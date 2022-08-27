<?php

namespace App\Skills\Domain\Factory;

use App\Skills\Domain\Entity\Skill\Skill;
use App\Skills\Domain\Entity\Skill\SkillGroup;
use App\Skills\Domain\Specification\Skill\SkillSpecification;

class SkillFactory
{
    public function __construct(private readonly SkillSpecification $skillSpecification)
    {
    }

    public function create(string $name, SkillGroup $skillGroup): Skill
    {
        return new Skill($name, $skillGroup, $this->skillSpecification);
    }
}
