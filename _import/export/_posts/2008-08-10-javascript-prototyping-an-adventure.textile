---
layout: post
title: Javascript Prototyping, an Adventure
permalink: /2008/08/javascript-prototyping-an-adventure/index.html
post_id: 21
categories: 
- ajax
- Development
- Javascript
- prototype
---

p. Lately, I've more or less been the go-to guy at work for Javascript issues. Several times daily, I've been helping other people out with Javascript (something I like to do; keeps me sharpened on the art of browser scripting), whether it be an issue with Ajax or something strange with variable initialization (check that your variable's not a keyword! make sure the src is set correctly!). So there I was, thinking myself somewhat of an expert on the subject, as my ego has a habit to coerce me into, until I came upon the Javascript "prototype". Not to be confused with the <a href="http://www.prototypejs.org/">popular Javasript framework</a>, but rather a method to add methods to objects. Essentially, it is a plausible way to extend current objects and really use Javascript as an object-oriented language. And what with my affinity towards C#, this was perfect.

I decided that I'd first start with my Ajax framework, DeviantAjax. The framework was something I started a while back, beginning with <a href="http://gevalum.com/jsfiles/AJAXFun.js">Gevalum's rudimentary system</a>; I took the few base functions and threw them nicely in a file with comments. However, this wasn't exactly anything new or groundbreaking; I wanted to put out a framework that was simple and easy (KISS), but still offered more than any wizened developer could throw together in a matter of minutes.

<span class="caps">DA, </span>as we'll call it from here on out, would be different than the other frameworks (the three that come to mind are <a href="http://script.aculo.us/">script.aculo.us</a>, <a href="http://www.prototypejs.org/">Prototype</a>, and <a href="http://jquery.com/">jQuery</a>). It wouldn't include all of the animation stuff and all the extra <span class="caps">DOM </span>code of the others; rather, it'd be for Ajax alone. It'd be a way for beginners to use the magic and a way for gurus to get a head start on a project.

So, first things first: I began with a Page object. Pleased with this, I began to add things into it's prototype, like so:



bq. function Page() {
&nbsp;&nbsp;&nbsp; ajaxes = new Array();
}

Page.prototype = {
&nbsp;&nbsp;&nbsp; SetAjaxRequestMax: function(ajaxObjectsToCreate){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ...
&nbsp;&nbsp;&nbsp; },
&nbsp;&nbsp;&nbsp; FillElement: function (element,source,postData,ajaxObjectIndex){
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ...
&nbsp;&nbsp;&nbsp; }
}
p. 
Excellent! I could make a new page - var MyPage = new Page(); - and it looked like good ol' C# (well, close enough, anyway.) I could even call MyPage.SetAjaxRequestMax(4)! And that was great, except now I wanted to add functions to FillElement. So, I added a FillElement.prototype block inside of my FillElement, with functions like Set, OnLoad, OnRequestOK, and OnRequestBad. Except... prototype doesn't quite work like that. You can't put the prototype declaration inside the FillElement function, as I found out after several hours.

So, instead, the framework began to look more like:

p. 


bq. _ajaxObjectArray = new Array();

function Page() {
&nbsp;&nbsp;&nbsp; 
}

function EvalAjaxPost(){};
function SetAjaxRequestMax(){};

SetAjaxRequestMax.prototype = {
&nbsp;&nbsp;&nbsp; Set: function(ajaxObjectsToCreate){
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; if(window.XMLHttpRequest){
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; for(x=0; x<ajaxObjectsToCreate; x++){
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; _ajaxObjectArray[x] = new <span class="caps">XMLH</span>ttpRequest();
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; }
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; }else if(window.ActiveXObject){
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; for(x=0; x<ajaxObjectsToCreate; x++){
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; _ajaxObjectArray[x] = new ActiveXObject("Microsoft.XMLHTTP");
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; }
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; }
&nbsp;&nbsp;&nbsp; }
};

FillElement.prototype = {
&nbsp;&nbsp;&nbsp; Post: function(element,source,postData,ajaxObjectIndex){
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; ...
&nbsp;&nbsp;&nbsp; },
&nbsp;&nbsp;&nbsp; ...
}
p. 
Page.prototype.SetAjaxRequestMax = new SetAjaxRequestMax();
Page.prototype.FillElement = new FillElement();

Now it started working better. I'd set the AjaxRequestMax on the <span class="caps">HTML </span>file it was used in, and then I could initialize and use FillElement objects- FillElement.Post("div1",...);. Cool.

So, the purpose of prototype, and how it works:
Prototype is a way to add methods onto objects. For example, you could add functions onto strings, like so:



bq. function Reverse(){
&nbsp;&nbsp;&nbsp; for (n=this.length-1;n>=0;n--){
&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; document.write(this.charAt(n))
&nbsp;&nbsp;&nbsp; }
}
String.prototype.writeback=Reverse();
p. 
And use it like "jack".Reverse(); and get a result. It's <a href="http://www.codinghorror.com/blog/archives/001151.html">Monkeypatching</a> at it's best. It also really lends itself to OO Javascript development, which is always a plus.

The next thing I'm trying to figure out is how to get other functions in the prototype (OnRequestOK, for example) to run on the FillElement object when I run Post and get a certain result. Feel free to leave any ideas in the comments, and otherwise I'll be posting part 2 soon.

Check out my <a href="http://crimsondeviations.com/sharedjavascript/Ajax/test.html">testing</a> page (which may or may not be broken, if I'm working on it) and the <a href="http://crimsondeviations.com/sharedjavascript/Ajax/DeviantAjax.rar">zip</a> file for yourself; it's creative commons licensing, so do whatever you want.
 


