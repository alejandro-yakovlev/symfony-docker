<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Query\Skills;

use App\Core\GraphQL\Query\AliasedQuery;
use App\Core\GraphQL\Type\Skills\SkillGroupGQ;
use App\Shared\Application\Query\QueryBusInterface;
use App\Skills\Application\DTO\SkillGroupDTO;
use App\Skills\Application\Query\FindSkillGroupById\FindSkillGroupByIdQuery;
use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Error\UserWarning;

class FindSkillGroupByIdGQ extends AliasedQuery
{
    public function __construct(private QueryBusInterface $queryBus)
    {
    }

    public function __invoke(ResolveInfo $info, string $id): array
    {
        /** @var SkillGroupDTO|null $skillGroup */
        $skillGroup = $this->queryBus->execute(new FindSkillGroupByIdQuery($id));

        if (!$skillGroup) {
            throw new UserWarning('Группа навыков не найдена');
        }

        return SkillGroupGQ::fromDTO($skillGroup)->toArray();
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return ['__invoke' => 'findSkillGroupById'];
    }
}
