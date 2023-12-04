<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Application\Event\EventBusInterface;
use App\Shared\Domain\Event\EventInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class EventBus implements EventBusInterface
{
    use HandleTrait;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->messageBus = $eventBus;
    }

    public function execute(EventInterface ...$events): void
    {
        foreach ($events as $event) {
            $this->messageBus->dispatch($event);
        }
    }
}
