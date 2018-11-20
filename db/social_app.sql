-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2018 at 10:17 AM
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
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `status`, `date`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 1, '2018-10-02', 0, 0, '2018-10-12 14:27:04', '2018-10-22 14:43:54'),
(2, 1, '2018-12-31', 0, 0, '2018-11-12 15:06:48', '2018-11-12 15:06:48');

-- --------------------------------------------------------

--
-- Stand-in structure for view `holidays_view`
-- (See below for the actual view)
--
CREATE TABLE `holidays_view` (
`id` int(11)
,`status` tinyint(1)
,`date` date
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`language_id` int(11)
,`title` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `holiday_details`
--

CREATE TABLE `holiday_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holiday_details`
--

INSERT INTO `holiday_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES
(1, 1, '2 october', '', ''),
(1, 2, '2 october', '', ''),
(2, 1, 'New year leave', '', ''),
(2, 2, 'New year leave', '', '');

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
-- Table structure for table `leave_applications`
--

CREATE TABLE `leave_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave_reason_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `leave_status_id` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `file_attach` text NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_applications`
--

INSERT INTO `leave_applications` (`id`, `user_id`, `leave_reason_id`, `leave_type_id`, `language_id`, `leave_status_id`, `from_date`, `to_date`, `total`, `file_attach`, `subject`, `text`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 2, 2, 4, 1, 1, '2018-11-13 00:00:00', '2018-11-15 00:00:00', '2.00', '', 'leave application', 'i have some urgent hospital work.', 1, 0, 0, '2018-11-13 10:29:44', '2018-11-19 10:48:02'),
(2, 2, 1, 2, 1, 1, '2018-11-15 00:00:00', '2018-11-16 00:00:00', '1.00', '', 'Leave application', 'i have some urgent hospital work.', 1, 0, 0, '2018-11-15 11:20:01', '2018-11-19 10:47:38'),
(3, 3, 2, 3, 1, 2, '2018-11-15 09:30:00', '2018-11-15 12:00:00', '2.30', '', 'leave application', 'leave application', 1, 0, 0, '2018-11-15 12:41:10', '2018-11-19 10:43:41'),
(4, 3, 1, 2, 1, 1, '2018-11-19 00:00:00', '2018-11-21 00:00:00', '2.00', '', 'leave application', 'dfgfdg', 1, 0, 0, '2018-11-19 12:35:10', '2018-11-19 12:35:10'),
(5, 1, 1, 1, 1, 1, '1970-01-01 00:00:00', '1970-01-01 00:00:00', '0.00', '', 'leave', 'leave', 1, 0, 0, '2018-11-20 12:04:09', '2018-11-20 12:04:09');

-- --------------------------------------------------------

--
-- Stand-in structure for view `leave_applications_view`
-- (See below for the actual view)
--
CREATE TABLE `leave_applications_view` (
`id` int(11)
,`user_id` int(11)
,`leave_reason_id` int(11)
,`leave_type_id` int(11)
,`language_id` int(11)
,`leave_status_id` int(11)
,`from_date` datetime
,`to_date` datetime
,`total` decimal(10,2)
,`file_attach` text
,`subject` varchar(100)
,`text` text
,`status` tinyint(1)
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`user_name` varchar(100)
,`leave_reason` varchar(100)
,`leave_status` varchar(100)
,`leave_type` varchar(100)
,`type` enum('full','half','hour')
,`value` int(11)
,`file` tinyint(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `leave_reasons`
--

CREATE TABLE `leave_reasons` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_reasons`
--

INSERT INTO `leave_reasons` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 1, 0, 0, '2018-10-22 10:56:23', '2018-10-22 10:56:23'),
(2, 1, 0, 0, '2018-10-22 10:57:50', '2018-10-22 10:57:50');

-- --------------------------------------------------------

--
-- Stand-in structure for view `leave_reasons_view`
-- (See below for the actual view)
--
CREATE TABLE `leave_reasons_view` (
`id` int(11)
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
-- Table structure for table `leave_reason_details`
--

CREATE TABLE `leave_reason_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_reason_details`
--

INSERT INTO `leave_reason_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES
(1, 1, 'emergency', '', ''),
(1, 2, 'emergency', '', ''),
(2, 1, 'casual', '', ''),
(2, 2, 'आकस्मिक', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `leave_statuses`
--

CREATE TABLE `leave_statuses` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_statuses`
--

INSERT INTO `leave_statuses` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 1, 0, 0, '2018-11-16 16:56:42', '2018-11-16 16:56:42'),
(2, 1, 0, 0, '2018-11-16 16:56:59', '2018-11-16 16:56:59'),
(3, 1, 0, 0, '2018-11-16 16:57:04', '2018-11-16 16:57:04');

-- --------------------------------------------------------

--
-- Stand-in structure for view `leave_statuses_view`
-- (See below for the actual view)
--
CREATE TABLE `leave_statuses_view` (
`id` int(11)
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
-- Table structure for table `leave_status_details`
--

CREATE TABLE `leave_status_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_status_details`
--

INSERT INTO `leave_status_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES
(1, 1, 'pending', '', ''),
(1, 2, 'pending', '', ''),
(2, 1, 'approved', '', ''),
(2, 2, 'approved', '', ''),
(3, 1, 'cancel', '', ''),
(3, 2, 'cancel', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL,
  `type` enum('full','half','hour') NOT NULL,
  `value` int(11) NOT NULL,
  `file` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `type`, `value`, `file`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 'half', 1, 0, 1, 0, 0, '2018-10-22 10:44:42', '2018-11-12 17:49:43'),
(2, 'full', 1, 1, 1, 0, 0, '2018-10-22 10:45:56', '2018-11-13 10:59:52'),
(3, 'hour', 2, 0, 1, 0, 0, '2018-10-22 10:46:22', '2018-11-12 17:50:16'),
(4, 'full', 1, 0, 1, 0, 0, '2018-10-22 17:09:19', '2018-11-12 17:49:34');

-- --------------------------------------------------------

--
-- Stand-in structure for view `leave_types_view`
-- (See below for the actual view)
--
CREATE TABLE `leave_types_view` (
`id` int(11)
,`type` enum('full','half','hour')
,`value` int(11)
,`file` tinyint(1)
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
-- Table structure for table `leave_type_details`
--

CREATE TABLE `leave_type_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_type_details`
--

INSERT INTO `leave_type_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES
(1, 1, 'half day', '', ''),
(1, 2, 'half day', '', ''),
(2, 1, 'emergency & medical', '', ''),
(2, 2, 'emergency & medical', '', ''),
(3, 1, 'gate pass', '', ''),
(3, 2, 'gate pass', '', ''),
(4, 1, 'casual', '', ''),
(4, 2, 'आकस्मिक', '', '');

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
(1, 'Leave_settings', 1, 1, 1, 1),
(1, 'Leave_statuses', 1, 1, 1, 1),
(1, 'Leave_types', 1, 1, 1, 1),
(1, 'Newsletters', 1, 1, 1, 1),
(1, 'Newsletter_mails', 1, 1, 1, 1),
(1, 'Newsletter_mail_trackers', 1, 1, 1, 1),
(1, 'Notifications', 1, 1, 1, 1),
(1, 'Penalties', 1, 1, 1, 1),
(1, 'Penalty_reasons', 1, 1, 1, 1),
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
(1, 'Todo_lists', 1, 1, 1, 1),
(1, 'Users', 1, 1, 1, 1),
(1, 'User_activities', 1, 1, 1, 1),
(1, 'User_complains', 1, 1, 1, 1),
(1, 'User_groups', 1, 1, 1, 1),
(1, 'User_leaves', 1, 1, 1, 1),
(1, 'User_leave_authorities', 1, 1, 1, 1),
(1, 'User_pets', 1, 1, 1, 1),
(1, 'User_pet_points', 1, 1, 1, 1),
(2, 'Holidays', 0, 1, 0, 0),
(2, 'Leave_applications', 0, 1, 0, 0),
(2, 'Leave_reasons', 0, 1, 0, 0),
(2, 'Leave_statuses', 0, 1, 0, 0),
(2, 'Leave_types', 0, 1, 0, 0),
(2, 'User_leaves', 0, 1, 0, 0),
(2, 'User_leave_authorities', 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(120) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `subscribe` tinyint(1) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `name`, `email`, `contact`, `subscribe`, `status`, `created_date`, `modified_date`) VALUES
(1, 'nadim', 'nadim.sheikh.07@gmail.com', '7737033665', 1, 1, '2018-11-17 14:39:43', '2018-11-17 14:39:43'),
(2, 'rajesh', 'rajesh.muskowl@gmail.com', '123456', 1, 1, '2018-11-17 14:39:43', '2018-11-17 14:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_mails`
--

CREATE TABLE `newsletter_mails` (
  `id` int(11) NOT NULL,
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
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter_mails`
--

INSERT INTO `newsletter_mails` (`id`, `title`, `name`, `email`, `contact`, `type`, `type_value`, `subject`, `text`, `html`, `status`, `created_date`, `modified_date`) VALUES
(2, 'test', 'muskowl', 'info@muskowl.com', '7737033665', '', '', 'test', 'test', 'test', 1, '2018-11-17 15:09:29', '2018-11-17 15:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_mail_trackers`
--

CREATE TABLE `newsletter_mail_trackers` (
  `id` int(11) NOT NULL,
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
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter_mail_trackers`
--

INSERT INTO `newsletter_mail_trackers` (`id`, `title`, `name`, `email`, `contact`, `to_email`, `subject`, `text`, `html`, `email_status`, `status`, `created_date`, `modified_date`) VALUES
(1, 'test', 'nadim', 'info@muskowl.com', '7737033665', 'nadim.sheikh.07@gmail.com', 'test', 'test', 'test', 'Failed', 1, '2018-11-19 10:11:18', '2018-11-19 10:11:18'),
(2, 'test', 'rajesh', 'info@muskowl.com', '7737033665', 'rajesh.muskowl@gmail.com', 'test', 'test', 'test', 'Failed', 1, '2018-11-19 10:11:19', '2018-11-19 10:11:19');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `type_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `image`, `type`, `type_id`, `status`, `sort_order`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 'upload/images/0c90f50a999505679ff15dc9926da398.jpg', '', 0, 1, 0, 0, 0, '2018-09-22 12:50:47', '2018-09-22 14:09:41');

-- --------------------------------------------------------

--
-- Stand-in structure for view `notifications_view`
-- (See below for the actual view)
--
CREATE TABLE `notifications_view` (
`id` int(11)
,`image` text
,`type` varchar(100)
,`type_id` int(11)
,`status` tinyint(1)
,`sort_order` int(11)
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`language_id` int(11)
,`title` varchar(100)
,`description` text
);

-- --------------------------------------------------------

--
-- Table structure for table `notification_details`
--

CREATE TABLE `notification_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_details`
--

INSERT INTO `notification_details` (`id`, `language_id`, `title`, `description`) VALUES
(1, 1, 'e', 'e'),
(1, 2, 'h', 'h');

-- --------------------------------------------------------

--
-- Table structure for table `notification_to_users`
--

CREATE TABLE `notification_to_users` (
  `id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_view` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_to_users`
--

INSERT INTO `notification_to_users` (`id`, `notification_id`, `user_id`, `is_view`) VALUES
(7, 1, 26, 0),
(8, 1, 27, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penalties`
--

CREATE TABLE `penalties` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `penalty_reason_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penalties`
--

INSERT INTO `penalties` (`id`, `user_id`, `language_id`, `penalty_reason_id`, `date`, `total`, `subject`, `text`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 2, 1, 1, '2018-11-17', '100.00', 'mobile penalty', 'mobile penalty', 1, 0, 0, '2018-11-17 11:32:54', '2018-11-17 11:35:16'),
(2, 2, 1, 2, '2018-11-16', '100.00', 'absent', 'absent', 1, 0, 0, '2018-11-17 11:49:43', '2018-11-17 11:49:43'),
(3, 3, 1, 2, '2018-11-15', '200.00', 'absent', 'absent', 1, 0, 0, '2018-11-17 11:52:11', '2018-11-17 11:52:11');

-- --------------------------------------------------------

--
-- Stand-in structure for view `penalties_view`
-- (See below for the actual view)
--
CREATE TABLE `penalties_view` (
`id` int(11)
,`user_id` int(11)
,`language_id` int(11)
,`penalty_reason_id` int(11)
,`date` date
,`total` decimal(10,2)
,`subject` varchar(100)
,`text` text
,`status` tinyint(1)
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`user_name` varchar(100)
,`penalty_reason` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `penalty_reasons`
--

CREATE TABLE `penalty_reasons` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penalty_reasons`
--

INSERT INTO `penalty_reasons` (`id`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 1, 0, 0, '2018-11-17 11:28:34', '2018-11-17 11:28:34'),
(2, 1, 0, 0, '2018-11-17 11:29:46', '2018-11-17 11:29:46');

-- --------------------------------------------------------

--
-- Stand-in structure for view `penalty_reasons_view`
-- (See below for the actual view)
--
CREATE TABLE `penalty_reasons_view` (
`id` int(11)
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
-- Table structure for table `penalty_reason_details`
--

CREATE TABLE `penalty_reason_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penalty_reason_details`
--

INSERT INTO `penalty_reason_details` (`id`, `language_id`, `title`, `description`, `html`) VALUES
(1, 1, 'mobile', '', ''),
(1, 2, 'mobile', '', ''),
(2, 1, 'absent', '', ''),
(2, 2, 'absent', '', '');

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

--
-- Dumping data for table `plugins`
--

INSERT INTO `plugins` (`id`, `name`, `code`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(57, 'Leave Managment Module', 'leave_managment_module', 1, 0, 0, '2018-11-12 10:47:43', '2018-11-12 10:47:43'),
(58, 'Notifications Module', 'notifications_module', 1, 0, 0, '2018-11-12 16:41:53', '2018-11-12 16:41:53'),
(59, 'Penalties Module', 'penalties_module', 1, 0, 0, '2018-11-17 11:52:42', '2018-11-17 11:52:42'),
(60, 'Newsletters Module', 'newsletters_module', 1, 0, 0, '2018-11-17 11:55:29', '2018-11-17 11:55:29'),
(61, 'Todo Lists Module', 'todo_lists_module', 1, 0, 0, '2018-11-19 15:53:23', '2018-11-19 15:53:23');

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
(583, 'leave_managment_module', 'pending_id', '1'),
(584, 'leave_managment_module', 'approved_id', '2'),
(585, 'leave_managment_module', 'cancel_id', '3'),
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
-- Table structure for table `todo_lists`
--

CREATE TABLE `todo_lists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todo_lists`
--

INSERT INTO `todo_lists` (`id`, `user_id`, `language_id`, `subject`, `text`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 2, 1, 'leave application', 'leave application', 1, 0, 0, '2018-11-19 16:04:33', '2018-11-20 11:03:21');

-- --------------------------------------------------------

--
-- Stand-in structure for view `todo_lists_view`
-- (See below for the actual view)
--
CREATE TABLE `todo_lists_view` (
`id` int(11)
,`user_id` int(11)
,`language_id` int(11)
,`subject` varchar(100)
,`text` text
,`status` tinyint(1)
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`user_name` varchar(100)
);

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
(1, 1, 'arushi', 'arushi@muskowl.com', '1234567890', 2, '0000-00-00', 0, 'admin', '', '', 1, 0, 1, '0.000000', '0.000000', 0, 0, '2018-08-24 18:04:47', '2018-11-19 11:13:05'),
(2, 1, 'nadim', 'nadim@muskowl.com', '7737033665', 1, '0000-00-00', 0, '123456', '', '', 0, 0, 1, '0.000000', '0.000000', 0, 0, '2018-11-12 16:39:55', '2018-11-19 10:20:16'),
(3, 2, 'rajesh', 'rajesh.muskowl@gmail.com', '123456', 1, '0000-00-00', 0, '', '', '', 0, 0, 1, '0.000000', '0.000000', 0, 0, '2018-11-14 17:23:17', '2018-11-19 10:21:49'),
(4, 2, 'pratik', 'pratik@muskowl.com', '1234566456', 1, '0000-00-00', 0, '', '', '', 0, 0, 1, '0.000000', '0.000000', 0, 0, '2018-11-19 10:19:54', '2018-11-19 10:21:44');

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
-- Table structure for table `user_leaves`
--

CREATE TABLE `user_leaves` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_leaves`
--

INSERT INTO `user_leaves` (`id`, `user_id`, `leave_type_id`, `total`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 1, 1, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43'),
(2, 1, 2, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43'),
(3, 1, 3, '2.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43'),
(4, 1, 4, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43'),
(5, 2, 1, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43'),
(6, 2, 2, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43'),
(7, 2, 3, '2.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43'),
(8, 2, 4, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43'),
(9, 3, 1, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43'),
(10, 3, 2, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43'),
(11, 3, 3, '-4.60', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-19 10:43:41'),
(12, 3, 4, '1.00', 1, 0, 0, '2018-11-14 17:25:43', '2018-11-14 17:25:43');

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_leaves_view`
-- (See below for the actual view)
--
CREATE TABLE `user_leaves_view` (
`id` int(11)
,`user_id` int(11)
,`leave_type_id` int(11)
,`total` decimal(10,2)
,`status` tinyint(1)
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`name` varchar(100)
,`email` varchar(200)
,`contact` varchar(20)
,`dob` date
,`language_id` int(11)
,`leave_type` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `user_leave_authorities`
--

CREATE TABLE `user_leave_authorities` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `priority` int(2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_leave_authorities`
--

INSERT INTO `user_leave_authorities` (`id`, `user_id`, `author_id`, `priority`, `status`, `created_date`, `modified_date`) VALUES
(1, 2, 1, 1, 1, '2018-11-13 10:40:40', '2018-11-13 11:52:19'),
(2, 2, 4, 2, 1, '2018-11-19 10:24:44', '2018-11-19 10:25:20'),
(3, 3, 2, 1, 1, '2018-11-19 10:25:04', '2018-11-19 10:25:04'),
(4, 3, 4, 2, 1, '2018-11-19 10:25:13', '2018-11-19 10:25:13'),
(5, 3, 1, 3, 1, '2018-11-19 10:25:28', '2018-11-19 10:25:28');

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_leave_authorities_view`
-- (See below for the actual view)
--
CREATE TABLE `user_leave_authorities_view` (
`id` int(11)
,`user_id` int(11)
,`author_id` int(11)
,`priority` int(2)
,`status` tinyint(1)
,`created_date` datetime
,`modified_date` datetime
,`user_name` varchar(100)
,`user_email` varchar(200)
,`author_name` varchar(100)
,`author_email` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_notifications_view`
-- (See below for the actual view)
--
CREATE TABLE `user_notifications_view` (
`id` int(11)
,`image` text
,`type` varchar(100)
,`type_id` int(11)
,`status` tinyint(1)
,`sort_order` int(11)
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`language_id` int(11)
,`title` varchar(100)
,`description` text
,`user_notification_id` int(11)
,`user_id` int(11)
,`is_view` tinyint(1)
);

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
-- Structure for view `holidays_view`
--
DROP TABLE IF EXISTS `holidays_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `holidays_view`  AS  select `t`.`id` AS `id`,`t`.`status` AS `status`,`t`.`date` AS `date`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title` from (`holidays` `t` left join `holiday_details` `td` on((`td`.`id` = `t`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `leave_applications_view`
--
DROP TABLE IF EXISTS `leave_applications_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `leave_applications_view`  AS  select `la`.`id` AS `id`,`la`.`user_id` AS `user_id`,`la`.`leave_reason_id` AS `leave_reason_id`,`la`.`leave_type_id` AS `leave_type_id`,`la`.`language_id` AS `language_id`,`la`.`leave_status_id` AS `leave_status_id`,`la`.`from_date` AS `from_date`,`la`.`to_date` AS `to_date`,`la`.`total` AS `total`,`la`.`file_attach` AS `file_attach`,`la`.`subject` AS `subject`,`la`.`text` AS `text`,`la`.`status` AS `status`,`la`.`created_by` AS `created_by`,`la`.`modified_by` AS `modified_by`,`la`.`created_date` AS `created_date`,`la`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name`,`lrd`.`title` AS `leave_reason`,`lsd`.`title` AS `leave_status`,`ltd`.`title` AS `leave_type`,`lt`.`type` AS `type`,`lt`.`value` AS `value`,`lt`.`file` AS `file` from (((((`leave_applications` `la` left join `users` `u` on((`u`.`id` = `la`.`user_id`))) left join `leave_reason_details` `lrd` on(((`lrd`.`language_id` = `la`.`language_id`) and (`lrd`.`id` = `la`.`leave_reason_id`)))) left join `leave_types` `lt` on((`lt`.`id` = `la`.`leave_type_id`))) left join `leave_type_details` `ltd` on(((`ltd`.`language_id` = `la`.`language_id`) and (`ltd`.`id` = `la`.`leave_type_id`)))) left join `leave_status_details` `lsd` on(((`lsd`.`id` = `la`.`leave_status_id`) and (`lsd`.`language_id` = `la`.`language_id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `leave_reasons_view`
--
DROP TABLE IF EXISTS `leave_reasons_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `leave_reasons_view`  AS  select `t`.`id` AS `id`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title` from (`leave_reasons` `t` left join `leave_reason_details` `td` on((`td`.`id` = `t`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `leave_statuses_view`
--
DROP TABLE IF EXISTS `leave_statuses_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `leave_statuses_view`  AS  select `t`.`id` AS `id`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title` from (`leave_statuses` `t` left join `leave_status_details` `td` on((`td`.`id` = `t`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `leave_types_view`
--
DROP TABLE IF EXISTS `leave_types_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `leave_types_view`  AS  select `t`.`id` AS `id`,`t`.`type` AS `type`,`t`.`value` AS `value`,`t`.`file` AS `file`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title` from (`leave_types` `t` left join `leave_type_details` `td` on((`td`.`id` = `t`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `notifications_view`
--
DROP TABLE IF EXISTS `notifications_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `notifications_view`  AS  select `n`.`id` AS `id`,`n`.`image` AS `image`,`n`.`type` AS `type`,`n`.`type_id` AS `type_id`,`n`.`status` AS `status`,`n`.`sort_order` AS `sort_order`,`n`.`created_by` AS `created_by`,`n`.`modified_by` AS `modified_by`,`n`.`created_date` AS `created_date`,`n`.`modified_date` AS `modified_date`,`nd`.`language_id` AS `language_id`,`nd`.`title` AS `title`,`nd`.`description` AS `description` from (`notifications` `n` left join `notification_details` `nd` on((`nd`.`id` = `n`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `penalties_view`
--
DROP TABLE IF EXISTS `penalties_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `penalties_view`  AS  select `p`.`id` AS `id`,`p`.`user_id` AS `user_id`,`p`.`language_id` AS `language_id`,`p`.`penalty_reason_id` AS `penalty_reason_id`,`p`.`date` AS `date`,`p`.`total` AS `total`,`p`.`subject` AS `subject`,`p`.`text` AS `text`,`p`.`status` AS `status`,`p`.`created_by` AS `created_by`,`p`.`modified_by` AS `modified_by`,`p`.`created_date` AS `created_date`,`p`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name`,`prd`.`title` AS `penalty_reason` from ((`penalties` `p` left join `users` `u` on((`u`.`id` = `p`.`user_id`))) left join `penalty_reason_details` `prd` on(((`prd`.`id` = `p`.`penalty_reason_id`) and (`prd`.`language_id` = `p`.`language_id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `penalty_reasons_view`
--
DROP TABLE IF EXISTS `penalty_reasons_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `penalty_reasons_view`  AS  select `t`.`id` AS `id`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title` from (`penalty_reasons` `t` left join `penalty_reason_details` `td` on((`td`.`id` = `t`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `todo_lists_view`
--
DROP TABLE IF EXISTS `todo_lists_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `todo_lists_view`  AS  select `tl`.`id` AS `id`,`tl`.`user_id` AS `user_id`,`tl`.`language_id` AS `language_id`,`tl`.`subject` AS `subject`,`tl`.`text` AS `text`,`tl`.`status` AS `status`,`tl`.`created_by` AS `created_by`,`tl`.`modified_by` AS `modified_by`,`tl`.`created_date` AS `created_date`,`tl`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name` from (`todo_lists` `tl` left join `users` `u` on((`u`.`id` = `tl`.`user_id`))) ;

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

-- --------------------------------------------------------

--
-- Structure for view `user_leaves_view`
--
DROP TABLE IF EXISTS `user_leaves_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `user_leaves_view`  AS  select `ul`.`id` AS `id`,`ul`.`user_id` AS `user_id`,`ul`.`leave_type_id` AS `leave_type_id`,`ul`.`total` AS `total`,`ul`.`status` AS `status`,`ul`.`created_by` AS `created_by`,`ul`.`modified_by` AS `modified_by`,`ul`.`created_date` AS `created_date`,`ul`.`modified_date` AS `modified_date`,`u`.`name` AS `name`,`u`.`email` AS `email`,`u`.`contact` AS `contact`,`u`.`dob` AS `dob`,`ltd`.`language_id` AS `language_id`,`ltd`.`title` AS `leave_type` from ((`user_leaves` `ul` left join `users` `u` on((`u`.`id` = `ul`.`user_id`))) left join `leave_type_details` `ltd` on((`ltd`.`id` = `ul`.`leave_type_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `user_leave_authorities_view`
--
DROP TABLE IF EXISTS `user_leave_authorities_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `user_leave_authorities_view`  AS  select `ula`.`id` AS `id`,`ula`.`user_id` AS `user_id`,`ula`.`author_id` AS `author_id`,`ula`.`priority` AS `priority`,`ula`.`status` AS `status`,`ula`.`created_date` AS `created_date`,`ula`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name`,`u`.`email` AS `user_email`,`a`.`name` AS `author_name`,`a`.`email` AS `author_email` from ((`user_leave_authorities` `ula` left join `users` `u` on((`u`.`id` = `ula`.`user_id`))) left join `users` `a` on((`a`.`id` = `ula`.`author_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `user_notifications_view`
--
DROP TABLE IF EXISTS `user_notifications_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `user_notifications_view`  AS  select `n`.`id` AS `id`,`n`.`image` AS `image`,`n`.`type` AS `type`,`n`.`type_id` AS `type_id`,`n`.`status` AS `status`,`n`.`sort_order` AS `sort_order`,`n`.`created_by` AS `created_by`,`n`.`modified_by` AS `modified_by`,`n`.`created_date` AS `created_date`,`n`.`modified_date` AS `modified_date`,`nd`.`language_id` AS `language_id`,`nd`.`title` AS `title`,`nd`.`description` AS `description`,`ntu`.`id` AS `user_notification_id`,`ntu`.`user_id` AS `user_id`,`ntu`.`is_view` AS `is_view` from ((`notifications` `n` left join `notification_details` `nd` on((`nd`.`id` = `n`.`id`))) left join `notification_to_users` `ntu` on((`ntu`.`notification_id` = `n`.`id`))) ;

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
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holiday_details`
--
ALTER TABLE `holiday_details`
  ADD UNIQUE KEY `id` (`id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_applications`
--
ALTER TABLE `leave_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `leave_reason_id` (`leave_reason_id`),
  ADD KEY `leave_type_id` (`leave_type_id`),
  ADD KEY `leave_applications_ibfk_4` (`language_id`),
  ADD KEY `leave_status_id` (`leave_status_id`);

--
-- Indexes for table `leave_reasons`
--
ALTER TABLE `leave_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_reason_details`
--
ALTER TABLE `leave_reason_details`
  ADD UNIQUE KEY `id` (`id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `leave_statuses`
--
ALTER TABLE `leave_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_status_details`
--
ALTER TABLE `leave_status_details`
  ADD UNIQUE KEY `id` (`id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_type_details`
--
ALTER TABLE `leave_type_details`
  ADD UNIQUE KEY `id` (`id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `module_permissions`
--
ALTER TABLE `module_permissions`
  ADD PRIMARY KEY (`user_group_id`,`module`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `newsletter_mails`
--
ALTER TABLE `newsletter_mails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `newsletter_mail_trackers`
--
ALTER TABLE `newsletter_mail_trackers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_details`
--
ALTER TABLE `notification_details`
  ADD PRIMARY KEY (`id`,`language_id`),
  ADD KEY `notification_details_ibfk_2` (`language_id`);

--
-- Indexes for table `notification_to_users`
--
ALTER TABLE `notification_to_users`
  ADD PRIMARY KEY (`id`,`notification_id`,`user_id`),
  ADD KEY `notification_id` (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `penalties`
--
ALTER TABLE `penalties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `leave_applications_ibfk_4` (`language_id`),
  ADD KEY `penalties_ibfk_2` (`penalty_reason_id`);

--
-- Indexes for table `penalty_reasons`
--
ALTER TABLE `penalty_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penalty_reason_details`
--
ALTER TABLE `penalty_reason_details`
  ADD UNIQUE KEY `id` (`id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

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
-- Indexes for table `todo_lists`
--
ALTER TABLE `todo_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `leave_applications_ibfk_4` (`language_id`);

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
-- Indexes for table `user_leaves`
--
ALTER TABLE `user_leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `leave_type_id` (`leave_type_id`);

--
-- Indexes for table `user_leave_authorities`
--
ALTER TABLE `user_leave_authorities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`author_id`),
  ADD KEY `author_id` (`author_id`);

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
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leave_applications`
--
ALTER TABLE `leave_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leave_reasons`
--
ALTER TABLE `leave_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leave_statuses`
--
ALTER TABLE `leave_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `newsletter_mails`
--
ALTER TABLE `newsletter_mails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `newsletter_mail_trackers`
--
ALTER TABLE `newsletter_mail_trackers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification_to_users`
--
ALTER TABLE `notification_to_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penalties`
--
ALTER TABLE `penalties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penalty_reasons`
--
ALTER TABLE `penalty_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plugins`
--
ALTER TABLE `plugins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=649;

--
-- AUTO_INCREMENT for table `todo_lists`
--
ALTER TABLE `todo_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_complains`
--
ALTER TABLE `user_complains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_leaves`
--
ALTER TABLE `user_leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_leave_authorities`
--
ALTER TABLE `user_leave_authorities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Constraints for table `holiday_details`
--
ALTER TABLE `holiday_details`
  ADD CONSTRAINT `holiday_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `holidays` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `holiday_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leave_applications`
--
ALTER TABLE `leave_applications`
  ADD CONSTRAINT `leave_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_applications_ibfk_2` FOREIGN KEY (`leave_reason_id`) REFERENCES `leave_reasons` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_applications_ibfk_3` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_applications_ibfk_4` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_applications_ibfk_5` FOREIGN KEY (`leave_status_id`) REFERENCES `leave_statuses` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `leave_reason_details`
--
ALTER TABLE `leave_reason_details`
  ADD CONSTRAINT `leave_reason_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `leave_reasons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_reason_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leave_status_details`
--
ALTER TABLE `leave_status_details`
  ADD CONSTRAINT `leave_status_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `leave_applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_status_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leave_type_details`
--
ALTER TABLE `leave_type_details`
  ADD CONSTRAINT `leave_type_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_type_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_permissions`
--
ALTER TABLE `module_permissions`
  ADD CONSTRAINT `module_permissions_ibfk_1` FOREIGN KEY (`user_group_id`) REFERENCES `user_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification_details`
--
ALTER TABLE `notification_details`
  ADD CONSTRAINT `notification_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification_to_users`
--
ALTER TABLE `notification_to_users`
  ADD CONSTRAINT `notification_to_users_ibfk_1` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_to_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penalties`
--
ALTER TABLE `penalties`
  ADD CONSTRAINT `penalties_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penalties_ibfk_2` FOREIGN KEY (`penalty_reason_id`) REFERENCES `leave_reasons` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `penalties_ibfk_3` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `penalty_reason_details`
--
ALTER TABLE `penalty_reason_details`
  ADD CONSTRAINT `penalty_reason_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `penalty_reasons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penalty_reason_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `todo_lists`
--
ALTER TABLE `todo_lists`
  ADD CONSTRAINT `todo_lists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `todo_lists_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON UPDATE CASCADE;

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

--
-- Constraints for table `user_leaves`
--
ALTER TABLE `user_leaves`
  ADD CONSTRAINT `user_leaves_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_leaves_ibfk_2` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_leave_authorities`
--
ALTER TABLE `user_leave_authorities`
  ADD CONSTRAINT `user_leave_authorities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_leave_authorities_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
