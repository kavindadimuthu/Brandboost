-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 13, 2025 at 09:01 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

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

DROP TABLE IF EXISTS `action`;
CREATE TABLE IF NOT EXISTS `action` (
  `action_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `order_id` int UNSIGNED DEFAULT NULL,
  `action_type` enum('banned','blocked','reversed','canceled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`action_id`),
  KEY `admin_id` (`admin_id`),
  KEY `user_id` (`user_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`action_id`, `admin_id`, `user_id`, `order_id`, `action_type`, `action_note`, `created_at`) VALUES
(1, 1, 3, NULL, 'reversed', 'Order reversed due to dispute.', '2025-01-06 03:10:21'),
(2, 2, 4, NULL, 'canceled', 'Customer requested cancellation.', '2025-01-06 03:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `businessman`;
CREATE TABLE IF NOT EXISTS `businessman` (
  `user_id` int UNSIGNED NOT NULL,
  `business_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `br_document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `br_status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `businessman`
--

INSERT INTO `businessman` (`user_id`, `business_name`, `br_document`, `br_status`, `updated_at`) VALUES
(1, 'Lanka Enterprises', 'br_docs_1.pdf', 'approved', '2025-01-06 03:10:21'),
(2, 'Colombo Traders', 'br_docs_2.pdf', 'pending', '2025-01-06 03:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

DROP TABLE IF EXISTS `chat_message`;
CREATE TABLE IF NOT EXISTS `chat_message` (
  `message_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `chat_room_id` int UNSIGNED NOT NULL,
  `sender_id` int UNSIGNED NOT NULL,
  `receiver_id` int UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `read_status` enum('unread','read') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  PRIMARY KEY (`message_id`),
  KEY `chat_room_id` (`chat_room_id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`message_id`, `chat_room_id`, `sender_id`, `receiver_id`, `message`, `created_at`, `delivered_at`, `read_status`) VALUES
(1, 1, 1, 3, 'Hello, I am interested in your services.', '2025-01-06 03:10:21', '2025-01-06 03:10:21', 'read'),
(2, 2, 2, 4, 'Can we discuss more about the project?', '2025-01-06 03:10:21', NULL, 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `chat_room`
--

DROP TABLE IF EXISTS `chat_room`;
CREATE TABLE IF NOT EXISTS `chat_room` (
  `chat_room_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_1` int UNSIGNED NOT NULL,
  `user_2` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`chat_room_id`),
  UNIQUE KEY `unique_chat_users` (`user_1`,`user_2`),
  KEY `user_2` (`user_2`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_room`
--

INSERT INTO `chat_room` (`chat_room_id`, `user_1`, `user_2`, `created_at`) VALUES
(1, 1, 3, '2025-01-06 03:10:21'),
(2, 2, 4, '2025-01-06 03:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
CREATE TABLE IF NOT EXISTS `complaint` (
  `complaint_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int UNSIGNED NOT NULL,
  `sender_id` int UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('open','resolved','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `response` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`complaint_id`),
  KEY `order_id` (`order_id`),
  KEY `sender_id` (`sender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designer_project`
--

DROP TABLE IF EXISTS `designer_project`;
CREATE TABLE IF NOT EXISTS `designer_project` (
  `project_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `influencer_social_account`
--

DROP TABLE IF EXISTS `influencer_social_account`;
CREATE TABLE IF NOT EXISTS `influencer_social_account` (
  `account_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `platform` enum('Instagram','YouTube','TikTok','Facebook','Twitter','LinkedIn','Other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`account_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `influencer_social_account`
--

INSERT INTO `influencer_social_account` (`account_id`, `user_id`, `platform`, `username`, `link`, `created_at`, `updated_at`) VALUES
(1, 1, 'Instagram', 'updated_insta', 'https://instagram.com/influencer1', '2025-01-06 03:10:21', '2025-01-17 00:26:35'),
(2, 2, 'YouTube', 'influencer2', 'https://youtube.com/influencer2', '2025-01-06 03:10:21', '2025-01-06 03:10:21'),
(104, 2, 'YouTube', 'Rachell', 'https://testYT.com/test', '2025-01-17 00:28:56', '2025-01-17 00:28:56');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `notification_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `generated_by` enum('system','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` int UNSIGNED DEFAULT NULL,
  `receiver_id` int UNSIGNED NOT NULL,
  `generation_note` text COLLATE utf8mb4_unicode_ci,
  `notification` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_status` enum('unread','read') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`notification_id`),
  KEY `admin_id` (`admin_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_id` int UNSIGNED NOT NULL,
  `customer_id` int UNSIGNED NOT NULL,
  `seller_id` int UNSIGNED NOT NULL,
  `package_id` int UNSIGNED DEFAULT NULL,
  `custom_package_id` int UNSIGNED DEFAULT NULL,
  `payment_type` enum('credit_card','paypal','bank_transfer','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivered_date` date DEFAULT NULL,
  `remained_revisions` int UNSIGNED NOT NULL DEFAULT '0',
  `order_status` enum('pending','in_progress','completed','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`),
  KEY `service_id` (`service_id`),
  KEY `customer_id` (`customer_id`),
  KEY `package_id` (`package_id`),
  KEY `custom_package_id` (`custom_package_id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `service_id`, `customer_id`, `seller_id`, `package_id`, `custom_package_id`, `payment_type`, `delivered_date`, `remained_revisions`, `order_status`, `created_at`) VALUES
(27, 42, 24, 0, 54, NULL, 'paypal', NULL, 0, 'pending', '2025-01-18 15:14:13'),
(28, 42, 24, 0, 54, NULL, 'paypal', NULL, 0, 'pending', '2025-01-18 15:14:53'),
(29, 42, 24, 0, 54, NULL, 'paypal', NULL, 2, 'pending', '2025-01-18 15:16:00'),
(30, 42, 24, 0, 54, NULL, 'paypal', NULL, 2, 'pending', '2025-01-18 15:19:02'),
(31, 42, 24, 0, 54, NULL, 'paypal', NULL, 2, 'pending', '2025-01-18 15:24:54'),
(32, 18, 24, 0, 18, NULL, 'paypal', NULL, 1, 'pending', '2025-01-19 08:11:15'),
(33, 45, 24, 0, 60, NULL, 'paypal', NULL, 4, 'pending', '2025-01-19 08:40:00'),
(34, 45, 24, 0, 60, NULL, 'paypal', NULL, 4, 'pending', '2025-01-19 08:40:27'),
(35, 18, 1, 0, 18, NULL, 'paypal', NULL, 1, 'pending', '2025-01-22 03:18:57'),
(39, 136, 24, 0, 102, NULL, 'paypal', NULL, 3, 'pending', '2025-02-19 02:19:34'),
(40, 136, 24, 0, 102, NULL, 'paypal', NULL, 3, 'pending', '2025-02-19 02:45:38'),
(41, 136, 1, 0, 102, NULL, 'paypal', NULL, 3, 'pending', '2025-03-04 09:04:18'),
(42, 138, 24, 0, 106, NULL, 'paypal', NULL, 6, 'pending', '2025-03-04 09:08:37'),
(43, 59, 24, 0, 88, NULL, 'paypal', NULL, 2, 'pending', '2025-04-09 12:29:31'),
(44, 138, 24, 0, 106, NULL, 'paypal', NULL, 6, 'pending', '2025-04-13 02:14:11'),
(45, 138, 24, 0, 106, NULL, 'paypal', NULL, 6, 'pending', '2025-04-13 02:15:38'),
(47, 139, 46, 48, 108, NULL, 'paypal', NULL, 3, 'pending', '2025-04-13 03:03:36'),
(48, 139, 24, 48, 108, NULL, 'paypal', NULL, 3, 'pending', '2025-04-13 03:23:43');

-- --------------------------------------------------------

--
-- Table structure for table `order_promises`
--

DROP TABLE IF EXISTS `order_promises`;
CREATE TABLE IF NOT EXISTS `order_promises` (
  `promise_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int UNSIGNED NOT NULL,
  `accepted_service` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `requested_service` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_days` int UNSIGNED NOT NULL,
  `number_of_revisions` int UNSIGNED NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`promise_id`),
  UNIQUE KEY `order_id` (`order_id`)
) ;

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
(37, 43, '{\"title\":\"Extra Curricular Activities\",\"description\":\"hngrssdfbzsfnhngrssdfbzsfnhngrssdfbzsfnhngrssdfbzsfnhngrssdfbzsfnhngrssdfbzsfnhngrssdfbzsfn\",\"delivery_formats\":\"[\\\"jpg\\\",\\\"png\\\",\\\"psd\\\"]\",\"benefits\":\"zvd\",\"service_type\":\"gig\"}', '{\"requirements\":\"scc\",\"description\":\"sca\"}', 3, 2, 5.00),
(38, 44, '{\"title\":\"yhdmmdtmgfmuyhkutjhtryh\",\"description\":\"hyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrw\",\"delivery_formats\":\"[\\\"jpg\\\",\\\"png\\\"]\",\"benefits\":\"abebt\",\"service_type\":\"gig\"}', '{\"requirements\":\"Detailed Requirements\\r\\n\",\"description\":\"Project Description\\r\\n\"}', 3, 6, 55.00),
(39, 45, '{\"title\":\"yhdmmdtmgfmuyhkutjhtryh\",\"description\":\"hyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrw\",\"delivery_formats\":\"[\\\"jpg\\\",\\\"png\\\"]\",\"benefits\":\"abebt\",\"service_type\":\"gig\"}', '{\"requirements\":\"Detailed Requirements\\r\\n\",\"description\":\"Project Description\\r\\n\"}', 3, 6, 55.00),
(41, 47, '{\"title\":\"Flyer design for business promotions\",\"description\":\"Description for Flyer design for business promotions  Description for Flyer design for business promotions  Description for Flyer design for business promotions  Description for Flyer design for business promotions\",\"delivery_formats\":\"[\\\"jpg\\\",\\\"png\\\",\\\"psd\\\",\\\"svg\\\"]\",\"benefits\":\"Basic Benefits\",\"service_type\":\"gig\"}', '{\"requirements\":\"Detailed Requirements\\r\\n\",\"description\":\"Project Description\\r\\n\\r\\n\"}', 5, 3, 35.00),
(42, 48, '{\"title\":\"Flyer design for business promotions\",\"description\":\"Description for Flyer design for business promotions  Description for Flyer design for business promotions  Description for Flyer design for business promotions  Description for Flyer design for business promotions\",\"delivery_formats\":\"[\\\"jpg\\\",\\\"png\\\",\\\"psd\\\",\\\"svg\\\"]\",\"benefits\":\"Basic Benefits\",\"service_type\":\"gig\"}', '{\"requirements\":\"Professional Business Plan Writing\\r\\n\",\"description\":\"Professional Business Plan Writing\\r\\n\"}', 5, 3, 35.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_reviews_feedback`
--

DROP TABLE IF EXISTS `order_reviews_feedback`;
CREATE TABLE IF NOT EXISTS `order_reviews_feedback` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `review_type` enum('review','feedback') COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `order_revision`
--

DROP TABLE IF EXISTS `order_revision`;
CREATE TABLE IF NOT EXISTS `order_revision` (
  `revision_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int UNSIGNED NOT NULL,
  `revision_number` int UNSIGNED NOT NULL,
  `request_note` text COLLATE utf8mb4_unicode_ci,
  `delivery_note` text COLLATE utf8mb4_unicode_ci,
  `deliveries` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `status` enum('pending','submitted','accepted','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`revision_id`,`order_id`,`revision_number`),
  KEY `order_id` (`order_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `service_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `media` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `service_type` enum('gig','promotion') COLLATE utf8mb4_unicode_ci NOT NULL,
  `platforms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_formats` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`service_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(138, 26, 'yhdmmdtmgfmuyhkutjhtryh', 'hyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrwhyrwjy4jrw', 'cdn_uploads/services/67b59b2c95df5.jpg', '[\"cdn_uploads\\/services\\/67b59b2c9652c.jpg\",\"cdn_uploads\\/services\\/67b59b2c968af.png\",\"cdn_uploads\\/services\\/67b59b2c96c38.jpg\",\"cdn_uploads\\/services\\/67b59b2c96f7f.jpg\"]', 'gig', '[\"facebook\",\"instagram\"]', '[\"jpg\",\"png\"]', '[\"fbzd\",\"fbd\",\"bdz\",\"bzd\",\"dzb\"]', '2025-02-19 08:49:48', '2025-02-19 08:49:48'),
(139, 48, 'Flyer design for business promotions', 'Description for Flyer design for business promotions  Description for Flyer design for business promotions  Description for Flyer design for business promotions  Description for Flyer design for business promotions', 'cdn_uploads/services/67fb6d3a0447d.jpg', '[\"cdn_uploads\\/services\\/67fb6d3a0960e.jpg\",\"cdn_uploads\\/services\\/67fb6d3a09a83.jpg\",\"cdn_uploads\\/services\\/67fb6d3a0a08a.webp\",\"cdn_uploads\\/services\\/67fb6d3a0a872.jpg\"]', 'gig', '[\"facebook\",\"instagram\",\"linkedin\"]', '[\"jpg\",\"png\",\"psd\",\"svg\"]', '[\"fb\",\"insta\",\"linkedin\",\"flyer\"]', '2025-04-13 07:52:26', '2025-04-13 07:52:26');

-- --------------------------------------------------------

--
-- Table structure for table `service_analytics`
--

DROP TABLE IF EXISTS `service_analytics`;
CREATE TABLE IF NOT EXISTS `service_analytics` (
  `analytics_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_id` int UNSIGNED NOT NULL,
  `views` int UNSIGNED NOT NULL DEFAULT '0',
  `clicks` int UNSIGNED NOT NULL DEFAULT '0',
  `rating` decimal(3,2) DEFAULT NULL,
  `revenue` decimal(12,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`analytics_id`),
  KEY `service_id` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_custom_package`
--

DROP TABLE IF EXISTS `service_custom_package`;
CREATE TABLE IF NOT EXISTS `service_custom_package` (
  `custom_package_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_id` int UNSIGNED NOT NULL,
  `seller_id` int UNSIGNED NOT NULL,
  `customer_id` int UNSIGNED NOT NULL,
  `benefits_requested` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_days_requested` int UNSIGNED NOT NULL,
  `revisions_requested` int UNSIGNED DEFAULT '0',
  `price_requested` decimal(10,2) NOT NULL,
  `status` enum('pending','accepted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`custom_package_id`),
  KEY `service_id` (`service_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `service_package`;
CREATE TABLE IF NOT EXISTS `service_package` (
  `package_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_id` int UNSIGNED NOT NULL,
  `package_type` enum('basic','premium') COLLATE utf8mb4_unicode_ci NOT NULL,
  `benefits` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_days` int UNSIGNED NOT NULL,
  `revisions` int UNSIGNED DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`package_id`),
  KEY `service_id` (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(107, 138, 'premium', 'btaebea', 3, 6, 55.00),
(108, 139, 'basic', 'Basic Benefits', 5, 3, 35.00),
(109, 139, 'premium', 'Premium Benefits', 3, 5, 55.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('businessman','influencer','designer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'businessman',
  `professional_title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialties` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tools` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_status` enum('active','inactive','suspended') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `verification_status` enum('unverified','verified','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unverified',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `phone`, `password`, `profile_picture`, `cover_picture`, `bio`, `role`, `professional_title`, `specialties`, `tools`, `location`, `account_status`, `verification_status`, `created_at`, `updated_at`) VALUES
(1, 'Isuru Naveen', 'isurunaveen@gmail.com', '', '$2y$10$fvlJlCeLnaKIqsyRSFnhlezy1M09HunOva4H94Mfbsd/jGITPSItO', '\\cdn_uploads\\services\\service_677d901a641a7_1736282138.jpg', 'cdn_uploads/services/service_677d901a63c9f_1736282138.png', '', 'designer', '', '', '', '', 'active', 'unverified', '2025-01-06 03:10:21', '2025-04-09 06:05:22'),
(2, 'Alpha Lee', 'janesmith@brandboost.lk', '', '$2y$10$fvlJlCeLnaKIqsyRSFnhlezy1M09HunOva4H94Mfbsd/jGITPSItO', '\\cdn_uploads\\users\\dp\\lalitha-epaarachchi-sri-lankan-fitness-influencer.webp', 'cdn_uploads/services/service_677d901a63c9f_1736282138.png', NULL, 'influencer', '', '', '', '', 'active', 'unverified', '2025-01-06 03:10:21', '2025-03-04 14:33:27'),
(3, 'Alice Perera', 'alicep@brandboost.lk', '', '$2y$10$8K7zgqpeY57peox0O2rFse5/zC9hPeF2.3dJfVw/0ZQJ3kQhmbK2K', NULL, '', NULL, 'businessman', '', '', '', '', 'active', 'unverified', '2025-01-06 03:10:21', '2025-01-24 01:58:23'),
(4, 'Bob Silva', 'bobs@brandboost.lk', '', '$2y$10$8K7zgqpeY57peox0O2rFse5/zC9hPeF2.3dJfVw/0ZQJ3kQhmbK2K', NULL, '', NULL, 'businessman', '', '', '', '', 'active', 'unverified', '2025-01-06 03:10:21', '2025-01-24 01:58:18'),
(15, 'Stephanie Cruz', 'sarah@social.com', '', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '\\cdn_uploads\\users\\dp\\DlGrcWrXcAEWOSz.jpg', '', 'Fashion and lifestyle influencer', 'influencer', '', '', '', '', 'active', 'unverified', '2024-12-31 05:13:04', '2025-01-28 09:27:58'),
(16, 'Mike Designer', 'mike@design.com', '', '$2y$10$fvlJlCeLnaKIqsyRSFnhlezy1M09HunOva4H94Mfbsd/jGITPSItO', 'https://storage.googleapis.com/a1aa/image/6yVDNncLcU45F9JPN2TMPNfDNRwHKrGqblFJU3fu7ew098AoA.jpg', '', 'Creative designer with modern style', 'designer', '', '', '', '', 'active', 'unverified', '2024-12-31 05:13:04', '2025-01-11 07:57:29'),
(17, 'Lisa Business', 'lisa@business.com', '', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', 'https://storage.googleapis.com/a1aa/image/6yVDNncLcU45F9JPN2TMPNfDNRwHKrGqblFJU3fu7ew098AoA.jpg', '', 'Tech startup founder', 'businessman', '', '', '', '', 'active', 'unverified', '2024-12-31 05:13:04', '2025-01-06 10:38:09'),
(18, 'Omaya Shanelli', 'tom@social.com', '', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '\\cdn_uploads\\users\\dp\\images (2).jpeg', '', 'Tech and gaming influencer', 'influencer', '', '', '', '', 'active', 'unverified', '2024-12-31 05:13:04', '2025-01-28 09:34:22'),
(20, 'Isuru Naveen', 'isuru@gmail.com', '', '$2y$10$fvlJlCeLnaKIqsyRSFnhlezy1M09HunOva4H94Mfbsd/jGITPSItO', 'https://storage.googleapis.com/a1aa/image/6yVDNncLcU45F9JPN2TMPNfDNRwHKrGqblFJU3fu7ew098AoA.jpg', '', NULL, 'designer', '', '', '', '', 'active', 'unverified', '2025-01-02 05:53:35', '2025-01-11 07:43:07'),
(21, 'Thiwanka Dilshan', 'thiwa@gmail.com', '', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '\\cdn_uploads\\users\\dp\\zuri-sri-lankan-fitness-influencers.webp', '', NULL, 'influencer', '', '', '', '', 'active', 'unverified', '2025-01-02 10:31:15', '2025-01-28 09:33:18'),
(22, 'tharusha tharu', 'tharusha@gmail.com', '', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', NULL, '', NULL, 'businessman', '', '', '', '', 'active', 'unverified', '2025-01-04 06:52:36', '2025-01-04 18:50:58'),
(23, 'Soliyas Mendis', 'soliyasmendis@gmail.com', '', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '\\cdn_uploads\\users\\dp\\images (4).jpeg', '', NULL, 'designer', '', '', '', '', 'active', 'unverified', '2025-01-04 07:46:18', '2025-01-28 09:57:45'),
(24, 'Bjohn Bdoe', 'business@m.com', '', '$2y$10$V/LrOHBYnoUWAaPf78n.0uzswfjN08b2sJZe6tlNxrMRHg51qYULi', 'https://storage.googleapis.com/a1aa/image/6yVDNncLcU45F9JPN2TMPNfDNRwHKrGqblFJU3fu7ew098AoA.jpg', 'cdn_uploads/services/678d0975064dd.jpg', 'Creative designer with modern style', 'businessman', '', '', '', '', 'active', 'unverified', '2025-01-05 04:53:19', '2025-03-04 08:34:47'),
(25, 'Hashi Jay', 'influencer@m.com', '', '$2y$10$ApCUEW6b2dkn.vVsEuzO3eTl7s3laKCmjylfwj4byRKo5eJFji4x6', '\\cdn_uploads\\users\\dp\\Christina-Plate-819x1024.jpg', '', NULL, 'influencer', '', '', '', '', 'active', 'unverified', '2025-01-05 04:54:00', '2025-01-28 09:29:18'),
(26, 'Nadun Basuru', 'designer@m.com', '', '$2y$10$fvlJlCeLnaKIqsyRSFnhlezy1M09HunOva4H94Mfbsd/jGITPSItO', '\\cdn_uploads\\users\\dp\\man_with_a_short_boxed_beard_1.jpg', '\\cdn_uploads\\users\\cover_photo\\f4a7898c7314a648f07d42ea9bb24340d2f6ddba.png', 'New bio', 'designer', '', '', '', '', 'active', 'unverified', '2025-01-05 04:54:41', '2025-04-09 08:59:25'),
(27, 'new de', 'decdec@m.com', '', '$2y$10$d6ay1Pcjuae0xydDe3UvVO7oOONpJzzjgfnLJ8iKeogBn59R.8Pf2', NULL, '', NULL, 'businessman', '', '', '', '', 'active', 'unverified', '2025-01-06 05:05:10', '2025-01-06 05:05:10'),
(28, 'Shane Mario', 'hero@m.com', '', '$2y$10$mFh9TzzNgVtfhQwPPd67.u1aAYYl8QWUuEfV/bk3mGs0RiT39vmMG', '\\cdn_uploads\\users\\dp\\yohan-seth-perera-1.webp', '', NULL, 'influencer', '', '', '', '', 'active', 'unverified', '2025-01-06 05:07:34', '2025-01-28 09:32:59'),
(41, 'Dilum Ekanayaka', 'dilumekanayaka@mail.com', '', '$2y$10$M9Br2AJfF21HAOU.Jd3Gt.UwWFwO9q9./.gnGSi02Kj6.BCnUxEHm', NULL, '', NULL, 'businessman', '', '', '', '', 'active', 'unverified', '2025-01-19 14:07:22', '2025-01-28 09:31:41'),
(42, 'Dilum Ekanayaka', 'dilumekanayaka@email.com', '', '$2y$10$Ic2uCwxxduNWwBs6teEr1OpFuAV4c8UmpyqDh9VDgiKrO0sC2d7Gi', '\\cdn_uploads\\users\\dp\\images (1).jpeg', '', NULL, 'influencer', '', '', '', '', 'active', 'unverified', '2025-01-28 02:32:57', '2025-01-28 09:32:12'),
(43, 'wer fw', 'kavindadimuthu260@gmail.comfw', '', '$2y$10$haPm3HycZFBczNYzFl1FD.7EIU.jDcWXiIycWeq0EbvCiTq8CIHha', NULL, '', NULL, 'businessman', '', '', '', '', 'active', 'unverified', '2025-01-28 02:35:21', '2025-01-28 02:35:21'),
(45, 'Elon Musk', 'elon@tesla.com', '', '$2y$10$0YDLNON5wmAOo7dX2aSGHu2WWQdtaDaeNnoW/0LUQ0GEbw6zTdF/6', NULL, NULL, NULL, 'designer', '', '', '', '', 'active', 'verified', '2025-04-09 14:49:57', '2025-04-09 14:49:57'),
(46, 'Nethsilu Marasinghe', 'business@gmail.com', '', '$2y$12$b4uom5246fR4/55MDcbxQOxRbkLPx19sDFwcmT/V7ncNeJ34dq2Wu', NULL, NULL, NULL, 'businessman', '', '', '', '', 'active', 'unverified', '2025-04-13 07:48:42', '2025-04-13 07:48:42'),
(47, 'Nadun Sandanayake', 'influencer@gmail.com', '', '$2y$12$TVAZ1KMpNtJnLwryxz62D.I/YdTYaC/ZJeXWJJLgh2dtQeLDkRZqi', NULL, NULL, NULL, 'influencer', '', '', '', '', 'active', 'unverified', '2025-04-13 07:49:22', '2025-04-13 07:49:22'),
(48, 'Isuru Liyanaarachchi', 'designer@gmail.com', '', '$2y$12$T6U6/4ZYFGIApPJlAH2w.u3cfHW3gvyiFNoiaEjf.H36Yx/0JzuJO', NULL, NULL, NULL, 'designer', '', '', '', '', 'active', 'verified', '2025-04-13 07:49:43', '2025-04-13 07:49:43');

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
  ADD CONSTRAINT `complaint_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`custom_package_id`) REFERENCES `service_custom_package` (`custom_package_id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
-- Constraints for table `order_revision`
--
ALTER TABLE `order_revision`
  ADD CONSTRAINT `order_revision_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
