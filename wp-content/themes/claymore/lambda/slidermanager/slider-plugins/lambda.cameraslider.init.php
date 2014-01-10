<?php

/*
 * Camera Slider Java & HTML Markup 
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since framework v 2.0
 */

#-----------------------------------------------------------------
# Camera Slider HTML Output
#-----------------------------------------------------------------
if ( !function_exists( 'getCameraHTML' ) ) {

	function getCameraHTML($slider_result) { 
		
		$slidercontent = lambda_prepare_load($slider_result->slider_content);	

		if( !empty($slidercontent) ) {
				
			$options = $slidercontent[ $slider_result->option_name ];
		
		} elseif( is_array( get_option($slider_result->option_name) ) ) {
			
			$options = get_option( $slider_result->option_name );
			
		}	
						
		$html = '<div class="clearfix ut-slider-wrap"><div class="camera_white_skin cameraslider_'.$slider_result->id.' camera_wrap">';
			
		$z = 0;		
		if(is_array($options['slides'])):
		foreach($options['slides'] as $slide) {
	
			if($slide['imgurl'])			
			$html.='<div data-thumb="'.aq_resize( $slide['imgurl'], 50, 50, true ).'" data-src="'.$slide['imgurl'].'">';
			
			if(!$slide['imgurl'])
			$html.='<div data-src="'.THEME_WEB_ROOT.'/images/blank.gif">';
			
			if($slide['video']) {
				
				$content_output =  $slide['video'];
				
				$html.= '<div class="caption_play"><a data-rel="prettySlider" href="'.extractURL($content_output).'">PLAY</a></div>';
							
			}
			
			if(($slide['caption_desc'] || $slide['caption_text'])){
				
				$caption_text =  $slide['caption_text'];
				
				$html.= '<div class="camera_caption fadeIn"><div class="container"><div class="claymore-caption '.$slide['caption_color'].' '.$slide['caption_align'].'"><h2>'.$caption_text.'</h2>';
			}
			
			if($slide['caption_desc']) {
				
				$caption_desc =  $slide['caption_desc'];								
				
				$html.= '<p>'.$caption_desc.'</p>';					
			}
			
			if($slide['buttontext'])
			$html.='<a href="'.$slide['caption_link'].'" class="excerpt">'.$slide['buttontext'].'</a>';
			
			if(($slide['caption_desc'] || $slide['caption_text']))			
			$html.= '</div></div></div>';			
			
			$html.='</div>';
			
			
			$z++;		
		}		
		endif;
		
		$html.= '</div></div>';
		
		return $html;
	}

}



function camera_form_array() { 	
	
	$default = array(
    	'fx'		 			=> array('default' 		=> 'random',
							 			 'keyvalues' 	=> 'random;simpleFade;curtainTopLeft;curtainTopRight;curtainBottomLeft;curtainBottomRight;curtainSliceLeft;curtainSliceRight;blindCurtainTopLeft;blindCurtainTopRight;blindCurtainBottomLeft;blindCurtainBottomRight;blindCurtainSliceBottom;blindCurtainSliceTop;stampede;mosaic;mosaicReverse;mosaicRandom;mosaicSpiral;mosaicSpiralReverse;topLeftBottomRight;bottomRightTopLeft;bottomLeftTopRight;bottomLeftTopRight;scrollLeft;scrollRight;scrollHorz;scrollBottom;scrollTop',
							 			 'keytype' 		=> 'select',
										 'js' 			=> 'char',
										 'fullname'		=> __('Transition Effect', 'claymore'),
										 'description'	=> __('Select your transition effect type', 'claymore')),		
		
		
	   	'easing'	 			=> array('default' 		=> 'easeInQuad;',
							 			 'keyvalues' 	=> 'linear;swing;easeInQuad;easeOutQuad;easeInOutQuad;easeInCubic;easeOutCubic;easeInOutCubic;easeOutQuart;easeInOutQuart;easeInQuint;easeOutQuint;easeInOutQuint;easeInSine;easeOutSine;easeInOutSine;easeInExpo;easeOutExpo;easeInOutExpo;easeInCirc;easeOutCirc;easeInOutCirc;easeInElastic;easeOutElastic;easeInOutElastic;easeInBounce;easeOutBounce;easeInOutBounce;easeInBack;easeOutBack;easeInOutBack',
							 			 'keytype' 		=> 'select',
										 'js' 			=> 'char',
										 'fullname'		=> __('Easing Effect', 'claymore'),
										 'description'	=> __('Select your easing effect type', 'claymore')),
		
		
		'height' 				=> array('default' 		=> '30%',
							 			 'keytype' 		=> 'input',
										 'js' 			=> 'char',
										 'fullname'		=> __('Slide Show Height', 'claymore'),
										 'description'	=> __('here you can type pixels (for instance 300px), a percentage (relative to the width of the slideshow, for instance 50%)', 'claymore')),
		
										 
		
		'time' 					=> array('default' 		=> '2000',
							 			 'keytype' 		=> 'input',
										 'fullname'		=> __('Slide Show Speed', 'claymore'),
										 'description'	=> __('milliseconds between the end of the sliding effect and the start of the nex one', 'claymore')),
										 
										 
		'transPeriod' 			=> array('default' 		=> '800',
							 			 'keytype' 		=> 'input',
										 'fullname'		=> __('Animation Speed', 'claymore'),
										 'description'	=> __('length of the sliding effect in milliseconds', 'claymore')),								 
										 
				
		'loader'	 			=> array('default' 		=> 'bar',
							 			 'keyvalues' 	=> 'pie;bar;none',
							 			 'keytype' 		=> 'select',
										 'js' 			=> 'char',
										 'fullname'		=> __('Loader Style', 'claymore'),
										 'description'	=> __('even if you choose "pie", old browsers like IE8- can\'t display it... they will display always a loading bar', 'claymore')),
										 
										
		'piePosition'	 		=> array('default' 		=> 'rightTop',
							 			 'keyvalues' 	=> 'rightTop;leftTop;leftBottom;rightBottom',
							 			 'keytype' 		=> 'select',
										 'js' 			=> 'char',
										 'fullname'		=> __('Loader Position', 'claymore'),
										 'description'	=> __('choose one of the 4 Positions', 'claymore')),		
		
		
		'loaderOpacity'	 		=> array('default' 		=> '1',
							 			 'keyvalues' 	=> '1;2;3;4;5;6;7;8;9;10',
							 			 'keytype' 		=> 'select',
										 'js' 			=> 'char',
										 'fullname'		=> __('Loader Opacity', 'claymore'),
										 'description'	=> __('Change the loader opacity', 'claymore')),
										 
		
		'navigationHover'		=> array('default' 		=> 'true',
							 			 'keyvalues' 	=> 'true;false',
										 'js' 			=> 'bolean',
							 		 	 'keytype' 		=> 'radio',
										 'fullname'		=> __('Display Controls on hover?', 'claymore'),
										 'description'	=> __('if true the navigation button (prev, next and play/stop buttons) will be visible on hover state only, if false they will be visible always', 'claymore')),
		
		
		'pagination'			=> array('default' 		=> 'true',
							 			 'keyvalues' 	=> 'true;false',
										 'js' 			=> 'bolean',
							 		 	 'keytype' 		=> 'radio',
										 'fullname'		=> __('Display Bullets?', 'claymore'),
										 'description'	=> __('If true each slide will create a bullet instead of a thumbnail', 'claymore')),
		
		
		'thumbnails'			=> array('default' 		=> 'true',
							 			 'keyvalues' 	=> 'true;false',
										 'js' 			=> 'bolean',
							 		 	 'keytype' 		=> 'radio',
										 'fullname'		=> __('Display Thumbnails?', 'claymore'),
										 'description'	=> __('If true the user will see thumbnails as an additional menu when hovering the bullets', 'claymore'))

	);
		
	return $default;
}

?>