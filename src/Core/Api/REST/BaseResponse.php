<?php

declare(strict_types=1);

namespace App\Core\Api\REST;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BaseResponse
{
    public function success(
        string $message = null,
        int $code = Response::HTTP_OK,
        array $headers = [],
    ): JsonResponse {
        return ResponseHelper::success($this, $message, $code, $headers);
    }
}
