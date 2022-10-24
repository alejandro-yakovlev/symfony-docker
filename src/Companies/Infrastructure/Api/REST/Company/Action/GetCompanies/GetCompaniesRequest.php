<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Api\REST\Company\Action\GetCompanies;

use App\Core\Api\REST\BaseRequest;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class GetCompaniesRequest extends BaseRequest
{
    #[Groups(['default'])]
    #[Assert\NotBlank()]
    #[Assert\Type('integer')]
    public int $page;

    #[Groups(['default'])]
    #[Assert\NotBlank()]
    #[Assert\Type('integer')]
    public int $perPage;
}
