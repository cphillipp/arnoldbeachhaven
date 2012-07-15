<div id="house2" class="right-box">
	<a href="sites/all/themes/claymoredesign/images/surland.png" title="Surland View" class="surland"><img src="sites/all/themes/claymoredesign/images/surland.png" alt="Surland View" /></a>
	<p>Surland View</p>
</div>
<div class="top">
	<h1>Availability</h1>
	<div class="left-side">
		<h2>Sandy Shores</h2>
		<a class="button" title="Availability Calendar" href="http://www.Booking-Tracker.com?7013&P" target=_cal onclick="return !window.open('http://www.Booking-Tracker.com?7013&P&'+location.href,'_cal','resizable=1')">Calendar</a>
	</div>
	<div class="right-side">
		<h2>Barefoot Sands</h2>
		<a class="button" title="Availability Calendar" href="http://www.Booking-Tracker.com?7014&amp;P" target="_cal" onclick="return !window.open('http://www.Booking-Tracker.com?7014&amp;P&amp;'+location.href,'_cal','resizable=1')">Calendar</a>
	</div>
	<p><a href="contact-us.php" class="link">Contact Us Here</a> to book your vacation now!</p>
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