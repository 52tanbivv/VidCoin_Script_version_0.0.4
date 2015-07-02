<span class="accountgreeting">Hello <?php print get_username(); ?> !</span><br/>
<span class='accountheading'>You have earned <span class='coin'><?php print get_balance(); ?></span> VidCoins so far.</span><br/>
<span class='accountheading'>1 VidCoin is currently worth <?php print btc_price(); ?> Satoshis.</span><br/>
<span class='accountlinks'><a href="account.php">Videos</a> | <a href="redeem.php">Redeem</a> | <?php $logouturl = $facebook->getLogoutUrl(); echo "<a href=$logouturl>Log out</a>"; ?></span><br/>
<span class='reflink'>Your referral link:</span><br/>
<span class='reflink'><a href="http://<?php echo $vcDomain;?>?ref=<?php echo $currentfbid;?>">http://<?php echo $vcDomain;?>?ref=<?php echo $currentfbid;?></a></span><br/>
<span class='reflink'>Earned from referrals: <?php print get_ref_balance(); ?></span>