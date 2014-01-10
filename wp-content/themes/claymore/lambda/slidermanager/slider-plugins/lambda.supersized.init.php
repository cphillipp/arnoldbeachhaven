<?php

/*
 * Supersized Java & HTML Markup 
 * lambda framework v 2.0
 * by www.unitedthemes.com
 * since framework v 2.0
 */

#-----------------------------------------------------------------
# Supersized HTML Output
#-----------------------------------------------------------------
if ( !function_exists( 'getSupersizedHTML' ) ) {
	

	function getSupersizedHTML($slider_result) { 
		
		$options = get_option($slider_result->option_name);	
		
		$html = '<a href="#" id="hidepage"></a>
				 <div class="slider-overlay"></div>
				 				
				<!--Arrow Navigation-->
				<a id="prevslide" class="load-item"></a>
				<a id="nextslide" class="load-item"></a>';
		
		return $html;
	}

}

function supersized_form_array() { 
    	
	$default = array(
    	'transition' 			=> array('default' 		=> 'fade',
							 			 'keyvalues' 	=> 'none=0;fade=1;slideTop=2;slideRight=3;slideBottom=4;slideLeft=5;carouselRight=6;carouselLeft=7',
							 			 'keytype' 		=> 'select',
										 'fullname'		=> 'Transition Effect',
										 'description'	=> 'Select your transition effect type'),
		
		'slide_interval'		=> array('default' 		=> '3000',
							 			 'keytype' 		=> 'input',
										 'fullname'		=> 'Slide Interval',
										 'description'	=> 'Time between slide changes in milliseconds.'),
		
		'transition_speed'		=> array('default' 		=> '1000',
							 			 'keytype' 		=> 'input',
										 'fullname'		=> 'Transition Speed',
										 'description'	=> 'Speed of transitions in milliseconds.'),		
										 
		'autoplay' 				=> array('default' 		=> 'true',
							 			 'keyvalues' 	=> 'true;false',
										 'js' 			=> 'bolean',
							 		 	 'keytype' 		=> 'radio',
										 'fullname'		=> 'Play after load?',
										 'description'	=> 'Determines whether slideshow begins playing when page is loaded.'),
		
		'stop_loop'				=> array('default' 		=> 'false',
							 			 'keyvalues' 	=> 'true;false',
										 'js' 			=> 'bolean',
							 		 	 'keytype' 		=> 'radio',
										 'fullname'		=> 'Pause slideshow at end?',
										 'description'	=> 'Pauses slideshow upon reaching the last slide.'),
		
		'random'				=> array('default' 		=> 'false',
							 			 'keyvalues' 	=> 'true;false',
										 'js' 			=> 'bolean',
							 		 	 'keytype' 		=> 'radio',
										 'fullname'		=> 'Randomize slide order?',
										 'description'	=> 'Randomize slide order. Ignores the '),
		
		'slideshow' 			=> array('default' 		=> 'true',
							 			 'keyvalues' 	=> 'true;false',
										 'js' 			=> 'bolean',
							 		 	 'keytype' 		=> 'radio',
										 'fullname'		=> 'Slideshow on/off?',
										 'description'	=> 'Turns the slideshow on/off. Disables navigation and transitions.'),
		
		'new_window' 			=> array('default' 		=> 'true',
							 			 'keyvalues' 	=> 'true;false',
										 'js' 			=> 'bolean',
							 		 	 'keytype' 		=> 'radio',
										 'fullname'		=> 'Open Links in new Window?',
										 'description'	=> 'Slide links open in a new window.'),
										 
		'performance' 			=> array('default' 		=> '1',
							 			 'keyvalues' 	=> '0;1;2;3',
							 			 'keytype' 		=> 'select',
										 'fullname'		=> 'Performance',
										 'description'	=> '0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)'),
										 
		'horizontal_center'		=> array('default' 		=> 'false',
							 			 'keyvalues' 	=> 'true;false',
										 'js' 			=> 'bolean',
							 		 	 'keytype' 		=> 'radio',
										 'fullname'		=> 'Centers image horizontally?',
										 'description'	=> 'Centers image horizontally. When turned off, the images resize/display from the left of the page.'),
		
		'vertical_center'		=> array('default' 		=> 'false',
							 			 'keyvalues' 	=> 'true;false',
										 'js' 			=> 'bolean',
							 		 	 'keytype' 		=> 'radio',
										 'fullname'		=> 'Centers image vertically?',
										 'description'	=> 'Centers image vertically. When turned off, the images resize/display from the top of the page.'),		
		
		'keyboard_nav'			=> array('default' 		=> 'false',
							 			 'keyvalues' 	=> 'true;false',
										 'js' 			=> 'bolean',
							 		 	 'keytype' 		=> 'radio',
										 'fullname'		=> 'Keyboard Navigation?',
										 'description'	=> 'Allows control via keyboard.'),
		
		'pause_hover'			=> array('default' 		=> 'false',
							 			 'keyvalues' 	=> 'true;false',
										 'js' 			=> 'bolean',
							 		 	 'keytype' 		=> 'radio',
										 'fullname'		=> 'Pause on hover?',
										 'description'	=> 'Pauses slideshow while current image hovered over.'),
										 
		'image_protect'			=> array('default' 		=> 'false',
							 			 'keyvalues' 	=> 'true;false',
										 'js' 			=> 'bolean',
							 		 	 'keytype' 		=> 'radio',
										 'fullname'		=> 'Protect Images?',
										 'description'	=> 'Disables image dragging and right click with Javascript')
										 
		
	
	);
		
	return $default;
}

?>