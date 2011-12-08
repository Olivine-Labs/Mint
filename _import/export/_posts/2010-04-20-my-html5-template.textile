---
layout: post
title: My HTML5 Template
permalink: /2010/04/my-html5-template/index.html
post_id: 227
categories: 
- Cascading Style Sheets
- css
- Data Formats
- Development
- html
- HTML5
- Javascript
- JQuery
- Prototyping
- Style Sheets
- Web Design
- Web Standards
---

I've noticed that whenever I make a site, 99% of the time I copy _at least_ 50% of the markup from another site I've done before instead of re-writing the structure. It saves a lot of time, and it makes styling easy- I'm re-styling the same site as I've already done, maybe with different colors and images. So, what I've done is make a generic template that acts as a site-starter. It's pretty full, so it may not be to everyone's tastes, but it covers most scenarios I've run into.

<a href="http://www.thejacklawson.com/files/html5template/html5template.html" target="_blank">Here's what I use</a>. Feel free to copy it and do whatever you want, it's GPL v2 licensed. (<a href="http://www.thejacklawson.com/files/html5template/html5template.zip">zip file</a>)
<ul>
	<li>The <a href="http://code.google.com/p/html5shiv/">Html5 Shiv</a> (conditionally for IE, of course.)</li>
	<li>The CSS is Richard Clark's <a href="http://html5doctor.com/html-5-reset-stylesheet/" target="_blank">HTML5 Reset Stylesheet</a>, plus some stub styles like image / text replacement for the h1.</li>
	<li>Whatever jQuery UI 1.8 theme (if applicable.. most of my sites use jQuery UI, so I added it to my template.)</li>
	<li>Conditionally, an IE stylesheet. I go ahead and lump IE 6+ into one bucket. This could be broken out into several stylesheets (per IE version), but I've found that using the reset sheet generally limits the amount of IE fixes I have to do, so there's not much wasted download time at all for IE users. If your stylesheet gets too heavy, break it out at your discretion.</li>
	<li>Several IE conditional statements to build IE wrapper divs to make styling easier. If you're including styles by version, you probably don't need this. Also has the added benefit of fast browser version checks with jQuery.</li>
	<li>Header with heading, subheading. The h1 is a link sometimes, using css image/text replacement. I went back and forth on whether the page title or the site title should be an h1- and chose an h1 based on arguments on <a href="http://www.iheni.com/html-5-to-the-h1-debate-rescue/" target="_blank">this blog post</a>.</li>
	<li>Seperate nav. I almost put it with header- but I like keeping the header more pure for the logo/title and subheading.</li>
	<li>A div to wrap all of the content, and then a "maincontent" div. I haven't found better names yet, so here you go. They're not _section _elements, like most of the content is in- the structure is there strictly for styling reasons.</li>
	<li>An example section. I like giving it an id with the page title, so I can add in page-specific styles as needed.
<ul>
	<li>The section's header, and content, as is reccomended</li>
</ul>
</li>
	<li>An aside, styled as a right-hand column with subsections</li>
	<li>A footer, with links (probably the same as the main links), and copyright information. I've used an _address _element to wrap the webmaster's email. Semantics!</li>
	<li>Finally, jQuery 1.4.2 and jQuery UI 1.8 pulled from offsite sources (parallelize downloads, plus it's likely cached from another site)</li>
</ul>
So, the idea was to get about an hour or two's work done by simply opening up a file. I think I've accomplished this- anything extra I can remove, I can switch the left and right columns pretty easily (or add a third, or fourth), and I have some very basic styles down (just change those grays to something a little more colorful.) Be free, my template!
<div class="zemanta-pixie" style="margin-top: 10px; height: 15px;"><a class="zemanta-pixie-a" title="Reblog this post [with Zemanta]" href="http://reblog.zemanta.com/zemified/553e6b7d-4afe-465a-9cab-53b4c4a8145d/"><img class="zemanta-pixie-img" style="border: none; float: right;" src="http://img.zemanta.com/reblog_e.png?x-id=553e6b7d-4afe-465a-9cab-53b4c4a8145d" alt="Reblog this post [with Zemanta]" /></a><span class="zem-script more-related pretty-attribution"><script src="http://static.zemanta.com/readside/loader.js" type="text/javascript"></script></span></div>