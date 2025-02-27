<?php

use PHPUnit\Framework\TestCase;
use app\valueObject\Email;
use app\exception\InvalidEmailException;

class EmailTest extends TestCase
{
    public function testEmail()
    {
        $email = new Email('osmanpl@example.com');
        $this->assertEquals('osmanpl@example.com', $email->value());
    }

    public function testInvalidEmail()
    {

        echo "----- Invalid email test -------\n";
        try {
            new Email('osmanpl');
            $this->fail("Expected InvalidEmailException not thrown.");
        } catch (InvalidEmailException $e) {
            echo $e->getMessage() . "\n";
            echo "----- Invalid email test passed ------\n\n";
            $this->assertEquals($e->getMessage() , "Email inválido."); 
        }
    }
}