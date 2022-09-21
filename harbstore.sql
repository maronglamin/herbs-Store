-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2022 at 01:05 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `harbstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `herbs`
--

CREATE TABLE `herbs` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `remedy` varchar(100) NOT NULL,
  `price` varchar(10) NOT NULL,
  `descr` text NOT NULL,
  `photo_url` varchar(255) NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `herbs`
--

INSERT INTO `herbs` (`id`, `name`, `remedy`, `price`, `descr`, `photo_url`, `featured`, `deleted`) VALUES
(419, 'harb name', 'remedy', '58', 'write some description... Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium mollitia voluptatibus', 'photos/2022-09-18-herb.png', 1, 0),
(420, 'test', 'test', '54', 'test description', 'photos/2022-09-18-delete-js.PNG', 1, 0),
(421, 'test', 'test test', '87', 'test test ', 'photos/2022-09-18-delete.PNG', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `cart_id` int(11) NOT NULL,
  `herb_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT 0,
  `paid_at` timestamp NULL DEFAULT NULL,
  `email_at_buying` varchar(200) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`cart_id`, `herb_id`, `user_id`, `paid`, `paid_at`, `email_at_buying`, `date_added`) VALUES
(1, 419, 2, 1, '2022-09-21 00:51:10', 'marong@resgate.edu.gm', '2022-09-19 09:04:38'),
(4, 420, 2, 0, NULL, NULL, '2022-09-20 23:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_role` varchar(75) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `tele` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `address` varchar(15) DEFAULT NULL,
  `join_date` timestamp NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL,
  `change_password` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `permission` tinyint(4) NOT NULL DEFAULT 1,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `user_name`, `password`, `user_role`, `gender`, `tele`, `mobile`, `address`, `join_date`, `last_login`, `change_password`, `status`, `permission`, `deleted`) VALUES
(1, 'Modou lamin Marong', 'mlm@gmail.com', 'afang', '$2y$10$3KqFE10AfuHIpk.01iVTQ.wTxqyzMjgVartfKxEQiFUpp0a.lIeT2', '1', 'male', NULL, NULL, NULL, '2022-09-15 13:33:36', '2022-09-21 11:12:56', 1, 0, 1, 0),
(2, 'Ebrima Dahaba', 'mlm123@gmail.com', 'kang', '$2y$10$CfYrgV30yMvMoffNNo3P2OnTCj0Tov.NTsZwYeQvjQe7dm19AXf6q', '2', NULL, NULL, NULL, NULL, '2022-09-15 14:57:36', '2022-09-21 13:05:00', 0, 0, 1, 0),
(3, 'full name', 'username@email.com', 'username', '$2y$10$XITiHl/xbLeWubpfvzkiBudDkYctOyXENNYflcwFZOa/TumXyFY6W', '2', NULL, NULL, NULL, NULL, '2022-09-16 12:46:43', '2022-09-18 20:32:46', 0, 0, 1, 0),
(4, 'Modou Lamin Kassama', 'mlk@gmail.com', 'mlk45', '$2y$10$bC349wKwWKFdpzTtqv9sDOefzxztZjCdG/6ORfDSvjIbHnASJubvy', '1', NULL, NULL, NULL, NULL, '2022-09-21 09:14:05', '2022-09-21 11:15:55', 1, 0, 1, 0),
(5, 'test', 'test@test.com', 'test', '$2y$10$oluBWpYy0zTE8eFVgF0xcuYMRCsJrHzgaVei2/D1JF6.fBBGabllS', '1', NULL, NULL, NULL, NULL, '2022-09-21 10:52:00', '2022-09-21 13:01:02', 1, 0, 1, 0),
(6, 'another', 'another@test.com', 'another', '$2y$10$vWz1HpMEwIuKZDdKYt6CIuu.sAJgZijmQLam.9PIi5hwsEQg.xeRa', '1', NULL, NULL, NULL, NULL, '2022-09-21 10:54:55', NULL, 0, 0, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `herbs`
--
ALTER TABLE `herbs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `herbs`
--
ALTER TABLE `herbs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=422;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
