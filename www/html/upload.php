<?php
require_once 'load.php';
?>
<?php if( !is_login() ): ?>
<?php header('Location: ./'); ?>
<?php exit(); ?>
<?php endif; ?>
<?php get_template('header'); ?>
<?php if( is_login() ): ?>
<?php $aid = ( isset( $_GET['aid'] ) && is_numeric( $_GET['aid'] ) ) ? $_GET['aid'] : NULL; ?>
<?php if( is_null( $aid ) ): ?>
	<?php $album_list = get_my_albums_list(); ?>
	<a id="newabtn" class="button" href="javascript:void(0);">Crear &Aacute;lbum</a>
    <?php if( is_array( $album_list ) ): ?>
    <a id="selabtn" class="button" href="javascript:void(0);">Seleccionar &Aacute;lbum</a> 
    <?php endif; ?>
    
    <div id="div_newabtn" style="display:none; cursor: default; padding:10px;"> 
    	<div style="font-weight:bold;">Escriba el nombre del &aacute;lbum.</div>
        <div><input style="width:245px;" type="text" id="name" name="name" /></div>
        <div style="font-weight:bold;">Escriba la descripci&oacute; del &aacute;lbum.</div>
        <div><textarea style="width:245px;" id="desc" name="desc"></textarea></div>
        <div>
        <input type="button" id="yes" value="Guardar" /> 
        <input type="button" id="no" value="Cancelar" /> 
        </div>
	</div>
   
   <div id="div_selabtn" style="display:none; cursor: default; padding:10px;"> 
    	<div style="font-weight:bold;">Seleccione el &aacute;lbum</div>
        <div>
        	<select id="mya" name="mya">
            	<option value="0">Seleccione</option>
            <?php if( count( $album_list ) ): ?>
            	<?php foreach( $album_list as $album ): ?>
                	<option value="<?php echo $album->aid; ?>"><?php echo $album->name; ?></option>
            	<?php endforeach; ?>
            <?php endif; ?>
        	</select>
        </div>
	</div>
    
    <script type="text/javascript">
	$(document).ready(function() { 
 
        $('#newabtn').click(function() {
            $.blockUI({ message: $('#div_newabtn'), css: { width: '275px' } }); 
        });
		
		$('#selabtn').click(function() {
            $.blockUI({ message: $('#div_selabtn'), css: { width: '275px' } }); 
        }); 
 
        $('#yes').click(function() { 
			var name = $("#name");
			var desc = $("#desc");
            // update the block message 
            $.blockUI({ message: "Guardando" }); 
 
            $.ajax({ 
				type: 'POST',
                url: 'ajax/album.add.php', 
				dataType: 'JSON',
				data: 'name='+name.val()+"&desc="+desc.val(),
				success: function(json)
					{
					if( json.status )
						{
						window.location = './upload.php?aid='+json.id;
						}
						else
							{
							alert(json.msg);
							}
					$.unblockUI();
					}
            }); 
        }); 
 
        $('#no').click(function() { 
            $.unblockUI(); 
            return false; 
        }); 
		
		$("#mya").change(function(e){
			if( $(this).val() > 0 )
				{
				window.location = './upload.php?aid=' + $(this).val();
				}
			});
 
    }); 
	</script>
<?php else: ?>
	<?php if( is_my_album( $aid ) ): ?>

	<script type="text/javascript">
		$(document).ready(function(e) {
            $("#btnMyAlbums").click(function(e){
			window.location = "./<?php echo $GLOBALS['user']->screen_name; ?>";
		});
        });
		
		
		var upload1, upload2;

		window.onload = function() {
			upload1 = new SWFUpload({
				// Backend Settings
				upload_url: "up.php",
				post_params: {"PHPSESSID" : "<?php echo session_id(); ?>",
								"aid" : "<?php echo $aid; ?>"},

				// File Upload Settings
				file_size_limit : "102400",	// 100MB
				file_types : "*.jpg; *.jpeg; *.jpe; *.png; *.gif",
				file_types_description : "Fotos",
				file_upload_limit : "100",
				file_queue_limit : "0",

				// Event Handler Settings (all my handlers are in the Handler.js file)
				file_dialog_start_handler : fileDialogStart,
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,

				// Button Settings
				button_image_url : "style/images/upbtn.png",
				button_placeholder_id : "spanButtonPlaceholder1",
				button_width: 61,
				button_height: 22,
				
				// Flash Settings
				flash_url : "swfupload.swf",
				

				custom_settings : {
					progressTarget : "fsUploadProgress1",
					cancelButtonId : "btnCancel1"
				},
				
				// Debug Settings
				debug: false
			});
	     }
	</script>
<div id="page_left">
<div class="fieldset flash" id="fsUploadProgress1">
	<span class="legend">Proceso de subida de fotos</span>
</div>
<div style="padding-left: 5px;">
	<span id="spanButtonPlaceholder1"></span>
	<input id="btnCancel1" type="button" value="Cancel Uploads" onclick="cancelQueue(upload1);" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;" />
    <input id="btnMyAlbums" type="button" value="Ir a mis albums" style="margin-left: 2px; height: 22px; font-size: 8pt;" />
	<br />
</div>
</div>
<div id="page_right">
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
	<?php else: ?>
    	<?php header("Location: ./upload.php"); ?>
        <?php exit(); ?>
    <?php endif; ?>

<?php endif; ?>

<?php endif; ?>
<?php get_template('footer'); ?>