<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>PicBlog - Comparte fotos en Twitter</title>
<link rel="stylesheet" type="text/css" href="style/style.css?v1.0" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.blockUI.js"></script>
<script type="text/javascript" src="swfupload.js"></script>
<script type="text/javascript" src="js/swfupload.queue.js"></script>
<script type="text/javascript" src="js/fileprogress.js"></script>
<script type="text/javascript" src="js/handlers.js"></script> 
<script src="http://platform.twitter.com/anywhere.js?id=WTqzgkcLUa6EXOuBslRiw&v=1" type="text/javascript"></script>

<link rel="shortcut icon" href="style/images/favicon.ico" />
</head>

<body>
<div id="header">
<?php if( is_login() ): ?>
	<div id="nav-auth">
    	<div id="nav-upload">
        	<a href="upload.php" target="_self">
            	<img src="http://i933.photobucket.com/albums/ad179/mcnallydevelopers/cdn/but_es.jpg" alt="Upload">
            </a>
        </div>
        <div id="nav-user">
        	<div id="nav-user-avatar">
            	<img width="38" height="38" src="<?php echo $GLOBALS['user']->profile_image_url; ?>" alt="Profile Picture" />
            </div>
            <div id="nav-links">
            <h1><?php echo $GLOBALS['user']->name; ?></h1>
            <a href="./" class="nav-link" target="_self">Inicio</a>
            <a href="./<?php echo $GLOBALS['user']->screen_name; ?>" class="nav-link" target="_self">Albums</a>
            <a href="http://twitter.com/<?php echo $GLOBALS['user']->screen_name; ?>" class="nav-link" target="_blank">@<?php echo $GLOBALS['user']->screen_name; ?></a>
            <a href="./clearsessions.php" class="nav-link" style="float:right;" target="_self">Salir</a>
            </div>
        </div>
        
       
    </div>
<?php else: ?>
     <div id="nav-login"><a href="singup.php" target="_self"><img src="style/images/lighter.png" alt="Login" /></a></div>
<?php endif; ?>
</div>
<div id="wrapper"><div class="content">