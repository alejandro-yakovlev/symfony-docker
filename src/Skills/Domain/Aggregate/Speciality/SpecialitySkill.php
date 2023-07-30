<?php

declare(strict_types=1);

namespace App\Skills\Domain\Aggregate\Speciality;

use App\Shared\Domain\Aggregate\Id;
use App\Skills\Domain\Aggregate\Skill\Skill;

class SpecialitySkill
{
    private string $id;

    private Speciality $speciality;

    private Skill $skill;

    private Level $level;

    public function __construct(Speciality $specialist, Skill $skill, Level $level)
    {
        $this->id = Id::makeUlid();
        $this->speciality = $specialist;
        $this->skill = $skill;
        $this->level = $level;
    }

    public function setLevel(Level $level): void
    {
        $this->level = $level;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSpeciality(): Speciality
    {
        return $this->speciality;
    }

    public function getSkill(): Skill
    {
        return $this->skill;
    }

    public function getLevel(): Level
    {
        return $this->level;
    }
}
