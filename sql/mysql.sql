-- --------------------------------------------------------
-- Host:                         192.168.56.101
-- Server version:               5.6.20-68.0 - Percona Server (GPL), Release 68.0, Revision 656
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table app.access_tokens
CREATE TABLE IF NOT EXISTS `access_tokens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) unsigned DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `access_token` char(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `refresh_token` char(50) COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Data exporting was unselected.


-- Dumping structure for table app.billings
CREATE TABLE IF NOT EXISTS `billings` (
  `id` int(10) unsigned NOT NULL,
  `shop_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Data exporting was unselected.


-- Dumping structure for table app.shops
CREATE TABLE IF NOT EXISTS `shops` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `shop` char(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `shop_url` varchar(512) COLLATE utf8_polish_ci DEFAULT NULL,
  `auth_code` char(50) COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop` (`shop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Data exporting was unselected.


-- Dumping structure for table app.subscriptions
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) unsigned NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
