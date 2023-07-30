<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\CreateSpeciality;

readonly class CreateSpecialityCommandResult
{
    public function __construct(public string $specialityId)
    {
    }
}
