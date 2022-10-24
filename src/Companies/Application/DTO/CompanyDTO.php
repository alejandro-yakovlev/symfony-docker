<?php

declare(strict_types=1);

namespace App\Companies\Application\DTO;

use App\Companies\Domain\Entity\Company\Company;
use App\Companies\Domain\Entity\Company\ContactPerson;
use DateTimeImmutable;

class CompanyDTO
{
    public string $id;
    public string $name;
    public string $ownerId;
    public ContactPerson $contactPerson;
    public DateTimeImmutable $createdAt;

    public static function fromEntity(Company $company): self
    {
        $dto = new self();
        $dto->id = $company->getId();
        $dto->name = $company->getName();
        $dto->createdAt = $company->getCreatedAt();
        $dto->contactPerson = $company->getContactPerson();
        $dto->ownerId = $company->getOwner()->getId();

        return $dto;
    }

    /**
     * @param Company[] $items
     */
    public static function fromArray(array $items): array
    {
        return array_map(fn (Company $c) => self::fromEntity($c), $items);
    }
}
