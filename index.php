<?php 

	require 'userauth.php';
	require 'config.php';
	require 'inc/functions.php';
	
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta charset="UTF-8">
<meta name="description" content="<?php print site_description(); ?>">
<meta name="keywords" content="<?php print site_keywords(); ?>">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="small_screens.css" type="text/css" media="all and (max-width: 480px)">
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<title><?php print site_title(); ?> - <?php print site_title_tag(); ?></title>
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
	<div id="logobox"><?php include 'inc/bigLogo.php';?></div>
	<span class="logginginmsg">Logging in...</span><br/>
	<?php
		$u = get_fbid();
		if($u == 0) {
		// The user is not found... let's create them:
		
			// Get the referrer if there is one
			$referrer = $_GET["ref"];
			// Check if the user was referred or not
			if (!empty($referrer)) {
				add_ref_data();
				} ?>
			<span class='heading'>Welcome!</span><br/>
			<span class='heading'>Since it's your first time here you need to enter your Bitcoin wallet ID below.</span><br/>
			<span class='heading'>You can get one for free at <a href="https://blockchain.info/" target="_blank">BlockChain.Info</a></span><br/><br/>
			<span class='warningmsg'>Make sure you enter it correctly because it can't be changed!</span><br/>
			<form class="btcregform" action='register.php' method='post'>
				<input class="btcregforminput" type='text' value='' id='btcaddress' name='btcaddress'>
				<input class="btcregformbutton" type='submit' value='Submit' id='button' name='regButton'>
			</form>
			<div id="creditsandlinks">
				<?php include 'inc/footerCredits.php';?>
			</div>
		<?php } else {
			// User is found! Redirect them to their account. ?>
			<script>location.href='account.php'</script>
		<?php } ?>

	<?php } else {
		// Facebook API detected no active user ID ?>
		<div id="logobox"><?php include 'inc/bigLogo.php';?></div>
		<div id="contentbox">
			<div id="leftcontent">
				<span class="greeting">Hello guest !</span><br/>
				<p class='heading'>For your convenience VidCoin uses your existing Facebook account to authenticate you.</p>
				<p class='heading'>If it's your first time here you will be asked to provide a Bitcoin wallet ID so that we can make payments to you.</p>
				<fb:login-button></fb:login-button>
			</div>
			<div id="rightcontent">
				<span class="rightheading">What is VidCoin?</span><br/>
				<p class='heading'>VidCoin is a virtual currency that can only be earned by watching short videos on our website.</p>
				<p class='heading'>You can exchange your VidCoins into Bitcoins (BTC) at any time.</p>
				<p class='heading'>One VidCoin is currently worth <?php print btc_price(); ?> Satoshis.</p>
				<p class='heading'>There is no minimum amount to reach in order to exchange!</p>
			</div>	
		</div>
	<div id="creditsandlinks">
		<?php include 'inc/footerCredits.php';?>
	</div>
<?php } ?>
</div>
</body>
</html>