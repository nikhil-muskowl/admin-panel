SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: todo_lists
#

DROP TABLE IF EXISTS `todo_lists`;

CREATE TABLE `todo_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
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
  CONSTRAINT `todo_lists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `todo_lists_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `todo_lists` (`id`, `user_id`, `language_id`, `subject`, `text`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 2, 1, 'leave application', 'leave application', 1, 0, 0, '2018-11-19 16:04:33', '2018-11-20 11:03:21');


SET foreign_key_checks = 1;
