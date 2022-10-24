<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkillGroup;

use App\Auth\CQRSAuthorizer\Authorizer;

class FindSkillGroupQueryAuthorizer extends Authorizer
{
    public function permitted($command): bool
    {
        return false;
    }
}
