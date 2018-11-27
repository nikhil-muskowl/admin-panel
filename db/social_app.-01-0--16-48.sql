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

-- CREATE DATABASE /*!32312 IF NOT EXISTS*/ `social_app` /*!40100 DEFAULT CHARACTER SET utf8 */;
-- 
-- 

--
-- Table structure for table `blog_details`
--

DROP TABLE IF EXISTS `blog_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `blog_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `blog_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_details`
--

LOCK TABLES `blog_details` WRITE;
/*!40000 ALTER TABLE `blog_details` DISABLE KEYS */;
INSERT INTO `blog_details` VALUES (2,1,'Why do we use it?','It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',''),(2,2,'यात्रा','',''),(3,1,'Where does it come from?','Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.',''),(3,2,'Where does it come from?','Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.',''),(4,1,'Where can I get some?','There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.','<br data-mce-bogus=\"1\">'),(4,2,'Where can I get some?','There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.','<br data-mce-bogus=\"1\">');
/*!40000 ALTER TABLE `blog_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_images`
--

DROP TABLE IF EXISTS `blog_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `link` text NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `blog_id` (`blog_id`),
  CONSTRAINT `blog_images_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_images`
--

LOCK TABLES `blog_images` WRITE;
/*!40000 ALTER TABLE `blog_images` DISABLE KEYS */;
INSERT INTO `blog_images` VALUES (1,4,'upload/fire.png','',0,1);
/*!40000 ALTER TABLE `blog_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_rankings`
--

DROP TABLE IF EXISTS `blog_rankings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_rankings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `story_id` (`blog_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `blog_rankings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `blog_rankings_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_rankings`
--

LOCK TABLES `blog_rankings` WRITE;
/*!40000 ALTER TABLE `blog_rankings` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_rankings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_tags`
--

DROP TABLE IF EXISTS `blog_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_tags` (
  `blog_id` int(11) NOT NULL,
  `tag` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  KEY `story_id` (`blog_id`),
  CONSTRAINT `blog_tags_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_tags`
--

LOCK TABLES `blog_tags` WRITE;
/*!40000 ALTER TABLE `blog_tags` DISABLE KEYS */;
INSERT INTO `blog_tags` VALUES (3,'#come'),(4,'dasd');
/*!40000 ALTER TABLE `blog_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_to_types`
--

DROP TABLE IF EXISTS `blog_to_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_to_types` (
  `blog_id` int(11) NOT NULL,
  `blog_type_id` int(11) NOT NULL,
  KEY `blog_id` (`blog_id`),
  KEY `blog_type_id` (`blog_type_id`),
  CONSTRAINT `blog_to_types_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `blog_to_types_ibfk_2` FOREIGN KEY (`blog_type_id`) REFERENCES `blog_types` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_to_types`
--

LOCK TABLES `blog_to_types` WRITE;
/*!40000 ALTER TABLE `blog_to_types` DISABLE KEYS */;
INSERT INTO `blog_to_types` VALUES (2,3),(2,2),(3,1),(4,4),(4,1),(4,5);
/*!40000 ALTER TABLE `blog_to_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_type_details`
--

DROP TABLE IF EXISTS `blog_type_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_type_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `blog_type_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `blog_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `blog_type_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_type_details`
--

LOCK TABLES `blog_type_details` WRITE;
/*!40000 ALTER TABLE `blog_type_details` DISABLE KEYS */;
INSERT INTO `blog_type_details` VALUES (1,1,'food'),(1,2,'भोजन'),(2,1,'travel'),(2,2,'यात्रा'),(3,1,'hotel'),(3,2,'होटल'),(4,1,'cafe'),(4,2,'कैफ़े'),(5,1,'restaurant'),(5,2,'खाने की दुकान');
/*!40000 ALTER TABLE `blog_type_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_types`
--

DROP TABLE IF EXISTS `blog_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_types`
--

LOCK TABLES `blog_types` WRITE;
/*!40000 ALTER TABLE `blog_types` DISABLE KEYS */;
INSERT INTO `blog_types` VALUES (1,1,0,0,'2018-08-03 15:27:29','2018-08-03 15:27:29'),(2,1,0,0,'2018-08-06 17:50:36','2018-08-06 17:50:36'),(3,1,0,0,'2018-08-06 17:53:28','2018-08-06 17:53:28'),(4,1,0,0,'2018-08-08 09:35:11','2018-08-08 09:35:11'),(5,1,0,0,'2018-08-08 09:35:37','2018-08-08 09:35:37');
/*!40000 ALTER TABLE `blog_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `blog_types_view`
--

DROP TABLE IF EXISTS `blog_types_view`;
/*!50001 DROP VIEW IF EXISTS `blog_types_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `blog_types_view` (
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
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `banner` text NOT NULL,
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
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (2,1,'','',1,0.000000,0.000000,0,0,'2018-08-06 17:54:02','2018-10-24 11:57:41'),(3,1,'','',1,0.000000,0.000000,0,0,'2018-08-07 17:49:46','2018-10-24 12:06:18'),(4,1,'','',1,0.000000,0.000000,0,0,'2018-08-07 17:51:17','2018-10-24 12:06:20');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `blogs_view`
--

DROP TABLE IF EXISTS `blogs_view`;
/*!50001 DROP VIEW IF EXISTS `blogs_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `blogs_view` (
  `id` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `image` tinyint NOT NULL,
  `banner` tinyint NOT NULL,
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
  `user_name` tinyint NOT NULL,
  `user_image` tinyint NOT NULL,
  `keyword` tinyint NOT NULL,
  `meta_title` tinyint NOT NULL,
  `meta_keyword` tinyint NOT NULL,
  `meta_description` tinyint NOT NULL
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
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plugins`
--

LOCK TABLES `plugins` WRITE;
/*!40000 ALTER TABLE `plugins` DISABLE KEYS */;
INSERT INTO `plugins` VALUES (65,'Blog Module','blog_module',1,0,0,'2018-11-26 16:31:06','2018-11-26 16:31:06');
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



--
-- Final view structure for view `blog_types_view`
--

/*!50001 DROP TABLE IF EXISTS `blog_types_view`*/;
/*!50001 DROP VIEW IF EXISTS `blog_types_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `blog_types_view` AS select `t`.`id` AS `id`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title` from (`blog_types` `t` left join `blog_type_details` `td` on((`td`.`id` = `t`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `blogs_view`
--

/*!50001 DROP TABLE IF EXISTS `blogs_view`*/;
/*!50001 DROP VIEW IF EXISTS `blogs_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `blogs_view` AS select `t`.`id` AS `id`,`t`.`user_id` AS `user_id`,`t`.`image` AS `image`,`t`.`banner` AS `banner`,`t`.`status` AS `status`,`t`.`latitude` AS `latitude`,`t`.`longitude` AS `longitude`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title`,`td`.`description` AS `description`,`td`.`html` AS `html`,`u`.`name` AS `user_name`,`u`.`image` AS `user_image`,`ua`.`keyword` AS `keyword`,`ua`.`meta_title` AS `meta_title`,`ua`.`meta_keyword` AS `meta_keyword`,`ua`.`meta_description` AS `meta_description` from (((`blogs` `t` left join `blog_details` `td` on((`td`.`id` = `t`.`id`))) left join `users` `u` on((`u`.`id` = `t`.`user_id`))) left join `url_alias` `ua` on(((`ua`.`language_id` = `td`.`language_id`) and (`ua`.`type_id` = `t`.`id`) and (`ua`.`type` = 'blogs')))) */;
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

/*!50001 VIEW `genders_view` AS select `t`.`id` AS `id`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title`,`td`.`description` AS `description`,`td`.`html` AS `html` from (`genders` `t` left join `gender_details` `td` on((`td`.`id` = `t`.`id`))) */;
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

-- Dump completed on 2018-11-26 16:48:43
