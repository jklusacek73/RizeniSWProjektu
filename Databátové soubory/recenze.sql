-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Pát 27. říj 2017, 13:36
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
-- Struktura tabulky `recenze`
--

CREATE TABLE `recenze` (
  `id_recenze` int(11) NOT NULL,
  `datum` date NOT NULL,
  `nazev_souboru` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `id_uzivatele` int(11) NOT NULL,
  `id_clanku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `recenze`
--
ALTER TABLE `recenze`
  ADD PRIMARY KEY (`id_recenze`),
  ADD UNIQUE KEY `id_recenze` (`id_recenze`),
  ADD KEY `id_uzivatele` (`id_uzivatele`),
  ADD KEY `id_clanku` (`id_clanku`);

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `recenze`
--
ALTER TABLE `recenze`
  ADD CONSTRAINT `recenze_ibfk_1` FOREIGN KEY (`id_uzivatele`) REFERENCES `uzivatel` (`id_uzivatele`),
  ADD CONSTRAINT `recenze_ibfk_2` FOREIGN KEY (`id_clanku`) REFERENCES `clanek` (`id_clanku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
