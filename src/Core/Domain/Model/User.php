<?php

declare(strict_types=1);

namespace App\Core\Domain\Model;

use App\Core\Domain\ValueObject\Foundation\DateTime;
use App\Core\Domain\ValueObject\Foundation\Identifier;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements Entity, UserInterface
{
    private string $id;
    private Identifier $uuid;
    private string $username;
    private string $email;
    private string $password;
    private DateTime $createdAt;

    public static function create(Identifier $uuid, string $username, string $email, string $password, DateTime $createdAt): self
    {
        return new static($uuid, $username, $email, $password, $createdAt);
    }

    public function __construct(Identifier $uuid, string $username, string $email, string $password, DateTime $createdAt)
    {
        $this->uuid = $uuid;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt;
    }

    public function getUuid(): Identifier
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

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function equalsTo(Entity $entity): bool
    {
        if ($entity instanceof self) {
            return $this->getUuid() === $entity->getUuid()
                && $this->getUsername() === $entity->getUsername()
                && $this->getEmail() === $entity->getEmail()
                && $this->getPassword() === $entity->getPassword();
        }

        return false;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
    }
}
