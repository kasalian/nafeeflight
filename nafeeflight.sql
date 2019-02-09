-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2019 at 03:44 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nafeeflight`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `flying_from` varchar(255) NOT NULL,
  `flying_to` varchar(255) NOT NULL,
  `amount` int(100) NOT NULL,
  `paymentstatus` int(2) NOT NULL,
  `ticket` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `contact_firstname` varchar(255) NOT NULL,
  `contact_lastname` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `contact_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `firstname`, `lastname`, `address`, `email`, `gender`, `flying_from`, `flying_to`, `amount`, `paymentstatus`, `ticket`, `date`, `contact_firstname`, `contact_lastname`, `contact_number`, `contact_email`) VALUES
(1, 'John', 'Eniola', 'Uplift Hub Nigeria, Federal Polytechnic Bauchi, Bauchi State', 'eniola@uplift.ng', 'Male', 'Jos', 'Bauchi', 15000, 0, '535909', '2018-12-03', 'James', 'Eniola', '08063078990', 'eniolajam@gmail.com'),
(2, 'dd', 'dd', 'ds', 'omachokoannabel@gmail.com', 'Female', 'Lagos', 'lagos', 0, 0, '758821', '2018-11-10', '', '', '', ''),
(3, 'John', 'Eniola', 'Uplift Hub Nigeria, Federal Polytechnic Bauchi, Bauchi State', 'omachokoannabel@gmail.com', 'Female', 'Abuja', 'Gombe', 0, 0, '945544', '2018-11-10', '', '', '', ''),
(4, 'Semmwa', 'Wilson', 'RAILWAY QUARTERS BAUCHI', 'wilsonsemmwa@gmail.com', 'Female', 'Bauchi', 'Jos', 0, 0, '243342', '2018-12-17', 'Planang', 'Wilson', '3', 'semmwa@uplift.ng');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
