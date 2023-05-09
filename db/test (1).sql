-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Apr 2023 um 18:31
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
(107, '2023-04-22', 1536, 85, 570),
(108, '2023-04-22', 1704, 85, 1311);

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
(107, 2),
(108, 2);

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
(3, 'alessandro.salomon', '$2y$10$zH1bmKW2SQlmj/ynL2eR/.12X//rmQloDshYXU1NN0ghqwTfA08IK', 'links'),
(6, 'a', '$2y$10$nArkFBC9nBL15o6AJzQS2uahVe/hpCGzFlLmHh5IJN8.J6o3QLYxy', 'rechts');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zeichenfehler`
--

CREATE TABLE `zeichenfehler` (
  `durchlauf_id` int(6) NOT NULL,
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  `e` int(11) NOT NULL,
  `f` int(11) NOT NULL,
  `g` int(11) NOT NULL,
  `h` int(11) NOT NULL,
  `i` int(11) NOT NULL,
  `j` int(11) NOT NULL,
  `k` int(11) NOT NULL,
  `l` int(11) NOT NULL,
  `m` int(11) NOT NULL,
  `n` int(11) NOT NULL,
  `o` int(11) NOT NULL,
  `p` int(11) NOT NULL,
  `q` int(11) NOT NULL,
  `r` int(11) NOT NULL,
  `s` int(11) NOT NULL,
  `t` int(11) NOT NULL,
  `u` int(11) NOT NULL,
  `v` int(11) NOT NULL,
  `w` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `z` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `zeichenfehler`
--

INSERT INTO `zeichenfehler` (`durchlauf_id`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `m`, `n`, `o`, `p`, `q`, `r`, `s`, `t`, `u`, `v`, `w`, `x`, `y`, `z`) VALUES
(107, 97, 52, 40, 39, 32, 29, 29, 25, 21, 19, 19, 15, 14, 14, 12, 11, 8, 7, 7, 7, 5, 5, 5, 5, 4, 4),
(108, 196, 103, 98, 89, 76, 66, 59, 58, 58, 48, 41, 35, 32, 27, 26, 26, 18, 18, 16, 15, 13, 11, 10, 10, 9, 9);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zeichengesamt`
--

CREATE TABLE `zeichengesamt` (
  `durchlauf_id` int(6) NOT NULL,
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  `e` int(11) NOT NULL,
  `f` int(11) NOT NULL,
  `g` int(11) NOT NULL,
  `h` int(11) NOT NULL,
  `i` int(11) NOT NULL,
  `j` int(11) NOT NULL,
  `k` int(11) NOT NULL,
  `l` int(11) NOT NULL,
  `m` int(11) NOT NULL,
  `n` int(11) NOT NULL,
  `o` int(11) NOT NULL,
  `p` int(11) NOT NULL,
  `q` int(11) NOT NULL,
  `r` int(11) NOT NULL,
  `s` int(11) NOT NULL,
  `t` int(11) NOT NULL,
  `u` int(11) NOT NULL,
  `v` int(11) NOT NULL,
  `w` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `z` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `zeichengesamt`
--

INSERT INTO `zeichengesamt` (`durchlauf_id`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `m`, `n`, `o`, `p`, `q`, `r`, `s`, `t`, `u`, `v`, `w`, `x`, `y`, `z`) VALUES
(107, 97, 52, 40, 39, 32, 29, 29, 25, 21, 20, 19, 15, 14, 14, 12, 11, 8, 7, 7, 7, 5, 5, 5, 5, 4, 4),
(108, 196, 103, 98, 89, 76, 66, 59, 58, 58, 48, 41, 35, 32, 27, 26, 26, 18, 18, 16, 15, 13, 11, 10, 10, 9, 9);

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
  MODIFY `durchlauf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
