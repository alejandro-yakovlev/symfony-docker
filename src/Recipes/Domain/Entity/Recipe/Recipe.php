<?php

declare(strict_types=1);

namespace App\Recipes\Domain\Entity\Recipe;

use App\Shared\Domain\Service\UlidService;

class Recipe
{
    private string $id;
    private string $name;
    private string $authorId;
    private string $description = '';
    private int $yield = 0;
    private bool $isPublished = false;
    private int $cookTime = 0;
    private int $prepTime = 0;
    private int $performTime = 0;

    public function __construct(string $authorId, string $name)
    {
        $this->id = UlidService::generate();
        $this->authorId = $authorId;
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAuthorId(): string
    {
        return $this->authorId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getYield(): int
    {
        return $this->yield;
    }

    public function isPublished(): bool
    {
        return $this->isPublished;
    }

    public function getCookTime(): int
    {
        return $this->cookTime;
    }

    public function getPrepTime(): int
    {
        return $this->prepTime;
    }

    public function getPerformTime(): int
    {
        return $this->performTime;
    }
}
