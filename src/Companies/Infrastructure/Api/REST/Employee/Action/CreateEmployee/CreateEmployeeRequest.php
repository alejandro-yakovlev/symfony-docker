<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Api\REST\Employee\Action\CreateEmployee;

use App\Companies\Infrastructure\Api\REST\Employee\Resource\ContactResource;
use App\Core\Api\REST\BaseRequest;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class CreateEmployeeRequest extends BaseRequest
{
    #[Groups(['default'])]
    #[Assert\NotBlank()]
    #[Assert\Type('string')]
    public string $name;

    #[Groups(['default'])]
    #[OA\Property(ref: new Model(type: ContactResource::class))]
    public ContactResource $contact;

    #[Groups(['default'])]
    #[Assert\Ulid]
    public string $companyId;
}
