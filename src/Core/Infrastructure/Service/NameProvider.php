<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Service;

class NameProvider
{
    private const DEFAULT_NAME = '';

    public function getName(): string
    {
        return shell_exec('basename `git rev-parse --show-toplevel`') ?? self::DEFAULT_NAME;
    }
}
