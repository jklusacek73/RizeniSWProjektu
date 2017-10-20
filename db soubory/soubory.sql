-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Pát 20. říj 2017, 11:39
-- Verze MySQL: 5.7.20
-- Verze PHP: 5.6.31

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `novak51`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `soubory`
--

CREATE TABLE IF NOT EXISTS `soubory` (
  `id_soubor` int(11) NOT NULL AUTO_INCREMENT,
  `id_uzivatel` int(11) NOT NULL,
  `soubor` varchar(2083) NOT NULL,
  PRIMARY KEY (`id_soubor`),
  KEY `id_uzivatel` (`id_uzivatel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `soubory`
--
ALTER TABLE `soubory`
  ADD CONSTRAINT `soubory_ibfk_1` FOREIGN KEY (`id_uzivatel`) REFERENCES `uzivatel` (`id_uzivatel`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
