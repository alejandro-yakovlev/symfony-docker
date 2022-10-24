<?php

namespace App\Skills\Domain\Repository;

use App\Skills\Domain\Entity\Skill\Skill;

interface SkillRepositoryInterface
{
    public function add(Skill $entity): void;

    /**
     * @return Skill[]
     */
    public function findByName(string $name): array;

    /**
     * @return Skill[]
     */
    public function findByIds(array $ids): array;

    public function findOneById(string $skillId): ?Skill;
}
