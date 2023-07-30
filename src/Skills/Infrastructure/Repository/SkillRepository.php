<?php

namespace App\Skills\Infrastructure\Repository;

use App\Shared\Domain\Repository\PaginationResult;
use App\Skills\Domain\Aggregate\Skill\Skill;
use App\Skills\Domain\Repository\SkillRepositoryInterface;
use App\Skills\Domain\Repository\SkillsFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

class SkillRepository extends ServiceEntityRepository implements SkillRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Skill::class);
    }

    public function add(Skill $entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    public function findByName(string $name): array
    {
        return $this->findBy(['name' => $name]);
    }

    public function findOneById(string $skillId): ?Skill
    {
        return $this->find($skillId);
    }

    public function findByIds(array $ids): array
    {
        return $this->findBy(['id' => $ids]);
    }

    public function findByFilter(SkillsFilter $filter): PaginationResult
    {
        $qb = $this->createQueryBuilder('s');

        if ($filter->name) {
            $qb->where($qb->expr()->like('s.name', ':name'))
                ->setParameter('name', '%'.$filter->name.'%');
        }

        if ($filter->pager) {
            $qb->setMaxResults($filter->pager->getLimit());
            $qb->setFirstResult($filter->pager->getOffset());
        }

        $paginator = new Paginator($qb->getQuery());

        return new PaginationResult(
            iterator_to_array($paginator->getIterator()),
            $paginator->count()
        );
    }

    public function delete(Skill $skill): void
    {
        $this->_em->remove($skill);
        $this->_em->flush();
    }
}
