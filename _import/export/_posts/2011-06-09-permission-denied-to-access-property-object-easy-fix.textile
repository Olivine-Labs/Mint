---
layout: post
title: "Permission denied to access property object : Easy Fix"
permalink: /2011/06/permission-denied-to-access-property-object-easy-fix/index.html
post_id: 353
categories: 
- Javascript
- JSON
---

Recently, I was working on an application using comet. To get around some issues opening multiple connections in older browsers (ahem, IE6), we injected an iframe using another domain into the page that hosted the application, which allowed more persistant connections.

The parent held details about the chat (username, other people online, etc.), which needed to be passed to the child. The trouble was, the child couldn't access properties of the object sent from parent, due to access restrictions - It would throw a "Permission denied to access property object" error in FireFox. This didn't matter if I sent in the object as a parameter in a method, or tried cloning the object - nothing worked. I could see the object, I could log the object, but I couldn't access any properties

After several attempts to get around this, I fell upon an easy and elegant solution: since I could access the object, just not its properties, I would encode the object as a JSON string and parse it on the client. Using <a title="json2.js" href="https://github.com/douglascrockford/JSON-js">Douglas Crockford's json2.js</a>, when sending the parent objects I encoded them as JSON using JSON.stringify(object). On the child, I did a JSON.parse(object) - and I had a fresh new copy of everything to work with. I could access everything with no trouble, as it's now an entirely new object.
<div class="zemanta-pixie" style="margin-top: 10px; height: 15px;"><a class="zemanta-pixie-a" title="Enhanced by Zemanta" href="http://www.zemanta.com/"><img class="zemanta-pixie-img" style="border: none; float: right;" src="http://img.zemanta.com/zemified_e.png?x-id=df926d3c-4e59-4695-ac87-bdaa3ff0b431" alt="Enhanced by Zemanta" /></a></div>