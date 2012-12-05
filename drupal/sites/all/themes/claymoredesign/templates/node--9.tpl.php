<div class="left-box push">
	<h1>Things to do</h1>
	<ul>
		<li><span></span>Oregon Coast Aquarium: 3 miles north</li>
		<li><span></span>Hatfield Science Center: 3 miles north</li>
		<li><span></span>Crabbing in Yaquina Bay: 3 miles north</li>
		<li><span></span>Deep Sea Fishing on the local charter vessels for tourists: 3 miles</li>
		<li><span></span>Local Lighthouses</li>
		<li><span></span>Casino in Lincoln City: 32 miles north</li>
		<li><span></span>Outlet Mall in Lincoln City: 29 miles north</li>
		<li><span></span>Cape Perpetua: 23 miles south</li>
		<li><span></span>Sea Lion Caves: 37 miles south</li>
		<li><span></span>Oregon Sand Dunes: 50 miles south</li>
		<li><span></span>Strawberry Hill: great tide pools & sea lions: 26 miles south</li>
		<li><span></span>Golfing: 6 miles north</li>
		<li><span></span>Kite flying: on the beach by the house</li>
		<li><span></span>Many quaint shops and  fine restaurants are located in Waldport, Yachats, and Newport.</li>
	</ul>
</div>
<div class="right-box border">
	<h1>Newport Haven</h1>
	<span class="house2"><img src="/sites/all/themes/claymoredesign/images/house2/newport-house-front.jpg" alt="Our beach front rental Arnold Beach Haven Newport location."><span>see more images down below</span></span>
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
	<h2 class="center">More Photos of Newport Haven</h2>
	<a class="small-box" title="Newport House Front View" href="/sites/all/themes/claymoredesign/images/house2/newport-house-front.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-house-front.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Back View" href="/sites/all/themes/claymoredesign/images/house2/newport-house-back.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-house-back.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Deck View" href="/sites/all/themes/claymoredesign/images/house2/newport-view-from-deck.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-view-from-deck.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Elevator View" href="/sites/all/themes/claymoredesign/images/house2/newport-elevator-door-closed-in-kitchen.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-elevator-door-closed-in-kitchen.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Elevator View" href="/sites/all/themes/claymoredesign/images/house2/newport-elevator-open.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-elevator-open.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Sink View" href="/sites/all/themes/claymoredesign/images/house2/newport-kitchen-sink01.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-kitchen-sink01.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Sink View" href="/sites/all/themes/claymoredesign/images/house2/newport-kitchen-sink02.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-kitchen-sink02.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Kitchen View" href="/sites/all/themes/claymoredesign/images/house2/newport-kitchen01.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-kitchen01.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Kitchen View" href="/sites/all/themes/claymoredesign/images/house2/newport-kitchen02.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-kitchen02.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Fireplace View" href="/sites/all/themes/claymoredesign/images/house2/newport-living-room-and-fireplace.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-living-room-and-fireplace.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Living Room View" href="/sites/all/themes/claymoredesign/images/house2/newport-living-room.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-living-room.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Master Bath View" href="/sites/all/themes/claymoredesign/images/house2/newport-master-bath-shower.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-master-bath-shower.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Master Bath View" href="/sites/all/themes/claymoredesign/images/house2/newport-master-bath.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-master-bath.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Dining Room View" href="/sites/all/themes/claymoredesign/images/house2/newport-veiw-from-Living-room-of-dining-room-and-fireplace.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-veiw-from-Living-room-of-dining-room-and-fireplace.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Dining Room View" href="/sites/all/themes/claymoredesign/images/house2/newport-view-from-living-room-of-dining-room-and-kitchen.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-view-from-living-room-of-dining-room-and-kitchen.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Dining Room View" href="/sites/all/themes/claymoredesign/images/house2/newport-view-from-living-room-of-dining-room-and-kitchen02.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-view-from-living-room-of-dining-room-and-kitchen02.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Living Room View" href="/sites/all/themes/claymoredesign/images/house2/newport-view-out-of-living-room.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-view-out-of-living-room.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Sunset View" href="/sites/all/themes/claymoredesign/images/house2/newport-sunset.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-sunset.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Beach Kid View" href="/sites/all/themes/claymoredesign/images/house2/newport-kid-beach.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-kid-beach.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Beach View" href="/sites/all/themes/claymoredesign/images/house2/newport-beach01.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-beach01.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Newport House Beach View" href="/sites/all/themes/claymoredesign/images/house2/newport-beach02.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/newport-beach02.jpg" alt=""><div class="plus"></div></a>
</div>
<div class="calendar">
	<div class="back"></div>
	<h2>Availability Calendar</h2>
	<a class="button" title="Availability Calendar" href="http://www.Booking-Tracker.com?7014&amp;P" target="_cal" onclick="return !window.open('http://www.Booking-Tracker.com?7014&amp;P&amp;'+location.href,'_cal','resizable=1')">Calendar</a>
</div>
