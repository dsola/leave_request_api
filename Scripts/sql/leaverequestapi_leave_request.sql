-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: leaverequestapi
-- ------------------------------------------------------
-- Server version	5.7.10

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
-- Table structure for table `leave_request`
--

DROP TABLE IF EXISTS `leave_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `date_start` timestamp NULL DEFAULT NULL,
  `date_end` timestamp NULL DEFAULT NULL,
  `comment` varchar(45) CHARACTER SET big5 DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_leave_request_employee1_idx` (`employee_id`),
  CONSTRAINT `fk_leave_request_employee1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_request`
--

LOCK TABLES `leave_request` WRITE;
/*!40000 ALTER TABLE `leave_request` DISABLE KEYS */;
INSERT INTO `leave_request` VALUES (3,'Leave Request 1','2015-03-07 12:30:00','2015-03-07 12:35:00','1457395900 ',1),(4,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(5,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(6,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(7,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(8,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(9,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(10,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(11,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(12,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(13,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(14,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(15,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(16,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(17,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(18,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(19,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(20,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(21,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(22,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(23,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(24,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1),(25,'My Leave Request 2','2016-03-08 10:41:18','2016-03-08 10:41:18','This is an interesting comment',1);
/*!40000 ALTER TABLE `leave_request` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-08 13:33:14
