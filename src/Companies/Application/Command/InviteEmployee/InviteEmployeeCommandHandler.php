<?php

declare(strict_types=1);

namespace App\Companies\Application\Command\InviteEmployee;

use App\Companies\Domain\Service\InviterService;
use App\Shared\Application\Command\CommandHandlerInterface;

class InviteEmployeeCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly InviterService $inviterService
    ) {
    }

    public function __invoke(InviteEmployeeCommand $command): InviteEmployeeCommandResult
    {
        $this->inviterService->makeInvite($command->employeeId);

        return new InviteEmployeeCommandResult();
    }
}
