<?php

/**
 * small-cart
 */

global $woocommerce;
?>
<div>
    <ul class="small_cart_list">
    
        <?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>
            
            <?php $quantity = 0; ?>
            
            <?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :
    
                $_product = $cart_item['data'];
    
                // Only display if allowed
                if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 )
                    continue;
    
                // Get price
                $product_price = get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();
    
                $product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
                
                $quantity = $cart_item['quantity'] + $quantity;
                
                ?>
                
            <?php endforeach; ?>
            
            <li><?php echo $quantity.__(' Items', 'woocommerce'); ?></li>
            
        <?php else : ?>
    
            <li class="empty"><?php _e('No products in the cart.', 'woocommerce'); ?></li>
    
        <?php endif; ?>
        
        
        <?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>
        <li>
            <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><strong><?php _e('Subtotal', 'woocommerce'); ?>:</strong> <?php echo $woocommerce->cart->get_cart_subtotal(); ?></a>
        </li>
    
        <?php endif; ?>    
    
    </ul><!-- end product list -->
</div>
