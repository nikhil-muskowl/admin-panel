-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2018 at 07:12 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

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
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('7iicmetfgske3vfu4v8eshkmpit4sii9', '::1', 1545218861, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353231383632373b75736572735f6c6f677c733a313a2232223b),
('88pmds4j8ei1rhihr4vskj9cpunft6kb', '::1', 1545370926, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353337303930383b75736572735f6c6f677c733a313a2232223b),
('bjllbgubgub2ugjna24dv2tg6vljqphv', '::1', 1545368498, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353336383439373b),
('emledemi45s9km90edqt6k9vmm52gkdr', '::1', 1545294841, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353239343833353b),
('fqn467fijfkhl3g66betrd3r1c7ppn47', '::1', 1545216514, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353231363531343b75736572735f6c6f677c733a313a2232223b),
('gkcu3a3h46m74r8bdbcapkvtmaaoe25j', '::1', 1545302283, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353330323238303b75736572735f6c6f677c733a313a2232223b),
('h7kgs6123ggd4edfj8ak821ipdnpn8fc', '::1', 1545285840, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353238353833393b),
('nv7tj8ob5t4rn0g7e6onllumv5jfdb0d', '::1', 1545221744, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353232313635383b75736572735f6c6f677c733a313a2232223b);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `image` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `image`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, '', 1, 0, 0, '2018-08-08 11:04:08', '2018-08-08 11:04:08'),
(2, '', 1, 0, 0, '2018-08-08 11:04:21', '2018-08-08 11:04:21');

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
(1, 'Addresses', 1, 1, 1, 1),
(1, 'Advertisements', 1, 1, 1, 1),
(1, 'Advertisement_types', 1, 1, 1, 1),
(1, 'Apply_leave_applications', 1, 1, 1, 1),
(1, 'Attributes', 1, 1, 1, 1),
(1, 'Attribute_groups', 1, 1, 1, 1),
(1, 'Blogs', 1, 1, 1, 1),
(1, 'Blog_types', 1, 1, 1, 1),
(1, 'Carts', 1, 1, 1, 1),
(1, 'Categories', 1, 1, 1, 1),
(1, 'Countries', 1, 1, 1, 1),
(1, 'Events', 1, 1, 1, 1),
(1, 'Faq_answers', 1, 1, 1, 1),
(1, 'Faq_questions', 1, 1, 1, 1),
(1, 'Genders', 1, 1, 1, 1),
(1, 'Holidays', 1, 1, 1, 1),
(1, 'Inquiries', 1, 1, 1, 1),
(1, 'Inquiry_types', 1, 1, 1, 1),
(1, 'Languages', 1, 1, 1, 1),
(1, 'Leave_applications', 1, 1, 1, 1),
(1, 'Leave_reasons', 1, 1, 1, 1),
(1, 'Leave_settings', 1, 1, 1, 1),
(1, 'Leave_statuses', 1, 1, 1, 1),
(1, 'Leave_types', 1, 1, 1, 1),
(1, 'Lengths', 1, 1, 1, 1),
(1, 'My_account', 1, 1, 1, 1),
(1, 'My_leave_applications', 1, 1, 1, 1),
(1, 'My_todo_lists', 1, 1, 1, 1),
(1, 'Newsletters', 1, 1, 1, 1),
(1, 'Newsletter_mails', 1, 1, 1, 1),
(1, 'Newsletter_mail_trackers', 1, 1, 1, 1),
(1, 'Notifications', 1, 1, 1, 1),
(1, 'Notification_settings', 1, 1, 1, 1),
(1, 'Orders', 1, 1, 1, 1),
(1, 'Penalties', 1, 1, 1, 1),
(1, 'Penalty_reasons', 1, 1, 1, 1),
(1, 'Pets', 1, 1, 1, 1),
(1, 'Pet_levels', 1, 1, 1, 1),
(1, 'Pet_settings', 1, 1, 1, 1),
(1, 'Plugins', 1, 1, 1, 1),
(1, 'Products', 1, 1, 1, 1),
(1, 'Product_carts', 1, 1, 1, 1),
(1, 'Product_inquiries', 1, 1, 1, 1),
(1, 'Product_inquiry_types', 1, 1, 1, 1),
(1, 'Product_ratings', 1, 1, 1, 1),
(1, 'Product_reviews', 1, 1, 1, 1),
(1, 'Product_wishlists', 1, 1, 1, 1),
(1, 'Services', 1, 1, 1, 1),
(1, 'Settings', 1, 1, 1, 1),
(1, 'Stories', 1, 1, 1, 1),
(1, 'Story_comments', 1, 1, 1, 1),
(1, 'Story_commnets', 1, 1, 1, 1),
(1, 'Story_complains', 1, 1, 1, 1),
(1, 'Story_types', 1, 1, 1, 1),
(1, 'Testimonials', 1, 1, 1, 1),
(1, 'Todo_lists', 1, 1, 1, 1),
(1, 'Update_password', 1, 1, 1, 1),
(1, 'Users', 1, 1, 1, 1),
(1, 'User_activities', 1, 1, 1, 1),
(1, 'User_authorities', 1, 1, 1, 1),
(1, 'User_complains', 1, 1, 1, 1),
(1, 'User_devices', 1, 1, 1, 1),
(1, 'User_groups', 1, 1, 1, 1),
(1, 'User_leaves', 1, 1, 1, 1),
(1, 'User_leave_authorities', 1, 1, 1, 1),
(1, 'User_pets', 1, 1, 1, 1),
(1, 'User_pet_points', 1, 1, 1, 1),
(1, 'Weights', 1, 1, 1, 1),
(1, 'Zones', 1, 1, 1, 1),
(2, 'Holidays', 0, 1, 0, 0),
(2, 'Leave_applications', 0, 1, 0, 0),
(2, 'Leave_reasons', 0, 1, 0, 0),
(2, 'Leave_statuses', 0, 1, 0, 0),
(2, 'Leave_types', 0, 1, 0, 0),
(2, 'Todo_lists', 1, 1, 1, 1),
(2, 'User_leaves', 0, 1, 0, 0),
(2, 'User_leave_authorities', 0, 1, 0, 0);

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `data` text NOT NULL,
  `expire` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `token`, `data`, `expire`, `status`, `created_date`, `modified_date`) VALUES
(1, 2, '8aef73230dd673743e5d045fe5fde6008941bdbcfd7ad31639b93e388d6944515f70cda8899fc9f8d6f2b7da9c0fa798f9b1e287665d1bcf079f3a97769b36729WjTSUUa9lMzsoWikRAZhCfeqi6OFoIr39g2WB9rZvc=', '', '0000-00-00 00:00:00', 1, '2018-12-19 16:16:32', '2018-12-21 10:10:03');

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
(628, 'config', 'name', 'Musk'),
(629, 'config', 'contact', '7737033665'),
(630, 'config', 'email', 'nadim@muskowl.com'),
(631, 'config', 'address', 'Pacific'),
(632, 'config', 'mail_protocol', 'mail'),
(633, 'config', 'smtp_hostname', 'localhost'),
(634, 'config', 'smtp_username', 'nadim@muskowl.com'),
(635, 'config', 'smtp_password', 'NS@123456'),
(636, 'config', 'smtp_port', '25'),
(637, 'config', 'smtp_timeout', '5'),
(638, 'config', 'date_format', 'd-m-Y'),
(639, 'config', 'datetime_format', 'd-m-Y h:i A'),
(640, 'config', 'decimal_format', '2'),
(641, 'config', 'list_image_width', '100'),
(642, 'config', 'list_image_height', '100'),
(643, 'config', 'list_banner_width', '100'),
(644, 'config', 'list_banner_height', '100'),
(645, 'config', 'detail_image_width', '800'),
(646, 'config', 'detail_image_height', '500'),
(647, 'config', 'detail_banner_width', '1500'),
(648, 'config', 'detail_banner_height', '500');

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
(1, 1, 'services', '', '', '', ''),
(1, 3, 'blogs', '', '', '', ''),
(1, 4, 'blogs', 'e1', '', '', ''),
(1, 4, 'categories', 'cate', 'cate', 'cate', 'cate'),
(2, 1, 'advertisements', '', '', '', ''),
(2, 1, 'products', 'hhh', '', '', ''),
(2, 1, 'services', '', '', '', ''),
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
  `verified` tinyint(1) NOT NULL,
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

INSERT INTO `users` (`id`, `user_group_id`, `name`, `email`, `contact`, `gender_id`, `dob`, `otp`, `password`, `image`, `banner`, `is_admin`, `verified`, `status`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 1, 'arushi', 'arushi@muskowl.com', '1234567890', 2, '0000-00-00', 0, '123456', '', '', 1, 0, 1, '0.000000', '0.000000', 0, 0, '2018-08-24 18:04:47', '2018-11-27 14:29:14'),
(2, 1, 'nadim', 'nadim@muskowl.com', '7737033665', 1, '0000-00-00', 0, '123456', '', '', 0, 0, 1, '0.000000', '0.000000', 0, 0, '2018-11-12 16:39:55', '2018-11-19 10:20:16'),
(3, 2, 'rajesh', 'rajesh.muskowl@gmail.com', '123456', 1, '0000-00-00', 0, '123456', '', '', 0, 0, 1, '0.000000', '0.000000', 0, 0, '2018-11-14 17:23:17', '2018-11-27 14:27:12'),
(4, 2, 'pratik', 'pratik@muskowl.com', '1234566456', 1, '0000-00-00', 0, '123456', '', '', 0, 0, 1, '0.000000', '0.000000', 0, 0, '2018-11-19 10:19:54', '2018-11-27 14:27:14'),
(5, 2, 'nikhil', 'nikhil@muskowl.com', '123456hh', 1, '0000-00-00', 0, '123456', '', '', 0, 0, 1, '0.000000', '0.000000', 0, 0, '2018-11-27 14:26:43', '2018-11-28 11:17:26');

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
(1, '', '', 1, 0, 0, '2018-07-07 17:18:32', '2018-07-07 17:18:32'),
(2, '', '', 1, 0, 0, '2018-11-19 10:21:21', '2018-11-19 10:21:21');

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
(1, 2, 'admin'),
(2, 1, 'employee'),
(2, 2, 'employee');

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
-- Structure for view `user_groups_view`
--
DROP TABLE IF EXISTS `user_groups_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `user_groups_view`  AS  select `t`.`id` AS `id`,`t`.`image` AS `image`,`t`.`banner` AS `banner`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title` from (`user_groups` `t` left join `user_group_details` `td` on((`td`.`id` = `t`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=649;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `user_group_details`
--
ALTER TABLE `user_group_details`
  ADD CONSTRAINT `user_group_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_group_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
