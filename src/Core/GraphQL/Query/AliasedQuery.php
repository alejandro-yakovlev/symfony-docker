<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Query;

use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;

abstract class AliasedQuery implements QueryInterface, AliasedInterface
{
}
