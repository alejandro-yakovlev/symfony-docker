<?php

declare(strict_types=1);

namespace App\Core\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ExceptionListener
{
    public const MIME_JSON = 'application/json';

    public function onKernelException(ExceptionEvent $event): void
    {
        // Получаем MIME тип из заголовка Accept
        $acceptHeader = $event->getRequest()->headers->get('Accept');

        if (self::MIME_JSON === $acceptHeader) {
            $exception = $event->getThrowable();
            $response = new JsonResponse();
            $response->setContent($this->exceptionToJson($exception));

            // HttpException содержит информацию о заголовках и статусе, испольузем это
            if ($exception instanceof HttpExceptionInterface) {
                $response->setStatusCode($event->getResponse()->getStatusCode());
                $response->headers->replace($exception->getHeaders());
            } else {
                $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $event->setResponse($response);
        }
    }

    public function exceptionToJson(\Throwable $exception): string
    {
        // Испольузем Serializer для преобразования объекта в JSON
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        return $serializer->serialize($exception, 'json');
    }
}
