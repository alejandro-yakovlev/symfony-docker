<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\GetMyPagedSpecialities;

use App\Shared\Domain\Repository\Pager;
use App\Skills\Application\DTO\Speciality\SpecialityDTO;

readonly class GetMyPagedSpecialitiesQueryResult
{
    /**
     * @param SpecialityDTO[] $specialities
     */
    public function __construct(
        public array $specialities,
        public Pager $pager
    ) {
    }
}
