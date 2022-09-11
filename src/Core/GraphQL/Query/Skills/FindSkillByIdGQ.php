<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Query\Skills;

use App\Core\GraphQL\Query\AliasedQuery;
use App\Core\GraphQL\Type\Skills\SkillGQ;
use App\Shared\Application\Query\QueryBusInterface;
use App\Skills\Application\DTO\SkillDTO;
use App\Skills\Application\Query\FindSkillById\FindSkillByIdQuery;
use Overblog\GraphQLBundle\Error\UserWarning;

class FindSkillByIdGQ extends AliasedQuery
{
    public function __construct(private QueryBusInterface $queryBus)
    {
    }

    /**
     * @return array<string, mixed>
     */
    public function __invoke(string $id): array
    {
        /** @var SkillDTO|null $skill */
        $skill = $this->queryBus->execute(new FindSkillByIdQuery($id));

        if (!$skill) {
            throw new UserWarning('Группа навыков не найдена');
        }

        return SkillGQ::fromDTO($skill)->toArray();
    }

    /**
     * {@inheritdoc}
     *
     * @retrun array<string, string>
     */
    public static function getAliases(): array
    {
        return ['__invoke' => 'findSkillGroupById'];
    }
}
