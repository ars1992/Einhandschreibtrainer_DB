-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Apr 2023 um 20:03
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

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `durchlauf`
--

CREATE TABLE `durchlauf` (
  `durchlauf_ID` int(11) NOT NULL,
  `user_ID` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `user_id` int(6) NOT NULL,
  `username` varchar(30) NOT NULL,
  `Passwort` varchar(70) NOT NULL,
  `hand` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`user_id`, `username`, `Passwort`, `hand`) VALUES
(1, 'a@b', '$2y$10$5alPN9zfwU4fnnKZHEE3..NKiay6xY3z0dTWv9mGYsu1uQDaUp.U6', 'links'),
(2, 'a@bc', '$2y$10$I70R7p6hJb/37or.q6KTueY5VzCN/UdIGioz3u7b9.aCHXZ7Q7B.6', 'links'),
(3, 'alessandro.salomon', '$2y$10$zH1bmKW2SQlmj/ynL2eR/.12X//rmQloDshYXU1NN0ghqwTfA08IK', 'links'),
(4, 'a', '$2y$10$Ldu5iLCr.wVtpktkoptkGuQPVZa3JleHR5XKBcR5jcBHD/eJa9myO', 'rechts');

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
  ADD UNIQUE KEY `user_ID_3` (`user_ID`),
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
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
