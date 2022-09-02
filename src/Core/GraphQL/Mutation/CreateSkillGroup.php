<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Mutation;

use App\Core\GraphQL\Skills\SkillGroup;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class CreateSkillGroup implements MutationInterface, AliasedInterface
{
    public function __invoke(string $name): array
    {
        return (new SkillGroup('qwe', 'qwe'))->toArray();
    }

    public static function getAliases(): array
    {
        return ['createSkillGroup' => '__invoke'];
    }
}
