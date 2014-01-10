<?php

/*
 * dynamic Slider shortcodes
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since framework v 2.0
 */

class lambda_slider_shortcode {
	
	static $add_script;
	
	function init() {
		add_shortcode('lambdaslider', array(__CLASS__, 'handle_slider_shortcode'));
	}
		
	function handle_slider_shortcode($atts) {
		extract(shortcode_atts(array( "id" => '' ), $atts));
		global $wpdb, $lambda_meta_data;
		
		$sitelayout = $lambda_meta_data->get_the_value('sitelayout');
		
		$table_prefix = lambda_get_table_prefix();
		$table_lambda_sliders = $table_prefix . "lambda_sliders";	
		
		$slider_result = $wpdb->get_row('SELECT * FROM ' . $table_lambda_sliders . ' WHERE id =' . $id);
				
		if (!$slider_result) return;
						
		switch($slider_result->slidertype) {
						
			case 'flexslider':
				 //Flexslider CSS
				 wp_enqueue_style('flexslider', THEME_WEB_ROOT.'/css/flexslider.css', 'theme', '1.8');
				 //JS
				 wp_enqueue_script('flexslider',THEME_WEB_ROOT ."/javascripts/jquery.flexslider.min.js",array('jquery'),'1.8',true);
				 //dynamic JS
				 wp_register_script('lambda_script_'.$id.'.js', THEME_WEB_ROOT . '/javascripts/slider.init.php?id='.$id, array('jquery'));
				 wp_enqueue_script('lambda_script_'.$id.'.js');
				 
				 //Return Flexslider's HTML
				return getFlexHTML($slider_result);	
							 
			break;
			
						
			case 'cameraslider':
				//CameraSlider CSS
				wp_enqueue_style('cameraslider', THEME_WEB_ROOT.'/css/cameraslider.css', 'theme', '1.0');
				
				//JS
				wp_register_script('cameraslider', THEME_WEB_ROOT . '/javascripts/camera.min.js', array('jquery'));
				wp_print_scripts('cameraslider');
				
				wp_register_script('cameraslidermob', THEME_WEB_ROOT . '/javascripts/jquery.mobile.customized.min.js', array('jquery'));
				wp_print_scripts('cameraslidermob');
				
				//dynamic JS
				wp_register_script('lambda_script_'.$id.'.js', THEME_WEB_ROOT . '/javascripts/slider.init.php?id='.$id, array('jquery'));
				wp_enqueue_script('lambda_script_'.$id.'.js');
				
				//Return Cycle's HTML
				return getCameraHTML($slider_result);
				
			break;
			
			
			case 'supersized':
				
				if(get_option_tree('sitelayout') == 'boxed' || $sitelayout == 'boxed') {
					
					//Supersized's CSS
					wp_enqueue_style('supersized-css', THEME_WEB_ROOT.'/css/supersized.css', 'theme', '3.2.7', 'screen, projection');
					wp_enqueue_style('supersized-shutter-css', THEME_WEB_ROOT.'/css/supersized.shutter.css', 'theme', '3.2.7', 'screen, projection');
	
					//JS
					wp_register_script('supersized.3.2.6.min.js', THEME_WEB_ROOT . '/javascripts/supersized.3.2.7.min.js', array('jquery'));
					wp_print_scripts('supersized.3.2.6.min.js');
					
					wp_register_script('supersized.shutter.min.js', THEME_WEB_ROOT . '/javascripts/supersized.shutter.min.js', array('jquery'));
					wp_print_scripts('supersized.shutter.min.js');
					
					//dynamic JS
					wp_register_script('lambda_script_'.$id.'.js', THEME_WEB_ROOT . '/javascripts/slider.init.php?id='.$id, array('jquery'));
					wp_print_scripts('lambda_script_'.$id.'.js');
					
					//Return supersized into global
					return getSupersizedHTML($slider_result);
				
				}
				
			break;			
		}		
	}
}
lambda_slider_shortcode::init();
?>