<?php

declare(strict_types=1);

namespace App\Users\Application\DTO;

use App\Users\Domain\Entity\User;

readonly class UserDTO
{
    public function __construct(public string $id, public string $name, public string $email)
    {
    }

    public static function fromEntity(User $user): self
    {
        return new self(id: $user->getId(), name: '', email: $user->getEmail());
    }
}
