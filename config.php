<?php

/* Database connection settings
-------------------------------*/

// Hostname is usually just localhost
$hostname = "YnefsFaucet.db.12112809.hostedresource.com";

// Your database name
$dbname = "YnefsFaucet";

// Your database username
$dbusername = "YnefsFaucet";

// Your database password
$dbpassword = "Ko1Xk!l@kj";

/* Important settings
-------------------------------*/

// Your site title
$siteTitle = 'VidCoin';

// This is the ID you get after validating your site with Virool network at http://www.virool.com
// Read more from the README.txt about setting up VIROOL
$ViroolID = '60c86ff';

// These variables are your Facebook API keys. You get them after creating your app at https://developers.facebook.com/
// Read more from the README.txt about setting up Facebook login
$appID = '1495872057352301'; // The app id
$appSecret = '63460568b35a81611ca2619bd56c4f2b'; // The secret key

// Your domain name WITHOUT http and www (example: internet.com or vidcoin.internet.com if script will be in a sub domain)
$vcDomain = 'vidcoin.ynef.net';

// How much (in %) you want the referral bonus to be
// Right now it's 20% so if you earn $0,01 the person who referred you earns $0,002
// Not yet tested live.
$refBonus = '20';

// This is your admin panel password. It can contain characters like @£$€! etc.
// Your admin panel login screen is yoursite.com/admin.php
$adminPassword = 'Ko2jvKDKeOKvjdnf';

// Get these from: https://www.google.com/recaptcha if you don't want to receive spam emails through the Contact form.
// More info in README.txt
$siteKey = '6LfvTP4SAAAAADNzTDIe0FY6zH9ulkeOynrxzvce';
$secretKey = '6LfvTP4SAAAAAEvOSMHB7l_3ocK6WfsPt633UKbc';

// You SHOULD provide this. It is used on the Contact us page so you will be able to receive emails.
$adminEmail = 'admin@ynef.net';

/* Optional settings
-------------------------------*/

// The default title tag consists of the $siteTitle and $siteTitleTag. Example: VidCoin :: Earn free Bitcoin by watching short videos
$siteTitleTag = 'Earn free Bitcoin by watching short videos';

// Description meta tag
$siteDescription = 'Get VidCoin for every fun video you watch and exchange them into Bitcoin!';

// Keywords meta tag
$siteKeywords = 'btc,bitcoin,vc,vidcoin,free,earn,get,redeem,exchange,watch,videos,money,make';

// The contact us page's email subject that you receive
$emailSubject = 'New message from a VidCoin user!';

?>