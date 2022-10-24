<?php

declare(strict_types=1);

namespace App\Companies\Application\Command\InviteEmployee;

use App\Shared\Application\Command\Command;

class InviteEmployeeCommand extends Command
{
    public function __construct(public readonly string $employeeId)
    {
    }
}
