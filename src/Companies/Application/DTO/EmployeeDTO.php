<?php

declare(strict_types=1);

namespace App\Companies\Application\DTO;

use App\Companies\Domain\Entity\Employee\Contact;
use App\Companies\Domain\Entity\Employee\Employee;

class EmployeeDTO
{
    public string $id;
    public Contact $contact;
    public string $companyId;
    public bool $invited;
    public bool $hired;

    public static function fromEntity(Employee $entity): self
    {
        $dto = new self();
        $dto->id = $entity->getId();
        $dto->contact = $entity->getContact();
        $dto->companyId = $entity->getCompany()->getId();
        $dto->invited = $entity->isInvited();
        $dto->hired = $entity->isHired();

        return $dto;
    }
}
