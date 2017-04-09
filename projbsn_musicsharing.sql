-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2017 at 01:34 PM
-- Server version: 10.0.30-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projbsn_musicsharing`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `AdminID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(25) NOT NULL DEFAULT 'No Name Assigned Yet',
  `Password` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`AdminID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `Name`, `Password`) VALUES
(1, 'Bob The Administrator', NULL),
(2, 'Sally the db administrato', NULL),
(3, 'John The Admin of Databas', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `AlbumName` varchar(25) NOT NULL DEFAULT 'No Name Yet Selected',
  `ArtistID` int(11) NOT NULL,
  `AdminWhoAddedID` int(11) DEFAULT NULL,
  `Year` int(4) DEFAULT NULL,
  `Sales` int(11) DEFAULT NULL,
  `AddedDate` date DEFAULT NULL,
  PRIMARY KEY (`AlbumName`,`ArtistID`),
  KEY `FK1` (`ArtistID`),
  KEY `FK2` (`AdminWhoAddedID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`AlbumName`, `ArtistID`, `AdminWhoAddedID`, `Year`, `Sales`, `AddedDate`) VALUES
('2005 mixtape', 2, 1, 2003, 4543, '2005-04-06'),
('Views', 1, 3, 2016, 346256, '2016-10-08');

-- --------------------------------------------------------

--
-- Table structure for table `album_rating`
--

CREATE TABLE IF NOT EXISTS `album_rating` (
  `AlbumName` varchar(25) NOT NULL,
  `ArtistID` int(11) NOT NULL,
  `ByUserID` int(11) NOT NULL,
  `Rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`AlbumName`,`ArtistID`,`ByUserID`),
  KEY `FK30` (`ArtistID`),
  KEY `FK31` (`ByUserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album_rating`
--

INSERT INTO `album_rating` (`AlbumName`, `ArtistID`, `ByUserID`, `Rating`) VALUES
('Views', 1, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE IF NOT EXISTS `artist` (
  `ArtistID` int(11) NOT NULL AUTO_INCREMENT,
  `AdminWhoAddedID` int(11) DEFAULT NULL,
  `StageName` varchar(25) DEFAULT NULL,
  `RealName` varchar(25) DEFAULT NULL,
  `AddedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`ArtistID`),
  KEY `FK6` (`AdminWhoAddedID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`ArtistID`, `AdminWhoAddedID`, `StageName`, `RealName`, `AddedDate`) VALUES
(1, 1, 'Drake', 'Aubrey Graham', '2017-01-01 00:00:00'),
(2, 3, 'Eminem', 'Marshall Mathers', '2002-03-22 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `artist_rating`
--

CREATE TABLE IF NOT EXISTS `artist_rating` (
  `ArtistID` int(11) NOT NULL,
  `ByUserID` int(11) NOT NULL,
  `Rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`ArtistID`,`ByUserID`),
  KEY `FK25` (`ByUserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artist_rating`
--

INSERT INTO `artist_rating` (`ArtistID`, `ByUserID`, `Rating`) VALUES
(1, 1, 5),
(2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `flag`
--

CREATE TABLE IF NOT EXISTS `flag` (
  `ModID` int(11) NOT NULL,
  `ReviewID` int(11) NOT NULL,
  PRIMARY KEY (`ModID`,`ReviewID`),
  KEY `FK23` (`ReviewID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flag`
--

INSERT INTO `flag` (`ModID`, `ReviewID`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE IF NOT EXISTS `following` (
  `FollowerID` int(11) NOT NULL DEFAULT '-1',
  `FolloweeID` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`FollowerID`,`FolloweeID`),
  KEY `FK8` (`FolloweeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `following`
--

INSERT INTO `following` (`FollowerID`, `FolloweeID`) VALUES
(1, 2),
(1, 3),
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `listened`
--

CREATE TABLE IF NOT EXISTS `listened` (
  `SongName` varchar(25) NOT NULL DEFAULT 'Not Yet Chosen',
  `ArtistID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `NumTimes` int(11) DEFAULT NULL,
  PRIMARY KEY (`SongName`,`ArtistID`,`UserID`),
  KEY `FK14` (`ArtistID`),
  KEY `FK15` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `listened`
--

INSERT INTO `listened` (`SongName`, `ArtistID`, `UserID`, `NumTimes`) VALUES
('Controlla', 1, 1, 56);

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE IF NOT EXISTS `moderator` (
  `ModID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(25) NOT NULL DEFAULT 'No Name Assigned Yet',
  `Password` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ModID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=4 ;

--
-- Dumping data for table `moderator`
--

INSERT INTO `moderator` (`ModID`, `Name`, `Password`) VALUES
(1, 'Edward the moderator', NULL),
(3, 'Jacobine - Moderator of D', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recommendation`
--

CREATE TABLE IF NOT EXISTS `recommendation` (
  `RecomID` int(11) NOT NULL AUTO_INCREMENT,
  `SongName` varchar(25) DEFAULT NULL,
  `ArtistID` int(11) DEFAULT NULL,
  `ByUserID` int(11) DEFAULT '1',
  `ForUserID` int(11) NOT NULL DEFAULT '1',
  `Message` varchar(500) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  PRIMARY KEY (`RecomID`),
  KEY `FK9` (`SongName`),
  KEY `FK11` (`ByUserID`),
  KEY `FK12` (`ForUserID`),
  KEY `FK10` (`ArtistID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `recommendation`
--

INSERT INTO `recommendation` (`RecomID`, `SongName`, `ArtistID`, `ByUserID`, `ForUserID`, `Message`, `Date`) VALUES
(1, 'The Real Slim Shady', 2, 1, 3, 'Check this out man!', '2017-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `ReviewID` int(11) NOT NULL AUTO_INCREMENT,
  `DatePosted` date DEFAULT NULL,
  `TimePosted` time NOT NULL,
  `Content` varchar(500) DEFAULT NULL,
  `SongName` varchar(25) DEFAULT NULL,
  `ArtistID` int(11) DEFAULT NULL,
  `AlbumName` varchar(25) NOT NULL,
  `UserWhoWrote` int(11) NOT NULL,
  PRIMARY KEY (`ReviewID`),
  KEY `FK16` (`SongName`),
  KEY `FK17` (`ArtistID`),
  KEY `FK18` (`AlbumName`),
  KEY `FK19` (`UserWhoWrote`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='If SongName and AlbumName are NULL, the review is about the artist. If only SongName is null, the review is about the album. if only album name is NULL, the review is about the song.' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`ReviewID`, `DatePosted`, `TimePosted`, `Content`, `SongName`, `ArtistID`, `AlbumName`, `UserWhoWrote`) VALUES
(1, '2017-03-30', '03:47:00', 'This is an extremely average song!!! :D', 'Controlla', 1, 'Views', 1),
(2, '2017-04-04', '12:12:12', 'Sweet', 'Controlla', 1, 'Views', 2);

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE IF NOT EXISTS `song` (
  `SongName` varchar(25) NOT NULL DEFAULT 'No Name Yet',
  `ArtistID` int(11) NOT NULL,
  `AlbumName` varchar(25) DEFAULT NULL,
  `AdminWhoAddedID` int(11) DEFAULT NULL,
  `Genre` varchar(25) DEFAULT NULL,
  `Length` int(11) DEFAULT NULL,
  `AddedDate` date DEFAULT NULL,
  PRIMARY KEY (`SongName`,`ArtistID`),
  KEY `FK3` (`ArtistID`),
  KEY `FK4` (`AlbumName`),
  KEY `FK5` (`AdminWhoAddedID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`SongName`, `ArtistID`, `AlbumName`, `AdminWhoAddedID`, `Genre`, `Length`, `AddedDate`) VALUES
('Controlla', 1, 'Views', 3, 'Rap', 34, '2016-10-22'),
('The Real Slim Shady', 2, '2005 mixtape', 2, 'Rap', 453, '2005-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `song_rating`
--

CREATE TABLE IF NOT EXISTS `song_rating` (
  `SongName` varchar(25) NOT NULL,
  `ArtistID` int(11) NOT NULL,
  `ByUserID` int(11) NOT NULL,
  `Rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`SongName`,`ArtistID`,`ByUserID`),
  KEY `FK27` (`ArtistID`),
  KEY `FK28` (`ByUserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `song_rating`
--

INSERT INTO `song_rating` (`SongName`, `ArtistID`, `ByUserID`, `Rating`) VALUES
('Controlla', 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `DOB` date DEFAULT NULL,
  `Name` varchar(25) DEFAULT NULL,
  `Password` varchar(32) CHARACTER SET utf32 COLLATE utf32_bin DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `DOB`, `Name`, `Password`) VALUES
(1, '1864-10-09', 'Nicolas Gonzalez', 'boo'),
(2, '1962-07-08', 'Ali Ahmed', NULL),
(3, '1989-02-02', 'Metch Rands', NULL),
(4, '2017-04-07', 'foo', 'bar'),
(5, NULL, NULL, NULL),
(6, NULL, NULL, NULL),
(7, '0000-00-00', NULL, 'oklshjdflkjs'),
(8, '1995-10-20', NULL, 'sdfsd'),
(9, '1995-10-20', 'Spock', 'kdnjkfl'),
(10, '0000-00-00', '', ''),
(11, '0000-00-00', '', ''),
(12, '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_warning`
--

CREATE TABLE IF NOT EXISTS `user_warning` (
  `ModID` int(11) NOT NULL DEFAULT '1',
  `UserID` int(11) NOT NULL DEFAULT '1',
  `NumStrikes` int(11) DEFAULT '0',
  PRIMARY KEY (`ModID`,`UserID`),
  KEY `FK21` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_warning`
--

INSERT INTO `user_warning` (`ModID`, `UserID`, `NumStrikes`) VALUES
(1, 2, 2),
(1, 3, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`ArtistID`) REFERENCES `artist` (`ArtistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK2` FOREIGN KEY (`AdminWhoAddedID`) REFERENCES `admin` (`AdminID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `album_rating`
--
ALTER TABLE `album_rating`
  ADD CONSTRAINT `FK29` FOREIGN KEY (`AlbumName`) REFERENCES `album` (`AlbumName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK30` FOREIGN KEY (`ArtistID`) REFERENCES `album` (`ArtistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK31` FOREIGN KEY (`ByUserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `artist`
--
ALTER TABLE `artist`
  ADD CONSTRAINT `FK6` FOREIGN KEY (`AdminWhoAddedID`) REFERENCES `admin` (`AdminID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `artist_rating`
--
ALTER TABLE `artist_rating`
  ADD CONSTRAINT `FK24` FOREIGN KEY (`ArtistID`) REFERENCES `artist` (`ArtistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK25` FOREIGN KEY (`ByUserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flag`
--
ALTER TABLE `flag`
  ADD CONSTRAINT `FK22` FOREIGN KEY (`ModID`) REFERENCES `moderator` (`ModID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK23` FOREIGN KEY (`ReviewID`) REFERENCES `review` (`ReviewID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `following`
--
ALTER TABLE `following`
  ADD CONSTRAINT `FK7` FOREIGN KEY (`FollowerID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK8` FOREIGN KEY (`FolloweeID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `listened`
--
ALTER TABLE `listened`
  ADD CONSTRAINT `FK13` FOREIGN KEY (`SongName`) REFERENCES `song` (`SongName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK14` FOREIGN KEY (`ArtistID`) REFERENCES `song` (`ArtistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK15` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recommendation`
--
ALTER TABLE `recommendation`
  ADD CONSTRAINT `FK10` FOREIGN KEY (`ArtistID`) REFERENCES `song` (`ArtistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK11` FOREIGN KEY (`ByUserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK12` FOREIGN KEY (`ForUserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK9` FOREIGN KEY (`SongName`) REFERENCES `song` (`SongName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK16` FOREIGN KEY (`SongName`) REFERENCES `song` (`SongName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK17` FOREIGN KEY (`ArtistID`) REFERENCES `artist` (`ArtistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK18` FOREIGN KEY (`AlbumName`) REFERENCES `album` (`AlbumName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK19` FOREIGN KEY (`UserWhoWrote`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `FK3` FOREIGN KEY (`ArtistID`) REFERENCES `artist` (`ArtistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK4` FOREIGN KEY (`AlbumName`) REFERENCES `album` (`AlbumName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK5` FOREIGN KEY (`AdminWhoAddedID`) REFERENCES `admin` (`AdminID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `song_rating`
--
ALTER TABLE `song_rating`
  ADD CONSTRAINT `FK26` FOREIGN KEY (`SongName`) REFERENCES `song` (`SongName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK27` FOREIGN KEY (`ArtistID`) REFERENCES `song` (`ArtistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK28` FOREIGN KEY (`ByUserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_warning`
--
ALTER TABLE `user_warning`
  ADD CONSTRAINT `FK20` FOREIGN KEY (`ModID`) REFERENCES `moderator` (`ModID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK21` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
