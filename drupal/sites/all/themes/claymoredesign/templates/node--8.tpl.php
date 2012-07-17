<div class="left-box push">
	<h1>Things we do</h1>
	<ul>
		<li><span></span>Take our kids to the Oregon Coast Aquarium</li>
		<li><span></span>Crabbing in the bay</li>
		<li><span></span>Deep Sea Fishing on the ocean</li>
		<li><span></span>Camp fires on the beach</li>
		<li><span></span>Shopping at the local shops</li>
	</ul>
</div>
<div class="right-box border">
	<span class="house2"><img src="/sites/all/themes/claymoredesign/images/banner03.jpg" alt="Image of the ocean and beach from our beach front rental."><span>enjoy beatuful beaches - oregon coast</span></span>
</div>

<div class="USER one">
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