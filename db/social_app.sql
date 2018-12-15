-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2018 at 10:28 AM
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
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `banner` text NOT NULL,
  `image` text NOT NULL,
  `location` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `events_view`
-- (See below for the actual view)
--
CREATE TABLE `events_view` (
`id` int(11)
,`user_id` int(11)
,`from_date` datetime
,`to_date` datetime
,`banner` text
,`image` text
,`location` varchar(100)
,`latitude` varchar(20)
,`longitude` varchar(20)
,`status` tinyint(1)
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`language_id` int(11)
,`title` varchar(100)
,`description` text
,`user_name` varchar(100)
,`user_image` text
);

-- --------------------------------------------------------

--
-- Table structure for table `event_details`
--

CREATE TABLE `event_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Penalties', 1, 1, 1, 1),
(1, 'Penalty_reasons', 1, 1, 1, 1),
(1, 'Pets', 1, 1, 1, 1),
(1, 'Pet_levels', 1, 1, 1, 1),
(1, 'Pet_settings', 1, 1, 1, 1),
(1, 'Plugins', 1, 1, 1, 1),
(1, 'Products', 1, 1, 1, 1),
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

-- --------------------------------------------------------

--
-- Stand-in structure for view `notification_user_devices_view`
-- (See below for the actual view)
--
CREATE TABLE `notification_user_devices_view` (
`id` int(11)
,`notification_id` int(11)
,`user_id` int(11)
,`is_view` tinyint(1)
,`provider` varchar(20)
,`type` varchar(20)
,`code` text
);

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `pets_view`
-- (See below for the actual view)
--
CREATE TABLE `pets_view` (
`id` int(11)
,`image` text
,`status` tinyint(1)
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
-- Table structure for table `pet_details`
--

CREATE TABLE `pet_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pet_levels`
--

CREATE TABLE `pet_levels` (
  `id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `level` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `pet_levels_view`
-- (See below for the actual view)
--
CREATE TABLE `pet_levels_view` (
`id` int(11)
,`pet_id` int(11)
,`image` text
,`level` int(11)
,`points` int(11)
,`status` tinyint(1)
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
(84, 'Event Module', 'event_module', 1, 0, 0, '2018-12-15 14:54:59', '2018-12-15 14:54:59'),
(85, 'Story Module', 'story_module', 1, 0, 0, '2018-12-15 14:55:12', '2018-12-15 14:55:12'),
(86, 'Notifications Module', 'notifications_module', 1, 0, 0, '2018-12-15 14:55:22', '2018-12-15 14:55:22'),
(87, 'Pet Module', 'pet_module', 1, 0, 0, '2018-12-15 14:55:26', '2018-12-15 14:55:26'),
(88, 'User Activities Module', 'user_activities_module', 1, 0, 0, '2018-12-15 14:55:39', '2018-12-15 14:55:39'),
(89, 'User Complain Module', 'user_complain_module', 1, 0, 0, '2018-12-15 14:55:42', '2018-12-15 14:55:42');

-- --------------------------------------------------------

--
-- Table structure for table `save_stories`
--

CREATE TABLE `save_stories` (
  `story_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
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
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `banner` text NOT NULL,
  `receipt` text NOT NULL,
  `receipt_private` tinyint(1) NOT NULL,
  `location` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `stories_view`
-- (See below for the actual view)
--
CREATE TABLE `stories_view` (
`id` int(11)
,`user_id` int(11)
,`event_id` int(11)
,`image` text
,`banner` text
,`receipt` text
,`receipt_private` tinyint(1)
,`location` varchar(200)
,`status` tinyint(1)
,`latitude` varchar(100)
,`longitude` varchar(100)
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`language_id` int(11)
,`title` varchar(100)
,`description` text
,`html` text
,`likes` decimal(32,0)
,`dislikes` decimal(32,0)
,`totalLikes` decimal(33,0)
,`user_name` varchar(100)
,`user_image` text
);

-- --------------------------------------------------------

--
-- Table structure for table `story_comments`
--

CREATE TABLE `story_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `story_comments_view`
-- (See below for the actual view)
--
CREATE TABLE `story_comments_view` (
`id` int(11)
,`user_id` int(11)
,`story_id` int(11)
,`language_id` int(11)
,`comment` text
,`date` datetime
,`status` tinyint(1)
,`user_name` varchar(100)
,`user_image` text
);

-- --------------------------------------------------------

--
-- Table structure for table `story_complains`
--

CREATE TABLE `story_complains` (
  `id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `story_comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
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
-- Stand-in structure for view `story_complains_view`
-- (See below for the actual view)
--
CREATE TABLE `story_complains_view` (
`id` int(11)
,`story_id` int(11)
,`story_comment_id` int(11)
,`user_id` int(11)
,`language_id` int(11)
,`title` varchar(200)
,`description` text
,`status` tinyint(1)
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`user_name` varchar(100)
,`story_title` varchar(100)
,`comment` text
);

-- --------------------------------------------------------

--
-- Table structure for table `story_details`
--

CREATE TABLE `story_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `story_images`
--

CREATE TABLE `story_images` (
  `id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `link` text NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `story_image_details`
--

CREATE TABLE `story_image_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `story_rankings`
--

CREATE TABLE `story_rankings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `story_tags`
--

CREATE TABLE `story_tags` (
  `story_id` int(11) NOT NULL,
  `tag` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `story_to_types`
--

CREATE TABLE `story_to_types` (
  `story_id` int(11) NOT NULL,
  `story_type_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `story_types`
--

CREATE TABLE `story_types` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `is_upload` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `story_types`
--

INSERT INTO `story_types` (`id`, `image`, `is_upload`, `status`, `created_by`, `modified_by`, `created_date`, `modified_date`) VALUES
(1, 'upload/story_types/food.png', 1, 1, 0, 0, '2018-08-03 10:15:53', '2018-10-31 23:14:57'),
(2, 'upload/story_types/VectorSmartObject.png', 0, 1, 0, 0, '2018-08-11 14:15:15', '2018-10-31 23:16:19'),
(3, 'upload/story_types/world.png', 0, 1, 0, 0, '2018-08-11 14:15:41', '2018-10-31 23:15:42'),
(4, 'upload/story_types/VectorSmartObject.png', 0, 1, 0, 0, '2018-08-11 14:16:15', '2018-10-31 23:16:09'),
(5, 'upload/story_types/world.png', 0, 1, 0, 0, '2018-09-10 15:32:25', '2018-10-31 23:15:54'),
(6, 'upload/story_types/food.png', 1, 1, 0, 0, '2018-10-26 11:41:30', '2018-10-31 23:15:12');

-- --------------------------------------------------------

--
-- Stand-in structure for view `story_types_view`
-- (See below for the actual view)
--
CREATE TABLE `story_types_view` (
`id` int(11)
,`image` text
,`is_upload` tinyint(1)
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
-- Table structure for table `story_type_details`
--

CREATE TABLE `story_type_details` (
  `id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `story_type_details`
--

INSERT INTO `story_type_details` (`id`, `language_id`, `title`) VALUES
(1, 1, 'food'),
(1, 2, '餐饮'),
(2, 1, 'art'),
(2, 2, '艺术'),
(3, 1, 'adventure'),
(3, 2, '冒险'),
(4, 1, 'recreation'),
(4, 2, '娱乐'),
(5, 1, 'travels'),
(5, 2, '旅行'),
(6, 1, 'restaurants'),
(6, 2, '餐馆');

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
-- Table structure for table `user_activities`
--

CREATE TABLE `user_activities` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `type_id` int(11) NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_activities_view`
-- (See below for the actual view)
--
CREATE TABLE `user_activities_view` (
`id` int(11)
,`user_id` int(11)
,`language_id` int(11)
,`type` varchar(100)
,`type_id` int(11)
,`text` text
,`ip` varchar(40)
,`status` tinyint(1)
,`sort_order` int(11)
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`user_name` varchar(100)
,`user_image` text
);

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
-- Table structure for table `user_devices`
--

CREATE TABLE `user_devices` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `provider` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `code` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_devices_view`
-- (See below for the actual view)
--
CREATE TABLE `user_devices_view` (
`id` int(11)
,`user_id` int(11)
,`provider` varchar(20)
,`type` varchar(20)
,`code` text
,`status` tinyint(1)
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`user_name` varchar(100)
,`user_image` text
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
-- Table structure for table `user_pets`
--

CREATE TABLE `user_pets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_pets_view`
-- (See below for the actual view)
--
CREATE TABLE `user_pets_view` (
`id` int(11)
,`user_id` int(11)
,`pet_id` int(11)
,`level` int(11)
,`status` tinyint(1)
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`user_name` varchar(100)
,`language_id` int(11)
,`pet_name` varchar(100)
,`pet_description` text
,`pet_points` int(11)
,`pet_image` text
);

-- --------------------------------------------------------

--
-- Table structure for table `user_pet_points`
--

CREATE TABLE `user_pet_points` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_pet_points_view`
-- (See below for the actual view)
--
CREATE TABLE `user_pet_points_view` (
`id` int(11)
,`user_id` int(11)
,`points` int(11)
,`description` text
,`status` tinyint(1)
,`created_by` int(11)
,`modified_by` int(11)
,`created_date` datetime
,`modified_date` datetime
,`user_name` varchar(100)
,`user_image` text
,`user_email` varchar(200)
);

-- --------------------------------------------------------

--
-- Structure for view `events_view`
--
DROP TABLE IF EXISTS `events_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `events_view`  AS  select `t`.`id` AS `id`,`t`.`user_id` AS `user_id`,`t`.`from_date` AS `from_date`,`t`.`to_date` AS `to_date`,`t`.`banner` AS `banner`,`t`.`image` AS `image`,`t`.`location` AS `location`,`t`.`latitude` AS `latitude`,`t`.`longitude` AS `longitude`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title`,`td`.`description` AS `description`,`u`.`name` AS `user_name`,`u`.`image` AS `user_image` from ((`events` `t` left join `event_details` `td` on((`td`.`id` = `t`.`id`))) left join `users` `u` on((`u`.`id` = `t`.`user_id`))) ;

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
-- Structure for view `notifications_view`
--
DROP TABLE IF EXISTS `notifications_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `notifications_view`  AS  select `n`.`id` AS `id`,`n`.`image` AS `image`,`n`.`type` AS `type`,`n`.`type_id` AS `type_id`,`n`.`status` AS `status`,`n`.`sort_order` AS `sort_order`,`n`.`created_by` AS `created_by`,`n`.`modified_by` AS `modified_by`,`n`.`created_date` AS `created_date`,`n`.`modified_date` AS `modified_date`,`nd`.`language_id` AS `language_id`,`nd`.`title` AS `title`,`nd`.`description` AS `description` from (`notifications` `n` left join `notification_details` `nd` on((`nd`.`id` = `n`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `notification_user_devices_view`
--
DROP TABLE IF EXISTS `notification_user_devices_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `notification_user_devices_view`  AS  select `ntu`.`id` AS `id`,`ntu`.`notification_id` AS `notification_id`,`ntu`.`user_id` AS `user_id`,`ntu`.`is_view` AS `is_view`,`ud`.`provider` AS `provider`,`ud`.`type` AS `type`,`ud`.`code` AS `code` from (`notification_to_users` `ntu` left join `user_devices` `ud` on((`ud`.`user_id` = `ntu`.`user_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `pets_view`
--
DROP TABLE IF EXISTS `pets_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `pets_view`  AS  select `p`.`id` AS `id`,`p`.`image` AS `image`,`p`.`status` AS `status`,`p`.`created_by` AS `created_by`,`p`.`modified_by` AS `modified_by`,`p`.`created_date` AS `created_date`,`p`.`modified_date` AS `modified_date`,`pd`.`language_id` AS `language_id`,`pd`.`title` AS `title`,`pd`.`description` AS `description` from (`pets` `p` left join `pet_details` `pd` on((`pd`.`id` = `p`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `pet_levels_view`
--
DROP TABLE IF EXISTS `pet_levels_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `pet_levels_view`  AS  select `pl`.`id` AS `id`,`pl`.`pet_id` AS `pet_id`,`pl`.`image` AS `image`,`pl`.`level` AS `level`,`pl`.`points` AS `points`,`pl`.`status` AS `status`,`pl`.`created_by` AS `created_by`,`pl`.`modified_by` AS `modified_by`,`pl`.`created_date` AS `created_date`,`pl`.`modified_date` AS `modified_date`,`pd`.`language_id` AS `language_id`,`pd`.`title` AS `title`,`pd`.`description` AS `description` from ((`pet_levels` `pl` left join `pets` `p` on((`p`.`id` = `pl`.`pet_id`))) left join `pet_details` `pd` on((`pd`.`id` = `pl`.`pet_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `stories_view`
--
DROP TABLE IF EXISTS `stories_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `stories_view`  AS  select `t`.`id` AS `id`,`t`.`user_id` AS `user_id`,`t`.`event_id` AS `event_id`,`t`.`image` AS `image`,`t`.`banner` AS `banner`,`t`.`receipt` AS `receipt`,`t`.`receipt_private` AS `receipt_private`,`t`.`location` AS `location`,`t`.`status` AS `status`,`t`.`latitude` AS `latitude`,`t`.`longitude` AS `longitude`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title`,`td`.`description` AS `description`,`td`.`html` AS `html`,(select sum(`sr`.`likes`) from `story_rankings` `sr` where (`sr`.`story_id` = `t`.`id`)) AS `likes`,(select sum(`sr`.`dislikes`) from `story_rankings` `sr` where (`sr`.`story_id` = `t`.`id`)) AS `dislikes`,(select (sum(`sr`.`likes`) - sum(`sr`.`dislikes`)) from `story_rankings` `sr` where (`sr`.`story_id` = `t`.`id`)) AS `totalLikes`,`u`.`name` AS `user_name`,`u`.`image` AS `user_image` from ((`stories` `t` left join `story_details` `td` on((`td`.`id` = `t`.`id`))) left join `users` `u` on((`u`.`id` = `t`.`user_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `story_comments_view`
--
DROP TABLE IF EXISTS `story_comments_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `story_comments_view`  AS  select `sc`.`id` AS `id`,`sc`.`user_id` AS `user_id`,`sc`.`story_id` AS `story_id`,`sc`.`language_id` AS `language_id`,`sc`.`comment` AS `comment`,`sc`.`date` AS `date`,`sc`.`status` AS `status`,`u`.`name` AS `user_name`,`u`.`image` AS `user_image` from (`story_comments` `sc` left join `users` `u` on((`u`.`id` = `sc`.`user_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `story_complains_view`
--
DROP TABLE IF EXISTS `story_complains_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `story_complains_view`  AS  select `sc`.`id` AS `id`,`sc`.`story_id` AS `story_id`,`sc`.`story_comment_id` AS `story_comment_id`,`sc`.`user_id` AS `user_id`,`sc`.`language_id` AS `language_id`,`sc`.`title` AS `title`,`sc`.`description` AS `description`,`sc`.`status` AS `status`,`sc`.`created_by` AS `created_by`,`sc`.`modified_by` AS `modified_by`,`sc`.`created_date` AS `created_date`,`sc`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name`,`sd`.`title` AS `story_title`,`sm`.`comment` AS `comment` from ((((`story_complains` `sc` left join `stories` `s` on((`s`.`id` = `sc`.`story_id`))) left join `story_details` `sd` on((`sd`.`id` = `sc`.`story_id`))) left join `story_comments` `sm` on(((`sm`.`id` = `sc`.`story_comment_id`) and (`sm`.`story_id` = `sc`.`story_id`) and (`sc`.`language_id` = `sc`.`language_id`)))) left join `users` `u` on((`u`.`id` = `sc`.`user_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `story_types_view`
--
DROP TABLE IF EXISTS `story_types_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `story_types_view`  AS  select `t`.`id` AS `id`,`t`.`image` AS `image`,`t`.`is_upload` AS `is_upload`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title` from (`story_types` `t` left join `story_type_details` `td` on((`td`.`id` = `t`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `user_activities_view`
--
DROP TABLE IF EXISTS `user_activities_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `user_activities_view`  AS  select `ua`.`id` AS `id`,`ua`.`user_id` AS `user_id`,`ua`.`language_id` AS `language_id`,`ua`.`type` AS `type`,`ua`.`type_id` AS `type_id`,`ua`.`text` AS `text`,`ua`.`ip` AS `ip`,`ua`.`status` AS `status`,`ua`.`sort_order` AS `sort_order`,`ua`.`created_by` AS `created_by`,`ua`.`modified_by` AS `modified_by`,`ua`.`created_date` AS `created_date`,`ua`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name`,`u`.`image` AS `user_image` from (`user_activities` `ua` left join `users` `u` on((`u`.`id` = `ua`.`user_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `user_complains_view`
--
DROP TABLE IF EXISTS `user_complains_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `user_complains_view`  AS  select `uc`.`id` AS `id`,`uc`.`user_id` AS `user_id`,`uc`.`complain_by` AS `complain_by`,`uc`.`language_id` AS `language_id`,`uc`.`title` AS `title`,`uc`.`description` AS `description`,`uc`.`status` AS `status`,`uc`.`created_by` AS `created_by`,`uc`.`modified_by` AS `modified_by`,`uc`.`created_date` AS `created_date`,`uc`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name`,`cmb`.`name` AS `complain_by_name` from ((`user_complains` `uc` left join `users` `u` on((`u`.`id` = `uc`.`user_id`))) left join `users` `cmb` on((`cmb`.`id` = `uc`.`complain_by`))) ;

-- --------------------------------------------------------

--
-- Structure for view `user_devices_view`
--
DROP TABLE IF EXISTS `user_devices_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `user_devices_view`  AS  select `ud`.`id` AS `id`,`ud`.`user_id` AS `user_id`,`ud`.`provider` AS `provider`,`ud`.`type` AS `type`,`ud`.`code` AS `code`,`ud`.`status` AS `status`,`ud`.`created_by` AS `created_by`,`ud`.`modified_by` AS `modified_by`,`ud`.`created_date` AS `created_date`,`ud`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name`,`u`.`image` AS `user_image` from (`user_devices` `ud` left join `users` `u` on((`u`.`id` = `ud`.`user_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `user_groups_view`
--
DROP TABLE IF EXISTS `user_groups_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `user_groups_view`  AS  select `t`.`id` AS `id`,`t`.`image` AS `image`,`t`.`banner` AS `banner`,`t`.`status` AS `status`,`t`.`created_by` AS `created_by`,`t`.`modified_by` AS `modified_by`,`t`.`created_date` AS `created_date`,`t`.`modified_date` AS `modified_date`,`td`.`language_id` AS `language_id`,`td`.`title` AS `title` from (`user_groups` `t` left join `user_group_details` `td` on((`td`.`id` = `t`.`id`))) ;

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Structure for view `user_notifications_view`
--
DROP TABLE IF EXISTS `user_notifications_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `user_notifications_view`  AS  select `n`.`id` AS `id`,`n`.`image` AS `image`,`n`.`type` AS `type`,`n`.`type_id` AS `type_id`,`n`.`status` AS `status`,`n`.`sort_order` AS `sort_order`,`n`.`created_by` AS `created_by`,`n`.`modified_by` AS `modified_by`,`n`.`created_date` AS `created_date`,`n`.`modified_date` AS `modified_date`,`nd`.`language_id` AS `language_id`,`nd`.`title` AS `title`,`nd`.`description` AS `description`,`ntu`.`id` AS `user_notification_id`,`ntu`.`user_id` AS `user_id`,`ntu`.`is_view` AS `is_view` from ((`notifications` `n` left join `notification_details` `nd` on((`nd`.`id` = `n`.`id`))) left join `notification_to_users` `ntu` on((`ntu`.`notification_id` = `n`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `user_pets_view`
--
DROP TABLE IF EXISTS `user_pets_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `user_pets_view`  AS  select `up`.`id` AS `id`,`up`.`user_id` AS `user_id`,`up`.`pet_id` AS `pet_id`,`up`.`level` AS `level`,`up`.`status` AS `status`,`up`.`created_by` AS `created_by`,`up`.`modified_by` AS `modified_by`,`up`.`created_date` AS `created_date`,`up`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name`,`pd`.`language_id` AS `language_id`,`pd`.`title` AS `pet_name`,`pd`.`description` AS `pet_description`,`pl`.`points` AS `pet_points`,`pl`.`image` AS `pet_image` from ((((`user_pets` `up` left join `users` `u` on((`u`.`id` = `up`.`user_id`))) left join `pets` `p` on((`p`.`id` = `up`.`pet_id`))) left join `pet_details` `pd` on((`pd`.`id` = `up`.`pet_id`))) left join `pet_levels` `pl` on(((`pl`.`pet_id` = `up`.`pet_id`) and (`pl`.`level` = `up`.`level`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `user_pet_points_view`
--
DROP TABLE IF EXISTS `user_pet_points_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `user_pet_points_view`  AS  select `upp`.`id` AS `id`,`upp`.`user_id` AS `user_id`,`upp`.`points` AS `points`,`upp`.`description` AS `description`,`upp`.`status` AS `status`,`upp`.`created_by` AS `created_by`,`upp`.`modified_by` AS `modified_by`,`upp`.`created_date` AS `created_date`,`upp`.`modified_date` AS `modified_date`,`u`.`name` AS `user_name`,`u`.`image` AS `user_image`,`u`.`email` AS `user_email` from (`user_pet_points` `upp` left join `users` `u` on((`u`.`id` = `upp`.`user_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_details`
--
ALTER TABLE `event_details`
  ADD UNIQUE KEY `id` (`id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

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
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_details`
--
ALTER TABLE `pet_details`
  ADD UNIQUE KEY `id` (`id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `pet_levels`
--
ALTER TABLE `pet_levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`pet_id`,`level`,`points`),
  ADD KEY `pet_levels_ibfk_1` (`pet_id`);

--
-- Indexes for table `plugins`
--
ALTER TABLE `plugins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `save_stories`
--
ALTER TABLE `save_stories`
  ADD UNIQUE KEY `story_id` (`story_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`code`,`code_key`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `story_comments`
--
ALTER TABLE `story_comments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`language_id`),
  ADD KEY `language_id` (`language_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `story_id` (`story_id`);

--
-- Indexes for table `story_complains`
--
ALTER TABLE `story_complains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `story_id` (`story_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `story_details`
--
ALTER TABLE `story_details`
  ADD UNIQUE KEY `id` (`id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `story_images`
--
ALTER TABLE `story_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `story_id` (`story_id`);

--
-- Indexes for table `story_image_details`
--
ALTER TABLE `story_image_details`
  ADD UNIQUE KEY `id` (`id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `story_rankings`
--
ALTER TABLE `story_rankings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `story_id` (`story_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `story_tags`
--
ALTER TABLE `story_tags`
  ADD KEY `story_id` (`story_id`);

--
-- Indexes for table `story_to_types`
--
ALTER TABLE `story_to_types`
  ADD KEY `blog_id` (`story_id`),
  ADD KEY `blog_type_id` (`story_type_id`);

--
-- Indexes for table `story_types`
--
ALTER TABLE `story_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `story_type_details`
--
ALTER TABLE `story_type_details`
  ADD UNIQUE KEY `id` (`id`,`language_id`),
  ADD KEY `language_id` (`language_id`);

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
-- Indexes for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_activities_ibfk_2` (`language_id`);

--
-- Indexes for table `user_complains`
--
ALTER TABLE `user_complains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `language_id` (`language_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `complain_by` (`complain_by`);

--
-- Indexes for table `user_devices`
--
ALTER TABLE `user_devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- Indexes for table `user_pets`
--
ALTER TABLE `user_pets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`,`pet_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `user_pet_points`
--
ALTER TABLE `user_pet_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notification_to_users`
--
ALTER TABLE `notification_to_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pet_levels`
--
ALTER TABLE `pet_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `plugins`
--
ALTER TABLE `plugins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=649;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `story_comments`
--
ALTER TABLE `story_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `story_complains`
--
ALTER TABLE `story_complains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `story_images`
--
ALTER TABLE `story_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `story_rankings`
--
ALTER TABLE `story_rankings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `story_types`
--
ALTER TABLE `story_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_complains`
--
ALTER TABLE `user_complains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_devices`
--
ALTER TABLE `user_devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_pets`
--
ALTER TABLE `user_pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_pet_points`
--
ALTER TABLE `user_pet_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_details`
--
ALTER TABLE `event_details`
  ADD CONSTRAINT `event_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `pet_details`
--
ALTER TABLE `pet_details`
  ADD CONSTRAINT `pet_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pet_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pet_levels`
--
ALTER TABLE `pet_levels`
  ADD CONSTRAINT `pet_levels_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `save_stories`
--
ALTER TABLE `save_stories`
  ADD CONSTRAINT `save_stories_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `save_stories_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `story_comments`
--
ALTER TABLE `story_comments`
  ADD CONSTRAINT `story_comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_comments_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_comments_ibfk_3` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `story_complains`
--
ALTER TABLE `story_complains`
  ADD CONSTRAINT `story_complains_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_complains_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `story_details`
--
ALTER TABLE `story_details`
  ADD CONSTRAINT `story_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `story_images`
--
ALTER TABLE `story_images`
  ADD CONSTRAINT `story_images_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `story_image_details`
--
ALTER TABLE `story_image_details`
  ADD CONSTRAINT `story_image_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `story_images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_image_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `story_rankings`
--
ALTER TABLE `story_rankings`
  ADD CONSTRAINT `story_rankings_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_rankings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `story_tags`
--
ALTER TABLE `story_tags`
  ADD CONSTRAINT `story_tags_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `story_to_types`
--
ALTER TABLE `story_to_types`
  ADD CONSTRAINT `story_to_types_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_to_types_ibfk_2` FOREIGN KEY (`story_type_id`) REFERENCES `story_types` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `story_type_details`
--
ALTER TABLE `story_type_details`
  ADD CONSTRAINT `story_type_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `story_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_type_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `url_alias`
--
ALTER TABLE `url_alias`
  ADD CONSTRAINT `url_alias_ibfk_1` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD CONSTRAINT `user_activities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_activities_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_complains`
--
ALTER TABLE `user_complains`
  ADD CONSTRAINT `user_complains_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_complains_ibfk_2` FOREIGN KEY (`complain_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_complains_ibfk_3` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_devices`
--
ALTER TABLE `user_devices`
  ADD CONSTRAINT `user_devices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_group_details`
--
ALTER TABLE `user_group_details`
  ADD CONSTRAINT `user_group_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_group_details_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_pets`
--
ALTER TABLE `user_pets`
  ADD CONSTRAINT `user_pets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_pets_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_pet_points`
--
ALTER TABLE `user_pet_points`
  ADD CONSTRAINT `user_pet_points_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
