<?php

declare(strict_types=1);

namespace App\Companies\Domain\Entity\Employee;

use App\Companies\Domain\Entity\Company\Company;
use App\Shared\Domain\Entity\ValueObject\NullableUserUlid;
use App\Shared\Domain\Service\UlidService;
use DateTimeImmutable;
use Webmozart\Assert\Assert;

class Employee
{
    private string $id;
    private Contact $contact;
    private Company $company;
    private ?NullableUserUlid $user = null;
    private bool $hired = false;
    private ?Invite $invite = null;
    private bool $canInviteEmployees = false;
    private DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $hiredAt = null;

    public function __construct(Contact $contact, Company $company)
    {
        $this->id = UlidService::generate();
        $this->contact = $contact;
        $this->company = $company;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getContact(): Contact
    {
        return $this->contact;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }

    public function getUser(): ?NullableUserUlid
    {
        return $this->user;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getHiredAt(): ?DateTimeImmutable
    {
        return $this->hiredAt;
    }

    public function setUser(?NullableUserUlid $user): void
    {
        $this->user = $user;
    }

    public function hire(): void
    {
        Assert::true($this->hired, 'Сотрудник уже нанят');
        $this->hiredAt = new DateTimeImmutable();
        $this->hired = true;
    }

    public function canInviteEmployees(): bool
    {
        return $this->canInviteEmployees;
    }

    public function setCanInviteEmployees(bool $canInviteEmployees): void
    {
        $this->canInviteEmployees = $canInviteEmployees;
    }

    public function getInvite(): ?Invite
    {
        return $this->invite;
    }

    public function setInvite(?Invite $invite): void
    {
        $this->invite = $invite;
    }

    public function isInvited(): bool
    {
        return !is_null($this->invite);
    }

    public function isHired(): bool
    {
        return $this->hired;
    }
}
