<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Query\Skills;

use App\Core\GraphQL\Query\AliasedQuery;
use App\Core\GraphQL\Type\Skills\SkillGroupGQ;
use App\Core\GraphQL\Type\Skills\SkillGroupsFilterGQ;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Domain\Repository\PaginationInput;
use App\Skills\Application\DTO\SkillGroupDTO;
use App\Skills\Application\Query\FindSkillGroups\FindSkillGroupsQuery;
use App\Skills\Domain\Repository\SkillGroupsFilter;
use GraphQL\Type\Definition\ResolveInfo;

class PaginateSkillGroupsGQ extends AliasedQuery
{
    public function __construct(private QueryBusInterface $queryBus)
    {
    }

    public function __invoke(SkillGroupsFilterGQ $filter, ResolveInfo $info): array
    {
        $query = new FindSkillGroupsQuery(
            new SkillGroupsFilter(
                paginationInput: PaginationInput::fromPage(
                    $filter->paginationInput->page,
                    $filter->paginationInput->page
                )
            )
        );

        /** @var SkillGroupDTO[] $skillGroups */
        $skillGroups = $this->queryBus->execute($query);

        return SkillGroupGQ::fromDTOCollection($skillGroups);
    }

    public static function getAliases(): array
    {
        return ['__invoke' => 'paginateSkillGroups'];
    }
}
