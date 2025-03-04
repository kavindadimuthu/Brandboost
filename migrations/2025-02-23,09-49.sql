-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2025 at 09:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
  `action_type` enum('banned','blocked','reversed','canceled') NOT NULL,
  `action_note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, 'Ajohn', 'admin@m.com', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '2025-01-05 04:56:11'),
(5, 'John Admin', 'admin@admin.com', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '2024-12-31 05:13:04'),
(6, 'kavinda', 'kavinda@gmail', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '2024-12-29 17:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `businessman`
--

CREATE TABLE `businessman` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `business_name` varchar(100) NOT NULL,
  `br_document` varchar(255) NOT NULL,
  `br_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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

CREATE TABLE `chat_message` (
  `message_id` int(10) UNSIGNED NOT NULL,
  `chat_room_id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivered_at` timestamp NULL DEFAULT NULL,
  `read_status` enum('unread','read') NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, 2, 4, '2025-01-06 03:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` enum('open','resolved','pending') NOT NULL DEFAULT 'open',
  `response` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `package_id` int(10) UNSIGNED DEFAULT NULL,
  `custom_package_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_type` enum('credit_card','paypal','bank_transfer','other') NOT NULL,
  `delivered_date` date DEFAULT NULL,
  `remained_revisions` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_status` enum('pending','in_progress','completed','canceled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `service_id`, `customer_id`, `package_id`, `custom_package_id`, `payment_type`, `delivered_date`, `remained_revisions`, `order_status`, `created_at`) VALUES
(27, 42, 24, 54, NULL, 'paypal', NULL, 0, 'pending', '2025-01-18 15:14:13'),
(28, 42, 24, 54, NULL, 'paypal', NULL, 0, 'pending', '2025-01-18 15:14:53'),
(29, 42, 24, 54, NULL, 'paypal', NULL, 2, 'pending', '2025-01-18 15:16:00'),
(30, 42, 24, 54, NULL, 'paypal', NULL, 2, 'pending', '2025-01-18 15:19:02'),
(31, 42, 24, 54, NULL, 'paypal', NULL, 2, 'pending', '2025-01-18 15:24:54'),
(32, 18, 24, 18, NULL, 'paypal', NULL, 1, 'pending', '2025-01-19 08:11:15'),
(33, 45, 24, 60, NULL, 'paypal', NULL, 4, 'pending', '2025-01-19 08:40:00'),
(34, 45, 24, 60, NULL, 'paypal', NULL, 4, 'pending', '2025-01-19 08:40:27'),
(35, 18, 1, 18, NULL, 'paypal', NULL, 1, 'pending', '2025-01-22 03:18:57'),
(36, 45, 44, 60, NULL, 'paypal', NULL, 4, 'pending', '2025-02-18 13:01:24'),
(37, 45, 44, 60, NULL, 'paypal', NULL, 4, 'pending', '2025-02-18 13:27:07'),
(38, 45, 44, 60, NULL, 'paypal', NULL, 4, 'pending', '2025-02-18 13:34:26');

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
(30, 36, '{\"title\":\"Ship category (engineering) presentation.pptx\",\"description\":\"jfyhhhmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmn\",\"delivery_formats\":\"[\\\"jpg\\\",\\\"png\\\",\\\"psd\\\"]\",\"benefits\":\"sfv\",\"service_type\":\"gig\"}', '', 4, 4, 80.00),
(31, 37, '{\"title\":\"Ship category (engineering) presentation.pptx\",\"description\":\"jfyhhhmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmn\",\"delivery_formats\":\"[\\\"jpg\\\",\\\"png\\\",\\\"psd\\\"]\",\"benefits\":\"sfv\",\"service_type\":\"gig\"}', '{\"accepted_service\":[\"business_plan\"],\"delivery_days\":7,\"number_of_revisions\":2,\"price\":500}', 4, 4, 80.00),
(32, 38, '{\"title\":\"Ship category (engineering) presentation.pptx\",\"description\":\"jfyhhhmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmnmn\",\"delivery_formats\":\"[\\\"jpg\\\",\\\"png\\\",\\\"psd\\\"]\",\"benefits\":\"sfv\",\"service_type\":\"gig\"}', '{\"requirements\":\"twe\",\"description\":\"wetv\"}', 4, 4, 80.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_reviews_feedback`
--

CREATE TABLE `order_reviews_feedback` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `review_type` enum('review','feedback') NOT NULL,
  `content` text NOT NULL,
  `rating` tinyint(3) UNSIGNED DEFAULT NULL CHECK (`rating` between 1 and 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_revision`
--

CREATE TABLE `order_revision` (
  `revision_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `revision_number` int(10) UNSIGNED NOT NULL,
  `request_note` text DEFAULT NULL,
  `delivery_note` text DEFAULT NULL,
  `deliveries` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`deliveries`)),
  `status` enum('pending','submitted','accepted','rejected') NOT NULL DEFAULT 'pending',
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(134, 26, 'Professional logo', 'fdnbdgfndgngnmfmnnf bnfnxcncxncxvnxfgndgnbgngcxnxgngnxggnxgfnn', 'cdn_uploads/services/678d089081563.jpg', '[\"cdn_uploads\\/services\\/678d089081b92.jpg\",\"cdn_uploads\\/services\\/678d0890821c7.jpg\",\"cdn_uploads\\/services\\/678d089082898.jpg\",\"cdn_uploads\\/services\\/678d089083271.jpg\"]', 'gig', '[\"facebook\",\"twitter\"]', '[\"jpg\",\"png\"]', '[\"web\",\"hdg\"]', '2025-01-19 14:13:36', '2025-01-19 14:13:36'),
(136, 26, 'Boost your social media presence', 'Professional photo editing and retouching', 'cdn_uploads/services/6797ccf505d64.png', '[\"cdn_uploads\\/services\\/6797ccf506136.png\",\"cdn_uploads\\/services\\/6797ccf506301.png\",\"cdn_uploads\\/services\\/6797ccf50658b.png\",\"cdn_uploads\\/services\\/6797ccf506789.png\"]', 'gig', '[\"twitter\"]', '[\"psd\",\"ai\"]', '[\"gnfx\",\"nfxg\"]', '2025-01-27 18:14:13', '2025-01-28 10:30:29'),
(137, 2, 'Custom website development services', 'Develop high-performance mobile applications', 'cdn_uploads/services/6798374ec5d83.jpg', '[\"cdn_uploads\\/services\\/6798374ec6296.webp\",\"cdn_uploads\\/services\\/6798374ec67cb.jpg\",\"cdn_uploads\\/services\\/6798374ec6d56.jpg\",\"cdn_uploads\\/services\\/6798374ec7101.jpg\"]', 'promotion', '[\"instagram\",\"twitter\"]', '[\"ai\",\"svg\"]', '[\"sfd\",\"sdfv\"]', '2025-01-28 01:47:58', '2025-01-28 10:30:21');

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
  `customer_id` int(10) UNSIGNED NOT NULL,
  `benefits_requested` text NOT NULL,
  `delivery_days_requested` int(10) UNSIGNED NOT NULL,
  `revisions_requested` int(10) UNSIGNED DEFAULT 0,
  `price_requested` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(98, 134, 'basic', 'little benefits', 8, 1, 30.00),
(99, 134, 'premium', 'More benefits', 3, 5, 50.00),
(102, 136, 'basic', 'gfn', 3, 3, 5.00),
(103, 136, 'premium', 'fng', 3, 3, 5.00),
(104, 137, 'basic', 'bzsgd', 3, 3, 5.00),
(105, 137, 'premium', 'bfd', 3, 3, 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `cover_picture` varchar(255) DEFAULT NULL,
  `bio` varchar(500) DEFAULT NULL,
  `role` enum('businessman','influencer','designer') NOT NULL DEFAULT 'businessman',
  `account_status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `verification_status` enum('unverified','verified','pending') NOT NULL DEFAULT 'unverified',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `profile_picture`, `cover_picture`, `bio`, `role`, `account_status`, `verification_status`, `created_at`, `updated_at`) VALUES
(1, 'Isuru Naveen', 'isurunaveen@gmail.com', '$2y$10$fvlJlCeLnaKIqsyRSFnhlezy1M09HunOva4H94Mfbsd/jGITPSItO', '\\cdn_uploads\\users\\dp\\Screenshot 2025-01-28 152154.png', NULL, '', 'designer', 'active', 'unverified', '2025-01-06 03:10:21', '2025-01-28 09:53:26'),
(2, 'Alpha Lee', 'janesmith@brandboost.lk', '$2y$10$fvlJlCeLnaKIqsyRSFnhlezy1M09HunOva4H94Mfbsd/jGITPSItO', '\\cdn_uploads\\users\\dp\\lalitha-epaarachchi-sri-lankan-fitness-influencer.webp', '\\cdn_uploads\\users\\dp\\lalitha-epaarachchi-sri-lankan-fitness-influencer.webp', NULL, 'influencer', 'active', 'unverified', '2025-01-06 03:10:21', '2025-02-23 08:42:21'),
(3, 'Alice Perera', 'alicep@brandboost.lk', '$2y$10$8K7zgqpeY57peox0O2rFse5/zC9hPeF2.3dJfVw/0ZQJ3kQhmbK2K', NULL, NULL, NULL, 'businessman', 'active', 'unverified', '2025-01-06 03:10:21', '2025-01-24 01:58:23'),
(4, 'Bob Silva', 'bobs@brandboost.lk', '$2y$10$8K7zgqpeY57peox0O2rFse5/zC9hPeF2.3dJfVw/0ZQJ3kQhmbK2K', NULL, NULL, NULL, 'businessman', 'active', 'unverified', '2025-01-06 03:10:21', '2025-01-24 01:58:18'),
(15, 'Stephanie Cruz', 'sarah@social.com', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '\\cdn_uploads\\users\\dp\\DlGrcWrXcAEWOSz.jpg', NULL, 'Fashion and lifestyle influencer', 'influencer', 'active', 'unverified', '2024-12-31 05:13:04', '2025-01-28 09:27:58'),
(16, 'Mike Designer', 'mike@design.com', '$2y$10$fvlJlCeLnaKIqsyRSFnhlezy1M09HunOva4H94Mfbsd/jGITPSItO', 'https://storage.googleapis.com/a1aa/image/6yVDNncLcU45F9JPN2TMPNfDNRwHKrGqblFJU3fu7ew098AoA.jpg', NULL, 'Creative designer with modern style', 'designer', 'active', 'unverified', '2024-12-31 05:13:04', '2025-01-11 07:57:29'),
(17, 'Lisa Business', 'lisa@business.com', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', 'https://storage.googleapis.com/a1aa/image/6yVDNncLcU45F9JPN2TMPNfDNRwHKrGqblFJU3fu7ew098AoA.jpg', NULL, 'Tech startup founder', 'businessman', 'active', 'unverified', '2024-12-31 05:13:04', '2025-01-06 10:38:09'),
(18, 'Omaya Shanelli', 'tom@social.com', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '\\cdn_uploads\\users\\dp\\images (2).jpeg', NULL, 'Tech and gaming influencer', 'influencer', 'active', 'unverified', '2024-12-31 05:13:04', '2025-01-28 09:34:22'),
(20, 'Isuru Naveen', 'isuru@gmail.com', '$2y$10$fvlJlCeLnaKIqsyRSFnhlezy1M09HunOva4H94Mfbsd/jGITPSItO', 'https://storage.googleapis.com/a1aa/image/6yVDNncLcU45F9JPN2TMPNfDNRwHKrGqblFJU3fu7ew098AoA.jpg', NULL, NULL, 'designer', 'active', 'unverified', '2025-01-02 05:53:35', '2025-01-11 07:43:07'),
(21, 'Thiwanka Dilshan', 'thiwa@gmail.com', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '\\cdn_uploads\\users\\dp\\zuri-sri-lankan-fitness-influencers.webp', NULL, NULL, 'influencer', 'active', 'unverified', '2025-01-02 10:31:15', '2025-01-28 09:33:18'),
(22, 'tharusha tharu', 'tharusha@gmail.com', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', NULL, NULL, NULL, 'businessman', 'active', 'unverified', '2025-01-04 06:52:36', '2025-01-04 18:50:58'),
(23, 'Soliyas Mendis', 'soliyasmendis@gmail.com', '$2y$10$yMn0WL/wNHL2ENdT6z3Tp.n0icTMHX5WwQXixGP0IFTm.ecCK3XkO', '\\cdn_uploads\\users\\dp\\images (4).jpeg', NULL, NULL, 'designer', 'active', 'unverified', '2025-01-04 07:46:18', '2025-01-28 09:57:45'),
(24, 'Bjohn Bdoe', 'business@m.com', '$2y$10$V/LrOHBYnoUWAaPf78n.0uzswfjN08b2sJZe6tlNxrMRHg51qYULi', NULL, NULL, NULL, 'businessman', 'active', 'unverified', '2025-01-05 04:53:19', '2025-01-05 04:53:19'),
(25, 'Hashi Jay', 'influencer@m.com', '$2y$10$ApCUEW6b2dkn.vVsEuzO3eTl7s3laKCmjylfwj4byRKo5eJFji4x6', '\\cdn_uploads\\users\\dp\\Christina-Plate-819x1024.jpg', NULL, NULL, 'influencer', 'active', 'unverified', '2025-01-05 04:54:00', '2025-01-28 09:29:18'),
(26, 'Nadun Dinisuru', 'designer@m.com', '$2y$10$fvlJlCeLnaKIqsyRSFnhlezy1M09HunOva4H94Mfbsd/jGITPSItO', '\\cdn_uploads\\users\\dp\\Screenshot 2025-01-28 152216.png', NULL, NULL, 'designer', 'active', 'unverified', '2025-01-05 04:54:41', '2025-01-28 11:08:08'),
(27, 'new de', 'decdec@m.com', '$2y$10$d6ay1Pcjuae0xydDe3UvVO7oOONpJzzjgfnLJ8iKeogBn59R.8Pf2', NULL, NULL, NULL, 'businessman', 'active', 'unverified', '2025-01-06 05:05:10', '2025-01-06 05:05:10'),
(28, 'Shane Mario', 'hero@m.com', '$2y$10$mFh9TzzNgVtfhQwPPd67.u1aAYYl8QWUuEfV/bk3mGs0RiT39vmMG', '\\cdn_uploads\\users\\dp\\yohan-seth-perera-1.webp', NULL, NULL, 'influencer', 'active', 'unverified', '2025-01-06 05:07:34', '2025-01-28 09:32:59'),
(41, 'Dilum Ekanayaka', 'dilumekanayaka@mail.com', '$2y$10$M9Br2AJfF21HAOU.Jd3Gt.UwWFwO9q9./.gnGSi02Kj6.BCnUxEHm', NULL, NULL, NULL, 'businessman', 'active', 'unverified', '2025-01-19 14:07:22', '2025-01-28 09:31:41'),
(42, 'Dilum Ekanayaka', 'dilumekanayaka@email.com', '$2y$10$Ic2uCwxxduNWwBs6teEr1OpFuAV4c8UmpyqDh9VDgiKrO0sC2d7Gi', '\\cdn_uploads\\users\\dp\\images (1).jpeg', NULL, NULL, 'influencer', 'active', 'unverified', '2025-01-28 02:32:57', '2025-01-28 09:32:12'),
(43, 'wer fw', 'kavindadimuthu260@gmail.comfw', '$2y$10$haPm3HycZFBczNYzFl1FD.7EIU.jDcWXiIycWeq0EbvCiTq8CIHha', NULL, NULL, NULL, 'businessman', 'active', 'unverified', '2025-01-28 02:35:21', '2025-01-28 02:35:21'),
(44, 'ponnaya pakaya', 'ponnapakaya@gmail.com', '$2y$10$.lhvqFT.qQzfyhD6DPejl.YNXRWEu7wkMIJLf1BBHkg8gZ8YIbAqu', NULL, NULL, NULL, 'businessman', 'active', 'unverified', '2025-01-29 14:30:15', '2025-01-29 14:30:15'),
(45, 'business busi', 'business@gmail.com', '$2y$10$C2nYcNMjS5S90x3UT7z5x.K6cch8vpgpUoMUIe.BKbJpgWPeod/yq', NULL, NULL, NULL, 'businessman', 'active', 'unverified', '2025-02-23 08:30:36', '2025-02-23 08:30:36');

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
  ADD KEY `sender_id` (`sender_id`);

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
  ADD KEY `custom_package_id` (`custom_package_id`);

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
-- Indexes for table `order_revision`
--
ALTER TABLE `order_revision`
  ADD PRIMARY KEY (`revision_id`,`order_id`,`revision_number`),
  ADD KEY `order_id` (`order_id`);

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action`
--
ALTER TABLE `action`
  MODIFY `action_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `message_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chat_room`
--
ALTER TABLE `chat_room`
  MODIFY `chat_room_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `designer_project`
--
ALTER TABLE `designer_project`
  MODIFY `project_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `influencer_social_account`
--
ALTER TABLE `influencer_social_account`
  MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `order_promises`
--
ALTER TABLE `order_promises`
  MODIFY `promise_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_reviews_feedback`
--
ALTER TABLE `order_reviews_feedback`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_revision`
--
ALTER TABLE `order_revision`
  MODIFY `revision_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `service_analytics`
--
ALTER TABLE `service_analytics`
  MODIFY `analytics_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_custom_package`
--
ALTER TABLE `service_custom_package`
  MODIFY `custom_package_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_package`
--
ALTER TABLE `service_package`
  MODIFY `package_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
