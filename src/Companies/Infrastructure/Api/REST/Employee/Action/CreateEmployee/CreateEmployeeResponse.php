<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Api\REST\Employee\Action\CreateEmployee;

use App\Companies\Infrastructure\Api\REST\Employee\Resource\EmployeeResource;
use App\Core\Api\REST\BaseResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

class CreateEmployeeResponse extends BaseResponse
{
    #[OA\Property(ref: new Model(type: EmployeeResource::class))]
    public EmployeeResource $employee;

    public function __construct(EmployeeResource $employeeResource)
    {
        $this->employee = $employeeResource;
    }
}
