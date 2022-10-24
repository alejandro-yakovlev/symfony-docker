<?php

declare(strict_types=1);

namespace App\Core\EventListener;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class BuiltInEventsSubscriber
{
    public function onKernelException(ExceptionEvent $event)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }
}
