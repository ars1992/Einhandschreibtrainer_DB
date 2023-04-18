-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Apr 2023 um 17:35
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `test`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auswertung`
--

CREATE TABLE `auswertung` (
  `durchlauf_ID` int(6) NOT NULL,
  `datum` date NOT NULL,
  `anschläge` int(11) NOT NULL,
  `fehler_Prozent` int(11) NOT NULL,
  `fehler_Gesamt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `auswertung`
--

INSERT INTO `auswertung` (`durchlauf_ID`, `datum`, `anschläge`, `fehler_Prozent`, `fehler_Gesamt`) VALUES
(1, '2023-04-12', 34, 22, 78);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `durchlauf`
--

CREATE TABLE `durchlauf` (
  `durchlauf_ID` int(11) NOT NULL,
  `user_ID` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `durchlauf`
--

INSERT INTO `durchlauf` (`durchlauf_ID`, `user_ID`) VALUES
(1, 1001);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `user_id` int(6) NOT NULL,
  `username` varchar(30) NOT NULL,
  `Passwort` varchar(50) NOT NULL,
  `hand` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`user_id`, `username`, `Passwort`, `hand`) VALUES
(1000, 'davidgeber', '12345abcd', 'rechts'),
(1001, 'a@b', 'dfhdfbcv', 'links');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zeichenfehler`
--

CREATE TABLE `zeichenfehler` (
  `durchlauf_ID` int(6) NOT NULL,
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `zeichenfehler`
--

INSERT INTO `zeichenfehler` (`durchlauf_ID`, `a`, `b`, `c`) VALUES
(1, 1, 1, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zeichengesamt`
--

CREATE TABLE `zeichengesamt` (
  `durchlauf_ID` int(6) NOT NULL,
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `zeichengesamt`
--

INSERT INTO `zeichengesamt` (`durchlauf_ID`, `a`, `b`, `c`) VALUES
(1, 1, 45, 235);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `auswertung`
--
ALTER TABLE `auswertung`
  ADD UNIQUE KEY `durchlauf_ID_2` (`durchlauf_ID`),
  ADD KEY `durchlauf_ID` (`durchlauf_ID`);

--
-- Indizes für die Tabelle `durchlauf`
--
ALTER TABLE `durchlauf`
  ADD PRIMARY KEY (`durchlauf_ID`),
  ADD UNIQUE KEY `user_ID_2` (`user_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indizes für die Tabelle `zeichenfehler`
--
ALTER TABLE `zeichenfehler`
  ADD UNIQUE KEY `durchlauf_ID_2` (`durchlauf_ID`),
  ADD KEY `durchlauf_ID` (`durchlauf_ID`);

--
-- Indizes für die Tabelle `zeichengesamt`
--
ALTER TABLE `zeichengesamt`
  ADD UNIQUE KEY `durchlauf_ID_2` (`durchlauf_ID`),
  ADD UNIQUE KEY `durchlauf_ID_4` (`durchlauf_ID`),
  ADD KEY `durchlauf_ID` (`durchlauf_ID`),
  ADD KEY `durchlauf_ID_3` (`durchlauf_ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `durchlauf`
--
ALTER TABLE `durchlauf`
  MODIFY `durchlauf_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `auswertung`
--
ALTER TABLE `auswertung`
  ADD CONSTRAINT `auswertung_ibfk_1` FOREIGN KEY (`durchlauf_ID`) REFERENCES `durchlauf` (`durchlauf_ID`);

--
-- Constraints der Tabelle `durchlauf`
--
ALTER TABLE `durchlauf`
  ADD CONSTRAINT `durchlauf_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_id`);

--
-- Constraints der Tabelle `zeichenfehler`
--
ALTER TABLE `zeichenfehler`
  ADD CONSTRAINT `zeichenfehler_ibfk_1` FOREIGN KEY (`durchlauf_ID`) REFERENCES `durchlauf` (`durchlauf_ID`);

--
-- Constraints der Tabelle `zeichengesamt`
--
ALTER TABLE `zeichengesamt`
  ADD CONSTRAINT `zeichengesamt_ibfk_1` FOREIGN KEY (`durchlauf_ID`) REFERENCES `durchlauf` (`durchlauf_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
