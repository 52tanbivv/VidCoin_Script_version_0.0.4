<?php
	require 'userauth.php';
	require 'inc/functions.php';
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta charset="UTF-8">
<meta name="description" content="<?php print site_title(); ?> members area - watch videos and earn free VidCoins. Exchange your coins to BTC!">
<meta name="keywords" content="<?php print site_keywords(); ?>">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<title><?php print site_title(); ?> - Account panel</title>
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
		<iframe class="videoiframe" src='http://api.virool.com/offers/wall/<?php print virool_id(); ?>?ip_address=<?php echo $_SERVER['REMOTE_ADDR'];?>&suid=<?php echo $currentfbid;?>&gender=<?php print gender(); ?>' allowfullscreen scrolling='yes'></iframe>
	</div>
</div>
	<div id="creditsandlinks">
		<?php include 'inc/footerCredits.php';?>
	</div>
		<?php } else { ?>
		<?php include 'inc/loggedOutMessage.php';?>
	<div id="creditsandlinks">
		<?php include 'inc/footerCredits.php';?>
	</div>
		<?php } ?>
</div>
</body>
</html>