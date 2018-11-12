SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: stories
#

DROP TABLE IF EXISTS `stories`;

CREATE TABLE `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
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

INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 4, 'upload/users/8336869.jpg', '', 'upload/users/887446.jpg', 0, 'China', 1, '39.922183', '116.420428', 0, 0, '2018-10-30 03:17:25', '2018-10-30 03:17:25');
INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 5, 'upload/users/6511436.jpg', '', '', 0, 'China', 1, '39.91146', '116.408016', 0, 0, '2018-11-01 01:05:44', '2018-11-01 01:05:44');
INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 3, 'upload/users/5573148.jpg', '', '', 0, 'China', 1, '39.925054', '116.416724', 0, 0, '2018-11-01 02:58:56', '2018-11-01 02:58:56');
INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 2, 'upload/users/820647.jpg', '', '', 0, 'China', 1, '39.920396', '116.418212', 0, 0, '2018-11-01 21:19:49', '2018-11-01 21:19:49');
INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (5, 2, 'upload/users/9492879.jpg', '', '', 0, 'China', 1, '39.914291', '116.425086', 0, 0, '2018-11-01 21:32:46', '2018-11-01 21:32:46');
INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (6, 3, 'upload/users/3647997.jpg', '', '', 0, 'China', 1, '39.920496', '116.416435', 0, 0, '2018-11-01 23:02:53', '2018-11-01 23:02:53');
INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (7, 2, 'upload/users/414962.jpg', '', '', 0, 'China', 1, '39.919981', '116.414977', 0, 0, '2018-11-02 03:30:47', '2018-11-02 03:30:47');
INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (8, 7, 'upload/users/4829110.jpg', '', '', 0, 'China', 1, '39.925429', '116.417253', 0, 0, '2018-11-02 21:45:29', '2018-11-02 21:45:29');
INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (9, 2, 'upload/users/8869539.jpg', '', '', 0, 'India', 1, '24.601399', '73.674223', 0, 0, '2018-11-03 04:16:47', '2018-11-03 05:19:07');
INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (10, 7, 'upload/users/7802814.jpg', '', '', 0, 'China', 1, '39.919981', '116.414977', 0, 0, '2018-11-03 04:32:28', '2018-11-03 04:32:28');
INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (11, 3, 'upload/users/579646.jpg', '', '', 0, 'India', 1, '24.585445', '73.712479', 0, 0, '2018-11-03 05:28:31', '2018-11-03 05:28:31');
INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (12, 2, 'upload/users/7405255.jpg', '', '', 0, 'India', 1, '24.599285', '73.776292', 0, 0, '2018-11-03 05:28:42', '2018-11-03 05:28:42');
INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (13, 5, 'upload/users/5571919.jpg', '', '', 0, 'Hong Kong', 1, '22.278909', '114.271741', 0, 0, '2018-11-03 09:50:50', '2018-11-03 09:50:50');
INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (14, 5, 'upload/users/4251761.jpg', '', '', 0, 'Hong Kong', 1, '22.308076', '114.258341', 0, 0, '2018-11-05 06:37:41', '2018-11-05 06:37:42');
INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (15, 2, 'upload/users/2297534.jpg', '', '', 0, 'Hong Kong', 1, '22.308047', '114.262560', 0, 0, '2018-11-05 06:40:58', '2018-11-05 06:40:58');
INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (16, 5, 'upload/users/5986882.jpg', '', '', 0, 'Hong Kong', 1, '22.304306', '114.161475', 0, 0, '2018-11-07 04:56:03', '2018-11-07 04:56:03');
INSERT INTO `stories` (`id`, `user_id`, `image`, `banner`, `receipt`, `receipt_private`, `location`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (17, 5, 'upload/users/2902742.jpg', '', '', 0, 'Hong Kong', 1, '22.295336', '114.172184', 0, 0, '2018-11-07 05:25:17', '2018-11-07 05:25:17');


#
# TABLE STRUCTURE FOR: story_comments
#

DROP TABLE IF EXISTS `story_comments`;

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

INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (1, 2, 1, 1, 'nice', '2018-10-30 05:30:00', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (2, 2, 1, 1, 'story detail', '2018-10-31 21:43:20', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (3, 2, 1, 1, 'story detail', '2018-10-31 21:44:55', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (4, 2, 5, 1, 'nice', '2018-11-01 23:29:10', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (5, 2, 5, 1, 'keep it on', '2018-11-01 23:32:47', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (6, 2, 6, 1, 'very nice', '2018-11-01 23:34:23', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (7, 7, 3, 1, 'nice', '2018-11-02 05:05:02', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (8, 7, 3, 1, 'nice', '2018-11-02 05:05:07', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (9, 7, 3, 1, 'nice', '2018-11-02 05:05:17', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (10, 7, 3, 1, 'very good', '2018-11-02 05:10:05', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (11, 2, 1, 1, 'story detail', '2018-11-02 21:30:22', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (12, 7, 6, 1, 'good', '2018-11-02 21:37:50', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (13, 2, 7, 1, 'good pic', '2018-11-02 21:51:04', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (14, 3, 3, 1, 'cool', '2018-11-03 03:02:48', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (15, 3, 2, 1, 'Nice', '2018-11-03 04:11:13', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (16, 3, 6, 1, 'Nice', '2018-11-03 04:11:25', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (17, 3, 7, 1, 'Good', '2018-11-03 04:11:34', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (18, 3, 8, 1, 'Good', '2018-11-03 04:11:49', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (19, 3, 8, 1, 'Djdjd', '2018-11-03 04:11:59', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (20, 3, 4, 1, 'Very good', '2018-11-03 04:12:13', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (21, 3, 4, 1, 'Best', '2018-11-03 04:12:17', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (22, 3, 4, 1, 'Fatao', '2018-11-03 04:12:23', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (23, 2, 9, 1, 'enjoy', '2018-11-03 04:17:40', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (24, 3, 12, 1, 'Hi', '2018-11-03 05:36:52', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (25, 3, 12, 1, ',,,', '2018-11-03 05:37:35', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (26, 3, 12, 1, ',', '2018-11-03 05:37:53', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (27, 5, 10, 1, '我', '2018-11-04 19:48:23', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (28, 5, 13, 1, '屌', '2018-11-04 19:49:25', 1);
INSERT INTO `story_comments` (`id`, `user_id`, `story_id`, `language_id`, `comment`, `date`, `status`) VALUES (29, 2, 14, 1, 'nice', '2018-11-06 02:15:58', 1);


#
# TABLE STRUCTURE FOR: story_complains
#

DROP TABLE IF EXISTS `story_complains`;

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

INSERT INTO `story_complains` (`id`, `story_id`, `story_comment_id`, `user_id`, `language_id`, `title`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 5, 0, 3, 1, 'Abusive', 'Abusive', 1, 0, 0, '2018-11-02 06:59:07', '2018-11-02 06:59:07');


#
# TABLE STRUCTURE FOR: story_details
#

DROP TABLE IF EXISTS `story_details`;

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

INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 1, '北京华尔道夫酒店', '', '');
INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 1, '中国国家博物馆', '', '');
INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (3, 1, '世纪大厦-A座', '', '');
INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (4, 1, 'F.A.T.O', '', '');
INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (5, 1, '东单地铁站-D口', '', '');
INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (6, 1, 'awinpaw', '', '');
INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (7, 1, '停车场-A入口', '', '');
INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (8, 1, '世纪大厦-B座', '', '');
INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (9, 1, 'Fateh Sagar Lake, Udaipur, Rajasthan', '', '');
INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (10, 1, '', '', '');
INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (11, 1, 'Udaipur, Rajasthan, India', '', '');
INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (12, 1, 'Pacific Institute of Technology, Udaipur, Rajasthan, India', '', '');
INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (13, 1, 'Hong Kong, 將軍澳工業邨', '', '');
INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (14, 1, 'Hong Kong, Tseung Kwan O, 將軍澳中心', '', '');
INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (15, 1, 'Hong Kong, Tseung Kwan O, 將軍澳廣場', '', '');
INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (16, 1, 'Hong Kong, West Kowloon, 九龍站', '', '');
INSERT INTO `story_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (17, 1, 'Hong Kong, Tsim Sha Tsui, 半島酒店', '', '');


#
# TABLE STRUCTURE FOR: story_images
#

DROP TABLE IF EXISTS `story_images`;

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

#
# TABLE STRUCTURE FOR: story_image_details
#

DROP TABLE IF EXISTS `story_image_details`;

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

#
# TABLE STRUCTURE FOR: story_rankings
#

DROP TABLE IF EXISTS `story_rankings`;

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

INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (1, 4, 1, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (2, 3, 1, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (3, 2, 1, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (4, 5, 2, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (5, 2, 3, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (6, 3, 2, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (7, 3, 3, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (8, 3, 5, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (12, 2, 6, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (13, 3, 6, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (14, 4, 6, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (15, 2, 4, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (16, 2, 2, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (17, 7, 7, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (18, 7, 3, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (20, 3, 7, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (21, 3, 4, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (22, 7, 1, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (23, 7, 2, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (24, 2, 8, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (25, 2, 7, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (26, 3, 8, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (27, 2, 9, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (28, 7, 9, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (29, 7, 8, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (30, 3, 9, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (31, 3, 12, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (32, 2, 11, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (33, 2, 12, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (34, 5, 4, 0, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (35, 5, 13, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (36, 5, 10, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (37, 2, 13, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (38, 2, 15, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (39, 2, 14, 1, 0);
INSERT INTO `story_rankings` (`id`, `user_id`, `story_id`, `likes`, `dislikes`) VALUES (40, 5, 14, 1, 0);


#
# TABLE STRUCTURE FOR: story_tags
#

DROP TABLE IF EXISTS `story_tags`;

CREATE TABLE `story_tags` (
  `story_id` int(11) NOT NULL,
  `tag` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  KEY `story_id` (`story_id`),
  CONSTRAINT `story_tags_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (1, '#Ggf');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (1, '#Fff');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (2, '#Yo,');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (3, '#Party');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (4, '#abcd');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (4, '#test');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (5, '#working');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (5, '#backtowork');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (5, '#morning');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (6, '#Working');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (6, '#Testing');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (7, '#abcd');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (7, '#test1');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (8, '#rarau');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (8, '#coding');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (8, '#test');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (9, '#fun');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (9, '#cool');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (10, '#hdhdh');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (10, '#jjdr');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (11, '#Gshdj');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (11, '#djdjd');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (11, '#djdjd');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (12, '#cool');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (12, '#done');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (13, '#我,');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (14, '#狗,');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (15, '#Omg');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (15, '#,');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (16, '#Bar,');
INSERT INTO `story_tags` (`story_id`, `tag`) VALUES (17, '#山,');


#
# TABLE STRUCTURE FOR: story_to_types
#

DROP TABLE IF EXISTS `story_to_types`;

CREATE TABLE `story_to_types` (
  `story_id` int(11) NOT NULL,
  `story_type_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  KEY `blog_id` (`story_id`),
  KEY `blog_type_id` (`story_type_id`),
  CONSTRAINT `story_to_types_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `story_to_types_ibfk_2` FOREIGN KEY (`story_type_id`) REFERENCES `story_types` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (1, 1, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (1, 6, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (2, 3, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (3, 2, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (3, 1, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (4, 3, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (5, 6, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (5, 5, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (6, 3, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (6, 2, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (6, 4, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (7, 3, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (7, 5, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (8, 3, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (8, 4, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (9, 3, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (9, 2, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (9, 5, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (10, 2, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (10, 5, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (11, 3, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (12, 3, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (12, 2, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (13, 4, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (14, 3, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (15, 3, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (16, 3, 0);
INSERT INTO `story_to_types` (`story_id`, `story_type_id`, `rank`) VALUES (17, 3, 0);


#
# TABLE STRUCTURE FOR: story_types
#

DROP TABLE IF EXISTS `story_types`;

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

INSERT INTO `story_types` (`id`, `image`, `is_upload`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 'upload/story_types/food.png', 1, 1, 0, 0, '2018-08-03 10:15:53', '2018-10-31 23:14:57');
INSERT INTO `story_types` (`id`, `image`, `is_upload`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 'upload/story_types/VectorSmartObject.png', 0, 1, 0, 0, '2018-08-11 14:15:15', '2018-10-31 23:16:19');
INSERT INTO `story_types` (`id`, `image`, `is_upload`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 'upload/story_types/world.png', 0, 1, 0, 0, '2018-08-11 14:15:41', '2018-10-31 23:15:42');
INSERT INTO `story_types` (`id`, `image`, `is_upload`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 'upload/story_types/VectorSmartObject.png', 0, 1, 0, 0, '2018-08-11 14:16:15', '2018-10-31 23:16:09');
INSERT INTO `story_types` (`id`, `image`, `is_upload`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (5, 'upload/story_types/world.png', 0, 1, 0, 0, '2018-09-10 15:32:25', '2018-10-31 23:15:54');
INSERT INTO `story_types` (`id`, `image`, `is_upload`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (6, 'upload/story_types/food.png', 1, 1, 0, 0, '2018-10-26 11:41:30', '2018-10-31 23:15:12');


#
# TABLE STRUCTURE FOR: story_type_details
#

DROP TABLE IF EXISTS `story_type_details`;

CREATE TABLE `story_type_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `story_type_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `story_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `story_type_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `story_type_details` (`id`, `language_id`, `title`) VALUES (1, 1, 'food');
INSERT INTO `story_type_details` (`id`, `language_id`, `title`) VALUES (1, 2, '餐饮');
INSERT INTO `story_type_details` (`id`, `language_id`, `title`) VALUES (2, 1, 'art');
INSERT INTO `story_type_details` (`id`, `language_id`, `title`) VALUES (2, 2, '艺术');
INSERT INTO `story_type_details` (`id`, `language_id`, `title`) VALUES (3, 1, 'adventure');
INSERT INTO `story_type_details` (`id`, `language_id`, `title`) VALUES (3, 2, '冒险');
INSERT INTO `story_type_details` (`id`, `language_id`, `title`) VALUES (4, 1, 'recreation');
INSERT INTO `story_type_details` (`id`, `language_id`, `title`) VALUES (4, 2, '娱乐');
INSERT INTO `story_type_details` (`id`, `language_id`, `title`) VALUES (5, 1, 'travels');
INSERT INTO `story_type_details` (`id`, `language_id`, `title`) VALUES (5, 2, '旅行');
INSERT INTO `story_type_details` (`id`, `language_id`, `title`) VALUES (6, 1, 'restaurants');
INSERT INTO `story_type_details` (`id`, `language_id`, `title`) VALUES (6, 2, '餐馆');


#
# TABLE STRUCTURE FOR: save_stories
#

DROP TABLE IF EXISTS `save_stories`;

CREATE TABLE `save_stories` (
  `story_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  UNIQUE KEY `story_id` (`story_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `save_stories_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `save_stories_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `save_stories` (`story_id`, `user_id`) VALUES (1, 2);
INSERT INTO `save_stories` (`story_id`, `user_id`) VALUES (3, 2);
INSERT INTO `save_stories` (`story_id`, `user_id`) VALUES (12, 3);


SET foreign_key_checks = 1;
