<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\FindSpeciality;

use App\Skills\Application\DTO\Speciality\SpecialityDTO;

readonly class FindSpecialityQueryResult
{
    public function __construct(public ?SpecialityDTO $speciality)
    {
    }
}
