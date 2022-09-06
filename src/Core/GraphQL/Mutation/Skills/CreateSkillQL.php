<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Mutation\Skills;

use App\Core\GraphQL\Type\Skills\SkillGQ;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Skills\Application\Command\CreateSkill\CreateSkillCommand;
use App\Skills\Application\DTO\SkillDTO;
use App\Skills\Application\Query\FindSkillById\FindSkillByIdQuery;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class CreateSkillQL implements MutationInterface, AliasedInterface
{
    public function __construct(private QueryBusInterface $queryBus, private CommandBusInterface $commandBus)
    {
    }

    public function __invoke(string $name, string $skillGroupId): array
    {
        $skillId = $this->commandBus->execute(new CreateSkillCommand($name, $skillGroupId));
        /** @var SkillDTO $skill */
        $skill = $this->queryBus->execute(new FindSkillByIdQuery($skillId));

        return SkillGQ::fromDTO($skill)->toArray();
    }

    public static function getAliases(): array
    {
        return ['__invoke' => 'createSkill'];
    }
}
