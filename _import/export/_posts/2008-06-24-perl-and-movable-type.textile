---
layout: post
title: Perl and Movable Type
permalink: /2008/06/perl-and-movable-type/index.html
post_id: 16
categories: 
- blogging
- Development
- iis
- IIS and Windows Technologies
- movabletype
- perl
- PHP
---

I finally made the switch for my blog to our own server, after Don got our new server up and running. We hammered through some <a href="http://www.fatalerroronline.com/2008/06/installing-and-configuring-dns.html">DNS fun</a> and then some <a href="http://www.fatalerroronline.com/2008/06/php-horror.html">PHP Horror</a>, and then, after everything was set up, it was Perl time.

What went through my head was a little chant: 'not a PHP install all over again.. not a PHP install all over again.. not a PHP install all over again.. '

And, it wasn't __quite __that bad. Close, but not quite. The difference was that in the Perl install, most of my guesses were correct. Because, as always, installing any non-Microsoft language on a 2k3 box with IIS is never going to be fun. I unzipped the MovableType (version 4.12) file into my web directory, and set off to configure everything. (I already had IIS and MySQL installed at this point).

That said, the first thing I did was install <a href="http://activestate.com/Products/activeperl/index.mhtml">ActivePerl</a> from ActiveState, version 5.10.0.1003. At the time of writing, this was the latest <strike>and greatest</strike>. I did the install (something that, if following this as instructions, I urge __not __to do, at least of that version... follow further down), and everything worked... except that there was no MySQL module to be found. Bummer.

So, after hours of troubleshooting that I won't bore you with, I finally googled around and found out that the 5.8 version (5.8.8.822, to be exact) still had the MySQL module. I uninstalled the old version and installed this older version, set up the extensions (IIS manager -> web site -> right-click, properties -> home directory -> configuration, add .cgi with the extension set to the perl.exe file where you installed perl, with the headers locked down to GET, HEAD, and POST). Basically, I followed this: <a href="http://www.movabletype.org/documentation/installation/windows.html">MT Windows Installation</a>. However, after all that was said and done, I still had the problem of it __not working.__

The first problem I had was that when I went to check the install by going to mt-check.cgi, it errored out halfway down the page. So, I opened up the ActivePerl Manager and set DBI and DBD-MySQL to reinstall. I also took the -original off of the "mt-config.cgi-original" file name.

The next thing to do is to open up that config file, and comment out
all of the data sources you're not using.&nbsp; Mine looked something like:

##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Movable Type configuration file&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ##
##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ##
## This file defines system-wide settings for Movable Type&nbsp;&nbsp;&nbsp; ##
## In total, there are over a hundred options, but only those ##
## critical for everyone are listed below.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ##
##&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ##
## Information on all others can be found at:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ##
## config

################################################################
##################### REQUIRED SETTINGS ########################
################################################################

# The CGIPath is the URL to your Movable Type directory
CGIPath&nbsp;&nbsp;&nbsp; http://www.crimsondeviations.com/blog/

# The StaticWebPath is the URL to your mt-static directory
# Note: Check the installation documentation to find out 
# whether this is required for your environment.&nbsp; If it is not,
# simply remove it or comment out the line by prepending a "#".
StaticWebPath&nbsp;&nbsp;&nbsp; http://www.crimsondeviations.com/blog/mt-static

#================ DATABASE SETTINGS ==================
#&nbsp;&nbsp; REMOVE all sections below that refer to databases 
#&nbsp;&nbsp; other than the one you will be using.

##### MYSQL #####
ObjectDriver DBI::mysql
Database movabletype
DBUser ********
DBPassword *************
DBHost localhost

##### POSTGRESQL #####
#ObjectDriver DBI::postgres
#Database DATABASE_NAME
#DBUser DATABASE_USERNAME
#DBPassword DATABASE_PASSWORD
#DBHost localhost

##### SQLITE #####
#ObjectDriver DBI::sqlite
#Database /path/to/sqlite/database/file

Then again, the mt-wizard page continued to error with "CGI Error. The specified CGI application misbehaved by not returning a complete set of HTTP headers".&nbsp; After more Googling around, I found out that you have to replace a line in every page in the main directory (luckily, not many: I opened them all in <a href="http://notepad-plus.sourceforge.net/uk/site.htm">Notepad++</a> and did a "replace all in opened files"). You have to change:
use lib $ENV{MT_HOME}&nbsp;? "$ENV{MT_HOME}/lib"&nbsp;: 'lib';
to
use lib $ENV{MT_HOME}&nbsp;? "$ENV{MT_HOME}/lib"&nbsp;: 'Y:wwwblogcgi-binmt4lib';
(replacing, of course, with whatever your path is).

Which then fixed my errors of it not finding the right data source, having wrong headers, and it magically worked, and I was on my way to blogdom!

