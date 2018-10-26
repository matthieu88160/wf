<?php

require __DIR__ . '/connection.php';

function getAllProjects() {
    global $connection;
    $statement = 'SELECT p.*, s.label FROM Project as p 
                  INNER JOIN Status as s ON s.id = p.statusId';
    $projects = $connection->query($statement)->fetchAll();
    if ($projects === false) {
        throw new Exception($connection->errorCode());
    }
    
    foreach ($projects as $key => $project) {
        $statement = '
            SELECT c.label FROM Category as c 
            INNER JOIN ProjectCategory as pc ON c.id = pc.categoryId
            WHERE pc.projectId = '.$project['id'];
        $categories = $connection->query($statement)->fetchAll();
        if ($categories === false) {
            throw new Exception($connection->errorCode());
        }
        
        $project['categories'] = $categories;
        $projects[$key] = $project;
    }

    return $projects;
}

