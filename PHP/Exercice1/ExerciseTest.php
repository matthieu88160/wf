<?php
use PHPUnit\Framework\TestCase;

class ExerciseTest extends TestCase
{
    public function testBoolean()
    {
        $booleanTrue = null;
        $booleanFalse = null;
        
        require 'exercise.php';
        
        $this->assertEquals(
            'boolean',
            gettype($booleanTrue),
            'The variable "booleanTrue" is expected to be of type boolean. Actualy, it contain a type "'.gettype($booleanTrue).'".'
        );
        
        $this->assertEquals(
            'boolean',
            gettype($booleanFalse),
            'The variable "booleanFalse" is expected to be of type boolean. Actualy, it contain a type "'.gettype($booleanFalse).'".'
        );
        
        $this->assertTrue(
            $booleanTrue,
            'The variable "booleanTrue" is expected to be true. Actualy it\'s false.'
        );

        $this->assertFalse(
            $booleanFalse,
            'The variable "booleanTrue" is expected to be false. Actualy it\'s true.'
        );
    }
    
    public function testInteger()
    {
        $int = null;
        $integer = null;
        
        require 'exercise.php';
        
        $this->assertEquals(
            'integer',
            gettype($int),
            'The variable "int" is expected to be of type integer. Actualy, it contain a type "'.gettype($int).'".'
        );
        
        $this->assertEquals(
            'integer',
            gettype($integer),
            'The variable "integer" is expected to be of type integer. Actualy, it contain a type "'.gettype($integer).'".'
        );
    }
    
    public function testDouble()
    {
        $float = null;
        
        require 'exercise.php';
        
        $this->assertEquals(
            'double',
            gettype($float),
            'The variable "float" is expected to be of type double. Actualy, it contain a type "'.gettype($float).'".'
        );
    }
    
    public function testString()
    {
        $string = null;
        
        require 'exercise.php';
        
        $this->assertEquals(
            'string',
            gettype($string),
            'The variable "string" is expected to be of type string. Actualy, it contain a type "'.gettype($string).'".'
        );
    }
    
    public function testArray()
    {
        $array = null;
        
        require 'exercise.php';
        
        $this->assertEquals(
            'array',
            gettype($array),
            'The variable "array" is expected to be of type array. Actualy, it contain a type "'.gettype($array).'".'
        );
    }
    
    public function testNull()
    {
        $null = '';
        
        require 'exercise.php';
        
        $this->assertNull(
            $null,
            'The variable "null" is expected to be of type NULL. Actualy, it contain a type "'.gettype($null).'".'
        );
    }
    
    public function testDoubleDimenssion()
    {
        $doubleDimenssionArray = '';
        
        require 'exercise.php';
        
        $message = 'The variable "doubleDimenssionArray" is expected to be an array with two dimenssion.';
        
        $this->assertEquals('array', gettype($doubleDimenssionArray), $message);
        
        foreach ($doubleDimenssionArray as $value) {
            $this->assertEquals('array', gettype($value), $message);
        }
    }
    
    public function testAssociative()
    {
        $associativeArray = '';
        
        require 'exercise.php';
        
        $message = 'The variable "doubleDimenssionArray" is expected to be an associative array.';
        
        $this->assertEquals('array', gettype($associativeArray), $message);
        foreach (array_keys($associativeArray) as $key) {
            $this->assertEquals('string', gettype($key), $message);
        }
    }
}

