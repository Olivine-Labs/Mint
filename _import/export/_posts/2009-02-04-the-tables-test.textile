---
layout: post
title: The Tables Test
permalink: /2009/02/the-tables-test/index.html
post_id: 40
categories: 
- css
- user interface
- Web Design
- Web Standards
---

As I've noted before, I believe that you should only use tables if you have an explicit reason to. Here's the test I use, and I'm totally open for comments and suggestions.

1. Am I going to change the layout much?
If a lot, then I'll use CSS; and even if it's only a little, use CSS. It's easier to make far-reaching changes to a couple classes in a single file, than to modify the HTML structure of several pages. It's also easier to add a new box, or some kind of widget, to a CSSed design, since they stretch well, unlike many table-based designs that can explode when you go a pixel too far. You can do it with tables, but in the end, it turns out to be a kluge.

2. Am I worried about different screen resolutions?
For me, this is very important; I design from 1024x768 (downgrading gracefully, but not fully supporting 800x600 unless I have to; see stats here) all the way up to 1650. The problem with tables, is it's tricky to get a well-stretched website; it can be done, but it's usually akward. So, I always use the CSS way, where I can float elements, and create fixed- and fluid- width columns.

3. Do I care about accessibility?
The answer should always be "yes" here as well. Screen readers have a lot of trouble parsing tabilized content (in what order should it read?), whereas a well-designed, minimalistic HTML structure can be designed to order the content in the way it's meant to be read, and then placed in the correct places using CSS.

4. Do I ever want to read the code again?
A mess of tag-heavy <table>s,<tr>s, <td>s, and the occasionally sprinkled-in <th> gets in the way; especially if you've got more than one nested table. It's annoying to read the code and get from one logical place to the next. However, with a tag-light mix of <div>s with applied classes and IDs, you can see what's going on; you can see through all the gunk and mess of the markup and cut straight to the content.

5. Do I care about several media types (print, mobile)?
Tables don't always render right when printing a page; and they very rarely render correctly on a cellphone. That's where the @media attribute of CSS comes in; you don't have to make a totally seperate version of a site to allow your users to print, or to view from their cell. You can specifiy a simpler design that's easier to print, and a more compact design that's easier to view on a 340x200 screen with ease.

6. Do I care about search engines?
Search engines do a much better job at reading code-light pages, where the content's at the top and the markup is light.

7. Is this tabular data?
Use a table.

Tables were awesome back in 1995. But today, the trend is heavily in the favor of CSS and maintainable code for a reason.