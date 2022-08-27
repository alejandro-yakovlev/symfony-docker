<?php

namespace App\Skills\Infrastructure\Repository;

use App\Skills\Domain\Entity\Skill\SkillGroup;
use App\Skills\Domain\Repository\SkillGroupRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SkillGroupRepository extends ServiceEntityRepository implements SkillGroupRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SkillGroup::class);
    }

    public function findByName(string $name): ?SkillGroup
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function add(SkillGroup $entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }
}
