<?php

declare(strict_types=1);

namespace App\Companies\Domain\Repository;

use App\Companies\Domain\Entity\Company\Company;
use App\Shared\Domain\Repository\PaginationResult;

interface CompanyRepositoryInterface
{
    public function add(Company $entity): void;

    public function findById(string $id): ?Company;

    /**
     * @return Company[]
     */
    public function findByOwner(string $ownerId): array;

    public function findByFilter(CompanyFilter $filter): PaginationResult;
}
