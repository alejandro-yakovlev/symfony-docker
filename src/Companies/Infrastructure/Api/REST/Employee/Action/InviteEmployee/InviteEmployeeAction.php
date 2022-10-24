<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Api\REST\Employee\Action\InviteEmployee;

use App\Companies\Application\Command\CommandInteractor;
use App\Companies\Application\Command\InviteEmployee\InviteEmployeeCommand;
use App\Core\Api\REST\ResponseHelper;
use InvalidArgumentException;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/invites', methods: ['POST'])]
#[OA\Response(
    response: 204,
    description: 'Отправлено приглашение'
)]
#[OA\RequestBody(content: new OA\JsonContent(
    ref: new Model(
        type: InviteEmployeeRequest::class,
        groups: ['default'],
    )
))]
#[Security(name: 'Bearer')]
#[OA\Tag(name: 'Companies')]
#[AsController]
class InviteEmployeeAction
{
    public function __construct(
        private readonly CommandInteractor $commandInteractor
    ) {
    }

    public function __invoke(InviteEmployeeRequest $request): JsonResponse
    {
        try {
            $this->commandInteractor->inviteEmployee(
                new InviteEmployeeCommand($request->employeeId)
            );
        } catch (InvalidArgumentException $exception) {
            return ResponseHelper::exception($exception);
        }

        return ResponseHelper::noContent();
    }
}
