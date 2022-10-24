<?php

declare(strict_types=1);

namespace App\Companies\Application\AccessControl\Action;

enum EmployeeAction
{
    public const INVITE = 'invite';
    public const CREATE = 'create';
}
