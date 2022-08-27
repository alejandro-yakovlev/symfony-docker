<?php

declare(strict_types=1);

namespace App\Skills\Domain\Specification\Speciality;

class SpecialitySpecification
{
    public function __construct(public readonly SpecialityNameSpecification $nameSpecification)
    {
    }
}
