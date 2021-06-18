<?php

declare(strict_types=1);

namespace App\Tests\Core\Domain\ValueObject\Foundation;

use App\Core\Domain\ValueObject\Foundation\Status;
use App\Core\Infrastructure\PhpUnit\CoreTestCase;

class StatusTest extends CoreTestCase
{
    public function testCreate(): void
    {
        $status = new Status('1.0', 'Sample name');

        self::assertSame('1.0', $status->getVersion());
        self::assertSame('Sample name', $status->getName());
    }
}
