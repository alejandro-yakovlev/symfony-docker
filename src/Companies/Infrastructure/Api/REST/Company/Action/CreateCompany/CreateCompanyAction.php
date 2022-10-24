<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Api\REST\Company\Action\CreateCompany;

use App\Companies\Application\Command\CommandInteractor;
use App\Companies\Application\Command\CreateCompany\CreateCompanyCommand;
use App\Companies\Domain\Entity\Company\ContactPerson;
use App\Companies\Infrastructure\Api\REST\Company\Resource\CompanyResource;
use App\Core\Api\REST\ResponseHelper;
use InvalidArgumentException;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/companies', methods: ['POST'])]
#[OA\RequestBody(content: new OA\JsonContent(
    ref: new Model(
        type: CreateCompanyRequest::class,
        groups: ['default'],
    )
))]
#[OA\Response(
    response: 201,
    description: 'Компания создана',
    content: new OA\JsonContent(ref: new Model(type: CompanyResource::class))
)]
#[Security(name: 'Bearer')]
#[OA\Tag(name: 'Companies')]
#[AsController]
class CreateCompanyAction
{
    public function __construct(
        private readonly CommandInteractor $commandInteractor
    ) {
    }

    public function __invoke(CreateCompanyRequest $request): JsonResponse
    {
        $contactPerson = new ContactPerson(
            $request->contactPerson->firstname,
            $request->contactPerson->lastname,
            $request->contactPerson->email,
            $request->contactPerson->phoneNumber,
        );

        try {
            $company = $this->commandInteractor->createCompany(
                new CreateCompanyCommand($request->name, $contactPerson)
            )->company;
        } catch (InvalidArgumentException $exception) {
            return ResponseHelper::exception($exception);
        }

        $companyResource = CompanyResource::fromDTOFull($company);
        $response = new CreateCompanyResponse($companyResource);

        return $response->success();
    }
}
