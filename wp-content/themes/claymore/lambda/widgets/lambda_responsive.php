<?php

/*
 * Responsive Switcher Widget 
 * by www.unitedthemes.com
 */

class WP_Widget_Responsive extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'lambda_widget_responsive', 'description' => __( 'Responsive On / Off Switch', 'claymore') );
		parent::__construct('lw_responsive', __('Lambda - Responsive Switch', 'claymore'), $widget_ops);
		$this->alt_option_name = 'lambda_widget_responsive';

	}	
	
	function form($instance) { 
		
		$buttontype = array(
			'plain' => __('Plain Text', 'claymore'),
			'button' => __('Button', 'claymore')
		); ?>	
		
        <p>
            <label for="<?php echo $this->get_field_id('button_type'); ?>"><?php _e('Switch Layout', 'claymore'); ?>:<br />
                <select name="<?php echo $this->get_field_name('button_type'); ?>" id="<?php echo $this->get_field_id('button_type'); ?>">
                <?php
                foreach($buttontype as $type_key => $type_value) {
                    $selected = ($type_key == $instance['button_type']) ? 'selected' : '';
                    echo '<option value="' . $type_key . '" ' . $selected . '>' . $type_value . '</option>';
                }
                ?>
            </select></label>
        </p>
		
		
		<?php $buttoncolors = array(
			'gray' => __('gray', 'claymore'),
			'blue' => __('blue', 'claymore'),
			'green' => __('green', 'claymore'),
			'orange' => __('orange', 'claymore'),
			'purple' => __('purple', 'claymore'),
			'red' => __('red', 'claymore'),
			'coffee' => __('brown', 'claymore'),
			'pink' => __('pink', 'claymore')
		); ?>	
		
        <p>
            <label for="<?php echo $this->get_field_id('button_color'); ?>"><?php _e('Button Color', 'claymore'); ?>:<br />
                <select name="<?php echo $this->get_field_name('button_color'); ?>" id="<?php echo $this->get_field_id('button_color'); ?>">
                <?php
                foreach($buttoncolors as $color_key => $color_value) {
                    $selected = ($color_key == $instance['button_color']) ? 'selected' : '';
                    echo '<option value="' . $color_key . '" ' . $selected . '>' . $color_value . '</option>';
                }
                ?>
            </select></label>
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id('mobile'); ?>"><?php _e('Button Text for Mobile Switch', 'claymore'); ?>:<br />
            <input type="text" id="<?php echo $this->get_field_id('mobile'); ?>" name="<?php echo $this->get_field_name('mobile'); ?>" style="width: 125px;" value="<?php echo $instance['mobile'];?>" /></label>
            <br /><span style="font-size:10px;"><?php _e('For Example: Switch to Desktop view', UT_THEME_INITIAL); ?></span>
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id('desktop'); ?>"><?php _e('Button Text for Desktop Switch', 'claymore'); ?>:<br />
            <input type="text" id="<?php echo $this->get_field_id('desktop'); ?>" name="<?php echo $this->get_field_name('desktop'); ?>" style="width: 125px;" value="<?php echo $instance['desktop'];?>" /></label>
            <br /><span style="font-size:10px;"><?php _e('For Example: Switch to Mobile view', UT_THEME_INITIAL); ?></span>
        </p>
		       
		
	<?php }
	
	 function widget($args, $instance = array() ){
	
		global $wpdb, $theme_options;
		
		extract( $args ); extract( $instance );
								
		$script = '<script type="text/javascript">
		
		(function($){
			
			$(document).ready(function(){
				
				var responsive = $.cookie("responsivestatus");
								
				$(\'#responsiveswitch\').click( function() {
					
					if(responsive != "on") {					
						
						$.cookie("responsivestatus","on");
						
					} else {
						
						$.cookie("responsivestatus","off");
						
					}
					
				});
			
			});
			
		})(jQuery);

		
		</script>';
		
		// Get Cookie Status
		$cookiestatus = ( isset( $_COOKIE['responsivestatus'] ) ) ? TRUE : FALSE;
		
		if($cookiestatus) {
			
			$status = ( isset($_COOKIE['responsivestatus']) && !empty($_COOKIE['responsivestatus']) ) ? $_COOKIE['responsivestatus'] : 'off';
			
		} else {
		
			$status = ( $theme_options['responsive'] == 'on' ) ? $theme_options['responsive'] : 'off';
			
		}
		
		
		
						
				
				
		// Assign Button Text
		$mobiletext = ( isset($mobile) && !empty($mobile) ) ? $mobile : __('Switch to Desktop view', UT_THEME_INITIAL);
		$desktoptext = ( isset($desktop) && !empty($desktop) ) ? $desktop : __('Switch to Mobile view', UT_THEME_INITIAL);
		$buttonstatus = ($status == "on") ? $mobiletext : $desktoptext;	
		
		// Create Button / Switcher
		$buttontype = ($button_type == "plain") ? '' : 'button' ;
		$buttoncolor = ($button_color && $button_type == "button") ? $button_color." small" : '';
				
		$switcher = '<a id="responsiveswitch" class="'.$buttontype.' '.$buttoncolor.'" href="'.lambdaCurPageURL().'">'.$buttonstatus.'</a>';

		echo $before_widget.$script.$switcher.$after_widget;
			
	}

}



add_action( 'widgets_init', create_function( '', 'return register_widget("wp_widget_responsive");' ) );
?>