---
layout: post
title: Flex Dynamic External Stylesheets Revisited
permalink: /2008/09/flex-dynamic-external-stylesheets-revisited/index.html
post_id: 24
categories: 
- Adobe Technologies
- ASP.NET
- Development
- Dynamic External Stylesheets
- Flex
- stylesheet change
---

Well, it seems that my article on <a href="http://www.thejacklawson.com/index.php/2008/05/flex-dynamic-external-stylesheets/">Flex Dynamic External Stylesheets</a> is the most popular on my blog; and, given that, I should probably explain what I did a bit better. The last article was more of a discussion on what I went through to get it working, whereas this will be more of a tutorial of sorts.

Note: this is using Flex 3; Flex 2 may be similar, but I can't guarantee anything.

First thing:_ you cannot load a CSS file into your SWF._ It's just not possible. It's what I struggled with, and finally had to come to the realization of; you have to compile the .css into a .swf file (as I explain further down.) Also, the "css" that flex uses isn't CSS, it's some convoluted garbage they call CSS. It should be called *FSS*. But I digress.

The first thing I did was get the CSS written that I wanted to change, and put it in a CSS file. It had background-color changes that overwrote the CSS in the main file. So, if the main CSS file was called default.css, and said:

[sourcecode language="css"]
.blueBox {
    color: #fffffff;
    background-color: #000066;
}
[/sourcecode]

My new CSS file was called newBlue, and said:

[sourcecode language="css"]
.blueBox {
    color: #ccccff;
}
[/sourcecode]

Or whatever you happen to choose. This causes my new CSS file's font color to overwrite the old one, just like real CSS.

I then right-clicked my new CSS file, and set it to "compile to swf". Don't do this with default.css, that'll be ok to compile into the original swf; the compile-to-swf option creates a seperate  SWF file specifically for your CSS (because it'd be way too easy to just load a .css file, right?)

The next step was to modify the ActionScript file. I was passing through a parameter called "Theme", so I used that to call the compiled CSS that I wanted to load, and overwrite the main. I passed through the theme parameter as a querystring parameter on the flash file name (flash.swf?Theme=jack)

The actionscript was something like this:
[sourcecode language="as3"]
//(function called by creationComplete
CSSFormat();

//(somewhere further down the page)
public function CSSFormat():void{
    //this will load up default.css, so we always have something.
    //however, the theme will flash the default color before it
    //loads the new theme you're trying, so keep that in mind.

    var theme:String = "default"var themeSWF:String = "default"

    //This grabs "Theme" from the parameters.

    if(Application.application.parameters.Theme != undefined) { 
        theme= Application.application.parameters.Theme;
    }

    themeSWF = theme;

    //note: swf files don't like compiling with hyphens.
    //your url will obviously change, depending on where you decide to
    //store your swf. Mine's in the app_themes directory for an
    //asp.net application.

    var css_url:String = "App_Themes/" + theme + "/" + themeSWF + ".swf";
    StyleManager.loadStyleDeclarations(css_url);
}
[/sourcecode]

And, now when I publish, it spits out the .css file I created into a .swf file. Put that into the directory I specified in the css_url, and it'll load it up! And, even if it doesn't, it'll still load the default (don't set default.css to compile).

Hope this helps everyone else that is remotely as frustrated as I was!