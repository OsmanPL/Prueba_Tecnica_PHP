<?php

namespace app\dto;

class UserResponseDTO
{
    public string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function toJson(): string
    {
        return json_encode(['message' => $this->message]);
    }
}