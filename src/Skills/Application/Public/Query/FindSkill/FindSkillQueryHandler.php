<?php

declare(strict_types=1);

namespace App\Skills\Application\Public\Query\FindSkill;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Skills\Application\Shared\DTO\Skill\SkillDTOTransformer;
use App\Skills\Domain\Repository\SkillRepositoryInterface;

class FindSkillQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly SkillRepositoryInterface $skillRepository,
        private readonly SkillDTOTransformer $skillDTOHydrator
    ) {
    }

    public function __invoke(FindSkillQuery $query): FindSkillQueryResult
    {
        $skill = $this->skillRepository->findOneById($query->id);

        if (!$skill) {
            return new FindSkillQueryResult(null);
        }

        $dto = $this->skillDTOHydrator->fromSkillEntity($skill);

        return new FindSkillQueryResult($dto);
    }
}
