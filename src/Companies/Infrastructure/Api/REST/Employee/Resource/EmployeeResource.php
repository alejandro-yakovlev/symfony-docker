<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Api\REST\Employee\Resource;

use App\Companies\Application\DTO\EmployeeDTO;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

class EmployeeResource
{
    #[OA\Property()]
    public string $id;

    #[OA\Property(ref: new Model(type: ContactResource::class))]
    public ContactResource $contact;

    public static function fromDTO(EmployeeDTO $dto): self
    {
        $resource = new self();
        $resource->id = $dto->id;
        $resource->contact = ContactResource::fromValueObject($dto->contact);

        return $resource;
    }
}
