<?php

declare(strict_types=1);

namespace App\Core\Domain\ValueObject\Foundation;

class Status
{
    private string $version;

    private string $name;

    public static function create(string $version, string $name): self
    {
        return new self($version, $name);
    }

    public function __construct(string $version, string $name)
    {
        $this->version = $version;
        $this->name = $name;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
