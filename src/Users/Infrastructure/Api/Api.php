<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Api;

use App\Auth\UserInterface;
use App\Users\Domain\Repository\UserRepositoryInterface;

class Api
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function findUser(string $id): ?UserInterface
    {
        return $this->userRepository->findOneById($id);
    }
}
