<?php

declare(strict_types=1);

namespace App\Shared\Damain\Security;

interface UserFetcherInterface
{
    public function getAuthUser(): AuthUserInterface;
}