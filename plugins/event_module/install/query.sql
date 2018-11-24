SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: events
#

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `banner` text NOT NULL,
  `image` text NOT NULL,
  `location` varchar(100) NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `events` (`id`, `user_id`, `from_date`, `to_date`, `banner`, `image`, `location`, `latitude`, `longitude`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 2, '2018-11-22 01:00:00', '2018-11-23 03:00:00', '', 'upload/water.png', 'Udaipur, Rajasthan, India', '24.585601', '73.708187', 1, 0, 0, '2018-11-22 11:42:22', '2018-11-24 12:41:18');


#
# TABLE STRUCTURE FOR: event_details
#

DROP TABLE IF EXISTS `event_details`;

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

INSERT INTO `event_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 1, 'test', '', '');
INSERT INTO `event_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 2, 'test', '', '');


SET foreign_key_checks = 1;
