<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Type;

use Overblog\GraphQLBundle\Annotation as GQL;

#[GQL\Input(name: 'PaginationInput')]
class PaginationInputGQ
{
    #[GQL\Field]
    public int $page;

    #[GQL\Field]
    public int $perPage;
}
