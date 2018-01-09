<?php 

function arrayDivide(array $baseArray, int $by) : array {
    $result = [];
    
    foreach ($baseArray as $base) {
        try {
            $result[] = divide($base, $by);
        } catch (RuntimeException $exception) {
            $result[] = $base;
        }
    }
    
    return $result;
}

function divide(int $base, int $by) : float {
    if ($by == 0) {
        throw new RuntimeException('Division by 0 is not allowed');
    }
    
    return $base / $by;
}
