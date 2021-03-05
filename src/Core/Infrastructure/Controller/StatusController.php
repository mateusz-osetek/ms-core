<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Controller;

use App\Core\Application\Dto\StatusDto;
use App\Core\Infrastructure\Service\Factory\StatusFactory;
use Symfony\Component\HttpFoundation\JsonResponse;

class StatusController
{
    private StatusFactory $statusFactory;

    public function __construct(StatusFactory $statusFactory)
    {
        $this->statusFactory = $statusFactory;
    }

    public function getStatus(): JsonResponse
    {
        return new JsonResponse(['status' => StatusDto::create(
            $this->statusFactory->create()
        )->toArray()]);
    }
}
