<?php 

function easterReverse($fileOrigin) {
    $fileContent = file_get_contents($fileOrigin);
    $secondPart = substr($fileContent, floor(strlen($fileContent) / 2));
    $firstPart = substr($fileContent, 0, strlen($secondPart) - 1);
    
    $file = fopen($fileOrigin, 'r+');
    fseek($file, strlen($firstPart), SEEK_SET);
    fwrite($file, strrev($secondPart), strlen($secondPart));
    
    fclose($file);
}
