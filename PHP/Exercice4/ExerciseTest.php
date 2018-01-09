<?php
use PHPUnit\Framework\TestCase;

require_once 'exercise.php';

class ExerciseTest extends TestCase
{
    public function provideYearAndMonth()
    {
        return [
            [2018, 1],
            [2020, 6],
            [2025, 11],
            [2013, 9],
            [2010, 7]
        ];
    }
    
    /**
     * Test function
     * 
     * This method validate the "getAllMondaysOfMonth" function
     * 
     * @param int $year  The calculation year
     * @param int $month The calculation month
     * 
     * @dataProvider provideYearAndMonth
     */
    public function testFunction(int $year, int $month) : void
    {
        $this->assertTrue(
            function_exists('getAllMondaysOfMonth'),
            'The function is expected to be named "getAllMondaysOfMonth"'
        );
        
        $functionReflex = new ReflectionFunction('getAllMondaysOfMonth');
        
        $this->assertEquals(
            2,
            $functionReflex->getNumberOfParameters(),
            'The function is expected to require exactly two parameters'
        );
        
        $this->assertEquals($this->getMondays($year, $month), getAllMondaysOfMonth($year, $month));
        
        return;
    }
    
    protected function getMondays(int $year, int $month) : array
    {
        $mondays = [];
        $date = new DateTime('first monday of '.(DateTime::createFromFormat('Yn', $year.$month))->format('F Y'));
        
        $interval = DateInterval::createFromDateString('next monday');
        while($date->format('m') == $month) {
            $mondays[] = $date->format('l j, M Y');
            $date->add($interval);
        }
        return $mondays;
    }
}

