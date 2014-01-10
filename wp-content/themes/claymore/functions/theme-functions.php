<?php
#-----------------------------------------------------------------
# register menu & navigation
#-----------------------------------------------------------------
if( !function_exists( 'register_menu' ) ) :
    
	function register_menu() {
	    register_nav_menu('primary-menu', __('Primary Navigation', 'claymore'));
		register_nav_menus( array( 'mobile-menu' => 'Mobile Menu') );
    }
    add_action('init', 'register_menu');
	
endif;

if( !function_exists( 'apply_mobile_menu' ) ) :

	function apply_mobile_menu( $menu_id ) {
		$menu_id = 'mobile-menu';
		return $menu_id;
	}
	
	add_filter( 'lambda_responsive_menu_location', 'apply_mobile_menu' );

endif;

#-----------------------------------------------------------------
# menu fallback
#-----------------------------------------------------------------
if( !function_exists( 'default_menu' ) ) :

	function default_menu() {
		require_once ( TEMPLATEPATH . '/functions/default-menu.php' );
	}

endif;


#-----------------------------------------------------------------
# WordPress Admin Login
#-----------------------------------------------------------------
add_action("login_head", "my_login_head");
function my_login_head() {
	if(get_option_tree('login_logo')) {
		echo "<style>
		body.login #login h1 a {
			background: url('".get_option_tree('login_logo')."') no-repeat scroll center top transparent;
		}
		.login #nav a, .login #backtoblog a {
			color: ".get_option_tree('color_scheme')." !important;
		}
		</style>";
	}
}

if ( !function_exists( 'change_login_url' ) ) {
	function change_login_url(){
		return (esc_url( home_url( '/' )));
	}
	add_filter('login_headerurl', 'change_login_url');
}

#-----------------------------------------------------------------
# polish google font name
#-----------------------------------------------------------------
if ( !function_exists( 'polish_font_name' ) ) {
	function polish_font_name($fontname) {
		$fontname = str_replace('+', ' ', $fontname);
		if(preg_match("/:/",$fontname)) {
			$fontname = explode(':' , $fontname);
			$fontname = $fontname[0];
		}
		return $fontname;	
	}
}

#-----------------------------------------------------------------
# continue reading link for excerpts
#-----------------------------------------------------------------
if ( !function_exists( 'lambda_continue_reading_link' ) ) {
	function lambda_continue_reading_link() {
		return '<a class="excerpt" href="'. get_permalink() . '">' . __( 'Read More', 'claymore' ) . '</a>';
	}
}

#-----------------------------------------------------------------
# custom functions for portfolio filter
#-----------------------------------------------------------------
if ( !function_exists( 'cmp' ) ) {
	function cmp( $a, $b )	{ 
		if(  $a->parent ==  $b->parent ){ return 0 ; } 
			return ($a->parent < $b->parent) ? -1 : 1;
	}
}
if ( !function_exists( 'sort_by_parent' ) ) {
	function sort_by_parent( $a, $b ) { 
		if(  $a->parent ==  $b->parent ){ return 0 ; } 
			return ($a->parent < $b->parent) ? -1 : 1;
	}
}
if ( !function_exists( 'sort_portfolio_filter' ) ) {
	function sort_portfolio_filter( $taxonomys ) {
		usort($taxonomys,'cmp');						
		usort($taxonomys,'sort_by_parent');
		
		return $taxonomys;
	}
}

#-----------------------------------------------------------------
# excerpt length & more link
#-----------------------------------------------------------------
if ( !function_exists( 'lambda_excerpt_length' ) ) {
	function lambda_excerpt_length( $length ) {
		return get_option_tree( 'excerpt_blog_length' );
	}
add_filter( 'excerpt_length', 'lambda_excerpt_length' );
}

function new_excerpt_more($more) {
    global $post;
	
	$more = __('Read more <span class="meta-nav"></span>', 'claymore');
	
	return '<a href="'. get_permalink($post->ID) . '" class="more-link">'.$more.'</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

#-----------------------------------------------------------------
# portfolio pagination
#-----------------------------------------------------------------
if ( !function_exists( 'paginate' ) ) {
	function paginate($next = 'Next Works &#8658;', $prev = '&#8656; Previous Works') {
		
		global $wp_query, $wp_rewrite;		
		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
		
		$pagination = array(
			'base' => @add_query_arg('page','%#%'),
			'format' => '',
			'total' => $wp_query->max_num_pages,
			'current' => $current,
			'show_all' => true,
			'prev_text' => $prev,
			'next_text' => $next,
			'type' => 'list'
		);
		if( $wp_rewrite->using_permalinks() ) $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
		if( !empty($wp_query->query_vars['s']) ) $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
		
		if($pagination['total'] > 1)
		echo '<div class="pagination">'.paginate_links( $pagination).'</div>';
	}
}


#-----------------------------------------------------------------
# Slider Loop
#-----------------------------------------------------------------
if ( !function_exists( 'callFlexslider' ) ) {
	
	/*
	* creates a standard flexslider
	* @param - $pagetype - single = home / portfolio / page
	*/
	
	function callFlexslider($pagetype = 'home') {
	
	$metadata = lambda_return_meta('page');
		
	//Sliderdata for Portfolio Single Pages
	if($pagetype == 'portfolio') {
		$slides = $metadata[UT_THEME_INITIAL.'portfolio_images'];
		$additional_class = 'class="portfolio_slider"';
	}	
	//Sliderdata for Single Page
	if($pagetype == 'page') {
		$slides = $metadata[UT_THEME_INITIAL.'slider_images'];
		$additional_class = 'class="sixteen columns clearfix"';
	}
	
	if(is_array($slides)) {
		  
		  if($pagetype == 'portfolio') {
		  	echo '<div class="thumb">';
		  }
		  
		  echo "<div id=\"slider-wrap\" ".$additional_class."><div class=\"flexslider\"><div class=\"frame\"><ul class=\"slides\">";
		  foreach( $slides as $slide ) {
		  
		  		  
		  //home or blog slider (Option Tree)
		  if($pagetype == 'home') {
		  		
				$imgurl = (isset($slide['image'])) ? $slide['image'] : '';
				$link = (isset($slide['link'])) ? $slide['link'] : '#';
				$caption = (isset($slide['description'])) ? $slide['description'] : '';
				$title = (isset($slide['title'])) ? $slide['title'] : '';

								
		  }
		  
		  //reasign array for portfolio images or page slider images
		  if($pagetype == 'portfolio' || $pagetype == 'page') {
								
				$imgurl = (isset($slide['imgurl'])) ? $slide['imgurl'] : '';
				$link = (isset($slide['slider_link'])) ? $slide['slider_link'] : '';
				$caption = (isset($slide['caption'])) ? $slide['caption'] : '';
				$title= (isset($slide['title'])) ? $slide['title'] : '';
												 			 
		  }
	  
		  echo '<li>
					<a href="'.$imgurl.'" data-rel="prettyPhoto[postgallery]"><img src="'.$imgurl.'" alt="'.$title.'" /></a>';
					
					if(!empty($caption)) { 
		  			echo '<p class="flex-caption">'.$caption.'</p>'; }
		  
		  echo '</li>';
		  } 
		  echo "</ul></div></div></div>"; 
		  
		  if($pagetype == 'portfolio') {
		  	echo '</div>';
		  }

		}
		
	}
}

#-----------------------------------------------------------------
# Main Slider
#-----------------------------------------------------------------
if ( !function_exists( 'lambda_main_slider' ) ) {

	function lambda_main_slider($slides) {
						
		$sliderinfo = explode('_',$slides['main_slider']);		
				
		if( $sliderinfo[0] == 'revslider' ) {
						
			echo '<div id="lambda-featured-header-wrap" class="clearfix">'.do_shortcode('[rev_slider '.$sliderinfo[1].']').'</div>';
	
		} elseif( $sliderinfo[0] == 'lambda') {
							
			echo do_shortcode('[lambdaslider id="'.$sliderinfo[1].'"]');
	
		}		
	
	}

}


#-----------------------------------------------------------------
# Remove HTML from the_content
#-----------------------------------------------------------------

/**
 * @param string $code name of the shortcode
 * @param string $content
 * @return string content with shortcode striped
 */
function strip_shortcode($code, $content)
{
    global $shortcode_tags;

    $stack = $shortcode_tags;
    $shortcode_tags = array($code => 1);

    $content = strip_shortcodes($content);

    $shortcode_tags = $stack;
    return $content;
}


if ( !function_exists( 'strip_html_from_the_content' ) ) {

	function strip_html_from_the_content($content, $tags = '') {
		
		global $post; 
	
		$post_format = get_post_format( $post->ID );
		$post_format = ( false === $post_format ) ? 'standard' : $post_format;	
						
		if ( is_home() && $post_format == 'gallery' ) {
			$content = strip_shortcode('gallery', $content);		
		}
		
		return $content;
	}
	
	add_filter( 'the_content', 'strip_html_from_the_content'); 
}

#-----------------------------------------------------------------
# Get an excerpt of a chosen page by ID
#-----------------------------------------------------------------

/*
* Gets the excerpt of a specific post ID or object
* @param - $post - object/int - the ID or object of the post to get the excerpt of
* @param - $length - int - the length of the excerpt in words
* @param - $tags - string - the allowed HTML tags. These will not be stripped out
* @param - $extra - string - text to append to the end of the excerpt
*/
if ( !function_exists( 'excerpt_by_id' ) ) {
	function excerpt_by_id($post, $length = 10, $tags = '<a><em><strong>', $extra = ' ...') {
		
		if($post) {
			// get the post object of the passed ID
			$post = get_post($post);
		} elseif(!is_object($post)) {
			return false;
		}
	 	
		if(has_excerpt($post->ID)) {
			$the_excerpt = $post->post_excerpt;
			return apply_filters('the_content', $the_excerpt);
		} else {
			$the_excerpt = lambda_translate_meta($post->post_content);
		}
	    
		$the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);
		$the_excerpt = preg_split('/("[^"]*"|\'[^\']*\'|\s+)/', $the_excerpt, $length, PREG_SPLIT_DELIM_CAPTURE);
		$excerpt_waste = array_pop($the_excerpt);
		$the_excerpt = implode(" ",$the_excerpt);
		$the_excerpt = '<p>'.$the_excerpt.'</p>'.$extra;
		
		return apply_filters('the_content', $the_excerpt);
	}
}

#-----------------------------------------------------------------
# Get the title of a chosen page by ID
#-----------------------------------------------------------------
if ( !function_exists( 'get_pagetitle_by_id' ) ) {
	function get_pagetitle_by_id($page_id) {
		$title_data = get_page($page_id);
		$title = apply_filters('the_content', $title_data->post_title);	
	
		//return page title
		return $title;
	}
}
#-----------------------------------------------------------------
# Replaces "[...]" (appended to automatically generated excerpts)
#----------------------------------------------------------------- 

if ( !function_exists( 'lambda_auto_excerpt_more' ) ) {

function lambda_auto_excerpt_more( $more ) {
	return ' &hellip;' . lambda_continue_reading_link();
}
add_filter( 'excerpt_more', 'lambda_auto_excerpt_more' );

}
 
#-----------------------------------------------------------------
# Adds a pretty "Continue Reading" link to custom post excerpts.
#-----------------------------------------------------------------  
if ( !function_exists( 'lambda_custom_excerpt_more' ) ) {

function lambda_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= lambda_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'lambda_custom_excerpt_more' );

}
 
#-----------------------------------------------------------------
# Removes inline styles printed when the gallery shortcode is used.
#----------------------------------------------------------------- 
add_filter( 'use_default_gallery_style', '__return_false' );


#-----------------------------------------------------------------
# Removes More Jump Link
#-----------------------------------------------------------------
if ( !function_exists( 'remove_more_jump_link' ) ) {

function remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
	$end = strpos($link, '"',$offset);
	}
	if ($end) {
	$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
	}
	add_filter('the_content_more_link', 'remove_more_jump_link');

}

#-----------------------------------------------------------------
# Rel Category
#-----------------------------------------------------------------
add_filter( 'the_category', 'add_nofollow_cat' );

function add_nofollow_cat( $rel ) {
	$rel = str_replace('rel="category"', 'data-rel="category"', $rel); return $rel;
}

#-----------------------------------------------------------------
# Get Image Size
#-----------------------------------------------------------------
if ( !function_exists( 'getImageSizebyID' ) ) {
	function getImageSizebyID($PostID, $columnset) {
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($PostID), $columnset.'col-image' );
		$size = getimagesize($thumb['0']);
		return $size;
	}
}

#-----------------------------------------------------------------
# Social Media
#-----------------------------------------------------------------
if ( !function_exists( 'socialmedia' ) ) {
	function socialmedia() {
	
		$icons = get_option_tree( 'social_media_icons', '', false, true );
		  if(is_array($icons)) {
	  		  echo '<ul id="socialmedia">';
			  foreach( $icons as $icon ) {
				 echo '
				 <li>
					<a href="'.$icon['link'].'"><img src="'.$icon['image'].'" alt="'.$icon['title'].'" class="tTip" title="'.$icon['title'].'" /></a>
				 </li>';
		  	 }
			 echo '</ul>';
		}
		
		
	}
}


#-----------------------------------------------------------------
# Author Social Media
#-----------------------------------------------------------------
function lambda_contactmethods( $contactmethods ) {
    
	// Add Twitter
    $contactmethods['twitter'] = 'Twitter';
    //add Facebook
    $contactmethods['facebook'] = 'Facebook';
     
    return $contactmethods;
    }
add_filter('user_contactmethods','lambda_contactmethods',10,1);



#-----------------------------------------------------------------
# Lambda Likes
#-----------------------------------------------------------------
if ( !function_exists( 'GetLambdaLikeCount' ) ) {
	function GetLambdaLikeCount($post_id) {
		 
		 global $wpdb;
		 
		 $show_symbols = get_option('lambda_like_post_show_symbols');
		 
		 $lambda_like_count = $wpdb->get_var("SELECT SUM(likeit) FROM {$wpdb->base_prefix}lambda_like_post WHERE post_id = '$post_id' AND likeit >= 0");
				 
		 if(!$lambda_like_count)
		 $lambda_like_count = 0;
		 		
		 return $lambda_like_count;
	}
}

if ( !function_exists( 'HasLambdaAlreadyVoted' ) ) {
	function HasLambdaAlreadyVoted($post_id, $ip = null) {
		 
		 global $wpdb;
		 
		 if(null == $ip)
		 $ip = $_SERVER['REMOTE_ADDR'];
		
		 $lambda_has_voted = $wpdb->get_var("SELECT COUNT(id) AS has_voted FROM {$wpdb->base_prefix}lambda_like_post WHERE post_id = '$post_id' AND ip = '$ip'");
		 
		 return $lambda_has_voted;
	}
}

if ( !function_exists( 'GetLambdaLastDate' ) ) {

	function GetLambdaLastDate($voting_period) {
		 switch($voting_period) {
			case "1":
				$day = 1;
				break;
			case "2":
				$day = 2;
				break;
			case "3":
				$day = 3;
				break;
			case "7":
				$day = 7;
				break;
			case "14":
				$day = 14;
				break;
			case "21":
				$day = 21;
				break;
			case "1m":
				$month = 1;
				break;
			case "2m":
				$month = 2;
				break;
			case "3m":
				$month = 3;
				break;
			case "6m":
				$month = 6;
				break;
			case "1y":
				$year = 1;
			   break;
		 }
		
		 $last_strtotime = strtotime(date('Y-m-d H:i:s'));
		 $last_strtotime = mktime(date('H', $last_strtotime), date('i', $last_strtotime), date('s', $last_strtotime),
					 date('m', $last_strtotime) - $month, date('d', $last_strtotime) - $day, date('Y', $last_strtotime) - $year);
		 
		 $last_voting_date = date('Y-m-d H:i:s', $last_strtotime);
		 
		 return $last_voting_date;
	}
}


if ( !function_exists( 'LambdaMostLikeQuery' ) ) {
	function LambdaMostLikeQuery($limit, $where) {
		
		global $wpdb;
		
		$query = "SELECT post_id, SUM(likeit) AS like_count, post_title FROM `{$wpdb->base_prefix}lambda_like_post` L, {$wpdb->base_prefix}posts P ";
		$query .= "WHERE L.post_id = P.ID AND post_status = 'publish' AND likeit > 0 $where GROUP BY post_id ORDER BY like_count DESC, post_title $limit";
		$posts = $wpdb->get_results($query);
		
		return $posts;
	
	}
}


if ( !function_exists( 'extractURL' ) ) {
	function extractURL($url) {
		$finalurl = preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $url, $match);
		$finalurl = generatePPVideoURL($match['0']['0']);		
		return $finalurl;
	}
}

if ( !function_exists( 'generatePPVideoURL' ) ) {
	function generatePPVideoURL($url) {
		
		$spliturl = explode("/", $url);		
	
		if(substr_count($url,"youtube")) {
		
			$finalurl = 'http://www.youtube.com/watch?v='.$spliturl[4];
		
		} elseif(substr_count($url,"vimeo")) {
			
			$finalurl = 'http://vimeo.com/'.$spliturl[4];

		} else {

			$finalurl = 'unknown';
					
		}
				
		return $finalurl;
	}
}
#-----------------------------------------------------------------
# Helper function to sort arrays 
#-----------------------------------------------------------------
if ( !function_exists( 'array_sort' ) ) {
	function array_sort($array, $on, $order=SORT_ASC)
	{
		$new_array = array();
		$sortable_array = array();
	
		if (count($array) > 0) {
			foreach ($array as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $k2 => $v2) {
						if ($k2 == $on) {
							$sortable_array[$k] = $v2;
						}
					}
				} else {
					$sortable_array[$k] = $v;
				}
			}
	
			switch ($order) {
				case SORT_ASC:
					asort($sortable_array);
				break;
				
				case SORT_DESC:
					arsort($sortable_array);
				break;
			}
	
			foreach ($sortable_array as $k => $v) {
				$new_array[$k] = $array[$k];
			}
		}
	
		return $new_array;
	}
}

if ( !function_exists( 'compareItems' ) ) {
	function compareItems($a, $b) {
		
		if (empty($b->SortID)) return '1';
		
		if ( $a->SortID < $b->SortID ) return -1;
		if ( $a->SortID > $b->SortID ) return 1;
		
		return 0; // equality
	}
}

#-----------------------------------------------------------------
# Pretty Photo for Standard WP Images
#-----------------------------------------------------------------
if ( !function_exists( 'add_rel_lightbox' ) ) {
	function add_rel_lightbox($content)  {    	
		
		$string = '/<a href="(.*?).(jpg|jpeg|png|gif|bmp|ico)"><img(.*?)class="(.*?)wp-image-(.*?)" \/><\/a>/i';  	
		preg_match_all( $string, $content, $matches, PREG_SET_ORDER);    	
		
		//Check which attachment is referenced  	
		foreach ($matches as $val) {
			$slimbox_caption = '';  		  		
			$post = get_post($val[5]);  		
			$slimbox_caption = esc_attr( $post->post_content ); 
			
			$string = '<a href="' . $val[1] . '.' . $val[2] . '"><img' . $val[3] . 'class="' . $val[4] . 'wp-image-' . $val[5] . '" /></a>';  		$replace = '<a href="' . $val[1] . '.' . $val[2] . '" data-rel="prettyPhoto[this_page]" title="' . $slimbox_caption . '"><img' . $val[3] . 'class="' . $val[4] . 'wp-image-' . $val[5] . '" /></a>';  		
			$content = str_replace( $string, $replace, $content);
		}
		return $content;
		 
	}
	add_filter('the_content', 'add_rel_lightbox', 2);
}

#-----------------------------------------------------------------
# Pretty Photo for Standard WP Images
#-----------------------------------------------------------------
if ( !function_exists( 'lambda_pretty_gallery' ) ) {
	function lambda_pretty_gallery($content) {
		
		global $theme_options;
		
		if(isset($theme_options['activate_prettyphoto']) && $theme_options['activate_prettyphoto'] == 'on')				
		$content = preg_replace("/<a/","<a data-rel=\"prettyPhoto[slides]\"",$content,1);
		
				
		return $content;
	}
	add_filter( 'wp_get_attachment_link', 'lambda_pretty_gallery');
}



#-----------------------------------------------------------------
# Color Scheme Array
#-----------------------------------------------------------------
if ( !function_exists( 'recognized_color_themefiles' ) ) {
	function recognized_color_themefiles() {
		return apply_filters( 'recognized_color_themefiles', array(
	
			'75a405' => 'greenapple.css',
			'9A6742' => 'coffee.css',
			'1A88C1' => 'blue.css',
			'8F4EC2' => 'purple.css',
			'ed6fe6' => 'pink.css',  
			'e30b0b' => 'red.css',
			'F55D2D' => 'orange.css' 
					
	  ));
	}
}
#-----------------------------------------------------------------
# Grid Array
#-----------------------------------------------------------------
if ( !function_exists( 'recognized_grid_sizes' ) ) {
	function recognized_grid_sizes() {
		return apply_filters( 'recognized_grid_sizes', array(
			
			'3' => array('fixed' => 'three columns',
						 'fluid' => 'one_third'),
						 
			'4' => array('fixed' => 'four columns',
						 'fluid' => 'one_fourth'),
					
	  ));
	}
}


function lambdaCurPageURL() {
	
	$pageURL = 'http';
	$pageURL .= ($_SERVER["HTTPS"] == "on") ? "s" : "";
	$pageURL .= "://";
	
 	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 	} else {
  		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 	}
 	
	return $pageURL;
}

#-----------------------------------------------------------------
# Fix Shortcodes
#-----------------------------------------------------------------
if( !function_exists('lambda_fix_shortcodes') ) {
	function lambda_fix_shortcodes($content){   
		$array = array (
			'<p>[' => '[', 
			']</p>' => ']', 
			']<br />' => ']'
		);
		$content = strtr($content, $array);
		return $content;
	}
	add_filter('the_content', 'lambda_fix_shortcodes');
}

#-----------------------------------------------------------------
# Get table prefix
#-----------------------------------------------------------------
if ( !function_exists( 'lambda_get_table_prefix' ) ) {
	function lambda_get_table_prefix(){
		
		global $blog_id, $wpdb;
			
		if($blog_id != 1 && is_multisite() ){
			$table_prefix = $wpdb->base_prefix . $blog_id."_";
		} else {
			$table_prefix = $wpdb->base_prefix;
		}
		
		return( $table_prefix );
		
	}
}


#-----------------------------------------------------------------
# return true if current page is blog related
#-----------------------------------------------------------------
if ( !function_exists( 'lambda_is_blog_related' ) ) {
	function lambda_is_blog_related() {
	
		return ( is_home() || is_tag() || is_search() || is_archive() || is_category() ) ? true : false;
		
	}
}

#------------------------------------------------------------------------------
# helper function : returns needed meta data of the current page
#------------------------------------------------------------------------------
if( !function_exists('lambda_return_meta') ) {

	function lambda_return_meta( $metatype = 'slider' , $ID = '' ) {
		
        global $post, $wp_query;
        
		// woo commerce shop ID
		if( function_exists('is_shop') ) {
			
			if( is_shop() ) {
				$pageID = get_option('woocommerce_shop_page_id');
			}
			
		}
		
		// blog page ID
		if( lambda_is_blog_related() ) {
			
			$pageID = get_option('page_for_posts');
		
		// all other pages
		} else {
			
			$pageID = ( isset($wp_query->post) ) ? $wp_query->post->ID : NULL;
            
		}
        
        // retrieve meta data from a specical page
        $pageID = ( !empty($ID) ) ? $ID : $pageID;
        
                        
		switch( $metatype ) :
			
			case 'slider':
			
				global $slider_meta_data;
				return get_post_meta($pageID, $slider_meta_data->get_the_id(), TRUE);
                break;
			
			case 'page':
			
				global $lambda_meta_data;
                return get_post_meta($pageID, $lambda_meta_data->get_the_id(), TRUE);
                break;
                
            			   			
		endswitch;
	
	}
		
} ?>