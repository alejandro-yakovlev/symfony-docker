<?php

declare(strict_types=1);

namespace App\Skills\Application\Public\Query\FindSpeciality;

use App\Skills\Application\Shared\DTO\Speciality\SpecialityDTO;

readonly class FindSpecialityQueryResult
{
    public function __construct(public ?SpecialityDTO $speciality)
    {
    }
}
