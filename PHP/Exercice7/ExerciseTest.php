<?php
use PHPUnit\Framework\TestCase;

require 'exercise.php';

class ExerciseTest extends TestCase
{
    public function testDivideByZero()
    {
        $this->assertTrue(function_exists('divide'), 'The function "divide" is expected to be defined');
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Division by 0 is not allowed');
        
        divide(0,0);
    }
    
    public function testDivide()
    {
        $this->assertTrue(function_exists('divide'), 'The function "divide" is expected to be defined');
        
        $this->assertEquals(16, divide(16*5, 5));
    }
    
    public function testArrayDivide()
    {
        $this->assertTrue(function_exists('arrayDivide'), 'The function "arrayDivide" is expected to be defined');
        $this->assertEquals([16], arrayDivide([16*5], 5));
    }
    
    public function testArrayDivideByZero()
    {
        $this->assertTrue(function_exists('arrayDivide'), 'The function "arrayDivide" is expected to be defined');
        $this->assertEquals([16*5], arrayDivide([16*5], 0));
    }
}

