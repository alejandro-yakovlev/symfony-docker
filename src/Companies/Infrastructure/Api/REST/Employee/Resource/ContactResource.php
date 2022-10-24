<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Api\REST\Employee\Resource;

use App\Companies\Domain\Entity\Employee\Contact;
use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class ContactResource
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

    public static function fromValueObject(Contact $contact): self
    {
        $dto = new self();
        $dto->email = $contact->email;
        $dto->lastname = $contact->lastname;
        $dto->firstname = $contact->firstname;

        return $dto;
    }
}
