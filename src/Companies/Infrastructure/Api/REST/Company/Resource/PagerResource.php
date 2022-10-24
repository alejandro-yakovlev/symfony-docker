<?php

declare(strict_types=1);

namespace App\Companies\Infrastructure\Api\REST\Company\Resource;

use App\Shared\Domain\Repository\Pager;
use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

class PagerResource
{
    #[Assert\NotBlank()]
    #[OA\Property(type: 'integer')]
    public int $page;

    #[Assert\NotBlank()]
    #[OA\Property(type: 'integer')]
    public int $perPage;

    #[OA\Property(type: 'integer', nullable: true)]
    public ?int $total;

    public static function fromPager(Pager $pager): self
    {
        $dto = new self();
        $dto->page = $pager->page;
        $dto->perPage = $pager->perPage;
        $dto->total = $pager->total;

        return $dto;
    }
}
