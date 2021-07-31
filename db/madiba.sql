-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2021 at 10:11 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `image`) VALUES
(1, 'rigo', '123456', 'upload/478819-amanda.png');

-- --------------------------------------------------------

--
-- Table structure for table `audio_book`
--

CREATE TABLE `audio_book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `audio_url` text NOT NULL,
  `user_classesId` int(11) NOT NULL,
  `user_categoryId` int(11) NOT NULL,
  `bookCategoryId` int(11) NOT NULL,
  `summary` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `numbers` varchar(255) DEFAULT NULL,
  `authors` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `book_categoryId` int(11) NOT NULL,
  `user_classesId` int(11) NOT NULL,
  `isAvailable` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `numbers`, `authors`, `image`, `summary`, `languages`, `book_categoryId`, `user_classesId`, `isAvailable`) VALUES
(18, 'ADONAI', '58', 'rigo', 'upload/66143-istockphoto-1251629816-170667a.jpg', '\n				sawa sawa		', NULL, 16, 26, 1),
(19, 'DONAI', '4', 'rigo', 'upload/9246-amanda.png', '\n						fsdfsd	', NULL, 26, 26, 1);

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `number_of_books` varchar(50) DEFAULT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `icon_image` varchar(255) DEFAULT NULL,
  `user_classesId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`id`, `title`, `number_of_books`, `languages`, `icon_image`, `user_classesId`) VALUES
(16, 'Adventures', '500', 'Kiswahili', 'upload/341658-shutterstock_93606586.jpg', 26),
(26, 'Video Books', '300', 'English,French', 'upload/361921-refrigerator-2.jpeg', 27),
(27, 'Video Books', '300', 'English,French', 'upload/270882-refrigerator-2.jpeg', 26);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `categoryId` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `is_free` int(11) NOT NULL DEFAULT 1,
  `price` varchar(100) DEFAULT NULL,
  `available_places` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `categoryId`, `image`, `location`, `time`, `date`, `is_free`, `price`, `available_places`, `status`) VALUES
(12, 'awes', 'nice event to have', 10, 'upload/324336-shutterstock_93606586.jpg', 'kigali', '14:00 am', '2021-07-27', 0, '0', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events_category`
--

CREATE TABLE `events_category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events_category`
--

INSERT INTO `events_category` (`id`, `title`) VALUES
(10, 'Not Free Events'),
(12, 'Free eventsuy');

-- --------------------------------------------------------

--
-- Table structure for table `event_history`
--

CREATE TABLE `event_history` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `eventId` int(11) NOT NULL,
  `place_booked` varchar(255) DEFAULT NULL,
  `createdTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_history`
--

INSERT INTO `event_history` (`id`, `userId`, `eventId`, `place_booked`, `createdTime`) VALUES
(1, 5, 12, '10', '2021-07-31 13:10:11'),
(2, 5, 12, '10', '2021-07-31 13:11:22'),
(3, 5, 12, '10', '2021-07-31 13:11:34'),
(4, 5, 12, '10', '2021-07-31 13:18:17'),
(5, 5, 12, '10', '2021-07-31 13:18:53'),
(6, 5, 12, '10', '2021-07-31 13:19:54'),
(7, 5, 12, '10', '2021-07-31 13:20:26'),
(8, 5, 12, '30', '2021-07-31 13:22:23'),
(9, 5, 12, '30', '2021-07-31 13:23:42'),
(10, 5, 12, '30', '2021-07-31 13:27:14'),
(11, 5, 12, '30', '2021-07-31 13:29:12'),
(12, 5, 12, '8', '2021-07-31 13:30:40');

-- --------------------------------------------------------

--
-- Table structure for table `news_feed`
--

CREATE TABLE `news_feed` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id` int(11) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `user_categoryId` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `isMembershipPaid` int(11) NOT NULL DEFAULT 0,
  `user_classesId` int(11) NOT NULL,
  `created_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registartion_users`
--

INSERT INTO `registartion_users` (`id`, `fname`, `lname`, `address`, `phone`, `user_categoryId`, `email`, `password`, `image`, `isMembershipPaid`, `user_classesId`, `created_time`) VALUES
(5, 'cyusa', 'tousaint', 'Kigali', '+250784638205', 50, 'rigos@gmail.com', '123456', 'upload/518265-1200px-reddot_burger.jpg', 0, 26, '2021-07-31 13:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `caption` varchar(250) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `caption`, `image`, `description`) VALUES
(2, 'Homeslider', 'awesome', 'slider-60f9986d4f6448.07411179.jpg', '0'),
(3, 'Homeslider', 'awesome', 'slider-60f99b78dda7b4.76593486.jpg', '0'),
(4, 'Homeslider', 'awesome', 'slider-60f99b94d04879.42221297.jpg', 'ni sawa cyane kbsa'),
(5, 'Test slider', 'awesome', 'slider-6100868a70fae2.59504083.png', 'ni sawa cyane kbsa');

-- --------------------------------------------------------

--
-- Table structure for table `user_category`
--

CREATE TABLE `user_category` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `membership_fees` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_category`
--

INSERT INTO `user_category` (`id`, `title`, `membership_fees`, `Description`, `created_time`) VALUES
(49, 'Familly', '14000', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', '2021-07-29 22:00:00'),
(50, 'Individual', '5000', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', '2021-07-29 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_classes`
--

CREATE TABLE `user_classes` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `user_categoryId` int(11) NOT NULL,
  `created_time` timestamp NULL DEFAULT current_timestamp(),
  `age_range` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_classes`
--

INSERT INTO `user_classes` (`id`, `title`, `user_categoryId`, `created_time`, `age_range`) VALUES
(26, 'Kids', 49, '2021-07-29 22:00:00', '3-6'),
(27, 'Kids', 50, '2021-07-29 22:00:00', '3-6');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `video_book`
--

CREATE TABLE `video_book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `video_url` text NOT NULL,
  `user_classesId` int(11) NOT NULL,
  `user_categoryId` int(11) NOT NULL,
  `auhtor` varchar(255) DEFAULT NULL,
  `bookCategoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for table `event_history`
--
ALTER TABLE `event_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `eventId` (`eventId`);

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
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `events_category`
--
ALTER TABLE `events_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `event_history`
--
ALTER TABLE `event_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `news_feed`
--
ALTER TABLE `news_feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registartion_users`
--
ALTER TABLE `registartion_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_category`
--
ALTER TABLE `user_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user_classes`
--
ALTER TABLE `user_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_book`
--
ALTER TABLE `video_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- Constraints for table `event_history`
--
ALTER TABLE `event_history`
  ADD CONSTRAINT `event_history_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `registartion_users` (`id`),
  ADD CONSTRAINT `event_history_ibfk_2` FOREIGN KEY (`eventId`) REFERENCES `events` (`id`);

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
