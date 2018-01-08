<?php
use PHPUnit\Framework\TestCase;

class ExerciseTest extends TestCase
{
    public function testWinner()
    {
        do{
            $data = $this->provideData();
            list($aResult, $bResult) = $this->getResults($data);
        } while($aResult == $bResult);
        
        $input = array_merge($data);
        
        include 'exercise.php';
        
        $this->assertEquals(
            (($aResult > $bResult) ? 'A' : 'B'),
            $winner
        );
        
    }
    
    protected function getResults($data)
    {
        $aResult = 0;
        $bResult = 0;
        foreach($data as $time) {
            list($a, $b) = $time;
            $aResult += (int)($a > $b);
            $bResult += (int)($a < $b);
        }
        
        return [$aResult, $bResult];
    }
    
    protected function provideData()
    {
        $data = [];
        for ($i = 0;$i < 20;$i++) {
            $data[] = [rand(1, 10), rand(1, 10)];
        }
        
        return $data;
    }
}

