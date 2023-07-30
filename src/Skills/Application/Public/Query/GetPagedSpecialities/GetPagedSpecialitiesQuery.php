<?php

declare(strict_types=1);

namespace App\Skills\Application\Public\Query\GetPagedSpecialities;

use App\Shared\Application\Query\Query;
use App\Skills\Domain\Repository\SpecialityFilter;

readonly class GetPagedSpecialitiesQuery extends Query
{
    public function __construct(public SpecialityFilter $filter)
    {
    }
}
