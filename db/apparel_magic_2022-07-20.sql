# ************************************************************
# Sequel Ace SQL dump
# Version 20033
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 8.0.29)
# Database: apparel_magic
# Generation Time: 2022-07-20 04:44:56 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `product_id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_name` text,
  `category` text,
  `season` text,
  `date_expected` datetime DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`product_id`, `product_name`, `category`, `season`, `date_expected`)
VALUES
	(1,'Shirt','Shirts','SS22','2022-09-23 00:00:00'),
	(2,'Hat','Hats','SS22','2022-09-01 00:00:00');

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table products_variants
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products_variants`;

CREATE TABLE `products_variants` (
  `variant_id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int unsigned DEFAULT NULL,
  `enabled` tinyint DEFAULT NULL,
  `color` text,
  `size` text,
  PRIMARY KEY (`variant_id`),
  KEY `FK_variant_product` (`product_id`),
  CONSTRAINT `FK_variant_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `products_variants` WRITE;
/*!40000 ALTER TABLE `products_variants` DISABLE KEYS */;

INSERT INTO `products_variants` (`variant_id`, `product_id`, `enabled`, `color`, `size`)
VALUES
	(1,1,1,'BLU','XS'),
	(2,1,0,'BLU','S'),
	(3,1,1,'BLU','M'),
	(4,1,1,'BLU','L'),
	(5,1,0,'BLU','XL'),
	(6,1,1,'YLW','XS'),
	(7,1,0,'YLW','S'),
	(8,1,1,'YLW','M'),
	(9,1,0,'YLW','L'),
	(10,1,0,'YLW','XL'),
	(11,2,1,'BLU','XS'),
	(12,2,0,'BLU','S'),
	(13,2,0,'BLU','M'),
	(14,2,0,'BLU','L'),
	(15,2,0,'BLU','XL'),
	(16,2,1,'YLW','XS'),
	(17,2,0,'YLW','S'),
	(18,2,1,'YLW','M'),
	(19,2,1,'YLW','L'),
	(20,2,0,'YLW','XL');

/*!40000 ALTER TABLE `products_variants` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
