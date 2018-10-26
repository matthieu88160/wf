<?php
/**
$firstEpochDay = DateTime::createFromFormat('Y-m-d', '1970-01-01');

$date = new DateTime('first day of current month at midnight');
$lastDate = new DateTime('last day of current month');
$date->add(new DateInterval('+1day'));
$dateAsString = $date->format('Y-m-d H:i:s');
*/

//0. In my function, assuming two input parameters year and month
function getAllMondaysOfMonth($year, $month) {
//    1. create a date from year and month
    $date = DateTime::createFromFormat('Yn', $year.$month);
    //    2. Go to first day of the month
    $date = new DateTime('first day of '.$date->format('F Y'));
    //    3. if current day is not a monday, go to next monday
    $interval = DateInterval::createFromDateString('next monday');
    if ($date->format('N') != 1) {
        $date->add($interval);
    }
    //    4. while the date month is the needed month
    $mondays = [];
    while($date->format('m') == $month) {
        //    	4.1. Add the date into an array
        $mondays[] = $date->format('l j, M Y');
        //    	4.2. Go to next monday
        $date->add($interval);
    }
//    5. return the array
    return $mondays;
}

