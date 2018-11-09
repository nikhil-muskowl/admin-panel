-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2018 at 06:31 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `current_user_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `followers_view`
-- (See below for the actual view)
--
CREATE TABLE `followers_view` (
`id` int(11)
,`user_id` int(11)
,`current_user_id` int(11)
,`status` tinyint(1)
,`created_date` datetime
,`modified_date` datetime
,`user_name` varchar(100)
,`user_image` text
,`current_user_name` varchar(100)
,`current_user_image` text
);

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 1, 0, 0, '2018-08-08 11:04:08', '2018-08-08 11:04:08'),
(2, 1, 0, 0, '2018-08-08 11:04:21', '2018-08-08 11:04:21');

-- --------------------------------------------------------

--
-- Stand-in structure for view `genders_view`
-- (See below for the actual view)
--
CREATE TABLE `genders_view` (
`id` int(11)
,`status` tinyint(1)
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`language_id` int(11)
,`title` varchar(100)
,`description` text
,`html` text
);

-- --------------------------------------------------------

--
-- Table structure for table `gender_details`
--

CREATE TABLE `gender_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender_details`
--

INSERT INTO `gender_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES
(1, 1, 'male', '', ''),
(1, 2, 'male', '', ''),
(2, 1, 'female', '', ''),
(2, 2, 'महिला', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `code`, `name`, `sort_order`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 'english', 'English', 0, 1, 0, 0, '2018-08-02 10:53:13', '2018-08-09 10:26:13'),
(2, 'hindi', ' हिंदी', 0, 1, 0, 0, '2018-08-02 11:05:07', '2018-08-09 10:26:06');

-- --------------------------------------------------------

--
-- Table structure for table `module_permissions`
--

CREATE TABLE `module_permissions` (
  `user_group_id` int(11) NOT NULL,
  `module` varchar(200) NOT NULL,
  `is_add` tinyint(1) NOT NULL,
  `is_view` tinyint(1) NOT NULL,
  `is_update` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_permissions`
--

INSERT INTO `module_permissions` (`user_group_id`, `module`, `is_add`, `is_view`, `is_update`, `is_delete`) VALUES
(1, 'Advertisements', 1, 1, 1, 1),
(1, 'Advertisement_types', 1, 1, 1, 1),
(1, 'Attributes', 1, 1, 1, 1),
(1, 'Attribute_groups', 1, 1, 1, 1),
(1, 'Blogs', 1, 1, 1, 1),
(1, 'Blog_types', 1, 1, 1, 1),
(1, 'Categories', 1, 1, 1, 1),
(1, 'Genders', 1, 1, 1, 1),
(1, 'Holidays', 1, 1, 1, 1),
(1, 'Inquiries', 1, 1, 1, 1),
(1, 'Inquiry_types', 1, 1, 1, 1),
(1, 'Languages', 1, 1, 1, 1),
(1, 'Leave_applications', 1, 1, 1, 1),
(1, 'Leave_reasons', 1, 1, 1, 1),
(1, 'Leave_types', 1, 1, 1, 1),
(1, 'Pets', 1, 1, 1, 1),
(1, 'Pet_levels', 1, 1, 1, 1),
(1, 'Pet_settings', 1, 1, 1, 1),
(1, 'Plugins', 1, 1, 1, 1),
(1, 'Products', 1, 1, 1, 1),
(1, 'Product_ratings', 1, 1, 1, 1),
(1, 'Product_reviews', 1, 1, 1, 1),
(1, 'Product_wishlists', 1, 1, 1, 1),
(1, 'Settings', 1, 1, 1, 1),
(1, 'Stories', 1, 1, 1, 1),
(1, 'Story_comments', 1, 1, 1, 1),
(1, 'Story_commnets', 1, 1, 1, 1),
(1, 'Story_complains', 1, 1, 1, 1),
(1, 'Story_types', 1, 1, 1, 1),
(1, 'Testimonials', 1, 1, 1, 1),
(1, 'Users', 1, 1, 1, 1),
(1, 'User_complains', 1, 1, 1, 1),
(1, 'User_groups', 1, 1, 1, 1),
(1, 'User_leaves', 1, 1, 1, 1),
(1, 'User_leave_authorities', 1, 1, 1, 1),
(1, 'User_pets', 1, 1, 1, 1),
(1, 'User_pet_points', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE `plugins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `code_key` varchar(64) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `code`, `code_key`, `value`) VALUES
(490, 'config', 'name', 'Musk'),
(491, 'config', 'contact', '7737033665'),
(492, 'config', 'email', 'nadim@muskowl.com'),
(493, 'config', 'address', 'Pacific'),
(494, 'config', 'mail_protocol', 'mail'),
(495, 'config', 'smtp_hostname', 'localhost'),
(496, 'config', 'smtp_username', 'nadim@muskowl.com'),
(497, 'config', 'smtp_password', 'NS@123456'),
(498, 'config', 'smtp_port', '25'),
(499, 'config', 'smtp_timeout', '5'),
(500, 'config', 'date_format', 'D m Y'),
(501, 'config', 'datetime_format', 'D m Y'),
(502, 'config', 'decimal_format', '2'),
(503, 'config', 'list_image_width', '100'),
(504, 'config', 'list_image_height', '100'),
(505, 'config', 'list_banner_width', '100'),
(506, 'config', 'list_banner_height', '100'),
(507, 'config', 'detail_image_width', '800'),
(508, 'config', 'detail_image_height', '500'),
(509, 'config', 'detail_banner_width', '1500'),
(510, 'config', 'detail_banner_height', '500'),
(536, 'pet_module', 'register_points', '500'),
(537, 'pet_module', 'story_upload_points', '100'),
(538, 'pet_module', 'story_comment_points', '50'),
(539, 'pet_module', 'story_like_points', '50'),
(540, 'pet_module', 'story_dislike_points', '20');

-- --------------------------------------------------------

--
-- Table structure for table `url_alias`
--

CREATE TABLE `url_alias` (
  `language_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `keyword` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `url_alias`
--

INSERT INTO `url_alias` (`language_id`, `type_id`, `type`, `keyword`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(1, 1, 'advertisements', '', '', '', ''),
(1, 1, 'products', 'eee', '', '', ''),
(1, 3, 'blogs', '', '', '', ''),
(1, 4, 'blogs', 'e1', '', '', ''),
(1, 4, 'categories', 'cate', 'cate', 'cate', 'cate'),
(2, 1, 'advertisements', '', '', '', ''),
(2, 1, 'products', 'hhh', '', '', ''),
(2, 3, 'blogs', '', '', '', ''),
(2, 4, 'blogs', 'h1', '', '', ''),
(2, 4, 'categories', 'cate', 'cate', 'cate', 'cate');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `otp` int(11) NOT NULL,
  `password` varchar(200) NOT NULL,
  `image` text NOT NULL,
  `banner` text NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `latitude` decimal(6,6) NOT NULL,
  `longitude` decimal(6,6) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_group_id`, `name`, `email`, `contact`, `gender_id`, `dob`, `otp`, `password`, `image`, `banner`, `is_admin`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 1, 'admin', 'admin', '1234567890', 0, '0000-00-00', 0, 'admin', '', '', 1, 1, '0.000000', '0.000000', 0, 0, '2018-08-24 18:04:47', '2018-10-13 11:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_complains`
--

CREATE TABLE `user_complains` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `complain_by` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_complains_view`
-- (See below for the actual view)
--
CREATE TABLE `user_complains_view` (
`id` int(11)
,`user_id` int(11)
,`complain_by` int(11)
,`language_id` int(11)
,`title` varchar(200)
,`description` text
,`status` tinyint(1)
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`user_name` varchar(100)
,`complain_by_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `banner` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `image`, `banner`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, '', '', 1, 0, 0, '2018-07-07 17:18:32', '2018-07-07 17:18:32');

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_groups_view`
-- (See below for the actual view)
--
CREATE TABLE `user_groups_view` (
`id` int(11)
,`image` text
,`banner` text
,`status` tinyint(1)
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`language_id` int(11)
,`title` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `user_group_details`
--

CREATE TABLE `user_group_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group_details`
--

INSERT INTO `user_group_details` (`id`, `language_id`, `title`) VALUES
(1, 1, 'admin'),
(1, 2, 'admin');

-- --------------------------------------------------------

--
-- Structure for view `followers_view`
--
DROP TABLE IF EXISTS `followers_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `followers_view`  AS  select `fr`.`id` AS `id`,`fr`.`user_id` AS `user_id`,`fr`.`current_user_id` AS `current_user_id`,`fr`.`status` AS `status`,`fr`.`created_date` AS `created_date`,`fr`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name`,`u`.`image` AS `user_image`,`f`.`name` AS `current_user_name`,`f`.`image` AS `current_user_image` from ((`followers` `fr` left join `users` `u` on((`u`.`id` = `fr`.`user_id`))) left join `users` `f` on((`f`.`id` = `fr`.`current_user_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `genders_view`
--
DROP TABLE IF EXISTS `genders_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `genders_view`  AS  select `t`.`id` AS `id`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title`,`td`.`description` AS `description`,`td`.`html` AS `html` from (`genders` `t` left join `gender_details` `td` on((`td`.`id` = `t`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `user_complains_view`
--
DROP TABLE IF EXISTS `user_complains_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `user_complains_view`  AS  select `uc`.`id` AS `id`,`uc`.`user_id` AS `user_id`,`uc`.`complain_by` AS `complain_by`,`uc`.`language_id` AS `language_id`,`uc`.`title` AS `title`,`uc`.`description` AS `description`,`uc`.`status` AS `status`,`uc`.`created_by` AS `created_by`,`uc`.`modified_by` AS `modified_by`,`uc`.`created_date` AS `created_date`,`uc`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name`,`cmb`.`name` AS `complain_by_name` from ((`user_complains` `uc` left join `users` `u` on((`u`.`id` = `uc`.`user_id`))) left join `users` `cmb` on((`cmb`.`id` = `uc`.`complain_by`))) ;

-- --------------------------------------------------------

--
-- Structure for view `user_groups_view`
--
DROP TABLE IF EXISTS `user_groups_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `user_groups_view`  AS  select `t`.`id` AS `id`,`t`.`image` AS `image`,`t`.`banner` AS `banner`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title` from (`user_groups` `t` left join `user_group_details` `td` on((`td`.`id` = `t`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`user_id`,`current_user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `follow_user_id` (`current_user_id`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender_details`
--
ALTER TABLE `gender_details`
  ADD UNIQUE KEY `id` (`id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_permissions`
--
ALTER TABLE `module_permissions`
  ADD PRIMARY KEY (`user_group_id`,`module`);

--
-- Indexes for table `plugins`
--
ALTER TABLE `plugins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`code`,`code_key`);

--
-- Indexes for table `url_alias`
--
ALTER TABLE `url_alias`
  ADD UNIQUE KEY `id` (`language_id`,`type_id`,`type`,`keyword`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_complains`
--
ALTER TABLE `user_complains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `language_id` (`language_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `complain_by` (`complain_by`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group_details`
--
ALTER TABLE `user_group_details`
  ADD UNIQUE KEY `id` (`id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plugins`
--
ALTER TABLE `plugins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=541;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_complains`
--
ALTER TABLE `user_complains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`current_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gender_details`
--
ALTER TABLE `gender_details`
  ADD CONSTRAINT `gender_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `genders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gender_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_permissions`
--
ALTER TABLE `module_permissions`
  ADD CONSTRAINT `module_permissions_ibfk_1` FOREIGN KEY (`user_group_id`) REFERENCES `user_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `url_alias`
--
ALTER TABLE `url_alias`
  ADD CONSTRAINT `url_alias_ibfk_1` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_complains`
--
ALTER TABLE `user_complains`
  ADD CONSTRAINT `user_complains_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_complains_ibfk_2` FOREIGN KEY (`complain_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_complains_ibfk_3` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_group_details`
--
ALTER TABLE `user_group_details`
  ADD CONSTRAINT `user_group_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_group_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
