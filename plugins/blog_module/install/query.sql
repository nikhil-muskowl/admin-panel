SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: blogs
#

DROP TABLE IF EXISTS `blogs`;

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

INSERT INTO `blogs` (`id`, `user_id`, `image`, `banner`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 1, '', '', 1, '0.000000', '0.000000', 0, 0, '2018-08-06 17:54:02', '2018-10-24 11:57:41');
INSERT INTO `blogs` (`id`, `user_id`, `image`, `banner`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 1, '', '', 1, '0.000000', '0.000000', 0, 0, '2018-08-07 17:49:46', '2018-10-24 12:06:18');
INSERT INTO `blogs` (`id`, `user_id`, `image`, `banner`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 1, '', '', 1, '0.000000', '0.000000', 0, 0, '2018-08-07 17:51:17', '2018-10-24 12:06:20');


#
# TABLE STRUCTURE FOR: blog_details
#

DROP TABLE IF EXISTS `blog_details`;

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

INSERT INTO `blog_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 1, 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '');
INSERT INTO `blog_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 2, 'यात्रा', '', '');
INSERT INTO `blog_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (3, 1, 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '');
INSERT INTO `blog_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (3, 2, 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '');
INSERT INTO `blog_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (4, 1, 'Where can I get some?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', '<br data-mce-bogus=\"1\">');
INSERT INTO `blog_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (4, 2, 'Where can I get some?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', '<br data-mce-bogus=\"1\">');


#
# TABLE STRUCTURE FOR: blog_images
#

DROP TABLE IF EXISTS `blog_images`;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: blog_rankings
#

DROP TABLE IF EXISTS `blog_rankings`;

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

#
# TABLE STRUCTURE FOR: blog_tags
#

DROP TABLE IF EXISTS `blog_tags`;

CREATE TABLE `blog_tags` (
  `blog_id` int(11) NOT NULL,
  `tag` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  KEY `story_id` (`blog_id`),
  CONSTRAINT `blog_tags_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `blog_tags` (`blog_id`, `tag`) VALUES (3, '#come');
INSERT INTO `blog_tags` (`blog_id`, `tag`) VALUES (4, 'dasd');


#
# TABLE STRUCTURE FOR: blog_to_types
#

DROP TABLE IF EXISTS `blog_to_types`;

CREATE TABLE `blog_to_types` (
  `blog_id` int(11) NOT NULL,
  `blog_type_id` int(11) NOT NULL,
  KEY `blog_id` (`blog_id`),
  KEY `blog_type_id` (`blog_type_id`),
  CONSTRAINT `blog_to_types_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `blog_to_types_ibfk_2` FOREIGN KEY (`blog_type_id`) REFERENCES `blog_types` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `blog_to_types` (`blog_id`, `blog_type_id`) VALUES (2, 3);
INSERT INTO `blog_to_types` (`blog_id`, `blog_type_id`) VALUES (2, 2);
INSERT INTO `blog_to_types` (`blog_id`, `blog_type_id`) VALUES (3, 1);
INSERT INTO `blog_to_types` (`blog_id`, `blog_type_id`) VALUES (4, 4);
INSERT INTO `blog_to_types` (`blog_id`, `blog_type_id`) VALUES (4, 1);
INSERT INTO `blog_to_types` (`blog_id`, `blog_type_id`) VALUES (4, 5);


#
# TABLE STRUCTURE FOR: blog_types
#

DROP TABLE IF EXISTS `blog_types`;

CREATE TABLE `blog_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `blog_types` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 0, 0, '2018-08-03 15:27:29', '2018-08-03 15:27:29');
INSERT INTO `blog_types` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 1, 0, 0, '2018-08-06 17:50:36', '2018-08-06 17:50:36');
INSERT INTO `blog_types` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 1, 0, 0, '2018-08-06 17:53:28', '2018-08-06 17:53:28');
INSERT INTO `blog_types` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 1, 0, 0, '2018-08-08 09:35:11', '2018-08-08 09:35:11');
INSERT INTO `blog_types` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (5, 1, 0, 0, '2018-08-08 09:35:37', '2018-08-08 09:35:37');


#
# TABLE STRUCTURE FOR: blog_type_details
#

DROP TABLE IF EXISTS `blog_type_details`;

CREATE TABLE `blog_type_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `blog_type_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `blog_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `blog_type_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `blog_type_details` (`id`, `language_id`, `title`) VALUES (1, 1, 'food');
INSERT INTO `blog_type_details` (`id`, `language_id`, `title`) VALUES (1, 2, 'भोजन');
INSERT INTO `blog_type_details` (`id`, `language_id`, `title`) VALUES (2, 1, 'travel');
INSERT INTO `blog_type_details` (`id`, `language_id`, `title`) VALUES (2, 2, 'यात्रा');
INSERT INTO `blog_type_details` (`id`, `language_id`, `title`) VALUES (3, 1, 'hotel');
INSERT INTO `blog_type_details` (`id`, `language_id`, `title`) VALUES (3, 2, 'होटल');
INSERT INTO `blog_type_details` (`id`, `language_id`, `title`) VALUES (4, 1, 'cafe');
INSERT INTO `blog_type_details` (`id`, `language_id`, `title`) VALUES (4, 2, 'कैफ़े');
INSERT INTO `blog_type_details` (`id`, `language_id`, `title`) VALUES (5, 1, 'restaurant');
INSERT INTO `blog_type_details` (`id`, `language_id`, `title`) VALUES (5, 2, 'खाने की दुकान');


SET foreign_key_checks = 1;
