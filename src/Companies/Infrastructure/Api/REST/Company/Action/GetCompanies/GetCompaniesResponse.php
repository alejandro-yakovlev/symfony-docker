<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Api\REST\Company\Action\GetCompanies;

use App\Companies\Infrastructure\Api\REST\Company\Resource\CompanyResource;
use App\Companies\Infrastructure\Api\REST\Company\Resource\PagerResource;
use App\Core\Api\REST\BaseResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

class GetCompaniesResponse extends BaseResponse
{
    /**
     * @var CompanyResource[]
     */
    #[OA\Property(type: 'array', items: new OA\Items(ref: new Model(type: CompanyResource::class, groups: ['list'])))]
    public array $items;

    #[OA\Property(ref: new Model(type: PagerResource::class))]
    public PagerResource $pager;

    /**
     * @param CompanyResource[] $items
     */
    public function __construct(array $items, PagerResource $pager)
    {
        $this->items = $items;
        $this->pager = $pager;
    }
}
