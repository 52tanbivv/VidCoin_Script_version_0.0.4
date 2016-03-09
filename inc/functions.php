<?php

	// Set some required variables
	$currentfbid = $user_profile['id'];
	$currentUser = $user_profile['first_name'];
	
	// Return the current site title
	function site_title() {
		require '../config.php';
		return $siteTitle;
	}
	
	// Return the current site title tags
	function site_title_tag() {
		require '../config.php';
		return $siteTitleTag;
	}
	
	// Return the current site description
	function site_description() {
		require '../config.php';
		return $siteDescription;
	}
	
	// Return the current site keywords
	function site_keywords() {
		require '../config.php';
		return $siteKeywords;
	}
	
	// Returns the VIROOL ID for postback
	function virool_id() {
		require '../config.php';
		return $ViroolID;
	}
	
	// Connect to database and do nothing else. Need to be closed manually!
	function connect() {
		require '../config.php';
		$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
		return $con;
	}
	
	// Returns the gender of the current user
	function gender() {
		require '../config.php';
		$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
		global $currentfbid;
		$query = " SELECT gender FROM data WHERE fbid = '$currentfbid' ";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		mysqli_close($con);
		return $row[0];
	}
	
	// Connect to database and return Bitcoin address of the current user
	function get_wallet_id() {
		require '../config.php';
		global $con;
		$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
		global $currentfbid;
		$query = " SELECT btcaddress FROM data WHERE fbid = '$currentfbid' ";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		mysqli_close($con);
		return $row[0];
	}
	
	// Connect to database and return the Balance of a current user
	function get_balance() {
		require '../config.php';
		$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
		global $currentfbid;
		$query = " SELECT balance FROM data WHERE fbid = '$currentfbid' ";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		mysqli_close($con);
		return $row[0];
	}
	
	// Connect to database and return referral earnings
	function get_ref_balance() {
		require '../config.php';
		$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
		global $currentfbid;
		$query = " SELECT balance FROM vidcoin_referrals WHERE referrer_fbid = '$currentfbid' ";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		mysqli_close($con);
			if (!empty($row[0])) {
				return $row[0];
			} else {
				return "0";
			}
	}
	
	// Connect to database and return the fbid (used for checking whether the user exists or not)
	function get_fbid() {
		require '../config.php';
		$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
		global $currentfbid;
		$query = " SELECT * FROM data WHERE fbid = '$currentfbid' ";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		mysqli_close($con);
		return $row[0];
	}
	
	// Returns the current username for greetings etc.
	function get_username() {
		require '../config.php';
		$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
		global $currentfbid;
		global $currentUser;
		$query = " SELECT '$currentUser' FROM data WHERE fbid = '$currentfbid' ";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		mysqli_close($con);
		return $row[0];
	}

	// This function adds referral data to the database
	function add_ref_data() {
		require '../config.php';
		$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
		global $currentfbid;
		$query = " SELECT * FROM referrals WHERE referrer_fbid = '$referrer' ";
		$result = mysqli_query($con, $query);
		$date = date("Y-m-d H:i:s"); // Set date for database
			if (mysqli_num_rows($result) == 0) {
				// No data was found. Add new data about referral.
				mysqli_query($con, "INSERT INTO referrals VALUES ('','$referrer','$currentfbid','yes','$date','0')");
			} else {
				// Referrer fbid exists, still need to create a new entry.
				mysqli_query($con, "INSERT INTO referrals VALUES ('','$referrer','$currentfbid','yes','$date','0')");
				}
		mysqli_close($con);
	}
	
	// Returns the current price of Bitcoin in Satoshis
	function btc_price() {
		$btcprice = file_get_contents('https://blockchain.info/tobtc?currency=USD&value=0.01');
		$satoshi = $btcprice * 100000000;
		return $satoshi;
	}
	
	// Returns total amount of members. This is used in the admin panel for stats.
	function total_users() {
		require '../config.php';
		$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
		$result = mysqli_query($con, "SELECT id FROM data");
		$num_rows = mysqli_num_rows($result);
		return $num_rows;
		mysqli_close($con);
	}
	
	// Returns the total amount of VidCoin exchanged into BTC
	function total_vc_exchanged() {
		require '../config.php';
		$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
		$result = mysqli_query($con, "SELECT SUM(amount) AS value_sum FROM requests");
		$row = mysqli_fetch_assoc($result);
		$sum = $row['value_sum'];
		return $sum;
		mysqli_close($con);
	}
	
	// Returns the total amount of BTC you have paid to your members
	function total_btc_sent() {
		require '../config.php';
		$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
		$result = mysqli_query($con, "SELECT SUM(valueinbtc) AS value_sum FROM requests");
		$row = mysqli_fetch_assoc($result);
		$sum = $row['value_sum'];
		print $sum;
		mysqli_close($con);
	}
	
	// Returns a list of unpaid payment requests as an array
	function unpaid_users() {
		require '../config.php';
		$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
		$result = mysqli_query($con, " SELECT * FROM requests WHERE iscomplete='no' ");
		return $result;
		mysqli_close($con);
	}
	
	// Returns a list of paid users as an array
	function paid_users() {
		require '../config.php';
		$con = mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
		$result = mysqli_query($con, " SELECT * FROM requests WHERE iscomplete='yes' ");
		return $result;
		mysqli_close($con);
	}
?>