<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Api\REST\Company\Action\GetCompanies;

use App\Companies\Application\DTO\CompanyDTO;
use App\Companies\Application\Query\GetCompanies\GetCompaniesQuery;
use App\Companies\Application\Query\QueryInteractor;
use App\Companies\Infrastructure\Api\REST\Company\Resource\CompanyResource;
use App\Companies\Infrastructure\Api\REST\Company\Resource\PagerResource;
use App\Shared\Domain\Repository\Pager;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/companies', methods: ['GET'])]
#[OA\Parameter(
    name: 'page',
    description: 'Номер страницы',
    in: 'query',
    schema: new OA\Schema(type: 'integer')
)]
#[OA\Parameter(
    name: 'perPage',
    description: 'Количество элементов на странице',
    in: 'query',
    schema: new OA\Schema(type: 'integer')
)]
#[OA\Response(
    response: 200,
    description: 'Получен список компаний',
    content: new OA\JsonContent(ref: new Model(type: GetCompaniesResponse::class))
)]
#[OA\Tag(name: 'Companies')]
#[AsController]
class GetCompaniesAction
{
    public function __construct(
        private readonly QueryInteractor $queryInteractor
    ) {
    }

    public function __invoke(GetCompaniesRequest $request): JsonResponse
    {
        $query = new GetCompaniesQuery(Pager::fromPage($request->page, $request->perPage));
        $result = $this->queryInteractor->getCompanies($query);

        $companyResources = array_map(fn (CompanyDTO $c) => CompanyResource::fromDTOList($c), $result->companies);
        $response = new GetCompaniesResponse($companyResources, PagerResource::fromPager($result->pager));

        return $response->success();
    }
}
