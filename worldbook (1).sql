-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnueabihf (armv8l)
--
-- Host: localhost    Database: worldbook
-- ------------------------------------------------------
-- Server version	10.3.22-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(100) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `receiver` varchar(100) NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `m_read` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`message_id`),
  KEY `receiver` (`receiver`),
  KEY `sender` (`sender`),
  CONSTRAINT `receiver` FOREIGN KEY (`receiver`) REFERENCES `wb_users` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sender` FOREIGN KEY (`sender`) REFERENCES `wb_users` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (29,'Hello World!','alvarusky','Alvaro','2020-07-31 17:04:42',1),(30,'Hello','alvarusky','Alvaro','2020-07-31 17:04:42',1),(31,'Hi! How are you?','Alvaro','alvarusky','2020-07-31 17:02:21',1),(32,'I\'m actually pretty good','alvarusky','Alvaro','2020-07-31 17:04:42',1),(33,'What \'bout u?','alvarusky','Alvaro','2020-07-31 17:04:42',1),(34,'I\'m doing good! Thanks','Alvaro','alvarusky','2020-07-31 17:02:21',1),(35,'Thats good','alvarusky','Alvaro','2020-07-31 17:04:42',1),(36,'yeah','Alvaro','alvarusky','2020-07-31 17:02:21',1),(37,'soo','alvarusky','Alvaro','2020-07-31 17:04:42',1),(38,'what are you up to?','alvarusky','Alvaro','2020-07-31 17:04:42',1),(39,'i dont knoe','Alvaro','alvarusky','2020-07-31 17:02:21',1),(40,'wanna read something?','Alvaro','alvarusky','2020-07-31 17:02:21',1),(41,'okay','alvarusky','Alvaro','2020-07-31 17:04:42',1),(42,'what kind of books do u lie','alvarusky','Alvaro','2020-07-31 17:04:42',1),(43,'like*','alvarusky','Alvaro','2020-07-31 17:04:42',1),(44,'usually adventure or sci-fi','Alvaro','alvarusky','2020-07-31 17:02:21',1),(45,'i love sci-fi!','alvarusky','Alvaro','2020-07-31 17:04:42',1),(46,'rly??','Alvaro','alvarusky','2020-07-31 17:02:21',1),(47,'yeah!','alvarusky','Alvaro','2020-07-31 17:04:42',1),(48,'i\'ve got harry potter here','Alvaro','alvarusky','2020-07-31 17:02:21',1),(49,'awesome','alvarusky','Alvaro','2020-07-31 17:04:42',1),(50,'can i go to your house to read?','alvarusky','Alvaro','2020-07-31 17:04:42',1),(51,'sure you can','Alvaro','alvarusky','2020-07-31 17:05:28',1),(52,'alrigh','alvarusky','Alvaro','2020-07-31 17:06:03',1),(53,'wait you here','Alvaro','alvarusky','2020-07-31 17:07:08',1),(54,'give me 5 mins','alvarusky','Alvaro','2020-07-31 17:07:27',1),(55,'hey! i\'ll be a bit late','alvarusky','Alvaro','2020-07-31 18:54:13',1),(56,'no proble,','Alvaro','alvarusky','2020-07-31 18:54:36',1),(57,'proble,','Alvaro','alvarusky','2020-07-31 18:54:40',1),(58,'problem😂','Alvaro','alvarusky','2020-07-31 18:55:05',1),(59,'hahaha','alvarusky','Alvaro','2020-07-31 18:55:11',1),(60,'😂😂','alvarusky','Alvaro','2020-07-31 18:57:25',1),(61,'by the way','alvarusky','Alvaro','2020-07-31 18:57:25',1),(62,'yeah?','alvarusky','Alvaro','2020-07-31 18:57:25',1),(63,'yeah what','Alvaro','alvarusky','2020-07-31 18:57:34',1),(64,'do u like ice cream?','alvarusky','Alvaro','2020-07-31 18:58:08',1),(65,'ive got some','alvarusky','Alvaro','2020-07-31 18:58:13',1),(66,'oohh','Alvaro','alvarusky','2020-07-31 18:58:19',1),(67,'i LOVE ice cream','Alvaro','alvarusky','2020-07-31 18:58:24',1),(68,'nice :)','alvarusky','Alvaro','2020-07-31 18:58:49',1),(69,'im almost there','alvarusky','Alvaro','2020-07-31 19:12:06',1),(70,'i see','Alvaro','alvarusky','2020-07-31 19:12:19',1),(71,'i see you','Alvaro','alvarusky','2020-07-31 19:12:21',1),(72,'me too','alvarusky','Alvaro','2020-07-31 19:12:28',1),(73,'Hi Alvaro! Thanks ','alvarusky','Alvaro','2020-07-31 20:17:47',1),(74,'Thanks for the great time i had in your house','alvarusky','Alvaro','2020-07-31 20:19:55',1),(75,'it was great','alvarusky','Alvaro','2020-07-31 20:19:59',1),(76,'for sure','alvarusky','Alvaro','2020-07-31 20:28:37',1),(77,'oh !','Alvaro','alvarusky','2020-07-31 20:29:05',1),(78,'the pleasure is minee','Alvaro','alvarusky','2020-07-31 20:29:17',1),(80,'Hola maria','alvarusky','Mariquilla2004','2020-08-03 10:08:22',1),(81,'chat beta!!','alvarusky','Mariquilla2004','2020-08-03 10:08:22',1),(82,'Quien erees??','alvarusky','alvarotto','2020-08-02 19:57:12',1),(83,'pardon?','alvarusky','alvarotto','2020-08-02 19:57:12',1),(84,'hola','alvarotto','alvarusky','2020-08-02 19:57:25',1),(85,'hola','alvarusky','alvarotto','2020-08-02 19:57:43',1),(86,'alvaro?','alvarotto','Alvaro','2020-08-02 20:04:41',0),(87,'eres tu?','alvarotto','Alvaro','2020-08-02 20:04:44',0),(88,'hello','Mariquilla2004','alvarusky','2020-08-03 10:08:25',1),(89,'holaaa','alvarusky','Mariquilla2004','2020-08-03 10:08:32',1),(90,'abuso','alvarusky','Mariquilla2004','2020-08-03 10:08:35',1),(91,'no me lo creo','Mariquilla2004','alvarusky','2020-08-03 10:08:37',1),(92,'ay mai','Mariquilla2004','alvarusky','2020-08-03 10:08:41',1),(93,'estoy flipando','Mariquilla2004','alvarusky','2020-08-03 10:08:41',1),(94,'yaaa','alvarusky','Mariquilla2004','2020-08-03 10:08:45',1),(95,'🤣','Mariquilla2004','alvarusky','2020-08-03 10:39:05',1),(96,'🤣','alvarusky','Mariquilla2004','2020-08-03 10:39:12',1),(98,'hey there','alvarusky','I\'m Just A Test!','2020-08-03 16:30:32',1),(99,'hi!','I\'m Just A Test!','alvarusky','2020-08-03 16:33:16',1),(100,'heyy','alvarusky','I\'m Just A Test!','2020-08-03 16:33:28',1),(101,'what\'s up?','alvarusky','I\'m Just A Test!','2020-08-03 16:34:23',1),(102,'nothing','I\'m Just A Test!','alvarusky','2020-08-03 16:34:28',1),(103,'alright','alvarusky','I\'m Just A Test!','2020-08-03 17:08:16',1);
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `library`
--

DROP TABLE IF EXISTS `library`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `library` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `owner_id` varchar(255) NOT NULL,
  PRIMARY KEY (`book_id`),
  UNIQUE KEY `unique_book_per_user` (`owner_id`,`title`,`author`),
  CONSTRAINT `owner` FOREIGN KEY (`owner_id`) REFERENCES `wb_users` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `library`
--

LOCK TABLES `library` WRITE;
/*!40000 ALTER TABLE `library` DISABLE KEYS */;
INSERT INTO `library` VALUES (45,'Harry Potter','J.K.Rowling','alvarusky'),(47,'Los Cinco','Enid Blyton','alvarusky'),(46,'Mentes Poderosas','Author','alvarusky'),(48,'Outliers','Malcom Gladwell','alvarusky'),(50,'The Other Test','Author','alvarusky'),(49,'The Test','Author','alvarusky'),(51,'El Diario de Greg: Volando Voy','Jeff Kinney','Mariquilla2004'),(41,'Harry Potter','Jkrowling','Mariquilla2004'),(43,'Harry Potter','test','Mariquilla2004'),(42,'test','test','Mariquilla2004');
/*!40000 ALTER TABLE `library` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matches`
--

DROP TABLE IF EXISTS `matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matches` (
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `requester` varchar(255) NOT NULL,
  `found_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`title`,`author`,`owner`,`requester`),
  KEY `matches_owner` (`owner`),
  KEY `matches_requester` (`requester`),
  CONSTRAINT `matches_owner` FOREIGN KEY (`owner`) REFERENCES `library` (`owner_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `matches_requester` FOREIGN KEY (`requester`) REFERENCES `wishlist` (`requester_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matches`
--

LOCK TABLES `matches` WRITE;
/*!40000 ALTER TABLE `matches` DISABLE KEYS */;
INSERT INTO `matches` VALUES ('Harry Potter','J.K.Rowling','alvarusky','alvarotto','2020-07-27 13:45:35'),('test','test','Mariquilla2004','Alvaro','2020-07-21 09:55:46');
/*!40000 ALTER TABLE `matches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wb_users`
--

DROP TABLE IF EXISTS `wb_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wb_users` (
  `uid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fav_book` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `cred_user` (`name`,`email`),
  UNIQUE KEY `unique_name` (`name`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wb_users`
--

LOCK TABLES `wb_users` WRITE;
/*!40000 ALTER TABLE `wb_users` DISABLE KEYS */;
INSERT INTO `wb_users` VALUES ('7dc31315ea9bcfb2c228cc41615e7d49','alvarotto','ademiguel.gd2@gmail.com','password','All of them!','Seccond account of @alvarusky. This is a test account!','2020-07-27'),('8bc93320bd0c3029f3b44ee655d957ac','Mariquilla2004','mvarelacaraballo@hotmail.com','21032004','','','2020-07-21'),('aa6a3fcf227ca6ad9799ea7969aab42e','I\'m Just A Test!','imjustatest@tests.test','test',NULL,NULL,'2020-08-03'),('b67fae3c109aaa00869c36fcf5f04eae','alvarusky','ademiguel.gd@gmail.com','password','Zero to One, Mentes Poderosas','Teen, nerd, coder. Co-founder of WorldBook. Love reading!','2020-07-26'),('bfef9b2499da193134087a9ab6b3a241','Alvaro','kyr7ex@gmail.com','password',NULL,NULL,'2020-07-16');
/*!40000 ALTER TABLE `wb_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishlist` (
  `wishbook_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `requester_id` varchar(255) NOT NULL,
  PRIMARY KEY (`wishbook_id`),
  UNIQUE KEY `unique_book_per_user` (`requester_id`,`title`,`author`),
  CONSTRAINT `requester` FOREIGN KEY (`requester_id`) REFERENCES `wb_users` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlist`
--

LOCK TABLES `wishlist` WRITE;
/*!40000 ALTER TABLE `wishlist` DISABLE KEYS */;
INSERT INTO `wishlist` VALUES (39,'Test','Test','Alvaro'),(42,'Harry Potter','J.K.Rowling','alvarotto'),(43,'Un desastre de cumpleaños (La diversión de Martina 1)','Martina D\'Antiochia','Mariquilla2004');
/*!40000 ALTER TABLE `wishlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-03 18:42:48
