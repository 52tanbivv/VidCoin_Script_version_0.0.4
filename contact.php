<?php
	require 'userauth.php';
	require 'config.php';
	require 'inc/functions.php';
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta charset="UTF-8">
<meta name="description" content="<?php print site_title(); ?> contact form">
<meta name="keywords" content="<?php print site_keywords(); ?>">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<title><?php print site_title(); ?> - Contact us</title>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
	<div id="fb-root"></div>
	<script>
      window.fbAsyncInit = function() {
        FB.init({
          appId: '<?php echo $facebook->getAppID() ?>',
          cookie: true,
          xfbml: true,
          oauth: true
        });
        FB.Event.subscribe('auth.login', function(response) {
          window.location.reload();
        });
        FB.Event.subscribe('auth.logout', function(response) {
          window.location.reload();
        });
      };
      (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol +
          '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>
<div id="wrapper">
	<?php if ($user) { ?>
<div id="leftbox">
	<div id="accountlogobox">
		<?php include 'inc/accountLogo.php';?>
	</div>
	<div id="userinfobox">
		<?php include 'inc/userMenu.php';?>
	</div>
</div>
<div id="rightbox">
	<div id="videobox">
		<form class='contactForm' name="contactform" method="post" action="contact.php">
		<?php include ('contactMailer.php');?>
			<span class='heading'>Your name</span><br/>
			<input class='contactInput' type='text' value='' id='contactformInput' name='contactformName'><br/>
			<span class='heading'>Your email address</span><br/>
			<input class='contactInput' type='text' value='' id='contactformInput' name='contactformEmail'><br/>
			<span class='heading'>Message</span><br/>
			<textarea  class='contactInput' name="contactformMessage" maxlength="50%" cols="25" rows="6"></textarea><br/>
			<input class='contactButton' type='submit' value='Submit' id='button' name='contactformSubmit'>
		</form>
	</div>
</div>
	<div id="creditsandlinks">
		<?php include 'inc/footerCredits.php';?>
	</div>
		<?php } else { ?>
		<div class="loggedoutLogoContainer">
			<a href="index.php"><img class="loggedoutVidCoinLogo" src="src/VidCoin160x64.png" alt="VidCoin logo - Earn free Bitcoins by watching short videos"></a>
		</div><br/>
		<form class='contactForm' name="contactform" method="post" action="contact.php">
		<?php include 'contactMailer.php';?>
			<span class='heading'>Your name</span><br/>
			<input class='contactInput' type='text' value='' id='contactformInput' name='contactformName'><br/>
			<span class='heading'>Your email address</span><br/>
			<input class='contactInput' type='text' value='' id='contactformInput' name='contactformEmail'><br/>
			<span class='heading'>Message</span><br/>
			<textarea  class='contactInput' name="contactformMessage" maxlength="50%" cols="25" rows="6"></textarea><br/>
			<div class="g-recaptcha" data-sitekey="<?php echo $siteKey;?>"></div>
			<input class='contactButton' type='submit' value='Submit' id='button' name='contactformSubmit'>
		</form>
	<div id="creditsandlinks">
		<?php include 'inc/footerCredits.php';?>
	</div>
		<?php } ?>
</div>
</body>
</html>