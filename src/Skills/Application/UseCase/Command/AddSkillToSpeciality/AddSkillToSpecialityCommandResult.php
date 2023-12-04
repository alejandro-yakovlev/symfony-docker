<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Command\AddSkillToSpeciality;

readonly class AddSkillToSpecialityCommandResult
{
    public function __construct(public string $specialitySkillId)
    {
    }
}
