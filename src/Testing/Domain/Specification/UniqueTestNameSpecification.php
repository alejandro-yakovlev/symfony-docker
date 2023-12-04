<?php

declare(strict_types=1);

namespace App\Testing\Domain\Specification;

use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Specification\SpecificationInterface;
use App\Testing\Domain\Aggregate\Test\Test;
use App\Testing\Domain\Repository\TestRepositoryInterface;

class UniqueTestNameSpecification implements SpecificationInterface
{
    public function __construct(private TestRepositoryInterface $testRepository)
    {
    }

    public function satisfy(Test $test): void
    {
        foreach ($this->testRepository->findByName($test->getName()) as $existingTest) {
            AssertService::notEq(
                $existingTest->getName(),
                $test->getName(),
                'Тест с таким названием уже существует'
            );
        }
    }
}
