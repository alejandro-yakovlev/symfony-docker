<?php

namespace App\Skills\Infrastructure\Repository;

use App\Skills\Domain\Entity\Skill\SkillGroup;
use App\Skills\Domain\Repository\SkillGroupRepositoryInterface;
use App\Skills\Domain\Repository\SkillGroupsFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SkillGroupRepository extends ServiceEntityRepository implements SkillGroupRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SkillGroup::class);
    }

    public function findOneByName(string $name): ?SkillGroup
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function add(SkillGroup $entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    public function findOneById(string $id): ?SkillGroup
    {
        return $this->find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function findByFilter(SkillGroupsFilter $filter): array
    {
        $qb = $this->createQueryBuilder('sg');

        if ($filter->name) {
            $qb->where($qb->expr()->like('sg.name', ':name'))
                ->setParameter('name', '%'.$filter->name.'%');
        }

        if ($filter->paginationInput) {
            $qb->setMaxResults($filter->paginationInput->getLimit());
            $qb->setFirstResult($filter->paginationInput->getOffset());
        }

        return $qb->getQuery()->getResult();
    }
}
