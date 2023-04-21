-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 21. Apr 2023 um 08:44
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
  `anschlaege` int(11) NOT NULL,
  `fehler_Prozent` int(11) NOT NULL,
  `fehler_Gesamt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `auswertung`
--

INSERT INTO `auswertung` (`durchlauf_ID`, `datum`, `anschlaege`, `fehler_Prozent`, `fehler_Gesamt`) VALUES
(13, '2023-04-20', 0, 0, 0),
(14, '2023-04-20', 0, 0, 0),
(15, '2023-04-21', 0, 0, 0),
(16, '2023-04-21', 0, 0, 0),
(17, '2023-04-21', 1140, 94, 18);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `durchlauf`
--

CREATE TABLE `durchlauf` (
  `durchlauf_id` int(11) NOT NULL,
  `user_ID` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `durchlauf`
--

INSERT INTO `durchlauf` (`durchlauf_id`, `user_ID`) VALUES
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `user_id` int(6) NOT NULL,
  `username` varchar(30) NOT NULL,
  `passwort` varchar(70) NOT NULL,
  `hand` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`user_id`, `username`, `passwort`, `hand`) VALUES
(1, 'a@b', '$2y$10$5alPN9zfwU4fnnKZHEE3..NKiay6xY3z0dTWv9mGYsu1uQDaUp.U6', 'links'),
(2, 'a@bc', '$2y$10$I70R7p6hJb/37or.q6KTueY5VzCN/UdIGioz3u7b9.aCHXZ7Q7B.6', 'links'),
(3, 'alessandro.salomon', '$2y$10$zH1bmKW2SQlmj/ynL2eR/.12X//rmQloDshYXU1NN0ghqwTfA08IK', 'links');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zeichenfehler`
--

CREATE TABLE `zeichenfehler` (
  `durchlauf_id` int(6) NOT NULL,
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zeichengesamt`
--

CREATE TABLE `zeichengesamt` (
  `durchlauf_id` int(6) NOT NULL,
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
  ADD UNIQUE KEY `durchlauf_ID` (`durchlauf_ID`),
  ADD KEY `durchlauf_ID_2` (`durchlauf_ID`);

--
-- Indizes für die Tabelle `durchlauf`
--
ALTER TABLE `durchlauf`
  ADD PRIMARY KEY (`durchlauf_id`),
  ADD KEY `user_ID` (`user_ID`) USING BTREE;

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indizes für die Tabelle `zeichenfehler`
--
ALTER TABLE `zeichenfehler`
  ADD UNIQUE KEY `durchlauf_ID` (`durchlauf_id`) USING BTREE;

--
-- Indizes für die Tabelle `zeichengesamt`
--
ALTER TABLE `zeichengesamt`
  ADD UNIQUE KEY `durchlauf_ID` (`durchlauf_id`) USING BTREE;

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `durchlauf`
--
ALTER TABLE `durchlauf`
  MODIFY `durchlauf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `auswertung`
--
ALTER TABLE `auswertung`
  ADD CONSTRAINT `auswertung_ibfk_1` FOREIGN KEY (`durchlauf_ID`) REFERENCES `durchlauf` (`durchlauf_id`);

--
-- Constraints der Tabelle `durchlauf`
--
ALTER TABLE `durchlauf`
  ADD CONSTRAINT `durchlauf_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_id`);

--
-- Constraints der Tabelle `zeichenfehler`
--
ALTER TABLE `zeichenfehler`
  ADD CONSTRAINT `zeichenfehler_ibfk_1` FOREIGN KEY (`durchlauf_id`) REFERENCES `durchlauf` (`durchlauf_id`);

--
-- Constraints der Tabelle `zeichengesamt`
--
ALTER TABLE `zeichengesamt`
  ADD CONSTRAINT `zeichengesamt_ibfk_1` FOREIGN KEY (`durchlauf_id`) REFERENCES `durchlauf` (`durchlauf_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
