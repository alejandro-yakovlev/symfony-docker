<?php

namespace App\Skills\Infrastructure\Repository;

use App\Skills\Domain\Aggregate\Specialist\Specialist;
use App\Skills\Domain\Repository\SpecialistRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SpecialistRepository extends ServiceEntityRepository implements SpecialistRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Specialist::class);
    }

    public function findOneByUser(string $userId): ?Specialist
    {
        return $this->findOneBy(['userId' => $userId]);
    }

    public function add(Specialist $specialist): void
    {
        $this->_em->persist($specialist);
        $this->_em->flush();
    }
}
