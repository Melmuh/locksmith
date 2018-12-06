-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 06. Dez 2018 um 16:03
-- Server-Version: 5.6.34-log
-- PHP-Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `locksmith`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `locks`
--

CREATE TABLE `locks` (
  `lock` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `s_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `locks`
--

INSERT INTO `locks` (`lock`, `s_id`) VALUES
('AAAABBBBCCCCDDDD', 1),
('BBBBCCCCDDDDEEEE', 1),
('CCCCDDDDEEEEFFFF', 2),
('DDDDEEEEFFFFGGGG', 3),
('EEEEFFFFGGGGHHHH', 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nutzer`
--

CREATE TABLE `nutzer` (
  `n_id` int(10) NOT NULL,
  `n_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `n_vorname` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `n_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `n_pass` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `n_zahlung` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `nutzer`
--

INSERT INTO `nutzer` (`n_id`, `n_name`, `n_vorname`, `n_email`, `n_pass`, `n_zahlung`) VALUES
(1, 'Meyer', 'Erik', 'meyer@mail.de', 'hashwert', 1),
(2, 'Kahnwald', 'Jonas', 'kahnwald@mail.de', 'hashwert', 2),
(3, 'Valtinke', 'Melina', 'valtinke@mail.de', 'hashwert', 2),
(4, 'Sauer', 'Philipp', 'sauer@mail.de', 'hashwert', 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `spiele`
--

CREATE TABLE `spiele` (
  `s_id` int(10) NOT NULL,
  `s_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `s_hersteller` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `s_preis` float(8,2) NOT NULL DEFAULT '0.00',
  `s_text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `spiele`
--

INSERT INTO `spiele` (`s_id`, `s_name`, `s_hersteller`, `s_preis`, `s_text`) VALUES
(1, 'Call of Duty - Black Ops 3', 'Treyarch', 39.99, 'Call of Duty: Black Ops III spielt in einer dystopischen Zukunft im Jahre 2065, 40 Jahre nach den Ereignissen von Black Ops II. Wissenschaft und Technologie haben sich stark verändert. Dies löst weltweit heftige Proteste aus und man versucht weitere Fortschritte zu stoppen. Die Militärtechnologie hat den Punkt erreicht, wo Robotik eine wichtige Rolle im Kampf spielt und „Supersoldaten“ entwickelt wurden, um auf dem Schlachtfeld zu kämpfen. Infolgedessen gibt es Spekulationen und Angst über eine mögliche Übernahme von Robotern. Der Spieler schlüpft in die Rolle eines Black-Ops-Soldaten, wie in den früheren Teilen der Black-Ops-Serie, mit Supersoldat-Fähigkeiten, die er durch eine schwere Verletzung im Kampf erhalten hat.'),
(2, 'Battlefield 5', 'Dice', 59.99, 'Battlefield V ist ein vom schwedischen Computerspielhersteller DICE entwickelter Ego-Shooter, welcher von Electronic Arts am 20. November 2018[1] weltweit veröffentlicht wurde. Damit ist dieser der insgesamt 16. Teil der Battlefield-Spielereihe.'),
(3, 'Fallout 76', 'Bethesda', 49.99, 'Fallout 76 ist keine direkte Fortsetzung der Reihe und verzichtet größtenteils auf eine Handlung. Es spielt in West Virginia, wo die Bewohner des Atombunkers Vault 76 im Jahr 2102, 25 Jahre nach dem verheerenden Atomkrieg, am sogenannten Reclamation Day beschließen, den Bunker zu öffnen und das umliegende Ödland wieder zu besiedeln. Das Spiel ist geprägt von der Suche nach überlebensnotwendigen Dingen wie Nahrung und nützlichen Dingen für die Erstellung von Ausrüstungs- und Nutzgegenständen.'),
(4, 'Minecraft', 'Mojang', 19.99, 'Minecraft ist ein Open-World-Spiel (ursprünglich Indie-Open-World-Spiel), das vom schwedischen Programmierer Markus „Notch“ Persson erschaffen und von dessen Firma Mojang, welche im September 2014 für 2,5 Milliarden Dollar (etwa 1,9 Milliarden Euro) durch den Microsoft-Konzern aufgekauft wurde, veröffentlicht und weiterentwickelt wird. ');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zahlung`
--

CREATE TABLE `zahlung` (
  `z_id` int(10) NOT NULL,
  `z_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `z_aufpreis` float(8,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `zahlung`
--

INSERT INTO `zahlung` (`z_id`, `z_name`, `z_aufpreis`) VALUES
(1, 'Kreditkarte', 0.00),
(2, 'PayPal', 2.50),
(3, 'PaySafeCard', 2.50);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `locks`
--
ALTER TABLE `locks`
  ADD PRIMARY KEY (`lock`);

--
-- Indizes für die Tabelle `nutzer`
--
ALTER TABLE `nutzer`
  ADD PRIMARY KEY (`n_id`);

--
-- Indizes für die Tabelle `spiele`
--
ALTER TABLE `spiele`
  ADD PRIMARY KEY (`s_id`);

--
-- Indizes für die Tabelle `zahlung`
--
ALTER TABLE `zahlung`
  ADD PRIMARY KEY (`z_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `nutzer`
--
ALTER TABLE `nutzer`
  MODIFY `n_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `spiele`
--
ALTER TABLE `spiele`
  MODIFY `s_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `zahlung`
--
ALTER TABLE `zahlung`
  MODIFY `z_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
