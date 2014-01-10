<?php

global $post;

if ( ! $post->post_excerpt ) return;
?>
<div itemprop="description" class="shortdescription">
	<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
</div>