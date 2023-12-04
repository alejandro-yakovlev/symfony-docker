<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Command\RemoveSkillFromSpeciality;

use App\Shared\Application\Command\Command;

readonly class RemoveSkillFromSpecialityCommand extends Command
{
    public function __construct(public string $specialitySkillId)
    {
    }
}
