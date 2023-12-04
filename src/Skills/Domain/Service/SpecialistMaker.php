<?php

declare(strict_types=1);

namespace App\Skills\Domain\Service;

use App\Skills\Domain\Aggregate\Specialist\Specialist;
use App\Skills\Domain\Factory\SpecialistFactory;

final class SpecialistMaker
{
    public function __construct(private SpecialistFactory $specialistFactory)
    {
    }

    public function make(string $publicUserId): Specialist
    {
        return $this->specialistFactory->create($publicUserId);
    }
}