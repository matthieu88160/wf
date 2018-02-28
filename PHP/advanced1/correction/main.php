<?php

require_once __DIR__.'/Loader/ApiLoader.php';
require_once __DIR__.'/Formatter/DataFormatter.php';
require_once __DIR__.'/FileDumper/FileDumper.php';

use function Loader\loadApiData;
use function DataFormatter\formatData;
use function FileDumper\createCsvFile;

createCsvFile(__DIR__.'/Store/result.csv', formatData(loadApiData('https://api.apis.guru/v2/list.json')));
