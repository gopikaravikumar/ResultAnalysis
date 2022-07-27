/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.5.8-log : Database - result-analysis
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`result-analysis` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `result-analysis`;

/*Table structure for table `acayear` */

DROP TABLE IF EXISTS `acayear`;

CREATE TABLE `acayear` (
  `yearid` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`yearid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `classadvisor` */

DROP TABLE IF EXISTS `classadvisor`;

CREATE TABLE `classadvisor` (
  `caid` int(11) NOT NULL AUTO_INCREMENT,
  `yearid` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `fid` int(11) DEFAULT NULL,
  PRIMARY KEY (`caid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `course` */

DROP TABLE IF EXISTS `course`;

CREATE TABLE `course` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) DEFAULT NULL,
  `course` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `department` */

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(30) DEFAULT NULL,
  `fid` int(11) DEFAULT '0',
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Table structure for table `exams` */

DROP TABLE IF EXISTS `exams`;

CREATE TABLE `exams` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `exam` varchar(100) DEFAULT NULL,
  `yearid` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `sem` varchar(10) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `examtype` varchar(20) DEFAULT 'Regular',
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `faculty` */

DROP TABLE IF EXISTS `faculty`;

CREATE TABLE `faculty` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `qual` varchar(50) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  `ftype` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `uname` varchar(30) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `utype` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Inactive',
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `studentresult` */

DROP TABLE IF EXISTS `studentresult`;

CREATE TABLE `studentresult` (
  `srid` int(11) NOT NULL AUTO_INCREMENT,
  `eid` int(11) DEFAULT NULL,
  `subid` int(11) DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  `examtype` varchar(15) DEFAULT NULL,
  `result` varchar(15) DEFAULT NULL,
  `status` varchar(15) DEFAULT 'Pending',
  PRIMARY KEY (`srid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `students` */

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `admno` varchar(10) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `yearid` int(11) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `sem` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `subject` */

DROP TABLE IF EXISTS `subject`;

CREATE TABLE `subject` (
  `subid` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `yearid` int(11) DEFAULT NULL,
  `sem` varchar(10) DEFAULT NULL,
  `subject` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`subid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
