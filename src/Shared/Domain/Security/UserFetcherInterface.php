<?php

declare(strict_types=1);

namespace App\Shared\Domain\Security;

interface UserFetcherInterface
{
    public function requiredUser(): AuthUserInterface;

    public function requiredUserId(): string;

    public function nullableUser(): ?AuthUserInterface;

    public function nullableUserId(): ?string;
}
