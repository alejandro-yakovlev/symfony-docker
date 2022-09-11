<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Mutation;

use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

abstract class AliasedMutation implements MutationInterface, AliasedInterface
{
    /**
     * {@inheritdoc}
     *
     * @retrun array<string, string>
     */
    abstract public static function getAliases(): array;
}
