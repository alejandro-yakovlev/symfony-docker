<?php

namespace App\Shared\Domain\Entity\ValueObject;

use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Service\UlidService;

class UserUlid
{
    private string $id;

    public function __construct(string $id)
    {
        AssertService::true(UlidService::isValid($id), 'ULID пользователя невалиден');
        $this->id = $id;
    }

    public static function fromString(string $id): self
    {
        return new self($id);
    }

    public function getId(): string
    {
        return $this->id;
    }
}
