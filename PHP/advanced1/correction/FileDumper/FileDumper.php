<?php 
namespace FileDumper;

function createCsvFile($filePath, $data) {
    $file = fopen($filePath, 'w');
    
    foreach ($data as $line) {
        fputcsv($file, $line);
    }
    
    fclose($file);
}
