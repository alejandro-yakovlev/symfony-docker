<?php

declare(strict_types=1);

namespace App\Skills\Application\Command\CreateSkill;

use App\Shared\Application\Command\Command;

class CreateSkillCommand extends Command
{
    public function __construct(
        public readonly string $name,
        public readonly string $skillGroupId,
    ) {
    }
}
