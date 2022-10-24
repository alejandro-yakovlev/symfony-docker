<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkillGroups;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Skills\Application\DTO\SkillGroupDTO;
use App\Skills\Domain\Entity\Skill\SkillGroup;
use App\Skills\Domain\Repository\SkillGroupRepositoryInterface;

class FindSkillGroupsQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly SkillGroupRepositoryInterface $skillGroupRepository
    ) {
    }

    public function __invoke(FindSkillGroupsQuery $query): FindSkillGroupsQueryResult
    {
        $skillGroups = $this->skillGroupRepository->findByFilter($query->input);

        return new FindSkillGroupsQueryResult(
            array_map(fn (SkillGroup $dto) => SkillGroupDTO::fromEntity($dto), $skillGroups)
        );
    }
}
