<?php

function waitArray(array $param = []){}
function waitObject(stdClass $obj){}
function waitCallable(callable $obj){}
function params(string $string, int $integer, bool $boolean, ...$other){}
function returnArray() : array {}

$output = '';
// Null coalescing operator
$output .= $myString ?? 'hello world';



$output = '';
if (isset($myString)) {
    $output .= $myString;
} else {
    $output = 'hello world';
}




// In a function named easterReverse
function easterReverse(string $filePath) : void {
// 	I assume a file path as first parameter
	
// 	Get the full file content
    $content = file_get_contents($filePath);
    // 	divide the file content by 2, using "floor(strlen($fileContent) / 2)"
    $secondPart = substr($content, floor(strlen($content) / 2));
    $firstPart = substr($content, 0, strlen($secondPart) - 1);
    
// 	Open the file in writing mode
    $file = fopen($filePath, 'r+');
// 	move the cursor to the first content part length
    fseek($file, strlen($firstPart), SEEK_SET);
// 	write the reversed second part into the file (strrev)
    fwrite($file, strrev($secondPart), strlen($secondPart));
	
// 	close the file
    fclose($file);
}

