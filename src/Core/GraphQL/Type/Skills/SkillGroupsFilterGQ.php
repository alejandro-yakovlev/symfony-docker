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

//    public static function fromArray(array $data): self
//    {
//        $obj = new self();
//
//        $obj->name = $data['name'] ?? null;
//        $obj->paginationInput = $data['name'] ?? null;
//    }
}
