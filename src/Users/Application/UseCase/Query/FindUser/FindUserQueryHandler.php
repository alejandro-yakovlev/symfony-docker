<?php

declare(strict_types=1);

namespace App\Users\Application\UseCase\Query\FindUser;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Users\Application\DTO\UserDTO;
use App\Users\Domain\Repository\UserRepositoryInterface;

readonly class FindUserQueryHandler implements QueryHandlerInterface
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function __invoke(FindUserQuery $query): FindUserQueryResult
    {
        $user = $this->userRepository->findById($query->userId);
        $userDTO = $user ? UserDTO::fromEntity($user) : null;

        return new FindUserQueryResult($userDTO);
    }
}
