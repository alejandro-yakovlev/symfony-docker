<?php

declare(strict_types=1);

namespace App\Users\Application\Command\CreateUser;

use App\Auth\CQRSAuthorizer\Authorizer;

class CreateUserCommandAuthorizer extends Authorizer
{
    public function permitted($command): bool
    {
        return false;
    }
}
