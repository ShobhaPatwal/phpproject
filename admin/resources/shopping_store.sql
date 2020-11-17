-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2020 at 05:18 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_store`
--
CREATE DATABASE IF NOT EXISTS `shopping_store` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `shopping_store`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Men'),
(2, 'Women'),
(3, 'Kids'),
(4, 'Electronics'),
(5, 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `color_id` int(11) NOT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`color_id`, `color`) VALUES
(1, 'Red'),
(2, 'Green'),
(3, 'Yellow'),
(4, 'Black'),
(5, 'White'),
(6, 'Pink'),
(7, 'Orange'),
(8, 'Brown'),
(9, 'Gray'),
(10, 'Blue'),
(11, 'Purple'),
(12, 'Cream');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` double(20,2) NOT NULL,
  `image` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `category_id`, `description`, `status`) VALUES
(1, 'Handbag', 200.00, 'handbag.jpg', 2, 'Short Description', 1),
(2, 'Floral Dress', 20.00, 'floral.jpg', 2, '<span style=\"color: rgb(85, 85, 85); text-transform: capitalize; background-color: rgb(243, 243, 243);\">Short Description</span>', 1),
(3, 'Television', 500.00, 'television.jpg', 4, 'Short Description', 1),
(4, 'White Top', 24.00, 'top.jpg', 2, 'White Top', 1),
(5, 'Sports Shoes', 500.00, 'sports-shoes.jpg', 5, 'Sport Shoes', 1),
(6, 'Shirt', 40.00, 'shirt.jpg', 1, 'Shirt', 1),
(7, 'Kid shirt', 35.00, 'kids-shirt.jpg', 3, 'KID SHIRT', 1),
(8, 'Purse', 500.00, 'purse.jpg', 2, 'Purse', 1),
(9, 'Mobile', 800.00, 'mobile.jpg', 4, 'Smartphone', 1),
(10, 'Lenevo laptop', 1000.00, 'lenevo.jpg', 4, 'Lenevo laptop', 1),
(11, 'Headphone', 300.00, 'headphone.jpg', 4, 'Black headphone', 1),
(12, 'Camera', 1000.00, 'camera.jpg', 4, 'Camera', 1),
(13, 'Black Dress', 25.00, 'black-dress.jpg', 2, 'Black dress', 1),
(14, 'Shoes', 400.00, 'shoes1.jpg', 1, 'Shoes', 1),
(15, 'Formal shoes', 400.00, 'shoes.jpg', 1, 'Formal Shoes', 1),
(16, 'White Floral Dress', 32.00, 'white-floral-dress.jpg', 2, 'White Floral Dress', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color` varchar(500) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `product_id`, `color`, `quantity`) VALUES
(1, 1, 'White,Pink', 20),
(2, 2, 'Red,Green,Black,White', 30),
(3, 3, 'Black', 20),
(4, 4, 'Black', 30),
(5, 5, 'Pink', 20),
(6, 6, 'Red,White', 40),
(7, 7, 'White', 30),
(8, 8, 'Cream', 20),
(9, 9, 'Gray', 30),
(10, 10, 'Black', 10),
(11, 11, 'Black', 20),
(12, 12, 'Black', 30),
(13, 13, 'Black', 30),
(14, 14, 'Brown', 50),
(15, 15, 'Gray', 40),
(16, 16, 'White', 30),
(17, 17, 'Red,White', 29);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'fashion'),
(2, 'ecommerce'),
(3, 'shop'),
(4, 'handbag'),
(5, 'laptop'),
(6, 'headphone');

-- --------------------------------------------------------

--
-- Table structure for table `tags_products`
--

CREATE TABLE `tags_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags_products`
--

INSERT INTO `tags_products` (`id`, `product_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 2, 1),
(4, 3, 2),
(5, 4, 1),
(6, 5, 1),
(7, 6, 1),
(8, 7, 1),
(9, 8, 1),
(10, 8, 4),
(11, 9, 2),
(12, 10, 5),
(13, 11, 6),
(14, 12, 1),
(15, 13, 1),
(16, 14, 1),
(17, 15, 1),
(18, 16, 1),
(19, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `dob` varchar(200) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `dob`, `address`) VALUES
(1, 'admin', 'admin123', 'admin@localhost.com', '22/01/1990', 'Lucknow');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags_products`
--
ALTER TABLE `tags_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tags_products`
--
ALTER TABLE `tags_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
