<?php

namespace App\Testing\Infrastructure\Repository;

use App\Testing\Domain\Entity\TestingSession\TestingSession;
use App\Testing\Domain\Repository\TestingSessionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TestingSessionRepository extends ServiceEntityRepository implements TestingSessionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestingSession::class);
    }

    public function findById(string $id): ?TestingSession
    {
        return $this->find($id);
    }
}
