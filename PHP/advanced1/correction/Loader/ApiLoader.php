<?php
namespace Loader;

function loadApiData($url) {
    $stringData = file_get_contents($url, true);
    
    $data = json_decode($stringData, true);
    
    return $data;
}
