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
-- Table structure for table `event_details`
--

DROP TABLE IF EXISTS `event_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `event_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_details`
--

LOCK TABLES `event_details` WRITE;
/*!40000 ALTER TABLE `event_details` DISABLE KEYS */;
INSERT INTO `event_details` VALUES (1,1,'test','',''),(1,2,'test','','');
/*!40000 ALTER TABLE `event_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `banner` text NOT NULL,
  `image` text NOT NULL,
  `location` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,2,'2018-11-22 01:00:00','2018-11-23 03:00:00','','upload/water.png','如家快捷酒店(酒泉西文化街昌兴电器市场店)','39.747251','98.514849',1,0,0,'2018-11-22 11:42:22','2018-11-24 15:45:39');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `events_view`
--

DROP TABLE IF EXISTS `events_view`;
/*!50001 DROP VIEW IF EXISTS `events_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `events_view` (
  `id` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `from_date` tinyint NOT NULL,
  `to_date` tinyint NOT NULL,
  `banner` tinyint NOT NULL,
  `image` tinyint NOT NULL,
  `location` tinyint NOT NULL,
  `latitude` tinyint NOT NULL,
  `longitude` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `modified_by` tinyint NOT NULL,
  `created_date` tinyint NOT NULL,
  `modified_date` tinyint NOT NULL,
  `language_id` tinyint NOT NULL,
  `title` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `user_name` tinyint NOT NULL,
  `user_image` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

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
  `image` text NOT NULL,
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
INSERT INTO `genders` VALUES (1,'',1,0,0,'2018-08-08 11:04:08','2018-08-08 11:04:08'),(2,'',1,0,0,'2018-08-08 11:04:21','2018-08-08 11:04:21');
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
INSERT INTO `module_permissions` VALUES (1,'Advertisements',1,1,1,1),(1,'Advertisement_types',1,1,1,1),(1,'Attributes',1,1,1,1),(1,'Attribute_groups',1,1,1,1),(1,'Blogs',1,1,1,1),(1,'Blog_types',1,1,1,1),(1,'Categories',1,1,1,1),(1,'Events',1,1,1,1),(1,'Genders',1,1,1,1),(1,'Holidays',1,1,1,1),(1,'Inquiries',1,1,1,1),(1,'Inquiry_types',1,1,1,1),(1,'Languages',1,1,1,1),(1,'Leave_applications',1,1,1,1),(1,'Leave_reasons',1,1,1,1),(1,'Leave_settings',1,1,1,1),(1,'Leave_statuses',1,1,1,1),(1,'Leave_types',1,1,1,1),(1,'Newsletters',1,1,1,1),(1,'Newsletter_mails',1,1,1,1),(1,'Newsletter_mail_trackers',1,1,1,1),(1,'Notifications',1,1,1,1),(1,'Penalties',1,1,1,1),(1,'Penalty_reasons',1,1,1,1),(1,'Pets',1,1,1,1),(1,'Pet_levels',1,1,1,1),(1,'Pet_settings',1,1,1,1),(1,'Plugins',1,1,1,1),(1,'Products',1,1,1,1),(1,'Product_ratings',1,1,1,1),(1,'Product_reviews',1,1,1,1),(1,'Product_wishlists',1,1,1,1),(1,'Settings',1,1,1,1),(1,'Stories',1,1,1,1),(1,'Story_comments',1,1,1,1),(1,'Story_commnets',1,1,1,1),(1,'Story_complains',1,1,1,1),(1,'Story_types',1,1,1,1),(1,'Testimonials',1,1,1,1),(1,'Todo_lists',1,1,1,1),(1,'Users',1,1,1,1),(1,'User_activities',1,1,1,1),(1,'User_complains',1,1,1,1),(1,'User_groups',1,1,1,1),(1,'User_leaves',1,1,1,1),(1,'User_leave_authorities',1,1,1,1),(1,'User_pets',1,1,1,1),(1,'User_pet_points',1,1,1,1),(2,'Holidays',0,1,0,0),(2,'Leave_applications',0,1,0,0),(2,'Leave_reasons',0,1,0,0),(2,'Leave_statuses',0,1,0,0),(2,'Leave_types',0,1,0,0),(2,'User_leaves',0,1,0,0),(2,'User_leave_authorities',0,1,0,0);
/*!40000 ALTER TABLE `module_permissions` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plugins`
--

LOCK TABLES `plugins` WRITE;
/*!40000 ALTER TABLE `plugins` DISABLE KEYS */;
INSERT INTO `plugins` VALUES (62,'Story Module','story_module',1,0,0,'2018-11-22 11:00:11','2018-11-22 11:00:11'),(63,'Event Module','event_module',1,0,0,'2018-11-22 11:42:52','2018-11-22 11:42:52');
/*!40000 ALTER TABLE `plugins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `save_stories`
--

DROP TABLE IF EXISTS `save_stories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `save_stories` (
  `story_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  UNIQUE KEY `story_id` (`story_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `save_stories_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `save_stories_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `save_stories`
--

LOCK TABLES `save_stories` WRITE;
/*!40000 ALTER TABLE `save_stories` DISABLE KEYS */;
INSERT INTO `save_stories` VALUES (1,2),(3,2),(12,3);
/*!40000 ALTER TABLE `save_stories` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=649 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (628,'config','name','Musk'),(629,'config','contact','7737033665'),(630,'config','email','nadim@muskowl.com'),(631,'config','address','Pacific'),(632,'config','mail_protocol','mail'),(633,'config','smtp_hostname','localhost'),(634,'config','smtp_username','nadim@muskowl.com'),(635,'config','smtp_password','NS@123456'),(636,'config','smtp_port','25'),(637,'config','smtp_timeout','5'),(638,'config','date_format','d-m-Y'),(639,'config','datetime_format','d-m-Y h:i A'),(640,'config','decimal_format','2'),(641,'config','list_image_width','100'),(642,'config','list_image_height','100'),(643,'config','list_banner_width','100'),(644,'config','list_banner_height','100'),(645,'config','detail_image_width','800'),(646,'config','detail_image_height','500'),(647,'config','detail_banner_width','1500'),(648,'config','detail_banner_height','500');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stories`
--

DROP TABLE IF EXISTS `stories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `banner` text NOT NULL,
  `receipt` text NOT NULL,
  `receipt_private` tinyint(1) NOT NULL,
  `location` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stories`
--

LOCK TABLES `stories` WRITE;
/*!40000 ALTER TABLE `stories` DISABLE KEYS */;
INSERT INTO `stories` VALUES (1,4,0,'upload/users/8336869.jpg','','upload/users/887446.jpg',0,'China',1,'39.922183','116.420428',0,0,'2018-10-30 03:17:25','2018-10-30 03:17:25'),(2,5,0,'upload/users/6511436.jpg','','',0,'China',1,'39.91146','116.408016',0,0,'2018-11-01 01:05:44','2018-11-01 01:05:44'),(3,3,0,'upload/users/5573148.jpg','','',0,'China',1,'39.925054','116.416724',0,0,'2018-11-01 02:58:56','2018-11-01 02:58:56'),(4,2,0,'upload/users/820647.jpg','','',0,'China',1,'39.920396','116.418212',0,0,'2018-11-01 21:19:49','2018-11-01 21:19:49'),(5,2,0,'upload/users/9492879.jpg','','',0,'China',1,'39.914291','116.425086',0,0,'2018-11-01 21:32:46','2018-11-01 21:32:46'),(6,3,0,'upload/users/3647997.jpg','','',0,'China',1,'39.920496','116.416435',0,0,'2018-11-01 23:02:53','2018-11-01 23:02:53'),(7,2,0,'upload/users/414962.jpg','','',0,'China',1,'39.919981','116.414977',0,0,'2018-11-02 03:30:47','2018-11-02 03:30:47'),(8,7,0,'upload/users/4829110.jpg','','',0,'China',1,'39.925429','116.417253',0,0,'2018-11-02 21:45:29','2018-11-02 21:45:29'),(9,2,0,'upload/users/8869539.jpg','','',0,'India',1,'24.601399','73.674223',0,0,'2018-11-03 04:16:47','2018-11-03 05:19:07'),(10,7,0,'upload/users/7802814.jpg','','',0,'China',1,'39.919981','116.414977',0,0,'2018-11-03 04:32:28','2018-11-03 04:32:28'),(11,3,0,'upload/users/579646.jpg','','',0,'India',1,'24.585445','73.712479',0,0,'2018-11-03 05:28:31','2018-11-03 05:28:31'),(12,2,0,'upload/users/7405255.jpg','','',0,'India',1,'24.599285','73.776292',0,0,'2018-11-03 05:28:42','2018-11-03 05:28:42'),(13,5,0,'upload/users/5571919.jpg','','',0,'Hong Kong',1,'22.278909','114.271741',0,0,'2018-11-03 09:50:50','2018-11-03 09:50:50'),(14,5,0,'upload/users/4251761.jpg','','',0,'Hong Kong',1,'22.308076','114.258341',0,0,'2018-11-05 06:37:41','2018-11-05 06:37:42'),(15,2,0,'upload/users/2297534.jpg','','',0,'Hong Kong',1,'22.308047','114.262560',0,0,'2018-11-05 06:40:58','2018-11-05 06:40:58'),(16,5,0,'upload/users/5986882.jpg','','',0,'Hong Kong',1,'22.304306','114.161475',0,0,'2018-11-07 04:56:03','2018-11-07 04:56:03'),(17,1,1,'upload/users/2902742.jpg','','',0,'Hong Kong',1,'22.295336','114.172184',0,0,'2018-11-07 05:25:17','2018-11-22 14:33:00');
/*!40000 ALTER TABLE `stories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `stories_view`
--

DROP TABLE IF EXISTS `stories_view`;
/*!50001 DROP VIEW IF EXISTS `stories_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `stories_view` (
  `id` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `event_id` tinyint NOT NULL,
  `image` tinyint NOT NULL,
  `banner` tinyint NOT NULL,
  `receipt` tinyint NOT NULL,
  `receipt_private` tinyint NOT NULL,
  `location` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `latitude` tinyint NOT NULL,
  `longitude` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `modified_by` tinyint NOT NULL,
  `created_date` tinyint NOT NULL,
  `modified_date` tinyint NOT NULL,
  `language_id` tinyint NOT NULL,
  `title` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `html` tinyint NOT NULL,
  `likes` tinyint NOT NULL,
  `dislikes` tinyint NOT NULL,
  `totalLikes` tinyint NOT NULL,
  `user_name` tinyint NOT NULL,
  `user_image` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `story_comments`
--

DROP TABLE IF EXISTS `story_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `story_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  KEY `user_id` (`user_id`),
  KEY `story_id` (`story_id`),
  CONSTRAINT `story_comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `story_comments_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `story_comments_ibfk_3` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `story_comments`
--

LOCK TABLES `story_comments` WRITE;
/*!40000 ALTER TABLE `story_comments` DISABLE KEYS */;
INSERT INTO `story_comments` VALUES (1,2,1,1,'nice','2018-10-30 05:30:00',1),(2,2,1,1,'story detail','2018-10-31 21:43:20',1),(3,2,1,1,'story detail','2018-10-31 21:44:55',1),(4,2,5,1,'nice','2018-11-01 23:29:10',1),(5,2,5,1,'keep it on','2018-11-01 23:32:47',1),(6,2,6,1,'very nice','2018-11-01 23:34:23',1),(7,7,3,1,'nice','2018-11-02 05:05:02',1),(8,7,3,1,'nice','2018-11-02 05:05:07',1),(9,7,3,1,'nice','2018-11-02 05:05:17',1),(10,7,3,1,'very good','2018-11-02 05:10:05',1),(11,2,1,1,'story detail','2018-11-02 21:30:22',1),(12,7,6,1,'good','2018-11-02 21:37:50',1),(13,2,7,1,'good pic','2018-11-02 21:51:04',1),(14,3,3,1,'cool','2018-11-03 03:02:48',1),(15,3,2,1,'Nice','2018-11-03 04:11:13',1),(16,3,6,1,'Nice','2018-11-03 04:11:25',1),(17,3,7,1,'Good','2018-11-03 04:11:34',1),(18,3,8,1,'Good','2018-11-03 04:11:49',1),(19,3,8,1,'Djdjd','2018-11-03 04:11:59',1),(20,3,4,1,'Very good','2018-11-03 04:12:13',1),(21,3,4,1,'Best','2018-11-03 04:12:17',1),(22,3,4,1,'Fatao','2018-11-03 04:12:23',1),(23,2,9,1,'enjoy','2018-11-03 04:17:40',1),(24,3,12,1,'Hi','2018-11-03 05:36:52',1),(25,3,12,1,',,,','2018-11-03 05:37:35',1),(26,3,12,1,',','2018-11-03 05:37:53',1),(27,5,10,1,'我','2018-11-04 19:48:23',1),(28,5,13,1,'屌','2018-11-04 19:49:25',1),(29,2,14,1,'nice','2018-11-06 02:15:58',1);
/*!40000 ALTER TABLE `story_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `story_comments_view`
--

DROP TABLE IF EXISTS `story_comments_view`;
/*!50001 DROP VIEW IF EXISTS `story_comments_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `story_comments_view` (
  `id` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `story_id` tinyint NOT NULL,
  `language_id` tinyint NOT NULL,
  `comment` tinyint NOT NULL,
  `date` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `user_name` tinyint NOT NULL,
  `user_image` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `story_complains`
--

DROP TABLE IF EXISTS `story_complains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `story_complains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `story_id` int(11) NOT NULL,
  `story_comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `story_id` (`story_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `story_complains_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `story_complains_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `story_complains`
--

LOCK TABLES `story_complains` WRITE;
/*!40000 ALTER TABLE `story_complains` DISABLE KEYS */;
INSERT INTO `story_complains` VALUES (1,5,0,3,1,'Abusive','Abusive',1,0,0,'2018-11-02 06:59:07','2018-11-02 06:59:07');
/*!40000 ALTER TABLE `story_complains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `story_complains_view`
--

DROP TABLE IF EXISTS `story_complains_view`;
/*!50001 DROP VIEW IF EXISTS `story_complains_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `story_complains_view` (
  `id` tinyint NOT NULL,
  `story_id` tinyint NOT NULL,
  `story_comment_id` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `language_id` tinyint NOT NULL,
  `title` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `modified_by` tinyint NOT NULL,
  `created_date` tinyint NOT NULL,
  `modified_date` tinyint NOT NULL,
  `user_name` tinyint NOT NULL,
  `story_title` tinyint NOT NULL,
  `comment` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `story_details`
--

DROP TABLE IF EXISTS `story_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `story_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `story_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `story_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `story_details`
--

LOCK TABLES `story_details` WRITE;
/*!40000 ALTER TABLE `story_details` DISABLE KEYS */;
INSERT INTO `story_details` VALUES (1,1,'北京华尔道夫酒店','',''),(2,1,'中国国家博物馆','',''),(3,1,'世纪大厦-A座','',''),(4,1,'F.A.T.O','',''),(5,1,'东单地铁站-D口','',''),(6,1,'awinpaw','',''),(7,1,'停车场-A入口','',''),(8,1,'世纪大厦-B座','',''),(9,1,'Fateh Sagar Lake, Udaipur, Rajasthan','',''),(10,1,'','',''),(11,1,'Udaipur, Rajasthan, India','',''),(12,1,'Pacific Institute of Technology, Udaipur, Rajasthan, India','',''),(13,1,'Hong Kong, 將軍澳工業邨','',''),(14,1,'Hong Kong, Tseung Kwan O, 將軍澳中心','',''),(15,1,'Hong Kong, Tseung Kwan O, 將軍澳廣場','',''),(16,1,'Hong Kong, West Kowloon, 九龍站','',''),(17,1,'Hong Kong, Tsim Sha Tsui, 半島酒店','','<br>'),(17,2,'Hong Kong, Tsim Sha Tsui, 半島酒店','','<br>');
/*!40000 ALTER TABLE `story_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `story_image_details`
--

DROP TABLE IF EXISTS `story_image_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `story_image_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `story_image_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `story_images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `story_image_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `story_image_details`
--

LOCK TABLES `story_image_details` WRITE;
/*!40000 ALTER TABLE `story_image_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `story_image_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `story_images`
--

DROP TABLE IF EXISTS `story_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `story_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `story_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `link` text NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `story_id` (`story_id`),
  CONSTRAINT `story_images_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `story_images`
--

LOCK TABLES `story_images` WRITE;
/*!40000 ALTER TABLE `story_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `story_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `story_rankings`
--

DROP TABLE IF EXISTS `story_rankings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `story_rankings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `story_id` (`story_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `story_rankings_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `story_rankings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `story_rankings`
--

LOCK TABLES `story_rankings` WRITE;
/*!40000 ALTER TABLE `story_rankings` DISABLE KEYS */;
INSERT INTO `story_rankings` VALUES (1,4,1,1,0),(2,3,1,1,0),(3,2,1,1,0),(4,5,2,1,0),(5,2,3,1,0),(6,3,2,1,0),(7,3,3,1,0),(8,3,5,1,0),(12,2,6,1,0),(13,3,6,1,0),(14,4,6,1,0),(15,2,4,1,0),(16,2,2,1,0),(17,7,7,1,0),(18,7,3,1,0),(20,3,7,1,0),(21,3,4,1,0),(22,7,1,1,0),(23,7,2,1,0),(24,2,8,1,0),(25,2,7,1,0),(26,3,8,1,0),(27,2,9,1,0),(28,7,9,1,0),(29,7,8,1,0),(30,3,9,1,0),(31,3,12,1,0),(32,2,11,1,0),(33,2,12,1,0),(34,5,4,0,0),(35,5,13,1,0),(36,5,10,1,0),(37,2,13,1,0),(38,2,15,1,0),(39,2,14,1,0),(40,5,14,1,0);
/*!40000 ALTER TABLE `story_rankings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `story_tags`
--

DROP TABLE IF EXISTS `story_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `story_tags` (
  `story_id` int(11) NOT NULL,
  `tag` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  KEY `story_id` (`story_id`),
  CONSTRAINT `story_tags_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `story_tags`
--

LOCK TABLES `story_tags` WRITE;
/*!40000 ALTER TABLE `story_tags` DISABLE KEYS */;
INSERT INTO `story_tags` VALUES (1,'#Ggf'),(1,'#Fff'),(2,'#Yo,'),(3,'#Party'),(4,'#abcd'),(4,'#test'),(5,'#working'),(5,'#backtowork'),(5,'#morning'),(6,'#Working'),(6,'#Testing'),(7,'#abcd'),(7,'#test1'),(8,'#rarau'),(8,'#coding'),(8,'#test'),(9,'#fun'),(9,'#cool'),(10,'#hdhdh'),(10,'#jjdr'),(11,'#Gshdj'),(11,'#djdjd'),(11,'#djdjd'),(12,'#cool'),(12,'#done'),(13,'#我,'),(14,'#狗,'),(15,'#Omg'),(15,'#,'),(16,'#Bar,'),(17,'#山,');
/*!40000 ALTER TABLE `story_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `story_to_types`
--

DROP TABLE IF EXISTS `story_to_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `story_to_types` (
  `story_id` int(11) NOT NULL,
  `story_type_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  KEY `blog_id` (`story_id`),
  KEY `blog_type_id` (`story_type_id`),
  CONSTRAINT `story_to_types_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `story_to_types_ibfk_2` FOREIGN KEY (`story_type_id`) REFERENCES `story_types` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `story_to_types`
--

LOCK TABLES `story_to_types` WRITE;
/*!40000 ALTER TABLE `story_to_types` DISABLE KEYS */;
INSERT INTO `story_to_types` VALUES (1,1,1),(1,6,1),(2,3,1),(3,2,1),(3,1,2),(4,3,6),(5,6,2),(5,5,3),(6,3,2),(6,2,2),(6,4,1),(7,3,3),(7,5,1),(8,3,4),(8,4,2),(9,3,5),(9,2,3),(9,5,2),(10,2,5),(10,5,4),(11,3,9),(12,3,7),(12,2,4),(13,4,3),(14,3,8),(15,3,10),(16,3,11),(17,3,13);
/*!40000 ALTER TABLE `story_to_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `story_type_details`
--

DROP TABLE IF EXISTS `story_type_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `story_type_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `story_type_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `story_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `story_type_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `story_type_details`
--

LOCK TABLES `story_type_details` WRITE;
/*!40000 ALTER TABLE `story_type_details` DISABLE KEYS */;
INSERT INTO `story_type_details` VALUES (1,1,'food'),(1,2,'餐饮'),(2,1,'art'),(2,2,'艺术'),(3,1,'adventure'),(3,2,'冒险'),(4,1,'recreation'),(4,2,'娱乐'),(5,1,'travels'),(5,2,'旅行'),(6,1,'restaurants'),(6,2,'餐馆');
/*!40000 ALTER TABLE `story_type_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `story_types`
--

DROP TABLE IF EXISTS `story_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `story_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `is_upload` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `story_types`
--

LOCK TABLES `story_types` WRITE;
/*!40000 ALTER TABLE `story_types` DISABLE KEYS */;
INSERT INTO `story_types` VALUES (1,'upload/story_types/food.png',1,1,0,0,'2018-08-03 10:15:53','2018-10-31 23:14:57'),(2,'upload/story_types/VectorSmartObject.png',0,1,0,0,'2018-08-11 14:15:15','2018-10-31 23:16:19'),(3,'upload/story_types/world.png',0,1,0,0,'2018-08-11 14:15:41','2018-10-31 23:15:42'),(4,'upload/story_types/VectorSmartObject.png',0,1,0,0,'2018-08-11 14:16:15','2018-10-31 23:16:09'),(5,'upload/story_types/world.png',0,1,0,0,'2018-09-10 15:32:25','2018-10-31 23:15:54'),(6,'upload/story_types/food.png',1,1,0,0,'2018-10-26 11:41:30','2018-10-31 23:15:12');
/*!40000 ALTER TABLE `story_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `story_types_view`
--

DROP TABLE IF EXISTS `story_types_view`;
/*!50001 DROP VIEW IF EXISTS `story_types_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `story_types_view` (
  `id` tinyint NOT NULL,
  `image` tinyint NOT NULL,
  `is_upload` tinyint NOT NULL,
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
INSERT INTO `user_group_details` VALUES (1,1,'admin'),(1,2,'admin'),(2,1,'employee'),(2,2,'employee');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_groups`
--

LOCK TABLES `user_groups` WRITE;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
INSERT INTO `user_groups` VALUES (1,'','',1,0,0,'2018-07-07 17:18:32','2018-07-07 17:18:32'),(2,'','',1,0,0,'2018-11-19 10:21:21','2018-11-19 10:21:21');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'arushi','arushi@muskowl.com','1234567890',2,'0000-00-00',0,'admin','','',1,0,1,0.000000,0.000000,0,0,'2018-08-24 18:04:47','2018-11-19 11:13:05'),(2,1,'nadim','nadim@muskowl.com','7737033665',1,'0000-00-00',0,'123456','','',0,0,1,0.000000,0.000000,0,0,'2018-11-12 16:39:55','2018-11-19 10:20:16'),(3,2,'rajesh','rajesh.muskowl@gmail.com','123456',1,'0000-00-00',0,'','','',0,0,1,0.000000,0.000000,0,0,'2018-11-14 17:23:17','2018-11-19 10:21:49'),(4,2,'pratik','pratik@muskowl.com','1234566456',1,'0000-00-00',0,'','','',0,0,1,0.000000,0.000000,0,0,'2018-11-19 10:19:54','2018-11-19 10:21:44');
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
-- Final view structure for view `events_view`
--

/*!50001 DROP TABLE IF EXISTS `events_view`*/;
/*!50001 DROP VIEW IF EXISTS `events_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `events_view` AS select `t`.`id` AS `id`,`t`.`user_id` AS `user_id`,`t`.`from_date` AS `from_date`,`t`.`to_date` AS `to_date`,`t`.`banner` AS `banner`,`t`.`image` AS `image`,`t`.`location` AS `location`,`t`.`latitude` AS `latitude`,`t`.`longitude` AS `longitude`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title`,`td`.`description` AS `description`,`u`.`name` AS `user_name`,`u`.`image` AS `user_image` from ((`events` `t` left join `event_details` `td` on((`td`.`id` = `t`.`id`))) left join `users` `u` on((`u`.`id` = `t`.`user_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

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
-- Final view structure for view `stories_view`
--

/*!50001 DROP TABLE IF EXISTS `stories_view`*/;
/*!50001 DROP VIEW IF EXISTS `stories_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `stories_view` AS select `t`.`id` AS `id`,`t`.`user_id` AS `user_id`,`t`.`event_id` AS `event_id`,`t`.`image` AS `image`,`t`.`banner` AS `banner`,`t`.`receipt` AS `receipt`,`t`.`receipt_private` AS `receipt_private`,`t`.`location` AS `location`,`t`.`status` AS `status`,`t`.`latitude` AS `latitude`,`t`.`longitude` AS `longitude`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title`,`td`.`description` AS `description`,`td`.`html` AS `html`,(select sum(`sr`.`likes`) from `story_rankings` `sr` where (`sr`.`story_id` = `t`.`id`)) AS `likes`,(select sum(`sr`.`dislikes`) from `story_rankings` `sr` where (`sr`.`story_id` = `t`.`id`)) AS `dislikes`,(select (sum(`sr`.`likes`) - sum(`sr`.`dislikes`)) from `story_rankings` `sr` where (`sr`.`story_id` = `t`.`id`)) AS `totalLikes`,`u`.`name` AS `user_name`,`u`.`image` AS `user_image` from ((`stories` `t` left join `story_details` `td` on((`td`.`id` = `t`.`id`))) left join `users` `u` on((`u`.`id` = `t`.`user_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `story_comments_view`
--

/*!50001 DROP TABLE IF EXISTS `story_comments_view`*/;
/*!50001 DROP VIEW IF EXISTS `story_comments_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `story_comments_view` AS select `sc`.`id` AS `id`,`sc`.`user_id` AS `user_id`,`sc`.`story_id` AS `story_id`,`sc`.`language_id` AS `language_id`,`sc`.`comment` AS `comment`,`sc`.`date` AS `date`,`sc`.`status` AS `status`,`u`.`name` AS `user_name`,`u`.`image` AS `user_image` from (`story_comments` `sc` left join `users` `u` on((`u`.`id` = `sc`.`user_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `story_complains_view`
--

/*!50001 DROP TABLE IF EXISTS `story_complains_view`*/;
/*!50001 DROP VIEW IF EXISTS `story_complains_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `story_complains_view` AS select `sc`.`id` AS `id`,`sc`.`story_id` AS `story_id`,`sc`.`story_comment_id` AS `story_comment_id`,`sc`.`user_id` AS `user_id`,`sc`.`language_id` AS `language_id`,`sc`.`title` AS `title`,`sc`.`description` AS `description`,`sc`.`status` AS `status`,`sc`.`created_by` AS `created_by`,`sc`.`modified_by` AS `modified_by`,`sc`.`created_date` AS `created_date`,`sc`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name`,`sd`.`title` AS `story_title`,`sm`.`comment` AS `comment` from ((((`story_complains` `sc` left join `stories` `s` on((`s`.`id` = `sc`.`story_id`))) left join `story_details` `sd` on((`sd`.`id` = `sc`.`story_id`))) left join `story_comments` `sm` on(((`sm`.`id` = `sc`.`story_comment_id`) and (`sm`.`story_id` = `sc`.`story_id`) and (`sc`.`language_id` = `sc`.`language_id`)))) left join `users` `u` on((`u`.`id` = `sc`.`user_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `story_types_view`
--

/*!50001 DROP TABLE IF EXISTS `story_types_view`*/;
/*!50001 DROP VIEW IF EXISTS `story_types_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `story_types_view` AS select `t`.`id` AS `id`,`t`.`image` AS `image`,`t`.`is_upload` AS `is_upload`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title` from (`story_types` `t` left join `story_type_details` `td` on((`td`.`id` = `t`.`id`))) */;
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-24 16:35:35
