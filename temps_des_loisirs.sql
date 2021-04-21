-- SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 21, 2021 at 03:10 PM
-- Server version: 8.0.23-0ubuntu0.20.04.1
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
-- Database: `temps_des_loisirs`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `price` int NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `start_date`, `end_date`, `price`, `description`, `image`) VALUES
(1, 'Voyage Saint Maloo', '2021-06-17', NULL, 150, 'nous irons a st malo', 'https://picsum.photos/200'),
(2, 'Visite de la cathedrale', '2021-02-17', NULL, 20, 'nous visiterons la cathedrale d\' Orleans', 'https://picsum.photos/200'),
(3, 'Voyage Nice', '2021-07-16', '2020-08-17', 150, 'Nous irons à Nice.', 'https://picsum.photos/200'),
(4, 'Visit Parc de Potyl', '2021-09-15', NULL, 20, 'nous visiterons le parc de potyl', 'https://picsum.photos/200'),
(5, 'Loto et Karaoke', '2021-08-09', NULL, 20, 'Soirée avec loto et karaoke', 'https://picsum.photos/200'),
(6, 'Voyage à Mont-Saint-Michel', '2021-06-09', '2021-06-12', 800, 'Voyage à Mont-Saint-Michel.', 'https://picsum.photos/200'),
(7, 'Voyage au Brésil', '2021-04-22', '2021-04-30', 5500, 'Voyage à Rio de Janeiro.', 'https://picsum.photos/200'),
(8, 'Journée à Nantes', '2021-05-28', NULL, 300, 'On va passer la journée à Nantes.', 'https://picsum.photos/200'),
(9, 'Loto de prinstemps', '2021-05-19', NULL, 10, 'Loto d\'habitude pour les membres et famille.', 'https://picsum.photos/200');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
