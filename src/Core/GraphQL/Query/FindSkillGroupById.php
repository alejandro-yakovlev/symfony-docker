<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Query;

use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

class FindSkillGroupById implements QueryInterface, AliasedInterface
{
    public function findSkillGroupById(string $id): array
    {
        return [
            'id' => '123',
            'name' => 'dsf',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return ['findSkillGroupById' => 'findSkillGroupById'];
    }
}
