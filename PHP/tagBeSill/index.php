<?php 
    // Articles : id, pub_date, img, title, description
    $articles = [
        [
            'id' => 1,
            'pub_date' => '2018-06-21 11:43:12',
            'img' => 'img/myPicture1.png',
            'title' => 'Title 1',
            'description' => 'Lorem ipsum sit amet'
        ],
        [
            'id' => 2,
            'pub_date' => '2018-06-22 09:33:17',
            'img' => 'img/myPicture2.png',
            'title' => 'Title 2',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse gravida orci sit amet tellus egestas, sed euismod leo dapibus. Sed faucibus arcu id purus malesuada volutpat. Vivamus rhoncus ornare tellus, eu porta purus lacinia eu viverra fusce.'
        ]
    ];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tag be sill home page</title>
    </head>
    <body>
    	<h1>Tag be sill</h1>
    	
    	<p style="font-weight: bold;color: red;">
    		Please, create an account on opse.cscfa.fr
    	</p>
    	
    	<table>
    		<thead>
    			<tr>
    				<th>&nbsp;</th>
    				<th>Title</th>
    				<th>Publication date</th>
    				<th>Description</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php 
    			     foreach ($articles as $article) {
    			         $img = $article['img'];
    			         $title = $article['title'];
    			         $pubDate = $article['pub_date'];
    			         $desc = $article['description'];
    			         
    			         if (strlen($desc) > 200) {
    			             $desc = substr($desc, 0, 197) . '...';
    			         }
    			         
		         ?>
		         <tr>
		         	<td><img src="<?php echo $img;?>" style="width:50px;"/></td>
		         	<td><?php echo $title;?></td>
		         	<td><?php echo $pubDate;?></td>
		         	<td><?php echo $desc;?></td>
		         </tr>
		         <?php
    			     }
    			?>
    		</tbody>
    	</table>
    </body>
</html>
