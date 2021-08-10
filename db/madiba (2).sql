-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2021 at 12:17 AM
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
(1, 'admin', 'admin', 'upload/478819-amanda.png');

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

--
-- Dumping data for table `audio_book`
--

INSERT INTO `audio_book` (`id`, `title`, `author`, `audio_url`, `user_classesId`, `user_categoryId`, `bookCategoryId`, `summary`) VALUES
(7, 'Kids sleeping audio', 'Rigo author', 'audio-61119133440659.76405788.mp3', 6, 50, 30, 'Sawa nice audio'),
(8, 'Kids sleeping audio', 'Rigo author', 'audio-61119202a94cc1.76195590.mp3', 6, 50, 31, 'Sawa nice audio');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `numbers` varchar(255) DEFAULT NULL,
  `taken_book` varchar(255) NOT NULL,
  `authors` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `book_categoryId` int(11) NOT NULL,
  `user_classesId` int(11) NOT NULL,
  `isAvailable` varchar(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `numbers`, `taken_book`, `authors`, `image`, `summary`, `languages`, `book_categoryId`, `user_classesId`, `isAvailable`) VALUES
(40, 'La rouse', '2', '', 'ETO HAFFMAN', 'upload/797631-rousse.jpg', 'This book is intende for new user to learn langugaes', NULL, 30, 6, '1');

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
(30, 'Adventures', '30', 'English,French', 'upload/947842-samusure.jpg', 6),
(31, 'Crime', '300', 'English,French', 'upload/170705-81kz6+wplel.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `borrow_history`
--

CREATE TABLE `borrow_history` (
  `id` int(11) NOT NULL,
  `bookId` int(11) NOT NULL,
  `number_of_book_borrowed` varchar(50) DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `createdTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `return_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(19, 'Espace Madiba Launch', 'Awesome Event to do', 15, 'upload/669923-whatsapp-image-2021-08-03-at-11.44.21-pm.jpeg', 'Kigali Kacyiru KK126 ST', '12:45PM', '2021-12-20', 1, '500', '200', 1),
(20, 'Kids Session', 'We are going to teach Kids how to read quickly and getting and explanation of book in less than two hours', 15, 'upload/607965-whatsapp-image-2021-08-03-at-11.42.00-pm.jpeg', 'Kigali Kacyiru KK126 ST', '12:45PM', '2021-12-20', 1, '500', '200', 1);

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
(14, 'Free'),
(15, 'Vip');

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
(4, 'Madiba App Launch', 'Tomorrow there a metting ', '2021-08-09 16:46:41', 'upload/270589-whatsapp-image-2021-08-03-at-11.44.23-pm.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `suscriptionId` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `transaction_id` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`id`, `amount`, `suscriptionId`, `status`, `transaction_id`, `phone`, `created_time`) VALUES
(1, '110', 49, '1', '471858823', '0787947109', '2021-08-03 11:35:57'),
(2, '110', 49, '1', '472025582', '0781935028', '2021-08-03 19:11:19');

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
  `added_by` varchar(255) DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registartion_users`
--

INSERT INTO `registartion_users` (`id`, `fname`, `lname`, `address`, `phone`, `user_categoryId`, `email`, `password`, `image`, `isMembershipPaid`, `user_classesId`, `added_by`, `created_time`) VALUES
(8, 'Amanda', 'Amanda', 'kgl', '0784638201', 50, 'toussaintnghh2@gmail.com', '123456', NULL, 0, 6, NULL, '2021-08-09 19:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `bookId` int(11) NOT NULL,
  `description` text NOT NULL,
  `helpful` int(10) DEFAULT 1,
  `createdTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `userId`, `bookId`, `description`, `helpful`, `createdTime`) VALUES
(14, 8, 40, 'Awesome Book', 1, '2021-08-09 20:48:42'),
(15, 8, 40, 'Awesome Book', 1, '2021-08-09 20:56:22'),
(16, 8, 40, 'Awesome Book', 1, '2021-08-09 20:56:23'),
(17, 8, 40, 'Awesome Book', 1, '2021-08-09 20:56:24'),
(18, 8, 40, 'Awesome Book', 1, '2021-08-09 20:56:25'),
(19, 8, 40, 'Awesome Book', 1, '2021-08-09 20:56:26'),
(20, 8, 40, 'Awesome Book', 1, '2021-08-09 20:56:26');

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
(7, 'About US', 'Espace Madiba', 'slider-611154ec3ee043.61750728.jpeg', 'We are an Open and Public Platform That Inspires Communities To Read, Discover and Learn . Espace Madiba Library of mostly Africans & Caraibians writers and other parts of the world \nis coming right at your doorstep, delivering to your chosen book rented.'),
(8, 'Cafe Literaire', 'Events & Networking', 'slider-61115520ed29b8.60881538.jpeg', 'Get a chance to gather together and make connections'),
(9, 'Kids', 'Making Learning Fun', 'slider-6111554146a825.96739585.jpeg', 'Kids love it because it\'s fun. Parents and teachers love it because it\'s educational.'),
(10, 'Espace', 'Explore, Learn & Discover', 'slider-6111555eb166f9.37908803.jpeg', 'For children, teachers and book-lovers of all ages. Explore and Discover our collection of books at Espace \nMadiba. Reading is Fundamental (Fun-to-Mental)');

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
(49, 'Family', '110', 'A Family that reads together, grows together. If you and your family wish to borrow books and explore more of what Espace Madiba Library has to offer, press \"Sign Up\" and get a membership with us', '2021-07-29 22:00:00'),
(50, 'Individual', '100', 'If you are a bibliophile and love a good read, you are at the right place. Espace Madiba is here to serve you, we love book readers. If you wish to borrow books and explore more of what Espace Madiba Library has to offer, press \"Sign Up\" and get your membership with us.', '2021-07-29 22:00:00'),
(51, 'Community', '200', 'Open a book, and Open your mind. A child who reads will be an adult who thinks. Read everyday with Espace Madiba and Lead a better life. Press \"Sign Up\" to get a membership with us and explore where all the fun stuff happens.', '2021-08-02 22:00:00'),
(52, 'Private Schools', '200', 'Education is the most powerful weapon which you can use to change the world, if you are a private school and wish to explore more of what Espace Madiba has to offer, press \"Sign Up\" and get a membership with us.', '2021-08-08 22:00:00'),
(53, 'Public  Schools', '200', 'Education is the most powerful weapon which you can use to change the world, if you are a public school and wish to explore more of what Espace Madiba has to offer, press \"Sign Up\" and get a membership with us.', '2021-08-08 22:00:00');

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
(1, 'Kids', 49, '2021-08-08 22:00:00', '3-6'),
(2, 'Kids', 49, '2021-08-08 22:00:00', '6-9'),
(3, 'Kids', 49, '2021-08-08 22:00:00', '9-12'),
(4, 'Kids', 49, '2021-08-08 22:00:00', '12-15'),
(5, 'Kids', 49, '2021-08-08 22:00:00', '15-18'),
(6, 'Adults', 50, '2021-08-08 22:00:00', '18-40');

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
  `user_categoryId` int(11) DEFAULT NULL,
  `bookCategoryId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video_book`
--

INSERT INTO `video_book` (`id`, `title`, `summary`, `video_url`, `user_classesId`, `user_categoryId`, `bookCategoryId`) VALUES
(16, 'Kimiri', '\nAwesome					', 'video-6111897c552238.34219853.mp4', 6, NULL, NULL);

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
-- Indexes for table `borrow_history`
--
ALTER TABLE `borrow_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookId` (`bookId`),
  ADD KEY `userId` (`userId`);

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
  ADD KEY `event_history_ibfk_2` (`eventId`);

--
-- Indexes for table `news_feed`
--
ALTER TABLE `news_feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suscriptionId` (`suscriptionId`);

--
-- Indexes for table `registartion_users`
--
ALTER TABLE `registartion_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ucl_fks` (`user_classesId`),
  ADD KEY `uct_fks` (`user_categoryId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_ibfk_1` (`userId`),
  ADD KEY `reviews_ibfk_2` (`bookId`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `borrow_history`
--
ALTER TABLE `borrow_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `events_category`
--
ALTER TABLE `events_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `event_history`
--
ALTER TABLE `event_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `news_feed`
--
ALTER TABLE `news_feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registartion_users`
--
ALTER TABLE `registartion_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_category`
--
ALTER TABLE `user_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `user_classes`
--
ALTER TABLE `user_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_book`
--
ALTER TABLE `video_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
-- Constraints for table `borrow_history`
--
ALTER TABLE `borrow_history`
  ADD CONSTRAINT `borrow_history_ibfk_1` FOREIGN KEY (`bookId`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `borrow_history_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `registartion_users` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `categotyFk` FOREIGN KEY (`categoryId`) REFERENCES `events_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_history`
--
ALTER TABLE `event_history`
  ADD CONSTRAINT `event_history_ibfk_2` FOREIGN KEY (`eventId`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD CONSTRAINT `payment_history_ibfk_2` FOREIGN KEY (`suscriptionId`) REFERENCES `user_category` (`id`);

--
-- Constraints for table `registartion_users`
--
ALTER TABLE `registartion_users`
  ADD CONSTRAINT `ucl_fks` FOREIGN KEY (`user_classesId`) REFERENCES `user_classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uct_fks` FOREIGN KEY (`user_categoryId`) REFERENCES `user_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `registartion_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`bookId`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
