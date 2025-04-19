-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2025 at 03:19 AM
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
  `cart_quantity` int(11) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `user_id`, `cart_quantity`, `added_at`) VALUES
(40, 21, 8, 1, '2025-04-19 08:59:34');

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
  `stock` int(11) NOT NULL,
  `image_path` varchar(200) NOT NULL,
  `file_path` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `sold` int(11) NOT NULL,
  `ratings` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `category`, `stock`, `image_path`, `file_path`, `created_at`, `sold`, `ratings`) VALUES
(18, 'Macbook Laptop Air 15 inch', 'The M3 chip brings even greater capabilities to the superportable 15-inch MacBook Air. With up to 18 hours of battery life, you can take it anywhere and blaze through work and play.                   ', 89990, 'laptop', 47, 'uploads/images/1744977552_macbook.jpg', 'https://docs.google.com/document/d/19iHrJ83ieHpZeHmo-0sGg6dnGz6gcnMu/export?format=docx', '2025-04-18 19:59:12', 2, 0),
(19, 'Macbook Pro m4', 'The 14-inch MacBook Pro with M4 chip gives you spectacular performance in a powerhouse laptop. With up to 24 hours of battery life and a breathtaking Liquid Retina XDR display with up to 1600 nits p  ', 101990, 'laptop', 27, 'uploads/images/1744977720_air.jpg', 'https://docs.google.com/document/d/19iHrJ83ieHpZeHmo-0sGg6dnGz6gcnMu/export?format=docx', '2025-04-18 20:02:00', 3, 0),
(20, 'Asus ROG Phone 9 Pro', 'Qualcomm&reg; Snapdragon&reg; 8 Elite Mobile Platform 4.3GHz, 64-bit, Octa-core Processor\r\nGPU: Qualcomm&reg; Adreno&trade; 830                    ', 62995, 'smartphone', 40, 'uploads/images/1744978130_asus rog 9.jpg', 'https://docs.google.com/document/d/19iHrJ83ieHpZeHmo-0sGg6dnGz6gcnMu/export?format=docx', '2025-04-18 20:08:50', 0, 0),
(21, 'JBL Go speaker', 'JBL Go 3 features bold styling and rich JBL Pro Sound. With its new eye-catching edgy design, colorful fabrics and expressive details this a must-have accessory for your next outing. Your tunes will l', 1799, 'speaker', 50, 'uploads/images/1745023713_jblspeaker.jpg', 'https://docs.google.com/document/d/19iHrJ83ieHpZeHmo-0sGg6dnGz6gcnMu/export?format=docx', '2025-04-19 08:48:33', 0, 0);

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
  `quantity` int(11) NOT NULL,
  `status` text NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `fulladdress` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `payment_option` text NOT NULL,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `product_id`, `product_name`, `price`, `total`, `quantity`, `status`, `fullname`, `fulladdress`, `email`, `payment_option`, `transaction_date`) VALUES
(34, 8, 18, 'Macbook Laptop Air 15 inch', 89990, 180030, 2, 'received', 'Glenn Quagmire', '29 Spooner Street, Quahog, Rhode Island', 'quagmire@gmail.com', 'master-card', '2025-04-19 08:59:54'),
(35, 8, 19, 'Macbook Pro m4', 101990, 306020, 3, 'shipped', 'Glenn Quagmire', '29 Spooner Street, Quahog, Rhode Island', 'quagmire@gmail.com', 'master-card', '2025-04-19 09:01:22');

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
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
