<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Query\Skills;

use App\Core\GraphQL\Query\AliasedQuery;
use App\Core\GraphQL\Type\Skills\SkillGroup\SkillGroupGQ;
use App\Skills\Application\Query\FindSkillGroup\FindSkillGroupQuery;
use App\Skills\Infrastructure\Api\Api;
use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Error\UserWarning;

class FindSkillGroupByIdGQ extends AliasedQuery
{
    public function __construct(
        private readonly Api $skillsApi
    ) {
    }

    public function __invoke(ResolveInfo $info, string $id): SkillGroupGQ
    {
        $skillGroup = $this->skillsApi->queryInteractor->findSkillGroup(new FindSkillGroupQuery($id))->skillGroup;

        if (!$skillGroup) {
            throw new UserWarning('Группа навыков не найдена');
        }

        return SkillGroupGQ::fromDTO($skillGroup);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return ['__invoke' => 'findSkillGroupById'];
    }
}
