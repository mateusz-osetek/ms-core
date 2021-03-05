<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Service\Factory;

use App\Core\Domain\ValueObject\Foundation\Status;
use App\Core\Infrastructure\Service\NameProvider;
use App\Core\Infrastructure\Service\VersionProvider;

class StatusFactory
{
    private VersionProvider $versionProvider;
    private NameProvider $nameProvider;

    public function __construct(VersionProvider $versionProvider, NameProvider $nameProvider)
    {
        $this->versionProvider = $versionProvider;
        $this->nameProvider = $nameProvider;
    }

    public function create(): Status
    {
        return Status::create(
            $this->versionProvider->getVersion(),
            $this->nameProvider->getName()
        );
    }
}
