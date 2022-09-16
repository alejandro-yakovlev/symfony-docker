<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Type\Skills;

use App\Core\GraphQL\Type\PaginationInputGQ;
use Overblog\GraphQLBundle\Annotation as GQL;

#[GQL\Input(name: 'SkillGroupsFilter')]
class SkillGroupsFilterGQ
{
    #[GQL\Field]
    public ?string $name;

    #[GQL\Field(type: 'PaginationInput')]
    public ?PaginationInputGQ $paginationInput;
}
