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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 'upload/pets/bird/Level-1.png', 1, 0, 1, 0, 0, '2018-10-27 14:23:38', '2018-10-30 21:54:41');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 1, 'upload/pets/bird/Level-2.png', 2, 2000, 1, 0, 0, '2018-10-27 14:52:16', '2018-10-30 21:55:04');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 1, 'upload/pets/bird/Level-3.png', 3, 3000, 1, 0, 0, '2018-10-27 14:52:16', '2018-10-30 21:55:20');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 1, 'upload/pets/bird/Level-4.png', 4, 4000, 1, 0, 0, '2018-10-27 14:53:43', '2018-10-30 21:55:35');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (5, 3, 'upload/pets/bird/Level-1.png', 1, 0, 1, 0, 0, '2018-10-30 01:46:59', '2018-10-31 01:39:45');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (6, 3, 'upload/pets/Bear.png', 2, 2000, 1, 0, 0, '2018-10-30 01:47:08', '2018-10-31 01:40:35');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (7, 3, '', 3, 3000, 1, 0, 0, '2018-10-30 01:47:18', '2018-10-30 01:47:18');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (8, 3, '', 4, 4000, 1, 0, 0, '2018-10-30 01:47:37', '2018-10-30 01:47:37');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (9, 2, 'upload/pets/bird/Level-1.png', 1, 0, 1, 0, 0, '2018-10-30 01:47:53', '2018-10-31 01:39:18');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (10, 2, 'upload/pets/Cat.png', 2, 2000, 1, 0, 0, '2018-10-30 01:48:00', '2018-10-31 01:40:52');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (11, 2, '', 3, 3000, 1, 0, 0, '2018-10-30 01:48:06', '2018-10-30 01:48:06');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (12, 2, '', 4, 4000, 1, 0, 0, '2018-10-30 01:48:13', '2018-10-30 01:48:13');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (13, 4, 'upload/pets/bird/Level-1.png', 1, 0, 1, 0, 0, '2018-10-30 01:48:26', '2018-10-31 01:38:52');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (14, 4, 'upload/pets/dog.png', 2, 2000, 1, 0, 0, '2018-10-30 01:48:32', '2018-10-31 01:41:09');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (15, 4, '', 3, 3000, 1, 0, 0, '2018-10-30 01:48:42', '2018-10-30 01:48:42');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (16, 4, '', 4, 4000, 1, 0, 0, '2018-10-30 01:49:02', '2018-10-30 01:49:02');
INSERT INTO `pet_levels` (`id`, `pet_id`, `image`, `level`, `points`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (17, 1, 'upload/pets/bird/Level-5.png', 5, 5000, 1, 0, 0, '2018-10-30 21:55:50', '2018-10-30 21:55:50');


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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `user_pets` (`id`, `user_id`, `pet_id`, `level`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 2, 3, 2, 1, 0, 0, '2018-10-30 00:10:17', '2018-11-02 21:58:18');
INSERT INTO `user_pets` (`id`, `user_id`, `pet_id`, `level`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 3, 4, 2, 1, 0, 0, '2018-10-30 00:29:15', '2018-11-03 04:12:31');
INSERT INTO `user_pets` (`id`, `user_id`, `pet_id`, `level`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 4, 1, 1, 1, 0, 0, '2018-10-30 02:53:58', '2018-10-31 23:50:10');
INSERT INTO `user_pets` (`id`, `user_id`, `pet_id`, `level`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 5, 4, 1, 1, 0, 0, '2018-10-31 21:35:23', '2018-10-31 21:35:23');
INSERT INTO `user_pets` (`id`, `user_id`, `pet_id`, `level`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (5, 6, 2, 1, 1, 0, 0, '2018-10-31 23:42:52', '2018-10-31 23:42:52');
INSERT INTO `user_pets` (`id`, `user_id`, `pet_id`, `level`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (6, 7, 3, 1, 1, 0, 0, '2018-11-02 04:57:56', '2018-11-02 04:57:56');
INSERT INTO `user_pets` (`id`, `user_id`, `pet_id`, `level`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (7, 8, 2, 1, 1, 0, 0, '2018-11-02 05:15:52', '2018-11-02 05:15:52');
INSERT INTO `user_pets` (`id`, `user_id`, `pet_id`, `level`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (8, 9, 1, 1, 1, 0, 0, '2018-11-08 21:22:03', '2018-11-08 21:22:03');


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
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 2, 500, 'registration bonus points', 1, 0, 0, '2018-10-30 00:10:17', '2018-10-30 00:10:17');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 3, 500, 'registration bonus points', 1, 0, 0, '2018-10-30 00:29:15', '2018-10-30 00:29:15');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (7, 4, 500, 'registration bonus points', 1, 0, 0, '2018-10-30 02:53:58', '2018-10-30 02:53:58');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (8, 4, 100, 'story bonus points', 1, 0, 0, '2018-10-30 03:17:25', '2018-10-30 03:17:25');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (9, 4, 50, 'story bonus points', 1, 0, 0, '2018-10-30 03:17:54', '2018-10-30 03:17:54');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (10, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-10-30 05:30:00', '2018-10-30 05:30:00');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (11, 3, 50, 'story bonus points', 1, 0, 0, '2018-10-31 01:46:31', '2018-10-31 01:46:31');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (12, 5, 500, 'registration bonus points', 1, 0, 0, '2018-10-31 21:35:22', '2018-10-31 21:35:22');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (13, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-10-31 21:43:20', '2018-10-31 21:43:20');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (14, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-10-31 21:43:20', '2018-10-31 21:43:20');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (15, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-10-31 21:44:55', '2018-10-31 21:44:55');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (16, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-10-31 21:44:55', '2018-10-31 21:44:55');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (17, 6, 500, 'registration bonus points', 1, 0, 0, '2018-10-31 23:42:51', '2018-10-31 23:42:51');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (18, 2, 50, 'story bonus points', 1, 0, 0, '2018-11-01 00:11:21', '2018-11-01 00:11:21');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (19, 5, 100, 'story bonus points', 1, 0, 0, '2018-11-01 01:05:44', '2018-11-01 01:05:44');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (20, 5, 50, 'story bonus points', 1, 0, 0, '2018-11-01 02:47:01', '2018-11-01 02:47:01');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (21, 3, 100, 'story bonus points', 1, 0, 0, '2018-11-01 02:58:56', '2018-11-01 02:58:56');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (22, 2, 50, 'story bonus points', 1, 0, 0, '2018-11-01 03:01:54', '2018-11-01 03:01:54');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (23, 3, 50, 'story bonus points', 1, 0, 0, '2018-11-01 08:34:17', '2018-11-01 08:34:17');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (24, 2, 100, 'story bonus points', 1, 0, 0, '2018-11-01 21:19:49', '2018-11-01 21:19:49');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (25, 2, 100, 'story bonus points', 1, 0, 0, '2018-11-01 21:32:46', '2018-11-01 21:32:46');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (26, 3, 50, 'story bonus points', 1, 0, 0, '2018-11-01 22:59:16', '2018-11-01 22:59:16');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (27, 3, 50, 'story bonus points', 1, 0, 0, '2018-11-01 22:59:46', '2018-11-01 22:59:46');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (28, 3, 100, 'story bonus points', 1, 0, 0, '2018-11-01 23:02:53', '2018-11-01 23:02:53');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (29, 2, 50, 'story bonus points', 1, 0, 0, '2018-11-01 23:05:18', '2018-11-01 23:05:18');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (30, 6, 50, 'story bonus points', 1, 0, 0, '2018-11-01 23:13:09', '2018-11-01 23:13:09');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (31, 2, 50, 'story bonus points', 1, 0, 0, '2018-11-01 23:14:04', '2018-11-01 23:14:04');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (32, 2, 50, 'story bonus points', 1, 0, 0, '2018-11-01 23:14:42', '2018-11-01 23:14:42');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (33, 3, 50, 'story bonus points', 1, 0, 0, '2018-11-01 23:15:12', '2018-11-01 23:15:12');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (34, 4, 50, 'story bonus points', 1, 0, 0, '2018-11-01 23:15:26', '2018-11-01 23:15:26');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (35, 2, 50, 'story bonus points', 1, 0, 0, '2018-11-01 23:26:33', '2018-11-01 23:26:33');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (36, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-11-01 23:29:10', '2018-11-01 23:29:10');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (37, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-11-01 23:29:10', '2018-11-01 23:29:10');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (38, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-11-01 23:32:47', '2018-11-01 23:32:47');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (39, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-11-01 23:32:47', '2018-11-01 23:32:47');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (40, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-11-01 23:34:23', '2018-11-01 23:34:23');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (41, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-11-01 23:34:23', '2018-11-01 23:34:23');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (42, 2, 50, 'story bonus points', 1, 0, 0, '2018-11-01 23:35:32', '2018-11-01 23:35:32');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (43, 2, 100, 'story bonus points', 1, 0, 0, '2018-11-02 03:30:47', '2018-11-02 03:30:47');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (44, 7, 500, 'registration bonus points', 1, 0, 0, '2018-11-02 04:57:56', '2018-11-02 04:57:56');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (45, 7, 50, 'story bonus points', 1, 0, 0, '2018-11-02 05:00:02', '2018-11-02 05:00:02');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (46, 7, 50, 'story bonus points', 1, 0, 0, '2018-11-02 05:04:37', '2018-11-02 05:04:37');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (47, 7, 50, 'story comment bonus points', 1, 0, 0, '2018-11-02 05:05:02', '2018-11-02 05:05:02');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (48, 7, 50, 'story comment bonus points', 1, 0, 0, '2018-11-02 05:05:02', '2018-11-02 05:05:02');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (49, 7, 50, 'story comment bonus points', 1, 0, 0, '2018-11-02 05:05:07', '2018-11-02 05:05:07');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (50, 7, 50, 'story comment bonus points', 1, 0, 0, '2018-11-02 05:05:07', '2018-11-02 05:05:07');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (51, 7, 50, 'story comment bonus points', 1, 0, 0, '2018-11-02 05:05:17', '2018-11-02 05:05:17');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (52, 7, 50, 'story comment bonus points', 1, 0, 0, '2018-11-02 05:05:17', '2018-11-02 05:05:17');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (53, 7, 50, 'story comment bonus points', 1, 0, 0, '2018-11-02 05:10:05', '2018-11-02 05:10:05');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (54, 7, 50, 'story comment bonus points', 1, 0, 0, '2018-11-02 05:10:05', '2018-11-02 05:10:05');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (55, 8, 500, 'registration bonus points', 1, 0, 0, '2018-11-02 05:15:52', '2018-11-02 05:15:52');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (56, 3, 50, 'story bonus points', 1, 0, 0, '2018-11-02 06:37:49', '2018-11-02 06:37:49');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (57, 3, 50, 'story bonus points', 1, 0, 0, '2018-11-02 06:38:05', '2018-11-02 06:38:05');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (58, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-11-02 21:30:22', '2018-11-02 21:30:22');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (59, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-11-02 21:30:22', '2018-11-02 21:30:22');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (60, 7, 50, 'story bonus points', 1, 0, 0, '2018-11-02 21:34:57', '2018-11-02 21:34:57');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (61, 7, 50, 'story comment bonus points', 1, 0, 0, '2018-11-02 21:37:50', '2018-11-02 21:37:50');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (62, 7, 50, 'story comment bonus points', 1, 0, 0, '2018-11-02 21:37:50', '2018-11-02 21:37:50');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (63, 7, 50, 'story bonus points', 1, 0, 0, '2018-11-02 21:39:08', '2018-11-02 21:39:08');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (64, 7, 100, 'story bonus points', 1, 0, 0, '2018-11-02 21:45:29', '2018-11-02 21:45:29');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (65, 2, 50, 'story bonus points', 1, 0, 0, '2018-11-02 21:48:34', '2018-11-02 21:48:34');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (66, 2, 50, 'story bonus points', 1, 0, 0, '2018-11-02 21:50:47', '2018-11-02 21:50:47');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (67, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-11-02 21:51:04', '2018-11-02 21:51:04');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (68, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-11-02 21:51:04', '2018-11-02 21:51:04');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (69, 2, -2000, 'redeem points for pet upgrade', 1, 0, 0, '2018-11-02 21:58:18', '2018-11-02 21:58:18');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (70, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 03:02:48', '2018-11-03 03:02:48');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (71, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 03:02:48', '2018-11-03 03:02:48');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (72, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:11:13', '2018-11-03 04:11:13');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (73, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:11:13', '2018-11-03 04:11:13');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (74, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:11:25', '2018-11-03 04:11:25');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (75, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:11:25', '2018-11-03 04:11:25');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (76, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:11:34', '2018-11-03 04:11:34');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (77, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:11:34', '2018-11-03 04:11:34');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (78, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:11:49', '2018-11-03 04:11:49');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (79, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:11:49', '2018-11-03 04:11:49');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (80, 3, 50, 'story bonus points', 1, 0, 0, '2018-11-03 04:11:54', '2018-11-03 04:11:54');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (81, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:11:59', '2018-11-03 04:11:59');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (82, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:11:59', '2018-11-03 04:11:59');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (83, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:12:13', '2018-11-03 04:12:13');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (84, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:12:13', '2018-11-03 04:12:13');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (85, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:12:17', '2018-11-03 04:12:17');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (86, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:12:17', '2018-11-03 04:12:17');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (87, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:12:23', '2018-11-03 04:12:23');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (88, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:12:23', '2018-11-03 04:12:23');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (89, 3, -2000, 'redeem points for pet upgrade', 1, 0, 0, '2018-11-03 04:12:31', '2018-11-03 04:12:31');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (90, 2, 100, 'story bonus points', 1, 0, 0, '2018-11-03 04:16:47', '2018-11-03 04:16:47');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (91, 2, 50, 'story bonus points', 1, 0, 0, '2018-11-03 04:17:30', '2018-11-03 04:17:30');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (92, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:17:40', '2018-11-03 04:17:40');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (93, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 04:17:40', '2018-11-03 04:17:40');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (94, 7, 50, 'story bonus points', 1, 0, 0, '2018-11-03 04:31:18', '2018-11-03 04:31:18');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (95, 7, 100, 'story bonus points', 1, 0, 0, '2018-11-03 04:32:28', '2018-11-03 04:32:28');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (96, 7, 50, 'story bonus points', 1, 0, 0, '2018-11-03 04:32:54', '2018-11-03 04:32:54');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (97, 3, 50, 'story bonus points', 1, 0, 0, '2018-11-03 04:57:11', '2018-11-03 04:57:11');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (98, 3, 100, 'story bonus points', 1, 0, 0, '2018-11-03 05:28:31', '2018-11-03 05:28:31');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (99, 2, 100, 'story bonus points', 1, 0, 0, '2018-11-03 05:28:42', '2018-11-03 05:28:42');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (100, 3, 50, 'story bonus points', 1, 0, 0, '2018-11-03 05:36:09', '2018-11-03 05:36:09');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (101, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 05:36:52', '2018-11-03 05:36:52');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (102, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 05:36:52', '2018-11-03 05:36:52');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (103, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 05:37:35', '2018-11-03 05:37:35');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (104, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 05:37:35', '2018-11-03 05:37:35');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (105, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 05:37:53', '2018-11-03 05:37:53');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (106, 3, 50, 'story comment bonus points', 1, 0, 0, '2018-11-03 05:37:53', '2018-11-03 05:37:53');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (107, 5, 100, 'story bonus points', 1, 0, 0, '2018-11-03 09:50:50', '2018-11-03 09:50:50');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (108, 2, 50, 'story bonus points', 1, 0, 0, '2018-11-03 20:23:09', '2018-11-03 20:23:09');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (109, 2, 50, 'story bonus points', 1, 0, 0, '2018-11-03 20:23:35', '2018-11-03 20:23:35');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (110, 5, 50, 'story bonus points', 1, 0, 0, '2018-11-04 19:24:32', '2018-11-04 19:24:32');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (111, 5, 50, 'story comment bonus points', 1, 0, 0, '2018-11-04 19:48:23', '2018-11-04 19:48:23');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (112, 5, 50, 'story comment bonus points', 1, 0, 0, '2018-11-04 19:48:23', '2018-11-04 19:48:23');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (113, 5, 50, 'story bonus points', 1, 0, 0, '2018-11-04 19:48:28', '2018-11-04 19:48:28');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (114, 5, 50, 'story comment bonus points', 1, 0, 0, '2018-11-04 19:49:25', '2018-11-04 19:49:25');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (115, 5, 50, 'story comment bonus points', 1, 0, 0, '2018-11-04 19:49:25', '2018-11-04 19:49:25');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (116, 2, 50, 'story bonus points', 1, 0, 0, '2018-11-04 21:23:36', '2018-11-04 21:23:36');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (117, 5, 100, 'story bonus points', 1, 0, 0, '2018-11-05 06:37:42', '2018-11-05 06:37:42');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (118, 2, 100, 'story bonus points', 1, 0, 0, '2018-11-05 06:40:58', '2018-11-05 06:40:58');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (119, 2, 50, 'story bonus points', 1, 0, 0, '2018-11-05 21:16:55', '2018-11-05 21:16:55');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (120, 2, 50, 'story bonus points', 1, 0, 0, '2018-11-06 02:15:40', '2018-11-06 02:15:40');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (121, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-11-06 02:15:58', '2018-11-06 02:15:58');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (122, 2, 50, 'story comment bonus points', 1, 0, 0, '2018-11-06 02:15:58', '2018-11-06 02:15:58');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (123, 5, 50, 'story bonus points', 1, 0, 0, '2018-11-06 07:59:08', '2018-11-06 07:59:08');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (124, 5, 100, 'story bonus points', 1, 0, 0, '2018-11-07 04:56:03', '2018-11-07 04:56:03');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (125, 5, 100, 'story bonus points', 1, 0, 0, '2018-11-07 05:25:17', '2018-11-07 05:25:17');
INSERT INTO `user_pet_points` (`id`, `user_id`, `points`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (126, 9, 500, 'registration bonus points', 1, 0, 0, '2018-11-08 21:22:03', '2018-11-08 21:22:03');


SET foreign_key_checks = 1;
