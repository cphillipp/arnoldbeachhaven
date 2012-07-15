<div id="house1" class="left-box">
	<h2>Sandy Shores</h2>
	<a class="house1" title="Sandy Shores Frontal View" href="sites/all/themes/claymoredesign/images/house1-front.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-front.jpg" alt="Sandy Shores Frontal View"></a> 
	<a class="hide" title="Sandy Shores Master Bedroom" href="sites/all/themes/claymoredesign/images/house1-masterbed.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-masterbed.jpg" alt="Sandy Shores Master Bedroom"></a> 
	<a class="hide" title="Sandy Shores Master Bedroom" href="sites/all/themes/claymoredesign/images/house1-masterbed2.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-masterbed2.jpg" alt="Sandy Shores Master Bedroom"></a> 
	<a class="hide" title="Sandy Shores Kitchen" href="sites/all/themes/claymoredesign/images/house1-kitchen.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-kitchen.jpg" alt="Sandy Shores kitchen"></a> 
	<a class="hide" title="Sandy Shores Downstairs Bedroom" href="sites/all/themes/claymoredesign/images/house1-downstairsbed.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-downstairsbed.jpg" alt="Sandy Shores Downstairs Bedroom"></a> 
	<a class="hide" title="Sandy Shores Living Room" href="sites/all/themes/claymoredesign/images/house1-livingroom.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-livingroom.jpg" alt="Sandy Shores Living Room"></a> 
	<a class="hide" title="Sandy Shores Back View" href="sites/all/themes/claymoredesign/images/house1-back.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-back.jpg" alt="Sandy Shores Back View"></a> 
	<a class="hide" title="Sandy Shores Back View" href="sites/all/themes/claymoredesign/images/house1-back2.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-back2.jpg" alt="Sandy Shores Back View"></a> 
	<a class="hide" title="Sandy Shores Deck View" href="sites/all/themes/claymoredesign/images/house1-deck.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-deck.jpg" alt="Sandy Shores Deck View"></a> 
	<a class="hide" title="Sandy Shores Beach View" href="sites/all/themes/claymoredesign/images/house1-beach.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-beach.jpg" alt="Sandy Shores Beach View"></a> 
	<a class="hide" title="Sandy Shores Sunset View" href="sites/all/themes/claymoredesign/images/house1-sunset.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-sunset.jpg" alt="Sandy Shores Sunset View"></a>
	<p>Click the image above to begin the slideshow</p>
</div>
<div id="house2" class="right-box">
	<h2>Barefoot Sands</h2>
	<a class="house2" title="Barefoot Sands Frontal View" href="sites/all/themes/claymoredesign/images/house2/house2-front.jpg" ><img src="sites/all/themes/claymoredesign/images/house2/house2-front.jpg" alt=""></a> 
	<a class="hide" title="Barefoot Sands Back View" href="sites/all/themes/claymoredesign/images/house2/house2-back.jpg" ><img src="sites/all/themes/claymoredesign/images/house2/house2-back.jpg" alt=""></a> 
	<a class="hide" title="Barefoot Sands Fireplace View" href="sites/all/themes/claymoredesign/images/house2/house2-fireplace.jpg" ><img src="sites/all/themes/claymoredesign/images/house2/house2-fireplace.jpg" alt=""></a> 
	<a class="hide" title="Barefoot Sands Kitchen View" href="sites/all/themes/claymoredesign/images/house2/house2-kitchen.jpg" ><img src="sites/all/themes/claymoredesign/images/house2/house2-kitchen.jpg" alt=""></a> 
	<a class="hide" title="Barefoot Sands Master Bed View" href="sites/all/themes/claymoredesign/images/house2/house2-master-bed.jpg" ><img src="sites/all/themes/claymoredesign/images/house2/house2-master-bed.jpg" alt=""></a> 
	<a class="hide" title="Barefoot Sands View of the Beach" href="sites/all/themes/claymoredesign/images/house2/house2-view.jpg" ><img src="sites/all/themes/claymoredesign/images/house2/house2-view.jpg" alt=""></a> 
	<a class="hide" title="Barefoot Sands View of the Beach" href="sites/all/themes/claymoredesign/images/house2/house2-beach.jpg" ><img src="sites/all/themes/claymoredesign/images/house2/house2-beach.jpg" alt=""></a> 
	<a class="hide" title="Barefoot Sands Sunset View" href="sites/all/themes/claymoredesign/images/house2/house2-sunset.jpg" ><img src="sites/all/themes/claymoredesign/images/house2/house2-sunset.jpg" alt=""></a>
	<p>Click the image above to begin the slideshow</p>
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