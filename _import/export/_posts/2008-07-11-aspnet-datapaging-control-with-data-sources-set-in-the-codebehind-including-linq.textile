---
layout: post
title: ASP.NET DataPaging Control with Data Sources Set in the Codebehind (Including LINQ)
permalink: /2008/07/aspnet-datapaging-control-with-data-sources-set-in-the-codebehind-including-linq/index.html
post_id: 357
categories: 
- ASP.NET
- control
- data source codebehind
- DataPager
- Development
- ListView
- paging
---

After eight (well, seven.. lunch) torturous hours, trying to figure out something so simple, that should have been so easy, I'm finally done. (Spoiler: skip to the bottom to figure out how to fix the paging-control-one-step-behind issue)

My scenario: I had an IList of objects, populated via some nHibernate magic. How I got the data isn't the important thing; just mattered that I had an IList of some object that I needed to put into some kind of paged display. The tricky bit was doing it through the codebehind, rather than setting up an ObjectDataSource for it. I tried several different methods, but kept coming back to one solution: a ListView with the new DataPager control.

It should have been pretty easy; the the DataPager control isn't terribly hard to set up. Just throw in the control, populate the ID, runat, pagesize, and pagedcontrolid (the control that it adds paging to). That was attached to a listview, with an id and runat, and it had a layout template, item template, and alternatingtemplate inside of it. It all looked something like:
<div style="background-color: #bbb;"><!--[if gte mso 9]><xml>
<w :WordDocument>
</w><w :View>Normal</w>
<w :Zoom>0</w>
<w :PunctuationKerning />
<w :ValidateAgainstSchemas />
<w :SaveIfXMLInvalid>false</w>
<w :IgnoreMixedContent>false</w>
<w :AlwaysShowPlaceholderText>false</w>
<w :Compatibility>
<w :BreakWrappedTables />
<w :SnapToGridInCell />
<w :WrapTextWithPunct />
<w :UseAsianBreakRules />
<w :DontGrowAutofit />
</w>
<w :BrowserLevel>MicrosoftInternetExplorer4</w>

</xml>< ![endif]--><!--[if gte mso 9]><xml>
<w :LatentStyles DefLockedState="false" LatentStyleCount="156">
</w>
</xml>< ![endif]-->
<!-- /* Style Definitions */ p.MsoNormal, li.MsoNormal, div.MsoNormal {mso-style-parent:""; margin:0in; margin-bottom:.0001pt; mso-pagination:widow-orphan; font-size:12.0pt; font-family:"Times New Roman"; mso-fareast-font-family:"Times New Roman";} @page Section1 {size:8.5in 11.0in; margin:1.0in 1.25in 1.0in 1.25in; mso-header-margin:.5in; mso-footer-margin:.5in; mso-paper-source:0;} div.Section1 {page:Section1;} -->

<!--[if gte mso 10]>

<mce :style>< !  /* Style Definitions */ table.MsoNormalTable {mso-style-name:"Table Normal"; mso-tstyle-rowband-size:0; mso-tstyle-colband-size:0; mso-style-noshow:yes; mso-style-parent:""; mso-padding-alt:0in 5.4pt 0in 5.4pt; mso-para-margin:0in; mso-para-margin-bottom:.0001pt; mso-pagination:widow-orphan; font-size:10.0pt; font-family:"Times New Roman"; mso-ansi-language:#0400; mso-fareast-language:#0400; mso-bidi-language:#0400;} -->
<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New"; color: blue;"><</span><span style="font-size: 10pt; font-family: "Courier New"; color: #a31515;">asp</span><span style="font-size: 10pt; font-family: "Courier New"; color: blue;">:</span><span style="font-size: 10pt; font-family: "Courier New"; color: #a31515;">DataPager</span><span style="font-size: 10pt; font-family: "Courier New";"> <span style="color: red;">ID</span><span style="color: blue;">="dpDataPager"</span>
<span style="color: red;">runat</span><span style="color: blue;">="server"</span>
<span style="color: red;">PageSize</span><span style="color: blue;">="5"</span>
<span style="color: red;">PagedControlID</span><span style="color: blue;">="lvItems"></span></span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: blue;"><</span><span style="color: #a31515;">Fields</span><span style="color: blue;">></span></span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: blue;"><</span><span style="color: #a31515;">asp</span><span style="color: blue;">:</span><span style="color: #a31515;">NextPreviousPagerField</span><span> </span><span style="color: red;">NextPageText</span><span style="color: blue;">="next »"</span> <span style="color: red;">ShowFirstPageButton</span><span style="color: blue;">="true"</span> <span style="color: red;">ShowLastPageButton</span><span style="color: blue;">="false"</span> <span style="color: red;">ShowNextPageButton</span><span style="color: blue;">="false"</span> <span style="color: red;">ShowPreviousPageButton</span><span style="color: blue;">="true"</span> <span style="color: blue;">/></span></span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: blue;"><</span><span style="color: #a31515;">asp</span><span style="color: blue;">:</span><span style="color: #a31515;">NumericPagerField</span> <span style="color: red;">ButtonCount</span><span style="color: blue;">="10"/></span></span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: blue;"><</span><span style="color: #a31515;">asp</span><span style="color: blue;">:</span><span style="color: #a31515;">NextPreviousPagerField</span> <span style="color: red;">PreviousPageText</span><span style="color: blue;">="« previous"</span> <span style="color: red;">ShowFirstPageButton</span><span style="color: blue;">="false"</span> <span style="color: red;">ShowLastPageButton</span><span style="color: blue;">="true"</span> <span style="color: red;">ShowNextPageButton</span><span style="color: blue;">="true"</span> <span style="color: red;">ShowPreviousPageButton</span><span style="color: blue;">="false"</span> <span style="color: blue;">/></span></span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: blue;"></</span><span style="color: #a31515;">Fields</span><span style="color: blue;">></span></span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New"; color: blue;"></</span><span style="font-size: 10pt; font-family: "Courier New"; color: #a31515;">asp</span><span style="font-size: 10pt; font-family: "Courier New"; color: blue;">:</span><span style="font-size: 10pt; font-family: "Courier New"; color: #a31515;">DataPager</span><span style="font-size: 10pt; font-family: "Courier New"; color: blue;">></span>



<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New"; color: blue;"><</span><span style="font-size: 10pt; font-family: "Courier New"; color: #a31515;">asp</span><span style="font-size: 10pt; font-family: "Courier New"; color: blue;">:</span><span style="font-size: 10pt; font-family: "Courier New"; color: #a31515;">ListView</span><span style="font-size: 10pt; font-family: "Courier New";"> <span style="color: red;">ID</span><span style="color: blue;">="lvItems"</span>
<span style="color: red;">runat</span><span style="color: blue;">="server"</span><span style="color: blue;">></span></span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: blue;"><</span><span style="color: #a31515;">LayoutTemplate</span><span style="color: blue;">></span></span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: blue;"><</span><span style="color: #a31515;">span</span> <span style="color: red;">id</span><span style="color: blue;">="itemPlaceholder"</span> <span style="color: red;">runat</span><span style="color: blue;">="server"></</span><span style="color: #a31515;">span</span><span style="color: blue;">></span></span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: blue;"></</span><span style="color: #a31515;">LayoutTemplate</span><span style="color: blue;">></span></span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: blue;"><</span><span style="color: #a31515;">ItemTemplate</span><span style="color: blue;">></span></span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: blue;"><</span><span style="color: #a31515;">li</span> <span style="color: red;">class</span><span style="color: blue;">="even"></span><span style="background: yellow none repeat scroll 0% 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;"><%</span># Eval("Caption") <span style="background: yellow none repeat scroll 0% 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;">%></span><span style="color: blue;"></</span><span style="color: #a31515;">li</span><span style="color: blue;">></span></span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: blue;"></</span><span style="color: #a31515;">ItemTemplate</span><span style="color: blue;">></span></span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: blue;"><</span><span style="color: #a31515;">AlternatingItemTemplate</span><span style="color: blue;">></span></span>



<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: blue;"> </span></span> <!--[if gte mso 9]><xml>
<w :WordDocument>
</w><w :View>Normal</w>
<w :Zoom>0</w>
<w :PunctuationKerning />
<w :ValidateAgainstSchemas />
<w :SaveIfXMLInvalid>false</w>
<w :IgnoreMixedContent>false</w>
<w :AlwaysShowPlaceholderText>false</w>
<w :Compatibility>
<w :BreakWrappedTables />
<w :SnapToGridInCell />
<w :WrapTextWithPunct />
<w :UseAsianBreakRules />
<w :DontGrowAutofit />
</w>
<w :BrowserLevel>MicrosoftInternetExplorer4</w>

</xml>< ![endif]--><!--[if gte mso 9]><xml>
<w :LatentStyles DefLockedState="false" LatentStyleCount="156">
</w>
</xml>< ![endif]-->
<!-- /* Style Definitions */ p.MsoNormal, li.MsoNormal, div.MsoNormal {mso-style-parent:""; margin:0in; margin-bottom:.0001pt; mso-pagination:widow-orphan; font-size:12.0pt; font-family:"Times New Roman"; mso-fareast-font-family:"Times New Roman";} @page Section1 {size:8.5in 11.0in; margin:1.0in 1.25in 1.0in 1.25in; mso-header-margin:.5in; mso-footer-margin:.5in; mso-paper-source:0;} div.Section1 {page:Section1;} -->

<!--[if gte mso 10]>

<mce :style>< !  /* Style Definitions */ table.MsoNormalTable {mso-style-name:"Table Normal"; mso-tstyle-rowband-size:0; mso-tstyle-colband-size:0; mso-style-noshow:yes; mso-style-parent:""; mso-padding-alt:0in 5.4pt 0in 5.4pt; mso-para-margin:0in; mso-para-margin-bottom:.0001pt; mso-pagination:widow-orphan; font-size:10.0pt; font-family:"Times New Roman"; mso-ansi-language:#0400; mso-fareast-language:#0400; mso-bidi-language:#0400;} -->

<span style="font-size: 10pt; font-family: "Courier New"; color: blue;"><</span><span style="font-size: 10pt; font-family: "Courier New"; color: #a31515;">li</span><span style="font-size: 10pt; font-family: "Courier New";"> <span style="color: red;">class</span><span style="color: blue;">="odd"></span><span style="background: yellow none repeat scroll 0% 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;"><%</span>#
Eval("Caption") <span style="background: yellow none repeat scroll 0% 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;">%></span><span style="color: blue;"></</span><span style="color: #a31515;">li</span><span style="color: blue;">></span></span>
<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: blue;"></</span><span style="color: #a31515;">AlternatingItemTemplate</span><span style="color: blue;">></span></span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New"; color: blue;"></</span><span style="font-size: 10pt; font-family: "Courier New"; color: #a31515;">asp</span><span style="font-size: 10pt; font-family: "Courier New"; color: blue;">:</span><span style="font-size: 10pt; font-family: "Courier New"; color: #a31515;">ListView</span><span style="font-size: 10pt; font-family: "Courier New"; color: blue;">></span><span style="font-size: 10pt; font-family: "Courier New";"><span> </span></span>


</mce>

</mce></div>
And (the important bits) in my code behind:
In the Page_Load, I had

<!--[if gte mso 9]><xml>
<w :WordDocument>
</w><w :View>Normal</w>
<w :Zoom>0</w>
<w :PunctuationKerning />
<w :ValidateAgainstSchemas />
<w :SaveIfXMLInvalid>false</w>
<w :IgnoreMixedContent>false</w>
<w :AlwaysShowPlaceholderText>false</w>
<w :Compatibility>
<w :BreakWrappedTables />
<w :SnapToGridInCell />
<w :WrapTextWithPunct />
<w :UseAsianBreakRules />
<w :DontGrowAutofit />
</w>
<w :BrowserLevel>MicrosoftInternetExplorer4</w>

</xml>< ![endif]--><!--[if gte mso 9]><xml>
<w :LatentStyles DefLockedState="false" LatentStyleCount="156">
</w>
</xml>< ![endif]-->
<!-- /* Style Definitions */ p.MsoNormal, li.MsoNormal, div.MsoNormal {mso-style-parent:""; margin:0in; margin-bottom:.0001pt; mso-pagination:widow-orphan; font-size:12.0pt; font-family:"Times New Roman"; mso-fareast-font-family:"Times New Roman";} @page Section1 {size:8.5in 11.0in; margin:1.0in 1.25in 1.0in 1.25in; mso-header-margin:.5in; mso-footer-margin:.5in; mso-paper-source:0;} div.Section1 {page:Section1;} -->

<!--[if gte mso 10]>

<mce :style>< !  /* Style Definitions */ table.MsoNormalTable {mso-style-name:"Table Normal"; mso-tstyle-rowband-size:0; mso-tstyle-colband-size:0; mso-style-noshow:yes; mso-style-parent:""; mso-padding-alt:0in 5.4pt 0in 5.4pt; mso-para-margin:0in; mso-para-margin-bottom:.0001pt; mso-pagination:widow-orphan; font-size:10.0pt; font-family:"Times New Roman"; mso-ansi-language:#0400; mso-fareast-language:#0400; mso-bidi-language:#0400;} -->
<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New"; color: blue;">if</span><span style="font-size: 10pt; font-family: "Courier New";">
(!IsPostBack)</span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";">{</span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span>bind();</span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";">}</span>



And after the Page_Load method, I had
<!--[if gte mso 9]><xml>
<w :WordDocument>
</w><w :View>Normal</w>
<w :Zoom>0</w>
<w :PunctuationKerning />
<w :ValidateAgainstSchemas />
<w :SaveIfXMLInvalid>false</w>
<w :IgnoreMixedContent>false</w>
<w :AlwaysShowPlaceholderText>false</w>
<w :Compatibility>
<w :BreakWrappedTables />
<w :SnapToGridInCell />
<w :WrapTextWithPunct />
<w :UseAsianBreakRules />
<w :DontGrowAutofit />
</w>
<w :BrowserLevel>MicrosoftInternetExplorer4</w>

</xml>< ![endif]--><!--[if gte mso 9]><xml>
<w :LatentStyles DefLockedState="false" LatentStyleCount="156">
</w>
</xml>< ![endif]-->
<!-- /* Style Definitions */ p.MsoNormal, li.MsoNormal, div.MsoNormal {mso-style-parent:""; margin:0in; margin-bottom:.0001pt; mso-pagination:widow-orphan; font-size:12.0pt; font-family:"Times New Roman"; mso-fareast-font-family:"Times New Roman";} @page Section1 {size:8.5in 11.0in; margin:1.0in 1.25in 1.0in 1.25in; mso-header-margin:.5in; mso-footer-margin:.5in; mso-paper-source:0;} div.Section1 {page:Section1;} -->

<!--[if gte mso 10]>

</mce><mce :style>< !  /* Style Definitions */ table.MsoNormalTable {mso-style-name:"Table Normal"; mso-tstyle-rowband-size:0; mso-tstyle-colband-size:0; mso-style-noshow:yes; mso-style-parent:""; mso-padding-alt:0in 5.4pt 0in 5.4pt; mso-para-margin:0in; mso-para-margin-bottom:.0001pt; mso-pagination:widow-orphan; font-size:10.0pt; font-family:"Times New Roman"; mso-ansi-language:#0400; mso-fareast-language:#0400; mso-bidi-language:#0400;} -->
<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New"; color: blue;">private</span><span style="font-size: 10pt; font-family: "Courier New";"> <span style="color: blue;">void</span> bind()</span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";">{</span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: #2b91af;">IList</span><<span style="color: #2b91af;">Content</span>> content;</span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: blue;">int</span> id = <span style="color: #2b91af;">Int32</span>.Parse(Request.QueryString[<span style="color: #a31515;">"id"</span>]);</span>



<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: #2b91af;">FeatureValues</span>
fv = <span style="color: #2b91af;">FeatureValues</span>.AudioGuestBook;</span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span>content = <span style="color: #2b91af;">ContentWrapper</span>.GetContent(id);</span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span></span><span style="font-size: 10pt; font-family: "Courier New";">lvItems<span>.DataSource = </span></span><span style="font-size: 10pt; font-family: "Courier New";">content</span><span style="font-size: 10pt; font-family: "Courier New";"><span>;</span></span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span></span><span style="font-size: 10pt; font-family: "Courier New";">lvItems<span>.DataBind();</span></span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";">}</span>



And all was fine, and it rendered nicely. Except when you clicked to change a page, that is.

From there, weirdness ensued; it was out of sync, always one step behind.  If you clicked page 2, nothing happened. If you then clicked page 3, it went to page 2. If you went back to 1, it went to 3... and so on.  This led to a wild chase through several hours and pots of coffee using Google, which finally led me to <a href="http://forums.asp.net/t/1215848.aspx">a forum post</a>.  And there the answer was! It suddenly became clear: a solution which was, in the end, rather simple, if a little obscure. I added:
<!--[if gte mso 9]><xml>
<w :WordDocument>
</w><w :View>Normal</w>
<w :Zoom>0</w>
<w :PunctuationKerning />
<w :ValidateAgainstSchemas />
<w :SaveIfXMLInvalid>false</w>
<w :IgnoreMixedContent>false</w>
<w :AlwaysShowPlaceholderText>false</w>
<w :Compatibility>
<w :BreakWrappedTables />
<w :SnapToGridInCell />
<w :WrapTextWithPunct />
<w :UseAsianBreakRules />
<w :DontGrowAutofit />
</w>
<w :BrowserLevel>MicrosoftInternetExplorer4</w>

</xml>< ![endif]--><!--[if gte mso 9]><xml>
<w :LatentStyles DefLockedState="false" LatentStyleCount="156">
</w>
</xml>< ![endif]-->
<!-- /* Style Definitions */ p.MsoNormal, li.MsoNormal, div.MsoNormal {mso-style-parent:""; margin:0in; margin-bottom:.0001pt; mso-pagination:widow-orphan; font-size:12.0pt; font-family:"Times New Roman"; mso-fareast-font-family:"Times New Roman";} @page Section1 {size:8.5in 11.0in; margin:1.0in 1.25in 1.0in 1.25in; mso-header-margin:.5in; mso-footer-margin:.5in; mso-paper-source:0;} div.Section1 {page:Section1;} -->

<!--[if gte mso 10]>

</mce><mce :style>< !  /* Style Definitions */ table.MsoNormalTable {mso-style-name:"Table Normal"; mso-tstyle-rowband-size:0; mso-tstyle-colband-size:0; mso-style-noshow:yes; mso-style-parent:""; mso-padding-alt:0in 5.4pt 0in 5.4pt; mso-para-margin:0in; mso-para-margin-bottom:.0001pt; mso-pagination:widow-orphan; font-size:10.0pt; font-family:"Times New Roman"; mso-ansi-language:#0400; mso-fareast-language:#0400; mso-bidi-language:#0400;} -->
<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New"; color: red;">onpagepropertieschanging</span><span style="font-size: 10pt; font-family: "Courier New"; color: blue;">="lvItems_PagePropertiesChanging"</span>


<p class="MsoNormal">




to the ListView in the .ascx file, and
<!--[if gte mso 9]><xml>
<w :WordDocument>
</w><w :View>Normal</w>
<w :Zoom>0</w>
<w :PunctuationKerning />
<w :ValidateAgainstSchemas />
<w :SaveIfXMLInvalid>false</w>
<w :IgnoreMixedContent>false</w>
<w :AlwaysShowPlaceholderText>false</w>
<w :Compatibility>
<w :BreakWrappedTables />
<w :SnapToGridInCell />
<w :WrapTextWithPunct />
<w :UseAsianBreakRules />
<w :DontGrowAutofit />
</w>
<w :BrowserLevel>MicrosoftInternetExplorer4</w>

</xml>< ![endif]--><!--[if gte mso 9]><xml>
<w :LatentStyles DefLockedState="false" LatentStyleCount="156">
</w>
</xml>< ![endif]-->
<!-- /* Style Definitions */ p.MsoNormal, li.MsoNormal, div.MsoNormal {mso-style-parent:""; margin:0in; margin-bottom:.0001pt; mso-pagination:widow-orphan; font-size:12.0pt; font-family:"Times New Roman"; mso-fareast-font-family:"Times New Roman";} @page Section1 {size:8.5in 11.0in; margin:1.0in 1.25in 1.0in 1.25in; mso-header-margin:.5in; mso-footer-margin:.5in; mso-paper-source:0;} div.Section1 {page:Section1;} -->

<!--[if gte mso 10]>

</mce><mce :style>< !  /* Style Definitions */ table.MsoNormalTable {mso-style-name:"Table Normal"; mso-tstyle-rowband-size:0; mso-tstyle-colband-size:0; mso-style-noshow:yes; mso-style-parent:""; mso-padding-alt:0in 5.4pt 0in 5.4pt; mso-para-margin:0in; mso-para-margin-bottom:.0001pt; mso-pagination:widow-orphan; font-size:10.0pt; font-family:"Times New Roman"; mso-ansi-language:#0400; mso-fareast-language:#0400; mso-bidi-language:#0400;} -->
<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New"; color: blue;">protected</span><span style="font-size: 10pt; font-family: "Courier New";"> <span style="color: blue;">void</span> lvItems_PagePropertiesChanging(<span style="color: blue;">object</span> sender, <span style="color: #2b91af;">PagePropertiesChangingEventArgs</span>
e)</span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";">{</span>



<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span><span style="color: blue;">this</span>.dpDataPager.SetPageProperties(e.StartRowIndex,
e.MaximumRows, <span style="color: blue;">false</span>);</span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";"><span> </span>bind();</span>


<p class="MsoNormal"><span style="font-size: 10pt; font-family: "Courier New";">}</span>


<p class="MsoNormal">



in the codebehind. This caused a change in the page to update both the listview and the data shown - something that I had been trying to find in a handler for the paging control, rather than the listview.

So there you have it: How to get a paged listview by using a data source set in the codebehind.</mce>