SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: inquiries
#

DROP TABLE IF EXISTS `inquiries`;

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `inquiry` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `inquiries` (`id`, `name`, `email`, `contact`, `inquiry`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 'nadim', 'nadim.muskowl@gmail.com', '7737033665', 'dasdasd', 1, 0, 0, '2018-09-14 10:09:50', '2018-09-14 10:09:50');


#
# TABLE STRUCTURE FOR: inquiry_to_types
#

DROP TABLE IF EXISTS `inquiry_to_types`;

CREATE TABLE `inquiry_to_types` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  KEY `blog_id` (`id`),
  KEY `blog_type_id` (`type_id`),
  CONSTRAINT `inquiry_to_types_ibfk_1` FOREIGN KEY (`id`) REFERENCES `inquiries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inquiry_to_types_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `inquiry_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `inquiry_to_types` (`id`, `type_id`) VALUES (1, 1);


#
# TABLE STRUCTURE FOR: inquiry_types
#

DROP TABLE IF EXISTS `inquiry_types`;

CREATE TABLE `inquiry_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `inquiry_types` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 0, 0, '2018-08-29 10:38:59', '2018-08-29 10:38:59');
INSERT INTO `inquiry_types` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 1, 0, 0, '2018-08-29 10:45:46', '2018-08-29 10:45:46');
INSERT INTO `inquiry_types` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 1, 0, 0, '2018-08-29 10:46:08', '2018-08-29 10:46:08');


#
# TABLE STRUCTURE FOR: inquiry_type_details
#

DROP TABLE IF EXISTS `inquiry_type_details`;

CREATE TABLE `inquiry_type_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `inquiry_type_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `inquiry_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inquiry_type_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `inquiry_type_details` (`id`, `language_id`, `title`) VALUES (1, 1, 'blog');
INSERT INTO `inquiry_type_details` (`id`, `language_id`, `title`) VALUES (1, 2, 'ब्लॉग');
INSERT INTO `inquiry_type_details` (`id`, `language_id`, `title`) VALUES (2, 1, 'support');
INSERT INTO `inquiry_type_details` (`id`, `language_id`, `title`) VALUES (2, 2, 'support');
INSERT INTO `inquiry_type_details` (`id`, `language_id`, `title`) VALUES (3, 1, 'product');
INSERT INTO `inquiry_type_details` (`id`, `language_id`, `title`) VALUES (3, 2, 'product');


SET foreign_key_checks = 1;
