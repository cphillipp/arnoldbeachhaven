<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Get tabs
ob_start();

do_action('woocommerce_product_tabs');

$tabs = trim( ob_get_clean() );

if ( ! empty( $tabs ) ) : ?>
	<section class="woocommerce-tabs full-width">
		<ul class="tabs">
			<?php echo $tabs; ?>
		</ul>
		<?php do_action('woocommerce_product_tab_panels'); ?>
	</section>
<?php endif; ?>