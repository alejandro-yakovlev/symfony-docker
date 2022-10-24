<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Api\REST\Company\Action\CreateCompany;

use App\Companies\Infrastructure\Api\REST\Company\Resource\ContactPersonResource;
use App\Core\Api\REST\BaseRequest;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class CreateCompanyRequest extends BaseRequest
{
    #[Groups(['default'])]
    #[Assert\NotBlank()]
    #[Assert\Type('string')]
    public string $name;

    #[Groups(['default'])]
    #[OA\Property(ref: new Model(type: ContactPersonResource::class))]
    public ContactPersonResource $contactPerson;
}
