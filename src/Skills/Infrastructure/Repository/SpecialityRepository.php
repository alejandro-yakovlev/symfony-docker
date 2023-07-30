<?php

namespace App\Skills\Infrastructure\Repository;

use App\Shared\Domain\Repository\PaginationResult;
use App\Skills\Domain\Aggregate\Speciality\Speciality;
use App\Skills\Domain\Repository\SpecialityFilter;
use App\Skills\Domain\Repository\SpecialityRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

class SpecialityRepository extends ServiceEntityRepository implements SpecialityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Speciality::class);
    }

    public function add(Speciality $entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    public function findPagedItems(SpecialityFilter $filter): PaginationResult
    {
        $qb = $this->createQueryBuilder('s');

        if ($filter->name) {
            $qb->andWhere('s.name LIKE :name')
                ->setParameter('name', '%'.$filter->name.'%');
        }

        if ($filter->publicationStatuses) {
            $qb->andWhere('s.publicationStatus IN (:publicationStatuses)')
                ->setParameter('publicationStatuses', $filter->publicationStatuses);
        }

        if ($filter->ownerId) {
            $qb->andWhere('s.ownerId = :ownerId')
                ->setParameter('ownerId', $filter->ownerId);
        }

        if ($filter->pager) {
            $qb->setFirstResult($filter->pager->getOffset())
                ->setMaxResults($filter->pager->getLimit());
        }

        $paginator = new Paginator($qb->getQuery());

        return new PaginationResult(
            iterator_to_array($paginator->getIterator()),
            $paginator->count()
        );
    }

    public function findOne(SpecialityFilter $filter): ?Speciality
    {
        $qb = $this->createQueryBuilder('s');

        if ($filter->id) {
            $qb->andWhere('s.id = :id')
                ->setParameter('id', $filter->id);
        }

        if ($filter->name) {
            $qb->andWhere('s.name = :name')
                ->setParameter('name', $filter->name);
        }

        if ($filter->publicationStatuses) {
            $qb->andWhere('s.publicationStatus IN (:publicationStatuses)')
                ->setParameter('publicationStatuses', $filter->publicationStatuses);
        }

        if ($filter->ownerId) {
            $qb->andWhere('s.ownerId = :ownerId')
                ->setParameter('ownerId', $filter->ownerId);
        }

        $qb->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
