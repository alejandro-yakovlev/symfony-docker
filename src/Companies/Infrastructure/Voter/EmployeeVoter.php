<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Voter;

use App\Auth\UserInterface;
use App\Companies\Application\AccessControl\Action\EmployeeAction;
use App\Companies\Domain\Entity\Employee\Employee;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class EmployeeVoter extends Voter
{
    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof Employee && EmployeeAction::INVITE === $attribute;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        /** @var UserInterface $user */
        $user = $token->getUser();

        return match ($attribute) {
            EmployeeAction::INVITE => $this->canInvite($subject, $user),
            default => false
        };
    }

    // TODO: вынести проверки на Application слой
    private function canInvite(Employee $employee, ?UserInterface $user): bool
    {
        $company = $employee->getCompany();

        // Пользователь может приглашать сотрудника компании если является владельцем
        if ($user->getId() === $company->getOwner()->getId()) {
            return true;
        }

        // Ищем приглашающего пользователя среди сотрудников компании.
        $inviter = $company->getEmployees()
            ->filter(fn (Employee $e) => $e->getUser() && $e->getUser()->getId() === $user->getId())
            ->first();

        if (!$inviter) {
            return false;
        }

        // Пользователь может отправить приглашение другому сотруднику,
        // если они работают в одной компании
        if (!$employee->getCompany()->isEqualTo($inviter->getCompany())) {
            return false;
        }

        // и пользователь имеет право приглашать других сотрудников
        return $inviter->canInviteEmployees();
    }
}
