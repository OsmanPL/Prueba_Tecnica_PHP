<?php

namespace app\valueObject;

use app\exception\InvalidEmailException;
/**
 * Representa el email de un usuario con validación de formato.
 */
final class Email
{
    private string $email;

    public function __construct(string $email)
    {
        // Validamos que el email tenga un formato correcto
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException("Email inválido.");
        }

        $this->email = $email;
    }

    /**
     * Devuelve el valor del email en formato string.
     */
    public function value(): string
    {
        return $this->email;
    }
}
