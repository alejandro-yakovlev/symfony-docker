<?php

declare(strict_types=1);

namespace App\Skills\Domain\Entity\Skill;

use App\Shared\Domain\Service\UlidService;
use App\Skills\Domain\Specification\SkillGroupNameSpecification;

/**
 * Группа навыков.
 */
class SkillGroup
{
    private string $id;

    private string $name;

    private SkillGroupNameSpecification $skillGroupNameSpecification;

    public function __construct(
        string $name,
        SkillGroupNameSpecification $skillGroupNameSpecification
    ) {
        $this->skillGroupNameSpecification = $skillGroupNameSpecification;
        $this->id = UlidService::generate();
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
}
