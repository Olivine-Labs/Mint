---
layout: post
title: ASP.NET 4.0 Changes tl;dr
permalink: /2010/06/asp-net-4-0-changes-tldr/index.html
post_id: 252
categories: 
- ASP.NET
- Development
---

*ASP.NET 4.0 Updates* - <a href="http://www.asp.net/learn/whitepapers/aspnet4">http://www.asp.net/learn/whitepapers/aspnet4</a>

tl;dr:
<ul>
	<li>Stuff moved from web.config to machine.config</li>
	<li>More robust XSS checking and form post validation</li>
	<li>More streamlined inclusion of Microsoft AJAX framework (UpdatePanels), and jQuery (which Microsoft officially includes now)</li>
	<li>More control over viewstate</li>
	<li>Built-in page routing for webforms (how MVC urls work, but now works with webforms. <a href="http://www.mem.com/contentdisplay/5123431">www.mem.com/contentdisplay/5123431</a> for example)</li>
	<li>Setting client IDs on controls instead of ASP.NET building it for you</li>
	<li>New Chart control</li>
	<li>Project templates slimmed down</li>
	<li>Better CSS styling on controls, option to not render tables around some controls (formview, login, stuff like that)</li>
	<li>ASP.NET MVC2</li>
	<li>Intellisense improvements</li>
</ul>
Tl;dr: tl;dr: Lots of little updates that will make asp.net better.

*C# 4.0 Updates* - <a href="http://code.msdn.microsoft.com/Project/Download/FileDownload.aspx?ProjectName=cs2010samples&DownloadId=10177">http://code.msdn.microsoft.com/Project/Download/FileDownload.aspx?ProjectName=cs2010samples&DownloadId=10177</a>

tl;dr:
<ul>
	<li>Dynamic binding; create objects and use methods and properties that may not exist yet on a “dynamic” typed object. This gets resolved at runtime. Upside: use non-type-safe languages and crazy voodoo magic where you don’t know the type. Downside: you only catch bugs at runtime. Use sparingly, but for awesome things. “dynamic” objects can literally do anything, as long as whatever it ends up as supports it. No lambdas on dynamic.
<ul>
	<li>Tl;dr: magic, type safety is so 2009</li>
	<li>Named and optional arguments; you don’t have to enter in your parameters in order, or even enter in all of them.</li>
	<li>“string”- that’s lower-case, kids- is an object now.</li>
</ul>
</li>
</ul>
Tl;dr: tl;dr: Dynamic programming is the key word. Also VB updates, but if a tree falls in the forest and nobody’s around to hear it, does anyone care?

*ASP.NET 4.0 Breaking Changes* - <a href="http://www.asp.net/learn/whitepapers/aspnet4/breaking-changes">http://www.asp.net/learn/whitepapers/aspnet4/breaking-changes</a>

tl;dr:
<ul>
	<li>A bunch of stuff you can do to revert changes, so I dunno why they’re in the “Breaking changes list”. Read for details, sorry.</li>
	<li>Stronger .aspx parsing, controls with random characters breaking stuff will break stuff. Our code should be clean, but needs to be looked at anyway.</li>
	<li>Stronger request validation, so errors may occur on posts that didn’t previously. To revert, we can add a line in the web.config if it gets crazy. Definitely check pages with rich text controls.</li>
	<li>Update your projects through visual studio to .net 4.0 so your web config doesn’t get borked. They support it, but it’ll make life easier.</li>
	<li>A bunch of troubleshooting options</li>
</ul>
tl;dr: tl;dr: More stuff, almost definitely won’t break existing code we have. Double-check pages submitting HTML (rich text areas.)

*tl;dr: Better standards, MVC 2, Dynamic typing, stronger parsing and validation*