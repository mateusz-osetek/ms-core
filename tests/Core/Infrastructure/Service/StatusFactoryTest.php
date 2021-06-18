<?php

declare(strict_types=1);

namespace App\Tests\Core\Infrastructure\Service;

use App\Core\Infrastructure\PhpUnit\CoreTestCase;
use App\Core\Infrastructure\Service\Factory\StatusFactory;
use App\Core\Infrastructure\Service\NameProvider;
use App\Core\Infrastructure\Service\VersionProvider;

class StatusFactoryTest extends CoreTestCase
{
    public function testCreate(): void
    {
        $version = \Mockery::mock(VersionProvider::class);
        $version->shouldReceive('getVersion')->andReturn('dev-master');

        $name = \Mockery::mock(NameProvider::class);
        $name->shouldReceive('getName')->andReturn('');

        $statusFactory = new StatusFactory($version, $name);
        $status = $statusFactory->create();

        self::assertSame($status->getVersion(), 'dev-master');
        self::assertSame($status->getName(), '');
    }
}
