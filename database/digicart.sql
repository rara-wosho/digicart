-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 02:38 PM
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
-- Database: `digicart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `user_id`, `added_at`) VALUES
(22, 8, 4, '2025-04-12 18:20:52'),
(24, 9, 8, '2025-04-12 20:08:29'),
(26, 10, 8, '2025-04-12 20:08:40'),
(27, 6, 8, '2025-04-12 20:10:08'),
(28, 8, 8, '2025-04-12 21:22:32'),
(30, 6, 4, '2025-04-13 16:30:40');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `category` varchar(100) NOT NULL,
  `image_path` varchar(200) NOT NULL,
  `file_path` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `sold` int(11) NOT NULL,
  `ratings` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `category`, `image_path`, `file_path`, `created_at`, `sold`, `ratings`) VALUES
(8, 'Printable Activity Book', 'Printable activity book for kids - 24 pages with author signature', 399, 'For Kids', 'uploads/images/1744371564_downlodable.jpg', 'https://docs.google.com/document/d/19iHrJ83ieHpZeHmo-0sGg6dnGz6gcnMu/export?format=docx', '2025-04-11 00:00:00', 0, 0),
(9, 'The Shattered Vows', 'Shattered Vows is a thrilling romance with twists, deception, and heartbreak. Can Harper find the strength to rebuild, or is her marriage destined to remain as it was.', 599, 'E-books', 'uploads/images/1744372123_d81275a5d225a455ab1c2aed235a71b9.jpg', 'https://docs.google.com/document/d/19iHrJ83ieHpZeHmo-0sGg6dnGz6gcnMu/export?format=docx', '2025-04-11 00:00:00', 6, 0),
(10, 'Best Seller E-book You&#039;ve reached Sam', 'You&#039;ve Reached Sam is a story about a high school girl named Julie grappling with the recent death of her boyfriend Sam.                    ', 499, 'E-books', 'uploads/images/1744372202_68dfa730f63a55c51159b427ef48e5fc.jpg', 'https://docs.google.com/document/d/19iHrJ83ieHpZeHmo-0sGg6dnGz6gcnMu/export?format=docx', '2025-04-11 00:00:00', 5, 0),
(11, 'Basics of python  - course', 'A basic Python course introduces fundamental programming concepts using Python. It typically covers topics like variables, data types, operators, control structures (if, else, for, while), functions, ', 599, 'Courses', 'uploads/images/1744372616_49a21780150d43276bf085f31c627f9c.jpg', 'https://docs.google.com/document/d/19iHrJ83ieHpZeHmo-0sGg6dnGz6gcnMu/export?format=docx', '2025-04-11 00:00:00', 1, 0),
(12, 'Shadow Girl II', 'Mei is a sensible girl. She isn&#039;t superstitious; she doesn&#039;t believe in ghosts. Yet she can&#039;t shake her fear that there is danger lurking in the shadows.                    ', 799, 'E-books', 'uploads/images/1744373417_2b6d8bf536d247fe87df9fd48bb7e2a8.jpg', 'https://docs.google.com/document/d/19iHrJ83ieHpZeHmo-0sGg6dnGz6gcnMu/export?format=docx', '2025-04-11 20:10:17', 6, 0),
(13, 'Corporate record book template', 'premium downloadable corporate record book. customizable layouts and theme color.                                        ', 750, 'Templates', 'uploads/images/1744538728_corporate-book.jpg', 'https://docs.google.com/document/d/19iHrJ83ieHpZeHmo-0sGg6dnGz6gcnMu/export?format=docx', '2025-04-13 10:07:14', 0, 0),
(14, 'Digital Art and Renaissance Statues', 'This era is defined by rapid advancements in artificial intelligence, machine learning, cloud solutions, and &#039;intelligent things&#039; which collectively have the power to reshape industries, red', 500, 'Digital Art', 'uploads/images/1744539906_digi1.jpg', 'https://docs.google.com/document/d/19iHrJ83ieHpZeHmo-0sGg6dnGz6gcnMu/export?format=docx', '2025-04-13 18:25:06', 0, 0),
(15, 'Toddler coloring book  - premium', 'Toddler coloring book  is available now for a limited time. ', 350, 'For Kids', 'uploads/images/1744540081_toddler.jpg', 'https://docs.google.com/document/d/19iHrJ83ieHpZeHmo-0sGg6dnGz6gcnMu/export?format=docx', '2025-04-13 18:28:01', 0, 0),
(16, 'Introduction to designing - beginner course', 'A full guidance course to develop your designing skills. Become one of our top designer featured worldwide with our course.                    ', 1400, 'Courses', 'uploads/images/1744541168_dsigner.jpg', 'https://docs.google.com/document/d/19iHrJ83ieHpZeHmo-0sGg6dnGz6gcnMu/export?format=docx', '2025-04-13 18:46:08', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `fulladdress` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `payment_option` text NOT NULL,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `product_id`, `product_name`, `price`, `total`, `fullname`, `fulladdress`, `email`, `payment_option`, `transaction_date`) VALUES
(10, 4, 6, 'Minimalist webdesign template', 1000, 1000, 'Rick Sanchez', '5th Dimension, Central Infinite Reality, Unknown', 'sample@gmail.com', 'paypal', '2025-04-12 15:58:06'),
(19, 4, 12, 'Shadow Girl', 799, 799, 'Rick Sanchez', '5th Dimension, Central Infinite Reality, Unknown', 'sample@gmail.com', 'paypal', '2025-04-12 17:09:43'),
(20, 4, 12, 'Shadow Girl', 799, 799, 'Rick Sanchez', '5th Dimension, Central Infinite Reality, Unknown', 'sample@gmail.com', 'apple-pay', '2025-04-12 17:10:20'),
(21, 4, 6, 'Minimalist webdesign template', 1000, 1000, 'Rick Sanchez', '5th Dimension, Central Infinite Reality, Unknown', 'sample@gmail.com', 'paypal', '2025-04-12 17:17:04'),
(22, 4, 12, 'Shadow Girl', 799, 799, 'Rick Sanchez', '5th Dimension, Central Infinite Reality, 76th Planetary Zone', 'sample@gmail.com', 'paypal', '2025-04-12 19:06:29'),
(23, 4, 6, 'Minimalist webdesign template', 1000, 1000, 'Rick Sanchez', '5th Dimension, Central Infinite Reality, 76th Planetary Zone', 'sample@gmail.com', 'master-card', '2025-04-12 19:09:06'),
(24, 8, 12, 'Shadow Girl', 799, 799, 'Glenn Quagmire', '29 Spooner Street, Quahog, Rhode Island', 'quagmire@gmail.com', 'master-card', '2025-04-12 20:06:47'),
(25, 8, 13, 'Corporate record book template', 650, 650, 'Glenn Quagmire', '29 Spooner Street, Quahog, Rhode Island', 'quagmire@gmail.com', 'apple-pay', '2025-04-13 10:14:28'),
(26, 8, 11, 'Basics of python  - course', 599, 599, 'Glenn Quagmire', '29 Spooner Street, Quahog, Rhode Island', 'quagmire@gmail.com', 'paypal', '2025-04-13 20:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(200) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `role` text NOT NULL,
  `gender` varchar(100) NOT NULL,
  `barangay` varchar(200) NOT NULL,
  `municipality` varchar(200) NOT NULL,
  `province` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `isBan` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `role`, `gender`, `barangay`, `municipality`, `province`, `email`, `password`, `isBan`) VALUES
(4, 'Rick', 'Sanchez', 'user', 'male', '5th Dimension', 'Central Infinite Reality', '76th Planetary Zone', 'sample@gmail.com', '12345', 0),
(5, 'Mherafe', 'Cabug', 'admin', 'female', 'Sibaroc', 'Jimenez', 'Misamis Occidental', 'mherafe10@gmail.com', '1234', 0),
(8, 'Glenn', 'Quagmire', 'user', 'male', '29 Spooner Street', 'Quahog', 'Rhode Island', 'quagmire@gmail.com', 'giggity', 0),
(9, 'Brian', 'Griffin', 'user', 'male', '29 Spooner Street', 'Quahog', 'Rhode Island', 'brian@gmail.com', '1234', 1);

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
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

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
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
