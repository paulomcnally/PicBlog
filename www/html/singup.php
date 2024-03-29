<?php
require_once 'load.php';

/* Build TwitterOAuth object with client credentials. */
$connection = new TwitterOAuth($tw_consumer_key, $tw_consumer_secret);
 
/* Get temporary credentials. */
$request_token = $connection->getRequestToken($tw_oauth_callback);

/* Save temporary credentials to session. */
$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
 
/* If last connection failed don't display authorization link. */
switch ($connection->http_code) {
  case 200:
    /* Build authorize URL and redirect user to Twitter. */
    $url = $connection->getAuthorizeURL($token);
    header('Location: ' . $url); 
	exit();
    break;
  default:
    /* Show notification if something went wrong. */
    echo 'No se pudo conectar a Twitter, refresque la p&aacute;gina.';
}
