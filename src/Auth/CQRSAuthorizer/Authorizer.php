<?php

declare(strict_types=1);

namespace App\Auth\CQRSAuthorizer;

abstract class Authorizer
{
    /**
     * @throws NotPermittedException
     */
    public function authorize($command): void
    {
        $this->permitted($command) || throw new NotPermittedException('Запрещено');
    }

    abstract protected function permitted($command): bool;
}
