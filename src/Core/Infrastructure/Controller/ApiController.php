<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Controller;

use App\Core\Domain\ValueObject\Foundation\Json;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController
{
    protected function requestToJson(Request $request): ?Json
    {
        return Json::fromString($request->getContent());
    }

    protected function throwValidationError(): JsonResponse
    {
        return JsonResponse::create([
            'code' => 'validation-error',
            'message' => 'Unprocessable entity.',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    protected function throwSuccessResponse(string $code = 'OK', string $message = 'Operation succeed.'): JsonResponse
    {
        return JsonResponse::create([
            'code' => $code,
            'message' => $message,
        ], Response::HTTP_OK);
    }
}
