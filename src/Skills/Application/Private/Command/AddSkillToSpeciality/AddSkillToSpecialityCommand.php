<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\AddSkillToSpeciality;

use App\Shared\Application\Command\Command;

readonly class AddSkillToSpecialityCommand extends Command
{
    public function __construct(public string $skillId, public string $specialityId, public string $level)
    {
    }
}
