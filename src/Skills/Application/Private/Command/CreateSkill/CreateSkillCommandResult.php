<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\CreateSkill;

class CreateSkillCommandResult
{
    public function __construct(
        public readonly string $skillId,
    ) {
    }
}
