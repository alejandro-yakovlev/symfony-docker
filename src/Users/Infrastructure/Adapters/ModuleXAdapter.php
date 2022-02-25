<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Adapters;

use App\ModuleX\Infrastructure\API\API;

class ModuleXAdapter
{
    public function __construct(private readonly API $moduleXApi)
    {
    }

    public function getSomeData(): array{
        $data = $this->moduleXApi->getSomeData();
        // mapping

         return $data;
    }
}