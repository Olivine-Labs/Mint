---
layout: post
title: Pop-Up Windows Are A Terrible Solution
permalink: /2008/08/pop-up-windows-are-a-terrible-solution/index.html
post_id: 22
categories: 
- Development
- user experience
- user interface
- User Interface Design
- Web Design
---

Pop-up windows are one of the biggest UI blunders ever. They create seperation from your website, they detract from the main content, and they are far from a 'seamless' data entry mechanism.

Let's start from the beginning. One day, some developer thought to himself, 'Hey! I want my user to stay on our website, and stay on the page to he maintains state, but also to enter data. How can I do that?' After a little Javascript tinkering, he created a button / link / something that pops up a window with a form, or with a help section, or something. Fantastic!

But then, some internet advertiser said 'Hey! I want my consumer to see our ads, all ten of them, even if he moves to different sites.' So, he added javascript of his own, and the community responded with pop-up blockers. So, internet advertiser went back to normal banners. However, this left the first developer in a bit of a hard place. His website was developed with those pop-ups in mind... so what now?

First, never, ever, ever have the browser pop up a new window in the first place. Ever. There is absolutely no reason for it, and there are easy ways around it that can avoid pop-up blockers totally screwing your user experience: for example, modal windows. They're an extremely easy mechanism to put in place (you can even use frameworks, like Scriptaculous or components from the Ajax toolkit for .NET), and they get around pop-up blockers. And, not only that- but you don't have the issue of not being able to send commands to your parent window! In this, it lends itself heavily to Ajax applications, in that you can also update content on the main page after submitting data from the modal. Seamless transitions are the best; make your web app behave like a desktop app. You also know that your user won't be messing with anything on the parent, out of order with the pop-up. It fits everything in place and creates a nice flow to the website.

So, please, please remove your pop-up windows and stop keeping your users from having to disable pop-up blockers!
