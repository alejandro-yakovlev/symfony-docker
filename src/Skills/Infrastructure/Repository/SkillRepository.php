<?php

namespace App\Skills\Infrastructure\Repository;

use App\Skills\Domain\Entity\Skill\Skill;
use App\Skills\Domain\Repository\SkillRepositoryInterface;

class SkillRepository implements SkillRepositoryInterface
{
    public function add(Skill $skill): void
    {
        // TODO: Implement add() method.
    }

    /**
     * {@inheritDoc}
     */
    public function findByName(string $name): array
    {
        // TODO: Implement findByName() method.
    }

    public function findById(string $skillId): ?Skill
    {
        // TODO: Implement findById() method.
    }
}
