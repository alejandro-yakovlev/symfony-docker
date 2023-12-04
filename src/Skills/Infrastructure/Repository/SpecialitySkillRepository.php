<?php

declare(strict_types=1);

namespace App\Skills\Infrastructure\Repository;

use App\Skills\Domain\Aggregate\Speciality\SpecialitySkill;
use App\Skills\Domain\Repository\SpecialitySkillRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SpecialitySkillRepository extends ServiceEntityRepository implements SpecialitySkillRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpecialitySkill::class);
    }

    public function add(SpecialitySkill $entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    public function remove(SpecialitySkill $entity): void
    {
        $this->_em->remove($entity);
        $this->_em->flush();
    }

    public function findAllBySpecialityId(string $specialityId): array
    {
        return $this->findBy(['speciality' => $specialityId]);
    }

    public function findOne(string $id): ?SpecialitySkill
    {
        return $this->find($id);
    }

    public function findOneBySpecialityAndSkill(string $specialityId, string $skillId): ?SpecialitySkill
    {
        return $this->findOneBy(['speciality' => $specialityId, 'skill' => $skillId]);
    }
}
