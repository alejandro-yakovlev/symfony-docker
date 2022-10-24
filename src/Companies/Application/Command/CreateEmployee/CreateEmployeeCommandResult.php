<?php

declare(strict_types=1);

namespace App\Companies\Application\Command\CreateEmployee;

use App\Companies\Application\DTO\EmployeeDTO;

class CreateEmployeeCommandResult
{
    public function __construct(
        public readonly EmployeeDTO $employee
    ) {
    }
}
