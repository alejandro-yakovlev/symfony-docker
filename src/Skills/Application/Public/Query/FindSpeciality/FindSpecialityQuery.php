<?php

declare(strict_types=1);

namespace App\Skills\Application\Public\Query\FindSpeciality;

use App\Shared\Application\Query\Query;

readonly class FindSpecialityQuery extends Query
{
    public function __construct(public string $id)
    {
    }
}
