<?php

declare(strict_types=1);

namespace App\Testing\Infrastructure\Security\Voter;

use App\Auth\UserInterface;
use App\Testing\Application\Voter\TestVoterInterface;
use App\Testing\Domain\Entity\Test\Test;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Проверка прав доступа к тесту.
 */
class TestVoter extends Voter implements TestVoterInterface
{
    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof Test && in_array($attribute, [self::EDIT], true);
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        /** @var UserInterface|null $user */
        $user = $token->getUser();

        return match ($attribute) {
            self::EDIT => $this->canEdit($subject, $user),
            default => false
        };
    }

    private function canEdit(Test $test, ?UserInterface $user): bool
    {
        return $test->getCreator()->getId() === $user->getId();
    }
}
