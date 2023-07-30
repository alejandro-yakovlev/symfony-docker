<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\UpdateSpecialityPublicationStatus;

use App\Shared\Application\Command\Command;

readonly class UpdateSpecialityPublicationStatusCommand extends Command
{
    public function __construct(public string $specialityId, public string $publicationStatus)
    {
    }
}
