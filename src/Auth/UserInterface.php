<?php

declare(strict_types=1);

namespace App\Auth;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface as CoreUserInterface;

interface UserInterface extends CoreUserInterface, PasswordAuthenticatedUserInterface
{
    public function getId(): string;

    public function getEmail(): string;

    public function isConfirmed(): bool;
}
