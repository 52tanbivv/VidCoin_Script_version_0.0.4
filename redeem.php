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
		<title><?php print site_title(); ?> - BTC exchange area</title>
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
		<?php
		if (isset($_POST["redeembutton"])) {

			$redeemedBalance = strip_tags($_POST["vidcoinamount"]);
			$actualBalance = get_balance();
			
				if ($actualBalance < $redeemedBalance && $redeemedBalance!=0) { // If trying to redeem what the user don't have OPEN ?>
				<span class='greeting'>Sorry, you can't exchange that...</span><br/>
				<span class='heading'>You have <?php echo $row['balance']; ?> VidCoins that you can exchange here.</span><br/>
				<span class='heading'>Enter the amount you wish to redeem and hit submit.</span><br/>
				<form class="btcregform" action='redeem.php' method='post'>
					<input class="btcregforminput" type='text' value='' id='vidcoinamount' name='vidcoinamount'>
					<input class="btcregformbutton" type='submit' value='Submit' id='button' name='redeembutton'>
				</form>
				<?php // If trying to redeem what the user don't have CLOSE
				} else { ?>  
				<?php
					// Redeem amount is OK OPEN
					$walletID = get_wallet_id();
					$date = date("Y-m-d H:i:s");
					$ipadr = $_SERVER['REMOTE_ADDR'];
					$iscomplete = 'no';
					$deductamount = $actualBalance-$redeemedBalance;
					// Get current BTC price from BlockChain into $btcprice (0,01 usd is virool payment per video) 
					$btcprice = file_get_contents('https://blockchain.info/tobtc?currency=USD&value=0.01');
					// Multiply the redeemed balance with the amount in actual BTC worth 0,01 usd.
					$valueInBTC = $redeemedBalance * $btcprice;
					// This gets rid of some formatting issues
					$actualBTC = sprintf("%.10f",$valueInBTC);
					$setBalance = " UPDATE data SET balance='$deductamount' WHERE fbid='$currentfbid' ";
					$con = connect();
					mysqli_query($con, $setBalance) or die ('Couldn\'t set balance to database !');
					$setRequest = " INSERT INTO requests VALUES ('','$currentfbid','$walletID','$redeemedBalance','$actualBTC','$date','$ipadr','$iscomplete') ";
					mysqli_query($con, $setRequest) or die ('Couldn\'t set payment request for admin into database !');
					mysqli_close($con);
				?>
				<span class='greeting'>Thank you!</span><br/>
				<span class='heading'>Your exchange request has been received.</span><br/>
				<span class='heading'>Please give us up to 48 hours to process it. On weekends it may take longer...</span><br/>
				<?php } //If redeem amount is OK CLOSE ?>
		<?php } else { // If the user hasn't done anything yet OPEN ?>
		<span class='greeting'>Redeem your VidCoins</span><br/>
		<span class='heading'>Enter the amount you wish to redeem and hit submit.</span><br/>
		<form class="btcregform" action='redeem.php' method='post'>
			<input class="btcregforminput" type='text' value='' id='vidcoinamount' name='vidcoinamount'>
			<input class="btcregformbutton" type='submit' value='Submit' id='button' name='redeembutton'>
		</form>
		<?php } //If the user hasn't done anything yet CLOSE ?>
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
</div> <!-- wrappers end -->
</body>
</html>