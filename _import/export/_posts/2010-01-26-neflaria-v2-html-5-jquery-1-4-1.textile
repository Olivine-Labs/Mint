---
layout: post
title: "Neflaria V2: HTML 5, jQuery 1.4.1"
permalink: /2010/01/neflaria-v2-html-5-jquery-1-4-1/index.html
post_id: 200
categories: 
- css
- Development
- html
- html 5
- Javascript
- JQuery
- jquery 1.4
- Neflaria
- PHP
- User Interface Design
- Web Design
- Web Standards
---

Yay! I love jQuery! I love HTML _html_ 5! I love CSS 3!

And, I've decided that Neflaria, Version 2, will be my playground.

<a href="http://www.neflaria.com" target="_blank">Neflaria</a>, for the unacquainted, is the online game that my friend and I inherited a couple years ago. You make a character, you log in, and you fight monsters and chat with other players; while there's not a whole lot to the game, it has been around for about 10 years, and as such, has a lot of character. And a lot of _characters_. I mean that endearingly. <span style="color: #888888;">(Hi, Chris)</span>

However, to a lot of the players, and definitely to me, its 2001-era look is a little stale. Its 12px Times New Roman on 100x100 pixel repeating background. Another word might be "dated." The server-side database and file structure is a little crazy and unorganized, and it is time for an upgrade. So, here's where Neflaria version 2 comes in.

One of the decisions we made was to move forward and to use jQuery 1.4.1, which niftily came out just as we were restarting development, to use html 5 (by including the wonderful html 5 shiv [<a href="http://remysharp.com/2009/01/07/html5-enabling-script/" target="_blank">blog post</a>, <a href="http://html5shiv.googlecode.com/svn/trunk/html5.js" target="_blank">javascript</a>] for backwards compatibility), and do as much as we can to bring Neflaria into 2010 while at the same time making sure that the people playing the game- who are probably still on IE6- aren't left out in the dark. Now, I've always railed against IE6, and I hate IE6 support more than anything... but by building on a solid base of well-structured html, css, and javascript, we can bend the styles later on to suit IE6's needs, while maintaining future compatibility. "Graceful Degredation" is the term of the day.

We're developing Neflaria V2 looking for the future. We're building our javascript more like a framework and less like a loose collection of methods called "x2" and "j5". We're restructuring the database (aka normalizing the heck out of it) and using JSON served piping hot via short but precise PHP pagelets. It'll be very client-heavy, assuring server-side performance, and it'll be extensible for future features. We're even working on multilingual support, using jQuery to query a language-based XML file by key.

I'm pretty excited. Get a preview here (only the home, terms of service, privacy policy, and "create" and "login" buttons do anything, and it isn't wired up to the database): <a href="http://labs.crimsondeviations.com/NeflariaV2Preview/">http://labs.crimsondeviations.com/NeflariaV2Preview/</a>