-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2025 at 10:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `monthly_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `image`, `year`, `name`, `price`, `monthly_price`) VALUES
(1, 'images/car2.jpg', 2017, 'Porsche 918 Spyder', 58500.00, 358.00),
(2, 'images/Tesla model s.jpg\r\n\r\n', 2018, 'Tesla Model S', 70000.00, 400.00),
(3, 'images/Lamborghini-huracan.jpg', 2019, 'Lamborghini Huracan', 210000.00, 1200.00),
(4, 'images/2020-Ferrari-F8-Tributo.jpg', 2020, 'Ferrari F8 Tributo', 280000.00, 1400.00),
(5, 'images/2022-McLaren-720S.jpg', 2022, 'McLaren 720S', 300000.00, 1600.00),
(6, 'images/Astro-Martini.jpg', 2016, 'Aston Martin DB11', 200000.00, 1100.00),
(7, 'images/chiron-2021.jpg', 2021, 'Bugatti Chiron', 3000000.00, 15000.00),
(8, 'images/2024-porsche-911-gt3.jpg', 2024, 'Porsche GT3 911', 120000.00, 900.00),
(9, 'images/2020-rolls-royce-phantom.jpg', 2020, 'Rolls-Royce Phantom', 450000.00, 2500.00),
(10, 'images/Bentley-Continental-GT.jpg', 2019, 'Bentley Continental GT', 250000.00, 1400.00),
(11, 'images/Chevrolet-Corvette-Z06.jpg', 2017, 'Chevrolet Corvette Z06', 90000.00, 650.00),
(12, 'images/Ford-Mustang-Shelby-GT500.jpg', 2019, 'Ford Mustang Shelby GT500', 75000.00, 500.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
