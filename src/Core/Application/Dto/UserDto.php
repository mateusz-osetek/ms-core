<?php

declare(strict_types=1);

namespace App\Core\Application\Dto;

use App\Core\Domain\Model\User;

class UserDto implements Dto
{
    use DtoTrait;

    private string $uuid;
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
        $dto->uuid = $array['uuid'];
        $dto->username = $array['username'];
        $dto->email = $array['email'];
        $dto->password = $array['password'];

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
