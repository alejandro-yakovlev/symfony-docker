<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateQuestion;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Testing\Domain\Aggregate\Test\QuestionType;
use App\Testing\Domain\Factory\QuestionFactory;
use App\Testing\Domain\Repository\TestRepositoryInterface;

class CreateQuestionCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private TestRepositoryInterface $testRepository,
        private QuestionFactory $questionFactory
    ) {
    }

    public function __invoke(CreateQuestionCommand $command): string
    {
        $test = $this->testRepository->findOneById($command->testId);
        $question = $this->questionFactory->create(
            $command->name,
            $command->description,
            QuestionType::from($command->type),
            $test
        );
        $test->addQuestion($question);
        $this->testRepository->add($test);

        return $question->getId();
    }
}
