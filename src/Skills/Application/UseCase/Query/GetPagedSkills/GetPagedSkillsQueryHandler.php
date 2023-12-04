<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\GetPagedSkills;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Domain\Repository\Pager;
use App\Skills\Application\DTO\Skill\SkillDTOTransformer;
use App\Skills\Domain\Repository\SkillRepositoryInterface;
use App\Skills\Domain\Repository\SkillsFilter;

readonly class GetPagedSkillsQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private SkillRepositoryInterface $skillRepository,
        private SkillDTOTransformer $skillDTOHydrator
    ) {
    }

    public function __invoke(GetPagedSkillsQuery $query): GetPagedSkillsQueryResult
    {
        $filter = new SkillsFilter($query->pager);
        $paginator = $this->skillRepository->findByFilter($filter);
        $pager = new Pager($query->pager->page, $query->pager->perPage, $paginator->total);

        $skills = $this->skillDTOHydrator->fromSkillEntityList($paginator->items);

        return new GetPagedSkillsQueryResult($skills, $pager);
    }
}
