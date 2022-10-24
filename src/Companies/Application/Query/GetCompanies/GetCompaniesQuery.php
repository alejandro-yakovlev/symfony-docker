<?php

declare(strict_types=1);

namespace App\Companies\Application\Query\GetCompanies;

use App\Shared\Application\Query\Query;
use App\Shared\Domain\Repository\Pager;

class GetCompaniesQuery extends Query
{
    public function __construct(public readonly Pager $pager)
    {
    }
}
