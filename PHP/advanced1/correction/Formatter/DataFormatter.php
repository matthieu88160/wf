<?php 
namespace DataFormatter;

function formatData($data) {
    $formattedData = [];
    
    foreach ($data as $element) {
        $format = 'Y-m-d\TH:i:s.u\Z';
        
        $created = \DateTime::createFromFormat($format, $element['added']);
        $preferedVersion = $element['preferred'];
        
        $currentVersion = $element['versions'][$preferedVersion];
        $updated = \DateTime::createFromFormat($format, $currentVersion['updated']);
                
        $description = $currentVersion['info']['description'];
        $title = $currentVersion['info']['title'];
        
        $formattedData[] = [
            $title,
            strlen($description) > 100 ? substr($description, 0, 100) : $description,
            $preferedVersion,
            $created->format('d-m-Y H:i:s'),
            $updated->format('d-m-Y H:i:s')
        ];
    }
    
    return $formattedData;
}