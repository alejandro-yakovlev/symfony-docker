<?php

declare(strict_types=1);

namespace App\Recipes\Infrastructure\Repository;

use App\Recipes\Domain\Repository\RecipeRepositoryInterface;

class RecipeRepository implements RecipeRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function findAll(): array
    {
        return [];
    }
}
