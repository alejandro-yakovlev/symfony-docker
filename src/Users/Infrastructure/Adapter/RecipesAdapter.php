<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Adapter;

use App\Recipes\Application\DTO\RecipeDTO;
use App\Recipes\Application\Query\GetRecipesQuery\GetRecipesQuery;
use App\Shared\Application\Query\QueryBusInterface;

class RecipesAdapter
{
    public function __construct(private readonly QueryBusInterface $queryBus)
    {
    }

    /**
     * @return RecipeDTO[]
     */
    public function getRecipes(): array
    {
        return $this->queryBus->execute(new GetRecipesQuery());
    }
}
