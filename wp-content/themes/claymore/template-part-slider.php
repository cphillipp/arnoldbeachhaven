<?php

/**
 * Templatepart for Slideroutput
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 2.0
 */

global $wpdb;

$slides = lambda_return_meta('slider');
		
	if(isset($slides['sliderstyle_type']) && ( !( is_archive() || is_search() ) || is_shop() ) ) {
		
		if($slides['sliderstyle_type'] == 'static_image') {
			
			echo '<div id="lambda-featured-header-wrap"><div id="lambda-featured-header">
					<figure class="lambda-featured-header-image">';
			
			//optional url	
			$url = (isset($slides['static_image_url'])) ? $slides['static_image_url'] : '#';	
			echo (isset($slides['static_image']) && $url != '#') ? '<a href="'.$url.'"><img src="'.$slides['static_image'].'" /></a>': '<img src="'.$slides['static_image'].'" />';	
					
			//optional Caption		
			echo (isset($slides['static_image_caption'])) ? '<figcaption class="lambda-featured-header-caption"><span>'.lambda_translate_meta($slides['static_image_caption']).'</span></figcaption>' : '';
					
			echo '</figure></div></div>';		
			
		}
		
		
		if($slides['sliderstyle_type'] == 'static_video') {
			echo '<div id="lambda-featured-header-wrap"><div class="container clearfix"><div class="sixteen columns clearfix">';	
				post_format_video($slides, "fh1");
			echo '</div></div></div>';
				
		}
		
		if($slides['sliderstyle_type'] == 'static_textvideo') {
			echo '<div id="lambda-featured-header-wrap">
					<div class="container clearfix">
						<div class="sixteen columns clearfix" style="padding:20px 0;">';	
						
						echo '<div class="lambda-featured-header-content one_half">
								<h1 style="color:'.$slides['featured_headline_color'].';">'.lambda_translate_meta($slides['featured_headline']).'</h1>
								<p style="color:'.$slides['featured_text_color'].';">'.do_shortcode(lambda_translate_meta($slides['featured_text'])).'</p>';
								
								if($slides['featured_buttontext'])
								echo '<a class="theme-button medium excerpt" href="'.$slides['featured_link'].'">'.lambda_translate_meta($slides['featured_buttontext']).'</a>';
											
						
						echo '</div><div class="lambda-featured-header-video one_half last"><div class="video-frame">';	
						post_format_video($slides, "fh1");
						echo '</div></div>
					</div>
					</div>
			</div>';
				
		}
		
		
		if($slides['sliderstyle_type'] == 'static_slider' && !empty( $slides['main_slider'] ) ) {
			
			$sliderinfo = explode('_',$slides['main_slider']);
			
			//add exception for supersized this one needs to be called in another place
			$table_lambda_sliders = $wpdb->base_prefix . "lambda_sliders"; 
			$supersized = $wpdb->get_var("SELECT slidertype FROM $table_lambda_sliders WHERE id = $sliderinfo[1]");	
			
			if($supersized != 'supersized' || $sliderinfo[0] == 'revslider')	
			lambda_main_slider($slides); // this function can be found in theme-functions.php around line 198
			
		}

	}
	
?>