/*
SQLyog - Free MySQL GUI v5.18
Host - 5.5.34 : Database - aplu_it_inventory
*********************************************************************
Server version : 5.5.34
*/

SET NAMES utf8;

SET SQL_MODE='';

create database if not exists `aplu_it_inventory`;

USE `aplu_it_inventory`;

SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';

/*Table structure for table `tbldepartment` */

DROP TABLE IF EXISTS `tbldepartment`;

CREATE TABLE `tbldepartment` (
  `iDepartmentID` int(11) NOT NULL AUTO_INCREMENT,
  `sDepartmentname` varchar(100) DEFAULT NULL,
  `iDepartmentheadID` int(11) DEFAULT NULL,
  PRIMARY KEY (`iDepartmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tbldepartment` */

insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`iDepartmentheadID`) values (1,'IT Department',5);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`iDepartmentheadID`) values (2,'Accounting',6);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`iDepartmentheadID`) values (3,'HR',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`iDepartmentheadID`) values (7,'CGA',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`iDepartmentheadID`) values (8,'STEAM',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`iDepartmentheadID`) values (9,'AG',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`iDepartmentheadID`) values (10,'Public Affairs',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`iDepartmentheadID`) values (11,'VSA',7);

/*Table structure for table `tbldepartmentemployee` */

DROP TABLE IF EXISTS `tbldepartmentemployee`;

CREATE TABLE `tbldepartmentemployee` (
  `iDepartEmpID` int(11) NOT NULL AUTO_INCREMENT,
  `iDepartmentID` int(11) DEFAULT NULL,
  `iEmployeeID` int(11) DEFAULT NULL,
  PRIMARY KEY (`iDepartEmpID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbldepartmentemployee` */

insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (2,9,4);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (3,2,5);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (4,7,6);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (5,1,7);

/*Table structure for table `tbldescription` */

DROP TABLE IF EXISTS `tbldescription`;

CREATE TABLE `tbldescription` (
  `iDescriptionID` int(11) NOT NULL AUTO_INCREMENT,
  `sDescription` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`iDescriptionID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbldescription` */

insert into `tbldescription` (`iDescriptionID`,`sDescription`) values (1,'OS');
insert into `tbldescription` (`iDescriptionID`,`sDescription`) values (2,'CPU Bit');
insert into `tbldescription` (`iDescriptionID`,`sDescription`) values (4,'(RAM)');

/*Table structure for table `tblemployee` */

DROP TABLE IF EXISTS `tblemployee`;

CREATE TABLE `tblemployee` (
  `iEmployeeID` int(11) NOT NULL AUTO_INCREMENT,
  `sFirstname` varchar(50) DEFAULT NULL,
  `sLastname` varchar(50) DEFAULT NULL,
  `sGender` varchar(10) DEFAULT NULL,
  `iBirthday` int(11) DEFAULT NULL,
  PRIMARY KEY (`iEmployeeID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tblemployee` */

insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`) values (4,'Jane','Doe','Female',912466800);
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`) values (5,'Roel','Barro','Male',662511600);
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`) values (6,'Jonh','Doe','Male',947372400);
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`) values (7,'Nathalie','Argueta','Female',0);

/*Table structure for table `tblhardware` */

DROP TABLE IF EXISTS `tblhardware`;

CREATE TABLE `tblhardware` (
  `iHardwareID` int(11) NOT NULL AUTO_INCREMENT,
  `sHardware` varchar(100) DEFAULT NULL,
  `sHardwareModel` varchar(100) DEFAULT NULL,
  `iHardwareBrandID` int(11) DEFAULT NULL,
  `iHardwareCategoryID` int(11) DEFAULT NULL,
  `sPropertyTag` varchar(100) DEFAULT NULL,
  `sNote` varchar(500) DEFAULT NULL,
  `bHasMultipleUser` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`iHardwareID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tblhardware` */

insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (1,'Dell PC 1','390',2,1,'741','sample Note',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (2,'Projector','TX612-3D',3,3,'661','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (3,'Dell PC','T1650',2,2,'560','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (4,'Dell PC','T1650',2,2,'559','',0);

/*Table structure for table `tblhardwarebrand` */

DROP TABLE IF EXISTS `tblhardwarebrand`;

CREATE TABLE `tblhardwarebrand` (
  `iHardwareBrandID` int(11) NOT NULL AUTO_INCREMENT,
  `sHardwareBrand` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`iHardwareBrandID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tblhardwarebrand` */

insert into `tblhardwarebrand` (`iHardwareBrandID`,`sHardwareBrand`) values (1,'HP');
insert into `tblhardwarebrand` (`iHardwareBrandID`,`sHardwareBrand`) values (2,'Dell');
insert into `tblhardwarebrand` (`iHardwareBrandID`,`sHardwareBrand`) values (3,'Optoma');

/*Table structure for table `tblhardwarecategory` */

DROP TABLE IF EXISTS `tblhardwarecategory`;

CREATE TABLE `tblhardwarecategory` (
  `iHardwareCategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `sHardwareCategory` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`iHardwareCategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tblhardwarecategory` */

insert into `tblhardwarecategory` (`iHardwareCategoryID`,`sHardwareCategory`) values (1,'Laptop');
insert into `tblhardwarecategory` (`iHardwareCategoryID`,`sHardwareCategory`) values (2,'Desktop');
insert into `tblhardwarecategory` (`iHardwareCategoryID`,`sHardwareCategory`) values (3,'Projector');
insert into `tblhardwarecategory` (`iHardwareCategoryID`,`sHardwareCategory`) values (4,'Printer');

/*Table structure for table `tblhardwaredepartment` */

DROP TABLE IF EXISTS `tblhardwaredepartment`;

CREATE TABLE `tblhardwaredepartment` (
  `iHardwareDepartmentID` int(11) NOT NULL AUTO_INCREMENT,
  `iHardwareID` int(11) DEFAULT NULL,
  `iDepartmentID` int(11) DEFAULT NULL,
  `iDateAssigned` int(11) DEFAULT NULL,
  `sNote` varchar(1000) DEFAULT NULL,
  `iUserID` int(11) DEFAULT NULL,
  PRIMARY KEY (`iHardwareDepartmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tblhardwaredepartment` */

insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sNote`,`iUserID`) values (1,2,8,1970,'',0);

/*Table structure for table `tblhardwaredescription` */

DROP TABLE IF EXISTS `tblhardwaredescription`;

CREATE TABLE `tblhardwaredescription` (
  `iHardwareDescriptionID` int(11) NOT NULL AUTO_INCREMENT,
  `iHardwareID` int(11) DEFAULT NULL,
  `iDescriptionID` int(11) DEFAULT NULL,
  `sValue` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`iHardwareDescriptionID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tblhardwaredescription` */

insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (1,3,1,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (2,3,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (3,3,4,'8');

/*Table structure for table `tblhardwareemployee` */

DROP TABLE IF EXISTS `tblhardwareemployee`;

CREATE TABLE `tblhardwareemployee` (
  `iHardwareEmployeeID` int(11) NOT NULL AUTO_INCREMENT,
  `iHardwareID` int(11) DEFAULT NULL,
  `iEmployeeID` int(11) DEFAULT NULL,
  `iDateAssigned` int(11) DEFAULT NULL,
  `sNote` varchar(1000) DEFAULT NULL,
  `iUserID` int(11) DEFAULT NULL,
  PRIMARY KEY (`iHardwareEmployeeID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tblhardwareemployee` */

insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (2,4,4,1970,'test 2',0);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (3,1,7,1970,'',0);

/*Table structure for table `tbluser` */

DROP TABLE IF EXISTS `tbluser`;

CREATE TABLE `tbluser` (
  `iUserID` int(11) NOT NULL AUTO_INCREMENT,
  `sUsername` varchar(50) DEFAULT NULL,
  `sPassword` varchar(50) DEFAULT NULL,
  `iEmployeeID` int(11) DEFAULT NULL,
  `iAccessLevel` int(11) DEFAULT NULL,
  PRIMARY KEY (`iUserID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbluser` */

insert into `tbluser` (`iUserID`,`sUsername`,`sPassword`,`iEmployeeID`,`iAccessLevel`) values (1,'admin','1qaz2wsx',1,1);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
