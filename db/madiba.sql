-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2021 at 11:47 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `image`) VALUES
(1, 'admin', 'admin', 'upload/919404-contes.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `audio_book`
--

CREATE TABLE `audio_book` (
  `id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `audio_url` text NOT NULL,
  `user_classesId` int NOT NULL,
  `user_categoryId` int NOT NULL,
  `bookCategoryId` int NOT NULL,
  `summary` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `numbers` varchar(255) DEFAULT NULL,
  `authors` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `summary` text,
  `languages` varchar(255) DEFAULT NULL,
  `book_categoryId` int NOT NULL,
  `user_classesId` int NOT NULL,
  `isAvailable` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `number_of_books` varchar(50) DEFAULT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `icon_image` varchar(255) DEFAULT NULL,
  `user_classesId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `categoryId` int NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `is_free` int NOT NULL DEFAULT '1',
  `price` varchar(100) DEFAULT NULL,
  `available_places` varchar(100) NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `categoryId`, `image`, `location`, `time`, `date`, `is_free`, `price`, `available_places`, `status`) VALUES
(11, 'Espace Madiba Launch', 'Awesome Event for every one, it is good ideas to attend this event, we have networking , snakc time and what ever', 9, 'upload/529554-whatsapp-image-2021-06-20-at-1.09.34-pm.png', 'Kigali Kacyiru', '14:00', '2021-07-01', 0, '0', '100', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events_category`
--

CREATE TABLE `events_category` (
  `id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events_category`
--

INSERT INTO `events_category` (`id`, `title`) VALUES
(9, 'Free Events'),
(10, 'Not Free Events');

-- --------------------------------------------------------

--
-- Table structure for table `news_feed`
--

CREATE TABLE `news_feed` (
  `id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `summary` text,
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `news_feed`
--

INSERT INTO `news_feed` (`id`, `title`, `summary`, `created_time`, `image`) VALUES
(1, 'Madiba App Launch', 'Tomorrow we will Launch Our new App with you guys', '2021-06-09 09:50:35', 'upload/214863-adventure.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `registartion_users`
--

CREATE TABLE `registartion_users` (
  `id` int NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `user_categoryId` int NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `isMembershipPaid` int NOT NULL DEFAULT '0',
  `user_classesId` int NOT NULL,
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_category`
--

CREATE TABLE `user_category` (
  `id` int NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `membership_fees` varchar(100) DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_category`
--

INSERT INTO `user_category` (`id`, `title`, `membership_fees`, `created_time`) VALUES
(6, 'Familly', '25000', '2021-06-27 22:00:00'),
(7, 'Individual', '15000', '2021-06-27 22:00:00'),
(8, 'Community', '30000', '2021-06-27 22:00:00'),
(9, 'Private School', '50000', '2021-06-27 22:00:00'),
(11, 'Community', '38000', '2021-06-29 22:00:00'),
(12, 'Public School', '15000', '2021-06-29 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_classes`
--

CREATE TABLE `user_classes` (
  `id` int NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `user_categoryId` int NOT NULL,
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `age_range` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_classes`
--

INSERT INTO `user_classes` (`id`, `title`, `user_categoryId`, `created_time`, `age_range`) VALUES
(10, 'Kids', 6, '2021-06-27 22:00:00', '3-6');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audio_book`
--
ALTER TABLE `audio_book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_classesId` (`user_classesId`),
  ADD KEY `user_categoryId` (`user_categoryId`),
  ADD KEY `bookCategoryId` (`bookCategoryId`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_categoryId` (`book_categoryId`),
  ADD KEY `user_classesId` (`user_classesId`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_classesId` (`user_classesId`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categotyFk` (`categoryId`);

--
-- Indexes for table `events_category`
--
ALTER TABLE `events_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_feed`
--
ALTER TABLE `news_feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registartion_users`
--
ALTER TABLE `registartion_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ucl_fks` (`user_classesId`),
  ADD KEY `uct_fks` (`user_categoryId`);

--
-- Indexes for table `user_category`
--
ALTER TABLE `user_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_classes`
--
ALTER TABLE `user_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uc_fk` (`user_categoryId`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `audio_book`
--
ALTER TABLE `audio_book`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `events_category`
--
ALTER TABLE `events_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `news_feed`
--
ALTER TABLE `news_feed`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registartion_users`
--
ALTER TABLE `registartion_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_category`
--
ALTER TABLE `user_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_classes`
--
ALTER TABLE `user_classes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_book`
--
ALTER TABLE `video_book`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audio_book`
--
ALTER TABLE `audio_book`
  ADD CONSTRAINT `audio_book_ibfk_1` FOREIGN KEY (`user_classesId`) REFERENCES `user_classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `audio_book_ibfk_2` FOREIGN KEY (`user_categoryId`) REFERENCES `user_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `audio_book_ibfk_3` FOREIGN KEY (`bookCategoryId`) REFERENCES `book_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`book_categoryId`) REFERENCES `book_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`user_classesId`) REFERENCES `user_classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book_category`
--
ALTER TABLE `book_category`
  ADD CONSTRAINT `book_category_ibfk_1` FOREIGN KEY (`user_classesId`) REFERENCES `user_classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `categotyFk` FOREIGN KEY (`categoryId`) REFERENCES `events_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registartion_users`
--
ALTER TABLE `registartion_users`
  ADD CONSTRAINT `ucl_fks` FOREIGN KEY (`user_classesId`) REFERENCES `user_classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uct_fks` FOREIGN KEY (`user_categoryId`) REFERENCES `user_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_classes`
--
ALTER TABLE `user_classes`
  ADD CONSTRAINT `uc_fk` FOREIGN KEY (`user_categoryId`) REFERENCES `user_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
