<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\EventListener\Exception;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public const MIME_JSON = 'application/json';

    public function __construct(private ContainerBagInterface $containerBag)
    {
    }

    #[AsEventListener(priority: 190)]
    public function onKernelException(ExceptionEvent $event): void
    {
        // Получаем MIME тип из заголовка Accept
        $acceptHeader = $event->getRequest()->headers->get('Accept');

        if (self::MIME_JSON === $acceptHeader) {
            $exception = $event->getThrowable();
            $response = new JsonResponse();
            $response->setData($this->exceptionToArray($exception));

            // HttpException содержит информацию о заголовках и статусе, испольузем это
            if ($exception instanceof HttpExceptionInterface) {
                $response->setStatusCode($exception->getStatusCode());
                $response->headers->replace($exception->getHeaders());
            } else {
                $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $event->setResponse($response);
        }
    }

    public function exceptionToArray(\Throwable $exception): array
    {
        $data = [
            'message' => $exception->getMessage(),
        ];
        if ($this->containerBag->get('kernel.debug')) {
            $data = array_merge(
                $data,
                [
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'trace' => $exception->getTrace(),
                ]
            );
        }

        return $data;
    }
}
