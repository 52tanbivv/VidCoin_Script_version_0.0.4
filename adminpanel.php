<?php 
session_start();
$fromSession = $_SESSION["sessionPW"];
require 'config.php';
require 'inc/functions.php';
	if ($adminPassword!==$fromSession) { // Checks for admin login session ?>
		<script>location.href='admin.php'</script>
<?php } else { // Session is OK. Proceed... ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="description" content="<?php print site_title(); ?> admin panel">
<meta name="keywords" content="<?php print site_keywords(); ?>">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<title><?php print site_title(); ?> - Admin panel</title>
</head>
<body>
<div id="adminWrapper">
	<div id="fadingBorders">
	<div id="topBox"><span><a class="success" href="adminpanel.php">Admin panel</a></span><br/></div>
	<div id="statBox">
		<span class="statBoxItems">
		Total members: <?php print total_users();?><br/>
		Total VidCoin exchanged: <?php print total_vc_exchanged(); ?><br/>
		Total BTC sent: <?php print total_btc_sent(); ?>
		</span>
	</div>
	<div id="adminTopLinks">
		<a class="adminTopLink" href="adminpanel.php?action=payment_requests">Payment requests</a> | <a class="adminTopLink" href="adminpanel.php?action=completed_payments">Completed payments</a> | <a class="adminTopLink" href="adminpanel.php?action=tech_support">Tech support</a> | <a class="adminTopLink" href="adminpanel.php?action=logout">Log out</a>
	</div>
	<div id="bottomBox">
		<?php
			// Marks a pending payment as completed
			if (isset($_POST['mark_as_paid']) && !empty($_POST['mark_as_paid'])) {
				$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
				$mark_as_paid = mysqli_real_escape_string($con, $_POST['mark_as_paid']);
				mysqli_query($con, "UPDATE requests SET iscomplete='yes' WHERE id=".$mark_as_paid);
				mysqli_close($con);
			}
			// Get the action into a variable and use it for various actions
			$action = $_GET["action"];
			
			// Payment requests
			if ($action==='payment_requests') { ?>
				<div id="notes">
				Send the amount in 'BTC Value' to the wallet in 'BTC Wallet' and then click 'Mark as Paid' to archive.
				1 VidCoin is currently worth <?php print btc_price(); ?> BTC</div><br/>
			<?php
				// Display a list of unpaid members
				$unpaid_users = unpaid_users();
				while ($row = mysqli_fetch_array($unpaid_users)) {
				echo "<table class='table'><tr><td>User</td><td>BTC Wallet</td><td>VidCoin</td><td>BTC Value</td><td>Date</td><td>IP Address</td><td>Action</td></tr>";
				echo '<tr><td>'.$row['fbid'].'</td><td>'.$row['btcaddress'].'</td><td>'.$row['amount'].'</td><td>'.$row['valueinbtc'].'</td><td>'.$row['date'].'</td><td>'.$row['ip'].'</td><td><form action="adminpanel.php?action=payment_requests" method="post"><input type="hidden" name="mark_as_paid" value='.$row['id'].'><input type="submit" class="btcregformbutton" value="Mark as Paid" /></form></td></tr>';
				}
			}
			
			// Completed payments
			if ($action==='completed_payments') {
				$paid_users = paid_users();
					while ($row = mysqli_fetch_array($paid_users)) {
						echo "<table class='table'><tr><td>User</td><td>BTC Wallet</td><td>VidCoin</td><td>BTC Value</td><td>Date</td><td>IP Address</td></tr>";
						echo '<tr><td>'.$row['fbid'].'</td><td>'.$row['btcaddress'].'</td><td>'.$row['amount'].'</td><td>'.$row['valueinbtc'].'</td><td>'.$row['date'].'</td><td>'.$row['ip'].'</td></tr>';
					}
				}
				
			// Tech support is where you contact me!
			if ($action==='tech_support') {?>
				<span class="techSupportTitle">Need help?</span><br/>
				<span class="techSupportMsg">You can get in touch with me via:</span><br/>
				<ul>
					<li><a href="https://www.facebook.com/frankpetser" target="_blank">Facebook</a></li>
					<li><a href="mailto:f@ynef.net">eMail</a> to f@ynef.net</li>
				</ul>
				<span class="techSupportMsg">I try my best to answer all of your questions!<br/>Frank Petser</span>
			<?php }
			
			// Logs you out
			if ($action==='logout') {
				session_unset(); 
				session_destroy();
				?><script>location.href='admin.php'</script><?php
				}?>
			<?php
			if (empty($action)) {
				// No action, display the news instead
				?>
			<span class="techSupportTitle">What's new</span><br/>
			<?php
				$theNews = file_get_contents('http://www.ynef.net/vidcoinscript/AdminNews.txt');
				echo $theNews;
				}
				?>
	</div>
	</div>
</div>
</body>
</html>
<?php } ?>