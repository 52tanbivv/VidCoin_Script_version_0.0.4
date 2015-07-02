<?php 
	require 'userauth.php';
	require 'inc/functions.php';
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta charset="UTF-8">
<meta name="description" content="<?php print site_title(); ?> Frequently Asked Questions">
<meta name="keywords" content="<?php print site_keywords(); ?>">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<title><?php print site_title(); ?> - Frequently Asked Questions</title>
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
		<?php include 'inc/faqList.php';?>
	</div>
</div>
	<div id="creditsandlinks"><?php include 'inc/footerCredits.php';?></div>
		<?php } else { ?>
		<div class="loggedoutLogoContainer">
			<a href="index.php"><img class="loggedoutVidCoinLogo" src="src/VidCoin160x64.png" alt="VidCoin logo - Earn free Bitcoins by watching short videos"></a>
		</div><br/>
	<?php include 'inc/faqList.php';?>
	<div id="creditsandlinks"><?php include 'inc/footerCredits.php';?></div>
		<?php } ?>
</div>
</body>
</html>