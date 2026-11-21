-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 11, 2026 at 12:07 AM
-- Server version: 8.0.44
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_magazine`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int UNSIGNED NOT NULL,
  `slug` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `headline` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `issue_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `slug`, `headline`, `issue_id`) VALUES
(1, 'dog', 'Dog found making den in tree', 1),
(2, 'cat', 'Cat wakes owner by baking pie', 1),
(3, 'donkey', 'Award-winning donkey known best for excellent singing', 2),
(4, 'shanties', 'Sea Shanties - top picks for your weekend', 2),
(5, 'grass', '\"Their grass was already cut!\" - gardener puzzled by neighbourhood lawn', 3),
(6, 'php-tips', 'Five PHP tips your doctor will hate you for - number 4 is insane!', 3),
(7, 'sql-secrets', 'Secrets of SQL - how to write a query that will leave you puzzled in two years', 4);

-- --------------------------------------------------------

--
-- Table structure for table `articles_people`
--

CREATE TABLE `articles_people` (
  `article_id` int UNSIGNED NOT NULL,
  `person_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles_people`
--

INSERT INTO `articles_people` (`article_id`, `person_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(3, 2),
(4, 1),
(5, 1),
(6, 1),
(6, 2),
(7, 1),
(7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date NOT NULL,
  `published` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `name`, `date`, `published`) VALUES
(1, 'September - 20299', '2026-09-01', 1),
(2, 'October - 2026', '2026-10-01', NULL),
(3, 'November - 2026', '2026-11-01', NULL),
(4, 'December - 2026  Wheeee', '2026-12-01', 0),
(5, 'HEllo, world', '2026-11-06', NULL),
(6, 'December 2027', '2027-12-20', 1),
(7, 'December 2027', '2027-12-20', 1),
(8, 'December 2027', '2027-12-20', 1),
(9, 'December 2027', '2027-12-20', 1),
(10, 'Hello, world!', '2027-04-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int UNSIGNED NOT NULL,
  `first_name` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `position` enum('writer','editor','photographer','staff') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `first_name`, `last_name`, `email`, `position`) VALUES
(1, 'Nick', 'Ireland', 'nireland@fanshawec.ca', 'writer'),
(2, 'Imaginary', 'Editor', 'nireland@fanshawec.ca', 'editor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug_unique` (`slug`),
  ADD KEY `articles_issue` (`issue_id`);

--
-- Indexes for table `articles_people`
--
ALTER TABLE `articles_people`
  ADD KEY `articles_people_article` (`article_id`),
  ADD KEY `articles_people_person` (`person_id`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_issue` FOREIGN KEY (`issue_id`) REFERENCES `issues` (`id`);

--
-- Constraints for table `articles_people`
--
ALTER TABLE `articles_people`
  ADD CONSTRAINT `articles_people_article` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `articles_people_person` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
