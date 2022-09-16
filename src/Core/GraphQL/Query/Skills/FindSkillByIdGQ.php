<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Query\Skills;

use App\Core\GraphQL\Query\AliasedQuery;
use App\Core\GraphQL\Type\Skills\Skill\SkillGQ;
use App\Skills\Application\Query\FindSkill\FindSkillQuery;
use App\Skills\Infrastructure\Api\Api;
use Overblog\GraphQLBundle\Error\UserWarning;

class FindSkillByIdGQ extends AliasedQuery
{
    public function __construct(
        private readonly Api $skillsApi
    ) {
    }

    public function __invoke(string $id): SkillGQ
    {
        $skill = $this->skillsApi->queryInteractor->findSkill(new FindSkillQuery($id))->skill;

        if (!$skill) {
            throw new UserWarning('Навык не найден');
        }

        return SkillGQ::fromDTO($skill);
    }

    /**
     * {@inheritdoc}
     *
     * @retrun array<string, string>
     */
    public static function getAliases(): array
    {
        return ['__invoke' => 'findSkillById'];
    }
}
