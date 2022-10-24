<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkill;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Skills\Application\DTO\SkillDTO;
use App\Skills\Domain\Repository\SkillRepositoryInterface;

class FindSkillQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly SkillRepositoryInterface $skillRepository)
    {
    }

    public function __invoke(FindSkillQuery $query): FindSkillQueryResult
    {
        $skill = $this->skillRepository->findOneById($query->id);

        if (!$skill) {
            return new FindSkillQueryResult(null);
        }

        return new FindSkillQueryResult(SkillDTO::fromEntity($skill));
    }
}
