<?php

declare(strict_types=1);

namespace App\Skills\Domain\Entity\Speciality;

use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Service\ULIDService;
use App\Shared\Domain\ValueObject\GlobalUserId;
use App\Skills\Domain\Entity\Skill\Skill;
use App\Skills\Domain\Specification\Speciality\SpecialitySpecification;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Специальность.
 */
class Speciality
{
    private string $id;

    private GlobalUserId $creator;

    private string $name;

    private bool $isPublished = false;

    /**
     * @var Collection<Skill>
     */
    private Collection $skills;

    private SpecialitySpecification $specification;

    public function __construct(
        GlobalUserId $creator,
        string $name,
        SpecialitySpecification $specification,
    ) {
        $this->id = ULIDService::generate();
        $this->creator = $creator;
        $this->name = $name;
        $this->skills = new ArrayCollection();
        $this->specification = $specification;
    }

    public function addSkill(Skill $skill): void
    {
        if (!$this->skills->contains($skill)) {
            $this->skills->add($skill);
        }
    }

    public function removeSkill(Skill $skill): void
    {
        if ($this->skills->contains($skill)) {
            $this->skills->removeElement($skill);
        }
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        $this->specification->nameSpecification->isSatisfiedBy($this);

        return $this;
    }

    /**
     * Опубликовать.
     */
    public function publish(): void
    {
        AssertService::greaterThanEq($this->skills->count(), 1, 'В специальности должен быть минимум 1 навык');

        $this->isPublished = true;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
