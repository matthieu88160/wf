<?php 
$db = 'test';
$host = '172.19.0.2';
$username = 'root';

$stderr = fopen('php://stderr', 'w');

try{
    $connection = new PDO("mysql:dbname=$db;host=$host", $username);
    
} catch (\PDOException $exception) {
    $log = sprintf(
        '[ERROR] %s Impossible connection to the DB %s',
        (new DateTime())->format('Y-m-d H:i:s'),
        (string)$exception
        );
    fwrite($stderr, $log);
    var_dump($log);
    exit(0x000A1);
}

$articles = $connection->query('SELECT * FROM article ORDER BY pub_date DESC', PDO::FETCH_BOTH);
if (!$articles) {
    fwrite($stderr, implode(', ', $connection->errorInfo()));
    var_dump($connection->errorInfo());
    exit(0x000A2);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Articles</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        
        <style type="text/css">
            @import url('https://fonts.googleapis.com/css?family=Sedgwick+Ave+Display');
            
            .body{
                padding-top: 2em;
            }
            
            .title-design{
                font-family: 'Sedgwick Ave Display', cursive;
            }
            
            .project-box{
                margin-top: 15px;
                margin-bottom: 5px;
                border-top: 1px solid grey;
                border-left: 1px solid grey;
                box-shadow: 3px 3px 3px grey;
                border-radius: 10px;
                padding: 2em 0 2em 0;
            }
        </style>
    </head>
    <body class='container body'>
    	<h1 class='title-design'>Articles :</h1>
    
        <div class='container-fluid'>
        <?php
        
        foreach($articles->fetchAll() as $article) {
            echo '<!-- '.$article['date'].' -->';
            
            ?>
            <div class='project-box row'>
                <div class='col-xs-12 col-md-4'>
                    <img src='<?php echo $article['img']; ?>'/>
                </div>
                <div class='col-xs-12 col-md-8'>
                     <h4>'<?php echo $article['title'];  ?>'</h4>
                     <p>'<?php echo $article['description'];  ?>'</p>
                </div>
            </div>
            <?php
        }
        
        ?>
        </div>
    </body>
</html>
