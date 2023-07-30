<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\UpdateSpeciality;

use App\Shared\Application\Command\Command;
use App\Skills\Application\Shared\DTO\Speciality\SpecialityDTO;

readonly class UpdateSpecialityCommand extends Command
{
    public function __construct(
        public string $specialityId,
        public SpecialityDTO $specialityDTO
    ) {
    }
}
