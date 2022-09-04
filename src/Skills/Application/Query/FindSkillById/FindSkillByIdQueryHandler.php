<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkillById;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Skills\Application\DTO\SkillDTO;
use App\Skills\Domain\Repository\SkillRepositoryInterface;

class FindSkillByIdQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly SkillRepositoryInterface $skillRepository)
    {
    }

    public function __invoke(FindSkillByIdQuery $query): ?SkillDTO
    {
        $skill = $this->skillRepository->findOneById($query->id);

        if (!$skill) {
            return null;
        }

        return SkillDTO::fromEntity($skill);
    }
}
