-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Pát 27. říj 2017, 13:37
-- Verze serveru: 5.7.20
-- Verze PHP: 7.1.11

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
-- Struktura tabulky `casopis`
--

CREATE TABLE `casopis` (
  `id_casopisu` int(10) NOT NULL,
  `rok` year(4) NOT NULL,
  `cislo` int(11) NOT NULL,
  `kapacita` int(11) NOT NULL,
  `uzaverka` date NOT NULL,
  `temata` varchar(150) COLLATE utf8_czech_ci NOT NULL,
  `odpovida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `casopis`
--
ALTER TABLE `casopis`
  ADD PRIMARY KEY (`id_casopisu`),
  ADD UNIQUE KEY `id_casopisu` (`id_casopisu`),
  ADD KEY `odpovida` (`odpovida`);

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `casopis`
--
ALTER TABLE `casopis`
  ADD CONSTRAINT `casopis_ibfk_1` FOREIGN KEY (`odpovida`) REFERENCES `uzivatel` (`id_uzivatele`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
