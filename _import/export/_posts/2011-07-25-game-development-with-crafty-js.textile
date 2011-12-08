---
layout: post
title: Game Development with Crafty.js
permalink: /2011/07/game-development-with-crafty-js/index.html
post_id: 360
categories: 
- Development
- Game Development
- html 5
- Javascript
---

I was recently looking around for some examples in Javascript for an isometric proof-of-concept I'm working on, when I came upon <a title="Crafty.js - an open-source Javascript game engine" href="http://craftyjs.com/">Crafty.js</a>. It had some neat demos, and it was MIT licensed, so I got to work - and I was pleasantly surprised by the library. The documentation itself is a little lacking- and its official tutorial (at the time of this post) was using an outdated version of the library (which has had several breaking changes), but I managed to come across an excellent tutorial by <a title="Starmelt's Crafty Tutorial" href="https://github.com/starmelt/craftyjstut/wiki">"Starmelt" on GitHub</a> that takes you through the process of building a simple game in Crafty. It introduces you to entity creation, the game loop, the eventing structure, and more - and once you're done, it's easy to add on to (for example, I kept a global high scores list, and added a "reset" button.)

Also, Crafty includes an <a title="Crafty.js Isometric Demo" href="http://craftyjs.com/demos/isometric/">isometric demo</a> - which works once you replace "Crafty.isometric.init" with "Crafty.isometric.size" in the source code.

I recommend playing around with the code - it's very lean and flexible. It's definitely worth checking out if you're looking for a springboard into JS game development. Here's a few notes:
<ul>
	<li>Switch between canvas and DOM with no code changes (besides telling it which to render in)</li>
	<li>Claims to support IE6+</li>
	<li>Easily extensible - build entities using interface-like structures</li>
	<li>Seemed fast in the demos I was trying</li>
	<li>Handles animations through tweening over the game loop (you can set the fps)</li>
	<li>Mouse  and keyboard events</li>
	<li>Collision detection, dragging API</li>
	<li>Hard-to-find documentation on available events and modules (it's possible that I'm blind, and am looking right past it, too)</li>
	<li>MIT license</li>
	<li>Excellent tutorial by <a title="Starmelt's Crafty Tutorial" href="https://github.com/starmelt/craftyjstut/wiki">Starmelt</a></li>
</ul>