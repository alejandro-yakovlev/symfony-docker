<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkillGroups;

use App\Auth\CQRSAuthorizer\Authorizer;

class FindSkillGroupsQueryAuthorizer extends Authorizer
{
    public function permitted($command): bool
    {
        return false;
    }
}
