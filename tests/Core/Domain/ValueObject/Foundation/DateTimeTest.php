<?php

declare(strict_types=1);

namespace App\Tests\Core\Domain\ValueObject\Foundation;

use App\Core\Domain\ValueObject\Foundation\DateTime;
use App\Core\Infrastructure\PhpUnit\CoreTestCase;

use DateTime as StandardDateTime;

class DateTimeTest extends CoreTestCase
{
    private const TIMESTAMP = 1611850600;
    private const DATETIME = '2021-01-28 17:16:40';
    private const TIMEZONE = 'Europe/Warsaw';

    public function testFromDateTime(): void
    {
        $standardDateTime = $this->getStandardDateTime();
        $dateTime = DateTime::fromDateTime($standardDateTime);

        self::assertSame(self::TIMESTAMP, $dateTime->toTimestamp());
    }

    public function testToDateTime(): void
    {
        $dateTime = DateTime::fromTimestamp(self::TIMESTAMP);

        self::assertEquals($this->getStandardDateTime(), $dateTime->toDateTime());
    }

    public function testFormat(): void
    {
        $dateTime = DateTime::fromTimestamp(self::TIMESTAMP);

        self::assertSame('2021-01', $dateTime->format('Y-m'));
    }

    public function testEqualsTo(): void
    {
        $dateTime = DateTime::fromTimestamp(self::TIMESTAMP);
        $standardDateTime = $this->getStandardDateTime();
        $anotherDateTime = DateTime::fromDateTime($standardDateTime);

        self::assertTrue($dateTime->equalsTo($anotherDateTime));
    }

    public function testNotEqualsTo(): void
    {
        $dateTime = new DateTime(self::TIMESTAMP);
        $actualDateTime = new DateTime(time());

        self::assertFalse($dateTime->equalsTo($actualDateTime));
    }

    private function getStandardDateTime(): StandardDateTime
    {
        return new StandardDateTime(self::DATETIME, new \DateTimeZone(self::TIMEZONE));
    }
}
