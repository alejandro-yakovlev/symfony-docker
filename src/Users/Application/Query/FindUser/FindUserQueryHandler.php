<?php

declare(strict_types=1);

namespace App\Users\Application\Query\FindUser;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Users\Application\DTO\UserDTO;
use App\Users\Domain\Repository\UserRepositoryInterface;

class FindUserQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function __invoke(FindUserQuery $query): FindUserQueryResult
    {
        $user = null;
        if ($query->id) {
            $user = $this->userRepository->findOneById($query->id);
        }

        return new FindUserQueryResult($user ? UserDTO::fromEntity($user) : null);
    }
}
