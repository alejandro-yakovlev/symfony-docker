<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Command\CreateSkillGroup;

use App\Shared\Application\Command\Command;

readonly class CreateSkillGroupCommand extends Command
{
    public function __construct(
        public string $name
    ) {
    }
}
