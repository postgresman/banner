CREATE DATABASE banner;

CREATE USER 'banner'@'localhost' IDENTIFIED BY 'password'

GRANT ALL PRIVILEGES ON banner.* TO 'banner'@'localhost';

FLUSH PRIVILEGES;

USE banner;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `user_agent` text NOT NULL,
  `view_date` TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
  `page_url` text NOT NULL,
  `views_count` int unsigned DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


