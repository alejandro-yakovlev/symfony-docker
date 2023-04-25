<?php

namespace App\Company\Domain\Entity\Company;

use App\Shared\Domain\Service\UlidService;
use App\Shared\Domain\ValueObject\GlobalUserId;

class Company
{
    private string $id;

    private GlobalUserId $owner;

    private ContactPerson $contactPerson;

    private string $name;

    public function __construct(GlobalUserId $owner, ContactPerson $contactPerson, string $name)
    {
        $this->id = UlidService::generate();
        $this->owner = $owner;
        $this->contactPerson = $contactPerson;
        $this->name = $name;
    }
}
