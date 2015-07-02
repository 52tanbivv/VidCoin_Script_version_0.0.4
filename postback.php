<?php

$user_id = $_GET["id"];
$vidcoins = $_GET["vc"];
$timestamp = $_GET["ts"];

	require 'config.php';
	$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
	$query = " SELECT * FROM data WHERE fbid = '$user_id' ";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	$reward = $row['balance']+$vidcoins;
	$setBalance = " UPDATE data SET balance='$reward' WHERE fbid='$user_id' ";
	mysqli_query($con, $setBalance);
	
	$setHistory = " INSERT INTO history VALUES ('','$user_id','$vidcoins','$timestamp') ";
	mysqli_query($con, $setHistory);

	// Below is for the referral system
	$thing = mysqli_query($con, " SELECT * FROM referrals WHERE fbidof_referred = '$user_id' ");
	// Thing should now contain data about whether or not this user is referred
	
		if(mysqli_num_rows($thing) !== 0) {
		
			// " Referrals Table Balance "
			$oldRTB = mysqli_query($con, " SELECT balance FROM referrals WHERE fbidof_referred = '$user_id' ");
			$rowRTB = mysqli_fetch_array($oldRTB);
			$bonus = $vidcoins*$refBonus/100;
			$totalRTB = $bonus+$rowRTB[0];
			mysqli_query($con, "UPDATE referrals SET balance='$totalRTB' WHERE fbidof_referred='$user_id'");
			
			// " Referrer Data Balance "
			$getReferrer = mysqli_query($con, " SELECT referrer_fbid FROM referrals WHERE fbidof_referred = '$user_id' ");
			$referrerID = mysqli_fetch_array($getReferrer);
			$oldRDB = mysqli_query($con, " SELECT balance FROM data WHERE fbid = '$referrerID[0]' ");
			$rowRDB = mysqli_fetch_array($oldRDB);
			$totalRDB = $bonus+$rowRDB[0];
			mysqli_query($con, "UPDATE data SET balance='$totalRDB' WHERE fbid = '$referrerID[0]' ");
		}
		
mysqli_close($con);


?>