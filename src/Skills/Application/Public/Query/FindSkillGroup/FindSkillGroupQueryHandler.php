<?php

declare(strict_types=1);

namespace App\Skills\Application\Public\Query\FindSkillGroup;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Skills\Application\Shared\DTO\SkillGroup\SkillGroupDTOTransformer;
use App\Skills\Domain\Repository\SkillGroupRepositoryInterface;

readonly class FindSkillGroupQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private SkillGroupRepositoryInterface $skillGroupRepository,
        private SkillGroupDTOTransformer $skillGroupDTOHydrator
    ) {
    }

    public function __invoke(FindSkillGroupQuery $query): FindSkillGroupQueryResult
    {
        $skillGroup = $this->skillGroupRepository->findOneById($query->id);

        if (!$skillGroup) {
            return new FindSkillGroupQueryResult(null);
        }

        return new FindSkillGroupQueryResult(
            $this->skillGroupDTOHydrator->fromEntity($skillGroup)
        );
    }
}
