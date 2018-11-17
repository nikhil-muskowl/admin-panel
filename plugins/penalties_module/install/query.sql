SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: penalties
#

DROP TABLE IF EXISTS `penalties`;

CREATE TABLE `penalties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `penalty_reason_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `leave_applications_ibfk_4` (`language_id`),
  KEY `penalties_ibfk_2` (`penalty_reason_id`),
  CONSTRAINT `penalties_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penalties_ibfk_2` FOREIGN KEY (`penalty_reason_id`) REFERENCES `leave_reasons` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `penalties_ibfk_3` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `penalties` (`id`, `user_id`, `language_id`, `penalty_reason_id`, `date`, `total`, `subject`, `text`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 2, 1, 1, '2018-11-17', '100.00', 'mobile penalty', 'mobile penalty', 1, 0, 0, '2018-11-17 11:32:54', '2018-11-17 11:35:16');
INSERT INTO `penalties` (`id`, `user_id`, `language_id`, `penalty_reason_id`, `date`, `total`, `subject`, `text`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 2, 1, 2, '2018-11-16', '100.00', 'absent', 'absent', 1, 0, 0, '2018-11-17 11:49:43', '2018-11-17 11:49:43');
INSERT INTO `penalties` (`id`, `user_id`, `language_id`, `penalty_reason_id`, `date`, `total`, `subject`, `text`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 3, 1, 2, '2018-11-15', '200.00', 'absent', 'absent', 1, 0, 0, '2018-11-17 11:52:11', '2018-11-17 11:52:11');


#
# TABLE STRUCTURE FOR: penalty_reasons
#

DROP TABLE IF EXISTS `penalty_reasons`;

CREATE TABLE `penalty_reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `penalty_reasons` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 0, 0, '2018-11-17 11:28:34', '2018-11-17 11:28:34');
INSERT INTO `penalty_reasons` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 1, 0, 0, '2018-11-17 11:29:46', '2018-11-17 11:29:46');


#
# TABLE STRUCTURE FOR: penalty_reason_details
#

DROP TABLE IF EXISTS `penalty_reason_details`;

CREATE TABLE `penalty_reason_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `penalty_reason_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `penalty_reasons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penalty_reason_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `penalty_reason_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 1, 'mobile', '', '');
INSERT INTO `penalty_reason_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 2, 'mobile', '', '');
INSERT INTO `penalty_reason_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 1, 'absent', '', '');
INSERT INTO `penalty_reason_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 2, 'absent', '', '');


SET foreign_key_checks = 1;
