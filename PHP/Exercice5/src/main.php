<?php

require_once __DIR__.'/DimensionalMath/Distance/DistanceCalculation.php';
require_once __DIR__.'/DimensionalMath/Vector/AngleCalculation.php';

use function DimensionalMath\Distance\threeDimensionDistance;
use function DimensionalMath\Vector\getVectorAngle;

$distance = threeDimensionDistance(
    [1, 1, 1],
    [2, 2, 2]
);

$angle = getVectorAngle([1, 6], [3, 12]);

var_dump($distance, $angle);