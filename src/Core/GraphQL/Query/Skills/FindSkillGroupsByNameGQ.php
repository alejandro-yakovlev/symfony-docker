<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Query\Skills;

use App\Core\GraphQL\Type\Skills\SkillGroupGQ;
use App\Shared\Application\Query\QueryBusInterface;
use App\Skills\Application\DTO\SkillGroupDTO;
use App\Skills\Application\Query\FindSkillGroups\FindSkillGroupsQuery;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

class FindSkillGroupsByNameGQ implements QueryInterface, AliasedInterface
{
    public function __construct(private QueryBusInterface $queryBus)
    {
    }

    public function findSkillGroupsByName(string $name): array
    {
        /** @var SkillGroupDTO[] $skillGroups */
        $skillGroups = $this->queryBus->execute(new FindSkillGroupsQuery($name));

        return SkillGroupGQ::fromDTOCollection($skillGroups);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return ['findSkillGroupsByName' => 'findSkillGroupsByName'];
    }
}
