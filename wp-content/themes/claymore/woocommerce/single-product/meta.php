<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post, $product;
?>
<div class="product_meta">

	<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option('woocommerce_enable_sku') == 'yes' && $product->get_sku() ) : ?>
		<p><?php _e('SKU:', 'woocommerce'); ?><span itemprop="productID" class="sku"><?php echo $product->get_sku(); ?></span></p>
	<?php endif; ?>

	<?php echo $product->get_categories( ', ', ' <p><span class="posted_in">'.__('Category:', 'woocommerce').' ', '</span></p>'); ?>

	<?php echo $product->get_tags( ', ', ' <span class="tagged_as">'.__('Tags:', 'woocommerce').' ', '.</span>'); ?>

</div>