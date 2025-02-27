<?php

use PHPUnit\Framework\TestCase;
use app\controller\RegisterUserController;
use app\useCase\RegisterUserUseCase;
use app\repository\UserRepositoryInterface;
use app\dto\RegisterUserRequest;
use app\entity\User;
use app\valueObject\Name;
use app\valueObject\Email;
use app\valueObject\Password;
use app\exception\UserAlreadyExistsException;
use app\event\UserRegisteredEventHandler;
use app\event\UserRegisteredEvent;

class RegisterUserUseCaseTest extends TestCase
{
    // Prueba para registrar un usuario exitosamente
    public function testRegisterUser()
    {
        echo "---- Register user test ------\n";
        // Crear un mock del repositorio de usuarios
        $userRepository = $this->createMock(UserRepositoryInterface::class);
        // Configurar el mock para que el método findByEmail devuelva null (email no existe)
        $userRepository->method('findByEmail')->willReturn(null);
        // Configurar el mock para esperar que el método save sea llamado una vez
        $userRepository->expects($this->once())->method('save');

        // Crear una instancia del caso de uso RegisterUserUseCase con el mock del repositorio
        $useCase = new RegisterUserUseCase($userRepository);
        // Crear una solicitud de registro de usuario con los datos proporcionados
        $request = new RegisterUserRequest('Osman Perez', 'osmanpl@example.com', 'P@ssw0rd');

        // Crear el controlador
        $registerUserController = new RegisterUserController($useCase);

        // Simular una solicitud HTTP
        $data = [
            'name' => 'Osman Perez',
            'email' => 'osmanpl@example.com',
            'password' => 'P@ssw0rd'
        ];

        try {
            // Ejecutar el caso de uso con la solicitud de registro
            $response = $registerUserController->register($data);
            // Verificar que la respuesta sea correcta
            $this->assertEquals('User registered successfully', $response->message);
            echo "User registered successfully\n";

            $eventHandler = new UserRegisteredEventHandler();
            $eventHandler->handle(new UserRegisteredEvent(new User(new Name('Osman Perez'), new Email('osmanpl@example.com'), new Password('P@ssw0rd'))));
            echo "---- User registered event handled successfully -------\n\n";
        } catch (\Exception $e) {
            // Fallar la prueba si se lanza una excepción inesperada
            $this->fail("User registration test failed: " . $e->getMessage());
        }
    }

    // Prueba para verificar que el registro de usuario falla si el email ya existe
    public function testRegisterUserFailsIfEmailExists()
    {
        echo "------- Register user fails if email exists test --------\n";
        // Crear un mock del repositorio de usuarios
        $userRepository = $this->createMock(UserRepositoryInterface::class);
        // Configurar el mock para que el método findByEmail devuelva un usuario (email ya existe)
        $userRepository->method('findByEmail')->willReturn(new User(new Name('Osman Perez'), new Email('osmanpl@example.com'), new Password('P@ssw0rd')));

        // Crear una instancia del caso de uso RegisterUserUseCase con el mock del repositorio
        $useCase = new RegisterUserUseCase($userRepository);
        // Crear una solicitud de registro de usuario con los datos proporcionados
        $request = new RegisterUserRequest('Osman Perez', 'osmanpl@example.com', 'P@ssw0rd');

        try {
            // Ejecutar el caso de uso con la solicitud de registro
            $useCase->execute($request);
            // Fallar la prueba si no se lanza la excepción esperada
            $this->fail("Expected exception not thrown.");
        } catch (UserAlreadyExistsException $e) {
            // Verificar que el mensaje de la excepción sea el esperado
            $this->assertEquals('Email already in use osmanpl@example.com', $e->getMessage());
            // Imprimir el mensaje de la excepción si la prueba pasa
            echo $e->getMessage() . "\n\n";
            echo "------- Register user fails if email exists test passed --------\n\n";
        } catch (\Exception $e) {
            // Fallar la prueba si se lanza una excepción inesperada
            $this->fail("Unexpected exception thrown: " . $e->getMessage());
        }
    }
}