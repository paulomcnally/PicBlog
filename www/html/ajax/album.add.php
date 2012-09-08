<?php
require_once '../load.php';

?>
<?php if( is_login() ): ?>
	<?php $name = ( isset( $_POST['name'] ) && !empty( $_POST['name'] ) ) ? $GLOBALS['mysql']->escape( $GLOBALS['mysql']->html( $_POST['name'] ) ) : NULL; ?>
    <?php $desc = ( isset( $_POST['desc'] ) && !empty( $_POST['desc'] ) ) ? $GLOBALS['mysql']->escape( $GLOBALS['mysql']->html( $_POST['desc'] ) ) : NULL; ?>
    <?php $short = shorturl( $GLOBALS['user']->screen_name . date('Y-m-d H:i:s') ); ?>
    <?php if( is_null( $name ) ): ?>
    	<?php die('{"status":false,"msg":"No ha escrito el nombre del &aacute;lbum"}'); ?>
    <?php else: ?>
    	<?php $GLOBALS['mysql']->query("CALL SP_ws_add_album('".$name."','".$desc."','".$short."','".$GLOBALS['user']->screen_name."',@id)"); ?>
        <?php $id = $GLOBALS['mysql']->value("SELECT @id"); ?>
        <?php die('{"status":true,"id":'.$id.'}'); ?>
    <?php endif; ?>
    
<?php else: ?>
	<?php die('{"status":false,"msg":"No ha iniciado sesi&oacute;n"}'); ?>
<?php endif; ?>