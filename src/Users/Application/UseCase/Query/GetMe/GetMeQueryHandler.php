<?php

declare(strict_types=1);

namespace App\Users\Application\UseCase\Query\GetMe;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Users\Application\DTO\UserDTO;
use App\Users\Domain\Repository\UserRepositoryInterface;

readonly class GetMeQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserFetcherInterface $userFetcher
    ) {
    }

    public function __invoke(GetMeQuery $query): GetMeQueryResult
    {
        $user = $this->userRepository->findById($this->userFetcher->requiredUser()->getId());
        $userDTO = $user ? UserDTO::fromEntity($user) : null;

        return new GetMeQueryResult($userDTO);
    }
}
