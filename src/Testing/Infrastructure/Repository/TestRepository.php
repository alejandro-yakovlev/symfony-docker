<?php

declare(strict_types=1);

namespace App\Testing\Infrastructure\Repository;

use App\Testing\Domain\Entity\Test\Test;
use App\Testing\Domain\Repository\TestRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TestRepository extends ServiceEntityRepository implements TestRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Test::class);
    }

    public function add(Test $entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    public function findOneById(string $id): ?Test
    {
        return $this->find($id);
    }

    /**
     * @return Test[]
     */
    public function findBySkill(string $skillId): array
    {
        return $this->findBy(['skillId' => $skillId]);
    }

    public function findByName(string $name): array
    {
        return $this->findBy(['name' => $name]);
    }
}
