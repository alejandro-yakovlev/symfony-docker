<?php

declare(strict_types=1);

namespace App\Skills\Domain\Repository;

use App\Skills\Domain\Aggregate\Speciality\SpecialitySkill;

interface SpecialitySkillRepositoryInterface
{
    public function add(SpecialitySkill $entity): void;

    public function remove(SpecialitySkill $entity): void;

    /**
     * @return array<SpecialitySkill>
     */
    public function findAllBySpecialityId(string $specialityId): array;

    public function findOne(string $id): ?SpecialitySkill;

    public function findOneBySpecialityAndSkill(string $specialityId, string $skillId): ?SpecialitySkill;
}
