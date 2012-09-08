<?php
require_once 'load.php';
$last_index = get_last_index();
$popular_user = get_popular_user();
?>
<?php get_template('header'); ?>
<div id="page_left" style="width:360px;">
	<div class="icontainer">
	<h1>Fotos recientes</h1>
    <div>
    <?php if( count( $last_index ) > 0 ): ?>
    	<?php foreach( $last_index as $last ): ?>
        <a href="<?php echo "./p_".$last->short_name; ?>" target="_self">
       	<img width="76" height="76" style="margin:3px;" src="<?php echo vsprintf( $global->pb_url, array( $last->screen_name, $GLOBALS['global']->prefix.$last->aid, $last->pb_name ) ); ?>" alt="Tumbnails" />
        </a>
    	<?php endforeach; ?>
    <?php endif; ?>
    </div>
	</div>
</div>
<div id="page_right" style="width:550px;">
	<!-- Login or Upload -->
	<div class="icontainer">
	<?php if( is_login() ): ?>
		<a class="ibuton" href="./upload.php" target="_self">Subir Fotos</a>
	<?php else: ?>
		<a class="ibuton" href="./singup.php" target="_self">Acceder</a>
	<?php endif; ?>
	</div>
    <!-- Adsense -->
    <div class="icontainer" align="center">
    <script type="text/javascript"><!--
		google_ad_client = "ca-pub-9262159992567637";
		/* PicBlog Index Horizontal */
		google_ad_slot = "0800900219";
		google_ad_width = 468;
		google_ad_height = 60;
		//-->
	</script>
	<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
    </div>
    <!-- Usuarios destacados -->
    <div class="icontainer">
        <div id="popular-user">
        <?php if( count( $popular_user ) > 0 ): ?>
    	<?php foreach( $popular_user as $popular ): ?>
        <?php $popular_user_info = json_decode( $popular->json ); ?>
        	<a class="twitter-anywhere-user" href="<?php echo "./".$popular->screen_name; ?>" target="_self">
       		<img width="76" height="76" title="<?php echo $popular->screen_name; ?>" style="margin:3px;" src="<?php echo $popular_user_info->profile_image_url; ?>" alt="Tumbnails" />
        	</a>
    	<?php endforeach; ?>
    <?php endif; ?>
        </div>
        <script type="text/javascript">
 twttr.anywhere(function (T) {
    T("#popular-user img").hovercards({
        username : function(node) {
            return node.title;
        }
    });
});
</script>
	</div>
</div>


<?php if( is_login() ): ?>

<?php endif; ?>
<?php get_template('footer'); ?>