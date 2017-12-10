-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Ned 10. pro 2017, 17:19
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
-- Struktura tabulky `casopis_vydany`
--

CREATE TABLE `casopis_vydany` (
  `id_casopisu` int(11) NOT NULL,
  `rok` year(4) NOT NULL,
  `cislo` int(11) NOT NULL,
  `temata` varchar(256) COLLATE utf8_czech_ci DEFAULT NULL,
  `odkaz_k_souboru` varchar(256) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `casopis_vydany`
--

INSERT INTO `casopis_vydany` (`id_casopisu`, `rok`, `cislo`, `temata`, `odkaz_k_souboru`) VALUES
(1, 2010, 1, 'Úvodní číslo časopisu Logos Polytechnikos', 'casopisy/1_logos_polytechnikos.pdf'),
(2, 2010, 2, 'Regionální rozvoj, operační výzkum, finanční matematika a statistika', 'casopisy/2_logos_polytechnikos.pdf'),
(3, 2010, 3, NULL, 'casopisy/3_logos_polytechnikos.pdf'),
(4, 2010, 4, 'Technické obory', 'casopisy/4_logos_polytechnikos.pdf'),
(5, 2011, 1, 'Ošetřovatelská problematika', 'casopisy/5_logos_polytechnikos.pdf'),
(6, 2011, 2, NULL, 'casopisy/6_logos_polytechnikos.pdf'),
(7, 2011, 3, 'Matematika, ekonomika, regionální rozvoj, veřejná správa', 'casopisy/7_logos_polytechnikos.pdf'),
(8, 2011, 4, 'Technické obory, matematika a ekonomika', 'casopisy/8_logos_polytechnikos.pdf'),
(9, 2012, 1, 'Zdravotnické obory', 'casopisy/9_logos_polytechnikos.pdf'),
(10, 2012, 2, 'Cestovní ruch a veřejná správa', 'casopisy/10_logos_polytechnikos.pdf'),
(11, 2012, 3, 'Ekonomické obory, matematika a statistika', 'casopisy/11_logos_polytechnikos.pdf'),
(12, 2012, 4, NULL, 'casopisy/12_logos_polytechnikos.pdf'),
(13, 2013, 1, 'Ošetřovatelství', 'casopisy/13_logos_polytechnikos.pdf'),
(14, 2013, 2, 'Cestovní ruch, jazyky, regionální rozvoj a veřejná správa', 'casopisy/14_logos_polytechnikos.pdf'),
(15, 2013, 3, 'Ekonomika a matematika', 'casopisy/15_logos_polytechnikos.pdf'),
(16, 2013, 4, 'Elektrotechnika, informatika a matematika', 'casopisy/16_logos_polytechnikos.pdf'),
(17, 2014, 1, 'Ošetřovatelství a zdravotnictví', 'casopisy/17_logos_polytechnikos.pdf'),
(18, 2014, 2, 'Zdravotnictví a sociální práce', 'casopisy/18_logos_polytechnikos.pdf'),
(19, 2014, 3, 'Ekonomika, matematika, cestovní ruch a veřejná správa', 'casopisy/19_logos_polytechnikos.pdf'),
(20, 2014, 4, 'Elektrotechnika, informatika, matematika a cizí jazyky', 'casopisy/20_logos_polytechnikos.pdf'),
(21, 2015, 1, 'Ošetřovatelství a porodní asistence', 'casopisy/21_logos_polytechnikos.pdf'),
(22, 2015, 2, 'Biologické, psychologické a sociální fungování člověka', 'casopisy/22_logos_polytechnikos.pdf'),
(23, 2015, 3, 'Cestovní ruch,  regionální rozvoj, matematika a ekonomika', 'casopisy/23_logos_polytechnikos.pdf'),
(24, 2015, 4, 'Technika, matematika a cizí jazyky', 'casopisy/24_logos_polytechnikos.pdf'),
(25, 2016, 1, 'Ošetřovatelství a porodní asistence', 'casopisy/25_logos_polytechnikos.pdf'),
(26, 2016, 2, 'Sociální práce, zdravotnictví, sport a psychologie', 'casopisy/26_logos_polytechnikos.pdf'),
(27, 2016, 3, 'Ekonomika a matematika', 'casopisy/27_logos_polytechnikos.pdf'),
(28, 2016, 4, 'Informatika, matematika a jazykověda', 'casopisy/28_logos_polytechnikos.pdf'),
(29, 2017, 1, 'Ošetřovatelství', 'casopisy/29_logos_polytechnikos.pdf'),
(30, 2017, 2, 'Zdravotní a sociální práce', 'casopisy/30_logos_polytechnikos.pdf'),
(31, 2017, 3, 'Ekonomika, cestovní ruch a regionální rozvoj', 'casopisy/31_logos_polytechnikos.pdf');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `casopis_vydany`
--
ALTER TABLE `casopis_vydany`
  ADD PRIMARY KEY (`id_casopisu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
