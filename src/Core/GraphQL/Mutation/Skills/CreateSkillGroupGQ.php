<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Mutation\Skills;

use App\Core\GraphQL\Mutation\AliasedMutation;
use App\Core\GraphQL\Type\Skills\SkillGroupGQ;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Skills\Application\Command\CreateSkillGroup\CreateSkillGroupCommand;
use App\Skills\Application\DTO\SkillGroupDTO;
use App\Skills\Application\Query\FindSkillGroupById\FindSkillGroupByIdQuery;

class CreateSkillGroupGQ extends AliasedMutation
{
    public function __construct(private QueryBusInterface $queryBus, private CommandBusInterface $commandBus)
    {
    }

    public function __invoke(string $name): array
    {
        $skillGroupId = $this->commandBus->execute(new CreateSkillGroupCommand($name));
        /** @var SkillGroupDTO $skillGroup */
        $skillGroup = $this->queryBus->execute(new FindSkillGroupByIdQuery($skillGroupId));

        return SkillGroupGQ::fromDTO($skillGroup)->toArray();
    }

    public static function getAliases(): array
    {
        return ['__invoke' => 'createSkillGroup'];
    }
}
