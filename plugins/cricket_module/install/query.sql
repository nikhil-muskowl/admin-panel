SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: cricket_battings
#

DROP TABLE IF EXISTS `cricket_battings`;

CREATE TABLE `cricket_battings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `match_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `run` int(11) NOT NULL,
  `ball` int(11) NOT NULL,
  `fours` int(11) NOT NULL,
  `sixs` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `match_id` (`match_id`),
  KEY `team_id` (`team_id`),
  KEY `player_id` (`player_id`),
  CONSTRAINT `cricket_battings_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `cricket_matches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cricket_battings_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `cricket_teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cricket_battings_ibfk_3` FOREIGN KEY (`player_id`) REFERENCES `cricket_players` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `cricket_battings` (`id`, `match_id`, `team_id`, `player_id`, `run`, `ball`, `fours`, `sixs`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 1, 1, 10, 10, 10, 10, 1, 0, 0, '2018-07-11 15:11:33', '2018-07-11 15:11:33');


#
# TABLE STRUCTURE FOR: cricket_bowllings
#

DROP TABLE IF EXISTS `cricket_bowllings`;

CREATE TABLE `cricket_bowllings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `match_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `over` decimal(1,1) NOT NULL,
  `maiden` int(11) NOT NULL,
  `run` int(11) NOT NULL,
  `wicket` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `match_id` (`match_id`),
  KEY `team_id` (`team_id`),
  KEY `player_id` (`player_id`),
  CONSTRAINT `cricket_bowllings_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `cricket_matches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cricket_bowllings_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `cricket_teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cricket_bowllings_ibfk_3` FOREIGN KEY (`player_id`) REFERENCES `cricket_players` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `cricket_bowllings` (`id`, `match_id`, `team_id`, `player_id`, `over`, `maiden`, `run`, `wicket`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 1, 1, '0.9', 10, 10, 10, 1, 0, 0, '2018-07-11 15:11:20', '2018-07-11 15:11:20');


#
# TABLE STRUCTURE FOR: cricket_batting_types
#

DROP TABLE IF EXISTS `cricket_batting_types`;

CREATE TABLE `cricket_batting_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `cricket_batting_types` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 'Right Handed Bat', 1, 0, 0, '2018-07-27 11:24:24', '2018-07-27 00:07:08');
INSERT INTO `cricket_batting_types` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 'Left Handed Bat', 1, 0, 0, '2018-07-27 11:24:52', '2018-07-27 00:07:17');


#
# TABLE STRUCTURE FOR: cricket_bowlling_types
#

DROP TABLE IF EXISTS `cricket_bowlling_types`;

CREATE TABLE `cricket_bowlling_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO `cricket_bowlling_types` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 'Right-arm fast', 1, 0, 0, '2018-07-27 11:25:54', '2018-07-27 00:16:38');
INSERT INTO `cricket_bowlling_types` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 'Right-arm fast medium', 1, 0, 0, '2018-07-27 11:26:00', '2018-07-27 00:16:46');
INSERT INTO `cricket_bowlling_types` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 'Right-arm medium fast', 1, 0, 0, '2018-07-27 00:16:52', '2018-07-27 00:16:52');
INSERT INTO `cricket_bowlling_types` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 'Right-arm medium', 1, 0, 0, '2018-07-27 00:16:59', '2018-07-27 00:16:59');
INSERT INTO `cricket_bowlling_types` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (5, 'Left-arm fast', 1, 0, 0, '2018-07-27 00:17:10', '2018-07-27 00:17:10');
INSERT INTO `cricket_bowlling_types` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (6, 'Left-arm fast medium', 1, 0, 0, '2018-07-27 00:17:30', '2018-07-27 00:17:30');
INSERT INTO `cricket_bowlling_types` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (7, 'Left-arm medium fast', 1, 0, 0, '2018-07-27 00:17:39', '2018-07-27 00:17:39');
INSERT INTO `cricket_bowlling_types` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (8, 'Left-arm medium', 1, 0, 0, '2018-07-27 00:17:47', '2018-07-27 00:17:47');
INSERT INTO `cricket_bowlling_types` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (9, 'Right-arm Off Break', 1, 0, 0, '2018-07-27 00:18:19', '2018-07-27 00:18:19');
INSERT INTO `cricket_bowlling_types` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (10, 'Right-arm Leg Break', 1, 0, 0, '2018-07-27 00:18:37', '2018-07-27 00:18:37');
INSERT INTO `cricket_bowlling_types` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (11, 'Left-arm Off Break', 1, 0, 0, '2018-07-27 00:18:57', '2018-07-27 00:18:57');
INSERT INTO `cricket_bowlling_types` (`id`, `name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (12, 'Left-arm Leg Break', 1, 0, 0, '2018-07-27 00:19:06', '2018-07-27 00:19:06');


#
# TABLE STRUCTURE FOR: cricket_matches
#

DROP TABLE IF EXISTS `cricket_matches`;

CREATE TABLE `cricket_matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `image` text NOT NULL,
  `banner` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `latitude` decimal(6,6) NOT NULL,
  `longitude` decimal(6,6) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `cricket_matches` (`id`, `name`, `description`, `start_date`, `end_date`, `image`, `banner`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 'match 1', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 1, '0.000000', '0.000000', 0, 0, '2018-07-11 12:55:44', '2018-07-11 12:55:44');


#
# TABLE STRUCTURE FOR: cricket_players
#

DROP TABLE IF EXISTS `cricket_players`;

CREATE TABLE `cricket_players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `bowlling_type_id` int(11) NOT NULL,
  `batting_type_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `points` decimal(15,6) NOT NULL,
  `image` text NOT NULL,
  `banner` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 0, 2, 1, 1, 'Aryan Chanal', '', '10.000000', '', '', 1, 0, 0, '2018-07-11 14:57:46', '2018-07-26 23:48:40');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 0, 2, 1, 1, 'Aniket Sharma', '', '10.000000', '', '', 1, 0, 0, '2018-07-23 12:05:43', '2018-07-26 23:46:58');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 0, 2, 2, 2, 'Aditya Singh Chouhan', '', '10.000000', '', '', 1, 0, 0, '2018-07-24 13:06:58', '2018-07-26 23:47:15');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (5, 0, 2, 1, 1, 'Aryan Chandra', '', '10.000000', '', '', 1, 0, 0, '2018-07-25 11:30:19', '2018-07-26 23:49:04');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (6, 6, 2, 1, 1, 'Aditya Pratap Singh Chauhan', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:06:13', '2018-07-31 10:02:40');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (7, 0, 2, 1, 1, 'Aryan Prakash', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:08:22', '2018-07-27 00:13:10');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (8, 0, 2, 1, 1, 'Ashutosh Agrawal', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:09:54', '2018-07-27 00:09:54');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (9, 0, 2, 2, 2, 'Avinash Kalal', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:14:26', '2018-07-27 00:14:26');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (10, 0, 2, 2, 1, 'Bhavin Gaur', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:15:14', '2018-07-27 00:15:28');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (11, 0, 2, 1, 1, 'Divij Sukhwani', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:16:42', '2018-07-27 00:16:42');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (12, 0, 2, 2, 2, 'Divyansh Dabi', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:18:19', '2018-07-27 00:18:19');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (13, 0, 2, 9, 2, 'Gitansh Mata', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:19:12', '2018-07-27 00:19:12');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (14, 0, 2, 12, 2, 'Harsh Jain', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:19:45', '2018-07-27 00:19:45');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (15, 0, 2, 12, 2, 'Harshal Jain', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:20:20', '2018-07-27 00:20:20');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (16, 0, 2, 12, 2, 'Harshit Dak', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:21:14', '2018-07-27 00:23:37');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (17, 0, 2, 12, 2, 'Harshit Dewedi', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:21:53', '2018-07-27 00:21:53');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (18, 0, 2, 12, 2, 'Harshpreet Singh', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:23:13', '2018-07-27 00:23:13');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (19, 0, 2, 12, 2, 'Harshvardhan Singh Chouhan', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:24:42', '2018-07-27 00:24:42');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (20, 0, 2, 12, 2, 'Hitesh Dangi', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:25:14', '2018-07-27 00:25:14');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (21, 0, 2, 12, 2, 'Hukm Singh Kumbhawat', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:26:28', '2018-07-27 00:26:28');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (22, 0, 2, 12, 2, 'Jinendra Dhaka', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:27:10', '2018-07-27 00:27:10');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (23, 0, 2, 12, 2, 'Karan Singh Ranawat', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:27:59', '2018-07-27 00:27:59');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (24, 0, 2, 12, 2, 'Kartik Kapoor', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:28:39', '2018-07-27 00:28:39');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (25, 0, 2, 12, 2, 'Ketan Sharma', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:29:17', '2018-07-27 00:29:17');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (26, 0, 2, 12, 2, 'Kinchuk Bhati', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:30:03', '2018-07-27 00:30:03');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (27, 0, 2, 12, 2, 'Lakshya Raj Singh Rajpoot', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:31:04', '2018-07-27 00:31:04');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (28, 0, 2, 12, 2, 'Lovisj Jain', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:31:43', '2018-07-27 00:31:43');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (29, 0, 2, 12, 2, 'Mahendra Choudhary', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:32:14', '2018-07-27 00:32:14');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (30, 0, 2, 12, 2, 'Malay Sharma', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:32:43', '2018-07-27 00:32:43');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (31, 0, 2, 12, 2, 'Mohit Bhardwaj', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 00:33:04', '2018-07-27 00:33:04');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (32, 0, 2, 12, 2, 'Mukesh Mali', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:08:05', '2018-07-27 01:08:05');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (33, 0, 2, 12, 2, 'Nakul Choudhary', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:08:26', '2018-07-27 01:08:26');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (34, 0, 2, 12, 2, 'Naman Joshi', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:08:42', '2018-07-27 01:14:47');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (35, 0, 2, 12, 2, 'Nilay Mantri', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:08:57', '2018-07-27 01:15:02');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (36, 0, 2, 12, 2, 'Parmveer Doshi', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:09:13', '2018-07-27 01:15:20');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (37, 0, 2, 12, 2, 'Pravar Bhardwaj', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:09:30', '2018-07-27 01:14:18');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (38, 0, 2, 12, 2, 'Prince Sharma', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:09:53', '2018-07-27 01:14:05');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (39, 0, 2, 12, 2, 'Pushpendra Singh', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:10:11', '2018-07-27 01:13:54');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (40, 0, 2, 12, 2, 'Rahul Chandel', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:10:24', '2018-07-27 01:13:44');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (41, 0, 2, 12, 2, 'Ravindra Singh', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:10:40', '2018-07-27 01:13:30');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (42, 0, 2, 12, 2, 'Ritik Audichya', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:11:01', '2018-07-27 01:13:20');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (43, 0, 2, 12, 2, 'Sohil Lodhi', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:11:15', '2018-07-27 01:13:12');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (44, 0, 2, 12, 2, 'Sunit Jat', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:11:32', '2018-07-27 01:13:02');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (45, 0, 2, 12, 2, 'Vashisth Raj Singh', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:11:44', '2018-07-27 01:12:52');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (46, 0, 2, 12, 2, 'Vishvjeet Singh', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:11:56', '2018-07-27 01:12:39');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (47, 0, 2, 12, 2, 'Yash Kothri', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:12:08', '2018-07-27 01:12:23');
INSERT INTO `cricket_players` (`id`, `team_id`, `type_id`, `bowlling_type_id`, `batting_type_id`, `name`, `description`, `points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (48, 0, 3, 12, 2, 'Anirudh Singh Chouhan', '', '10.000000', '', '', 1, 0, 0, '2018-07-27 01:49:44', '2018-07-27 01:49:44');


#
# TABLE STRUCTURE FOR: cricket_player_levels
#

DROP TABLE IF EXISTS `cricket_player_levels`;

CREATE TABLE `cricket_player_levels` (
  `player_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  KEY `team_id` (`player_id`),
  KEY `role_id` (`level_id`),
  CONSTRAINT `cricket_player_levels_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `cricket_tournament_levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cricket_player_levels_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `cricket_players` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `cricket_player_levels` (`player_id`, `level_id`) VALUES (1, 2);
INSERT INTO `cricket_player_levels` (`player_id`, `level_id`) VALUES (5, 1);
INSERT INTO `cricket_player_levels` (`player_id`, `level_id`) VALUES (5, 2);
INSERT INTO `cricket_player_levels` (`player_id`, `level_id`) VALUES (7, 1);
INSERT INTO `cricket_player_levels` (`player_id`, `level_id`) VALUES (7, 2);


#
# TABLE STRUCTURE FOR: cricket_player_roles
#

DROP TABLE IF EXISTS `cricket_player_roles`;

CREATE TABLE `cricket_player_roles` (
  `player_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  KEY `team_id` (`player_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `cricket_player_roles_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `cricket_players` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cricket_player_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `cricket_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (1, 1);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (5, 5);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (7, 2);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (10, 2);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (11, 2);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (12, 3);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (12, 1);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (13, 2);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (17, 2);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (18, 1);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (2, 2);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (16, 2);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (20, 1);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (22, 1);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (23, 5);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (24, 1);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (25, 5);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (26, 5);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (27, 1);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (28, 5);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (29, 5);
INSERT INTO `cricket_player_roles` (`player_id`, `role_id`) VALUES (30, 1);


#
# TABLE STRUCTURE FOR: cricket_roles
#

DROP TABLE IF EXISTS `cricket_roles`;

CREATE TABLE `cricket_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `short_name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `cricket_roles` (`id`, `name`, `short_name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 'Batsman', 'BTM', 1, 0, 0, '2018-07-11 12:05:54', '2018-07-26 23:38:30');
INSERT INTO `cricket_roles` (`id`, `name`, `short_name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 'Bowler', 'BWL', 1, 0, 0, '2018-07-11 12:05:54', '2018-07-26 23:38:37');
INSERT INTO `cricket_roles` (`id`, `name`, `short_name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 'Wicket Keeper', 'WK', 1, 0, 0, '2018-07-11 12:06:21', '2018-07-26 23:38:59');
INSERT INTO `cricket_roles` (`id`, `name`, `short_name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 'Captain ', 'C', 1, 0, 0, '2018-07-11 12:06:56', '2018-07-26 23:39:06');
INSERT INTO `cricket_roles` (`id`, `name`, `short_name`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (5, 'All Rounder', 'AR', 1, 0, 0, '2018-07-11 12:10:00', '2018-07-26 23:38:45');


#
# TABLE STRUCTURE FOR: cricket_teams
#

DROP TABLE IF EXISTS `cricket_teams`;

CREATE TABLE `cricket_teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `points` decimal(15,6) NOT NULL,
  `remaining_points` decimal(15,6) NOT NULL,
  `image` text NOT NULL,
  `banner` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `cricket_teams` (`id`, `name`, `description`, `points`, `remaining_points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 'Pacific', '', '80.000000', '80.000000', 'upload/images/08c36d761dc3ef60fdead45ca8e07e0a.jpg', '', 1, 0, 0, '2018-07-11 12:12:36', '2018-07-26 23:52:14');
INSERT INTO `cricket_teams` (`id`, `name`, `description`, `points`, `remaining_points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 'Sojatiya', '', '80.000000', '80.000000', '', '', 1, 0, 0, '2018-07-11 12:12:36', '2018-07-26 23:54:07');
INSERT INTO `cricket_teams` (`id`, `name`, `description`, `points`, `remaining_points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 'Shaho', '', '80.000000', '80.000000', '', '', 1, 0, 0, '2018-07-25 11:54:35', '2018-07-25 11:54:35');
INSERT INTO `cricket_teams` (`id`, `name`, `description`, `points`, `remaining_points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 'MoJo Jojo', '', '80.000000', '80.000000', '', '', 1, 0, 0, '2018-07-25 11:54:58', '2018-07-25 11:54:58');
INSERT INTO `cricket_teams` (`id`, `name`, `description`, `points`, `remaining_points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (5, 'Power Arraow', '', '80.000000', '80.000000', '', '', 1, 0, 0, '2018-07-25 11:55:08', '2018-07-25 11:55:08');
INSERT INTO `cricket_teams` (`id`, `name`, `description`, `points`, `remaining_points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (6, 'AAAA', '', '80.000000', '70.000000', '', '', 1, 0, 0, '2018-07-26 14:17:41', '2018-07-31 10:02:40');
INSERT INTO `cricket_teams` (`id`, `name`, `description`, `points`, `remaining_points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (7, 'bbb', '', '80.000000', '80.000000', '', '', 1, 0, 0, '2018-07-26 14:17:41', '2018-07-26 14:17:41');
INSERT INTO `cricket_teams` (`id`, `name`, `description`, `points`, `remaining_points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (8, 'ccc', '', '80.000000', '80.000000', '', '', 1, 0, 0, '2018-07-26 14:17:41', '2018-07-26 14:17:41');
INSERT INTO `cricket_teams` (`id`, `name`, `description`, `points`, `remaining_points`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (9, 'ddd', '', '80.000000', '80.000000', '', '', 1, 0, 0, '2018-07-26 14:17:41', '2018-07-26 14:17:41');


#
# TABLE STRUCTURE FOR: cricket_team_matches
#

DROP TABLE IF EXISTS `cricket_team_matches`;

CREATE TABLE `cricket_team_matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `match_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`),
  KEY `match_id` (`match_id`),
  CONSTRAINT `cricket_team_matches_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `cricket_teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cricket_team_matches_ibfk_2` FOREIGN KEY (`match_id`) REFERENCES `cricket_matches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `cricket_team_matches` (`id`, `match_id`, `team_id`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 1, '', 1, 0, 0, '2018-07-11 15:01:00', '2018-07-11 15:01:00');
INSERT INTO `cricket_team_matches` (`id`, `match_id`, `team_id`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 1, 2, '', 1, 0, 0, '2018-07-11 15:01:00', '2018-07-11 15:01:00');


#
# TABLE STRUCTURE FOR: cricket_team_points
#

DROP TABLE IF EXISTS `cricket_team_points`;

CREATE TABLE `cricket_team_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `points` decimal(15,6) NOT NULL,
  `approved_status` enum('P','A','C','R') NOT NULL DEFAULT 'P',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`),
  KEY `player_id` (`player_id`),
  CONSTRAINT `cricket_team_points_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `cricket_teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cricket_team_points_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `cricket_players` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `cricket_team_points` (`id`, `team_id`, `player_id`, `description`, `points`, `approved_status`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 6, 6, '', '10.000000', 'A', 1, 0, 0, '2018-07-31 10:02:37', '2018-07-31 10:02:40');


#
# TABLE STRUCTURE FOR: cricket_tournament_levels
#

DROP TABLE IF EXISTS `cricket_tournament_levels`;

CREATE TABLE `cricket_tournament_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `cricket_tournament_levels` (`id`, `name`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 'District Level', '', 1, 0, 0, '2018-07-24 15:27:46', '2018-07-24 15:27:46');
INSERT INTO `cricket_tournament_levels` (`id`, `name`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 'State Level', '', 1, 0, 0, '2018-07-24 15:27:46', '2018-07-24 15:27:46');


#
# TABLE STRUCTURE FOR: cricket_tournament_types
#

DROP TABLE IF EXISTS `cricket_tournament_types`;

CREATE TABLE `cricket_tournament_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `cricket_tournament_types` (`id`, `name`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 'U-14', 'Under 14', 1, 0, 0, '2018-07-24 15:28:10', '2018-07-24 15:35:42');
INSERT INTO `cricket_tournament_types` (`id`, `name`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 'U-16', 'Under 16', 1, 0, 0, '2018-07-24 15:28:10', '2018-07-24 15:35:51');
INSERT INTO `cricket_tournament_types` (`id`, `name`, `description`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 'U-19', 'Under 19', 1, 0, 0, '2018-07-24 15:28:17', '2018-07-24 15:35:28');


SET foreign_key_checks = 1;
