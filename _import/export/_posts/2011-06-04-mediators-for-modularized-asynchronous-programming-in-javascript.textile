---
layout: post
title: Mediators for Modularized Asynchronous Programming in Javascript
permalink: /2011/06/mediators-for-modularized-asynchronous-programming-in-javascript/index.html
post_id: 337
categories: 
- design patterns
- github
- Javascript
- Mediator.js
- Source code
- Uncategorized
---

(j<a href="http://jsbin.com/iceru6/2/edit">sbin</a> / <a href="https://github.com/ajacksified/Mediator.js">github</a> / *<a title="Mediator.js v0.6" href="http://www.thejacklawson.com/2011/09/mediator-js-0-6-0/">latest version post</a>*)

_Author's note: this probably doesn't match the Mediator pattern *exactly*, but it's the closest pattern I could find to what I had in mind. Also, check out the "latest version post" link at the top of this post to see the latest update._

As I was writing a simple chat application <a title="Alchemy Websockets Chat Example" href="https://github.com/Olivine-Labs/Alchemy-Websockets-Example" target="_blank">for my websocket library</a>, I caught myself doing a lot of this:

[sourcecode language="javascript"]
AlchemyChatServer.MessageReceived = function(event) {
ParseResponse(event.data);
};

function ParseResponse(response) {
var data = JSON.parse(response);
if (data.Type == 0) {
var message = data.Data.Name + ' connected!';
} else if (data.Type == 1) {
var message = data.Data.Name + ' disconnected!';
} else if (data.Type == 2 &amp;amp;&amp;amp; data.Data.Name != me.Name) {
...
} else if (data.Type == 9999999....)
[/sourcecode]

So, while this works _ok_, as you can see, it gets a little... big over time. That's a lot of if statements to go through. That's a lot of dom interaction being called from the same chunk of code that's dealing with the messages. That's tight coupling. So, what happens when, say, we want Chrome to use <a title="How to Desktop Notifications" href="http://0xfe.blogspot.com/2010/04/desktop-notifications-with-webkit.html" target="_blank">desktop notifications</a>? Well, we're nesting more if statements based on data type. Maybe even copypasting this notification code several times. As we add more conditional logic, it gets heavier, and heavier, and heavier...

And that's when it struck me - there is a better way! What if I used an object that held functions in an array based on response type, and called those functions when I received a call with that response type? It would be fast, as an array lookup, and it would let me add any arbitrary amount of functions based on logic without having to tie it into a massive if/then statement. And, as an added bonus, we get a _really easy_ method of testing our application without being connected to a server, by directly passing our Mediator object some mocked data.

I sat down and got together a little utility class that allows you to add methods based on data type (which we assume to be there. More on this in a bit.) I added a remove method that allows you to remove all associations for a given type, or to remove associations based on a type for a specific function that you've wired up. (Like the jQuery bind / unbind.) I finally added a Call method, which accepts an object. Easy and elegant.

And then I got thinking about ways to take it a step further. In our example chat application - what if I want different logic if it's a chat message with my username in it? If we allow our Add method to take a predicate as an alternative to a "type", we can now say things like:

[sourcecode language="javascript"]

Mediator.Add(DirectedAtMe, DisplayMessageThatIsToMe);

function DirectedAtMe(data){
if(data.Type == 1 &amp;amp;&amp;amp; data.To == myUserName){
return true;
}
}

function DisplayMessageThatIsToMe(data){
...
}
[/sourcecode]

So, I came up with this:

[sourcecode language="javascript"]
(function(){
var Mediator = function(){};

Mediator.prototype = {
_callbacks: { Predicates: [] },

Add: function(condition, fn){
if(typeof condition === "function"){
this._callbacks.Predicates.push([condition, fn]);
return;
}

if(!this._callbacks[condition]){
this._callbacks[condition] = [];
}

this._callbacks[condition].push(fn);
return;
},

Remove: function(condition, fn){
if(this._callbacks.Predicates.length > 0 &amp;amp;&amp;amp; typeof condition == "function"){
var counter = 0;
for(var x in this._callbacks.Predicates){
if(this._callbacks.Predicates[x][0] == condition &amp;amp;&amp;amp; (!fn || fn == this._callbacks.Predicates[x])){
this._callbacks.Predicates.splice(counter, 1);
counter--;
}

counter++;
}

return;
}

if(this._callbacks[condition]){
if(!fn){
this._callbacks[condition] = [];
return;
}

for(var y in this._callbacks[condition]) {
if(this._callbacks[condition][y] == fn){
this._callbacks[condition].splice(y,1);
}
}
}
},

Call: function(data){
if(data.Type !== undefined &amp;amp;&amp;amp; this._callbacks[data.Type]){
for(var x in this._callbacks[data.Type]){
this._callbacks[data.Type][x](data);

}
}

for(var y in this._callbacks.Predicates){
if(this._callbacks.Predicates[y][0](data)){
this._callbacks.Predicates[y][1](data);
}
}
}
}

window.Mediator = Mediator.prototype;
})(window);
[/sourcecode]

Wow, neat-o! So, as long as our "data" object contains a "type", we can call anybody who's registered to that type. We can also remove objects, either by typed, or if it's a named function, by passing in the function. (Note: anonymous functions won't work here.)

To see it in action:

[sourcecode language="javascript"]
function Test(){
Mediator.Add(0, function(){ alert("Tested adding typed anonymous functions.") });
Mediator.Call({Type: 0});
Mediator.Remove(0);
Mediator.Call({Type: 0});

Mediator.Add(1, AlertMessage);
Mediator.Add(1, LogMessage);
Mediator.Call({ Type: 1, Message: "I am alerted and logged." });
Mediator.Remove(1, AlertMessage);
Mediator.Call({ Type: 1, Message: "I am only logged." });

Mediator.Add(FilterMessages, AlertMessage);
Mediator.Call({ From: "Audrey", Message: "This message shouldn't apear." });
Mediator.Call({ From: "Jack", Message: "This message should ony appear once." });
Mediator.Remove(FilterMessages);
Mediator.Call({ From: "Jack", Message: "This message should only appear once." });
}

function AlertMessage(data){
alert(data.Message);
}

function LogMessage(data){
console.log(data.Message);
}

function FilterMessages(data){
return data.From == "Jack";
}
[/sourcecode]

There it is - I've only spent an hour on it, so I'm sure there's about a billion refactor points. But, <a title="Github hosting of Mediator.js" href="https://github.com/ajacksified/Mediator.js">here it is on Github</a>. Feedback and improvements absolutely welcome.