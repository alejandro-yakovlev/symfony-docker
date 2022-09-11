<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindQuestionById;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Testing\Application\Query\DTO\Test\QuestionDTO;
use App\Testing\Domain\Repository\QuestionRepositoryInterface;

class FindQuestionByIdQueryHandler implements QueryHandlerInterface
{
    public function __construct(private QuestionRepositoryInterface $questionRepository)
    {
    }

    public function __invoke(FindQuestionByIdQuery $query): ?QuestionDTO
    {
        $question = $this->questionRepository->findOneById($query->id);

        return $question ? QuestionDTO::fromEntity($question) : null;
    }
}
