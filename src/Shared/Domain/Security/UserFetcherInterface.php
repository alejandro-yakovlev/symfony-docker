<?php

declare(strict_types=1);

namespace App\Shared\Domain\Security;

interface UserFetcherInterface
{
    public function getAuthUser(): AuthUserInterface;
}
