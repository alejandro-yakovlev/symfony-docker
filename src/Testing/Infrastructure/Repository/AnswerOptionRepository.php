<?php

declare(strict_types=1);

namespace App\Testing\Infrastructure\Repository;

use App\Testing\Domain\Entity\Test\AnswerOption;
use App\Testing\Domain\Repository\AnswerOptionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AnswerOptionRepository extends ServiceEntityRepository implements AnswerOptionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnswerOption::class);
    }

    public function findOneById(string $answerOptionId): ?AnswerOption
    {
        return $this->find($answerOptionId);
    }
}
