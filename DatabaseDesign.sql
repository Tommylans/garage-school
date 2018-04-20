-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server versie:                10.1.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Versie:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Databasestructuur van garage wordt geschreven
CREATE DATABASE IF NOT EXISTS `garage` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `garage`;

-- Structuur van  tabel garage.auto wordt geschreven
CREATE TABLE IF NOT EXISTS `auto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kenteken` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `kmStand` int(100) NOT NULL,
  `klantid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `klantid` (`klantid`),
  KEY `kenteken` (`kenteken`),
  CONSTRAINT `FK_auto_users` FOREIGN KEY (`klantid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Data exporteren was gedeselecteerd
-- Structuur van  tabel garage.rollen wordt geschreven
CREATE TABLE IF NOT EXISTS `rollen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `level` enum('Monteur','Planner','Directie','Systeembeheerder','Klant') DEFAULT 'Klant',
  PRIMARY KEY (`id`),
  KEY `FK_rollen_users` (`userid`),
  CONSTRAINT `FK_rollen_users` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Data exporteren was gedeselecteerd
-- Structuur van  tabel garage.users wordt geschreven
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(120) NOT NULL DEFAULT '0',
  `adres` varchar(120) NOT NULL DEFAULT '0',
  `postcode` varchar(120) NOT NULL DEFAULT '0',
  `plaats` varchar(120) NOT NULL DEFAULT '0',
  `email` varchar(120) NOT NULL DEFAULT '0',
  `wachtwoord` varchar(1000) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unieke gebruiker` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Data exporteren was gedeselecteerd
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
