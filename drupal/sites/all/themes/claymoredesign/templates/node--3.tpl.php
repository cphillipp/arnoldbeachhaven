<div class="right-box border">
	<span class="house2"><img src="sites/all/themes/claymoredesign/images/surland.png" alt="Picture of Oregon coast beach from our beach house rental." /></a><span>enjoy beatuful beaches - oregon coast</span></span>
</div>
<div class="top push">
	<h1>Planning A Vacation?</h1>
	<p class="extra">See our booking info here:</p>
	<a class="button" href="contact" class="link">booking info!</a>
	<div class="clear"></div>
	<p class="extra">Check availability here:</p>
	<a class="button" title="Availability Calendar" href="http://www.Booking-Tracker.com?7013&P" target=_cal onclick="return !window.open('http://www.Booking-Tracker.com?7013&P&'+location.href,'_cal','resizable=1')">Sandy Shores</a>
	<span>AND</span>
	<a class="button" title="Availability Calendar" href="http://www.Booking-Tracker.com?7014&amp;P" target="_cal" onclick="return !window.open('http://www.Booking-Tracker.com?7014&amp;P&amp;'+location.href,'_cal','resizable=1')">Newport Haven</a>
</div>

<div class="USER three">
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