-- MySQL dump 10.16  Distrib 10.1.39-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: cms
-- ------------------------------------------------------
-- Server version	10.1.39-MariaDB

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `cattitle` varchar(36) NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Oracle SQL'),(3,'Java'),(20,'PHP'),(21,'C#'),(22,'Mongo DB'),(24,'Java FX');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT,
  `commentcatid` int(11) DEFAULT NULL,
  `commentauthor` varchar(36) DEFAULT NULL,
  `commentemail` varchar(36) DEFAULT NULL,
  `commentcontent` text,
  `commentdate` date DEFAULT NULL,
  `commentstatus` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`commentid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,'Quadri','quad@gmail.com','I love the way you teach student with your smiling face, thank you','2019-06-16','active'),(2,NULL,'Sodeeq','sod@deek.com','I love this tutorial, thanks for the post, God bless you','2019-06-24',NULL),(5,14,'ibroh','email@ib.com','fine post','2019-06-26',NULL),(6,14,'JackMa','jack@ma.com','Nice post','2019-07-04',NULL),(7,22,'Azeezat','azeezat.bello@gmail.com','Alhamdulilah! i love the post.\r\nbravo to the admin','2019-07-21',NULL),(8,22,'Sodeeq','sod@deek.com','Cool information, am just hearing that now.','2019-07-21',NULL);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `postid` int(11) NOT NULL AUTO_INCREMENT,
  `postcatid` varchar(36) DEFAULT NULL,
  `posttitle` varchar(255) DEFAULT NULL,
  `postauthor` varchar(255) DEFAULT NULL,
  `postuser` varchar(36) DEFAULT NULL,
  `postdate` date DEFAULT NULL,
  `postimageurl` text,
  `postcontent` text,
  `posttags` varchar(255) DEFAULT NULL,
  `postcommentcount` int(11) NOT NULL,
  `poststatus` varchar(255) DEFAULT 'draft',
  `postviewscount` int(11) DEFAULT NULL,
  PRIMARY KEY (`postid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (16,'1','Database','Ibrahim','Ibrahim','2019-06-22','det.jpeg','database, oracle sql','database, oracle sql',4,'Active',NULL),(17,'C#','Microsoft Technology','Adeyemi','Student','2019-06-22','10win.jpg','OOP Concept in c#','OOP Concept in c#',4,'Active',NULL),(18,'PHP','PHP OOP','Adeyemi','Student','2019-06-23','14.jpeg','Php, oop, procedural','Php, oop, procedural',4,'draft',NULL),(19,'C#','Microsoft C#','Ibrahim','Student','2019-06-23','ahlusunnah.jpg','OOP Concept in c#','OOP Concept in c#',4,'Active',NULL),(21,'PHP','Islam as a way','Adeyemi','Student','2019-06-24','ahlu_sunnah.png','OOP Concept in c#','OOP Concept in c#',4,'draft',NULL),(22,'PHP','Science and Islam','Ibrahim','Student','2019-07-21','ibroh24_screen3.png','The many people unbiase people believe that Islam cannot be separate from science, as the fact that all the prove of science has been written in the book of Muslim since over 1400 years ago.\r\nThe fact that science discover different planet is not a big deal to muslim.','science, islam',4,'Active',NULL),(23,'PHP','PHP OOP','Adeyemi','Ibrahim Hammed','2019-07-21','masjida.jpg','New post on php','OOP Concept in c#',4,'draft',NULL),(24,'PHP','WordPress','Ibrahim','Ibrahim Hammed','2019-07-22','','This post is all about word press and the most widely used backend language for word press is PHP, that why we are going to be including php in the post.','PHP, wordpress',4,'Active',NULL);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(36) NOT NULL,
  `lastname` varchar(36) NOT NULL,
  `username` varchar(36) NOT NULL,
  `password` varchar(36) NOT NULL,
  `email` varchar(36) NOT NULL,
  `imageurl` text NOT NULL,
  `role` varchar(200) NOT NULL,
  `randsalt` varchar(200) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'sodeeq','wasiu','wasiu','password','wasiu.sodeeq@gmail.com','','subscriber',''),(6,'AbdulAziz','Hammed','Obalowu','password','az.oba@gmail.com','','Subscriber',''),(7,'Muiz','Bukhari','muiz','password','muiz.b@gmail.com','','admin',''),(8,'adeyemi','ibrahim','ibrahim','ibroh','highbee@gmail.com','','admin',''),(9,'Wakeel','Hammed','wakee','123456','lastborn@gmail.com','','subscriber',''),(10,'Kolawole','Abdullah','abdul','password','k.ab@gmail.com','','Subscriber',''),(11,'Qultum','gbemi','gbemi','password','k.ab@gmail.com','','Subscriber',''),(12,'Wole','Tella','wole','password','wole@gmail.com','','Subscriber',''),(14,'Abdullah','Sulayman','danjuma','password','danjuma@g.com','','Admin','');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usertracker`
--

DROP TABLE IF EXISTS `usertracker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usertracker` (
  `trackid` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(36) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`trackid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usertracker`
--

LOCK TABLES `usertracker` WRITE;
/*!40000 ALTER TABLE `usertracker` DISABLE KEYS */;
/*!40000 ALTER TABLE `usertracker` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-22  8:23:20
