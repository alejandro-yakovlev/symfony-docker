<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\CreateSpeciality;

use App\Shared\Application\Command\Command;

readonly class CreateSpecialityCommand extends Command
{
    public function __construct(
        public string $name
    ) {
    }
}
