<?php

namespace App\Skills\Domain\Aggregate\Skill\Specification;

use App\Shared\Domain\Specification\SpecificationInterface;

class SkillSpecification implements SpecificationInterface
{
    public function __construct(public readonly UniqueSkillInGroupSpecification $uniqueSkillInGroupSpecification)
    {
    }
}
