DROP DATABASE IF EXISTS db_PHP_Rush_MVC;
CREATE DATABASE db_PHP_Rush_MVC;
USE db_PHP_Rush_MVC;


CREATE TABLE `users` (
  `id` SERIAL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `group` varchar(10) DEFAULT NULL,
  `banned` varchar(10) DEFAULT NULL,
  `creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `edition_date` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE NOW()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `articles`;

CREATE TABLE IF NOT EXISTS `articles` (
  `id` SERIAL,
  `user_id` tinyint(4) NOT NULL,
  `title` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `category_id` tinyint(4) DEFAULT NULL,
  `creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `edition_date` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE NOW()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `categories`;

CREATE TABLE IF NOT EXISTS `categories` (
  `id` SERIAL,
  `category` text DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	
-- Ajout de catégories
INSERT INTO `categories` (`category`) VALUES("Kitchen"), ("Garden"), ("Leisure");

DROP TABLE IF EXISTS `comments`;

CREATE TABLE IF NOT EXISTS `comments` (
  `id` SERIAL,
  `user_id` tinyint(4) NOT NULL,
  `article_id` tinyint(4) NOT NULL,
  `content` text DEFAULT NULL,
  `creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `tags`;

CREATE TABLE IF NOT EXISTS `tags` (
  `id` SERIAL,
  `tag` text NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Ajout de tags
INSERT INTO `tags` (`tag`) VALUES("#fit"), ("#health"), ("#fun");

DROP TABLE IF EXISTS `links`;

CREATE TABLE IF NOT EXISTS `links` (
  `id` SERIAL,
  `tag_id` tinyint(4) NOT NULL,
  `article_id` tinyint(4) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
