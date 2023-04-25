<?php

namespace App\Skills\Infrastructure\Repository;

use App\Skills\Domain\Entity\Specialist\Specialist;
use App\Skills\Domain\Repository\SpecialistRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SpecialistRepository extends ServiceEntityRepository implements SpecialistRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Specialist::class);
    }

    public function findByGlobalUserId(string $globalUserId): ?Specialist
    {
        return $this->findOneBy(['globalUserId' => $globalUserId]);
    }

    public function add(Specialist $specialist): void
    {
        $this->getEntityManager()->persist($specialist);
        $this->getEntityManager()->flush();
    }
}
