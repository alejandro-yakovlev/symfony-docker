<?php

declare(strict_types=1);

namespace App\Skills\Domain\Entity\Skill;

use App\Shared\Domain\Entity\Aggregate;
use App\Shared\Domain\Service\UlidService;
use App\Skills\Domain\Specification\Skill\SkillGroupNameSpecification;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Группа навыков.
 */
class SkillGroup extends Aggregate
{
    private string $id;

    private string $name;

    /**
     * @var Collection<Skill>
     */
    private Collection $skills;

    private SkillGroupNameSpecification $skillGroupNameSpecification;

    public function __construct(
        string $name,
        SkillGroupNameSpecification $skillGroupNameSpecification
    ) {
        $this->skillGroupNameSpecification = $skillGroupNameSpecification;
        $this->id = UlidService::generate();
        $this->skills = new ArrayCollection();
        $this->setName($name);
    }

    public function setName(string $name): void
    {
        $this->name = $name;
        $this->skillGroupNameSpecification->satisfy($this);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Collection<Skill>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }
}
