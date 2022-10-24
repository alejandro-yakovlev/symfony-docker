<?php

declare(strict_types=1);

namespace App\Companies\Application\AccessControl\Action;

enum CompanyAction
{
    public const CREATE = 'create';
    public const CREATE_EMPLOYEE = 'create-employee';
}
