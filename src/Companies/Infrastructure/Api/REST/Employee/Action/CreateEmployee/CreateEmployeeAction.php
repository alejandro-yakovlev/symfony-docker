<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Api\REST\Employee\Action\CreateEmployee;

use App\Companies\Application\Command\CommandInteractor;
use App\Companies\Application\Command\CreateEmployee\CreateEmployeeCommand;
use App\Companies\Domain\Entity\Employee\Contact;
use App\Companies\Infrastructure\Api\REST\Employee\Resource\EmployeeResource;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/employees', methods: ['POST'])]
#[OA\RequestBody(content: new OA\JsonContent(
    ref: new Model(
        type: CreateEmployeeRequest::class,
        groups: ['default'],
    )
))]
#[OA\Response(
    response: 201,
    description: 'Сотрудник создан',
    content: new OA\JsonContent(ref: new Model(type: CreateEmployeeResponse::class))
)]
#[Security(name: 'Bearer')]
#[OA\Tag(name: 'Employees')]
#[AsController]
class CreateEmployeeAction
{
    public function __construct(
        private readonly CommandInteractor $commandInteractor
    ) {
    }

    public function __invoke(CreateEmployeeRequest $request): JsonResponse
    {
        $contact = new Contact(
            $request->contact->firstname,
            $request->contact->lastname,
            $request->contact->email
        );

        $employee = $this->commandInteractor->createEmployee(
            new CreateEmployeeCommand($contact, $request->companyId)
        )->employee;

        $employeeResource = EmployeeResource::fromDTO($employee);
        $response = new CreateEmployeeResponse($employeeResource);

        return $response->success();
    }
}
