---
layout: post
title: jQuery 1.4 Released! (Let's have an end-to-end testing party)
permalink: /2010/01/jquery-1-4-released-lets-have-an-end-to-end-testing-party/index.html
post_id: 161
categories: 
- Development
- Javascript
- JQuery
- jquery 1.4
---

Query 1.4 was released as final on January 14, 2010, at 1pm (or so) EST.  The day it came out, I went to my boss and said "let's update! Woohoo! I'll order some cake" and he (yeah, yeah, rightfully) said "we need to discuss implications." Which was a good thing, because- well, why should we even bother with the days of testing that it'll require to switch out our framework?

I did some research, and there are some very, very compelling reasons. Here's what I wrote to our team:

We may want to look at updating, or at least putting it in and testing, soon.

Benefits of upgrading:
<ul>
	<li>Performance updates</li>
	<li>IE fixes, including some fixes to IE event bubbling</li>
	<li>Includes extra API calls and additions to existing functions</li>
	<li>Maintaining possibility to use new plugins as they are created for the latest version of jQuery</li>
	<li>Better handling for events (outside of just IE)- we can (should) refactor and reduce a lot of our jQuery code using events</li>
	<li>Better support for multiple simultaneous animations</li>
	<li>More granular "does my browser support X" checks</li>
</ul>
The downside is that we're going to have to do pretty thorough testing in all browsers to make sure that the update hasn't broken anything. The main areas to hit will be places that plugins are used:
<ul>
	<li>Autocomplete for country/state</li>
	<li>Loading screen in DE / Admin</li>
	<li>Media plugin that sets up flash for Audio Guest Book in display</li>
	<li>Simple Uploader</li>
	<li>Help boxes in DE</li>
</ul>
We'll need to spot-check around other areas of the site for javascript errors as well. jQuery still supports the same browsers- FF 2+, IE 6+, Safari 3+, Opera 9+, Chrome 1+ (<a href="http://docs.jquery.com/Browser_Compatibility" target="_blank">http://docs.jquery.com/Browser_Compatibility</a>) so we shouldn't expect any new weirdness in archaic browsers like IE6.

More information about the update can be found at:
<ul>
	<li><a href="http://css.dzone.com/articles/jquery-14-improves-code-and" target="_blank">http://css.dzone.com/articles/jquery-14-improves-code-and</a></li>
	<li><a href="http://api.jquery.com/category/version/1.4/" target="_blank">http://api.jquery.com/category/version/1.4/</a></li>
	<li><a href="http://docs.jquery.com/JQuery_1.4_Roadmap" target="_blank">http://docs.jquery.com/JQuery_1.4_Roadmap</a></li>
	<li><a href="http://jquery14.com/day-01/jquery-14" target="_blank">http://jquery14.com/day-01/jquery-14</a> (the best link, in my opinion)</li>
</ul>
Also: "15 new features you must know": <a href="http://net.tutsplus.com/tutorials/javascript-ajax/jquery-1-4-released-the-15-new-features-you-must-know/" target="_blank">http://net.tutsplus.com/tutorials/javascript-ajax/jquery-1-4-released-the-15-new-features-you-must-know/</a>

(Lower is better):
<div style="clear: both;"><a title="Performance of .html() by John Resig, on Flickr" href="http://www.flickr.com/photos/jeresig/4271691747/"><img class="alignleft" src="http://farm5.static.flickr.com/4037/4271691747_0cce01a33d.jpg" alt="Performance of .html()" width="240" height="180" /></a><a title="Performance of .remove() and .empty() by John Resig, on Flickr" href="http://www.flickr.com/photos/jeresig/4271690883/"><img class="alignleft" src="http://farm3.static.flickr.com/2693/4271690883_3224979b9b.jpg" alt="Performance of .remove() and .empty()" width="240" height="180" /></a>

<a title="Performance of .css() by John Resig, on Flickr" href="http://www.flickr.com/photos/jeresig/4271691599/"><img class="alignleft" src="http://farm5.static.flickr.com/4055/4271691599_8a2f2e0624.jpg" alt="Performance of .css()" width="240" height="180" /></a>

<a title="Performance of DOM Insertion by John Resig, on Flickr" href="http://www.flickr.com/photos/jeresig/4271691471/"><img class="alignleft" src="http://farm5.static.flickr.com/4029/4271691471_1240afd5af.jpg" alt="Performance of DOM Insertion" width="240" height="180" /></a>

<a title="# of Function Calls for Popular jQuery Methods by John Resig, on Flickr" href="http://www.flickr.com/photos/jeresig/4271691293/"><img src="http://farm3.static.flickr.com/2781/4271691293_324e506c7b.jpg" alt="# of Function Calls for Popular jQuery Methods" width="240" height="180" /></a>
</div>