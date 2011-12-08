---
layout: post
title: "HTML5 Site \xE2\x80\x93 Waterford Family Bowl (Part 3 of n)"
permalink: /2010/05/html5-site-waterford-family-bowl-part-3/index.html
post_id: 230
categories: 
- Atom
- Cascading Style Sheets
- Development
- Google
- html
- Javascript
- JQuery
- PHP
- RSS
- Simplepie
- Wordpress
---

<div class="zemanta-img" style="margin: 1em; display: block;">
<div><dl class="wp-caption alignright" style="width: 138px;"> <dt class="wp-caption-dt"><a href="http://commons.wikipedia.org/wiki/Image:Feed-icon.svg"><img title="This icon, known as the "feed icon" ..." src="http://upload.wikimedia.org/wikipedia/commons/thumb/4/43/Feed-icon.svg/128px-Feed-icon.svg.png" alt="This icon, known as the "feed icon" ..." width="128" height="128" /></a></dt> <dd class="wp-caption-dd zemanta-img-attribution" style="font-size: 0.8em;">Image via <a href="http://commons.wikipedia.org/wiki/Image:Feed-icon.svg">Wikipedia</a></dd> </dl></div>
</div>
(<a href="http://www.thejacklawson.com/index.php/2010/04/html5-site-waterford-family-bowl-part-1-of-n/">Back to beginning of series</a>)

Part 3: Site Architecture Design

Now that I had the majority of the HTML and CSS down, I had more to figure out about how to implement the various features (like image gallery, news,and mailing list). Should I write my own, or should I use existing tools? What language should I use? What database system? Which pages should be static, which dynamic? The process of building he site was all about efficiency: getting the most done, using the best tools, in the least amount of time. That would allow me to focus as much time as possible in my before my deadline towards the things that will make a difference: site design, usability, and the the use of the features on the site.

I came with the conclusion that I could, and should, develop most of the data management using external tools. Spending time re-inventing the wheel and rebuilding tools that already have dedicated teams would be wasteful, especially when they all had some sort of hook (mostly RSS feeds) that I could just pull into the site. I was familiar with all the 3rd party tools I needed, so I was already comfortable with using them and knew they had the features that I needed. I came up with:
<ul>
	<li><a href="http://www.google.com/apps/intl/en/business/index.html" target="_blank">Google Apps</a> for email and calendar
<ul>
	<li><a href="http://om4.com.au/client/embedding-google-apps-calendar/" target="_blank">Here's a good tutorial</a>. It was a little messy at first, but it gives you an iframe (the only standards-breaking thing on the site... thanks, Goog) that you can just drop in.</li>
</ul>
</li>
	<li><a href="http://picasa.google.com/" target="_blank">Picasa</a> for photo gallery
<ul>
	<li>I chose Picasa for a few reasons, the largest of which was the integration of the Google Apps account. While there's no "Picasa" section of Google Apps, I could use the account I set up to minimize the logins I'm using, now that I'm using four tools. I used the RSS feed to export to the image gallery and to make an image gallery  RSS link on the home page.</li>
</ul>
</li>
	<li><a href="http://wordpress.org/" target="_blank">Wordpress</a> for dynamic pages and news
<ul>
	<li>The reason I used Wordpress, and I didn't just slap together my own editor, was the <a href="http://wordpress.org/extend/plugins/page-feeder/" target="_blank">WCM Page Feeder</a> plugin. It allows you to serve individual Wordpress pages as an RSS feed. This means that I could use WP's superior news-serving tools along with their page editing tools with very simple integration. I also added an RSS link to the home page, for news.</li>
</ul>
</li>
	<li><a href="http://pommo.org/Main_Page" target="_blank">Pommo</a> for mailing list management
<ul>
	<li>I tried out a few tools, and found this to be the easiest to set up. Makes adding an email form pretty simple, manages everything for me. Another several hours saved to these guys. Here's some credit :D</li>
</ul>
</li>
</ul>
I also used a couple 3rd party PHP Libraries so that I could hook all of this lovliness together:
<ul>
	<li><a href="http://simplepie.org/" target="_blank">Simplepie</a> RSS Reader
<ul>
	<li>Note: I had to switch my Wordpress RSS feeds over to Atom, even though SP claims it can read the RSS 2.0 standard. This was a simple checkbox in the "Writing" section of the Wordpress settings.</li>
</ul>
</li>
	<li>phpmailer for mail functions
<ul>
	<li>A little messy to set up to go through Google Apps mail. I had to set <a href="http://pastebin.com/GDP5XKCq" target="_blank">these settings</a> in class.phpmailer.php in order to connect without errors. Once you have this part right, though, you're good to go. I'll go into more detail about this in the next article.</li>
</ul>
</li>
</ul>
Once all of these tools were in place, it was a simple matter of dumping their content, using Simplepie, into my template. I'll talk about the actual hooking up of everything, and setting up the custom code I did write, in the next article.
<div class="zemanta-pixie" style="margin-top: 10px; height: 15px;"><a class="zemanta-pixie-a" title="Reblog this post [with Zemanta]" href="http://reblog.zemanta.com/zemified/f9e4b859-6bc3-4877-814b-f8ba4e564441/"><img class="zemanta-pixie-img" style="border: none; float: right;" src="http://img.zemanta.com/reblog_e.png?x-id=f9e4b859-6bc3-4877-814b-f8ba4e564441" alt="Reblog this post [with Zemanta]" /></a><span class="zem-script more-related pretty-attribution"><script src="http://static.zemanta.com/readside/loader.js" type="text/javascript"></script></span></div>