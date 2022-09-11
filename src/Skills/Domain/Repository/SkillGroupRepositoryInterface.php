<?php

namespace App\Skills\Domain\Repository;

use App\Skills\Domain\Entity\Skill\SkillGroup;

interface SkillGroupRepositoryInterface
{
    public function add(SkillGroup $entity): void;

    public function findOneByName(string $name): ?SkillGroup;

    /**
     * @return SkillGroup[]
     */
    public function findByFilter(SkillGroupsFilter $filter): array;

    public function findOneById(string $id): ?SkillGroup;
}
