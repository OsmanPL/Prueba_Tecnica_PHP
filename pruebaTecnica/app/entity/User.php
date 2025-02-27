<?php

namespace app\entity;

use app\valueObject\UserId;
use app\valueObject\Name;
use app\valueObject\Email;
use app\valueObject\Password;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "User")]
final class User
{
    #[ORM\Id]
    #[ORM\Column(type: "integer", name: "UserId")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private int $userId;

    #[ORM\Column(type: "string", name: "Name")]
    private string $name;

    #[ORM\Column(type: "string", name: "Email")]
    private string $email;

    #[ORM\Column(type: "string", name: "Password")]
    private string $password;

    #[ORM\Column(type: "datetime_immutable", name: "Created_at")]
    private DateTimeImmutable $createdAt;

    public function __construct(Name $name, Email $email, Password $password, ?DateTimeImmutable $createdAt = null)
    {
        $this->name = $name->value();
        $this->email = $email->value();
        $this->password = $password->value();
        $this->createdAt = $createdAt ?? new DateTimeImmutable(); // Fecha de creación automática
    }

    /**
     * Devuelve el ID del usuario.
     */
    public function id(): UserId
    {
        return new UserId($this->userId);
    }

    /**
     * Devuelve el nombre del usuario.
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Devuelve el email del usuario.
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * Devuelve la contraseña (hash) del usuario.
     */
    public function password(): string
    {
        return $this->password;
    }

    /**
     * Devuelve la fecha de creación del usuario en formato string.
     */
    public function createdAt(): string
    {
        return $this->createdAt->format('Y-m-d H:i:s');
    }
}