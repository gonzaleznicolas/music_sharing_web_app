# Host: localhost  (Version 5.7.15-log)
# Date: 2016-11-10 17:02:30
# Generator: MySQL-Front 5.4  (Build 3.44)
# Internet: http://www.mysqlfront.de/

/*!40101 SET NAMES utf8 */;

#
# Structure for table "names"
#

DROP TABLE IF EXISTS `names`;
CREATE TABLE `names` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "names"
#

INSERT INTO `names` VALUES (1,'John'),(2,'John'),(3,'John'),(4,'John'),(5,'John');
