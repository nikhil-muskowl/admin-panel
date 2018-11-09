SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: p_inquiries
#

DROP TABLE IF EXISTS `p_inquiries`;

CREATE TABLE `p_inquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `inquiry` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `p_inquiries_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: p_inquiry_to_types
#

DROP TABLE IF EXISTS `p_inquiry_to_types`;

CREATE TABLE `p_inquiry_to_types` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  KEY `blog_id` (`id`),
  KEY `blog_type_id` (`type_id`),
  CONSTRAINT `p_inquiry_to_types_ibfk_1` FOREIGN KEY (`id`) REFERENCES `p_inquiries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `p_inquiry_to_types_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `p_inquiry_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: p_inquiry_types
#

DROP TABLE IF EXISTS `p_inquiry_types`;

CREATE TABLE `p_inquiry_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `p_inquiry_types` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 0, 0, '2018-09-14 10:07:48', '2018-09-14 10:07:48');


#
# TABLE STRUCTURE FOR: p_inquiry_type_details
#

DROP TABLE IF EXISTS `p_inquiry_type_details`;

CREATE TABLE `p_inquiry_type_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `p_inquiry_type_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `p_inquiry_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `p_inquiry_type_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `p_inquiry_type_details` (`id`, `language_id`, `title`) VALUES (1, 1, 'service');
INSERT INTO `p_inquiry_type_details` (`id`, `language_id`, `title`) VALUES (1, 2, 'service');


SET foreign_key_checks = 1;
