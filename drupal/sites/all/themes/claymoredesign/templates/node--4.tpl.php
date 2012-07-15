<div id="house" class="right-box">
	<a href="sites/all/themes/claymoredesign/images/surland.png" title="Surland View" class="surland"><img src="sites/all/themes/claymoredesign/images/surland.png" alt="Surland View" /><span>Surland View - click to enlarge</span></a>
</div>
<div class="top push">
	<h1>Arnold Beach Haven</h1>
	<p>Ready to book your vacation, or have questions?</p>
	<h2><span>Phone:</span> Sharon Arnold - 541-867-7116</h2>
	<h2><span>Email:</span> <a href="mailto:sharon@arnoldbeachhaven.com">sharon@arnoldbeachhaven.com</a></h2>
</div>

<div class="USER four">
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