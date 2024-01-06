-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 08:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sage_grocery`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_order`
--

CREATE TABLE `item_order` (
  `order_id` int(11) NOT NULL,
  `user_id` varchar(150) NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `quantity` varchar(150) NOT NULL,
  `price` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_order`
--

INSERT INTO `item_order` (`order_id`, `user_id`, `item_name`, `quantity`, `price`) VALUES
(22, '2', 'apple,Grapes', '10,1', '$ 10.00,$ 20.00'),
(23, '2', 'Grapes,apple', '26,52', '$ 20.00,$ 10.00'),
(24, '2', 'apple,Grapes', '1,7', '$ 10.00,$ 20.00');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `uom` varchar(150) NOT NULL,
  `price` double(10,2) NOT NULL,
  `quantity` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`id`, `name`, `code`, `image`, `uom`, `price`, `quantity`) VALUES
(9, 'apple', 'APPLE', 'product-images/apple_158989157.jpg', 'kilo', 10.00, '500'),
(10, 'Grapes', 'GRAPES', 'product-images/grapes.jpg', 'kilo', 20.00, '500');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `zipcode` varchar(150) NOT NULL,
  `usertype` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `firstname`, `lastname`, `phone`, `address`, `city`, `zipcode`, `usertype`, `password`, `status`) VALUES
(1, 'admin', 'admin@admin.com', 'Admin', 'One', '12345678890', 'admin address one', 'admin city one', '8000', 'admin', 'admin123', ''),
(2, 'user_one', 'user_one@user.com', 'User', 'One', '12345678890', 'Address one', 'city one', '8000', 'user', 'user123', 'Active'),
(3, 'user_two', 'user_two@user.com', 'User', 'Two', '12345678890', 'address two', 'city two', '8000', 'user', 'user123', 'Active'),
(4, 'UserThree', 'userthree@user.com', 'User', 'Three', '12341234', 'address three', 'city three', '9000', 'user', 'user123', 'Active'),
(5, 'UserFour', 'user_four@user.com', 'User', 'Four', '1234567890', 'User Four', 'City Four', '8000', 'user', 'user123', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE `user_order` (
  `id` int(11) NOT NULL,
  `user_id` varchar(150) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `zip` varchar(150) NOT NULL,
  `totalquantity` varchar(150) NOT NULL,
  `totalprice` varchar(150) NOT NULL,
  `orderdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`id`, `user_id`, `firstname`, `lastname`, `email`, `address`, `phone`, `city`, `zip`, `totalquantity`, `totalprice`, `orderdate`, `status`) VALUES
(22, '2', 'User', 'One', 'user_one@user.com', 'Address one', '12345678890', 'city one', '8000', '11', '$ 120.00', '2023-12-03 23:47:55', 'pending'),
(23, '2', 'User', 'One', 'user_one@user.com', 'Address one', '12345678890', 'city one', '8000', '78', '$ 1,040.00', '2023-12-04 00:14:10', 'Pending'),
(24, '2', 'User', 'One', 'user_one@user.com', 'Address one', '12345678890', 'city one', '8000', '8', '$ 150.00', '2023-12-04 01:49:02', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_order`
--
ALTER TABLE `item_order`
  ADD UNIQUE KEY `id` (`order_id`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
