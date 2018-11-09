SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: attributes
#

DROP TABLE IF EXISTS `attributes`;

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `attributes_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `attribute_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `attributes` (`id`, `group_id`, `status`, `sort_order`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 2, 1, 0, 0, 0, '2018-09-18 11:06:55', '2018-09-18 11:06:55');
INSERT INTO `attributes` (`id`, `group_id`, `status`, `sort_order`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 1, 1, 0, 0, 0, '2018-09-19 17:14:33', '2018-09-19 17:14:33');


#
# TABLE STRUCTURE FOR: attribute_details
#

DROP TABLE IF EXISTS `attribute_details`;

CREATE TABLE `attribute_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `attribute_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `attribute_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `attribute_details` (`id`, `language_id`, `title`) VALUES (1, 1, 'a');
INSERT INTO `attribute_details` (`id`, `language_id`, `title`) VALUES (1, 2, 'a');
INSERT INTO `attribute_details` (`id`, `language_id`, `title`) VALUES (2, 1, 'aa');
INSERT INTO `attribute_details` (`id`, `language_id`, `title`) VALUES (2, 2, 'aa');


#
# TABLE STRUCTURE FOR: attribute_groups
#

DROP TABLE IF EXISTS `attribute_groups`;

CREATE TABLE `attribute_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `attribute_groups` (`id`, `status`, `sort_order`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 1, 0, 0, '2018-09-18 10:51:33', '2018-09-18 10:53:07');
INSERT INTO `attribute_groups` (`id`, `status`, `sort_order`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 1, 0, 0, 0, '2018-09-18 10:54:52', '2018-09-18 10:54:52');


#
# TABLE STRUCTURE FOR: attribute_group_details
#

DROP TABLE IF EXISTS `attribute_group_details`;

CREATE TABLE `attribute_group_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `attribute_group_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `attribute_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `attribute_group_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `attribute_group_details` (`id`, `language_id`, `title`) VALUES (1, 1, 'memory');
INSERT INTO `attribute_group_details` (`id`, `language_id`, `title`) VALUES (1, 2, 'memory');
INSERT INTO `attribute_group_details` (`id`, `language_id`, `title`) VALUES (2, 1, 'ffoof');
INSERT INTO `attribute_group_details` (`id`, `language_id`, `title`) VALUES (2, 2, 'ffoof');


#
# TABLE STRUCTURE FOR: categories
#

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `banner` text NOT NULL,
  `in_menu` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `categories` (`id`, `parent_id`, `image`, `banner`, `in_menu`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 0, '', '', 1, 1, 0, 0, '2018-08-10 17:13:38', '2018-09-24 14:21:33');
INSERT INTO `categories` (`id`, `parent_id`, `image`, `banner`, `in_menu`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 0, '', '', 1, 1, 0, 0, '2018-09-10 15:46:54', '2018-09-24 14:21:38');
INSERT INTO `categories` (`id`, `parent_id`, `image`, `banner`, `in_menu`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 2, '', '', 1, 1, 0, 0, '2018-09-10 15:47:06', '2018-09-24 14:50:39');
INSERT INTO `categories` (`id`, `parent_id`, `image`, `banner`, `in_menu`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 3, '', '', 1, 1, 0, 0, '2018-09-15 11:35:29', '2018-09-24 14:21:38');


#
# TABLE STRUCTURE FOR: category_details
#

DROP TABLE IF EXISTS `category_details`;

CREATE TABLE `category_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `category_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `category_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `category_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 1, 'food', '', '');
INSERT INTO `category_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 2, 'भोजन', '', '');
INSERT INTO `category_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 1, 'tarvels', '', '');
INSERT INTO `category_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 2, 'tarvels', '', '');
INSERT INTO `category_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (3, 1, 'POS', '', '');
INSERT INTO `category_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (3, 2, 'POS', '', '');
INSERT INTO `category_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (4, 1, 'carte', '', '<br data-mce-bogus=\"1\">');
INSERT INTO `category_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (4, 2, 'cate', '', '<br data-mce-bogus=\"1\">');


#
# TABLE STRUCTURE FOR: products
#

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(15,6) NOT NULL,
  `quantity` decimal(15,6) NOT NULL,
  `image` text NOT NULL,
  `banner` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `products` (`id`, `price`, `quantity`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, '100.000000', '100.000000', 'upload/images/c215b6df0959ca52126bbb5c78ad4c7d.jpg', 'upload/images/0c90f50a999505679ff15dc9926da398.jpg', 1, 0, 0, '2018-08-11 10:27:56', '2018-08-11 12:49:35');
INSERT INTO `products` (`id`, `price`, `quantity`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, '200.000000', '200.000000', 'upload/images/e2e34dcaa293b21b43ab86116dc4349a.jpg', '', 1, 0, 0, '2018-08-11 12:41:16', '2018-08-11 12:49:45');


#
# TABLE STRUCTURE FOR: product_attributes
#

DROP TABLE IF EXISTS `product_attributes`;

CREATE TABLE `product_attributes` (
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`product_id`,`attribute_id`,`language_id`),
  KEY `language_id` (`language_id`),
  KEY `attribute_id` (`attribute_id`),
  CONSTRAINT `product_attributes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_attributes_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_attributes_ibfk_3` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `product_attributes` (`product_id`, `attribute_id`, `language_id`, `text`) VALUES (1, 1, 1, 'e');
INSERT INTO `product_attributes` (`product_id`, `attribute_id`, `language_id`, `text`) VALUES (1, 1, 2, 'h');


#
# TABLE STRUCTURE FOR: product_carts
#

DROP TABLE IF EXISTS `product_carts`;

CREATE TABLE `product_carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` decimal(15,8) NOT NULL,
  `options` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`product_id`,`user_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `product_carts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `product_carts` (`id`, `token`, `product_id`, `user_id`, `quantity`, `options`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, '1', 1, 0, '1.00000000', '', 1, 0, 0, '2018-09-24 10:21:00', '2018-09-24 10:21:11');


#
# TABLE STRUCTURE FOR: product_details
#

DROP TABLE IF EXISTS `product_details`;

CREATE TABLE `product_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `product_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 1, 'aaaa', '', '<br>');
INSERT INTO `product_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (1, 2, 'hhh', '', '<br>');
INSERT INTO `product_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 1, 'bbb', '', '');
INSERT INTO `product_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES (2, 2, 'bbb', '', '');


#
# TABLE STRUCTURE FOR: product_images
#

DROP TABLE IF EXISTS `product_images`;

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `link` text NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `blog_id` (`product_id`),
  CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO `product_images` (`id`, `product_id`, `image`, `link`, `sort_order`, `status`) VALUES (22, 1, 'upload/images/e2e34dcaa293b21b43ab86116dc4349a.jpg', '', 0, 1);


#
# TABLE STRUCTURE FOR: product_ratings
#

DROP TABLE IF EXISTS `product_ratings`;

CREATE TABLE `product_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `product_ratings` (`id`, `value`, `status`, `sort_order`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 1, 0, 0, 0, '2018-10-04 16:25:03', '2018-10-04 16:33:15');
INSERT INTO `product_ratings` (`id`, `value`, `status`, `sort_order`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 2, 1, 0, 0, 0, '2018-10-04 16:25:52', '2018-10-04 16:33:18');
INSERT INTO `product_ratings` (`id`, `value`, `status`, `sort_order`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 3, 1, 0, 0, 0, '2018-10-04 16:22:40', '2018-10-04 16:33:21');
INSERT INTO `product_ratings` (`id`, `value`, `status`, `sort_order`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (4, 4, 1, 0, 0, 0, '2018-10-04 16:22:52', '2018-10-04 16:33:26');
INSERT INTO `product_ratings` (`id`, `value`, `status`, `sort_order`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (5, 5, 1, 0, 0, 0, '2018-10-04 16:24:06', '2018-10-04 16:33:24');


#
# TABLE STRUCTURE FOR: product_rating_details
#

DROP TABLE IF EXISTS `product_rating_details`;

CREATE TABLE `product_rating_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `product_rating_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `product_ratings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_rating_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `product_rating_details` (`id`, `language_id`, `title`) VALUES (1, 1, 'not good');
INSERT INTO `product_rating_details` (`id`, `language_id`, `title`) VALUES (1, 2, 'not good');
INSERT INTO `product_rating_details` (`id`, `language_id`, `title`) VALUES (2, 1, 'average');
INSERT INTO `product_rating_details` (`id`, `language_id`, `title`) VALUES (2, 2, 'average');
INSERT INTO `product_rating_details` (`id`, `language_id`, `title`) VALUES (3, 1, 'good');
INSERT INTO `product_rating_details` (`id`, `language_id`, `title`) VALUES (3, 2, 'good');
INSERT INTO `product_rating_details` (`id`, `language_id`, `title`) VALUES (4, 1, 'very good');
INSERT INTO `product_rating_details` (`id`, `language_id`, `title`) VALUES (4, 2, 'very good');
INSERT INTO `product_rating_details` (`id`, `language_id`, `title`) VALUES (5, 1, 'excellent');
INSERT INTO `product_rating_details` (`id`, `language_id`, `title`) VALUES (5, 2, 'excellent');


#
# TABLE STRUCTURE FOR: product_reviews
#

DROP TABLE IF EXISTS `product_reviews`;

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `rating_id` int(11) NOT NULL,
  `author` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`language_id`),
  KEY `language_id` (`language_id`),
  KEY `user_id` (`user_id`),
  KEY `story_id` (`product_id`),
  KEY `rating_id` (`rating_id`),
  CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_reviews_ibfk_3` FOREIGN KEY (`rating_id`) REFERENCES `product_ratings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `product_reviews` (`id`, `user_id`, `product_id`, `language_id`, `rating_id`, `author`, `comment`, `status`, `date`) VALUES (1, 26, 1, 1, 1, 'nadim', 'nice product', 1, '2018-10-04 11:30:42');
INSERT INTO `product_reviews` (`id`, `user_id`, `product_id`, `language_id`, `rating_id`, `author`, `comment`, `status`, `date`) VALUES (2, 26, 1, 1, 1, 'aaa', 'dasdas', 0, '2018-10-04 15:12:29');
INSERT INTO `product_reviews` (`id`, `user_id`, `product_id`, `language_id`, `rating_id`, `author`, `comment`, `status`, `date`) VALUES (3, 0, 1, 1, 2, 'ali', 'best product', 0, '2018-10-04 16:56:57');


#
# TABLE STRUCTURE FOR: product_to_categories
#

DROP TABLE IF EXISTS `product_to_categories`;

CREATE TABLE `product_to_categories` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  KEY `product_id` (`product_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_to_categories_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_to_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `product_to_categories` (`product_id`, `category_id`) VALUES (2, 1);
INSERT INTO `product_to_categories` (`product_id`, `category_id`) VALUES (1, 1);


#
# TABLE STRUCTURE FOR: product_wishlists
#

DROP TABLE IF EXISTS `product_wishlists`;

CREATE TABLE `product_wishlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`product_id`,`user_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `product_wishlists_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_wishlists_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `product_wishlists` (`id`, `product_id`, `user_id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (1, 1, 1, 1, 0, 0, '2018-09-20 16:37:51', '2018-09-20 16:37:51');
INSERT INTO `product_wishlists` (`id`, `product_id`, `user_id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (2, 1, 26, 1, 0, 0, '2018-09-20 16:51:09', '2018-09-20 16:51:09');
INSERT INTO `product_wishlists` (`id`, `product_id`, `user_id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES (3, 2, 1, 1, 0, 0, '2018-09-22 15:55:24', '2018-09-22 15:55:24');


SET foreign_key_checks = 1;
