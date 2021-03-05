<?php

declare(strict_types=1);

namespace App\Core\Application\Dto;

use App\Core\Domain\ValueObject\Foundation\Status;

class StatusDto implements Dto
{
    use DtoTrait;

    private string $version;
    private string $name;

    public static function create(Status $status): self
    {
        $dto = new static();
        $dto->version = $status->getVersion();
        $dto->name = $status->getName();

        return $dto;
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
