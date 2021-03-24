-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2021 at 01:31 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test-work-store`
--
CREATE DATABASE IF NOT EXISTS `test-work-store` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `test-work-store`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `name`, `state`, `created_at`) VALUES
(1, 'Piel', 1, '2021-03-23 21:36:43'),
(2, 'Ojos', 1, '2021-03-23 21:36:43'),
(3, 'Cuidado para la piel', 1, '2021-03-23 21:36:43'),
(4, 'Accesorios', 1, '2021-03-23 21:36:43'),
(5, 'Promociones', 1, '2021-03-23 21:36:43'),
(6, 'Labios', 1, '2021-03-23 21:36:43'),
(7, 'Cejas', 1, '2021-03-23 21:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `reference` varchar(100) DEFAULT '0',
  `price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `category_id` int(11) NOT NULL,
  `amount` int(100) DEFAULT 0,
  `state` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `name`, `reference`, `price`, `category_id`, `amount`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Polvo ASEPXIA', '1234123412341234', '1232.00', 1, 3, 1, '2021-03-23 22:31:54', '2021-03-24 00:16:02'),
(2, 'Pestanina', '123', '123.00', 2, 1, 1, '2021-03-24 00:26:46', '2021-03-24 00:29:21'),
(3, 'Crema de manos', '123', '123.00', 2, 123, 1, '2021-03-24 00:27:24', '2021-03-24 00:29:31'),
(4, 'Crema', '12', '12.00', 2, 2, 1, '2021-03-24 00:27:53', '2021-03-24 00:29:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
