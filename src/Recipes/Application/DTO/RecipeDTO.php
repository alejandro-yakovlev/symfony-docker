<?php

declare(strict_types=1);

namespace App\Recipes\Application\DTO;

use App\Recipes\Domain\Entity\Recipe\Recipe;

class RecipeDTO
{
    public ?string $id;
    public ?string $name;
    public ?string $authorId;
    public ?string $description;
    public ?int $yield;
    public ?bool $isPublished;
    public ?int $cookTime;
    public ?int $prepTime;
    public ?int $performTime;

    public static function fromEntity(Recipe $recipe): self
    {
        $dto = new self();
        $dto->id = $recipe->getId();
        $dto->name = $recipe->getName();
        $dto->authorId = $recipe->getAuthorId();
        $dto->description = $recipe->getDescription();
        $dto->yield = $recipe->getYield();
        $dto->isPublished = $recipe->isPublished();
        $dto->cookTime = $recipe->getCookTime();
        $dto->prepTime = $recipe->getPrepTime();
        $dto->performTime = $recipe->getPerformTime();

        return $dto;
    }
}
