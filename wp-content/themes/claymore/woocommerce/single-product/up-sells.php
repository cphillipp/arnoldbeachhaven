<?php

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$args = array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'posts_per_page' 		=> 4,
	'no_found_rows' 		=> 1,
	'orderby' 				=> 'rand',
	'post__in' 				=> $upsells
);

$products = new WP_Query( $args );

if ( $products->have_posts() ) : ?>

	<section class="upsells products full-width">

		<h3 class="home-title"><span><?php _e('You may also like&hellip;', 'woocommerce') ?></span></h3>
			
            <div class="products-listing">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>
			
            </div>
	
    </section>
    
    <div class="clear"></div>

<?php endif;

wp_reset_postdata();