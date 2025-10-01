-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 01, 2025 at 11:22 AM
-- Server version: 8.0.41
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `provision`
--

-- --------------------------------------------------------

--
-- Table structure for table `oc_product_section`
--

CREATE TABLE `oc_product_section` (
  `product_section_id` int NOT NULL,
  `product_id` int NOT NULL,
  `section_type` varchar(10) NOT NULL DEFAULT 'image',
  `image` varchar(255) DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `oc_product_section`
--

INSERT INTO `oc_product_section` (`product_section_id`, `product_id`, `section_type`, `image`, `video_path`, `title`, `description`, `sort_order`) VALUES
(1, 156, 'image', 'catalog/HID/106359152_1394568554265115_4121091259042363325_n.jpg', NULL, 'test 1', '&lt;p&gt;test content&lt;/p&gt;', 1),
(2, 428, 'image', 'catalog/Accessories/Connectors-for-HID-Ballasts.jpg', '', 'Test', '&lt;p&gt;Test Content&lt;/p&gt;', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oc_product_section`
--
ALTER TABLE `oc_product_section`
  ADD PRIMARY KEY (`product_section_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `oc_product_section`
--
ALTER TABLE `oc_product_section`
  MODIFY `product_section_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
