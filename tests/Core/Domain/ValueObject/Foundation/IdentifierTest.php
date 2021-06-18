<?php

declare(strict_types=1);

namespace App\Tests\Core\Domain\ValueObject\Foundation;

use App\Core\Domain\ValueObject\Foundation\Identifier;
use App\Core\Infrastructure\PhpUnit\CoreTestCase;

class IdentifierTest extends CoreTestCase
{
    public function testRandom(): void
    {
        $random = Identifier::random();
        self::assertNotEmpty($random);
    }

    public function testEquals(): void
    {
        $identifier = Identifier::fromString('some-id');
        $anotherIdentifier = Identifier::fromString('some-id');
        self::assertTrue($identifier->equalsTo($anotherIdentifier));
    }

    public function testNotEquals(): void
    {
        $identifier = Identifier::fromString('some-id');
        $anotherIdentifier = Identifier::random();
        self::assertFalse($identifier->equalsTo($anotherIdentifier));
    }
}
