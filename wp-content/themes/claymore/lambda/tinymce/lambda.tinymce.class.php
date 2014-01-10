<?php
#-----------------------------------------------------------------
# Custom Editor Styles
#-----------------------------------------------------------------
add_action( 'after_setup_theme', 'lambda_after_setup_theme' );
function lambda_after_setup_theme() {
	add_editor_style('editor-style.css');
}

#-----------------------------------------------------------------
# Load Tinymce Styles
#-----------------------------------------------------------------
function lambda_tinymce_css()  {
	wp_enqueue_style('lambda_buttons', get_template_directory_uri()  . '/lambda/tinymce/css/tinymce.css');
}
add_action('admin_print_styles', 'lambda_tinymce_css');

#-----------------------------------------------------------------
# Register TinyMCE editor buttons
#-----------------------------------------------------------------
function lambda_tiny() {
 
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}
	
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'add_js_plugin' );
		add_filter( 'mce_buttons_3', 'register_lambda_tinymce_buttons' );
	}
 
}
add_action('init', 'lambda_tiny');


function add_js_plugin( $plugin_array ) {
   $plugin_array['lambda_buttons'] = THEME_WEB_ROOT . '/lambda/tinymce/lambda.tinymce.js';
   return $plugin_array;
}

#-----------------------------------------------------------------
# Create Buttons
#-----------------------------------------------------------------
function register_lambda_tinymce_buttons( $buttons ) {
	array_push( $buttons,"themecolor","scgenerator","lambda_buttons","lambda_sliders","lambda_tables","lambda_vimeo","lambda_youtube","lambda_soundcloud","lambda_google","lambda_cta" );
	return $buttons; 
}
?>