<?php

/**
 * Templatepart for Teaser
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 2.0
 */

#-----------------------------------------------------------------
# Conditional Tags for displaying Site Titels and Teaser
#-----------------------------------------------------------------
global $slider_meta_data; 

if( lambda_is_blog_related() ) {
			
	$homeid = get_option('page_for_posts');  
	$featuredheader = get_post_meta($homeid, $slider_meta_data->get_the_id(), TRUE);	
		
} elseif(is_shop()) {
	
	$shopid = get_option('woocommerce_shop_page_id');   
	$featuredheader = get_post_meta($shopid, $slider_meta_data->get_the_id(), TRUE);

} else {

	$featuredheader = $slider_meta_data->the_meta();
	
}

if (get_option_tree('blog_title') && is_home()) {
		
	//Set Title
	$title = get_option_tree('blog_title');
	
} elseif( is_shop() ) {
	
	$shop_page = get_post( woocommerce_get_page_id( 'shop' ) );
	$title = apply_filters( 'the_title', ( $shop_page_title = get_option( 'woocommerce_shop_page_title' ) ) ? $shop_page_title : $shop_page->post_title );

} elseif(( is_page() || is_single() || is_product() )) {
	
	$title = get_the_title();

} elseif(is_404()) { 
		
	//Set Title
	$title = __( '404 Error', 'claymore' );

} elseif( is_tax() ) {
	
	$title = single_term_title( "", false );	
	
			
} else { // for all other especially Archives
		
	if(is_day()) : 
		$title = sprintf( __( '%s', 'claymore' ), get_the_date() );
					
	elseif(is_month()) : 
		$title = sprintf( __( '%s', 'claymore' ), get_the_date('F Y') );
					
	elseif(is_year()) : 
		$title = sprintf( __( '%s', 'claymore' ), get_the_date('Y') );
					
	elseif(is_category()) :
		$title = sprintf( __( '%s', 'claymore' ), single_cat_title( '', false ) );
		
	elseif(is_tag()) :
		$title = __( 'Tag Archives', 'claymore' );
		
	elseif(!is_page() && ( !is_home() && !is_front_page() ) ) : 
		
		$title = __( 'Blog Archives', 'claymore' );
	
	endif; 

	}
	
#-----------------------------------------------------------------
# Start Output
#----------------------------------------------------------------- ?>

<?php 

$hideteaser = (isset($featuredheader['hide_teaser'])) ? $featuredheader['hide_teaser'] : 'teaseron'; ?>

<div class="clear"></div>

<section id="teaser" class="fluid clearfix" <?php echo ($hideteaser != 'teaseroff') ? '':'style="display:none !important;"'; ?>>
	<div class="container">
	
	<div id="teaser-content" class="sixteen columns">
	         
                <h1 id="page-title">
				
					<span><?php echo $title; ?></span>
					
                </h1>    
		
	</div><!-- /#teaser-content -->
    </div>	
</section><!-- /#teaser -->

<div class="clear"></div>