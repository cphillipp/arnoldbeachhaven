<div id="house2" class="right-box">
	<a href="sites/all/themes/claymoredesign/images/surland.png" title="Surland View" class="surland"><img src="sites/all/themes/claymoredesign/images/surland.png" alt="Surland View" /></a>
	<p>Surland View</p>
</div>
<div class="top">
	<h1>Contact Arnold Beach Haven</h1>
	<p>For inquiries call or email:</p>
	<p><span class="bold">Sharon Arnold</span> 541-867-7116</p>
	<p><span class="bold">E-mail:</span> <a href="mailto:sharon@arnoldbeachhaven.com">sharon@arnoldbeachhaven.com</a></p>
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