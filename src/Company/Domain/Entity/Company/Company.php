<?php

namespace App\Company\Domain\Entity\Company;

use App\Shared\Domain\Entity\ValueObject\GlobalUserId;
use App\Shared\Domain\Service\UlidService;

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

    public function getId(): string
    {
        return $this->id;
    }

    public function getOwner(): GlobalUserId
    {
        return $this->owner;
    }

    public function getContactPerson(): ContactPerson
    {
        return $this->contactPerson;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
