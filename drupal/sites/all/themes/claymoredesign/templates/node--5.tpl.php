<div id="house" class="left-box">
	<h1>Sandy Shores</h1>
	<a class="house1" title="Sandy Shores Frontal View" href="sites/all/themes/claymoredesign/images/house1-front.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-front.jpg" alt="Sandy Shores Frontal View"><span>click to begin the slideshow</span></a> 
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
</div>
<div id="house" class="right-box">
	<h1>THINGS TO DO</h1>
	<ul>
		<li><span></span>Sea Lion Caves: 20 miles south</li>
		<li><span></span>Cape Perpetua: 6 miles south</li>
		<li><span></span>Local Lighthouses</li>
		<li><span></span>Oregon Coast Aquarium: 16 miles north</li>
		<li><span></span>Hatfield Science Center:  16 miles north</li>
		<li><span></span>Crabbing and Clamming in Alsea Bay:  4 miles north</li>
		<li><span></span>Deep Sea Fishing on Charter Boats:  16 miles north</li>
		<li><span></span>Oregon Sand Dunes:  33  miles south</li>
		<li><span></span>Strawberry Hill, great tide pools &amp; sea lions:  9 miles south</li>
		<li><span></span>Golfing:  5 miles north</li>
		<li><span></span>Kite flying</li>
		<li><span></span>Beach:  right out the back door</li>
		<li><span></span>Many quaint shops and  fine restaurants are located in Waldport, Yachats, and Newport.</li>
	</ul>
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
<div id="house2" class="bottom">
	<h2 class="center">More Photos of Sandy Shores</h2>
	<a class="small-box" title="Sandy Shores Frontal View" href="sites/all/themes/claymoredesign/images/house1-front.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-front.jpg" alt="Sandy Shores Frontal View"><div class="plus"></div></a> 
	<a class="small-box" title="Sandy Shores Master Bedroom" href="sites/all/themes/claymoredesign/images/house1-masterbed.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-masterbed.jpg" alt="Sandy Shores Master Bedroom"><div class="plus"></div></a> 
	<a class="small-box" title="Sandy Shores Master Bedroom" href="sites/all/themes/claymoredesign/images/house1-masterbed2.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-masterbed2.jpg" alt="Sandy Shores Master Bedroom"><div class="plus"></div></a> 
	<a class="small-box" title="Sandy Shores Kitchen" href="sites/all/themes/claymoredesign/images/house1-kitchen.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-kitchen.jpg" alt="Sandy Shores kitchen"><div class="plus"></div></a> 
	<a class="small-box" title="Sandy Shores Downstairs Bedroom" href="sites/all/themes/claymoredesign/images/house1-downstairsbed.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-downstairsbed.jpg" alt="Sandy Shores Downstairs Bedroom"><div class="plus"></div></a> 
	<a class="small-box" title="Sandy Shores Living Room" href="sites/all/themes/claymoredesign/images/house1-livingroom.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-livingroom.jpg" alt="Sandy Shores Living Room"><div class="plus"></div></a> 
	<a class="small-box" title="Sandy Shores Back View" href="sites/all/themes/claymoredesign/images/house1-back.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-back.jpg" alt="Sandy Shores Back View"><div class="plus"></div></a> 
	<a class="small-box" title="Sandy Shores Back View" href="sites/all/themes/claymoredesign/images/house1-back2.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-back2.jpg" alt="Sandy Shores Back View"><div class="plus"></div></a> 
	<a class="small-box" title="Sandy Shores Deck View" href="sites/all/themes/claymoredesign/images/house1-deck.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-deck.jpg" alt="Sandy Shores Deck View"><div class="plus"></div></a> 
	<a class="small-box" title="Sandy Shores Beach View" href="sites/all/themes/claymoredesign/images/house1-beach.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-beach.jpg" alt="Sandy Shores Beach View"><div class="plus"></div></a> 
	<a class="small-box" title="Sandy Shores Sunset View" href="sites/all/themes/claymoredesign/images/house1-sunset.jpg" ><img src="sites/all/themes/claymoredesign/images/house1-sunset.jpg" alt="Sandy Shores Sunset View"><div class="plus"></div></a>
</div>
<div class="calendar">
	<div class="back"></div>
	<h2>Availability Calendar</h2>
	<a class="button" title="Availability Calendar" href="http://www.Booking-Tracker.com?7013&P" target=_cal onclick="return !window.open('http://www.Booking-Tracker.com?7013&P&'+location.href,'_cal','resizable=1')">Calendar</a>
</div>
