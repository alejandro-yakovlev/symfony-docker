<?php

declare(strict_types=1);

namespace App\Skills\Domain\Factory;

use App\Skills\Domain\Aggregate\Specialist\Specialist;

class SpecialistFactory
{
    public function create(string $publicUserId): Specialist
    {
        return new Specialist($publicUserId);
    }
}
