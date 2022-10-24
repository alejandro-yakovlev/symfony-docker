<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindAnswerOption;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Testing\Application\Query\DTO\Test\AnswerOptionDTO;
use App\Testing\Domain\Repository\AnswerOptionRepositoryInterface;

class FindAnswerOptionQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly AnswerOptionRepositoryInterface $answerOptionRepository)
    {
    }

    public function __invoke(FindAnswerOptionQuery $query): FindAnswerOptionQueryResult
    {
        $answerOption = $this->answerOptionRepository->findOneById($query->answerOptionId);

        return new FindAnswerOptionQueryResult(
            $answerOption ? AnswerOptionDTO::fromEntity($answerOption) : null
        );
    }
}
