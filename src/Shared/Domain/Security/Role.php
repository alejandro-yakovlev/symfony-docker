<?php

declare(strict_types=1);

namespace App\Shared\Domain\Security;

/**
 * Роль пользователя.
 */
class Role
{
    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';

    public const ROLES = [
        self::ROLE_USER,
        self::ROLE_ADMIN,
    ];
}
