<?php
use PHPUnit\Framework\TestCase;

class ExerciseTest extends TestCase
{
    public function testSalting()
    {
        $password = 'azertyqwerty';
        $salt = 'salt';
        
        require 'correction.php';
        
        $this->assertEquals('azertysaltqwerty', $saltedPassword);
    }
}

