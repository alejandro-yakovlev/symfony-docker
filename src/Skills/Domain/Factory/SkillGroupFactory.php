<?php

namespace App\Skills\Domain\Factory;

use App\Skills\Domain\Aggregate\Skill\SkillGroup;
use App\Skills\Domain\Aggregate\Skill\Specification\SkillGroupNameSpecification;

readonly class SkillGroupFactory
{
    public function __construct(private SkillGroupNameSpecification $skillGroupNameSpecification)
    {
    }

    public function create(string $name, string $ownerId): SkillGroup
    {
        return new SkillGroup(
            $name,
            $ownerId,
            $this->skillGroupNameSpecification
        );
    }
}
