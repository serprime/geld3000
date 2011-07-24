-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 15. Mai 2011 um 20:14
-- Server Version: 5.1.41
-- PHP-Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `finance`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `money`
--

CREATE TABLE IF NOT EXISTS `money` (
  `money_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` text NOT NULL,
  PRIMARY KEY (`money_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

ALTER TABLE  `money` 
  ADD  `both` BOOLEAN NOT NULL AFTER  `user_id` ,

--
-- Daten für Tabelle `money`
--

INSERT INTO `money` (`money_id`, `user_id`, `both`, `value`, `date`, `comment`) VALUES
(1, 1, true, '45.00', '2011-04-15 16:11:07', 'Rails 3 is a massive shake-up to the Rails community because it includes the surprise merger of the'),
(2, 2, true, '45.30', '2011-03-15 16:11:41', 'powerful Merb framework. This means a lot of people will be interested in kno'),
(3, 1, true, '45.40', '2011-05-15 16:25:01', 'ing what’s new in Rails if they’ve used it before, and getting started with it from scratch if they haven’t.'),
(4, 1, true, '45.70', '2011-05-15 16:25:16', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`user_id`, `name`) VALUES
(1, 'vielieb'),
(2, 'sarah');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
