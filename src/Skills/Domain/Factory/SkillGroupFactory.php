<?php

namespace App\Skills\Domain\Factory;

use App\Skills\Domain\Entity\Skill\SkillGroup;
use App\Skills\Domain\Specification\SkillGroupNameSpecification;

class SkillGroupFactory
{
    public function __construct(private readonly SkillGroupNameSpecification $skillGroupNameSpecification)
    {
    }

    public function create(string $name): SkillGroup
    {
        return new SkillGroup($name, $this->skillGroupNameSpecification);
    }
}
