<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Repository;

use App\Companies\Domain\Entity\Employee\Invite;
use App\Companies\Domain\Repository\InviteRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class InviteRepository extends ServiceEntityRepository implements InviteRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invite::class);
    }

    public function add(Invite $entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    public function findOneByEmployee(string $employeeId): ?Invite
    {
        return $this->findOneBy(['employee' => $employeeId]);
    }
}
