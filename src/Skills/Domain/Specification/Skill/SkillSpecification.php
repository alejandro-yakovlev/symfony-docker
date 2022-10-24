<?php

namespace App\Skills\Domain\Specification\Skill;

use App\Shared\Domain\Specification\SpecificationInterface;

class SkillSpecification implements SpecificationInterface
{
    public function __construct(public readonly UniqueSkillInGroupSpecification $uniqueSkillInGroupSpecification)
    {
    }
}
