-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Pát 20. říj 2017, 11:43
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
-- Struktura tabulky `uzivatel`
--

CREATE TABLE IF NOT EXISTS `uzivatel` (
  `id_uzivatel` int(11) NOT NULL AUTO_INCREMENT,
  `jmeno` varchar(255) NOT NULL,
  `prijmeni` varchar(255) NOT NULL,
  `email` varchar(320) NOT NULL,
  `prava` varchar(50) NOT NULL,
  PRIMARY KEY (`id_uzivatel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Vypisuji data pro tabulku `uzivatel`
--

INSERT INTO `uzivatel` (`id_uzivatel`, `jmeno`, `prijmeni`, `email`, `prava`) VALUES
(1, 'pepa', 'novak', 'pnovak@vspj.cz', 'uzivatel'),
(2, 'Honza', 'novak', 'hnovak@vspj.cz', 'uzivatel'),
(3, 'Mirek', 'Vesely', 'mvesely@vspj.cz', 'uzivatel');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
