<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Resolver;

use App\Core\GraphQL\Query\AliasedQuery;
use App\Core\GraphQL\Type\Skills\SkillGroup\SkillGroupGQ;

class SkillsResolverGQ extends AliasedQuery
{
    public function __invoke(int $limit, $info, $context, SkillGroupGQ $value): array
    {
        return array_slice($value->skills, 0, $limit);
    }

    public static function getAliases(): array
    {
        return ['__invoke' => 'skillsResolver'];
    }
}
