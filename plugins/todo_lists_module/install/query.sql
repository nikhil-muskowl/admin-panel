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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `todo_lists` (`id`, `user_id`, `language_id`, `subject`, `text`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 2, 1, 'admin work', 'admin work', 1, 0, 0, '2018-11-19 16:04:33', '2018-11-28 15:13:48');
INSERT INTO `todo_lists` (`id`, `user_id`, `language_id`, `subject`, `text`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 2, 1, 'test', 'test', 1, 0, 0, '2018-11-20 16:42:11', '2018-11-28 17:48:02');
INSERT INTO `todo_lists` (`id`, `user_id`, `language_id`, `subject`, `text`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 5, 1, 'rarau work', 'rarau work', 1, 0, 0, '2018-11-28 15:13:24', '2018-11-28 15:13:24');
INSERT INTO `todo_lists` (`id`, `user_id`, `language_id`, `subject`, `text`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (5, 3, 1, 'nest work', 'nest work', 1, 0, 0, '2018-11-28 15:13:34', '2018-11-28 15:13:34');
INSERT INTO `todo_lists` (`id`, `user_id`, `language_id`, `subject`, `text`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (6, 2, 1, 'testing', 'testing', 1, 0, 0, '2018-11-28 15:26:00', '2018-11-28 17:48:01');


SET foreign_key_checks = 1;
