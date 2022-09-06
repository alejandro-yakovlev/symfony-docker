<?php

namespace App\Company\Domain\Entity\Company;

use App\Shared\Domain\Entity\ValueObject\GlobalUserId;

class Company
{
    private string $id;

    private GlobalUserId $owner;

    private ContactPerson $contactPerson;

    private string $name;

    public function __construct(GlobalUserId $owner, ContactPerson $contactPerson, string $name)
    {
        $this->owner = $owner;
        $this->contactPerson = $contactPerson;
        $this->name = $name;
    }
}
