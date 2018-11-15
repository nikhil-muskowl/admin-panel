-- MySQL dump 10.16  Distrib 10.1.35-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: social_app
-- ------------------------------------------------------
-- Server version	10.1.35-MariaDB

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
-- Current Database: `social_app`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `social_app` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `social_app`;

--
-- Table structure for table `followers`
--

DROP TABLE IF EXISTS `followers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `followers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `current_user_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`user_id`,`current_user_id`),
  KEY `user_id` (`user_id`),
  KEY `follow_user_id` (`current_user_id`),
  CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`current_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `followers`
--

LOCK TABLES `followers` WRITE;
/*!40000 ALTER TABLE `followers` DISABLE KEYS */;
/*!40000 ALTER TABLE `followers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `followers_view`
--

DROP TABLE IF EXISTS `followers_view`;
/*!50001 DROP VIEW IF EXISTS `followers_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `followers_view` (
  `id` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `current_user_id` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `created_date` tinyint NOT NULL,
  `modified_date` tinyint NOT NULL,
  `user_name` tinyint NOT NULL,
  `user_image` tinyint NOT NULL,
  `current_user_name` tinyint NOT NULL,
  `current_user_image` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `gender_details`
--

DROP TABLE IF EXISTS `gender_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gender_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `gender_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `genders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `gender_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gender_details`
--

LOCK TABLES `gender_details` WRITE;
/*!40000 ALTER TABLE `gender_details` DISABLE KEYS */;
INSERT INTO `gender_details` VALUES (1,1,'male','',''),(1,2,'male','',''),(2,1,'female','',''),(2,2,'महिला','','');
/*!40000 ALTER TABLE `gender_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genders`
--

DROP TABLE IF EXISTS `genders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genders`
--

LOCK TABLES `genders` WRITE;
/*!40000 ALTER TABLE `genders` DISABLE KEYS */;
INSERT INTO `genders` VALUES (1,1,0,0,'2018-08-08 11:04:08','2018-08-08 11:04:08'),(2,1,0,0,'2018-08-08 11:04:21','2018-08-08 11:04:21');
/*!40000 ALTER TABLE `genders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `genders_view`
--

DROP TABLE IF EXISTS `genders_view`;
/*!50001 DROP VIEW IF EXISTS `genders_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `genders_view` (
  `id` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `modified_by` tinyint NOT NULL,
  `created_date` tinyint NOT NULL,
  `modified_date` tinyint NOT NULL,
  `language_id` tinyint NOT NULL,
  `title` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `html` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `holiday_details`
--

DROP TABLE IF EXISTS `holiday_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `holiday_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `holiday_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `holidays` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `holiday_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `holiday_details`
--

LOCK TABLES `holiday_details` WRITE;
/*!40000 ALTER TABLE `holiday_details` DISABLE KEYS */;
INSERT INTO `holiday_details` VALUES (1,1,'2 october','',''),(1,2,'2 october','',''),(2,1,'New year leave','',''),(2,2,'New year leave','','');
/*!40000 ALTER TABLE `holiday_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `holidays`
--

DROP TABLE IF EXISTS `holidays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `holidays`
--

LOCK TABLES `holidays` WRITE;
/*!40000 ALTER TABLE `holidays` DISABLE KEYS */;
INSERT INTO `holidays` VALUES (1,1,'2018-10-02',0,0,'2018-10-12 14:27:04','2018-10-22 14:43:54'),(2,1,'2018-12-31',0,0,'2018-11-12 15:06:48','2018-11-12 15:06:48');
/*!40000 ALTER TABLE `holidays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `holidays_view`
--

DROP TABLE IF EXISTS `holidays_view`;
/*!50001 DROP VIEW IF EXISTS `holidays_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `holidays_view` (
  `id` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `date` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `modified_by` tinyint NOT NULL,
  `created_date` tinyint NOT NULL,
  `modified_date` tinyint NOT NULL,
  `language_id` tinyint NOT NULL,
  `title` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'english','English',0,1,0,0,'2018-08-02 10:53:13','2018-08-09 10:26:13'),(2,'hindi',' हिंदी',0,1,0,0,'2018-08-02 11:05:07','2018-08-09 10:26:06');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_applications`
--

DROP TABLE IF EXISTS `leave_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `leave_reason_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `file_attach` text NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `leave_status` enum('P','A','C') NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `leave_reason_id` (`leave_reason_id`),
  KEY `leave_type_id` (`leave_type_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `leave_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_ibfk_2` FOREIGN KEY (`leave_reason_id`) REFERENCES `leave_reasons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_ibfk_3` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_ibfk_4` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_applications`
--

LOCK TABLES `leave_applications` WRITE;
/*!40000 ALTER TABLE `leave_applications` DISABLE KEYS */;
INSERT INTO `leave_applications` VALUES (1,2,2,4,1,'2018-11-13 00:00:00','2018-11-15 00:00:00',2.00,'','dahsodh','jjfsdf','P',1,0,0,'2018-11-13 10:29:44','2018-11-15 10:56:22'),(2,2,1,2,1,'2018-11-15 00:00:00','2018-11-16 00:00:00',1.00,'','cc','sdffsd','P',1,0,0,'2018-11-15 11:20:01','2018-11-15 13:05:34'),(3,3,2,3,1,'2018-11-15 09:30:00','2018-11-15 12:00:00',2.30,'','fsd','fsdf','P',1,0,0,'2018-11-15 12:41:10','2018-11-15 13:04:47');
/*!40000 ALTER TABLE `leave_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `leave_applications_view`
--

DROP TABLE IF EXISTS `leave_applications_view`;
/*!50001 DROP VIEW IF EXISTS `leave_applications_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `leave_applications_view` (
  `id` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `leave_reason_id` tinyint NOT NULL,
  `leave_type_id` tinyint NOT NULL,
  `language_id` tinyint NOT NULL,
  `from_date` tinyint NOT NULL,
  `to_date` tinyint NOT NULL,
  `total` tinyint NOT NULL,
  `file_attach` tinyint NOT NULL,
  `subject` tinyint NOT NULL,
  `text` tinyint NOT NULL,
  `leave_status` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `modified_by` tinyint NOT NULL,
  `created_date` tinyint NOT NULL,
  `modified_date` tinyint NOT NULL,
  `user_name` tinyint NOT NULL,
  `leave_reason` tinyint NOT NULL,
  `leave_type` tinyint NOT NULL,
  `type` tinyint NOT NULL,
  `value` tinyint NOT NULL,
  `file` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `leave_reason_details`
--

DROP TABLE IF EXISTS `leave_reason_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_reason_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `leave_reason_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `leave_reasons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_reason_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_reason_details`
--

LOCK TABLES `leave_reason_details` WRITE;
/*!40000 ALTER TABLE `leave_reason_details` DISABLE KEYS */;
INSERT INTO `leave_reason_details` VALUES (1,1,'medical emergency','',''),(1,2,'आपात चिकित्सा','',''),(2,1,'casual','',''),(2,2,'आकस्मिक','','');
/*!40000 ALTER TABLE `leave_reason_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_reasons`
--

DROP TABLE IF EXISTS `leave_reasons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_reasons`
--

LOCK TABLES `leave_reasons` WRITE;
/*!40000 ALTER TABLE `leave_reasons` DISABLE KEYS */;
INSERT INTO `leave_reasons` VALUES (1,1,0,0,'2018-10-22 10:56:23','2018-10-22 10:56:23'),(2,1,0,0,'2018-10-22 10:57:50','2018-10-22 10:57:50');
/*!40000 ALTER TABLE `leave_reasons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `leave_reasons_view`
--

DROP TABLE IF EXISTS `leave_reasons_view`;
/*!50001 DROP VIEW IF EXISTS `leave_reasons_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `leave_reasons_view` (
  `id` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `modified_by` tinyint NOT NULL,
  `created_date` tinyint NOT NULL,
  `modified_date` tinyint NOT NULL,
  `language_id` tinyint NOT NULL,
  `title` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `leave_type_details`
--

DROP TABLE IF EXISTS `leave_type_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_type_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `leave_type_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_type_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_type_details`
--

LOCK TABLES `leave_type_details` WRITE;
/*!40000 ALTER TABLE `leave_type_details` DISABLE KEYS */;
INSERT INTO `leave_type_details` VALUES (1,1,'half day','',''),(1,2,'half day','',''),(2,1,'emergency & medical','',''),(2,2,'emergency & medical','',''),(3,1,'gate pass','',''),(3,2,'gate pass','',''),(4,1,'casual','',''),(4,2,'आकस्मिक','','');
/*!40000 ALTER TABLE `leave_type_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_types`
--

DROP TABLE IF EXISTS `leave_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('full','half','hour') NOT NULL,
  `value` int(11) NOT NULL,
  `file` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_types`
--

LOCK TABLES `leave_types` WRITE;
/*!40000 ALTER TABLE `leave_types` DISABLE KEYS */;
INSERT INTO `leave_types` VALUES (1,'half',1,0,1,0,0,'2018-10-22 10:44:42','2018-11-12 17:49:43'),(2,'full',1,1,1,0,0,'2018-10-22 10:45:56','2018-11-13 10:59:52'),(3,'hour',2,0,1,0,0,'2018-10-22 10:46:22','2018-11-12 17:50:16'),(4,'full',1,0,1,0,0,'2018-10-22 17:09:19','2018-11-12 17:49:34');
/*!40000 ALTER TABLE `leave_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `leave_types_view`
--

DROP TABLE IF EXISTS `leave_types_view`;
/*!50001 DROP VIEW IF EXISTS `leave_types_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `leave_types_view` (
  `id` tinyint NOT NULL,
  `type` tinyint NOT NULL,
  `value` tinyint NOT NULL,
  `file` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `modified_by` tinyint NOT NULL,
  `created_date` tinyint NOT NULL,
  `modified_date` tinyint NOT NULL,
  `language_id` tinyint NOT NULL,
  `title` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `module_permissions`
--

DROP TABLE IF EXISTS `module_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module_permissions` (
  `user_group_id` int(11) NOT NULL,
  `module` varchar(200) NOT NULL,
  `is_add` tinyint(1) NOT NULL,
  `is_view` tinyint(1) NOT NULL,
  `is_update` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_group_id`,`module`),
  CONSTRAINT `module_permissions_ibfk_1` FOREIGN KEY (`user_group_id`) REFERENCES `user_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module_permissions`
--

LOCK TABLES `module_permissions` WRITE;
/*!40000 ALTER TABLE `module_permissions` DISABLE KEYS */;
INSERT INTO `module_permissions` VALUES (1,'Advertisements',1,1,1,1),(1,'Advertisement_types',1,1,1,1),(1,'Attributes',1,1,1,1),(1,'Attribute_groups',1,1,1,1),(1,'Blogs',1,1,1,1),(1,'Blog_types',1,1,1,1),(1,'Categories',1,1,1,1),(1,'Genders',1,1,1,1),(1,'Holidays',1,1,1,1),(1,'Inquiries',1,1,1,1),(1,'Inquiry_types',1,1,1,1),(1,'Languages',1,1,1,1),(1,'Leave_applications',1,1,1,1),(1,'Leave_reasons',1,1,1,1),(1,'Leave_types',1,1,1,1),(1,'Newsletters',1,1,1,1),(1,'Newsletter_mails',1,1,1,1),(1,'Newsletter_mail_trackers',1,1,1,1),(1,'Notifications',1,1,1,1),(1,'Pets',1,1,1,1),(1,'Pet_levels',1,1,1,1),(1,'Pet_settings',1,1,1,1),(1,'Plugins',1,1,1,1),(1,'Products',1,1,1,1),(1,'Product_ratings',1,1,1,1),(1,'Product_reviews',1,1,1,1),(1,'Product_wishlists',1,1,1,1),(1,'Settings',1,1,1,1),(1,'Stories',1,1,1,1),(1,'Story_comments',1,1,1,1),(1,'Story_commnets',1,1,1,1),(1,'Story_complains',1,1,1,1),(1,'Story_types',1,1,1,1),(1,'Testimonials',1,1,1,1),(1,'Users',1,1,1,1),(1,'User_activities',1,1,1,1),(1,'User_complains',1,1,1,1),(1,'User_groups',1,1,1,1),(1,'User_leaves',1,1,1,1),(1,'User_leave_authorities',1,1,1,1),(1,'User_pets',1,1,1,1),(1,'User_pet_points',1,1,1,1);
/*!40000 ALTER TABLE `module_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification_details`
--

DROP TABLE IF EXISTS `notification_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`,`language_id`),
  KEY `notification_details_ibfk_2` (`language_id`),
  CONSTRAINT `notification_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notification_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification_details`
--

LOCK TABLES `notification_details` WRITE;
/*!40000 ALTER TABLE `notification_details` DISABLE KEYS */;
INSERT INTO `notification_details` VALUES (1,1,'e','e'),(1,2,'h','h');
/*!40000 ALTER TABLE `notification_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification_to_users`
--

DROP TABLE IF EXISTS `notification_to_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification_to_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_view` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`,`notification_id`,`user_id`),
  KEY `notification_id` (`notification_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `notification_to_users_ibfk_1` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notification_to_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification_to_users`
--

LOCK TABLES `notification_to_users` WRITE;
/*!40000 ALTER TABLE `notification_to_users` DISABLE KEYS */;
INSERT INTO `notification_to_users` VALUES (7,1,26,0),(8,1,27,0);
/*!40000 ALTER TABLE `notification_to_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `type_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'upload/images/0c90f50a999505679ff15dc9926da398.jpg','',0,1,0,0,0,'2018-09-22 12:50:47','2018-09-22 14:09:41');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `notifications_view`
--

DROP TABLE IF EXISTS `notifications_view`;
/*!50001 DROP VIEW IF EXISTS `notifications_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `notifications_view` (
  `id` tinyint NOT NULL,
  `image` tinyint NOT NULL,
  `type` tinyint NOT NULL,
  `type_id` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `sort_order` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `modified_by` tinyint NOT NULL,
  `created_date` tinyint NOT NULL,
  `modified_date` tinyint NOT NULL,
  `language_id` tinyint NOT NULL,
  `title` tinyint NOT NULL,
  `description` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `plugins`
--

DROP TABLE IF EXISTS `plugins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plugins`
--

LOCK TABLES `plugins` WRITE;
/*!40000 ALTER TABLE `plugins` DISABLE KEYS */;
INSERT INTO `plugins` VALUES (57,'Leave Managment Module','leave_managment_module',1,0,0,'2018-11-12 10:47:43','2018-11-12 10:47:43'),(58,'Notifications Module','notifications_module',1,0,0,'2018-11-12 16:41:53','2018-11-12 16:41:53');
/*!40000 ALTER TABLE `plugins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `code_key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`code`,`code_key`)
) ENGINE=InnoDB AUTO_INCREMENT=583 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (536,'pet_module','register_points','500'),(537,'pet_module','story_upload_points','100'),(538,'pet_module','story_comment_points','50'),(539,'pet_module','story_like_points','50'),(540,'pet_module','story_dislike_points','20'),(562,'config','name','Musk'),(563,'config','contact','7737033665'),(564,'config','email','nadim@muskowl.com'),(565,'config','address','Pacific'),(566,'config','mail_protocol','mail'),(567,'config','smtp_hostname','localhost'),(568,'config','smtp_username','nadim@muskowl.com'),(569,'config','smtp_password','NS@123456'),(570,'config','smtp_port','25'),(571,'config','smtp_timeout','5'),(572,'config','date_format','D m Y'),(573,'config','datetime_format','d-m-Y H:i A'),(574,'config','decimal_format','2'),(575,'config','list_image_width','100'),(576,'config','list_image_height','100'),(577,'config','list_banner_width','100'),(578,'config','list_banner_height','100'),(579,'config','detail_image_width','800'),(580,'config','detail_image_height','500'),(581,'config','detail_banner_width','1500'),(582,'config','detail_banner_height','500');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `url_alias`
--

DROP TABLE IF EXISTS `url_alias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `url_alias` (
  `language_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `keyword` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`language_id`,`type_id`,`type`,`keyword`) USING BTREE,
  CONSTRAINT `url_alias_ibfk_1` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `url_alias`
--

LOCK TABLES `url_alias` WRITE;
/*!40000 ALTER TABLE `url_alias` DISABLE KEYS */;
INSERT INTO `url_alias` VALUES (1,1,'advertisements','','','',''),(1,1,'products','eee','','',''),(1,3,'blogs','','','',''),(1,4,'blogs','e1','','',''),(1,4,'categories','cate','cate','cate','cate'),(2,1,'advertisements','','','',''),(2,1,'products','hhh','','',''),(2,3,'blogs','','','',''),(2,4,'blogs','h1','','',''),(2,4,'categories','cate','cate','cate','cate');
/*!40000 ALTER TABLE `url_alias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_complains`
--

DROP TABLE IF EXISTS `user_complains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_complains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `complain_by` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `language_id` (`language_id`),
  KEY `user_id` (`user_id`),
  KEY `complain_by` (`complain_by`),
  CONSTRAINT `user_complains_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_complains_ibfk_2` FOREIGN KEY (`complain_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_complains_ibfk_3` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_complains`
--

LOCK TABLES `user_complains` WRITE;
/*!40000 ALTER TABLE `user_complains` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_complains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `user_complains_view`
--

DROP TABLE IF EXISTS `user_complains_view`;
/*!50001 DROP VIEW IF EXISTS `user_complains_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `user_complains_view` (
  `id` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `complain_by` tinyint NOT NULL,
  `language_id` tinyint NOT NULL,
  `title` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `modified_by` tinyint NOT NULL,
  `created_date` tinyint NOT NULL,
  `modified_date` tinyint NOT NULL,
  `user_name` tinyint NOT NULL,
  `complain_by_name` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `user_group_details`
--

DROP TABLE IF EXISTS `user_group_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `user_group_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_group_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group_details`
--

LOCK TABLES `user_group_details` WRITE;
/*!40000 ALTER TABLE `user_group_details` DISABLE KEYS */;
INSERT INTO `user_group_details` VALUES (1,1,'admin'),(1,2,'admin');
/*!40000 ALTER TABLE `user_group_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `banner` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_groups`
--

LOCK TABLES `user_groups` WRITE;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
INSERT INTO `user_groups` VALUES (1,'','',1,0,0,'2018-07-07 17:18:32','2018-07-07 17:18:32');
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `user_groups_view`
--

DROP TABLE IF EXISTS `user_groups_view`;
/*!50001 DROP VIEW IF EXISTS `user_groups_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `user_groups_view` (
  `id` tinyint NOT NULL,
  `image` tinyint NOT NULL,
  `banner` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `modified_by` tinyint NOT NULL,
  `created_date` tinyint NOT NULL,
  `modified_date` tinyint NOT NULL,
  `language_id` tinyint NOT NULL,
  `title` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `user_leave_authorities`
--

DROP TABLE IF EXISTS `user_leave_authorities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_leave_authorities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `priority` int(2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`author_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `user_leave_authorities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_leave_authorities_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_leave_authorities`
--

LOCK TABLES `user_leave_authorities` WRITE;
/*!40000 ALTER TABLE `user_leave_authorities` DISABLE KEYS */;
INSERT INTO `user_leave_authorities` VALUES (1,2,1,1,1,'2018-11-13 10:40:40','2018-11-13 11:52:19');
/*!40000 ALTER TABLE `user_leave_authorities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `user_leave_authorities_view`
--

DROP TABLE IF EXISTS `user_leave_authorities_view`;
/*!50001 DROP VIEW IF EXISTS `user_leave_authorities_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `user_leave_authorities_view` (
  `id` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `author_id` tinyint NOT NULL,
  `priority` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `created_date` tinyint NOT NULL,
  `modified_date` tinyint NOT NULL,
  `user_name` tinyint NOT NULL,
  `user_email` tinyint NOT NULL,
  `author_name` tinyint NOT NULL,
  `author_email` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `user_leaves`
--

DROP TABLE IF EXISTS `user_leaves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_leaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `leave_type_id` (`leave_type_id`),
  CONSTRAINT `user_leaves_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_leaves_ibfk_2` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_leaves`
--

LOCK TABLES `user_leaves` WRITE;
/*!40000 ALTER TABLE `user_leaves` DISABLE KEYS */;
INSERT INTO `user_leaves` VALUES (1,1,1,1.00,1,0,0,'2018-11-14 17:25:43','2018-11-14 17:25:43'),(2,1,2,1.00,1,0,0,'2018-11-14 17:25:43','2018-11-14 17:25:43'),(3,1,3,2.00,1,0,0,'2018-11-14 17:25:43','2018-11-14 17:25:43'),(4,1,4,1.00,1,0,0,'2018-11-14 17:25:43','2018-11-14 17:25:43'),(5,2,1,1.00,1,0,0,'2018-11-14 17:25:43','2018-11-14 17:25:43'),(6,2,2,1.00,1,0,0,'2018-11-14 17:25:43','2018-11-14 17:25:43'),(7,2,3,2.00,1,0,0,'2018-11-14 17:25:43','2018-11-14 17:25:43'),(8,2,4,1.00,1,0,0,'2018-11-14 17:25:43','2018-11-14 17:25:43'),(9,3,1,1.00,1,0,0,'2018-11-14 17:25:43','2018-11-14 17:25:43'),(10,3,2,1.00,1,0,0,'2018-11-14 17:25:43','2018-11-14 17:25:43'),(11,3,3,2.00,1,0,0,'2018-11-14 17:25:43','2018-11-14 17:25:43'),(12,3,4,1.00,1,0,0,'2018-11-14 17:25:43','2018-11-14 17:25:43');
/*!40000 ALTER TABLE `user_leaves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `user_leaves_view`
--

DROP TABLE IF EXISTS `user_leaves_view`;
/*!50001 DROP VIEW IF EXISTS `user_leaves_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `user_leaves_view` (
  `id` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `leave_type_id` tinyint NOT NULL,
  `total` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `modified_by` tinyint NOT NULL,
  `created_date` tinyint NOT NULL,
  `modified_date` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `email` tinyint NOT NULL,
  `contact` tinyint NOT NULL,
  `dob` tinyint NOT NULL,
  `language_id` tinyint NOT NULL,
  `leave_type` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `user_notifications_view`
--

DROP TABLE IF EXISTS `user_notifications_view`;
/*!50001 DROP VIEW IF EXISTS `user_notifications_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `user_notifications_view` (
  `id` tinyint NOT NULL,
  `image` tinyint NOT NULL,
  `type` tinyint NOT NULL,
  `type_id` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `sort_order` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `modified_by` tinyint NOT NULL,
  `created_date` tinyint NOT NULL,
  `modified_date` tinyint NOT NULL,
  `language_id` tinyint NOT NULL,
  `title` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `user_notification_id` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `is_view` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `otp` int(11) NOT NULL,
  `password` varchar(200) NOT NULL,
  `image` text NOT NULL,
  `banner` text NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `latitude` decimal(6,6) NOT NULL,
  `longitude` decimal(6,6) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'admin','admin','1234567890',2,'0000-00-00',0,'admin','','',1,0,1,0.000000,0.000000,0,0,'2018-08-24 18:04:47','2018-11-15 16:11:16'),(2,1,'nadim','nadim.sheikh.07@gmail.com','7737033665',1,'0000-00-00',0,'123456','','',0,0,1,0.000000,0.000000,0,0,'2018-11-12 16:39:55','2018-11-12 16:40:35'),(3,1,'rajesh','rajesh.muskowl@gmail.com','123456',1,'0000-00-00',0,'','','',0,0,1,0.000000,0.000000,0,0,'2018-11-14 17:23:17','2018-11-14 17:23:17');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'social_app'
--

--
-- Current Database: `social_app`
--

USE `social_app`;

--
-- Final view structure for view `followers_view`
--

/*!50001 DROP TABLE IF EXISTS `followers_view`*/;
/*!50001 DROP VIEW IF EXISTS `followers_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `followers_view` AS select `fr`.`id` AS `id`,`fr`.`user_id` AS `user_id`,`fr`.`current_user_id` AS `current_user_id`,`fr`.`status` AS `status`,`fr`.`created_date` AS `created_date`,`fr`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name`,`u`.`image` AS `user_image`,`f`.`name` AS `current_user_name`,`f`.`image` AS `current_user_image` from ((`followers` `fr` left join `users` `u` on((`u`.`id` = `fr`.`user_id`))) left join `users` `f` on((`f`.`id` = `fr`.`current_user_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `genders_view`
--

/*!50001 DROP TABLE IF EXISTS `genders_view`*/;
/*!50001 DROP VIEW IF EXISTS `genders_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `genders_view` AS select `t`.`id` AS `id`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title`,`td`.`description` AS `description`,`td`.`html` AS `html` from (`genders` `t` left join `gender_details` `td` on((`td`.`id` = `t`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `holidays_view`
--

/*!50001 DROP TABLE IF EXISTS `holidays_view`*/;
/*!50001 DROP VIEW IF EXISTS `holidays_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `holidays_view` AS select `t`.`id` AS `id`,`t`.`status` AS `status`,`t`.`date` AS `date`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title` from (`holidays` `t` left join `holiday_details` `td` on((`td`.`id` = `t`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `leave_applications_view`
--

/*!50001 DROP TABLE IF EXISTS `leave_applications_view`*/;
/*!50001 DROP VIEW IF EXISTS `leave_applications_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `leave_applications_view` AS select `la`.`id` AS `id`,`la`.`user_id` AS `user_id`,`la`.`leave_reason_id` AS `leave_reason_id`,`la`.`leave_type_id` AS `leave_type_id`,`la`.`language_id` AS `language_id`,`la`.`from_date` AS `from_date`,`la`.`to_date` AS `to_date`,`la`.`total` AS `total`,`la`.`file_attach` AS `file_attach`,`la`.`subject` AS `subject`,`la`.`text` AS `text`,`la`.`leave_status` AS `leave_status`,`la`.`status` AS `status`,`la`.`created_by` AS `created_by`,`la`.`modified_by` AS `modified_by`,`la`.`created_date` AS `created_date`,`la`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name`,`lrd`.`title` AS `leave_reason`,`ltd`.`title` AS `leave_type`,`lt`.`type` AS `type`,`lt`.`value` AS `value`,`lt`.`file` AS `file` from ((((`leave_applications` `la` left join `users` `u` on((`u`.`id` = `la`.`user_id`))) left join `leave_reason_details` `lrd` on(((`lrd`.`language_id` = `la`.`language_id`) and (`lrd`.`id` = `la`.`leave_reason_id`)))) left join `leave_types` `lt` on((`lt`.`id` = `la`.`leave_type_id`))) left join `leave_type_details` `ltd` on(((`ltd`.`language_id` = `la`.`language_id`) and (`ltd`.`id` = `la`.`leave_type_id`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `leave_reasons_view`
--

/*!50001 DROP TABLE IF EXISTS `leave_reasons_view`*/;
/*!50001 DROP VIEW IF EXISTS `leave_reasons_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `leave_reasons_view` AS select `t`.`id` AS `id`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title` from (`leave_reasons` `t` left join `leave_reason_details` `td` on((`td`.`id` = `t`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `leave_types_view`
--

/*!50001 DROP TABLE IF EXISTS `leave_types_view`*/;
/*!50001 DROP VIEW IF EXISTS `leave_types_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `leave_types_view` AS select `t`.`id` AS `id`,`t`.`type` AS `type`,`t`.`value` AS `value`,`t`.`file` AS `file`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title` from (`leave_types` `t` left join `leave_type_details` `td` on((`td`.`id` = `t`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `notifications_view`
--

/*!50001 DROP TABLE IF EXISTS `notifications_view`*/;
/*!50001 DROP VIEW IF EXISTS `notifications_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `notifications_view` AS select `n`.`id` AS `id`,`n`.`image` AS `image`,`n`.`type` AS `type`,`n`.`type_id` AS `type_id`,`n`.`status` AS `status`,`n`.`sort_order` AS `sort_order`,`n`.`created_by` AS `created_by`,`n`.`modified_by` AS `modified_by`,`n`.`created_date` AS `created_date`,`n`.`modified_date` AS `modified_date`,`nd`.`language_id` AS `language_id`,`nd`.`title` AS `title`,`nd`.`description` AS `description` from (`notifications` `n` left join `notification_details` `nd` on((`nd`.`id` = `n`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `user_complains_view`
--

/*!50001 DROP TABLE IF EXISTS `user_complains_view`*/;
/*!50001 DROP VIEW IF EXISTS `user_complains_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `user_complains_view` AS select `uc`.`id` AS `id`,`uc`.`user_id` AS `user_id`,`uc`.`complain_by` AS `complain_by`,`uc`.`language_id` AS `language_id`,`uc`.`title` AS `title`,`uc`.`description` AS `description`,`uc`.`status` AS `status`,`uc`.`created_by` AS `created_by`,`uc`.`modified_by` AS `modified_by`,`uc`.`created_date` AS `created_date`,`uc`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name`,`cmb`.`name` AS `complain_by_name` from ((`user_complains` `uc` left join `users` `u` on((`u`.`id` = `uc`.`user_id`))) left join `users` `cmb` on((`cmb`.`id` = `uc`.`complain_by`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `user_groups_view`
--

/*!50001 DROP TABLE IF EXISTS `user_groups_view`*/;
/*!50001 DROP VIEW IF EXISTS `user_groups_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `user_groups_view` AS select `t`.`id` AS `id`,`t`.`image` AS `image`,`t`.`banner` AS `banner`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title` from (`user_groups` `t` left join `user_group_details` `td` on((`td`.`id` = `t`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `user_leave_authorities_view`
--

/*!50001 DROP TABLE IF EXISTS `user_leave_authorities_view`*/;
/*!50001 DROP VIEW IF EXISTS `user_leave_authorities_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `user_leave_authorities_view` AS select `ula`.`id` AS `id`,`ula`.`user_id` AS `user_id`,`ula`.`author_id` AS `author_id`,`ula`.`priority` AS `priority`,`ula`.`status` AS `status`,`ula`.`created_date` AS `created_date`,`ula`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name`,`u`.`email` AS `user_email`,`a`.`name` AS `author_name`,`a`.`email` AS `author_email` from ((`user_leave_authorities` `ula` left join `users` `u` on((`u`.`id` = `ula`.`user_id`))) left join `users` `a` on((`a`.`id` = `ula`.`author_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `user_leaves_view`
--

/*!50001 DROP TABLE IF EXISTS `user_leaves_view`*/;
/*!50001 DROP VIEW IF EXISTS `user_leaves_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `user_leaves_view` AS select `ul`.`id` AS `id`,`ul`.`user_id` AS `user_id`,`ul`.`leave_type_id` AS `leave_type_id`,`ul`.`total` AS `total`,`ul`.`status` AS `status`,`ul`.`created_by` AS `created_by`,`ul`.`modified_by` AS `modified_by`,`ul`.`created_date` AS `created_date`,`ul`.`modified_date` AS `modified_date`,`u`.`name` AS `name`,`u`.`email` AS `email`,`u`.`contact` AS `contact`,`u`.`dob` AS `dob`,`ltd`.`language_id` AS `language_id`,`ltd`.`title` AS `leave_type` from ((`user_leaves` `ul` left join `users` `u` on((`u`.`id` = `ul`.`user_id`))) left join `leave_type_details` `ltd` on((`ltd`.`id` = `ul`.`leave_type_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `user_notifications_view`
--

/*!50001 DROP TABLE IF EXISTS `user_notifications_view`*/;
/*!50001 DROP VIEW IF EXISTS `user_notifications_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `user_notifications_view` AS select `n`.`id` AS `id`,`n`.`image` AS `image`,`n`.`type` AS `type`,`n`.`type_id` AS `type_id`,`n`.`status` AS `status`,`n`.`sort_order` AS `sort_order`,`n`.`created_by` AS `created_by`,`n`.`modified_by` AS `modified_by`,`n`.`created_date` AS `created_date`,`n`.`modified_date` AS `modified_date`,`nd`.`language_id` AS `language_id`,`nd`.`title` AS `title`,`nd`.`description` AS `description`,`ntu`.`id` AS `user_notification_id`,`ntu`.`user_id` AS `user_id`,`ntu`.`is_view` AS `is_view` from ((`notifications` `n` left join `notification_details` `nd` on((`nd`.`id` = `n`.`id`))) left join `notification_to_users` `ntu` on((`ntu`.`notification_id` = `n`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-15 16:42:21
