<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Api\REST\Company\Resource;

use App\Companies\Domain\Entity\Company\ContactPerson;
use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class ContactPersonResource
{
    #[Groups(['default'])]
    #[OA\Property(type: 'string')]
    #[Assert\Type('string')]
    public string $firstname;

    #[Groups(['default'])]
    #[OA\Property(type: 'string')]
    #[Assert\Type('string')]
    public string $lastname;

    #[Groups(['default'])]
    #[OA\Property(type: 'string')]
    #[Assert\Type('string')]
    public string $email;

    #[Groups(['default'])]
    #[OA\Property(type: 'string', nullable: true)]
    #[Assert\Type('string')]
    public ?string $phoneNumber = null;

    public static function fromValueObject(ContactPerson $contactPerson): self
    {
        $dto = new self();
        $dto->email = $contactPerson->email;
        $dto->lastname = $contactPerson->lastname;
        $dto->firstname = $contactPerson->firstname;
        $dto->phoneNumber = $contactPerson->phoneNumber;

        return $dto;
    }
}
