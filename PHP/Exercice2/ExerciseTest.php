<?php
use PHPUnit\Framework\TestCase;

class ExerciseTest extends TestCase
{
    public function testSalting()
    {
        $password = 'azertyqwerty';
        $salt = 'salt';
        
        require 'exercise.php';
        
        $this->assertEquals('azertysaltqwerty', $saltedPassword);
    }
}

