<?php 
	session_start();
	require 'inc/functions.php';
	require 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="description" content="<?php print site_title(); ?> admin panel">
<meta name="keywords" content="<?php print site_keywords(); ?>">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<title><?php print site_title(); ?> - Admin login</title>
</head>
<body>
<div id="adminWrapper">
	<div id="loginBox">
	<?php if (!isset($_POST["adminPassword"])) { ?>
		<span class="adminTitle">Enter password</span><br/>
		<form class='adminform' name="adminform" method="post" action="admin.php">
		<input class='adminLoginInput' type='password' value='' id='adminPasswordInput' name='adminPasswordInput'>
		<input class='btcregformbutton' type='submit' value='Submit' id='button' name='adminPassword'></form>
	<?php } else {
		$currentPass = $_POST["adminPasswordInput"];
			if ($adminPassword==$currentPass) { 
				$_SESSION["sessionPW"] = $currentPass;
			?>
			<span class="success">Logging in...</span><br/>
			<script>location.href='adminpanel.php'</script>
			<?php }
			if ($adminPassword!==$currentPass) { ?>
			<span class="error">Invalid password!</span><br/>
			<form class='adminform' name="adminform" method="post" action="admin.php">
			<input class='adminLoginInput' type='text' value='' id='adminPasswordInput' name='adminPasswordInput'>
			<input class='btcregformbutton' type='submit' value='Submit' id='button' name='adminPassword'>
			<?php } ?>
	<?php } ?>
	</form>
	</div>
</div>
</body>
</html>