---
layout: post
title: ASP.NET Controls, How I Hate Them
permalink: /2010/02/asp-net-controls-how-i-hate-them/index.html
post_id: 204
categories: 
- .net
- .NET Framework
- Add new tag
- ASP
- ASP.NET
- ASP.NET AJAX
- Component Frameworks
- Development
- General
- IIS and Windows Technologies
- JQuery
- PHP
- Programming
---

<div class="zemanta-img" style="margin: 1em; display: block;">
<div><dl class="wp-caption alignright" style="width: 250px;"><dt class="wp-caption-dt"><a href="http://www.flickr.com/photos/57798571@N00/2398917253"><img title="MSDN Error" src="http://farm3.static.flickr.com/2354/2398917253_6bcafbbd76_m.jpg" alt="MSDN Error" width="240" height="106" /></a></dt><dd class="wp-caption-dd zemanta-img-attribution" style="font-size: 0.8em;">Image by <a href="http://www.flickr.com/photos/57798571@N00/2398917253">ttrentham</a> via Flickr</dd></dl></div>
</div>
I've always, for some reason, felt innately that <a class="zem_slink" title="PHP" rel="homepage" href="http://www.php.net/">PHP</a> allowed me more control over my code than <a class="zem_slink" title="ASP.NET" rel="homepage" href="http://www.asp.net">ASP.NET</a>. My _brain _kept saying "but .NET is more organized! It compiles! It's faster! It's easier to write," but my _mind _kept saying "PHP lets me do what I want how I want it... screw .NET!"

What I finally figured out was that I love C#, I even like the <a class="zem_slink" title=".NET Framework" rel="homepage" href="http://msdn.microsoft.com/netframework/">.NET framework</a>, but I hate is, in fact, ASP.NET.

Every time I see an example of simple, elegant code, the most complex control on the page is a label or a panel. While the intentions behind FormView may be good, writing my own forms and hooking them up saves hundreds of lines (literally- I just refactored almost 800 lines of code into 150 by _removing _a formview) as well as reduces complexity and maintenance (now I no longer have to maintain view and edit and whatever other modes FormView has.) ASP.NET perhaps made sense in a day before OO principles and ORMs came into play; the controls were written for the same kind of people that use the drag-and-drop design mode. Easy to slap down haphazardly, not so easy to maintain.

We replaced every ASP.NET <a class="zem_slink" title="ASP.NET AJAX" rel="wikipedia" href="http://en.wikipedia.org/wiki/ASP.NET_AJAX">Ajax</a> control we used anywhere (after I evangelized it, to my chagrin) with <a class="zem_slink" title="JQuery" rel="homepage" href="http://jquery.com/">jQuery</a> after about 6 months of use; while the controls did what we needed on the surface, underneath there was _always_ some caveat, like the linked DropDowns needed web services, or the datepicker control had missing options... there was always something somewhere that I needed a bit of flexibility on that just wasn't there, or was buggy. It seemed very odd for it to be out of beta in such a state. So, I ended up starting my own control library using jQuery, and now it's easily extensible, easy to modify from the client, and I can control the markup.

Oh, and the markup... don't get me started on the markup. Tables for _everything_. I can't rearrange the otherwise useful Wizard control because it's so static in its display.

So, I guess the point I'm trying to make is, that the longer I use .NET, the less and less I use the complex controls and the more I roll my own. Because it's _easier_.
Kind of ironic.
<div class="zemanta-pixie" style="margin-top: 10px; height: 15px;"><a class="zemanta-pixie-a" title="Reblog this post [with Zemanta]" href="http://reblog.zemanta.com/zemified/4d9cd1b1-cc21-4241-b625-e55c125fd955/"><img class="zemanta-pixie-img" style="border: medium none; float: right;" src="http://img.zemanta.com/reblog_e.png?x-id=4d9cd1b1-cc21-4241-b625-e55c125fd955" alt="Reblog this post [with Zemanta]" /></a><span class="zem-script more-related pretty-attribution"><script src="http://static.zemanta.com/readside/loader.js" type="text/javascript"></script></span></div>