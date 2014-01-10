<?php

/*
 * Simple Contact Widget 
 * lambda framework v 1.0
 * by www.unitedthemes.com
 * since framework v 2.1
 */


class WP_Widget_Contact extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'lambda_widget_contact', 'description' => __( 'Insert your contact data in here!', 'claymore') );
		parent::__construct('lw_contact', __('Lambda - Contact', 'claymore'), $widget_ops);
		$this->alt_option_name = 'lambda_widget_contact';

	}
	function form($instance) {

	?>

    <label><?php _e('Title', 'claymore'); ?>: <input type="text" style="width:100%;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" /></label>
    
	<label><?php _e('Address', 'claymore'); ?>: <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>"><?php echo $instance['address']; ?></textarea></label>
	<label><?php _e('Phone', 'claymore'); ?>: <input type="text" style="width:100%;" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" value="<?php echo esc_attr($instance['phone']); ?>" /></label>
    <label><?php _e('Fax', 'claymore'); ?>: <input type="text" style="width:100%;" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" value="<?php echo esc_attr($instance['fax']); ?>" /></label>
   	<label><?php _e('Email', 'claymore'); ?>: <input type="text" style="width:100%;" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo esc_attr($instance['email']); ?>" /></label>
   	<label><?php _e('Internet', 'claymore'); ?>: <input type="text" style="width:100%;" id="<?php echo $this->get_field_id('internet'); ?>" name="<?php echo $this->get_field_name('internet'); ?>" value="<?php echo esc_attr($instance['internet']); ?>" /></label>

	
	<?php

    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function widget( $args, $instance ){

	extract( $args );
	extract( $instance );

	if( $title )
	    $title = $before_title.do_shortcode($title).$after_title;

	$text = ( isset($text) ) ? do_shortcode( $text ) : '';
	$text.= '<ul>';
	
	if(!empty($address)) {
		$text.= '<li class="clearfix"><div class="left"><span class="lambda-address"></span></div><div class="description">';
		$text.= do_shortcode(lambda_translate_meta($address)).'</div></li>';	
	}
	
	if(!empty($phone)) {
		$text.= '<li class="clearfix"><div class="left"><span class="lambda-phone"></span></div><div class="description">';
		$text.= do_shortcode(lambda_translate_meta($phone)).'</div></li>';	
	}
	
	if(!empty($fax)) {
		$text.= '<li class="clearfix"><div class="left"><span class="lambda-fax"></span></div><div class="description">';
		$text.= do_shortcode(lambda_translate_meta($fax)).'</div></li>';		
	}
	
	if(!empty($email)) {
		$text.= '<li class="clearfix"><div class="left"><span class="lambda-email"></span></div><div class="description">';
		$text.= do_shortcode(lambda_translate_meta($email)).'</div></li>';	
	}
	if(!empty($internet)) {
		$text.= '<li class="clearfix"><div class="left"><span class="lambda-internet"></span></div><div class="description">';
		$text.= do_shortcode(lambda_translate_meta($internet)).'</div></li>';	
	}
	
	
	$text.= '</ul>';

	echo "$before_widget
	    	$title
			$text
		  $after_widget";
    }

}

add_action( 'widgets_init', create_function( '', 'return register_widget("wp_widget_contact");' ) );

?>
