<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkillGroup;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Skills\Application\DTO\SkillGroupDTO;
use App\Skills\Domain\Repository\SkillGroupRepositoryInterface;

class FindSkillGroupQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly SkillGroupRepositoryInterface $skillGroupRepository)
    {
    }

    public function __invoke(FindSkillGroupQuery $query): FindSkillGroupQueryResult
    {
        $skillGroup = $this->skillGroupRepository->findOneById($query->id);

        if (!$skillGroup) {
            return new FindSkillGroupQueryResult(null);
        }

        return new FindSkillGroupQueryResult(SkillGroupDTO::fromEntity($skillGroup));
    }
}
