<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateTest;

use App\Auth\CQRSAuthorizer\Authorizer;

class CreateTestCommandAuthorizer extends Authorizer
{
    public function permitted($command): bool
    {
        return false;
    }
}
