<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Query\FindMySpeciality;

use App\Shared\Application\Query\Query;

readonly class FindMySpecialityQuery extends Query
{
    public function __construct(public string $id)
    {
    }
}
