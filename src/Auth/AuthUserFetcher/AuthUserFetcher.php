<?php

declare(strict_types=1);

namespace App\Auth\AuthUserFetcher;

use App\Auth\UserInterface;
use InvalidArgumentException;
use Symfony\Component\Security\Core\Security;

class AuthUserFetcher implements AuthUserFetcherInterface
{
    public function __construct(private readonly Security $security)
    {
    }

    public function getRequiredUser(): UserInterface
    {
        /** @var UserInterface|null $user */
        $user = $this->security->getUser();

        if (!$user) {
            throw new InvalidArgumentException('Current user not found check security access list');
        }

        return $user;
    }
}
