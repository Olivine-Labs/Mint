---
layout: post
title: "Re: \"Why CSS should not be used for layout\""
permalink: /2009/02/re-why-css-should-not-be-used-for-layout/index.html
post_id: 38
categories: 
- css
- user interface
- Web Design
- Web Standards
---

First, <a title="CSS Rant" href="http://www.flownet.com/ron/css-rant.html" target="_blank">read this</a>. Then come back.

I'll wait here.

...

...

Ok, good. Now, here's why the article's complete and total garbage.

On his first point:
bq. The CSS layout primites are inadequate because they do not allow elements to be positioned relative to each other, only relative to their containers.
They don't? What about floats... do they not effect direct siblings? Can you not change positioning? Maybe I'm missing something here, but we've got the ability to change element positioning relative to other elements as well as the container (or even display on the screen at all times ("floating" elements on the screen), or display anywhere on the page). Using the table method that Ron advocates only allows you to position relative to it's sibling. A table cell, which spans 1-n rows. A table cell that requires you to restructure your HTML (or at least move your content) if you want to move a section from the left, to the right. Whereas I could just swap the float, changing a couple lines of CSS.
bq. The way CSS layout is rendered results in unavoidable interactions between the style sheets and the underlying content.  So even when CSS is used exactly as intended, it is not possible to separate content from layout.
Unavoidable interactions? Giving elements IDs (which is good practice anyway), classes, and a <link> tag? Is this worse than creating an immutable structure? Again, perhaps I'm missing something somewhere, but the liquidity of a <div> layout is far superior. It's changable, it's easier to get things where you want them to go, it's less HTML markup gunking up your content. A nicely "divved" layout is cleaner, easier to modify. Yes, I have to add IDs and classes... but a semantic, descriptive markup is far easier to read anyway.
bq. One of the problems with criticising CSS is that it's very hard to write good CSS, so pointing out problems with CSS begs the question of whether this is an indictment of CSS or one's coding ability.
Hard for who? And regardless of difficulty, it's a bit strange to denounce an entire language (markup syntax?) because it's "hard". C# and Ruby and Python and baking and riding bicycles can be hard for beginners too.

Ron follows his CSS bashing up with a kluge of examples that do nothing except show he has no idea what he's doing, and badly mangles examples, saying "look, I reversed it, and it 'sploded! css sux".
bq. But the point is _they have to be fixed!_ The correct CSS is _inextricably bound_ to the content.  Smarter people than me have tied themselves into knots trying to figure out how to make a three-column CSS layout that doesn't have these problems.  To my knowledge, no one has succeeded.  It may be possible.
To his knowledge, nobody's suceeded? Funny, because several of my own websites use 3-column CSS layouts, without "these problems". Because I understand how CSS _works_. Because I'm not afraid to get my hands a little dirty, and because I don't base my knowledge on display-view of Dreamwaver.

All it comes down to is the ranting of a man who has no idea what he's talking about. CSS is perfect for layouts. It's hard, as he readily admits, but once you understand it's semantics, understand when and how and what to apply, there's nothing better.