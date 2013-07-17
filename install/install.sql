CREATE TABLE IF NOT EXISTS `worldclock_settings` (
		`idx` int(11) NOT NULL auto_increment,
		`seq` int(10) NOT NULL,
		`pws_mode` int(1) NOT NULL,
		`pws_clock1_timezone` varchar(50) NOT NULL,
		`pws_clock2_timezone` varchar(50) NOT NULL,
		PRIMARY KEY  (idx)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;