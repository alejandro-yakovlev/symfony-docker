<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Query\FindMySpeciality;

use App\Skills\Application\Shared\DTO\Speciality\SpecialityDTO;

readonly class FindMySpecialityQueryResult
{
    public function __construct(public ?SpecialityDTO $speciality)
    {
    }
}
