<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Controller;

use App\Core\Application\Dto\StatusDto;
use App\Core\Domain\Repository\DoctrineUserRepository;
use App\Core\Domain\ValueObject\Foundation\Json;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserAuthorizationController
{
    private DoctrineUserRepository $userRepository;

    public function __construct(DoctrineUserRepository $userRepository)
    {
//        $this->userRepository = $userRepository;
    }

    public function register(Request $request): JsonResponse
    {
        dump($request);
    }

    public function getStatus(): JsonResponse
    {
        return new JsonResponse(['status' => StatusDto::create(
            $this->statusFactory->create()
        )->toArray()]);
    }
}
