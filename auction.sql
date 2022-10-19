-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2022 at 01:54 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(3) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_desc` text NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_image` text NOT NULL,
  `product_create_date` date NOT NULL,
  `product_end_time` int(3) NOT NULL,
  `product_status` varchar(10) NOT NULL,
  `product_user_id` int(3) NOT NULL,
  `winner` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_desc`, `product_price`, `product_image`, `product_create_date`, `product_end_time`, `product_status`, `product_user_id`, `winner`) VALUES
(7, 'Xerxes Cortez', 'Doloribus quia saepe', 187, 'backgound.jpg', '2022-03-04', 66, 'disabled', 1, 16),
(11, 'Juliet Stein', 'Aspernatur quod veli', 889, 'benjamin-deyoung-NbXAavuQJV4-unsplash.jpg', '2022-03-05', 5, 'active', 1, 0),
(12, 'Lenore Bradford', 'Aut dolorem amet et', 271, 'mak-XSDr6vsIh5g-unsplash.jpg', '2022-03-05', 20, 'disabled', 1, 12),
(13, 'Ifeoma Spears', 'Nisi eiusmod sed inv', 78, 'hammer.jpg', '2022-03-05', 5, 'disabled', 1, 12),
(14, 'Himal123', 'Error doloribus qui ', 111, 'auction.jpg', '2022-03-05', 123, 'active', 1, 0),
(15, 'Kaden Solomon', 'Possimus reprehende', 987, 'backgound.jpg', '2022-03-05', 1, 'disabled', 1, 12),
(17, 'Himal007', 'Himal Description', 120, 'auction.jpg', '2022-03-06', 12, 'disabled', 1, 16),
(18, 'Kasimir Roth', 'Deserunt mollitia qu', 290, 'auction.jpg', '2022-03-09', 96, 'disabled', 9, 12),
(19, 'Whitney Luna', 'Est aut fugiat a e', 214, 'jeremy-zero-yh5M-4aBiZ0-unsplash.jpg', '2022-03-15', 75, 'active', 17, 0),
(20, 'new 123', 'Cumque odit in offic', 26, 'benjamin-deyoung-NbXAavuQJV4-unsplash.jpg', '2022-03-15', 8, 'active', 1, 0),
(21, 'Flynn Morse', 'Repudiandae inventor', 967, 'backgound.jpg', '2022-03-15', 32, 'active', 1, 0),
(22, 'Julian Rollins', 'Ea dolor a similique', 404, 'backgound.jpg', '2022-03-15', 16, 'disabled', 17, 16),
(24, 'Oren Adams', 'Aliquip aut cillum e', 963, 'hammer.jpg', '2022-03-16', 58, 'active', 17, 0),
(26, 'Harshit123', 'Dolorem delectus mo', 252, 'benjamin-deyoung-NbXAavuQJV4-unsplash.jpg', '2022-03-16', 10, 'active', 1, 0),
(27, 'Jigar 123', 'Laboriosam asperior', 589, 'jeremy-zero-yh5M-4aBiZ0-unsplash.jpg', '2022-03-16', 20, 'active', 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pwd_reset`
--

CREATE TABLE `pwd_reset` (
  `pwd_reset_id` int(11) NOT NULL,
  `pwd_reset_email` text NOT NULL,
  `pwd_reset_selector` text NOT NULL,
  `pwd_reset_token` longtext NOT NULL,
  `pwd_reset_expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pwd_reset`
--

INSERT INTO `pwd_reset` (`pwd_reset_id`, `pwd_reset_email`, `pwd_reset_selector`, `pwd_reset_token`, `pwd_reset_expires`) VALUES
(25, 'businesshm2002@gmail.com', '0c25bd8feef3f966', '$2y$10$QxQg.8zoo9eUaifh8jXXX.9m/HWa0toaKnm3HY5vlc4jxd2D7129a', '1647695626');

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `bid_id` int(3) NOT NULL,
  `bid_amount` int(10) NOT NULL,
  `bid_product_id` int(3) NOT NULL,
  `bid_user_id` int(3) NOT NULL,
  `bid_date` date NOT NULL DEFAULT current_timestamp(),
  `product_user_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`bid_id`, `bid_amount`, `bid_product_id`, `bid_user_id`, `bid_date`, `product_user_id`) VALUES
(6, 150, 17, 16, '2022-03-11', 1),
(7, 1200, 18, 12, '2022-03-11', 9),
(8, 1212, 12, 12, '2022-03-11', 1),
(10, 1233, 7, 16, '2022-03-12', 1),
(12, 1212, 8, 12, '2022-03-12', 1),
(13, 80, 13, 12, '2022-03-12', 1),
(16, 1120, 15, 12, '2022-03-13', 1),
(20, 1278, 14, 12, '2022-03-15', 1),
(21, 1222, 19, 12, '2022-03-15', 17),
(22, 1206, 20, 12, '2022-03-15', 1),
(23, 1205, 21, 12, '2022-03-15', 1),
(25, 1225, 11, 16, '2022-03-15', 1),
(26, 445, 22, 16, '2022-03-15', 17);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_password` varchar(150) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` int(10) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_email`, `user_phone`, `user_image`, `user_role`) VALUES
(1, 'auctioneer', '$2y$10$mWP/RtFJTGjRwMmzdx6MpePw2qD2kLQjBI.ipt7Tt0TnhXeaYW/1K', 'auctioneer@gmail.com', 2147483647, 'profile-picture-2.jpg', 'auctioneer'),
(9, 'auctioneer2', '$2y$10$rf81VQlRLenzYlf.XH68NOH1hgF.DAwC71Y.6upvW/L7m62IMENhi', 'businesshm2002@gmail.com', 1212121212, 'profile-2.jpg', 'auctioneer'),
(12, 'bidder', '$2y$10$G2IHmmBJpOyxOuzrvRkML.qqAxXp9LunQJhffh8hZWGh.B1BsK8by', 'bidder@gmail.com', 2147483647, 'profile-picture-2.jpg', 'bidder'),
(16, 'bidder2', '$2y$10$thnFuEEvbsAJ2/WxWF3JiedkL/TXJrm.TAkglPm0ThbV4KpAoCJ4S', 'bidder2@gmail.com', 1234234575, 'profile-6.jpg', 'bidder'),
(17, 'admin', '$2y$10$rjnPIIIPCtI5FXdvZFmikuRXFULt59zfVXyUPtfNiCe81hAC5VyBq', 'admin@gmail.com', 1234567835, 'profile-6.jpg', 'admin'),
(18, 'himal', '$2y$10$I/7Q3XOMQwVGGqcDYK3IWuEAYZBizoKdUs5VrQR8ggvEUKoCrJCre', 'himal@gmail.com', 2147483647, 'profile-picture-1.jpg', 'auctioneer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `pwd_reset`
--
ALTER TABLE `pwd_reset`
  ADD PRIMARY KEY (`pwd_reset_id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`bid_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pwd_reset`
--
ALTER TABLE `pwd_reset`
  MODIFY `pwd_reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `bid_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
