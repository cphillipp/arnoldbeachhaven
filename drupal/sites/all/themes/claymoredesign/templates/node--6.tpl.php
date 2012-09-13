<div class="left-box push">
	<h1>Things to do</h1>
	<ul>
		<li><span></span>Sea Lion Caves: 19 miles south</li>
		<li><span></span>Cape Perpetua: 5 miles south</li>
		<li><span></span>Local Lighthouses</li>
		<li><span></span>Oregon Coast Aquarium:17 miles north</li>
		<li><span></span>Hatfield Science Center: 17 miles north</li>
		<li><span></span>Crabbing and Clamming in Alsea Bay: 5 miles north</li>
		<li><span></span>Deep Sea Fishing on Charter Boats: 17 miles north</li>
		<li><span></span>Oregon Sand Dunes: 32  miles south</li>
		<li><span></span>Strawberry Hill-great tide pools&sea lions: 8 miles south</li>
		<li><span></span>Golfing: 6 miles north</li>
		<li><span></span>Kite flying</li>
		<li><span></span>Beach: right out the back door</li>
		<li><span></span>Many quaint shops and  fine restaurants are located in Waldport, Yachats, and Newport.</li>
	</ul>
</div>
<div class="right-box border">
	<h1>Barefoot Sands</h1>
	<span class="house2"><img src="/sites/all/themes/claymoredesign/images/house2/house2-front.jpg" alt="Our beach front rental Barefoot Sands location."><span>see more images down below</span></span>
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
	<h2 class="center">More Photos of Barefoot Sands</h2>
	<a class="small-box" title="Barefoot Sands Frontal View" href="/sites/all/themes/claymoredesign/images/house2/house2-front.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/house2-front.jpg" alt=""><div class="plus"></div></a> 
	<a class="small-box" title="Barefoot Sands Back View" href="/sites/all/themes/claymoredesign/images/house2/bs-back-view02.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-back-view02.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Deck View" href="/sites/all/themes/claymoredesign/images/house2/bs-deck01.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-deck01.JPG" alt=""><div class="plus"></div></a>	
	<a class="small-box" title="Barefoot Sands Entryway View" href="/sites/all/themes/claymoredesign/images/house2/bs-entryway01.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-entryway01.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Kitchen View" href="/sites/all/themes/claymoredesign/images/house2/bs-kitchen01.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-kitchen01.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Kitchen View" href="/sites/all/themes/claymoredesign/images/house2/bs-kitchen02.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-kitchen02.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Kitchen View" href="/sites/all/themes/claymoredesign/images/house2/bs-kitchen03.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-kitchen03.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Dining View" href="/sites/all/themes/claymoredesign/images/house2/bs-dining01.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-dining01.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Living Room View" href="/sites/all/themes/claymoredesign/images/house2/bs-living01.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-living01.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Living Room View" href="/sites/all/themes/claymoredesign/images/house2/bs-living02.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-living02.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Living Room View" href="/sites/all/themes/claymoredesign/images/house2/bs-living03.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-living03.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Living Room View" href="/sites/all/themes/claymoredesign/images/house2/bs-living04.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-living04.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Living Room View" href="/sites/all/themes/claymoredesign/images/house2/bs-living05.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-living05.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Fireplace View" href="/sites/all/themes/claymoredesign/images/house2/bs-fire01.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-fire01.jpg" alt=""><div class="plus"></div></a> 
	<a class="small-box" title="Barefoot Sands Upstairs Bathroom View" href="/sites/all/themes/claymoredesign/images/house2/bs-bathroom01.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-bathroom01.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Master Bathroom View" href="/sites/all/themes/claymoredesign/images/house2/bs-bathroom02.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-bathroom02.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Upstairs Bedroom View" href="/sites/all/themes/claymoredesign/images/house2/bs-bedroom02.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-bedroom02.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Upstairs Bedroom View" href="/sites/all/themes/claymoredesign/images/house2/bs-bedroom03.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-bedroom03.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Master Bedroom View" href="/sites/all/themes/claymoredesign/images/house2/bs-bedroom04.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-bedroom04.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Master Bath View" href="/sites/all/themes/claymoredesign/images/house2/bs-bathroom03.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-bathroom03.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Upstairs Bedroom View" href="/sites/all/themes/claymoredesign/images/house2/bs-bedroom01.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-bedroom01.JPG" alt=""><div class="plus"></div></a>	
	<a class="small-box" title="Barefoot Sands Master Bedroom view downstairs" href="/sites/all/themes/claymoredesign/images/house2/bs-bedroom05.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-bedroom05.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Downstairs Bedroom View" href="/sites/all/themes/claymoredesign/images/house2/bs-bedroom06.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-bedroom06.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands View of the Beach" href="/sites/all/themes/claymoredesign/images/house2/house2-beach.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/house2-beach.jpg" alt=""><div class="plus"></div></a> 	
	<a class="small-box" title="Barefoot Sands Upstairs Bedroom View" href="/sites/all/themes/claymoredesign/images/house2/bs-bedroom07.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-bedroom07.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Master Bedroom View" href="/sites/all/themes/claymoredesign/images/house2/bs-ocean-view01.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-ocean-view01.JPG" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Beach View" href="/sites/all/themes/claymoredesign/images/house2/bs-beach01.JPG" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-beach01.JPG" alt=""><div class="plus"></div></a>	
	<a class="small-box" title="Barefoot Sands Sunset View" href="/sites/all/themes/claymoredesign/images/house2/house2-sunset.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/house2-sunset.jpg" alt=""><div class="plus"></div></a>
	<a class="small-box" title="Barefoot Sands Sunset View" href="/sites/all/themes/claymoredesign/images/house2/bs-sunset01.jpg" ><img src="/sites/all/themes/claymoredesign/images/house2/bs-sunset01.jpg" alt=""><div class="plus"></div></a>
</div>
<div class="calendar">
	<div class="back"></div>
	<h2>Availability Calendar</h2>
	<a class="button" title="Availability Calendar" href="http://www.Booking-Tracker.com?7014&amp;P" target="_cal" onclick="return !window.open('http://www.Booking-Tracker.com?7014&amp;P&amp;'+location.href,'_cal','resizable=1')">Calendar</a>
</div>
