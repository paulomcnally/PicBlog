<?php
require_once 'load.php';
$shorturl = ( isset( $_GET['shorturl'] ) && !empty( $_GET['shorturl'] ) ) ? $GLOBALS['mysql']->escape( $_GET['shorturl'] ) : NULL;
?>
<?php get_template('header'); ?>
<?php if( !is_null( $shorturl ) ): ?>
	<?php $album = get_album( $shorturl ); ?>
	<?php $photo_list = get_photo_list( $shorturl ); ?>
    <?php if( is_null( $photo_list ) ): ?>
    	<h1 style="font-size:14;" align="center">
    	<?php echo "No existen fotos en este &aacute;lbum."; ?>
        </h1>
    <?php else: ?>
    	<div id="page_left">
    		<div class="album_preview">
    	<?php foreach( $photo_list as $photo ): ?>
        	<div class="container">
                <?php if( !empty( $photo->pb_name ) ): ?>
                <a href="<?php echo "./p_".$photo->short_name; ?>" target="_self"><img src="<?php echo vsprintf( $global->pb_url, array( $album->screen_name, $GLOBALS['global']->prefix.$photo->aid, "th_" . $photo->pb_name ) ); ?>" alt="Tumbnails" /></a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        	</div>
        </div>
        <div id="page_right">
        	<div class="profile">
                <div class="desc">
                	<input type="text" name="shorturl" style="width:240px;cursor:text;" value="<?php echo $GLOBALS['global']->url . "a_" . $shorturl; ?>"  readonly="readonly"/>
                    <h1><a class="nav-link" href="./<?php echo $album->screen_name; ?>"><img src="http://i933.photobucket.com/albums/ad179/mcnallydevelopers/cdn/return.png" align="absmiddle" /> &nbsp; Volver a <?php echo $album->screen_name; ?></a></h1>
                	<h1><img src="http://i933.photobucket.com/albums/ad179/mcnallydevelopers/cdn/album.png" align="absmiddle" /> &nbsp; <?php echo $album->name; ?></h1>
                    <h1><img src="http://i933.photobucket.com/albums/ad179/mcnallydevelopers/cdn/date.png" align="absmiddle" /> &nbsp; <?php echo $album->registered; ?></h1>
                    <h1><img src="http://i933.photobucket.com/albums/ad179/mcnallydevelopers/cdn/description.png" align="absmiddle" /> &nbsp; <?php echo $album->description; ?></h1>
                    <h1><a class="nav-link" href="http://twitter.com/<?php echo $album->screen_name; ?>" target="_blank"><img src="http://i933.photobucket.com/albums/ad179/mcnallydevelopers/cdn/twitter-2.png" align="absmiddle" /> &nbsp; @<?php echo $album->screen_name; ?></a></h1>
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