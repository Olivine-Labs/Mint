---
layout: post
title: "User Controls Rock: Legos and Fake Ajax Master Pages"
permalink: /2008/09/user-controls-rock-legos-and-fake-ajax-master-pages/index.html
post_id: 25
categories: 
- ajax control toolkit
- Ajax Master Pages
- Architecture
- ASP.NET
- asp.net 3.5
- Development
- IIS and Windows Technologies
- user controls
---

Let me start with a simple statement: user controls are absolutely fantastic.

If you haven't delved into the realm of the .ascx, then let me briefly explain the two big benefits that have been relevant to me recently:

<ul><li>Totally reusable code</li><li>Emulate master pages; only with this, you can use the Ajax control toolkit to do it</li></ul>On the first point, the reusable code point, this is the biggest. It's the entire reason behind user controls. It lets you chunk out code that you use all over, and use it in several places; it's a fundamental of object oriented development. Let's do an example.

Say you have a piece of code that goes to the database and retrieves data on a member. That data is then put into a styled gridview, for the administration side of a website. But, you also have an area in a members section where a user can edit their own information (more like a formview); and, on the normal web display, casual users can browse through usernames and user roles in a paged gridview.

Don't write the same code thrice! (or even twice!) Rather, make a user control to do all the work for you, and place it in each of your pages. This is how I'd do it:

__For the sake of this article, I'm assuming you're using a list of "Member" objects. Use whatever.__

-Make a public class-level property in your control called "ReadOnly", a bool.
-Make a public class-level method in your control called "Intialize", which takes an IList of Member objects
-If the IList has one object, add a FormView to your control, and databind it. Otherwise, go the Gridview route (doing this all from the codebehind would keep your code cleaner and keep you from having an extra control rendered, although you could do this in the .ascx if you really wanted to; just set one to visible="false" to the one you're not using)
-Create all of the appropriate methods for your control for delete, update, insert, etc. and set up your formview or gridview accordingly (of course, only update for our member's area FormView!)
-If ReadOnly is true, don't add edit, insert, or delete buttons to your formview/gridview. (Easy enough; could set visible="false" on the fields, or just not add them at all)

And, then, back on your three main pages, register and use your control.&nbsp; Set the ReadOnly property (if it's a bool, you should even get IntelliSense for true/false), and then on Page_Load, call Intialize on the control, passing through the IList of Members that you pulled down.

The reason we're calling the data on the page, rather than the control, is so that the control can remain "dumb" and doesn't need to know whether it's a member, admin, or web display control. The less logic in the control, the better; just spit out the lowest common denominator.

Ok. Now that we've hit the reusable control side, let's hit the fake-an-ajax-master-page part.

As you may or may not know, even if you wrap the ContentTemplate in a MasterPage, it still reloads every page change. This is because the MasterPage gets loaded __after__ the rest of the page, and is treated like a control. So, if you change pages.. it loads the page, and then says afterwards, 'oh, yeah, that was Ajax. Oh well.'

The cool thing you can do, is make one default page, and inside of that have user controls in place of your pages, something like this:

-Make your default.aspx page
-Create user controls; however, rather than logic in Page_Load of the control, put it all in a public class-level method you call Initialize.You'll see why soon.
-Put all of your controls into your default.aspx page, with visible="false".
-On the onclick of your navigation buttons, run the Initialize on the control, and set it's __visible__ property to __true__, and all the others to __false__.. I might alternately suggest using Command and a single method rather than Onclick and seperate methods for each button, so you can pass through a CommandName, which you can then use in a switch statement and know what button you hit.

Ok. Now that we have our fancy Ajaxy page, you may be wondering: why not just visiblity? Why this Initialize thing?

This is because ASP.NET will fully render the controls, visible or not. Which means that if you have 10 pages, it will load those 10 pages and display one; which is a big performance hit on the server, especially if you're loading database data into each of those 10. Having to explicitly call Initialize avoids this. It also allows you to pass through a common parameter to each of the controls (say, a title string that displays at the top of each control) .

Controls can certainly do much more than this; but these are the biggies for me. Have any .ascx uses of your own?

