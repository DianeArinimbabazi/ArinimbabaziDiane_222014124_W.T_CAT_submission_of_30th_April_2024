-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 11:08 AM
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
-- Database: `pharmacy_mgt_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `medecineId` int(11) NOT NULL,
  `quantiyAvaliable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `medecineId`, `quantiyAvaliable`) VALUES
(1, 2, 23),
(2, 1, 234),
(3, 3, 24),
(4, 1, 56),
(5, 1, 45),
(6, 3, 87);

-- --------------------------------------------------------

--
-- Table structure for table `medecine`
--

CREATE TABLE `medecine` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `manfactrure` varchar(100) NOT NULL,
  `dosage` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medecine`
--

INSERT INTO `medecine` (`id`, `name`, `manfactrure`, `dosage`, `price`, `quantity`) VALUES
(1, 'Ibuprofen', 'Cooper Pharma Rwanda Ltd', 12, 100, 12),
(2, 'Acetaminophen', 'Kigali Pharma Ltd', 12, 12000, 77),
(3, 'Aspirin', 'Aurobindo Pharma Rwanda Ltd', 34, 200, 12),
(4, 'Omeprazole', 'Medisel (Rwanda) Ltd', 65, 70000, 32),
(5, 'Amoxicillin', 'Pharmanova Ltd', 76, 56000, 12),
(6, 'Metformin', 'Odypharm Limited', 6, 12000, 12),
(7, 'Atorvastatin', 'Rango Rwanda', 2, 20000, 23),
(8, 'Lisinopril', 'Vabis International Ltd', 2, 3000, 15),
(9, 'Levothyroxine', 'Africure Pharmaceuticals Rwanda Ltd', 5, 90000, 5),
(10, 'Prednisone', 'Laprophan Rwanda Pharma', 5, 4000, 12);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `names` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `insurance` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `names`, `address`, `contact`, `insurance`) VALUES
(1, 'Irakiza', 'Kigali rwanda', '0788965501', 'Radiant'),
(2, 'Danox', 'Kabuga', '0787666117', 'Rama'),
(3, 'Nelly', 'Muhanga', '0789527457', 'Rssb'),
(4, 'Daine Arinimbabazi', 'kigali', '0722657783', 'Rama'),
(5, 'Clement', 'kibungo', '0789345266', 'CORAR-AG'),
(6, 'Koko', 'Nyamirambo', '0784353728', 'Prime Insurance'),
(7, 'Dodai', 'Rulindo', '0734567857', 'Radiant'),
(8, 'Ange', 'Kimihurura', '0798534572', 'saham');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `medecine` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amaount` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `medecine`, `quantity`, `amaount`, `Date`) VALUES
(1, 1, 6, 72, '2024-02-02 20:36:44'),
(2, 1, 10, 1000, '2024-02-06 22:36:00'),
(6, 1, 3, 345, '2024-04-29 11:10:47'),
(7, 3, 2, 199, '2024-04-29 12:00:08'),
(8, 3, 2, 87, '2024-04-29 12:00:25'),
(9, 3, 98, 3400, '2024-04-29 12:00:42'),
(10, 2, 23, 12000, '2024-04-29 12:01:13'),
(11, 2, 23, 454, '2024-04-29 12:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `supprier`
--

CREATE TABLE `supprier` (
  `id` int(11) NOT NULL,
  `names` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `supplied` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supprier`
--

INSERT INTO `supprier` (`id`, `names`, `contact`, `supplied`) VALUES
(1, 'Louise', '0798543324', 12),
(2, 'lapaix ', '0789654328', 127),
(3, 'Mavie', '0786161265', 123),
(4, 'Lapaix', '0789643267', 76),
(5, 'Eliab', '0723546477', 43),
(6, 'Justin', '0798653246', 10),
(7, 'Nepo', '0789765334', 77),
(8, 'Danox', '0787666117', 12),
(9, 'Mama', '0786161265', 45),
(10, 'Lamar', '0780552525', 23);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'Semugisha', 'Lamar', 'lamardanox', 'Lamar@gmail.com', '0780552525', '$2y$10$3DKTP360BTbq5mZh5dIypuIFPlnfRtz/BELsMQYg1/GhLji.CaGJS', '2024-04-29 10:35:46', '117', 0),
(2, 'Arinimbabazi', 'Diane', 'ArinimbabaziDiane', 'Diane@gmail.com', '0782484514', '$2y$10$lgI2O7abZnK2Xgm2XwhJl.yBr5ISJBZoO3FHiowbXMJHNjo0JPjZm', '2024-04-30 06:19:31', '84514', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medecineId` (`medecineId`);

--
-- Indexes for table `medecine`
--
ALTER TABLE `medecine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medecine` (`medecine`);

--
-- Indexes for table `supprier`
--
ALTER TABLE `supprier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medecine`
--
ALTER TABLE `medecine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `supprier`
--
ALTER TABLE `supprier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`medecineId`) REFERENCES `medecine` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`medecine`) REFERENCES `medecine` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
