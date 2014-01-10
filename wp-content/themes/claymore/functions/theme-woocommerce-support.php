<?php
#-----------------------------------------------------------------
# Woocommerce Before Content
#-----------------------------------------------------------------
if ( !function_exists( 'lambda_woo_before_content' ) ) {
	
	function lambda_woo_before_content() {
				
		global $lambda_meta_data;		
		
		if( is_shop() ) {
			
			$shopid = get_option('woocommerce_shop_page_id'); 
			$meta_sidebar = get_post_meta($shopid, $lambda_meta_data->get_the_id(), TRUE);
			$sidebar_align = get_post_meta($shopid, $lambda_meta_data->get_the_id(), TRUE);
							
		} else {
				
			$meta_sidebar = $lambda_meta_data->the_meta();
			$sidebar_align = $lambda_meta_data->the_meta();	
		}
		
		$sidebar = (isset($meta_sidebar['sidebar'])) ? $meta_sidebar['sidebar'] : get_option_tree('select_sidebar');
		$sidebar_second = (isset($meta_sidebar['sidebar_second'])) ? $meta_sidebar['sidebar_second'] : get_option_tree('select_sidebar_second');
		$sidebar_align = (isset($sidebar_align['sidebar_align'])) ? $sidebar_align['sidebar_align'] : get_option_tree('sidebar_alignement');
		
		if ( function_exists( 'is_product_category' ) ) {
			
			if( is_product_category() ) {
				
				$sidebar = get_option_tree('woo_cat_select_sidebar');
				$sidebar_second = get_option_tree('woo_cat_select_sidebar_second');
				$sidebar_align = get_option_tree('woo_cat_sidebar_alignment');			
			
			}
						
		}		
				
		#-----------------------------------------------------------------
		# special global for woocommerce 
		#-----------------------------------------------------------------
		$GLOBALS['lambda_shop_sidebaralign'] = $sidebar_align;
		$GLOBALS['lambda_sidebar'] = $sidebar;
		
		#-----------------------------------------------------------------
		# includes the template-part-slider.php
		#-----------------------------------------------------------------		
		get_template_part( 'template-part', 'slider' );
		
		//includes the template-part-teaser.php
		get_template_part( 'template-part', 'teaser' );
		
		
		#-----------------------------------------------------------------
		# set column layout depending if user wants to display a sidebar
		#-----------------------------------------------------------------	
		if($sidebar != UT_THEME_INITIAL.'sidebar_none') {
		
			$columns='';
			
		} elseif($sidebar == UT_THEME_INITIAL.'sidebar_none') {
			
			$columns='sixteen';
			
		}
		
		
		#-----------------------------------------------------------------
		# Standard Column Set
		#-----------------------------------------------------------------
		if (empty($columns) && $sidebar_align != 'both') {
			//one sidebar
			$columns = 'eleven';
			$GLOBALS['lambda_content_column'] = $columns;
			
		} elseif (empty($columns) && $sidebar_align == 'both') {
			//two sidebars
			$columns = 'eight';
			$GLOBALS['lambda_content_column'] = $columns;
			
		} else {
			// Check the function for a returned variable
			$columns = $columns;
			$GLOBALS['lambda_content_column'] = $columns;
		}		
		
		
		#----------------------------------------------------------------
		# Markup
		#----------------------------------------------------------------
		echo '<div id="content-wrap" class="fluid clearfix" data-content="content"><!-- /#start content-wrap -->
					<div class="container">';
		
		if($columns == 'eight' && $sidebar_align == 'both') {
			
			echo '<aside id="sidebar_second" class="four columns" role="complementary">';
								
				echo '<ul>';
					
					if(isset($sidebar_second)) {
						
						dynamic_sidebar($sidebar_second);
						
					} 
					
				echo '</ul>';
			
			echo '</aside><!-- #sidebar -->';
			
		}
					
		echo '<div id="content" class="'.$columns.' columns">';		
	
	}
}


#-----------------------------------------------------------------
# Woocommerce After Content
#-----------------------------------------------------------------
if (! function_exists('lambda_woo_after_content'))  {
    function lambda_woo_after_content() {
    	
		global $lambda_content_column, $lambda_shop_sidebaralign, $lambda_sidebar;
								
		//close content wrap
		echo '</div><!-- /#content-wrap -->';
				
		//generate sidebar
		if($lambda_content_column == 'eight' || $lambda_content_column == 'eleven' ) {
			
				if ($lambda_shop_sidebaralign != 'both') {
		
					//one sidebar
					$columns = 'five';
					
				} elseif ($lambda_shop_sidebaralign == 'both') {
					
					//two sidebars
					$columns = 'four';
					
				} else {
					
					// Check the function for a returned variable
					$columns = $columns;
					
				}
			
			echo '<aside id="sidebar" class="'.$columns.' columns" role="complementary">';
			
			
				echo '<ul>';
					
					if(isset($lambda_sidebar)) {
						
						dynamic_sidebar($lambda_sidebar);
						
					} 
					
				echo '</ul>';			
			
			
			echo '</aside><!-- #sidebar -->';		
		
		}
		
    }
}

#-----------------------------------------------------------------
# Woocommerce Before Content
#-----------------------------------------------------------------
if ( !function_exists( 'lambda_woocommerce_content' ) ) {
	function lambda_woocommerce_content() {
	
			if ( is_singular( 'product' ) ) {
	
				while ( have_posts() ) : the_post();
	
					woocommerce_get_template_part( 'content', 'single-product' );
	
				endwhile;
	
			} else { ?>
             
	
				<?php 
					$shop_page = get_post( woocommerce_get_page_id( 'shop' ) );
					do_action( 'woocommerce_archive_description' ); 
				?>
                
              	<?php if ( get_query_var( 'paged' ) ) : ?>
						
					<?php printf( __( '&nbsp;&ndash; Page %s', 'woocommerce' ), get_query_var( 'paged' ) ); ?>
						
				<?php endif; ?>
	
				<?php if ( is_tax() ) : ?>
				
					<?php do_action( 'woocommerce_taxonomy_archive_description' ); ?>
					
				<?php elseif ( ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
				
					<?php do_action( 'woocommerce_product_archive_description', $shop_page ); ?>
					
				<?php endif; ?>
	
				<?php if ( have_posts() ) : ?>
	
					<?php do_action('woocommerce_before_shop_loop'); ?>
	
					<div class="products-listing">
	
						<?php woocommerce_product_subcategories(); ?>
	
						<?php while ( have_posts() ) : the_post(); ?>
	
							<?php woocommerce_get_template_part( 'content', 'product' ); ?>
	
						<?php endwhile; // end of the loop. ?>
	
					</div>
	
					<?php do_action('woocommerce_after_shop_loop'); ?>
	
				<?php else : ?>
	
					<?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>
	
						<p><?php _e( 'No products found which match your selection.', 'woocommerce' ); ?></p>
	
					<?php endif; ?>
	
				<?php endif; ?>
	
				<div class="clear"></div>
	
				<?php do_action( 'woocommerce_pagination' );
	
			}
	}
}

#-----------------------------------------------------------------
# Woocommerce woocommerce_before_shop_loop_item_title
#-----------------------------------------------------------------
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 * WooCommerce Loop Product Thumbs
 **/

 if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {

	function woocommerce_template_loop_product_thumbnail() {
		woocommerce_get_product_thumbnail();
	} 
 }


/**
 * WooCommerce Product Thumbnail
 **/
 if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
	
	function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
		global $post, $woocommerce;

		if ( ! $placeholder_width )
		$placeholder_width = $woocommerce->get_image_size( 'shop_catalog_image_width' );
		
		if ( ! $placeholder_height )
		$placeholder_height = $woocommerce->get_image_size( 'shop_catalog_image_height' );
			
			echo '<div class="imagewrapper">';
			
			do_action( 'woocommerce_after_shop_loop_item_title' );
			
			if ( has_post_thumbnail() ) {
				
				echo get_the_post_thumbnail( $post->ID, $size ); 
				
			} else {
			
				echo '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';
			
			}
			
			echo '</div>';
			
	}
 }

?>