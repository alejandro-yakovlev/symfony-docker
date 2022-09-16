<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Query\Skills;

use App\Core\GraphQL\Query\AliasedQuery;
use App\Core\GraphQL\Type\Skills\SkillGroup\SkillGroupGQ;
use App\Core\GraphQL\Type\Skills\SkillGroupsFilterGQ;
use App\Shared\Domain\Repository\PaginationInput;
use App\Skills\Application\Query\FindSkillGroups\FindSkillGroupsQuery;
use App\Skills\Domain\Repository\SkillGroupsFilter;
use App\Skills\Infrastructure\Api\Api;
use GraphQL\Type\Definition\ResolveInfo;

class PaginateSkillGroupsGQ extends AliasedQuery
{
    public function __construct(
        private readonly Api $skillsApi
    ) {
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

        $result = $this->skillsApi->queryInteractor->findSkillGroups($query);

        return SkillGroupGQ::fromDTOCollection($result->skillGroups);
    }

    public static function getAliases(): array
    {
        return ['__invoke' => 'paginateSkillGroups'];
    }
}
