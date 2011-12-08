---
layout: post
title: Flex Dynamic External Stylesheets
permalink: /2008/05/flex-dynamic-external-stylesheets/index.html
post_id: 12
categories: 
- Adobe Technologies
- ASP.NET
- Development
- flex dynamic stylesheets
---

p. Note: an updated version can be found <a href="http://www.thejacklawson.com/index.php/2008/09/flex-dynamic-external-stylesheets-revisited/">here</a>, which only has the relevant stuff if you're trying to figure out how to do this.


p. After a short hiatus succeeding my random anti-RIAA rant, I'm back with

some information on an interesting Flex issue that I had.


p. Flex

is the new(ish) Adobe tool that lets you develop flash-like

applications in a new way. It's Actionscript based, but has a more web

development feel to it than the Flash applications of yore.

Unfortunately, though, being a new language, it's lacking a lot. And I

mean <span style="font-style: italic;">a lot</span>.


p. Recently,

I was tasked with augmenting an application that we have where I work.

It's an image gallery, which reads lists of files fed to it via XML and

displays everything. It used a flex stylesheet (which is mostly CSS,

with some extra proprietary stuff mixed in), which is all good and

dandy- except that it didn't change depending on theme. And, since we

have several websites that are the same, with different styles applied,

the image gallery looked the same, whether or not it matched. So, my

job was to take this flex doodad and spice it up, so it could change

depending on theme.


p. My first thought was "this can't be too bad,

it uses these CSS-like sheets, I can just reference externally." Well,

this wasn't quite true. I Googled around a bit, to no avail; so, my

next step was to check the new version, Flex 3. What I had was Flex 2,

and lo and behold, Flex 3 claimed 'external stylesheet report'. I was

in, or so I thought.


p. I set up my .net app to send the theme name

through a querystring, with which I'd be able to pick up the stylesheet

(thinking I'd just drop it in the theme-specific folder and grab the

path through application logic in the flex program). I did it and it

spectacularly failed. Frustrated, I tried several configurations, but

nothing worked. So, I made my way over to the Actionscript.org forums

to see what I could dig up. As you can see <a href="http://www.actionscript.org/forums/showthread.php3?p=722679">here</a>,

I didn't make much progress. Apparently, I was going completely the

wrong way (and may have thrown a little tantrum in the progress, but

we'll look over that, heh.)


p. But just then, a fellow named Jeff with a blog post saved the day. After <a href="http://jeff.mxdj.com/changing_flex_style_sheets_at_runtime.htm">reading his instructions</a>,

I got correct results instantly! Fantastic. I now had my working

project, which changed styles based on the asp.net theme I was in. I

guess flex and asp.net just isn't quite right to be married to each

other yet, no matter how much XML you pass back and forth.


p. Here's what I did:
<pre class="alt2" dir="ltr" style="border: 1px inset ; margin: 0px; padding: 6px; overflow: auto; width: 640px; height: 338px; text-align: left;">__On init() (function called by creationComplete)__CSSFormat();

__After init()__public function CSSFormat():void{var theme:String = "default"var themeSWF:String = "default"

if(Application.application.parameters.Theme != undefined) { theme= Application.application.parameters.Theme;}

themeSWF = theme;

//conditional comments to take out hyphens were here, but I took them out to shorten it a bit. some directories use hyphens, while the swf files themselves have issues compiling like that.

var css_url:String = "App_Themes/" + theme + "/" + themeSWF + ".swf";StyleManager.loadStyleDeclarations(css_url);}</pre>


p. Moral of the story? Although I got it to work, I'm sticking to Silverlight.


