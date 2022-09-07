<?php

declare(strict_types=1);

namespace App\Testing\Infrastructure\Security\Voter;

use App\Shared\Domain\Security\UserFetcherInterface;
use App\Testing\Application\Query\DTO\Test\TestDTO;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Права доступа к тесту
 */
class TestVoter extends Voter
{
    public const EDIT = 'edit';

    public function __construct(private readonly UserFetcherInterface $userFetcher)
    {
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof TestDTO && in_array($attribute, [self::EDIT]);
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        return match ($attribute) {
            self::EDIT => $this->canEdit($subject)
        };
    }

    private function canEdit(TestDTO $test): bool
    {
        return $test->creatorId === $this->userFetcher->getAuthUser()->getId();
    }
}
