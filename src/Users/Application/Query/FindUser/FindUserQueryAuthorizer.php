<?php

declare(strict_types=1);

namespace App\Users\Application\Query\FindUser;

use App\Auth\CQRSAuthorizer\Authorizer;

class FindUserQueryAuthorizer extends Authorizer
{
    public function permitted($command): bool
    {
        return false;
    }
}
