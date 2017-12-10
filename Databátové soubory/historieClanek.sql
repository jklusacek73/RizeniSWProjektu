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
-- Struktura tabulky `historieClanek`
--

CREATE TABLE `historieClanek` (
  `id` int(11) NOT NULL,
  `id_clanku` int(11) NOT NULL,
  `id_stavu` int(11) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci ROW_FORMAT=COMPACT;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `historieClanek`
--
ALTER TABLE `historieClanek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_clanku` (`id_clanku`),
  ADD KEY `id_stavu` (`id_stavu`);

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `historieClanek`
--
ALTER TABLE `historieClanek`
  ADD CONSTRAINT `historieClanek_ibfk_1` FOREIGN KEY (`id_clanku`) REFERENCES `clanek` (`id_clanku`),
  ADD CONSTRAINT `historieClanek_ibfk_2` FOREIGN KEY (`id_stavu`) REFERENCES `stavy` (`id_stavu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
