<?php

namespace App\Skills\Infrastructure\Repository;

use App\Shared\Domain\Entity\ValueObject\UserUlid;
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

    public function findOneByUserId(UserUlid $userId): ?Specialist
    {
        return $this->findOneBy(['userId' => $userId]);
    }

    public function add(Specialist $specialist): void
    {
        $this->_em->persist($specialist);
        $this->_em->flush();
    }
}
