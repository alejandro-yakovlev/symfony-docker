<?php

declare(strict_types=1);

namespace App\Users\Domain\Factory;

use App\Users\Domain\Entity\User;

class UserFactory
{

    public function create(string $email, string $password): User
    {
        return new User($email, $password);
    }
}