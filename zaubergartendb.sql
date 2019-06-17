-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 17. Jun 2019 um 09:48
-- Server-Version: 10.3.12-MariaDB-1:10.3.12+maria~stretch
-- PHP-Version: 7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `zaubergarten_zaubergartendb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Material`
--

CREATE TABLE `Material` (
  `MaterialID` int(11) NOT NULL,
  `Groesse` double NOT NULL,
  `Einheit` varchar(15) COLLATE utf8_bin NOT NULL,
  `Name` text COLLATE utf8_bin DEFAULT NULL,
  `Menge` double DEFAULT NULL,
  `Zusammensetzung` text COLLATE utf8_bin DEFAULT NULL,
  `Anwendung` text COLLATE utf8_bin DEFAULT NULL,
  `RubrikName` text COLLATE utf8_bin DEFAULT NULL,
  `Rubrikbeschreibung` text COLLATE utf8_bin DEFAULT NULL,
  `bild` varchar(150) COLLATE utf8_bin NOT NULL,
  `qr` varchar(150) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `Material`
--

INSERT INTO `Material` (`MaterialID`, `Groesse`, `Einheit`, `Name`, `Menge`, `Zusammensetzung`, `Anwendung`, `RubrikName`, `Rubrikbeschreibung`, `bild`, `qr`) VALUES
(13, 123, 'quadratMeter', 'test12356', 1, 'cds', 'cds', 'cds', 'dfskfjs', '', NULL),
(17, 0, 'quadratMeter', 'asdfjksajlf', 8, 'nigero', 'sakdfjö', 'sadklfj', 'dksfja', '', NULL),
(21, 0, 'quadratMeter', 'Layus Galilayus', 55, 'dfkj', 'dfkj', 'djfj', 'fdjkdf', '', '../qr/material21.png'),
(22, 0, 'quadratMeter', 'Ein Material', 0, 'gor', 'dkfj', 'dlfkjas', 'fjsdf', '', NULL),
(23, 42, 'quadratMeter', '2 Material', 3, '', '', '', '', '', NULL),
(24, 123, 'quadratMeter', 'asd', 24, '234', '2dsf', 'sds', 'sdvsd', '', NULL),
(25, 2323, 'quadratMeter', 'jkkj', 232, '', '', '', '', '', NULL),
(26, 0, 'quadratMeter', 'Tolles mat', 0, '', '', '', '', '', NULL),
(27, 0, 'quadratMeter', 'Testssss', 0, '', '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Materialpfad`
--

CREATE TABLE `Materialpfad` (
  `MaterialID` int(11) NOT NULL,
  `Bildpfad` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Materialpfad`
--

INSERT INTO `Materialpfad` (`MaterialID`, `Bildpfad`) VALUES
(25, './materialPicture/trigger.gif'),
(27, './materialPicture/thumb-1920-728203.jpg'),
(27, './materialPicture/Scan.jpeg'),
(27, './materialPicture/948030.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Pflanze`
--

CREATE TABLE `Pflanze` (
  `PflanzenID` int(11) NOT NULL,
  `Sorte` int(11) DEFAULT NULL,
  `Beschreibung` int(11) DEFAULT NULL,
  `Pflege` int(11) DEFAULT NULL,
  `Wissenswert` int(11) DEFAULT NULL,
  `bild` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Pflanze`
--

INSERT INTO `Pflanze` (`PflanzenID`, `Sorte`, `Beschreibung`, `Pflege`, `Wissenswert`, `bild`) VALUES
(13, 26, 20, 34, 16, ''),
(16, 30, 24, 38, 20, ''),
(17, 31, 25, 39, 21, ''),
(18, 32, 26, 40, 22, ''),
(19, 33, 27, 41, 23, ''),
(21, 35, 29, 43, 25, ''),
(22, 36, 30, 44, 26, ''),
(23, 37, 31, 45, 27, ''),
(24, 38, 32, 46, 28, ''),
(25, 39, 33, 47, 29, ''),
(26, 40, 34, 48, 30, ''),
(27, 41, 35, 49, 31, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Pflanzenbeschreibung`
--

CREATE TABLE `Pflanzenbeschreibung` (
  `BeschreibungsID` int(11) NOT NULL,
  `Wuchs` text COLLATE utf8_bin DEFAULT NULL,
  `HoeheMin` double DEFAULT NULL,
  `HoeheMax` double DEFAULT NULL,
  `Breite` double DEFAULT NULL,
  `Rinde` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `Blaetter` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `Blueten` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `Fruechte` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `Wurzel` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `Standort` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `Boden` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `Eigenschaften` text COLLATE utf8_bin DEFAULT NULL,
  `Herkunft` varchar(200) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `Pflanzenbeschreibung`
--

INSERT INTO `Pflanzenbeschreibung` (`BeschreibungsID`, `Wuchs`, `HoeheMin`, `HoeheMax`, `Breite`, `Rinde`, `Blaetter`, `Blueten`, `Fruechte`, `Wurzel`, `Standort`, `Boden`, `Eigenschaften`, `Herkunft`) VALUES
(2, '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', ''),
(3, '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', ''),
(4, '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', ''),
(5, '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', ''),
(6, 'viel', NULL, NULL, NULL, 'keine', 'groÃŸe', 'schÃ¶ne', 'kein', 'is krass', 'in der Sonne', 'Lehmig', 'kvndjsvnnvdksvnakdjnsav', 'Italien'),
(7, 'viel', NULL, NULL, NULL, 'keine', 'groÃŸe', 'schÃ¶ne', 'kein', 'is krass', 'in der Sonne', 'Lehmig', 'kvndjsvnnvdksvnakdjnsav', 'Italien'),
(8, 'viel', NULL, NULL, NULL, 'keine', 'groÃŸe', 'schÃ¶ne', 'kein', 'is krass', 'in der Sonne', 'Lehmig', 'kvndjsvnnvdksvnakdjnsav', 'Italien'),
(20, '', NULL, NULL, NULL, '', '', '', '', '', '', '', '', ''),
(21, 'asdflk', 0, 4, 9, 'sdf', 'jdakasdl', 'kdsjflsd', '3', 'asldkfj', 'aslöfdjösal', 'asdkfjsa', 'jdajfsdjf', 'adsjkfklsajf'),
(24, 'adkfj', 5, 10, 88, 'djsflö', 'ld', 'jkdlsöfka', 'dsjöfla', 'dkjfa', 'dslkfja', 'dlkfj', 'dklsfj', 'jdflaj'),
(25, '', 0, 0, 0, '', '', '', '', '', '', '', '', ''),
(26, 'hoch', 80, 100, 0, 'braun', 'viele', 'keine', 'fru fru', 'fest', 'austria', 'gelb', 'sehr schön', 'austria'),
(27, 'jsfkjsdlf', 50, 105, 0, 'dsfjlsdfj', 'jdsflkjlkj', 'jwwekfjlsdjf', 'kjdfjsdlfj', 'jdfjslkfj', 'ldjflj', 'dlkfjsöf', 'ljdfkjsddf', 'sdjfölsdajkf'),
(29, '', 0, 0, 0, '', '', '', '', '', '', '', '', ''),
(30, 'jkldsdf', 14, 99, 34, 'sdsdkdsf', 'dsjdfslf', 'ksdjflj', 'dsjsfljaö', 'lkdsjlfj', 'ljsdlkfj', 'lkjf', 'fjlkasdjflkj', 'dlksfjlfkö'),
(31, 'Groß', 120, 150, 55, 'rinde', 'blätter', 'blüten', 'früchte', 'wurzel', 'standort', 'boden', 'eigenschaft', 'österreich'),
(32, '', 0, 0, 0, '', '', '', '', '', '', '', '', ''),
(33, '', 0, 0, 0, '', '', '', '', '', '', '', '', ''),
(34, '', 0, 0, 0, '', '', '', '', '', '', '', '', ''),
(35, '', 0, 0, 0, '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Pflanzenpfad`
--

CREATE TABLE `Pflanzenpfad` (
  `PflanzenID` int(11) NOT NULL,
  `Bildpfad` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Daten für Tabelle `Pflanzenpfad`
--

INSERT INTO `Pflanzenpfad` (`PflanzenID`, `Bildpfad`) VALUES
(0, './plantPictures/ogott.png'),
(17, './plantPictures/Foto am 13.03.19 um 16.06.jpg'),
(18, './plantPictures/WhatsApp Image 2019-02-21 at 13.24.39.jpeg'),
(20, './plantPictures/krone_mirela.png'),
(19, './plantPictures/blanc.jpg'),
(21, './plantPictures/blanc_1.jpg'),
(22, './plantPictures/ogott.png'),
(22, './plantPictures/pb_elearn.png'),
(23, './plantPictures/2010_sonnenblume_(Helianthus_annuus).jpg'),
(23, './plantPictures/sonnenblume_rund.jpg'),
(23, './plantPictures/Sonnenblume-Wachstum.jpg'),
(24, './plantPictures/2010_sonnenblume_(Helianthus_annuus)_2.jpg'),
(25, './plantPictures/trigger.gif'),
(26, './plantPictures/trigger_1.gif');

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `PflanzenView`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `PflanzenView` (
`PflanzenID` int(11)
,`Sorte` int(11)
,`Beschreibung` int(11)
,`Pflege` int(11)
,`Wissenswert` int(11)
,`SorteID` int(11)
,`BotanischerName` varchar(100)
,`DeutscherName` varchar(100)
,`Volksmund` varchar(100)
,`BeschreibungsID` int(11)
,`Wuchs` text
,`HoeheMin` double
,`HoeheMax` double
,`Breite` double
,`Rinde` varchar(100)
,`Blaetter` varchar(150)
,`Blueten` varchar(150)
,`Fruechte` varchar(150)
,`Wurzel` varchar(150)
,`Standort` varchar(150)
,`Boden` varchar(150)
,`Eigenschaften` text
,`Herkunft` varchar(200)
,`PflegeID` int(11)
,`Schnitt` varchar(200)
,`Schadbilder` varchar(200)
,`Hilfe` varchar(200)
,`WissenswertID` int(11)
,`Baumkreis` varchar(200)
,`Rezept` text
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Pflege`
--

CREATE TABLE `Pflege` (
  `PflegeID` int(11) NOT NULL,
  `Schnitt` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Schadbilder` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Hilfe` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Pflege`
--

INSERT INTO `Pflege` (`PflegeID`, `Schnitt`, `Schadbilder`, `Hilfe`) VALUES
(2, 'test1', 'Ja', 'Es gibt keine Hilfe'),
(3, 'test2', 'Nein', 'Bitte wenden Sie sich an den 2. level support'),
(4, 'test3', 'Ja/Nein', 'What is going on='),
(5, 'test4', 'Ja/Nein', 'What is going on='),
(6, 'test5', 'Noah', 'What is happening'),
(7, 'test5', 'Noha', 'Help me i am held here against my will!'),
(8, 'test6', 'Nohaaa', 'I am a happy plant'),
(9, 'test7', '20er', 'I am a happy 20er'),
(10, '', '', ''),
(11, 'kurz', 'Wespen', 'Ruaf in mathie an'),
(12, '', '', ''),
(13, '', '', ''),
(14, '', '', ''),
(15, '', '', ''),
(16, '', '', ''),
(17, '', '', ''),
(18, '', '', ''),
(19, '', '', ''),
(20, 'Wird nicht geschnitten', 'KÃ¤fer', 'Frog in Tobi der was ois'),
(21, 'Wird nicht geschnitten', 'KÃ¤fer', 'Frog in Tobi der was ois'),
(22, 'Wird nicht geschnitten', 'KÃ¤fer', 'Frog in Tobi der was ois'),
(34, '', '', ''),
(35, 'asdjf', 'dkfjasf', 'lkdsjflk'),
(38, 'dslkfjsdöl', 'ldssfjaö', 'dlkfjs'),
(39, '', 'nknkdfs', 'sdkmnf'),
(40, 'schnitt', 'büder', 'hüffe'),
(41, 'kfsaj', 'jdsöfajasö', 'sdlfkjsaö'),
(43, '', '', ''),
(44, 'sdfjdslfkl', 'dsklfj', 'kdsflk'),
(45, 'schnitt', 'schadbild', 'hilfe'),
(46, '', '', ''),
(47, '', '', ''),
(48, '', '', ''),
(49, '', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Sorte`
--

CREATE TABLE `Sorte` (
  `SorteID` int(11) NOT NULL,
  `BotanischerName` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `DeutscherName` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Volksmund` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Sorte`
--

INSERT INTO `Sorte` (`SorteID`, `BotanischerName`, `DeutscherName`, `Volksmund`) VALUES
(2, 'Pflanze1', ' dkjvsnk', 'vdskvndj'),
(3, 'Sonnenblume', 'die gelbe Blume', 'Mais'),
(4, 'Sonnenblume', '', ''),
(5, 'Sonnenblume', '', ''),
(6, 'Sonnenblume', '', ''),
(7, 'Sonnenblume', '', ''),
(8, 'Sonnenblume', '', ''),
(9, 'csacs', '', ''),
(10, 'csacs', '', ''),
(11, 'Sonnenblume', '', ''),
(12, 'Sonnus Blumus', 'Sonnenblume', 'Maislume'),
(13, 'Sonnus Blumus', 'Sonnenblume', 'Maislume'),
(14, 'Sonnus Blumus', 'Sonnenblume', 'Maislume'),
(26, 'Sonnus Blumus', 'Sonnenblume', ''),
(27, 'dfskjf', 'kdjasflk', 'lsdjaflös'),
(30, 'Nigro', 'fdsaljk', 'dsklfj'),
(31, 'sdf', 'sadf', 'dsfa'),
(32, 'A guader', 'miguel', 'miggi'),
(33, 'öasjfslöajf', 'ldsjaföaskf', 'lksdjföalsdkjf'),
(35, 'Sen', 'Sationell', ''),
(36, 'fdsflkjsdlj', 'jdslkfj', 'dsfklj'),
(37, 'Sonnnseenblume', 'Diese Blume', 'Blume'),
(38, 'dies', 'skfljasf', 'sdfj'),
(39, 'asd', 'asd', 'asd'),
(40, '', '', ''),
(41, 'TEST', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Wissenswertes`
--

CREATE TABLE `Wissenswertes` (
  `WissenswertID` int(11) NOT NULL,
  `Baumkreis` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Rezept` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Wissenswertes`
--

INSERT INTO `Wissenswertes` (`WissenswertID`, `Baumkreis`, `Rezept`) VALUES
(1, '', ''),
(2, '5', 'ins wasser geben und kochen'),
(3, '5', 'ins wasser geben und kochen'),
(4, '5', 'ins wasser geben und kochen'),
(5, '5', 'ins wasser geben und kochen'),
(6, '5', 'ins wasser geben und kochen'),
(7, '5', 'ins wasser geben und kochen'),
(8, '5', 'ins wasser geben und kochen'),
(9, '', ''),
(10, '', ''),
(11, '', ''),
(12, '', ''),
(13, '', ''),
(14, '', ''),
(15, '', ''),
(16, '', ''),
(17, '4', 'salfksjlöf'),
(18, 'asdfkj', 'dlfkjsöfkjsa'),
(19, 'dlkfja', 'sajdf'),
(20, 'asdf', 'asdfsdaf'),
(21, '', ''),
(22, 'rund', 'instant nudeln halt '),
(23, 'dfjsdjf', 'lkdjf'),
(24, 'lkjf', 'lkjflkqjflk'),
(25, '', ''),
(26, 'askdf', 'kfdsfs'),
(27, 'baumkreis', 'rezept'),
(28, '', ''),
(29, '', ''),
(30, '', ''),
(31, '', ''),
(32, '', ''),
(33, '', '');

-- --------------------------------------------------------

--
-- Struktur des Views `PflanzenView`
--
DROP TABLE IF EXISTS `PflanzenView`;

CREATE ALGORITHM=UNDEFINED DEFINER=`zaubergarten_zaubergarten`@`localhost` SQL SECURITY DEFINER VIEW `PflanzenView`  AS  select `p`.`PflanzenID` AS `PflanzenID`,`p`.`Sorte` AS `Sorte`,`p`.`Beschreibung` AS `Beschreibung`,`p`.`Pflege` AS `Pflege`,`p`.`Wissenswert` AS `Wissenswert`,`s`.`SorteID` AS `SorteID`,`s`.`BotanischerName` AS `BotanischerName`,`s`.`DeutscherName` AS `DeutscherName`,`s`.`Volksmund` AS `Volksmund`,`pb`.`BeschreibungsID` AS `BeschreibungsID`,`pb`.`Wuchs` AS `Wuchs`,`pb`.`HoeheMin` AS `HoeheMin`,`pb`.`HoeheMax` AS `HoeheMax`,`pb`.`Breite` AS `Breite`,`pb`.`Rinde` AS `Rinde`,`pb`.`Blaetter` AS `Blaetter`,`pb`.`Blueten` AS `Blueten`,`pb`.`Fruechte` AS `Fruechte`,`pb`.`Wurzel` AS `Wurzel`,`pb`.`Standort` AS `Standort`,`pb`.`Boden` AS `Boden`,`pb`.`Eigenschaften` AS `Eigenschaften`,`pb`.`Herkunft` AS `Herkunft`,`pf`.`PflegeID` AS `PflegeID`,`pf`.`Schnitt` AS `Schnitt`,`pf`.`Schadbilder` AS `Schadbilder`,`pf`.`Hilfe` AS `Hilfe`,`w`.`WissenswertID` AS `WissenswertID`,`w`.`Baumkreis` AS `Baumkreis`,`w`.`Rezept` AS `Rezept` from ((((`Pflanze` `p` join `Sorte` `s` on(`p`.`Sorte` = `s`.`SorteID`)) join `Pflanzenbeschreibung` `pb` on(`p`.`Beschreibung` = `pb`.`BeschreibungsID`)) join `Pflege` `pf` on(`p`.`Pflege` = `pf`.`PflegeID`)) join `Wissenswertes` `w` on(`p`.`Wissenswert` = `w`.`WissenswertID`)) ;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Material`
--
ALTER TABLE `Material`
  ADD PRIMARY KEY (`MaterialID`);

--
-- Indizes für die Tabelle `Pflanze`
--
ALTER TABLE `Pflanze`
  ADD PRIMARY KEY (`PflanzenID`),
  ADD KEY `fk_Sorte` (`Sorte`),
  ADD KEY `fk_Pflanzenbeschreibung` (`Beschreibung`),
  ADD KEY `fk_Pflege` (`Pflege`),
  ADD KEY `fk_Wissenswert` (`Wissenswert`);

--
-- Indizes für die Tabelle `Pflanzenbeschreibung`
--
ALTER TABLE `Pflanzenbeschreibung`
  ADD PRIMARY KEY (`BeschreibungsID`);

--
-- Indizes für die Tabelle `Pflege`
--
ALTER TABLE `Pflege`
  ADD PRIMARY KEY (`PflegeID`);

--
-- Indizes für die Tabelle `Sorte`
--
ALTER TABLE `Sorte`
  ADD PRIMARY KEY (`SorteID`);

--
-- Indizes für die Tabelle `Wissenswertes`
--
ALTER TABLE `Wissenswertes`
  ADD PRIMARY KEY (`WissenswertID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Material`
--
ALTER TABLE `Material`
  MODIFY `MaterialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT für Tabelle `Pflanze`
--
ALTER TABLE `Pflanze`
  MODIFY `PflanzenID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT für Tabelle `Pflanzenbeschreibung`
--
ALTER TABLE `Pflanzenbeschreibung`
  MODIFY `BeschreibungsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT für Tabelle `Pflege`
--
ALTER TABLE `Pflege`
  MODIFY `PflegeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT für Tabelle `Sorte`
--
ALTER TABLE `Sorte`
  MODIFY `SorteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT für Tabelle `Wissenswertes`
--
ALTER TABLE `Wissenswertes`
  MODIFY `WissenswertID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `Pflanze`
--
ALTER TABLE `Pflanze`
  ADD CONSTRAINT `fk_Pflanzenbeschreibung` FOREIGN KEY (`Beschreibung`) REFERENCES `Pflanzenbeschreibung` (`BeschreibungsID`),
  ADD CONSTRAINT `fk_Pflege` FOREIGN KEY (`Pflege`) REFERENCES `Pflege` (`PflegeID`),
  ADD CONSTRAINT `fk_Sorte` FOREIGN KEY (`Sorte`) REFERENCES `Sorte` (`SorteID`),
  ADD CONSTRAINT `fk_Wissenswert` FOREIGN KEY (`Wissenswert`) REFERENCES `Wissenswertes` (`WissenswertID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
