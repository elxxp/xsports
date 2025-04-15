-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 15, 2025 at 04:18 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xsports`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int NOT NULL,
  `id_user` int NOT NULL,
  `name` varchar(225) NOT NULL,
  `telephone` varchar(18) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sport` enum('sepakbola','futsal','basket','tennis','badminton','gold') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_venue` int NOT NULL,
  `tanggal_sewa` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `payment` enum('bca','bni','mandiri','bri') NOT NULL,
  `bukti` longblob,
  `biaya` int NOT NULL,
  `status` enum('pending','active','complete','cancel') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pending',
  `waktu_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(75) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(16) NOT NULL,
  `level` enum('admin','manager','staff','guest') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `name`, `email`, `telephone`, `level`) VALUES
(1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'Super admin', 'admin@gmail.com', '0895630616207', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id_venue` int NOT NULL,
  `thumbnail` longblob,
  `venue` varchar(225) NOT NULL,
  `description` text NOT NULL,
  `tarif` int NOT NULL,
  `sport` enum('sepakbola','futsal','voli','tennis','badminton','golf') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` enum('open','closed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id_venue`, `thumbnail`, `venue`, `description`, `tarif`, `sport`, `status`) VALUES
(1, NULL, 'Garuda perkasa', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 750000, 'sepakbola', 'open'),
(2, NULL, 'Kenarok', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 175000, 'tennis', 'open'),
(3, NULL, 'Hartono tennis club', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 150000, 'tennis', 'closed'),
(4, NULL, 'Garuda Arena', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 1250000, 'sepakbola', 'open'),
(5, NULL, 'Stadion nusantara', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 2000000, 'sepakbola', 'open'),
(6, NULL, 'Bola victory field', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 1750000, 'sepakbola', 'open'),
(7, NULL, 'Futsal galaxy', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 100000, 'futsal', 'closed'),
(8, NULL, 'Tendangan arena', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 75000, 'futsal', 'open'),
(9, NULL, 'Shuttle master', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 60000, 'badminton', 'open'),
(10, NULL, 'Grand first', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 125000, 'tennis', 'open'),
(11, NULL, 'Volley big club', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 100000, 'voli', 'open'),
(12, NULL, 'Lapangan smash net', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 75000, 'voli', 'open'),
(13, NULL, 'Voli arena spike', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 215000, 'voli', 'open'),
(14, NULL, 'Thunder court voli', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 130000, 'voli', 'open'),
(15, NULL, 'Green valley golf course', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 180000, 'golf', 'open'),
(16, NULL, 'Fairway royale', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 245000, 'golf', 'open'),
(17, NULL, 'Golf-ian field', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 150000, 'golf', 'open'),
(18, NULL, 'Elitara golf', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 265000, 'golf', 'open'),
(19, NULL, 'Raket hall satria', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 100000, 'badminton', 'open'),
(20, NULL, 'Futsal urban pro', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 250000, 'futsal', 'open'),
(21, NULL, 'Zona kickoff', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 160000, 'futsal', 'open'),
(22, NULL, 'Arena mini gol', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 120000, 'futsal', 'open'),
(23, NULL, 'Planet soccer', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 1325000, 'sepakbola', 'open'),
(24, NULL, 'Grand slam tennis', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 175000, 'tennis', 'open'),
(25, NULL, 'Tennis royale', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 100000, 'tennis', 'open'),
(26, NULL, 'Arena 88', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 50000, 'badminton', 'open'),
(27, NULL, 'GOR raket jaya', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quisquam et aliquam ducimus accusamus voluptates?', 145000, 'tennis', 'open');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`,`id_venue`),
  ADD KEY `id_venue` (`id_venue`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id_venue`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id_venue` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_venue`) REFERENCES `venues` (`id_venue`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
