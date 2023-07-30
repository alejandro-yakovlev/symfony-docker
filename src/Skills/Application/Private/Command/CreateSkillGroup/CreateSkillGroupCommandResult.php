<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\CreateSkillGroup;

class CreateSkillGroupCommandResult
{
    public function __construct(
        public readonly string $skillGroupId,
    ) {
    }
}
