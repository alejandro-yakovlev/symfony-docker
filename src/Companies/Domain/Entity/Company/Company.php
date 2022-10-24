<?php

declare(strict_types=1);

namespace App\Companies\Domain\Entity\Company;

use App\Companies\Domain\Entity\Employee\Employee;
use App\Companies\Domain\Specification\CompanySpecification;
use App\Shared\Domain\Entity\ValueObject\UserUlid;
use App\Shared\Domain\Service\UlidService;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Company
{
    private string $id;
    private string $name;
    private ContactPerson $contactPerson;
    private UserUlid $owner;
    private Collection $employees;
    private DateTimeImmutable $createdAt;
    private CompanySpecification $companySpecification;

    public function __construct(
        CompanySpecification $companySpecification,
        UserUlid $owner,
        string $name,
        ContactPerson $contactPerson
    ) {
        $this->companySpecification = $companySpecification;
        $this->id = UlidService::generate();
        $this->employees = new ArrayCollection();
        $this->owner = $owner;
        $this->contactPerson = $contactPerson;
        $this->createdAt = new DateTimeImmutable();
        $this->setName($name);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContactPerson(): ContactPerson
    {
        return $this->contactPerson;
    }

    public function getOwner(): UserUlid
    {
        return $this->owner;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employee $employee): void
    {
        $this->employees->add($employee);
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function isEqualTo(Company $company): bool
    {
        return $this->id === $company->getId();
    }

    public function setName(string $name): void
    {
        $this->name = $name;
        $this->companySpecification->nameSpecification->satisfy($this);
    }
}
