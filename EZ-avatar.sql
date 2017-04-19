-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `ryongyon_ezavatar` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ryongyon_ezavatar`;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `text` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `comments` (`id`, `email`, `author`, `ip`, `time`, `text`) VALUES
(16,	'n',	'E',	'61.186.16.172',	'2017-04-19 19:28:38',	'Hello, world!'),
(15,	'a',	'あ',	'61.186.16.172',	'2017-04-19 19:27:54',	'Hello, world!'),
(14,	'25689@qq.com',	'帅',	'61.186.16.172',	'2017-04-19 19:24:24',	'Hello, world!'),
(13,	'admin@ryongyon.com',	'拾',	'61.186.16.172',	'2017-04-19 19:23:55',	'Hello, world!'),
(12,	'admin@ryongyon.com',	'叁',	'61.186.16.172',	'2017-04-19 19:23:48',	'Hello, world!'),
(11,	'279721075@qq.com',	'拾叁',	'61.186.16.172',	'2017-04-19 19:23:29',	'Hello, world!');

-- 2017-04-19 12:59:06
