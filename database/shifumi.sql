-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 09, 2023 at 11:36 AM
-- Server version: 10.6.5-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shifumi`
--

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `date_de_creation` date NOT NULL,
  `score_utilisateur` int(11) NOT NULL,
  `score_hal` int(11) NOT NULL,
  `nombre_de_tours` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `date_de_creation`, `score_utilisateur`, `score_hal`, `nombre_de_tours`) VALUES
(1, 'paul', '2023-01-09', 4, 6, 14),
(2, 'patrique', '2023-01-03', 4, 4, 9),
(3, 'jack', '2023-01-08', 3, 5, 10),
(4, 'lolo', '2022-12-15', 5, 2, 11);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
