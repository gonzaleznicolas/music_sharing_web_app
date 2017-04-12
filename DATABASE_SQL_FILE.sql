-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2017 at 08:26 AM
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
(1, 'Ned', 'pass1'),
(2, 'Fred', 'pass2'),
(3, 'Ted', 'pass3');

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
('Back in Black', 5, 3, 1980, 687642, '2017-04-10'),
('Drake 2.0', 1, 2, 2012, 50000, '2012-10-09'),
('led zepellin one', 8, 1, 2000, 123465, '2017-04-12'),
('Morning View', 6, 1, 2001, 12345, '2017-04-10'),
('Rihannas First Album', 4, 1, 2005, 2147483647, '2017-04-10'),
('The Resistance', 3, 1, 2009, 100000, '2017-04-11'),
('Views', 1, 3, 2016, 34545, '2017-04-11');

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
('2005 mixtape', 2, 1, 5),
('The Resistance', 3, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE IF NOT EXISTS `artist` (
  `ArtistID` int(11) NOT NULL AUTO_INCREMENT,
  `AdminWhoAddedID` int(11) DEFAULT NULL,
  `StageName` varchar(25) DEFAULT NULL,
  `RealName` varchar(25) DEFAULT NULL,
  `AddedDate` date DEFAULT NULL,
  PRIMARY KEY (`ArtistID`),
  KEY `FK6` (`AdminWhoAddedID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`ArtistID`, `AdminWhoAddedID`, `StageName`, `RealName`, `AddedDate`) VALUES
(1, 1, 'Drake', 'Aubrey Graham', '2017-01-01'),
(2, 3, 'Eminem', 'Marshall Mathers', '2002-03-22'),
(3, 1, 'Muse', 'Muse', '2000-02-02'),
(4, 1, 'Rihanna', 'Robyn Rihanna', '2017-04-10'),
(5, 3, 'ACDC', 'ACDC', '2017-04-10'),
(6, 1, 'Incubus', 'Incubus', '2017-04-10'),
(7, 1, 'Maroon 5', '', '2017-04-12'),
(8, 1, 'Led Zepellin', '', '2017-04-12');

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
(1, 2, 2),
(2, 1, 3),
(3, 2, 5);

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
(1, 2),
(1, 19),
(1, 23),
(1, 34),
(1, 45),
(2, 38),
(2, 40);

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
(1, 2);

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
(1, 'Edward the moderator', 'pass1'),
(2, 'Jacobine - Moderator of D', 'pass2');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `recommendation`
--

INSERT INTO `recommendation` (`RecomID`, `SongName`, `ArtistID`, `ByUserID`, `ForUserID`, `Message`, `Date`) VALUES
(16, 'ubrella', 4, 1, 3, 'I think you like', NULL),
(17, 'Summer Time', 1, 3, 1, 'Yooo this song is so good! Listen to it man...', NULL),
(18, 'back in black', 5, 1, 4, 'listen to this!', NULL);

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
  `AlbumName` varchar(25) DEFAULT NULL,
  `UserWhoWrote` int(11) NOT NULL,
  PRIMARY KEY (`ReviewID`),
  KEY `FK16` (`SongName`),
  KEY `FK17` (`ArtistID`),
  KEY `FK18` (`AlbumName`),
  KEY `FK19` (`UserWhoWrote`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='If SongName and AlbumName are NULL, the review is about the artist. If only SongName is null, the review is about the album. if only album name is NULL, the review is about the song.' AUTO_INCREMENT=46 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`ReviewID`, `DatePosted`, `TimePosted`, `Content`, `SongName`, `ArtistID`, `AlbumName`, `UserWhoWrote`) VALUES
(2, '2017-04-09', '11:22:50', 'f**k s**t c**t. I''m an angry reviewer!', 'Back in Black', 5, NULL, 1),
(3, '1243-04-04', '03:55:00', 'Wow. Just wow. this artist is amazing', NULL, 2, NULL, 1),
(19, '2017-04-10', '12:04:47', 'Oh my gosh i have a huge crush on drakeeee', NULL, 1, 'Drake 2.0', 1),
(20, '2017-04-10', '12:13:24', 'THIS BAND IS SO COOL!!', NULL, 3, NULL, 1),
(23, '2017-04-10', '12:39:51', 'eminem is gud', NULL, 2, NULL, 1),
(33, '2017-04-11', '08:41:20', 'I think they are one of the greatest bands on earth', NULL, 3, NULL, 3),
(34, '1243-04-04', '03:55:00', 'I HATE THIS BAD F****', NULL, 2, NULL, 1),
(35, '2017-04-11', '09:50:00', 'Drake is quite good. Deserves his fame.', NULL, 1, NULL, 1),
(36, '2017-04-11', '09:56:33', 'Eminem is a rap god... Wish he would never retire!', NULL, 2, NULL, 1),
(37, '2017-04-11', '09:59:02', 'Eminem is a rap god... Wish he would never retire!', NULL, 2, NULL, 1),
(38, '2017-04-11', '10:01:14', 'eminem, bro, this album was a huge disappointment man. I HATE YOU', NULL, 2, '2005 mixtape', 2),
(39, '2017-04-11', '10:09:19', 'ACDC IS JUST AWFUL F***', NULL, 5, NULL, 2),
(40, '2017-04-11', '10:11:54', '**** **** ****!!!!!', 'Back in Black', 5, NULL, 2),
(41, '2017-04-11', '10:12:00', '**** **** ****!!!!!', 'Back in Black', 5, NULL, 2),
(42, '2017-04-11', '10:12:36', '**** **** ****!!!!!', 'Back in Black', 5, NULL, 2),
(43, '2017-04-12', '12:12:38', 'abcdef', 'back in black', 3, NULL, 4),
(44, '2017-04-12', '12:12:59', 'abcdef', 'back in black', 5, NULL, 4),
(45, '2017-04-12', '12:16:59', 'inappropriate', NULL, 1, NULL, 4);

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
('another song', 8, 'led zepellin one', 1, 'rock', 3, '2017-04-12'),
('Back in Black', 5, 'Back in Black', 3, 'Hard Rock', 342, '2017-04-10'),
('Controlla', 1, 'Views', 3, 'Rap', 342, '2017-04-11'),
('dazed and confused', 8, 'led zepellin one', 1, 'rock', 3, '2017-04-12'),
('Summer Time', 1, 'Views', 1, 'Rap', 235, '2017-04-11'),
('The Real Slim Shady', 2, '2005 mixtape', 2, 'Rap', 453, '2005-04-08'),
('Thunderstruck', 5, 'Back in Black', 3, 'Hard Rock', 453, '2017-04-10'),
('U With Me', 1, 'Views', 1, 'Rap', 987, '2017-04-11'),
('Ubrella', 4, 'Rihannas First Album', 1, 'Pop', 435, '2017-04-10'),
('You Shook me All Night Lo', 5, 'Back in Black', 1, 'Rock', 435, '2017-04-11');

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
('Back in Black', 5, 2, 3),
('Controlla', 1, 2, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `DOB`, `Name`, `Password`) VALUES
(1, '1864-10-09', 'Nicolas', 'pass1'),
(2, '1900-05-05', 'Brenton', 'pass2'),
(3, '1550-12-12', 'Sean', 'pass3'),
(4, '0000-00-00', 'Animesh', 'abc');

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
(1, 1, 4),
(1, 4, 1),
(2, 2, 2);

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
