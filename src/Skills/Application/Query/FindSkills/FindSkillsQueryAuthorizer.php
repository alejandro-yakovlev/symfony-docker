<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkills;

use App\Auth\CQRSAuthorizer\Authorizer;

class FindSkillsQueryAuthorizer extends Authorizer
{
    public function permitted($command): bool
    {
        return false;
    }
}
