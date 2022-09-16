<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Mutation\Skills;

use App\Core\GraphQL\Mutation\AliasedMutation;
use App\Core\GraphQL\Type\Skills\SkillGroup\SkillGroupGQ;
use App\Skills\Application\Command\CreateSkillGroup\CreateSkillGroupCommand;
use App\Skills\Application\Query\FindSkillGroup\FindSkillGroupQuery;
use App\Skills\Infrastructure\Api\Api;

class CreateSkillGroupGQ extends AliasedMutation
{
    public function __construct(
        private readonly Api $skillsApi
    ) {
    }

    public function __invoke(string $name): SkillGroupGQ
    {
        $skillGroupId = $this->skillsApi->commandInteractor->createSkillGroup(new CreateSkillGroupCommand($name));
        $skillGroup = $this->skillsApi->queryInteractor->findSkillGroup(
            new FindSkillGroupQuery($skillGroupId)
        )->skillGroup;

        return SkillGroupGQ::fromDTO($skillGroup);
    }

    public static function getAliases(): array
    {
        return ['__invoke' => 'createSkillGroup'];
    }
}
