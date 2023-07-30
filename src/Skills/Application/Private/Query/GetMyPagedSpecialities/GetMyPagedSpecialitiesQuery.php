<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Query\GetMyPagedSpecialities;

use App\Shared\Application\Query\Query;
use App\Skills\Domain\Repository\SpecialityFilter;

/**
 * Получить список специальностей авторизованного пользователя.
 */
readonly class GetMyPagedSpecialitiesQuery extends Query
{
    public function __construct(public SpecialityFilter $filter)
    {
    }
}
