<?php

try {

    $DB = $config['DB'];

    $connection = new PDO(
        'mysql:host='.$DB['host'].';dbname='.$DB['name'],   // dns => database namespace
        $DB['user'],                                        // username
        $DB['password']                                     // Password
    );

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    exit();
}
