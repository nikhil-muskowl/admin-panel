SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: user_complains
#

DROP TABLE IF EXISTS `user_complains`;

CREATE TABLE `user_complains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `complain_by` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `language_id` (`language_id`),
  KEY `user_id` (`user_id`),
  KEY `complain_by` (`complain_by`),
  CONSTRAINT `user_complains_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_complains_ibfk_2` FOREIGN KEY (`complain_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_complains_ibfk_3` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `user_complains` (`id`, `user_id`, `complain_by`, `language_id`, `title`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 3, 1, 'das', 'ddasd', 1, 0, 0, '2018-11-26 16:27:50', '2018-11-26 16:27:50');


SET foreign_key_checks = 1;
