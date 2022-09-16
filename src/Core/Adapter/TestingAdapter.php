<?php

declare(strict_types=1);

namespace App\Core\Adapter;

use App\Core\GraphQL\Type\Testing\AnswerOptionGQ;
use App\Core\GraphQL\Type\Testing\QuestionGQ;
use App\Core\GraphQL\Type\Testing\TestGQ;
use App\Testing\Application\Command\CreateAnswerOption\CreateAnswerOptionCommand;
use App\Testing\Application\Command\CreateQuestion\CreateQuestionCommand;
use App\Testing\Application\Command\CreateTest\CreateTestCommand;
use App\Testing\Application\Query\DTO\Test\QuestionDTO;
use App\Testing\Application\Query\FindAnswerOption\FindAnswerOptionQuery;
use App\Testing\Application\Query\FindQuestion\FindQuestionQuery;
use App\Testing\Application\Query\FindTest\FindTestQuery;
use App\Testing\Infrastructure\Api\TestingApi;

class TestingAdapter
{
    public function __construct(private readonly TestingApi $testingApi)
    {
    }

    public function findTest(string $testId): ?TestGQ
    {
        $test = $this->testingApi->queryInteractor->findTest(new FindTestQuery($testId))->test;
        $questions = array_map(fn (QuestionDTO $qDto) => QuestionGQ::fromDTO($qDto), $test->questions);

        if (!$test) {
            return null;
        }

        return new TestGQ(
            id: $test->id,
            name: $test->name,
            description: $test->description,
            correctAnswersPercentage: $test->correctAnswersPercentage,
            published: $test->isPublished,
            difficultyLevel: $test->difficultyLevel,
            questions: $questions,
        );
    }

    public function createTest(
        string $creatorId,
        string $name,
        string $description,
        string $difficultyLevel,
        int $correctAnswersPercentage,
        ?string $skillId,
    ): TestGQ {
        $command = new CreateTestCommand(
            $creatorId, $name, $description, $difficultyLevel, $correctAnswersPercentage, $skillId
        );

        $testId = $this->testingApi->commandInteractor->createTest($command);

        return $this->findTest($testId);
    }

    public function findQuestion(string $questionId): ?QuestionGQ
    {
        $question = $this->testingApi->queryInteractor->findQuestion(new FindQuestionQuery($questionId))->question;

        if (!$question) {
            return null;
        }

        return new QuestionGQ(
            id: $question->id,
            name: $question->name,
            description: $question->description,
            positionNumber: $question->positionNumber,
            published: $question->published,
            type: $question->type,
        );
    }

    public function createQuestion(string $name, string $description, string $type, string $testId): QuestionGQ
    {
        $command = new CreateQuestionCommand($name, $description, $type, $testId);
        $questionId = $this->testingApi->commandInteractor->createQuestion($command);

        return $this->findQuestion($questionId);
    }

    public function createAnswerOption(
        string $questionId,
        string $description,
        bool $isCorrect,
    ): ?AnswerOptionGQ {
        $command = new CreateAnswerOptionCommand($questionId, $description, $isCorrect);
        $answerOptionId = $this->testingApi->commandInteractor->createAnswerOption($command);

        $answerOption = $this->testingApi->queryInteractor->findAnswerOption(
            new FindAnswerOptionQuery($answerOptionId)
        )->answerOption;

        return new AnswerOptionGQ(
            id: $answerOption->id,
            description: $answerOption->description,
            isCorrect: $answerOption->isCorrect,
        );
    }
}
