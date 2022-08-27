<?php

namespace App\Skills\Domain\Repository;

use App\Skills\Domain\Entity\Skill\SkillGroup;

interface SkillGroupRepositoryInterface
{
    public function add(SkillGroup $entity): void;

    public function findByName(string $name): ?SkillGroup;
}
