-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 30. říj 2017, 10:58
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
-- Struktura tabulky `uzivatel`
--

CREATE TABLE `uzivatel` (
  `id_uzivatele` int(11) NOT NULL,
  `titul_pred` varchar(25) COLLATE utf8_czech_ci DEFAULT NULL,
  `jmeno` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `prijmeni` varchar(70) COLLATE utf8_czech_ci NOT NULL,
  `titul_za` varchar(25) COLLATE utf8_czech_ci DEFAULT NULL,
  `e-mail` varchar(110) COLLATE utf8_czech_ci NOT NULL,
  `heslo` varchar(250) COLLATE utf8_czech_ci NOT NULL,
  `instituce` varchar(110) COLLATE utf8_czech_ci NOT NULL,
  `instituce_blizsi_urceni` varchar(150) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `uzivatel`
--

INSERT INTO `uzivatel` (`id_uzivatele`, `titul_pred`, `jmeno`, `prijmeni`, `titul_za`, `e-mail`, `heslo`, `instituce`, `instituce_blizsi_urceni`) VALUES
(1, '', 'Jiří', 'Klusáček', '', 'jirik.73@seznam.cz', '58a04acccf9ac1612c40d0050f323dfeff4e3c80a6e66e2df2f19b634192ada3b8a7348d978999071cc327a5e16c61ce8854bdd7b80f2d4f9364f81260038f35', 'Vysoká škola polytechnická Jihlava', '');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD PRIMARY KEY (`id_uzivatele`),
  ADD UNIQUE KEY `id_uzivatele` (`id_uzivatele`),
  ADD UNIQUE KEY `e-mail` (`e-mail`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
