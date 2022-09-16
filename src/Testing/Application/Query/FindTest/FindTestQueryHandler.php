<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindTest;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Testing\Application\Query\DTO\Test\TestDTO;
use App\Testing\Domain\Repository\TestRepositoryInterface;

class FindTestQueryHandler implements QueryHandlerInterface
{
    public function __construct(private TestRepositoryInterface $testRepository)
    {
    }

    public function __invoke(FindTestQuery $query): FindTestQueryResult
    {
        $test = $this->testRepository->findOneById($query->id);

        return new FindTestQueryResult($test ? TestDTO::fromEntity($test) : null);
    }
}
