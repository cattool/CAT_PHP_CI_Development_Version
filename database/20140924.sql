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
  `sLocation` varchar(50) DEFAULT NULL,
  `iDepartmentheadID` int(11) DEFAULT NULL,
  PRIMARY KEY (`iDepartmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `tbldepartment` */

insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`sLocation`,`iDepartmentheadID`) values (1,'MIS','APLU',5);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`sLocation`,`iDepartmentheadID`) values (2,'Accounting','APLU',6);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`sLocation`,`iDepartmentheadID`) values (3,'HR','APLU',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`sLocation`,`iDepartmentheadID`) values (7,'CGA','APLU',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`sLocation`,`iDepartmentheadID`) values (8,'STEAM','APLU',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`sLocation`,`iDepartmentheadID`) values (9,'AG','APLU',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`sLocation`,`iDepartmentheadID`) values (10,'Public Affairs','APLU',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`sLocation`,`iDepartmentheadID`) values (11,'VSA','APLU',7);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`sLocation`,`iDepartmentheadID`) values (12,'Pres','APLU',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`sLocation`,`iDepartmentheadID`) values (13,'Work Room','APLU',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`sLocation`,`iDepartmentheadID`) values (14,'OAA','APLU',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`sLocation`,`iDepartmentheadID`) values (15,'USU','APLU',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`sLocation`,`iDepartmentheadID`) values (16,'Receptionist Desk','APLU',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`sLocation`,`iDepartmentheadID`) values (17,'Finance','APLU',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`sLocation`,`iDepartmentheadID`) values (18,'OAS','APLU',0);
insert into `tbldepartment` (`iDepartmentID`,`sDepartmentname`,`sLocation`,`iDepartmentheadID`) values (19,'Int',NULL,22);

/*Table structure for table `tbldepartmentemployee` */

DROP TABLE IF EXISTS `tbldepartmentemployee`;

CREATE TABLE `tbldepartmentemployee` (
  `iDepartEmpID` int(11) NOT NULL AUTO_INCREMENT,
  `iDepartmentID` int(11) DEFAULT NULL,
  `iEmployeeID` int(11) DEFAULT NULL,
  PRIMARY KEY (`iDepartEmpID`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

/*Data for the table `tbldepartmentemployee` */

insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (3,2,5);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (5,11,7);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (6,2,8);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (7,2,9);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (8,11,10);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (9,9,11);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (10,12,12);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (11,19,13);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (12,10,14);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (13,10,15);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (14,14,16);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (15,9,17);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (16,15,18);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (17,12,19);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (18,9,20);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (19,8,21);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (20,19,22);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (21,11,23);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (22,8,24);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (23,2,25);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (24,7,26);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (25,11,27);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (26,14,28);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (27,12,29);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (28,19,30);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (29,14,31);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (30,10,32);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (31,7,33);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (32,8,34);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (33,9,35);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (34,13,36);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (35,7,37);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (36,12,38);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (37,15,39);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (38,12,40);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (39,16,41);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (41,7,43);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (42,7,44);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (43,10,45);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (44,8,46);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (45,2,47);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (46,9,48);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (47,9,49);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (48,11,50);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (49,9,51);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (50,7,52);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (51,8,53);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (52,15,54);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (53,8,55);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (54,2,56);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (55,19,57);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (56,7,58);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (57,15,59);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (58,1,60);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (59,10,61);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (60,8,62);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (61,17,63);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (62,8,64);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (63,2,65);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (64,18,66);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (66,1,67);
insert into `tbldepartmentemployee` (`iDepartEmpID`,`iDepartmentID`,`iEmployeeID`) values (70,19,71);

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
insert into `tbldescription` (`iDescriptionID`,`sDescription`) values (4,'RAM');

/*Table structure for table `tblemployee` */

DROP TABLE IF EXISTS `tblemployee`;

CREATE TABLE `tblemployee` (
  `iEmployeeID` int(11) NOT NULL AUTO_INCREMENT,
  `sFirstname` varchar(50) DEFAULT NULL,
  `sLastname` varchar(50) DEFAULT NULL,
  `sGender` varchar(10) DEFAULT NULL,
  `iBirthday` int(11) DEFAULT NULL,
  `sLocation` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`iEmployeeID`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

/*Data for the table `tblemployee` */

insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (7,'Nathalie','Argueta','Female',-3600,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (8,'KeiWanna','Beckett','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (9,'KeiAnna','Beckett','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (10,'Ann Ho','Becks','0',-3600,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (11,'Linda kay','Benning','0',-3600,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (12,'Barbara','Couture','0',-3600,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (13,'Tag','Demment','',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (14,'Meagan','Duff','0',-3600,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (15,'David','Edelson','0',-3600,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (16,'Christopher','Faulk','0',-3600,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (17,'Wendy','Fink','0',-3600,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (18,'Shari','Garmise','0',-3600,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (19,'Howard','Gobstein','0',-3600,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (20,'Eddie','Gouge','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (21,'Katherine','Hazelrigg','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (22,'Anne-Claire','Hervy','',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (23,'Teri Lynn','Hinds','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (24,'Nelea','Johnson','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (25,'Tanisha','Jones','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (26,'Shalin','Jyostishi','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (27,'Chirstine','Keller','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (28,'Samaad','Keys','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (29,'Sara','King','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (30,'Olivia','Nouaihetas-Ba','',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (31,'John','Lee','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (32,'Jeff','Lieberson','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (33,'Craig','Lindwarm','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (34,'Michael','Mastroianni','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (35,'Ian','Maw','0',-3600,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (36,'Christopher','Mayrant','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (37,'Kari','McCarron','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (38,'Peter','McPherson','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (39,'Julia','MIcheals','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (40,'Jean','Middleton','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (41,'Marcia','Moore','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (43,'Madeline','Nykaza','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (44,'Jennifer','Poulakidas','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (45,'Troy','Prestwood','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (46,'Kacy','Redd','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (47,'Marsha','Roberts','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (48,'Suzette','Robinson','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (49,'Sandy','Ruble','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (50,'Austin','Ryland','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (51,'Jane','Schuchardt','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (52,'Claire','Stieg','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (53,'Michael','Tanner','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (54,'Adrianne','Thomas','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (55,'Jim','Turner','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (56,'Emily','van Loon','0',-3600,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (57,'Mark','Varner','',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (58,'Ayoko','Vias','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (59,'Rebecca','Villarreal','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (60,'Paula','Villegas-Morera','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (61,'Alison','White','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (62,'Joyce','Williams','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (63,'Henry','Wong','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (64,'Jim','Woodell','0',-3600,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (65,'Tammy','Wyatt','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (66,'Carlos','Zelaya','0',0,'APLU');
insert into `tblemployee` (`iEmployeeID`,`sFirstname`,`sLastname`,`sGender`,`iBirthday`,`sLocation`) values (71,'Roel','Barro','',0,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=latin1;

/*Data for the table `tblhardware` */

insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (1,'Dell PC 1','390',2,1,'741','sample Note',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (3,'Dell PC','T1650',2,2,'560','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (4,'Dell PC','T1650',2,2,'559','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (8,'Dell','200',2,2,'672','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (9,'Lenovo','X1 Carbon',4,1,'4024','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (14,'Dell','380',2,2,'380','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (15,'Dell','380',2,2,'1011','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (16,'Dell','380',2,2,'755','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (19,'Default','380',2,2,'759','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (20,'Dell','380',2,2,'651','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (21,'Dell','7010',2,2,'4072','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (22,'Dell','7010',2,2,'4071','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (23,'Dell','7010',2,2,'4052','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (24,'Dell','7010',2,2,'4074','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (25,'Dell','7010',2,2,'7010','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (26,'Dell','380',2,2,'653','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (27,'Dell','390',2,2,'742','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (28,'Dell','380',2,2,'1016','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (29,'Dell','T1650',2,1,'554','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (30,'Dell','380',2,2,'571','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (31,'Dell','390',2,2,'4013','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (32,'Dell','390',2,2,'669','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (33,'Dell','T1650',2,1,'555','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (34,'Dell','380',2,2,'1015','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (35,'Dell','7010',2,2,'4061','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (36,'Dell','7010',2,2,'4067','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (37,'Dell','380',2,2,'760','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (38,'Dell','380',2,2,'575','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (39,'Dell','7010',2,2,'4070','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (40,'Dell','T1650',2,2,'557','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (41,'Dell','380',2,2,'652','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (42,'Dell','380',2,2,'1014','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (43,'Dell','380',2,2,'1','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (44,'Dell','T1650',2,2,'558','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (45,'Dell','380',2,2,'625','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (46,'Dell','380',2,2,'626','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (48,'Dell','380',2,2,'628','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (49,'Dell','390',2,2,'743','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (50,'Dell','T1650',2,2,'552','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (51,'Default','380',2,2,'578','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (52,'Dell','380',2,2,'429','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (53,'Dell','7010',2,2,'4076','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (54,'Default','380',2,2,'756','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (55,'Dell','380',2,2,'623','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (56,'Dell','7010',2,2,'4069','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (57,'Dell','380',2,2,'655','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (58,'Dell','7010',2,2,'4066','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (59,'Dell','T1650',2,2,'553','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (60,'Dell','7010',2,2,'4068','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (61,'Dell','380',2,2,'654','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (62,'Dell','380',2,2,'574','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (63,'Dell','380',2,2,'754','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (65,'Dell','380',2,2,'627','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (66,'Dell','T5400',2,1,'688','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (67,'Dell','7010',2,2,'4065','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (68,'Dell','7010',2,2,'4028','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (69,'Dell','360',2,1,'1004','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (70,'Dell','7010',2,2,'4073','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (73,'Default','200',2,2,'989','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (76,'Default','530',1,1,'681','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (77,'Default','530',1,1,'982','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (78,'Default','530',1,1,'683','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (79,'Default','530',1,1,'697','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (80,'Default','530',1,1,'700','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (81,'Default','530',1,1,'698','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (82,'Default','530',1,1,'696','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (83,'Default','4525',1,1,'577','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (84,'Default','45256',1,1,'635','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (85,'Default','4525',1,1,'635','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (86,'Default','4525',1,1,'636','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (87,'Default','4525',1,1,'634','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (88,'Default','DV4',1,1,'660','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (89,'Default','Dv4',1,1,'659','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (90,'Default','Dv4',1,1,'642','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (91,'Default','G60',1,1,'615','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (92,'Default','G60',1,1,'616','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (93,'Default','G60',1,1,'617','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (94,'Default','TX612-3D',3,3,'661','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (95,'Default','PJD5123',5,3,'663','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (96,'Default','H309A',6,3,'647','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (97,'Default','H309A',6,3,'646','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (98,'Default','XJ-S30',7,3,'985','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (99,'Default','XJ-S30',7,3,'986','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (100,'Default','PJ558D',5,3,'388','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (101,'Default','PJ558D',5,3,'389','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (103,'Default','TLP-T60M',8,3,'4021','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (104,'Default','H534A',6,3,'4007','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (105,'Default','H534A',6,3,'4062','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (106,'Default','H534A',6,3,'4063','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (107,'Default','H534A',6,3,'4064','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (108,'Default','3400MP',2,3,'978','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (109,'Default','2200',2,4,'929','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (110,'Default','3100',2,2,'980','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (111,'Default','3100',2,2,'970','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (112,'Default','4600',2,2,'454','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (113,'Default','E521',2,2,'437','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (114,'Default','Ljet 1006',1,4,'570','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (115,'Default','Ljet 1002',1,4,'4014','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (116,'Default','Ljet 1102',1,4,'4016','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (117,'Default','Ljet 1100',1,4,'568','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (118,'Default','Ljet 1102',1,4,'4017','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (119,'Default','Office Jet 100',1,4,'4001','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (120,'Default','Office Jet 100',1,4,'4002','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (121,'Default','Office Jet 100',1,4,'4018','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (122,'Default','Omni 120(All in 1)',1,2,'666','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (123,'Default','Omni 120 (All in 1)',1,2,'667','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (124,'Default','Omni 120 (All in 1)',1,2,'668','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (125,'Default','Power Edge 2600',2,2,'928','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (126,'Default','Power Edge 2900',2,2,'387','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (127,'Default','Power Edge 2900',2,2,'386','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (128,'Default','Power Edge 2900',2,2,'424','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (129,'Default','Power Edge 2900',2,2,'689','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (130,'Default','Power Edge 4400',2,2,'368','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (131,'Default','Power Edge SC1425',2,2,'710','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (132,'Default','Power Edge T420',2,2,'746','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (133,'Default','AMP01',2,4,'4022','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (134,'Default','AMP01',1,4,'4023','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (135,'Default','Jatheon ',9,4,'1017','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (136,'Default','Ljet 1102',1,4,'640','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (137,'Default','Super Micro',10,5,'869','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (138,'Default','4250',1,4,'719','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (139,'Default','Ljet 1320',1,4,'976','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (140,'Default','E521',2,4,'436','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (141,'Default','3100',2,4,'969','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (142,'Default','200',1,4,'988','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (143,'Default','5100',2,4,'964','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (144,'Default','200',2,4,'671','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (145,'Default','4700',2,4,'736','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (146,'Default','4600',2,4,'947','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (147,'Default','380',2,2,'1012','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (148,'Default','360',2,4,'428','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (149,'Default','360',2,2,'427','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (150,'Default','380',2,2,'572','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (151,'Default','390',2,2,'656','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (152,'Default','EliteBook 8440p',1,1,'4044','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (153,'Default','EliteBook 8440p',1,1,'4045','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (154,'Default','EliteBook 8440p',1,1,'4046','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (155,'Default','EliteBook 8440p',1,1,'4047','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (156,'Default','EliteBook 8440p',1,1,'4059','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (157,'Default','EliteBook 8440p',1,1,'4060','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (158,'Default','EliteBook 8440p',1,1,'4053','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (159,'Default','EliteBook 8440p',1,1,'4030','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (160,'Default','EliteBook 8440p',1,1,'4056','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (162,'Default','EliteBook 8440p',1,1,'4054','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (163,'Default','EliteBook 8440p',1,1,'4057','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (164,'Default','360',2,2,'687','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (165,'Default','360',2,2,'1003','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (167,'Default','200',2,2,'987','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (169,'Default','380',2,2,'630','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (170,'Default','380',2,2,'1013','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (171,'Default','360',2,2,'1005','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (172,'Default','Ljet 1102',2,4,'639','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (173,'Default','T1650',2,2,'556','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (174,'Default','360',2,2,'1002','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (175,'Default','360',2,2,'426','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (176,'Default','4250',1,4,'673','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (177,'Default','390',2,2,'579','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (178,'Default','380',2,2,'573','',0);
insert into `tblhardware` (`iHardwareID`,`sHardware`,`sHardwareModel`,`iHardwareBrandID`,`iHardwareCategoryID`,`sPropertyTag`,`sNote`,`bHasMultipleUser`) values (179,'Default','380',2,2,'624','',0);

/*Table structure for table `tblhardwarebrand` */

DROP TABLE IF EXISTS `tblhardwarebrand`;

CREATE TABLE `tblhardwarebrand` (
  `iHardwareBrandID` int(11) NOT NULL AUTO_INCREMENT,
  `sHardwareBrand` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`iHardwareBrandID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tblhardwarebrand` */

insert into `tblhardwarebrand` (`iHardwareBrandID`,`sHardwareBrand`) values (1,'HP');
insert into `tblhardwarebrand` (`iHardwareBrandID`,`sHardwareBrand`) values (2,'Dell');
insert into `tblhardwarebrand` (`iHardwareBrandID`,`sHardwareBrand`) values (3,'Optoma');
insert into `tblhardwarebrand` (`iHardwareBrandID`,`sHardwareBrand`) values (4,'Lenovo');
insert into `tblhardwarebrand` (`iHardwareBrandID`,`sHardwareBrand`) values (5,'View Sonic');
insert into `tblhardwarebrand` (`iHardwareBrandID`,`sHardwareBrand`) values (6,'Epson');
insert into `tblhardwarebrand` (`iHardwareBrandID`,`sHardwareBrand`) values (7,'Casio');
insert into `tblhardwarebrand` (`iHardwareBrandID`,`sHardwareBrand`) values (8,'Toshiba');
insert into `tblhardwarebrand` (`iHardwareBrandID`,`sHardwareBrand`) values (9,'Jatheon');
insert into `tblhardwarebrand` (`iHardwareBrandID`,`sHardwareBrand`) values (10,'Super Micro');

/*Table structure for table `tblhardwarecategory` */

DROP TABLE IF EXISTS `tblhardwarecategory`;

CREATE TABLE `tblhardwarecategory` (
  `iHardwareCategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `sHardwareCategory` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`iHardwareCategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tblhardwarecategory` */

insert into `tblhardwarecategory` (`iHardwareCategoryID`,`sHardwareCategory`) values (1,'Laptop');
insert into `tblhardwarecategory` (`iHardwareCategoryID`,`sHardwareCategory`) values (2,'Desktop');
insert into `tblhardwarecategory` (`iHardwareCategoryID`,`sHardwareCategory`) values (3,'Projector');
insert into `tblhardwarecategory` (`iHardwareCategoryID`,`sHardwareCategory`) values (4,'Printer');
insert into `tblhardwarecategory` (`iHardwareCategoryID`,`sHardwareCategory`) values (5,'Server');

/*Table structure for table `tblhardwaredepartment` */

DROP TABLE IF EXISTS `tblhardwaredepartment`;

CREATE TABLE `tblhardwaredepartment` (
  `iHardwareDepartmentID` int(11) NOT NULL AUTO_INCREMENT,
  `iHardwareID` int(11) DEFAULT NULL,
  `iDepartmentID` int(11) DEFAULT NULL,
  `iDateAssigned` int(11) DEFAULT NULL,
  `sHWLocation` varchar(100) DEFAULT NULL,
  `sNote` varchar(1000) DEFAULT NULL,
  `iUserID` int(11) DEFAULT NULL,
  PRIMARY KEY (`iHardwareDepartmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;

/*Data for the table `tblhardwaredepartment` */

insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (4,73,1,1408485600,'Kellogg Conference','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (5,77,1,1408485600,'MIS Laptop','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (6,76,1,1408485600,'MIS laptop','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (7,78,1,1408485600,'MIS Laptop','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (8,79,1,1408485600,'MIS laptop','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (9,80,1,1408485600,'MIS Laptop','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (10,81,1,1408485600,'Marsha Desk','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (11,82,1,1408485600,'MIS Laptop','Broken\\n\\n',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (12,83,1,1408485600,'MIS Laptop','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (13,84,1,1408485600,'MIS Laptop','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (14,86,1,1408485600,'MIS Laptop','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (15,87,1,1408485600,'MIS Laptop','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (16,88,1,1408485600,'MIS Laptop','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (17,89,1,1408485600,'MIS Laptop','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (18,90,1,1408485600,'MIS Laptop','Broken',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (19,91,1,1408485600,'MIS Laptop','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (20,92,1,1408485600,'MIS Laptop','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (21,94,1,1408485600,'MIS Projector','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (22,95,1,1408485600,'MIS Projector','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (23,96,1,1408485600,'MIS Projector','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (24,97,1,1408485600,'MIS Projector','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (25,98,1,1408485600,'MIS Projector','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (26,99,1,1408485600,'MIS Projector','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (27,100,1,1408485600,'MIS Projector','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (28,101,1,1408485600,'MIS Projector','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (29,103,1,1408485600,'MIS Projector','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (30,104,1,1408485600,'MIS Projector','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (31,105,1,1408485600,'MIS Projector','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (32,106,1,1408485600,'MIS Projector','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (33,107,1,1408485600,'MIS Projector','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (34,108,1,1408485600,'MIS Projector','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (35,174,1,1408485600,'CGA Area','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (36,173,1,1408485600,'STEM Area','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (37,175,1,1408485600,'WorkRoom','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (38,172,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (39,109,1,1408485600,'WorkRoom','NASULGC 5',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (40,110,1,1408485600,'Henry Office','Consultant',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (41,111,1,1408485600,'Henry Office','Patrick',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (42,112,1,1408485600,'WorkRoom','BK Server',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (43,113,1,1408485600,'WorkRoom','APLU 8',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (44,114,1,1408485600,'Printer/CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (45,115,1,1408485600,'Printer/CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (46,116,1,1408485600,'Printer/CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (47,117,1,1408485600,'Printer/CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (48,118,1,1408485600,'Printer/CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (49,119,1,1408485600,'Printer/CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (50,120,1,1408485600,'Printer/CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (51,121,1,1408485600,'Printer/CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (52,122,1,1408485600,'Receptionist Desk','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (53,123,1,1408485600,'Receptionist Desk','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (54,124,1,1408485600,'Receptionist Desk','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (55,125,1,1408485600,'CPU Room','NASULGC 4',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (56,126,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (57,127,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (58,128,1,1408485600,'CPU Room','APLU 2',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (59,129,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (60,130,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (61,131,1,1408485600,'CPU Room','NASULGC 3',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (62,132,1,1408485600,'Henry Office','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (63,133,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (67,134,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (68,135,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (69,136,1,1408485600,'Printer/CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (70,137,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (71,176,1,1408485600,'AG Area','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (72,138,1,1408485600,'AG Area','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (73,139,1,1408485600,'ACCT Area','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (74,140,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (75,141,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (76,142,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (77,143,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (78,144,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (79,145,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (80,146,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (81,147,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (82,148,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (83,149,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (84,150,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (85,151,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (86,152,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (87,153,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (88,154,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (89,155,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (90,156,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (91,157,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (92,158,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (93,159,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (94,160,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (95,162,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (96,163,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (97,164,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (98,165,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (99,166,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (100,167,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (101,168,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (102,169,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (103,170,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (104,171,1,1408485600,'CPU Room','',1);
insert into `tblhardwaredepartment` (`iHardwareDepartmentID`,`iHardwareID`,`iDepartmentID`,`iDateAssigned`,`sHWLocation`,`sNote`,`iUserID`) values (105,85,1,1408485600,'MIS Laptop','',1);

/*Table structure for table `tblhardwaredescription` */

DROP TABLE IF EXISTS `tblhardwaredescription`;

CREATE TABLE `tblhardwaredescription` (
  `iHardwareDescriptionID` int(11) NOT NULL AUTO_INCREMENT,
  `iHardwareID` int(11) DEFAULT NULL,
  `iDescriptionID` int(11) DEFAULT NULL,
  `sValue` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`iHardwareDescriptionID`)
) ENGINE=InnoDB AUTO_INCREMENT=376 DEFAULT CHARSET=latin1;

/*Data for the table `tblhardwaredescription` */

insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (2,3,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (4,34,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (5,4,1,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (6,19,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (7,15,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (8,16,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (9,17,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (10,18,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (12,20,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (13,21,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (14,70,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (15,23,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (16,24,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (17,22,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (18,22,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (19,4,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (20,4,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (21,19,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (22,19,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (23,15,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (25,34,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (26,34,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (27,15,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (28,16,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (29,16,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (30,17,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (31,17,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (32,18,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (33,18,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (37,20,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (38,20,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (39,25,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (40,25,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (41,25,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (54,14,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (55,14,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (56,14,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (57,71,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (58,71,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (59,71,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (60,28,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (61,28,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (62,28,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (63,29,1,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (64,29,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (65,29,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (66,30,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (67,30,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (68,30,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (69,31,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (70,31,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (71,31,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (72,32,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (73,32,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (74,32,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (75,33,1,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (76,33,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (77,33,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (81,35,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (82,35,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (83,35,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (84,36,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (85,36,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (86,36,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (87,37,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (88,37,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (89,37,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (90,38,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (91,38,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (92,38,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (93,39,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (94,39,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (95,39,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (96,40,1,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (97,40,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (98,40,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (99,41,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (100,41,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (101,41,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (102,42,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (103,42,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (104,42,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (105,43,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (106,43,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (107,43,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (108,44,1,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (109,44,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (110,44,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (111,45,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (112,45,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (113,45,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (114,46,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (115,46,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (116,46,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (117,47,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (118,47,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (119,47,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (120,48,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (121,48,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (122,48,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (123,49,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (124,49,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (125,49,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (126,50,1,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (127,50,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (128,50,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (129,51,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (131,51,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (132,51,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (133,52,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (134,52,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (135,52,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (136,53,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (137,53,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (138,53,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (139,54,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (140,54,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (141,54,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (142,55,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (143,55,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (144,55,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (145,56,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (146,56,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (147,56,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (148,57,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (149,57,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (150,57,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (151,58,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (152,58,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (153,58,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (154,59,1,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (155,59,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (156,59,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (157,60,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (158,60,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (159,60,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (160,61,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (161,61,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (162,61,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (163,62,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (164,62,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (165,62,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (166,63,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (167,63,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (168,63,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (172,65,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (173,65,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (174,65,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (175,66,1,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (176,66,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (177,66,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (178,67,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (179,67,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (180,67,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (181,68,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (182,68,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (183,68,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (184,69,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (185,69,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (186,69,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (188,22,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (189,1,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (190,1,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (191,1,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (192,3,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (193,3,1,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (194,8,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (195,8,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (196,8,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (197,9,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (198,9,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (199,9,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (200,177,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (201,177,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (202,177,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (203,21,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (204,21,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (205,70,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (206,70,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (207,23,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (208,23,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (209,24,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (210,24,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (211,26,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (212,26,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (213,26,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (214,27,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (215,27,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (216,27,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (217,173,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (218,173,1,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (219,173,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (220,151,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (221,151,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (222,151,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (223,73,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (224,73,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (225,73,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (226,77,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (227,77,4,'1');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (228,77,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (229,76,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (230,76,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (231,76,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (232,78,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (233,78,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (234,78,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (235,79,4,'1');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (236,79,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (237,79,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (238,80,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (239,80,4,'1');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (240,80,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (241,81,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (242,81,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (243,81,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (244,82,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (245,82,4,'1');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (246,82,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (247,83,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (248,83,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (249,83,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (250,84,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (251,84,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (252,84,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (253,86,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (254,86,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (255,86,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (256,87,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (257,87,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (258,87,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (259,88,4,'3');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (260,88,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (261,88,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (262,89,4,'3');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (263,89,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (264,89,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (265,90,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (266,90,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (267,90,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (268,91,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (269,91,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (270,91,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (271,92,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (272,92,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (273,92,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (274,93,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (275,93,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (276,93,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (278,174,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (279,174,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (280,174,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (281,175,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (282,110,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (283,111,1,'XP');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (284,122,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (285,122,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (286,122,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (287,123,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (288,123,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (289,123,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (290,124,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (291,124,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (292,124,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (293,125,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (294,125,1,'2003');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (295,126,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (296,126,1,'2003');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (297,127,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (298,127,1,'2003');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (299,128,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (300,128,1,'2008');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (301,129,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (302,129,1,'2008');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (303,130,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (304,130,1,'2003');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (305,131,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (306,131,1,'2003');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (307,132,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (308,132,1,'2008');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (309,137,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (310,137,1,'2003');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (311,147,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (312,147,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (313,149,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (314,149,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (315,149,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (316,150,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (317,150,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (318,150,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (319,152,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (320,152,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (321,152,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (322,153,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (323,153,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (324,153,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (325,154,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (326,154,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (327,154,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (328,155,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (329,155,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (330,155,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (331,156,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (332,156,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (333,156,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (334,157,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (335,157,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (336,157,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (337,158,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (338,158,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (339,158,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (340,159,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (341,159,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (342,159,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (343,160,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (344,160,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (345,160,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (346,162,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (347,162,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (348,162,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (349,163,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (350,163,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (351,163,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (352,164,4,'6');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (353,164,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (354,164,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (355,165,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (356,165,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (357,165,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (358,167,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (359,167,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (360,167,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (361,169,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (362,169,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (363,169,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (364,170,4,'8');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (365,170,2,'64');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (366,170,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (367,171,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (368,171,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (369,171,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (370,178,4,'2');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (371,178,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (372,178,2,'32');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (373,179,4,'4');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (374,179,1,'7');
insert into `tblhardwaredescription` (`iHardwareDescriptionID`,`iHardwareID`,`iDescriptionID`,`sValue`) values (375,179,2,'32');

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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

/*Data for the table `tblhardwareemployee` */

insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (3,1,7,1408485600,'test',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (4,3,8,1389135600,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (5,4,9,1408485600,'test',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (6,19,10,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (7,15,11,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (8,16,12,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (9,8,13,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (10,9,14,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (11,20,16,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (12,21,17,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (13,70,18,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (14,23,19,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (15,24,20,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (16,22,21,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (17,26,22,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (18,27,23,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (19,28,24,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (20,29,25,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (21,30,26,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (22,31,27,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (23,32,28,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (24,173,29,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (25,34,30,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (26,35,31,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (27,36,32,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (28,37,33,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (29,38,34,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (30,39,35,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (31,40,36,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (32,41,37,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (33,42,38,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (34,43,39,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (35,44,40,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (36,45,41,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (37,46,43,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (38,151,44,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (39,48,45,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (40,49,46,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (41,50,47,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (42,51,48,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (43,52,49,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (44,53,50,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (45,54,51,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (46,55,52,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (47,56,53,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (48,57,54,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (49,58,55,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (50,59,56,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (51,60,57,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (52,61,58,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (53,62,59,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (54,63,60,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (55,33,61,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (56,65,62,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (57,66,63,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (58,67,64,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (59,68,65,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (60,69,66,1970,'',1);
insert into `tblhardwareemployee` (`iHardwareEmployeeID`,`iHardwareID`,`iEmployeeID`,`iDateAssigned`,`sNote`,`iUserID`) values (63,177,15,-3600,'',1);

/*Table structure for table `tbluser` */

DROP TABLE IF EXISTS `tbluser`;

CREATE TABLE `tbluser` (
  `iUserID` int(11) NOT NULL AUTO_INCREMENT,
  `sUsername` varchar(50) DEFAULT NULL,
  `sPassword` varchar(50) DEFAULT NULL,
  `iEmployeeID` int(11) DEFAULT NULL,
  `iAccessLevel` int(11) DEFAULT NULL,
  PRIMARY KEY (`iUserID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbluser` */

insert into `tbluser` (`iUserID`,`sUsername`,`sPassword`,`iEmployeeID`,`iAccessLevel`) values (1,'admin','1qaz2wsx',63,1);
insert into `tbluser` (`iUserID`,`sUsername`,`sPassword`,`iEmployeeID`,`iAccessLevel`) values (2,'roel','pogi',71,1);
insert into `tbluser` (`iUserID`,`sUsername`,`sPassword`,`iEmployeeID`,`iAccessLevel`) values (3,'test','test',7,2);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
