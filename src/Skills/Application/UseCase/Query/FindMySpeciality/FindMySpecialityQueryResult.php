<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\FindMySpeciality;

use App\Skills\Application\DTO\Speciality\SpecialityDTO;

readonly class FindMySpecialityQueryResult
{
    public function __construct(public ?SpecialityDTO $speciality)
    {
    }
}
