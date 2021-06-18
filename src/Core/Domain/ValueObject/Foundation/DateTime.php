<?php

declare(strict_types=1);

namespace App\Core\Domain\ValueObject\Foundation;

use App\Core\Domain\ValueObject\ValueObject;

use DateTime as StandardDateTime;

final class DateTime implements ValueObject
{
    private const DEFAULT_TIMEZONE = 'Europe/Warsaw';

    private int $timestamp;

    public static function fromTimestamp(int $timestamp): self
    {
        return new self($timestamp);
    }

    public static function fromDateTime(StandardDateTime $dateTime): self
    {
        return new self($dateTime->getTimestamp());
    }

    public function __construct(int $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function toTimestamp(): int
    {
        return $this->timestamp;
    }

    public function toDateTime(string $format = StandardDateTime::ATOM, $timezone = self::DEFAULT_TIMEZONE): StandardDateTime
    {
        $datetime = new StandardDateTime();
        $datetime->setTimezone(new \DateTimeZone($timezone));

        return $datetime->setTimestamp($this->timestamp);
    }

    public function format(string $format = StandardDateTime::ATOM, $timezone = self::DEFAULT_TIMEZONE): string
    {
        $datetime = new StandardDateTime();
        $datetime->setTimezone(new \DateTimeZone($timezone));

        return $datetime->setTimestamp($this->timestamp)->format($format);
    }

    public function equalsTo(ValueObject $another): bool
    {
        if ($another instanceof self) {
            return $another->timestamp === $this->timestamp;
        }

        return true;
    }
}
