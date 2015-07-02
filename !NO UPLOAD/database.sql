CREATE TABLE `data` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `btcaddress` varchar(35) NOT NULL,
  `balance` varchar(35) NOT NULL,
  `fbid` varchar(35) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
CREATE TABLE `referrals` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `referrer_fbid` varchar(35) NOT NULL,
  `fbidof_referred` varchar(35) NOT NULL,
  `isreferral` varchar(3) NOT NULL,
  `date` varchar(35) NOT NULL,
  `balance` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
CREATE TABLE `requests` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `fbid` varchar(35) NOT NULL,
  `btcaddress` varchar(35) NOT NULL,
  `amount` varchar(35) NOT NULL,
  `valueinbtc` varchar(35) NOT NULL,
  `date` varchar(35) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `iscomplete` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;