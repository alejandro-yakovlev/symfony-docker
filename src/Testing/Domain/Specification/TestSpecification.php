<?php

declare(strict_types=1);

namespace App\Testing\Domain\Specification;

use App\Shared\Domain\Specification\SpecificationInterface;

class TestSpecification implements SpecificationInterface
{
    public function __construct(public readonly UniqueTestNameSpecification $uniqueTestNameSpecification)
    {
    }
}
