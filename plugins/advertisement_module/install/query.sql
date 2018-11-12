SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: advertisements
#

DROP TABLE IF EXISTS `advertisements`;

CREATE TABLE `advertisements` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `advertisements` (`id`, `user_id`, `image`, `banner`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 0, '', '', 1, '0.000000', '0.000000', 0, 0, '2018-10-24 13:04:08', '2018-10-24 13:04:08');


#
# TABLE STRUCTURE FOR: advertisement_details
#

DROP TABLE IF EXISTS `advertisement_details`;

CREATE TABLE `advertisement_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `advertisement_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `advertisements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `advertisement_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `advertisement_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 1, 'a', '', '');
INSERT INTO `advertisement_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 2, 'a', '', '');


#
# TABLE STRUCTURE FOR: advertisement_images
#

DROP TABLE IF EXISTS `advertisement_images`;

CREATE TABLE `advertisement_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `advertisement_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `link` text NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `blog_id` (`advertisement_id`),
  CONSTRAINT `advertisement_images_ibfk_1` FOREIGN KEY (`advertisement_id`) REFERENCES `advertisements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: advertisement_tags
#

DROP TABLE IF EXISTS `advertisement_tags`;

CREATE TABLE `advertisement_tags` (
  `advertisement_id` int(11) NOT NULL,
  `tag` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  KEY `story_id` (`advertisement_id`),
  CONSTRAINT `advertisement_tags_ibfk_1` FOREIGN KEY (`advertisement_id`) REFERENCES `advertisements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: advertisement_to_types
#

DROP TABLE IF EXISTS `advertisement_to_types`;

CREATE TABLE `advertisement_to_types` (
  `advertisement_id` int(11) NOT NULL,
  `advertisement_type_id` int(11) NOT NULL,
  KEY `blog_id` (`advertisement_id`),
  KEY `blog_type_id` (`advertisement_type_id`),
  CONSTRAINT `advertisement_to_types_ibfk_1` FOREIGN KEY (`advertisement_id`) REFERENCES `advertisements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `advertisement_to_types_ibfk_2` FOREIGN KEY (`advertisement_type_id`) REFERENCES `advertisement_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: advertisement_types
#

DROP TABLE IF EXISTS `advertisement_types`;

CREATE TABLE `advertisement_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `advertisement_types` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 0, 0, '2018-10-24 13:03:49', '2018-10-24 13:03:49');


#
# TABLE STRUCTURE FOR: advertisement_type_details
#

DROP TABLE IF EXISTS `advertisement_type_details`;

CREATE TABLE `advertisement_type_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `advertisement_type_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `advertisement_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `advertisement_type_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `advertisement_type_details` (`id`, `language_id`, `title`) VALUES (1, 1, 'a');
INSERT INTO `advertisement_type_details` (`id`, `language_id`, `title`) VALUES (1, 2, 'a');


SET foreign_key_checks = 1;
