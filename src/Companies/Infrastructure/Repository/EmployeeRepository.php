<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Repository;

use App\Companies\Domain\Entity\Employee\Employee;
use App\Companies\Domain\Repository\EmployeeRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EmployeeRepository extends ServiceEntityRepository implements EmployeeRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employee::class);
    }

    public function add(Employee $entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    public function findById(string $id): ?Employee
    {
        return $this->find($id);
    }
}
