<?php

declare(strict_types=1);

namespace App\Testing\Domain\Specification;

use App\Shared\Domain\Specification\SpecificationInterface;

readonly class TestSpecification implements SpecificationInterface
{
    public function __construct(public UniqueTestNameSpecification $uniqueTestNameSpecification)
    {
    }
}
