-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2021 at 04:16 AM
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
(5, 'Yannick OMMO', 'Philpeter', 'audio-61089fa4b08572.94791133.mp3', 27, 49, 16, 'Disabled checkboxes and radios are supported, but to provide a not-allowed cursor on hover of the parent <label>, you’ll need to add the disabled attribute to the .form-check-input. The disabled attribute will apply a lighter color to help indicate the input’s state.\n							'),
(6, 'Chris Peter', 'YANNICK MOA', 'audio-6108a009783cd9.79732238.mp3', 28, 49, 27, 'Checkboxes and radios use are built to support HTML-based form validation and provide concise, accessible labels. As such, our <input>s and <label>s are sibling elements as opposed to an <input> within a <label>. This is slightly more verbose as you must specify id and for attributes to relate the <input> and <label>.\n							');

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
(18, 'ADONAI', '9', '0', 'rigo', 'upload/66143-istockphoto-1251629816-170667a.jpg', '\n				sawa sawa		', NULL, 16, 26, '1'),
(21, 'Contes Fantastiques', '4', '0', 'ETA HOFFMANN', 'upload/150080-shutterstock_93606586.jpg', 'ETA HOFFMANN', NULL, 28, 27, '1'),
(22, 'Contes Fantastiques New', '9', '0', 'ETA HOFFMANN 2', 'upload/745934-shutterstock_93606586.jpg', 'ETA HOFFMANN', NULL, 28, 27, '1');

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
(27, 'Video Books', '300', 'English,French', 'upload/270882-refrigerator-2.jpeg', 26),
(28, 'Animations', '30', 'English,French', 'upload/271574-1200px-reddot_burger.jpg', 28);

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

--
-- Dumping data for table `borrow_history`
--

INSERT INTO `borrow_history` (`id`, `bookId`, `number_of_book_borrowed`, `userId`, `createdTime`, `return_date`, `status`) VALUES
(1, 18, '1', 1, '2021-08-02 03:03:22', '2021-08-03', 1),
(2, 21, '1', 1, '2021-08-02 03:37:57', '2021-08-03', 1),
(3, 22, '1', 1, '2021-08-02 03:46:27', '2021-08-31', 1),
(4, 18, '1', 1, '2021-08-02 03:46:57', '2021-08-03', 1),
(5, 21, '1', 1, '2021-08-02 03:47:18', '2021-08-03', 1),
(6, 21, '1', 1, '2021-08-02 03:49:50', '2021-08-03', 1),
(7, 21, '1', 1, '2021-08-02 03:50:20', '2021-08-03', 1),
(8, 21, '1', 1, '2021-08-02 03:50:42', '2021-08-03', 1),
(20, 22, '3', 2, '2021-08-02 17:02:02', '2021-08-02', 0),
(21, 22, '5', 2, '2021-08-02 21:42:21', '2021-08-02', 0);

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
(15, 'Espace Madiba Launch', 'Awesome Event to do', 13, 'upload/390533-istockphoto-1251629816-170667a.jpg', 'Kigali Kacyiru KK126 ST', '12:45PM', '2021-12-20', 1, '500', '179', 1);

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
(13, 'Free eventsuy');

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
(13, 5, 15, '8', '2021-08-02 05:10:19'),
(14, 5, 15, '8', '2021-08-02 05:11:28'),
(15, 1, 15, '1', '2021-08-02 05:32:03'),
(16, 1, 15, '1', '2021-08-02 05:34:08'),
(17, 1, 15, '1', '2021-08-02 05:36:52'),
(18, 1, 15, '1', '2021-08-02 05:37:56'),
(19, 1, 15, '1', '2021-08-02 05:56:39');

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
(2, 'Madiba App Launch', 'Tomorrow there a metting ', '2021-08-02 06:57:29', 'upload/393379-1200px-reddot_burger.jpg'),
(3, 'Finishing the release madiba app', 'www.google.com’s DNS address could not be found. Diagnosing the problem.\nTry running Windows Network Diagnostics.', '2021-08-03 01:24:29', 'upload/8398-istockphoto-1251629816-170667a.jpg');

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
(1, 'vgg', 'vgg', 'ffff', '0784638201', 50, 'toussaintnghh2@gmail.com', '123456', NULL, 0, 27, NULL, '2021-08-01 23:19:42'),
(2, 'cyusa uwera', 'tousaint', 'Kigali', '+250784638202', 50, 't@gmail.com', '123456', NULL, 0, 26, NULL, '2021-08-02 16:43:18');

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
(49, 'Familly', '110', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', '2021-07-29 22:00:00'),
(50, 'Individual', '150', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', '2021-07-29 22:00:00');

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
(27, 'Kids', 50, '2021-07-29 22:00:00', '3-6'),
(28, 'Kids', 49, '2021-07-31 22:00:00', '6-9');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `borrow_history`
--
ALTER TABLE `borrow_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `events_category`
--
ALTER TABLE `events_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `event_history`
--
ALTER TABLE `event_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `news_feed`
--
ALTER TABLE `news_feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registartion_users`
--
ALTER TABLE `registartion_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_book`
--
ALTER TABLE `video_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
