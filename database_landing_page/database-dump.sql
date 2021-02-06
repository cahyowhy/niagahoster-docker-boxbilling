-- MySQL dump 10.13  Distrib 5.7.32, for osx10.15 (x86_64)
--
-- Host: localhost    Database: niagahoster-test
-- ------------------------------------------------------
-- Server version	5.7.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `total_usage` int(11) DEFAULT NULL,
  `features` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
INSERT INTO `prices` VALUES (1,'Bayi',19000,4100,938,'\n        <ul>\n            <li><strong>0.5X RESOURCE POWER</strong></li>\n            <li><strong>500 MB</strong> Disk Space</li>\n            <li><strong>Unlimited</strong> Bandwidth</li>\n            <li><strong>Unlimited</strong> Databases</li>\n            <li><strong>1</strong> Domain</li>\n            <li><strong>Instant</strong> Backup</li>\n            <li><strong>Unlimited SSL</strong> Gratis Selamanya</li>\n        </ul>\n        '),(2,'Pelajar',46900,23450,4168,'\n        <ul>\n            <li><strong>1X RESOURCE POWER</strong></li>\n            <li><strong>Unlimited</strong> Disk Space</li>\n            <li><strong>Unlimited</strong> Bandwidth</li>\n            <li><strong>Unlimited</strong> POP3 Email</li>\n            <li><strong>Unlimited</strong> Databases</li>\n            <li><strong>10</strong> Addon Domain</li>\n            <li><strong>Instant</strong> Backup</li>\n            <li><strong>Domain Gratis</strong> Selamanya</li>\n            <li><strong>Unlimited SSL</strong> Gratis Selamanya</li>\n        </ul>\n        '),(3,'Personal',58900,20000,10017,'\n        <ul>\n            <li><strong>2X RESOURCE POWER</strong></li>\n            <li><strong>Unlimited</strong> Disk Space</li>\n            <li><strong>Unlimited</strong> Bandwidth</li>\n            <li><strong>Unlimited</strong> POP3 Email</li>\n            <li><strong>Unlimited</strong> Databases</li>\n            <li><strong>Unlimited</strong> Addon Domain</li>\n            <li><strong>Instant</strong> Backup</li>\n            <li><strong>Domain Gratis</strong> Selamanya</li>\n            <li><strong>Unlimited SSL</strong> Gratis Selamanya</li>\n            <li><strong>Private</strong> Name Server</li>\n            <li><strong>SpamAssasin</strong> Mail Protection</li>\n        </ul>\n        '),(4,'Bisnis',109900,43100,3552,'\n        <ul>\n            <li><strong>3X RESOURCE POWER</strong></li>\n            <li><strong>Unlimited</strong> Disk Space</li>\n            <li><strong>Unlimited</strong> Bandwidth</li>\n            <li><strong>Unlimited</strong> POP3 Email</li>\n            <li><strong>Unlimited</strong> Databases</li>\n            <li><strong>Unlimited</strong> Addon Domain</li>\n            <li><strong>Magic Auto</strong> Backup & Restore</li>\n            <li><strong>Domain Gratis</strong> Selamanya</li>\n            <li><strong>Unlimited SSL</strong> Gratis Selamanya</li>\n            <li><strong>Private</strong> Name Server</li>\n            <li><strong>Prioritas</strong> Layanan Suport</li>\n            <li class=\'has-text-centered\'><i class=\'fas fa-star\'></i><i class=\'fas fa-star\'></i><i class=\'fas fa-star\'></i><i class=\'fas fa-star\'></i><i class=\'fas fa-star\'></i></li>\n            <li><strong>SpamExpert</strong> Pro Mail Protection</li>\n        </ul>\n        ');
/*!40000 ALTER TABLE `prices` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-07  1:46:14
