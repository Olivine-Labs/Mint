---
layout: post
title: Goodbye, Movable Type; Hello, Wordpress
permalink: /2009/01/goodbye-movable-type-hello-wordpress/index.html
post_id: 31
categories: 
- General
- IIS and Windows Technologies
- Javascript
- Linux
- meta
- Movable Type
- windows server 2008
- Wordpress
---

I've been using <a href="http://movabletype.org/" target="_blank">Movable Typ</a><a href="http://movabletype.org/">e</a> for a few months now. I've liked it, but it wasn't great; it worked well, but I wasn't blown away. After a while, it moved slow; there was no way to remove a lot of comment spam at once (which I seemed to be particularly prone to), and I had a few bugs, such as having to log in twice each session. Maybe they weren't all MT's fault; but I had trouble finding support.

So, when we set up our new Windows Server 2008 machine using a 64-bit edition, I hit a wall: there's no MySQL support for ActivePerl x64. There isn't any official support for x86 either; but there are workarounds for that (use external repositories). It also came at a time when I was deciding whether or not I wanted to switch, so it pretty much cinched it up; I decided to try out <a href="http://wordpress.org/" target="_blank">WordPress</a>. It was a PHP/MySQL system, both of which I had already set up, so I expected (or at least hoped) that it'd be pretty simple to get running.

The first thing I had to do was back up my old MT database. I expected some long, tortourous sequence of MySQL edits or something, but <a href="http://www.sixapart.com/movabletype/docs/3.2/01_installation_and_upgrade/mt_export.html" target="_blank">all it came down to</a> was logging in, clicking "Import/Export", and then export. It spit out a text file, which I saved to my desktop. Next, I unzipped a WordPress download into my blog folder (and set up the requisite site in IIS). I set up a database and a user in MySQL for my blog. I then edited the wp-config-sample.php, filling in the requisite database information and renaming it to wp-config.php, visited the site in my browser, and hit 'go'. Seconds later, I had a new, live WP blog.

From the admin panel of my blog, I went to tools, hit "import", selected "Movable Type" from the list, browsed to my file, and uploaded. And that was it. I had totally converted to Wordpress in minutes. I was absolutely astounded by the ease. It was already much faster (with the help of WP-Cache), and running well.

Next stop: new design. WP looks like it'll be much easier to work with, so hopefully we'll be up soon.