SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: notifications
#

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `type_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `notifications` (`id`, `image`, `type`, `type_id`, `status`, `sort_order`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 'upload/images/0c90f50a999505679ff15dc9926da398.jpg', '', 0, 1, 0, 0, 0, '2018-09-22 12:50:47', '2018-09-22 14:09:41');


#
# TABLE STRUCTURE FOR: notification_details
#

DROP TABLE IF EXISTS `notification_details`;

CREATE TABLE `notification_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`,`language_id`),
  KEY `notification_details_ibfk_2` (`language_id`),
  CONSTRAINT `notification_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notification_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `notification_details` (`id`, `language_id`, `title`, `description`) VALUES (1, 1, 'e', 'e');
INSERT INTO `notification_details` (`id`, `language_id`, `title`, `description`) VALUES (1, 2, 'h', 'h');


#
# TABLE STRUCTURE FOR: notification_to_users
#

DROP TABLE IF EXISTS `notification_to_users`;

CREATE TABLE `notification_to_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_view` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`,`notification_id`,`user_id`),
  KEY `notification_id` (`notification_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `notification_to_users_ibfk_1` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notification_to_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `notification_to_users` (`id`, `notification_id`, `user_id`, `is_view`) VALUES (7, 1, 26, 0);
INSERT INTO `notification_to_users` (`id`, `notification_id`, `user_id`, `is_view`) VALUES (8, 1, 27, 0);


SET foreign_key_checks = 1;
