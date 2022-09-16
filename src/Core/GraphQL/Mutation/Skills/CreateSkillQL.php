<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Mutation\Skills;

use App\Core\GraphQL\Mutation\AliasedMutation;
use App\Core\GraphQL\Type\Skills\Skill\SkillGQ;
use App\Skills\Application\Command\CreateSkill\CreateSkillCommand;
use App\Skills\Application\Query\FindSkill\FindSkillQuery;
use App\Skills\Infrastructure\Api\Api;

class CreateSkillQL extends AliasedMutation
{
    public function __construct(
        private readonly Api $skillsApi
    ) {
    }

    public function __invoke(string $name, string $skillGroupId): array
    {
        $skillId = $this->skillsApi->commandInteractor->createSkill(new CreateSkillCommand($name, $skillGroupId));
        $skill = $this->skillsApi->queryInteractor->findSkill(new FindSkillQuery($skillId))->skill;

        return SkillGQ::fromDTO($skill)->toArray();
    }

    public static function getAliases(): array
    {
        return ['__invoke' => 'createSkill'];
    }
}
