-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 21, 2021 at 11:15 PM
-- Server version: 10.3.25-MariaDB-0ubuntu0.20.04.1
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
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `pro_id`, `quantity`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 18, '2021-02-21 15:16:55', '0000-00-00 00:00:00'),
(3, 2, 3, 18, '2021-02-21 15:18:28', '0000-00-00 00:00:00'),
(4, 4, 1, 18, '2021-02-21 19:11:37', '0000-00-00 00:00:00'),
(5, 11, 1, 0, '2021-02-21 19:14:55', '0000-00-00 00:00:00'),
(6, 8, 1, 18, '2021-02-21 19:17:09', '0000-00-00 00:00:00'),
(7, 12, 1, 0, '2021-02-21 19:47:29', '0000-00-00 00:00:00'),
(8, 14, 1, 0, '2021-02-21 19:50:50', '0000-00-00 00:00:00'),
(9, 2, 1, 19, '2021-02-21 19:53:43', '0000-00-00 00:00:00'),
(10, 17, 1, 19, '2021-02-21 19:54:12', '0000-00-00 00:00:00'),
(11, 2, 1, 0, '2021-02-21 20:48:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(10) NOT NULL,
  `brand` varchar(10) NOT NULL,
  `category` varchar(10) NOT NULL,
  `colors` varchar(100) NOT NULL,
  `img` text NOT NULL,
  `pro_desc` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `name`, `price`, `quantity`, `brand`, `category`, `colors`, `img`, `pro_desc`, `created_at`, `updated_at`) VALUES
(1, 'Nitro 5', 900, 2, 'Acer', 'Laptop', '#000', 'acer-nitro-5-an515-55-7.jpg', 'abc', '2021-02-15 15:25:42', '2021-02-15 15:25:42'),
(2, 'ROC Strix g g731', 1000, 2, 'Asus', 'Laptop', '#000', 'asus-roc-strix-g-g731.jpg', 'abc', '2021-02-15 15:27:50', '2021-02-15 15:27:50'),
(3, 'Dell G5 Gaming', 1200, 3, 'Dell', 'Laptop', '#000', 'dell-g5-15-5590-gaming-laptop.jpg', 'abc', '2021-02-15 15:30:55', '2021-02-15 15:30:55'),
(4, 'HP 1033NE', 1000, 2, 'HP', 'Laptop', '#000', 'hp-15-db1033ne-laptop.jpg', 'abc', '2021-02-15 15:36:00', '2021-02-15 15:36:00'),
(5, 'Dell Inspiron 15', 1000, 2, 'Dell', 'Laptop', '#000', 'dell-inspiron-15-5000-15.jpg', 'abc', '2021-02-15 15:37:41', '2021-02-15 15:37:41'),
(6, 'Leglon 5 Gaming', 1000, 2, 'Lenovo', 'Laptop', '#000', 'lenovo-leglon-5-gaming.jpg', 'abc', '2021-02-15 15:40:19', '2021-02-15 15:40:19'),
(7, 'Samsung Galaxy', 152, 3, 'Samsung', 'Mobile', '#000', '1.png', 'abc', '2021-02-15 15:41:56', '2021-02-15 15:41:56'),
(8, 'Redmi 12', 220, 4, 'Redmi', 'Mobile', '#ccc', '2.png', 'abc', '2021-02-15 15:44:41', '2021-02-15 15:44:41'),
(9, 'Redmi 23', 250, 3, 'Redmi', 'Mobile', '#eee', '3.png', 'abc', '2021-02-15 15:46:06', '2021-02-15 15:46:06'),
(10, 'Samsung Galaxy S7', 400, 2, 'Samsung', 'Mobile', '#000', '12.png', 'abc', '2021-02-15 15:47:42', '2021-02-15 15:47:42'),
(11, 'Samsung Galaxy S6', 300, 3, 'Samsung', 'Mobile', '#fff', '11.png', 'abc', '2021-02-15 16:19:44', '2021-02-15 16:19:44'),
(12, 'Iphone 5', 420, 3, 'Apple', 'Mobile', '#000', '14.png', 'abc', '2021-02-15 16:19:44', '2021-02-15 16:19:44'),
(13, 'Iphone 6S', 550, 4, 'Apple', 'Mobile', '#eee', 'apple-iphone-6s.jpg', 'abc', '2021-02-15 16:21:39', '2021-02-15 16:21:39'),
(14, 'Iphone 5S', 500, 2, 'Apple', 'Mobile', '#fff', '15.png', 'abc', '2021-02-15 16:24:30', '2021-02-15 16:24:30'),
(15, ' Matepad', 500, 4, 'Huawei', 'Tablet', '#000', 'huawei-matepad-t10-tablet-9-7.jpg', 'abc', '2021-02-15 16:29:19', '2021-02-15 16:29:19'),
(16, 'Galaxy tab s6', 900, 5, 'Samsung ', 'Tablet', '', 'samsung-galaxy-tab-s6-lite.jpg', 'abc', '2021-02-15 16:29:19', '2021-02-15 16:29:19'),
(17, 'Ipad pro', 1500, 3, 'Apple', 'Tablet', '#eee', 'large-apple-10-5-ipad-pro-64-gb-space-grey-2017.jpg', 'abc\r\n', '2021-02-15 16:30:43', '2021-02-15 16:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT 0,
  `trust_status` int(11) NOT NULL DEFAULT 0,
  `reg_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `password`, `gender`, `full_name`, `group_id`, `trust_status`, `reg_status`, `created_at`, `updated_at`) VALUES
(4, 'Nidaa', 'nido@nido.com', '8cb2237d0679ca88db6464eac60da96345513964', 'female', 'Nidaa Hamid', 1, 0, 1, '2021-02-17 17:41:47', '2021-02-17 17:41:47'),
(8, 'mohamed', 'mohamad@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'male', 'Mohamed Hamouda', 0, 0, 0, '2021-02-20 12:08:46', '2021-02-20 12:08:46'),
(10, 'Esraa', 'esraa@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'female', 'Esraa Soso', 0, 0, 0, '2021-02-20 16:29:26', '2021-02-20 16:29:26'),
(14, 'Ehab', 'ehab@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'male', 'Ehab Hoba', 0, 0, 0, '2021-02-20 16:52:39', '2021-02-20 16:52:39'),
(17, 'Morad', 'morad@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'male', 'Morad Moro', 0, 0, 0, '2021-02-20 18:07:07', '2021-02-20 18:07:07'),
(18, 'Osama', 'osama@osos.com', '545d3535c62200c3b92cb803b808c17f73e1c535', 'male', 'Osama Osos', 0, 0, 0, '2021-02-21 15:08:35', '2021-02-21 15:08:35'),
(19, 'nidaa', 'nidaa@nido.com', '8cb2237d0679ca88db6464eac60da96345513964', 'female', 'nidaa sallam', 0, 0, 0, '2021-02-21 19:52:20', '2021-02-21 19:52:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
