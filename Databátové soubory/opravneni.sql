-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 30. říj 2017, 10:59
-- Verze serveru: 10.1.21-MariaDB
-- Verze PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Vypisuji data pro tabulku `opravneni`
--

INSERT INTO `opravneni` (`id_uzivatele`, `id_role`) VALUES
(1, 1);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `opravneni`
--
ALTER TABLE `opravneni`
  ADD PRIMARY KEY (`id_uzivatele`,`id_role`),
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
