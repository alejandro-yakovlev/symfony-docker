<?php

declare(strict_types=1);

namespace App\Testing\Application;

use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Infrastructure\Security\PermissionChecker;
use App\Testing\Application\Command\CreateAnswerOption\CreateAnswerOptionCommand;
use App\Testing\Application\Command\CreateQuestion\CreateQuestionCommand;
use App\Testing\Application\Command\CreateTest\CreateTestCommand;

class CommandInteractor
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        private readonly PermissionChecker $permissionChecker,
    ) {
    }

    public function createTest(CreateTestCommand $command): string
    {
        return $this->commandBus->execute($command);
    }

    public function createQuestion(CreateQuestionCommand $command): string
    {
        $this->permissionChecker->denyAccessUnlessGranted('execute', $command);

        return $this->commandBus->execute($command);
    }

    public function createAnswerOption(CreateAnswerOptionCommand $command): string
    {
        return $this->commandBus->execute($command);
    }
}
