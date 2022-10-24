<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\ValueObject;

use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Service\UlidService;

class NullableUserUlid
{
    private ?string $id;

    public function __construct(?string $id)
    {
        if ($id) {
            AssertService::true(UlidService::isValid($id), 'ULID пользователя невалиден');
        }

        $this->id = $id;
    }

    public static function fromString(?string $id): self
    {
        return new self($id);
    }

    public function getId(): ?string
    {
        return $this->id;
    }
}
