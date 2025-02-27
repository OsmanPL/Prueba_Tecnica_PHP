<?php

namespace app\valueObject;

/**
 * Representa el nombre de un usuario con validaciones de formato y longitud.
 */
final class Name
{
    private string $name;

    public function __construct(string $name)
    {
        // Validamos que el nombre tenga al menos 3 caracteres y solo contenga letras y espacios
        if (strlen($name) < 3 || !preg_match('/^[a-zA-Z\s]+$/', $name)) {
            throw new \InvalidArgumentException("Nombre inválido.");
        }

        $this->name = $name;
    }

    /**
     * Devuelve el valor del nombre en formato string.
     */
    public function value(): string
    {
        return $this->name;
    }
}
