<?php

declare(strict_types=1);

namespace App\Core\Api\REST;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Webmozart\Assert\InvalidArgumentException;

class ResponseHelper
{
    public static function success(
        mixed $data = null,
        string $message = null,
        int $code = Response::HTTP_OK,
        array $headers = [],
    ): JsonResponse {
        $data = [...['message' => $message, ...['data' => $data]]];

        return new JsonResponse($data, $code, $headers);
    }

    public static function noContent(array $headers = []): JsonResponse
    {
        return new JsonResponse([], Response::HTTP_NO_CONTENT, $headers);
    }

    public static function exception(
        Throwable $e,
        array $headers = []
    ): JsonResponse {
        $data = ['message' => $e->getMessage()];
        $code = $e instanceof InvalidArgumentException
            ? Response::HTTP_UNPROCESSABLE_ENTITY
            : Response::HTTP_INTERNAL_SERVER_ERROR;

        return new JsonResponse($data, $code, $headers);
    }

    public static function notFound(
        string $message = 'Not found',
        array $headers = []
    ): JsonResponse {
        $data = ['message' => $message];

        return new JsonResponse($data, Response::HTTP_NOT_FOUND, $headers);
    }

    public static function errors(
        array $errors = [],
        string $message = 'Some error occurred',
        array $headers = []
    ): JsonResponse {
        $data = [...['message' => $message], ...['errors' => $errors]];

        return new JsonResponse($data, Response::HTTP_UNPROCESSABLE_ENTITY, $headers);
    }
}
