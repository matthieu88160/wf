<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Insert title here</title>
    </head>
    <body>
    	<h1>My super page</h1>
    	
    	<p>
    		The actual time is 
    		<?php 
    		
    		echo (new DateTime())->format('Y-m-d H:i:s');
    		
    		?>
    	</p>
    </body>
</html>
