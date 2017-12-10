-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Ned 10. pro 2017, 15:23
-- Verze serveru: 5.7.20
-- Verze PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `klusacek`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `autori`
--

CREATE TABLE `autori` (
  `id_autora` int(11) NOT NULL,
  `titul_pred` varchar(25) COLLATE utf8_czech_ci DEFAULT NULL,
  `jmeno` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `prijmeni` varchar(70) COLLATE utf8_czech_ci NOT NULL,
  `titul_za` varchar(25) COLLATE utf8_czech_ci DEFAULT NULL,
  `instituce` varchar(110) COLLATE utf8_czech_ci NOT NULL,
  `instituce_blizsi_urceni` varchar(150) COLLATE utf8_czech_ci DEFAULT NULL,
  `id_clanku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `autori`
--
ALTER TABLE `autori`
  ADD PRIMARY KEY (`id_autora`),
  ADD KEY `id_clanku` (`id_clanku`);

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `autori`
--
ALTER TABLE `autori`
  ADD CONSTRAINT `autori_ibfk_1` FOREIGN KEY (`id_clanku`) REFERENCES `clanek` (`id_clanku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
