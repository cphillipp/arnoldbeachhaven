<?php 
//includes the header.php
get_header();

//can be found in functions/theme-woocommerce.php
lambda_woo_before_content();
lambda_woocommerce_content();
lambda_woo_after_content();

//includes the footer.php
get_footer();
?>