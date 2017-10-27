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
-- Struktura tabulky `clanek`
--

CREATE TABLE `clanek` (
  `id_clanku` int(11) NOT NULL,
  `nazev_clanku` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `nazev_souboru` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `datum_vlozeni` date NOT NULL,
  `stav` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `datum_recenzniho_rizeni` date DEFAULT NULL,
  `nazev_aktualizovaneho_souboru` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL,
  `datum_aktualizace` date DEFAULT NULL,
  `odpovedny_uzivatel` int(11) NOT NULL,
  `casopis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `clanek`
--
ALTER TABLE `clanek`
  ADD PRIMARY KEY (`id_clanku`),
  ADD KEY `casopis` (`casopis`),
  ADD KEY `odpovedny_uzivatel` (`odpovedny_uzivatel`);

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `clanek`
--
ALTER TABLE `clanek`
  ADD CONSTRAINT `clanek_ibfk_2` FOREIGN KEY (`casopis`) REFERENCES `casopis` (`id_casopisu`),
  ADD CONSTRAINT `clanek_ibfk_3` FOREIGN KEY (`odpovedny_uzivatel`) REFERENCES `uzivatel` (`id_uzivatele`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
