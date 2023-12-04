<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindQuestion;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Testing\Application\Query\DTO\Test\QuestionDTO;
use App\Testing\Domain\Repository\QuestionRepositoryInterface;

class FindQuestionQueryHandler implements QueryHandlerInterface
{
    public function __construct(private QuestionRepositoryInterface $questionRepository)
    {
    }

    public function __invoke(FindQuestionQuery $query): FindQuestionQueryResult
    {
        $question = $this->questionRepository->findOneById($query->id);

        return new FindQuestionQueryResult($question ? QuestionDTO::fromEntity($question) : null);
    }
}
