<?php

namespace App\Skills\Domain\Repository;

use App\Shared\Domain\Repository\PaginationResult;
use App\Skills\Domain\Aggregate\Skill\Skill;

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

    public function findByFilter(SkillsFilter $filter): PaginationResult;

    public function delete(Skill $skill): void;
}
