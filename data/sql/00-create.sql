-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `Containers`;
CREATE TABLE `Containers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(120) DEFAULT NULL,
  `shortHash` varchar(120) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `image` varchar(120) DEFAULT NULL,
  `memory` varchar(120) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Containers` (`id`, `hash`, `shortHash`, `name`, `image`, `memory`, `created`) VALUES
(1, NULL, NULL, 'asdasdasd',  'alpine', '128M', '2018-04-05 14:20:49'),
(2, NULL, NULL, 'asdasda',  'alpine', '128M', '2018-04-05 14:22:34'),
(3, NULL, NULL, 'asdasda',  'alpine', '128M', '2018-04-05 14:22:54'),
(4, NULL, NULL, 'asdasda',  'alpine', '128M', '2018-04-05 14:24:15'),
(5, NULL, NULL, 'asdasdasd',  'alpine', '128M', '2018-04-05 14:52:02'),
(6, NULL, NULL, 'asdasdas', 'alpine', '128M', '2018-04-05 14:53:36'),
(7, NULL, NULL, 'teste',  'alpine', '128M', '2018-04-05 15:15:53'),
(8, NULL, NULL, 'teste2', 'alpine', '128M', '2018-04-05 15:16:14'),
(9, NULL, NULL, 'testeC', 'alpine', '128M', '2018-04-05 15:16:37'),
(10,  NULL, NULL, 'testando', 'alpine', '128M', '2018-04-05 15:24:45'),
(11,  NULL, NULL, 'testador2',  'alpine', '1G', '2018-04-05 18:51:21');

DROP TABLE IF EXISTS `Hosts`;
CREATE TABLE `Hosts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(80) NOT NULL,
  `name` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Hosts` (`id`, `address`, `name`) VALUES
(1, 'host1:2375', 'Best First Host'),
(2, 'host2:2375', 'Great Second Host'),
(3, '10.7.8.50:2376', 'Chronos');

DROP TABLE IF EXISTS `Networks`;
CREATE TABLE `Networks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `Users_Containers`;
CREATE TABLE `Users_Containers` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `containerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2018-04-05 18:55:23