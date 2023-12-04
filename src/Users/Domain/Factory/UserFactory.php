<?php

declare(strict_types=1);

namespace App\Users\Domain\Factory;

use App\Shared\Domain\Security\Role;
use App\Users\Domain\Entity\User;
use App\Users\Domain\Service\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function create(string $email, string $password, string $role = Role::ROLE_USER): User
    {
        $user = new User($email, $role);
        $user->setPassword($password, $this->passwordHasher);

        return $user;
    }
}
