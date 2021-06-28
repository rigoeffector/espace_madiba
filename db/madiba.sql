-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2021 at 08:47 AM
-- Server version: 8.0.25-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `madiba`
--

-- --------------------------------------------------------

--
-- Table structure for table `video_book`
--

CREATE TABLE `video_book` (
  `id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `summary` text,
  `video_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_classesId` int NOT NULL,
  `user_categoryId` int NOT NULL,
  `auhtor` varchar(255) DEFAULT NULL,
  `bookCategoryId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `video_book`
--
ALTER TABLE `video_book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_classesId` (`user_classesId`),
  ADD KEY `user_categoryId` (`user_categoryId`),
  ADD KEY `video_book_ibfk_3` (`bookCategoryId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `video_book`
--
ALTER TABLE `video_book`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `video_book`
--
ALTER TABLE `video_book`
  ADD CONSTRAINT `video_book_ibfk_1` FOREIGN KEY (`user_classesId`) REFERENCES `user_classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `video_book_ibfk_2` FOREIGN KEY (`user_categoryId`) REFERENCES `user_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `video_book_ibfk_3` FOREIGN KEY (`bookCategoryId`) REFERENCES `book_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
