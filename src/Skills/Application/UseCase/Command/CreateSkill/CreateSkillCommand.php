<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Command\CreateSkill;

use App\Shared\Application\Command\Command;

readonly class CreateSkillCommand extends Command
{
    public function __construct(
        public string $name,
        public string $skillGroupId,
    ) {
    }
}
