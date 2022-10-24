<?php

declare(strict_types=1);

namespace App\Testing\Domain\Repository;

use App\Testing\Domain\Entity\Test\Test;

interface TestRepositoryInterface
{
    public function add(Test $entity): void;

    public function findOneById(string $id): ?Test;

    /**
     * @return Test[]
     */
    public function findBySkill(string $skillId): array;

    /**
     * @return Test[]
     */
    public function findByName(string $name): array;
}
