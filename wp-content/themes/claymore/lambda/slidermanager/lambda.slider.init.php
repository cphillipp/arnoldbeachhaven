<?php
#-----------------------------------------------------------------
# Dynamic Slide add
#-----------------------------------------------------------------
add_action('admin_head', 'lambda_slide_add_action');

function lambda_slide_add_action() { ?>

<script type="text/javascript" >

jQuery(document).ready(function($) {

/* ------------------------------------------------
Dynamic Slide Builder by UnitedThemes
------------------------------------------------ */
var total_slides = 0;
var latest_id = 1;	
			
//lets find the latest ID
$(".slider_item").each(function() {
var id = parseInt( this.id.split('_')[2], 10 );
				
if( id >= latest_id)
	latest_id = id + 1;
});			
			
//add item on click
$( ".add_slider_item").click(function() {
					
	//get slidername
	var slname = $(this).attr('name');
	var sltype = $(this).attr('title');
		
	//data for slide add function
	var data = {
		action: 'lambda_add_slide',
		slideid : latest_id,
		slidername : slname,
		slidertype : sltype
	};
	
	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	jQuery.post(ajaxurl, data, function(response) {
		$("#single-items").append(response);
	});
							
	//refresh sortable list
	$("#single-items").sortable('refresh');
					
	//increase id for next add
	latest_id++;
	return false;
	
});
});				
</script>
<?php
}


#-----------------------------------------------------------------
# Slide add callback
#-----------------------------------------------------------------
add_action('wp_ajax_lambda_add_slide', 'lambda_add_slide_callback');

function lambda_add_slide_callback() { 

$slider = $_POST['slidername'];
$slidertype = $_POST['slidertype'];
$key = 'slide_'.$_POST['slideid'];

?>

<div id="lambda_<?php echo $key; ?>" class="slider_item ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
					
<div class="slider-header ui-widget-header ui-corner-all">
	<span class='left btn btn-mini btn-success drop-icon'><i class='icon-chevron-up icon-white'></i></span>
	<?php _e('New Slide', 'claymore');?>
</div>
						
<div class="slider-content">

	<div class="lambda-opttitle">
			<div class="lambda-opttitle-pad">
					<?php _e("Choose an Image",'claymore'); ?>
			</div>
	</div>
	<div class="lambda_row section">
			<input id="<?php echo $key; ?>" type="text" name="lambda_slider_content[<?php echo $slider; ?>][slides][<?php echo $key; ?>][imgurl]" value="" />
			<button id="btn_<?php echo $key; ?>" class="lambda_upload_slider thickbox btn btn-mini btn-success"  title="<?php echo $key; ?>"><?php _e('upload', 'claymore'); ?></button>
	 </div>
	
	
	<?php if($slidertype == 'cameraslider') { ?>
	<div class="lambda-opttitle">
			<div class="lambda-opttitle-pad">
					<?php _e('or place an embedded video code', 'claymore'); ?>
			</div>
	</div>
	<div class="lambda_row section"> <span class="badge badge-info">
			<?php _e( 'You can also insert an image if using a video, this will be used as a poster!', 'claymore' ); ?>
			</span><br />
			<br />
			<textarea id="video_<?php echo $key; ?>" name="lambda_slider_content[<?php echo $slider; ?>][slides][<?php echo $key; ?>][video]"></textarea>
	</div>
	<?php } ?>
	
	
	<div class="lambda-opttitle">
			<div class="lambda-opttitle-pad">
					<?php _e('Caption Headline', 'claymore'); ?>
			</div>
	</div>
	<div class="lambda_row section">
			<input id="caption_text_<?php echo $key; ?>" type="text" name="lambda_slider_content[<?php echo $slider; ?>][slides][<?php echo $key; ?>][caption_text]" value="" />
			<br />
	</div>
	
	
	<div class="lambda-opttitle">
			<div class="lambda-opttitle-pad">
					<?php _e('Caption Text', 'claymore'); ?>
			</div>
	</div>
	<div class="lambda_row section">
			<textarea class="lambda_textarea" name="lambda_slider_content[<?php echo $slider; ?>][slides][<?php echo $key; ?>][caption_desc]"></textarea>
	</div>
	
	<?php 
								
	$alignvalues['default'] = 'left';
	$alignvalues['fullname'] = 'Caption Align';
	$alignvalues['keyvalues'] = 'left;right';
	$savetarget = "lambda_slider_content[".$slider."][slides][".$key."][caption_align]";
																
	render_lambda_radio($key, $alignvalues, $value['caption_align'], $slider, true, $savetarget); 
								
	?>	
	
	<div class="lambda-opttitle">
			<div class="lambda-opttitle-pad">
					<?php _e('Buttonlink', 'claymore'); ?>
			</div>
	</div>
	<div class="lambda_row section">
			<input id="caption_link_<?php echo $key; ?>" type="text" name="lambda_slider_content[<?php echo $slider; ?>][slides][<?php echo $key; ?>][caption_link]" value="<?php echo $value['caption_link']; ?>" />
			<br />
	</div>
	
	<?php if($slidertype == 'cameraslider') { ?>
	<div class="lambda-opttitle">
			<div class="lambda-opttitle-pad">
					<?php _e('Buttontext', 'claymore'); ?>
			</div>
	</div>
	<div class="lambda_row section">
			<input id="buttontext_<?php echo $key; ?>" type="text" name="lambda_slider_content[<?php echo $slider; ?>][slides][<?php echo $key; ?>][buttontext]" value="<?php echo $value['buttontext']; ?>" />
			<br />
	</div>
	<?php } ?>
	
	<button id="btn_del_<?php echo $key; ?>" class="lambda_delete_slide btn btn-mini btn-danger"  title="lambda_<?php echo $key; ?>">delete</button>

</div>
</div>
</div>

<?php 
die();
}

#-----------------------------------------------------------------
# Image Source Tab planed feature!
#-----------------------------------------------------------------
function lambda_slider_source_tab() { 
	
	$default = array(
    	'imgsource' 			=> array('default' 		=> 'custom',
							 			 'keyvalues' 	=> 'custom;category',
							 			 'keytype' 		=> 'select',
										 'fullname'		=> 'Image Source',
										 'description'	=> 'Choose your Image Source -> Custom = Own Imageset ->category = Set of Featured Images of the selected category')
										 
		
	);
	return $default;
}

#-----------------------------------------------------------------
# Slider Item Tab - for all sliders
#-----------------------------------------------------------------
function lambda_slider_item_array() { 
	
	$default = array(
    	
		'slide_1'	 			=> array('caption_text'		=> '',
							 			 'caption_link'		=> '',
							 			 'caption_desc'		=> '',
										 'video'			=> '',
										 'buttontext'		=> '',
										 'imgurl'			=> ''),
		
		'slide_2'	 			=> array('caption_text'		=> '',
							 			 'caption_link'		=> '',
							 			 'caption_desc'		=> '',
										 'video'			=> '',
 										 'buttontext'		=> '',
										 'imgurl'			=> ''),
										 
		'slide_3'	 			=> array('caption_text'		=> '',
							 			 'caption_link'		=> '',
							 			 'caption_desc'		=> '',
										 'video'			=> '',
 										 'buttontext'		=> '',
										 'imgurl'			=> '')
										 
		
	);
	return $default;
}
?>