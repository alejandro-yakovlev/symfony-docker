<?php

declare(strict_types=1);

namespace App\Users\Domain\Repository;

use App\Users\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function add(User $user): void;

    public function findByUlid(string $ulid): ?User;

    public function findByEmail(string $email): ?User;
}