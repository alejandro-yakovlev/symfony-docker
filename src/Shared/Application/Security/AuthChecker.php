<?php

declare(strict_types=1);

namespace App\Shared\Application\Security;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Вспомогательный класс для проверки прав доступа.
 */
readonly class AuthChecker
{
    public function __construct(private AuthorizationCheckerInterface $authorizationChecker)
    {
    }

    public function isGranted(mixed $attribute, mixed $subject = null): bool
    {
        return $this->authorizationChecker->isGranted($attribute, $subject);
    }
}
