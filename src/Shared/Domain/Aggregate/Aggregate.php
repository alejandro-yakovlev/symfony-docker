<?php

declare(strict_types=1);

namespace App\Shared\Domain\Aggregate;

use App\Shared\Domain\Event\EventInterface;

abstract class Aggregate
{
    /**
     * @var EventInterface[]
     */
    private array $events = [];

    abstract public function getId(): string;

    /**
     * @return EventInterface[]
     */
    public function pullEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    public function eventsEmpty(): bool
    {
        return empty($this->events);
    }

    protected function raise(EventInterface $event): void
    {
        $this->events[] = $event;
    }
}
