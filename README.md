YOURLS-GA-MP-Tracking
====================

Track YOURLS link clicks with Google Analytics Measurement protocol in Real Time

YOURLS.org is a best cumstom URL shortner script in PHP. YOURLS has many usefull plugins. I've build this plugin for track link clicks in real time with Google Analytics. Already few plugins available for this purpose. Unfortunately  they are not working. So I've build my own plugin. It is working perfectly. 

<h3>
 Start Up </h3>
<ul>
<li>Create New Account Property in Google Analytics - Universal Analytic (Important)&nbsp;</li>
<li>Get Tracking ID (Eg: UA-43862376-6)&nbsp;</li>
<li>Download <i>YOURS-GA-MP-Tracking.zip</i>, extract it  and replace your GA Tracking code on line 48 (<b>$power_ga_mp_GAID</b>) in plugin.php</li>
<li>Upload&nbsp;<b>GA-Measurement-Protocol</b> folder to /user/plugins/ path. (html/YOURLS INSTALL PATH/user/plugins/)</li>
<li>Go to manage plugins in your YOURLS Admin interface and Activate it.</li>
</ul>
<div>
Now short &amp; share a link and watch clicks in Google Real Time reporting!&nbsp;</div>
<div>
</div>
<div>
I've planned to use Google Event tracking for deep YOURLS click tracking in future (Eg: Track User IP, Click counts, Redirect time and more)</div>
<div>
</div>
<div>
<ul>
<li>I've used "pre_redirect" function for track every click.&nbsp;</li>
<li>Please use Universal GA property. It is only support to Measurement protocol.</li>
</ul>
</div>

<h5>Note</h5>
Now Google Analytics shows  <b>Missing Tracking Code Page "yourShortUrl.com" for property "Custom Property" is missing valid tracking code</b> You can ignore this message. 

<div>
Keep in Touch with me on&nbsp;<a href="https://twitter.com/powerthazan" target="_blank">@powerthazan</a></div>

<ul>
<li>Browse more YOURS plugins <a href="https://github.com/YOURLS/YOURLS/wiki/Plugin-List" target="_blank">here</a></li>
</ul>

<h4>Version 1.1</h4>
Now, Real Time visitor location track-able.
There was no way to pass the end-user's IP or Geolocation (derived by GA from IP) neither through that or through the measurement protocol when I started to develop this plugin.

But their is no way to pass user Geolocation directly to GA-MP  at this stage.

Now Google Add uip paramater for IP Override. It is helping to determine user location from GA End point. The source of the traffic arriving to the short url domain is now availble in Reports.
