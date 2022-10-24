<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Api\REST\Company\Action\CreateCompany;

use App\Companies\Infrastructure\Api\REST\Company\Resource\CompanyResource;
use App\Core\Api\REST\BaseResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

class CreateCompanyResponse extends BaseResponse
{
    #[OA\Property(ref: new Model(type: CompanyResource::class))]
    public CompanyResource $company;

    public function __construct(CompanyResource $company)
    {
        $this->company = $company;
    }
}
