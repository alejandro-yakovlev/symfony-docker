<?php

declare(strict_types=1);

namespace App\Skills\Domain\Specification\Speciality;

use App\Shared\Domain\Specification\SpecificationInterface;
use App\Skills\Domain\Entity\Speciality\Speciality;
use App\Skills\Domain\Repository\SpecialityRepositoryInterface;

class SpecialityNameSpecification implements SpecificationInterface
{
    public function __construct(private readonly SpecialityRepositoryInterface $specialityRepository)
    {
    }

    public function isSatisfiedBy(Speciality $speciality): bool
    {
        return $this->hasUniqueName($speciality);
    }

    private function hasUniqueName(Speciality $speciality): bool
    {
        $foundSpeciality = $this->specialityRepository->findByName($speciality->getName());

        return is_null($foundSpeciality) || $speciality->getId() === $foundSpeciality->getId();
    }
}
