<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repository;

readonly class Pager
{
    public function __construct(
        public int $page,
        public int $perPage,
        public ?int $total = null
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
