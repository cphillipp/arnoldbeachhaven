<?php

/*
 * basic functions 
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since framework v 1.0
 */

define( 'UT_THEME_INITIAL' , 'claymore_' ); // DO NOT CHANGE THIS VALUE!
 
#-----------------------------------------------------------------
# default theme constants & repeating variables - do not change!
#-----------------------------------------------------------------
define( 'UT_THEME_NAME' , 'claymore' );
define( 'UT_THEME_VERSION' , '1.7.2' );
define( 'UT_LAMBDA_VERSION' , get_option('lambda_version') );
define( 'UT_PORTFOLIO_SLUG' , 'portfolio' ); //This Constant is changeable

define( 'THEME_WEB_ROOT' , get_template_directory_uri() );
define( 'THEME_DOCUMENT_ROOT' , get_template_directory() );

define( 'STYLE_WEB_ROOT' , get_stylesheet_directory_uri() );
define( 'STYLE_DOCUMENT_ROOT' , get_stylesheet_directory() );

define( 'FRAMEWORK_DIRECTORY' , THEME_WEB_ROOT . '/lambda/' );

#-----------------------------------------------------------------
# Theme Activation Hook
#-----------------------------------------------------------------
require_once ( THEME_DOCUMENT_ROOT  . '/functions/theme-activation-hook.php' );

$theme_options = get_option('option_tree');
$content_width = '940';

#-----------------------------------------------------------------
# Check IE
#-----------------------------------------------------------------
$browser = (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) ? true : false;

#-----------------------------------------------------------------
# Meta Box Management
#-----------------------------------------------------------------
require_once ( THEME_DOCUMENT_ROOT  . '/lambda/lambda.meta.box.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/lambda/lambda.media.access.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/lambda/lambda.taxonomy.class.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/lambda/lambda.callmetaboxes.php' );


#-----------------------------------------------------------------
# Meta Box Access
#-----------------------------------------------------------------
$wpalchemy_media_access = NEW WPAlchemy_MediaAccess();

#-----------------------------------------------------------------
# Check if Option Tree / Moover Plugin has been already installed, 
# if not use our Theme Option Panel
#-----------------------------------------------------------------
if ( !function_exists( 'lambda_is_plugin_active' ) ) {
	
	function lambda_is_plugin_active( $plugin ) {
		return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
	}
	
	if(!lambda_is_plugin_active('option-tree/index.php')) {
		require_once ( THEME_DOCUMENT_ROOT  . '/lambda/index.php' );
	}
	
	if(!lambda_is_plugin_active('soundcloud-shortcode/soundcloud-shortcode.php')) {
		require_once ( THEME_DOCUMENT_ROOT  . '/functions/soundcloud.php' );
	}
		
	if(lambda_is_plugin_active('qtranslate/qtranslate.php')) {
		require_once ( THEME_DOCUMENT_ROOT  . '/functions/lambda.qtranslate.php' );
	}
	
	if(!lambda_is_plugin_active('qtranslate/qtranslate.php')) {
		require_once ( THEME_DOCUMENT_ROOT  . '/functions/lambda.parsecontent.php' );
	}
  
}
#-----------------------------------------------------------------
# Admin Stuff
#-----------------------------------------------------------------
if( is_admin() ) { 
	require_once ( 'lambda/lambda.admin.functions.php' );
}
require_once ( 'lambda/tinymce/lambda.tinymce.class.php' );	

#-----------------------------------------------------------------
# Plugin Activation
#-----------------------------------------------------------------
require_once ( THEME_DOCUMENT_ROOT  . '/functions/plugin-activation.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/functions/plugin-update.php' );

#-----------------------------------------------------------------
# Needed Functions for Front and Backend
#-----------------------------------------------------------------
require_once ( THEME_DOCUMENT_ROOT  . '/functions/theme-portfolio-init.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/functions/aquaresizer.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/functions/theme-walker.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/functions/theme-functions.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/functions/theme-shortcodes.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/functions/theme-post-formats.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/functions/theme-slider-shortcodes.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/functions/pagecreator-functions.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/functions/theme-sanitize.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/javascripts/like.js.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/lambda/lambda.register.widgets.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/lambda/slidermanager/index.php' );


#-----------------------------------------------------------------
# Layout & Form and Misc Functions
#-----------------------------------------------------------------
require_once ( THEME_DOCUMENT_ROOT  . '/functions/theme-custom-css.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/functions/theme-layout-functions.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/functions/theme-form-functions.php' );
require_once ( THEME_DOCUMENT_ROOT  . '/functions/theme-java-functions.php' ); 


#-----------------------------------------------------------------
# Cookie Management for Responsive Switch
#-----------------------------------------------------------------
$cookiestatus = ( isset( $_COOKIE['responsivestatus'] ) ) ? TRUE : FALSE;

if( isset($theme_options['responsive']) && $theme_options['responsive'] == 'on') {	
	if(!$cookiestatus) { setcookie("responsivestatus", "on"); }	
}

#-----------------------------------------------------------------
# Register Core Stylesheets and set loading Filters
#-----------------------------------------------------------------
if ( !function_exists( 'lambda_registerstyles' ) ) {

	add_action('get_header', 'lambda_registerstyles');
	
		function lambda_registerstyles() {
			
			global $cookiestatus;
			
			/*
			 * needed variables
			 */
			$theme_options = get_option('option_tree');
			$portfoliometa = lambda_return_meta('page');			
			$custom_font = get_option('option_tree');
			$color_scheme = (isset($_GET['color_scheme'])) ? '?color_scheme='.$_GET['color_scheme'] : '';
			
			/*
			 * define stylesheets variable
			 */
			$stylesheets = '';
			
			
			/*
			 * enqueue standard css files
			 */			 
			$stylesheets .= wp_enqueue_style('theme',  STYLE_WEB_ROOT . '/style.css' , array(), UT_THEME_VERSION, 'screen, projection');
			$stylesheets .= wp_enqueue_style('layout', STYLE_WEB_ROOT . '/layout.css' , array('theme'), UT_THEME_VERSION, 'screen, projection');
			
			$themecolor = $theme_options['color_scheme'];
			$themecolor = preg_replace("/#/", "", $themecolor);
			$themefiles = recognized_color_themefiles();
			$themefile = ( isset($themefiles[$themecolor]) ) ? $themefiles[$themecolor] : 'custom.css.php';	
			
			/*
			 * enqeue color css
			 */
			if($themefile != 'custom.css.php')
			$stylesheets .= wp_enqueue_style('color', STYLE_WEB_ROOT . '/css/colors/'.$themefile, false, UT_THEME_VERSION, 'screen, projection');
					
			#-----------------------------------------------------------------
			# Responsive Handling
			#-----------------------------------------------------------------	
			
			// cookie is set and can overwrite the backend option		
			// if($cookiestatus && ( isset($_COOKIE['responsivestatus'] ) && $_COOKIE['responsivestatus'] == "on") ) 
			// $stylesheets .= wp_enqueue_style('responsive', STYLE_WEB_ROOT . '/responsive.css' , 'theme', UT_THEME_VERSION, 'screen, projection');
			
			//no cookie has been set so we will use the backend option
			// if(!$cookiestatus && $theme_options['responsive'] == 'on')
			// $stylesheets .= wp_enqueue_style('responsive', STYLE_WEB_ROOT . '/responsive.css' , 'theme', UT_THEME_VERSION, 'screen, projection');
			
			
			#-----------------------------------------------------------------
			# enqueue misc css files
			#-----------------------------------------------------------------
			$stylesheets .= wp_enqueue_style('formalize', THEME_WEB_ROOT.'/formalize.css', 'theme', UT_THEME_VERSION, 'screen, projection');
			$stylesheets .= wp_enqueue_style('superfish', THEME_WEB_ROOT.'/superfish.css', 'theme', UT_THEME_VERSION, 'screen, projection');
			$stylesheets .= wp_enqueue_style('prettyphoto', THEME_WEB_ROOT.'/css/prettyPhoto.css', 'theme', UT_THEME_VERSION, 'screen, projection');
			$stylesheets .= wp_enqueue_style('nonverblaster', THEME_WEB_ROOT.'/css/nonverblaster.css', 'theme', UT_THEME_VERSION, 'screen, projection');
			
			#-----------------------------------------------------------------
			# Exceptions to reduce scriptloading
			#-----------------------------------------------------------------
			if(isset($theme_options['headline_font_face_type']) && $theme_options['headline_font_face_type'] == 'headline_font_face_google') {	
			$stylesheets .= wp_enqueue_style('google_font', 'http://fonts.googleapis.com/css?family='.$custom_font['headline_font_face_google']['font-family'], 'theme', UT_THEME_VERSION); }
			
			
			$stylesheets .= wp_enqueue_style('flexslider', THEME_WEB_ROOT.'/css/flexslider.css', 'theme', '1.0');
			
			if(lambda_is_plugin_active('woocommerce/woocommerce.php')) {
				$stylesheets .= wp_enqueue_style('woocommerce', THEME_WEB_ROOT.'/css/woocommerce.css', 'theme', UT_THEME_VERSION, 'screen, projection');
			}
				
			echo apply_filters( 'lambda_stylesheets' , $stylesheets );
			
		}

}

#-----------------------------------------------------------------
# Header Core Scripts
#-----------------------------------------------------------------
if ( !function_exists( 'lambda_header_scripts' ) ) {

	add_action('init', 'lambda_header_scripts');
	function lambda_header_scripts() {
						
			$theme_options = get_option('option_tree');
				
			if(!is_admin()) {
		
				$javascripts  = wp_enqueue_script('jquery');

				//core scripts
				$javascripts .= wp_enqueue_script('superfish',THEME_WEB_ROOT ."/javascripts/superfish.js",array('jquery'),'1.2.3',true);
				$javascripts .= wp_enqueue_script('carousellite',THEME_WEB_ROOT ."/javascripts/jquery.jcarousellite.js",array('jquery'),'1.3',true);
				$javascripts .= wp_enqueue_script('fitvid',THEME_WEB_ROOT ."/javascripts/jquery.fitvids.js",array('jquery'),'1.3',true);

				//only for portfolio
				$javascripts .= wp_enqueue_script('isotope',THEME_WEB_ROOT ."/javascripts/jquery.isotope.min.js",array('jquery'),'1.5.09',true); 	
				$javascripts .= wp_enqueue_script('formalize',THEME_WEB_ROOT ."/javascripts/jquery.formalize.min.js",array('jquery'),'1.2.3',true);
		
				//only when player is available
				$javascripts .= wp_enqueue_script('nonverbla',THEME_WEB_ROOT ."/javascripts/nonverblaster.js",array('jquery'),'1.0',true);
				$javascripts .= wp_enqueue_script('swfobject');
								
				//custom javascript
				$javascripts .= wp_enqueue_script('custom', STYLE_WEB_ROOT ."/javascripts/app.js",array('jquery'),'1.2.3', true);
				
				//prettyphoto load if it has been enabled inside the theme options panels
				if(isset($theme_options['activate_prettyphoto']) && $theme_options['activate_prettyphoto'] == 'on')	{
					$javascripts .= wp_enqueue_script('prettyphoto',THEME_WEB_ROOT ."/javascripts/jquery.prettyPhoto.js",array('jquery'),'1.3',true);
				}			
				echo apply_filters('lambda_javascripts', $javascripts);
			}
			
			
			
	}

}

#-----------------------------------------------------------------
# Script Exceptions to reduce script loading
#-----------------------------------------------------------------
if ( !function_exists( 'script_exceptions' ) ) {
	add_action('get_header', 'script_exceptions');
	function script_exceptions() {
	  
	  	//receive Globals
	  	$portfoliometa = lambda_return_meta('page');
	  		  	
	  	$script_exceptions = '';  
	  	  
	  	 //Flexslider Gallery
  		$script_exceptions .= wp_enqueue_script('flexslider',THEME_WEB_ROOT ."/javascripts/jquery.flexslider.min.js",array('jquery'),'1.8',true);
			
	  			
	  	if(is_active_widget( false, false, 'lw_responsive', true )) {
		$script_exceptions  .= wp_enqueue_script('jscookie',THEME_WEB_ROOT ."/javascripts/jquery.cookie.js",array('jquery'),'1.0',true); }			
	  	
		
		// Form enhancement
	  	if(is_page_template('dynamic-contact-form.php')) {
		$script_exceptions  .= wp_enqueue_script( 'validateform', THEME_WEB_ROOT .'/javascripts/jquery.validate.min.js', array('jquery'), '1.9'); }	  		
	  	  
	  	
		echo apply_filters ('child_add_portfolioscripts',$script_exceptions);
	}
}

#-----------------------------------------------------------------
# Load Lambda Setup
#-----------------------------------------------------------------
add_action( 'after_setup_theme', 'lambda_setup' );

if ( ! function_exists( 'lambda_setup' ) ):

function lambda_setup() {
	
	#-----------------------------------------------------------------
	# Post Formats
	#-----------------------------------------------------------------
	$pformats = array( 
				'audio',
				'gallery', 
				'link', 
				'quote', 
				'video');
	
	add_theme_support( 'post-formats', $pformats ); 
		
	#-----------------------------------------------------------------
	# Activate Post Thumbnails & Set Image Sizes
	#-----------------------------------------------------------------
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_image_size( '1col-image', '940', '', true);
	add_image_size( '2col-image', '460', '230', true);
	add_image_size( '3col-image', '420', '210', true);
	add_image_size( '4col-image', '420', '240', true);	

	#-----------------------------------------------------------------
	# Design Variables
	#-----------------------------------------------------------------
	$image_frame = array( 'class'	=>  "frame");
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	

	#-----------------------------------------------------------------
	# Make theme available for translation
	#-----------------------------------------------------------------
	load_theme_textdomain( 'claymore' , THEME_DOCUMENT_ROOT  . '/languages' );

	$locale = get_locale();
	$locale_file = THEME_DOCUMENT_ROOT  . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );


		// No support for text inside the header image.
		if ( ! defined( 'NO_HEADER_TEXT' ) )
			define( 'NO_HEADER_TEXT', true );
			
		if ( ! defined( 'HEADER_IMAGE_WIDTH') )
			define( 'HEADER_IMAGE_WIDTH', apply_filters( 'lambda_header_image_width',960));
			
			
		if ( ! defined( 'HEADER_IMAGE_HEIGHT') )
			define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'lambda_header_image_height',185 ));


	}
	endif;

#-----------------------------------------------------------------
# Register widgetized areas, including two sidebars and four widget-ready 
# columns in the footer and all created Sidebars in Admin Panel
#-----------------------------------------------------------------
if ( !function_exists( 'st_widgets_init' ) ) {

function st_widgets_init() {
	
	// The Default Sidebar
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'claymore' ),
		'id' => UT_THEME_INITIAL.'sidebar_default',
		'description' => __( 'The Default Sidebar', 'claymore' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
		
	
	// Register Custom Sidebars
	if (function_exists( 'get_option_tree') ) {
		$sidebars = get_option_tree( 'sidebars', '', false, true, -1 );
			if( !empty( $sidebars ) && is_array( $sidebars ) ){
			$i=1;
			foreach( $sidebars as $num => $sidebar_options ){
				register_sidebar(array(
					'name'          	=> $sidebar_options['title'],
					'id'            	=> UT_THEME_INITIAL.'sidebar_'.$num,
					'description'   	=> $sidebar_options['sidebardesc'],
					'before_widget' 	=> '<li id="%1$s" class="widget-container %2$s">',
					'after_widget' 		=> '</li>',
					'before_title' 		=> '<h3 class="widget-title"><span>',
					'after_title' 		=> '</span></h3>',
				 ));
				 $i++;
			}   
		}	
	}
	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'claymore' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'claymore' ),
		'before_widget' => '<div class="%1$s %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'claymore' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'claymore' ),
		'before_widget' => '<div class="%1$s %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'claymore' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'claymore' ),
		'before_widget' => '<div class="%1$s %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'claymore' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'claymore' ),
		'before_widget' => '<div class="%1$s %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	
	// Area 7, located in the Header. Empty by default.
	register_sidebar( array(
		'name' => __( 'Header Widget Area', 'claymore' ),
		'id' => 'header-widget-area',
		'description' => __( 'The header widget area. Only for Lambda Social Media Widget', 'claymore' ),
		'before_widget' => '<div class="%1$s %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
		
}
/** Register sidebars by running lambda_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'st_widgets_init' );

}


if ( ! function_exists( 'lambda_posted_on' ) ) :
#-----------------------------------------------------------------
# Prints HTML with meta information for the current post-date/time and author.
#----------------------------------------------------------------- 
function lambda_posted_on() {
	return sprintf( __( '%2$s', 'claymore' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'claymore' ), get_the_author() ),
			get_the_author()
		)
	);
}

endif;

// Enable Shortcodes in excerpts and widgets
add_filter('widget_text', 'do_shortcode');
add_filter('the_excerpt', 'do_shortcode');
add_filter('get_the_excerpt', 'do_shortcode');

#-----------------------------------------------------------------
# Woo Commerce Integration
#----------------------------------------------------------------- 
if(lambda_is_plugin_active('woocommerce/woocommerce.php')) {
	
	require_once(THEME_DOCUMENT_ROOT  . '/functions/theme-woocommerce-support.php');	
	
	//HOOKS	
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

	add_action('woocommerce_before_main_content', 'lambda_woo_before_content', 10);
	add_action('woocommerce_after_main_content', 'lambda_woo_after_content', 10);
	
	//Remove default Woocommerce CSS
	define('WOOCOMMERCE_USE_CSS', false);

}

if(!lambda_is_plugin_active('woocommerce/woocommerce.php')) {
	require_once(THEME_DOCUMENT_ROOT  . '/functions/lambda.parseconditionals.php');
} ?>