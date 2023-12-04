<?php

declare(strict_types=1);

namespace App\Testing\Application;

use App\Shared\Application\Command\CommandBusInterface;
use App\Testing\Application\Command\CreateAnswerOption\CreateAnswerOptionCommand;
use App\Testing\Application\Command\CreateQuestion\CreateQuestionCommand;
use App\Testing\Application\Command\CreateTest\CreateTestCommand;

readonly class CommandInteractor
{
    public function __construct(
        private CommandBusInterface $commandBus,
    ) {
    }

    public function createTest(
        string $ownerId,
        string $name,
        string $description,
        string $difficultyLevel,
        int $correctAnswersPercentage,
        ?string $skillId,
    ): string {
        return $this->commandBus->execute(
            new CreateTestCommand(
                $ownerId,
                $name,
                $description,
                $difficultyLevel,
                $correctAnswersPercentage,
                $skillId,
            )
        );
    }

    public function createQuestion(
        string $name,
        string $description,
        string $type,
        string $testId
    ): string {
        return $this->commandBus->execute(
            new CreateQuestionCommand(
                $name,
                $description,
                $type,
                $testId,
            )
        );
    }

    public function createAnswerOption(
        string $questionId,
        string $description,
        bool $correct
    ): string {
        return $this->commandBus->execute(
            new CreateAnswerOptionCommand(
                $questionId,
                $description,
                $correct,
            )
        );
    }
}
