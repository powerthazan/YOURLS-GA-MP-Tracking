YOURLS-GA-MP-Tracking
====================

Track YOURLS link clicks with Google Analytics Measurement protocol in Real Time

YOURLS.org is the best custom URL shortener script in PHP. YOURLS has many useful plugins. I've built this plugin to track link clicks in real time with Google Analytics. There are already a few plugins available for this purpose, but unfortunately they are not working. So I've built my own. It is working perfectly.

### Start Up ###
* Create New Account Property in Google Analytics - Universal Analytics (important, but should be the default as of March 2016)
* Get Tracking ID (e.g. `UA-43862376-6`)
* Download `YOURLS-GA-MP-Tracking.zip`, extract it, and replace your GA Tracking code on line 64 (`$power_ga_mp_GAID`) in `plugin.php`
* Upload `GA-Measurement-Protocol` folder to YOURLS `user/plugins/` path (`html/YOURLS_INSTALL_PATH/user/plugins/`)
* Go to manage plugins in your YOURLS Admin interface and Activate it

Now shorten & share a link and watch clicks in Google Real Time reporting!

I plan to use Google Event Tracking for deep YOURLS click tracking in a future version (e.g. track user IP, click counts, redirect time, and more)

* I've used `pre_redirect` hook to track every click.
* Again: Please use Universal Analytics GA property. Only UA properties support the Measurement protocol.

##### Note #####
If you see "Missing Tracking Code" notifications in Google Analytics for your YOURLS property, you can ignore this message.

* Keep in touch with me on Twitter @[powerthazan](https://twitter.com/powerthazan)
* Browse more YOURLS plugins [here](https://github.com/YOURLS/YOURLS/wiki/Plugin-List)

#### Version 1.1 ####
Now, Real Time visitor location is trackable.
There was no way to pass the end-user's IP or Geolocation (derived by GA from IP) to the measurement protocol when I started to develop this plugin.

Now Google added `uip` paramater for IP Override. It helps to determine user location from GA endpoint. The source of the traffic arriving to the short URL domain is now available in Reports.
