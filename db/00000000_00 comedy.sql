-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 jun 2021 om 10:59
-- Serverversie: 10.4.14-MariaDB
-- PHP-versie: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comedy`
--
CREATE DATABASE IF NOT EXISTS `comedy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `comedy`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `jokes`
--

DROP TABLE IF EXISTS `jokes`;
CREATE TABLE IF NOT EXISTS `jokes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setup` text COLLATE utf8_bin NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
