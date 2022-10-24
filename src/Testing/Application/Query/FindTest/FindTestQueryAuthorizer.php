<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindTest;

use App\Auth\CQRSAuthorizer\Authorizer;

class FindTestQueryAuthorizer extends Authorizer
{
    public function permitted($command): bool
    {
        return false;
    }
}
