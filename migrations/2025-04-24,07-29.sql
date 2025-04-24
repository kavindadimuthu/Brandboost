-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 07:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brandboost`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `action_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `action_type` enum('user_banned','user_blocked','order_reversed','order_canceled','user_inactive','user_active') NOT NULL,
  `action_note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`action_id`, `admin_id`, `user_id`, `order_id`, `action_type`, `action_note`, `created_at`) VALUES
(1, 1, 3, NULL, '', 'Order reversed due to dispute.', '2025-01-06 03:10:21'),
(2, 2, 4, NULL, '', 'Customer requested cancellation.', '2025-01-06 03:10:21'),
(3, 4, 43, NULL, '', 'User account status changed to inactive', '2025-04-17 12:59:13'),
(4, 4, 43, NULL, 'user_active', 'User account status changed to active', '2025-04-17 13:03:51'),
(5, 4, 41, NULL, 'user_blocked', 'User account status changed to blocked', '2025-04-18 01:45:04'),
(6, 4, 27, NULL, 'user_banned', 'User account status changed to banned', '2025-04-18 01:45:16'),
(7, 4, 27, NULL, 'user_inactive', 'User account status changed to inactive', '2025-04-18 01:45:21'),
(8, 4, 27, NULL, 'user_blocked', 'User account status changed to blocked', '2025-04-18 01:45:26'),
(9, 4, 27, NULL, 'user_active', 'User account status changed to active', '2025-04-18 01:45:30'),
(10, 4, 27, NULL, 'user_banned', 'User account status changed to banned', '2025-04-18 01:45:34'),
(11, 4, 27, NULL, 'user_inactive', 'User account status changed to inactive', '2025-04-18 01:45:37'),
(12, 4, 27, NULL, 'user_blocked', 'User account status changed to blocked', '2025-04-18 01:45:40'),
(13, 4, 27, NULL, 'user_blocked', 'User account status changed to blocked', '2025-04-18 01:45:44'),
(14, 4, 27, NULL, 'user_active', 'User account status changed to active', '2025-04-18 01:45:47'),
(15, 4, 1, NULL, 'user_banned', 'User account status changed to banned', '2025-04-18 11:04:29'),
(16, 4, 1, NULL, 'user_active', 'User account status changed to active', '2025-04-18 11:05:06'),
(17, 4, 24, NULL, 'user_banned', 'User account status changed to banned', '2025-04-18 14:14:04'),
(18, 4, 24, NULL, 'user_blocked', 'User account status changed to blocked', '2025-04-18 14:15:52'),
(19, 4, 24, NULL, 'user_banned', 'User account status changed to banned', '2025-04-18 14:16:12'),
(20, 4, 1, NULL, 'user_banned', 'User account status changed to banned', '2025-04-18 14:16:46'),
(21, 4, 1, NULL, 'user_active', 'User account status changed to active', '2025-04-18 14:17:01'),
(22, 4, 24, NULL, 'user_active', 'User account status changed to active', '2025-04-18 14:17:11'),
(23, 4, 1, NULL, 'user_blocked', 'User account status changed to blocked', '2025-04-20 11:06:36'),
(24, 4, 24, NULL, 'user_banned', 'User account status changed to banned', '2025-04-23 11:49:53'),
(25, 4, 24, NULL, 'user_active', 'User account status changed to active', '2025-04-23 11:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Admin1', 'admin1@brandboost.lk', '$2y$10$8K7zgqpeY57peox0O2rFse5/zC9hPeF2.3dJfVw/0ZQJ3kQhmbK2K', '2025-01-06 03:10:21'),
(2, 'Admin2', 'admin2@brandboost.lk', '$2y$10$8K7zgqpeY57peox0O2rFse5/zC9hPeF2.3dJfVw/0ZQJ3kQhmbK2K', '2025-01-06 03:10:21'),
(4, 'Ajohn', 'admin@m.com', '$2y$10$fvlJlCeLnaKIqsyRSFnhlezy1M09HunOva4H94Mfbsd/jGITPSItO', '2025-01-05 04:56:11'),
(5, 'John Admin', 'admin@admin.com', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '2024-12-31 05:13:04'),
(6, 'kavinda', 'kavinda@gmail', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '2024-12-29 17:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `businessman`
--

CREATE TABLE `businessman` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `business_name` varchar(100) NOT NULL,
  `business_type` varchar(100) NOT NULL,
  `br_document` varchar(255) NOT NULL,
  `br_status` enum('pending','verified','rejected') NOT NULL DEFAULT 'pending',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `businessman`
--

INSERT INTO `businessman` (`user_id`, `business_name`, `business_type`, `br_document`, `br_status`, `updated_at`) VALUES
(1, 'Lanka Enterprises', 'Planning', 'br_docs_1.pdf', 'verified', '2025-04-17 12:48:14'),
(2, 'Colombo Traders', 'Stock Market', 'br_docs_2.pdf', 'pending', '2025-04-17 12:48:10'),
(24, 'Hayleys', 'Agricultural', 'cdn_uploads/users/business_registration/67fe9f9fa4716.jpg', 'verified', '2025-04-18 20:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `message_id` int(10) UNSIGNED NOT NULL,
  `chat_room_id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivered_at` timestamp NULL DEFAULT NULL,
  `read_status` enum('unsent','sent','delivered','read') NOT NULL DEFAULT 'unsent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`message_id`, `chat_room_id`, `sender_id`, `receiver_id`, `message`, `created_at`, `delivered_at`, `read_status`) VALUES
(1, 1, 1, 3, 'Hello, I am interested in your services.', '2025-01-06 03:10:21', '2025-01-06 03:10:21', 'read'),
(2, 2, 2, 4, 'Can we discuss more about the project?', '2025-01-06 03:10:21', NULL, ''),
(3, 3, 1, 2, 'ds', '2025-04-21 16:37:31', NULL, 'sent');

-- --------------------------------------------------------

--
-- Table structure for table `chat_room`
--

CREATE TABLE `chat_room` (
  `chat_room_id` int(10) UNSIGNED NOT NULL,
  `user_1` int(10) UNSIGNED NOT NULL,
  `user_2` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_room`
--

INSERT INTO `chat_room` (`chat_room_id`, `user_1`, `user_2`, `created_at`) VALUES
(1, 1, 3, '2025-01-06 03:10:21'),
(2, 2, 4, '2025-01-06 03:10:21'),
(3, 1, 2, '2025-04-21 16:37:31');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `complainant_user_id` int(10) UNSIGNED NOT NULL,
  `reported_user_id` int(10) UNSIGNED NOT NULL,
  `complaint_type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('open','resolved','pending') NOT NULL DEFAULT 'open',
  `resolved_by_admin_id` int(10) UNSIGNED DEFAULT NULL,
  `resolution_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `order_id`, `complainant_user_id`, `reported_user_id`, `complaint_type`, `description`, `status`, `resolved_by_admin_id`, `resolution_notes`, `created_at`, `updated_at`) VALUES
(3, 27, 3, 1, 'Content', 'User posted inappropriate content that violates community guidelines.', 'pending', NULL, NULL, '2025-04-07 23:28:09', '2025-04-20 02:53:51'),
(6, 32, 4, 23, 'Account Access', 'Unable to access my account despite multiple password reset attempts.', 'open', NULL, NULL, '2025-04-18 23:32:27', '2025-04-18 23:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `designer_project`
--

CREATE TABLE `designer_project` (
  `project_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `image_1` varchar(255) DEFAULT NULL,
  `image_2` varchar(255) DEFAULT NULL,
  `image_3` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designer_project`
--

INSERT INTO `designer_project` (`project_id`, `user_id`, `title`, `description`, `image_1`, `image_2`, `image_3`, `created_at`, `updated_at`) VALUES
(2, 1, 'Unilever Add', 'sdvagvbaef', 'cdn_uploads/users/portfolio_projects/67ff25faa5b46.png', 'cdn_uploads/users/portfolio_projects/67ff25faa6677.jpg', 'cdn_uploads/users/portfolio_projects/67ff23c45624e.webp', '2025-04-15 04:25:52', '2025-04-16 03:37:30'),
(4, 1, 'milo', 'ut,kry6lil,y,yl,ytkuny', 'cdn_uploads/users/portfolio_projects/67ff3071121f8.jpg', 'cdn_uploads/users/portfolio_projects/67ff307113347.jpeg', 'cdn_uploads/users/portfolio_projects/67ff307113e88.jpg', '2025-04-16 04:22:09', '2025-04-16 04:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `influencer_social_account`
--

CREATE TABLE `influencer_social_account` (
  `account_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `platform` enum('Instagram','YouTube','TikTok','Facebook','Twitter','LinkedIn','Other') NOT NULL,
  `username` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `link_status` enum('pending','verified','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `influencer_social_account`
--

INSERT INTO `influencer_social_account` (`account_id`, `user_id`, `platform`, `username`, `link`, `link_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Instagram', 'updated_insta', 'https://instagram.com/influencer1', 'pending', '2025-01-06 03:10:21', '2025-01-17 00:26:35'),
(2, 2, 'YouTube', 'influencer2', 'https://youtube.com/influencer2', 'pending', '2025-01-06 03:10:21', '2025-01-06 03:10:21'),
(104, 2, 'YouTube', 'Rachell', 'https://testYT.com/test', 'verified', '2025-01-17 00:28:56', '2025-04-17 12:21:00'),
(108, 25, 'YouTube', 'mitchell', 'http://localhost:8000/designer/gootyjt', 'rejected', '2025-04-16 03:38:26', '2025-04-17 12:18:54'),
(109, 25, 'Facebook', 'danush', 'http://localhost:8000/destrhryjmrjn', 'verified', '2025-04-16 04:00:19', '2025-04-17 11:15:58'),
(110, 25, 'Instagram', 'kaushi', 'http://localhost:8000/influencer/edit-profiledfhsed', 'verified', '2025-04-17 10:56:51', '2025-04-17 12:05:30'),
(111, 25, 'Instagram', 'dfgbdbh', 'http://localhost:8000/influencer/edit-profiledfhseddfhfsgjn', 'verified', '2025-04-17 10:56:51', '2025-04-20 16:35:58'),
(112, 25, 'Instagram', 'dsefgewrh', 'http://localhost:8000/influencer/edit-profiledfhsedfdsbh', 'rejected', '2025-04-17 10:56:51', '2025-04-17 12:31:43'),
(113, 25, 'Instagram', 'dgvrthyw3q45th', 'http://localhost:8000/influencer/edit-profileedwryq345r', 'pending', '2025-04-17 10:56:51', '2025-04-17 10:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(10) UNSIGNED NOT NULL,
  `generated_by` enum('system','admin') NOT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `generation_note` text DEFAULT NULL,
  `notification` text NOT NULL,
  `read_status` enum('unread','read') NOT NULL DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `generated_by`, `admin_id`, `receiver_id`, `generation_note`, `notification`, `read_status`, `created_at`) VALUES
(1, 'system', NULL, 1, 'Your service is now live!', 'Service Approved', 'unread', '2025-01-06 03:10:21'),
(2, 'admin', 1, 2, 'Please update your BR document.', 'BR Update Required', 'read', '2025-01-06 03:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED DEFAULT NULL,
  `custom_package_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_type` enum('credit_card','paypal','bank_transfer','other') NOT NULL,
  `delivered_date` date DEFAULT NULL,
  `remained_revisions` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_status` enum('pending','in_progress','completed','canceled','disputed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `service_id`, `customer_id`, `seller_id`, `package_id`, `custom_package_id`, `payment_type`, `delivered_date`, `remained_revisions`, `order_status`, `created_at`) VALUES
(27, 42, 24, 1, 54, NULL, 'paypal', NULL, 0, 'pending', '2025-01-18 15:14:13'),
(28, 42, 24, 1, 54, NULL, 'paypal', NULL, 0, 'pending', '2025-01-18 15:14:53'),
(29, 42, 24, 1, 54, NULL, 'paypal', NULL, 2, 'pending', '2025-01-18 15:16:00'),
(30, 42, 24, 1, 54, NULL, 'paypal', NULL, 2, 'completed', '2025-01-18 15:19:02'),
(31, 42, 24, 1, 54, NULL, 'paypal', NULL, 2, 'pending', '2025-01-18 15:24:54'),
(32, 18, 24, 23, 18, NULL, 'paypal', NULL, 1, 'pending', '2025-01-19 08:11:15'),
(33, 45, 24, 1, 60, NULL, 'paypal', NULL, 4, 'pending', '2025-01-19 08:40:00'),
(34, 45, 24, 15, 60, NULL, 'paypal', NULL, 4, 'in_progress', '2025-01-19 08:40:27'),
(35, 18, 1, 17, 18, NULL, 'paypal', NULL, 1, 'pending', '2025-01-22 03:18:57'),
(39, 136, 24, 15, 102, NULL, 'paypal', NULL, 3, 'pending', '2025-02-19 02:19:34'),
(40, 136, 24, 17, 102, NULL, 'paypal', NULL, 3, 'completed', '2025-02-19 02:45:38'),
(41, 136, 1, 23, 102, NULL, 'paypal', NULL, 3, 'pending', '2025-03-04 09:04:18'),
(42, 138, 24, 42, 106, NULL, 'paypal', NULL, 6, 'pending', '2025-03-04 09:08:37'),
(43, 59, 24, 42, 88, NULL, 'paypal', NULL, 2, 'canceled', '2025-04-09 12:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `order_deliveries`
--

CREATE TABLE `order_deliveries` (
  `delivery_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `revision_number` int(10) UNSIGNED NOT NULL,
  `revision_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revision_files` longtext NOT NULL COMMENT 'files need to upload when requesting a revision',
  `delivery_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliveries` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status` enum('pending','submitted','accepted','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_deliveries`
--

INSERT INTO `order_deliveries` (`delivery_id`, `order_id`, `revision_number`, `revision_note`, `revision_files`, `delivery_note`, `deliveries`, `status`, `delivered_at`, `created_at`) VALUES
(1, 41, 1, 'revision note', 'cdn_uploads/services/678d0975064dd.jpg', 'delivery note', 'cdn_uploads/services/678d0975064dd.jpg', 'pending', '2025-04-17 05:29:48', '2025-04-18 05:30:44'),
(14, 42, 2, NULL, '', 'dsadasd', '[{\"name\":\"screenshot_1.png\",\"path\":\"cdn_uploads\\/services\\/\\/delivery_68073fd9bc718.png\",\"url\":\"cdn_uploads\\/services\\/delivery_68073fd9bc718.png\",\"size\":163285,\"type\":\"image\\/png\"}]', '', '2025-04-22 01:36:01', '2025-04-22 01:36:01'),
(15, 39, 0, NULL, '', 'dsad', '[{\"name\":\"screenshot_1.png\",\"path\":\"cdn_uploads\\/services\\/\\/delivery_680748aacd713.png\",\"url\":\"cdn_uploads\\/services\\/delivery_680748aacd713.png\",\"size\":7034,\"type\":\"image\\/jpeg\"}]', '', '2025-04-22 02:13:38', '2025-04-22 02:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `order_promises`
--

CREATE TABLE `order_promises` (
  `promise_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `accepted_service` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`accepted_service`)),
  `requested_service` longtext NOT NULL,
  `delivery_days` int(10) UNSIGNED NOT NULL,
  `number_of_revisions` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_promises`
--

INSERT INTO `order_promises` (`promise_id`, `order_id`, `accepted_service`, `requested_service`, `delivery_days`, `number_of_revisions`, `price`) VALUES
(21, 27, '{\"title\":\"New Stunning Website UI\\/UX Design for Enhanced User Experience\",\"description\":\"I will create intuitive, visually appealing UI\\/UX designs to make your website stand out.\",\"delivery_formats\":\"ai\",\"benefits\":\"Get 1 custom webpage design with a clean layout, responsive elements, Includes 1 revision.\",\"serviceType\":\"Gig\"}', '', 6, 2, 40.00),
(22, 28, '{\"title\":\"New Stunning Website UI\\/UX Design for Enhanced User Experience\",\"description\":\"I will create intuitive, visually appealing UI\\/UX designs to make your website stand out.\",\"delivery_formats\":\"ai\",\"benefits\":\"Get 1 custom webpage design with a clean layout, responsive elements, Includes 1 revision.\"}', '', 50, 2, 40.00),
(23, 29, '{\"title\":\"New Stunning Website UI\\/UX Design for Enhanced User Experience\",\"description\":\"I will create intuitive, visually appealing UI\\/UX designs to make your website stand out.\",\"delivery_formats\":\"ai\",\"benefits\":\"Get 1 custom webpage design with a clean layout, responsive elements, Includes 1 revision.\"}', '', 6, 2, 40.00),
(24, 30, '{\"title\":\"New Stunning Website UI\\/UX Design for Enhanced User Experience\",\"description\":\"I will create intuitive, visually appealing UI\\/UX designs to make your website stand out.\",\"delivery_formats\":\"ai\",\"benefits\":\"Get 1 custom webpage design with a clean layout, responsive elements, Includes 1 revision.\"}', '', 6, 2, 40.00),
(25, 31, '{\"title\":\"New Stunning Website UI\\/UX Design for Enhanced User Experience\",\"description\":\"I will create intuitive, visually appealing UI\\/UX designs to make your website stand out.\",\"delivery_formats\":\"ai\",\"benefits\":\"Get 1 custom webpage design with a clean layout, responsive elements, Includes 1 revision.\"}', '', 6, 2, 40.00),
(26, 32, '{\"title\":\"sri lanka\",\"description\":\"I will create a professional logo tailored to your brand.\",\"delivery_formats\":\"[\\\"jpg\\\",\\\"png\\\",\\\"psd\\\"]\",\"benefits\":\"Simple logo design with one revision\",\"service_type\":\"gig\"}', '', 2, 1, 50.00),
(27, 33, '{\"title\":\"Ship category (engineering) presentation.pptx\",\"description\":\"jfyhhhmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmn\",\"delivery_formats\":\"[\\\"jpg\\\",\\\"png\\\",\\\"psd\\\"]\",\"benefits\":\"sfv\",\"service_type\":\"gig\"}', '', 4, 4, 80.00),
(28, 34, '{\"title\":\"Ship category (engineering) presentation.pptx\",\"description\":\"jfyhhhmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmn\",\"delivery_formats\":\"[\\\"jpg\\\",\\\"png\\\",\\\"psd\\\"]\",\"benefits\":\"sfv\",\"service_type\":\"gig\"}', '', 4, 4, 80.00),
(29, 35, '{\"title\":\"sri lanka\",\"description\":\"I will create a professional logo tailored to your brand.\",\"delivery_formats\":\"[\\\"jpg\\\",\\\"png\\\",\\\"psd\\\"]\",\"benefits\":\"Simple logo design with one revision\",\"service_type\":\"gig\"}', '', 2, 1, 50.00),
(33, 39, '{\"title\":\"Boost your social media presence\",\"description\":\"Professional photo editing and retouching\",\"delivery_formats\":\"[\\\"psd\\\",\\\"ai\\\"]\",\"benefits\":\"gfn\",\"service_type\":\"gig\"}', '{\"requirements\":\"gbsdb\",\"description\":\"bdgsd\"}', 3, 3, 5.00),
(34, 40, '{\"title\":\"Boost your social media presence\",\"description\":\"Professional photo editing and retouching\",\"delivery_formats\":\"[\\\"psd\\\",\\\"ai\\\"]\",\"benefits\":\"gfn\",\"service_type\":\"gig\"}', '{\"requirements\":\"rg\",\"description\":\"dbg\"}', 3, 3, 5.00),
(35, 41, '{\"title\":\"Boost your social media presence\",\"description\":\"Professional photo editing and retouching\",\"delivery_formats\":\"[\\\"psd\\\",\\\"ai\\\"]\",\"benefits\":\"gfn\",\"service_type\":\"gig\"}', '{\"requirements\":\"rgsgr\",\"description\":\"sgrsrg\"}', 3, 3, 5.00),
(36, 42, '{\"title\":\"yhdmmdtmgfmuyhkutjhtryh\",\"description\":\"hyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrw\",\"delivery_formats\":\"[\\\"jpg\\\",\\\"png\\\"]\",\"benefits\":\"abebt\",\"service_type\":\"gig\"}', '{\"requirements\":\"I want to create a custom business plan\",\"description\":\"this is about a flower shop\"}', 3, 6, 55.00),
(37, 43, '{\"title\":\"Extra Curricular Activities\",\"description\":\"hngrssdfbzsfnhngrssdfbzsfnhngrssdfbzsfnhngrssdfbzsfnhngrssdfbzsfnhngrssdfbzsfnhngrssdfbzsfn\",\"delivery_formats\":\"[\\\"jpg\\\",\\\"png\\\",\\\"psd\\\"]\",\"benefits\":\"zvd\",\"service_type\":\"gig\"}', '{\"requirements\":\"scc\",\"description\":\"sca\"}', 3, 2, 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_reviews_feedback`
--

CREATE TABLE `order_reviews_feedback` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `review_type` enum('review','feedback') NOT NULL,
  `content` text NOT NULL,
  `rating` tinyint(3) UNSIGNED DEFAULT NULL CHECK (`rating` between 1 and 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payout_methods`
--

CREATE TABLE `payout_methods` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `name_on_card` varchar(100) DEFAULT NULL,
  `paypal_name` varchar(100) DEFAULT NULL,
  `paypal_email` varchar(150) DEFAULT NULL,
  `paypal_mobile_number` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_type` enum('bank','paypal') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payout_methods`
--

INSERT INTO `payout_methods` (`id`, `bank_name`, `branch`, `account_number`, `name_on_card`, `paypal_name`, `paypal_email`, `paypal_mobile_number`, `user_id`, `payment_type`) VALUES
(1, 'commercial', 'beliatta', '3924795202', 'naveen', NULL, NULL, NULL, 48, 'bank'),
(2, 'boc', 'matara', '392479520233', 'isuru', NULL, NULL, NULL, 48, 'bank'),
(3, NULL, NULL, NULL, NULL, 'Isuru Naveen Liyanaarachchi', 'designer@gmail.com', '', 48, 'paypal');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `media` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `service_type` enum('gig','promotion') NOT NULL,
  `platforms` varchar(255) DEFAULT NULL,
  `delivery_formats` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `user_id`, `title`, `description`, `cover_image`, `media`, `service_type`, `platforms`, `delivery_formats`, `tags`, `created_at`, `updated_at`) VALUES
(18, 23, 'Logo Design Services', 'I will create a professional logo tailored to your brand.', 'cdn_uploads/services/678d0975064dd.jpg', '[\"cdn_uploads\\/services\\/service_677d8c7072d0b_1736281200.jpg\",\"cdn_uploads\\/services\\/service_677d8c7072f58_1736281200.jpg\",\"cdn_uploads\\/services\\/service_677d8c7073156_1736281200.jpg\",\"cdn_uploads\\/services\\/service_677d8c70733f9_1736281200.jpg\"]', 'gig', '[\"facebook\",\"instagram\"]', '[\"JPEG\", \"PNG\"]', '[\"logo\", \"branding\", \"design\"]', '2025-01-07 06:37:18', '2025-01-28 10:11:53'),
(42, 1, 'New Stunning Website UI/UX Design for Enhanced User Experience', 'I will create intuitive, visually appealing UI/UX designs to make your website stand out.', 'cdn_uploads/services/6783e88fafcaa.jpg', '[\"cdn_uploads\\/services\\/service_6783adcbe9b43_1736682955.png\",\"cdn_uploads\\/services\\/6783e7f513c3e.png\",\"cdn_uploads\\/services\\/6783e88fb0fb1.jpg\"]', 'gig', '[\"facebook\",\"instagram\",\"twitter\",\"linkedin\"]', '[\"ai\"]', '[\"web\",\"wireframe\"]', '2025-01-07 20:02:06', '2025-01-28 09:41:45'),
(43, 1, 'New test gig with single html', 'New test gig with single htmlNew test gig with single htmlNew test gig with single htmlNew test gig with single htmlNew test gig with single html', 'cdn_uploads/services/678cfdbc1fa9a.jpg', '[\"cdn_uploads\\/services\\/service_677d8b0d43d91_1736280845.jpg\",\"cdn_uploads\\/services\\/678cfd7f2124e.webp\",\"cdn_uploads\\/services\\/678cfd7f214ef.jpg\",\"cdn_uploads\\/services\\/678cfd7f216d4.webp\",\"cdn_uploads\\/services\\/678cfdbc1fd21.webp\",\"cdn_uploads\\/services\\/678cfdbc1fedc.jpg\",\"cdn_uploads\\/services\\/678cfdbc200a5.webp\"]', 'gig', '[\"facebook\",\"instagram\",\"linkedin\"]', '[\"jpg\",\"png\",\"psd\",\"ai\",\"svg\"]', '[\"adf\",\"dv\",\"dvzs\"]', '2025-01-07 20:14:05', '2025-01-19 13:27:24'),
(45, 1, 'Ship category (engineering) presentation.pptx', 'jfyhhhmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmn', 'cdn_uploads/services/678cfddfe11ab.webp', '[\"cdn_uploads\\/services\\/service_677d8c7072d0b_1736281200.jpg\",\"cdn_uploads\\/services\\/service_677d8c7072f58_1736281200.jpg\",\"cdn_uploads\\/services\\/service_677d8c7073156_1736281200.jpg\",\"cdn_uploads\\/services\\/service_677d8c70733f9_1736281200.jpg\"]', 'gig', '[\"instagram\",\"linkedin\"]', '[\"jpg\",\"png\",\"psd\"]', '[\"hfx\",\"hmfxc\",\"mhf\",\"hmf\",\"hmcf\"]', '2025-01-07 20:20:00', '2025-01-19 13:27:59'),
(46, 2, 'First Portfolio', 'fwafewwffFEdffwafewwffFEdffwafewwffFEdffwafewwffFEdffwafewwffFEdffwafewwffFEdffwafewwffFEdffwafewwffFEdf', 'cdn_uploads/services/service_677d901a63c9f_1736282138.png', '[\"cdn_uploads\\/services\\/service_677d901a63c9f_1736282138.png\",\"cdn_uploads\\/services\\/service_677d901a63eb0_1736282138.jpg\",\"cdn_uploads\\/services\\/service_677d901a641a7_1736282138.jpg\",\"cdn_uploads\\/services\\/service_677d901a645b9_1736282138.png\",\"cdn_uploads\\/services\\/service_677d901a64919_1736282138.png\"]', 'promotion', '[\"instagram\",\"linkedin\"]', '[\"jpg\",\"png\",\"psd\"]', '[\"VZ\",\"VDZS\",\"VDZ\"]', '2025-01-07 20:35:38', '2025-01-28 00:36:55'),
(47, 1, 'Gig creation test', 'Our Agency Will Boost Your Brand\'s Visibility with Targeted Influencer CampaignsOur Agency Will Boost Your Brand\'s Visibility with Targeted Influencer CampaignsOur Agency Will Boost Your Brand\'s Visibility with Targeted Influencer Campaigns', 'cdn_uploads/services/service_677e70a030abe_1736339616.jpg', '[\"cdn_uploads\\/services\\/service_677e70a030abe_1736339616.jpg\",\"cdn_uploads\\/services\\/service_677e70a03159e_1736339616.jpg\",\"cdn_uploads\\/services\\/service_677e70a031942_1736339616.jpg\",\"cdn_uploads\\/services\\/service_677e70a031c44_1736339616.jpg\",\"cdn_uploads\\/services\\/service_677e70a0320fd_1736339616.jpg\"]', 'gig', '[\"instagram\",\"linkedin\"]', '[\"jpg\",\"png\",\"psd\"]', '[\"fab×\",\"hawk×\"]', '2025-01-08 12:33:36', '2025-01-12 10:08:24'),
(59, 1, 'Extra Curricular Activities', 'hngrssdfbzsfnhngrssdfbzsfnhngrssdfbzsfnhngrssdfbzsfnhngrssdfbzsfnhngrssdfbzsfnhngrssdfbzsfn', 'cdn_uploads/services/service_67833f75ee107_1736654709.jpg', '[\"cdn_uploads\\/services\\/service_67833f75ee107_1736654709.jpg\",\"cdn_uploads\\/services\\/service_67833f75eedc5_1736654709.jpg\",\"cdn_uploads\\/services\\/service_67833f75ef1a1_1736654709.jpg\",\"cdn_uploads\\/services\\/service_67833f75ef41e_1736654709.jpg\",\"cdn_uploads\\/services\\/service_67833f75ef5cd_1736654709.jpg\"]', 'gig', '[\"instagram\",\"linkedin\"]', '[\"jpg\",\"png\",\"psd\"]', '[\"fab×\",\"hawk×\"]', '2025-01-12 04:05:09', '2025-01-12 10:08:48'),
(61, 1, 'Custom Logo Design for Your Brand Identity', 'Get a professional and unique logo tailored to your brand\'s personality, vision, and audience.', 'cdn_uploads/services/service_6783f648b4f34_1736701512.jpg', '[\"cdn_uploads\\/services\\/service_6783f648b4f34_1736701512.jpg\",\"cdn_uploads\\/services\\/service_6783f648b5423_1736701512.jpg\",\"cdn_uploads\\/services\\/service_6783f648b579b_1736701512.png\",\"cdn_uploads\\/services\\/service_6783f648b5b5b_1736701512.jpg\",\"cdn_uploads\\/services\\/service_6783f648b5e8c_1736701512.png\"]', 'promotion', '[\"facebook\"]', '[\"jpg\",\"png\"]', '[\"#LogoDesign\",\"#BrandIdentity\",\"#GraphicDesign\",\"#CustomLogo\"]', '2025-01-12 17:05:12', '2025-01-27 18:55:03'),
(62, 1, 'cvgn dgndx', 'vcb zdg ngdzzvcb zdg ngdzzvcb zdg ngdzzvcb zdg ngdzz', 'cdn_uploads/services/service_6784041a2d6f2_1736705050.webp', '[\"cdn_uploads\\/services\\/service_6784041a2d6f2_1736705050.webp\",\"cdn_uploads\\/services\\/service_6784041a2e748_1736705050.webp\",\"cdn_uploads\\/services\\/service_6784041a2ed6c_1736705050.webp\",\"cdn_uploads\\/services\\/service_6784041a2f029_1736705050.jpg\",\"cdn_uploads\\/services\\/service_6784041a2f204_1736705050.jpg\"]', 'gig', '[\"facebook\",\"instagram\"]', '[\"png\"]', '[\"ds\",\"svbd\"]', '2025-01-12 18:04:10', '2025-01-12 18:04:10'),
(136, 26, 'Boost your social media presence', 'Professional photo editing and retouching', 'cdn_uploads/services/6797ccf505d64.png', '[\"cdn_uploads\\/services\\/6797ccf506136.png\",\"cdn_uploads\\/services\\/6797ccf506301.png\",\"cdn_uploads\\/services\\/6797ccf50658b.png\",\"cdn_uploads\\/services\\/6797ccf506789.png\"]', 'gig', '[\"twitter\"]', '[\"psd\",\"ai\"]', '[\"gnfx\",\"nfxg\"]', '2025-01-27 18:14:13', '2025-01-28 10:30:29'),
(137, 2, 'Custom website development services', 'Develop high-performance mobile applications', 'cdn_uploads/services/6798374ec5d83.jpg', '[\"cdn_uploads\\/services\\/6798374ec6296.webp\",\"cdn_uploads\\/services\\/6798374ec67cb.jpg\",\"cdn_uploads\\/services\\/6798374ec6d56.jpg\",\"cdn_uploads\\/services\\/6798374ec7101.jpg\"]', 'promotion', '[\"instagram\",\"twitter\"]', '[\"ai\",\"svg\"]', '[\"sfd\",\"sdfv\"]', '2025-01-28 01:47:58', '2025-01-28 10:30:21'),
(138, 26, 'yhdmmdtmgfmuyhkutjhtryh', 'hyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrw', 'cdn_uploads/services/67b59b2c95df5.jpg', '[\"cdn_uploads\\/services\\/67b59b2c9652c.jpg\",\"cdn_uploads\\/services\\/67b59b2c968af.png\",\"cdn_uploads\\/services\\/67b59b2c96c38.jpg\",\"cdn_uploads\\/services\\/67b59b2c96f7f.jpg\"]', 'gig', '[\"facebook\",\"instagram\"]', '[\"jpg\",\"png\"]', '[\"fbzd\",\"fbd\",\"bdz\",\"bzd\",\"dzb\"]', '2025-02-19 08:49:48', '2025-02-19 08:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `service_analytics`
--

CREATE TABLE `service_analytics` (
  `analytics_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `clicks` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `rating` decimal(3,2) DEFAULT NULL,
  `revenue` decimal(12,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_custom_package`
--

CREATE TABLE `service_custom_package` (
  `custom_package_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `benefits_requested` text NOT NULL,
  `delivery_days_requested` int(10) UNSIGNED NOT NULL,
  `revisions_requested` int(10) UNSIGNED DEFAULT 0,
  `price_requested` decimal(10,2) NOT NULL,
  `status` enum('pending','accepted') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_custom_package`
--

INSERT INTO `service_custom_package` (`custom_package_id`, `service_id`, `seller_id`, `customer_id`, `benefits_requested`, `delivery_days_requested`, `revisions_requested`, `price_requested`, `status`, `created_at`) VALUES
(2, 18, 23, 23, 'Benefit 1, Benefit 2efwf', 8, 3, 45.00, 'accepted', '2025-02-22 13:07:40'),
(8, 61, 1, 24, 'nyhrymrymrsmsrys', 4, 3, 55.00, 'pending', '2025-02-22 19:32:23');

-- --------------------------------------------------------

--
-- Table structure for table `service_package`
--

CREATE TABLE `service_package` (
  `package_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `package_type` enum('basic','premium') NOT NULL,
  `benefits` text NOT NULL,
  `delivery_days` int(10) UNSIGNED NOT NULL,
  `revisions` int(10) UNSIGNED DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_package`
--

INSERT INTO `service_package` (`package_id`, `service_id`, `package_type`, `benefits`, `delivery_days`, `revisions`, `price`) VALUES
(18, 18, 'basic', '1 logo, 2 concepts, no revisions', 2, 0, 50.00),
(19, 18, 'premium', '3 logos, unlimited concepts, 3 revisions', 5, 3, 150.00),
(54, 42, 'basic', 'Get 1 custom webpage design with a clean layout, responsive elements, Includes 1 revision.', 6, 2, 40.00),
(55, 42, 'premium', 'Complete website design with up to 5 pages, advanced UI/UX elements, prototyping, and unlimited revisions.', 4, 7, 85.00),
(56, 43, 'basic', 'fbd', 3, 3, 55.00),
(57, 43, 'premium', 'bfzg', 3, 3, 50.00),
(60, 45, 'basic', 'sfv', 4, 4, 80.00),
(61, 45, 'premium', 'sfd', 4, 4, 90.00),
(62, 46, 'basic', 'FD', 2, 2, 55.00),
(63, 46, 'premium', 'FD', 2, 2, 55.00),
(64, 47, 'basic', 'Basic benefits given', 5, 1, 20.00),
(65, 47, 'premium', 'More premium are have', 2, 4, 45.00),
(88, 59, 'basic', 'zvd', 3, 2, 5.00),
(89, 59, 'premium', 'vdz', 3, 0, 5.00),
(92, 61, 'basic', 'Get a simple and clean logo design with 1 concept and 1 revision. Ideal for startups or small projects.', 4, 2, 20.00),
(93, 61, 'premium', 'Receive a fully customized logo with 3 unique concepts, unlimited revisions, and all file formats (JPEG, PNG, SVG, PDF).', 3, 3, 25.00),
(94, 62, 'basic', 'dsvs', 2, 2, 5.00),
(95, 62, 'premium', 'vdc', 2, 2, 5.00),
(102, 136, 'basic', 'gfn', 3, 3, 5.00),
(103, 136, 'premium', 'fng', 3, 3, 5.00),
(104, 137, 'basic', 'bzsgd', 3, 3, 5.00),
(105, 137, 'premium', 'bfd', 3, 3, 5.00),
(106, 138, 'basic', 'abebt', 3, 6, 55.00),
(107, 138, 'premium', 'btaebea', 3, 6, 55.00);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('hold','released','failed','withdrawal') NOT NULL DEFAULT 'hold',
  `hold_until` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `cover_picture` varchar(255) DEFAULT NULL,
  `bio` varchar(500) DEFAULT NULL,
  `role` enum('businessman','influencer','designer') NOT NULL DEFAULT 'businessman',
  `professional_title` varchar(100) NOT NULL,
  `specialties` varchar(200) NOT NULL,
  `tools` varchar(300) NOT NULL,
  `location` varchar(50) NOT NULL,
  `account_status` enum('active','inactive','blocked','banned') NOT NULL DEFAULT 'active',
  `verification_status` enum('unverified','verified','pending') NOT NULL DEFAULT 'unverified',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `phone`, `password`, `profile_picture`, `cover_picture`, `bio`, `role`, `professional_title`, `specialties`, `tools`, `location`, `account_status`, `verification_status`, `created_at`, `updated_at`) VALUES
(1, 'Mathara arachchi', 'isurunaveen@gmail.com', 'Not set', '$2y$10$fvlJlCeLnaKIqsyRSFnhlezy1M09HunOva4H94Mfbsd/jGITPSItO', 'cdn_uploads/users/dp/67fddca5692da.webp', 'cdn_uploads/users/cover_photo/67fe02bd220da.jpg', 'I am good dedicated designer for developing websites', 'designer', 'UI/UX designer', 'Not set', 'Not set', 'Kirulapone', 'blocked', 'unverified', '2025-01-06 03:10:21', '2025-04-20 16:36:36'),
(2, 'Alpha Lee', 'janesmith@brandboost.lk', '', '$2y$10$8VyDPBlbcN8rBmJgWT6ta.FmgFW1J5DhPqWGfPn5T9UVUZl/guqgK', 'cdn_uploads/users/dp/lalitha-epaarachchi-sri-lankan-fitness-influencer.webp', 'cdn_uploads/services/service_677d901a63c9f_1736282138.png', NULL, 'influencer', '', '', '', '', 'active', 'unverified', '2025-01-06 03:10:21', '2025-04-20 12:19:56'),
(3, 'Alice Perera', 'alicep@brandboost.lk', '', '$2y$10$8K7zgqpeY57peox0O2rFse5/zC9hPeF2.3dJfVw/0ZQJ3kQhmbK2K', '/cdn_uploads/users/dp/67fddca5692da.webp', '', NULL, 'businessman', '', '', '', '', 'active', 'unverified', '2025-01-06 03:10:21', '2025-04-19 08:39:38'),
(4, 'Bob Silva', 'bobs@brandboost.lk', '', '$2y$10$8K7zgqpeY57peox0O2rFse5/zC9hPeF2.3dJfVw/0ZQJ3kQhmbK2K', '/cdn_uploads/users/dp/67fddca5692da.webp', '', NULL, 'businessman', '', '', '', '', 'active', 'unverified', '2025-01-06 03:10:21', '2025-04-19 08:40:04'),
(15, 'Stephanie Cruz', 'sarah@social.com', '', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '\\cdn_uploads\\users\\dp\\DlGrcWrXcAEWOSz.jpg', '', 'Fashion and lifestyle influencer', 'influencer', '', '', '', '', 'active', 'unverified', '2024-12-31 05:13:04', '2025-01-28 09:27:58'),
(16, 'Mike Designer', 'mike@design.com', '', '$2y$10$fvlJlCeLnaKIqsyRSFnhlezy1M09HunOva4H94Mfbsd/jGITPSItO', 'https://storage.googleapis.com/a1aa/image/6yVDNncLcU45F9JPN2TMPNfDNRwHKrGqblFJU3fu7ew098AoA.jpg', '', 'Creative designer with modern style', 'designer', '', '', '', '', 'active', 'unverified', '2024-12-31 05:13:04', '2025-01-11 07:57:29'),
(17, 'Lisa Business', 'lisa@business.com', '', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', 'https://storage.googleapis.com/a1aa/image/6yVDNncLcU45F9JPN2TMPNfDNRwHKrGqblFJU3fu7ew098AoA.jpg', '', 'Tech startup founder', 'businessman', '', '', '', '', 'active', 'unverified', '2024-12-31 05:13:04', '2025-01-06 10:38:09'),
(18, 'Omaya Shanelli', 'tom@social.com', '', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '\\cdn_uploads\\users\\dp\\images (2).jpeg', '', 'Tech and gaming influencer', 'influencer', '', '', '', '', 'active', 'unverified', '2024-12-31 05:13:04', '2025-01-28 09:34:22'),
(20, 'Isuru Naveen', 'isuru@gmail.com', '', '$2y$10$fvlJlCeLnaKIqsyRSFnhlezy1M09HunOva4H94Mfbsd/jGITPSItO', '/cdn_uploads/users/dp/67fddca5692da.webp', '', 'Fashion and lifestyle influencer', 'designer', '', '', '', '', 'active', 'unverified', '2025-01-02 05:53:35', '2025-04-17 13:14:03'),
(21, 'Thiwanka Dilshan', 'thiwa@gmail.com', '', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '\\cdn_uploads\\users\\dp\\zuri-sri-lankan-fitness-influencers.webp', '', NULL, 'influencer', '', '', '', '', 'active', 'unverified', '2025-01-02 10:31:15', '2025-01-28 09:33:18'),
(22, 'tharusha tharu', 'tharusha@gmail.com', '', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', NULL, '', NULL, 'businessman', '', '', '', '', 'active', 'unverified', '2025-01-04 06:52:36', '2025-01-04 18:50:58'),
(23, 'Soliyas Mendis', 'soliyasmendis@gmail.com', '', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '/cdn_uploads/users/dp/67fc9ba55f2b5.jpeg', '', NULL, 'designer', '', '', '', '', 'active', 'unverified', '2025-01-04 07:46:18', '2025-04-20 12:47:53'),
(24, 'Bjohn Bdoe', 'business@m.com', 'Not set', '$2y$10$V/LrOHBYnoUWAaPf78n.0uzswfjN08b2sJZe6tlNxrMRHg51qYULi', 'cdn_uploads/users/dp/lalitha-epaarachchi-sri-lankan-fitness-influencer.webp', 'cdn_uploads/users/cover_photo/67fe9f7795cfd.webp', 'Creative designer with modern style', 'businessman', 'Not set', 'Not set', 'Not set', 'Not set', 'active', 'unverified', '2025-01-05 04:53:19', '2025-04-23 17:19:58'),
(25, 'Hashi Jay', 'influencer@m.com', 'uky', '$2y$10$ApCUEW6b2dkn.vVsEuzO3eTl7s3laKCmjylfwj4byRKo5eJFji4x6', 'cdn_uploads/users/dp/67fdd6025b393.jpg', 'cdn_uploads/users/cover_photo/67fdd6025a229.jpg', 'jtukmtuk', 'influencer', 'kyr', 'kru', 'kry', 'uykr', 'active', 'unverified', '2025-01-05 04:54:00', '2025-04-15 03:44:02'),
(26, 'Nadun Jayalanka', 'designer@m.com', '5437365', '$2y$10$fvlJlCeLnaKIqsyRSFnhlezy1M09HunOva4H94Mfbsd/jGITPSItO', 'cdn_uploads/users/dp/67fc9ba55f2b5.jpeg', 'cdn_uploads/users/cover_photo/67fc9b29cc901.png', 'Updated biooliadcfwxvf', 'designer', 'Mr.', 'ux/ui', 'xd, figma', 'colombo', 'active', 'unverified', '2025-01-05 04:54:41', '2025-04-14 05:22:45'),
(27, 'new de', 'decdec@m.com', '', '$2y$10$fvlJlCeLnaKIqsyRSFnhlezy1M09HunOva4H94Mfbsd/jGITPSItO', NULL, '', NULL, 'businessman', '', '', '', '', 'active', 'unverified', '2025-01-06 05:05:10', '2025-04-18 07:15:47'),
(28, 'Shane Mario', 'hero@m.com', '', '$2y$10$mFh9TzzNgVtfhQwPPd67.u1aAYYl8QWUuEfV/bk3mGs0RiT39vmMG', '\\cdn_uploads\\users\\dp\\yohan-seth-perera-1.webp', '', NULL, 'influencer', '', '', '', '', 'active', 'unverified', '2025-01-06 05:07:34', '2025-01-28 09:32:59'),
(41, 'Dilum Ekanayaka', 'dilumekanayaka@mail.com', '', '$2y$10$M9Br2AJfF21HAOU.Jd3Gt.UwWFwO9q9./.gnGSi02Kj6.BCnUxEHm', NULL, '', NULL, 'businessman', '', '', '', '', 'blocked', 'unverified', '2025-01-19 14:07:22', '2025-04-18 07:15:04'),
(42, 'Dilum Ekanayaka', 'dilumekanayaka@email.com', '', '$2y$10$Ic2uCwxxduNWwBs6teEr1OpFuAV4c8UmpyqDh9VDgiKrO0sC2d7Gi', '\\cdn_uploads\\users\\dp\\images (1).jpeg', '', NULL, 'influencer', '', '', '', '', 'inactive', 'unverified', '2025-01-28 02:32:57', '2025-04-17 18:07:13'),
(43, 'wer fw', 'kavindadimuthu260@gmail.comfw', '', '$2y$10$haPm3HycZFBczNYzFl1FD.7EIU.jDcWXiIycWeq0EbvCiTq8CIHha', NULL, '', NULL, 'businessman', '', '', '', '', 'active', 'unverified', '2025-01-28 02:35:21', '2025-04-17 18:33:51'),
(45, 'Elon Musk', 'elon@tesla.com', '', '$2y$10$0YDLNON5wmAOo7dX2aSGHu2WWQdtaDaeNnoW/0LUQ0GEbw6zTdF/6', NULL, NULL, NULL, 'designer', '', '', '', '', 'inactive', 'verified', '2025-04-09 14:49:57', '2025-04-17 17:41:21'),
(46, 'Nethsilu Marasinghe', 'business@gmail.com', '', '$2y$12$b4uom5246fR4/55MDcbxQOxRbkLPx19sDFwcmT/V7ncNeJ34dq2Wu', NULL, NULL, NULL, 'businessman', '', '', '', '', 'active', 'unverified', '2025-04-13 07:48:42', '2025-04-13 07:48:42'),
(47, 'Nadun Sandanayake', 'influencer@gmail.com', '', '$2y$12$TVAZ1KMpNtJnLwryxz62D.I/YdTYaC/ZJeXWJJLgh2dtQeLDkRZqi', NULL, NULL, NULL, 'influencer', '', '', '', '', 'active', 'unverified', '2025-04-13 07:49:22', '2025-04-13 07:49:22'),
(48, 'Isuru Liyanaarachchi', 'designer@gmail.com', '', '$2y$12$T6U6/4ZYFGIApPJlAH2w.u3cfHW3gvyiFNoiaEjf.H36Yx/0JzuJO', NULL, NULL, NULL, 'designer', '', '', '', '', 'active', 'verified', '2025-04-13 07:49:43', '2025-04-13 07:49:43'),
(49, 'dinuka sahan', 'dinuka@gmail.com', '', '$2y$12$NktZCxIoyfRAXOA.lcqRaeKa7ikBD94Zo7OXnzytl.ZhAM.Ox1wYe', NULL, NULL, NULL, 'influencer', '', '', '', '', 'active', 'unverified', '2025-04-21 11:56:01', '2025-04-21 11:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `session_token` varchar(255) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `expires_at` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `user_id`, `session_token`, `ip_address`, `user_agent`, `is_active`, `created_at`, `expires_at`, `last_activity`) VALUES
(1, 1, 'd4c212f1e844f5b97e7ca0a92c23a32842ccd2e0b0e99c7c1dc009ddf78445ba', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 1, '2025-04-21 18:56:28', '2025-05-21 13:26:28', '2025-04-21 18:56:28'),
(2, 25, '473ab5f0ab1fa5040545b1e023dc31cc74799442df0af4b3b3c5c3a33c65ac1d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 1, '2025-04-21 19:15:06', '2025-05-21 13:45:06', '2025-04-21 19:15:06'),
(3, 1, '1be401722a86bd337e1fec2cc6f71003ebbc547632dcf1073ecdc7a35698d91b', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 1, '2025-04-21 19:16:42', '2025-05-21 13:46:42', '2025-04-21 19:16:42'),
(4, 1, 'd521b545c6130ec430853f8dadb798d06a0615ee20c5861e192c275f3008a79c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 1, '2025-04-22 00:01:50', '2025-05-21 18:31:50', '2025-04-22 00:01:50'),
(5, 1, '33a58fe4090d67b41a2f9a63f5df2bf03f96f270a8f3c5007151a659d50b38e8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 1, '2025-04-22 02:58:50', '2025-05-21 21:28:50', '2025-04-22 02:58:50'),
(6, 1, '46f7a5698c40185e526ddb88613bb0892a13a58405271550f16b3ed719bc1e2c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 1, '2025-04-22 03:08:34', '2025-05-21 21:38:34', '2025-04-22 03:08:34'),
(7, 1, '70e86a4431b2f6e1bb2b09843ff74c1e312d1e93665cdf695f4765a019825940', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 1, '2025-04-22 10:04:14', '2025-05-22 04:34:14', '2025-04-22 10:04:14'),
(8, 1, '0d0a46e2f433de058f93faba6caa052f824ee1e15fa764bc2bc71579bc06fb94', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 1, '2025-04-23 22:26:05', '2025-05-23 16:56:05', '2025-04-23 22:26:05'),
(9, 4, 'b0d30777d3a91a46c4522124a0c4c6f49e87dfd6c0a483ead6db94b6acbbd70c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 1, '2025-04-23 22:26:20', '2025-05-23 16:56:20', '2025-04-23 22:26:20'),
(10, 25, '55c34396560d06ffc6c133d7af0f403a43d5a0e7045ec4ca3a7af815a2e53827', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 1, '2025-04-23 22:29:13', '2025-05-23 16:59:13', '2025-04-23 22:29:13'),
(11, 4, 'cb4d77d834948cb77d2953f220f685d49badce7de5f5f7c080d6cab1236aa387', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 1, '2025-04-23 23:58:45', '2025-05-23 18:28:45', '2025-04-23 23:58:45');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `wallet_id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`wallet_id`, `seller_id`, `balance`, `currency`, `last_updated`) VALUES
(1, 1, 262.00, 'USD', '2025-04-23 17:54:50'),
(2, 2, 110.00, 'USD', '2025-04-21 03:39:10'),
(3, 26, 5.00, 'USD', '2025-04-21 03:44:59'),
(4, 48, 81.00, 'USD', '2025-04-23 17:54:50'),
(5, 47, 40.00, 'USD', '2025-04-21 08:19:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`action_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `businessman`
--
ALTER TABLE `businessman`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `chat_room_id` (`chat_room_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `chat_room`
--
ALTER TABLE `chat_room`
  ADD PRIMARY KEY (`chat_room_id`),
  ADD UNIQUE KEY `unique_chat_users` (`user_1`,`user_2`),
  ADD KEY `user_2` (`user_2`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `sender_id` (`complainant_user_id`),
  ADD KEY `reported_user_id` (`reported_user_id`),
  ADD KEY `resolved_by_admin_id` (`resolved_by_admin_id`);

--
-- Indexes for table `designer_project`
--
ALTER TABLE `designer_project`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `influencer_social_account`
--
ALTER TABLE `influencer_social_account`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `custom_package_id` (`custom_package_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `order_deliveries`
--
ALTER TABLE `order_deliveries`
  ADD PRIMARY KEY (`delivery_id`,`order_id`,`revision_number`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_promises`
--
ALTER TABLE `order_promises`
  ADD PRIMARY KEY (`promise_id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `order_reviews_feedback`
--
ALTER TABLE `order_reviews_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payout_methods`
--
ALTER TABLE `payout_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `service_analytics`
--
ALTER TABLE `service_analytics`
  ADD PRIMARY KEY (`analytics_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `service_custom_package`
--
ALTER TABLE `service_custom_package`
  ADD PRIMARY KEY (`custom_package_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `service_package`
--
ALTER TABLE `service_package`
  ADD PRIMARY KEY (`package_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_token` (`session_token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`wallet_id`),
  ADD UNIQUE KEY `seller_id` (`seller_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action`
--
ALTER TABLE `action`
  MODIFY `action_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `message_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat_room`
--
ALTER TABLE `chat_room`
  MODIFY `chat_room_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `designer_project`
--
ALTER TABLE `designer_project`
  MODIFY `project_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `influencer_social_account`
--
ALTER TABLE `influencer_social_account`
  MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `order_deliveries`
--
ALTER TABLE `order_deliveries`
  MODIFY `delivery_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_promises`
--
ALTER TABLE `order_promises`
  MODIFY `promise_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `order_reviews_feedback`
--
ALTER TABLE `order_reviews_feedback`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payout_methods`
--
ALTER TABLE `payout_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `service_analytics`
--
ALTER TABLE `service_analytics`
  MODIFY `analytics_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_custom_package`
--
ALTER TABLE `service_custom_package`
  MODIFY `custom_package_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `service_package`
--
ALTER TABLE `service_package`
  MODIFY `package_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `wallet_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `action`
--
ALTER TABLE `action`
  ADD CONSTRAINT `action_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `action_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `action_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `businessman`
--
ALTER TABLE `businessman`
  ADD CONSTRAINT `businessman_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD CONSTRAINT `chat_message_ibfk_1` FOREIGN KEY (`chat_room_id`) REFERENCES `chat_room` (`chat_room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_message_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_message_ibfk_3` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat_room`
--
ALTER TABLE `chat_room`
  ADD CONSTRAINT `chat_room_ibfk_1` FOREIGN KEY (`user_1`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_room_ibfk_2` FOREIGN KEY (`user_2`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_ibfk_admin` FOREIGN KEY (`resolved_by_admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_ibfk_complainant` FOREIGN KEY (`complainant_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaint_ibfk_reported` FOREIGN KEY (`reported_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `designer_project`
--
ALTER TABLE `designer_project`
  ADD CONSTRAINT `designer_project_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `influencer_social_account`
--
ALTER TABLE `influencer_social_account`
  ADD CONSTRAINT `influencer_social_account_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`package_id`) REFERENCES `service_package` (`package_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`custom_package_id`) REFERENCES `service_custom_package` (`custom_package_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_5` FOREIGN KEY (`seller_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_deliveries`
--
ALTER TABLE `order_deliveries`
  ADD CONSTRAINT `order_deliveries_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_promises`
--
ALTER TABLE `order_promises`
  ADD CONSTRAINT `order_promises_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_reviews_feedback`
--
ALTER TABLE `order_reviews_feedback`
  ADD CONSTRAINT `order_reviews_feedback_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_reviews_feedback_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_analytics`
--
ALTER TABLE `service_analytics`
  ADD CONSTRAINT `service_analytics_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_custom_package`
--
ALTER TABLE `service_custom_package`
  ADD CONSTRAINT `service_custom_package_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_custom_package_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_package`
--
ALTER TABLE `service_package`
  ADD CONSTRAINT `service_package_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transactions_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_transactions_receiver_id` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_transactions_sender_id` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `fk_wallet_seller_id` FOREIGN KEY (`seller_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
