<?php

namespace App\Skills\Infrastructure\Repository;

use App\Skills\Domain\Entity\Skill\Skill;
use App\Skills\Domain\Repository\SkillRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SkillRepository extends ServiceEntityRepository implements SkillRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Skill::class);
    }

    public function add(Skill $skill): void
    {
        $this->getEntityManager()->persist($skill);
        $this->getEntityManager()->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function findByName(string $name): array
    {
        return $this->findBy(['name' => $name]);
    }

    public function findById(string $skillId): ?Skill
    {
        return $this->find($skillId);
    }
}
