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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `holidays` (`id`, `status`, `date`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, '2018-10-02', 0, 0, '2018-10-12 14:27:04', '2018-10-22 14:43:54');


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

INSERT INTO `holiday_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 1, '2 october', '', '');
INSERT INTO `holiday_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 2, '2 october', '', '');


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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 26, 4, '10.00', 1, 0, 0, '2018-10-12 14:45:53', '2018-10-22 17:11:03');
INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 26, 4, '10.00', 1, 0, 0, '2018-10-22 17:09:50', '2018-10-22 17:11:08');
INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 26, 3, '10.00', 1, 0, 0, '2018-10-22 17:10:57', '2018-10-22 17:10:57');
INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 26, 1, '10.00', 1, 0, 0, '2018-10-22 17:11:18', '2018-10-22 17:11:18');


#
# TABLE STRUCTURE FOR: leave_applications
#

DROP TABLE IF EXISTS `leave_applications`;

CREATE TABLE `leave_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `leave_reason_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `leave_status` enum('P','A','C') NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `leave_reason_id` (`leave_reason_id`),
  KEY `leave_type_id` (`leave_type_id`),
  CONSTRAINT `leave_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_ibfk_2` FOREIGN KEY (`leave_reason_id`) REFERENCES `leave_reasons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_ibfk_3` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `leave_applications` (`id`, `user_id`, `leave_reason_id`, `leave_type_id`, `from_date`, `to_date`, `total`, `leave_status`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 26, 1, 1, '2018-11-05 10:00:00', '2018-11-12 04:00:00', '6.00', 'P', 1, 0, 0, '2018-10-13 10:27:26', '2018-10-22 11:24:54');


#
# TABLE STRUCTURE FOR: leave_application_details
#

DROP TABLE IF EXISTS `leave_application_details`;

CREATE TABLE `leave_application_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `leave_application_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `leave_applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_application_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `leave_reasons` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 0, 0, '2018-10-22 10:56:23', '2018-10-22 10:56:23');
INSERT INTO `leave_reasons` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 1, 0, 0, '2018-10-22 10:57:50', '2018-10-22 10:57:50');


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

INSERT INTO `leave_reason_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 1, 'medical emergency', '', '');
INSERT INTO `leave_reason_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 2, 'आपात चिकित्सा', '', '');
INSERT INTO `leave_reason_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 1, 'casual', '', '');
INSERT INTO `leave_reason_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 2, 'आकस्मिक', '', '');


#
# TABLE STRUCTURE FOR: leave_types
#

DROP TABLE IF EXISTS `leave_types`;

CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `leave_types` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 0, 0, '2018-10-22 10:44:42', '2018-10-22 10:44:42');
INSERT INTO `leave_types` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 1, 0, 0, '2018-10-22 10:45:56', '2018-10-22 10:45:56');
INSERT INTO `leave_types` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 1, 0, 0, '2018-10-22 10:46:22', '2018-10-22 10:46:22');
INSERT INTO `leave_types` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 1, 0, 0, '2018-10-22 17:09:19', '2018-10-22 17:09:19');


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

INSERT INTO `leave_type_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 1, 'partial', '', '');
INSERT INTO `leave_type_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 2, 'आंशिक', '', '');
INSERT INTO `leave_type_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 1, 'emergency', '', '');
INSERT INTO `leave_type_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 2, 'आपातकालीन', '', '');
INSERT INTO `leave_type_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (3, 1, 'medical', '', '');
INSERT INTO `leave_type_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (3, 2, 'मेडिकल', '', '');
INSERT INTO `leave_type_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (4, 1, 'casual', '', '');
INSERT INTO `leave_type_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (4, 2, 'आकस्मिक', '', '');


#
# TABLE STRUCTURE FOR: user_leave_authorities
#

DROP TABLE IF EXISTS `user_leave_authorities`;

CREATE TABLE `user_leave_authorities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`author_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `user_leave_authorities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_leave_authorities_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `user_leave_authorities` (`id`, `user_id`, `author_id`, `status`, `created_date`, `modified_date`) VALUES (1, 25, 1, 1, '2018-10-22 14:42:29', '2018-10-22 14:42:29');
INSERT INTO `user_leave_authorities` (`id`, `user_id`, `author_id`, `status`, `created_date`, `modified_date`) VALUES (2, 25, 26, 1, '2018-10-22 14:42:29', '2018-10-22 14:42:29');
INSERT INTO `user_leave_authorities` (`id`, `user_id`, `author_id`, `status`, `created_date`, `modified_date`) VALUES (3, 26, 1, 1, '2018-10-22 14:42:29', '2018-10-22 14:42:29');


SET foreign_key_checks = 1;
