<?php

declare(strict_types=1);

namespace App\Skills\Domain\Service;

use App\Skills\Domain\Aggregate\Speciality\Speciality;
use App\Skills\Domain\Factory\SpecialityFactory;
use App\Skills\Domain\Repository\SpecialityRepositoryInterface;

final readonly class SpecialityMaker
{
    public function __construct(
        private SpecialityFactory $specialityFactory,
        private SpecialityRepositoryInterface $specialityRepository
    ) {
    }

    public function make(string $name, string $ownerId): Speciality
    {
        $speciality = $this->specialityFactory->create($name, $ownerId);
        $this->specialityRepository->add($speciality);

        return $speciality;
    }
}
