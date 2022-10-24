<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Repository;

use App\Companies\Domain\Entity\Company\Company;
use App\Companies\Domain\Repository\CompanyFilter;
use App\Companies\Domain\Repository\CompanyRepositoryInterface;
use App\Shared\Domain\Repository\PaginationResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

class CompanyRepository extends ServiceEntityRepository implements CompanyRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    public function add(Company $entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    public function findById(string $id): ?Company
    {
        return $this->find($id);
    }

    public function findByOwner(string $ownerId): array
    {
        return $this->findBy(['owner.id' => $ownerId]);
    }

    public function findByFilter(CompanyFilter $filter): PaginationResult
    {
        $qb = $this->createQueryBuilder('c');

        if ($filter->name) {
            $qb->where($qb->expr()->like('c.name', ':name'))
                ->setParameter('name', '%'.$filter->name.'%');
        }

        if ($filter->pager) {
            $qb->setMaxResults($filter->pager->getLimit());
            $qb->setFirstResult($filter->pager->getOffset());
        }

        $paginator = new Paginator($qb->getQuery());

        return new PaginationResult(iterator_to_array($paginator->getIterator()), $paginator->count());
    }
}
