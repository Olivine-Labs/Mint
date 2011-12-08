---
layout: post
title: "HTML 5: Why and How"
permalink: /2010/08/html-5-why-and-how/index.html
post_id: 257
categories: 
- Development
- html
- html 5
- HTML5
- User Interface Design
- Web application
- Web Design
- Web Standards
---

<span style="font-weight: normal; font-size: 13px;">HTML has been around for a while- since the original HTML spec designed by Tim Berners-Lee in 1990. In those 20 years, HTML has evolved to include new syntax, tags, and style, both in its original form as well as in branching to create the commonly-used xhtml format.</span>

HTML 5 brings with it changes in syntax, loosens some of the tight restrictions of xhtml strict, and adds new tags, attributes, attribute values, and API methods. The goal of these changes is to make a more semantic, robust internet within which one may create web applications with a focus on accessibility and without the necessity to rely on third-party plugins for interactivity.
h3. Benefits to Upgrading Existing Code


Existing code, written in xhtml transitional, or even HTML 4, works fine today just like any vetted code or framework. However, HTML 5 brings many benefits to both the developer as well as the end user.
<ul>
	<li>More semantic markup using  tags such as “section”, “aside”, “header”, “footer”, and “nav”
<ul>
	<li>Developers can clearly see more clearly what different pieces of code are without having to fully understand a page or control within a website, and are thus less likely to make mistakes</li>
	<li>Users’ browsing tools gain better ability to, based on content type, perform functions such as zooming or screen-reading, now that they have context</li>
</ul>
</li>
	<li>New media tags such as “video”, “audio”
<ul>
	<li>Developers can now assign captions, pictures, and other pieces of useful data to video and audio which helps accessibility as well as gives users more information about the multimedia</li>
	<li>No more reliance on 3^rd^ party technologies like Flash and Silverlight for audio and video rendering</li>
	<li>Support by popular mobile devices such as iPhones, iPads and Android devices</li>
</ul>
</li>
	<li>Metadata
<ul>
	<li>Metadata allows developers to classify blocks of markup as a data object. This allows users’ browsers and tools to parse this data; for example, classifying an event and adding that event to a Google calendar. Metadata also influences search results and provides additional information to users, where they can be parsed.</li>
</ul>
</li>
	<li>Standards-setting body is not owned by a profit-driven corporation
<ul>
	<li>Adobe could collapse, leaving us stuck with old, dead technology; the W3C is made of representatives from many organizations that acts as a governing body</li>
</ul>
</li>
	<li>Offline storage database allows you to set your application to “offline mode” and work, and save changes later</li>
	<li>Browser-based drag-and-drop API, reducing need for a javascript-based solution</li>
	<li>Geolocation API</li>
	<li>New form input types: date, time, email, url, search, color
<ul>
	<li>These will restrict and validate inputs for you (as implemented). Some will be new controls (date, time, and color) that will appear when you click on the input field; some do things like dynamically changing the keyboard layout, based on type, on input devices such as the iPhone and Android phones.</li>
</ul>
</li>
	<li>HTML 5 is designed such that old controls (such as an input with type “color”) work with browsers without HTML 5 support</li>
	<li>HTML 5 is supported in Chrome, FireFox, Safari, Opera, and IE 9</li>
	<li>Some elements will be dropped from the HTML 5 spec. These elements are: _acronym, applet, basefont, big, center, dir, font, frame, frameset, isindex, noframes, s, strike, tt, u_</li>
</ul>
h3. Potential Setbacks to Updating Code


<ul>
	<li>Time used in training developers and updating old code</li>
	<li>No browser support in IE 6-8
<ul>
	<li>Can be mitigated by a piece of Javascript code that “creates” the elements within the browser</li>
</ul>
</li>
	<li>Spec is not 100% locked down and may change during browser implementation
<ul>
	<li>Browser differences can be mitigated by using a “reset stylesheet” that forces all elements to remain unstyled until specifically styled by the developer the same way differences are fixed in xhtml elements we use today in elements like “ul” and “body” which use padding or margin depending on browser</li>
</ul>
</li>
	<li>HTML 5 does not require the same strict markup that xhtml does, such as closing />, quotes around attributes, requiring attributes to have values, and requiring lower-case names and attributes. This can result in “ugly” code if standards are not followed.</li>
</ul>
h3. HTML 5 Implementation


Implementing the technology can be boiled down to two steps:  installing the “shiv” and reset stylesheet for IE, and using the new tags. However, in order to take advantage of these new tags, existing code should be updated where appropriate to use them. Some divs may be renamed to “section”, “article”, or “aside” tags; heading levels may change based on their position within sections; input fields may be changed to specify input type such as “email”. This work may be done as areas of code are refactored, or it may be done as part of an overall initiative to update to html 5 at once.

The benefit of updating as refactoring occurs is that the developer is already in the code, causing changes and testing to happen regardless, and upgrading some elements to the latest could piggyback as part of the project. However, a partially-converted project results and it may not be able to take full advantage of the benefits provided by html 5. Converting an entire project at once allows all benefits to be had, but causes an additional time sink that may be unavailable.
<div class="zemanta-pixie" style="margin-top: 10px; height: 15px;"><a class="zemanta-pixie-a" title="Enhanced by Zemanta" href="http://www.zemanta.com/"><img class="zemanta-pixie-img" style="border: none; float: right;" src="http://img.zemanta.com/zemified_e.png?x-id=96108b4e-db8a-4cb6-a241-a36af5f00b9e" alt="Enhanced by Zemanta" /></a><span class="zem-script more-related pretty-attribution"><script src="http://static.zemanta.com/readside/loader.js" type="text/javascript"></script></span></div>