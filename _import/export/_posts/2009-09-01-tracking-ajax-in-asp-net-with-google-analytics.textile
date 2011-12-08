---
layout: post
title: Tracking AJAX in ASP.NET with Google Analytics
permalink: /2009/09/tracking-ajax-in-asp-net-with-google-analytics/index.html
post_id: 102
categories: 
- ajax
- Analytics
- ASP.NET
- Development
- Google
- google analytics
- Javascript
- JQuery
- web trending
---

<div class="zemanta-img" style="margin: 1em; display: block;">
<div><dl class="wp-caption alignright" style="width: 250px;"> <dt class="wp-caption-dt"><a href="http://www.flickr.com/photos/76347018@N00/2290586287"><img title="Google analytics for recruitment" src="http://farm4.static.flickr.com/3243/2290586287_6c02972b60_m.jpg" alt="Google analytics for recruitment" /></a></dt> <dd class="wp-caption-dd zemanta-img-attribution" style="font-size: 0.8em;">Image by <a href="http://www.flickr.com/photos/76347018@N00/2290586287">carveconsulting</a> via Flickr</dd> </dl></div>
</div>
_(skip down a little further if you don't need an introduction to <a class="zem_slink" title="Google Analytics" rel="homepage" href="http://www.google.com/analytics">Google Analytics</a>.)_

I love <a class="zem_slink" title="Google" rel="homepage" href="http://google.com">Google</a> Analytics. In fact, I'm a big fan of Google as a whole, and I do the majority of my work using Google <a class="zem_slink" title="Google Docs" rel="homepage" href="http://docs.google.com/">Docs</a>, <a class="zem_slink" title="Google Calendar" rel="homepage" href="http://google.com/calendar">Calendar</a>, and Gmail (online collaboration! oh, and free) and Google Analytics is a beautiful tool for businesses, whether their <a class="zem_slink" title="Website" rel="wikipedia" href="http://en.wikipedia.org/wiki/Website">website</a>'s primary focus is online sales or just a small info-about-my-business site. If you don't have some kind of tracking, you're missing out on very important information; GA is a good place to start. Anybody can put GA into their website, and everybody should put something in.

The way GA works is by dropping a snippet of <a class="zem_slink" title="JavaScript" rel="wikipedia" href="http://en.wikipedia.org/wiki/JavaScript">Javascript</a> into your page; this javascript runs a series of tests against the visitor's browser, checking <a class="zem_slink" title="Display resolution" rel="wikipedia" href="http://en.wikipedia.org/wiki/Display_resolution">screen resolution</a>, flash capabilities, seeing if the user is unique, watching the user's path through the website, checking the user's location, and much, much more (all collected anonymously). This is all put into an interface where you can see the data collected and organized. However, <a class="zem_slink" title="Ajax (programming)" rel="wikipedia" href="http://en.wikipedia.org/wiki/Ajax_%28programming%29">AJAX</a> applications don't function as normal websites- you don't get a new <a class="zem_slink" title="Hit (internet)" rel="wikipedia" href="http://en.wikipedia.org/wiki/Hit_%28internet%29">page hit</a> every time you fire off an UpdatePanel, because it's not a full page refresh. So, we need to do a little trickery to get things to work the way we want them to.

_(you can start reading again if you skipped earlier.)_

If you have the Google Analytics in the host page (whether the aspx page, or more likely, the master page), then you have to register a client script block that calls the trackpageview method. If you use <a class="zem_slink" title="JQuery" rel="homepage" href="http://jquery.com/">jQuery</a>, it'll look something like:

@ScriptManager.RegisterClientScriptBlock(UpdatePanelID, typeof(UpdatePanel), "uniqueIdentifierString", "$(document).ready(function(){ pageTracker._trackPageview('/pagename'); });", true);@

If you're not using jQuery, you'll have to do a little more work to attach to the window's onload event, but it's pretty similar.
What you're doing is registering a script block to execute when the UpdatePanel updates (because it won't execute JS returned in the text), and using the pageTracker object (that the GA code you copied when you first set up GA on your site created) to force a pageview for a page you define. For my applications, I generally use something like "/dataentry/guestbook/edit" or "/dataentry/guestbook/delete" so that I can easily track guestbook views, as well as edits / deletes. It's both a way to track controls you load via AJAX, and a cheap shot at logging (not perfect data, though, so you're still best off doing all of your own logging on events, of course.)

The official Google help doc on the subject is also here: <a href="http://www.google.com/support/analytics/bin/answer.py?hl=en&answer=55519" target="_blank">http://www.google.com/support/analytics/bin/answer.py?hl=en&answer=55519</a>
<div class="zemanta-pixie" style="margin-top: 10px; height: 15px;"><a class="zemanta-pixie-a" title="Reblog this post [with Zemanta]" href="http://reblog.zemanta.com/zemified/570dfef3-4261-4739-9d63-560430307e2b/"><img class="zemanta-pixie-img" style="border: medium none ; float: right;" src="http://img.zemanta.com/reblog_e.png?x-id=570dfef3-4261-4739-9d63-560430307e2b" alt="Reblog this post [with Zemanta]" /></a><span class="zem-script more-related pretty-attribution"><script src="http://static.zemanta.com/readside/loader.js" type="text/javascript"></script></span></div>