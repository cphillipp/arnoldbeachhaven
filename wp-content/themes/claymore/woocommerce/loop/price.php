<?php global $product; ?>

<?php if ($price_html = $product->get_price_html()) : ?>
	<span class="price"><?php echo $price_html; ?></span><div class="clear"></div>
<?php endif; ?>