-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Ned 10. pro 2017, 15:20
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
-- Struktura tabulky `uzivatel`
--

CREATE TABLE `uzivatel` (
  `id_uzivatele` int(11) NOT NULL,
  `titul_pred` varchar(25) COLLATE utf8_czech_ci DEFAULT NULL,
  `jmeno` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `prijmeni` varchar(70) COLLATE utf8_czech_ci NOT NULL,
  `titul_za` varchar(25) COLLATE utf8_czech_ci DEFAULT NULL,
  `e_mail` varchar(110) COLLATE utf8_czech_ci NOT NULL,
  `heslo` varchar(250) COLLATE utf8_czech_ci NOT NULL,
  `instituce` varchar(110) COLLATE utf8_czech_ci NOT NULL,
  `instituce_blizsi_urceni` varchar(150) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD PRIMARY KEY (`id_uzivatele`),
  ADD UNIQUE KEY `id_uzivatele` (`id_uzivatele`),
  ADD UNIQUE KEY `e_mail` (`e_mail`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
