-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 03. Jan 2019 um 14:09
-- Server-Version: 10.1.37-MariaDB
-- PHP-Version: 7.3.0

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
-- Tabellenstruktur für Tabelle `cookie`
--

CREATE TABLE `cookie` (
  `c_id` int(10) NOT NULL,
  `cookie_user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `n_id` int(10) NOT NULL DEFAULT '0',
  `logged_in` bit(1) NOT NULL DEFAULT b'0',
  `login_expire` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `cookie`
--

INSERT INTO `cookie` (`c_id`, `cookie_user`, `n_id`, `logged_in`, `login_expire`) VALUES
(11, '6d161d2ccea13f208bc6a3cf4c1766d6', 0, b'1', '0000-00-00 00:00:00'),
(12, 'a20cd61a3fdc1f929e387019bc173145', 0, b'1', '0000-00-00 00:00:00'),
(13, '7ce5b5196d3bfc423795ca67940c2db5', 0, b'1', '0000-00-00 00:00:00'),
(14, '5aa4a24f721dbffed9c7b48a0593252d', 0, b'0', '0000-00-00 00:00:00'),
(15, '0785a870fa9dd8e2ae887c2d5f3ad70d', 10, b'0', '0000-00-00 00:00:00'),
(16, '664c2f58a9bdcd1c23a1b690b0a79a83', 10, b'0', '0000-00-00 00:00:00'),
(17, 'dd9c52403499704020860c8592aa997d', 0, b'0', '0000-00-00 00:00:00'),
(18, 'f316649c464fa497e3504b1df4799088', 0, b'0', '0000-00-00 00:00:00'),
(19, '8d8ac81382b96fd3955daeb492e88a00', 0, b'0', '0000-00-00 00:00:00'),
(20, '210b2691244df2b0f42f40450971d5a5', 0, b'0', '0000-00-00 00:00:00'),
(21, '312001def1fad92e7f5300642ccfa0c3', 0, b'0', '0000-00-00 00:00:00'),
(22, '6db39d43d188166313616fab7b2277d2', 0, b'0', '0000-00-00 00:00:00'),
(23, '70fc8420e2c3eba6d6ebd3a1f5852131', 0, b'0', '0000-00-00 00:00:00'),
(24, '845f23572bcc485a1c448931837c2f8c', 10, b'1', '0000-00-00 00:00:00'),
(25, '79303eb00ffcbb250a357b515f872232', 10, b'1', '0000-00-00 00:00:00'),
(26, '8fd930f895a6b126e598aa32c5f1a85b', 12, b'1', '0000-00-00 00:00:00'),
(27, '8e4166684d0bba1b8e66b2ec594efe86', 13, b'1', '0000-00-00 00:00:00'),
(28, '6c319ffafffe649ed95634738d5863cd', 13, b'1', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kauf`
--

CREATE TABLE `kauf` (
  `k_id` int(10) NOT NULL,
  `n_id` int(10) NOT NULL,
  `k_datum` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `k_zeit` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `k_spiele` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `k_preis` float(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `kauf`
--

INSERT INTO `kauf` (`k_id`, `n_id`, `k_datum`, `k_zeit`, `k_spiele`, `k_preis`) VALUES
(15, 12, '28.12.2018', '15:49', '1 (2x)', 79.88),
(16, 12, '28.12.2018', '16:00', '1 (5x)', 199.70),
(17, 12, '28.12.2018', '16:08', '1 (2x)', 79.88),
(18, 12, '28.12.2018', '16:47', '1 (1x)', 39.94),
(19, 12, '28.12.2018', '16:48', '1 (1x)', 39.94),
(20, 12, '28.12.2018', '16:49', '1 (3x)', 119.82),
(21, 13, '29.12.2018', '18:29', '1 (2x)', 79.88),
(22, 13, '29.12.2018', '19:11', 'Call of Duty - Black Ops 3 (2x)', 79.88),
(23, 13, '29.12.2018', '19:23', 'Call of Duty - Black Ops 3 (3x), Battlefield 5 (1x', 179.81);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `locks`
--

CREATE TABLE `locks` (
  `locks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `s_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `locks`
--

INSERT INTO `locks` (`locks`, `s_id`) VALUES
('16e8aa6c6d657b8d28d3eb7716d69843', 4),
('58557f6f6927f90d41106b40ce099636', 4),
('7fe0a5d4a8f2b5dafd98fd996d29bcab', 4),
('b4c6baf6645fcd34aee86d692b48130f', 4);

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
  `n_zahlung` int(10) NOT NULL DEFAULT '0',
  `hashwert` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `n_admin` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `nutzer`
--

INSERT INTO `nutzer` (`n_id`, `n_name`, `n_vorname`, `n_email`, `n_pass`, `n_zahlung`, `hashwert`, `n_admin`) VALUES
(1, 'Meyer', 'Erik', 'meyer@mail.de', 'hashwert', 1, NULL, b'0'),
(2, 'Kahnwald', 'Jonas', 'kahnwald@mail.de', 'hashwert', 2, NULL, b'0'),
(3, 'Valtinke', 'Melina', 'valtinke@mail.de', 'hashwert', 2, NULL, b'0'),
(4, 'Sauer', 'Philipp', 'sauer@mail.de', 'hashwert', 4, NULL, b'0'),
(5, 'asdaw', 'sadawds', 'adsd', '', 0, '$2y$10$aWVAqfnv3GiftnQ0C0U83uWCTy950EAgBjziT5/UG0Z', b'0'),
(6, 'Heinz', 'MÃ¼ller', 'heinz@lol.de', '', 0, '$2y$10$UNuX3VxLriRwHUplkePbM.gtVlK5I8/EU5J8I1Z56OG', b'0'),
(7, 'Hans', 'Peter', 'hans@lol.de', '', 0, '$2y$10$Y1.qO8O/WYhFs8gxEPpn.uvdy36wZnVRAn8md73pl.f', b'0'),
(9, 'Sauer', 'Philipp', 'penis@lol.de', '', 0, '$2y$10$wP04c.ewSKs7U5DQ.DzI8.CbG8Sw42YHFRIM19cYAKWw2.D/NU5rO', b'0'),
(10, 'Wiese', 'Jana', 'jana@lol.de', '', 0, '$2y$10$BGdIfh/FzvaApHjM0WVojuY/b7jRbJGbPEZ/Guenxd.apEZC0IXcC', b'1'),
(11, 'KeyÃŸner', 'Leon', 'leon@lol.de', '', 0, '$2y$10$c0WwzuEmvLBv/9Dm6usUAesuyBx1.wWh.ZS9c8m8QLDZsE4NrG9tq', b'0'),
(12, 'Test', 'User', 'nutzlosundso@gmail.com', '', 0, '$2y$10$lVh9v9uKUJVw7WMq9OQY9.uOL./qRHjokDFYbl3U5zjnzGhOL7FmK', b'0'),
(13, 'Hans', 'Peter', 'peter@lol.de', '', 0, '$2y$10$iEMDF4eqAznpqiaZMMRU0umJ377W1gYfj42.UHwhbIH4.WiSlMUBa', b'0');

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
(1, 'Call of Duty - Black Ops 3', 'Treyarch', 39.94, 'Call of Duty: Black Ops III spielt in einer dystopischen Zukunft im Jahre 2065, 40 Jahre nach den Ereignissen von Black Ops II. Wissenschaft und Technologie haben sich stark verï¿½ndert. Dies lï¿½st weltweit heftige Proteste aus und man versucht weitere Fortschritte zu stoppen. Die Militï¿½rtechnologie hat den Punkt erreicht, wo Robotik eine wichtige Rolle im Kampf spielt und ï¿½Supersoldatenï¿½ entwickelt wurden, um auf dem Schlachtfeld zu kï¿½mpfen. Infolgedessen gibt es Spekulationen und Angst ï¿½ber eine mï¿½gliche ï¿½bernahme von Robotern. Der Spieler schlï¿½pft in die Rolle eines Black-Ops-Soldaten, wie in den frï¿½heren Teilen der Black-Ops-Serie, mit Supersoldat-Fï¿½higkeiten, die er durch eine schwere Verletzung im Kampf erhalten hat.'),
(2, 'Battlefield 5', 'Dice', 59.99, 'Battlefield V ist ein vom schwedischen Computerspielhersteller DICE entwickelter Ego-Shooter, welcher von Electronic Arts am 20. November 2018[1] weltweit veröffentlicht wurde. Damit ist dieser der insgesamt 16. Teil der Battlefield-Spielereihe.'),
(3, 'Fallout 76', 'Bethesda', 49.99, 'Fallout 76 ist keine direkte Fortsetzung der Reihe und verzichtet größtenteils auf eine Handlung. Es spielt in West Virginia, wo die Bewohner des Atombunkers Vault 76 im Jahr 2102, 25 Jahre nach dem verheerenden Atomkrieg, am sogenannten Reclamation Day beschließen, den Bunker zu öffnen und das umliegende Ödland wieder zu besiedeln. Das Spiel ist geprägt von der Suche nach überlebensnotwendigen Dingen wie Nahrung und nützlichen Dingen für die Erstellung von Ausrüstungs- und Nutzgegenständen.'),
(4, 'Minecraft', 'Mojang', 19.99, 'Minecraft ist ein Open-World-Spiel (ursprünglich Indie-Open-World-Spiel), das vom schwedischen Programmierer Markus „Notch“ Persson erschaffen und von dessen Firma Mojang, welche im September 2014 für 2,5 Milliarden Dollar (etwa 1,9 Milliarden Euro) durch den Microsoft-Konzern aufgekauft wurde, veröffentlicht und weiterentwickelt wird. '),
(5, 'Spiel5', 'GameDeveloper', 24.99, 'Spiel Nummer 5.'),
(6, 'Spiel6', 'GameDeveloper', 10.00, 'Geiles Game.'),
(9, 'Assault Cube', 'Der Azubi', 20.00, 'Geiles Game wa?'),
(11, 'League of Legends', 'Riot Games', 50.00, 'macht sÃ¼chtig.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `warenkorb`
--

CREATE TABLE `warenkorb` (
  `w_id` int(10) NOT NULL,
  `cookie_user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `s_id` int(10) NOT NULL,
  `s_menge` int(10) NOT NULL,
  `s_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `warenkorb`
--

INSERT INTO `warenkorb` (`w_id`, `cookie_user`, `s_id`, `s_menge`, `s_name`) VALUES
(6, 'fad61060262e873f0daadc8ca3f85b76', 1, 2, NULL),
(7, 'fad61060262e873f0daadc8ca3f85b76', 3, 1, NULL),
(10, '0785a870fa9dd8e2ae887c2d5f3ad70d', 1, 2, NULL),
(12, '8d8ac81382b96fd3955daeb492e88a00', 1, 2, NULL),
(14, '845f23572bcc485a1c448931837c2f8c', 2, 1, NULL);

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
-- Indizes für die Tabelle `cookie`
--
ALTER TABLE `cookie`
  ADD PRIMARY KEY (`c_id`);

--
-- Indizes für die Tabelle `kauf`
--
ALTER TABLE `kauf`
  ADD PRIMARY KEY (`k_id`);

--
-- Indizes für die Tabelle `locks`
--
ALTER TABLE `locks`
  ADD PRIMARY KEY (`locks`);

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
-- Indizes für die Tabelle `warenkorb`
--
ALTER TABLE `warenkorb`
  ADD PRIMARY KEY (`w_id`);

--
-- Indizes für die Tabelle `zahlung`
--
ALTER TABLE `zahlung`
  ADD PRIMARY KEY (`z_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `cookie`
--
ALTER TABLE `cookie`
  MODIFY `c_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT für Tabelle `kauf`
--
ALTER TABLE `kauf`
  MODIFY `k_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT für Tabelle `nutzer`
--
ALTER TABLE `nutzer`
  MODIFY `n_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `spiele`
--
ALTER TABLE `spiele`
  MODIFY `s_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `warenkorb`
--
ALTER TABLE `warenkorb`
  MODIFY `w_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT für Tabelle `zahlung`
--
ALTER TABLE `zahlung`
  MODIFY `z_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
