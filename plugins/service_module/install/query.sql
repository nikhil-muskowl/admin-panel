SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: services
#

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `banner` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `services` (`id`, `parent_id`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 0, '', '', 1, 0, 0, '2018-12-04 15:42:24', '2018-12-04 15:42:24');


#
# TABLE STRUCTURE FOR: service_details
#

DROP TABLE IF EXISTS `service_details`;

CREATE TABLE `service_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `service_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `service_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `service_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 1, 'test', '', '');
INSERT INTO `service_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 2, 'test', '', '');


SET foreign_key_checks = 1;
