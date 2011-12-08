---
layout: post
title: Analytics
permalink: /2008/06/analytics/index.html
post_id: 15
categories: 
- Analytics
- Google
- google analytics
- web trending
---

Having searched through a large number of analytics software, I was extremely surprised at the lack of, well, good software. It seemed that there were two ends on the spectrum: cheap (or free) software that took years to parse through IIS log files and then still recompiled every time you clicked a link, or there was the really, really expensive stuff that did everything you wanted and sends a team to wash your car every other Tuesday. Having looked through about a dozen tools, I finally found a fit: Google Analytics.

GA is a beautiful tool; just throw in a .js file, a couple variable configurations, and you're done. It'll show you everthing from the most common city people are visiting from, to the highest web browser / OS combo (which is extremely useful.. can we drop IE 6 YET? The CSS support is killing me). It's got every metric I could hope to track. However, that doesn't solve all problems - what do we do with old trending data? How do we get them together? How do we archive these Google reports?

Even then, the answer is clear: the holy grail of universal data format, XML. Google Analytics very conveniently exports all reports as XML format, so it's really just a matter of taking all of the old data and pushing it through a little tool thrown together quickly using Visual Studio, which parses and exports data in Google's XML format. Now we've got all of our data stored and backed up, and even ready for the next thing to come after Google.

I'll attach a breakdown of all of the different tools we looked at, tomorrow.
