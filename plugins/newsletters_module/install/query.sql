SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: newsletters
#

DROP TABLE IF EXISTS `newsletters`;

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(120) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `subscribe` tinyint(1) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `newsletters` (`id`, `name`, `email`, `contact`, `subscribe`, `status`, `created_date`, `modified_date`) VALUES (1, 'nadim', 'nadim.sheikh.07@gmail.com', '7737033665', 1, 1, '2018-11-17 14:39:43', '2018-11-17 14:39:43');
INSERT INTO `newsletters` (`id`, `name`, `email`, `contact`, `subscribe`, `status`, `created_date`, `modified_date`) VALUES (2, 'rajesh', 'rajesh.muskowl@gmail.com', '123456', 1, 1, '2018-11-17 14:39:43', '2018-11-17 14:39:43');


#
# TABLE STRUCTURE FOR: newsletter_mails
#

DROP TABLE IF EXISTS `newsletter_mails`;

CREATE TABLE `newsletter_mails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(120) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `type_value` text NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `newsletter_mails` (`id`, `title`, `name`, `email`, `contact`, `type`, `type_value`, `subject`, `text`, `html`, `status`, `created_date`, `modified_date`) VALUES (2, 'test', 'muskowl', 'info@muskowl.com', '7737033665', '', '', 'test', 'test', 'test', 1, '2018-11-17 15:09:29', '2018-11-17 15:09:29');


#
# TABLE STRUCTURE FOR: newsletter_mail_trackers
#

DROP TABLE IF EXISTS `newsletter_mail_trackers`;

CREATE TABLE `newsletter_mail_trackers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(120) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `to_email` varchar(120) NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_status` varchar(10) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `newsletter_mail_trackers` (`id`, `title`, `name`, `email`, `contact`, `to_email`, `subject`, `text`, `html`, `email_status`, `status`, `created_date`, `modified_date`) VALUES (1, 'test', 'nadim', 'info@muskowl.com', '7737033665', 'nadim.sheikh.07@gmail.com', 'test', 'test', 'test', 'Failed', 1, '2018-11-19 10:11:18', '2018-11-19 10:11:18');
INSERT INTO `newsletter_mail_trackers` (`id`, `title`, `name`, `email`, `contact`, `to_email`, `subject`, `text`, `html`, `email_status`, `status`, `created_date`, `modified_date`) VALUES (2, 'test', 'rajesh', 'info@muskowl.com', '7737033665', 'rajesh.muskowl@gmail.com', 'test', 'test', 'test', 'Failed', 1, '2018-11-19 10:11:19', '2018-11-19 10:11:19');


SET foreign_key_checks = 1;
