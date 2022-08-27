<?php

namespace App\Skills\Domain\Factory;

use App\Skills\Domain\Entity\Skill\Skill;
use App\Skills\Domain\Entity\Specialist\SkillConfirmation;
use App\Skills\Domain\Entity\Specialist\Specialist;

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
