---
layout: post
title: Kubuntu 8.10 and Wireless
permalink: /2008/12/kubuntu-810-and-wireless/index.html
post_id: 30
categories: 
- intrepid ibex
- kubuntu 8.10
- Linux
- ndiswrapper
- ndiswrapper error
- patch
---

After using Vista for a while (and after my brief <a href="http://www.thejacklawson.com/2008/05/ubuntu-84-and-kde4.html">experimentation with Ubuntu 8.04</a>), I decided to go ahead and create another partition for Kubuntu 8.10, with KDE 4.1. I did it with the latest version of Wubi. It installed fast, booted fast, and left me without wireless (as I expected). Problem is, I had moved my office downstairs, leaving the router upstairs; I had to get wireless working somehow.

So, I booted up my laptop and began a search. "Install <a href="http://sourceforge.net/projects/ndiswrapper/">Ndiswrapper</a>", was the first bit of advice I got; so, I downloaded this onto a flash drive, plugged it into my new Linux machine (which found the drive and popped it up helpfully), and tried to install it. I followed the instructions left by the developer in the 'Install' notes; however, to my dismay, I was unable to due to an error that read "error: too few arguments to function 'iwe_stream_add_value' ". Having no clue what it meant, I did a quick Google search, and found out I had to patch the Ndiswrapper with <a href="http://www.slackware.com/%7Ealien/slackbuilds/ndiswrapper/build/ndiswrapper_kernel_2.6.27.patch">this patch</a>. 

I copied the patch file into the directory, then ran 

__patch -p0 > ndiswrapper_kernel_2.6.27.patch__

... and again, I hit a wall; it threw up an error that the patch command is not recognized. So, again, I hit google and found that I needed to now download and run the <a href="http://packages.ubuntu.com/intrepid/patch">"Patch" installation file</a> (I already had all the dependencies installed). Now, I ran the patch command, and it worked! I installed Ndiswrapper, then followed the guide <a href="http://ubuntuforums.org/showthread.php?t=9454">here</a>&nbsp; to get it up and running.

So, this was posted from Firefox in my new linux installation.

