<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Api\REST\Employee\Action\InviteEmployee;

use App\Core\Api\REST\BaseRequest;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class InviteEmployeeRequest extends BaseRequest
{
    #[Groups(['default'])]
    #[Assert\Ulid]
    public string $employeeId;
}
