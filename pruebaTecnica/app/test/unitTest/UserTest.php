<?php

use PHPUnit\Framework\TestCase;
use app\entity\User;
use app\valueObject\Name;
use app\valueObject\Email;
use app\valueObject\Password;

class UserTest extends TestCase
{
    public function testUser()
    {
        echo "User test\n";
        $name = new Name('Osman Perez');
        $email = new Email('osmanpl@example.com');
        $plainPassword = 'P@ssw0rd';
        $password = new Password($plainPassword);
        $user = new User($name, $email, $password);

        $this->assertEquals('Osman Perez', $user->name());
        $this->assertEquals('osmanpl@example.com', $user->email());
        $this->assertTrue($password->verify($plainPassword));
        echo "User test passed\n\n";
    }
}