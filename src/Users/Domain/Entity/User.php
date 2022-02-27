<?php

declare(strict_types=1);

namespace App\Users\Domain\Entity;

use App\Shared\Damain\Service\UlidService;

class User
{
    private string $ulid;
    private string $email;
    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->ulid = UlidService::generate();
        $this->email = $email;
        $this->password = $password;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}