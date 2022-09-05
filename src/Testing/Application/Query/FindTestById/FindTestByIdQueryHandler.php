<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindTestById;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Testing\Application\Query\DTO\Test\TestDTO;
use App\Testing\Domain\Repository\TestRepositoryInterface;

class FindTestByIdQueryHandler implements QueryHandlerInterface
{
    public function __construct(private TestRepositoryInterface $testRepository)
    {
    }

    public function __invoke(FindTestByIdQuery $query): ?TestDTO
    {
        $test = $this->testRepository->findOneById($query->id);

        return $test ? TestDTO::fromEntity($test) : null;
    }
}
