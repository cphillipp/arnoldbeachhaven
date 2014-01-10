<?php
/**
 * My Addresses
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce;

$customer_id = get_current_user_id();
?>

<?php if (get_option('woocommerce_ship_to_billing_address_only')=='no') : ?>

	<div class="col2-set addresses">

		<div class="col-1">

<?php endif; ?>
			
			<header>
				<h3 class="home-title"><span><?php _e('Billing Address', 'woocommerce'); ?></span></h3>
			</header>
			<address>
            
            	<div class="left">
            		<span class="lambda-address"></span>
                </div>
                
                <div class="description" style="padding-left:25px;">
				<?php
					$address = array(
						'first_name' 	=> get_user_meta( $customer_id, 'billing_first_name', true ),
						'last_name'		=> get_user_meta( $customer_id, 'billing_last_name', true ),
						'company'		=> get_user_meta( $customer_id, 'billing_company', true ),
						'address_1'		=> get_user_meta( $customer_id, 'billing_address_1', true ),
						'address_2'		=> get_user_meta( $customer_id, 'billing_address_2', true ),
						'city'			=> get_user_meta( $customer_id, 'billing_city', true ),
						'state'			=> get_user_meta( $customer_id, 'billing_state', true ),
						'postcode'		=> get_user_meta( $customer_id, 'billing_postcode', true ),
						'country'		=> get_user_meta( $customer_id, 'billing_country', true )
					);

					$formatted_address = $woocommerce->countries->get_formatted_address( $address );

					if (!$formatted_address) _e('You have not set up a billing address yet.', 'woocommerce'); else echo $formatted_address;
				?>
                </div>
                <a href="<?php echo esc_url( add_query_arg('address', 'billing', get_permalink(woocommerce_get_page_id('edit_address'))) ); ?>" class="edit woo-button"><?php _e('Edit', 'woocommerce'); ?></a>

                
			</address>


<?php if (get_option('woocommerce_ship_to_billing_address_only')=='no') : ?>

		</div><!-- /.col-1 -->

		<div class="col-2">

			<header>
				<h3 class="home-title"><span><?php _e('Shipping Address', 'woocommerce'); ?></span></h3>
			</header>
			<address>
				
                <div class="left">
            		<span class="lambda-address"></span>
                </div>
				<div class="description" style="padding-left:25px;">
				<?php
					$address = array(
						'first_name' 	=> get_user_meta( $customer_id, 'shipping_first_name', true ),
						'last_name'		=> get_user_meta( $customer_id, 'shipping_last_name', true ),
						'company'		=> get_user_meta( $customer_id, 'shipping_company', true ),
						'address_1'		=> get_user_meta( $customer_id, 'shipping_address_1', true ),
						'address_2'		=> get_user_meta( $customer_id, 'shipping_address_2', true ),
						'city'			=> get_user_meta( $customer_id, 'shipping_city', true ),
						'state'			=> get_user_meta( $customer_id, 'shipping_state', true ),
						'postcode'		=> get_user_meta( $customer_id, 'shipping_postcode', true ),
						'country'		=> get_user_meta( $customer_id, 'shipping_country', true )
					);

					$formatted_address = $woocommerce->countries->get_formatted_address( $address );

					if (!$formatted_address) _e('You have not set up a shipping address yet.', 'woocommerce'); else echo $formatted_address;
				?>
                </div>
                <a href="<?php echo esc_url( add_query_arg('address', 'shipping', get_permalink(woocommerce_get_page_id('edit_address'))) ); ?>" class="edit woo-button"><?php _e('Edit', 'woocommerce'); ?></a>

			</address>

		</div><!-- /.col-2 -->

	</div><!-- /.col2-set -->

<?php endif; ?>