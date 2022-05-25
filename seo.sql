-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: localhost    Database: secan
-- ------------------------------------------------------
-- Server version	5.7.32-0ubuntu0.18.04.1

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
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `route` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Beranda','frontHome'),(2,'Tentang Secan','frontAbout'),(3,'Artikel','frontNews'),(4,'Video','frontVideo'),(5,'Artikel Kecantikan','frontNewsCategory'),(6,'Artikel Kesehatan','frontNewsCategory'),(7,'Halaman Pencarian','frontSearch'),(8,'Video Kecantikan','frontVideoCategory'),(9,'Video Kesehatan','frontVideoCategory'),(10,'Dokter','frontDoctor');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seo`
--

DROP TABLE IF EXISTS `seo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key_id` varchar(45) DEFAULT NULL,
  `key_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seo`
--

LOCK TABLES `seo` WRITE;
/*!40000 ALTER TABLE `seo` DISABLE KEYS */;
INSERT INTO `seo` VALUES (2,'2','App\\Models\\Pages'),(4,'4','App\\Models\\Pages'),(6,'3','App\\Models\\Pages'),(8,'1','App\\Models\\Pages'),(10,'1','App\\Models\\News'),(11,'7','App\\Models\\Pages'),(13,'5','App\\Models\\Pages'),(14,'6','App\\Models\\Pages');
/*!40000 ALTER TABLE `seo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seo_trans`
--

DROP TABLE IF EXISTS `seo_trans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seo_trans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seo_id` int(11) NOT NULL,
  `locale` varchar(2) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_description` text,
  PRIMARY KEY (`id`),
  KEY `fk_seo_trans_1_idx` (`seo_id`),
  CONSTRAINT `fk_seo_trans_1` FOREIGN KEY (`seo_id`) REFERENCES `seo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seo_trans`
--

LOCK TABLES `seo_trans` WRITE;
/*!40000 ALTER TABLE `seo_trans` DISABLE KEYS */;
INSERT INTO `seo_trans` VALUES (3,2,'id','Tentang Secan','Tentang Secan','Tentang Secan'),(4,2,'en',NULL,NULL,NULL),(7,4,'id','Video','Video','Video'),(8,4,'en',NULL,NULL,NULL),(11,6,'id','Artikel','Artikel','Artikel'),(12,6,'en','','',''),(15,8,'id','Beranda Secan E','Beranda Secan E','Beranda Secan E'),(16,8,'en','','',''),(19,10,'id','Artikel Detail 1','Artikel Detail 1','Artikel Detail 1'),(20,10,'en','','',''),(21,11,'id','Hasil Pencarian','Hasil Pencarian','Hasil Pencarian'),(22,11,'en','','',''),(25,13,'id','Artikel Kecantikan','Artikel Kecantikan','Artikel Kecantikan'),(26,13,'en','','',''),(27,14,'id','Artikel Kesehatan','Artikel Kesehatan','Artikel Kesehatan'),(28,14,'en','','','');
/*!40000 ALTER TABLE `seo_trans` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-11 10:28:58
