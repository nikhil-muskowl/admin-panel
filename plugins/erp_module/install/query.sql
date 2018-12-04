SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: user_authorities
#

DROP TABLE IF EXISTS `user_authorities`;

CREATE TABLE `user_authorities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `priority` int(2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`author_id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `user_authorities` (`id`, `user_id`, `author_id`, `priority`, `status`, `created_date`, `modified_date`) VALUES (1, 5, 2, 1, 1, '2018-12-01 14:51:25', '2018-12-01 14:51:25');


SET foreign_key_checks = 1;
