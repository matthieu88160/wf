<?php
use PHPUnit\Framework\TestCase;

require 'exercise.php';

class ExerciseTest extends TestCase
{
    public function testFile()
    {
        copy(__DIR__.'/fixture/fixtureFile.txt', __DIR__.'/file.txt');
        
        $fileContent = file_get_contents(__DIR__.'/file.txt');
        $secondPart = substr($fileContent, floor(strlen($fileContent) / 2));
        $firstPart = substr($fileContent, 0, strlen($secondPart) - 1);
        
        easterReverse(__DIR__.'/file.txt');
        
        $this->assertEquals($firstPart.strrev($secondPart), file_get_contents(__DIR__.'/file.txt'));
        
        $exercise = file_get_contents(__DIR__.'/exercise.php');
        
        $this->assertFalse(strstr($exercise, 'file_put_content'), 'You are not allowed to use file_put_contents');
        $this->assertFalse(
            (bool)preg_match('/fopen\([^)]*, ?["\'](w|(w\+))["\']\)/', $exercise),
            'You are not allowed to use "w" or "w+" access mode'
        );
    }
}

