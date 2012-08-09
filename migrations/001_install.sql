CREATE TABLE IF NOT EXISTS `noviusos_comments_comment` (
  `comm_id` int(10) unsigned NOT NULL,
  `comm_parent_id` int(10) unsigned NOT NULL,
  `comm_email` varchar(255) NOT NULL,
  `comm_author` varchar(255) NOT NULL,
  `comm_content` text NOT NULL,
  `comm_created_at` datetime NOT NULL,
  `comm_ip` varchar(15) NOT NULL,
  `comm_state` enum('published','pending','refused') NOT NULL,
  PRIMARY KEY (`comm_id`),
  KEY `comm_created_at` (`comm_created_at`),
  KEY `comm_parent_id` (`comm_parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;