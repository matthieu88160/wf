<?php
require dirname(__DIR__).'/vendor/autoload.php';
use Ramsey\Uuid\Uuid;

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function generateToken(&$uuid, &$tag) : string {
    $cipher = "aes-256-gcm";
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
    $uuid = Uuid::uuid1();
    
    return openssl_encrypt($uuid, $cipher, gethostname(), OPENSSL_ZERO_PADDING, $iv, $tag);
}

function tokenKeepAlive() {
    $current = new DateTime();
    $alive = [];
    foreach ($_SESSION['csrf_tokens'] as $uuid => $infos) {
        if ($infos['valid_period'] > $current) {
            $alive[$uuid] = $_SESSION['csrf_tokens'][$uuid];
        }
    }
    
    $_SESSION['csrf_tokens'] = $alive;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $token = generateToken($uuid, $tag);
    $tokenLimit = 120;
    
    if (!isset($_SESSION['csrf_tokens'])) {
        $_SESSION['csrf_tokens'] = [];
    } else if (count($_SESSION['csrf_tokens']) > $tokenLimit) {
        $_SESSION['csrf_tokens'] = array_slice($_SESSION['csrf_tokens'], count($_SESSION['csrf_tokens'])-$tokenLimit, $tokenLimit, true);
    }
    
    tokenKeepAlive();
    
    $_SESSION['csrf_tokens'][(string)$uuid] = [
        'uuid' => (string)$uuid,
        'tag' => $tag,
        'valid_period' => new DateTime('now +1hour')
    ];
}

session_write_close();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Adding a project</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <style type="text/css">
            @import url('https://fonts.googleapis.com/css?family=Sedgwick+Ave+Display');
            
            .body{
                padding-top: 2em;
            }
            
            .title-design{
                font-family: 'Sedgwick Ave Display', cursive;
            }
            
            .center-content, .cc{
				display: flex;
				justify-content: center;
            }
        </style>
	</head>
	<body class="container">
		<h1 class="title-design">Add a project :</h1>
		
		<form method="GET" action="addpage.php">
			<div class="form-group">
			    <label for="addProject_title">Tip a title for your project</label>
			    <input class="form-control" type="text" name="addProject_title"></input>
			</div>
			
			<div class="form-group">
			    <label for="addProject_description">Define a description for your project</label>
			    <textarea class="form-control" name="addProject_description"></textarea>
			</div>
		
			<div class="form-group">
			    <label for="addProject_image">Choose an image for your project</label>
			    <input class="form-control" type="file" name="addProject_image"></textarea>
			</div>
		
		    <input type="hidden" name="addProject_csrf_token" value="<?php echo $token ?? ''; ?>"
		    />
		
			<div class="form-group cc">
		    	<button class="btn btn-default" type="submit">Submit</button>
			</div>
		</form>
	</body>
</html>
