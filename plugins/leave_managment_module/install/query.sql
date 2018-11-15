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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `holidays` (`id`, `status`, `date`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, '2018-10-02', 0, 0, '2018-10-12 14:27:04', '2018-10-22 14:43:54');
INSERT INTO `holidays` (`id`, `status`, `date`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 1, '2018-12-31', 0, 0, '2018-11-12 15:06:48', '2018-11-12 15:06:48');


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
INSERT INTO `holiday_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 1, 'New year leave', '', '');
INSERT INTO `holiday_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 2, 'New year leave', '', '');


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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 1, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43');
INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 1, 2, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43');
INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 1, 3, '2.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43');
INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 1, 4, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43');
INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (5, 2, 1, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43');
INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (6, 2, 2, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43');
INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (7, 2, 3, '2.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43');
INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (8, 2, 4, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43');
INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (9, 3, 1, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43');
INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (10, 3, 2, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43');
INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (11, 3, 3, '2.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43');
INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (12, 3, 4, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43');


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
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `file_attach` text NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
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
  KEY `language_id` (`language_id`),
  CONSTRAINT `leave_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_ibfk_2` FOREIGN KEY (`leave_reason_id`) REFERENCES `leave_reasons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_ibfk_3` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_ibfk_4` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `leave_applications` (`id`, `user_id`, `leave_reason_id`, `leave_type_id`, `language_id`, `from_date`, `to_date`, `total`, `file_attach`, `subject`, `text`, `leave_status`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 2, 2, 4, 1, '2018-11-13 00:00:00', '2018-11-15 00:00:00', '2.00', '', 'dahsodh', 'jjfsdf', 'P', 1, 0, 0, '2018-11-13 10:29:44', '2018-11-15 10:56:22');
INSERT INTO `leave_applications` (`id`, `user_id`, `leave_reason_id`, `leave_type_id`, `language_id`, `from_date`, `to_date`, `total`, `file_attach`, `subject`, `text`, `leave_status`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 2, 1, 2, 1, '2018-11-15 00:00:00', '2018-11-16 00:00:00', '1.00', '', 'cc', 'sdffsd', 'P', 1, 0, 0, '2018-11-15 11:20:01', '2018-11-15 13:05:34');
INSERT INTO `leave_applications` (`id`, `user_id`, `leave_reason_id`, `leave_type_id`, `language_id`, `from_date`, `to_date`, `total`, `file_attach`, `subject`, `text`, `leave_status`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 3, 2, 3, 1, '2018-11-15 09:30:00', '2018-11-15 12:00:00', '2.30', '', 'fsd', 'fsdf', 'P', 1, 0, 0, '2018-11-15 12:41:10', '2018-11-15 13:04:47');


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
  `type` enum('full','half','hour') NOT NULL,
  `value` int(11) NOT NULL,
  `file` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `leave_types` (`id`, `type`, `value`, `file`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 'half', 1, 0, 1, 0, 0, '2018-10-22 10:44:42', '2018-11-12 17:49:43');
INSERT INTO `leave_types` (`id`, `type`, `value`, `file`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 'full', 1, 1, 1, 0, 0, '2018-10-22 10:45:56', '2018-11-13 10:59:52');
INSERT INTO `leave_types` (`id`, `type`, `value`, `file`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 'hour', 2, 0, 1, 0, 0, '2018-10-22 10:46:22', '2018-11-12 17:50:16');
INSERT INTO `leave_types` (`id`, `type`, `value`, `file`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 'full', 1, 0, 1, 0, 0, '2018-10-22 17:09:19', '2018-11-12 17:49:34');


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

INSERT INTO `leave_type_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 1, 'half day', '', '');
INSERT INTO `leave_type_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 2, 'half day', '', '');
INSERT INTO `leave_type_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 1, 'emergency & medical', '', '');
INSERT INTO `leave_type_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 2, 'emergency & medical', '', '');
INSERT INTO `leave_type_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (3, 1, 'gate pass', '', '');
INSERT INTO `leave_type_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (3, 2, 'gate pass', '', '');
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
  `priority` int(2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`author_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `user_leave_authorities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_leave_authorities_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `user_leave_authorities` (`id`, `user_id`, `author_id`, `priority`, `status`, `created_date`, `modified_date`) VALUES (1, 2, 1, 1, 1, '2018-11-13 10:40:40', '2018-11-13 11:52:19');


SET foreign_key_checks = 1;
