<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repository;

class Pager
{
    public function __construct(
        public readonly int $page = 1,
        public readonly int $perPage = 10,
        public readonly ?int $total = null
    ) {
    }

    public static function fromPage(int $page, int $perPage): self
    {
        return new self($page, $perPage);
    }

    public function getOffset(): int
    {
        if (1 === $this->page) {
            return 0;
        }

        return $this->page * $this->perPage - $this->perPage;
    }

    public function getLimit(): int
    {
        return $this->perPage;
    }
}
