<?php

declare(strict_types=1);

namespace App\Auth\AccessControl\AccessManager;

interface AccessMangerInterface
{
    public function isGranted(mixed $attributes, mixed $object = null): bool;
}
