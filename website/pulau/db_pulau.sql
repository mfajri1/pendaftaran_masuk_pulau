-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Agu 2021 pada 11.28
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pulau`
--
CREATE DATABASE IF NOT EXISTS `db_pulau` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_pulau`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mode`
--

DROP TABLE IF EXISTS `tb_mode`;
CREATE TABLE IF NOT EXISTS `tb_mode` (
  `mode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengunjung`
--

DROP TABLE IF EXISTS `tb_pengunjung`;
CREATE TABLE IF NOT EXISTS `tb_pengunjung` (
  `pengunjung_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengunjung_card` varchar(100) NOT NULL,
  `pengunjung_name` varchar(200) NOT NULL,
  `pengunjung_asal` text NOT NULL,
  `pengunjung_date` date DEFAULT NULL,
  `pengunjung_jml_hari` int(11) NOT NULL,
  `pengunjung_keluar` date DEFAULT NULL,
  `pengunjung_mode` enum('M','K','E') NOT NULL,
  `pengunjung_status` enum('A','N','B') NOT NULL,
  PRIMARY KEY (`pengunjung_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pengunjung`
--

INSERT INTO `tb_pengunjung` (`pengunjung_id`, `pengunjung_card`, `pengunjung_name`, `pengunjung_asal`, `pengunjung_date`, `pengunjung_jml_hari`, `pengunjung_keluar`, `pengunjung_mode`, `pengunjung_status`) VALUES
(7, '215139232216', 'fajar', 'pariaman', NULL, 0, NULL, 'E', 'B'),
(11, '14721017024', 'ilham', 'Padang', NULL, 0, NULL, 'M', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmprfid`
--

DROP TABLE IF EXISTS `tmprfid`;
CREATE TABLE IF NOT EXISTS `tmprfid` (
  `nokartu` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
