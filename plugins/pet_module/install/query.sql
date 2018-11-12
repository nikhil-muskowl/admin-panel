SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: pets
#

DROP TABLE IF EXISTS `pets`;

CREATE TABLE `pets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `pets` (`id`, `image`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 'upload/pets/bird/Level-1.png', 1, 0, 0, '2018-10-26 16:04:53', '2018-10-26 17:38:14');
INSERT INTO `pets` (`id`, `image`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 'upload/pets/bird/Level-1.png', 1, 0, 0, '2018-10-27 11:57:57', '2018-10-27 11:57:57');
INSERT INTO `pets` (`id`, `image`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 'upload/pets/bird/Level-1.png', 1, 0, 0, '2018-10-27 11:58:17', '2018-10-27 11:58:17');
INSERT INTO `pets` (`id`, `image`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 'upload/pets/bird/Level-1.png', 1, 0, 0, '2018-10-27 11:58:34', '2018-10-27 11:58:34');


#
# TABLE STRUCTURE FOR: pet_details
#

DROP TABLE IF EXISTS `pet_details`;

CREATE TABLE `pet_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `pet_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pet_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pet_details` (`id`, `language_id`, `title`, `description`) VALUES (1, 1, 'poko', '');
INSERT INTO `pet_details` (`id`, `language_id`, `title`, `description`) VALUES (1, 2, 'poko', '');
INSERT INTO `pet_details` (`id`, `language_id`, `title`, `description`) VALUES (2, 1, 'topo', '');
INSERT INTO `pet_details` (`id`, `language_id`, `title`, `description`) VALUES (2, 2, 'topo', '');
INSERT INTO `pet_details` (`id`, `language_id`, `title`, `description`) VALUES (3, 1, 'moto', '');
INSERT INTO `pet_details` (`id`, `language_id`, `title`, `description`) VALUES (3, 2, 'moto', '');
INSERT INTO `pet_details` (`id`, `language_id`, `title`, `description`) VALUES (4, 1, 'toto', '');
INSERT INTO `pet_details` (`id`, `language_id`, `title`, `description`) VALUES (4, 2, 'toto', '');


#
# TABLE STRUCTURE FOR: pet_levels
#

DROP TABLE IF EXISTS `pet_levels`;

CREATE TABLE `pet_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pet_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `level` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`pet_id`,`level`,`points`),
  KEY `pet_levels_ibfk_1` (`pet_id`),
  CONSTRAINT `pet_levels_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 'upload/pets/bird/Level-2.png', 1, 1000, 1, 0, 0, '2018-10-27 14:23:38', '2018-10-29 15:45:53');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 1, 'upload/pets/bird/Level-3.png', 2, 2000, 1, 0, 0, '2018-10-27 14:52:16', '2018-10-29 15:45:56');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 1, 'upload/pets/bird/Level-4.png', 3, 3000, 1, 0, 0, '2018-10-27 14:52:16', '2018-10-29 15:46:04');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 1, 'upload/pets/bird/Level-5.png', 4, 4000, 1, 0, 0, '2018-10-27 14:53:43', '2018-10-29 15:46:07');


#
# TABLE STRUCTURE FOR: user_pets
#

DROP TABLE IF EXISTS `user_pets`;

CREATE TABLE `user_pets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_2` (`user_id`,`pet_id`),
  KEY `user_id` (`user_id`),
  KEY `pet_id` (`pet_id`),
  CONSTRAINT `user_pets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_pets_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: user_pet_points
#

DROP TABLE IF EXISTS `user_pet_points`;

CREATE TABLE `user_pet_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_pet_points_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

SET foreign_key_checks = 1;
