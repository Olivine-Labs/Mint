---
layout: post
title: Bluetooth Issue on My Dell Laptop
permalink: /2008/09/bluetooth-issue-on-my-dell-laptop/index.html
post_id: 26
categories: 
- dell bluetooth driver
- General
- lg dare bluetooth problem
- toshiba 350 bluetooth
---

I've got a Dell Latitude D820, with a Toshiba 350 bluetooth card. Don't ask me why Dell used a competing laptop brand's hardware, because obviously it isn't working out.... the fact that the Toshiba "Dell" drivers are two years old, while there are drivers out "for Toshiba laptops only" that are significantly newer. But I digress.

My issue was in connecting my <a href="http://estore.vzwshop.com/dare/">LG Dare</a> (__fantastic __phone, I might add) via Bluetooth. I used the drivers right off of Dell's website, which installed the "Bluetooth Stack By Toshiba For Windows" (what a mouthful). I was able to use dial-up-networking and use it as a modem, as well as setting up a serial port.. but couldn't do file transfers or use bluetooth programs. It just wouldn't find the phone.

So, after an unsucessful hour and a half on the phone with Dell tech support, and a full day of Googling, I decided to try something totally crazy: uninstall the Bluetooth Stack from add/remove programs, and then do a 'scan for hardware changes' in the device manager. (make sure the bluetooth is active (check for a blue icon next to your power icon on the screen hinge.) if it isn't there, you'll have to download the driver from dell's site, activate it, and then uninstall it.) And, woah, it worked! It now showed up as a bluetooth device, rather than a network device, and I could now do all the file transfer stuff.

Now, my next step is using some of the <a href="http://www.microsoft.com/express/samples/c4fdevkit/default.aspx">Bluetooth API stuff from C4F</a>, and make a proximity-based application.

