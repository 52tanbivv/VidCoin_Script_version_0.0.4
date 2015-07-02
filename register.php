<?php 
	require 'userauth.php';
	require 'inc/functions.php';
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="<?php print site_title(); ?> - First time user registration form">
		<meta name="keywords" content="<?php print site_keywords(); ?>">
		<link rel="stylesheet" href="style.css"/>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<title><?php print site_title(); ?> - Register</title>
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
	</head>
	<body>
    <?php if (isset($_POST["regButton"])) {
		connect();
		// Set variables to be written in the database
		$btcaddress = $_POST['btcaddress'];
		$balance = 0;
		$currentfbid = $user_profile['id'];
		$gender = $user_profile['gender'];
		$emailaddress = $user_profile['email'];
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		// Make the database query
		$query = "INSERT INTO data VALUES ('','$btcaddress','$balance','$currentfbid','$gender','$emailaddress','$ipaddress')";
		// Execute the query
		mysqli_query($con, $query) or die ('Couldn\'t execute database query!');
		mysqli_close($con);
	?>
		<div id="wrapper">
			<div id="logobox">
				<img class="VidCoinLogo" src="src/VidCoinLogo.png" alt="VidCoin logo - Earn free Bitcoins by watching short videos"/>
			</div>
			<span class="greeting">Awesome!</span><br/>
			<span class="heading">I have just created an account for you. From now on simply use your Facebook login to watch videos, check your balance or withdraw.</span><br/>
			<a class="gotit" href='index.php'>Got it!</a>
			<div id="creditsandlinks"><?php include 'inc/footerCredits.php';?></div>
		</div>
	<?php } else { echo "Error... <a href='index.php'>go back</a> and try again!";} ?>
	</body>
</html>