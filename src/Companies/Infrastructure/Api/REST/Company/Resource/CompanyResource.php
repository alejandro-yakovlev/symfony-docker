<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Api\REST\Company\Resource;

use App\Companies\Application\DTO\CompanyDTO;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Annotation\Groups;

class CompanyResource
{
    #[Groups(['full', 'list'])]
    #[OA\Property()]
    public string $id;

    #[Groups(['full', 'list'])]
    #[OA\Property(type: 'string')]
    public string $name;

    #[Groups(['full'])]
    #[OA\Property(ref: new Model(type: ContactPersonResource::class))]
    public ContactPersonResource $contactPerson;

    #[Groups(['full'])]
    #[OA\Property(type: 'string', format: 'date-time')]
    public string $createdAt;

    public static function fromDTOFull(CompanyDTO $dto): self
    {
        $resource = new self();
        $resource->id = $dto->id;
        $resource->name = $dto->name;
        $resource->contactPerson = ContactPersonResource::fromValueObject($dto->contactPerson);
        $resource->createdAt = $dto->createdAt->format(DATE_ATOM);

        return $resource;
    }

    public static function fromDTOList(CompanyDTO $dto): self
    {
        $resource = new self();
        $resource->id = $dto->id;
        $resource->name = $dto->name;

        return $resource;
    }
}
