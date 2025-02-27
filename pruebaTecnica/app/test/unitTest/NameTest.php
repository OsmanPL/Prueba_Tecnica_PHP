<?php

use PHPUnit\Framework\TestCase;
use app\valueObject\Name;

class NameTest extends TestCase
{
    public function testName()
    {
        echo "----- Name test --------\n";
        $name = new Name('Osman Perez');
        $this->assertEquals('Osman Perez', $name->value());
        echo "-------- Name test passed --------\n\n";
    }
}