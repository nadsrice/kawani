-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2017 at 04:33 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kawani_temp`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `active_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `company_id`, `name`, `description`, `created`, `created_by`, `active_status`) VALUES
(1, 0, 'admin', 'Administrator', '0000-00-00 00:00:00', 0, 1),
(2, 0, 'System Administrator', 'Systems Administrator', '2015-12-18 12:00:00', 1, 1),
(3, 0, 'Frontdesk', 'Front Desk Clerk', '2015-12-18 12:00:00', 1, 1),
(4, 0, 'Supervisor', 'Supervisor', '2015-12-18 12:00:00', 1, 1),
(5, 0, 'Finance Officer', 'Finance Officer', '2015-12-18 12:00:00', 1, 1),
(6, 0, 'Finance Manager', 'Finance Manager', '2015-12-18 12:00:00', 1, 1),
(7, 0, 'Manager', 'manager', '2015-12-18 12:00:00', 1, 1),
(8, 0, 'Guest', 'Guest', '2015-12-18 12:00:00', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
