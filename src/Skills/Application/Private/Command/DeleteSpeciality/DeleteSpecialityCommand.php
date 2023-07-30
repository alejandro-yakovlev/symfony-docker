<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\DeleteSpeciality;

use App\Shared\Application\Command\Command;

readonly class DeleteSpecialityCommand extends Command
{
    public function __construct(public string $specialityId)
    {
    }
}
