<?php

namespace App\Skills\Infrastructure\Repository;

use App\Skills\Domain\Entity\Speciality\Speciality;
use App\Skills\Domain\Repository\SpecialityRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SpecialityRepository extends ServiceEntityRepository implements SpecialityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Speciality::class);
    }

    public function findOneByName(string $name): ?Speciality
    {
        return $this->findOneBy(['name' => $name]);
    }
}
