-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2025 at 03:29 PM
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
-- Database: `car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `page_content`
--

CREATE TABLE `page_content` (
  `id` int(11) NOT NULL,
  `page_name` varchar(50) NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_content`
--

INSERT INTO `page_content` (`id`, `page_name`, `section_name`, `content`) VALUES
(1, 'home', 'headline', 'Looking for a car to rent?'),
(2, 'home', 'sub_text', 'Download now on App Store and Google Play.'),
(3, 'home', 'form_label_location', 'Location'),
(4, 'home', 'form_label_pickup', 'Pick-Up Date'),
(5, 'home', 'form_label_return', 'Return Date'),
(6, 'ride', 'heading', 'Rent With 3 Easy Steps'),
(7, 'ride', 'step_1', 'Choose a Location'),
(8, 'ride', 'step_2', 'Pick-Up Date'),
(9, 'ride', 'step_3', 'Book A Car'),
(10, 'services', 'main_heading', 'Explore Our Top Deals From Top Rated Dealers'),
(14, 'about', 'section_title', 'About Us'),
(15, 'about', 'main_heading', 'Best Customer Experience'),
(16, 'about', 'about_subheading', 'About Us'),
(17, 'about', 'paragraph_1', 'Welcome to our car rental website, your trusted partner for reliable and affordable car rentals. Whether it\'s a weekend getaway, a family vacation, or a business trip, we have the perfect vehicle for your journey.'),
(18, 'about', 'paragraph_2', 'Our mission is to make car rentals easy, accessible, and hassle-free. With a diverse fleet of well-maintained vehicles, competitive pricing, and flexible rental terms, we\'re here to ensure your travel plans go smoothly. From compact cars to spacious SUVs, we\'ve got you covered.'),
(19, 'about', 'paragraph_3', 'Your comfort and safety are our top priorities. Every vehicle is regularly inspected and sanitized to meet the highest standards. Plus, with our friendly customer support team available 24/7, help is always just a call away.'),
(20, 'about', 'paragraph_4', 'Thank you for choosing our website. Let\'s hit the road together! Whether it\'s a short trip or a grand adventure, we\'re here to make your travels unforgettable.'),
(21, 'reviews', 'main_heading', 'Trusted by Thousands of Customers'),
(22, 'reviews', 'review_1_name', 'Daniel'),
(23, 'reviews', 'review_1_rating', '4.5'),
(24, 'reviews', 'review_1_image', 'rev1.jpg'),
(25, 'reviews', 'review_1_content', 'The car options are fantastic, and the prices are super competitive. I appreciated the flexibility with pick-up and return dates. Will definitely use this service again!'),
(26, 'reviews', 'review_2_name', 'Andrea'),
(27, 'reviews', 'review_2_rating', '4.5'),
(28, 'reviews', 'review_2_image', 'rev2.jpg'),
(29, 'reviews', 'review_2_content', 'I loved how easy it was to book a car! The website is clean and intuitive, and I found everything I needed within minutes. Highly recommended!'),
(30, 'reviews', 'review_3_name', 'Liam'),
(31, 'reviews', 'review_3_rating', '5'),
(32, 'reviews', 'review_3_image', 'rev3.jpg'),
(33, 'reviews', 'review_3_content', 'The design of the website is sleek and modern. Navigating through locations, dates, and car types was a breeze. The attention to detail really stands out!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `page_content`
--
ALTER TABLE `page_content`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `page_content`
--
ALTER TABLE `page_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
