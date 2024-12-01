-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 08:02 PM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `businessman_registrations`
--

CREATE TABLE `businessman_registrations` (
  `user_id` int(11) NOT NULL,
  `registration_number` varchar(50) NOT NULL,
  `proof_document` varchar(255) NOT NULL,
  `business_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designer_gig`
--

CREATE TABLE `designer_gig` (
  `gig_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `delivery_formats` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designer_gig`
--

INSERT INTO `designer_gig` (`gig_id`, `user_id`, `title`, `description`, `delivery_formats`, `tags`, `status`) VALUES
(4, 23, 'fb and insta post design', 'fb, insta post design for business promotions', 'jpg,png', 'fb,post,promotion', 'active'),
(5, 23, 'insta reel creating', 'insta reel creating description', 'mp4', 'new, insta, reel', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `designer_gig_package_details`
--

CREATE TABLE `designer_gig_package_details` (
  `gig_id` int(11) NOT NULL,
  `package_type` enum('basic','standard','premium') NOT NULL,
  `benefits` text NOT NULL,
  `delivery_days` int(11) NOT NULL,
  `revisions` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designer_gig_package_details`
--

INSERT INTO `designer_gig_package_details` (`gig_id`, `package_type`, `benefits`, `delivery_days`, `revisions`, `price`) VALUES
(4, 'basic', 'benefits basic', 5, 2, 35.00),
(4, 'premium', 'benefits premium ', 3, 4, 46.00),
(5, 'basic', 'basic reels', 5, 2, 15.00),
(5, 'premium', 'premium reels', 3, 4, 25.00);

-- --------------------------------------------------------

--
-- Table structure for table `designer_portfolio`
--

CREATE TABLE `designer_portfolio` (
  `portfolio_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cover_image` varchar(255) NOT NULL,
  `first_image` varchar(255) DEFAULT NULL,
  `second_image` varchar(255) DEFAULT NULL,
  `third_image` varchar(255) DEFAULT NULL,
  `fourth_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designer_portfolio`
--

INSERT INTO `designer_portfolio` (`portfolio_id`, `user_id`, `title`, `description`, `cover_image`, `first_image`, `second_image`, `third_image`, `fourth_image`, `created_at`, `updated_at`) VALUES
(3, 23, 'new portfolio', 'new new nwe', 'uploads/designer/portfolio/674a846f0efc0_fblogo.png', 'uploads/designer/portfolio/674a846f0f3ef_tiktoklogo.png', 'uploads/designer/portfolio/674a846f0f60d_youtubelogo.png', 'uploads/designer/portfolio/674a846f0f81b_instalogo.png', 'uploads/designer/portfolio/674a846f0fd4e_xlogo.png', '2024-11-30 03:20:15', '2024-11-30 03:20:15');

-- --------------------------------------------------------

--
-- Table structure for table `designer_qualifications`
--

CREATE TABLE `designer_qualifications` (
  `user_id` int(11) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `proof_document` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(10) NOT NULL,
  `question` varchar(200) NOT NULL,
  `answer` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(1, 'What is the return policy?', 'Our return policy lasts 30 days. If 30 days have gone by since your purchase, we can’t offer you a refund or exchange.'),
(4, 'How can I contact customer support?', 'You can contact our customer support via email at support@example.com or call us at 123-456-7890.'),
(12, 'sachith', 'mu kari pakaya'),
(13, 'kava', 'i am real kava from embiliptiya'),
(14, 'tharusha', 'medawachchiye kariya\n'),
(15, 'gaiya', 'mu real kolukarayek');

-- --------------------------------------------------------

--
-- Table structure for table `influencer_gig`
--

CREATE TABLE `influencer_gig` (
  `gig_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `platform` varchar(50) NOT NULL,
  `tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `influencer_gig_package_details`
--

CREATE TABLE `influencer_gig_package_details` (
  `gig_id` int(11) NOT NULL,
  `package_type` enum('basic','standard','premium') NOT NULL,
  `benefits` text NOT NULL,
  `designing_days` int(11) NOT NULL,
  `promotional_days` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `influencer_links`
--

CREATE TABLE `influencer_links` (
  `user_id` int(11) NOT NULL,
  `platform_name` varchar(50) NOT NULL,
  `profile_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','influencer','designer','businessman') NOT NULL,
  `gender` enum('male','female','other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `phone`, `password`, `role`, `gender`) VALUES
(1, 'gra', 'garw', 'kavindadimuthu260@gmail.com', '', '$2y$10$E38KxN7WBe6rIIazLS8Fh.B.HQItqpTLkoNGpz.j52mK5R31m8BpW', 'admin', 'male'),
(8, 'Kavindacd', 'Dimuthucd', 'ddvsv@gmail.com', '42554245', '$2y$10$YTNYNmBTCj6rLcHBOf.rP.3Po4cnk9mVJOCssRI2QCGsOE7MZDJXK', 'admin', 'male'),
(9, 'bus', 'barista', 'jiji@uhh', '46565', '$2y$10$FATB9BM.oIbRlyM.WBsjyeA0.wRRW4nquuWt1q16lCjWTXoQ0UKUa', 'admin', 'male'),
(10, 'f', 'fs', 'dfsdae@njlnl', '254425', '$2y$10$ZnJzYaJLM/WYsxZoFD2shuIH1EFwdH41Il2uv0XlN7xODnk1bhsLG', 'admin', 'male'),
(11, 'te', 'ert', 'dfsdteae@njlnl', '25442355', '$2y$10$QIqgu2QZOhIpfdLP.3PSSeDux18VGYnLxfINgfKTQhPohJqAbbyYO', 'admin', 'male'),
(12, 'isuru', 'son', 'ysu@tayh', '517929', '$2y$10$MX.bjiyhOXDuuz4Vp979x.iZFtIAjVueY2TVbYVFHNyDYU2ZjEciK', 'admin', 'male'),
(13, 'tharusha', 'navod', 'tn@gmail.com', '1215366', '$2y$10$pyj9IW2uKi4kaFkYYvjFBekjpR8OpdkHZgFFLNPyZBD9JY6anFf1i', 'admin', 'male'),
(15, 'te', 'eg', 'gr2EW@GRS', '314', '$2y$10$2EUu5YdQBKzZbIj9aVAtL.FdhjGr4h2GWwdZf4drN4wewaWuFEgJW', 'businessman', 'male'),
(16, 'cds', 'csd', 'acd@dea', '143', '$2y$10$djyUxN687E2PgZ.Nk4IvReBLu7fsQkvVHo2VCS7AxVlhnoU9KSBMa', 'influencer', 'female'),
(17, 'qe', 'qwe', 'tnewq@gmail.com', '121536621', '$2y$10$kz5d0RiV5YFYFEDSb8OdDu35z4QOUN/tcogP2qhKYtmEbpoT8Oyyi', 'designer', 'female'),
(18, 'isuru', 'son', 'isurunaveen27@gmail.com', '5179293424', '$2y$10$n4c/T0BaTQl2c4vFHFeYKOxvmaGeVDJGoYInyNYgjiN.jrvSdDCZS', 'businessman', 'male'),
(20, 'Kavinda', 'son', 'kawa@gm', '51792932', '$2y$10$qU44XA1Bk93T0vb.QiKFH.FeycWt7YwnCYHAvuCXCXH8azUUsmdnC', 'designer', 'male'),
(21, 'deemath', 'jaye', 'deema@gmail', '0710718989', '$2y$10$HL0DgTbPs94f7JHlCrXJLOCDttQHuB0M2LrhXSfO6GB7LkmBWFkIW', 'influencer', 'male'),
(23, 'thiwanga', 'jayasinghe', 'thiwa@gmail.com', '077898989', '$2y$10$SnYSJ5A63FZzXYCqAmQlZeIE05ZwCYqJ4PoPTJhWZKpLwwTETDnau', 'designer', 'male'),
(24, 'rashmika', 'mihashi', 'rashmika@gmail', '07777898', '$2y$10$e8tmnjCO3R6MT3FKLif1xumz/Q4XPAQwDReGjDrwXcqRyirHk9qpa', 'influencer', 'male'),
(25, 'nethsilu', 'marasignhe', 'nethsilu@gmail.com', '07777343434', '$2y$10$7wbzUrmJ26Stsu9q7Xsqu.1f2AcvhTC49.u0pWzarGvKYit8pVzd2', 'businessman', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `businessman_registrations`
--
ALTER TABLE `businessman_registrations`
  ADD UNIQUE KEY `registration_number` (`registration_number`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `designer_gig`
--
ALTER TABLE `designer_gig`
  ADD PRIMARY KEY (`gig_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `designer_gig_package_details`
--
ALTER TABLE `designer_gig_package_details`
  ADD PRIMARY KEY (`gig_id`,`package_type`);

--
-- Indexes for table `designer_portfolio`
--
ALTER TABLE `designer_portfolio`
  ADD PRIMARY KEY (`portfolio_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `designer_qualifications`
--
ALTER TABLE `designer_qualifications`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `influencer_gig`
--
ALTER TABLE `influencer_gig`
  ADD PRIMARY KEY (`gig_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `influencer_gig_package_details`
--
ALTER TABLE `influencer_gig_package_details`
  ADD PRIMARY KEY (`gig_id`,`package_type`);

--
-- Indexes for table `influencer_links`
--
ALTER TABLE `influencer_links`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `designer_gig`
--
ALTER TABLE `designer_gig`
  MODIFY `gig_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `designer_portfolio`
--
ALTER TABLE `designer_portfolio`
  MODIFY `portfolio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `influencer_gig`
--
ALTER TABLE `influencer_gig`
  MODIFY `gig_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `businessman_registrations`
--
ALTER TABLE `businessman_registrations`
  ADD CONSTRAINT `businessman_registrations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `designer_gig`
--
ALTER TABLE `designer_gig`
  ADD CONSTRAINT `designer_gig_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `designer_gig_package_details`
--
ALTER TABLE `designer_gig_package_details`
  ADD CONSTRAINT `designer_gig_package_details_ibfk_1` FOREIGN KEY (`gig_id`) REFERENCES `designer_gig` (`gig_id`) ON DELETE CASCADE;

--
-- Constraints for table `designer_portfolio`
--
ALTER TABLE `designer_portfolio`
  ADD CONSTRAINT `designer_portfolio_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `designer_qualifications`
--
ALTER TABLE `designer_qualifications`
  ADD CONSTRAINT `designer_qualifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `influencer_gig`
--
ALTER TABLE `influencer_gig`
  ADD CONSTRAINT `influencer_gig_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `influencer_gig_package_details`
--
ALTER TABLE `influencer_gig_package_details`
  ADD CONSTRAINT `influencer_gig_package_details_ibfk_1` FOREIGN KEY (`gig_id`) REFERENCES `influencer_gig` (`gig_id`) ON DELETE CASCADE;

--
-- Constraints for table `influencer_links`
--
ALTER TABLE `influencer_links`
  ADD CONSTRAINT `influencer_links_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
