<?php

declare(strict_types=1);

namespace App\Skills\Domain\Aggregate\Speciality;

use App\Shared\Domain\Aggregate\Id;
use App\Shared\Domain\Service\AssertService;
use App\Skills\Domain\Aggregate\Speciality\Specification\SpecialitySpecification;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Специальность.
 */
class Speciality
{
    private string $id;

    private string $ownerId;

    private string $name;
    private string $description = '';

    private PublicationStatus $publicationStatus = PublicationStatus::DRAFT;

    /**
     * @var Collection<SpecialitySkill>
     */
    private Collection $skills;

    private SpecialitySpecification $specification;

    private \DateTimeImmutable $createdAt;

    public function __construct(
        string $name,
        string $ownerId,
        SpecialitySpecification $specification,
    ) {
        $this->id = Id::makeUlid();
        $this->skills = new ArrayCollection();
        $this->specification = $specification;
        $this->ownerId = $ownerId;
        $this->createdAt = new \DateTimeImmutable();
        $this->setName($name);
    }

    public function addSkill(SpecialitySkill $skill): void
    {
        $this->skills->add($skill);
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Опубликовать.
     */
    public function publish(): void
    {
        AssertService::greaterThanEq($this->skills->count(), 1, 'В специальности должен быть минимум 1 навык');

        $this->publicationStatus = PublicationStatus::PUBLISHED;
    }

    /**
     * Отправить в черновик.
     */
    public function draft(): void
    {
        $this->publicationStatus = PublicationStatus::DRAFT;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isPublished(): bool
    {
        return $this->publicationStatus->equals(PublicationStatus::PUBLISHED);
    }

    public function setOwnerId(string $ownerId): void
    {
        $this->ownerId = $ownerId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getOwnerId(): ?string
    {
        return $this->ownerId;
    }

    public function getSkills(): Collection
    {
        return $this->skills;
    }

    /**
     * Удалить специальность (Отправить специальность в архив).
     */
    public function delete(): void
    {
        AssertService::notEq(
            $this->publicationStatus,
            PublicationStatus::DELETED,
            'Специальность уже удалена'
        );
        $this->publicationStatus = PublicationStatus::DELETED;
    }

    public function isDeleted(): bool
    {
        return $this->publicationStatus->equals(PublicationStatus::DELETED);
    }

    public function getPublicationStatus(): PublicationStatus
    {
        return $this->publicationStatus;
    }

    /**
     * Принадлежит ли специальность пользователю.
     */
    public function isOwnedBy(string $ownerId): bool
    {
        return $this->ownerId === $ownerId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
