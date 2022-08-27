<?php

namespace App\Skills\Domain\Repository;

use App\Skills\Domain\Entity\Skill\Skill;

interface SkillRepositoryInterface
{
    public function add(Skill $skill): void;

    /**
     * @return Skill[]
     */
    public function findByName(string $name): array;

    public function findById(string $skillId): ?Skill;
}
