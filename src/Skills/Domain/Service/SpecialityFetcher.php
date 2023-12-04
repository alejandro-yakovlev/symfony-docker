<?php

declare(strict_types=1);

namespace App\Skills\Domain\Service;

use App\Skills\Domain\Aggregate\Speciality\Speciality;
use App\Skills\Domain\Repository\SpecialityFilter;
use App\Skills\Domain\Repository\SpecialityRepositoryInterface;
use Webmozart\Assert\Assert;

readonly class SpecialityFetcher
{
    public function __construct(private SpecialityRepositoryInterface $specialityRepository)
    {
    }

    public function getRequiredSpeciality(string $id): Speciality
    {
        $speciality = $this->specialityRepository->findOne(
            new SpecialityFilter(
                id: $id
            )
        );
        Assert::notEmpty($speciality, 'Специальность не найдена');

        return $speciality;
    }
}
