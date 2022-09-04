<?php

declare(strict_types=1);

namespace App\Skills\Application\Command\CreateSkill;

use App\Shared\Application\Command\CommandInterface;

class CreateSkillCommand implements CommandInterface
{
    public function __construct(
        public readonly string $name,
        public readonly string $skillGroupId,
    ) {
    }
}
