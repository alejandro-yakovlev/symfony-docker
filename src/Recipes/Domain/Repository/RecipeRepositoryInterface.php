<?php

declare(strict_types=1);

namespace App\Recipes\Domain\Repository;

use App\Recipes\Domain\Entity\Recipe\Recipe;

interface RecipeRepositoryInterface
{
    /**
     * @return Recipe[]
     */
    public function findAll(): array;
}
