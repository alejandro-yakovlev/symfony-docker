<?php

namespace App\Skills\Domain\Specification\Skill;

class SkillSpecification
{
    public function __construct(public readonly UniqueSkillInGroupSpecification $uniqueSkillInGroupSpecification)
    {
    }
}
