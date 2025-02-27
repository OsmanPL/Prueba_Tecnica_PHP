<?php

use PHPUnit\Framework\TestCase;
use app\valueObject\Password;
use app\exception\WeakPasswordException;

class PasswordTest extends TestCase
{
    public function testPasswordCreation()
    {
        echo "----- Password test -----\n";
        $plainPassword = 'P@ssw0rd';
        $password = new Password($plainPassword);
        $this->assertTrue($password->verify($plainPassword));
        echo "---- Password test passed -----\n\n";
    }

    public function testInvalidPassword()
    {
        echo "----- Invalid password test -------\n";
        try {
            new Password('password');
            $this->fail("Expected WeakPasswordException not thrown.");
        } catch (WeakPasswordException $e) {
            echo $e->getMessage() . "\n";
            echo "----- Invalid password test passed ------\n\n";
            $this->assertEquals($e->getMessage() , "La contraseña no cumple con los requisitos."); 
        }
    }
}