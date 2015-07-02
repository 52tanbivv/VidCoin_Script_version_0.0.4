

 _______________________
/ Installing the script \
-----------------------------------------------------------------------

	Open config.php and change the variables according to comments
	Save your changes!
	
	Create your SQL database tables by importing database.sql from
	the NO UPLOAD folder into your phpMyAdmin or equivalent.
	
	Upload all the files and folders except NO UPLOAD to your web
	server via FTP or cPanel.

-----------------------------------------------------------------------


 ____________________________
/ Setting up Virool postback \
-----------------------------------------------------------------------

	When you sign up with Virool go to MY SITES

	Click on ADD NEW SITE

	Choose ActivSocial as SITE TYPE
	
	Fill in INFO about your site (url, description etc.)
	
	UPLOAD a screenshot showing them the Virool widget on your site
	
	Choose relevant CATEGORIES for your site

	Set Currency 1 Coins to 0.01 USD

	Your CALLBACK URL is:
	www.yoursite.com/postback.php?id=[USER_ID]&vc=[REWARD]&ts=[TIMESTAMP]
	
	Choose PLAIN encryption method
	
	After your site is validated you will be provided an API KEY
	Paste that key into the $ViroolID variable in config.php
	
	Upload the config.php to update your settings!
	
-----------------------------------------------------------------------


 ___________________________
/ Setting up Facebook login \
-----------------------------------------------------------------------

	Visit http://developers.facebook.com and log in
	
	From the drop down menu click APPS and ADD NEW APP
	
	Choose WEBSITE as your app type
	
	Name your app and create new Facebook ID for it
	Note: Your app name will be public so choose a nice name
	
	Choose NO for test version to make it public right away
	
	Choose category. I chose Finance, but I think it can be
	related to your main site theme as well
	
	Click CREATE
	
	Scroll down to TELL US ABOUT YOUR WEBSITE
	
	Provide your website URLs (both can be the same)
	
	Click NEXT
	
	Click SKIP QUICKSTART on the top of the page
	
	You should now be in your app's DASHBOARD
	
	Take the APP ID and paste it into the variable
	$appID in config.php
	
	Take the APP SECRET and paste it into the variable
	$appSecret in config.php
	
	Upload the config.php to update your settings!
	
-----------------------------------------------------------------------


 ______________________
/ Setting up ReCaptcha \
-----------------------------------------------------------------------

	With your Google account log into www.google.com/recaptcha
	
	Click on GET RECAPTCHA
	
	Register a NEW site
	
	After you're done look for "Adding reCAPTCHA to your site"
	and paste the SITE KEY and SECRET KEY to the corresponding
	variables in config.php
	
-----------------------------------------------------------------------


 ___________________
/ Admin panel guide \
-----------------------------------------------------------------------

	Access the admin panel by visiting www.yoursite.com/admin.php
	
	Enter your admin password that you set up in config.php
	
	If password is good you will be redirected to the admin panel
	
	From here you can see pending payments, completed payments
	and contact tech support if needed
	
-----------------------------------------------------------------------


 _______________________________________________________
/ Credits and additional resources used in this project \
-----------------------------------------------------------------------

	Programming and design: ynef (http://www.ynef.net)
	Background images: Subtle Patterns (http://www.subtlepatterns.com)
	Movie icon: Find Icons (http://findicons.com/icon/131792/movie)
	Gold coins icon: Google. If it's yours let me know!
	
-----------------------------------------------------------------------