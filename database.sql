DROP DATABASE IF EXISTS db_PHP_Rush_MVC;
CREATE DATABASE db_PHP_Rush_MVC;
USE db_PHP_Rush_MVC;


CREATE TABLE `users` (
  `id` SERIAL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `group` tinyint(4) DEFAULT NULL,
  `banned` tinyint(4) DEFAULT NULL,
  `creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `edition_date` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE NOW()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


  CREATE TABLE IF NOT EXISTS `articles` (
  `id` SERIAL,
  `user_id` varchar(255) NOT NULL,
  `title` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `category` tinyint(4) DEFAULT NULL,
  `creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `edition_date` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE NOW()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;



