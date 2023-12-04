<?php

namespace App\Skills\Infrastructure\Repository;

use App\Skills\Domain\Aggregate\SkillConfirmation\SkillConfirmation;
use App\Skills\Domain\Repository\SkillConfirmationRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SkillConfirmationRepository extends ServiceEntityRepository implements SkillConfirmationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SkillConfirmation::class);
    }

    public function findOneBySpecialist(string $skillId, string $specialistId): ?SkillConfirmation
    {
        return $this->findOneBy(['skill' => $skillId, 'specialist' => $specialistId]);
    }

    public function add(SkillConfirmation $skillConfirmation): void
    {
        $this->_em->persist($skillConfirmation);
        $this->_em->flush();
    }
}
