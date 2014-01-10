<?php

/*
 * dynamic Slider JavaScript Generator
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since framework v 2.0
 */
 
header ("Content-Type:	application/javascript; charset=utf-8");
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];

// Access to WordPress
require_once( $path_to_wp . '/wp-load.php' );
$themepath = get_template_directory_uri();

$SlideID = $_GET['id'];
global $wpdb;

$table_prefix = lambda_get_table_prefix();
$table_lambda_sliders = $table_prefix . "lambda_sliders";

$slidedata = $wpdb->get_row('SELECT * FROM ' . $table_lambda_sliders . ' WHERE id =' . $SlideID); 
$slidercontent = maybe_unserialize( $slidedata->slider_content );

if( !empty($slidercontent) ) {
		
	$newsystem = true;
	$options = $slidercontent[ $slidedata->option_name ];
	
} elseif( is_array( get_option($slidedata->option_name) ) ) {
	
	$oldsystem = true;
	$options = get_option( $slidedata->option_name );
			
}	


$theme_options = get_option('option_tree');

#-----------------------------------------------------------------
# FlexSlider JS Output
#-----------------------------------------------------------------
?>

<?php if($slidedata->slidertype == "flexslider") { ?>
(function($){
	$(document).ready(function(){
		$('.flexslider_<?php echo $SlideID; ?>').flexslider({		
		<?php 
		$flexslideroptions = flexslider_form_array(); 
		foreach ($flexslideroptions as $key => $option) {
			if($option['js'] == "char") {
				echo $key.':"'.$options[$key]."\", \n";		
			} else {
				echo $key.':'.$options[$key].", \n";		
			}
		} ?>
		})
	})
})(jQuery);
<?php } ?>


<?php
#-----------------------------------------------------------------
# Supersized JS Output
#-----------------------------------------------------------------
?>

<?php if($slidedata->slidertype == "supersized") { ?>

(function($){
	
	$(document).ready(function(){
		
		$.supersized({		
		<?php 
		$supersizedoptions = supersized_form_array();
		foreach ($supersizedoptions as $key => $option) {
			if(isset($option['js']) && $option['js'] == "char") {
				
				echo $key.':"'.$options[$key]."\", \n";		
				
			} elseif(isset($option['js']) && $option['js'] == "bolean") {
			
				($options[$key] == 'true') ? $value = '1' : $value = '0';
				echo $key.':'.$value.", \n"; 	
			
			} else {
				
				echo $key.':'.$options[$key].", \n";		
			}
		} 
		?>
				
		<?php
		#-----------------------------------------------------------------
		# create Slides
		#-----------------------------------------------------------------
		if(is_array($options['slides'])):
					
			$javaoutput = 'slides	:	[';
			foreach($options['slides'] as $slide) {
				
				
				$imgurl = (isset($slide['imgurl'])) ? $slide['imgurl'] : ''; 
				$caption_text = (isset($slide['caption_text'])) ? $slide['caption_text'] : ''; 
				$caption_link = (isset($slide['caption_link'])) ? $slide['caption_link'] : ''; 

				
						
				$javaoutput.='{image :"'.$imgurl.'", title:"'.$caption_text.'", thumb :"'.$imgurl.'", url :"'.$caption_link.'"},';
				
				if(!empty($caption)) { 
					$html.='<p class="flex-caption">'.$slide['caption_desc'].'</p>'; }
				}	
					
				$javaoutput = substr($javaoutput, 0, -1); 
				$javaoutput.= ']';						
					
				echo $javaoutput;
					
		endif; ?>
		
		});
	
	});
	
})(jQuery);
	
<?php } ?>


<?php 
#-----------------------------------------------------------------
# Camera JS Output
#-----------------------------------------------------------------
if($slidedata->slidertype == "cameraslider") { 

global $theme_options; ?>

(function($){
	
	$(document).ready(function(){
		
        <?php if(isset($theme_options['activate_prettyphoto']) && $theme_options['activate_prettyphoto'] == 'on')	{ ?>
        
		$('.caption_play').click(function(){
						
			//finally pause the camera slider
			$('.cameraslider_<?php echo $SlideID; ?>').cameraPause();
			
		}).find('a').prettyPhoto({
			overlay_gallery: false,
			default_width: 960,
			default_height: 540,
			callback: function(){
				$('.cameraslider_<?php echo $SlideID; ?>').cameraPlay();
			}
		});	
		
		<?php } else { ?>
        
        $('.caption_play').click(function(){
						
			//finally pause the camera slider
			$('.cameraslider_<?php echo $SlideID; ?>').cameraPause();
			
		});       
        
        <?php } ?>
		
		$('.cameraslider_<?php echo $SlideID; ?>').camera({		
		loaderColor : '<?php echo get_option_tree( 'color_scheme'); ?>',
		<?php 
		$slideroptions = camera_form_array(); 
		foreach ($slideroptions as $key => $option) {
			if(isset($option['js']) && $option['js'] == "char") {
				echo $key.':"'.$options[$key]."\", \n";		
			} else {
				echo $key.':'.$options[$key].", \n";		
			} 
		} ?>
		})
	})
	
})(jQuery);
<?php } ?>