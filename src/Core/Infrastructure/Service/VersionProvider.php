<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Service;

class VersionProvider
{
    private const DEFAULT_VERSION = 'dev-master';

    public function getVersion(): string
    {
        $version = shell_exec('git describe --tags --abbrev=0');
        return $version ?? self::DEFAULT_VERSION;
    }
}
//    public function getName(): string
//    {
//        return shell_exec('basename `git rev-parse --show-toplevel`') ?? '';
//    }
