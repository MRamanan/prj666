-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: database_1
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `contactinformation`
--

DROP TABLE IF EXISTS `contactinformation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactinformation` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` enum('Mr','Ms','Mrs','Dr') DEFAULT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Email` varchar(160) NOT NULL,
  `Street` varchar(255) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `PostalCode` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactinformation`
--

LOCK TABLES `contactinformation` WRITE;
/*!40000 ALTER TABLE `contactinformation` DISABLE KEYS */;
INSERT INTO `contactinformation` VALUES (1,'Mr','ramanan','manokaran','','','','',''),(2,'Mr','devon','User','','','','',''),(3,'Mr','ahilan','Vigneswaran','','','','',''),(4,'Mr','kevin','l','','','','',''),(5,'Mr','ramanan','manokaran','','','','',''),(6,'Mr','ramanan','manokaran','','','','',''),(7,'Mr','ramanan','manokaran','','','','',''),(8,'Mr','ramsta123','user2','','','','','');
/*!40000 ALTER TABLE `contactinformation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credential`
--

DROP TABLE IF EXISTS `credential`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credential` (
  `Id` int(11) NOT NULL,
  `Username` varchar(160) NOT NULL,
  `UserPassword` blob NOT NULL,
  `TypeofUser` varchar(1) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credential`
--

LOCK TABLES `credential` WRITE;
/*!40000 ALTER TABLE `credential` DISABLE KEYS */;
INSERT INTO `credential` VALUES (1,'ramanan@gmail.com','ramsta123','D'),(2,'devon@gmail.com','ramsta123','U'),(3,'ahilan@gmail.com','ramsta123','U'),(4,'kevin@gmail.com','ramsta123','D'),(5,'ramanan2@gmail.com','ramsta123','U'),(6,'ramanan','manokaran','U'),(7,'ramanan_d@gmail.com','ramsta123','D'),(8,'user2@gmail.com','ramsta123','U');
/*!40000 ALTER TABLE `credential` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dailyintake`
--

DROP TABLE IF EXISTS `dailyintake`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dailyintake` (
  `ID` int(11) NOT NULL,
  `DATE` varchar(255) DEFAULT NULL,
  `MEAL_TIME` varchar(255) DEFAULT NULL,
  `FOOD_NAME` varchar(255) DEFAULT NULL,
  `FOOD_BRAND` varchar(255) DEFAULT NULL,
  `FAT` int(11) DEFAULT NULL,
  `CALORIES` int(11) DEFAULT NULL,
  `SODIUM` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dailyintake`
--

LOCK TABLES `dailyintake` WRITE;
/*!40000 ALTER TABLE `dailyintake` DISABLE KEYS */;
INSERT INTO `dailyintake` VALUES (2,'2017-03-01','Dinner','Pretzel Bagel','Tim Horton\'s',3,300,850),(2,'2017-03-01','Lunch','Light Plain Cream Cheese Spread','Tim Horton\'s',6,90,200),(2,'2017-03-01','Dinner','Big Mac','McDonald\'s',28,540,970),(2,'2017-03-01','Lunch','Big Breakfast, Regular Size Biscuit','McDonald\'s',48,740,1560),(2,'2017-03-01','Dinner','Big Mac','McDonald\'s',28,540,970),(2,'2017-03-01','Lunch','Big Breakfast, Regular Size Biscuit','McDonald\'s',48,740,1560),(2,'2017-03-02','Dinner','Pepperoni Pizza, Medium','Pizza Pizza',7,210,520);
/*!40000 ALTER TABLE `dailyintake` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dietician`
--

DROP TABLE IF EXISTS `dietician`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dietician` (
  `DieticianId` int(11) NOT NULL AUTO_INCREMENT,
  `ContactStartTimeMonday` time DEFAULT NULL,
  `ContactEndTimeMonday` time DEFAULT NULL,
  `ContactStartTimeTuesday` time DEFAULT NULL,
  `ContactEndTimeTuesday` time DEFAULT NULL,
  `ContactStartTimeWednesday` time DEFAULT NULL,
  `ContactEndTimeWednesday` time DEFAULT NULL,
  `ContactStartTimeThursday` time DEFAULT NULL,
  `ContactEndTimeThursday` time DEFAULT NULL,
  `ContactStartTimeFriday` time DEFAULT NULL,
  `ContactEndTimeFriday` time DEFAULT NULL,
  `ContactStartTimeSaturday` time DEFAULT NULL,
  `ContactEndTimeSaturday` time DEFAULT NULL,
  `ContactStartTimeSunday` time DEFAULT NULL,
  `ContactEndTimeSunday` time DEFAULT NULL,
  PRIMARY KEY (`DieticianId`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dietician`
--

LOCK TABLES `dietician` WRITE;
/*!40000 ALTER TABLE `dietician` DISABLE KEYS */;
INSERT INTO `dietician` VALUES (1,'00:00:00','00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'00:00:00','00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'00:00:00','00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `dietician` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dieticianuser`
--

DROP TABLE IF EXISTS `dieticianuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dieticianuser` (
  `DieticianUserId` int(11) NOT NULL AUTO_INCREMENT,
  `DieticianId` int(11) DEFAULT NULL,
  `ClientId` int(11) DEFAULT NULL,
  PRIMARY KEY (`DieticianUserId`),
  KEY `fk_DieticianUser_Dietician` (`DieticianId`),
  KEY `fk_DieticianUser_User` (`ClientId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dieticianuser`
--

LOCK TABLES `dieticianuser` WRITE;
/*!40000 ALTER TABLE `dieticianuser` DISABLE KEYS */;
INSERT INTO `dieticianuser` VALUES (1,1,2),(2,1,2),(3,1,2);
/*!40000 ALTER TABLE `dieticianuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user2`
--

DROP TABLE IF EXISTS `user2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user2` (
  `Id` int(11) NOT NULL,
  `Height` int(11) DEFAULT '0',
  `Weight` int(11) DEFAULT '0',
  `Age` int(11) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user2`
--

LOCK TABLES `user2` WRITE;
/*!40000 ALTER TABLE `user2` DISABLE KEYS */;
INSERT INTO `user2` VALUES (2,0,0,0),(3,0,0,0),(6,0,0,0),(8,0,0,0);
/*!40000 ALTER TABLE `user2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (16,'ram12','ram12','12','12'),(17,'ram12','ram12','12','12'),(18,'1231','123','123','123'),(19,'','','',''),(20,'','','',''),(21,'','','zas',''),(22,'1231123','123','12','123'),(23,'user@gmail.com','pass','user','last_n');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-02 15:51:54
