<?php

declare(strict_types=1);

namespace App\Skills\Application\Command\CreateSkillGroup;

use App\Shared\Application\Command\Command;

class CreateSkillGroupCommand extends Command
{
    public function __construct(
        public readonly string $name
    ) {
    }
}
