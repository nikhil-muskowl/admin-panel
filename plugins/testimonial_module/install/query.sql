SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: testimonials
#

DROP TABLE IF EXISTS `testimonials`;

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` text NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `language_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `testimonials_ibfk_1` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `testimonials` (`id`, `author`, `role`, `image`, `text`, `language_id`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 'nadim', 'developer', 'upload/images/0c90f50a999505679ff15dc9926da398.jpg', 'hiii', 1, 1, '', '', 0, 0, '2018-10-24 11:02:04', '2018-10-24 11:04:25');
INSERT INTO `testimonials` (`id`, `author`, `role`, `image`, `text`, `language_id`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 'dd', 'dd', '', 'dd', 2, 1, '', '', 0, 0, '2018-10-24 11:53:08', '2018-10-24 11:53:08');


SET foreign_key_checks = 1;
