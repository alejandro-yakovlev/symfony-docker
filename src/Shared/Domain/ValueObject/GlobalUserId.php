<?php

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Service\UlidService;

class GlobalUserId
{
    private string $id;

    public function __construct(string $id)
    {
        AssertService::true(UlidService::isValid($id));
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
