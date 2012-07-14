<div class="banner">
	<div id="slides">
		<div class="slides_container">
			<div class="slide">
				<img src="sites/all/themes/claymoredesign/images/banner01.jpg" alt="Sites to see on the Oregon Coast while staying at our Beach house rentals.">
				<div class="caption" style="bottom: 0;"><p>Enjoy Beatuful Landmarks - Oregon Light house</p></div>
			</div>
			<div class="slide">
				<img src="sites/all/themes/claymoredesign/images/banner02.jpg" alt="Large spaciouse interior room of our Oregon beach house rental.">
				<div class="caption"><p>Property Interior - Comfortable and Spaciouse</p></div>
			</div>
			<div class="slide">
				<img src="sites/all/themes/claymoredesign/images/banner03.jpg" alt="Oregon coast beach front of our rental house.">
				<div class="caption"><p>Beach Front Properties - Oregon Coast</p></div>
			</div>
			<div class="slide">
				<img src="sites/all/themes/claymoredesign/images/banner04.jpg" alt="Oregon Coast Marina and fishing boats.">
				<div class="caption"><p>One of a kind Marine experience - Oregon Bay Front</p></div>
			</div>
		</div>
	</div>
</div>

<div class="USER">
	<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

	  <?php print render($title_prefix); ?>
	  <?php if (!$page): ?>
	    <h2<?php print $title_attributes; ?>>
	      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
	    </h2>
	  <?php endif; ?>
	  <?php print render($title_suffix); ?>

	  <?php if ($display_submitted): ?>
	    <div class="meta submitted">
	      <?php print $user_picture; ?>
	      <?php print $submitted; ?>
	    </div>
	  <?php endif; ?>

	  <div class="content clearfix"<?php print $content_attributes; ?>>
	    <?php
	      // We hide the comments and links now so that we can render them later.
	      hide($content['comments']);
	      hide($content['links']);
	      print render($content);
	    ?>
	  </div>

	  <?php
	    // Remove the "Add new comment" link on the teaser page or if the comment
	    // form is being displayed on the same page.
	    if ($teaser || !empty($content['comments']['comment_form'])) {
	      unset($content['links']['comment']['#links']['comment-add']);
	    }
	    // Only display the wrapper div if there are links.
	    $links = render($content['links']);
	    if ($links):
	  ?>
	    <div class="link-wrapper">
	      <?php print $links; ?>
	    </div>
	  <?php endif; ?>

	  <?php print render($content['comments']); ?>

	</div>
</div>