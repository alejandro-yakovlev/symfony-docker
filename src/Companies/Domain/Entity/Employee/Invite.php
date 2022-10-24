<?php

declare(strict_types=1);

namespace App\Companies\Domain\Entity\Employee;

use App\Shared\Domain\Service\UlidService;
use DateTimeImmutable;

class Invite
{
    private string $id;
    private Employee $employee;
    private DateTimeImmutable $createdAt;

    public function __construct(Employee $employee)
    {
        $this->id = UlidService::generate();
        $this->employee = $employee;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmployee(): Employee
    {
        return $this->employee;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
