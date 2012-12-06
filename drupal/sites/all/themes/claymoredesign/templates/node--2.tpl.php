<div class="left-box">
	<h1>Sandy Shores</h1>
	<a class="house1" title="Sandy Shores Frontal View" href="?q=node/5" ><img src="/sites/all/themes/claymoredesign/images/ss-front-view.jpg" alt="Sandy Shores Frontal View"><div class="plus"></div><span>click for more info</span></a> 
</div>
<div class="right-box">
	<h1>Barefoot Sands</h1>
	<a class="house2" title="Barefoot Sands Frontal View" href="?q=node/6" ><img src="/sites/all/themes/claymoredesign/images/house2/house2-front.jpg" alt="Barefoot Sands Frontal View"><div class="plus"></div><span>click for more info</span></a> 
</div>

<div class="left-box">
	<h1>Newport Haven</h1>
	<a class="house1" title="Sandy Shores Frontal View" href="?q=node/9" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-house-front.jpg" alt="Sandy Shores Frontal View"><div class="plus"></div><span>click for more info</span></a> 
</div>
<div class="right-box">
	<h1>Property Updates</h1>
	<p style="color:#FFFFFF; font-size:12px;">We have decided to move back to our Barefoot Home. It will no longer be available after January 1st. We will be replacing Barefoot with our beautiful Newport home. It will be available starting with the 2nd weekend in January. It is much larger,and just south of Newport. You will have easy access to all that Newport has to offer. Check out the pictures and info. The living room furniture will be different. The pictures are from5 years ago. We are excited about this change and think you will be too!</p>
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