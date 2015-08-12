CREATE TABLE `backup` (
`backup_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`backup_name` varchar(255) NOT NULL,
`backup_location` varchar(255) NOT NULL,
`created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`backup_id`),
UNIQUE KEY `backup_name_UNIQUE` (`backup_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
