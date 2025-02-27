<?php

namespace app\valueObject;

use app\exception\WeakPasswordException;

/**
 * Representa la contraseña de un usuario con validaciones y hashing seguro.
 */
final class Password
{
    private string $hash;

    public function __construct(string $password)
    {
        // Validamos que la contraseña tenga al menos 8 caracteres, 1 mayúscula, 1 número y 1 carácter especial
        if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[0-9]/', $password) || !preg_match('/[^a-zA-Z0-9]/', $password)) {
            throw new WeakPasswordException("La contraseña no cumple con los requisitos.");
        }

        // Guardamos la contraseña en formato hash para mayor seguridad
        $this->hash = password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Devuelve el hash de la contraseña.
     */
    public function value(): string
    {
        return $this->hash;
    }

    /**
     * Verifica si una contraseña ingresada coincide con el hash almacenado.
     */
    public function verify(string $password): bool
    {
        return password_verify($password, $this->hash);
    }
}
