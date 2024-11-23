-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 03:06 PM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(8, 'Kavindacd', 'Dimuthucd', 'ddvsv@gmail.com', '42554245', '$2y$10$YTNYNmBTCj6rLcHBOf.rP.3Po4cnk9mVJOCssRI2QCGsOE7MZDJXK', 'admin', 'male');

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
-- Indexes for table `designer_qualifications`
--
ALTER TABLE `designer_qualifications`
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designer_gig`
--
ALTER TABLE `designer_gig`
  MODIFY `gig_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `influencer_gig`
--
ALTER TABLE `influencer_gig`
  MODIFY `gig_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
