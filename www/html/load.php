<?php

session_start();

$base = dirname(__FILE__) . DIRECTORY_SEPARATOR;

$f_core = $base . "core" . DIRECTORY_SEPARATOR;

$f_template = $base . "template" . DIRECTORY_SEPARATOR;

$ext = ".php";



$db_host = '';

$db_user = '';

$db_pass = '';

$db_name = '';



$tw_consumer_key = 'WTqzgkcLUa6EXOuBslRiw'; // http://dev.twitter.com

$tw_consumer_secret = 'yZDxWQYesxbOWtFHgbANlHjHgHZywpv7C3QjNkJx8'; // http://dev.twitter.com

$tw_oauth_callback = 'http://picblog.me/callback.php';



require_once $f_core.'mysql.php';

require_once $f_core.'twitteroauth.php';

require_once $f_core.'functions.php';



if( is_login() )

	{

	$access_token = $_SESSION['access_token'];

	$connection = new TwitterOAuth($tw_consumer_key, $tw_consumer_secret, $access_token['oauth_token'], $access_token['oauth_token_secret']);

	$user = $connection->get('account/verify_credentials');

	singup();

	}



$global = json_decode( $mysql->value( "SELECT `value` FROM options WHERE `key`= 'global'" ) );

?>