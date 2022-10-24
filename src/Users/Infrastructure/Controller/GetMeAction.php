<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Controller;

use App\Auth\AuthUserFetcher\AuthUserFetcherInterface;
use App\Users\Application\Query\FindUser\FindUserQuery;
use App\Users\Application\QueryInteractor;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users/me', methods: ['GET'])]
class GetMeAction
{
    public function __construct(
        private readonly AuthUserFetcherInterface $userFetcher,
        private readonly QueryInteractor $queryInteractor,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $user = $this->userFetcher->getRequiredUser();
        $user = $this->queryInteractor->findUser(FindUserQuery::fromId($user->getId()))->user;

        if (!$user) {
            return new JsonResponse([
                'message' => 'Пользователь не найден',
            ], 404);
        }

        return new JsonResponse([
            'ulid' => $user->ulid,
            'email' => $user->email,
        ]);
    }
}
