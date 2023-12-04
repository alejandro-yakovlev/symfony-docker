<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Command\DeleteSkill;

use App\Shared\Application\Command\Command;

readonly class DeleteSkillCommand extends Command
{
    public function __construct(public string $skillId)
    {
    }
}
