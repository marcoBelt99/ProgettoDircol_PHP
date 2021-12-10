-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2021 alle 17:48
-- Versione del server: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dircol`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `capi`
--

DROP SCHEMA IF EXISTS `dircol`;
CREATE SCHEMA `dircol`;
USE `dircol`;

DROP TABLE IF EXISTS `capi`;
CREATE TABLE IF NOT EXISTS `capi` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `Taglia` text NOT NULL,
  `Colore` text NOT NULL,
  `PuntoVendita` varchar(5) NOT NULL,
  `CodModello` int(4) NOT NULL,
  PRIMARY KEY (`ID`),
  FOREIGN KEY (`CodModello`) REFERENCES modelli (`CodModello`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;
TRUNCATE TABLE `capi`;
--
-- Dump dei dati per la tabella `capi`
--

INSERT INTO `capi` (`Taglia`, `Colore`, `PuntoVendita`, `CodModello`) VALUES
('XXS', '#FF0000', '1', 1),
('S', '#000000', '6', 2),
('L', '#FFFF00', '1', 2),
('XL', '#008000', '1', 1),
('XS', '#0000FF', '5', 3),
('M', '#800000', '4', 3),
('L', '#8F00FF', '4', 4),
('L', '	#008000', '3', 2),
('XXL', '#FF0000', '1', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `dipendenti`
--

DROP TABLE IF EXISTS `dipendenti`;
CREATE TABLE IF NOT EXISTS `dipendenti` (
  `Matricola` bigint(6) NOT NULL,
  `Cognome` text NOT NULL,
  `Nome` text NOT NULL,
  `CodiceFiscale` varchar(16) NOT NULL,
  `Qualifica` text NOT NULL,
  `PuntoVendita` varchar(5) NOT NULL,
  PRIMARY KEY (`Matricola`),
  -- KEY `PuntoVendita` (`PuntoVendita`),
  FOREIGN KEY (`PuntoVendita`) REFERENCES puntivendita (`CodPV`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
TRUNCATE TABLE `dipendenti`;
--
-- Dump dei dati per la tabella `dipendenti`
--

INSERT INTO `dipendenti` (`Matricola`, `Cognome`, `Nome`, `CodiceFiscale`, `Qualifica`, `PuntoVendita`) VALUES
('148881', 'Beltrame', 'Marco', 'BLTMRC99M30A059W', 'Programmatore', '4'),
('148887', 'Rossi', 'Mario', 'RSSMRO120NX34I09', 'Content Manager', '4'),
('452314', 'Morin', 'Sara', 'MRNSRA99ARIA1QP1', 'Stilista', '1'),
('852159', 'Berton', 'Francesco', 'BRTFRC8812321KN6', 'Stilista', '2'),
('369541', 'Biondi', 'Diletta', 'BNDLTTA590WQZ7L2', 'Content Manager', '4');


-- --------------------------------------------------------

--
-- Struttura della tabella `modelli`
--

DROP TABLE IF EXISTS `modelli`;
CREATE TABLE IF NOT EXISTS `modelli` (
  `CodModello` int(4) NOT NULL AUTO_INCREMENT,
  `Immagine` VARCHAR(200) NOT NULL,
  `Nome` text NOT NULL,
  `Descrizione` text NOT NULL,
  `PrezzoListino` float NOT NULL,
  `Genere` text NOT NULL,
  `Collezione` varchar(20) NOT NULL,
  PRIMARY KEY (`CodModello`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
TRUNCATE TABLE `modelli`;
--
-- Dump dei dati per la tabella `modelli`
--

INSERT INTO `modelli` (`Immagine`,`Nome`, `Descrizione`, `PrezzoListino`, `Genere`, `Collezione`) VALUES
( 'gonna.jpg', 'Gonna 2.0', 'Gonna per ragazze di cotone', 23, 'F', 'Autunnale'),
( 'CappellinoGucci.jpg', 'CapoGuc', 'Cappellino Gucci per ragazzi verde ed oro', 45, 'F', 'Estiva'),
( 'MaglioneZaraGiallo.jpg',  'MaglioneG', 'Maglione Zara giallo', 35, 'M', 'Invernale'),
( 'PantaloniBlu.jpg',  'PantaBlu', 'Pantaloni blu Sorbino', 49.9, 'M', 'Primaverile'),
( 'FelpaDiPile.jpg',  'Felpa 1.5', 'Felpa di paille', 66, 'F', 'Autunnale');

-- --------------------------------------------------------

--
-- Struttura della tabella `puntivendita`
--

DROP TABLE IF EXISTS `puntivendita`;
CREATE TABLE IF NOT EXISTS `puntivendita` (
  `CodPV` int(4) NOT NULL AUTO_INCREMENT,
  `Indirizzo` varchar(50) NOT NULL,
  `Telefono` varchar(11) NOT NULL,
  `Citta` text NOT NULL,
  `DataInizio` date NOT NULL,
  `Nazione` text NOT NULL,
  PRIMARY KEY (`CodPV`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=9;
TRUNCATE TABLE `puntivendita`;
--
-- Dump dei dati per la tabella `puntivendita`
--

INSERT INTO `puntivendita` (`Indirizzo`, `Telefono`, `Citta`, `DataInizio`, `Nazione`) VALUES
('Via del Sole 11', 2147483647, 'Catania (CT)', '1986-03-12', 'Italia'),
('Moonlight Street 15', 3403185266, 'Edimburgo', '2001-04-10', 'Inghilterra'),
('Via Giuseppe Verdi 7', 7413698745, 'Bologna', '2006-05-05', 'Italia'),
('Viale dei Pini 9', 3571236475, 'Mestre', '2009-08-07', 'Italia'),
('Street Zero 899', 1020304050, 'Cambridge', '2020-03-23', 'Inghilterra'),
('Ruta del agua 133', 3332221144, 'Barcellona', '2018-01-31', 'Spagna'),
('Avenida Independencia 23', 159753456, 'Madrid', '1991-08-23', 'Spagna');

-- --------------------------------------------------------

--
-- Struttura della tabella `vendite`
--

DROP TABLE IF EXISTS `vendite`;
CREATE TABLE IF NOT EXISTS `vendite` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `DataVendita` date NOT NULL,
  `PrezzoVendita` float NOT NULL,
  `Matricola` bigint(6) NOT NULL,
  `IDCapo` int(4) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDCapo` (`IDCapo`),
  FOREIGN KEY (`Matricola`) REFERENCES dipendenti (`Matricola`),
  FOREIGN KEY (`IDCapo`) REFERENCES capi (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;
TRUNCATE TABLE `vendite`;
--
-- Dump dei dati per la tabella `vendite`
--

INSERT INTO `vendite` (`DataVendita`, `PrezzoVendita`, `Matricola`, `IDCapo`) VALUES
('2021-11-04', 444, '148881', 9),
('2021-08-11', 512, '369541', 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
