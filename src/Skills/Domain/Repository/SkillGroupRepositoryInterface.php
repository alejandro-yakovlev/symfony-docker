<?php

namespace App\Skills\Domain\Repository;

use App\Shared\Domain\Repository\PaginationResult;
use App\Skills\Domain\Aggregate\Skill\SkillGroup;

interface SkillGroupRepositoryInterface
{
    public function add(SkillGroup $entity): void;

    public function findOneByName(string $name): ?SkillGroup;

    public function findByFilter(SkillGroupsFilter $filter): PaginationResult;

    public function findOneById(string $id): ?SkillGroup;
}
