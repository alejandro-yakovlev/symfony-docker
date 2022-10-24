<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Voter;

use App\Auth\AuthUserFetcher\AuthUserFetcherInterface;
use App\Auth\UserInterface;
use App\Companies\Application\AccessControl\Action\CompanyAction;
use App\Companies\Domain\Entity\Company\Company;
use App\Companies\Domain\Entity\Employee\Employee;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CompanyVoter extends Voter
{
    public function __construct(private readonly AuthUserFetcherInterface $userFetcher)
    {
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof Company || Company::class === $subject;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        /** @var UserInterface $user */
        $user = $token->getUser();

        return match ($attribute) {
            CompanyAction::CREATE => $this->canCreate(),
            CompanyAction::CREATE_EMPLOYEE => $this->canCreateEmployee($subject, $user),
            default => false
        };
    }

    private function canCreate(): bool
    {
        $user = $this->userFetcher->getRequiredUser();

        return $user->isConfirmed();
    }

    private function canCreateEmployee(Company $company, ?UserInterface $user): bool
    {
        // Пользователь может создать сотрудника компании если является владельцем
        if ($user->getId() === $company->getOwner()->getId()) {
            return true;
        }

        // Ищем приглашающего пользователя среди сотрудников компании.
        $inviter = $company->getEmployees()
            ->filter(fn (Employee $employee) => $employee->getUser()->getId() === $user->getId())
            ->first();

        if (!$inviter) {
            return false;
        }

        // Пользователь может создать сотрудника компании если имеет право приглашать сотрудников
        return $inviter->canInviteEmployees();
    }
}
