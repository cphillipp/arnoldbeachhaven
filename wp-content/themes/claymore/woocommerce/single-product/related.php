<?php

global $product, $woocommerce_loop;

$related = $product->get_related();

if ( sizeof($related) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>

	<section class="related products full-width">

		<h3 class="home-title"><span><?php _e('Related Products', 'woocommerce'); ?></span></h3>
			
            <div class="products-listing">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>
            
            </div>


	</section>
    
    <div class="clear"></div>

<?php endif;

wp_reset_postdata();
