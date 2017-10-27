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
-- Struktura tabulky `opravneni`
--

CREATE TABLE `opravneni` (
  `id_uzivatele` int(11) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `opravneni`
--
ALTER TABLE `opravneni`
  ADD KEY `id_uzivatele` (`id_uzivatele`),
  ADD KEY `id_role` (`id_role`);

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `opravneni`
--
ALTER TABLE `opravneni`
  ADD CONSTRAINT `opravneni_ibfk_1` FOREIGN KEY (`id_uzivatele`) REFERENCES `uzivatel` (`id_uzivatele`),
  ADD CONSTRAINT `opravneni_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
