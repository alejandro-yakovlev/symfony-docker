<?php

declare(strict_types=1);

namespace App\Auth\AuthUserFetcher;

use App\Auth\UserInterface;
use InvalidArgumentException;

/**
 * Сервис получения личности аутентифицированного пользователя.
 */
interface AuthUserFetcherInterface
{
    /**
     * @throws InvalidArgumentException
     */
    public function getRequiredUser(): UserInterface;
}
