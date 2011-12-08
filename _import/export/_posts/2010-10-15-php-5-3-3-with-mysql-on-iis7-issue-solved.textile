---
layout: post
title: "PHP 5.3.3 with MySQL on IIS7: Issue Solved"
permalink: /2010/10/php-5-3-3-with-mysql-on-iis7-issue-solved/index.html
post_id: 304
categories: 
- Config
- PHP
- windows server 2008
---

Running Server 2008 - After following all of the normal install guides for PHP 5.3.3, I kept running across an error where the page would hang for about 60 seconds, and then give me a database connection issue. Strange indeed!

After struggling with this for a while, I came across <a href="http://blog.tjitjing.com/index.php/2010/02/php-5-3-1-upgrade-on-iis7-and-mysqlgives-internal-server-error.html" target="_blank">an enlightening blog post</a> that had a simple fix: remove the IPv6 definition for localhost, and everything was magical and happy and wonderful.

Open up your host file at c:windowssystem32driversetchosts, and comment out ::1 localhost so it looks like
bq. 127.0.0.1 localhost
#::1 localhost
And problem solved.