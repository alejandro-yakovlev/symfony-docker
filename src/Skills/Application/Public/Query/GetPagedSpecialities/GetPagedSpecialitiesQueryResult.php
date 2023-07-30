<?php

declare(strict_types=1);

namespace App\Skills\Application\Public\Query\GetPagedSpecialities;

use App\Shared\Domain\Repository\Pager;
use App\Skills\Application\Shared\DTO\Speciality\SpecialityDTO;

readonly class GetPagedSpecialitiesQueryResult
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
