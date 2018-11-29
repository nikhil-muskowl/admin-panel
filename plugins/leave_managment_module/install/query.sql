SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: holidays
#

DROP TABLE IF EXISTS `holidays`;

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: holiday_details
#

DROP TABLE IF EXISTS `holiday_details`;

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

#
# TABLE STRUCTURE FOR: user_leaves
#

DROP TABLE IF EXISTS `user_leaves`;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: leave_applications
#

DROP TABLE IF EXISTS `leave_applications`;

CREATE TABLE `leave_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `leave_reason_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `leave_status_id` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `file_attach` text NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `leave_reason_id` (`leave_reason_id`),
  KEY `leave_type_id` (`leave_type_id`),
  KEY `leave_applications_ibfk_4` (`language_id`),
  KEY `leave_status_id` (`leave_status_id`),
  CONSTRAINT `leave_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_ibfk_2` FOREIGN KEY (`leave_reason_id`) REFERENCES `leave_reasons` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_ibfk_3` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_ibfk_4` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_ibfk_5` FOREIGN KEY (`leave_status_id`) REFERENCES `leave_statuses` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: leave_reasons
#

DROP TABLE IF EXISTS `leave_reasons`;

CREATE TABLE `leave_reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: leave_reason_details
#

DROP TABLE IF EXISTS `leave_reason_details`;

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

#
# TABLE STRUCTURE FOR: leave_statuses
#

DROP TABLE IF EXISTS `leave_statuses`;

CREATE TABLE `leave_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: leave_status_details
#

DROP TABLE IF EXISTS `leave_status_details`;

CREATE TABLE `leave_status_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `leave_status_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `leave_applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_status_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: leave_types
#

DROP TABLE IF EXISTS `leave_types`;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: leave_type_details
#

DROP TABLE IF EXISTS `leave_type_details`;

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

#
# TABLE STRUCTURE FOR: user_leave_authorities
#

DROP TABLE IF EXISTS `user_leave_authorities`;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

SET foreign_key_checks = 1;
