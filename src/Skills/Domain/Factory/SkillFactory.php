<?php

namespace App\Skills\Domain\Factory;

use App\Skills\Domain\Aggregate\Skill\Skill;
use App\Skills\Domain\Aggregate\Skill\SkillGroup;
use App\Skills\Domain\Aggregate\Skill\Specification\SkillSpecification;

readonly class SkillFactory
{
    public function __construct(private SkillSpecification $skillSpecification)
    {
    }

    public function create(string $name, SkillGroup $skillGroup, string $ownerId): Skill
    {
        return new Skill($name, $skillGroup, $ownerId, $this->skillSpecification);
    }
}
