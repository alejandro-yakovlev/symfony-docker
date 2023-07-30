<?php

declare(strict_types=1);

namespace App\Skills\Domain\Factory;

use App\Skills\Domain\Aggregate\Speciality\Speciality;
use App\Skills\Domain\Aggregate\Speciality\Specification\SpecialitySpecification;

readonly class SpecialityFactory
{
    public function __construct(private SpecialitySpecification $specialitySpecification)
    {
    }

    public function create(string $name, string $ownerId): Speciality
    {
        return new Speciality($name, $ownerId, $this->specialitySpecification);
    }
}
