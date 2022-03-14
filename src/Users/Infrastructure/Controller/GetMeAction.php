<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Controller;

use App\Shared\Damain\Security\UserFetcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users/me', methods: ['GET'])]
class GetMeAction
{
    public function __construct(private readonly UserFetcherInterface $userFetcher)
    {
    }

    public function __invoke()
    {
        $user = $this->userFetcher->getAuthUser();

        return new JsonResponse([
            'ulid' => $user->getUlid(),
            'email' => $user->getEmail(),
        ]);
    }
}