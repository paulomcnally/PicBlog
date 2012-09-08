<?php
require_once 'load.php';
$screen_name = ( isset( $_GET['screen_name'] ) && !empty( $_GET['screen_name'] ) ) ? $GLOBALS['mysql']->escape( $_GET['screen_name'] ) : NULL;
?>
<?php get_template('header'); ?>
<?php if( !is_null( $screen_name ) ): ?>
	<?php $my_albums_list = get_albums_list( $screen_name ); ?>
    <?php if( is_null( $my_albums_list ) ): ?>
    	<h1 style="font-size:14;" align="center">
    	<?php echo "El usuario " . $screen_name . " no tiene ning&uacute;n &aacute;lbum de fotos."; ?>
        </h1>
    <?php else: ?>
   		<?php $user_data = get_user_data( $screen_name ); ?>
    	<div id="page_left">
    		<div class="album_preview">
    	<?php foreach( $my_albums_list as $my_albums): ?>
        	<div class="container">
            	<div class="title"><?php echo $my_albums->name; ?></div>
                <?php if( !empty( $my_albums->tumbnails ) ): ?>
                <a href="<?php echo "./a_".$my_albums->shorturl; ?>" target="_self"><img src="<?php echo vsprintf( $global->pb_url, array( $screen_name, $GLOBALS['global']->prefix.$my_albums->aid, $my_albums->tumbnails ) ); ?>" alt="Tumbnails" /></a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        	</div>
        </div>
        <div id="page_right">
        	<div class="profile">
            	<div class="photo">
            	<img width="70" height="70" src="<?php echo str_replace("normal","reasonably_small",$user_data->profile_image_url) ?>" alt="Profile Pic" />
                </div>
                <div class="desc">
                	<h1 style="font-size:12px; margin:0; padding:0;"><?php echo $user_data->name; ?></h1>
                    <a class="nav-link" href="https://twitter.com/<?php echo $user_data->screen_name; ?>" target="_blank">@<?php echo $user_data->screen_name; ?></a>
                </div>
            </div>
        	<div class="adsense">
            	<script type="text/javascript"><!--
				google_ad_client = "ca-pub-9262159992567637";
				/* Picblog Right */
				google_ad_slot = "0314713387";
				google_ad_width = 250;
				google_ad_height = 250;
				//-->
				</script>
				<script type="text/javascript"
				src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
				</script>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>
<?php get_template('footer'); ?>