---
layout: post
title: Dynamic Pages with Perch CMS
permalink: /2011/05/dynamic-pages-with-perch-cms/index.html
post_id: 311
categories: 
- Content management
- Development
- dynamic pages
- Perch
- PHP
- Programming
---

<a title="Perch CMS" href="http://grabaperch.com" target="_blank">Perch CMS is pretty awesome</a>. It's a CMS that stays out of your way as you're building, allowing you to handcraft html and css (rather than you having to trust that whatever you're using is outputting good and efficient code. It's probably not.) And it's absolutely worth the small licensing fee to save the amount of time you'd spend building a solution / hacking an existing solution.

A brief overview of how it works:
<ul>
	<li>Drop the perch directory into your site root (if your site root is /var/www/herpinderpin.com, your perch directory will be /var/www/herpinderpin.com/perch)</li>
	<li>Run the perch install</li>
	<li>On your site pages, include a reference to perch/runtime.php</li>
	<li>On your site pages, include <?php perchcontent("this is a content block")</li>
	<li>Visit the page</li>
	<li>Edit the page content in the Perch administration area</li>
</ul>
It's easy! It's fast! And it's... extremely barebones! Exactly what I want, as someone who takes pride in my html & css. It has enough flexibility to create new "content" templates for your non-technical user to use from within perch, and enough simplicity to let you define how everything is rendered without having to learn a complicated templating system.

But, enough about that. Here's the real meat of this subject: how to create dynamic pages in Perch. It ended up being a lot simpler than I first thought it would be. You see, Perch doesn't create pages*; it simply allows you to edit content on existing pages. So, if you have a 50-page site, and you want to move things around, it gets difficult. Note: this works because all of my pages have the same template. You can get fancier with your .htaccess or page file and have different page types based various parts of the requested url. I'm showing a simple case.

Here's how I solved my problem:

*1. Create an .htaccess file that points all non-existing files to page.php*

[sourcecode]
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ page.php?_route_=$1 [L,QSA]
[/sourcecode]

*2. Create page.php base template and define good / bad urls*

[sourcecode language="php"]
<?php
$route = strtolower($_GET['_route_']);
//we'll make a list of valid pages
$validRoutes = array(
"derp",
"derp/herp",
"derp/mcburp"

"page-not-found"
);

if(!in_array($route, $validRoutes)){
//if not a valid route, redirect to our custom 404 page
header('Location: /page-not-found');
exit;
}

include('./perch/runtime.php');

if($route != ''){
PerchSystem::set_page($route); // <- MAGIC HERE
}
?>
...
<section>
<h1><?php perch_content('Page title') ?></h1>
<?php perch_content('Main content'); ?>
</section>

<aside>
<h1><?php perch_content('Adbar heading'); ?></h1>
<?php perch_content('Adbar content'); ?>
</aside>
...
[/sourcecode]

Saw that "PerchSystem::set_page($route);" ? Well, that lets us force the perch "page" so that we can fake it. Even though everything's loading from page.php, Perch sees "derp/herp" as the path, and in the content management, let us edit as if we were within that page!

We also check valid routes so by nefariousness or mistake, someone can't spam a bunch of junk urls, filling up your poor CMS editing screen.

An infinite number of pages, all spawned through a single page! Easy enough, right?

_*there is a Pages plugin, but it writes out all the files statically, and it's messy._
<div class="zemanta-pixie" style="margin-top: 10px; height: 15px;"><a class="zemanta-pixie-a" title="Enhanced by Zemanta" href="http://www.zemanta.com/"><img class="zemanta-pixie-img" style="border: none; float: right;" src="http://img.zemanta.com/zemified_e.png?x-id=aef7be8b-10ac-4952-9de0-c326fafd1d1f" alt="Enhanced by Zemanta" /></a></div>