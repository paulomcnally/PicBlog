<?php
function get_template( $filename )
	{
	$filepatch = $GLOBALS["f_template"] . $filename . $GLOBALS['ext'];
	if( file_exists( $filepatch ) )
		{
		require_once $filepatch;
		}
		else
			{
			die( show_message( "Archivo no incluido", "El archivo " . $filename . $GLOBALS['ext'] . " no se ha encontrado en el directorio de plantillas." ) );
			}
	}

function is_login()
	{
	if( isset( $_SESSION['access_token'] ) )
		{
		return true;
		}
		else
			{
			return false;
			}
	}

function singup()
	{
	$twitter = new stdClass();
	$twitter->screen_name = $GLOBALS['user']->screen_name;
	$twitter->name = $GLOBALS['user']->name;
	$twitter->profile_image_url = $GLOBALS['user']->profile_image_url;
	$twitter->location = $GLOBALS['user']->location;
	$twitter->url = $GLOBALS['user']->url;
	$twitter->profile_text_color = $GLOBALS['user']->profile_text_color;
	$twitter->profile_link_color = $GLOBALS['user']->profile_link_color;
	$twitter->profile_background_image_url = $GLOBALS['user']->profile_background_image_url;
	$twitter->id_str = $GLOBALS['user']->id_str;
	$GLOBALS['mysql']->query("CALL SP_ws_singup('".$GLOBALS['user']->screen_name."','".strip_tags(json_encode($twitter))."')");
	}

function get_photo_list( $shorturl )
	{
	return $GLOBALS['mysql']->results("SELECT P.pb_name, P.short_name, P.aid FROM albums A, photos P
WHERE A.shorturl = '".$shorturl."'
AND P.aid = A.aid");
	}

function get_photo( $shorturl )
	{
	return $GLOBALS['mysql']->row("SELECT P.pid, P.aid, P.pb_name, P.registered, (P.view_count+1) as view_count, A.name, A.screen_name, A.shorturl FROM photos P, albums A WHERE P.short_name = '".$shorturl."'
AND A.aid = P.aid");
	}

function add_view( $pid )
	{
	$GLOBALS['mysql']->query("UPDATE photos SET view_count = view_count + 1 WHERE pid = '".$pid."'");
	}

function get_album($shorturl)
	{
	return $GLOBALS['mysql']->row("SELECT * FROM albums WHERE shorturl = '".$shorturl."'");
	}

function get_my_albums_list( )
	{
	return $GLOBALS['mysql']->results("SELECT * FROM albums WHERE screen_name = '".$GLOBALS['user']->screen_name."'");
	}

function get_albums_list( $screen_name )
	{
	return $GLOBALS['mysql']->results("SELECT A.aid, A.name, A.registered, A.shorturl, (SELECT CONCAT('th_',P.pb_name) FROM photos P WHERE P.aid = A.aid ORDER BY P.registered DESC limit 1) AS tumbnails
FROM albums A
WHERE A.screen_name = '".$screen_name."'");
	}

function get_last_index($limit = 20)
	{
	return $GLOBALS['mysql']->results("SELECT A.aid, CONCAT('th_',P.pb_name) as pb_name, P.short_name, A.screen_name FROM photos P, albums A
WHERE A.aid = P.aid
ORDER BY P.registered DESC limit ".$limit);
	}

function get_popular_user( $limit = 6 )
	{
	return $GLOBALS['mysql']->results("SELECT screen_name, json FROM users ORDER BY RAND() LIMIT ".$limit);
	}

function is_my_album($aid)
	{
	$screen_name_album = $GLOBALS['mysql']->value("SELECT screen_name FROM albums WHERE aid = '".$aid."'");
	if( $screen_name_album == $GLOBALS['user']->screen_name )
		{
		return true;
		}
		else
			{
			return false;
			}
	}

function get_user_data($screen_name)
	{
	return json_decode( $GLOBALS['mysql']->value("SELECT json FROM users WHERE screen_name = '".$screen_name."'") );
	}

function shorturl($input) {
  $base32 = array (
    'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
    'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
    'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
    'y', 'z', '0', '1', '2', '3', '4', '5'
    );

  $hex = md5($input);
  $hexLen = strlen($hex);
  $subHexLen = $hexLen / 8;
  $output = array();

  for ($i = 0; $i < $subHexLen; $i++) {
    $subHex = substr ($hex, $i * 8, 8);
    $int = 0x3FFFFFFF & (1 * ('0x'.$subHex));
    $out = '';

    for ($j = 0; $j < 6; $j++) {
      $val = 0x0000001F & $int;
      $out .= $base32[$val];
      $int = $int >> 5;
    }

    $output[] = $out;
  }

  return $output[0];
}
?>