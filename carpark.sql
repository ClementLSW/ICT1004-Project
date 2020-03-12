-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 12, 2020 at 02:22 PM
-- Server version: 10.4.11-MariaDB
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
-- Database: `carpark`
--

-- --------------------------------------------------------

--
-- Table structure for table `AREA`
--

CREATE TABLE `AREA` (
  `area_id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `occupancy` varchar(45) NOT NULL,
  `location_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `AREA`
--

INSERT INTO `AREA` (`area_id`, `type`, `occupancy`, `location_id`, `name`) VALUES
(1, 'hall', '0', 1, 'Hall 1'),
(2, 'hall', '0', 1, 'Hall 2'),
(3, 'hall', '0', 1, 'Hall 3'),
(4, 'hall', '0', 1, 'Hall 4'),
(5, 'hall', '0', 1, 'Hall 5'),
(6, 'hall', '0', 1, 'Hall 6'),
(7, 'hall', '0', 1, 'Hall 7'),
(8, 'hall', '0', 1, 'Hall 8'),
(9, 'hall', '0', 1, 'Hall 9'),
(10, 'hall', '0', 1, 'Hall 10');

-- --------------------------------------------------------

--
-- Table structure for table `connection`
--

CREATE TABLE `connection` (
  `id` varchar(5) NOT NULL,
  `weight` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `start_node` varchar(45) NOT NULL,
  `end_node` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`) VALUES
(1, 'Expo Convention Center'),
(2, 'Suntec City');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(45) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `contact` int(8) DEFAULT NULL,
  `permissions` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `fname`, `lname`, `password`, `email`, `contact`, `permissions`) VALUES
('andysmith', 'andy', 'smith', 'anddy', 'andysmith@email.com', 12345678, 'user'),
('bobross', 'bob', 'ross', 'bobby', 'bobross@email.com', 12345678, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AREA`
--
ALTER TABLE `AREA`
  ADD PRIMARY KEY (`area_id`),
  ADD UNIQUE KEY `area_id_UNIQUE` (`area_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `connection`
--
ALTER TABLE `connection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AREA`
--
ALTER TABLE `AREA`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `AREA`
--
ALTER TABLE `AREA`
  ADD CONSTRAINT `area_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
