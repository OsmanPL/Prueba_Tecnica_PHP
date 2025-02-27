<?php

namespace app\controller;

use app\useCase\RegisterUserUseCase;
use app\dto\RegisterUserRequest;
use app\dto\UserResponseDTO;

class RegisterUserController
{
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(RegisterUserUseCase $registerUserUseCase)
    {
        $this->registerUserUseCase = $registerUserUseCase;
    }

    public function register(array $data): UserResponseDTO
    {
        $request = new RegisterUserRequest($data['name'], $data['email'], $data['password']);
        $this->registerUserUseCase->execute($request);

        return new UserResponseDTO('User registered successfully');
    }
}