<?php

namespace app\useCase;

use app\repository\UserRepositoryInterface;
use app\dto\RegisterUserRequest;
use app\valueObject\Name;
use app\valueObject\Email;
use app\valueObject\Password;
use app\entity\User;
use app\event\UserRegisteredEvent;
use app\exception\UserAlreadyExistsException;

class RegisterUserUseCase
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(RegisterUserRequest $request): void
    {
        // Validar que el email no esté en uso
        if ($this->userRepository->findByEmail($request->email)) {
            throw new UserAlreadyExistsException("Email already in use " . $request->email);
        }

        // Crear instancias de los Value Objects
        $name = new Name($request->name);
        $email = new Email($request->email);
        $password = new Password($request->password);

        // Crear instancia de User
        $user = new User($name, $email, $password);

        // Guardar el usuario en la base de datos
        $this->userRepository->save($user);

        // Disparar el evento de dominio
        $event = new UserRegisteredEvent($user);
        // Aquí deberías despachar el evento a través de un EventDispatcher
    }
}