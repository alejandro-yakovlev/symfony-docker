<?php

namespace App\Skills\Domain\Factory;

use App\Skills\Domain\Aggregate\Skill\Skill;
use App\Skills\Domain\Aggregate\Specialist\SkillConfirmation;
use App\Skills\Domain\Aggregate\Specialist\Specialist;

class SkillConfirmationFactory
{
    public function __construct()
    {
    }

    public function create(Specialist $specialist, Skill $skill): SkillConfirmation
    {
        return new SkillConfirmation($specialist, $skill);
    }
}
