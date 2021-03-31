<?php

declare(strict_types=1);

namespace App\Core\Application\Dto;

use App\Core\Domain\Model\User;
use App\Core\Domain\ValueObject\Foundation\DateTime;
use App\Core\Domain\ValueObject\Foundation\Identifier;

class UserDto implements Dto
{
    use DtoTrait;

    private ?string $uuid;
    private string $username;
    private string $email;
    private string $password;
    private ?int $createdAt;

    public static function create(User $user): self
    {
        $dto = new static();
        $dto->uuid = $user->getUuid()->toString();
        $dto->username = $user->getUsername();
        $dto->email = $user->getEmail();
        $dto->password = $user->getPassword();
        $dto->createdAt = $user->getCreatedAt()->toTimestamp();

        return $dto;
    }

    public static function fromArray(array $array): self
    {
        $dto = new static();
        $dto->uuid = Identifier::random()->toString();
        $dto->username = $array['username'];
        $dto->email = $array['email'];
        $dto->password = $array['password'];
        $dto->createdAt = time();

        return $dto;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }
}
