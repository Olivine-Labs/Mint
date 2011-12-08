---
layout: post
title: APIs and Extensibility
permalink: /2009/06/apis-and-extensibility/index.html
post_id: 85
categories: 
- Architecture
- Development
- web services
---

<div class="zemanta-img" style="margin: 1em; display: block;">
<div><dl class="wp-caption alignright" style="width: 172px;"> <dt class="wp-caption-dt"><a href="http://www.crunchbase.com/product/flickr"><img title="Image representing Flickr as depicted in Crunc..." src="http://www.crunchbase.com/assets/images/resized/0001/0830/10830v1-max-450x450.png" alt="Image representing Flickr as depicted in Crunc..." width="162" height="63" /></a></dt> <dd class="wp-caption-dd zemanta-img-attribution" style="font-size: 0.8em;">Image via <a href="http://www.crunchbase.com">CrunchBase</a></dd> </dl></div>
</div>
More and more often, it becomes obvious to me how important an external <a class="zem_slink" title="Application programming interface" rel="wikipedia" href="http://en.wikipedia.org/wiki/Application_programming_interface">API</a> is. What better way is there to share your product, then to let people build on top of your <a class="zem_slink" title="Service layer" rel="wikipedia" href="http://en.wikipedia.org/wiki/Service_layer">service layer</a> and customize their own interface? If someone doesn't like the look of your program, or how it feels, they may leave; but a missed opportunity can quickly turn into another user when they find someone else's implementation of your <a class="zem_slink" title="Application software" rel="wikipedia" href="http://en.wikipedia.org/wiki/Application_software">application</a>. Or, other applications may pull your data into their product, giving you another <a class="zem_slink" title="Revenue stream" rel="wikipedia" href="http://en.wikipedia.org/wiki/Revenue_stream">revenue stream</a> (or just more users), more popularity, your name thrown around more; it's free advertising and a great testimony to your product that someone liked it so much that they included it in their product.

I recently looked into <a class="zem_slink" title="Flickr" rel="homepage" href="http://www.flickr.com">Flickr</a>'s API, for integration into a project I was working on, which spawned this thought. It is absolutely fantastic that I can call a URL with some credentials, and bam, I have the file I need. The user doesn't have to upload (or worse, download from Flickr and reupload) to another photo-sharing application; they can just point out a url, and I can display it. It's really awesome. <a class="zem_slink" title="Twitter" rel="homepage" href="http://twitter.com">Twitter</a> has feeds, that I can pull into my blog; even my blog has an API that will allow other sites to post comments to me without ever loading my site. That's pretty cool stuff.

For an information-hosting web app, this is one of the best things you can do to increase views and popularity. If you have a good service layer, expose some of it (with the right security, of course), let other people use your app. More users is never a bad thing.
<div class="zemanta-pixie" style="margin-top: 10px; height: 15px;"><a class="zemanta-pixie-a" title="Reblog this post [with Zemanta]" href="http://reblog.zemanta.com/zemified/d95e66f8-f407-431d-ac9d-fab33225b4ff/"><img class="zemanta-pixie-img" style="border: medium none; float: right;" src="http://img.zemanta.com/reblog_e.png?x-id=d95e66f8-f407-431d-ac9d-fab33225b4ff" alt="Reblog this post [with Zemanta]" /></a><span class="zem-script more-related pretty-attribution"><script src="http://static.zemanta.com/readside/loader.js" type="text/javascript"></script></span></div>