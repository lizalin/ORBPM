-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.7.29


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema ORBPM_devdb
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ ORBPM_devdb;
USE ORBPM_devdb;

--
-- Table structure for table `ORBPM_devdb`.`m_admin_global_menu`
--

DROP TABLE IF EXISTS `m_admin_global_menu`;
CREATE TABLE `m_admin_global_menu` (
  `INT_ADMIN_GL_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VCH_GL_NAME` varchar(45) DEFAULT NULL,
  `INT_PERMISSION` int(10) unsigned DEFAULT NULL,
  `INT_DELETED_FLAG` int(10) unsigned DEFAULT '0',
  `VCH_IMAGE` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`INT_ADMIN_GL_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`m_admin_global_menu`
--

/*!40000 ALTER TABLE `m_admin_global_menu` DISABLE KEYS */;
INSERT INTO `m_admin_global_menu` (`INT_ADMIN_GL_ID`,`VCH_GL_NAME`,`INT_PERMISSION`,`INT_DELETED_FLAG`,`VCH_IMAGE`) VALUES 
 (1,'Manage User',NULL,1,'fa-user'),
 (2,'Manage Link',NULL,0,'fa-chain'),
 (3,'Content Management',NULL,1,'menuContMgmtIcon.png'),
 (4,'Manage Application',NULL,0,'fa-cog'),
 (5,'Manage Contact',NULL,1,'fa-phone');
/*!40000 ALTER TABLE `m_admin_global_menu` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`m_admin_primary_menu`
--

DROP TABLE IF EXISTS `m_admin_primary_menu`;
CREATE TABLE `m_admin_primary_menu` (
  `INT_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `INT_ADMIN_GL_ID` int(10) unsigned NOT NULL,
  `VCH_PL_NAME` varchar(128) NOT NULL,
  `INT_DELETED_FLAG` int(10) unsigned DEFAULT '0',
  `VCH_URL` varchar(100) DEFAULT NULL,
  `INT_ADMIN_PL_ID` int(10) unsigned NOT NULL,
  `VCH_RELATED_PAGES` varchar(500) DEFAULT NULL,
  `INT_FUNCTION_ID` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`INT_ID`) USING BTREE,
  KEY `FK_m_admin_primary_menu_1` (`INT_ADMIN_GL_ID`),
  CONSTRAINT `FK_m_admin_primary_menu_1` FOREIGN KEY (`INT_ADMIN_GL_ID`) REFERENCES `m_admin_global_menu` (`INT_ADMIN_GL_ID`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`m_admin_primary_menu`
--

/*!40000 ALTER TABLE `m_admin_primary_menu` DISABLE KEYS */;
INSERT INTO `m_admin_primary_menu` (`INT_ID`,`INT_ADMIN_GL_ID`,`VCH_PL_NAME`,`INT_DELETED_FLAG`,`VCH_URL`,`INT_ADMIN_PL_ID`,`VCH_RELATED_PAGES`,`INT_FUNCTION_ID`) VALUES 
 (1,4,'Tender',0,'viewTender',6,'addTender.php,viewTender.php,addendumTender.php,corrigendumTender.php',3),
 (3,2,'Pages',0,'viewPage',1,'addPage.php,viewPage.php',0),
 (4,2,'Manage Menu',0,'addGL',2,'addGL.php',0),
 (8,4,'Manage Gallery',0,'viewGallery',4,'addGallery.php,viewGallery.php,archieveGallery.php',15),
 (10,4,'Important Links',0,'viewLink',5,'addLink.php,viewLink.php,archieveLink.php',0),
 (11,4,'Feedback',0,'feedback',9,'feedback.php',10),
 (23,4,'Location',0,'viewLocation',1,'addLocation.php,viewLocation.php',0),
 (24,1,'Department',0,'viewDepartment',2,'addDepartment.php,viewDepartment.php',0),
 (25,1,'Designation',0,'viewDesignation',3,'addDesignation.php,viewDesignation.php',0),
 (26,1,'User Profile',0,'viewUser',4,'addUser.php,viewUser.php',0),
 (27,1,'Set Permission',0,'setPermission',5,'',0),
 (30,4,'Former Officer Profile ',0,'viewProfile',13,'addProfile.php,viewProfile.php',0),
 (34,4,'Services',0,'viewImpServices',17,'addImpServices.php,viewImpServices.php,archieveImpServices.php',0);
INSERT INTO `m_admin_primary_menu` (`INT_ID`,`INT_ADMIN_GL_ID`,`VCH_PL_NAME`,`INT_DELETED_FLAG`,`VCH_URL`,`INT_ADMIN_PL_ID`,`VCH_RELATED_PAGES`,`INT_FUNCTION_ID`) VALUES 
 (43,4,'Manage Governer Officers',0,'viewOfficers',14,NULL,0),
 (44,4,'Manage Banner',0,'viewBanner',2,'addBanner.php,viewBanner.php',0);
/*!40000 ALTER TABLE `m_admin_primary_menu` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`m_circular_master`
--

DROP TABLE IF EXISTS `m_circular_master`;
CREATE TABLE `m_circular_master` (
  `intmId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intCircularId` int(10) unsigned NOT NULL DEFAULT '1',
  `vchCirculaName` varchar(64) DEFAULT NULL,
  `dtmCreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bitDeleteflag` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`intmId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`m_circular_master`
--

/*!40000 ALTER TABLE `m_circular_master` DISABLE KEYS */;
INSERT INTO `m_circular_master` (`intmId`,`intCircularId`,`vchCirculaName`,`dtmCreatedOn`,`bitDeleteflag`) VALUES 
 (1,1,'Gazette Notification','0000-00-00 00:00:00',0),
 (2,1,'TC\'S Circular','2016-10-19 15:00:54',0),
 (3,1,'Route Vacancy','2016-10-19 15:00:54',0),
 (4,1,'New Applied Routes','0000-00-00 00:00:00',0),
 (5,1,'Fitment Of Speed Governor','2016-10-25 09:35:59',0);
/*!40000 ALTER TABLE `m_circular_master` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`m_department_master`
--

DROP TABLE IF EXISTS `m_department_master`;
CREATE TABLE `m_department_master` (
  `INT_DEPARTMENT_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `INT_LOCATION_ID` int(10) unsigned NOT NULL,
  `VCH_DEPARTMENT_NAME` varchar(45) NOT NULL,
  `TXT_DEPARTMENT_NAME_O` text,
  `VCH_DESCRIPTION` varchar(500) DEFAULT NULL,
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `INT_CREATED_BY` int(10) unsigned DEFAULT NULL,
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `INT_UPDATED_BY` int(10) unsigned DEFAULT NULL,
  `BIT_DELETED_FLAG` bit(1) NOT NULL DEFAULT b'0',
  `INT_PREVILIGE_STATUS` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`INT_DEPARTMENT_ID`),
  KEY `IDX_DEPT_LOC_ID` (`INT_LOCATION_ID`),
  KEY `IDX_DEPT_NAME` (`VCH_DEPARTMENT_NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`m_department_master`
--

/*!40000 ALTER TABLE `m_department_master` DISABLE KEYS */;
INSERT INTO `m_department_master` (`INT_DEPARTMENT_ID`,`INT_LOCATION_ID`,`VCH_DEPARTMENT_NAME`,`TXT_DEPARTMENT_NAME_O`,`VCH_DESCRIPTION`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PREVILIGE_STATUS`) VALUES 
 (1,2,'Education','','Education department','2015-09-10 17:52:36',1,'2015-09-10 18:01:30',1,'\0',0),
 (2,3,'Business Solutions Services','','','2015-09-14 17:26:47',1,NULL,NULL,'\0',0),
 (3,3,'PRODUCTION','','PRODUCTION\r\nPRODUCTION','2015-09-23 12:54:35',1,'2015-09-23 12:55:29',1,'',0);
/*!40000 ALTER TABLE `m_department_master` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`m_dir_category`
--

DROP TABLE IF EXISTS `m_dir_category`;
CREATE TABLE `m_dir_category` (
  `intcatId` int(11) NOT NULL AUTO_INCREMENT,
  `vchcatName` varchar(64) NOT NULL,
  `stmCreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dtmUpdatedOn` datetime DEFAULT NULL,
  `intCreatedBy` int(11) NOT NULL,
  `intUpdatedBy` int(11) DEFAULT NULL,
  `bitDeletedFlag` bit(1) NOT NULL DEFAULT b'0',
  `intSlNo` int(11) unsigned DEFAULT NULL,
  `intPublishStatus` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`intcatId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`m_dir_category`
--

/*!40000 ALTER TABLE `m_dir_category` DISABLE KEYS */;
INSERT INTO `m_dir_category` (`intcatId`,`vchcatName`,`stmCreatedOn`,`dtmUpdatedOn`,`intCreatedBy`,`intUpdatedBy`,`bitDeletedFlag`,`intSlNo`,`intPublishStatus`) VALUES 
 (2,'COMMERCE AND TRANSPORT DEPARTMENT','2016-06-03 16:24:59','2017-08-29 16:57:06',1,0,'\0',2,2),
 (3,'TRANSPORT COMMISSIONERATE ','2016-06-03 16:26:15','2017-08-29 16:57:06',1,0,'\0',3,2),
 (4,'ZONAL OFFICES','2016-06-07 15:39:26','2017-08-29 16:57:06',1,0,'\0',4,2),
 (5,'REGIONAL TRANSPORT OFFICES','2016-06-07 15:39:26','2017-08-29 16:57:06',1,0,'\0',5,2);
/*!40000 ALTER TABLE `m_dir_category` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`m_district`
--

DROP TABLE IF EXISTS `m_district`;
CREATE TABLE `m_district` (
  `intDistrictid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vchDistrictname` varchar(128) NOT NULL,
  `stmCreatedOn` datetime NOT NULL,
  `bitDeletedflag` bit(1) NOT NULL DEFAULT b'0',
  `vchDistrictnameO` varchar(256) DEFAULT NULL,
  `intCreatedby` int(10) DEFAULT NULL,
  `dtmUpdatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `intUpdatedBy` int(10) DEFAULT NULL,
  `tinPublishStatus` tinyint(3) NOT NULL DEFAULT '1',
  `vchDescription` varchar(512) DEFAULT NULL,
  `vchDescriptionO` text,
  `vchSvgcx` varchar(16) DEFAULT NULL,
  `vchSvgcy` varchar(16) DEFAULT NULL,
  `vchSvgTransform` varchar(64) DEFAULT NULL,
  `vchNearDists` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`intDistrictid`),
  KEY `IDX_NEARDIST` (`vchNearDists`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ORBPM_devdb`.`m_district`
--

/*!40000 ALTER TABLE `m_district` DISABLE KEYS */;
INSERT INTO `m_district` (`intDistrictid`,`vchDistrictname`,`stmCreatedOn`,`bitDeletedflag`,`vchDistrictnameO`,`intCreatedby`,`dtmUpdatedOn`,`intUpdatedBy`,`tinPublishStatus`,`vchDescription`,`vchDescriptionO`,`vchSvgcx`,`vchSvgcy`,`vchSvgTransform`,`vchNearDists`) VALUES 
 (3,'Angul','2016-09-02 12:20:59','\0','à¬…à¬¨à­à¬—à­‹à¬³',0,'2016-09-21 15:14:06',1,1,'','','348.7','152.8','matrix(1 0 0 1 343 155)','10,30,8,11,31'),
 (4,'Balasore','2016-09-02 12:21:41','\0','à¬¬à¬¾à¬²à­‡à¬¶à­à¬¬à¬°',0,'2016-09-21 15:14:06',1,1,'','','520.1','131.5','matrix(1 0 0 1 515 134)','24,6,20'),
 (5,'Bargarh','2016-09-02 12:21:32','\0','à¬¬à¬°à¬—à¬¡',0,'2016-09-21 15:14:06',1,1,'','','221.3','113.5','matrix(1 0 0 1 216 116)','27,7,31,30,16'),
 (6,'Bhadrak','2016-09-02 12:21:49','\0','à¬­à¬¦à­à¬°à¬•',0,'2016-09-21 15:14:06',1,1,'','','495','153.7','matrix(1 0 0 1 490 156)','15,19,4,20'),
 (7,'Bolangir','2016-09-02 12:21:22','\0','à¬¬à¬²à¬¾à¬™à­à¬—à­€à¬°',0,'2016-09-21 15:14:06',1,1,'','','188.3','212.9','matrix(1 0 0 1 183 215)','27,31,17,5'),
 (8,'Boudh','2016-09-02 12:21:13','\0','à¬¬à­Œà¬¦à­à¬§',0,'2016-09-21 15:14:06',1,1,'','','314.8','200.4','matrix(1 0 0 1 309 203)','3,5,31,22');
INSERT INTO `m_district` (`intDistrictid`,`vchDistrictname`,`stmCreatedOn`,`bitDeletedflag`,`vchDistrictnameO`,`intCreatedby`,`dtmUpdatedOn`,`intUpdatedBy`,`tinPublishStatus`,`vchDescription`,`vchDescriptionO`,`vchSvgcx`,`vchSvgcy`,`vchSvgTransform`,`vchNearDists`) VALUES 
 (9,'Cuttack','2016-09-02 12:21:57','\0','à¬•à¬Ÿà¬•',0,'2016-09-21 15:14:06',1,1,'','','410.8','215.8','matrix(1 0 0 1 405 218)','15,19,14,21,11,26'),
 (10,'Deogarh','2016-09-02 12:22:05','\0','à¬¦à­‡à¬“à¬—à¬¡',0,'2016-09-21 15:14:06',1,1,'','','326.2','97.5','matrix(1 0 0 1 321 100)','30,3,5,32'),
 (11,'Dhenkanal','2016-09-02 12:22:14','\0','à¬¢à­‡à¬™à­à¬•à¬¾à¬¨à¬¾à¬³',0,'2016-09-21 15:14:06',1,1,'','','408.8','160','matrix(1 0 0 1 403 163)','15,9,3,20'),
 (12,'Gajapati','2016-09-02 12:22:31','\0','à¬—à¬œà¬ªà¬¤à¬¿',0,'2016-09-21 15:14:06',1,1,'','','285.9','339.1','matrix(1 0 0 1 280 342)','13,29,18'),
 (13,'Ganjam','2016-09-02 12:22:22','\0','à¬—à¬žà­à¬œà¬¾à¬®',0,'2016-09-21 15:14:06',1,1,'','','333.3','270.6','matrix(1 0 0 1 328 273)','12,5,18,22,21'),
 (14,'Jagatsinghpur','2016-09-02 12:23:02','\0','à¬œà¬—à¬¤à¬¸à¬¿à¬‚à¬ªà­à¬°',0,'2016-09-21 15:14:06',1,1,'','','478.6','228.1','matrix(1 0 0 1 473 231)','19,9,21,28');
INSERT INTO `m_district` (`intDistrictid`,`vchDistrictname`,`stmCreatedOn`,`bitDeletedflag`,`vchDistrictnameO`,`intCreatedby`,`dtmUpdatedOn`,`intUpdatedBy`,`tinPublishStatus`,`vchDescription`,`vchDescriptionO`,`vchSvgcx`,`vchSvgcy`,`vchSvgTransform`,`vchNearDists`) VALUES 
 (15,'Jajpur','2016-09-02 12:22:51','\0','à¬¯à¬¾à¬œà¬ªà­à¬°',0,'2016-09-21 15:14:06',1,1,'','','462.5','165.3','matrix(1 0 0 1 457 168)','20,6,19,9'),
 (16,'Jharsuguda','2016-09-02 12:22:40','\0','à¬à¬¾à¬°à¬¸à­à¬—à­à¬¡à¬¾',0,'2016-09-21 15:14:06',1,1,'','','243.5','88','matrix(1 0 0 1 238 91)','32,30,5'),
 (17,'Kalahandi','2016-09-02 12:49:25','\0','à¬•à¬³à¬¾à¬¹à¬¾à¬£à­à¬¡à¬¿',0,'2016-09-21 15:14:06',1,1,'','','153.8','290.2','matrix(1 0 0 1 148 293)','25,29,27,7'),
 (18,'Kandhamal','2016-09-02 12:49:35','\0','à¬•à¬¨à­à¬§à¬®à¬¾à¬³',0,'2016-09-21 15:14:06',1,1,'','','259.4','267.6','matrix(1 0 0 1 254 270)','8,26,13,12,29,17'),
 (19,'Kendrapara','2016-09-02 12:49:57','\0','à¬•à­‡à¬¨à­à¬¦à­à¬°à¬¾à¬ªà¬¡à¬¾',0,'2016-09-21 15:14:06',1,1,'','','507.9','214.9','matrix(1 0 0 1 502 217)','6,15,14,9');
INSERT INTO `m_district` (`intDistrictid`,`vchDistrictname`,`stmCreatedOn`,`bitDeletedflag`,`vchDistrictnameO`,`intCreatedby`,`dtmUpdatedOn`,`intUpdatedBy`,`tinPublishStatus`,`vchDescription`,`vchDescriptionO`,`vchSvgcx`,`vchSvgcy`,`vchSvgTransform`,`vchNearDists`) VALUES 
 (20,'Keonjhar','2016-09-02 12:23:21','\0','à¬•à­‡à¬¨à­à¬¦à­à¬à¬°',0,'2016-09-21 15:14:06',1,1,'','','418.1','80.7','matrix(1 0 0 1 413 83)','32,3,11,15,6,24'),
 (21,'Khurdha','2016-09-02 12:23:11','\0','à¬–à­‹à¬°à­à¬¦à­à¬§à¬¾',0,'2016-09-21 15:14:06',1,1,'','','412.4','251.5','matrix(1 0 0 1 407 254)','28,14,9,26'),
 (22,'Koraput','2016-09-02 12:49:46','\0','à¬•à­‹à¬°à¬¾à¬ªà­à¬Ÿ',0,'2016-09-21 15:14:06',1,1,'','','141.3','356.6','matrix(1 0 0 1 136 359)','29,25,17,23'),
 (23,'Malkangiri','2016-09-02 12:50:08','\0','à¬®à¬¾à¬²à¬•à¬¾à¬¨à¬—à¬¿à¬°à¬¿',0,'2016-09-21 15:14:06',1,1,'','','36.7','452.1','matrix(1 0 0 1 31 455)','22'),
 (24,'Mayurbhanj','2016-09-02 12:50:17','\0','à¬®à­Ÿà­à¬°à¬­à¬žà­à¬œ',0,'2016-09-21 15:14:06',1,1,'','','490.2','49.5','matrix(1 0 0 1 485 52)','4,20');
INSERT INTO `m_district` (`intDistrictid`,`vchDistrictname`,`stmCreatedOn`,`bitDeletedflag`,`vchDistrictnameO`,`intCreatedby`,`dtmUpdatedOn`,`intUpdatedBy`,`tinPublishStatus`,`vchDescription`,`vchDescriptionO`,`vchSvgcx`,`vchSvgcy`,`vchSvgTransform`,`vchNearDists`) VALUES 
 (25,'Nabarangpur','2016-09-02 12:50:31','\0','à¬¨à¬¬à¬°à¬™à­à¬—à¬ªà­à¬°',0,'2016-09-21 15:14:06',1,1,'','','92.7','277.8','matrix(1 0 0 1 87 280)','22,17,29'),
 (26,'Nayagarh','2016-09-02 12:50:53','\0','à¬¨à­Ÿà¬¾à¬—à¬¡',0,'2016-09-21 15:14:06',1,1,'','','365.7','249','matrix(1 0 0 1 360 252)','21,9,8,13,18'),
 (27,'Nuapada','2016-09-02 12:50:43','\0','à¬¨à­‚à¬†à¬ªà¬¡à¬¾',0,'2016-09-21 15:14:06',1,1,'','','120.3','179.2','matrix(1 0 0 1 115 182)','5,7,17'),
 (28,'Puri','2016-09-02 12:51:02','\0','à¬ªà­à¬°à­€',0,'2016-09-21 15:14:06',1,1,'','','464.1','260.4','matrix(1 0 0 1 459 263)','14,9,21,13'),
 (29,'Rayagada','2016-09-02 12:51:11','\0','à¬°à¬¾à­Ÿà¬—à¬¡à¬¾',0,'2016-09-21 15:14:06',1,1,'','','220.8','333.5','matrix(1 0 0 1 215 336)','12,18,17,22'),
 (30,'Sambalpur','2016-09-02 12:51:27','\0','à¬¸à¬®à­à¬¬à¬²à¬ªà­à¬°',0,'2016-09-21 15:14:06',1,1,'','','282.2','106.3','matrix(1 0 0 1 277 109)','3,10,32,16,5,31');
INSERT INTO `m_district` (`intDistrictid`,`vchDistrictname`,`stmCreatedOn`,`bitDeletedflag`,`vchDistrictnameO`,`intCreatedby`,`dtmUpdatedOn`,`intUpdatedBy`,`tinPublishStatus`,`vchDescription`,`vchDescriptionO`,`vchSvgcx`,`vchSvgcy`,`vchSvgTransform`,`vchNearDists`) VALUES 
 (31,'Sonepur','2016-09-02 12:51:43','\0','à¬¸à­à¬¬à¬°à­à¬£à­à¬£à¬ªà­à¬°',0,'2016-09-21 15:14:06',1,1,'','','234.7','176.2','matrix(1 0 0 1 229 178)','8,3,30,7,5'),
 (32,'Sundargarh','2016-09-02 12:57:12','\0','à¬¸à­à¬¨à­à¬¦à¬°à¬—à¬¡',0,'2016-09-21 15:14:06',1,1,'','','341.5','35.1','matrix(1 0 0 1 336 38)','16,30,10,20');
/*!40000 ALTER TABLE `m_district` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`m_location_master`
--

DROP TABLE IF EXISTS `m_location_master`;
CREATE TABLE `m_location_master` (
  `INT_LOCATION_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VCH_LOCATION` varchar(50) NOT NULL,
  `TXT_LOCATION_O` text,
  `VCH_DESCRIPTION` varchar(500) DEFAULT NULL,
  `VCH_OFFICE_NO1` varchar(100) DEFAULT NULL,
  `VCH_OFFICE_NO2` varchar(100) DEFAULT NULL,
  `VCH_OFFICE_EMAIL` varchar(45) DEFAULT NULL,
  `INT_CREATED_BY` int(10) unsigned DEFAULT NULL,
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `INT_UPDATED_BY` int(10) unsigned DEFAULT NULL,
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `BIT_DELETED_FLAG` bit(1) NOT NULL DEFAULT b'0',
  `INT_PUBLISH_STATUS` int(5) DEFAULT '0',
  PRIMARY KEY (`INT_LOCATION_ID`),
  KEY `IDX_LOCATION` (`VCH_LOCATION`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`m_location_master`
--

/*!40000 ALTER TABLE `m_location_master` DISABLE KEYS */;
INSERT INTO `m_location_master` (`INT_LOCATION_ID`,`VCH_LOCATION`,`TXT_LOCATION_O`,`VCH_DESCRIPTION`,`VCH_OFFICE_NO1`,`VCH_OFFICE_NO2`,`VCH_OFFICE_EMAIL`,`INT_CREATED_BY`,`DTM_CREATED_ON`,`INT_UPDATED_BY`,`DTM_UPDATED_ON`,`BIT_DELETED_FLAG`,`INT_PUBLISH_STATUS`) VALUES 
 (1,'Shimla','','Shimla',NULL,NULL,NULL,1,'2015-09-10 16:09:51',1,'2015-09-10 16:33:26','',0),
 (2,'Raj Bhavan, Puri','','Puri, 751005','','','',1,'2015-09-10 16:18:26',1,'2021-06-04 12:06:38','\0',2),
 (3,'Raj Bhavan, Bhubaneswar','','Bhubaneswar, 751008','0674 2535581/ 2535583/ 2535584/ 25355704','0674 2535581','govodisha@nic.in',1,'2015-09-14 17:26:04',1,'2021-06-04 12:06:38','\0',2),
 (4,'1','','',NULL,NULL,NULL,1,'2015-09-23 12:19:16',1,'2015-09-23 12:36:34','',0),
 (5,'TEST','','TEST',NULL,NULL,NULL,1,'2015-09-23 12:37:45',1,'2015-09-23 12:37:56','',0),
 (6,'gfhfh','','hfghfh','','','',1,'2021-05-30 10:25:22',1,'2021-05-30 10:26:40','',0);
/*!40000 ALTER TABLE `m_location_master` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`m_service_category`
--

DROP TABLE IF EXISTS `m_service_category`;
CREATE TABLE `m_service_category` (
  `intCatId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vchService` varchar(64) DEFAULT NULL,
  `bitDeleteflag` int(10) unsigned NOT NULL DEFAULT '0',
  `INT_PUBLISH_STATUS` int(10) DEFAULT NULL,
  `DTM_CREATED_ON` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `INT_CREATED_BY` int(10) DEFAULT NULL,
  `VCH_CATEGORY_NAME_O` text,
  `INT_TYPE` int(10) DEFAULT '1',
  `INT_PLUGIN_TYPE` int(10) DEFAULT NULL,
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `INT_UPDATED_BY` int(10) DEFAULT NULL,
  PRIMARY KEY (`intCatId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`m_service_category`
--

/*!40000 ALTER TABLE `m_service_category` DISABLE KEYS */;
INSERT INTO `m_service_category` (`intCatId`,`vchService`,`bitDeleteflag`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`VCH_CATEGORY_NAME_O`,`INT_TYPE`,`INT_PLUGIN_TYPE`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`) VALUES 
 (1,'Application for LL &amp; DL',0,2,'2017-11-03 18:19:17',NULL,NULL,1,NULL,NULL,NULL),
 (2,'OPMS',0,2,'2017-11-03 18:19:17',NULL,NULL,1,NULL,NULL,NULL),
 (3,' Fancy Number Auction System',0,2,'2017-11-03 18:19:17',NULL,NULL,1,NULL,NULL,NULL),
 (4,'Speed Governor',0,2,'2017-11-03 18:19:17',NULL,NULL,1,NULL,NULL,NULL),
 (5,'Road Safety',0,2,'2017-11-03 18:19:17',NULL,NULL,1,NULL,NULL,NULL),
 (6,'Reflective Tape',0,2,'2018-11-26 13:04:05',1,'',1,1,'2018-12-07 11:37:55',1),
 (7,'HMV Driving Training Institutes',0,2,'2018-11-26 14:57:31',1,'',1,1,'2018-11-26 14:55:42',1);
/*!40000 ALTER TABLE `m_service_category` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`m_user_master`
--

DROP TABLE IF EXISTS `m_user_master`;
CREATE TABLE `m_user_master` (
  `INT_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `INT_LOCATION_ID` int(10) unsigned DEFAULT NULL,
  `INT_DEPARTMENT_ID` int(10) unsigned DEFAULT NULL,
  `INT_DESIGNATION_ID` int(10) unsigned DEFAULT NULL,
  `VCH_FULL_NAME` varchar(50) NOT NULL,
  `VCH_GENDER` int(10) unsigned NOT NULL,
  `VCH_DATE_OF_JOIN` varchar(15) NOT NULL,
  `VCH_DATE_OF_BIRTH` varchar(15) DEFAULT NULL,
  `VCH_QUALIFICATION` varchar(200) DEFAULT NULL,
  `VCH_SPECIALIZATION` varchar(30) DEFAULT NULL,
  `VCH_HOBBY` varchar(500) DEFAULT NULL,
  `VCH_IMAGE` varchar(100) DEFAULT NULL,
  `VCH_PH_NO` varchar(15) DEFAULT NULL,
  `VCH_MOBILE_NO` varchar(10) DEFAULT NULL,
  `VCH_EMAIL` varchar(50) NOT NULL,
  `VCH_ADDRESS` varchar(500) DEFAULT NULL,
  `VCH_USER_ID` varchar(50) NOT NULL,
  `VCH_PASSWORD` varchar(50) NOT NULL,
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `INT_CREATED_BY` int(10) unsigned DEFAULT NULL,
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `INT_UPDATED_BY` int(10) unsigned DEFAULT NULL,
  `BIT_DELETED_FLAG` bit(1) NOT NULL DEFAULT b'0',
  `INT_ADMIN_PRIVILEGE` int(10) unsigned DEFAULT NULL,
  `INT_PREVILIGE_STATUS` int(10) unsigned DEFAULT NULL,
  `INT_ARCHIVE_STATUS` int(10) unsigned DEFAULT '0',
  `INT_PUBLISH_STATUS` int(10) unsigned DEFAULT NULL,
  `INT_PASSWORD_CHECK` int(10) unsigned NOT NULL DEFAULT '0',
  `INT_PORTAL_TYPE` int(10) unsigned NOT NULL,
  `INT_SLNO` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`INT_ID`),
  KEY `IDX_USER_LOC_ID` (`INT_LOCATION_ID`),
  KEY `IDX_USER_DEPT_ID` (`INT_DEPARTMENT_ID`),
  KEY `IDX_USER_DESG_ID` (`INT_DESIGNATION_ID`),
  KEY `IDX_USER_ID` (`VCH_USER_ID`),
  KEY `IDX_MAIL_ID` (`VCH_EMAIL`),
  KEY `IDX_USER_PRIVILEGE` (`INT_PREVILIGE_STATUS`),
  KEY `IDX_USER_PORTAL_TYPE` (`INT_PORTAL_TYPE`),
  KEY `IDX_USER_SL_NO` (`INT_SLNO`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`m_user_master`
--

/*!40000 ALTER TABLE `m_user_master` DISABLE KEYS */;
INSERT INTO `m_user_master` (`INT_ID`,`INT_LOCATION_ID`,`INT_DEPARTMENT_ID`,`INT_DESIGNATION_ID`,`VCH_FULL_NAME`,`VCH_GENDER`,`VCH_DATE_OF_JOIN`,`VCH_DATE_OF_BIRTH`,`VCH_QUALIFICATION`,`VCH_SPECIALIZATION`,`VCH_HOBBY`,`VCH_IMAGE`,`VCH_PH_NO`,`VCH_MOBILE_NO`,`VCH_EMAIL`,`VCH_ADDRESS`,`VCH_USER_ID`,`VCH_PASSWORD`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_ADMIN_PRIVILEGE`,`INT_PREVILIGE_STATUS`,`INT_ARCHIVE_STATUS`,`INT_PUBLISH_STATUS`,`INT_PASSWORD_CHECK`,`INT_PORTAL_TYPE`,`INT_SLNO`) VALUES 
 (1,0,0,0,'Super Administrator',1,'2003-5-29','1973-6-10','B.Com',NULL,NULL,NULL,NULL,NULL,'handrik.basumatary@torridnetworks.com',NULL,'supAdmin','e6e061838856bf47e1de730719fb2609','2015-08-31 14:45:10',1,NULL,1,'\0',1,0,0,1,0,1,0),
 (2,2,1,2,'aa',1,'','','mba','','','','345345345','3535434534','aa@a.com','','aaaaaa','d41d8cd98f00b204e9800998ecf8427e','2015-09-01 18:27:55',1,'2015-09-11 10:50:02',1,'\0',0,2,0,1,0,0,2),
 (3,2,1,3,'ketaki',0,'','','B.Tech','','','USER_1441194498.jpg','234234233432','3423423423','a@a.com','','ketaki','5d793fc5b00a2348c3fb9ab59e5ca98a','2015-09-02 12:26:34',1,'2015-09-11 10:52:07',1,'\0',1,1,0,1,0,0,1),
 (4,3,2,4,'Sukanta Kumar Mishra',1,'','','','','','','','','','','sukanta','e6e061838856bf47e1de730719fb2609','2015-09-14 17:30:43',1,NULL,NULL,'\0',0,2,0,1,0,0,3);
INSERT INTO `m_user_master` (`INT_ID`,`INT_LOCATION_ID`,`INT_DEPARTMENT_ID`,`INT_DESIGNATION_ID`,`VCH_FULL_NAME`,`VCH_GENDER`,`VCH_DATE_OF_JOIN`,`VCH_DATE_OF_BIRTH`,`VCH_QUALIFICATION`,`VCH_SPECIALIZATION`,`VCH_HOBBY`,`VCH_IMAGE`,`VCH_PH_NO`,`VCH_MOBILE_NO`,`VCH_EMAIL`,`VCH_ADDRESS`,`VCH_USER_ID`,`VCH_PASSWORD`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_ADMIN_PRIVILEGE`,`INT_PREVILIGE_STATUS`,`INT_ARCHIVE_STATUS`,`INT_PUBLISH_STATUS`,`INT_PASSWORD_CHECK`,`INT_PORTAL_TYPE`,`INT_SLNO`) VALUES 
 (5,3,2,4,'CHINMAYEE',0,'','','','','','USER_1442993720.png','409','8908138116','','','CHINMAYEE','35be42ec2279abc769e5d3064b441614','2015-09-23 13:05:20',1,'2015-09-23 13:06:11',1,'\0',0,2,0,1,0,0,4);
/*!40000 ALTER TABLE `m_user_master` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_banner`
--

DROP TABLE IF EXISTS `t_banner`;
CREATE TABLE `t_banner` (
  `INT_BANNER_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VCH_CAPTIONS` text,
  `VCH_CAPTIONS_O` text CHARACTER SET utf8,
  `VCH_IMAGE` varchar(100) NOT NULL,
  `INT_PUBLISH_STATUS` int(10) unsigned DEFAULT NULL,
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `INT_CREATED_BY` int(10) unsigned DEFAULT NULL,
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `INT_UPDATED_BY` int(10) unsigned DEFAULT NULL,
  `BIT_DELETED_FLAG` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`INT_BANNER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_banner`
--

/*!40000 ALTER TABLE `t_banner` DISABLE KEYS */;
INSERT INTO `t_banner` (`INT_BANNER_ID`,`VCH_CAPTIONS`,`VCH_CAPTIONS_O`,`VCH_IMAGE`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`) VALUES 
 (1,'','','Banner20210601_105112.JPG',2,'2021-06-01 10:52:11',1,'2021-06-01 10:54:52',1,'\0'),
 (2,'','','Banner20210601_105133.jpg',2,'2021-06-01 10:52:31',1,'2021-06-01 10:54:52',1,'\0'),
 (3,'','','Banner20210601_105319.jpg',2,'2021-06-01 10:54:18',1,'2021-06-01 10:54:52',1,'\0'),
 (4,'','','Banner20210601_105328.jpg',2,'2021-06-01 10:54:26',1,'2021-06-01 10:54:52',1,'\0'),
 (5,'','','Banner20210601_105337.jpg',2,'2021-06-01 10:54:35',1,'2021-06-01 10:54:52',1,'\0');
/*!40000 ALTER TABLE `t_banner` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_compliment`
--

DROP TABLE IF EXISTS `t_compliment`;
CREATE TABLE `t_compliment` (
  `intId` int(8) NOT NULL AUTO_INCREMENT,
  `vchCompliment` text NOT NULL,
  `vchName` varchar(512) DEFAULT NULL,
  `vchPhoneNo` varchar(16) DEFAULT NULL,
  `vchEmail` varchar(512) DEFAULT NULL,
  `intRadVal` int(10) NOT NULL,
  `intCreatedBy` int(10) unsigned DEFAULT NULL,
  `dtmCreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intUpdatedBy` int(11) DEFAULT NULL,
  `dtmUpdatedOn` datetime DEFAULT NULL,
  `tinPublishStatus` tinyint(2) DEFAULT NULL,
  `tinArchiveStatus` tinyint(2) DEFAULT NULL,
  `bitDeletedFlag` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`intId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_compliment`
--

/*!40000 ALTER TABLE `t_compliment` DISABLE KEYS */;
INSERT INTO `t_compliment` (`intId`,`vchCompliment`,`vchName`,`vchPhoneNo`,`vchEmail`,`intRadVal`,`intCreatedBy`,`dtmCreatedOn`,`intUpdatedBy`,`dtmUpdatedOn`,`tinPublishStatus`,`tinArchiveStatus`,`bitDeletedFlag`) VALUES 
 (1,'Website is good.','','','',0,0,'2020-12-24 15:35:20',NULL,NULL,0,0,''),
 (2,'Website is so good.','Indrani','9090909090','test12@gmail.com',0,0,'2020-12-24 15:36:15',NULL,NULL,0,0,''),
 (3,'By visiting site, we can know about many services.','Indrani','9090909089','test34@gmail.com',1,1,'2020-12-24 15:58:25',NULL,NULL,0,0,'\0'),
 (4,'There is many services.','','','',2,1,'2020-12-24 15:59:48',NULL,NULL,0,0,'\0'),
 (5,'Nice compliment by indrani','indrani tested','9898989898','indrani98@gmail.com',1,0,'2021-01-14 21:16:36',NULL,NULL,0,0,'\0');
/*!40000 ALTER TABLE `t_compliment` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_event_details`
--

DROP TABLE IF EXISTS `t_event_details`;
CREATE TABLE `t_event_details` (
  `INT_EVENT_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VCH_TITLE_E` varchar(320) NOT NULL,
  `VCH_TITLE_O` text,
  `VCH_SOURCE` varchar(258) NOT NULL,
  `DTM_START_DATE` date NOT NULL,
  `START_TIME` time NOT NULL,
  `DTM_END_DATE` date NOT NULL,
  `END_TIME` time NOT NULL,
  `VCH_LOCATION` varchar(258) NOT NULL,
  `VCH_DESCRIPTION_E` varchar(640) NOT NULL,
  `VCH_DESCRIPTION_O` text,
  `VCH_IMAGE` varchar(258) NOT NULL,
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `INT_CREATED_BY` int(10) unsigned NOT NULL,
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `INT_UPDATED_BY` int(10) unsigned DEFAULT NULL,
  `BIT_DELETED_FLAG` bit(1) DEFAULT b'0',
  `INT_PUBLISH_STATUS` int(10) unsigned NOT NULL,
  `INT_ARCHIVE_STATUS` int(10) unsigned NOT NULL,
  PRIMARY KEY (`INT_EVENT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_event_details`
--

/*!40000 ALTER TABLE `t_event_details` DISABLE KEYS */;
INSERT INTO `t_event_details` (`INT_EVENT_ID`,`VCH_TITLE_E`,`VCH_TITLE_O`,`VCH_SOURCE`,`DTM_START_DATE`,`START_TIME`,`DTM_END_DATE`,`END_TIME`,`VCH_LOCATION`,`VCH_DESCRIPTION_E`,`VCH_DESCRIPTION_O`,`VCH_IMAGE`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`) VALUES 
 (1,'Test event','','http://www.google.com','2020-12-10','09:00:00','2020-12-18','18:00:00','BBSR','Event','','','2020-12-10 18:01:39',1,'2020-12-11 14:15:21',1,'',2,0),
 (2,'Safety concern event','','http://www.google.com','2020-12-23','06:30:00','2020-12-31','07:00:00','BBSR','Safety concern event will be held in bhubaneswar.Safety concern event will be held in bhubaneswar.Safety concern event will be held in bhubaneswar.Safety concern event will be held in bhubaneswar.Safety concern event will be held in bhubaneswar.Safety concern event will be held in bhubaneswar.Safety concern event will be held in bhubaneswar.Safety concern event will be held in bhubaneswar.Safety concern event will be held in bhubaneswar.Safety concern event will be held in bhubaneswar.','','EventImg_1607691993.jpg','2020-12-10 18:15:06',1,'2020-12-14 15:19:05',0,'\0',2,0),
 (3,'Road Safety Event','Road Safety Event','http://www.google.com','2020-12-29','04:15:00','2020-12-30','16:15:00','Delhi','Road Safety event will be held in Delhi.Road Safety event will be held in Delhi.Road Safety event will be held in Delhi.Road Safety event will be held in Delhi.Road Safety event will be held in Delhi.Road Safety event will be held in Delhi.Road Safety event will be held in Delhi.Road Safety event will be held in Delhi.','','EventImg_1607691963.jpg','2020-12-11 10:18:29',1,'2020-12-14 15:19:05',0,'\0',2,0);
INSERT INTO `t_event_details` (`INT_EVENT_ID`,`VCH_TITLE_E`,`VCH_TITLE_O`,`VCH_SOURCE`,`DTM_START_DATE`,`START_TIME`,`DTM_END_DATE`,`END_TIME`,`VCH_LOCATION`,`VCH_DESCRIPTION_E`,`VCH_DESCRIPTION_O`,`VCH_IMAGE`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`) VALUES 
 (4,'Traffic charges event','','http://www.google.com','2020-12-17','23:15:00','2020-12-23','15:15:00','BBSR','Traffic charges event.Traffic charges event.Traffic charges event.Traffic charges event.Traffic charges event.Traffic charges eventTraffic charges event.Traffic charges eventTraffic charges event.Traffic charges event.Traffic charges event.','','EventImg_1607939433.jpg','2020-12-11 17:47:56',1,'2020-12-16 10:18:06',1,'\0',2,0),
 (5,'Road Safety rules','Road Safety rules','http://www.youtube.com','2020-12-24','18:15:00','2020-12-25','10:15:00','Delhi','Traffic rules event will be held in delhi.Traffic rules event will be held in delhi.Traffic rules event will be held in delhi.Traffic rules event will be held in delhi.','','EventImg_1607694788.jpg','2020-12-11 19:24:58',1,'2020-12-16 10:17:25',1,'\0',2,0),
 (6,'Traffic fine event','Traffic fine event','http://www.google.com','2020-12-23','17:15:00','2020-12-31','14:30:00','BBSR','Traffic fine event.Traffic fine event.Traffic fine event.Traffic fine event.Traffic fine event.Traffic fine event.Traffic fine event.Traffic fine event.Traffic fine event.Traffic fine event.Traffic fine event.Traffic fine event.','','EventImg_1607939949.jpg','2020-12-14 15:31:42',1,'2020-12-16 09:54:28',1,'\0',2,0);
INSERT INTO `t_event_details` (`INT_EVENT_ID`,`VCH_TITLE_E`,`VCH_TITLE_O`,`VCH_SOURCE`,`DTM_START_DATE`,`START_TIME`,`DTM_END_DATE`,`END_TIME`,`VCH_LOCATION`,`VCH_DESCRIPTION_E`,`VCH_DESCRIPTION_O`,`VCH_IMAGE`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`) VALUES 
 (7,'vehicle event','vehicle event','http://www.google.com','2020-12-18','19:15:00','2020-12-18','07:30:00','BBSR','Vehicle event.Vehicle event.Vehicle event.Vehicle event.Vehicle event.Vehicle event.Vehicle event.Vehicle event.Vehicle event.Vehicle event','','EventImg_1608090121.jpg','2020-12-16 09:14:30',1,'2020-12-16 09:55:09',1,'\0',2,0),
 (8,'Road Accident event','Road Accident event','http://www.google.com','2020-12-24','09:45:00','2020-12-25','05:15:00','Delhi','Road Accident event.Road Accident event.Road Accident event.Road Accident event.Road Accident event.Road Accident event.Road Accident event.Road Accident event.Road Accident event.','','EventImg_1608095092.jpg','2020-12-16 10:37:21',1,'2020-12-16 10:43:48',0,'\0',2,0),
 (9,'Transport Rule Event','','http://www.youtube.com','2020-12-28','10:35:00','2020-12-30','04:45:00','BBSR','Transport Rule Event.Transport Rule Event.Transport Rule Event.Transport Rule Event.Transport Rule Event.Transport Rule Event.Transport Rule Event.','','EventImg_1608095206.jpg','2020-12-16 10:39:15',1,'2020-12-16 10:43:48',0,'\0',2,0);
INSERT INTO `t_event_details` (`INT_EVENT_ID`,`VCH_TITLE_E`,`VCH_TITLE_O`,`VCH_SOURCE`,`DTM_START_DATE`,`START_TIME`,`DTM_END_DATE`,`END_TIME`,`VCH_LOCATION`,`VCH_DESCRIPTION_E`,`VCH_DESCRIPTION_O`,`VCH_IMAGE`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`) VALUES 
 (10,'Road Parking event','','http://www.google.com','2020-12-22','02:15:00','2020-12-24','03:30:00','BBSR','Road Parking event.Road Parking event.Road Parking event.Road Parking event.Road Parking event.Road Parking event.','','EventImg_1608095337.jpg','2020-12-16 10:41:27',1,'2020-12-16 10:43:48',0,'\0',2,0),
 (11,'Pollution checking event','','http://www.google.com','2020-12-24','02:15:00','2020-12-25','02:30:00','chennai','Pollution checking event.Pollution checking event.Pollution checking event.Pollution checking event.Pollution checking event.Pollution checking event.','','EventImg_1608095448.jpg','2020-12-16 10:43:17',1,'2020-12-16 10:43:48',0,'\0',2,0),
 (12,'Event on Beneifits of Traffic rules','','http://www.google.com','2020-12-29','02:30:00','2020-12-30','03:15:00','Delhi','Event on Beneifits of Traffic rules.Event on Beneifits of Traffic rules.Event on Beneifits of Traffic rules.Event on Beneifits of Traffic rules.Event on Beneifits of Traffic rules.Event on Beneifits of Traffic rules.','','EventImg_1608271523.jpg','2020-12-18 11:37:48',1,NULL,NULL,'\0',0,0);
/*!40000 ALTER TABLE `t_event_details` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_faq`
--

DROP TABLE IF EXISTS `t_faq`;
CREATE TABLE `t_faq` (
  `INT_FAQ_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `INT_CHAPTER_ID` int(10) unsigned NOT NULL,
  `VCH_QUESTION` varchar(264) NOT NULL,
  `VCH_DESCRIPTION` text NOT NULL,
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `INT_CREATED_BY` int(10) unsigned NOT NULL,
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `INT_UPDATED_BY` int(10) unsigned DEFAULT NULL,
  `BIT_DELETED_FLAG` bit(1) NOT NULL DEFAULT b'0',
  `INT_PUBLISH_STATUS` int(10) unsigned NOT NULL,
  `INT_ARCHIVE_STATUS` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`INT_FAQ_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_faq`
--

/*!40000 ALTER TABLE `t_faq` DISABLE KEYS */;
INSERT INTO `t_faq` (`INT_FAQ_ID`,`INT_CHAPTER_ID`,`VCH_QUESTION`,`VCH_DESCRIPTION`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`) VALUES 
 (1,1,'dasdasd','asdad','2020-11-16 17:49:20',1,NULL,NULL,'',0,0),
 (2,1,'What is your name?','Indrani Biswas ji','2020-11-16 17:51:15',1,'2020-11-24 09:32:58',0,'\0',2,0),
 (3,1,'Where are you living?','','2020-11-16 18:12:40',1,'2020-11-16 18:12:57',1,'',0,0),
 (4,1,'dadad','','2020-11-16 18:15:39',1,NULL,NULL,'',0,0),
 (5,1,'What is your hobby?','Drawinggg','2020-11-17 09:54:24',1,'2020-11-17 10:36:20',0,'\0',2,0),
 (6,2,'What is your faverate color?','Pink','2020-11-17 10:17:00',1,'2020-11-17 10:36:20',0,'\0',2,0),
 (7,2,'do you like tea?','Yes','2020-11-17 10:35:22',1,'2020-11-24 09:32:58',0,'\0',2,0),
 (8,1,'Process of donate to raod safety?','Process of donate to raod safety.Process of donate to raod safety.Process of donate to raod safety.Process of donate to raod safety','2021-01-11 17:49:18',1,'2021-01-11 17:50:40',1,'\0',2,0);
/*!40000 ALTER TABLE `t_faq` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_feedback`
--

DROP TABLE IF EXISTS `t_feedback`;
CREATE TABLE `t_feedback` (
  `intFeedbackId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vchName` varchar(128) DEFAULT NULL,
  `vchEmail` varchar(64) DEFAULT NULL,
  `vchTelNo` varchar(16) DEFAULT NULL,
  `vchSubject` varchar(512) DEFAULT NULL,
  `vchMessage` text,
  `vchRemarks` varchar(256) DEFAULT NULL,
  `stmCreatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dtmUpdatedOn` datetime DEFAULT NULL,
  `intUpdatedBy` int(10) unsigned DEFAULT NULL,
  `bitDeletedFlag` bit(1) DEFAULT b'0',
  `vchNameL` varchar(128) NOT NULL,
  PRIMARY KEY (`intFeedbackId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_feedback`
--

/*!40000 ALTER TABLE `t_feedback` DISABLE KEYS */;
INSERT INTO `t_feedback` (`intFeedbackId`,`vchName`,`vchEmail`,`vchTelNo`,`vchSubject`,`vchMessage`,`vchRemarks`,`stmCreatedOn`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`vchNameL`) VALUES 
 (1,'ashok Samal','ashok@csm.co.in','8908804243','','test message.',NULL,'2021-06-08 15:54:48',NULL,NULL,'\0',''),
 (2,'ashok Samal','ashok@csm.co.in','8908804243','','test message.',NULL,'2021-06-08 16:07:44',NULL,NULL,'\0',''),
 (3,'','','','','',NULL,'2021-06-08 22:10:47',NULL,NULL,'\0',''),
 (4,'','','','','',NULL,'2021-06-08 22:15:31',NULL,NULL,'\0',''),
 (5,'','','','','',NULL,'2021-06-08 22:19:15',NULL,NULL,'\0',''),
 (9,'dsfgfdgfhfgh','a@gmail.com','9090121942','','dsfsdfdsgdfsg',NULL,'2021-06-09 11:42:59',NULL,NULL,'\0',''),
 (10,'fdfdsgdgfd','a@gmail.com','9090121942','','dsfdgdfgfh',NULL,'2021-06-09 11:46:53',NULL,NULL,'\0','');
/*!40000 ALTER TABLE `t_feedback` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_former_officer`
--

DROP TABLE IF EXISTS `t_former_officer`;
CREATE TABLE `t_former_officer` (
  `intProfileId` int(11) NOT NULL AUTO_INCREMENT,
  `intOfficerType` smallint(4) NOT NULL DEFAULT '1' COMMENT '1=Former Goverener, 2= Former Seceretary',
  `vchOfficerName` varchar(200) NOT NULL,
  `dtJoiningDate` date DEFAULT NULL,
  `dtRetireDate` date DEFAULT NULL,
  `vchImage` varchar(200) DEFAULT NULL,
  `intOrderno` int(11) DEFAULT '0',
  `tinPublishStatus` tinyint(3) DEFAULT '1',
  `stmCreatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `intCreatedBy` tinyint(3) DEFAULT '1',
  `dtmUpdatedOn` datetime DEFAULT NULL,
  `intUpdatedBy` tinyint(3) DEFAULT '1',
  `bitDeletedFlag` bit(1) DEFAULT b'0',
  PRIMARY KEY (`intProfileId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='Former officers and govereners ';

--
-- Dumping data for table `ORBPM_devdb`.`t_former_officer`
--

/*!40000 ALTER TABLE `t_former_officer` DISABLE KEYS */;
INSERT INTO `t_former_officer` (`intProfileId`,`intOfficerType`,`vchOfficerName`,`dtJoiningDate`,`dtRetireDate`,`vchImage`,`intOrderno`,`tinPublishStatus`,`stmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`) VALUES 
 (1,2,'Mr. J.S. Wilcock, ICS','1936-04-01','1940-01-01','',1,2,'2021-05-20 17:53:52',1,'2021-06-06 12:51:22',1,'\0'),
 (2,1,'Satya Pal Malik','2018-03-21','2018-05-28','OffProfile1621513514.jpg',1,2,'2021-05-20 17:56:36',1,'2021-06-06 12:51:22',1,'\0'),
 (4,1,'Dr. Senayangba Chubatoshi Jamir','2013-03-21','2018-03-20','OffProfile1622868770.jpg',2,2,'2021-06-05 10:23:41',1,'2021-06-06 12:51:22',1,'\0'),
 (5,2,'Mr. F.E.A. Taylor, ICS',NULL,NULL,'',2,2,'2021-06-06 12:40:46',1,'2021-06-06 12:51:22',1,'\0'),
 (6,2,'Mr. J. Bowstead, ICS',NULL,NULL,'',3,2,'2021-06-06 12:41:29',1,'2021-06-06 12:51:22',1,'\0'),
 (7,2,'Mr. V.E. Devies, ICS','1941-01-12','1944-07-26','',4,2,'2021-06-06 12:46:46',1,'2021-06-06 12:51:22',1,'\0'),
 (8,2,'Mr. C.L. Bryson, ICS','1944-07-27','1944-11-13','',5,2,'2021-06-06 12:48:07',1,'2021-06-06 12:51:22',1,'\0'),
 (9,2,'Mr. R.S. Swann, ICS','1944-11-14','1944-12-18','',6,2,'2021-06-06 12:49:04',1,'2021-06-06 12:51:23',1,'\0');
/*!40000 ALTER TABLE `t_former_officer` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_function_master`
--

DROP TABLE IF EXISTS `t_function_master`;
CREATE TABLE `t_function_master` (
  `INT_FN_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VCH_NAME` varchar(45) NOT NULL,
  `VCH_ADMIN_LAND_URL` varchar(45) DEFAULT NULL,
  `VCH_WEB_LAND_URL` varchar(45) NOT NULL,
  PRIMARY KEY (`INT_FN_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_function_master`
--

/*!40000 ALTER TABLE `t_function_master` DISABLE KEYS */;
INSERT INTO `t_function_master` (`INT_FN_ID`,`VCH_NAME`,`VCH_ADMIN_LAND_URL`,`VCH_WEB_LAND_URL`) VALUES 
 (3,'Services','addImpServices','services'),
 (14,'Web Directory','addWebdirectory','web-directory'),
 (15,'Gallery','addGallery','gallery'),
 (17,'Governer Officers','addOfficer','governer-officer'),
 (18,'Tender','addTender','tender'),
 (20,'Contact',NULL,'contactus'),
 (29,'faq','faq','faq'),
 (33,'Important Links','addLink','important-links'),
 (40,'Former Governer',NULL,'former-governer'),
 (41,'Fomer Secerteries',NULL,'former-secreteries'),
 (42,'Feedback','feedback','feedback');
/*!40000 ALTER TABLE `t_function_master` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_gallery`
--

DROP TABLE IF EXISTS `t_gallery`;
CREATE TABLE `t_gallery` (
  `INT_GALLERY_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VCH_HEADLINE_E` varchar(256) NOT NULL,
  `VCH_HEADLINE_O` text,
  `VCH_THUMB_IMAGE` varchar(128) DEFAULT NULL,
  `VCH_LARGE_IMAGE` varchar(128) DEFAULT NULL,
  `VCH_DESCRIPTION_E` varchar(512) DEFAULT NULL,
  `VCH_DESCRIPTION_O` text,
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `INT_CREATED_BY` int(10) unsigned DEFAULT NULL,
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `INT_UPDATED_BY` int(10) unsigned DEFAULT NULL,
  `BIT_DELETED_FLAG` bit(1) DEFAULT b'0',
  `VCH_URL` varchar(258) DEFAULT NULL,
  `INT_PUBLISH_STATUS` int(10) unsigned DEFAULT NULL,
  `INT_ARCHIVE_STATUS` int(10) unsigned NOT NULL,
  `INT_CATEGORY_ID` int(11) NOT NULL,
  `VCH_PORTAL_TYPE` varchar(128) DEFAULT NULL,
  `INT_TYPE_ID` tinyint(4) unsigned NOT NULL,
  `INT_VIDEO_LINK_TYPE` tinyint(4) unsigned DEFAULT NULL,
  `INT_PLUGIN_ID` int(10) unsigned NOT NULL,
  `INT_SCREEN_TYPE` int(11) NOT NULL,
  PRIMARY KEY (`INT_GALLERY_ID`),
  KEY `IDX_HEAD_LINE` (`VCH_HEADLINE_E`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_gallery`
--

/*!40000 ALTER TABLE `t_gallery` DISABLE KEYS */;
INSERT INTO `t_gallery` (`INT_GALLERY_ID`,`VCH_HEADLINE_E`,`VCH_HEADLINE_O`,`VCH_THUMB_IMAGE`,`VCH_LARGE_IMAGE`,`VCH_DESCRIPTION_E`,`VCH_DESCRIPTION_O`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`VCH_URL`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`,`INT_CATEGORY_ID`,`VCH_PORTAL_TYPE`,`INT_TYPE_ID`,`INT_VIDEO_LINK_TYPE`,`INT_PLUGIN_ID`,`INT_SCREEN_TYPE`) VALUES 
 (1,'test','','','UP_Gallery_1620893563.jpg','','','2021-05-13 13:44:19',1,'2021-06-06 11:38:22',0,'\0','',2,0,1,'',2,0,1,0),
 (2,'test caption','','','UP_Gallery_1620906276.jpg','                                                        test descriptin                                                ','','2021-05-13 17:16:11',1,'2021-06-06 11:38:22',0,'\0','',2,0,1,'',2,0,1,0),
 (3,'test cap','','','UP_Gallery_1620907747.jpg','tezst cap des','','2021-05-13 17:40:42',1,'2021-05-17 14:02:19',0,'\0','',1,1,1,'',2,0,1,0),
 (4,'Governor Prof Ganeshi Lal administering oath of office to State Information Commissioner','','','UP_Gallery_1622777830.jpg','Hon&#039;ble Governor Prof Ganeshi Lal administering oath of office to State Information Commissioner Bikram Kumar Senapati and Dilip Kumar Bisoi in a ceremony at Rajbhaban on 09.09.2020','','2021-06-04 09:08:03',1,'2021-06-06 11:38:22',0,'\0','',2,0,4,'',2,0,1,0),
 (5,'Governor Prof Ganeshi Lal administering oath','','','UP_Gallery_1622778197.jpg','                            Hon&#039;ble Governor Prof Ganeshi Lal administering oath of office to State Information Commissioner Bikram Kumar Senapati and Dilip Kumar Bisoi in a ceremony at Rajbhaban on 09.09.2020                        ','','2021-06-04 09:14:10',1,'2021-06-06 11:38:22',0,'\0','',2,0,4,'',2,0,1,0);
INSERT INTO `t_gallery` (`INT_GALLERY_ID`,`VCH_HEADLINE_E`,`VCH_HEADLINE_O`,`VCH_THUMB_IMAGE`,`VCH_LARGE_IMAGE`,`VCH_DESCRIPTION_E`,`VCH_DESCRIPTION_O`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`VCH_URL`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`,`INT_CATEGORY_ID`,`VCH_PORTAL_TYPE`,`INT_TYPE_ID`,`INT_VIDEO_LINK_TYPE`,`INT_PLUGIN_ID`,`INT_SCREEN_TYPE`) VALUES 
 (6,'Governor Prof Ganeshi Lal administering oath of office to State Information Commissioner','','','UP_Gallery_1622778262.jpg','Hon&#039;ble Governor Prof Ganeshi Lal administering oath of office to State Information Commissioner Bikram Kumar Senapati and Dilip Kumar Bisoi in a ceremony at Rajbhaban on 09.09.2020','','2021-06-04 09:15:15',1,'2021-06-06 11:38:22',0,'\0','',2,0,4,'',2,0,1,0),
 (7,'Governor Prof Ganeshi Lal administering oath of office to State Information Commissioner','','','UP_Gallery_1622778306.jpg','Hon&#039;ble Governor Prof Ganeshi Lal administering oath of office to State Information Commissioner Bikram Kumar Senapati and Dilip Kumar Bisoi in a ceremony at Rajbhaban on 09.09.2020','','2021-06-04 09:15:59',1,'2021-06-06 11:38:22',0,'\0','',2,0,4,'',2,0,1,0),
 (8,'Governor Prof. Ganeshi Lal expressing his views and comments','','','UP_Gallery_1622778373.JPG','Hon&#039;ble Governor Prof. Ganeshi Lal expressing his views and comments in Governors&#039; Conference on Role of NEP 2020 in transforming Higher Education, organised by Ministry of Education, Government of India inaugurated by Hon&#039;ble President of India and addressed by Hon&#039;ble Prime Minister on 07.09.2020.','','2021-06-04 09:17:06',1,'2021-06-06 11:38:22',0,'\0','',2,0,4,'',2,0,1,0);
INSERT INTO `t_gallery` (`INT_GALLERY_ID`,`VCH_HEADLINE_E`,`VCH_HEADLINE_O`,`VCH_THUMB_IMAGE`,`VCH_LARGE_IMAGE`,`VCH_DESCRIPTION_E`,`VCH_DESCRIPTION_O`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`VCH_URL`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`,`INT_CATEGORY_ID`,`VCH_PORTAL_TYPE`,`INT_TYPE_ID`,`INT_VIDEO_LINK_TYPE`,`INT_PLUGIN_ID`,`INT_SCREEN_TYPE`) VALUES 
 (9,'Governor Prof. Ganeshi Lal expressing his views and comments','','','UP_Gallery_1622778424.jpg','Hon&#039;ble Governor Prof. Ganeshi Lal expressing his views and comments in Governors&#039; Conference on Role of NEP 2020 in transforming Higher Education, organised by Ministry of Education, Government of India inaugurated by Hon&#039;ble President of India and addressed by Hon&#039;ble Prime Minister on 07.09.2020.','','2021-06-04 09:17:57',1,'2021-06-06 11:38:22',0,'\0','',2,0,4,'',2,0,1,0),
 (10,'Governor Prof. Ganeshi Lal expressing his views and comments','','','UP_Gallery_1622778492.jpg','Hon&#039;ble Governor Prof. Ganeshi Lal expressing his views and comments in Governors&#039; Conference on Role of NEP 2020 in transforming Higher Education, organised by Ministry of Education, Government of India inaugurated by Hon&#039;ble President of India and addressed by Hon&#039;ble Prime Minister on 07.09.2020.','','2021-06-04 09:19:05',1,'2021-06-06 11:38:22',0,'\0','',2,0,4,'',2,0,1,0),
 (11,'Governor Prof. Ganeshi Lal expressing his views and comments','','','UP_Gallery_1622778522.JPG','Hon&#039;ble Governor Prof. Ganeshi Lal expressing his views and comments in Governors&#039; Conference on Role of NEP 2020 in transforming Higher Education, organised by Ministry of Education, Government of India inaugurated by Hon&#039;ble President of India and addressed by Hon&#039;ble Prime Minister on 07.09.2020.','','2021-06-04 09:19:35',1,'2021-06-06 11:38:22',0,'\0','',2,0,4,'',2,0,1,0);
INSERT INTO `t_gallery` (`INT_GALLERY_ID`,`VCH_HEADLINE_E`,`VCH_HEADLINE_O`,`VCH_THUMB_IMAGE`,`VCH_LARGE_IMAGE`,`VCH_DESCRIPTION_E`,`VCH_DESCRIPTION_O`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`VCH_URL`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`,`INT_CATEGORY_ID`,`VCH_PORTAL_TYPE`,`INT_TYPE_ID`,`INT_VIDEO_LINK_TYPE`,`INT_PLUGIN_ID`,`INT_SCREEN_TYPE`) VALUES 
 (12,'Governor Prof. Ganeshi Lal expressing his views and comments','','','UP_Gallery_1622778558.jpg','Hon&#039;ble Governor Prof. Ganeshi Lal expressing his views and comments in Governors&#039; Conference on Role of NEP 2020 in transforming Higher Education, organised by Ministry of Education, Government of India inaugurated by Hon&#039;ble President of India and addressed by Hon&#039;ble Prime Minister on 07.09.2020.','','2021-06-04 09:20:11',1,'2021-06-06 11:38:22',0,'\0','',2,0,4,'',2,0,1,0),
 (13,'Honble Governor Prof Ganeshi Lal speaking in World First Aid Day celebration organised by St John A','','','UP_Gallery_1622959374.jpg','                            Hon&#039;ble Governor Prof Ganeshi Lal speaking in World First Aid Day celebration organised by St John Ambulance at Rajbhaban on 12.09.2020                        ','','2021-06-06 11:33:42',1,'2021-06-06 11:38:22',0,'\0','',2,0,3,'',2,0,1,0),
 (14,'Honble Governor Prof Ganeshi Lal inaugurating St.John Ambulance Website on the occasion of World Fi','','','UP_Gallery_1622959443.jpg','Hon&#039;ble Governor Prof Ganeshi Lal inaugurating St.John Ambulance Website on the occasion of World First Aid Day at Rajbhaban on 12.09.2020','','2021-06-06 11:34:51',1,'2021-06-06 11:38:22',0,'\0','',2,0,3,'',2,0,1,0);
INSERT INTO `t_gallery` (`INT_GALLERY_ID`,`VCH_HEADLINE_E`,`VCH_HEADLINE_O`,`VCH_THUMB_IMAGE`,`VCH_LARGE_IMAGE`,`VCH_DESCRIPTION_E`,`VCH_DESCRIPTION_O`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`VCH_URL`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`,`INT_CATEGORY_ID`,`VCH_PORTAL_TYPE`,`INT_TYPE_ID`,`INT_VIDEO_LINK_TYPE`,`INT_PLUGIN_ID`,`INT_SCREEN_TYPE`) VALUES 
 (15,'Honble Governor Prof Ganeshi Lal administering oath of office to State Information Commissioner Bik','','','UP_Gallery_1622959481.jpg','Hon&#039;ble Governor Prof Ganeshi Lal administering oath of office to State Information Commissioner Bikram Kumar Senapati and Dilip Kumar Bisoi in a ceremony at Rajbhaban on 09.09.2020','','2021-06-06 11:35:30',1,'2021-06-06 11:38:22',0,'\0','',2,0,3,'',2,0,1,0),
 (16,'Honble Governor Prof. Ganeshi Lal expressing his views and comments in Governors Conference','','','UP_Gallery_1622959639.JPG','                            Hon&#039;ble Governor Prof. Ganeshi Lal expressing his views and comments in Governors&#039; Conference on Role of NEP 2020 in transforming Higher Education, organised by Ministry of Education, Government of India inaugurated by Hon&#039;ble President of India and addressed by Hon&#039;ble Prime Minister on 07.09.2020.                        ','','2021-06-06 11:38:08',1,'2021-06-06 11:38:22',0,'\0','',2,0,3,'',2,0,1,0);
/*!40000 ALTER TABLE `t_gallery` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_gallery_category`
--

DROP TABLE IF EXISTS `t_gallery_category`;
CREATE TABLE `t_gallery_category` (
  `INT_CATEGORY_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VCH_CATEGORY_NAME` varchar(128) NOT NULL,
  `VCH_DESCRIPTION` varchar(512) DEFAULT NULL,
  `INT_PUBLISH_STATUS` int(10) unsigned NOT NULL DEFAULT '0',
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `INT_CREATED_BY` int(10) unsigned NOT NULL DEFAULT '1',
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `INT_UPDATED_BY` int(10) unsigned DEFAULT NULL,
  `BIT_DELETED_FLAG` bit(1) NOT NULL DEFAULT b'0',
  `INT_SHOW_HOME` smallint(1) unsigned NOT NULL DEFAULT '0',
  `VCH_CATEGORY_NAME_O` text CHARACTER SET utf8,
  `VCH_DESCRIPTION_O` text CHARACTER SET utf8,
  `INT_TYPE` int(10) unsigned NOT NULL DEFAULT '1',
  `INT_PLUGIN_TYPE` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`INT_CATEGORY_ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_gallery_category`
--

/*!40000 ALTER TABLE `t_gallery_category` DISABLE KEYS */;
INSERT INTO `t_gallery_category` (`INT_CATEGORY_ID`,`VCH_CATEGORY_NAME`,`VCH_DESCRIPTION`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_SHOW_HOME`,`VCH_CATEGORY_NAME_O`,`VCH_DESCRIPTION_O`,`INT_TYPE`,`INT_PLUGIN_TYPE`) VALUES 
 (1,'Cultural Event',NULL,2,'2021-05-12 21:41:06',1,'2021-05-26 16:22:22',1,'\0',0,NULL,NULL,1,NULL),
 (2,'OFFICIAL EVENTS',NULL,2,'2021-05-26 16:21:43',1,'2021-05-26 16:22:22',1,'\0',0,NULL,NULL,1,NULL),
 (3,'PHOTO ARCHIVES',NULL,2,'2021-05-26 16:22:09',1,'2021-05-26 16:22:22',1,'\0',0,NULL,NULL,1,NULL),
 (4,'Home Gallery',NULL,2,'2021-05-31 17:01:15',1,'2021-06-06 11:28:48',1,'\0',0,NULL,NULL,1,NULL);
/*!40000 ALTER TABLE `t_gallery_category` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_important_links`
--

DROP TABLE IF EXISTS `t_important_links`;
CREATE TABLE `t_important_links` (
  `intLinkId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vchLinkNameE` varchar(64) NOT NULL,
  `VchLinknameH` varchar(64) DEFAULT NULL,
  `vchUrl` varchar(256) NOT NULL,
  `tinPublishStatus` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `tinArcStatus` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `stmCreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intCreatedBy` int(10) unsigned NOT NULL,
  `dtmUpdatedOn` datetime DEFAULT NULL,
  `intUpdatedBy` int(10) unsigned DEFAULT NULL,
  `bitDeletedFlag` bit(1) NOT NULL DEFAULT b'0',
  `vchImage` varchar(128) DEFAULT NULL,
  `intSlNo` int(11) unsigned DEFAULT '0',
  `tinLinkType` tinyint(3) unsigned DEFAULT NULL,
  `vchDocument` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`intLinkId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_important_links`
--

/*!40000 ALTER TABLE `t_important_links` DISABLE KEYS */;
INSERT INTO `t_important_links` (`intLinkId`,`vchLinkNameE`,`VchLinknameH`,`vchUrl`,`tinPublishStatus`,`tinArcStatus`,`stmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`vchImage`,`intSlNo`,`tinLinkType`,`vchDocument`) VALUES 
 (1,'President Of India','','https://presidentofindia.nic.in/',2,0,'2021-05-17 11:50:12',1,'2021-05-19 19:56:44',1,'\0','',0,0,''),
 (2,'Rajbhawan UttaraKhand','','https://governoruk.gov.in/',2,0,'2021-05-17 11:50:58',1,'2021-05-17 14:03:35',1,'\0','',0,0,''),
 (3,'Raj bhavan Gujarat','','http://rajbhavan.gujarat.gov.in/',1,0,'2021-06-09 09:44:45',1,NULL,NULL,'\0','',0,0,'');
/*!40000 ALTER TABLE `t_important_links` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_manage_logo`
--

DROP TABLE IF EXISTS `t_manage_logo`;
CREATE TABLE `t_manage_logo` (
  `INT_LOGO_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VCH_LOGO_TITLE` varchar(50) NOT NULL,
  `VCH_LOGO_TITLE_O` text CHARACTER SET utf8,
  `VCH_IMAGE` varchar(50) NOT NULL,
  `VCH_DESCRIPTION_E` varchar(500) NOT NULL,
  `INT_PUBLISH_STATUS` int(10) unsigned NOT NULL,
  `INT_PREVILIGE_STATUS` int(10) unsigned NOT NULL,
  `INT_CREATED_BY` int(10) unsigned NOT NULL,
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `INT_UPDATED_BY` int(10) DEFAULT NULL,
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `BIT_DELETED_FLAG` bit(1) NOT NULL DEFAULT b'0',
  `INT_APPROVAL_STATUS` int(10) unsigned DEFAULT NULL,
  `VCH_IMAGE_H` varchar(50) NOT NULL,
  PRIMARY KEY (`INT_LOGO_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_manage_logo`
--

/*!40000 ALTER TABLE `t_manage_logo` DISABLE KEYS */;
INSERT INTO `t_manage_logo` (`INT_LOGO_ID`,`VCH_LOGO_TITLE`,`VCH_LOGO_TITLE_O`,`VCH_IMAGE`,`VCH_DESCRIPTION_E`,`INT_PUBLISH_STATUS`,`INT_PREVILIGE_STATUS`,`INT_CREATED_BY`,`DTM_CREATED_ON`,`INT_UPDATED_BY`,`DTM_UPDATED_ON`,`BIT_DELETED_FLAG`,`INT_APPROVAL_STATUS`,`VCH_IMAGE_H`) VALUES 
 (1,'LOGO1','','Logo20160926_131824.jpg','',0,0,0,'2016-06-01 12:11:22',0,'2016-09-26 13:18:57','',0,'LogoH20160926_131824.jpg'),
 (2,'Rajvan ,Odisha','','white-logo.png','',0,0,0,'2016-09-26 16:10:54',0,'2020-12-09 13:03:25','\0',0,'LogoH20201209_130445.png');
/*!40000 ALTER TABLE `t_manage_logo` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_menus`
--

DROP TABLE IF EXISTS `t_menus`;
CREATE TABLE `t_menus` (
  `intId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intPageId` int(10) unsigned NOT NULL,
  `intParentId` int(10) unsigned NOT NULL,
  `tinMenuType` tinyint(3) unsigned NOT NULL,
  `intMenuOrder` int(10) unsigned NOT NULL,
  `vchLinkType` varchar(24) DEFAULT NULL,
  `vchPageNavigation` varchar(128) NOT NULL,
  PRIMARY KEY (`intId`),
  KEY `fkPageId_idx` (`intPageId`),
  CONSTRAINT `fkPageId` FOREIGN KEY (`intPageId`) REFERENCES `t_pages` (`intPageId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=400 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_menus`
--

/*!40000 ALTER TABLE `t_menus` DISABLE KEYS */;
INSERT INTO `t_menus` (`intId`,`intPageId`,`intParentId`,`tinMenuType`,`intMenuOrder`,`vchLinkType`,`vchPageNavigation`) VALUES 
 (7,13,0,2,1,'globalLink','13'),
 (8,14,0,2,2,'globalLink','14'),
 (204,11,0,3,1,'globalLink','11'),
 (205,9,0,3,2,'globalLink','9'),
 (259,7,0,1,1,NULL,'7'),
 (260,1,7,1,1,NULL,'7_1'),
 (261,2,7,1,2,NULL,'7_2'),
 (262,3,7,1,3,NULL,'7_3'),
 (263,15,7,1,4,NULL,'7_15'),
 (264,16,7,1,5,NULL,'7_16'),
 (265,8,0,1,2,NULL,'8'),
 (266,4,8,1,6,NULL,'8_4'),
 (267,5,8,1,7,NULL,'8_5'),
 (268,6,8,1,8,NULL,'8_6'),
 (269,9,0,1,3,NULL,'9'),
 (270,17,9,1,9,NULL,'9_17'),
 (271,20,17,1,10,NULL,'17_20'),
 (272,21,17,1,11,NULL,'17_21'),
 (273,22,17,1,12,NULL,'17_22'),
 (274,23,17,1,13,NULL,'17_23'),
 (275,24,17,1,14,NULL,'17_24'),
 (276,18,9,1,15,NULL,'9_18'),
 (277,19,9,1,16,NULL,'9_19'),
 (278,10,0,1,4,NULL,'10'),
 (279,25,10,1,17,NULL,'10_25'),
 (280,26,10,1,18,NULL,'10_26'),
 (281,27,10,1,19,NULL,'10_27'),
 (282,28,27,1,20,NULL,'27_28'),
 (283,29,27,1,21,NULL,'27_29'),
 (284,30,27,1,22,NULL,'27_30'),
 (285,31,27,1,23,NULL,'27_31');
INSERT INTO `t_menus` (`intId`,`intPageId`,`intParentId`,`tinMenuType`,`intMenuOrder`,`vchLinkType`,`vchPageNavigation`) VALUES 
 (286,11,0,1,5,NULL,'11'),
 (287,32,11,1,24,NULL,'11_32'),
 (288,33,11,1,25,NULL,'11_33'),
 (289,12,0,1,6,NULL,'12'),
 (386,7,0,4,1,NULL,'7'),
 (387,1,7,4,1,NULL,'7_1'),
 (388,2,7,4,2,NULL,'7_2'),
 (389,3,7,4,3,NULL,'7_3'),
 (390,15,7,4,4,NULL,'7_15'),
 (391,9,0,4,2,NULL,'9'),
 (392,17,9,4,5,NULL,'9_17'),
 (393,18,9,4,6,NULL,'9_18'),
 (394,19,9,4,7,NULL,'9_19'),
 (395,8,0,4,3,NULL,'8'),
 (396,4,8,4,8,NULL,'8_4'),
 (397,5,8,4,9,NULL,'8_5'),
 (398,6,8,4,10,NULL,'8_6');
/*!40000 ALTER TABLE `t_menus` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_message`
--

DROP TABLE IF EXISTS `t_message`;
CREATE TABLE `t_message` (
  `INT_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VCH_CONTENT_E` text NOT NULL,
  `VCH_CONTENT_O` text,
  `INT_PAGETYPE_ID` tinyint(4) unsigned NOT NULL,
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `INT_CREATED_BY` int(10) unsigned NOT NULL,
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `INT_UPDATED_BY` int(10) unsigned DEFAULT NULL,
  `BIT_DELETED_FLAG` bit(1) DEFAULT b'0',
  `INT_PUBLISH_STATUS` int(10) unsigned NOT NULL,
  `INT_ARCHIVE_STATUS` int(10) unsigned NOT NULL,
  PRIMARY KEY (`INT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_message`
--

/*!40000 ALTER TABLE `t_message` DISABLE KEYS */;
INSERT INTO `t_message` (`INT_ID`,`VCH_CONTENT_E`,`VCH_CONTENT_O`,`INT_PAGETYPE_ID`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`) VALUES 
 (1,'Give your feedback for odisha road safety.Give your feedback for odisha road safety.Give your feedback for odisha road safety.Give your feedback for odisha road safety.','',3,'2020-12-23 11:26:50',1,'2020-12-24 11:10:14',1,'\0',2,0),
 (2,'This page is intended to allow you to submit your positive comments and compliments about our staff and organization to us. If you wish to make a complaint about one of our members or our Service, please choose the other options.\r\n\r\nThis form is intended for positive compliments about our members and service only, and is only checked periodically during normal business hours. We will only respond to messages that are written in a respectful manner.\r\n\r\nPlease provide the details about your interaction with our Service and/or our members in the box below.','',1,'2020-12-23 12:57:36',1,'2020-12-24 12:50:26',1,'\0',2,0),
 (3,'test','test',2,'2020-12-23 13:00:54',1,'2020-12-23 13:01:16',0,'',2,0);
INSERT INTO `t_message` (`INT_ID`,`VCH_CONTENT_E`,`VCH_CONTENT_O`,`INT_PAGETYPE_ID`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`) VALUES 
 (4,'This page is intended to allow you to submit your feedback about our staff and organization to us.This page is intended to allow you to submit your feedback about our staff and organization to us.','This page is intended to allow you to submit your feedback about our staff and organization to us.',3,'2020-12-24 12:47:41',1,'2020-12-24 13:06:02',1,'\0',2,0),
 (5,'This page is intended to allow you to submit your Complaint about our staff and organization to us.','',2,'2020-12-28 09:49:59',1,'2020-12-28 10:29:00',1,'\0',2,0),
 (6,'This page is intended to allow you to submit your Complaint about our staff and organization to us. Complaint should be in respectful manner.','',2,'2020-12-28 10:30:08',1,'2020-12-28 10:30:51',0,'\0',2,0);
/*!40000 ALTER TABLE `t_message` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_mobile`
--

DROP TABLE IF EXISTS `t_mobile`;
CREATE TABLE `t_mobile` (
  `INT_MOB_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VCH_MOBILE_NO` varchar(16) NOT NULL,
  `INT_DIR_ID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`INT_MOB_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_mobile`
--

/*!40000 ALTER TABLE `t_mobile` DISABLE KEYS */;
INSERT INTO `t_mobile` (`INT_MOB_ID`,`VCH_MOBILE_NO`,`INT_DIR_ID`) VALUES 
 (14,'9937025635',7),
 (15,'9238500079',5),
 (16,'',3),
 (25,'8763283849',4),
 (26,'9337111783',6),
 (27,'9876544444',1),
 (38,'909011219022',19),
 (39,'898199112211',19),
 (45,'9437007955',29),
 (47,'9438731597',32),
 (52,'9437130299',24),
 (56,'9437494100',28),
 (57,'9439491122',33),
 (58,'9437742744',36),
 (60,'9437486458',39),
 (62,'9437351332',41),
 (64,'9090909090',45);
/*!40000 ALTER TABLE `t_mobile` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_notification`
--

DROP TABLE IF EXISTS `t_notification`;
CREATE TABLE `t_notification` (
  `INT_NOTIFICATION_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VCH_HEADLINE` varchar(128) NOT NULL,
  `VCH_DOCUMENT` text,
  `INT_PUBLISH_STATUS` int(10) unsigned NOT NULL,
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `INT_CREATED_BY` int(10) unsigned NOT NULL,
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `INT_UPDATED_BY` int(10) unsigned DEFAULT NULL,
  `BIT_DELETED_FLAG` tinyint(2) NOT NULL DEFAULT '0',
  `INT_PLUGIN_TYPE` int(10) unsigned DEFAULT NULL,
  `DTM_NOTIFICATION_DATE` datetime NOT NULL,
  `INT_ARC_STATUS` int(10) unsigned DEFAULT NULL,
  `VCH_HEADLINE_O` text,
  `INT_BLINK_STATUS` int(11) DEFAULT NULL,
  `INT_LINK_TYPE` int(10) unsigned DEFAULT NULL,
  `VCH_CODE` varchar(20) DEFAULT NULL,
  `DTM_NOTICE_START` datetime DEFAULT NULL,
  `INT_URL_TYPE` smallint(2) NOT NULL DEFAULT '1',
  `INT_TEMPLATE_TYPE` smallint(2) NOT NULL DEFAULT '2',
  `INT_WIN_STATUS` smallint(2) NOT NULL DEFAULT '2',
  `INT_PLUGIN_ID` smallint(2) DEFAULT NULL,
  `VCH_URL` varchar(128) DEFAULT NULL,
  `VCH_DETAILE` mediumtext,
  `VCH_DETAILO` mediumtext,
  `INT_SLNO` smallint(9) NOT NULL,
  PRIMARY KEY (`INT_NOTIFICATION_ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=309 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_notification`
--

/*!40000 ALTER TABLE `t_notification` DISABLE KEYS */;
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (1,'Tender 1r','\"\"',2,'2016-09-30 10:33:54',1,'2016-10-17 17:42:45',1,1,0,'2016-10-05 00:00:00',1,'sdad',1,2,'TN001','2016-09-30 00:00:00',1,2,2,NULL,NULL,NULL,NULL,149),
 (3,'Route Rationalization 15','\"\",\"\",\"\"',2,'2016-09-30 10:37:58',1,'2016-10-04 11:57:25',1,1,0,'1970-01-01 00:00:00',1,'',0,3,'','2016-10-13 00:00:00',1,2,2,NULL,NULL,NULL,NULL,150),
 (10,'yyyybbbnnn','\"document_0_1475223100.pdf\",\"document_1_1475223338.pdf\",\"document_2_1475223338.pdf\"',2,'2016-09-30 13:46:32',1,'2016-10-19 13:33:31',1,1,1,'1970-01-01 00:00:00',1,'',1,1,'yy99','2016-09-30 00:00:00',1,2,2,NULL,NULL,NULL,NULL,151),
 (17,'test','\"document_0_1475231599.pdf\"',1,'2016-09-30 16:05:20',1,'2016-10-28 10:51:08',1,1,1,'1970-01-01 00:00:00',1,'test',1,1,'test','2016-09-30 00:00:00',1,2,2,NULL,NULL,NULL,NULL,152);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (22,'fdsfd3ervvb','\"document_0_1475231943.pdf\",\"document_1_1475232283.pdf\"',1,'2016-09-30 16:14:44',1,'2016-10-29 10:18:23',1,1,0,'2016-09-30 00:00:00',1,'',0,3,'fdsg','2016-09-30 00:00:00',1,2,2,NULL,NULL,NULL,NULL,153),
 (24,'ghgu','\"document_0_1475316404.pdf\",\"\",\"document_2_1475316404.pdf\",\"document_3_1475316404.pdf\"',2,'2016-10-01 15:48:06',1,'2016-10-04 11:57:25',1,1,0,'1970-01-01 00:00:00',1,'',0,3,'','2016-10-01 00:00:00',1,2,2,NULL,NULL,NULL,NULL,154),
 (25,'Circular 12','\"document_0_1475228205.pdf\"',1,'2016-10-03 11:32:37',1,'2016-10-28 16:15:41',1,0,3,'1970-01-01 00:00:00',2,'',1,1,'NT009','2016-10-05 00:00:00',1,2,2,NULL,NULL,NULL,NULL,155),
 (26,'Route Vacancy Notification 1','\"document_0_1475474780.pdf\"',1,'2016-10-03 11:36:20',1,'2016-11-04 15:43:13',0,0,2,'0000-00-00 00:00:00',2,'Route Vacancy Notification 1',1,1,'RV0008','2016-10-07 00:00:00',1,2,2,NULL,NULL,NULL,NULL,156);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (29,'Cuttack-Astranga','\"document_0_1475562786.pdf\",\"document_1_1475562786.pdf\",\"document_2_1475562786.pdf\"',1,'2016-10-04 12:03:06',1,'2016-10-29 10:18:23',1,1,0,'0000-00-00 00:00:00',1,'Cuttack-Astranga',0,3,'','2016-10-04 00:00:00',1,2,2,NULL,NULL,NULL,NULL,157),
 (32,'Gkjagsg sadghas d','\"document_0_1476357419.pdf\"',1,'2016-10-13 16:46:59',1,'2016-10-28 13:29:26',1,1,0,'2016-10-14 00:00:00',1,'Gkashdf asjgdas',0,2,'GFH1243','2016-10-18 00:00:00',1,2,2,NULL,NULL,NULL,NULL,158),
 (34,'JHKJHKJ','\"document_0_1476705408.pdf\",\"document_1_1476705686.pdf\"',1,'2016-10-17 17:31:26',1,'2016-10-28 13:29:26',1,1,0,'2016-10-19 00:00:00',1,'asdasdasd',0,2,'GHG456','2016-10-18 00:00:00',1,2,2,NULL,NULL,NULL,NULL,159),
 (36,'Notification 2','\"document_0_1476864635.pdf\"',1,'2016-10-19 14:37:33',1,'2016-10-25 15:28:24',1,0,1,'1970-01-01 00:00:00',2,'Notification 2',1,1,'GH4578','2016-10-25 00:00:00',1,2,2,NULL,NULL,NULL,NULL,160);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (41,'Orissa Motor Vehicles (Licensing of Agents) Rules 1993','\"document_0_1605851326.pdf\"',2,'2016-10-25 15:25:05',1,'2020-11-20 11:18:07',1,0,1,'0000-00-00 00:00:00',2,'',0,1,'1428','1993-10-20 00:00:00',1,2,2,0,'','','',161),
 (42,'Gazette Notification dated 18th Nov 1996','\"document_0_1477389668.pdf\"',2,'2016-10-25 15:31:08',1,NULL,NULL,0,1,'0000-00-00 00:00:00',2,'',0,1,'1207','1996-11-18 00:00:00',1,2,2,NULL,NULL,NULL,NULL,162),
 (43,'Orissa Motor Vehicles Taxation (Amendment) Act) Act 2004','\"document_0_1477389773.pdf\"',2,'2016-10-25 15:32:53',1,NULL,NULL,0,1,'0000-00-00 00:00:00',2,'',0,1,'370','2005-02-25 00:00:00',1,2,2,NULL,NULL,NULL,NULL,163),
 (44,'Notice dated 9th Oct 2006','\"document_0_1477389898.pdf\"',2,'2016-10-25 15:34:58',1,NULL,NULL,0,1,'0000-00-00 00:00:00',2,'',0,1,'8672','2006-10-09 00:00:00',1,2,2,NULL,NULL,NULL,NULL,164);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (46,'Resolution No-4267-LC-TR-55/2014(Pt)/T','\"document_0_1477638993.pdf\"',2,'2016-10-28 12:46:33',1,NULL,NULL,0,1,'0000-00-00 00:00:00',2,'',0,1,'4267','2014-07-22 00:00:00',1,2,2,NULL,NULL,NULL,NULL,165),
 (47,'Online Auction of Fancy Numbers','\"document_0_1477639354.pdf\"',2,'2016-10-28 12:52:35',1,NULL,NULL,0,1,'0000-00-00 00:00:00',2,'',0,1,'17005','2015-12-05 00:00:00',1,2,2,NULL,NULL,NULL,NULL,166),
 (48,'EOI for Empanelment of LMV DTIs under Govt. Funded Scheme','\"document_0_1477639417.pdf\"',2,'2016-10-28 12:53:37',1,NULL,NULL,0,1,'0000-00-00 00:00:00',2,'',0,1,'EoI','2016-02-06 00:00:00',1,2,2,NULL,NULL,NULL,NULL,167),
 (49,'Fitment of speed governors on different types of Transport vehicles in the State','\"document_0_1477639487.pdf\"',2,'2016-10-28 12:54:47',1,NULL,NULL,0,1,'0000-00-00 00:00:00',2,'',0,1,'809','2016-05-05 00:00:00',1,2,2,NULL,NULL,NULL,NULL,168);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (50,'Fitment of speed governors on different types of Transport vehicles in the State','\"document_0_1477639767.pdf\"',2,'2016-10-28 12:59:27',1,NULL,NULL,0,5,'0000-00-00 00:00:00',2,'',0,1,'11084','2016-07-19 00:00:00',1,2,2,NULL,NULL,NULL,NULL,169),
 (51,'Circulation of Authorisation for Fitment of Speed Governor in all kinds of Transport Vehicles','\"document_0_1477639864.pdf\"',2,'2016-10-28 13:01:04',1,NULL,NULL,0,5,'0000-00-00 00:00:00',2,'',0,1,'11604','2016-07-29 00:00:00',1,2,2,NULL,NULL,NULL,NULL,170),
 (52,'Circulation of Authorisation for Fitment of Speed Governor in all kinds of Transport Vehicles','\"document_0_1477639917.pdf\"',2,'2016-10-28 13:01:57',1,NULL,NULL,0,5,'0000-00-00 00:00:00',2,'',0,1,'11834','2016-08-01 00:00:00',1,2,2,NULL,NULL,NULL,NULL,171),
 (53,'Circulation of Authorisation for Fitment of Speed Governor in all kinds of Transport Vehicles','\"document_0_1477639981.pdf\"',2,'2016-10-28 13:03:01',1,NULL,NULL,0,5,'0000-00-00 00:00:00',2,'',0,1,'11905','2016-08-02 00:00:00',1,2,2,NULL,NULL,NULL,NULL,172);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (54,'Circulation of Authorisation for Fitment of Speed Governor in all kinds of Transport Vehicles','\"document_0_1477640029.pdf\"',2,'2016-10-28 13:03:49',1,NULL,NULL,0,5,'0000-00-00 00:00:00',2,'',0,1,'12165','2016-08-08 00:00:00',1,2,2,NULL,NULL,NULL,NULL,173),
 (55,'Circulation of Authorisation for Fitment of Speed Governor in all kinds of Transport Vehicles','\"document_0_1477640088.pdf\"',2,'2016-10-28 13:04:48',1,NULL,NULL,0,5,'0000-00-00 00:00:00',2,'',0,1,'12248','2016-08-09 00:00:00',1,2,2,NULL,NULL,NULL,NULL,174),
 (56,'Office Order Fitment of Speed Governor of Ecogas Impex','\"document_0_1477640145.pdf\"',2,'2016-10-28 13:05:45',1,NULL,NULL,0,5,'0000-00-00 00:00:00',2,'',0,1,'13949','2016-09-03 00:00:00',1,2,2,NULL,NULL,NULL,NULL,175),
 (57,'Office Order Fitment of Speed Governor of GRL Engineers','\"document_0_1477640195.pdf\"',2,'2016-10-28 13:06:35',1,NULL,NULL,0,5,'0000-00-00 00:00:00',2,'',0,1,'13952','2016-09-03 00:00:00',1,2,2,NULL,NULL,NULL,NULL,176);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (58,'Office Order Fitment of Speed Governor of Craysol','\"document_0_1477640250.pdf\"',2,'2016-10-28 13:07:30',1,NULL,NULL,0,5,'0000-00-00 00:00:00',2,'',0,1,'13955','2016-09-03 00:00:00',1,2,2,NULL,NULL,NULL,NULL,177),
 (59,'TENDER FOR POLLUTION TESTING EQUIPMENTS','\"document_0_1477641033.pdf\"',2,'2016-10-28 13:20:33',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'8932','2015-07-13 00:00:00',1,2,2,NULL,NULL,NULL,NULL,178),
 (60,'TENDER FOR DRIVING SIMULATOR','\"document_0_1477641122.pdf\"',2,'2016-10-28 13:22:02',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'8831','2015-07-13 00:00:00',1,2,2,NULL,NULL,NULL,NULL,179),
 (61,'TENDER FOR CALL CENTER (ToR)','\"document_0_1477641191.pdf\"',2,'2016-10-28 13:23:11',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'8151','2015-07-13 00:00:00',1,2,2,NULL,NULL,NULL,NULL,180);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (62,'TENDER FOR CALL CENTER (RFP)','\"document_0_1477641246.pdf\"',2,'2016-10-28 13:24:06',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'8151','2015-07-13 00:00:00',1,2,2,NULL,NULL,NULL,NULL,181),
 (63,'MODIFIED HIGH SECURITY REGISTRATION PLATES BID DOCUMENT','\"document_0_1477641803.pdf\"',2,'2016-10-28 13:33:23',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'9428','2015-07-22 00:00:00',1,2,2,NULL,NULL,NULL,NULL,182),
 (64,'CORRIGENDUM TO TENDER NO 8831,8932,7973','\"document_0_1477641862.pdf\"',2,'2016-10-28 13:34:22',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'9432','2015-07-22 00:00:00',1,2,2,NULL,NULL,NULL,NULL,183),
 (65,'CORRIGENDUM ON HIGH SECURITY REGISTRATION PLATES','\"document_0_1477641960.pdf\"',2,'2016-10-28 13:36:00',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'9428','2015-07-22 00:00:00',1,2,2,NULL,NULL,NULL,NULL,184);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (66,'TENDER FOR SUPPLY AND INSTALLATION OF 35 KVA DG SET','\"document_0_1477642034.pdf\"',2,'2016-10-28 13:37:14',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'9805','2015-07-28 00:00:00',1,2,2,NULL,NULL,NULL,NULL,185),
 (67,'CORRIGENDUM TO TENDER NO 9805/TC','\"document_0_1477642087.pdf\"',2,'2016-10-28 13:38:07',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'10571','2015-08-13 00:00:00',1,2,2,NULL,NULL,NULL,NULL,186),
 (68,'TENDER FOR AUTOMATION OF DRIVING TEST TRACK CENTRES (ADTS) CONTRACT','\"document_0_1477642551.pdf\"',2,'2016-10-28 13:45:51',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'RFP','2015-08-17 00:00:00',1,2,2,NULL,NULL,NULL,NULL,187),
 (69,'TENDER FOR AUTOMATION OF DRIVING TEST TRACK CENTRES (ADTS) BID DOCUMENT','\"document_0_1477642637.pdf\"',2,'2016-10-28 13:47:17',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'RFP','2015-08-17 00:00:00',1,2,2,NULL,NULL,NULL,NULL,188);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (70,'NOTICE OF AUTOMATION OF DRIVING TEST TRACK CENTRES (ADTS)','\"document_0_1477642783.pdf\"',2,'2016-10-28 13:49:43',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'10625','2015-08-18 00:00:00',1,2,2,NULL,NULL,NULL,NULL,189),
 (71,'TENDER FOR PURCHASE OF POLLUTION TESTING EQUIPMENTS','\"document_0_1477642855.pdf\"',2,'2016-10-28 13:50:55',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'11857','2015-09-08 00:00:00',1,2,2,NULL,NULL,NULL,NULL,190),
 (72,'Corrigendum to Tender call notice no: 8832/08-07-15','\"document_0_1477643072.pdf\"',2,'2016-10-28 13:54:32',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'11856','2015-09-08 00:00:00',1,2,2,NULL,NULL,NULL,NULL,191),
 (73,'Tender for Purchase of Highway Interceptor based on Tata Winger','\"document_0_1477643148.pdf\"',2,'2016-10-28 13:55:48',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'12208','2015-09-14 00:00:00',1,2,2,NULL,NULL,NULL,NULL,192);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (74,'RESPONSE TO PRE BID AUTOMATED DRIVING TEST TRACK CENTRES','\"document_0_1477643228.pdf\"',2,'2016-10-28 13:57:08',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'12156','2015-09-22 00:00:00',1,2,2,NULL,NULL,NULL,NULL,193),
 (75,'NOTICE FOR AUTOMATED DRIVING TEST TRACK CENTRES','\"document_0_1477643288.pdf\"',2,'2016-10-28 13:58:08',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'12156','2015-09-22 00:00:00',1,2,2,NULL,NULL,NULL,NULL,194),
 (76,'DL TESTING DATA SHEET FOR 2014-15','\"document_0_1477643440.pdf\"',2,'2016-10-28 14:00:40',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'Ref','2015-09-22 00:00:00',1,2,2,NULL,NULL,NULL,NULL,195),
 (77,'CONTRACT FOR AUTOMATED DRIVING TEST TRACK CENTRES','\"document_0_1477643492.pdf\"',2,'2016-10-28 14:01:32',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'12156','2015-09-22 00:00:00',1,2,2,NULL,NULL,NULL,NULL,196);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (78,'BID FOR AUTOMATED DRIVING TEST TRACK CENTRES','\"document_0_1477643621.pdf\"',2,'2016-10-28 14:03:41',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'12156','2015-09-22 00:00:00',1,2,2,NULL,NULL,NULL,NULL,197),
 (79,'TENDER FOR DRIVING TRAINING SIMULATOR','\"document_0_1477643694.pdf\"',2,'2016-10-28 14:04:54',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'13398','2015-10-09 00:00:00',1,2,2,NULL,NULL,NULL,NULL,198),
 (80,'CORRIGENDUM TO TENDER NO 12156/TC','\"document_0_1477643895.pdf\"',2,'2016-10-28 14:08:15',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'13529','2015-10-14 00:00:00',1,2,2,NULL,NULL,NULL,NULL,199),
 (81,'Payment Gateway Facility for Fancy Registration Number Auction System Notice','\"document_0_1477643939.pdf\"',2,'2016-10-28 14:08:59',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'4393','2016-03-21 00:00:00',1,2,2,NULL,NULL,NULL,NULL,200);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (82,'Tender For Purchase of Cranes','\"document_0_1477643986.pdf\"',2,'2016-10-28 14:09:46',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'4714','2016-03-29 00:00:00',1,2,2,NULL,NULL,NULL,NULL,201),
 (83,'EOI FOR PAYMENT GATEWAY FOR FANCY NUMBER AUCTION','\"document_0_1477644100.pdf\"',2,'2016-10-28 14:11:40',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'4393','2016-04-02 00:00:00',1,2,2,NULL,NULL,NULL,NULL,202),
 (84,'RFP FOR SUPPLY OF SPEED GOVERNOR','\"document_0_1477644185.pdf\"',2,'2016-10-28 14:13:05',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'7233','2016-05-09 00:00:00',1,2,2,NULL,NULL,NULL,NULL,203),
 (85,'NOTICE FOR SUPPLY OF SPEED GOVERNOR','\"document_0_1477644244.pdf\"',2,'2016-10-28 14:14:04',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'8064','2016-05-25 00:00:00',1,2,2,NULL,NULL,NULL,NULL,204);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (86,'TENDER FOR SUPPLY OF FIRST-AID-KITS','\"document_0_1477644289.pdf\"',2,'2016-10-28 14:14:49',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'9149','2016-06-17 00:00:00',1,2,2,NULL,NULL,NULL,NULL,205),
 (87,'ROUTE VACANCY','\"document_0_1477650152.pdf\"',2,'2016-10-28 15:52:32',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',0,1,'1','2013-10-08 00:00:00',1,2,2,NULL,NULL,NULL,NULL,206),
 (88,'CUTTACK TO NARSINGHPUR ROUTE','\"document_0_1477650764.pdf\"',2,'2016-10-28 16:02:44',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',0,1,'2','2014-01-15 00:00:00',1,2,2,NULL,NULL,NULL,NULL,207),
 (89,'NARSINGHPUR TO CUTTACK ROUTE','\"document_0_1477650820.pdf\"',2,'2016-10-28 16:03:40',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',0,1,'3','2014-01-15 00:00:00',1,2,2,NULL,NULL,NULL,NULL,208);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (91,'INTER REGION ROUTE VACANCY','\"document_0_1477650932.pdf\"',2,'2016-10-28 16:05:32',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',0,1,'5','2014-02-14 00:00:00',1,2,2,NULL,NULL,NULL,NULL,209),
 (92,'ROUTE VACANCY','\"document_0_1477650858.pdf\"',2,'2016-10-28 16:06:31',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',0,1,'4','2014-02-12 00:00:00',1,2,2,NULL,NULL,NULL,NULL,210),
 (93,'NOTIFICATION OF ROUTE (INTER REGION)','\"document_0_1477651054.pdf\"',2,'2016-10-28 16:07:34',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',0,1,'6','2014-02-28 00:00:00',1,2,2,NULL,NULL,NULL,NULL,211),
 (94,'INTER STATE ROUTE VACANCY','\"document_0_1477651139.pdf\"',2,'2016-10-28 16:08:59',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',0,1,'7','2014-03-07 00:00:00',1,2,2,NULL,NULL,NULL,NULL,212);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (95,'INTER REGION ROUTE VACANCY','\"document_0_1477651182.pdf\"',2,'2016-10-28 16:09:42',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',0,1,'8','2014-07-07 00:00:00',1,2,2,NULL,NULL,NULL,NULL,213),
 (96,'INTER REGION ROUTE VACANCY','\"document_0_1477651239.pdf\"',2,'2016-10-28 16:10:39',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',0,1,'9','2014-09-01 00:00:00',1,2,2,NULL,NULL,NULL,NULL,214),
 (97,'NOTIFICATION ROUTE (INTER-REGION)','\"document_0_1477651277.pdf\"',2,'2016-10-28 16:11:17',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',0,1,'10','2015-01-15 00:00:00',1,2,2,NULL,NULL,NULL,NULL,215),
 (98,'PUBLICATION OF CORRIGENDUM(15.01.2015) NOTIFICATION','\"document_0_1477651332.pdf\"',2,'2016-10-28 16:12:12',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',0,1,'11','2015-01-22 00:00:00',1,2,2,NULL,NULL,NULL,NULL,216);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (99,'ROUTE VACANCY','\"document_0_1477651377.pdf\"',2,'2016-10-28 16:12:57',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',0,1,'12','2015-05-14 00:00:00',1,2,2,NULL,NULL,NULL,NULL,217),
 (100,'Meeting on 04/09/2015(New Applied Routes)','\"document_0_1477651427.pdf\"',2,'2016-10-28 16:13:47',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',0,1,'13','2015-08-18 00:00:00',1,2,2,NULL,NULL,NULL,NULL,218),
 (101,'NOTIFICATION ROUTE VACANCY','\"document_0_1477651483.pdf\"',2,'2016-10-28 16:14:43',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',0,1,'14','2016-03-22 00:00:00',1,2,2,NULL,NULL,NULL,NULL,219),
 (103,'CHANDIKHOL-PARADEEP','\"document_0_1477715545.pdf\",\"document_1_1477715545.pdf\"',2,'2016-10-29 10:02:26',1,'2016-10-29 10:35:49',1,0,0,'0000-00-00 00:00:00',1,'',0,3,'','2016-10-19 00:00:00',1,2,2,NULL,NULL,NULL,NULL,220);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (104,'PATTAMUNDAI-KENDRAPARA-PARADEEP','\"document_0_1477715826.pdf\",\"document_1_1477715826.pdf\"',2,'2016-10-29 10:07:06',1,'2016-10-29 10:18:23',1,1,0,'0000-00-00 00:00:00',1,'',0,3,'','2016-10-04 00:00:00',1,2,2,NULL,NULL,NULL,NULL,221),
 (105,'PATTAMUNDAI-PARADEEP','\"document_0_1477716027.pdf\",\"document_1_1477716027.pdf\"',2,'2016-10-29 10:10:27',1,'2016-10-29 10:18:23',1,1,0,'0000-00-00 00:00:00',1,'',0,3,'','2016-10-04 00:00:00',1,2,2,NULL,NULL,NULL,NULL,222),
 (108,'CUTTACK-KENDRAPARA','\"document_0_1477715261.pdf\",\"document_1_1477715261.pdf\",\"document_2_1477715261.pdf\",\"document_3_1477715261.pdf\"',2,'2016-10-29 10:26:55',1,'2016-10-29 10:35:49',1,0,0,'0000-00-00 00:00:00',1,'',0,3,'','2016-10-21 00:00:00',1,2,2,NULL,NULL,NULL,NULL,223),
 (109,'KENDRAPARA-PARADEEP','\"document_0_1477716921.pdf\",\"document_1_1477716921.pdf\"',2,'2016-10-29 10:27:31',1,'2016-10-29 10:35:49',1,0,0,'0000-00-00 00:00:00',1,'',0,3,'','2016-10-04 00:00:00',1,2,2,NULL,NULL,NULL,NULL,224);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (110,'BHUBANESWAR-BERHAMPUR','\"document_0_1477717420.pdf\",\"document_1_1477717420.pdf\"',2,'2016-10-29 10:33:40',1,'2016-10-29 10:35:49',1,0,0,'0000-00-00 00:00:00',1,'',0,3,'','2016-10-29 00:00:00',1,2,2,NULL,NULL,NULL,NULL,225),
 (111,'Demonstration of performance of Speed limiting Devices through on road trials','\"document_0_1477718678.pdf\"',2,'2016-10-29 10:54:38',1,NULL,NULL,0,5,'0000-00-00 00:00:00',2,'',0,1,'14983','2016-09-22 00:00:00',1,2,2,NULL,NULL,NULL,NULL,226),
 (114,'CUTTACK-PARADEEP','\"document_0_1477719717.pdf\",\"document_1_1477719717.pdf\",\"document_2_1477719717.pdf\",\"document_3_1477719717.pdf\",\"document_4_1477719717.pdf\",\"document_5_1477719717.pdf\"',2,'2016-10-29 11:11:57',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2016-10-29 00:00:00',1,2,2,NULL,NULL,NULL,NULL,18),
 (117,'CUTTACK-JAGATSINGHPUR','\"document_0_1477720590.pdf\"',2,'2016-10-29 11:26:30',1,'2016-10-29 11:35:21',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2016-10-29 00:00:00',1,2,2,NULL,NULL,NULL,NULL,17);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (118,'CUTTACK-ASTARANGA','\"document_0_1477721100.pdf\",\"document_1_1477721100.pdf\",\"document_2_1477721100.pdf\",\"document_3_1477721100.pdf\",\"document_4_1477721100.pdf\",\"document_5_1477721100.pdf\"',2,'2016-10-29 11:35:00',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2016-10-29 00:00:00',1,2,2,NULL,NULL,NULL,NULL,16),
 (119,'BBSR-ASTARANGA','\"document_0_1477721390.pdf\",\"document_1_1477721390.pdf\"',2,'2016-10-29 11:39:50',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2016-10-29 00:00:00',1,2,2,NULL,NULL,NULL,NULL,15),
 (120,'Office order of Fitment of Speed Governor of Pricol','\"document_0_1477721817.pdf\"',2,'2016-10-29 11:46:57',1,NULL,NULL,0,5,'0000-00-00 00:00:00',2,'',0,1,'15456','2016-10-01 00:00:00',1,2,2,NULL,NULL,NULL,NULL,231);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (121,'BARGARH-SAMBALPUR-SUNDARGARH','\"document_0_1477721828.pdf\",\"document_1_1477721828.pdf\",\"document_2_1477721828.pdf\",\"document_3_1477721828.pdf\"',2,'2016-10-29 11:47:08',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2016-10-29 00:00:00',1,2,2,NULL,NULL,NULL,NULL,14),
 (122,'List of Speed Governor Manufacturers and Instruction for Public','\"document_0_1477721995.pdf\"',2,'2016-10-29 11:49:55',1,NULL,NULL,0,5,'0000-00-00 00:00:00',2,'',0,1,'16078','2016-10-17 00:00:00',1,2,2,NULL,NULL,NULL,NULL,233),
 (123,'Office Order Fitment of Speed Governor of Digila Devices','\"document_0_1477722321.pdf\"',2,'2016-10-29 11:55:21',1,NULL,NULL,0,5,'0000-00-00 00:00:00',2,'',0,1,'13958','2016-09-03 00:00:00',1,2,2,NULL,NULL,NULL,NULL,234),
 (127,'Office Order Fitment of Speed Governor of Digila Devices','\"document_0_1477724397.pdf\"',2,'2016-10-29 12:29:57',0,NULL,NULL,0,5,'0000-00-00 00:00:00',2,'',0,1,'13958','2016-09-03 00:00:00',1,2,2,NULL,NULL,NULL,NULL,235);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (130,'Registration','',2,'2016-11-04 15:46:10',1,'2016-11-04 15:48:12',0,0,2,'0000-00-00 00:00:00',2,'Registration',0,1,'1','2016-11-04 00:00:00',2,1,2,0,'http://as2.ori.nic.in:8080/web/regi.jsp','','',236),
 (131,'Taxation','',2,'2016-11-04 16:00:28',1,NULL,NULL,0,2,'0000-00-00 00:00:00',2,'',0,1,'2','2016-11-04 00:00:00',2,1,2,0,'http://as2.ori.nic.in:8080/web/taxation.jsp','','',237),
 (132,'Licence','',2,'2016-11-04 16:02:39',1,NULL,NULL,0,2,'0000-00-00 00:00:00',2,'',0,1,'3','2016-11-04 00:00:00',2,1,2,0,'http://as2.ori.nic.in:8080/web/licence.jsp','','',238),
 (133,'Permit','',2,'2016-11-04 16:03:48',1,NULL,NULL,0,2,'0000-00-00 00:00:00',2,'',0,1,'4','2016-11-04 00:00:00',2,1,2,0,'http://as2.ori.nic.in:8080/web/permit.jsp','','',239);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (134,'Off-Road','',2,'2016-11-04 16:04:50',1,NULL,NULL,0,2,'0000-00-00 00:00:00',2,'',0,1,'5','2016-11-04 00:00:00',2,1,2,0,'http://as2.ori.nic.in:8080/web/off_road.jsp','','',240),
 (135,'Transfer of Ownership','',2,'2016-11-04 16:05:59',1,NULL,NULL,0,2,'0000-00-00 00:00:00',2,'',0,1,'6','2016-11-04 00:00:00',2,1,2,0,'http://as2.ori.nic.in:8080/web/tr_own.jsp','','',241),
 (136,'Administration','',2,'2016-11-04 16:07:11',1,NULL,NULL,0,2,'0000-00-00 00:00:00',2,'',0,1,'7','2016-11-04 00:00:00',2,1,2,0,'http://as2.ori.nic.in:8080/web/admin.jsp','','',242),
 (139,'Application for Hydraulic Multi Axle Trailers','\"document_0_1478256942.pdf\"',2,'2016-11-04 16:25:42',1,NULL,NULL,0,2,'0000-00-00 00:00:00',2,'',0,1,'8','2016-11-04 00:00:00',1,2,2,0,'','','',243);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (140,'Application for Permit on Vacant Routes','\"document_0_1478257814.pdf\"',2,'2016-11-04 16:40:14',1,NULL,NULL,0,2,'0000-00-00 00:00:00',2,'',0,1,'9','2016-11-04 00:00:00',1,2,2,0,'','','',244),
 (141,'Special Permit and Contract carriage Permit on Inter Regional Routes','\"document_0_1504867942.pdf\"',2,'2016-11-04 16:44:05',1,'2017-09-08 16:23:12',1,0,2,'0000-00-00 00:00:00',1,'',0,1,'10','2016-11-04 00:00:00',1,2,2,0,'','','',245),
 (142,'BHUBANESWAR-BARIPADA(DRAFT)','\"document_0_1477718815.pdf\",\"document_1_1477718815.pdf\",\"document_2_1477718815.pdf\",\"document_3_1477718815.pdf\",\"document_4_1477718815.pdf\",\"document_5_1477718815.pdf\",\"document_6_1477718815.pdf\",\"document_7_1477718815.pdf\",\"document_8_1477718815.pdf\",\"document_9_1477718815.pdf\"',2,'2016-11-07 11:05:53',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2016-10-29 00:00:00',1,2,2,0,'','','',13),
 (143,'BHUBANESWAR-ANGUL(DRAFT)','\"document_0_1477719323.pdf\",\"document_1_1477719323.pdf\",\"document_2_1477719323.pdf\",\"document_3_1477719323.pdf\",\"document_4_1477719323.pdf\",\"document_5_1477719323.pdf\"',2,'2016-11-07 11:08:37',1,'2017-05-31 11:23:58',1,0,0,'0000-00-00 00:00:00',1,'',0,3,'','2016-10-29 00:00:00',1,2,2,0,'','','',247);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (144,'BBSR-NAYAGARH(DRAFT)','\"document_0_1477720361.pdf\",\"document_1_1477720361.pdf\",\"document_2_1477720361.pdf\",\"document_3_1477720361.pdf\",\"document_4_1477720361.pdf\",\"document_5_1477720361.pdf\"',2,'2016-11-07 11:09:59',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2016-10-29 00:00:00',1,2,2,0,'','','',12),
 (145,'BBSR-BERHAMPUR(DRAFT)','\"document_0_1477723010.pdf\",\"document_1_1477723010.pdf\",\"document_2_1477723010.pdf\",\"document_3_1477723010.pdf\",\"document_4_1477723010.pdf\",\"document_5_1477723010.pdf\"',2,'2016-11-07 11:11:05',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2016-10-29 00:00:00',1,2,2,0,'','','',11),
 (146,'CUTTACK-KENDRAPARA(DRAFT)','\"document_0_1477723408.pdf\",\"document_1_1477723408.pdf\",\"document_2_1477723408.pdf\",\"document_3_1477723408.pdf\"',2,'2016-11-07 11:12:14',1,'2017-05-31 11:21:59',1,0,0,'0000-00-00 00:00:00',1,'',0,3,'','2016-10-29 00:00:00',1,2,2,0,'','','',250);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (147,'CHANDIKHOL/KENDRAPARA-PARADEEP(DRAFT)','\"document_0_1477723885.pdf\",\"document_1_1477723885.pdf\",\"document_2_1477723885.pdf\",\"document_3_1477723885.pdf\"',2,'2016-11-07 11:15:46',1,'2017-05-31 11:22:59',1,0,0,'0000-00-00 00:00:00',1,'',0,3,'','2016-10-29 00:00:00',1,2,2,0,'','','',251),
 (148,'BHUBANESWAR-PURI(DRAFT)','\"document_0_1477727309.pdf\",\"document_1_1477727309.pdf\"',2,'2016-11-07 11:17:33',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2016-10-29 00:00:00',1,2,2,0,'','','',10),
 (149,'pentest&amp;lt;h1&amp;gt;HTMLinjection&amp;lt;/h1&amp;gt;','',1,'2016-11-30 14:52:22',1,'2017-09-02 12:33:30',1,0,2,'0000-00-00 00:00:00',2,'asdsa',1,1,'741852963','2016-12-01 00:00:00',1,1,2,0,'','','',253),
 (150,'CUTTACK-CHANDIKHOL/SALIPUR-KENDRAPARA-PATTAMUNDAI','\"document_0_1496210469.pdf\",\"document_1_1496210469.pdf\",\"document_2_1496210469.pdf\",\"document_3_1496210469.pdf\"',2,'2017-05-31 11:31:09',1,'2017-05-31 11:32:33',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2016-12-08 00:00:00',1,2,2,0,'','','',9);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (151,'CHANDIKHOL/PATTAMUNDAI/KENDRAPARA-PARADEEP','\"document_0_1496210758.pdf\",\"document_1_1496210758.pdf\",\"document_2_1496210758.pdf\",\"document_3_1496210758.pdf\"',2,'2017-05-31 11:35:58',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2016-12-08 00:00:00',1,2,2,0,'','','',8),
 (152,'BHUBANESWAR-DHENKANAL/ANGUL/TALCHER','\"document_0_1496212445.pdf\",\"document_1_1496212445.pdf\",\"document_2_1496212445.pdf\",\"document_3_1496212445.pdf\",\"document_4_1496212445.pdf\",\"document_5_1496212445.pdf\"',2,'2017-05-31 12:04:05',1,'2017-05-31 12:16:01',1,0,0,'0000-00-00 00:00:00',1,'',0,3,'','2017-04-11 00:00:00',1,2,2,0,'','','',256),
 (153,'SIGNED COPY OF CUTTACK-PATTAMUNDAI  CHANDIKHOLE-PARADEEP PATTAMUNDAI-PARADEEP ROUTE','\"document_0_1496213087.pdf\"',2,'2017-05-31 12:14:47',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2016-12-08 00:00:00',1,2,2,0,'','','',7);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (154,'BHUBANESWAR-DHENKANAL/ANGUL/TALCHER','\"document_0_1496213283.pdf\",\"document_1_1496213283.pdf\",\"document_2_1496213283.pdf\",\"document_3_1496213283.pdf\",\"document_4_1496213283.pdf\",\"document_5_1496213283.pdf\"',2,'2017-05-31 12:18:03',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2017-04-11 00:00:00',1,2,2,0,'','','',6),
 (155,'te','\"document_0_1496907875.pdf\"',2,'2017-06-08 13:14:35',1,'2017-06-08 13:16:09',1,0,0,'0000-00-00 00:00:00',1,'te',0,3,'','2017-06-08 00:00:00',1,2,2,0,'','','',259),
 (156,'Fitment of Speed Governor','\"document_0_1498807287.pdf\"',2,'2017-06-30 12:51:27',1,NULL,NULL,0,5,'0000-00-00 00:00:00',2,'',0,1,'2400','2017-02-23 00:00:00',1,2,2,0,'','','',260),
 (157,'Meeting on 18/03/2017(New Applied Routes)','\"document_0_1498807959.pdf\"',2,'2017-06-30 13:02:39',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',0,1,'1','2017-03-18 00:00:00',1,2,2,0,'','','',261);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (158,'ROUTE VACANCY','\"document_0_1498808900.pdf\"',2,'2017-06-30 13:18:20',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',0,1,'242','2017-07-04 00:00:00',1,2,2,0,'','','',262),
 (159,'TENDER FOR AUCTION OF VEHICLE OR05H5555','\"document_0_1498810074.pdf\"',2,'2017-06-30 13:37:54',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'1271','2017-01-31 00:00:00',1,2,2,0,'','','',263),
 (160,'TENDER FOR HIGH SECURITY REGISTRATION PLATE','\"document_0_1498810401.pdf\"',2,'2017-06-30 13:43:21',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'2834','2017-03-03 00:00:00',1,2,2,0,'','','',264),
 (161,'TENDER FOR FIRST AID KIT','\"document_0_1498810578.pdf\"',2,'2017-06-30 13:46:18',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'6688','2017-05-30 00:00:00',1,2,2,0,'','','',265);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (162,'TENDER FOR HIRE VEHICLE','\"document_0_1498810756.pdf\"',2,'2017-06-30 13:49:16',1,'2017-07-29 14:23:53',1,0,0,'0000-00-00 00:00:00',2,'',0,2,'7590','2017-06-23 00:00:00',1,2,2,0,'','','',266),
 (163,'BHUBANESWAR-KAKATPUR/KONARK(FINAL)','\"document_0_1498908003.pdf\"',1,'2017-07-01 16:50:03',1,'2017-09-20 13:22:51',1,0,0,'0000-00-00 00:00:00',1,'',0,3,'','2017-06-02 00:00:00',1,2,2,0,'','','',267),
 (164,'KAKATPUR/KONARK-BHUBANESWAR(FINAL)','\"document_0_1505893758.PDF\",\"document_1_1505893758.PDF\"',2,'2017-07-01 16:50:52',1,'2017-09-20 13:20:11',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2017-06-02 00:00:00',1,2,2,0,'','','',5),
 (165,'Tender for Auction of Weighbridge','\"document_0_1501318721.pdf\"',2,'2017-07-29 14:28:41',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'8692','2017-07-14 00:00:00',1,2,2,0,'','','',269);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (166,'Tender for Hire of Vehicle','\"document_0_1501318979.pdf\"',2,'2017-07-29 14:33:00',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'8780','2017-07-17 00:00:00',1,2,2,0,'','','',270),
 (167,'Notification For Purchase Fire Extinguisher','\"document_0_1501319143.pdf\"',2,'2017-07-29 14:35:43',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',0,2,'8838','2017-07-19 00:00:00',1,2,2,0,'','','',271),
 (168,'Special Permit / Contract carriage Permit Inter Regional Routes','\"document_0_1504866214.pdf\"',2,'2017-09-08 15:53:34',1,NULL,NULL,0,2,'0000-00-00 00:00:00',2,'',0,1,'12181','2012-08-31 00:00:00',1,2,2,0,'','','',272),
 (169,'Rectified Final Rationalized Timings on Cuttack-Salipur-Kendrapara-Pattamundai Route (Category-A) Published on 29-10-2017','\"document_0_1509190098.PDF\",\"document_1_1509190098.PDF\"',2,'2017-10-28 16:58:18',1,'2018-01-18 13:09:55',1,0,0,'0000-00-00 00:00:00',2,'Rectified Final Rationalized Timings on Cuttack-Salipur-Kendrapara-Pattamundai Route (Category-A) Published on 29-10-2017',0,3,'','2017-10-29 00:00:00',1,2,1,0,'','','',1);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (170,'Rectified Final Rationalized Timings on Cuttack-Chandikhole-Kendrapara_Pattamundai Route (Category-B) Published on 29-10-2017','\"document_0_1509190216.PDF\",\"document_1_1509190216.PDF\"',2,'2017-10-28 17:00:16',1,'2018-01-18 13:11:53',1,0,0,'0000-00-00 00:00:00',2,'Rectified Final Rationalized Timings on Cuttack-Chandikhole-Kendrapara_Pattamundai Route (Category-B) Published on 29-10-2017',0,3,'','2017-10-29 00:00:00',1,2,1,0,'','','',2),
 (171,'Rectified Final Rationalized Timings on Chandikhole-Duhuria-Paradeep Route (Category-C) Published on 29-10-2017','\"document_0_1509190265.PDF\",\"document_1_1509190265.PDF\"',2,'2017-10-28 17:01:05',1,'2018-01-18 13:13:49',1,0,0,'0000-00-00 00:00:00',2,'Rectified Final Rationalized Timings on Chandikhole-Duhuria-Paradeep Route (Category-C) Published on 29-10-2017',0,3,'','2017-10-29 00:00:00',1,2,1,0,'','','',3),
 (172,'Rectified Final Rationalized Timings on Pattamundai-Kendrapara-Duhuria-Paradeep Route (Category-D) Published on 29-10-2017','\"document_0_1509190312.PDF\",\"document_1_1509190312.PDF\"',2,'2017-10-28 17:01:52',1,'2018-01-18 13:15:14',1,0,0,'0000-00-00 00:00:00',2,'Rectified Final Rationalized Timings on Pattamundai-Kendrapara-Duhuria-Paradeep Route (Category-D) Published on 29-10-2017',0,3,'','2017-10-29 00:00:00',1,2,1,0,'','','',4);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (173,'Enhancement of M.V Tax / Addl. M.V Tax','\"document_0_1511594819.pdf\"',2,'2017-11-25 12:56:59',1,'2020-11-09 12:23:10',1,0,1,'0000-00-00 00:00:00',2,'Enhancement of M.V Tax / Addl. M.V Tax',0,1,'14143','2017-11-21 00:00:00',1,2,1,0,'','','',273),
 (174,'EOI for Development of Road Accident Management Information System','\"document_0_1512641148.pdf\"',2,'2017-12-07 15:35:48',1,'2018-01-10 12:41:48',1,0,0,'0000-00-00 00:00:00',2,'EOI for Development of Road Accident Management Information System',0,2,'14414','2017-12-07 00:00:00',1,2,2,0,'','','',274),
 (175,'Corrigendum on EOI Published on 07-12-2017 (RAMIS)','\"document_0_1513083789.pdf\"',2,'2017-12-12 18:33:09',1,'2018-01-10 12:41:28',1,0,0,'0000-00-00 00:00:00',2,'Corrigendum on EOI Published on 07-12-2017 (RAMIS)',0,2,'14639','2017-12-12 00:00:00',1,2,1,0,'','','',275);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (176,'Auction of seized vehicles in Ganjam region on dated 29/12/2017','\"document_0_1513416494.pdf\"',1,'2017-12-16 14:58:14',1,'2017-12-28 15:24:35',1,1,0,'0000-00-00 00:00:00',1,'',1,2,'8388','2017-12-13 00:00:00',1,2,2,0,'','','',276),
 (177,'Corrigendum-2 on EOI Published on 07-12-2017 (RAMIS)','\"document_0_1514450695.pdf\"',2,'2017-12-28 14:14:55',1,'2018-01-10 12:41:09',1,0,0,'0000-00-00 00:00:00',2,'Corrigendum-2 on EOI Published on 07-12-2017 (RAMIS)',0,2,'15305','2017-12-28 00:00:00',1,2,1,0,'','','',277),
 (178,'List of Vaccant Interstate Routes','\"document_0_1514456381.pdf\"',2,'2017-12-28 15:49:41',1,'2018-01-10 12:37:35',1,0,3,'0000-00-00 00:00:00',2,'List of Vaccant Interstate Routes',0,1,'122','2017-12-21 00:00:00',1,2,2,0,'','','',278),
 (179,'Allotment of vacant slots in Cuttack-Pattamundai Route','\"document_0_1515061802.PDF\"',2,'2018-01-04 16:00:02',1,'2018-02-28 11:57:35',1,0,3,'0000-00-00 00:00:00',2,'',0,1,'252017','2018-01-04 00:00:00',1,2,2,0,'','','',279);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (180,'Revised Rationalized Timings persuant to orders passed by Chairman, STA dated 26-12-2017 for (Category-A)','\"document_0_1516262049.PDF\",\"document_1_1516262049.PDF\"',2,'2018-01-18 13:24:09',1,'2018-02-28 11:53:35',1,0,0,'0000-00-00 00:00:00',2,'Revised Rationalized Timings persuant to orders passed by Chairman, STA dated 26-12-2017 for (Category-A)',0,3,'','2018-01-19 00:00:00',1,2,1,0,'','','',280),
 (181,'Revised Rationalized Timings persuant to orders passed by Chairman, STA dated 26-12-2017 for (Category-B)','\"document_0_1516262195.PDF\",\"document_1_1516262195.PDF\"',2,'2018-01-18 13:26:35',1,'2018-02-28 11:53:50',1,0,0,'0000-00-00 00:00:00',2,'Revised Rationalized Timings persuant to orders passed by Chairman, STA dated 26-12-2017 for (Category-B)',0,3,'','2018-01-19 00:00:00',1,2,1,0,'','','',281),
 (182,'Papper Advertisement &amp;amp; Principle Followed for Rationalization of Timings on [BBSR-Cuttack-Balasore-Baripada] Route','\"document_0_1516361739.pdf\"',2,'2018-01-19 16:57:25',1,'2018-02-28 11:52:27',1,0,0,'0000-00-00 00:00:00',2,'Papper Advertisement &amp; Principle Followed for Rationalization of Timings on [BBSR-Cuttack-Balasore-Baripada] Route',0,3,'','2018-01-20 00:00:00',1,2,1,0,'','','',282);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (183,'2nd Draft Rationalized Timings on Route [BBSR-Cuttack-Balasore-Baripada] (Up Trip)','\"document_0_1516361285.pdf\"',2,'2018-01-19 16:58:06',1,'2018-02-28 12:06:33',1,0,0,'0000-00-00 00:00:00',2,'2nd Draft Rationalized Timings on Route [BBSR-Cuttack-Balasore-Baripada] (Up Trip)',0,3,'','2018-01-20 00:00:00',1,2,1,0,'','','',283),
 (184,'2nd Draft Rationalized Timings on Route [BBSR-Cuttack-Balasore-Baripada] (Down Trip)','\"document_0_1516361312.pdf\"',2,'2018-01-19 16:58:32',1,'2018-02-28 11:52:54',1,0,0,'0000-00-00 00:00:00',2,'2nd Draft Rationalized Timings on Route [BBSR-Cuttack-Balasore-Baripada] (Down Trip)',0,3,'','2018-01-20 00:00:00',1,2,1,0,'','','',284),
 (185,'3rd Draft Rationalized Timings on Route [(BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI)] (Up Trip)','\"document_0_1519816814.pdf\"',1,'2018-02-28 16:50:14',1,'2018-02-28 17:05:43',1,1,0,'0000-00-00 00:00:00',1,'3rd Draft Rationalized Timings on Route [(BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI)] (Up Trip)',1,3,'','2018-03-01 00:00:00',1,2,1,0,'','','',285);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (186,'3rd Draft Rationalized Timings on Route [(BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI)] (Down Trip)','\"document_0_1519816857.pdf\"',1,'2018-02-28 16:50:57',1,'2018-02-28 17:05:43',1,1,0,'0000-00-00 00:00:00',1,'3rd Draft Rationalized Timings on Route [(BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI)] (Down Trip)',1,3,'','2018-03-01 00:00:00',1,2,1,0,'','','',286),
 (187,'Paper Advertisement and Principle Followed for Rationalization of Timings on (BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI) Route','\"document_0_1519817507.pdf\"',1,'2018-02-28 17:01:47',1,'2018-04-18 17:07:10',1,0,0,'0000-00-00 00:00:00',2,'Paper Advertisement and Principle Followed for Rationalization of Timings on (BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI) Route',0,3,'','2018-03-01 00:00:00',1,2,1,0,'','','',287),
 (188,'3rd Draft Rationalized Timings on Route [(BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI)] (Up Trip)','\"document_0_1519817810.pdf\"',2,'2018-02-28 17:06:50',1,'2018-04-18 17:07:33',1,0,0,'0000-00-00 00:00:00',2,'3rd Draft Rationalized Timings on Route [(BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI)] (Up Trip)',0,3,'','2018-03-01 00:00:00',1,2,1,0,'','','',288);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (189,'3rd Draft Rationalized Timings on Route [(BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI)] (Down Trip)','\"document_0_1519817855.pdf\"',2,'2018-02-28 17:07:35',1,'2018-04-18 17:08:18',1,0,0,'0000-00-00 00:00:00',2,'3rd Draft Rationalized Timings on Route [(BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI)] (Down Trip)',0,3,'','2018-03-01 00:00:00',1,2,1,0,'','','',289),
 (190,'Operators Applied for Change of Slot','\"document_0_1523944655.pdf\"',2,'2018-04-17 11:27:35',1,'2018-07-19 11:06:28',1,0,0,'0000-00-00 00:00:00',2,'Operators Applied for Change of Slot',0,3,'','2018-04-16 00:00:00',1,2,2,0,'','','',290),
 (191,'PAPER ADD &amp;amp; GROUND RULE ON 2nd DRAFT RATIONALIZED TIMING OF CUTTACK/BHUBANESWAR-PURI ROUTE','\"document_0_1524050382.pdf\"',2,'2018-04-18 16:49:42',1,'2018-07-19 11:04:05',1,0,0,'0000-00-00 00:00:00',2,'PAPER ADD &amp; GROUND RULE ON 2nd DRAFT RATIONALIZED TIMING OF CUTTACK/BHUBANESWAR-PURI ROUTE',0,3,'','2018-04-19 00:00:00',1,2,2,0,'','','',291);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (192,'2nd DRAFT RATIONALIZED TIMING CUTTACK/BHUBANESWAR-PURI ROUTE UP TRIP','\"document_0_1524050473.pdf\"',2,'2018-04-18 16:51:13',1,'2018-07-19 11:04:21',1,0,0,'0000-00-00 00:00:00',2,'2nd DRAFT RATIONALIZED TIMING CUTTACK/BHUBANESWAR-PURI ROUTE UP TRIP',0,3,'','2018-04-19 00:00:00',1,2,2,0,'','','',292),
 (193,'2nd DRAFT RATIONALIZED TIMING CUTTACK BHUBANESWAR-PURI ROUTE DOWN TRIP','\"document_0_1524050523.pdf\"',2,'2018-04-18 16:52:03',1,'2018-07-19 11:04:51',1,0,0,'0000-00-00 00:00:00',2,'2nd DRAFT RATIONALIZED TIMING CUTTACK BHUBANESWAR-PURI ROUTE DOWN TRIP',0,3,'','2018-04-19 00:00:00',1,2,2,0,'','','',293),
 (194,'List of Vacant Routes','\"document_0_1526029884.pdf\"',2,'2018-05-11 14:41:24',1,'2018-12-22 13:48:42',1,0,3,'0000-00-00 00:00:00',2,'List of Vacant Routes',0,1,'5926','2018-05-08 00:00:00',1,2,2,0,'','','',294);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (195,'Final Rationalized Timings on Route [(BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI)](Up Trip)','\"document_0_1527828524.PDF\"',1,'2018-06-01 10:18:44',1,'2018-06-01 10:22:54',1,1,0,'0000-00-00 00:00:00',1,'',1,3,'','2018-06-01 00:00:00',1,2,2,0,'','','',295),
 (196,'Final Rationalized Timings on Route [(BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI)](Down Trip)','\"document_0_1527828654.PDF\"',2,'2018-06-01 10:20:54',1,'2018-06-01 10:22:54',1,1,0,'0000-00-00 00:00:00',1,'',1,3,'','2018-06-01 00:00:00',1,2,2,0,'','','',296),
 (197,'Final Rationalized Timings on Route [(BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI)](Up Trip)','\"document_0_1527829253.PDF\"',2,'2018-06-01 10:30:54',1,'2018-06-01 10:34:56',1,1,0,'0000-00-00 00:00:00',1,'',1,3,'','2018-06-01 00:00:00',1,2,2,0,'','','',295),
 (198,'Final Rationalized Timings on Route [(BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI)](Down Trip)','\"document_0_1527829307.PDF\"',2,'2018-06-01 10:31:47',1,'2018-06-01 10:34:56',1,1,0,'0000-00-00 00:00:00',1,'',1,3,'','2018-06-01 00:00:00',1,2,2,0,'','','',296);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (199,'Final Rationalized Timings on Route [(BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI)](Down Trip)','\"document_0_1527829570.pdf\"',1,'2018-06-01 10:36:11',1,'2018-06-01 10:47:45',1,1,0,'0000-00-00 00:00:00',1,'',1,3,'','2018-06-01 00:00:00',1,2,2,0,'','','',295),
 (200,'Final Rationalized Timings on Route [(BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI)](Up Trip)','\"document_0_1527829660.PDF\"',1,'2018-06-01 10:37:40',1,'2018-06-01 10:47:45',1,1,0,'0000-00-00 00:00:00',1,'',1,3,'','2018-06-01 00:00:00',1,2,2,0,'','','',296),
 (201,'Final Rationalized Timings on Route [(BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI)](Up Trip)','\"document_0_1527831392.PDF\"',2,'2018-06-01 11:06:33',1,'2018-07-19 11:02:24',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2018-06-01 00:00:00',1,2,2,0,'','','',295),
 (202,'Final Rationalized Timings on Route [(BBSR/Cuttack)-Dhenkanal-(Angul/Talcher/FCI)](Down Trip)','\"document_0_1527831453.PDF\"',2,'2018-06-01 11:07:33',1,'2018-07-19 11:02:40',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2018-06-01 00:00:00',1,2,2,0,'','','',296);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (203,'Paper Advertisement and Principle Followed for Final Rationalization of Timings on BBSR-Cuttack-Dhenkanal Route','\"document_0_1527834465.pdf\"',2,'2018-06-01 11:57:45',1,'2018-07-19 11:02:56',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2018-06-01 00:00:00',1,2,1,0,'','','',297),
 (204,'Final Rationalized Timing on Route [BBSR-Cuttack-Akhuapada-Bhadrak-Soro-Balasore-Baripada] (Up Trip)','\"document_0_1531975238.PDF\"',2,'2018-07-19 10:10:38',1,'2018-11-17 17:17:51',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2018-07-19 00:00:00',1,2,2,0,'','','',298),
 (205,'Final Rationalized Timing on Route [BBSR-Cuttack-Akhuapada-Bhadrak-Soro-Balasore-Baripada] (Down Trip)','\"document_0_1531975296.PDF\"',2,'2018-07-19 10:11:36',1,'2018-11-17 17:18:03',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2018-07-19 00:00:00',1,2,2,0,'','','',299);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (206,'Paper Advertisement &amp;amp; Principle Follwed for Final Rationalization Timing on Bhubaneswar-Baripada Route','\"document_0_1531978171.PDF\"',2,'2018-07-19 10:59:31',1,'2018-11-17 17:18:11',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2018-07-19 00:00:00',1,2,2,0,'','','',300),
 (207,'FINAL RATIONALIZATION TIMING ON CUTTACK-BHUBANESWAR-PURI ROUTE(  DOWN TRIP)','\"document_0_1542454774.PDF\"',2,'2018-11-17 17:09:34',1,'2019-02-16 13:10:43',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2018-11-18 00:00:00',1,2,2,0,'','','',301),
 (208,'FINAL RATIONALIZATION TIMING ON CUTTACK-BHUBANESWAR-PURI ROUTE(  UP TRIP)','\"document_0_1542454862.PDF\"',2,'2018-11-17 17:11:02',1,'2019-02-16 13:10:26',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2018-11-18 00:00:00',1,2,2,0,'','','',302),
 (209,'PAPER ADVERTISEMENT AND GROUND RULE FOR FINAL RATIONALIZATION TIMING ON CUTTACK-BHUBANESWAR-PURI ROUTE','\"document_0_1542454899.PDF\"',2,'2018-11-17 17:11:39',1,'2019-03-21 17:38:22',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2018-11-18 00:00:00',1,2,2,0,'','','',303);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (210,'GROUND RULE FOR RECTIFIED FINAL RATIONALIZATION TIMING ON CUTTACK-BHUBANESWAR-PURI ROUTE','\"document_0_1543494751.pdf\"',2,'2018-11-29 18:02:31',1,'2019-02-16 13:10:13',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2018-11-29 00:00:00',1,2,2,0,'','','',304),
 (211,'RECTIFIED FINAL RATIONALIZATION TIMING ON CUTTACK-BHUBANESWAR-PURI ROUTE( UP TRIP)','\"document_0_1543494837.pdf\"',2,'2018-11-29 18:03:57',1,'2019-02-16 13:11:21',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2018-11-29 00:00:00',1,2,2,0,'','','',305),
 (212,'RECTIFIED FINAL RATIONALIZATION TIMING ON CUTTACK-BHUBANESWAR-PURI ROUTE( DOWN TRIP)','\"document_0_1543645192.PDF\"',2,'2018-11-29 18:05:26',1,'2019-02-16 13:11:01',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2018-11-29 00:00:00',1,2,2,0,'','','',306),
 (213,'Tender for Supply of  Booklets','\"document_0_1544517580.pdf\"',2,'2018-12-11 14:09:40',1,'2019-08-14 17:50:49',1,0,0,'0000-00-00 00:00:00',2,'',0,2,'14106','2018-12-10 00:00:00',1,2,2,0,'','','',307);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (214,'Vacant Slot Allotted to OD02Q4902 and OD02Q4904 in Cuttack/Bhubaneswar-Puri Rationalization Timing','\"document_0_1544526043.pdf\"',2,'2018-12-11 16:30:43',1,'2019-02-16 13:12:12',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2018-12-11 00:00:00',1,2,2,0,'','','',308),
 (215,'Vacant Slot Allotted to OR12-5155 in Cuttack/Bhubaneswar-Puri Rationalization Timing','\"document_0_1545034127.pdf\"',2,'2018-12-17 13:38:47',1,'2019-02-16 13:12:26',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2018-12-17 00:00:00',1,2,2,0,'','','',309),
 (216,'VACANT INTER STATE ROUTE FOR THE STATE OF ODISHA AND CHHATISGARH','\"document_0_1545466409.pdf\"',2,'2018-12-22 13:43:29',1,'2020-11-11 17:14:49',1,0,3,'0000-00-00 00:00:00',2,'',0,1,'412','2018-12-22 00:00:00',1,2,2,0,'','','',310),
 (217,'NOTIFICATION OF INTER STATE ROUTE','\"document_0_1545466460.pdf\"',2,'2018-12-22 13:44:20',1,'2020-11-11 17:14:03',1,0,3,'0000-00-00 00:00:00',2,'',0,1,'413','2018-12-22 00:00:00',1,2,2,0,'','','',311);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (218,'Advertisement for Request for Proposal for Intelligent Enforcement on NH 16','\"document_0_1545543946.pdf\"',2,'2018-12-23 11:15:46',1,'2019-08-14 17:49:37',1,0,0,'0000-00-00 00:00:00',2,'',0,2,'15098','2018-12-22 00:00:00',1,2,2,0,'','','',312),
 (219,'Request for Proposal for Intelligent Enforcement on NH 16','\"document_0_1545544375.pdf\"',2,'2018-12-23 11:22:55',1,'2019-08-14 17:50:33',1,0,0,'0000-00-00 00:00:00',2,'',0,2,'15098','2018-12-22 00:00:00',1,2,2,0,'','','',313),
 (220,'ADVERTISEMENT FOR RE-FIXATION OF THE FINAL RATIONALIZED TIMING ON CUTTCAK-PARADEEP ROUTE','\"document_0_1546952363.PDF\"',2,'2019-01-08 18:29:23',1,'2019-03-21 17:37:26',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-01-09 00:00:00',1,2,2,0,'','','',314),
 (221,'RE-FIXATION OF THE FINAL RATIONALIZED TIMING ON CUTTCAK-PARADEEP ROUTE FOR UP TRIP','\"document_0_1546952453.PDF\"',2,'2019-01-08 18:30:53',1,'2019-03-21 17:37:44',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-01-09 00:00:00',1,2,2,0,'','','',315);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (222,'RE-FIXATION OF THE FINAL RATIONALIZED TIMING ON CUTTCAK-PARADEEP ROUTE FOR DOWN TRIP','\"document_0_1546952577.PDF\"',2,'2019-01-08 18:32:57',1,'2019-03-21 17:38:01',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-01-09 00:00:00',1,2,2,0,'','','',316),
 (223,'INCLUSION OF MISSING VEHICLES IN RECTIFIED FINAL RATIONALIZATION TIMING ON CUTTACK-BHUBANESWAR-PURI ROUTE( UP TRIP)','\"document_0_1548936175.pdf\"',2,'2019-01-31 17:32:55',1,'2019-03-21 17:36:40',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-01-31 00:00:00',1,2,2,0,'','','',317),
 (224,'INCLUSION OF MISSING VEHICLES IN RECTIFIED FINAL RATIONALIZATION TIMING ON CUTTACK-BHUBANESWAR-PURI ROUTE( DOWN TRIP)','\"document_0_1548936234.pdf\"',2,'2019-01-31 17:33:54',1,'2019-03-21 17:37:04',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-01-31 00:00:00',1,2,2,0,'','','',318);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (225,'REVISED RATIONALIZED TIMING ON BHUBANESWAR/CUTTACK-DHENKANAL-BANARPAL-ANGUL/TALCHER/FCI ROUTE (Up TRIP)','\"document_0_1549984702.pdf\"',2,'2019-02-12 20:48:22',1,'2019-07-06 16:40:12',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-02-13 00:00:00',1,2,1,0,'','','',319),
 (226,'REVISED RATIONALIZED TIMING ON BHUBANESWAR/CUTTACK-DHENKANAL-BANARPAL-ANGUL/TALCHER/FCI ROUTE (DOWN TRIP)','\"document_0_1549985138.pdf\"',2,'2019-02-12 20:55:38',1,'2019-07-06 16:40:25',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-02-13 00:00:00',1,2,2,0,'','','',320),
 (227,'OBJECTION RECEIVED REGARDING ALLOTMENT OF VACANT SLOTS IN BHUBANESVVAR/CUTTACK-DHENKANAL-BANARAPAL-ANGUL/TALCHER-FCI ROUTE','\"document_0_1550032799.pdf\"',2,'2019-02-13 10:09:59',1,'2019-07-06 16:40:48',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-02-13 00:00:00',1,2,2,0,'','','',321);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (228,'ADVERTISEMENT FOR REVISED RATIONALIZED TIMING ON BHUBANESWAR/CUTTACK-DHENKANAL-BANARPAL-ANGUL/TALCHER/FCI ROUTE','\"document_0_1550212701.pdf\"',2,'2019-02-15 12:08:21',1,'2019-07-06 16:39:57',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-02-15 00:00:00',1,2,2,0,'','','',322),
 (229,'Mutual Change Of Timings in Cuttack-Angul Route','\"document_0_1551340348.pdf\"',2,'2019-02-28 13:22:28',1,'2019-07-06 16:38:18',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-02-28 00:00:00',1,2,2,0,'','','',323),
 (230,'REVISED FINAL RATIONALIZED TIMING ON CUTTCAK-PARADEEP ROUTE FOR DOWN TRIP (CATAGORY -A)','\"document_0_1551342349.PDF\"',2,'2019-02-28 13:55:49',1,'2019-07-06 16:38:44',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-02-28 00:00:00',1,2,2,0,'','','',324),
 (231,'REVISED FINAL RATIONALIZED TIMING ON CUTTCAK-PARADEEP ROUTE FOR UP TRIP (CATAGORY -A)','\"document_0_1551342396.PDF\"',2,'2019-02-28 13:56:36',1,'2019-07-06 16:38:59',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-02-28 00:00:00',1,2,2,0,'','','',325);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (232,'Compliance Towards Objection Received on Re-Fixation of Rationalized Timing on Cuttack-Paradeep Route','\"document_0_1551342635.PDF\"',2,'2019-02-28 14:00:35',1,'2019-07-06 16:39:44',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-02-28 00:00:00',1,2,2,0,'','','',326),
 (233,'FINAL UPDATED RATIONALIZED TIMING ON CUTTCAK-PARADEEP ROUTE FOR UP TRIP AS ON 12.04.19','\"document_0_1555055302.PDF\"',2,'2019-04-11 12:14:41',1,'2019-07-06 16:37:33',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-04-12 00:00:00',1,2,2,0,'','','',327),
 (234,'FINAL UPDATED RATIONALIZED TIMING ON CUTTCAK-PARADEEP ROUTE FOR DOWN TRIP AS ON 12.04.19','\"document_0_1555055237.PDF\"',2,'2019-04-11 12:15:42',1,'2019-07-06 16:37:58',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-04-12 00:00:00',1,2,2,0,'','','',328),
 (235,'Comprehensive Maintenance Contract of Surveillance Equipment Installed in Highway Interceptors','\"document_0_1561027169.pdf\"',2,'2019-06-20 16:09:29',1,'2019-08-14 17:50:04',1,0,0,'0000-00-00 00:00:00',2,'',0,2,'6415','2019-06-20 00:00:00',1,2,2,0,'','','',329);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (236,'Corrigendum Notice for Comprehensive Maintenance Contract of Surveillance Equipment Installed in Highway Interceptors','\"document_0_1561027376.pdf\"',2,'2019-06-20 16:12:56',1,'2019-08-14 17:49:21',1,0,0,'0000-00-00 00:00:00',2,'',0,2,'6415','2019-06-20 00:00:00',1,2,2,0,'','','',330),
 (237,'REVISED FINAL RATIONALIZED TIMING ON BHUBANESWAR/CUTTACK-DHENKANAL-BANARPAL-ANGUL/TALCHER/FCI ROUTE (UP TRIP) AS ON 30.06.2019','\"document_0_1562409174.pdf\"',2,'2019-07-06 16:02:54',1,'2019-10-18 16:51:46',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-07-06 00:00:00',1,2,2,0,'','','',331),
 (238,'REVISED FINAL RATIONALIZED TIMING ON BHUBANESWAR/CUTTACK-DHENKANAL-BANARPAL-ANGUL/TALCHER/FCI ROUTE (DOWN TRIP) AS ON 30.06.2019','\"document_0_1562409253.pdf\"',2,'2019-07-06 16:04:13',1,'2019-10-18 16:51:58',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-07-06 00:00:00',1,2,2,0,'','','',332);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (239,'Office Order Cuttack/Bhubaneswar-Puri Route','\"document_0_1562670150.pdf\"',2,'2019-07-09 16:32:30',1,'2019-10-18 16:51:15',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-07-09 00:00:00',1,2,2,0,'','','',333),
 (240,'Final Rationalization Timing after allocation of Vacant Slot in Cuttack/Bhubaneswar-Puri route (Up Trip) as on 15.07.2019','\"document_0_1563452531.pdf\"',2,'2019-07-18 17:52:11',1,'2019-08-14 17:48:41',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-07-18 00:00:00',1,2,2,0,'','','',334),
 (241,'Final Rationalization Timing after allocation of Vacant Slot in Cuttack/Bhubaneswar-Puri route (Down Trip) as on 15.07.2019','\"document_0_1563452601.pdf\"',2,'2019-07-18 17:53:21',1,'2019-10-18 16:50:21',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-07-18 00:00:00',1,2,2,0,'','','',335),
 (242,'Request of Proposal For Providing Comprehensive Maintenance Contract of Surveillance Equipment Installed in Highway Interceptors','\"document_0_1565785376.PDF\"',2,'2019-08-14 17:52:56',1,'2019-08-14 17:53:15',1,0,0,'0000-00-00 00:00:00',2,'',1,2,'866','2019-08-14 00:00:00',1,2,2,0,'','','',336);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (243,'Registration of Tractor and Trailers and Payment of Tax','\"document_0_1572603766.pdf\"',2,'2019-11-01 15:52:47',1,'2020-11-11 20:07:23',1,0,2,'0000-00-00 00:00:00',2,'',0,1,'5','2019-10-29 00:00:00',1,2,2,0,'','','',337),
 (244,'Separate Login Credentials of Testing Authorities for Issue of Final Driving License and Fitness Certificate','\"document_0_1572603908.pdf\"',2,'2019-11-01 15:55:08',1,'2020-11-11 20:07:02',1,0,2,'0000-00-00 00:00:00',2,'',0,1,'6','2019-10-29 00:00:00',1,2,2,0,'','','',338),
 (245,'Issue of Learner License  Final Driving License and Registration of  Motor Vehicles','\"document_0_1572603976.pdf\"',2,'2019-11-01 15:56:16',1,'2020-11-11 20:06:41',1,0,2,'0000-00-00 00:00:00',2,'',0,1,'7','2019-11-01 00:00:00',1,2,2,0,'','','',339),
 (246,'GROUND RULE ON BHUBANESWAR-CUTTACK-KUAKHIA-JAJPUR TOWN BARI BANDHADIHA JAJPUR ROAD ANANDAPUR GHATAGAON KARANJIA KEONJHAR ROUTE','\"document_0_1574167627.PDF\"',2,'2019-11-19 18:17:07',1,'2020-01-29 14:31:02',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-11-19 00:00:00',1,2,2,0,'','','',340);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (247,'DRAFT RATIONALIZED TIMING ON BHUBANESWAR CUTTACK JAJPUR ROAD ANANDAPUR GHATAGAON KEONJHAR KARANJIA ROUTE CAT A UP TRIP','\"document_0_1574168630.PDF\"',2,'2019-11-19 18:33:50',1,'2020-01-29 14:31:50',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-11-19 00:00:00',1,2,1,0,'','','',341),
 (248,'DRAFT RATIONALIZED TIMING ON BHUBANESWAR CUTTACK JAJPUR ROAD ANANDAPUR GHATAGAON KEONJHAR KARANJIA ROUTE CAT A DOWN  TRIP','\"document_0_1574168668.PDF\"',2,'2019-11-19 18:34:28',1,'2020-01-29 14:30:12',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-11-19 00:00:00',1,2,2,0,'','','',342),
 (249,'DRAFT RATIONALIZED TIMING ON BHUBANESWAR CUTTACK KUAKHIA JAJPUR TOWN BARI BANDHADIHA ROUTE CAT B DOWN TRIP','\"document_0_1574168781.PDF\"',2,'2019-11-19 18:36:21',1,'2020-01-29 14:32:45',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-11-19 00:00:00',1,2,2,0,'','','',343);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (250,'DRAFT RATIONALIZED TIMING ON BHUBANESWAR CUTTACK KUAKHIA JAJPUR TOWN BARI BANDHADIHA ROUTE CAT B UP TRIP','\"document_0_1574168811.PDF\"',2,'2019-11-19 18:36:51',1,'2020-01-29 14:31:39',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-11-19 00:00:00',1,2,2,0,'','','',344),
 (251,'Determination of one time tax in absence of invoice','\"document_0_1574853889.PDF\"',2,'2019-11-27 16:54:49',1,'2020-11-11 20:06:13',1,0,2,'0000-00-00 00:00:00',2,'',0,1,'8','2019-11-27 00:00:00',1,2,2,0,'','','',345),
 (252,'RECTIFIED FINAL DRAFT RATIONALIZED TIMING ON BHUBANESWAR/CUTTACK-AKHUAPADA-BHADRAK-SORO-BALASORE-BARIPADA ROUTE(UP TRIP)','\"document_0_1576907523.PDF\"',2,'2019-12-20 18:30:52',1,'2020-11-09 12:43:57',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-12-20 00:00:00',1,2,2,0,'','','',346),
 (253,'RECTIFIED FINAL DRAFT RATIONALIZED TIMING ON BHUBANESWAR/CUTTACK-AKHUAPADA-BHADRAK-SORO-BALASORE-BARIPADA ROUTE(DOWN TRIP)','\"document_0_1576907553.PDF\"',2,'2019-12-20 18:31:33',1,'2020-11-09 12:44:14',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-12-20 00:00:00',1,2,2,0,'','','',347);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (254,'GROUND RULE FOLLOWED IN RECTIFIED FINAL DRAFT RATIONALIZATION TIMING OF BHUBANESWAR-CUTTACK-BHADRAK-BALASORE-BARIPADA ROUTE','\"document_0_1576847214.PDF\"',2,'2019-12-20 18:36:54',1,'2020-11-09 12:44:37',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2019-12-20 00:00:00',1,2,2,0,'','','',348),
 (255,'Final Rationalization Timing After Allocation of Vacant Slots on Cuttack/Bhubaneswar-Puri Route(Up Trip) As on 16.01.2020','\"document_0_1579242726.PDF\"',2,'2020-01-17 12:02:06',1,'2020-11-09 12:43:16',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-01-17 00:00:00',1,2,2,0,'','','',349),
 (256,'Final Rationalization Timing After Allocation of Vacant Slots on Cuttack/Bhubaneswar-Puri Route(Down Trip) As on 16.01.2020','\"document_0_1579242762.PDF\"',2,'2020-01-17 12:02:42',1,'2020-11-09 12:43:38',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-01-17 00:00:00',1,2,2,0,'','','',350);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (257,'FINAL UPDATED RATIONALIZED TIMING ON CUTTACK-PARADEEP ROUTE (UP AND DOWN TRIP) AS ON 18.01.2020','\"document_0_1579345125.PDF\",\"document_1_1579345125.PDF\"',2,'2020-01-18 16:28:45',1,'2020-11-09 12:42:58',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-01-18 00:00:00',1,2,2,0,'','','',351),
 (258,'Updated Rationalized Timing on Cuttack-Jagatsinghpur Route (UP/Down Trip) as on 27.01.2020','\"document_0_1580122906.PDF\",\"document_1_1580122906.PDF\"',2,'2020-01-27 16:31:46',1,'2020-11-09 12:41:33',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-01-27 00:00:00',1,2,2,0,'','','',352),
 (259,'Objections or Representations Received in Bhubaneswar-Cuttack-Bhadrak-Balasore-Baripada Route','\"document_0_1580130677.PDF\"',2,'2020-01-27 18:41:17',1,'2020-11-09 12:41:55',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-01-27 00:00:00',1,2,2,0,'','','',353);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (260,'Ground rule followed in rectified final rationalization timing  on Bhubaneswar-Cuttack-Bhadrak-Balasore-Baripada route','\"document_0_1580130778.PDF\"',2,'2020-01-27 18:42:58',1,'2020-11-09 12:42:12',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-01-27 00:00:00',1,2,2,0,'','','',354),
 (261,'Rectified final rationalized timing on Bhubaneswar-Cuttack-Akhuapada-Bhadrak-Soro-Balasore-Baripada Route','\"document_0_1580130924.PDF\",\"document_1_1580130924.PDF\"',2,'2020-01-27 18:45:24',1,'2020-11-09 12:42:36',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-01-27 00:00:00',1,2,2,0,'','','',355),
 (262,'Introduction of document uploading facility in SARATHI Applications for Issue of LL and DL','\"document_0_1580212598.pdf\"',2,'2020-01-28 17:26:38',1,'2020-11-11 20:05:42',1,0,2,'0000-00-00 00:00:00',2,'',0,1,'1','2020-01-28 00:00:00',1,2,2,0,'','','',356);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (263,'Final Rationalized Timing after Allocation of Vacant Slots on Cuttack/Bhubaneswar-Puri Route as on 28.01.2020','\"document_0_1580215947.PDF\",\"document_1_1580215947.PDF\"',2,'2020-01-28 18:22:27',1,'2020-11-09 12:41:18',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-01-28 00:00:00',1,2,2,0,'','','',357),
 (264,'FINAL RATIONALIZATION TIMINGS OF STAGE CARRIAGE PLYING ON  THE ROUTE BHUBANESWAR / CUTTACK TOWARDS NARSINGHPUR AS on  29.01.2020','\"document_0_1580300386.PDF\",\"document_1_1580300386.PDF\"',2,'2020-01-29 17:49:46',1,'2020-11-09 12:40:57',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-01-29 00:00:00',1,2,2,0,'','','',358),
 (265,'CIRCULAR NO. 01 OF 2020 (As modified vide order No.1422 dated 29.01.2020)','\"document_0_1580304811.PDF\"',2,'2020-01-29 19:03:31',1,'2020-11-11 20:05:28',1,0,2,'0000-00-00 00:00:00',2,'',0,1,'1','2020-01-29 00:00:00',1,2,2,0,'','','',359);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (266,'Updated Rationalized Timing on Cuttack-Salipur-KendraPara-Pattamundai Route  (Category-A ) As on 31.01.2020','\"document_0_1580559698.PDF\",\"document_1_1580559698.PDF\"',2,'2020-02-01 17:51:38',1,'2020-11-09 12:39:45',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-02-01 00:00:00',1,2,2,0,'','','',360),
 (267,'Updated Rationalized Timing on Cuttack-Chandikhol-Kendrapara-Pattamundai Route (Category-B) As on 31.01.2020','\"document_0_1580559840.PDF\",\"document_1_1580559840.PDF\"',2,'2020-02-01 17:54:00',1,'2020-11-09 12:39:57',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-02-01 00:00:00',1,2,2,0,'','','',361),
 (268,'Updated Rationalized Timing on Cuttack-Jagatsinghpur Route As on 31.01.2020','\"document_0_1580559937.PDF\",\"document_1_1580559937.PDF\"',2,'2020-02-01 17:55:37',1,'2020-11-09 12:40:08',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-02-01 00:00:00',1,2,2,0,'','','',362);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (269,'Final Rationalization Timing on Bhubaneswar/Cuttack-Narsinghpur Route As on 31.01.2020','\"document_0_1580560230.PDF\",\"document_1_1580560230.PDF\"',2,'2020-02-01 18:00:30',1,'2020-11-09 12:40:33',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-02-01 00:00:00',1,2,2,0,'','','',363),
 (270,'The list of notified route in Interstate and inter region','\"document_0_1580971989.pdf\"',2,'2020-02-06 12:22:05',1,'2020-11-11 17:12:21',1,0,3,'0000-00-00 00:00:00',2,'',0,1,'1','2020-02-06 00:00:00',1,2,2,0,'','','',364),
 (271,'CIRCULAR NO. 2 OF 2020 (Collection of fine from other State goods carriages)','\"document_0_1581437000.PDF\"',2,'2020-02-11 21:33:20',1,'2020-11-11 20:05:04',1,0,2,'0000-00-00 00:00:00',2,'',0,1,'2','2020-02-11 00:00:00',1,2,2,0,'','','',365),
 (272,'Updated Rationalization on Cuttack-Salipur-Kendrapara-Pattamundai Route Category-A Buses As on 13.02.2020','\"document_0_1581590186.PDF\",\"document_1_1581590186.PDF\"',2,'2020-02-13 16:06:26',1,'2020-11-09 12:39:13',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-02-13 00:00:00',1,2,2,0,'','','',366);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (273,'Updated Rationalization on Cuttack-Chandikhole-Kendrapara-Pattamundai Route Category-B Buses As on 13.02.2020','\"document_0_1581590236.PDF\",\"document_1_1581590236.PDF\"',2,'2020-02-13 16:07:16',1,'2020-11-09 12:39:30',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-02-13 00:00:00',1,2,2,0,'','','',367),
 (274,'Final Rationalized Timing on CTC/BBSR-PURI Route As on 14.02.2020','\"document_0_1581684287.PDF\",\"document_1_1581684287.PDF\"',2,'2020-02-14 18:14:47',1,'2020-11-09 12:37:57',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-02-14 00:00:00',1,2,2,0,'','','',368),
 (275,'Final Rationalized Timing on Cuttack-Jagatsinghpur Route As on 14.02.2020','\"document_0_1581684363.PDF\",\"document_1_1581684363.PDF\"',2,'2020-02-14 18:16:03',1,'2020-11-09 12:38:11',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-02-14 00:00:00',1,2,2,0,'','','',369);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (276,'Final Rationalized Timing on CTC/BBSR-Narasinghpur Route As on 14.02.2020','\"document_0_1581684447.PDF\",\"document_1_1581684447.PDF\"',2,'2020-02-14 18:17:27',1,'2020-11-09 12:38:25',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-02-14 00:00:00',1,2,2,0,'','','',370),
 (277,'Updated Rationalization timing on Cuttack-Salipur-Kendrapara-Pattamundai Route As on 17.02.2020','\"document_0_1582006990.PDF\",\"document_1_1582006990.PDF\"',2,'2020-02-18 11:53:10',1,'2020-11-09 12:37:39',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-02-18 00:00:00',1,2,2,0,'','','',371),
 (278,'UPDATED FINAL RATIONALIZED TIMING ON BHUBANESWAR-KAKATPUR-KONARK ROUTE AS ON 27.02.2020','\"document_0_1582787993.PDF\",\"document_1_1582787993.PDF\"',2,'2020-02-27 12:49:53',1,'2020-11-09 12:33:03',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-02-27 00:00:00',1,2,2,0,'','','',372);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (279,'UPDATED FINAL RATIONALIZED TIMINGS ON CUTTACK-KAKATPUR ROUTE CATEGORY-A AS ON 27.02.2020','\"document_0_1582788130.PDF\",\"document_1_1582788130.PDF\"',2,'2020-02-27 12:52:10',1,'2020-11-09 12:36:31',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-02-27 00:00:00',1,2,2,0,'','','',373),
 (280,'UPDATED RATIONALIZED TIMING ON ROURKELA TO SUNDERGARH ROUTE AS ON 27.02.2020','\"document_0_1582788267.PDF\",\"document_1_1582788267.PDF\"',2,'2020-02-27 12:54:28',1,'2020-11-09 12:36:46',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-02-27 00:00:00',1,2,2,0,'','','',374),
 (281,'UPDATED FINAL RATIONALIZED TIMING ON SAMBALPUR-BARGARH ROUTE AS ON 27.02.2020','\"document_0_1582788348.PDF\",\"document_1_1582788348.PDF\"',2,'2020-02-27 12:55:48',1,'2020-11-09 12:36:58',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-02-27 00:00:00',1,2,2,0,'','','',375);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (282,'UPDATED FINAL RATIONALIZED TIMING ON SAMBALPUR-JHARSUGUDA-SUNDARGARH ROUTE AS ON 27.02.2020','\"document_0_1582788435.PDF\",\"document_1_1582788435.PDF\"',2,'2020-02-27 12:57:15',1,'2020-11-09 12:37:09',1,0,0,'0000-00-00 00:00:00',2,'',0,3,'','2020-02-27 00:00:00',1,2,2,0,'','','',376),
 (283,'Applications for Temporary .Permit in the Interstate Enclave route which will be placed in Committee Meeting on 17.03.2020','\"document_0_1582959214.pdf\"',2,'2020-02-29 12:23:34',1,'2020-11-11 17:10:20',1,0,3,'0000-00-00 00:00:00',2,'',0,1,'1','2020-02-29 00:00:00',1,2,1,0,'','','',377),
 (284,'Online payment system for all transactions at RTOs','\"document_0_1584101482.PDF\"',2,'2020-03-13 17:41:22',1,'2020-11-09 12:23:32',1,0,1,'0000-00-00 00:00:00',2,'',0,1,'3754','2020-03-13 00:00:00',1,2,2,0,'','','',378);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (285,'CIRCULAR NO. 3 OF 2020 (Prior permission for registration of off-highway vehicles)','\"document_0_1596186802.pdf\"',2,'2020-07-31 14:43:22',1,'2020-11-11 20:04:26',1,0,2,'0000-00-00 00:00:00',2,'',0,1,'3','2020-07-31 00:00:00',1,2,2,0,'','','',379),
 (286,'CIRCULAR NO 4 OF 2020 (Instruction to prevent hiring of non-transport (private) passenger carrying vehicles)','\"document_0_1601297563.pdf\"',2,'2020-09-28 18:22:43',1,'2020-11-11 20:03:51',1,0,2,'0000-00-00 00:00:00',2,'',0,1,'4','2020-09-28 00:00:00',1,2,2,0,'','','',380),
 (287,'CIRCULAR NO 5 of 2020','\"document_0_1601544258.PDF\"',2,'2020-10-01 14:03:40',1,'2020-10-01 14:54:18',1,0,2,'0000-00-00 00:00:00',2,'',1,1,'5','2020-10-01 00:00:00',1,2,2,0,'','','',381),
 (288,'Circular 6 of 2020 (Verification of Address in respect of Other State Vehicles)','\"document_0_1601968078.pdf\"',2,'2020-10-06 12:37:58',1,'2020-10-06 12:38:23',1,0,2,'0000-00-00 00:00:00',2,'',1,1,'6','2020-10-06 00:00:00',1,2,2,0,'','','',382);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (289,'GROUND RULES FOLLOWED IN FINAL  RATIONALIZATION TIMING IN BHUBANESWAR/ CUTTACK- KUAKHIA-BARUAN-JAJPUR TOWN/BARI/BANDHADHIA ROUTE','\"document_0_1603281690.PDF\"',2,'2020-10-21 17:31:30',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',1,3,'','2020-10-21 00:00:00',1,2,2,0,'','','',383),
 (290,'OBJECTIONS RECEIVED IN DRAFT RATIONALIZATION TIMING OF BHUBANESWAR/CUTTACK-BARUAN-JAJPUR TOWN/BARI/BANDHADHIA ROUTE','\"document_0_1603281898.PDF\"',2,'2020-10-21 17:34:58',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',1,3,'','2020-10-21 00:00:00',1,2,2,0,'','','',384),
 (291,'FINAL RATIONALIZATION TIMING ON BHUBANESWAR-CUTTACK-CHANDIKHOL-KUAKHIA-BARUAN-JAJPUR TOWN/BARI/BANDHADHIA ROUTE','\"document_0_1603282034.PDF\",\"document_1_1603282034.PDF\"',2,'2020-10-21 17:37:14',1,'2020-11-09 12:45:17',1,0,0,'0000-00-00 00:00:00',2,'',1,3,'','2020-10-21 00:00:00',1,2,2,0,'','','',385);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (292,'GROUND RULE FOLLOWED IN FINAL RATIONALIZATION TIMING OF BHUBANESWAR/CUTTACK-J K ROAD-ANANDAPUR-GHATAGAON-KEONJHAR/KARANJIA ROUTE','\"document_0_1603282583.PDF\"',2,'2020-10-21 17:46:23',1,'2020-11-09 12:45:31',1,0,0,'0000-00-00 00:00:00',2,'',1,3,'','2020-10-21 00:00:00',1,2,2,0,'','','',386),
 (293,'OBJECTIONS RECEIVED IN BHUBANESWAR/CUTTACK-J K ROAD-ANANDAPUR-KEONJHAR/KARANJIA ROUTE','\"document_0_1603282906.PDF\"',2,'2020-10-21 17:51:46',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',1,3,'','2020-10-21 00:00:00',1,2,2,0,'','','',387),
 (294,'FINAL RATIONALIZATION TIMING ON BHUBANESWAR/CUTTACK-JAJPUR ROAD-ANANDAPUR-GHATAGAON-DHENKIKOTE-KARANJIA/KEONJHAR ROUTE','\"document_0_1603283061.PDF\",\"document_1_1603283061.PDF\"',2,'2020-10-21 17:54:22',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',1,3,'','2020-10-21 00:00:00',1,2,2,0,'','','',388);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (295,'Applications Invited for Grant of Permanent Permit in Interstate Vacant Route','\"document_0_1603981515.pdf\"',2,'2020-10-29 19:55:15',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',1,1,'Interstate','2020-10-29 00:00:00',1,2,2,0,'','','',389),
 (296,'THE LIST OF VACANT -INTERSTATE ROUTES IN BETWEEN ODISHA AND JHARKHAND','\"document_0_1604666765.pdf\"',2,'2020-11-06 18:16:05',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',1,1,'1','2020-11-06 00:00:00',1,2,2,0,'','','',390),
 (297,'THE LIST OF VACANT INTERSTATE ROUTES IN BETWEEN STATE OF ODISHA AND CHHATISGARH','\"document_0_1604666861.pdf\"',2,'2020-11-06 18:17:41',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',1,1,'2','2020-11-06 00:00:00',1,2,2,0,'','','',391),
 (298,'THE LIST OF VACANT INTERSTATE ROUTES IN BETWEEN STATE OF ODISHA AND WEST BENGAL','\"document_0_1604666917.pdf\"',2,'2020-11-06 18:18:37',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',1,1,'3','2020-11-06 00:00:00',1,2,2,0,'','','',392);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (299,'APPLICATIONS INVITED FOR GRANT OF PERMANENT PERMIT IN INTERSTATE VACANT ROUTE.','\"document_0_1604666991.PDF\"',2,'2020-11-06 18:19:51',1,'2020-11-11 17:15:38',1,0,3,'0000-00-00 00:00:00',2,'',1,1,'4','2020-11-06 00:00:00',1,2,2,0,'','','',393),
 (300,'UPDATED FINAL RATIONALIZATION TIMING ON BHUBANESWAR-KAKATPUR-KONARK ROUTE AS ON 02.11.2020','\"document_0_1604996663.pdf\",\"document_1_1604996663.pdf\"',2,'2020-11-10 13:54:23',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',1,3,'','2020-11-10 00:00:00',1,2,2,0,'','','',394),
 (301,'UPDATED FINAL RATIONALIZATION TIMING ON CHANDIKHOL-DUHURIA-PARADEEP ROUTE (CAT-C) AS ON 02.11.2020','\"document_0_1604996997.pdf\",\"document_1_1604996997.pdf\"',2,'2020-11-10 13:59:57',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',1,3,'','2020-11-10 00:00:00',1,2,2,0,'','','',395),
 (302,'UPDATED FINAL RATIONALIZATION TIMING ON CUTTACK/BHUBANESWAR-KALPANA-PURI ROUTE AS ON 06.11.2020','\"document_0_1604997357.pdf\",\"document_1_1604997357.pdf\"',2,'2020-11-10 14:05:57',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',1,3,'','2020-11-10 00:00:00',1,2,2,0,'','','',396);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (303,'UPDATED FINAL RATIONALIZATION TIMING ON CUTTACK-JAGATSINGHPUR ROUTE AS ON 02.11.2020','\"document_0_1604997528.pdf\",\"document_1_1604997528.pdf\"',2,'2020-11-10 14:08:48',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',1,3,'','2020-11-10 00:00:00',1,2,2,0,'','','',397),
 (304,'UPDATED FINAL RATIONALIZATION TIMING ON CUTTACK-PARADEEP ROUTE AS ON 06.11.2020','\"document_0_1604997731.pdf\",\"document_1_1604997731.pdf\"',2,'2020-11-10 14:12:11',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',1,3,'','2020-11-10 00:00:00',1,2,2,0,'','','',398),
 (305,'UPDATED FINAL RATIONALIZATION TIMING ON SAMBALPUR-BARAGARH ROUTE AS ON 02.11.2020','\"document_0_1604997951.pdf\",\"document_1_1604997951.pdf\"',2,'2020-11-10 14:15:51',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',1,3,'','2020-11-10 00:00:00',1,2,2,0,'','','',399);
INSERT INTO `t_notification` (`INT_NOTIFICATION_ID`,`VCH_HEADLINE`,`VCH_DOCUMENT`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PLUGIN_TYPE`,`DTM_NOTIFICATION_DATE`,`INT_ARC_STATUS`,`VCH_HEADLINE_O`,`INT_BLINK_STATUS`,`INT_LINK_TYPE`,`VCH_CODE`,`DTM_NOTICE_START`,`INT_URL_TYPE`,`INT_TEMPLATE_TYPE`,`INT_WIN_STATUS`,`INT_PLUGIN_ID`,`VCH_URL`,`VCH_DETAILE`,`VCH_DETAILO`,`INT_SLNO`) VALUES 
 (306,'UPDATED FINAL RATIONALIZATION TIMING ON SAMBALPUR-JHARSUGUDA-SUNDARGARH ROUTE AS ON 02.11.2020','\"document_0_1604998108.pdf\",\"document_1_1604998108.pdf\"',2,'2020-11-10 14:18:28',1,NULL,NULL,0,0,'0000-00-00 00:00:00',2,'',1,3,'','2020-11-10 00:00:00',1,2,2,0,'','','',400),
 (307,'APPLICATION FOR  INVITING FOR  PERMANENT PERMIT IN THE VACANT INTER STATE ROUTE (BABAR TO CONTAI)','\"document_0_1605094603.PDF\"',2,'2020-11-11 17:06:43',1,NULL,NULL,0,3,'0000-00-00 00:00:00',2,'',1,1,'1','2020-11-11 00:00:00',1,2,2,0,'','','',401),
 (308,'CIRCULAR NO 7 OF 2020 (Grant or Renewal of Authorization of Pollution Testing Centers)','\"document_0_1605104985.pdf\"',2,'2020-11-11 19:59:45',1,NULL,NULL,0,2,'0000-00-00 00:00:00',2,'',1,1,'7','2020-11-11 00:00:00',1,2,2,0,'','','',402);
/*!40000 ALTER TABLE `t_notification` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_officer_category`
--

DROP TABLE IF EXISTS `t_officer_category`;
CREATE TABLE `t_officer_category` (
  `INT_CATEGORY_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VCH_CATEGORY_NAME` varchar(128) NOT NULL,
  `VCH_DESCRIPTION` varchar(512) DEFAULT NULL,
  `INT_PUBLISH_STATUS` int(10) unsigned NOT NULL DEFAULT '0',
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intOrderno` int(11) DEFAULT '0',
  `INT_CREATED_BY` int(10) unsigned NOT NULL DEFAULT '1',
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `INT_UPDATED_BY` int(10) unsigned DEFAULT NULL,
  `BIT_DELETED_FLAG` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`INT_CATEGORY_ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_officer_category`
--

/*!40000 ALTER TABLE `t_officer_category` DISABLE KEYS */;
INSERT INTO `t_officer_category` (`INT_CATEGORY_ID`,`VCH_CATEGORY_NAME`,`VCH_DESCRIPTION`,`INT_PUBLISH_STATUS`,`DTM_CREATED_ON`,`intOrderno`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`) VALUES 
 (1,'SECRETARY TO GOVERNOR',NULL,2,'2021-06-05 11:03:30',1,1,'2021-06-08 16:33:29',1,'\0'),
 (2,'AIDE-DE-CAMP',NULL,2,'2021-06-05 11:04:29',2,1,'2021-06-08 16:33:29',1,'\0'),
 (3,'PERSONAL STAFF',NULL,2,'2021-06-05 11:04:37',3,1,'2021-06-08 16:33:29',1,'\0'),
 (4,'HOUSEHOLD ESTABLISHMENT',NULL,2,'2021-06-08 16:32:25',4,1,'2021-06-08 16:33:29',1,'\0'),
 (5,'SECRETARIAT ESTABLISHMENT',NULL,2,'2021-06-08 16:33:00',5,1,'2021-06-08 16:33:29',1,'\0'),
 (6,'MEDICAL ESTABLISHMENT',NULL,2,'2021-06-08 16:33:12',6,1,'2021-06-08 16:33:29',1,'\0');
/*!40000 ALTER TABLE `t_officer_category` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_officer_profile`
--

DROP TABLE IF EXISTS `t_officer_profile`;
CREATE TABLE `t_officer_profile` (
  `intProfileId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vchMinisterNameE` varchar(128) NOT NULL,
  `vchMinisterNameH` text,
  `vchDesignationE` varchar(128) NOT NULL,
  `vchDesignationH` text,
  `vchQulificationE` varchar(128) DEFAULT NULL,
  `vchQulificationH` text,
  `intSlNo` int(11) NOT NULL,
  `intLinkType` int(10) unsigned NOT NULL,
  `vchUrl` varchar(256) DEFAULT NULL,
  `vchImage` varchar(128) DEFAULT NULL,
  `vchMobile` varchar(10) DEFAULT NULL,
  `tinPublishStatus` tinyint(3) unsigned DEFAULT '1',
  `tinArcStatus` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `stmCreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intCreatedBy` int(10) unsigned DEFAULT NULL,
  `dtmUpdatedOn` datetime DEFAULT NULL,
  `intUpdatedBy` int(10) unsigned DEFAULT NULL,
  `bitDeletedFlag` bit(1) NOT NULL DEFAULT b'0',
  `dtmArchieveOn` datetime DEFAULT NULL,
  PRIMARY KEY (`intProfileId`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_officer_profile`
--

/*!40000 ALTER TABLE `t_officer_profile` DISABLE KEYS */;
INSERT INTO `t_officer_profile` (`intProfileId`,`vchMinisterNameE`,`vchMinisterNameH`,`vchDesignationE`,`vchDesignationH`,`vchQulificationE`,`vchQulificationH`,`intSlNo`,`intLinkType`,`vchUrl`,`vchImage`,`vchMobile`,`tinPublishStatus`,`tinArcStatus`,`stmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`dtmArchieveOn`) VALUES 
 (7,'Shri Naveen Patnaik','Shri Naveen Patnaik','Honï¿½ble Chief Minister','Honï¿½ble Chief Minister','','',1,0,'','OffProfile20160601_153753.jpg',NULL,2,0,'2016-02-27 09:36:49',1,'2016-06-28 13:30:40',1,'',NULL),
 (8,'Shri Ramesh Ch Majhi','','Honâ€™ble Minister of State','','','',2,0,'','OffProfile20160601_153833.jpg',NULL,2,0,'2016-02-27 09:36:58',1,'2016-07-11 10:17:39',1,'',NULL),
 (9,'Smt M. Sudha Devi','','Managing Director','','IAS','',3,1,'0','OffProfile20160330_101100.jpg',NULL,2,0,'2016-02-27 09:37:10',1,'2016-03-30 10:11:03',1,'',NULL),
 (10,'dsad','','dsad','','','',3,1,'0','',NULL,1,0,'2016-03-10 16:16:04',1,NULL,NULL,'',NULL),
 (11,'Shri Sanjay Rastogi','','Principal Secretary','','','',3,0,'','OffProfile20160601_153908.jpg',NULL,2,0,'2016-06-01 15:37:05',1,'2016-06-28 13:30:34',1,'',NULL);
INSERT INTO `t_officer_profile` (`intProfileId`,`vchMinisterNameE`,`vchMinisterNameH`,`vchDesignationE`,`vchDesignationH`,`vchQulificationE`,`vchQulificationH`,`intSlNo`,`intLinkType`,`vchUrl`,`vchImage`,`vchMobile`,`tinPublishStatus`,`tinArcStatus`,`stmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`dtmArchieveOn`) VALUES 
 (12,'sdad','sad','dsada','','','',4,0,'','',NULL,1,0,'2016-07-05 15:35:45',1,NULL,NULL,'',NULL),
 (13,'Shri Manoj Kumar Mishra','','Commissioner Rail Coordination & Special Secretary','','asdasdasc','',4,0,'','OffProfile20160711_115245.png',NULL,2,0,'2016-07-11 09:54:44',1,'2016-07-11 11:52:45',1,'',NULL),
 (14,'Shri Sanjeeb Panda, IPS','Shri Madhusudhan Padhi, IAS','Transport Commissioner-cum-Chairman, STA','sdfd','','IAS',1,0,'','OffProfile20201119_122318.jpg','',2,0,'2016-09-30 15:32:48',1,'2020-11-19 12:22:42',1,'\0',NULL),
 (15,'Ignace Hasda,OAS (SAG)','Dr. Abhinash','Secretary, STA','Secretary, STA','','',3,0,'','OffProfile20161027_164736.jpg',NULL,2,0,'2016-10-03 10:09:50',1,'2019-10-24 13:52:42',1,'',NULL),
 (16,'Sameer Kumar Panigrahi,OTES(S)','Sameer Kumar Panigrahi,OTES(S)','Addl.Commissioner,Transport (Tech)','Addl.Commissioner,Transport (Tech)','','',4,0,'','OffProfile20161027_164926.jpg',NULL,2,0,'2016-10-27 11:46:25',1,'2018-05-19 16:43:08',1,'',NULL);
INSERT INTO `t_officer_profile` (`intProfileId`,`vchMinisterNameE`,`vchMinisterNameH`,`vchDesignationE`,`vchDesignationH`,`vchQulificationE`,`vchQulificationH`,`intSlNo`,`intLinkType`,`vchUrl`,`vchImage`,`vchMobile`,`tinPublishStatus`,`tinArcStatus`,`stmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`dtmArchieveOn`) VALUES 
 (17,'AshishKUmar Patra','AshishKUmar Patra','SDO','SDO','ads','dsadas',4,0,'','OffProfile20161027_114655.png',NULL,1,0,'2016-10-27 11:46:55',1,NULL,NULL,'',NULL),
 (18,'Dr.Banani Mohanty,OAS(S)','Dr.Banani Mohanty,OAS(S)','Joint.Commissioner,Transport (Tax)','Joint.Commissioner,Transport (Tax)','','',4,0,'','OffProfile20161027_165017.jpg',NULL,2,0,'2016-10-27 16:50:17',1,'2016-10-27 18:07:27',1,'',NULL),
 (19,'Atasi Das, OAS-I(SB)','','Deputy Secretary','','','',6,0,'','OffProfile20170619_114810.jpg','',2,0,'2016-10-27 16:50:47',1,'2020-08-14 13:24:21',1,'\0',NULL),
 (20,'Sri Rabindra Nath Nayak','Tapan Kumar Mishra','Assistant Director (TS)','Assistant Director,(Traffic Survey)','','',11,0,'','OffProfile20200203_110549.jpg','',2,0,'2016-10-27 16:51:32',1,'2020-08-14 13:24:21',1,'\0',NULL),
 (21,'KarunaKar Mohapatra','KarunaKar Mohapatra','OSD(Law)','OSD(Law)','','',8,0,'','OffProfile20161027_165215.jpg',NULL,2,0,'2016-10-27 16:52:15',1,'2020-08-14 13:24:21',1,'\0',NULL);
INSERT INTO `t_officer_profile` (`intProfileId`,`vchMinisterNameE`,`vchMinisterNameH`,`vchDesignationE`,`vchDesignationH`,`vchQulificationE`,`vchQulificationH`,`intSlNo`,`intLinkType`,`vchUrl`,`vchImage`,`vchMobile`,`tinPublishStatus`,`tinArcStatus`,`stmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`dtmArchieveOn`) VALUES 
 (22,'Pradip Kumar Jally,OPS(I)Jr.','Pradip Kumar Jally,OPS(I)Jr.','Asst. Transport Commissioner (Enf.)','Asst. Transport Commissioner (Enf.)','','',8,0,'','OffProfile20161027_165302.jpg',NULL,2,0,'2016-10-27 16:53:02',1,'2016-10-27 18:07:27',1,'',NULL),
 (23,'Sadaf Shuab,OFS(I)Jr.','','Accounts Officer','','','',7,0,'','OffProfile20161027_165345.jpg','',2,0,'2016-10-27 16:53:45',1,'2020-08-14 13:24:21',1,'\0',NULL),
 (24,'Bijaya Kumar Mishra','Bijaya Kumar Mishra','Assistant Director (Road Safety)','Assistant Director (Tax)','','',10,0,'','OffProfile20161027_165510.jpg','',2,0,'2016-10-27 16:55:10',1,'2020-08-14 13:24:21',1,'\0',NULL),
 (25,'Sarat Chandra Khandual','Sarat Chandra Khandual','O.S.D To Transport Commissioner','Private Secretary To Transport Commissioner','','',12,0,'','OffProfile20161027_165617.jpg','',2,0,'2016-10-27 16:56:17',1,'2020-08-14 13:24:21',1,'\0',NULL),
 (26,'Arati Nayak','Arati Nayak','Asst. Director (TS)','Asst. Director (TS)','','',11,0,'','OffProfile20161027_165706.jpg',NULL,2,0,'2016-10-27 16:57:06',1,'2018-05-19 16:43:18',1,'',NULL);
INSERT INTO `t_officer_profile` (`intProfileId`,`vchMinisterNameE`,`vchMinisterNameH`,`vchDesignationE`,`vchDesignationH`,`vchQulificationE`,`vchQulificationH`,`intSlNo`,`intLinkType`,`vchUrl`,`vchImage`,`vchMobile`,`tinPublishStatus`,`tinArcStatus`,`stmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`dtmArchieveOn`) VALUES 
 (27,'Sarat Chandra Das','Sarat Chandra Das','Section Officer','Section Officer','','',13,0,'','OffProfile20161027_165750.jpg',NULL,2,0,'2016-10-27 16:57:50',1,'2020-08-14 13:24:21',1,'\0',NULL),
 (28,'Purna chandra Behera','Purna chandra Behera','Section Officer','Section Officer','','',14,0,'','OffProfile20161027_165916.jpg',NULL,2,0,'2016-10-27 16:59:16',1,'2016-10-27 18:07:49',1,'',NULL),
 (29,'Balaram Mallick','Balaram Mallick','Section Officer','Section Officer','','',14,0,'','OffProfile20161027_165954.jpg',NULL,2,0,'2016-10-27 16:59:54',1,'2020-08-14 13:24:21',1,'',NULL),
 (30,'Pramila Kansrali','Pramila Kansrali','Section Officer','Section Officer','','',15,0,'','OffProfile20161027_170038.jpg',NULL,2,0,'2016-10-27 17:00:38',1,'2020-08-14 13:24:21',1,'\0',NULL),
 (31,'Reeta Mahakud','Reeta Mahakud','Section Officer','Section Officer','','',16,0,'','OffProfile20161027_170115.jpg',NULL,2,0,'2016-10-27 17:01:15',1,'2020-08-14 13:24:21',1,'\0',NULL);
INSERT INTO `t_officer_profile` (`intProfileId`,`vchMinisterNameE`,`vchMinisterNameH`,`vchDesignationE`,`vchDesignationH`,`vchQulificationE`,`vchQulificationH`,`intSlNo`,`intLinkType`,`vchUrl`,`vchImage`,`vchMobile`,`tinPublishStatus`,`tinArcStatus`,`stmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`dtmArchieveOn`) VALUES 
 (32,'Narayan Sethy','Narayan Sethy','Section Officer','Section Officer','','',14,0,'','OffProfile20161027_170152.jpg',NULL,2,0,'2016-10-27 17:01:52',1,'2018-05-19 16:43:19',1,'',NULL),
 (33,'pentest','','ceo0','','oiioiois','',19,0,'','OffProfile20161130_150505.jpg','7412589630',1,0,'2016-11-30 15:05:05',1,'2016-12-05 18:14:22',1,'',NULL),
 (34,'Smt. Kanakchampa Meher, OAS-I(SB)','','Deputy Secretary','','','',5,0,'','OffProfile20190619_162315.jpeg','',2,0,'2017-06-19 11:55:44',1,'2020-08-14 13:24:21',1,'\0',NULL),
 (35,'Sri. Jiten Kumar Pattnaik','','Dy. Superintendent (Traffic)','','','',9,0,'','OffProfile20190601_113448.jpg','',2,0,'2017-06-19 12:02:26',1,'2020-08-14 13:24:21',1,'\0',NULL),
 (36,'Manoranjan Lodha','','Addl. Comm. Transport (Tech.)','','','',4,0,'','OffProfile20200814_132857.jpeg','',2,0,'2017-06-19 12:04:40',1,'2020-08-14 13:29:10',1,'\0',NULL);
INSERT INTO `t_officer_profile` (`intProfileId`,`vchMinisterNameE`,`vchMinisterNameH`,`vchDesignationE`,`vchDesignationH`,`vchQulificationE`,`vchQulificationH`,`intSlNo`,`intLinkType`,`vchUrl`,`vchImage`,`vchMobile`,`tinPublishStatus`,`tinArcStatus`,`stmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`dtmArchieveOn`) VALUES 
 (37,'Shri Srinibas Behera,OAS (SAG)','','Addl. Comm. Transport (Admin)','','','',2,0,'','OffProfile20180720_142651.jpg','',2,0,'2018-05-19 16:36:15',1,'2020-08-14 13:24:21',1,'\0',NULL),
 (38,'SHRI SHARAT KUMAR PUROHIT, O.A.S (S)','','Joint Comm. Transport (Tax)','','','',4,0,'','OffProfile20191106_103728.jpg','',2,0,'2019-10-24 13:41:41',1,'2020-02-03 11:06:04',1,'',NULL),
 (39,'Brajabandhu Bhola','','Secretary STA','','OAS (SAG)','',3,0,'','OffProfile20200715_124604.jpeg','',2,0,'2020-07-15 12:46:04',1,'2020-08-14 13:29:48',1,'\0',NULL);
/*!40000 ALTER TABLE `t_officer_profile` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_officers`
--

DROP TABLE IF EXISTS `t_officers`;
CREATE TABLE `t_officers` (
  `intOfficerId` int(11) NOT NULL AUTO_INCREMENT,
  `intCategory` int(11) NOT NULL,
  `vchOfficername` varchar(250) NOT NULL,
  `txtAddress` mediumtext,
  `vchofficeno` varchar(200) DEFAULT NULL,
  `vchResno` varchar(200) DEFAULT NULL,
  `intOrderno` int(11) DEFAULT '0',
  `tinPublishStatus` tinyint(3) DEFAULT '1',
  `stmCreatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `intCreatedBy` int(11) DEFAULT '1',
  `dtmUpdatedOn` datetime DEFAULT NULL,
  `intUpdatedBy` int(11) DEFAULT NULL,
  `bitDeletedFlag` bit(1) DEFAULT b'0',
  PRIMARY KEY (`intOfficerId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_officers`
--

/*!40000 ALTER TABLE `t_officers` DISABLE KEYS */;
INSERT INTO `t_officers` (`intOfficerId`,`intCategory`,`vchOfficername`,`txtAddress`,`vchofficeno`,`vchResno`,`intOrderno`,`tinPublishStatus`,`stmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`) VALUES 
 (1,1,'Dr. Pramod Kumar Meherda, IAS Commissioner-cum-Secretary to the Governor','text address','(0674) 2536699','(0674) 2536969',1,2,'2021-05-22 18:01:38',1,'2021-06-08 17:43:28',1,'\0'),
 (2,2,'Lt. B. Anuragh Iyer , IN ADC to the Governor,Odisha','4R-1, Raj Bhavan Colony,Bhubaneswar 751008','(0674) 2536111','( 0674)2397411 9437044444 (Mob.)',2,2,'2021-06-08 16:34:52',1,'2021-06-08 17:43:28',1,'\0'),
 (3,2,'Shri Kailash Nath Nayak ,OAPS ADC(P) to the Governor,Odisha','3R-3 Raj Bhavan Colony ,Bhubaneswar-751008','(0674) 2536111','9437344444 (0674)2397390/ 9437010464',3,2,'2021-06-08 16:36:00',1,'2021-06-08 17:43:28',1,'\0'),
 (4,2,'Shri Manoj Mishra, CSO','R-4 Raj Bhavan Colony ,Bhubaneswar-751008','9437146879','9437146879',4,2,'2021-06-08 16:36:46',1,'2021-06-08 17:43:28',1,'\0'),
 (5,3,'Shri Himansu Narayan Patnaik Personal Secretary to the Governor','(0674) 2397406','(0674) 2536222','(0674) 2397406',5,2,'2021-06-08 16:37:29',1,'2021-06-08 17:43:28',1,'\0');
INSERT INTO `t_officers` (`intOfficerId`,`intCategory`,`vchOfficername`,`txtAddress`,`vchofficeno`,`vchResno`,`intOrderno`,`tinPublishStatus`,`stmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`) VALUES 
 (6,3,'Shri Inder Jeet Khurana Officer-on-Special Duty to the Governor','Governorâ€™s Estate, Bhubaneswar','(0674) 2397782','(0674) 2397782',6,2,'2021-06-08 16:39:15',1,'2021-06-08 17:43:28',1,'\0'),
 (7,3,'Shri Vinod Kumar Personal Assistant to the Governor','Governorâ€™s Estate,Bhubaneswar.','(0674) 2397782','(0674) 2397782',7,2,'2021-06-08 16:39:54',1,'2021-06-08 17:43:28',1,'\0'),
 (8,4,'Shri Gauttam Choudhury, OAS Comptroller','Qtrs No. VR-13, Unit-VI, Bhubaneswar','(0674) 2397353','(0674) 2397860',8,2,'2021-06-08 16:40:49',1,'2021-06-08 17:43:28',1,'\0');
/*!40000 ALTER TABLE `t_officers` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_pages`
--

DROP TABLE IF EXISTS `t_pages`;
CREATE TABLE `t_pages` (
  `intPageId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vchTitle` varchar(100) DEFAULT NULL,
  `vchName` varchar(80) DEFAULT NULL,
  `vchFeaturedImage` varchar(200) DEFAULT NULL,
  `intLinkType` smallint(2) unsigned NOT NULL,
  `vchUrl` text,
  `intTemplateType` smallint(2) unsigned NOT NULL,
  `vchPluginName` varchar(100) DEFAULT NULL,
  `intWindowStatus` smallint(2) unsigned NOT NULL,
  `intPublishStatus` smallint(2) unsigned NOT NULL,
  `dtmCreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intCreatedBy` int(10) unsigned NOT NULL,
  `dtmUpdatedOn` datetime DEFAULT NULL,
  `intUpdatedBy` int(10) unsigned DEFAULT NULL,
  `bitDeletedFlag` bit(1) NOT NULL DEFAULT b'0',
  `vchPageAlias` varchar(50) DEFAULT NULL,
  `vchMetaTitle` varchar(60) DEFAULT NULL,
  `vchMetaKeyword` varchar(150) DEFAULT NULL,
  `vchMetaDescription` varchar(200) DEFAULT NULL,
  `vchMetaType` varchar(50) DEFAULT NULL,
  `vchMetaImage` varchar(100) DEFAULT NULL,
  `intArcStatus` int(10) unsigned NOT NULL DEFAULT '0',
  `dtmArchieveOn` datetime DEFAULT NULL,
  `vchSnippet` text,
  `INT_FUNCTION_ID` int(10) unsigned DEFAULT '0',
  `vchNameO` text,
  `vchLinkImage` varchar(264) DEFAULT NULL,
  PRIMARY KEY (`intPageId`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_pages`
--

/*!40000 ALTER TABLE `t_pages` DISABLE KEYS */;
INSERT INTO `t_pages` (`intPageId`,`vchTitle`,`vchName`,`vchFeaturedImage`,`intLinkType`,`vchUrl`,`intTemplateType`,`vchPluginName`,`intWindowStatus`,`intPublishStatus`,`dtmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`vchPageAlias`,`vchMetaTitle`,`vchMetaKeyword`,`vchMetaDescription`,`vchMetaType`,`vchMetaImage`,`intArcStatus`,`dtmArchieveOn`,`vchSnippet`,`INT_FUNCTION_ID`,`vchNameO`,`vchLinkImage`) VALUES 
 (1,'PROFILE','Honorable Governor, Odisha - Professor Ganeshi Lal','Page_1622012471.jpg',1,'',1,'0',1,2,'2021-05-26 12:32:21',1,'2021-05-26 13:02:25',1,'\0','profile','profile','profile','profile','','',0,NULL,'Prof. Ganeshi Lal was sworn in as the Honâ€™ble Governor of Odisha on 29th May 2018. He was administered the oath of office by the Honâ€™ble Chief Justice of High Court of Odisha Shri Justice Vineet Saran in a function held at the Abhishek Hall of Raj Bhavan.',0,'',''),
 (2,'Role Of Governer','As Constitutional Head','',1,'',1,'0',1,2,'2021-05-26 12:53:15',1,'2021-05-31 16:50:32',1,'\0','role-of-governer','','','','','',0,NULL,'',0,'',''),
 (3,'Incumbency Chart of Governors','The illustrious Governors of Odisha who stayed at Raj Bhavan, Bhubanes','',1,'',2,'null',1,2,'2021-05-26 12:55:51',1,'2021-05-27 10:56:50',1,'\0','former-governers','','','','','',0,NULL,'',40,'','');
INSERT INTO `t_pages` (`intPageId`,`vchTitle`,`vchName`,`vchFeaturedImage`,`intLinkType`,`vchUrl`,`intTemplateType`,`vchPluginName`,`intWindowStatus`,`intPublishStatus`,`dtmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`vchPageAlias`,`vchMetaTitle`,`vchMetaKeyword`,`vchMetaDescription`,`vchMetaType`,`vchMetaImage`,`intArcStatus`,`dtmArchieveOn`,`vchSnippet`,`INT_FUNCTION_ID`,`vchNameO`,`vchLinkImage`) VALUES 
 (4,'RAJ BHAVAN, CUTTACK','RAJ BHAVAN, CUTTACK','Page_1622014075.jpg',1,'',1,'0',1,2,'2021-05-26 12:59:05',1,'2021-05-26 13:02:24',1,'\0','raj-bhavan-cuttaack','','','','','',0,NULL,'',0,'',''),
 (5,'RAJ BHAVAN, PURI','RAJ BHAVAN, PURI','Page_1622014208.JPG',1,'',1,'0',1,2,'2021-05-26 13:01:19',1,'2021-05-26 13:10:01',1,'\0','raj-bhavan-puri','','','','','',0,NULL,'',0,'',''),
 (6,'RAJ BHAVAN, BHUBANESWAR','RAJ BHAVAN, BHUBANESWAR','Page_1622014265.JPG',1,'',1,'0',1,2,'2021-05-26 13:02:15',1,'2021-05-26 13:10:01',1,'\0','raj-bhavan-bhubaneswar','','','','','',0,NULL,'',0,'',''),
 (7,'His Excellency The Governer','His Excellency The Governer','Page_1623037040.png',1,'',1,'0',1,2,'2021-05-26 13:05:45',1,'2021-06-07 09:08:07',1,'\0','His-Excellency-The-Governer','','','','','',0,NULL,'Professor Ganeshi Lal',0,'','');
INSERT INTO `t_pages` (`intPageId`,`vchTitle`,`vchName`,`vchFeaturedImage`,`intLinkType`,`vchUrl`,`intTemplateType`,`vchPluginName`,`intWindowStatus`,`intPublishStatus`,`dtmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`vchPageAlias`,`vchMetaTitle`,`vchMetaKeyword`,`vchMetaDescription`,`vchMetaType`,`vchMetaImage`,`intArcStatus`,`dtmArchieveOn`,`vchSnippet`,`INT_FUNCTION_ID`,`vchNameO`,`vchLinkImage`) VALUES 
 (8,'History','History','',1,'',1,'0',1,2,'2021-05-26 13:06:13',1,'2021-05-26 13:10:01',1,'\0','History','','','','','',0,NULL,'',0,'',''),
 (9,'Explore Raj Bhavan','Explore Raj Bhavan','',1,'',1,'0',1,2,'2021-05-26 13:06:50',1,'2021-05-26 13:10:01',1,'\0','Explore-Raj-Bhavan','','','','','',0,NULL,'',0,'',''),
 (10,'Media','Media','',1,'',1,'0',1,2,'2021-05-26 13:07:13',1,'2021-05-26 13:10:01',1,'\0','Media','','','','','',0,NULL,'Media',0,'',''),
 (11,'Events','Events','',1,'',1,'0',1,2,'2021-05-26 13:07:32',1,'2021-05-26 13:10:01',1,'\0','Events','','','','','',0,NULL,'Events',0,'',''),
 (12,'Tender','Tender','',1,'',2,'null',1,2,'2021-05-26 13:08:49',1,'2021-05-27 10:55:13',1,'\0','Tender','','','','','',0,NULL,'Tender',18,'','');
INSERT INTO `t_pages` (`intPageId`,`vchTitle`,`vchName`,`vchFeaturedImage`,`intLinkType`,`vchUrl`,`intTemplateType`,`vchPluginName`,`intWindowStatus`,`intPublishStatus`,`dtmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`vchPageAlias`,`vchMetaTitle`,`vchMetaKeyword`,`vchMetaDescription`,`vchMetaType`,`vchMetaImage`,`intArcStatus`,`dtmArchieveOn`,`vchSnippet`,`INT_FUNCTION_ID`,`vchNameO`,`vchLinkImage`) VALUES 
 (13,'Contact Us','Contact Us','',1,'',1,'0',1,2,'2021-05-26 13:09:29',1,'2021-05-26 13:10:01',1,'\0','Contact-Us','','','','','',0,NULL,'Contact Us',0,'',''),
 (14,'Feedback','Feedback','',1,'',2,'null',1,2,'2021-05-26 13:09:49',1,'2021-05-27 10:53:58',1,'\0','Feedback','','','','','',0,NULL,'Feedback',42,'',''),
 (15,'OFFICERS OF RAJ BHAVAN','OFFICERS OF RAJ BHAVAN','',1,'',2,'null',1,2,'2021-05-26 13:40:44',1,'2021-06-06 13:01:29',1,'\0','OFFICERS-OF-RAJ-BHAVAN','OFFICERS OF RAJ BHAVAN','','','','',0,NULL,'GOVERNORâ€™S SECRETARIAT, BHUBANESWAR \r\n\r\nEPABX-0674-2397581/2397853/2536584/2536704/2536709, FAX-2536582\r\n\r\nRAJ BHAVAN, PURI-06752-222068',17,'',''),
 (16,'FORMER SECRETARIES','FORMER SECRETARIES','',1,'',2,'null',1,2,'2021-05-26 13:41:16',1,'2021-05-27 10:51:31',1,'\0','FORMER-SECRETARIES','FORMER SECRETARIES','FORMER SECRETARIES','','','',0,NULL,'FORMER SECRETARIES',41,'','');
INSERT INTO `t_pages` (`intPageId`,`vchTitle`,`vchName`,`vchFeaturedImage`,`intLinkType`,`vchUrl`,`intTemplateType`,`vchPluginName`,`intWindowStatus`,`intPublishStatus`,`dtmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`vchPageAlias`,`vchMetaTitle`,`vchMetaKeyword`,`vchMetaDescription`,`vchMetaType`,`vchMetaImage`,`intArcStatus`,`dtmArchieveOn`,`vchSnippet`,`INT_FUNCTION_ID`,`vchNameO`,`vchLinkImage`) VALUES 
 (17,'Inside Raj Bhavan, Bhubaneswar','Inside Raj Bhavan, Bhubaneswar','',1,'',1,'0',1,2,'2021-05-26 13:45:20',1,'2021-05-26 13:47:43',1,'\0','Inside-Ra-Bhavan-Bhubaneswar','Inside Raj Bhavan, Bhubaneswar','Raj Bhavan, Bhubaneswar','','','',0,NULL,'Inside Raj Bhavan, Bhubaneswar',0,'',''),
 (18,'At Home Party','At Home Party','',1,'',1,'0',1,2,'2021-05-26 13:46:40',1,'2021-05-26 13:47:43',1,'\0','homeParty','','','','','',0,NULL,'At Home Party',0,'',''),
 (19,'ROSHNI - A Green Innovation for Sustainable Habitats','ROSHNI - A Green Innovation for Sustainable Habitats','',1,'',1,'0',1,2,'2021-05-26 13:47:23',1,'2021-05-26 13:47:43',1,'\0','roshni','','','','','',0,NULL,'roshni',0,'',''),
 (20,'THE RAJ BHAVAN COMPLEX','THE RAJ BHAVAN COMPLEX','',1,'',1,'0',1,2,'2021-05-26 15:41:56',1,'2021-05-26 15:58:50',1,'\0','raj-bhavan-complex','','','','','',0,NULL,'',0,'','');
INSERT INTO `t_pages` (`intPageId`,`vchTitle`,`vchName`,`vchFeaturedImage`,`intLinkType`,`vchUrl`,`intTemplateType`,`vchPluginName`,`intWindowStatus`,`intPublishStatus`,`dtmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`vchPageAlias`,`vchMetaTitle`,`vchMetaKeyword`,`vchMetaDescription`,`vchMetaType`,`vchMetaImage`,`intArcStatus`,`dtmArchieveOn`,`vchSnippet`,`INT_FUNCTION_ID`,`vchNameO`,`vchLinkImage`) VALUES 
 (21,'MAIN BUILDING','MAIN BUILDING','Page_1622023974.JPG',1,'',1,'0',1,2,'2021-05-26 15:44:04',1,'2021-05-26 15:58:50',1,'\0','main-building','','','','','',0,NULL,'',0,'',''),
 (22,'Abhishek Hall','Abhishek Hall','Page_1622024676.jpeg',1,'',1,'0',1,2,'2021-05-26 15:55:46',1,'2021-05-26 16:14:38',1,'\0','Abhishek-Hall','','','','','',0,NULL,'Situated on the ground floor, the Abhishek Hall serves as the venue for important official meetings and functions including swearing-in ceremonies. This 49 feet by 29 feet hall is decorated with two large paintings.',0,'',''),
 (23,'Banquet Hall','Banquet Hall','Page_1622024748.jpg',1,'',1,'0',1,2,'2021-05-26 15:56:58',1,'2021-05-26 16:14:38',1,'\0','Banquet-Hall','','','','','',0,NULL,'Banquets and parties are held in this 39 feet by 32 feet hall. It is decked with photographs of Presidents of India and several other paintings.',0,'','');
INSERT INTO `t_pages` (`intPageId`,`vchTitle`,`vchName`,`vchFeaturedImage`,`intLinkType`,`vchUrl`,`intTemplateType`,`vchPluginName`,`intWindowStatus`,`intPublishStatus`,`dtmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`vchPageAlias`,`vchMetaTitle`,`vchMetaKeyword`,`vchMetaDescription`,`vchMetaType`,`vchMetaImage`,`intArcStatus`,`dtmArchieveOn`,`vchSnippet`,`INT_FUNCTION_ID`,`vchNameO`,`vchLinkImage`) VALUES 
 (24,'Mini Conference Hall','Mini Conference Hall','Page_1622024823.jpeg',1,'',1,'0',1,2,'2021-05-26 15:58:13',1,'2021-05-26 16:14:38',1,'\0','Mini-Conference-Hall','','','','','',0,NULL,'A mini conference hall with a capacity of about 20 persons, has been added to the main block. The seats surround an oval-shaped table and are equipped with microphones. The hall is equipped with state-of-the-art infrastructure including a computer video conferencing unit and an overhead LCD projector with screen. His Excellency Dr. A.P.J Abdul Kalam, the then President of India, inaugurated the hall on 3rd July 2006.',0,'',''),
 (25,'RTI','RTI','',1,'',4,'0',1,2,'2021-05-26 16:06:56',1,'2021-05-26 16:14:38',1,'\0','RTI','','','','','',0,NULL,'RTI',0,'','LinkDoc20210526_160546.pdf');
INSERT INTO `t_pages` (`intPageId`,`vchTitle`,`vchName`,`vchFeaturedImage`,`intLinkType`,`vchUrl`,`intTemplateType`,`vchPluginName`,`intWindowStatus`,`intPublishStatus`,`dtmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`vchPageAlias`,`vchMetaTitle`,`vchMetaKeyword`,`vchMetaDescription`,`vchMetaType`,`vchMetaImage`,`intArcStatus`,`dtmArchieveOn`,`vchSnippet`,`INT_FUNCTION_ID`,`vchNameO`,`vchLinkImage`) VALUES 
 (26,'Photo Archives','Photo Archives','',1,'',2,'null',1,2,'2021-05-26 16:08:11',1,'2021-05-27 10:50:44',1,'\0','mediagallery','PHOTO ARCHIVES','PHOTO ARCHIVES','PHOTO ARCHIVES','','',0,NULL,'PHOTO ARCHIVES',15,'',''),
 (27,'Speeches','Speeches','',1,'',1,'0',1,2,'2021-05-26 16:08:38',1,'2021-05-26 16:14:38',1,'\0','Speeches','','','','','',0,NULL,'Speeches',0,'',''),
 (28,'10th Convocation of Ravenshaw University, Cuttack','10th Convocation of Ravenshaw University, Cuttack','',1,'',4,'0',1,2,'2021-05-26 16:10:06',1,'2021-05-26 16:14:37',1,'\0','convocation-revenshaw-university','','','','','',0,NULL,'10th Convocation of Ravenshaw University, Cuttack',0,'','LinkDoc20210526_160856.pdf'),
 (29,'50th Conference of Governors at Rashtrapati Bhavan, New Delhi','50th Conference of Governors at Rashtrapati Bhavan, New Delhi','',1,'',4,'0',1,2,'2021-05-26 16:11:40',1,'2021-05-26 16:14:37',1,'\0','conference-rastrapati-bhavan','','','','','',0,NULL,'50th Conference of Governors at Rashtrapati Bhavan, New Delhi',0,'','LinkDoc20210526_161030.pdf');
INSERT INTO `t_pages` (`intPageId`,`vchTitle`,`vchName`,`vchFeaturedImage`,`intLinkType`,`vchUrl`,`intTemplateType`,`vchPluginName`,`intWindowStatus`,`intPublishStatus`,`dtmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`vchPageAlias`,`vchMetaTitle`,`vchMetaKeyword`,`vchMetaDescription`,`vchMetaType`,`vchMetaImage`,`intArcStatus`,`dtmArchieveOn`,`vchSnippet`,`INT_FUNCTION_ID`,`vchNameO`,`vchLinkImage`) VALUES 
 (30,'Acceptance Speech at Hanseo University, Korea','Acceptance Speech at Hanseo University, Korea','',1,'',4,'0',1,2,'2021-05-26 16:12:40',1,'2021-05-26 16:14:37',1,'\0','speech-hanseo-university-korea','','','','','',0,NULL,'',0,'','LinkDoc20210526_161130.pdf'),
 (31,'Convocation of (CUTM) at Gajapati','Convocation of (CUTM) at Gajapati','',1,'',4,'0',1,2,'2021-05-26 16:13:49',1,'2021-05-26 16:14:37',1,'\0','Convocation-of-CUTM-Gajapati','','','','','',0,NULL,'',0,'','LinkDoc20210526_161239.pdf'),
 (32,'CULTURAL EVENTS','CULTURAL EVENTS','',1,'',2,'null',1,2,'2021-05-26 16:18:09',1,'2021-05-27 10:50:17',1,'\0','CULTURAL-EVENTS','CULTURAL EVENTS','CULTURAL EVENTS','CULTURAL EVENTS','','',0,'0000-00-00 00:00:00','',15,'',''),
 (33,'OFFICIAL EVENTS','OFFICIAL EVENTS','',1,'',2,'null',1,2,'2021-05-26 16:19:08',1,'2021-05-27 10:50:02',1,'\0','OFFICIAL-EVENTS','OFFICIAL EVENTS','OFFICIAL EVENTS','OFFICIAL EVENTS','','',0,'0000-00-00 00:00:00','OFFICIAL EVENTS',15,'','');
/*!40000 ALTER TABLE `t_pages` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_pages_content_e`
--

DROP TABLE IF EXISTS `t_pages_content_e`;
CREATE TABLE `t_pages_content_e` (
  `intContentId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intPageId` int(10) unsigned NOT NULL,
  `intPageNo` int(10) unsigned NOT NULL,
  `vchContentE` mediumtext,
  `intPortalType` smallint(2) unsigned DEFAULT NULL,
  `bitDeletedFlag` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`intContentId`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_pages_content_e`
--

/*!40000 ALTER TABLE `t_pages_content_e` DISABLE KEYS */;
INSERT INTO `t_pages_content_e` (`intContentId`,`intPageId`,`intPageNo`,`vchContentE`,`intPortalType`,`bitDeletedFlag`) VALUES 
 (4,1,1,'&lt;p&gt;Prof. Ganeshi Lal was sworn in as the Hon&amp;rsquo;ble Governor of Odisha on 29th May 2018. He was administered the oath of office by the Hon&amp;rsquo;ble Chief Justice of High Court of Odisha Shri Justice Vineet Saran in a function held at the Abhishek Hall of Raj Bhavan.&lt;/p&gt;\r\n\r\n&lt;p&gt;Prof. Lal was born in Sirsa, Haryana on 1st March, 1942 and holds a degree in English Honours. He further went on to gain a post-graduate degree in Mathematics. He was brilliant in studies and stood First Class First in FA, BA and MA Class and was a Gold Medallist.&lt;/p&gt;\r\n\r\n&lt;p&gt;After completing his education, he became an academician and served as a professor in various government colleges of Haryana between 1964 and 1991.&lt;/p&gt;\r\n\r\n&lt;p&gt;Since 1962, Prof. Lal is actively associated with the Rastriya Swayamsevak Sangh (RSS) and held posts in the Hisar, Rohtak Wing of RSS.&lt;/p&gt;\r\n\r\n&lt;p&gt;Prof. Lal&amp;rsquo;s political career started with grassroots organisations of the Bharatiya Janata Party (BJP). He was former State President of Haryana BJP, a former Chairman of Akhil Bharatiya Vidyarthi Parishad, Haryana, and former National President of the BJP Disciplinary Committee. During Emergency period in the country in 1976, Prof. Lal was sent to jail. He also actively participated in the Ram Janmabhoomi Movement.&lt;/p&gt;\r\n\r\n&lt;p&gt;Prof. Lal was elected as MLA from Sirsa constituency in 1996, and became a Minister in the Haryana Vikas Party (HVP)-BJP Government in Haryana from 1996-99.&lt;/p&gt;\r\n\r\n&lt;p&gt;Prof. Lal is married to Smt. Sushila Devi.&lt;/p&gt;\r\n',0,'\0'),
 (7,4,1,'&lt;p&gt;Situated on the bank of the Kathjodi river, the Lal Bagh Palace at Cuttack has a long and colourful history. This building witnessed the rise and fall of several rulers who controlled the fortune of Odisha. It was constructed by the Mughal Subedar stationed at Cuttack. Subsequently, the property passed into the hands of the Marathas. Over the years, the premises have undergone several alterations and modifications.&lt;/p&gt;\r\n\r\n&lt;p&gt;William Bruton visited Cuttack in 1633, when the Lal Bagh Palace was under construction. In 1741, Saulat Jung, the Naib Nazim, took up residence in the palace. The building was occupied by the Naib Nazims till 1751 and by the representatives of the Bhonslas of Nagpur from 1751 to 1803. Lal Bagh came into the possession of the British in 1803 when Colonel Harcourt&amp;rsquo;s men defeated the Maratha soldiers. The Lal Bagh Palace was apparently leased out but again came into the possession of the government, who sold it in January 1862, and the purchaser sold the estate along with the building to the East India Irrigation Company. In 1863, the building came into the possession of the Government when they took over the irrigation works from the Company. Since 1868 the building was occupied by Commissioners and sometimes by collectors.&lt;/p&gt;\r\n\r\n&lt;p&gt;In 1896, Shri R.C. Dutt, the then Commissioner, who was also a well-known historian, lived in this building. In a letter to his daughter, he describes the building as &amp;ldquo;the best-situated Commissioner&amp;rsquo;s house.&amp;rdquo; The building which was still under the Irrigation Branch was transferred to the Buildings and Roads Branch of the Government in 1914. In 1941, Shri K.C. Gajapati Narayan Deo, Maharaja of Paralakhemundi and Premier of Odisha, fixed his residence at the Lal Bagh palace for some time.&lt;/p&gt;\r\n\r\n&lt;p&gt;On 18th July 1942, the Lal Bagh Palace became the new Government House. Sir Hawthorne Lewis was the first Governor to live in the Lal Bagh palace. This historic building, which stood witness to countless political and social upheavals during Mughal, Maratha and British rule in Odisha, became the center of administration.&lt;/p&gt;\r\n\r\n&lt;p&gt;The Lal Bagh Palace continued to serve as the residence of the Governor till 1960. During the tenure of Shri Sukthankar in 1960, the Raj Bhavan was shifted from Cuttack to Bhubaneswar. Shri Sukthankar generously donated the building to the Indian Red Cross Society to utilize it as a children&amp;rsquo;s hospital. The Government of Orissa [now, Odisha] took over this hospital in 1966 and made it an independent institute for post-graduate training and research. At present, the institute is known as Sardar Vallabhbhai Patel Post Graduate Institute of Pediatrics, and is popularly known as Shishu Bhavan.&lt;/p&gt;\r\n',0,'\0');
INSERT INTO `t_pages_content_e` (`intContentId`,`intPageId`,`intPageNo`,`vchContentE`,`intPortalType`,`bitDeletedFlag`) VALUES 
 (8,5,1,'&lt;p&gt;The Raj Bhavan at Puri, which was known as the Government House during the British rule, was constructed in the early part of the twentieth century. Soon after the Province of Bihar and Orissa was carved out of the Bengal Presidency in 1912, the administration of the newly formed province functioned at Ranchi. However, it was decided that Bankipore Patna would be the capital and Puri would be the summer capital of the province.&lt;/p&gt;\r\n\r\n&lt;p&gt;The construction of the Government House at Puri commenced almost at the centre of the sprawling Balukhand Government Estate towards the later part of 1913 and was completed in 1914. During the period from 1914 to 1936, as many as ten Lieutenant Governors and Governors of Bihar and Odisha made an annual stay here during summer months.&lt;/p&gt;\r\n\r\n&lt;p&gt;After Odisha was accorded the status of a separate province in 1936, Cuttack became its capital. The Government House at Puri then served as the interim residence of the Governor. All care was taken to make the building suitable and comfortable for the imperial dignity of His Majesty&amp;rsquo;s representative in the province. Later, several additional structures were built.&lt;/p&gt;\r\n\r\n&lt;p&gt;After the Governor&amp;rsquo;s residence shifted to Cuttack in August 1942, the Government House at Puri served as the summer resort of the Governor. Successive Governors and their guests stayed here during their visits to Puri. Several dignitaries including His Excellency Lord Linlithgow and His Excellency Lord Mountbatten visited the Government House. &amp;ldquo;Puri sea beach is the best beach I have ever visited and the Puri Government House is the finest,&amp;rdquo; remarked Lord Mountbatten in 1948, as Smt Saroj Mukherjee, the daughter of His Excellency Dr. Kailash Nath Katju, recalls. Usually, when the guests of His Excellency visit Odisha, they make it a point to pay a visit to Puri.&lt;/p&gt;\r\n\r\n&lt;p&gt;Originally, the Government House stood on an area measuring 30.226 acres, out of which a plot of land measuring 8.926 acres was alienated. Hotel Neelachal Ashok was built here in 1983 to give a boost to tourism in the state. The two-storeyed Puri Raj Bhavan now stands on an area of 21.30 acres comprising 11 suites including 4 VIP suites, a kitchen and a dining hall besides an office room, a reception hall and a sprawling verandah.&lt;/p&gt;\r\n',0,'\0'),
 (9,6,1,'&lt;p&gt;The Raj Bhavan at Bhubaneswar is an important landmark of the modern capital city of Odisha. Situated on a hillock known as Bhalu Mundia, the building presents a magnificent sight. The construction of a residence for the Governor was taken up in a sprawling plot of land measuring 88 acres, which was then located in the western part of the existing township. Architect Shri Julius Vaz prepared the design.&lt;/p&gt;\r\n\r\n&lt;p&gt;The foundation stone was laid by Dr. Harekrushna Mahatab, the then Chief Minister of Odisha. Construction work started on 1st January 1958 under the supervision of the Chief Engineer Shri K.K.Kartha, Superintending Engineers, Shri S. Behera and Shri S.R. Padhi and Executive Engineer Shri Mumtaz Ali. The construction was completed on 31st March, 1960. After the Raj Bhavan was properly furnished, Sri Y.N. Sukthankar, the 11th Governor of Odisha, occupied it. It has been the official accommodation of successive Governors of Odisha till date.&lt;/p&gt;\r\n',0,'\0');
INSERT INTO `t_pages_content_e` (`intContentId`,`intPageId`,`intPageNo`,`vchContentE`,`intPortalType`,`bitDeletedFlag`) VALUES 
 (11,8,0,'',0,'\0'),
 (12,9,0,'',0,'\0'),
 (13,10,0,'',0,'\0'),
 (14,11,0,'',0,'\0'),
 (16,13,0,'',0,'\0'),
 (20,17,0,'',0,'\0'),
 (21,18,0,'',0,'\0'),
 (22,19,0,'',0,'\0'),
 (23,20,1,'&lt;p&gt;The hilly terrain of the Raj Bhavan Complex has been terraced into several sections. On top of the hillock stands the magnificent main building, and the other buildings are located below it.&lt;/p&gt;\r\n\r\n&lt;p&gt;The complex comprises of the main building, the administrative block, an annexe, the office of the reserve inspector, a reception counter, a dispensary, a garage and a godown. A portion of the premises is forested and the remaining area is covered with different horticulture species such as coconut, cashew, mango and other fruit bearing trees. Open lawns adorn the paths leading up to the buildings.&lt;/p&gt;\r\n',0,'\0'),
 (24,21,1,'&lt;p&gt;&lt;span style=&quot;background-color:rgb(255, 255, 255); color:rgb(135, 135, 135); font-family:montserrat,sans-serif; font-size:16px&quot;&gt;The official chamber and residential quarters of His Excellency the Governor, office of the Secretary to Governor, office of the Aide-de-camp, Personal Secretary, Private Secretary and Comptroller, guest rooms, library, the Abhishek Hall, the Banquet Hall and a mini conference hall are located in the main building. Several artifacts comprising stone statues, pieces of filigree work, paintings, photographs and trophies adorn the Raj Bhavan.&lt;/span&gt;&lt;/p&gt;\r\n',0,'\0'),
 (25,22,1,'&lt;p&gt;Situated on the ground floor, the Abhishek Hall serves as the venue for important official meetings and functions including swearing-in ceremonies. This 49 feet by 29 feet hall is decorated with two large paintings.&lt;/p&gt;\r\n',0,'\0');
INSERT INTO `t_pages_content_e` (`intContentId`,`intPageId`,`intPageNo`,`vchContentE`,`intPortalType`,`bitDeletedFlag`) VALUES 
 (26,23,1,'&lt;p&gt;Banquets and parties are held in this 39 feet by 32 feet hall. It is decked with photographs of Presidents of India and several other paintings.&lt;/p&gt;\r\n',0,'\0'),
 (27,24,1,'&lt;p&gt;A mini conference hall with a capacity of about 20 persons, has been added to the main block. The seats surround an oval-shaped table and are equipped with microphones. The hall is equipped with state-of-the-art infrastructure including a computer video conferencing unit and an overhead LCD projector with screen. His Excellency Dr. A.P.J Abdul Kalam, the then President of India, inaugurated the hall on 3rd July 2006.&lt;/p&gt;\r\n',0,'\0'),
 (28,25,0,'',0,'\0'),
 (30,27,0,'',0,'\0'),
 (31,28,0,'',0,'\0'),
 (32,29,0,'',0,'\0'),
 (33,30,0,'',0,'\0'),
 (34,31,0,'',0,'\0'),
 (38,33,0,'',0,'\0'),
 (39,32,0,'',0,'\0'),
 (40,26,0,'',0,'\0'),
 (41,16,0,'',0,'\0'),
 (43,14,0,'',0,'\0');
INSERT INTO `t_pages_content_e` (`intContentId`,`intPageId`,`intPageNo`,`vchContentE`,`intPortalType`,`bitDeletedFlag`) VALUES 
 (44,12,0,'',0,'\0'),
 (45,3,0,'',0,'\0'),
 (50,2,1,'&lt;div class=&quot;container&quot; style=&quot;box-sizing: border-box; width: 1140px; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto; max-width: 1140px; color: rgb(33, 37, 41); font-family: Montserrat, sans-serif; font-size: 16px;&quot;&gt;\r\n&lt;div class=&quot;content-sec&quot; style=&quot;box-sizing: border-box; box-shadow: rgb(232, 232, 232) 0px 0px 10px; margin-top: -5.5rem; border-top: 2px solid rgb(43, 73, 135); border-radius: 3px;&quot;&gt;\r\n&lt;div class=&quot;content-inner governer-inner&quot; style=&quot;box-sizing: border-box; position: relative; padding: 1.5em; z-index: 2; background: url(&amp;quot;../images/introductionbg.png&amp;quot;) right top / 30% no-repeat rgb(255, 255, 255); overflow: hidden; border-radius: 3px;&quot;&gt;\r\n&lt;p&gt;Relevant provisions of the Constitution of India on Governor and his functions:&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;The report of the Comptroller and Auditor General of India relating that accounts of the State shall be submitted to the Governor, who shall cause them to be laid before the legislation of the State.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 151 (2)&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Governors of States:- There shall be a Governor for each state:&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;[Provided that nothing shall prevent the appointment of the same person as Governor for two or more states.]&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 153&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Executive power of State. - The Executive power of the state shall be vested in the Governor and shall be exercised by him either directly or through officers subordinate to him in accordance with this constitution.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(2) Nothing in this article shall-&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(a) Be deemed to transfer to the Governor any functions conferred by any existing law on any other authority; or&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(b) prevent Parliament or the Legislature of the State from conferring by law functions on any authority subordinate to the Governor .&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 154&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Appointment of Governor- The Governor of a State shall be appointed by the President by warrant under his hand and seal.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 155&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Term of office of Governor&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(1) The Governor shall hold office during the pleasure of the President.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(2) The Governor may, by writing under his hand addressed to the President, resign his office.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(3) Subject to the foregoing provisions of this article, a Governor shall hold for a term of five years from the date on which he enters upon his office.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Provided that a Governor shall, notwithstanding the expiration of his term, continue to hold office until his successor enters upon his office.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 156&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Qualification for appointment as Governor- No person shall be eligible for appointment as Governor unless he is a citizen of India and has completed the age of thirty-five years.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 157&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Condition of Governor&amp;#39;s Office&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(1) The Governor shall not be a member of either House of Parliament or of a House of the Legislator of any State specified in the First Schedule, and if a member of either House of Parliament or of a House of the Legislature of any such State be appointed Governor, he shall be deemed to have vacated his seat in that House or the date on which he enters upon his office as Governor.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(2) The Governor shall not hold any other office of profit.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(3) The Governor shall be entitled without payment of rent to the use of his official residences and shall be also entitled to such emoluments, allowances and privileges as may be determined by Parliament by law and until provision in that behalf is so made, such emoluments, allowances and privileges as are specified in the Second Schedule.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;[3A] where the same person is appointed as Governor of two or more States, the emoluments and allowances payable to the Governor shall be allocated among the States in such proportion as the President may by order determine.]&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(4) The emoluments and allowances of the Governor shall not be diminished during his term of office.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 158&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Oath or affirmation by Governor- Every Governor and every person discharging the functions of the Governor shall, before entering his office, make and subscribe in the presence of the Chief Justice of the High Court exercising jurisdiction in relation to the State, or, in his absence, the senior most Judge of that Court available, on oath or affirmation in the following form, that is to say-&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;I,A.B., do swear in the name of God/ solemnly affirm, that I will faithfully execute the office of Governor (or discharge the functions of the Governor) of .......(name of the State) and will to the best of my ability preserve, protect and defend the Constitution and the law and that I will devote myself to the service and well-being of the people of .......(name of the State).&amp;quot;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 159&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Discharge of the functions of the Governor in certain contingencies- The President may make such provision as he thinks fit or the discharge of the functions of the Governor of a State in any contingency not provided for this Chapter.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 160&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Power of governor to grant pardons, etc., and to suspend, remit or commute sentences in certain cases:&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;The Governor of a State shall have the power to grant pardons, reprieves, respites or remissions of punishment or to suspend, remit or commute the sentence of any person convicted of any offence against any law relating to a matter to which the executive power of the State extends.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 161&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(1) There shall be a council of Ministers with the Chief Minister at the head to aid and advise the Governor in the exercise of his functions, except in so far as he is by or under this Constitution required to exercise his functions or any of them in his discretion.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(2) If any question arises whether any matter is or is not a matter as respects which the Governor is by or under this Constitution requires to act I his discretion, the decision of the Governor in his discretion shall be final and the validity of anything done by the Governor shall not be called in question on the ground that he ought or ought not to have acted in his discretion.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(3) The question whether any, and if so what, advice was tendered by the Ministers to the Governor shall not be inquired into in any Court.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 163&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(1) The Chief Minister shall be appointed by the Governor and other Ministers shall be appointed by the Governor on the advice of the Chief Minister, and the Ministers shall hold office during the pleasure of the Governor;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 164&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(1) All executive action of the Government of a State shall be expressed to be taken in the name of the Governor.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(2) Orders and other instruments made and executed in the name of the Governor shall be authenticated in such matter as may be specified in rules to be made by the Governor, and the validity of an order or instrument which is so authenticated shall not be called in question on the ground that it is not an order or instrument made or executed by the Governor.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 166&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;It shall be the duty of the Chief Minister of each State:-&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(a) to communicate to the Governor of the State all decisions of the council of Ministers relating to the administration of the affairs of the State and proposals for legislation;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(b) to furnish such information relating to the administration of the affairs of the State and proposals for legislations the Governor may call for; and&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;&amp;copy; if the Governor so requires to submit for the consideration of the Council of Ministers any matter on which a decision has been taken by a Minister but which has not been considered by the Council.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 167&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(1)For every state there shall be a Legislature which shall consist of the Governor - .and&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(a) In the states of Bihar, Maharashtra, Karnataka and Uttar Pradesh, two Houses;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(b) In other States, one House.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 168&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(1)The Governor shall from time to time summon the House or each House of the Legislature of the State to meet at such time and place as he thinks fit, but six months shall not intervene between its last sitting in one session and the date appointed for its first sitting in the next session.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(2)The Governor may from time to time:-&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(a)prorogue the House or either House;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(b) dissolve the Legislative Assembly.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 174&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(1)The Governor may address the Legislative Assembly or, in the case of a State having a Legislative Council, either House of the Legislature of the State, or both Houses assembled together, and may for that purpose require the attendance of members.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(2)The Governor may send messages to the House or Houses of the Legislature of the State, whether with respect to a Bill then pending in the Legislature or otherwise, and a House to which any message is so sent shall with all convenient despatch consider any matter required by the message to be taken into consideration.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 175&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(1)At the commencement of (the first session after each general election to the Legislative Assembly ads at the commencement of the first session of leach year), the Governor shall address, the Legislative Assembly or, in the case of a State having a Legislative Council, both Houses assembled together and inform the Legislature of the causes of its summons.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Provision shall be made by the rules regulating the procedure of the House or either House for the allotment of time for discussion of the matters referred to in such address.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 176&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;When a Bill has been passed by the Legislative Assembly of a State or in the case of a State having a Legislative Council, has been passed by both Houses of the Legislature of the State, it shall be presented to the Governor and the Governor shall declare either that he assents to the Bill or that he withholds assent therefrom or that he reserves the Bill for the consideration of the President;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Provided that the Governor may, as soon as possible after the presentation to him of the Bill for assent, return the Bill if it is a Money Bill together with a message requesting that the House or Houses will reconsider the Bill or any specified provisions thereof and, in particular, will consider the desirability of introducing any such amendments as he may recommend in his message and, when a Bill is so returned, the House or Houses shall reconsider the Bill accordingly, and if the Bill is presented to the Governor for assent, the Governor shall not withhold assent therefrom;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Provided further that the Governor shall not assent to, but shall reserve for the reconsideration of the President, any Bill which in the opinion of the Governor would, if it became law, so derogate from the powers of the High Court as to endanger the position which that Court is by this Constitution designed to fill.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 200&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;When a Bill is reserved by a Governor for the consideration of the President, the President shall declare either that he assents to the Bill or that he withholds assent therefrom;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Provided that, where the bill is not a Money Bill, the President may direct the Governor to return the Bill to the House or, as the case may be, the Houses of the Legislature of the State together with such a message as is mentioned in the first proviso to Article 200 and, when a Bill is so returned, the House or Houses shall reconsider it accordingly within a period of six months from the date of receipt of such message and, if it is again passed by the House or Houses with or without amendment, it shall be presented again to the President for his consideration.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 201&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;The Governor shall in respect of every financial year cause to be laid before the House.....a statement of the estimated receipts and expenditure.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 202&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;No demand for a grant shall be made except on the recommendation of the Governor.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 203(3)&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;The Governor shall cause to be laid before the House another statement showing estimated amount of expenditure (Article 205).&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Provided that no recommendation shall be required under this clause for the moving of an amendment making provision for the reduction or abolition of any tax.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 205&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(1) A Bill or amendment making provision for any of the matters specified in sub-clauses (a) to (f) of clause (1) of Article 199 shall not be introduced or moved except on the recommendations of the Governor, and a bill making such provision shall not be introduced in a Legislative Council.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Provided that no recommendation shall be required under this clause for the moving of an amendment making provision for the reduction or abolition of any tax.Article 213&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;The Governor may promulgate such Ordinances, as the circumstances appear to him to require.... during the recess of legislature.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 207&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;The Governor is consulted for appointment of Judges of High Court.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 217&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Every person appointed to be a Judge of a High Court shall, before he enters upon his office, make and subscribe before the Governor of the State, or some person appointed in behalf by him, an oath or affirmation according to the form set out for the purpose.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 219&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Appointment of District Judges:&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Appointment of persons to be, and the posting and promotion of, district judges in any State shall be made by Governor of the State in consultation with the High Court exercising jurisdiction in relation to such State.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 233 (1)&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;The Governor of Odisha has special responsibility about the administration of Scheduled Areas as provided in the Fifth Schedule of the Constitution.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 244(1)&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;h5&gt;Administration of Scheduled Areas&lt;/h5&gt;\r\n\r\n&lt;p&gt;The Governor of Odisha has special responsibility about the administration of Scheduled Areas are provided in the Fifth Schedule of the Constitution.&lt;/p&gt;\r\n\r\n&lt;p&gt;The Scheduled Areas Order 1977 declares three full districts viz. Mayurbhanj, Sundargarh and Koraput (after re-organization, 7 districts viz. Mayurbhanj, Sundargarh, Jharsuguda, Koraput, Malkangiri, Rayagada and Nawarangpur) and parts of other districts namely Kuchinda tehsil of Sambalpur district, Keonjhar, Telkoi, Champua and Barbil tehsil of Keonjhar district, Kandhamal, Baliguda and G.Udayagiri tehsil of Kandhamal district, R. Udayagiri tehsil (including present Mohana tehsil), Guma and Rayagada Blocks in Paralakhemundi sub-division of Gajapati district and Suruda tehsil excluding Gajalbadi and Gochha gram panchayat of Ghumsar Sub-division of Ganjam district, Thuamul-Rampur and Lanjigarh of Kalahandi district and Nilagiri Block of Balasore district as Scheduled Areas of the State.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Where any such report of National Commission for Scheduled Tribes, or any part thereof, related to any matter with which any State Government is concerned, a copy of such report shall be forwarded to the Governor of the State who shall cause it to be laid before the Legislature of the State along with a recommendation explaining the action taken or proposed to be taken on the recommendations relating to the State and the reasons for the non-acceptance, if any, of any such recommendations.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 338 A (7)&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(1) The Chairman and other members of the Public Service Commission shall be appointed in the case of Union Commission or Joint Commission by the President and in the case of a State Commission by the Governor of the State.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(2) The President, or the Governor of a State shall not be answerable to any Court for the exercise and performance of the powers and duties of his office or for any act done or purporting to be done by him in the exercise and performance of those powers and duties;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Provided that the conduct of the President may be brought under review by any Court, tribunal or body appointed or designated by either House of Parliament for the investigation of a charge under Article 61;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;Provided further that nothing in this clause shall be construed as restricting the right of any person to bring appropriate proceedings against the Government of India or the Government of a State:&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(1) No criminal proceedings, whatsoever, shall be instituted, or continued against the President, or the Governor of a State, in any Court during his term of office.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;margin-left:0px&quot;&gt;(2) No process for the arrest or imprisonment of the President, or the Governor of a State, shall issue from any Court during his term of office.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;h5&gt;Article 361&lt;/h5&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;h5&gt;Appointment of Constitutional and Statutory Bodies under the relevant Constitutional and Statutory provisions:&lt;/h5&gt;\r\n\r\n&lt;p&gt;The Governor makes appointments to Constitutional and Statutory Bodies such as Public Service Commission, Lokayukt, State Information Commission, Human Rights Commission, Electricity Regulatory Commission, etc.&lt;/p&gt;\r\n\r\n&lt;p&gt;His Excellency the Governor is the ex-officio Chancellor of the Universities of the State by virtue of Section 5(1) of Odisha Universities Act, 1989 and similar other legislations. These are as follows:&lt;/p&gt;\r\n\r\n&lt;h5&gt;List of Universities under Administrative control of Department of Higher Education.&lt;/h5&gt;\r\n&amp;nbsp;\r\n\r\n&lt;div class=&quot;table-responsive&quot; style=&quot;box-sizing: border-box; width: 1062px; overflow-x: auto;&quot;&gt;\r\n&lt;table class=&quot;table table1&quot; style=&quot;background-color:transparent; border-collapse:collapse; border:1px solid rgb(221, 221, 221); margin-bottom:1em; max-width:100%; width:1062px&quot;&gt;\r\n	&lt;thead&gt;\r\n		&lt;tr&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Sl#&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Name of the University&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Date/Year of Establishment&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Provisions of Acts/Statutes&lt;/th&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/thead&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;1&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Utkal University, Bhubaneswar&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;1943 (incorporated vide Orissa Act 20 of 1966)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Orissa Universities Act,1989 &amp;amp; Orissa Universities First Statutes,1990&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;2&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Berhampur University, Berhampur&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;1967(Established by Orissa Act 21 of 1966)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Orissa Universities Act,1989 &amp;amp; Orissa Universities First Statutes,1990&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;3&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Sambalpur University, Sambalpur&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;1967 (Established by Orissa Act 22 of 1966)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Orissa Universities Act,1989 &amp;amp; Orissa Universities First Statutes,1990&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;4&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Shri Jagannath Sanskrit Viswavidyalaya, Puri&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;1981 (Established by Orissa Act 31 of 1981)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Orissa Universities Act,1989 &amp;amp; Orissa Universities First Statutes,1990&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;5&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;North Orissa University, Baripada&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;13.07.1998(Established by Notification No.32930/HE Dated: 13.07.1988 of HE Deptt.)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Orissa Universities Act,1989 &amp;amp; Orissa Universities First Statutes,1990&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;6&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Fakir Mohan University, Balasore&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;11.07.1999 (Established vide Notification No.31369-I/HE Dated: 03.07.1999 of HE Deptt.&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Orissa Universities Act,1989 &amp;amp; Orissa Universities First Statutes,1990&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;7&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;2006(Established by Orissa Act 8 of 2005)&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;2006(Established by Orissa Act 8 of 2005)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Ravenshaw University Act, 2005 No separate Statutes formed. Day to day business are being managed by following provisions of Orissa Universities First Statutes,1990 as per orders of Govt.&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;8&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Rama Devi Women&amp;rsquo;s University, Bhubaneswar&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;30.05.2015 (Established vide Notification No.11605/HE Dated: 30.05.2015 of HE Deptt.)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Orissa Universities Act, 1989 &amp;amp; Orissa Universities First Statutes, 1990&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;9&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Khallikote (Cluster) University, Berhampur&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;30.05.2015 (Established vide Notification No.11612/HE Dated: 30.05.2015 of HE Deptt.)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Orissa Universities Act, 1989 &amp;amp; Orissa Universities First Statutes, 1990&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;10&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Gangadhar Meher University, Sambalpur&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;30.05.2015 (Established vide Notification No.11618 Dated: 30.05.2015 of HE Deptt.)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Orissa Universities Act, 1989 &amp;amp; Orissa Universities First Statutes, 1990&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;11&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Odisha State Open University, Sambalpur&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;10.06.2015 (Established by Odisha Act 5 of 2015)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Odisha State Open University Act,2014&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;12&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Odia University&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;1918&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&amp;nbsp;&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;13&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Kalahandi University, Bhawanipatna&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Established by altering the territorial jurisdiction of Sambalpur University vide Notification No.5789/HE dated:06.03.2019 of Deptt of Higher Education&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Orissa Universities Act, 1989 &amp;amp; Orissa Universities First Statute, 1990.&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;14&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Rajendra University, Bolangir&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Established by altering the territorial jurisdiction of Sambalpur University vide Notification No.5676/HE dated:02.03.2019 of Deptt of Higher Education&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Orissa Universities Act, 1989 &amp;amp; Orissa Universities First Statute,1990.&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;/div&gt;\r\n\r\n&lt;h5&gt;University under administrative control of Agriculture &amp;amp; Farmer&amp;rsquo;s Empowerment Department.&lt;/h5&gt;\r\n&amp;nbsp;\r\n\r\n&lt;div class=&quot;table-responsive&quot; style=&quot;box-sizing: border-box; width: 1062px; overflow-x: auto;&quot;&gt;\r\n&lt;table class=&quot;table table1&quot; style=&quot;background-color:transparent; border-collapse:collapse; border:1px solid rgb(221, 221, 221); margin-bottom:1em; max-width:100%; width:1062px&quot;&gt;\r\n	&lt;thead&gt;\r\n		&lt;tr&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Sl#&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Name of the University&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Date/Year of Establishment&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Provisions of Acts/Statutes&lt;/th&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/thead&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;15&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Orissa University of Agriculture &amp;amp; Technology, Odisha, Bhubaneswar.&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;1962 (Established by Odisha Act 17 of 1965)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Orissa University of Agriculture &amp;amp; Technology Act,1965 Orissa University of Agriculture &amp;amp; Technology Statutes,1966&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;/div&gt;\r\n\r\n&lt;h5&gt;Universities under administrative control of Skill Development &amp;amp; Technical Education Department.&lt;/h5&gt;\r\n&amp;nbsp;\r\n\r\n&lt;div class=&quot;table-responsive&quot; style=&quot;box-sizing: border-box; width: 1062px; overflow-x: auto;&quot;&gt;\r\n&lt;table class=&quot;table table1&quot; style=&quot;background-color:transparent; border-collapse:collapse; border:1px solid rgb(221, 221, 221); margin-bottom:1em; max-width:100%; width:1062px&quot;&gt;\r\n	&lt;thead&gt;\r\n		&lt;tr&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Sl#&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Name of the University&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Date/Year of Establishment&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Provisions of Acts/Statutes&lt;/th&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/thead&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;16&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Biju Patnaik University of Technology, Rourkela&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;2002 (Established by Orissa Act 9 of 2002)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Biju Patnaik University of Technology Act, 2002 &amp;amp; Biju Patnaik University of Technology First Statutes, 2006.&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;17&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Veer Surendra Sai University of Technology, Burla&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;2009 (Established by Orissa Act 9 of 2002)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Veer Surendra Sai University of Technology Act, 2008 &amp;amp; Veer Surendra Sai University of Technology First Statutes, 2010&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;/div&gt;\r\n\r\n&lt;h5&gt;University under administrative control of Culture Department.&lt;/h5&gt;\r\n&amp;nbsp;\r\n\r\n&lt;div class=&quot;table-responsive&quot; style=&quot;box-sizing: border-box; width: 1062px; overflow-x: auto;&quot;&gt;\r\n&lt;table class=&quot;table table1&quot; style=&quot;background-color:transparent; border-collapse:collapse; border:1px solid rgb(221, 221, 221); margin-bottom:1em; max-width:100%; width:1062px&quot;&gt;\r\n	&lt;thead&gt;\r\n		&lt;tr&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Sl#&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Name of the University&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Date/Year of Establishment&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Provisions of Acts/Statutes&lt;/th&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/thead&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;18&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Utkal University of Culture, Bhubaneswar&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;1999 (Established by Orissa Act 9 of 1999)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Utkal University of Culture Act,1999 &amp;amp; Utkal University of Culture First Statutes, 2001&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;/div&gt;\r\n\r\n&lt;h5&gt;University under administrative control of Electronics &amp;amp; Information Technology Department&lt;/h5&gt;\r\n&amp;nbsp;\r\n\r\n&lt;div class=&quot;table-responsive&quot; style=&quot;box-sizing: border-box; width: 1062px; overflow-x: auto;&quot;&gt;\r\n&lt;table class=&quot;table table1&quot; style=&quot;background-color:transparent; border-collapse:collapse; border:1px solid rgb(221, 221, 221); margin-bottom:1em; max-width:100%; width:1062px&quot;&gt;\r\n	&lt;thead&gt;\r\n		&lt;tr&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Sl#&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Name of the University&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Date/Year of Establishment&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Provisions of Acts/Statutes&lt;/th&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/thead&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;19&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;The International Institute of Information Technology, Bhubaneswar&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;20.01.2014 (Established by Orissa Act 25 of 2013)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;The International Institute of Information Technology (IIIT) Act, 2013.&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;/div&gt;\r\n\r\n&lt;h5&gt;University Under Administrative control of Health &amp;amp; Family Welfare Department.&lt;/h5&gt;\r\n&amp;nbsp;\r\n\r\n&lt;div class=&quot;table-responsive&quot; style=&quot;box-sizing: border-box; width: 1062px; overflow-x: auto;&quot;&gt;\r\n&lt;table class=&quot;table table1&quot; style=&quot;background-color:transparent; border-collapse:collapse; border:1px solid rgb(221, 221, 221); margin-bottom:1em; max-width:100%; width:1062px&quot;&gt;\r\n	&lt;thead&gt;\r\n		&lt;tr&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Sl#&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Name of the University&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Date/Year of Establishment&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Provisions of Acts/Statutes&lt;/th&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/thead&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;20&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Veer Surendra Sai Institute of Medical Sciences &amp;amp; Research, Burla (VIMSAR)&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Came into force w.e.f 01.01.2015. Established by the Veer Surendra Sai Institute of Medical Sciences &amp;amp; Research Act, 2014 (Odisha Act 6 of 2014)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Veer Surendra Sai Institute of Medical Sciences &amp;amp; Research 2014 &amp;amp; Veer Surendra Sai Institute of Medical Sciences &amp;amp; Research First Statute, 2016.&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;/div&gt;\r\n\r\n&lt;h5&gt;List of self-financed private Universities established in the state wherein Hon&amp;rsquo;ble Governor is the Chancellor/ Visitor.&lt;/h5&gt;\r\n\r\n&lt;div class=&quot;table-responsive&quot; style=&quot;box-sizing: border-box; width: 1062px; overflow-x: auto;&quot;&gt;\r\n&lt;table class=&quot;table table1&quot; style=&quot;background-color:transparent; border-collapse:collapse; border:1px solid rgb(221, 221, 221); margin-bottom:1em; max-width:100%; width:1062px&quot;&gt;\r\n	&lt;thead&gt;\r\n		&lt;tr&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Sl#&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Name of the University&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Date/Year of Establishment&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Provisions of Acts/Statutes&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Position of Governor&lt;/th&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/thead&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;21&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Centurion University&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;2010 (Established by the Centurion University of Technology and Management Orissa Act,2010) (Orissa Act 4 of 2010)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;The Centurion University of Technology &amp;amp; Management, Orissa Act, 2010&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Visitor&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;22&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Xavier University&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;2013 (Established by Xavier University, Odisha Act,2013) (Odisha Act 17 of 2013)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;The Xavier University Act, 2013&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Visitor&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;23&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Institute of Chartered Financial Analyst of India University, Bhubaneswar&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;The Institute of Chartered Financial Analyst of India University Act, 2009 (Orissa Act 5 of 2010)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;The Institute of Chartered Financial Analyst of India University Act, 2009&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Visitor&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;24&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;span style=&quot;color:rgb(78, 113, 184)&quot;&gt;Birla Global University&lt;/span&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Established by the Birla Global University, Odisha Act, 2015 (Odisha Act 1 of 2016)&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Birla Global University Act, 2015&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Chancellor&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;/div&gt;\r\n\r\n&lt;p&gt;The position of the Chancellor has been delineated in clear cut fashion in Odisha Universities Act, 1989. He has to preside over all the Convocations of the Universities convened for the purpose of conferring degrees or for any other purpose. He decides all disputes with regard to election, nomination or selection of members of the authorities of the Universities. He enjoys the right to inspect or cause to be inspected the Universities or part thereof and make appropriate directions for corrective measures on the findings during such enquiry. Under sub-Section 9 of Section 5, he is competent to issue directions or instructions not inconsistent with the provisions of this Act and Statutes on any matter connected with a University when any authority or Vice-Chancellor fails to act in accordance with the provisions of this Act, the Statutes, or the Regulations. Under sub-Section 10 of Section 5, the Chancellor may, by order in writing annul any proceeding of the Senate, Syndicate, Academic Council or any other authority which is not in conformity with this Act, the Statutes, the Regulations or the directions issued under sub-Section (9). Under sub-Section 20 of Section 6, the Chancellor may, at any time, by an order in writing remove the Vice-Chancellor of a University from office if in his opinion it appears that his continuance in office is detrimental to the interests of that University.&lt;/p&gt;\r\n\r\n&lt;p&gt;The Chancellor enjoys enormous authority in the matter of appointment of vital functionaries of the University which includes Vice-Chancellor, Registrar, and Comptroller of Finance, certain members of the Senate, Syndicate and Academic Council from the University. He also enjoys the authority to suspend any member of the authorities under Section 15(1) and (2) of Odisha Universities Act under given circumstances.&lt;/p&gt;\r\n\r\n&lt;p&gt;Odisha University of Agriculture and Technology Act, Utkal University of Culture Act and Biju Patnaik University of Technology Act also clearly define the powers and position of the Chancellor.&lt;/p&gt;\r\n\r\n&lt;h5&gt;As Patron/President of Organizations&lt;/h5&gt;\r\n\r\n&lt;p&gt;The Governor is also the Patron/ President/ Chairman of several organizations such as&lt;/p&gt;\r\n\r\n&lt;div class=&quot;table-responsive&quot; style=&quot;box-sizing: border-box; width: 1062px; overflow-x: auto;&quot;&gt;\r\n&lt;table class=&quot;table table1&quot; style=&quot;background-color:transparent; border-collapse:collapse; border:1px solid rgb(221, 221, 221); margin-bottom:1em; max-width:100%; width:1062px&quot;&gt;\r\n	&lt;thead&gt;\r\n		&lt;tr&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:center !important; vertical-align:top&quot;&gt;Link&lt;/th&gt;\r\n			&lt;th style=&quot;border-color:rgb(221, 221, 221) rgb(221, 221, 221) rgb(43, 73, 135); text-align:inherit; vertical-align:top&quot;&gt;Description&lt;/th&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/thead&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;a href=&quot;http://localhost:7001/ORBPM/www.ijl.org.in&quot; style=&quot;box-sizing: border-box; color: rgb(118, 141, 186); background-color: transparent; line-height: 1.4em; display: block; text-align: center; text-decoration-line: none !important;&quot; target=&quot;_blank&quot;&gt;www.ijl.org.in&lt;/a&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Hind Kusht Nivaran Sang, Odisha State Branch&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;a href=&quot;http://localhost:7001/ORBPM/www.indianredcross.org&quot; style=&quot;box-sizing: border-box; color: rgb(118, 141, 186); background-color: transparent; line-height: 1.4em; display: block; text-align: center; text-decoration-line: none !important;&quot; target=&quot;_blank&quot;&gt;www.indianredcross.org&lt;/a&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Indian Red cross Society&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;a href=&quot;http://localhost:7001/ORBPM/www.bsgindia.org&quot; style=&quot;box-sizing: border-box; color: rgb(118, 141, 186); background-color: transparent; line-height: 1.4em; display: block; text-align: center; text-decoration-line: none !important;&quot; target=&quot;_blank&quot;&gt;www.bsgindia.org&lt;/a&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Odisha State Bharat Scouts and Guides&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;a href=&quot;http://localhost:7001/ORBPM/www.tbassnindia.org&quot; style=&quot;box-sizing: border-box; color: rgb(118, 141, 186); background-color: transparent; line-height: 1.4em; display: block; text-align: center; text-decoration-line: none !important;&quot; target=&quot;_blank&quot;&gt;www.tbassnindia.org&lt;/a&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;State Tuberculosis Association of Odisha&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;a href=&quot;http://localhost:7001/ORBPM/www.dgrindia.com&quot; style=&quot;box-sizing: border-box; color: rgb(118, 141, 186); background-color: transparent; line-height: 1.4em; display: block; text-align: center; text-decoration-line: none !important;&quot; target=&quot;_blank&quot;&gt;www.dgrindia.com&lt;/a&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;Rajya Sainik Board, Odisha&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n		&lt;tr&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;&lt;a href=&quot;http://localhost:7001/ORBPM/www.sjaodisha.com&quot; style=&quot;box-sizing: border-box; color: rgb(118, 141, 186); background-color: transparent; line-height: 1.4em; display: block; text-align: center; text-decoration-line: none !important;&quot; target=&quot;_blank&quot;&gt;www.stjohnambulance.org.in&lt;/a&gt;&lt;/td&gt;\r\n			&lt;td style=&quot;vertical-align:top&quot;&gt;St. John Ambulance Odisha State Centre&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n',0,'\0'),
 (51,15,0,'',0,'\0');
INSERT INTO `t_pages_content_e` (`intContentId`,`intPageId`,`intPageNo`,`vchContentE`,`intPortalType`,`bitDeletedFlag`) VALUES 
 (58,7,1,'&lt;h3&gt;HIS EXCELLENCY&lt;/h3&gt;\r\n\r\n&lt;h1&gt;THE GOVERNOR&lt;/h1&gt;\r\n\r\n&lt;h5&gt;Professor Ganeshi Lal&lt;/h5&gt;\r\n\r\n&lt;p&gt;Prof. Ganeshi Lal was sworn in as the Hon&amp;rsquo;ble Governor of Odisha on 29th May 2018.&lt;/p&gt;\r\n\r\n&lt;p&gt;He was administered the oath of office by the Hon&amp;rsquo;ble Chief Justice of High Court of Odisha Shri Justice Vineet Saran in a function held at the Abhishek Hall of Raj Bhavan.&lt;/p&gt;\r\n',0,'\0'),
 (61,34,0,'',0,'\0'),
 (62,35,0,'',0,'\0'),
 (63,36,0,'',0,'\0'),
 (64,37,0,'',0,'\0'),
 (65,38,0,'',0,'\0'),
 (66,39,0,'',0,'\0'),
 (67,40,0,'',0,'\0');
/*!40000 ALTER TABLE `t_pages_content_e` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_pages_content_h`
--

DROP TABLE IF EXISTS `t_pages_content_h`;
CREATE TABLE `t_pages_content_h` (
  `intContentId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intPageId` int(10) unsigned NOT NULL,
  `intPageNo` int(10) unsigned NOT NULL,
  `vchContentH` mediumtext,
  `intPortalType` smallint(2) unsigned NOT NULL,
  `bitDeletedFlag` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`intContentId`),
  KEY `FK_pageId` (`intPageId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_pages_content_h`
--

/*!40000 ALTER TABLE `t_pages_content_h` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_pages_content_h` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_plugin`
--

DROP TABLE IF EXISTS `t_plugin`;
CREATE TABLE `t_plugin` (
  `INT_PLUGIN_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `INT_FN_ID` int(10) unsigned NOT NULL DEFAULT '0',
  `INT_SUBCAT_ID` int(10) unsigned NOT NULL DEFAULT '0',
  `VCH_HEADLINE` varchar(300) NOT NULL,
  `VCH_DESCRIPTION` text,
  `VCH_DOCFILE` varchar(100) DEFAULT NULL,
  `INT_PUBLISH_STATUS` smallint(2) unsigned NOT NULL DEFAULT '1',
  `INT_ARCHIVE_STATUS` smallint(2) unsigned NOT NULL DEFAULT '0',
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `INT_CREATED_BY` int(10) unsigned NOT NULL,
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `INT_UPDATED_BY` int(10) unsigned DEFAULT NULL,
  `BIT_DELETED_FLAG` bit(1) NOT NULL DEFAULT b'0',
  `DTM_ARCHIVE_ON` datetime DEFAULT NULL,
  `INT_PORTAL_TYPE` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`INT_PLUGIN_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_plugin`
--

/*!40000 ALTER TABLE `t_plugin` DISABLE KEYS */;
INSERT INTO `t_plugin` (`INT_PLUGIN_ID`,`INT_FN_ID`,`INT_SUBCAT_ID`,`VCH_HEADLINE`,`VCH_DESCRIPTION`,`VCH_DOCFILE`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`DTM_ARCHIVE_ON`,`INT_PORTAL_TYPE`) VALUES 
 (1,1,0,'Banks need to urgently reduce stressed assets: R Gandhi','','doc20150915_112127.pdf',2,0,'2015-09-15 11:21:27',1,'2016-03-01 13:23:11',0,'\0',NULL,NULL),
 (2,2,0,'Storage &amp; Distribution of Commodities','&lt;p&gt;Storage &amp;amp; Distribution of Commodities&lt;/p&gt;\r\n','doc20150915_112146.pdf',2,0,'2015-09-15 11:21:46',1,'2016-03-01 13:23:18',0,'\0',NULL,NULL),
 (3,3,0,'After the first face-to-face between the two Patels, the government said the community leaders will have to approach the state OBC Commission','','doc20150915_112207.pdf',2,0,'2015-09-15 11:22:07',1,'2016-03-01 13:23:29',0,'\0',NULL,NULL),
 (4,1,0,'Sensex Struggles Amid Selling Pressure in Banking, Metal Stocks','&lt;p&gt;BSE Sensex and Nifty struggled on Tuesday amid mostly weak Asian markets. Traders were also wary ahead of US Federal Reserve meet on Thursday. The Sensex fell over 100 points at its day&amp;#39;s low while Nifty slipped to 7,829. A weaker rupee also weighed on the sentiment.&lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;strong&gt;Here are the top developments:&lt;/strong&gt;&lt;br /&gt;\r\n&lt;br /&gt;\r\n1) Analysts say that Indian markets are likely to be volatile ahead of US Fed rate decision on Thursday.&lt;br /&gt;\r\n&lt;br /&gt;\r\n2) Although the Fed has signalled it plans to lift interest rates in 2015, some analysts say turbulence in the global financial markets could prompt the US central bank to delay the rate hike. Worries over the growth of China&amp;#39;s economy have added uncertainty to global financial markets.&lt;br /&gt;\r\n&lt;br /&gt;\r\n3) An interest rate hike in the US could accelerate the selling from foreign investors in Indian stock markets. Besides, a rate hike in the US would strengthen the dollar, putting further pressure on rupee.&lt;br /&gt;\r\n&lt;br /&gt;\r\n4) The rupee today fell to 66.46/dollar against its previous close of 66.32.&lt;br /&gt;\r\n&lt;br /&gt;\r\n5) Foreign investors sold a record Rs 16,877 crore worth of domestic stocks in August, leading to the recent selloff in Indian markets. They continued to sell Indian stocks this month though the selling pressure has eased in recent sessions.&lt;br /&gt;\r\n&lt;br /&gt;\r\n6) Banking, metal and capital goods stocks led the decline today. Rate sensitive stocks like banking and real estate stocks had outperformed yesterday amid brightening hopes of a rate cut from Reserve Bank of India later this month. Frontline steel stocks mostly gave up early gains despite the government announcing 20 per cent safeguard duty on imports.&lt;br /&gt;\r\n&lt;br /&gt;\r\n7) Hopes of a rate cut from the Reserve Bank brightened after inflation dived to a new low in August, helped by falling global commodity prices. Retail inflation, which the central bank tracks to set rates, eased to 3.66 per cent in August from a revised 3.69 per cent a month ago.&lt;br /&gt;\r\n&lt;br /&gt;\r\n8) Many analysts see the Reserve Bank of India cutting rates by at least 25 bps later this month. The next RBI policy review is due on September 29.&lt;br /&gt;\r\n&lt;br /&gt;\r\n9) Asian shares struggled on Tuesday as caution reigned ahead of this week&amp;#39;s US Federal Reserve decision on interest rates. The Bank of Japan today refrained from any new policy steps.&lt;br /&gt;\r\n&lt;br /&gt;\r\n10) Japan&amp;#39;s Nikkei gained nearly 0.90 per cent while China&amp;#39;s stock markets slipped nearly 2 per cent.&lt;/p&gt;\r\n','',2,0,'2015-09-15 11:24:13',1,'2016-03-01 13:23:11',0,'\0',NULL,NULL),
 (5,1,0,'Invitation For Expression of Interest For Providing Online Collection of Payments From Fair Price Shops to HPSCSC','&lt;p&gt;Invitation For Expression of Interest For Providing Online Collection of Payments From Fair Price Shops to HPSCSC&lt;/p&gt;\r\n','doc20150915_114143.pdf',2,0,'2015-09-15 11:41:43',1,'2016-03-01 13:23:11',0,'\0',NULL,NULL);
INSERT INTO `t_plugin` (`INT_PLUGIN_ID`,`INT_FN_ID`,`INT_SUBCAT_ID`,`VCH_HEADLINE`,`VCH_DESCRIPTION`,`VCH_DOCFILE`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`DTM_ARCHIVE_ON`,`INT_PORTAL_TYPE`) VALUES 
 (6,9,1,'H.P State Civil Supplies Corporation Limited','&lt;p&gt;H.P State Civil Supplies Corporation Limited&lt;/p&gt;\r\n','',2,0,'2015-09-15 15:57:04',1,'2016-03-01 13:23:43',0,'\0',NULL,NULL),
 (7,9,2,'DI Pipes supplies to the government of H.P','&lt;p&gt;&lt;strong&gt;DI Pipes&lt;/strong&gt; supplies to the government of H.P&lt;/p&gt;\r\n','',2,0,'2015-09-15 16:16:27',1,'2016-03-01 13:23:43',0,'\0',NULL,NULL),
 (8,3,0,'','','',1,1,'2015-09-15 16:16:38',1,'2016-03-01 13:23:35',0,'','2016-03-01 13:23:35',NULL),
 (9,3,0,'dfgdfg','&lt;p&gt;dfgdfg&lt;/p&gt;\r\n','',1,1,'2015-09-15 16:18:09',1,'2016-03-01 13:23:35',0,'\0','2016-03-01 13:23:35',NULL),
 (10,9,1,'Central Procurement Agency','&lt;p&gt;Central Procurement Agency&lt;/p&gt;\r\n','',2,0,'2015-09-15 16:18:25',1,'2016-03-01 13:23:43',0,'\0',NULL,NULL),
 (11,1,0,'Primary Function: is of a Central Procurement Agency for all the controlled &amp; non-controlled essential commodities.','&lt;p&gt;Primary Function: is of a Central Procurement Agency for all the controlled &amp;amp; non-controlled essential commodities.&lt;/p&gt;\r\n','doc20150921_103351.pdf',2,0,'2015-09-21 10:33:51',1,'2016-03-01 13:23:11',0,'\0',NULL,NULL);
INSERT INTO `t_plugin` (`INT_PLUGIN_ID`,`INT_FN_ID`,`INT_SUBCAT_ID`,`VCH_HEADLINE`,`VCH_DESCRIPTION`,`VCH_DOCFILE`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`DTM_ARCHIVE_ON`,`INT_PORTAL_TYPE`) VALUES 
 (12,2,0,'Ration Card Details','&lt;p&gt;Ration Card Details&lt;/p&gt;\r\n','',2,0,'2015-09-21 10:34:42',1,'2016-03-01 13:23:18',0,'\0',NULL,NULL),
 (13,3,0,'test c','&lt;p&gt;test c&lt;/p&gt;\r\n','',1,1,'2015-09-21 10:35:10',1,'2016-03-01 13:23:35',0,'\0','2016-03-01 13:23:35',NULL),
 (14,2,0,'ACR Proformas/Other Proformas','&lt;p&gt;ACR Proformas/Other Proformas&lt;/p&gt;\r\n','',2,0,'2015-09-23 12:43:46',1,'2016-03-01 13:23:18',0,'\0',NULL,NULL),
 (15,2,0,'Stock postion of LPG Agencies','&lt;p&gt;Stock postion of LPG Agencies&lt;/p&gt;\r\n','',2,0,'2015-09-23 12:43:54',1,'2016-03-01 13:23:18',0,'\0',NULL,NULL),
 (16,2,0,'Stock postion of Food Grain','&lt;p&gt;Stock postion of Food Grain&lt;/p&gt;\r\n','',2,0,'2015-09-23 12:44:03',1,'2016-03-01 13:23:18',0,'\0',NULL,NULL),
 (17,9,0,'CORPORATION','&lt;p&gt;CORPORATION&lt;/p&gt;\r\n','doc20150923_160856.pdf',1,1,'2015-09-23 16:08:56',1,'2015-09-23 16:09:31',0,'','2015-09-23 16:09:31',NULL);
INSERT INTO `t_plugin` (`INT_PLUGIN_ID`,`INT_FN_ID`,`INT_SUBCAT_ID`,`VCH_HEADLINE`,`VCH_DESCRIPTION`,`VCH_DOCFILE`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`DTM_ARCHIVE_ON`,`INT_PORTAL_TYPE`) VALUES 
 (18,1,0,'gdsfg','','',1,1,'2015-11-17 12:56:51',1,'2016-03-01 11:23:57',0,'','2016-03-01 11:23:57',NULL),
 (19,9,0,'erttryretyry','','',1,1,'2016-01-06 15:56:35',1,'2016-03-01 11:31:58',0,'\0','2016-03-01 11:31:58',NULL),
 (20,1,0,'12&lt;script&gt;for(var p=0;p&lt;=2;p++){alert(document.cookie);}&lt;/script&gt;','','',1,1,'2016-01-29 09:50:45',1,'2016-03-01 11:23:57',0,'','2016-03-01 11:23:57',NULL),
 (21,9,1,'fgh','&lt;p&gt;fgh&lt;/p&gt;\r\n','',1,1,'2016-03-01 11:45:39',1,'2016-03-01 11:45:49',0,'\0','2016-03-01 11:45:49',NULL),
 (22,13,1,'Office Order No. 33/2016-PPC','&lt;p&gt;Regarding&amp;nbsp;relieving of Shri Tapan Kumar Kayori, Section Officer on deputation basis in Prasar Bharati Secretariat w.e.f. 07.03.2016.&lt;/p&gt;\r\n','',2,0,'2016-03-01 12:28:58',1,'2016-03-01 13:14:34',0,'\0',NULL,NULL),
 (23,13,1,'OFFICE MEMORANDUM No. 04/2016-Budget (No. Misc-1/001(12)2016-Budget/345)','&lt;p&gt;Regarding appropriate accounting procedure of AIR and DD.&lt;/p&gt;\r\n','doc20160301_124733.pdf',2,0,'2016-03-01 12:30:11',1,'2016-03-01 13:14:34',0,'\0',NULL,NULL);
INSERT INTO `t_plugin` (`INT_PLUGIN_ID`,`INT_FN_ID`,`INT_SUBCAT_ID`,`VCH_HEADLINE`,`VCH_DESCRIPTION`,`VCH_DOCFILE`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`DTM_ARCHIVE_ON`,`INT_PORTAL_TYPE`) VALUES 
 (24,13,2,'Instructions/Exemptions being extended to Differently Abled candidates for Class X and XII Examination','&lt;p&gt;Instructions/Exemptions being extended to Differently Abled candidates for Class X and XII Examination&lt;/p&gt;\r\n','',2,0,'2016-03-01 12:33:43',1,'2016-03-01 13:14:34',0,'\0',NULL,NULL),
 (25,3,0,'abc','&lt;p&gt;ee&lt;/p&gt;\r\n','doc20160519_094450.pdf',2,0,'2016-05-19 09:44:49',1,'2016-05-19 09:46:52',0,'\0',NULL,2);
/*!40000 ALTER TABLE `t_plugin` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_services`
--

DROP TABLE IF EXISTS `t_services`;
CREATE TABLE `t_services` (
  `intServiceId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `IntCatId` int(10) unsigned NOT NULL DEFAULT '0',
  `vchServiceNameE` varchar(64) DEFAULT NULL,
  `vchServiceNameO` varchar(64) DEFAULT NULL,
  `vchUrl` varchar(128) DEFAULT NULL,
  `vchDocument` varchar(45) DEFAULT NULL,
  `vchimage` varchar(100) DEFAULT NULL,
  `vchDetailE` text,
  `vchDetailO` text,
  `stmCreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `intCreatedBy` int(10) unsigned DEFAULT NULL,
  `dtmUpdatedOn` datetime DEFAULT NULL,
  `intUpdatedBy` int(10) DEFAULT NULL,
  `bitDeletedFlag` bit(1) DEFAULT b'0',
  `intPublishStatus` int(10) unsigned DEFAULT '1',
  `intArcStatus` int(10) unsigned DEFAULT '0',
  `intLinkType` smallint(2) unsigned NOT NULL,
  `intTemplateType` smallint(2) unsigned NOT NULL,
  `intWindowStatus` smallint(2) unsigned NOT NULL,
  `intPluginId` smallint(2) unsigned NOT NULL,
  PRIMARY KEY (`intServiceId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_services`
--

/*!40000 ALTER TABLE `t_services` DISABLE KEYS */;
INSERT INTO `t_services` (`intServiceId`,`IntCatId`,`vchServiceNameE`,`vchServiceNameO`,`vchUrl`,`vchDocument`,`vchimage`,`vchDetailE`,`vchDetailO`,`stmCreatedOn`,`intCreatedBy`,`dtmUpdatedOn`,`intUpdatedBy`,`bitDeletedFlag`,`intPublishStatus`,`intArcStatus`,`intLinkType`,`intTemplateType`,`intWindowStatus`,`intPluginId`) VALUES 
 (1,0,'test service','','','','Services_1621941320.jpg','&amp;lt;p&amp;gt;test details test&amp;lt;/p&amp;gt;\r\n','','2021-05-27 09:59:59',1,'2021-05-27 09:59:59',1,'\0',2,0,1,1,1,0);
/*!40000 ALTER TABLE `t_services` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_special_info`
--

DROP TABLE IF EXISTS `t_special_info`;
CREATE TABLE `t_special_info` (
  `INT_INFO_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VCH_TITLE` varchar(512) NOT NULL,
  `DTM_START_DATE` date DEFAULT NULL,
  `DTM_END_DATE` date DEFAULT NULL,
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `INT_CREATED_BY` int(10) unsigned NOT NULL,
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `INT_UPDATED_BY` int(10) unsigned DEFAULT NULL,
  `BIT_DELETED_FLAG` bit(1) NOT NULL DEFAULT b'0',
  `INT_PUBLISH_STATUS` int(10) unsigned NOT NULL,
  `INT_ARCHIVE_STATUS` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`INT_INFO_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_special_info`
--

/*!40000 ALTER TABLE `t_special_info` DISABLE KEYS */;
INSERT INTO `t_special_info` (`INT_INFO_ID`,`VCH_TITLE`,`DTM_START_DATE`,`DTM_END_DATE`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`) VALUES 
 (1,'Event will be held on Road Safety tips','2020-12-01','2020-12-23','2020-11-26 13:32:45',1,'2020-11-30 12:17:52',0,'\0',2,0),
 (2,'Seminar will be held on beneifits of Helmet','2020-11-28','2020-11-29','2020-11-26 15:09:21',1,'2020-11-26 15:32:22',0,'\0',2,0),
 (3,'An Event on Odisha transport','2020-11-30','0000-00-00','2020-11-26 15:13:01',1,'2020-11-30 12:17:52',0,'\0',2,0),
 (4,'Event on Traffic fine','2020-11-26','2020-11-28','2020-11-26 15:15:00',1,'2020-11-30 12:17:52',0,'\0',2,0),
 (5,'New event','0000-00-00','0000-00-00','2020-11-26 15:26:32',1,'2020-11-26 15:32:50',0,'',1,0),
 (6,'New Event on Traffic Penality','2020-11-27','2020-11-30','2020-11-26 16:00:43',1,'2020-11-30 12:17:52',0,'\0',2,0),
 (7,'test event','2020-11-27','2020-11-28','2020-11-26 16:23:55',1,'2020-11-30 12:17:52',0,'\0',2,0),
 (8,'event on Inter state transport','2020-11-10','2020-11-24','2020-11-26 16:46:11',1,'2020-11-30 12:17:52',0,'\0',2,0);
INSERT INTO `t_special_info` (`INT_INFO_ID`,`VCH_TITLE`,`DTM_START_DATE`,`DTM_END_DATE`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`) VALUES 
 (9,'event on Road tax','2020-11-27','2020-11-28','2020-11-26 16:52:42',1,'2020-11-30 12:17:52',0,'\0',2,0),
 (10,'test events','2020-11-28','2020-11-29','2020-11-26 16:58:47',1,NULL,NULL,'\0',0,0),
 (11,'Test event two','2020-11-28','2020-11-30','2020-11-26 17:03:49',1,NULL,NULL,'\0',0,0),
 (12,'Test event three','2020-11-27','2020-11-28','2020-11-26 17:04:32',1,NULL,NULL,'\0',0,0),
 (13,'test event five','2020-11-25','2020-11-27','2020-11-26 17:14:05',1,NULL,NULL,'\0',0,0),
 (14,'Event six','2020-11-28','2020-11-30','2020-11-26 17:14:31',1,NULL,NULL,'\0',0,0),
 (15,'Test event seven','2020-11-27','0000-00-00','2020-11-26 17:24:43',1,NULL,NULL,'\0',0,0),
 (16,'Test event eight','2020-11-24','0000-00-00','2020-11-26 17:25:02',1,NULL,NULL,'\0',0,0),
 (17,'event eight','2020-11-23','0000-00-00','2020-11-26 17:27:10',1,NULL,NULL,'\0',0,0),
 (18,'event one','2020-11-28','0000-00-00','2020-11-26 17:36:24',1,NULL,NULL,'\0',0,0);
INSERT INTO `t_special_info` (`INT_INFO_ID`,`VCH_TITLE`,`DTM_START_DATE`,`DTM_END_DATE`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`) VALUES 
 (19,'event test','2020-11-28','2020-11-28','2020-11-26 17:47:12',1,NULL,NULL,'\0',0,0),
 (20,'test','0000-00-00','0000-00-00','2020-12-10 13:32:47',1,NULL,NULL,'\0',0,0),
 (21,'test message','2020-12-11','0000-00-00','2020-12-10 13:33:21',1,NULL,NULL,'\0',0,0),
 (22,'test message two','2020-12-12','2020-12-12','2020-12-10 13:34:20',1,NULL,NULL,'\0',0,0),
 (23,'test','2020-12-24','0000-00-00','2020-12-16 09:41:41',1,NULL,NULL,'\0',0,0),
 (24,'Seminar on Road Accident','2021-01-20','0000-00-00','2021-01-11 17:47:59',1,'2021-01-11 17:48:28',0,'\0',2,0);
/*!40000 ALTER TABLE `t_special_info` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_tender_details`
--

DROP TABLE IF EXISTS `t_tender_details`;
CREATE TABLE `t_tender_details` (
  `INT_TENDER_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VCH_REF_NO` varchar(50) NOT NULL,
  `VCH_HEAD_LINE_E` varchar(500) NOT NULL,
  `VCH_HEAD_LINE_O` varchar(500) DEFAULT NULL,
  `DTM_OPENING_DATETIME` datetime NOT NULL,
  `DTM_CLOSING_DATETIME` datetime NOT NULL,
  `VCH_DESCRIPTION_E` varchar(500) NOT NULL,
  `VCH_DESCRIPTION_O` text,
  `INT_TENDER_TYPE` int(10) unsigned DEFAULT NULL,
  `VCH_DOCUMENT_NAME` varchar(200) NOT NULL,
  `VCH_DOCUMENT_NAME2` varchar(200) DEFAULT NULL,
  `VCH_DOCUMENT_NAME3` varchar(200) DEFAULT NULL,
  `INT_PUBLISH_STATUS` int(10) unsigned NOT NULL,
  `INT_CREATED_BY` int(10) unsigned NOT NULL,
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `INT_UPDATED_BY` int(10) unsigned DEFAULT NULL,
  `BIT_DELETED_FLAG` bit(1) NOT NULL DEFAULT b'0',
  `INT_APPROVAL_STATUS` int(10) unsigned DEFAULT NULL,
  `INT_PREVILIGE_STATUS` int(10) unsigned DEFAULT NULL,
  `VCH_ADDENDUM_FILE` varchar(200) DEFAULT NULL,
  `VCH_ADDENDUM_FILE2` varchar(200) DEFAULT NULL,
  `VCH_ADDENDUM_FILE3` varchar(200) DEFAULT NULL,
  `VCH_CORRIGENDUM_FILE` varchar(200) DEFAULT NULL,
  `VCH_CORRIGENDUM_FILE2` varchar(200) DEFAULT NULL,
  `VCH_CORRIGENDUM_FILE3` varchar(200) DEFAULT NULL,
  `INT_ARCHIVE_STATUS` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`INT_TENDER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_tender_details`
--

/*!40000 ALTER TABLE `t_tender_details` DISABLE KEYS */;
INSERT INTO `t_tender_details` (`INT_TENDER_ID`,`VCH_REF_NO`,`VCH_HEAD_LINE_E`,`VCH_HEAD_LINE_O`,`DTM_OPENING_DATETIME`,`DTM_CLOSING_DATETIME`,`VCH_DESCRIPTION_E`,`VCH_DESCRIPTION_O`,`INT_TENDER_TYPE`,`VCH_DOCUMENT_NAME`,`VCH_DOCUMENT_NAME2`,`VCH_DOCUMENT_NAME3`,`INT_PUBLISH_STATUS`,`INT_CREATED_BY`,`DTM_CREATED_ON`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_APPROVAL_STATUS`,`INT_PREVILIGE_STATUS`,`VCH_ADDENDUM_FILE`,`VCH_ADDENDUM_FILE2`,`VCH_ADDENDUM_FILE3`,`VCH_CORRIGENDUM_FILE`,`VCH_CORRIGENDUM_FILE2`,`VCH_CORRIGENDUM_FILE3`,`INT_ARCHIVE_STATUS`) VALUES 
 (1,'T1001','Tests tends',NULL,'2021-05-20 00:00:00','2021-05-28 00:00:00','Test desc sds',NULL,NULL,'Tender_1621434300.pdf',NULL,NULL,1,1,'2021-05-19 19:28:02','2021-05-20 19:01:42',1,'\0',1,0,NULL,NULL,NULL,NULL,NULL,NULL,1),
 (2,'T1002','test',NULL,'2021-05-27 00:00:00','2021-05-29 00:00:00','test descriptionfgf',NULL,NULL,'Tender_1621432827.pdf',NULL,NULL,1,1,'2021-05-19 19:31:51','2021-05-20 19:01:42',1,'\0',1,0,NULL,NULL,NULL,NULL,NULL,NULL,1),
 (3,'OD33tr/2534','Test tender By Ashok',NULL,'2021-06-08 00:00:00','2021-06-10 00:00:00','test Description Added',NULL,NULL,'Tender_1623164200.pdf',NULL,NULL,2,1,'2021-06-08 20:27:24','2021-06-08 20:27:53',1,'\0',1,0,NULL,NULL,NULL,NULL,NULL,NULL,0);
INSERT INTO `t_tender_details` (`INT_TENDER_ID`,`VCH_REF_NO`,`VCH_HEAD_LINE_E`,`VCH_HEAD_LINE_O`,`DTM_OPENING_DATETIME`,`DTM_CLOSING_DATETIME`,`VCH_DESCRIPTION_E`,`VCH_DESCRIPTION_O`,`INT_TENDER_TYPE`,`VCH_DOCUMENT_NAME`,`VCH_DOCUMENT_NAME2`,`VCH_DOCUMENT_NAME3`,`INT_PUBLISH_STATUS`,`INT_CREATED_BY`,`DTM_CREATED_ON`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_APPROVAL_STATUS`,`INT_PREVILIGE_STATUS`,`VCH_ADDENDUM_FILE`,`VCH_ADDENDUM_FILE2`,`VCH_ADDENDUM_FILE3`,`VCH_CORRIGENDUM_FILE`,`VCH_CORRIGENDUM_FILE2`,`VCH_CORRIGENDUM_FILE3`,`INT_ARCHIVE_STATUS`) VALUES 
 (4,'OD33tr/2530','Test tender By Liza',NULL,'2021-06-09 00:00:00','2021-06-12 00:00:00','test Description Added',NULL,NULL,'Tender_1623212186.pdf',NULL,NULL,0,1,'2021-06-09 09:48:11',NULL,NULL,'\0',1,0,NULL,NULL,NULL,NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `t_tender_details` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_user_feedback`
--

DROP TABLE IF EXISTS `t_user_feedback`;
CREATE TABLE `t_user_feedback` (
  `INT_FEEDBACK_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VCH_NAME` varchar(512) NOT NULL,
  `VCH_EMAIL` varchar(512) NOT NULL,
  `VCH_MOBILENO` varchar(16) NOT NULL,
  `VCH_SUBJECT` varchar(640) NOT NULL,
  `VCH_FEEDBACK` text NOT NULL,
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `INT_CREATED_BY` int(10) unsigned DEFAULT NULL,
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `INT_UPDATED_BY` int(10) unsigned DEFAULT NULL,
  `BIT_DELETED_FLAG` bit(1) NOT NULL DEFAULT b'0',
  `INT_PUBLISH_STATUS` int(10) unsigned NOT NULL,
  `INT_ARCHIVE_STATUS` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`INT_FEEDBACK_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_user_feedback`
--

/*!40000 ALTER TABLE `t_user_feedback` DISABLE KEYS */;
INSERT INTO `t_user_feedback` (`INT_FEEDBACK_ID`,`VCH_NAME`,`VCH_EMAIL`,`VCH_MOBILENO`,`VCH_SUBJECT`,`VCH_FEEDBACK`,`DTM_CREATED_ON`,`INT_CREATED_BY`,`DTM_UPDATED_ON`,`INT_UPDATED_BY`,`BIT_DELETED_FLAG`,`INT_PUBLISH_STATUS`,`INT_ARCHIVE_STATUS`) VALUES 
 (1,'Indrani','indrani21@gmail.com','9090909090','Site related','It is user friendly.','2020-12-24 13:02:46',0,NULL,NULL,'\0',0,0),
 (2,'Indrani tested','indrani23@gmail.com','9090909090','testing','Nice','2021-01-14 21:10:42',0,NULL,NULL,'\0',0,0),
 (3,'ashok Samal','ashok@csm.co.in','8908804243','','test message.','2021-06-08 15:32:18',0,NULL,NULL,'\0',0,0),
 (4,'ashok Samal','ashok@csm.co.in','8908804243','','test message.','2021-06-08 15:32:41',0,NULL,NULL,'\0',0,0);
/*!40000 ALTER TABLE `t_user_feedback` ENABLE KEYS */;


--
-- Table structure for table `ORBPM_devdb`.`t_user_permission`
--

DROP TABLE IF EXISTS `t_user_permission`;
CREATE TABLE `t_user_permission` (
  `INT_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `INT_USER_ID` int(10) unsigned NOT NULL,
  `INT_GL_ID` int(11) DEFAULT NULL,
  `INT_PL_ID` int(11) DEFAULT NULL,
  `INT_AUTHOR` int(10) unsigned DEFAULT NULL,
  `INT_EDITOR` int(10) unsigned DEFAULT NULL,
  `INT_PUBLISHER` int(10) unsigned DEFAULT NULL,
  `INT_MANAGER` int(10) unsigned DEFAULT NULL,
  `INT_PRIVILEGE` int(10) unsigned NOT NULL,
  `INT_CREATED_BY` int(10) unsigned DEFAULT NULL,
  `DTM_CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `INT_UPDATED_BY` int(10) unsigned DEFAULT NULL,
  `DTM_UPDATED_ON` datetime DEFAULT NULL,
  `BIT_DELETED_FLAG` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`INT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ORBPM_devdb`.`t_user_permission`
--

/*!40000 ALTER TABLE `t_user_permission` DISABLE KEYS */;
INSERT INTO `t_user_permission` (`INT_ID`,`INT_USER_ID`,`INT_GL_ID`,`INT_PL_ID`,`INT_AUTHOR`,`INT_EDITOR`,`INT_PUBLISHER`,`INT_MANAGER`,`INT_PRIVILEGE`,`INT_CREATED_BY`,`DTM_CREATED_ON`,`INT_UPDATED_BY`,`DTM_UPDATED_ON`,`BIT_DELETED_FLAG`) VALUES 
 (8,2,4,7,0,1,0,0,0,0,'2015-09-03 13:18:43',0,'2015-09-03 13:39:38','\0'),
 (9,2,4,8,0,0,1,0,0,0,'2015-09-03 13:18:43',0,'2015-09-03 13:39:38','\0'),
 (10,2,4,12,0,0,0,1,0,0,'2015-09-03 13:18:43',0,'2015-09-03 13:39:39','\0'),
 (11,2,4,13,0,0,0,1,0,0,'2015-09-03 13:18:43',0,'2015-09-03 13:39:39','\0'),
 (12,2,4,25,0,0,0,1,0,0,'2015-09-03 13:18:43',0,'2015-09-03 13:39:39','\0'),
 (18,3,4,7,1,0,0,0,0,0,'2015-09-03 13:33:12',0,'2015-09-10 13:07:42','\0'),
 (19,3,4,8,0,1,0,0,0,0,'2015-09-03 13:33:12',0,'2015-09-10 13:07:42','\0'),
 (20,3,2,1,1,0,0,0,0,0,'2015-09-03 13:33:37',0,'2015-09-10 13:07:42','\0'),
 (21,3,4,12,0,0,0,1,0,0,'2015-09-03 13:34:21',0,'2015-09-10 13:07:42','\0'),
 (22,3,4,13,0,0,0,1,0,0,'2015-09-03 13:34:21',0,'2015-09-10 13:07:42','\0'),
 (23,3,4,25,1,0,0,0,0,0,'2015-09-03 13:34:21',0,'2015-09-10 13:07:42','\0');
INSERT INTO `t_user_permission` (`INT_ID`,`INT_USER_ID`,`INT_GL_ID`,`INT_PL_ID`,`INT_AUTHOR`,`INT_EDITOR`,`INT_PUBLISHER`,`INT_MANAGER`,`INT_PRIVILEGE`,`INT_CREATED_BY`,`DTM_CREATED_ON`,`INT_UPDATED_BY`,`DTM_UPDATED_ON`,`BIT_DELETED_FLAG`) VALUES 
 (24,1,2,1,0,0,0,0,0,0,'2015-09-10 11:21:16',NULL,NULL,'\0'),
 (25,1,4,7,0,0,0,0,0,0,'2015-09-10 11:21:16',NULL,NULL,'\0'),
 (26,1,4,8,0,0,0,0,0,0,'2015-09-10 11:21:16',NULL,NULL,'\0'),
 (27,1,4,12,0,0,0,0,0,0,'2015-09-10 11:21:16',NULL,NULL,'\0'),
 (28,1,4,13,0,0,0,0,0,0,'2015-09-10 11:21:16',NULL,NULL,'\0'),
 (29,1,4,25,0,0,0,0,0,0,'2015-09-10 11:21:16',NULL,NULL,'\0'),
 (30,3,1,1,1,0,0,0,0,0,'2015-09-10 12:48:20',0,'2015-09-10 13:07:42','\0'),
 (32,3,4,16,0,1,0,0,0,0,'2015-09-10 13:07:42',NULL,NULL,'\0'),
 (33,3,4,17,1,0,0,0,0,0,'2015-09-10 13:07:42',NULL,NULL,'\0'),
 (34,4,4,1,0,0,0,1,0,0,'2015-09-14 17:31:50',NULL,NULL,'\0'),
 (35,4,4,7,0,0,0,1,0,0,'2015-09-14 17:31:51',NULL,NULL,'\0'),
 (36,5,2,1,0,0,1,0,0,0,'2016-03-22 10:22:20',NULL,NULL,'\0');
/*!40000 ALTER TABLE `t_user_permission` ENABLE KEYS */;


--
-- Procedure `ORBPM_devdb`.`USP_ADMIN_GL`
--

DROP PROCEDURE IF EXISTS `USP_ADMIN_GL`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_ADMIN_GL`(

  IN  P_ACTION       VARCHAR(3),

  IN  P_ADMIN_GL_ID  INT,

  IN  P_GL_NAME      VARCHAR(45),

  OUT P_OUT          VARCHAR(200)

)
BEGIN







  IF(P_ACTION='S')THEN

    SET @P_SQL="SELECT INT_ADMIN_GL_ID,VCH_GL_NAME,VCH_IMAGE FROM m_admin_global_menu WHERE INT_DELETED_FLAG=0 ";

    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;



  IF(P_ACTION='MX')THEN

    SELECT MAX(INT_ADMIN_GL_ID) AS MAX_GL FROM m_admin_global_menu WHERE INT_DELETED_FLAG=0;

  END IF;



END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_ADMIN_PL`
--

DROP PROCEDURE IF EXISTS `USP_ADMIN_PL`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_ADMIN_PL`(

  IN  P_ACTION       VARCHAR(3),

  IN  P_ADMIN_PL_ID  INT,

  IN  P_ADMIN_GL_ID  INT,

  IN  P_PL_NAME      VARCHAR(45),

  IN  P_URL          VARCHAR(100),

  OUT P_OUT          VARCHAR(200)

)
BEGIN







  IF(P_ACTION='S')THEN

    SET @P_SQL="SELECT INT_ID,INT_ADMIN_PL_ID,VCH_PL_NAME,INT_ADMIN_GL_ID,VCH_URL,INT_FUNCTION_ID FROM m_admin_primary_menu WHERE INT_DELETED_FLAG=0";



    IF(P_ADMIN_GL_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL," AND INT_ADMIN_GL_ID=",P_ADMIN_GL_ID," ORDER BY INT_ADMIN_PL_ID ASC");

    END IF;



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;



  IF(P_ACTION='MX')THEN

    SELECT MAX(INT_ADMIN_PL_ID) AS MAX_GL FROM m_admin_global_menu WHERE INT_DELETED_FLAG=0 AND INT_ADMIN_GL_ID=P_ADMIN_GL_ID;

  END IF;

   IF(P_ACTION='VPL')THEN

    SET @P_SQL="SELECT INT_FN_ID, VCH_NAME, VCH_ADMIN_LAND_URL, VCH_WEB_LAND_URL FROM t_function_master WHERE  INT_FN_ID!=0 ";



    SET @P_SQL=CONCAT(@P_SQL," ORDER BY VCH_NAME ASC");

    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;

   IF(P_ACTION='V')THEN

    SET @P_SQL="SELECT INT_ID,INT_ADMIN_PL_ID,VCH_PL_NAME,INT_ADMIN_GL_ID,VCH_URL,INT_FUNCTION_ID FROM m_admin_primary_menu WHERE INT_DELETED_FLAG=0";



    SET @P_SQL=CONCAT(@P_SQL," AND INT_FUNCTION_ID!=0 ORDER BY VCH_PL_NAME ASC");

    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;



  IF(P_ACTION='R')THEN

    SET @P_SQL="SELECT INT_ID,INT_ADMIN_PL_ID,VCH_PL_NAME,INT_ADMIN_GL_ID,VCH_URL,INT_FUNCTION_ID,(SELECT VCH_ADMIN_LAND_URL

    FROM t_function_master WHERE INT_FN_ID = INT_FUNCTION_ID) AS LINK_URL FROM m_admin_primary_menu WHERE INT_DELETED_FLAG=0";



    IF(P_ADMIN_PL_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL," AND INT_ADMIN_PL_ID=",P_ADMIN_PL_ID,"");

    END IF;

    IF(P_ADMIN_GL_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL," AND INT_ADMIN_GL_ID=",P_ADMIN_GL_ID," ORDER BY INT_ADMIN_PL_ID ASC");

    END IF;



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;



END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_BANNER`
--

DROP PROCEDURE IF EXISTS `USP_BANNER`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_BANNER`(

  IN P_ACTION               VARCHAR(3),

  IN P_BANNER_ID            INT,

  IN P_CAPTION      		TEXT,

  IN P_CAPTION_O      		TEXT charset utf8,

  IN P_IMAGE                VARCHAR(150),

  IN P_PUBLISH_STATUS       INT,

  IN P_CREATED_BY           INT,

  OUT P_OUT                 VARCHAR(200)



)
BEGIN



  IF(P_ACTION='A') THEN



    INSERT INTO t_banner (INT_BANNER_ID,VCH_IMAGE,VCH_CAPTIONS,VCH_CAPTIONS_O,INT_PUBLISH_STATUS,INT_CREATED_BY)

    VALUES (P_BANNER_ID,P_IMAGE,P_CAPTION,P_CAPTION_O,P_PUBLISH_STATUS,P_CREATED_BY);

    SELECT "Banner Added Successfully";



  END IF;



  IF(P_ACTION='U')THEN



   UPDATE t_banner SET VCH_IMAGE=P_IMAGE,VCH_CAPTIONS=P_CAPTION,VCH_CAPTIONS_O=P_CAPTION_O,INT_UPDATED_BY=P_CREATED_BY,

   DTM_UPDATED_ON=NOW() WHERE INT_BANNER_ID=P_BANNER_ID AND BIT_DELETED_FLAG=0;

   SELECT "Banner Updated Successfully";

  END IF;



  IF(P_ACTION='R') THEN

      SELECT INT_BANNER_ID,VCH_IMAGE,VCH_CAPTIONS,VCH_CAPTIONS_O,INT_PUBLISH_STATUS,DTM_CREATED_ON FROM t_banner WHERE INT_BANNER_ID=P_BANNER_ID AND BIT_DELETED_FLAG=0;

    END IF;





   IF(P_ACTION='CD') THEN



       SET @P_SQL=CONCAT('SELECT VCH_CAPTIONS FROM t_banner WHERE BIT_DELETED_FLAG=0 AND VCH_CAPTIONS="',P_CAPTION,'"');





      IF(P_BANNER_ID>0)THEN

        SET @P_SQL=CONCAT(@P_SQL,' AND INT_BANNER_ID!=',P_BANNER_ID);

      END IF;



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;



    END IF;





  IF(P_ACTION='V') THEN



      SET @P_SQL='SELECT INT_BANNER_ID, VCH_IMAGE,VCH_CAPTIONS,VCH_CAPTIONS_O,INT_PUBLISH_STATUS, DTM_CREATED_ON FROM t_banner WHERE BIT_DELETED_FLAG=0';



	   IF(P_PUBLISH_STATUS>0) THEN

	     SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');

	   END IF;



	   IF(P_BANNER_ID>0) THEN

	    SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_BANNER_ID = "'),P_BANNER_ID,'"');

	   END IF;



      SET @P_SQL=CONCAT(@P_SQL,'  ORDER BY DTM_CREATED_ON DESC');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



    END IF;







   IF(P_ACTION='PG') THEN



 	 SET @START_REC=P_BANNER_ID;



	  SET @P_SQL='SELECT INT_BANNER_ID, VCH_IMAGE,VCH_CAPTIONS,VCH_CAPTIONS_O,INT_PUBLISH_STATUS,DTM_CREATED_ON FROM t_banner WHERE BIT_DELETED_FLAG=0';



    SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON DESC LIMIT ?,10');



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT USING @START_REC;



    END IF;





  IF(P_ACTION='IN')THEN



    UPDATE t_banner SET INT_PUBLISH_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

    WHERE  INT_BANNER_ID=P_BANNER_ID AND BIT_DELETED_FLAG=0 ;

     SELECT 'Banner UnPublished Successfully';



  END IF;





	IF(P_ACTION='D')THEN



	  UPDATE t_banner SET BIT_DELETED_FLAG=1 WHERE INT_BANNER_ID=P_BANNER_ID;

	  SELECT 0;



	END IF;





  IF(P_ACTION='P')THEN



    UPDATE t_banner SET INT_PUBLISH_STATUS=2,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE INT_BANNER_ID=P_BANNER_ID;

    SELECT "Banner published Successfully";



  END IF;



  IF(P_ACTION='VP') THEN



      SET @P_SQL='SELECT INT_BANNER_ID,VCH_IMAGE,VCH_CAPTIONS,VCH_CAPTIONS_O, FROM t_banner WHERE BIT_DELETED_FLAG=0';



      IF(P_PUBLISH_STATUS>0) THEN

	   	SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');

      END IF;



      SET @P_SQL=CONCAT(@P_SQL,'  ORDER BY DTM_CREATED_ON DESC');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



    END IF;



END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_CATEGORY`
--

DROP PROCEDURE IF EXISTS `USP_CATEGORY`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_CATEGORY`(

  IN  P_ACTION           VARCHAR(3),

  IN  P_CATEGORY_ID      INT,

  IN  P_CATEGORY_NAME    VARCHAR(100),

  IN  P_CATEGORY_CLASS    VARCHAR(100),

  IN  P_DESCRIPTION      VARCHAR(500),

  IN  P_PUB_STATUS       INT,

  IN  P_CREATED_BY       INT,

  OUT P_OUT              VARCHAR(200)

)
BEGIN



  IF(P_ACTION='CD')THEN

    SET @P_SQL=CONCAT('SELECT VCH_CATEGORY_NAME FROM t_category WHERE BIT_DELETED_FLAG=0 AND VCH_CATEGORY_NAME="',P_CATEGORY_NAME,'"');



    IF(P_CATEGORY_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_CATEGORY_ID!=',P_CATEGORY_ID);

    END IF;



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



  END IF;



  IF(P_ACTION='A')THEN

    INSERT INTO t_category (VCH_CATEGORY_NAME,VCH_IMG,VCH_DESCRIPTION,INT_PUBLISH_STATUS,INT_CREATED_BY)

    VALUES(P_CATEGORY_NAME,P_CATEGORY_CLASS,P_DESCRIPTION,P_PUB_STATUS,P_CREATED_BY);

    SELECT "Category Added Successfully";

  END IF;





  IF(P_ACTION='U')THEN

    UPDATE t_category SET VCH_CATEGORY_NAME=P_CATEGORY_NAME,VCH_IMG=P_CATEGORY_CLASS,VCH_DESCRIPTION=P_DESCRIPTION,

    INT_PUBLISH_STATUS=P_PUB_STATUS, INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE INT_CATEGORY_ID=P_CATEGORY_ID;

    SELECT "Category Updated Successfully";

  END IF;





  IF(P_ACTION='V')THEN

    SET @P_SQL='SELECT INT_CATEGORY_ID,VCH_CATEGORY_NAME,VCH_CATEGORY_CLASS,VCH_IMG,VCH_DESCRIPTION,INT_PUBLISH_STATUS,

    INT_CREATED_BY,DTM_CREATED_ON FROM t_category WHERE BIT_DELETED_FLAG=0';



    IF(P_CATEGORY_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

    END IF;



  IF(P_PUB_STATUS>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUB_STATUS,'"');

  END IF;



  SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON DESC');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;





  IF(P_ACTION='PG')THEN

    SET @START_REC=P_CATEGORY_ID;

    SET @P_SQL='SELECT INT_CATEGORY_ID,VCH_CATEGORY_NAME,VCH_CATEGORY_CLASS,VCH_IMG,VCH_DESCRIPTION,INT_PUBLISH_STATUS,

    INT_CREATED_BY,DTM_CREATED_ON FROM t_category WHERE BIT_DELETED_FLAG=0';



  IF(P_CATEGORY_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

    END IF;



  IF(P_PUB_STATUS>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUB_STATUS,'"');

  END IF;



  SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON DESC LIMIT ?,10');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT USING @START_REC;

  END IF;





  IF(P_ACTION='R')THEN

    SET @P_SQL='SELECT INT_CATEGORY_ID,VCH_CATEGORY_NAME,VCH_CATEGORY_CLASS,VCH_IMG,VCH_DESCRIPTION,INT_PUBLISH_STATUS,

    INT_CREATED_BY,DTM_CREATED_ON FROM t_category WHERE BIT_DELETED_FLAG=0';



    IF(P_CATEGORY_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

    END IF;



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;



  IF(P_ACTION='AC')THEN

    UPDATE t_category SET INT_PUBLISH_STATUS=2,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

    WHERE  INT_CATEGORY_ID=P_CATEGORY_ID;

    SELECT 'Category Activated Successfully';

  END IF;



  IF(P_ACTION='IN')THEN

    UPDATE t_category SET INT_PUBLISH_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

    WHERE  INT_CATEGORY_ID=P_CATEGORY_ID;

     SELECT 'Category UnPublished Successfully';

  END IF;





  IF(P_ACTION='D')THEN



    SET @CATEGORY_NAME  = (SELECT VCH_CATEGORY_NAME FROM t_category WHERE BIT_DELETED_FLAG=0 AND INT_CATEGORY_ID=P_CATEGORY_ID);



    IF((SELECT COUNT(1) FROM t_sub_category WHERE BIT_DELETED_FLAG=0 AND INT_CATEGORY_ID=P_CATEGORY_ID)=0)THEN

      UPDATE t_category SET BIT_DELETED_FLAG=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_CATEGORY_ID=P_CATEGORY_ID;

      SET P_OUT= "0";

      SELECT P_OUT;

    ELSE

      SET P_OUT= @CATEGORY_NAME;

      SELECT P_OUT;

    END IF;



  END IF;



	IF(P_ACTION='F')THEN

		SELECT INT_CATEGORY_ID,VCH_CATEGORY_NAME,VCH_CATEGORY_CLASS,VCH_IMG FROM t_category WHERE BIT_DELETED_FLAG=0 AND INT_PUBLISH_STATUS = 2 ORDER BY VCH_CATEGORY_NAME ASC;

	END IF;



   IF(P_ACTION='VS')THEN



    SET @P_SQL='SELECT INT_CATEGORY_ID,VCH_CATEGORY_NAME,VCH_CATEGORY_CLASS,VCH_IMG,VCH_DESCRIPTION,INT_PUBLISH_STATUS,

    INT_CREATED_BY,DTM_CREATED_ON FROM t_category WHERE BIT_DELETED_FLAG=0 AND INT_PUBLISH_STATUS =2 ORDER BY DTM_CREATED_ON DESC LIMIT 1';



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;



END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_EVENT_DETAILS`
--

DROP PROCEDURE IF EXISTS `USP_EVENT_DETAILS`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_EVENT_DETAILS`(
  IN P_ACTION            VARCHAR(3),
  IN P_EVENT_ID           INT,
  IN P_TITLE_E            VARCHAR(320),
  IN P_TITLE_O            TEXT,
  IN P_SOURCE             VARCHAR(256),
  IN P_START_DATE         DATE,
  IN P_START_TIME         TIME,
  IN P_END_DATE           DATE,
  IN P_END_TIME           TIME,
  IN P_LOCATION           VARCHAR(256),
  IN P_DESCRIPTION_E      VARCHAR(640),
  IN P_DESCRIPTION_O      TEXT,
  IN P_IMAGE_NAME         VARCHAR(320),
  IN P_PUBLISH_STATUS     INT,
  IN P_ARC_STATUS         INT,
  IN P_CREATED_BY         INT,
  IN P_ATTR1              VARCHAR(256),
  IN P_ATTR2              VARCHAR(256),
  IN P_INTATTR1           INT,
  IN P_INTATTR2           INT,
  OUT P_OUT               VARCHAR(256)
)
BEGIN
/* Procedure Name: USP_EVENT_DETAILS 
   Created Date :: 10-12-2020
   Created By:: Indrani Biswas
*/

IF(P_ACTION='A')THEN
	INSERT INTO t_event_details (VCH_TITLE_E,VCH_TITLE_O,VCH_SOURCE,DTM_START_DATE,START_TIME,DTM_END_DATE,END_TIME,VCH_LOCATION,VCH_DESCRIPTION_E,VCH_DESCRIPTION_O,VCH_IMAGE,DTM_CREATED_ON,INT_CREATED_BY,INT_PUBLISH_STATUS,INT_ARCHIVE_STATUS) VALUES (P_TITLE_E,P_TITLE_O,P_SOURCE,P_START_DATE,P_START_TIME,P_END_DATE,P_END_TIME,P_LOCATION,P_DESCRIPTION_E,P_DESCRIPTION_O,P_IMAGE_NAME,NOW(),P_CREATED_BY,P_PUBLISH_STATUS,P_ARC_STATUS);
END IF;

IF(P_ACTION='U')THEN
	UPDATE t_event_details SET VCH_TITLE_E=P_TITLE_E,VCH_TITLE_O=P_TITLE_O,VCH_SOURCE=P_SOURCE,DTM_START_DATE=P_START_DATE,START_TIME=P_START_TIME,DTM_END_DATE=P_END_DATE,END_TIME=P_END_TIME,VCH_LOCATION=P_LOCATION,VCH_DESCRIPTION_E=P_DESCRIPTION_E,VCH_DESCRIPTION_O=P_DESCRIPTION_O,VCH_IMAGE=P_IMAGE_NAME,DTM_UPDATED_ON=NOW(),INT_UPDATED_BY=P_CREATED_BY WHERE INT_EVENT_ID=P_EVENT_ID AND BIT_DELETED_FLAG=0;
END IF;

IF(P_ACTION='R')THEN
SELECT INT_EVENT_ID,VCH_TITLE_E,VCH_TITLE_O,VCH_SOURCE,DTM_START_DATE,START_TIME,DTM_END_DATE,END_TIME,VCH_LOCATION,VCH_DESCRIPTION_E,VCH_DESCRIPTION_O,VCH_IMAGE,DTM_CREATED_ON,INT_CREATED_BY,INT_PUBLISH_STATUS FROM t_event_details WHERE INT_EVENT_ID=P_EVENT_ID AND BIT_DELETED_FLAG=0;
END IF;

IF(P_ACTION='V')THEN
	SET @P_SQL='SELECT INT_EVENT_ID,VCH_TITLE_E,VCH_TITLE_O,VCH_SOURCE,DTM_START_DATE,START_TIME,DTM_END_DATE,END_TIME,VCH_LOCATION,VCH_DESCRIPTION_E,VCH_DESCRIPTION_O,VCH_IMAGE,DTM_CREATED_ON,INT_CREATED_BY,INT_PUBLISH_STATUS,INT_ARCHIVE_STATUS FROM t_event_details WHERE BIT_DELETED_FLAG=0';
    IF(P_PUBLISH_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');
    END IF;
    IF(P_ARC_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS = "'),P_ARC_STATUS,'"');
    END IF;
        SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON DESC');

    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;
END IF;

IF(P_ACTION='PG')THEN
	SET @START_REC=P_EVENT_ID;
	SET @P_SQL='SELECT INT_EVENT_ID,VCH_TITLE_E,VCH_TITLE_O,VCH_SOURCE,DTM_START_DATE,START_TIME,DTM_END_DATE,END_TIME,VCH_LOCATION,VCH_DESCRIPTION_E,VCH_DESCRIPTION_O,VCH_IMAGE,DTM_CREATED_ON,INT_CREATED_BY,INT_PUBLISH_STATUS,INT_ARCHIVE_STATUS FROM t_event_details WHERE BIT_DELETED_FLAG=0';
    IF(P_PUBLISH_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');
    END IF;
    IF(P_ARC_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS = "'),P_ARC_STATUS,'"');
    END IF;

    SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON DESC LIMIT ?,10');

      PREPARE STMT FROM @P_SQL;
      EXECUTE STMT USING @START_REC;
 END IF;
 
IF(P_ACTION='D')THEN
	UPDATE t_event_details SET BIT_DELETED_FLAG=1 WHERE INT_EVENT_ID=P_EVENT_ID;      
    SELECT '0';
END IF; 

IF(P_ACTION='P')THEN
    UPDATE t_event_details SET INT_PUBLISH_STATUS=2,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE INT_EVENT_ID=P_EVENT_ID;
    SELECT "Events Details published Successfully";
END IF;
  
IF(P_ACTION='IN')THEN
    UPDATE t_event_details SET INT_PUBLISH_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()
    WHERE INT_EVENT_ID=P_EVENT_ID AND BIT_DELETED_FLAG=0 ;
     SELECT "Events Details Unpublished Successfully";
END IF; 

/* Action for showing upcoming events in home page */
IF(P_ACTION='VE')THEN
	SET @currentdate = NOW();
    SET @P_SQL='SELECT INT_EVENT_ID,VCH_TITLE_E,VCH_TITLE_O,VCH_SOURCE,DTM_START_DATE,START_TIME,DTM_END_DATE,END_TIME,VCH_LOCATION,VCH_DESCRIPTION_E,VCH_DESCRIPTION_O,VCH_IMAGE,DTM_CREATED_ON,INT_CREATED_BY,INT_PUBLISH_STATUS,INT_ARCHIVE_STATUS FROM t_event_details WHERE BIT_DELETED_FLAG=0 ';
    SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND DTM_START_DATE > "'),@currentdate,'"');
    IF(P_EVENT_ID>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_EVENT_ID = "'),P_EVENT_ID,'"');
    END IF;
    IF(P_PUBLISH_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');
    END IF;
    IF(P_ARC_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS = "'),P_ARC_STATUS,'"');
    END IF;
        SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_START_DATE DESC, START_TIME ASC');

    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;
END IF;  

/* Action for showing all upcoming events list in home page event list page */
IF(P_ACTION='VAE')THEN
	SET @currentdate = NOW();
    SET @P_SQL='SELECT INT_EVENT_ID,VCH_TITLE_E,VCH_TITLE_O,VCH_SOURCE,DTM_START_DATE,START_TIME,DTM_END_DATE,END_TIME,VCH_LOCATION,VCH_DESCRIPTION_E,VCH_DESCRIPTION_O,VCH_IMAGE,DTM_CREATED_ON,INT_CREATED_BY,INT_PUBLISH_STATUS,INT_ARCHIVE_STATUS FROM t_event_details WHERE BIT_DELETED_FLAG=0 ';
    SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND DTM_START_DATE > "'),@currentdate,'"');
    IF(P_PUBLISH_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');
    END IF;
    IF(P_ARC_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS = "'),P_ARC_STATUS,'"');
    END IF;
        SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_START_DATE DESC, START_TIME ASC');

    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT;
END IF;

/*  Action for showing all upcoming events list in home page event list page  */
IF(P_ACTION='PGE')THEN
	SET @START_REC=P_EVENT_ID;
	SET @currentdate = NOW();
    SET @P_SQL='SELECT INT_EVENT_ID,VCH_TITLE_E,VCH_TITLE_O,VCH_SOURCE,DTM_START_DATE,START_TIME,DTM_END_DATE,END_TIME,VCH_LOCATION,VCH_DESCRIPTION_E,VCH_DESCRIPTION_O,VCH_IMAGE,DTM_CREATED_ON,INT_CREATED_BY,INT_PUBLISH_STATUS,INT_ARCHIVE_STATUS FROM t_event_details WHERE BIT_DELETED_FLAG=0 ';
    SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND DTM_START_DATE > "'),@currentdate,'"');
    IF(P_PUBLISH_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');
    END IF;
    IF(P_ARC_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS = "'),P_ARC_STATUS,'"');
    END IF;
        SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_START_DATE DESC, START_TIME ASC LIMIT ?,6');

    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT USING @START_REC;
END IF;

/* Action to get all upcoming events for event-detail page in home page by indrani on::15-12-2020 */
IF(P_ACTION='VA')THEN
	SET @currentdate = NOW();
    SET @P_SQL='SELECT INT_EVENT_ID,VCH_TITLE_E,VCH_TITLE_O,VCH_SOURCE,DTM_START_DATE,START_TIME,DTM_END_DATE,END_TIME,VCH_LOCATION,VCH_DESCRIPTION_E,VCH_DESCRIPTION_O,VCH_IMAGE,DTM_CREATED_ON,INT_CREATED_BY,INT_PUBLISH_STATUS,INT_ARCHIVE_STATUS FROM t_event_details WHERE BIT_DELETED_FLAG=0 ';
    SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND DTM_START_DATE > "'),@currentdate,'"');
    IF(P_PUBLISH_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');
    END IF;
    IF(P_ARC_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS = "'),P_ARC_STATUS,'"');
    END IF;
        SET @P_SQL=CONCAT(@P_SQL,' ORDER BY INT_EVENT_ID ASC LIMIT 4');
    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT;
END IF;

/*Action to get events for load more in event-detail page of home page by indrani on::15-12-2020 */
IF(P_ACTION='VLE')THEN
	SET @currentdate = NOW();
    SET @P_SQL='SELECT INT_EVENT_ID,VCH_TITLE_E,VCH_TITLE_O,VCH_SOURCE,DTM_START_DATE,START_TIME,DTM_END_DATE,END_TIME,VCH_LOCATION,VCH_DESCRIPTION_E,VCH_DESCRIPTION_O,VCH_IMAGE,DTM_CREATED_ON,INT_CREATED_BY,INT_PUBLISH_STATUS,INT_ARCHIVE_STATUS FROM t_event_details WHERE BIT_DELETED_FLAG=0 ';
    SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND DTM_START_DATE > "'),@currentdate,'"');
    IF(P_EVENT_ID>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_EVENT_ID > "'),P_EVENT_ID,'"');
    END IF;
    IF(P_PUBLISH_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');
    END IF;
    IF(P_ARC_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS = "'),P_ARC_STATUS,'"');
    END IF;
        SET @P_SQL=CONCAT(@P_SQL,' ORDER BY INT_EVENT_ID ASC LIMIT 4');

    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT;
END IF; 

END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_FEEDBACK`
--

DROP PROCEDURE IF EXISTS `USP_FEEDBACK`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_FEEDBACK`(

     IN  P_ACTION        VARCHAR(2),

     IN  P_FEEDBACK_ID   INT,

     IN  P_NAME          VARCHAR(128),

     IN  P_NAME_L          VARCHAR(128),

     IN  P_EMAIL         VARCHAR(64),

     IN  P_MOBILE        VARCHAR(16),

     IN  P_SUBJECT       VARCHAR(512),

     IN  P_MESSAGE       VARCHAR(512),

     IN  P_REMARKS       VARCHAR(256),

     IN  P_DATE_FROM     VARCHAR(256),

     IN  P_DATE_TO       VARCHAR(256),

     IN  P_UPDATED_BY    INT,

     OUT P_OUT           VARCHAR(200)

)
BEGIN
/*================
Created By: Ashok Kumar Samal
ON: 08-06-2021
====================*/


IF(P_ACTION = 'A')THEN

START TRANSACTION;

    INSERT INTO t_feedback(vchName,vchNameL,vchEmail,vchTelNo,vchSubject,vchMessage)

    VALUES(P_NAME,P_NAME_L,P_EMAIL,P_MOBILE,P_SUBJECT,P_MESSAGE);


COMMIT;
  END IF;

   

  IF (P_ACTION = 'V') THEN

      SET @P_SQL = CONCAT('SELECT intFeedbackId, vchName,vchNameL, vchEmail, vchTelNo, vchSubject, vchMessage, vchRemarks, stmCreatedOn, dtmUpdatedOn, bitDeletedFlag FROM t_feedback WHERE bitDeletedFlag=0');

      IF(P_FEEDBACK_ID >0) THEN

        SET @P_SQL = CONCAT(@P_SQL,' AND intFeedbackId=',P_FEEDBACK_ID);

      END IF;

      IF(CHAR_LENGTH(P_MESSAGE)>0) THEN

        SET @P_SQL = CONCAT(@P_SQL,' AND vchMessage LIKE "%',P_MESSAGE,'%"');

      END IF;

      SET @P_SQL = CONCAT(@P_SQL, ' ORDER BY stmCreatedOn desc');

      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;

  END IF;

   

  IF (P_ACTION='PG') THEN

      SET @P_START_INDEX = P_FEEDBACK_ID;

      SET @P_SQL =CONCAT('SELECT intFeedbackId, vchName,vchNameL, vchEmail, vchTelNo, vchSubject, vchMessage, vchRemarks, stmCreatedOn, dtmUpdatedOn, bitDeletedFlag FROM t_feedback WHERE bitDeletedFlag=0');

      IF(CHAR_LENGTH(P_MESSAGE)>0) THEN

        SET @P_SQL = CONCAT(@P_SQL,' AND vchMessage LIKE "%',P_MESSAGE,'%"');

      END IF;

      SET @P_SQL  = CONCAT(@P_SQL,' ORDER BY stmCreatedOn DESC LIMIT ?,10');

      PREPARE STMT FROM @P_SQL;

  		EXECUTE STMT USING @P_START_INDEX;



  END IF;

 

  IF(P_ACTION='D') THEN

      UPDATE t_feedback SET bitDeletedFlag=1, intUpdatedBy=P_UPDATED_BY, dtmUpdatedOn=NOW()

      WHERE intFeedbackId = P_FEEDBACK_ID;

  END IF;



END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_FORMER_OFFICERS`
--

DROP PROCEDURE IF EXISTS `USP_FORMER_OFFICERS`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_FORMER_OFFICERS`(
	IN  P_ACTION           VARCHAR(3),
    IN  P_OFFICER_ID        INT,
    IN  P_OFFICER_TYPE        INT,
    IN  P_OFFICER_NAME         VARCHAR(250),
	IN  P_JOINING_DATE     VARCHAR(32),
	IN  P_RETIRE_DATE     VARCHAR(32),
	IN  P_OFFICER_FILE      VARCHAR(50),
    IN  P_PUB_STATUS       INT,
    IN  P_CREATED_BY       INT,
    IN  P_ORDER_NO       INT,
    OUT P_OUT              VARCHAR(200)
)
BEGIN
	IF(P_JOINING_DATE='') THEN 
		set P_JOINING_DATE= NULL;
    END IF;
    IF(P_RETIRE_DATE='') THEN 
		set P_RETIRE_DATE= NULL;
    END IF;
	IF(P_ACTION='CD')THEN

		SET @P_SQL=CONCAT('SELECT intProfileId FROM t_former_officer WHERE  dtJoiningDate>="',P_JOINING_DATE,'" AND dtRetireDate <="',P_RETIRE_DATE,'" AND intOfficerType=',P_OFFICER_TYPE,' and bitDeletedFlag=0 ');

		IF(P_OFFICER_ID>0)THEN
			SET @P_SQL=CONCAT(@P_SQL,' AND intProfileId!=',P_OFFICER_ID);
		END IF;

		PREPARE STMT FROM @P_SQL;

		EXECUTE STMT;
	END IF;
    
    
     IF(P_ACTION='A')THEN

		INSERT INTO t_former_officer (intOfficerType,vchOfficerName,dtJoiningDate,dtRetireDate,vchImage,intOrderno,intCreatedBy)
		VALUES (P_OFFICER_TYPE,P_OFFICER_NAME,P_JOINING_DATE,P_RETIRE_DATE,P_OFFICER_FILE,P_ORDER_NO,P_CREATED_BY);

		SELECT "Former Officer Added Successfully";

	END IF;
    
    IF(P_ACTION='U')THEN

		UPDATE t_former_officer SET intOfficerType=P_OFFICER_TYPE,vchOfficerName=P_OFFICER_NAME,dtJoiningDate=P_JOINING_DATE,dtRetireDate=P_RETIRE_DATE,vchImage=P_OFFICER_FILE,intOrderno=P_ORDER_NO,intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW() WHERE intProfileId=P_OFFICER_ID;
        
		SELECT "Former Officer Updated Successfully";

	END IF;
    
    
    
    IF(P_ACTION='R')THEN

		SET @P_SQL='SELECT intOfficerType,vchOfficerName,dtJoiningDate,dtRetireDate,intOrderno,vchImage FROM t_former_officer WHERE bitDeletedFlag=0';
        
		IF(P_OFFICER_ID>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND intProfileId = "'),P_OFFICER_ID,'"');

		END IF;

		PREPARE STMT FROM @P_SQL;

		EXECUTE STMT;

	END IF;
    
    
    IF(P_ACTION='IN')THEN

		UPDATE t_former_officer SET tinPublishStatus=1,intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW()
		WHERE  intProfileId=P_OFFICER_ID;

		SELECT "Officer Un-Published Successfully";
	END IF;



	IF(P_ACTION='D')THEN

		DELETE FROM t_former_officer WHERE  intProfileId=P_OFFICER_ID;

		SELECT 0;

	END IF;



	IF(P_ACTION='P')THEN

		UPDATE t_former_officer SET tinPublishStatus=2, intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW()
		WHERE  intProfileId=P_OFFICER_ID;

		SELECT "Officer Published Successfully";

	END IF;
    
    IF(P_ACTION='V')THEN
    
    SET @P_SQL='SELECT intProfileId,intOfficerType,vchOfficerName,dtJoiningDate,dtRetireDate,vchImage,intOrderno,tinPublishStatus,stmCreatedOn FROM t_former_officer WHERE bitDeletedFlag=0';

   IF(CHAR_LENGTH(P_OFFICER_NAME)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND vchOfficerName LIKE "%'),P_OFFICER_NAME,'%"');

    END IF;
    IF(P_PUB_STATUS>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND tinPublishStatus = "'),P_PUB_STATUS,'"');

    END IF;
    IF(P_OFFICER_ID>0) THEN

	  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND intProfileId = "'),P_OFFICER_ID,'"');

	END IF;
    IF(P_OFFICER_TYPE>0) THEN

	  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND intOfficerType = "'),P_OFFICER_TYPE,'"');

	END IF;

	SET @P_SQL=CONCAT(@P_SQL,' ORDER BY intOfficerType,intOrderno');


	#select @P_SQL;
    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;





  IF(P_ACTION='PG')THEN

    SET @START_REC=P_OFFICER_ID;

    SET @P_SQL='SELECT intProfileId,intOfficerType,vchOfficerName,dtJoiningDate,dtRetireDate,vchImage,tinPublishStatus,intOrderno,stmCreatedOn FROM t_former_officer WHERE bitDeletedFlag=0';

   IF(CHAR_LENGTH(P_OFFICER_NAME)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND vchOfficerName LIKE "%'),P_OFFICER_NAME,'%"');

    END IF;
    IF(P_PUB_STATUS>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND tinPublishStatus = "'),P_PUB_STATUS,'"');

    END IF;
    IF(P_OFFICER_ID>0) THEN

	  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND intProfileId = "'),P_OFFICER_ID,'"');

	END IF;
     IF(P_OFFICER_TYPE>0) THEN

	  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND intOfficerType = "'),P_OFFICER_TYPE,'"');

	END IF;

      SET @P_SQL=CONCAT(@P_SQL,' ORDER BY intOfficerType,intOrderno ASC LIMIT ?,10');


    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT USING @START_REC;

  END IF;

    

END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_GALLERY`
--

DROP PROCEDURE IF EXISTS `USP_GALLERY`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_GALLERY`(



  IN P_ACTION             VARCHAR(3),

  IN P_GALARY_ID          INT,

  IN P_TYPEID             INT,

  IN P_PLUGINID           INT,

  IN P_CATEGORY_ID        INT,

  IN P_VIDEOTYPEID        INT,

  IN P_HEADLINE_E         VARCHAR(256),

  IN P_HEADLINE_o		  TEXT,

  IN P_THUMB_IMAGE        VARCHAR(128),

  IN P_LARGE_IMAGE        VARCHAR(128),

  IN P_DESCRIPTION_E      VARCHAR(512),

  IN P_DESCRIPTION_O      TEXT,

  IN P_URL                VARCHAR(256),

  IN P_PUBLISH_STATUS     INT,

  IN P_ARC_STATUS         INT,

  IN P_CREATED_BY         INT,

  IN P_PORTAL_TYPE        VARCHAR(128),
  
  IN P_SCREEN_TYPE        INT,

  OUT P_OUT               VARCHAR(256)







)
BEGIN

  IF(P_ACTION='VG') THEN

       SET @P_SQL= CONCAT( 'SELECT t_pages.intPageId, t_pages.vchTitle FROM t_gallery left JOIN t_pages

        ON t_pages.intPageId=t_gallery.INT_PLUGIN_ID where t_gallery.BIT_DELETED_FLAG=0');



      IF(P_TYPEID>0)THEN

        SET @P_SQL=CONCAT(@P_SQL,' AND INT_TYPE_ID =',P_TYPEID);

      END IF;



      SET @P_SQL=CONCAT(@P_SQL,'  group by t_pages.intPageId ');



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;



  END IF;



	IF(P_ACTION='CD') THEN

    

      SET @P_SQL= CONCAT('SELECT VCH_HEADLINE_E FROM t_gallery WHERE BIT_DELETED_FLAG=0 AND VCH_HEADLINE_E="',P_HEADLINE_E,'"' );



      IF(P_GALARY_ID>0)THEN

        SET @P_SQL=CONCAT(@P_SQL,' AND INT_GALLERY_ID!=',P_GALARY_ID);

      END IF;



      IF(P_CATEGORY_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_CATEGORY_ID=',P_CATEGORY_ID);

      END IF;



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;

    END IF;

	



  IF(P_ACTION='A') THEN



      INSERT INTO t_gallery (INT_CATEGORY_ID,INT_GALLERY_ID,VCH_HEADLINE_E,VCH_HEADLINE_O,VCH_THUMB_IMAGE,VCH_LARGE_IMAGE,

      VCH_DESCRIPTION_E,VCH_DESCRIPTION_O,INT_PUBLISH_STATUS,INT_ARCHIVE_STATUS,INT_CREATED_BY,VCH_PORTAL_TYPE,INT_TYPE_ID,

      INT_VIDEO_LINK_TYPE,VCH_URL,INT_PLUGIN_ID,INT_SCREEN_TYPE)

      VALUES (P_CATEGORY_ID,P_GALARY_ID,P_HEADLINE_E,P_HEADLINE_O,P_THUMB_IMAGE,P_LARGE_IMAGE,P_DESCRIPTION_E,P_DESCRIPTION_O,

      P_PUBLISH_STATUS,P_ARC_STATUS,P_CREATED_BY,P_PORTAL_TYPE,P_TYPEID,P_VIDEOTYPEID,P_URL,P_PLUGINID,P_SCREEN_TYPE);

      SELECT "Gallery Added Successfully";



  END IF;





   IF(P_ACTION='U') THEN



      UPDATE t_gallery SET INT_CATEGORY_ID=P_CATEGORY_ID,VCH_HEADLINE_E=P_HEADLINE_E,VCH_HEADLINE_O=P_HEADLINE_O,

		  VCH_DESCRIPTION_E=P_DESCRIPTION_E,VCH_DESCRIPTION_O=P_DESCRIPTION_O,VCH_THUMB_IMAGE=P_THUMB_IMAGE,VCH_LARGE_IMAGE=P_LARGE_IMAGE,

		  INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW(),VCH_PORTAL_TYPE=P_PORTAL_TYPE,

		  INT_TYPE_ID   = P_TYPEID,INT_VIDEO_LINK_TYPE=P_VIDEOTYPEID,VCH_URL=P_URL,INT_PLUGIN_ID=P_PLUGINID

	 ,INT_SCREEN_TYPE=P_SCREEN_TYPE WHERE INT_GALLERY_ID=P_GALARY_ID AND BIT_DELETED_FLAG=0;

      SELECT "Gallery  Updated Successfully";

  END IF;



   

  IF(P_ACTION='R') THEN



      SELECT INT_CATEGORY_ID,INT_GALLERY_ID,INT_TYPE_ID,INT_PLUGIN_ID,INT_VIDEO_LINK_TYPE,VCH_URL,VCH_HEADLINE_E,VCH_PORTAL_TYPE,VCH_HEADLINE_O,VCH_THUMB_IMAGE,VCH_LARGE_IMAGE,VCH_DESCRIPTION_E,VCH_DESCRIPTION_O,INT_PUBLISH_STATUS,DTM_CREATED_ON,INT_SCREEN_TYPE FROM t_gallery WHERE INT_GALLERY_ID=P_GALARY_ID  AND BIT_DELETED_FLAG=0;





    END IF;

  



  IF(P_ACTION='V') THEN



      SET @P_SQL='SELECT INT_GALLERY_ID, INT_PLUGIN_ID,VCH_HEADLINE_E, INT_TYPE_ID,INT_VIDEO_LINK_TYPE,VCH_URL,VCH_PORTAL_TYPE,VCH_HEADLINE_O, INT_CATEGORY_ID, VCH_THUMB_IMAGE, VCH_LARGE_IMAGE, VCH_DESCRIPTION_E,VCH_DESCRIPTION_O, INT_PUBLISH_STATUS,DTM_CREATED_ON,INT_SCREEN_TYPE FROM t_gallery WHERE  BIT_DELETED_FLAG=0';



	  IF(P_PUBLISH_STATUS>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');

		END IF;



	  IF(P_GALARY_ID>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_GALLERY_ID = "'),P_GALARY_ID,'"');

		END IF;



	  IF(P_TYPEID>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_TYPE_ID = "'),P_TYPEID,'"');

		END IF;

	  IF(P_PLUGINID>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PLUGIN_ID = "'),P_PLUGINID,'"');

		END IF;

	  IF(P_CATEGORY_ID>0) THEN

	    SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

	  END IF;
      
	  IF(P_SCREEN_TYPE>0) THEN

        SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_SCREEN_TYPE = "'),P_SCREEN_TYPE,'"');

	  END IF; 

      SET @P_SQL=CONCAT(@P_SQL,'  AND INT_ARCHIVE_STATUS=',P_ARC_STATUS,' ORDER BY DTM_CREATED_ON DESC');



    PREPARE STMT FROM @P_SQL;



    EXECUTE STMT;

    END IF;



  IF(P_ACTION='VM') THEN

SET @START_REC=P_GALARY_ID;

      SET @P_SQL='SELECT INT_GALLERY_ID, VCH_HEADLINE_E,INT_PLUGIN_ID, INT_TYPE_ID,INT_VIDEO_LINK_TYPE,VCH_URL,VCH_PORTAL_TYPE,VCH_HEADLINE_O, INT_CATEGORY_ID, VCH_THUMB_IMAGE, VCH_LARGE_IMAGE, VCH_DESCRIPTION_E,VCH_DESCRIPTION_O, INT_PUBLISH_STATUS,DTM_CREATED_ON FROM t_gallery WHERE  BIT_DELETED_FLAG=0';



	  IF(P_PUBLISH_STATUS>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');

		END IF;





	  IF(P_TYPEID>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_TYPE_ID = "'),P_TYPEID,'"');

		END IF;

	  IF(P_CATEGORY_ID>0) THEN

	    SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

	  END IF;



      SET @P_SQL=CONCAT(@P_SQL,'  AND INT_ARCHIVE_STATUS=',P_ARC_STATUS,' ORDER BY DTM_CREATED_ON DESC LIMIT ?,',P_VIDEOTYPEID);



   PREPARE STMT FROM @P_SQL;

      EXECUTE STMT USING @START_REC;

    END IF;



  IF(P_ACTION='VP') THEN



      SET @P_SQL='SELECT INT_GALLERY_ID, VCH_HEADLINE_E,INT_PLUGIN_ID, INT_TYPE_ID,INT_VIDEO_LINK_TYPE,VCH_URL,VCH_PORTAL_TYPE,VCH_HEADLINE_O, INT_CATEGORY_ID, VCH_THUMB_IMAGE, VCH_LARGE_IMAGE, VCH_DESCRIPTION_E,VCH_DESCRIPTION_O, INT_PUBLISH_STATUS,DTM_CREATED_ON FROM t_gallery WHERE  BIT_DELETED_FLAG=0';



	  IF(P_PUBLISH_STATUS>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');

		END IF;



	  IF(P_GALARY_ID>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_GALLERY_ID = "'),P_GALARY_ID,'"');

		END IF;



	  IF(P_CATEGORY_ID>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

		END IF;



      SET @P_SQL=CONCAT(@P_SQL,'  AND INT_ARCHIVE_STATUS=',P_ARC_STATUS,' ORDER BY DTM_CREATED_ON DESC');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

    END IF;



   IF(P_ACTION='PG') THEN

      SET @START_REC=P_GALARY_ID;

	SET @P_SQL='SELECT INT_GALLERY_ID, VCH_HEADLINE_E,INT_PLUGIN_ID,INT_TYPE_ID,INT_VIDEO_LINK_TYPE,VCH_URL, VCH_PORTAL_TYPE,VCH_HEADLINE_O, INT_CATEGORY_ID, VCH_THUMB_IMAGE, VCH_LARGE_IMAGE, VCH_DESCRIPTION_E,VCH_DESCRIPTION_O, INT_PUBLISH_STATUS,DTM_CREATED_ON,INT_SCREEN_TYPE FROM t_gallery WHERE  BIT_DELETED_FLAG=0';





	IF(P_CATEGORY_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

    END IF;



	IF(P_TYPEID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_TYPE_ID = "'),P_TYPEID,'"');

    END IF;

  IF(P_PLUGINID>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PLUGIN_ID = "'),P_PLUGINID,'"');

		END IF;
   
  IF(P_SCREEN_TYPE>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_SCREEN_TYPE = "'),P_SCREEN_TYPE,'"');

    END IF; 

 

    SET @P_SQL=CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS=',P_ARC_STATUS,' ORDER BY DTM_CREATED_ON DESC LIMIT ?,20');



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT USING @START_REC;

    END IF;



 IF(P_ACTION='APG') THEN

      SET @START_REC=P_GALARY_ID;

    SET @P_SQL='SELECT INT_GALLERY_ID, VCH_HEADLINE_E,INT_TYPE_ID,INT_PLUGIN_ID,INT_VIDEO_LINK_TYPE,VCH_URL, VCH_PORTAL_TYPE,VCH_HEADLINE_O, INT_CATEGORY_ID, VCH_THUMB_IMAGE, VCH_LARGE_IMAGE, VCH_DESCRIPTION_E,VCH_DESCRIPTION_O, INT_PUBLISH_STATUS,DTM_CREATED_ON FROM t_gallery WHERE  BIT_DELETED_FLAG=0';





    IF(P_CATEGORY_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

    END IF;



    SET @P_SQL=CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS=',P_ARC_STATUS,'  ORDER BY DTM_CREATED_ON DESC LIMIT ?,20');



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT USING @START_REC;

    END IF;



IF(P_ACTION='PGA') THEN

      SET @START_REC=P_GALARY_ID;

		SET @P_SQL='SELECT INT_GALLERY_ID, VCH_HEADLINE_E,INT_TYPE_ID,INT_PLUGIN_ID,INT_VIDEO_LINK_TYPE,VCH_URL, VCH_PORTAL_TYPE,VCH_HEADLINE_O, INT_CATEGORY_ID, VCH_THUMB_IMAGE, VCH_LARGE_IMAGE, VCH_DESCRIPTION_E,VCH_DESCRIPTION_O, INT_PUBLISH_STATUS,DTM_CREATED_ON FROM t_gallery WHERE  BIT_DELETED_FLAG=0';





		IF(P_CATEGORY_ID>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

		END IF;



		SET @P_SQL=CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS=',P_ARC_STATUS,' AND INT_TYPE_ID=',P_TYPEID,' ORDER BY DTM_CREATED_ON DESC LIMIT ?,20');



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT USING @START_REC;

    END IF;

  IF(P_ACTION='VPA') THEN



      SET @P_SQL='SELECT INT_GALLERY_ID, VCH_HEADLINE_E, INT_TYPE_ID,INT_PLUGIN_ID,INT_VIDEO_LINK_TYPE,VCH_URL,VCH_PORTAL_TYPE,VCH_HEADLINE_O, INT_CATEGORY_ID, VCH_THUMB_IMAGE, VCH_LARGE_IMAGE, VCH_DESCRIPTION_E,VCH_DESCRIPTION_O, INT_PUBLISH_STATUS, DTM_CREATED_ON FROM t_gallery WHERE  BIT_DELETED_FLAG=0';



	  IF(P_PUBLISH_STATUS>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');

		END IF;



	  IF(P_GALARY_ID>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_GALLERY_ID = "'),P_GALARY_ID,'"');

		END IF;



	  IF(P_CATEGORY_ID>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

		END IF;





      SET @P_SQL=CONCAT(@P_SQL,'  AND INT_ARCHIVE_STATUS=',P_ARC_STATUS,' AND INT_TYPE_ID=',P_TYPEID,' ORDER BY DTM_CREATED_ON DESC');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

    END IF;



IF(P_ACTION='AVP') THEN



  SET @P_SQL='SELECT INT_GALLERY_ID, VCH_HEADLINE_E, INT_TYPE_ID,INT_PLUGIN_ID,INT_VIDEO_LINK_TYPE,VCH_URL,VCH_PORTAL_TYPE,VCH_HEADLINE_O, INT_CATEGORY_ID, VCH_THUMB_IMAGE, VCH_LARGE_IMAGE, VCH_DESCRIPTION_E,VCH_DESCRIPTION_O, INT_PUBLISH_STATUS,DTM_CREATED_ON FROM t_gallery WHERE  BIT_DELETED_FLAG=0';





    IF(P_PUBLISH_STATUS>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');

    END IF;



    IF(P_GALARY_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_GALLERY_ID = "'),P_GALARY_ID,'"');

    END IF;



    IF(P_CATEGORY_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

    END IF;



	SET @P_SQL=CONCAT(@P_SQL,'  AND INT_ARCHIVE_STATUS=',P_ARC_STATUS,'  ORDER BY DTM_CREATED_ON DESC');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

    END IF;







  IF(P_ACTION='IN')THEN

    UPDATE t_gallery SET INT_PUBLISH_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

    WHERE  INT_GALLERY_ID=P_GALARY_ID AND BIT_DELETED_FLAG=0 ;

     SELECT "Gallery Unpublished Successfully";

  END IF;





  IF(P_ACTION='AR')THEN

    UPDATE t_gallery SET INT_ARCHIVE_STATUS=1,INT_PUBLISH_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_GALLERY_ID=P_GALARY_ID;

    SELECT "Gallery Archived Successfully";

  END IF;

  

   IF(P_ACTION='P')THEN

    UPDATE t_gallery SET INT_PUBLISH_STATUS=2,INT_ARCHIVE_STATUS=0,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_GALLERY_ID=P_GALARY_ID;

    SELECT "Gallery publish Successfully";

  END IF;

  



  IF(P_ACTION='D')THEN



	UPDATE t_gallery SET BIT_DELETED_FLAG=1 WHERE INT_GALLERY_ID=P_GALARY_ID;      

    SELECT '0';

  END IF;



  IF(P_ACTION='CA')THEN

	SET @P_SQL='SELECT INT_GALLERY_ID, VCH_HEADLINE_E, VCH_HEADLINE_O, INT_CATEGORY_ID,INT_PLUGIN_ID, VCH_THUMB_IMAGE, VCH_LARGE_IMAGE, VCH_DESCRIPTION_E, INT_PUBLISH_STATUS, INT_PREVILIGE_STATUS, INT_APPROVAL_STATUS,DTM_CREATED_ON ,count(INT_CATEGORY_ID) AS RECNO FROM t_gallery WHERE  BIT_DELETED_FLAG=0';



    IF(P_PUBLISH_STATUS>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');

    END IF;



    IF(P_GALARY_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_GALLERY_ID = "'),P_GALARY_ID,'"');

    END IF;



    IF(P_CATEGORY_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

    END IF;



    SET @P_SQL=CONCAT(@P_SQL,' group by INT_CATEGORY_ID ORDER BY DTM_CREATED_ON DESC');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

    END IF;





  IF(P_ACTION='CM')THEN

            SET @P_SQL='SELECT c.INT_CATEGORY_ID, c.VCH_CATEGORY_NAME,c.VCH_CATEGORY_NAME_O, count(g.INT_CATEGORY_ID) AS RECNO, g.VCH_THUMB_IMAGE, g.VCH_LARGE_IMAGE FROM t_gallery g inner join t_gallery_category c on c.INT_CATEGORY_ID=g.INT_CATEGORY_ID WHERE g.BIT_DELETED_FLAG=0 ';

   



    IF(P_TYPEID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_TYPE_ID = "'),P_TYPEID,'"');

    END IF;

 

    SET @P_SQL=CONCAT(@P_SQL,' AND c.INT_PUBLISH_STATUS = 2 AND INT_ARCHIVE_STATUS=0 GROUP BY c.INT_CATEGORY_ID ORDER BY c.VCH_CATEGORY_NAME ASC ');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

    END IF;



  

  IF(P_ACTION = 'AC')THEN

     UPDATE t_gallery SET INT_ARCHIVE_STATUS = 0,DTM_UPDATED_ON = NOW(),INT_UPDATED_BY = P_CREATED_BY WHERE INT_GALLERY_ID=P_GALARY_ID;

	 SELECT "Gallery Activated Successfully";

  END IF;





  IF(P_ACTION='VC') THEN



      SET @P_SQL='SELECT INT_GALLERY_ID, INT_PLUGIN_ID,VCH_HEADLINE_E, INT_TYPE_ID,INT_VIDEO_LINK_TYPE,VCH_URL,VCH_PORTAL_TYPE,VCH_HEADLINE_O, INT_CATEGORY_ID, VCH_THUMB_IMAGE, VCH_LARGE_IMAGE, VCH_DESCRIPTION_E,VCH_DESCRIPTION_O, INT_PUBLISH_STATUS,DTM_CREATED_ON FROM t_gallery WHERE  BIT_DELETED_FLAG=0';



	  IF(P_PUBLISH_STATUS>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');

		END IF;



	  IF(P_GALARY_ID>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_GALLERY_ID = "'),P_GALARY_ID,'"');

		END IF;



	  IF(P_TYPEID>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_TYPE_ID = "'),P_TYPEID,'"');

		END IF;

	  IF(P_PLUGINID>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PLUGIN_ID = "'),P_PLUGINID,'"');

		END IF;

	  IF(P_CATEGORY_ID>0) THEN

	    SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

	  END IF;
      
      IF(P_SCREEN_TYPE>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_SCREEN_TYPE = "'),P_SCREEN_TYPE,'"');

     END IF;



      SET @P_SQL=CONCAT(@P_SQL,'  AND INT_ARCHIVE_STATUS=',P_ARC_STATUS,' ORDER BY DTM_CREATED_ON DESC limit 1');



	PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

       END IF;




/* Action to view gallery and safety concern photo,video in Home page on::23-11-2020 by indrani */

IF(P_ACTION='VHG')THEN
SET @P_SQL='SELECT INT_GALLERY_ID, INT_PLUGIN_ID,VCH_HEADLINE_E, INT_TYPE_ID,INT_VIDEO_LINK_TYPE,VCH_URL,VCH_PORTAL_TYPE,VCH_HEADLINE_O, INT_CATEGORY_ID, VCH_THUMB_IMAGE, VCH_LARGE_IMAGE, VCH_DESCRIPTION_E,VCH_DESCRIPTION_O, INT_PUBLISH_STATUS,DTM_CREATED_ON,INT_SCREEN_TYPE FROM t_gallery WHERE  BIT_DELETED_FLAG=0';

	  IF(P_PUBLISH_STATUS>0) THEN
		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');
		END IF;

	  IF(P_GALARY_ID>0) THEN
		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_GALLERY_ID = "'),P_GALARY_ID,'"');
		END IF;

	  IF(P_TYPEID>0) THEN
		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_TYPE_ID = "'),P_TYPEID,'"');
		END IF;

	  IF(P_PLUGINID>0) THEN
		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PLUGIN_ID = "'),P_PLUGINID,'"');
		END IF;

	  IF(P_CATEGORY_ID>0) THEN
	    SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');
	  END IF;
      
	  IF(P_SCREEN_TYPE>0) THEN
        SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_SCREEN_TYPE = "'),P_SCREEN_TYPE,'"');
	  END IF;

      SET @P_SQL=CONCAT(@P_SQL,'  AND INT_ARCHIVE_STATUS=',P_ARC_STATUS,' ORDER BY DTM_CREATED_ON DESC LIMIT 9');

    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT;

END IF;


END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_GALLERY_CATEGORY`
--

DROP PROCEDURE IF EXISTS `USP_GALLERY_CATEGORY`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_GALLERY_CATEGORY`(

  IN  P_ACTION           VARCHAR(3),

  IN  P_CATEGORY_ID      INT,

  IN  P_CATEGORY_TYPE    INT,

  IN  P_PLUGIN_TYPE      INT,

  IN  P_CATEGORY_NAME    VARCHAR(128),

  IN  P_CATEGORY_NAME_O  TEXT CHARSET utf8,

  IN  P_DESCRIPTION      VARCHAR(512),

  IN  P_DESCRIPTION_O    TEXT CHARSET utf8,

  IN  P_PUB_STATUS       INT,

  IN  P_CREATED_BY       INT,

  OUT P_OUT              VARCHAR(256)

)
BEGIN



  IF(P_ACTION='CD')THEN

    SET @P_SQL=CONCAT('SELECT VCH_CATEGORY_NAME FROM t_gallery_category WHERE BIT_DELETED_FLAG=0 AND VCH_CATEGORY_NAME="',P_CATEGORY_NAME,'"');



    IF(P_CATEGORY_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_CATEGORY_ID!=',P_CATEGORY_ID);

    END IF;



    IF(P_CATEGORY_TYPE>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_TYPE =',P_CATEGORY_TYPE);

    END IF;



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



  END IF;



  IF(P_ACTION='A')THEN

    INSERT INTO t_gallery_category (VCH_CATEGORY_NAME)

    VALUES(P_CATEGORY_NAME);

    SELECT "Category Added Successfully";

  END IF;





  IF(P_ACTION='U')THEN

    UPDATE t_gallery_category SET VCH_CATEGORY_NAME=P_CATEGORY_NAME,INT_PUBLISH_STATUS=P_PUB_STATUS, INT_UPDATED_BY=P_CREATED_BY,DTM_CREATED_ON=NOW() WHERE  INT_CATEGORY_ID=P_CATEGORY_ID;

    SELECT "Category Updated Successfully";

  END IF;





  IF(P_ACTION='V')THEN

    SET @P_SQL='SELECT INT_TYPE,INT_CATEGORY_ID,INT_PLUGIN_TYPE,VCH_CATEGORY_NAME,VCH_DESCRIPTION,INT_PUBLISH_STATUS,

    INT_CREATED_BY,DTM_CREATED_ON,VCH_CATEGORY_NAME_O,VCH_DESCRIPTION_O,INT_SHOW_HOME FROM t_gallery_category WHERE BIT_DELETED_FLAG=0';



  IF(P_CATEGORY_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

    END IF;



  IF(P_PLUGIN_TYPE>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PLUGIN_TYPE = "'),P_PLUGIN_TYPE,'"');

    END IF;



  IF(P_PUB_STATUS>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUB_STATUS,'"');

  END IF;



  IF(P_CATEGORY_TYPE>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_TYPE =',P_CATEGORY_TYPE);

    END IF;



  SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON DESC');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;





  IF(P_ACTION='RA') THEN



      SET @P_SQL='SELECT INT_TYPE,INT_CATEGORY_ID,INT_PLUGIN_TYPE,VCH_CATEGORY_NAME,VCH_DESCRIPTION,INT_PUBLISH_STATUS,

    INT_CREATED_BY,DTM_CREATED_ON,VCH_CATEGORY_NAME_O,VCH_DESCRIPTION_O,INT_SHOW_HOME FROM t_gallery_category WHERE BIT_DELETED_FLAG=0';



    IF(P_CATEGORY_TYPE>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_TYPE = "'),P_CATEGORY_TYPE,'"');

    END IF;





     SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON DESC  limit 0 ,1');



     PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



    END IF;



 IF(P_ACTION='RAV') THEN



     select distinct(INT_TYPE) from t_gallery_category;



 END IF;







  IF(P_ACTION='PG')THEN

    SET @START_REC=P_CATEGORY_ID;

    SET @P_SQL='SELECT INT_TYPE,INT_PLUGIN_TYPE,INT_CATEGORY_ID,VCH_CATEGORY_NAME,VCH_DESCRIPTION,INT_PUBLISH_STATUS,

    INT_CREATED_BY,DTM_CREATED_ON,VCH_CATEGORY_NAME_O,VCH_DESCRIPTION_O,INT_SHOW_HOME FROM t_gallery_category WHERE BIT_DELETED_FLAG=0';



  IF(P_CATEGORY_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

    END IF;



  IF(P_PUB_STATUS>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUB_STATUS,'"');

  END IF;

  IF(P_PLUGIN_TYPE>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PLUGIN_TYPE = "'),P_PLUGIN_TYPE,'"');

    END IF;



   IF(P_CATEGORY_TYPE>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_TYPE =',P_CATEGORY_TYPE);

    END IF;



  SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON DESC LIMIT ?,20');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT USING @START_REC;

  END IF;





  IF(P_ACTION='R')THEN

    SET @P_SQL='SELECT INT_TYPE,INT_CATEGORY_ID,INT_PLUGIN_TYPE,VCH_CATEGORY_NAME,VCH_DESCRIPTION,INT_PUBLISH_STATUS,

    INT_CREATED_BY,DTM_CREATED_ON,VCH_CATEGORY_NAME_O,VCH_DESCRIPTION_O FROM t_gallery_category WHERE BIT_DELETED_FLAG=0';



    IF(P_CATEGORY_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

    END IF;



    IF(P_CATEGORY_TYPE>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_TYPE =',P_CATEGORY_TYPE);

    END IF;



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;



  IF(P_ACTION='AC')THEN

    UPDATE t_gallery_category SET INT_PUBLISH_STATUS=2,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

    WHERE  INT_CATEGORY_ID=P_CATEGORY_ID;

    SELECT 'Category Activated Successfully';

  END IF;



  IF(P_ACTION='IN')THEN

    UPDATE t_gallery_category SET INT_PUBLISH_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

    WHERE  INT_CATEGORY_ID=P_CATEGORY_ID;

     SELECT 'Category UnPublished Successfully';

  END IF;





  IF(P_ACTION='D')THEN



    SET @CATEGORY_NAME  = (SELECT VCH_CATEGORY_NAME FROM t_gallery_category WHERE BIT_DELETED_FLAG=0 AND INT_CATEGORY_ID=P_CATEGORY_ID);



    IF((SELECT COUNT(1) FROM t_gallery WHERE BIT_DELETED_FLAG=0 AND INT_CATEGORY_ID=P_CATEGORY_ID)=0)THEN

      UPDATE t_gallery_category SET BIT_DELETED_FLAG=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_CATEGORY_ID=P_CATEGORY_ID;

      SET P_OUT= "0";

      SELECT P_OUT;

    ELSE

      SET P_OUT= @CATEGORY_NAME;

      SELECT P_OUT;

    END IF;



  END IF;



	IF(P_ACTION='F')THEN

		 SET @P_SQL= 'select distinct INT_PLUGIN_TYPE from t_gallery_category where BIT_DELETED_FLAG=0 and INT_PUBLISH_STATUS = 2';





    IF(P_CATEGORY_TYPE>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_TYPE =',P_CATEGORY_TYPE);

    END IF;

    IF(P_PLUGIN_TYPE>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PLUGIN_TYPE = "'),P_PLUGIN_TYPE,'"');

    END IF;



     SET @P_SQL=CONCAT(@P_SQL,' ORDER BY VCH_CATEGORY_NAME ASC');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;









	IF(P_ACTION='FA')THEN

		 SET @P_SQL='SELECT INT_TYPE,INT_CATEGORY_ID,INT_PLUGIN_TYPE,VCH_CATEGORY_NAME,VCH_DESCRIPTION,INT_PUBLISH_STATUS,

    INT_CREATED_BY,DTM_CREATED_ON,VCH_CATEGORY_NAME_O,VCH_DESCRIPTION_O FROM t_gallery_category WHERE BIT_DELETED_FLAG=0 and  INT_PUBLISH_STATUS = 2';





    IF(P_CATEGORY_TYPE>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_TYPE =',P_CATEGORY_TYPE);

    END IF;





     SET @P_SQL=CONCAT(@P_SQL,' ORDER BY VCH_CATEGORY_NAME ASC');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;



















	IF(P_ACTION='FM')THEN

SET @START_REC=P_CATEGORY_ID;

		 SET @P_SQL='SELECT INT_TYPE,INT_CATEGORY_ID,VCH_CATEGORY_NAME,VCH_CATEGORY_NAME_O,DTM_CREATED_ON,

     (SELECT a.VCH_LARGE_IMAGE FROM t_gallery a WHERE a.INT_CATEGORY_ID = b.INT_CATEGORY_ID

     ORDER BY DTM_CREATED_ON DESC LIMIT 1) AS albumPhoto,

     (SELECT COUNT(1) FROM t_gallery a WHERE a.INT_CATEGORY_ID = b.INT_CATEGORY_ID

     ) AS totalGallery FROM t_gallery_category b

     WHERE BIT_DELETED_FLAG=0 AND INT_PUBLISH_STATUS = 2';





    IF(P_CATEGORY_TYPE>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_TYPE =',P_CATEGORY_TYPE);

    END IF;



     SET @P_SQL=CONCAT(@P_SQL,' ORDER BY VCH_CATEGORY_NAME LIMIT ?,',P_CATEGORY_NAME);



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT USING @START_REC;

  END IF;









END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_HOMEPAGE`
--

DROP PROCEDURE IF EXISTS `USP_HOMEPAGE`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_HOMEPAGE`(

  IN P_ACTION             VARCHAR(3),
  IN P_GALARY_ID          INT,
  IN P_STRATTR1           VARCHAR(256),
  IN P_STRATTR2           VARCHAR(256),
  IN P_INTATTR1           INT,
  IN P_INTATTR2           INT,
  IN P_INTATTR3           INT,
  IN P_INTATTR4           INT,
  IN P_PUBLISH_STATUS     INT,
  IN P_ARC_STATUS         INT,
  IN P_CREATED_BY         INT,
  OUT P_OUT               VARCHAR(256)
)
BEGIN

/* Procedure: USP_HOMEPAGE Created on::18-11-2020 by indrani */

/* Acton For get Gallary images and video for home page gallary section on::18-11-2020 */
IF(P_ACTION='VG') THEN

      SET @P_SQL='SELECT INT_GALLERY_ID, INT_PLUGIN_ID,VCH_HEADLINE_E, INT_TYPE_ID,INT_VIDEO_LINK_TYPE,VCH_URL,VCH_PORTAL_TYPE,VCH_HEADLINE_O, INT_CATEGORY_ID, VCH_THUMB_IMAGE, VCH_LARGE_IMAGE, VCH_DESCRIPTION_E,VCH_DESCRIPTION_O, INT_PUBLISH_STATUS,DTM_CREATED_ON FROM t_gallery WHERE  BIT_DELETED_FLAG=0';

	  IF(P_PUBLISH_STATUS>0) THEN
		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');
	  END IF;
       SET @P_SQL=CONCAT(@P_SQL,'  AND INT_ARCHIVE_STATUS=',P_ARC_STATUS,' ORDER BY DTM_CREATED_ON DESC limit 9');

   PREPARE STMT FROM @P_SQL;
      EXECUTE STMT;
END IF; 

/* Action for get Notification for home page marquee secion on::20-11-2020 */
IF(P_ACTION='VN')THEN
     SET @P_SQL='SELECT N.DTM_NOTICE_START,N.INT_LINK_TYPE,N.INT_URL_TYPE,N.INT_WIN_STATUS,N.INT_TEMPLATE_TYPE,N.INT_PLUGIN_ID,N.VCH_URL,N.VCH_CODE,N.INT_NOTIFICATION_ID,N.INT_BLINK_STATUS, N.VCH_HEADLINE,N.VCH_HEADLINE_O,N.VCH_DETAILE,N.VCH_DETAILO, N.VCH_DOCUMENT, N.INT_PUBLISH_STATUS, N.DTM_CREATED_ON, N.INT_CREATED_BY,
     N.DTM_UPDATED_ON, N.INT_UPDATED_BY, N.INT_SLNO ,  N.INT_PLUGIN_TYPE, N.DTM_NOTIFICATION_DATE, N.INT_ARC_STATUS,(SELECT C.vchCirculaName FROM m_circular_master C WHERE C.bitDeleteflag=0 and  C.intCircularId=1 and C.intmId = N.INT_PLUGIN_TYPE) AS sectorName FROM t_notification N WHERE N.BIT_DELETED_FLAG=0';

  IF(P_INTATTR1>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_LINK_TYPE = "'),P_INTATTR1,'"');
    END IF;

  IF(P_ARC_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_ARC_STATUS = "'),P_ARC_STATUS,'"');
  END IF;
  
  IF(P_PUBLISH_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');
  END IF;

 SET @P_SQL=CONCAT(@P_SQL,' ORDER BY N.DTM_NOTICE_START DESC, N.VCH_CODE DESC ');

	PREPARE STMT FROM @P_SQL;
	EXECUTE STMT;
  END IF;       
END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_IMPSERVICE_CATEGORY`
--

DROP PROCEDURE IF EXISTS `USP_IMPSERVICE_CATEGORY`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_IMPSERVICE_CATEGORY`(
  IN  P_ACTION           VARCHAR(3),
  IN  P_CATEGORY_ID      INT,
  IN  P_CATEGORY_TYPE    INT,
  IN  P_PLUGIN_TYPE      INT,
  IN  P_CATEGORY_NAME    VARCHAR(128),
  IN  P_CATEGORY_NAME_O  TEXT CHARSET utf8,
  IN  P_DESCRIPTION      VARCHAR(512),
  IN  P_DESCRIPTION_O    TEXT CHARSET utf8,
  IN  P_PUB_STATUS       INT,
  IN  P_CREATED_BY       INT,
  OUT P_OUT              VARCHAR(256)
)
BEGIN

  IF(P_ACTION='CD')THEN
    SET @P_SQL=CONCAT('SELECT vchService FROM m_service_category WHERE bitDeleteflag=0 AND vchService="',P_CATEGORY_NAME,'"');

    IF(P_CATEGORY_ID>0)THEN
      SET @P_SQL=CONCAT(@P_SQL,' AND intCatId!=',P_CATEGORY_ID);
    END IF;

    IF(P_CATEGORY_TYPE>0)THEN
      SET @P_SQL=CONCAT(@P_SQL,' AND INT_TYPE =',P_CATEGORY_TYPE);
    END IF;

    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT;

  END IF;

  IF(P_ACTION='A')THEN
    INSERT INTO m_service_category (INT_TYPE,INT_PLUGIN_TYPE,vchService,VCH_CATEGORY_NAME_O,INT_PUBLISH_STATUS,INT_CREATED_BY)
    VALUES(P_CATEGORY_TYPE,P_PLUGIN_TYPE,P_CATEGORY_NAME,P_CATEGORY_NAME_O,P_PUB_STATUS,P_CREATED_BY);
    SELECT "Category Added Successfully";
  END IF;


  IF(P_ACTION='U')THEN
    UPDATE m_service_category SET INT_TYPE=P_CATEGORY_TYPE,INT_PLUGIN_TYPE=P_PLUGIN_TYPE,vchService=P_CATEGORY_NAME,VCH_CATEGORY_NAME_O=P_CATEGORY_NAME_O,INT_PUBLISH_STATUS=P_PUB_STATUS, INT_UPDATED_BY=P_CREATED_BY,DTM_CREATED_ON=NOW() WHERE  intCatId=P_CATEGORY_ID;
    SELECT "Category Updated Successfully";
  END IF;


  IF(P_ACTION='V')THEN
    SET @P_SQL='SELECT INT_TYPE,intCatId,INT_PLUGIN_TYPE,vchService,INT_PUBLISH_STATUS,
    INT_CREATED_BY,DTM_CREATED_ON,VCH_CATEGORY_NAME_O FROM m_service_category WHERE bitDeleteflag=0';

  IF(P_CATEGORY_ID>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND intCatId = "'),P_CATEGORY_ID,'"');
    END IF;

    IF(P_PUB_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUB_STATUS,'"');
  END IF;

  IF(P_CATEGORY_TYPE>0)THEN
      SET @P_SQL=CONCAT(@P_SQL,' AND INT_TYPE =',P_CATEGORY_TYPE);
    END IF;
     IF(P_CATEGORY_NAME!="")THEN
      SET @P_SQL=CONCAT(@P_SQL,' AND vchService ="',P_CATEGORY_NAME,'"');
    END IF;

  SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON DESC');
	
    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT;
  END IF;


  IF(P_ACTION='RA') THEN

      SET @P_SQL='SELECT INT_TYPE,intCatId,INT_PLUGIN_TYPE,vchService,INT_PUBLISH_STATUS,
    INT_CREATED_BY,DTM_CREATED_ON,VCH_CATEGORY_NAME_O FROM m_service_category WHERE bitDeleteflag=0';

    IF(P_CATEGORY_TYPE>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_TYPE = "'),P_CATEGORY_TYPE,'"');
    END IF;


     SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON DESC  limit 0 ,1');

     PREPARE STMT FROM @P_SQL;
    EXECUTE STMT;

    END IF;

 IF(P_ACTION='RAV') THEN

     select distinct(INT_TYPE) from m_service_category;

 END IF;



  IF(P_ACTION='PG')THEN
    SET @START_REC=P_CATEGORY_ID;
    SET @P_SQL='SELECT INT_TYPE,INT_PLUGIN_TYPE,intCatId,vchService,INT_PUBLISH_STATUS,
    INT_CREATED_BY,DTM_CREATED_ON,VCH_CATEGORY_NAME_O FROM m_service_category WHERE bitDeleteflag=0';

  IF(P_CATEGORY_ID>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND intCatId = "'),P_CATEGORY_ID,'"');
    END IF;

  IF(P_PUB_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUB_STATUS,'"');
  END IF;
 

   IF(P_CATEGORY_TYPE>0)THEN
      SET @P_SQL=CONCAT(@P_SQL,' AND INT_TYPE =',P_CATEGORY_TYPE);
    END IF;
    
 IF(P_CATEGORY_NAME!="")THEN
      SET @P_SQL=CONCAT(@P_SQL,' AND vchService ="',P_CATEGORY_NAME,'"');
    END IF;

  SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON DESC LIMIT ?,20');

    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT USING @START_REC;
  END IF;


  IF(P_ACTION='R')THEN
    SET @P_SQL='SELECT INT_TYPE,intCatId,INT_PLUGIN_TYPE,vchService,INT_PUBLISH_STATUS,
    INT_CREATED_BY,DTM_CREATED_ON,VCH_CATEGORY_NAME_O FROM m_service_category WHERE bitDeleteflag=0';

    IF(P_CATEGORY_ID>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND intCatId = "'),P_CATEGORY_ID,'"');
    END IF;

    IF(P_CATEGORY_TYPE>0)THEN
      SET @P_SQL=CONCAT(@P_SQL,' AND INT_TYPE =',P_CATEGORY_TYPE);
    END IF;

    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT;
  END IF;

  IF(P_ACTION='AC')THEN
    UPDATE m_service_category SET INT_PUBLISH_STATUS=2,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()
    WHERE  intCatId=P_CATEGORY_ID;
    SELECT 'Category Activated Successfully';
  END IF;

  IF(P_ACTION='IN')THEN
    UPDATE m_service_category SET INT_PUBLISH_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()
    WHERE  intCatId=P_CATEGORY_ID;
     SELECT 'Category UnPublished Successfully';
  END IF;


  IF(P_ACTION='D')THEN

	SET @CATEGORY_NAME  = (SELECT vchService FROM m_service_category WHERE bitDeleteflag=0 AND intCatId=P_CATEGORY_ID);
    IF((SELECT COUNT(1) FROM t_services WHERE bitDeletedFlag=0 AND IntCatId=P_CATEGORY_ID)=0)THEN
      UPDATE m_service_category SET bitDeleteflag=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  IntCatId=P_CATEGORY_ID;
      SET P_OUT= "0";
      SELECT P_OUT;
    ELSE
      SET P_OUT= @CATEGORY_NAME;
      SELECT P_OUT;
    END IF;
    
    

  END IF;

	IF(P_ACTION='F')THEN
		 SET @P_SQL= 'select distinct INT_PLUGIN_TYPE from m_service_category where bitDeleteflag=0 and INT_PUBLISH_STATUS = 2';


    IF(P_CATEGORY_TYPE>0)THEN
      SET @P_SQL=CONCAT(@P_SQL,' AND INT_TYPE =',P_CATEGORY_TYPE);
    END IF;
    IF(P_PLUGIN_TYPE>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PLUGIN_TYPE = "'),P_PLUGIN_TYPE,'"');
    END IF;

     SET @P_SQL=CONCAT(@P_SQL,' ORDER BY VCH_CATEGORY_NAME ASC');

    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT;
  END IF;




	IF(P_ACTION='FA')THEN
		 SET @P_SQL='SELECT INT_TYPE,intCatId,INT_PLUGIN_TYPE,vchService,INT_PUBLISH_STATUS,
    INT_CREATED_BY,DTM_CREATED_ON,VCH_CATEGORY_NAME_O FROM m_service_category WHERE bitDeleteflag=0 and  INT_PUBLISH_STATUS = 2';


    IF(P_CATEGORY_TYPE>0)THEN
      SET @P_SQL=CONCAT(@P_SQL,' AND INT_TYPE =',P_CATEGORY_TYPE);
    END IF;


     SET @P_SQL=CONCAT(@P_SQL,' ORDER BY VCH_CATEGORY_NAME ASC');

    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT;
  END IF;









	




END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_IMP_LINK`
--

DROP PROCEDURE IF EXISTS `USP_IMP_LINK`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_IMP_LINK`(

     IN  P_ACTION            VARCHAR(3),

     IN  P_LINK_ID           INT,

     IN  P_LINK_NAME_E       VARCHAR(64),

     IN  P_LINK_NAME_H       VARCHAR(64) CHARSET utf8,

     IN  P_URL               TEXT,

     IN  P_IMAGE             VARCHAR(128),

     IN  P_PUB_STATUS        INT,

     IN  P_ARC_STATUS        INT,

     IN  P_CREATED_BY        INT,

     IN  P_SL_NO             INT,

     IN  P_LINK_TYPE         TINYINT(3),

     IN  P_DOCUMENT          VARCHAR(64),

     OUT P_OUT               VARCHAR(200)

)
BEGIN



IF(P_ACTION='US')THEN

    SET @P_ID  = (SELECT intLinkId FROM t_important_links  WHERE bitDeletedFlag=0 AND intSlNo=P_SL_NO );



    SET @P_SL  = (SELECT intSlNo FROM t_important_links WHERE bitDeletedFlag=0 AND intLinkId=P_LINK_ID );



    UPDATE t_important_links SET intSlNo=@P_SL  WHERE intLinkId=@P_ID;



    UPDATE t_important_links SET intSlNo=P_SL_NO WHERE intLinkId=P_LINK_ID;

    SELECT 'sl no updated Successfully';

  END IF;

 

  IF(P_ACTION='CD')THEN

    SET @P_SQL=CONCAT('SELECT vchLinkNameE  FROM t_important_links WHERE bitDeletedFlag=0  AND tinLinkType= ',P_LINK_TYPE,' AND vchLinkNameE="',P_LINK_NAME_E,'"');



    IF(P_LINK_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND intLinkId!=',P_LINK_ID);

    END IF;



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



  END IF;







  IF(P_ACTION='A')THEN

    INSERT INTO t_important_links (vchLinkNameE,VchLinknameH,vchUrl,vchImage,intCreatedBy,intSlNo,tinLinkType,vchDocument)

    VALUES(P_LINK_NAME_E,P_LINK_NAME_H,P_URL,P_IMAGE,P_CREATED_BY,P_SL_NO,P_LINK_TYPE,P_DOCUMENT);

    SELECT "Important Link Added Successfully";

  END IF;





  IF(P_ACTION='U')THEN

    UPDATE t_important_links SET

    vchLinkNameE      =  P_LINK_NAME_E,

    VchLinknameH      =  P_LINK_NAME_H,

    vchUrl            =  P_URL,

    intUpdatedBy      =  P_CREATED_BY,

    vchImage          =  P_IMAGE,

    intSlNo           =  P_SL_NO,

    tinLinkType       =  P_LINK_TYPE,

    vchDocument       =  P_DOCUMENT,

    dtmUpdatedOn    =  NOW()

     WHERE intLinkId=P_LINK_ID;

    SELECT "Important Link Updated Successfully";

  END IF;





  IF(P_ACTION='R')THEN

    SELECT vchLinkNameE,VchLinknameH,vchUrl,vchImage,intCreatedBy,intSlNo,tinLinkType,vchDocument FROM t_important_links WHERE intLinkId=P_LINK_ID;

  END IF;



    IF(P_ACTION='IN')THEN



    UPDATE t_important_links SET tinPublishStatus=1,intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW() WHERE intLinkId=P_LINK_ID;

    SELECT 'Important Link Inactivated Successfully';



  END IF;



  IF(P_ACTION='AC')THEN



    UPDATE t_important_links SET tinPublishStatus=1,tinArcStatus=0,intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW() WHERE intLinkId=P_LINK_ID;

    SELECT 'Important Link Activated Successfully';



  END IF;

  IF(P_ACTION='P')THEN



    UPDATE t_important_links SET tinPublishStatus=2,tinArcStatus=0,intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW() WHERE intLinkId=P_LINK_ID;

    SELECT 'Important Link published Successfully';



  END IF;

  IF(P_ACTION='AR')THEN



    UPDATE t_important_links SET tinArcStatus=1,tinPublishStatus=1,intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW() WHERE intLinkId=P_LINK_ID;

    SELECT 'Important Link Activated Successfully';



  END IF;

   IF(P_ACTION='D')THEN

    UPDATE t_important_links SET bitDeletedFlag=1 WHERE intLinkId=P_LINK_ID;

    select 0;



  END IF;



    IF(P_ACTION='V') THEN



      SET @P_SQL='SELECT intLinkId,vchLinkNameE,VchLinknameH,vchUrl,vchImage,intCreatedBy,intSlNo,stmCreatedOn,tinPublishStatus,tinLinkType,vchDocument FROM t_important_links WHERE bitDeletedFlag=0';



    IF(P_LINK_TYPE>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND tinLinkType=',P_LINK_TYPE);

    END IF;



    IF(CHAR_LENGTH(P_LINK_NAME_E)>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND vchLinkNameE LIKE "%',P_LINK_NAME_E,'%"');

    END IF;



    IF(P_PUB_STATUS>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND tinPublishStatus=',P_PUB_STATUS);

    END IF;







    SET @P_SQL=CONCAT(@P_SQL,' AND tinArcStatus = ',P_ARC_STATUS,' ORDER BY stmCreatedOn DESC ');

   PREPARE STMT FROM @P_SQL;

        EXECUTE STMT;

    END IF;



    IF(P_ACTION='PG') THEN

      SET @START_REC=P_LINK_ID;

       SET @P_SQL='SELECT intLinkId,vchLinkNameE,VchLinknameH,vchUrl,vchImage,intSlNo,intCreatedBy,stmCreatedOn,tinPublishStatus,tinLinkType,vchDocument FROM t_important_links WHERE bitDeletedFlag=0';



    IF(P_LINK_TYPE>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND tinLinkType=',P_LINK_TYPE);

    END IF;



    IF(CHAR_LENGTH(P_LINK_NAME_E)>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND vchLinkNameE LIKE "%',P_LINK_NAME_E,'%"');

    END IF;



    IF(P_PUB_STATUS>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND tinPublishStatus=',P_PUB_STATUS);

    END IF;







    SET @P_SQL=CONCAT(@P_SQL,' AND tinArcStatus = ',P_ARC_STATUS,' ORDER BY stmCreatedOn DESC LIMIT ?,10');



       PREPARE STMT FROM @P_SQL;

      EXECUTE STMT USING @START_REC;

     

    END IF;







END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_IMP_SERVICES`
--

DROP PROCEDURE IF EXISTS `USP_IMP_SERVICES`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_IMP_SERVICES`(
  IN  P_ACTION            VARCHAR(3),

  IN  P_SERVICE_ID   INT,

  IN  P_CAT_ID       INT,

  IN  P_LINK_TYPE       SMALLINT(2),

  IN  P_TEMPLATE_TYPE   SMALLINT(2),

  IN  P_WINDOW_TYPE     SMALLINT(2),

  IN  P_PLUGIN_ID        SMALLINT(2),

  IN  P_SERVICE_NAME_E     VARCHAR(64),

  IN  P_SERVICE_NAME_O     VARCHAR(64),

  IN  P_URL                VARCHAR(128),

  IN  P_DOCUMENT           VARCHAR(45),

  IN  P_DETAIL_E          TEXT CHARSET utf8,

  IN  P_DETAIL_O          TEXT CHARSET utf8,

  IN  P_CREATED_BY        INT,

  IN  P_PUB_STATUS        INT,

  IN  P_ARC_STATUS        INT,
  IN  P_IMG           VARCHAR(100),

  OUT P_OUT               VARCHAR(256)

)
BEGIN       

   IF(P_ACTION='CD') THEN
   
      SET @P_SQL= CONCAT('SELECT vchServiceNameE FROM t_services WHERE bitDeletedFlag=0  AND vchServiceNameE="',P_SERVICE_NAME_E,'"' );
      
      IF(P_SERVICE_ID>0)THEN
        SET @P_SQL=CONCAT(@P_SQL,' AND intServiceId!=',P_SERVICE_ID);
      END IF;

      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;

  END IF;

  

IF(P_ACTION='A')THEN
	SET @P_STATUS=0;
    SET @P_COUNT =(SELECT COUNT(1) FROM t_services WHERE bitDeletedFlag=0 AND vchServiceNameE=P_SERVICE_NAME_E);
       
    IF(@P_COUNT >0) THEN
    
		SET @P_STATUS=1;
		select  @P_STATUS;
    ELSE IF(@P_COUNT=0) THEN

		INSERT INTO t_services (intCatId,intLinkType,intTemplateType,intWindowStatus,intPluginId,vchServiceNameE,vchServiceNameO,vchUrl,vchDocument,vchDetailE,vchDetailO,intCreatedBy,intUpdatedBy,intPublishStatus,intArcStatus,vchimage)

		VALUES(P_CAT_ID,P_LINK_TYPE,P_TEMPLATE_TYPE,P_WINDOW_TYPE,P_PLUGIN_ID,P_SERVICE_NAME_E,P_SERVICE_NAME_O,P_URL,P_DOCUMENT,P_DETAIL_E,P_DETAIL_O,P_CREATED_BY,P_CREATED_BY,P_PUB_STATUS,P_ARC_STATUS,P_IMG);

		SET @P_STATUS =2;

		select  @P_STATUS;

	END IF;

  END IF;

END IF;



IF(P_ACTION='U')THEN
    SET @P_STATUS=0;

       SET @P_COUNT =(SELECT COUNT(1) FROM t_services WHERE bitDeletedFlag=0 AND vchServiceNameE=P_SERVICE_NAME_E AND intServiceId!=P_SERVICE_ID);
       
    IF(@P_COUNT >0) THEN
		SET @P_STATUS=1;

		select  @P_STATUS;
    ELSE IF(@P_COUNT=0) THEN

		UPDATE t_services SET

		intLinkType          =  P_LINK_TYPE,

	   intTemplateType       =  P_TEMPLATE_TYPE,

	   intWindowStatus       =  P_WINDOW_TYPE,

	   intPluginId           =  P_PLUGIN_ID,

		vchServiceNameE      =  P_SERVICE_NAME_E,

		vchServiceNameO      =  P_SERVICE_NAME_O,

		vchDetailE      =  P_DETAIL_E,

		vchDetailO      =  P_DETAIL_O,

		vchUrl          =   P_URL,

		vchDocument       = P_DOCUMENT,

		intUpdatedBy      =  P_CREATED_BY,

		dtmUpdatedOn      =  NOW(),

		intPublishStatus  =  P_PUB_STATUS,

		intArcStatus        = P_ARC_STATUS,
        vchimage = P_IMG

		 WHERE intServiceId=P_SERVICE_ID;

		  SET @P_STATUS =2;

		  select  @P_STATUS;

      END IF;

      END IF;

  END IF;



  IF(P_ACTION='R')THEN

    SELECT intServiceId,intCatId,intLinkType,intTemplateType,intWindowStatus,intPluginId,vchServiceNameE,vchServiceNameO,vchUrl,vchDetailE,vchDocument,vchDetailO,intCreatedBy,intPublishStatus,intArcStatus,vchimage FROM t_services WHERE intServiceId=P_SERVICE_ID;

  END IF;



    IF(P_ACTION='IN')THEN



    UPDATE t_services SET intPublishStatus=1,intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW() WHERE intServiceId=P_SERVICE_ID;

    SELECT 'Important Services Inactivated Successfully';



  END IF;



  IF(P_ACTION='AC')THEN



    UPDATE t_services SET intArcStatus=0,intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW() WHERE intServiceId=P_SERVICE_ID;

    SELECT 'Important Services Activated Successfully';



  END IF;



  IF(P_ACTION='P')THEN



    UPDATE t_services SET intPublishStatus=2,intArcStatus=0,intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW() WHERE intServiceId=P_SERVICE_ID;

    SELECT 'Important Services published Successfully';



  END IF;

  

  IF(P_ACTION='AR')THEN



    UPDATE t_services SET intArcStatus=1,intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW() WHERE intServiceId=P_SERVICE_ID;

    SELECT 'Important Services Activated Successfully';



  END IF;

   IF(P_ACTION='D')THEN

    UPDATE t_services SET bitDeletedFlag=1 WHERE intServiceId=P_SERVICE_ID;

    select 0;



  END IF;



  IF(P_ACTION='V') THEN



      SET @P_SQL='SELECT * FROM t_services a  WHERE  bitDeletedFlag=0';



    IF(P_PUB_STATUS>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND a.intPublishStatus=',P_PUB_STATUS);

    END IF;

   IF(P_CAT_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND a.intCatId=',P_CAT_ID);

    END IF;

    

     IF(P_SERVICE_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND a.intServiceId=',P_SERVICE_ID);

    END IF;

   IF(CHAR_LENGTH(P_SERVICE_NAME_E)>0)THEN

     SET @P_SQL  = CONCAT(@P_SQL,' AND a.vchServiceNameE LIKE "%',P_SERVICE_NAME_E,'%"');

  END IF;

  



    SET @P_SQL=CONCAT(@P_SQL,' AND a.intArcStatus = ',P_ARC_STATUS,' ORDER BY stmCreatedOn DESC ');

   PREPARE STMT FROM @P_SQL;



    EXECUTE STMT;

        END IF;



    IF(P_ACTION='PG') THEN

      SET @START_REC=P_SERVICE_ID;

       SET @P_SQL='SELECT intServiceId,intCatId,intLinkType,intTemplateType,intWindowStatus,intPluginId,vchServiceNameE,vchServiceNameO,vchUrl,vchDocument,vchDetailE,vchDetailO,intCreatedBy,stmCreatedOn,intPublishStatus,intArcStatus,vchimage FROM t_services  WHERE  bitDeletedFlag=0';



    IF(P_PUB_STATUS>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND intPublishStatus=',P_PUB_STATUS);

    END IF;
    IF(CHAR_LENGTH(P_SERVICE_NAME_E)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND vchServiceNameE LIKE "%'),P_SERVICE_NAME_E,'%"');

    END IF;



  IF(P_CAT_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND intCatId=',P_CAT_ID);

    END IF;

 

    SET @P_SQL=CONCAT(@P_SQL,' AND intArcStatus = ',P_ARC_STATUS,' ORDER BY stmCreatedOn DESC LIMIT ?,10');



	PREPARE STMT FROM @P_SQL;

     EXECUTE STMT USING @START_REC;

       END IF;

    

    

  IF(P_ACTION='VP') THEN



      SET @P_SQL='SELECT * FROM t_services a ,t_function_master b WHERE  a.bitDeletedFlag=0';



    IF(P_PLUGIN_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND a.intPluginId=',P_PLUGIN_ID);

	END IF;

    SET @P_SQL=CONCAT(@P_SQL,' AND a.intPluginId= b.INT_FN_ID ORDER BY stmCreatedOn DESC ');

   PREPARE STMT FROM @P_SQL;



    EXECUTE STMT;

        END IF;



   

END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_LOCATION_MASTER`
--

DROP PROCEDURE IF EXISTS `USP_LOCATION_MASTER`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_LOCATION_MASTER`( 

  IN P_ACTION     VARCHAR(2),

  IN P_LOC_ID     INT,

  IN P_LOC_NAME   VARCHAR(50),

  IN P_LOC_NAME_O TEXT,

  IN P_LOC_DESC   text,
  IN P_LOC_OFFICENO1 VARCHAR(100),
  IN P_LOC_OFFICENO2 VARCHAR(100),
  IN P_LOC_OFFICEEMAIL VARCHAR(100),

  IN P_CREATED_BY INT,

  OUT P_OUT       VARCHAR(200)

)
BEGIN



IF(P_ACTION='C') THEN

      SET @P_SQL= CONCAT(" SELECT VCH_LOCATION FROM m_location_master WHERE BIT_DELETED_FLAG=0 AND VCH_LOCATION='",P_LOC_NAME,"'" );

      IF(P_LOC_ID>0)THEN

        SET @P_SQL=CONCAT(@P_SQL," AND INT_LOCATION_ID!=",P_LOC_ID);

      END IF;

      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;

    END IF;

    IF(P_ACTION='A') THEN 
    
		INSERT INTO m_location_master (VCH_LOCATION,TXT_LOCATION_O,VCH_DESCRIPTION,VCH_OFFICE_NO1,VCH_OFFICE_NO2,VCH_OFFICE_EMAIL,INT_CREATED_BY) VALUES (P_LOC_NAME,P_LOC_NAME_O,P_LOC_DESC,P_LOC_OFFICENO1,P_LOC_OFFICENO2,P_LOC_OFFICEEMAIL,P_CREATED_BY);

      SELECT "Location Details Added successfully";



    END IF;



    IF(P_ACTION='U') THEN 
      UPDATE m_location_master SET VCH_LOCATION=P_LOC_NAME,TXT_LOCATION_O=P_LOC_NAME_O,VCH_DESCRIPTION=P_LOC_DESC,VCH_OFFICE_NO1=P_LOC_OFFICENO1,VCH_OFFICE_NO2=P_LOC_OFFICENO2,VCH_OFFICE_EMAIL=P_LOC_OFFICEEMAIL,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE INT_LOCATION_ID=P_LOC_ID AND BIT_DELETED_FLAG=0;

      SELECT "Location Details Updated   Successfully";
    END IF;



    IF(P_ACTION='V') THEN 
      SELECT INT_LOCATION_ID,VCH_LOCATION,TXT_LOCATION_O,VCH_DESCRIPTION,VCH_OFFICE_NO1,VCH_OFFICE_NO2,VCH_OFFICE_EMAIL, DTM_CREATED_ON,INT_PUBLISH_STATUS  FROM m_location_master WHERE BIT_DELETED_FLAG=0 order by VCH_LOCATION ASC;
    END IF;
    
     IF(P_ACTION='VF') THEN 
      SELECT INT_LOCATION_ID,VCH_LOCATION,TXT_LOCATION_O,VCH_DESCRIPTION,VCH_OFFICE_NO1,VCH_OFFICE_NO2,VCH_OFFICE_EMAIL, DTM_CREATED_ON,INT_PUBLISH_STATUS  FROM m_location_master WHERE BIT_DELETED_FLAG=0 AND INT_PUBLISH_STATUS=2 order by VCH_LOCATION ASC;
    END IF;



    IF(P_ACTION='PG') THEN

      SET @START_REC=P_LOC_ID;

      SET @P_SQL="SELECT INT_LOCATION_ID,VCH_LOCATION,TXT_LOCATION_O,VCH_DESCRIPTION,VCH_OFFICE_NO1,VCH_OFFICE_NO2,VCH_OFFICE_EMAIL, DTM_CREATED_ON,INT_PUBLISH_STATUS FROM m_location_master WHERE BIT_DELETED_FLAG=0";

      SET @P_SQL=CONCAT(@P_SQL," ORDER BY VCH_LOCATION ASC LIMIT ?,10");

      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT USING @START_REC;

    END IF;



    IF(P_ACTION='R') THEN

      SELECT INT_LOCATION_ID,VCH_LOCATION,TXT_LOCATION_O,VCH_DESCRIPTION,VCH_OFFICE_NO1,VCH_OFFICE_NO2,VCH_OFFICE_EMAIL  FROM m_location_master WHERE INT_LOCATION_ID=P_LOC_ID AND BIT_DELETED_FLAG=0;

    END IF;



  IF(P_ACTION='D')THEN
      UPDATE m_location_master SET BIT_DELETED_FLAG=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_LOCATION_ID=P_LOC_ID;

      SET P_OUT= "0";

      SELECT P_OUT;
  END IF;
  
  IF(P_ACTION='IN')THEN

    UPDATE m_location_master SET INT_PUBLISH_STATUS=0,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

    WHERE  INT_LOCATION_ID=P_LOC_ID;
    
    SELECT "Location UnPublished Successfully";

  END IF;
  
  IF(P_ACTION='P')THEN

    UPDATE m_location_master SET INT_PUBLISH_STATUS=2,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

    WHERE  INT_LOCATION_ID=P_LOC_ID;
    
    SELECT "Location UnPublished Successfully";

  END IF;


END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_MANAGE_LOGO`
--

DROP PROCEDURE IF EXISTS `USP_MANAGE_LOGO`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_MANAGE_LOGO`(

    IN   P_ACTION            VARCHAR(2),

    IN   P_LOGO_ID           INT,

    IN   P_LOGO_TITLE        VARCHAR(50),

    IN   P_LOGO_TITLE_O      TEXT CHARSET utf8,

    IN   P_IMAGE             VARCHAR(50),

    IN   P_IMAGE_H             VARCHAR(50),

    IN   P_DESCRIPTION       VARCHAR(500),

    IN   P_PUBLISH_STATUS    INT,

    IN   P_PREVILIGE_STATUS  INT,

    IN   P_CREATED_BY        INT,

    IN   P_APPROVAL          INT,

    OUT  P_OUT               VARCHAR(200)



)
BEGIN



IF(P_ACTION = 'UP') THEN



  SELECT INT_LOGO_ID FROM t_manage_logo WHERE BIT_DELETED_FLAG=0;

  END IF;







  IF(P_ACTION='A') THEN



  IF((SELECT COUNT(1) FROM t_manage_logo WHERE BIT_DELETED_FLAG=0)>0)THEN



IF(COUNT > 0) THEN

UPDATE t_manage_logo SET VCH_LOGO_TITLE=P_LOGO_TITLE,VCH_LOGO_TITLE_O=P_LOGO_TITLE_O,VCH_IMAGE=P_IMAGE,VCH_IMAGE_H=P_IMAGE_H,VCH_DESCRIPTION_E=P_DESCRIPTION,INT_PUBLISH_STATUS=P_PUBLISH_STATUS,INT_PREVILIGE_STATUS=P_PREVILIGE_STATUS,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE INT_LOGO_ID=P_LOGO_ID AND BIT_DELETED_FLAG=0;

SELECT "Logo Updated Sucessfully";

  END IF;



  ELSE

    INSERT INTO t_manage_logo (INT_LOGO_ID,VCH_LOGO_TITLE,VCH_LOGO_TITLE_O,VCH_IMAGE,VCH_IMAGE_H,VCH_DESCRIPTION_E,INT_PUBLISH_STATUS,INT_PREVILIGE_STATUS,INT_CREATED_BY,INT_APPROVAL_STATUS)

    VALUES

    (P_LOGO_ID,P_LOGO_TITLE,P_LOGO_TITLE_O,P_IMAGE,P_IMAGE_H,P_DESCRIPTION,P_PUBLISH_STATUS,P_PREVILIGE_STATUS,P_CREATED_BY,P_APPROVAL);

    SELECT "Logo Added Sucessfully";

  END IF;

END IF;



  IF(P_ACTION='U')  THEN



  UPDATE t_manage_logo SET VCH_LOGO_TITLE=P_LOGO_TITLE,VCH_LOGO_TITLE_O=P_LOGO_TITLE_O,VCH_IMAGE=P_IMAGE,VCH_IMAGE_H=P_IMAGE_H,VCH_DESCRIPTION_E=P_DESCRIPTION,INT_PUBLISH_STATUS=P_PUBLISH_STATUS,INT_PREVILIGE_STATUS=P_PREVILIGE_STATUS,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE INT_LOGO_ID=P_LOGO_ID AND BIT_DELETED_FLAG=0;

SELECT "Logo Updated Sucessfully";

  END IF;





  IF(P_ACTION='R')  THEN



  SELECT VCH_LOGO_TITLE,VCH_LOGO_TITLE_O,VCH_IMAGE,VCH_IMAGE_H,VCH_DESCRIPTION_E,INT_PUBLISH_STATUS,INT_PREVILIGE_STATUS,INT_CREATED_BY,DTM_CREATED_ON,INT_APPROVAL_STATUS FROM t_manage_logo

  WHERE INT_LOGO_ID=P_LOGO_ID;

  END IF;





  IF(P_ACTION='C') THEN



      SET @P_SQL= CONCAT('SELECT VCH_LOGO_TITLE FROM t_manage_logo WHERE BIT_DELETED_FLAG=0 ');



      IF(P_LOGO_ID>0)THEN

        SET @P_SQL=CONCAT(@P_SQL,' AND INT_LOGO_ID!=',P_LOGO_ID);

      END IF;

      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;

    END IF;



      IF(P_ACTION='CS') THEN



      SET @P_SQL= CONCAT('SELECT VCH_LOGO_TITLE FROM t_manage_logo WHERE BIT_DELETED_FLAG=0 AND INT_PREVILIGE_STATUS="',P_PREVILIGE_STATUS,'"' );



      IF(P_LOGO_ID>0)THEN

        SET @P_SQL=CONCAT(@P_SQL,' AND INT_LOGO_ID!=',P_LOGO_ID);

      END IF;

      IF(P_IMAGE>0)THEN

        SET @P_SQL=CONCAT(@P_SQL,' AND VCH_IMAGE!=',P_IMAGE);

      END IF;

  PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;

    END IF;



  IF(P_ACTION='V') THEN



      SET @P_SQL='SELECT INT_LOGO_ID, VCH_LOGO_TITLE, VCH_LOGO_TITLE_O, VCH_IMAGE,VCH_IMAGE_H, VCH_DESCRIPTION_E, INT_PUBLISH_STATUS, INT_PREVILIGE_STATUS, INT_CREATED_BY,DTM_CREATED_ON,INT_APPROVAL_STATUS FROM t_manage_logo  WHERE  BIT_DELETED_FLAG=0';





    IF(P_APPROVAL>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_APPROVAL_STATUS = "'),P_APPROVAL,'"');

    END IF;



    IF(P_LOGO_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_LOGO_ID = "'),P_LOGO_ID,'"');

    END IF;

    

      SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON DESC');



    PREPARE STMT FROM @P_SQL;



    EXECUTE STMT;

    END IF;







   IF(P_ACTION='PG') THEN

      SET @START_REC=P_LOGO_ID;

      SET @P_SQL='SELECT INT_LOGO_ID, VCH_LOGO_TITLE, VCH_LOGO_TITLE_O, VCH_IMAGE,VCH_IMAGE_H, VCH_DESCRIPTION_E, INT_PUBLISH_STATUS, INT_PREVILIGE_STATUS, INT_CREATED_BY,DTM_CREATED_ON,INT_APPROVAL_STATUS FROM t_manage_logo WHERE  BIT_DELETED_FLAG=0';







    SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON DESC LIMIT ?,20');



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT USING @START_REC;



  END IF;

  



  IF(P_ACTION='IN')THEN

    UPDATE t_manage_logo SET INT_PUBLISH_STATUS=P_PUBLISH_STATUS,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

    WHERE  INT_LOGO_ID=P_LOGO_ID AND BIT_DELETED_FLAG=0 ;

  END IF;



    

     IF(P_ACTION='D')THEN



      UPDATE t_manage_logo SET BIT_DELETED_FLAG=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_LOGO_ID=P_LOGO_ID;

      SELECT "logo Details Deleted Successfully";

     END IF;



   IF(P_ACTION='P')THEN

    UPDATE t_manage_logo SET INT_PUBLISH_STATUS=2,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_LOGO_ID=P_LOGO_ID;

    SELECT "Logo publish Successfully";

  END IF;





  IF(P_ACTION='VA') THEN



      SET @P_SQL='SELECT INT_LOGO_ID, VCH_LOGO_TITLE, VCH_LOGO_TITLE_O, VCH_IMAGE,VCH_IMAGE_H, VCH_DESCRIPTION_E, INT_PUBLISH_STATUS, INT_PREVILIGE_STATUS, INT_CREATED_BY,DTM_CREATED_ON,INT_APPROVAL_STATUS FROM t_manage_logo  WHERE  BIT_DELETED_FLAG=0';





    IF(P_LOGO_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_LOGO_ID = "'),P_LOGO_ID,'"');

    END IF;





    PREPARE STMT FROM @P_SQL;



    EXECUTE STMT;

    END IF;









END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_MENUS`
--

DROP PROCEDURE IF EXISTS `USP_MENUS`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_MENUS`(

  IN  P_ACTION           VARCHAR(3),

  IN  P_ID               INT(10),

  IN  P_PAGE_ID          INT(10),

  IN  P_PARENT_ID        INT(10),

  IN  P_MENU_TYPE        TINYINT(3),

  IN  P_MENU_ORDER       INT(10),

  IN  P_LINK_TYPE        text,

  IN  P_PAGE_NAVIGATION  VARCHAR(100)

)
BEGIN





  IF(P_ACTION = 'PM') THEN



    SET @COUNT = (SELECT COUNT(1) FROM t_menus WHERE  tinMenuType=P_MENU_TYPE);



    IF(@COUNT>0)THEN

        Delete  from t_menus  WHERE  tinMenuType=P_MENU_TYPE;

            SET @P_SQL=CONCAT('INSERT INTO t_menus (intPageId,intParentId,tinMenuType,intMenuOrder,vchPageNavigation) VALUES ',P_LINK_TYPE);

          PREPARE STMT FROM @P_SQL;

          EXECUTE STMT;

      else

      SET @P_SQL=CONCAT('INSERT INTO t_menus (intPageId,intParentId,tinMenuType,intMenuOrder,vchPageNavigation) VALUES ',P_LINK_TYPE);

          PREPARE STMT FROM @P_SQL;

          EXECUTE STMT;

      END IF;



  END IF;









  IF(P_ACTION = 'DP') THEN

    SET @COUNT = (SELECT COUNT(1) FROM t_menus WHERE  intParentId=P_PARENT_ID);

   IF(@COUNT=0)THEN

    DELETE FROM t_menus WHERE intId= P_ID;

    SET @DELETFLAG=1;



   else

    SET @DELETFLAG=0;



   END IF;

    SELECT @DELETFLAG;

  END IF;









  

  IF(P_ACTION = 'A') THEN

    INSERT INTO t_menus(intPageId,intParentId,tinMenuType,intMenuOrder,vchLinkType,vchPageNavigation) VALUES(P_PAGE_ID,P_PARENT_ID,P_MENU_TYPE,

    P_MENU_ORDER,P_LINK_TYPE,P_PAGE_NAVIGATION);

  END IF;



  

  IF(P_ACTION = 'DL') THEN

    DELETE FROM t_menus WHERE vchLinkType = P_LINK_TYPE AND tinMenuType = P_MENU_TYPE AND intParentId = P_PARENT_ID;

  END IF;





  IF(P_ACTION = 'V') THEN

    SET @P_SQL= CONCAT('SELECT a.vchName,a.vchNameO,a.vchTitle,b.intId,b.intPageId,b.intParentId,b.tinMenuType,b.intMenuOrder,b.vchLinkType,

    b.vchPageNavigation FROM t_pages a,t_menus b WHERE a.intPageId = b.intPageId AND a.intPublishStatus = 2 AND a.bitDeletedFlag = 0');



    IF(P_MENU_TYPE>0)THEN

        SET @P_SQL=CONCAT(@P_SQL,' AND b.tinMenuType=',P_MENU_TYPE);

    END IF;



    IF(P_PARENT_ID>0)THEN

        SET @P_SQL=CONCAT(@P_SQL,' AND b.intParentId=',P_PARENT_ID);

    END IF;



    IF(CHAR_LENGTH(P_LINK_TYPE)>0)THEN

        SET @P_SQL=CONCAT(@P_SQL,' AND b.vchLinkType="',P_LINK_TYPE,'"');

    END IF;



    SET @P_SQL=CONCAT(@P_SQL,'  ORDER BY b.intMenuOrder ASC');





    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;













  IF(P_ACTION = 'VM') THEN

    SET @P_SQL= CONCAT('SELECT a.vchTitle,a.vchNameO,b.intId,b.intPageId,b.intParentId,b.tinMenuType,b.intMenuOrder,b.vchLinkType,

    b.vchPageNavigation FROM t_pages a,t_menus b WHERE a.intPageId = b.intPageId AND a.intPublishStatus = 2 AND a.bitDeletedFlag = 0');

    SET @P_SQL=CONCAT(@P_SQL,' AND b.tinMenuType=',P_MENU_TYPE);

    SET @P_SQL=CONCAT(@P_SQL,' AND b.intParentId=',P_PARENT_ID);



    SET @P_SQL=CONCAT(@P_SQL,'  ORDER BY b.intMenuOrder ASC');





    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;







  

  IF(P_ACTION = 'VA') THEN



    SET @P_SQL= CONCAT('SELECT b.intPageId,a.vchTitle,a.vchNameO,b.intId,b.intParentId,b.tinMenuType,b.intMenuOrder,b.vchLinkType,

    b.vchPageNavigation FROM t_pages a,t_menus b WHERE a.intPageId = b.intPageId AND a.intPublishStatus = 2 AND a.bitDeletedFlag = 0');



   



    IF(P_MENU_TYPE>0)THEN

        SET @P_SQL=CONCAT(@P_SQL,' AND b.tinMenuType=',P_MENU_TYPE);

    END IF;



    IF(P_PARENT_ID>0)THEN

        SET @P_SQL=CONCAT(@P_SQL,' AND b.intParentId=',P_PARENT_ID);

    END IF;





    IF(CHAR_LENGTH(P_LINK_TYPE)>0)THEN

        SET @P_SQL=CONCAT(@P_SQL,' AND b.vchLinkType="',P_LINK_TYPE,'"');

    END IF;



    SET @P_SQL=CONCAT(@P_SQL,'  ORDER BY a.vchTitle ASC');





    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;



  IF(P_ACTION = 'D') THEN

    DELETE FROM t_menus WHERE intId= P_ID;

  END IF;











  IF(P_ACTION = 'R') THEN

    SELECT COUNT(1) AS TOTAL FROM t_menus WHERE intParentId= P_PARENT_ID;

  END IF;



  IF(P_ACTION = 'CN') THEN

    SELECT COUNT(1) AS TOTAL FROM t_menus;

  END IF;







  IF(P_ACTION = 'VP') THEN



    SET @P_SQL= 'SELECT a.vchTitle,a.vchName,a.vchNameO,a.vchFeaturedImage,a.vchMetaImage,a.vchSnippet,a.vchUrl,a.vchPluginName,a.intWindowStatus,a.intLinkType,a.intTemplateType,b.intId,b.intPageId,b.intParentId,b.tinMenuType,b.intMenuOrder,b.vchLinkType,b.vchPageNavigation,a.vchLinkImage,

    (SELECT VCH_WEB_LAND_URL FROM t_function_master WHERE INT_FN_ID = a.INT_FUNCTION_ID) AS pageName,

    (SELECT intPageId FROM t_pages WHERE intPageId =intParentId and intTemplateType=3) AS childpageId,

(SELECT intPageId  from t_menus where intParentId= b.intPageId  order by intMenuOrder Asc limit 1)as cildid,a.vchPageAlias

     FROM t_pages a,t_menus b

    WHERE a.intPageId = b.intPageId AND a.intPublishStatus = 2 AND a.bitDeletedFlag = 0 ';



    IF(P_MENU_TYPE>0)THEN



        SET @P_SQL=CONCAT(@P_SQL,' AND b.tinMenuType=',P_MENU_TYPE);



    END IF;

	SET @P_SQL=CONCAT(@P_SQL,' AND b.intParentId=',P_PARENT_ID);
    
    IF(CHAR_LENGTH(P_LINK_TYPE)>0)THEN
    
        SET @P_SQL=CONCAT(@P_SQL,' AND b.vchLinkType="',P_LINK_TYPE,'"');
    END IF;

    SET @P_SQL=CONCAT(@P_SQL,'  ORDER BY b.intMenuOrder ASC');

	#select @P_SQL;

    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;

IF(P_ACTION='VC')THEN





    SET @P_SQL= CONCAT('SELECT a.vchName,a.vchTitle,a.vchFeaturedImage,a.vchSnippet,a.vchMetaImage,a.vchUrl,a.vchPluginName,a.intWindowStatus,a.intLinkType,a.intTemplateType,b.intId,b.intPageId,

    b.intParentId,b.tinMenuType,b.intMenuOrder,b.vchLinkType,b.vchPageNavigation,

    (SELECT VCH_WEB_LAND_URL FROM t_function_master WHERE INT_FN_ID = a.INT_FUNCTION_ID) AS pageName FROM t_pages a,t_menus b

    WHERE a.intPageId = b.intPageId AND a.intPublishStatus = 2 AND a.bitDeletedFlag = 0');



    IF(P_MENU_TYPE>0)THEN



        SET @P_SQL=CONCAT(@P_SQL,' AND b.tinMenuType=',P_MENU_TYPE);



    END IF;



    IF(P_PARENT_ID>0)THEN



        SET @P_SQL=CONCAT(@P_SQL,' AND b.intParentId=',P_PARENT_ID);



    END IF;



    IF(CHAR_LENGTH(P_LINK_TYPE)>0)THEN



        SET @P_SQL=CONCAT(@P_SQL,' AND b.vchLinkType="',P_LINK_TYPE,'"');



    END IF;



    SET @P_SQL=CONCAT(@P_SQL,'  ORDER BY b.intMenuOrder ASC LIMIT 1');





    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



       

    END IF;





IF(P_ACTION = 'F') THEN



    SET @P_SQL= CONCAT('SELECT b.intPageId,a.vchTitle,a.vchMetaImage,b.intId,b.intParentId,b.tinMenuType,b.intMenuOrder,b.vchLinkType,

    b.vchPageNavigation FROM t_pages a,t_menus b WHERE a.intPageId = b.intPageId AND a.intPublishStatus = 2 AND a.bitDeletedFlag = 0');



    IF(P_MENU_TYPE>0)THEN

        SET @P_SQL=CONCAT(@P_SQL,' AND b.tinMenuType=',P_MENU_TYPE);

    END IF;





        SET @P_SQL=CONCAT(@P_SQL,' AND b.intParentId=',P_PARENT_ID);





    IF(CHAR_LENGTH(P_LINK_TYPE)>0)THEN

        SET @P_SQL=CONCAT(@P_SQL,' AND b.vchLinkType="',P_LINK_TYPE,'"');

    END IF;



    SET @P_SQL=CONCAT(@P_SQL,'  ORDER BY b.intMenuOrder  ASC');





    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;











  IF(P_ACTION = 'IM') THEN

    SET @P_SQL= CONCAT('SELECT a.vchName,a.vchNameO,a.vchTitle,a.vchMetaImage,a.intLinkType,a.intTemplateType,a.intWindowStatus,b.intId,b.intPageId,b.intParentId,b.tinMenuType,b.intMenuOrder,b.vchLinkType,a.vchUrl,

     (SELECT VCH_WEB_LAND_URL FROM t_function_master WHERE INT_FN_ID = a.INT_FUNCTION_ID) AS pageName,

    b.vchPageNavigation,a.vchLinkImage,a.vchPageAlias FROM t_pages a,t_menus b WHERE a.intPageId = b.intPageId AND a.intPublishStatus = 2 AND a.bitDeletedFlag = 0 AND b.intParentId=0');



    IF(P_MENU_TYPE>0)THEN

        SET @P_SQL=CONCAT(@P_SQL,' AND b.tinMenuType=',P_MENU_TYPE);

    END IF;

    SET @P_SQL=CONCAT(@P_SQL,'  ORDER BY b.intMenuOrder ASC');





    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;

/* Action for Looking for menu by indrani on::13-11-2020 */
   IF(P_ACTION = 'LKM') THEN
    SET @P_SQL= CONCAT('SELECT a.vchName,a.vchNameO,a.vchTitle,a.vchMetaImage,a.intLinkType,a.intTemplateType,a.intWindowStatus,b.intId,b.intPageId,b.intParentId,b.tinMenuType,b.intMenuOrder,b.vchLinkType,a.vchUrl,
     (SELECT VCH_WEB_LAND_URL FROM t_function_master WHERE INT_FN_ID = a.INT_FUNCTION_ID) AS pageName,
    b.vchPageNavigation,a.vchLinkImage,a.vchPageAlias FROM t_pages a,t_menus b WHERE a.intPageId = b.intPageId AND a.intPublishStatus = 2 AND a.bitDeletedFlag = 0 AND b.intParentId=0');

    IF(P_MENU_TYPE>0)THEN
        SET @P_SQL=CONCAT(@P_SQL,' AND b.tinMenuType=',P_MENU_TYPE);
    END IF;
    SET @P_SQL=CONCAT(@P_SQL,'  ORDER BY b.intMenuOrder ASC');


    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT;
  END IF;

/*Action for draggable looking for first level menu by indrani on::13-01-2021*/
IF(P_ACTION = 'IML') THEN

    SET @P_SQL= CONCAT('SELECT a.vchName,a.vchNameO,a.vchTitle,a.vchMetaImage,a.intLinkType,a.intTemplateType,a.intWindowStatus,b.intId,b.intPageId,b.intParentId,b.tinMenuType,b.intMenuOrder,b.vchLinkType,a.vchUrl,

     (SELECT VCH_WEB_LAND_URL FROM t_function_master WHERE INT_FN_ID = a.INT_FUNCTION_ID) AS pageName,

    b.vchPageNavigation,a.vchLinkImage,a.vchPageAlias FROM t_pages a,t_menus b WHERE a.intPageId = b.intPageId AND a.intPublishStatus = 2 AND a.bitDeletedFlag = 0 AND b.intParentId=0');

    IF(P_MENU_TYPE>0)THEN
        SET @P_SQL=CONCAT(@P_SQL,' AND b.tinMenuType=',P_MENU_TYPE);
    END IF;

    SET @P_SQL=CONCAT(@P_SQL,'  ORDER BY b.intMenuOrder ASC');

    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT;

  END IF;
  
 /*Action to view draggable looking for menu second level by indrani on::13-01-2021*/
 IF(P_ACTION = 'VPL') THEN

    SET @P_SQL= 'SELECT a.vchTitle,a.vchName,a.vchNameO,a.vchFeaturedImage,a.vchMetaImage,a.vchSnippet,a.vchUrl,a.vchPluginName,a.intWindowStatus,a.intLinkType,a.intTemplateType,b.intId,b.intPageId,



    b.intParentId,b.tinMenuType,b.intMenuOrder,b.vchLinkType,b.vchPageNavigation,a.vchLinkImage,

    (SELECT VCH_WEB_LAND_URL FROM t_function_master WHERE INT_FN_ID = a.INT_FUNCTION_ID) AS pageName,

    (SELECT intPageId FROM t_pages WHERE intPageId =intParentId and intTemplateType=3) AS childpageId,

(SELECT intPageId  from t_menus where intParentId= b.intPageId  order by intMenuOrder Asc limit 1)as cildid,a.vchPageAlias

     FROM t_pages a,t_menus b

    WHERE a.intPageId = b.intPageId AND a.intPublishStatus = 2 AND a.bitDeletedFlag = 0 ';

    IF(P_MENU_TYPE>0)THEN
        SET @P_SQL=CONCAT(@P_SQL,' AND b.tinMenuType=',P_MENU_TYPE);
    END IF;

    IF(P_PARENT_ID>0)THEN
        SET @P_SQL=CONCAT(@P_SQL,' AND b.intParentId=',P_PARENT_ID);
    END IF;

    IF(CHAR_LENGTH(P_LINK_TYPE)>0)THEN
        SET @P_SQL=CONCAT(@P_SQL,' AND b.vchLinkType="',P_LINK_TYPE,'"');
    END IF;

    SET @P_SQL=CONCAT(@P_SQL,'  ORDER BY b.intMenuOrder ASC');

    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT;

  END IF;
  
END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_MESSAGE`
--

DROP PROCEDURE IF EXISTS `USP_MESSAGE`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_MESSAGE`(
  IN P_ACTION             VARCHAR(3),
  IN P_ID                 INT,
  IN P_PAGETYPE_ID        INT,
  IN P_CONTENT_E          VARCHAR(640),
  IN P_CONTENT_O          TEXT,
  IN P_PUBLISH_STATUS     INT,
  IN P_ARC_STATUS         INT,
  IN P_CREATED_BY         INT,
  IN P_ATTR1              VARCHAR(256),
  IN P_ATTR2              VARCHAR(256),
  IN P_INTATTR1           INT,
  IN P_INTATTR2           INT,
  OUT P_OUT               VARCHAR(256)
)
BEGIN

/* Procedure Name:USP_MESSAGE 
   Created by :: Indrani
   On :: 23-12-2020
*/

IF(P_ACTION='A')THEN
INSERT INTO t_message (VCH_CONTENT_E,VCH_CONTENT_O,INT_PAGETYPE_ID,DTM_CREATED_ON,INT_CREATED_BY,INT_PUBLISH_STATUS,INT_ARCHIVE_STATUS)
      VALUES (P_CONTENT_E,P_CONTENT_O,P_PAGETYPE_ID,NOW(),P_CREATED_BY,P_PUBLISH_STATUS,P_ARC_STATUS);
      SELECT "Message Added Successfully";
END IF;

IF(P_ACTION='U')THEN
 UPDATE t_message SET VCH_CONTENT_E=P_CONTENT_E,VCH_CONTENT_O=P_CONTENT_O,INT_PAGETYPE_ID=P_PAGETYPE_ID,
		  DTM_UPDATED_ON=NOW(),INT_UPDATED_BY=P_CREATED_BY
	  WHERE INT_ID=P_ID AND BIT_DELETED_FLAG=0;
      SELECT "Message Updated Successfully";
END IF;

IF(P_ACTION='R')THEN
    SELECT INT_ID, VCH_CONTENT_E, VCH_CONTENT_O, INT_PAGETYPE_ID,INT_PUBLISH_STATUS,INT_ARCHIVE_STATUS, INT_CREATED_BY,DTM_CREATED_ON FROM t_message WHERE INT_ID=P_ID AND BIT_DELETED_FLAG=0;
   END IF;
   
IF(P_ACTION='V')THEN
	SET @P_SQL='SELECT INT_ID, VCH_CONTENT_E, VCH_CONTENT_O, INT_PAGETYPE_ID,INT_PUBLISH_STATUS,INT_ARCHIVE_STATUS, INT_CREATED_BY,DTM_CREATED_ON FROM t_message WHERE BIT_DELETED_FLAG=0';
    IF(P_PAGETYPE_ID>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PAGETYPE_ID = "'),P_PAGETYPE_ID,'"');
    END IF;
    IF(P_PUBLISH_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');
    END IF;
    IF(P_ARC_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS = "'),P_ARC_STATUS,'"');
    END IF;
        SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON ASC');

    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT;
END IF;

IF(P_ACTION='PG')THEN
	SET @START_REC=P_ID;
	SET @P_SQL='SELECT INT_ID, VCH_CONTENT_E, VCH_CONTENT_O, INT_PAGETYPE_ID,INT_PUBLISH_STATUS,INT_ARCHIVE_STATUS, INT_CREATED_BY,DTM_CREATED_ON FROM t_message WHERE BIT_DELETED_FLAG=0';
    IF(P_PAGETYPE_ID>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PAGETYPE_ID = "'),P_PAGETYPE_ID,'"');
    END IF;
    IF(P_PUBLISH_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');
    END IF;
    IF(P_ARC_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS = "'),P_ARC_STATUS,'"');
    END IF;

    SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON ASC LIMIT ?,10');

      PREPARE STMT FROM @P_SQL;
      EXECUTE STMT USING @START_REC;
 END IF;
 
 IF(P_ACTION='D')THEN
	UPDATE t_message SET BIT_DELETED_FLAG=1 WHERE INT_ID=P_ID;      
    SELECT '0';
  END IF;
  
 IF(P_ACTION='P')THEN
    UPDATE t_message SET INT_PUBLISH_STATUS=2,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE INT_ID=P_ID;
    SELECT "Message published Successfully";
  END IF;
  
 IF(P_ACTION='IN')THEN
    UPDATE t_message SET INT_PUBLISH_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()
    WHERE INT_ID=P_ID AND BIT_DELETED_FLAG=0 ;
     SELECT "Message Unpublished Successfully";
  END IF;
  
  /*Action to get content message for page by indrani on::24-12-2020*/
  IF(P_ACTION='VM')THEN
	SET @P_SQL='SELECT INT_ID, VCH_CONTENT_E, VCH_CONTENT_O, INT_PAGETYPE_ID,INT_PUBLISH_STATUS,INT_ARCHIVE_STATUS, INT_CREATED_BY,DTM_CREATED_ON FROM t_message WHERE BIT_DELETED_FLAG=0';
    IF(P_PAGETYPE_ID>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PAGETYPE_ID = "'),P_PAGETYPE_ID,'"');
    END IF;
    IF(P_PUBLISH_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUBLISH_STATUS,'"');
    END IF;
    IF(P_ARC_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS = "'),P_ARC_STATUS,'"');
    END IF;
    SET @P_SQL=CONCAT(@P_SQL,' ORDER BY INT_ID DESC LIMIT 1');

    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT;
END IF;

END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_OFFICERS`
--

DROP PROCEDURE IF EXISTS `USP_OFFICERS`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_OFFICERS`(
	IN  P_ACTION           VARCHAR(3),
    IN  P_OFFICER_ID        INT,
    IN  P_OFFICER_CAT_ID        INT,
    IN  P_OFFICER_NAME         VARCHAR(250),
	IN  P_OFFICER_ADDRESS     text,
	IN  P_OFFICE_NO    VARCHAR(50),
	IN  P_RES_NO      VARCHAR(50),
    IN  P_PUB_STATUS       INT,
    IN  P_CREATED_BY       INT,
    IN  P_ORDER_NO       INT,
    OUT P_OUT              VARCHAR(200)
)
BEGIN
	IF(P_ACTION='CD')THEN

		SET @P_SQL=CONCAT('SELECT intOfficerId FROM t_officers WHERE  vchOfficername="',P_OFFICER_NAME,'" AND intCategory=',P_OFFICER_CAT_ID,' and bitDeletedFlag=0 ');

		IF(P_OFFICER_ID>0)THEN
			SET @P_SQL=CONCAT(@P_SQL,' AND intOfficerId!=',P_OFFICER_ID);
		END IF;

		PREPARE STMT FROM @P_SQL;

		EXECUTE STMT;
	END IF;
    
    
     IF(P_ACTION='A')THEN

		INSERT INTO t_officers (intCategory,vchOfficername,txtAddress,vchofficeno,vchResno,intCreatedBy,intOrderno)
		VALUES (P_OFFICER_CAT_ID,P_OFFICER_NAME,P_OFFICER_ADDRESS,P_OFFICE_NO,P_RES_NO,P_CREATED_BY,P_ORDER_NO);

		SELECT "Officer Added Successfully";

	END IF;
    
    IF(P_ACTION='U')THEN

		UPDATE t_officers SET intCategory=P_OFFICER_CAT_ID,vchOfficerName=P_OFFICER_NAME,txtAddress=P_OFFICER_ADDRESS,vchofficeno=P_OFFICE_NO,vchResno=P_RES_NO,intUpdatedBy=P_CREATED_BY,intOrderno=P_ORDER_NO,dtmUpdatedOn=NOW() WHERE intOfficerId=P_OFFICER_ID;
        
		SELECT "Officer Updated Successfully";

	END IF;
    
    
    
    IF(P_ACTION='R')THEN

		SET @P_SQL='SELECT intOfficerId,intCategory,vchOfficername,txtAddress,vchofficeno,vchResno,intOrderno FROM t_officers WHERE bitDeletedFlag=0';
        
		IF(P_OFFICER_ID>0) THEN

		  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND intOfficerId = "'),P_OFFICER_ID,'"');

		END IF;

		PREPARE STMT FROM @P_SQL;

		EXECUTE STMT;

	END IF;
    
    
    IF(P_ACTION='IN')THEN

		UPDATE t_officers SET tinPublishStatus=1,intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW()
		WHERE  intOfficerId=P_OFFICER_ID;

		SELECT "Officer Un-Published Successfully";
	END IF;



	IF(P_ACTION='D')THEN

		DELETE FROM t_officers WHERE  intOfficerId=P_OFFICER_ID;

		SELECT 0;

	END IF;



	IF(P_ACTION='P')THEN

		UPDATE t_officers SET tinPublishStatus=2, intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW()
		WHERE  intOfficerId=P_OFFICER_ID;

		SELECT "Officer Published Successfully";

	END IF;
    
    IF(P_ACTION='V')THEN
    
    SET @P_SQL='SELECT intOfficerId,intCategory,vchOfficername,txtAddress,vchofficeno,vchResno ,tinPublishStatus,stmCreatedOn FROM t_officers WHERE bitDeletedFlag=0';

   IF(CHAR_LENGTH(P_OFFICER_NAME)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND vchOfficerName LIKE "%'),P_OFFICER_NAME,'%"');

    END IF;
    IF(P_PUB_STATUS>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND tinPublishStatus = "'),P_PUB_STATUS,'"');

    END IF;
    IF(P_OFFICER_ID>0) THEN

	  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND intOfficerId = "'),P_OFFICER_ID,'"');

	END IF;

	SET @P_SQL=CONCAT(@P_SQL,' ORDER BY intOrderno ASC');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;





  IF(P_ACTION='PG')THEN

    SET @START_REC=P_OFFICER_ID;

    SET @P_SQL='SELECT intOfficerId,intCategory,vchOfficername,txtAddress,vchofficeno,vchResno ,tinPublishStatus,stmCreatedOn FROM t_officers WHERE bitDeletedFlag=0';

   IF(CHAR_LENGTH(P_OFFICER_NAME)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND vchOfficerName LIKE "%'),P_OFFICER_NAME,'%"');

    END IF;
    IF(P_PUB_STATUS>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND tinPublishStatus = "'),P_PUB_STATUS,'"');

    END IF;
    IF(P_OFFICER_ID>0) THEN

	  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND intOfficerId = "'),P_OFFICER_ID,'"');

	END IF;

      SET @P_SQL=CONCAT(@P_SQL,' ORDER BY intOrderno ASC LIMIT ?,10');


    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT USING @START_REC;

  END IF;

    
    
     IF(P_ACTION='VCW')THEN
    
    SET @P_SQL='SELECT tof.intOfficerId, tof.intCategory, tof.vchOfficername, tof.txtAddress, tof.vchofficeno, tof.vchResno, tof.tinPublishStatus, tof.stmCreatedOn, tc.VCH_CATEGORY_NAME FROM t_officers tof INNER JOIN t_officer_category tc ON (tof.intCategory=tc.INT_CATEGORY_ID  AND tc.BIT_DELETED_FLAG=0)  WHERE tof.bitDeletedFlag=0';

   IF(CHAR_LENGTH(P_OFFICER_NAME)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND tof.vchOfficerName LIKE "%'),P_OFFICER_NAME,'%"');

    END IF;
    IF(P_PUB_STATUS>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND tof.tinPublishStatus = "'),P_PUB_STATUS,'"');

    END IF;
    IF(P_OFFICER_ID>0) THEN

	  SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND tof.intOfficerId = "'),P_OFFICER_ID,'"');

	END IF;

	SET @P_SQL=CONCAT(@P_SQL,' ORDER BY tof.intOrderno ASC');
    
    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;
    DEALLOCATE PREPARE STMT;

  END IF;

END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_OFFICER_CATEGORY`
--

DROP PROCEDURE IF EXISTS `USP_OFFICER_CATEGORY`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_OFFICER_CATEGORY`(

  IN  P_ACTION           VARCHAR(3),
  IN  P_CATEGORY_ID      INT,
  IN  P_CATEGORY_NAME    VARCHAR(128),
  IN  P_DESCRIPTION      VARCHAR(512),
  IN  P_PUB_STATUS       INT,
  IN  P_CREATED_BY       INT,
  IN  P_ORDER_NO       INT,
  OUT P_OUT              VARCHAR(256)

)
BEGIN


  IF(P_ACTION='CD')THEN

	SET @P_SQL=CONCAT('SELECT VCH_CATEGORY_NAME FROM t_officer_category WHERE BIT_DELETED_FLAG=0 AND VCH_CATEGORY_NAME="',P_CATEGORY_NAME,'"');
    
    IF(P_CATEGORY_ID>0)THEN
      SET @P_SQL=CONCAT(@P_SQL,' AND INT_CATEGORY_ID!=',P_CATEGORY_ID);

    END IF;
    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;
    
  END IF;



  IF(P_ACTION='A')THEN

    INSERT INTO t_officer_category (VCH_CATEGORY_NAME,intOrderno)  VALUES(P_CATEGORY_NAME,P_ORDER_NO);

    SELECT "Category Added Successfully";

  END IF;





  IF(P_ACTION='U')THEN

    UPDATE t_officer_category SET VCH_CATEGORY_NAME=P_CATEGORY_NAME,INT_PUBLISH_STATUS=P_PUB_STATUS, INT_UPDATED_BY=P_CREATED_BY,intOrderno=P_ORDER_NO,DTM_CREATED_ON=NOW() WHERE  INT_CATEGORY_ID=P_CATEGORY_ID;

    SELECT "Category Updated Successfully";

  END IF;





  IF(P_ACTION='V')THEN

    SET @P_SQL='SELECT INT_CATEGORY_ID,VCH_CATEGORY_NAME,VCH_DESCRIPTION,INT_PUBLISH_STATUS, INT_CREATED_BY,DTM_CREATED_ON FROM t_officer_category WHERE BIT_DELETED_FLAG=0';


    IF(P_CATEGORY_ID>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');
    END IF;

	IF(P_PUB_STATUS>0) THEN
		SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUB_STATUS,'"');
	END IF;
    
	SET @P_SQL=CONCAT(@P_SQL,' ORDER BY intOrderno ASC');
    
    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;





  IF(P_ACTION='RA') THEN
  
      SET @P_SQL='SELECT INT_CATEGORY_ID,VCH_CATEGORY_NAME,VCH_DESCRIPTION,INT_PUBLISH_STATUS,
    INT_CREATED_BY,DTM_CREATED_ON FROM t_officer_category WHERE BIT_DELETED_FLAG=0';

     SET @P_SQL=CONCAT(@P_SQL,' ORDER BY intOrderno ASC  limit 0 ,1');

     PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



    END IF;






  IF(P_ACTION='PG')THEN

    SET @START_REC=P_CATEGORY_ID;

    SET @P_SQL='SELECT INT_CATEGORY_ID,VCH_CATEGORY_NAME,VCH_DESCRIPTION,INT_PUBLISH_STATUS,
    INT_CREATED_BY,DTM_CREATED_ON FROM  t_officer_category WHERE BIT_DELETED_FLAG=0';



	IF(P_CATEGORY_ID>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');
    END IF;



	IF(P_PUB_STATUS>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUB_STATUS,'"');
	END IF;


	SET @P_SQL=CONCAT(@P_SQL,' ORDER BY intOrderno ASC LIMIT ?,20');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT USING @START_REC;

  END IF;





  IF(P_ACTION='R')THEN

    SET @P_SQL='SELECT INT_CATEGORY_ID,VCH_CATEGORY_NAME,VCH_DESCRIPTION,INT_PUBLISH_STATUS,intOrderno,
    INT_CREATED_BY,DTM_CREATED_ON FROM t_officer_category WHERE BIT_DELETED_FLAG=0';



    IF(P_CATEGORY_ID>0) THEN
      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_CATEGORY_ID = "'),P_CATEGORY_ID,'"');

    END IF;

    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;



  IF(P_ACTION='AC')THEN

    UPDATE t_officer_category SET INT_PUBLISH_STATUS=2,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

    WHERE  INT_CATEGORY_ID=P_CATEGORY_ID;

    SELECT 'Category Activated Successfully';

  END IF;



  IF(P_ACTION='IN')THEN

    UPDATE t_officer_category SET INT_PUBLISH_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

    WHERE  INT_CATEGORY_ID=P_CATEGORY_ID;

     SELECT 'Category UnPublished Successfully';

  END IF;





  IF(P_ACTION='D')THEN

    SET @CATEGORY_NAME  = (SELECT VCH_CATEGORY_NAME FROM t_officer_category WHERE BIT_DELETED_FLAG=0 AND INT_CATEGORY_ID=P_CATEGORY_ID);

    IF((SELECT COUNT(1) FROM t_officers WHERE BIT_DELETED_FLAG=0 AND INT_CATEGORY_ID=P_CATEGORY_ID)=0)THEN

      UPDATE t_officer_category SET BIT_DELETED_FLAG=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_CATEGORY_ID=P_CATEGORY_ID;

      SET P_OUT= "0";

      SELECT P_OUT;

    ELSE

      SET P_OUT= @CATEGORY_NAME;

      SELECT P_OUT;

    END IF;



  END IF;



END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_OFFICER_PROFILE`
--

DROP PROCEDURE IF EXISTS `USP_OFFICER_PROFILE`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_OFFICER_PROFILE`(
    IN P_ACTION           VARCHAR(2),
    IN P_PROFILE_ID       INT,
    IN P_SL_NO            INT,
    IN P_MINISTER_NAME_E  VARCHAR(50),
    IN P_MINISTER_NAME_H  TEXT,
    IN P_DESIGNATION_E    VARCHAR(100),
    IN P_DESIGNATION_H    VARCHAR(100) ,
    IN P_QUALIFICATION_E  VARCHAR(50),
    IN P_QUALIFICATION_H  TEXT,
    IN P_MOBILE_NO        VARCHAR(10),
    IN P_IMAGE            VARCHAR(50),
    IN P_PUBLISH_STATUS   TINYINT(3),
    IN P_ARC_STATUS       TINYINT(3),
    IN P_CREATED_BY       INT,
    IN P_LINK_TYPE        INT,
    IN P_URL              TEXT,
    IN  P_ARC_START_DATE    DATE,
    IN  P_ARC_END_DATE    DATE,
    OUT P_OUT             VARCHAR(200)
 )
BEGIN


  IF(P_ACTION='CD') THEN

      SET @P_SQL= CONCAT('SELECT vchMinisterNameE FROM t_officer_profile WHERE bitDeletedFlag=0  AND vchMinisterNameE="',P_MINISTER_NAME_E,'"' );

      IF(P_PROFILE_ID>0)THEN
        SET @P_SQL=CONCAT(@P_SQL,' AND intProfileId!=',P_PROFILE_ID);
      END IF;

      PREPARE STMT FROM @P_SQL;
      EXECUTE STMT;
  END IF;

  IF(P_ACTION='A') THEN

      INSERT INTO t_officer_profile(vchMinisterNameE,vchMinisterNameH,vchDesignationE,vchDesignationH,vchQulificationE,vchQulificationH,vchMobile,intSlNo,vchImage, intCreatedBy,intLinkType,vchUrl)
      VALUES (P_MINISTER_NAME_E,P_MINISTER_NAME_H,P_DESIGNATION_E,P_DESIGNATION_H,P_QUALIFICATION_E,P_QUALIFICATION_H,P_MOBILE_NO,P_SL_NO,P_IMAGE,P_CREATED_BY,P_LINK_TYPE,P_URL);
      SELECT "Officer Profile Details Added Successfully";

    END IF;

     IF(P_ACTION='U') THEN

      UPDATE t_officer_profile SET
      vchMinisterNameE  =  P_MINISTER_NAME_E,
      vchMinisterNameH  =  P_MINISTER_NAME_H,
      vchDesignationE   =  P_DESIGNATION_E,
      vchDesignationH   =  P_DESIGNATION_H,
      vchQulificationE  =  P_QUALIFICATION_E,
      vchQulificationH  =  P_QUALIFICATION_H,
      vchMobile         =  P_MOBILE_NO,
      intSlNo           =  P_SL_NO,
      vchImage          =  P_IMAGE,
      intUpdatedBy      =  P_CREATED_BY,
      intLinkType       =  P_LINK_TYPE,
      vchUrl            =  P_URL,
      dtmUpdatedOn      =  NOW()
      WHERE
      intProfileId      =  P_PROFILE_ID ;
       SELECT "Officer Profile Details Updated Successfully";

    END IF;

   
    IF(P_ACTION='R') THEN

      SELECT intProfileId,vchMinisterNameE,vchMinisterNameH,vchDesignationE,vchDesignationH,vchQulificationE,vchQulificationH,vchMobile,intSlNo,vchImage,intLinkType,vchUrl FROM t_officer_profile WHERE intProfileId=P_PROFILE_ID AND bitDeletedFlag=0;


    END IF;
   IF(P_ACTION='V') THEN

      SET @P_SQL='SELECT intProfileId,vchMinisterNameE,vchMinisterNameH,vchDesignationE,vchDesignationH,vchQulificationE,vchQulificationH,vchMobile,intSlNo,vchImage,stmCreatedOn,intLinkType,vchUrl,tinPublishStatus FROM t_officer_profile WHERE bitDeletedFlag=0';


    IF(P_PUBLISH_STATUS>0)THEN
      SET @P_SQL=CONCAT(@P_SQL,' AND tinPublishStatus=',P_PUBLISH_STATUS);
    END IF;

    IF(P_ARC_START_DATE!='0000-00-00' and P_ARC_END_DATE='0000-00-00')THEN
        SET @P_SQL  = CONCAT(@P_SQL,' AND date(dtmArchieveOn)>="',P_ARC_START_DATE,'"');
      END IF;

      IF(P_ARC_END_DATE!='0000-00-00' and P_ARC_START_DATE='0000-00-00')THEN
        SET @P_SQL  = CONCAT(@P_SQL,' AND date(dtmArchieveOn)<="',P_ARC_END_DATE,'"');
      END IF;

      IF(P_ARC_END_DATE!='0000-00-00' and P_ARC_START_DATE!='0000-00-00')THEN
        SET @P_SQL  = CONCAT(@P_SQL,' AND date(dtmArchieveOn) BETWEEN "',P_ARC_START_DATE,'" AND "',P_ARC_END_DATE,'"');
      END IF;


    SET @P_SQL=CONCAT(@P_SQL,' AND tinArcStatus = ',P_ARC_STATUS,' ORDER BY intSlNo ASC ');
    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;
    END IF;
    IF(P_ACTION='PG') THEN
      SET @START_REC=P_PROFILE_ID;
      SET @P_SQL='SELECT intProfileId,vchMinisterNameE,vchMinisterNameH,vchDesignationE,vchDesignationH,vchQulificationE,vchQulificationH,vchMobile,intSlNo,vchImage,stmCreatedOn,intLinkType,vchUrl,tinPublishStatus FROM t_officer_profile WHERE bitDeletedFlag=0';

    IF(P_PUBLISH_STATUS>0)THEN
      SET @P_SQL=CONCAT(@P_SQL,' AND tinPublishStatus=',P_PUBLISH_STATUS);
    END IF;
    IF(P_ARC_START_DATE!='0000-00-00' and P_ARC_END_DATE='0000-00-00')THEN
        SET @P_SQL  = CONCAT(@P_SQL,' AND date(dtmArchieveOn)>="',P_ARC_START_DATE,'"');
      END IF;

      IF(P_ARC_END_DATE!='0000-00-00' and P_ARC_START_DATE='0000-00-00')THEN
        SET @P_SQL  = CONCAT(@P_SQL,' AND date(dtmArchieveOn)<="',P_ARC_END_DATE,'"');
      END IF;

      IF(P_ARC_END_DATE!='0000-00-00' and P_ARC_START_DATE!='0000-00-00')THEN
        SET @P_SQL  = CONCAT(@P_SQL,' AND date(dtmArchieveOn) BETWEEN "',P_ARC_START_DATE,'" AND "',P_ARC_END_DATE,'"');
      END IF;


    SET @P_SQL=CONCAT(@P_SQL,' AND tinArcStatus = ',P_ARC_STATUS,' ORDER BY intSlNo ASC LIMIT ?,10');

      PREPARE STMT FROM @P_SQL;
      EXECUTE STMT USING @START_REC;
    END IF;

  IF(P_ACTION='IN')THEN

    UPDATE t_officer_profile SET tinPublishStatus=1,intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW() WHERE intProfileId=P_PROFILE_ID;
    SELECT 'Officer Profile Inactivated Successfully';

  END IF;

  IF(P_ACTION='P')THEN

    UPDATE t_officer_profile SET tinPublishStatus=2,tinArcStatus=0,intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW() WHERE intProfileId=P_PROFILE_ID;
    SELECT 'Officer Profile Published Successfully';

  END IF;
  IF(P_ACTION='AC')THEN

   SET @MAXSL   =  (SELECT MAX(intSlNo) FROM t_officer_profile WHERE bitDeletedFlag=0);
    UPDATE t_officer_profile SET tinPublishStatus=1,tinArcStatus=0,intSlNo=@MAXSL+1,
    intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW(),dtmArchieveOn='0000-00-00' WHERE intProfileId=P_PROFILE_ID;
    SELECT 'Officer Profile Activated Successfully';

  END IF;
  IF(P_ACTION='AR')THEN

     SET @P_SL    = (SELECT intSlNo FROM t_officer_profile WHERE bitDeletedFlag=0 AND intProfileId=P_PROFILE_ID);
     SET @MAXSL   =  (SELECT MAX(intSlNo) FROM t_officer_profile WHERE bitDeletedFlag=0 AND tinArcStatus=0);
    UPDATE t_officer_profile SET tinArcStatus=1,tinPublishStatus=1,intSlNo=0,dtmArchieveOn=NOW(),intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW() WHERE intProfileId=P_PROFILE_ID;

        UPDATE t_officer_profile SET intSlNo=intSlNo-1 where intSlNo>@P_SL;

    SELECT 'Officer Profile Archieved Successfully';

  END IF;
   IF(P_ACTION='D')THEN
    UPDATE t_officer_profile SET bitDeletedFlag=1 WHERE intProfileId=P_PROFILE_ID;
    select 0;

  END IF;


  IF(P_ACTION='US')THEN
    SET @P_ID  = (SELECT intProfileId FROM t_officer_profile  WHERE bitDeletedFlag=0 AND intSlNo=P_SL_NO);

    SET @P_SL  = (SELECT intSlNo FROM t_officer_profile WHERE bitDeletedFlag=0 AND intProfileId=P_PROFILE_ID);

    UPDATE t_officer_profile SET intSlNo=@P_SL  WHERE intProfileId=@P_ID;

    UPDATE t_officer_profile SET intSlNo=P_SL_NO WHERE intProfileId=P_PROFILE_ID;
SELECT 'sl no updated Successfully';
  END IF;

   IF(P_ACTION='S')THEN

        SET @P_SQL='SELECT INT_USER_ID,VCH_FULL_NAME,VCH_QUALIFICATION,VCH_MOBILE_NO,VCH_EMAIL,
        (SELECT D.VCH_DESG_NAME FROM m_admin_desg_master D WHERE
		    D.INT_DESG_ID=U.INT_DESIGNATION_ID AND D.BIT_DELETED_FLAG=0) AS DESIGNATION_NAME
        FROM m_admin_user U WHERE INT_EX_EMPLOYEE=1 AND INT_PRIVILEGE!=0  ';
        IF(P_PROFILE_ID>0)THEN
             SET @P_SQL=CONCAT(@P_SQL,' AND INT_USER_ID=',P_PROFILE_ID);
        END IF;

    SET @P_SQL=CONCAT(@P_SQL,'  ORDER BY VCH_FULL_NAME ASC ');
    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;
    END IF;
  




END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_PAGES`
--

DROP PROCEDURE IF EXISTS `USP_PAGES`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_PAGES`(

  IN  P_ACTION          VARCHAR(3),

  IN  P_PAGE_ID         INT,

  IN  P_PAGE_TITLE       VARCHAR(80),

  IN  P_PAGE_NAME      VARCHAR(80),

  IN  P_PAGE_NAME_O    text charset utf8,

  IN  P_PAGE_ALIAS      VARCHAR(80),

  IN  P_META_TITLE      VARCHAR(50),

  IN  P_META_KEYWARD    VARCHAR(50),

  IN  P_META_DESCRIPTION VARCHAR(500),

  IN  P_META_TYPE       VARCHAR(50),

  IN  P_META_IMAGE      VARCHAR(100),

  IN  P_FEATURED_IMAGE  VARCHAR(268),

  IN  P_LINK_TYPE       SMALLINT(2),

  IN  P_URL             TEXT,

  IN  P_TEMPLATE_TYPE   SMALLINT(2),

  IN  P_PLUGIN_NAME     VARCHAR(100),

  IN  P_WINDOW_TYPE     SMALLINT(2),

  IN  P_PUB_STATUS      SMALLINT(2),

  IN  P_CREATED_BY      INT,

  IN  P_ARC_STATUS      INT,

  IN  P_SNIPPET         TEXT,

  IN  P_FUNC_ID          INT,
  
  IN P_LINK_IMAGE       VARCHAR(264)

)
BEGIN









   IF(P_ACTION='CD') THEN



      SET @P_SQL= CONCAT('SELECT vchTitle FROM t_pages WHERE bitDeletedFlag=0 AND vchPageAlias="',P_PAGE_ALIAS,'"' );



      IF(P_PAGE_ID>0)THEN

        SET @P_SQL=CONCAT(@P_SQL,' AND intPageId!=',P_PAGE_ID);

      END IF;



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;

   END IF;





  IF(P_ACTION='A') THEN



      INSERT INTO t_pages(intPageId,vchTitle,vchName,vchNameO,vchFeaturedImage,intLinkType,vchUrl,intTemplateType,

      vchPluginName,intWindowStatus,intPublishStatus,intCreatedBy,vchPageAlias,vchMetaTitle,vchMetaKeyword,vchMetaDescription,vchMetaType,vchMetaImage,vchSnippet,INT_FUNCTION_ID,vchLinkImage)

      VALUES (P_PAGE_ID,P_PAGE_TITLE,P_PAGE_NAME,P_PAGE_NAME_O,P_FEATURED_IMAGE,P_LINK_TYPE,P_URL,P_TEMPLATE_TYPE,P_PLUGIN_NAME,

      P_WINDOW_TYPE,P_PUB_STATUS,P_CREATED_BY,P_PAGE_ALIAS,P_META_TITLE,P_META_KEYWARD,P_META_DESCRIPTION,P_META_TYPE,P_META_IMAGE,P_SNIPPET,P_FUNC_ID,P_LINK_IMAGE);

      SELECT LAST_INSERT_ID();

  END IF;



  

  IF(P_ACTION='U') THEN



      UPDATE t_pages SET vchTitle=P_PAGE_TITLE,vchName=P_PAGE_NAME,vchNameO=P_PAGE_NAME_O,vchFeaturedImage=P_FEATURED_IMAGE,intLinkType=P_LINK_TYPE,vchUrl=P_URL,

      intTemplateType=P_TEMPLATE_TYPE,vchPluginName=P_PLUGIN_NAME,intWindowStatus=P_WINDOW_TYPE,vchPageAlias=P_PAGE_ALIAS,

      intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW(),vchMetaType=P_META_TYPE,vchMetaImage=P_META_IMAGE,

       vchMetaTitle=P_META_TITLE,vchMetaKeyword=P_META_KEYWARD,vchMetaDescription=P_META_DESCRIPTION,vchSnippet=P_SNIPPET,INT_FUNCTION_ID=P_FUNC_ID,vchLinkImage=P_LINK_IMAGE WHERE intPageId=P_PAGE_ID AND bitDeletedFlag=0;



  END IF;



  

  IF(P_ACTION='R') THEN



      SELECT intPageId,vchTitle,vchName,vchNameO,vchFeaturedImage,intLinkType,vchUrl,intTemplateType,vchPageAlias,vchMetaType,vchMetaImage,

      vchPluginName,intWindowStatus,intPublishStatus,dtmCreatedOn,vchMetaTitle,vchMetaKeyword,vchMetaDescription,vchSnippet,INT_FUNCTION_ID,vchLinkImage FROM t_pages WHERE  bitDeletedFlag=0 AND

      intPageId = P_PAGE_ID;



  END IF;



  

  IF(P_ACTION='V') THEN



      SET @P_SQL='SELECT intPageId,vchTitle,vchName,vchNameO,vchPageAlias,vchMetaTitle,vchSnippet,vchMetaKeyword,vchMetaDescription,vchMetaType,vchMetaImage,vchFeaturedImage,intLinkType,vchUrl,intTemplateType,

      INT_FUNCTION_ID,vchPluginName,intWindowStatus,intPublishStatus,dtmCreatedOn,(SELECT COUNT(1) FROM t_pages_content_e WHERE

      t_pages_content_e.intPageId = t_pages.intPageId) AS TOTAL,vchLinkImage FROM t_pages WHERE  bitDeletedFlag=0';



      IF(CHAR_LENGTH(P_PAGE_TITLE)>0)THEN

				SET @P_SQL	= CONCAT(@P_SQL,' AND vchTitle LIKE "%',P_PAGE_TITLE,'%"');

			END IF;



      IF(P_FUNC_ID >0)THEN

				SET @P_SQL	= CONCAT(@P_SQL,' AND INT_FUNCTION_ID = "',P_FUNC_ID,'"');

			END IF;



      SET @P_SQL=CONCAT(@P_SQL,' AND intArcStatus = ',P_ARC_STATUS,' ORDER BY dtmCreatedOn DESC');



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;



  END IF;



  

  IF(P_ACTION='PG') THEN



      SET @START_REC=P_PAGE_ID;

      SET @P_SQL='SELECT intPageId,vchTitle,vchName,vchNameO,vchPageAlias,vchMetaTitle,vchSnippet,vchMetaKeyword,vchMetaDescription,vchMetaType,vchMetaImage,vchFeaturedImage,intLinkType,vchUrl,intTemplateType,

      vchPluginName,intWindowStatus,intPublishStatus,dtmCreatedOn,INT_FUNCTION_ID,(SELECT COUNT(1) FROM t_pages_content_e WHERE

      t_pages_content_e.intPageId = t_pages.intPageId) AS TOTAL,vchLinkImage FROM t_pages WHERE  bitDeletedFlag=0';



      IF(CHAR_LENGTH(P_PAGE_TITLE)>0)THEN

				SET @P_SQL	= CONCAT(@P_SQL,' AND vchTitle LIKE "%',P_PAGE_TITLE,'%"');

			END IF;





      SET @P_SQL=CONCAT(@P_SQL,' AND intArcStatus = ',P_ARC_STATUS,' ORDER BY dtmCreatedOn DESC LIMIT ?,10');



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT USING @START_REC;



  END IF;



  

  IF(P_ACTION='PL') THEN



      SET @P_SQL='SELECT intPageId,vchTitle,vchName,vchNameO,vchPageAlias,vchMetaTitle,vchMetaKeyword,vchMetaDescription,vchMetaType,vchMetaImage,vchFeaturedImage,intLinkType,vchUrl,intTemplateType,

      vchPluginName,intWindowStatus,dtmCreatedOn,vchSnippet,INT_FUNCTION_ID FROM t_pages WHERE bitDeletedFlag=0 AND intPublishStatus = 2';



      SET @P_SQL=CONCAT(@P_SQL,'  ORDER BY vchTitle ASC');



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;



  END IF;



  IF(P_ACTION='IN')THEN



    UPDATE t_pages SET intPublishStatus=1,intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW() WHERE intPageId=P_PAGE_ID

    AND bitDeletedFlag=0 ;

    SELECT 'Page Inactivated Successfully';

  END IF;





  IF(P_ACTION='P')THEN



    UPDATE t_pages SET intPublishStatus=2,intUpdatedBy=P_CREATED_BY,dtmUpdatedOn=NOW() WHERE intPageId=P_PAGE_ID

    AND bitDeletedFlag=0 ;

    SELECT 'Page published Successfully';



  END IF;



   IF(P_ACTION='AR')THEN

    SET @PG_NAME  = (SELECT vchTitle FROM t_pages WHERE bitDeletedFlag=0 AND intPageId=P_PAGE_ID);

	  SET @PG_COUNT	= (SELECT COUNT(1) FROM t_menus WHERE intPageId=P_PAGE_ID);

    IF(@PG_COUNT=0)THEN

      UPDATE t_pages SET intArcStatus=1,intPublishStatus=1,intUpdatedBy=P_CREATED_BY,dtmArchieveOn=NOW(),dtmUpdatedOn=NOW() WHERE intPageId=P_PAGE_ID;

      select 0;

    ELSE

    select @PG_NAME;

  END IF;

  END IF;



  IF(P_ACTION='AC')THEN



    UPDATE t_pages SET intPublishStatus=1,intArcStatus=0,intUpdatedBy=P_CREATED_BY,dtmArchieveOn='0000-00-00',dtmUpdatedOn=NOW() WHERE intPageId=P_PAGE_ID;

     SELECT 'Page Activated Successfully';

  END IF;



   IF(P_ACTION='D')THEN

    SET @PG_NAME  = (SELECT vchTitle FROM t_pages WHERE bitDeletedFlag=0 AND intPageId=P_PAGE_ID);

	  SET @PG_COUNT	= (SELECT COUNT(1) FROM t_menus WHERE intPageId=P_PAGE_ID);

    IF(@PG_COUNT=0)THEN

    UPDATE t_pages SET bitDeletedFlag=1 WHERE intPageId=P_PAGE_ID;

    select 0;

    ELSE

    select @PG_NAME;

    END IF;



  END IF;



  IF(P_ACTION='VR') THEN

      SELECT intPageId,intPageNo,vchContentE  FROM t_pages_content_e  WHERE intPageId=P_PAGE_ID;



  END IF;

  IF(P_ACTION='VH') THEN

      SELECT t_pages.intPageId,vchTitle,vchName,vchNameO,vchPageAlias,vchMetaTitle,vchSnippet,vchMetaKeyword,vchMetaDescription,vchMetaType,vchMetaImage,vchFeaturedImage,intLinkType,vchUrl,intTemplateType,

      vchPluginName,intWindowStatus,intPublishStatus,dtmCreatedOn,intContentId,intPageNo,vchContentE, (SELECT COUNT(1) FROM t_pages_content_e WHERE

      t_pages_content_e.intPageId = t_pages.intPageId) AS TOTAL FROM t_pages, t_pages_content_e WHERE t_pages_content_e.intPageId = t_pages.intPageId AND t_pages.bitDeletedFlag=0 and t_pages.intPageId=P_PAGE_ID and intPageNo=1;



  END IF;

  IF(P_ACTION='VP') THEN

      SET @P_SQL='SELECT t_pages.intPageId,vchTitle,vchName,vchNameO,vchPageAlias,vchSnippet,vchMetaTitle,vchMetaKeyword,vchMetaDescription,vchMetaType,vchMetaImage,vchFeaturedImage,intLinkType,vchUrl,intTemplateType,

      vchPluginName,intWindowStatus,intPublishStatus,dtmCreatedOn,intContentId,intPageNo,vchContentE FROM t_pages, t_pages_content_e WHERE t_pages_content_e.intPageId = t_pages.intPageId AND t_pages.bitDeletedFlag=0';

      SET @P_SQL	= CONCAT(@P_SQL,' AND vchPageAlias = "',P_PAGE_ALIAS,'"');



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;



  END IF;

  IF(P_ACTION='PA') THEN

      SET @P_SQL='SELECT intPageId,vchTitle,vchName,vchNameO,vchPageAlias FROM t_pages WHERE bitDeletedFlag=0';

      SET @P_SQL	= CONCAT(@P_SQL,' AND vchPageAlias = "',P_PAGE_ALIAS,'"');



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;



  END IF;

 /* Action to get child page ids for parent menu for content page by indrani on::01-jan-2021 */
 IF(P_ACTION='MC') THEN

	SELECT a.vchName,a.vchNameO,a.vchTitle,a.vchMetaImage,a.intLinkType,a.intTemplateType,a.intWindowStatus,b.intId,b.intPageId,b.intParentId,b.tinMenuType,b.intMenuOrder,b.vchLinkType,a.vchUrl,(SELECT VCH_WEB_LAND_URL FROM t_function_master WHERE INT_FN_ID = a.INT_FUNCTION_ID) AS pageName,b.vchPageNavigation,a.vchLinkImage,a.vchPageAlias FROM t_pages a,t_menus b WHERE a.intPageId = b.intPageId AND a.intPublishStatus = 2 AND a.bitDeletedFlag = 0 and intParentId = P_PAGE_ID and b.tinMenuType=P_LINK_TYPE;
      
  END IF;
  
/* Action to get page id for page alias in content page by indrani on::04-jan-2021 */
IF(P_ACTION='GI')THEN
	SELECT a.intPageId,a.vchName,a.vchNameO,a.vchTitle,a.vchMetaImage,a.intLinkType,a.intTemplateType,a.intWindowStatus,a.vchUrl,(SELECT VCH_WEB_LAND_URL FROM t_function_master WHERE INT_FN_ID = a.INT_FUNCTION_ID) AS pageName,a.vchLinkImage,a.vchPageAlias,a.vchMetaTitle,a.vchMetaDescription,b.tinMenuType FROM t_pages a,t_menus b WHERE a.intPageId = b.intPageId and a.bitDeletedFlag = 0 and a.vchPageAlias = P_PAGE_ALIAS and b.tinMenuType=P_LINK_TYPE;
END IF; 

/* Action to get parent id for content page navigation by indrani on::05-jan-2021 */
IF(P_ACTION='PI')THEN
	SELECT intId,intPageId,intParentId,tinMenuType,intMenuOrder,vchLinkType,vchPageNavigation FROM t_menus WHERE intPageId = P_PAGE_ID and tinMenuType=P_LINK_TYPE;
END IF;

/* Action to get page names for navigation in content page by indrani on::05-jan-2021 */
IF(P_ACTION='RI')THEN
	SELECT a.intPageId,a.vchName,a.vchNameO,a.vchTitle,a.vchMetaImage,a.intLinkType,a.intTemplateType,a.intWindowStatus,a.vchUrl,(SELECT VCH_WEB_LAND_URL FROM t_function_master WHERE INT_FN_ID = a.INT_FUNCTION_ID) AS pageName,a.vchLinkImage,a.vchPageAlias,a.vchMetaTitle,a.vchMetaDescription,b.tinMenuType,b.intMenuOrder,b.vchPageNavigation,b.intParentId FROM t_pages a,t_menus b WHERE a.intPageId = b.intPageId and a.bitDeletedFlag = 0 and a.intPageId = P_PAGE_ID and b.tinMenuType=P_LINK_TYPE;
END IF;

END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_PAGE_CONTENT`
--

DROP PROCEDURE IF EXISTS `USP_PAGE_CONTENT`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_PAGE_CONTENT`(

    IN P_ACTION       VARCHAR(3),

    IN P_QUERY        mediumtext,

    IN P_PAGE_ID      INT(10),

    IN PORTAL_ID      smallint(2)

)
BEGIN



  



  

  IF(P_ACTION='A1') THEN



      SET @P_SQL = CONCAT('INSERT INTO t_pages_content_e(intPageId,intPageNo,vchContentE,intPortalType) VALUES ', P_QUERY);



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;

  END IF;



  

  IF(P_ACTION='D1') THEN



      DELETE FROM t_pages_content_e WHERE intPageId = P_PAGE_ID;



  END IF;



  

  IF(P_ACTION='V1')THEN



    SET @P_SQL ='SELECT intContentId,intPageId,intPageNo,vchContentE  FROM t_pages_content_e  WHERE bitDeletedFlag = 0';

    IF(P_QUERY>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND intPageNo = "'),P_QUERY,'"');

    END IF;

	  SET @P_SQL=CONCAT(@P_SQL,'  AND intPageId=',P_PAGE_ID);

    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



  END IF;



  

  IF(P_ACTION='A2') THEN



      SET @P_SQL = CONCAT('INSERT INTO t_pages_content_h(intPageId,intPageNo,vchContentH,intPortalType) VALUES ', P_QUERY);

      

      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;

  END IF;



  

  IF(P_ACTION='D2') THEN



      DELETE FROM t_pages_content_h WHERE intPageId = P_PAGE_ID;



  END IF;



  

  IF(P_ACTION='V2')THEN



    SELECT intContentId,intPageId,intPageNo,vchContentH  FROM t_pages_content_h  WHERE intPageId = P_PAGE_ID;



  END IF;



    IF(P_ACTION='V3')THEN

    SET @TOTRES = (select count(1) from t_pages_content_h where intPageId=P_PAGE_ID And intPageNo >0);



    IF(@TOTRES >0)THEN



    SET @P_SQL = CONCAT('SELECT intContentId,intPageId,intPageNo,vchContentH  FROM t_pages_content_h  WHERE intPageId = ',P_PAGE_ID);



    IF(CHAR_LENGTH(P_QUERY)>0)THEN



        SET @P_SQL=CONCAT(@P_SQL,' AND intPageNo="',P_QUERY,'"');



    END IF;



    ELSE



    SET @P_SQL = CONCAT('SELECT intContentId,intPageId,intPageNo,vchContentE FROM t_pages_content_e P WHERE intPageId =',P_PAGE_ID);

    IF(CHAR_LENGTH(P_QUERY)>0)THEN



        SET @P_SQL=CONCAT(@P_SQL,' AND intPageNo="',P_QUERY,'"');



    END IF;



    END IF;

    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;





  END IF;



  IF(P_ACTION='V4')THEN





    SET @P_SQL = CONCAT('SELECT intContentId,intPageId,intPageNo,vchContentE FROM t_pages_content_e P WHERE intPageId =',P_PAGE_ID);

    IF(CHAR_LENGTH(P_QUERY)>0)THEN



        SET @P_SQL=CONCAT(@P_SQL,' AND intPageNo="',P_QUERY,'"');



    END IF;



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



  END IF;

  IF(P_ACTION='VR') THEN

      SELECT intPageId,intPageNo,vchContentE  FROM t_pages_content_e  WHERE intPageId=P_PAGE_ID;



  END IF;





  IF(P_ACTION='VC')THEN



    SELECT vchContentE,(SELECT vchTitle FROM t_pages TP WHERE TP.intPageId=TC.intPageId)AS pageTitle FROM t_pages_content_e TC WHERE intPageId=P_PAGE_ID AND intPageNo=PORTAL_ID;

  END IF;



END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_PLUGIN`
--

DROP PROCEDURE IF EXISTS `USP_PLUGIN`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_PLUGIN`(

     IN  P_ACTION            VARCHAR(3),

     IN  P_PLUGIN_ID           INT,

     IN  P_FUNCTION_ID         INT,

     IN  P_FUN_CAT_TYPE        INT,

     IN  P_HEADLINE          VARCHAR(300),

     IN  P_DESC          TEXT,

     IN  P_DOCUMENT          VARCHAR(100),

     IN  P_PUB_STATUS        INT,

     IN  P_ARC_STATUS        INT,

     IN  P_CREATED_BY        INT,

     IN  P_ARC_START_DATE    DATE,

     IN  P_ARC_END_DATE      DATE,

     IN  P_PORTAL_TYPE        INT,

     OUT P_OUT               VARCHAR(200)

 )
BEGIN







      IF(P_ACTION='FNT')THEN

        SELECT INT_FN_ID,INT_SUBCAT_ID,VCH_SUBCATEGORY FROM t_function_subcategory WHERE INT_FN_ID=P_FUNCTION_ID;

     END IF;



   IF(P_ACTION='GFN')THEN

        SELECT INT_FN_ID FROM t_function_master WHERE VCH_WEB_LAND_URL=P_HEADLINE;

     END IF;







  IF(P_ACTION='CD')THEN

    SET @P_SQL=CONCAT('SELECT VCH_HEADLINE FROM t_plugin WHERE BIT_DELETED_FLAG=0 AND VCH_HEADLINE="',P_HEADLINE,'" AND INT_FN_ID="',P_FUNCTION_ID,'"');



     IF(P_FUN_CAT_TYPE>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_SUBCAT_ID=',P_FUN_CAT_TYPE);

    END IF;



    IF(P_PLUGIN_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_PLUGIN_ID!=',P_PLUGIN_ID);

    END IF;



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



  END IF;





  IF(P_ACTION='A')THEN

    INSERT INTO t_plugin (INT_FN_ID,INT_SUBCAT_ID,VCH_HEADLINE,VCH_DESCRIPTION,VCH_DOCFILE,INT_CREATED_BY,INT_PORTAL_TYPE)

    VALUES(P_FUNCTION_ID,P_FUN_CAT_TYPE,P_HEADLINE,P_DESC,P_DOCUMENT,P_CREATED_BY,P_PORTAL_TYPE);

    SELECT "PLUGIN Added Successfully";

  END IF;





  IF(P_ACTION='U')THEN

    UPDATE t_plugin SET

    INT_FN_ID      =  P_FUNCTION_ID,

    INT_SUBCAT_ID  =  P_FUN_CAT_TYPE,

    VCH_HEADLINE   =  P_HEADLINE,

    VCH_DESCRIPTION = P_DESC,

    VCH_DOCFILE    =  P_DOCUMENT,

    INT_UPDATED_BY =  P_CREATED_BY,

    INT_PORTAL_TYPE=  P_PORTAL_TYPE,

    DTM_UPDATED_ON =  NOW()

     WHERE INT_PLUGIN_ID=P_PLUGIN_ID;

    SELECT "PLUGIN Updated Successfully";

  END IF;



  IF(P_ACTION='R')THEN

    SELECT INT_PLUGIN_ID,INT_FN_ID,INT_SUBCAT_ID,VCH_HEADLINE,VCH_DESCRIPTION,VCH_DOCFILE,INT_CREATED_BY,DTM_UPDATED_ON,INT_PORTAL_TYPE FROM t_plugin WHERE INT_PLUGIN_ID=P_PLUGIN_ID;

  END IF;



  IF(P_ACTION='IN')THEN



    UPDATE t_plugin SET INT_PUBLISH_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE INT_PLUGIN_ID=P_PLUGIN_ID;

    SELECT 'PLUGIN Inactivated Successfully';



  END IF;



  IF(P_ACTION='AC')THEN



    UPDATE t_plugin SET INT_PUBLISH_STATUS=1,INT_ARCHIVE_STATUS=0,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW(),DTM_ARCHIVE_ON='0000-00-00' WHERE INT_PLUGIN_ID=P_PLUGIN_ID;

    SELECT 'Publication Activated Successfully';



  END IF;



  IF(P_ACTION='P')THEN



    UPDATE t_plugin SET INT_PUBLISH_STATUS=2,INT_ARCHIVE_STATUS=0,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE INT_PLUGIN_ID=P_PLUGIN_ID;

    SELECT 'Publication published Successfully';



  END IF;

  IF(P_ACTION='AR')THEN



    UPDATE t_plugin SET INT_ARCHIVE_STATUS=1,INT_PUBLISH_STATUS=1,DTM_ARCHIVE_ON=NOW(),INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE INT_PLUGIN_ID=P_PLUGIN_ID;

    SELECT 'Publication Activated Successfully';



  END IF;

   IF(P_ACTION='D')THEN

    UPDATE t_plugin SET BIT_DELETED_FLAG=1 WHERE INT_PLUGIN_ID=P_PLUGIN_ID;

    select 0;



  END IF;



    IF(P_ACTION='V') THEN



      SET @P_SQL='SELECT INT_PLUGIN_ID,INT_FN_ID,INT_SUBCAT_ID,VCH_HEADLINE,VCH_DESCRIPTION,VCH_DOCFILE,DTM_CREATED_ON,DTM_UPDATED_ON,INT_PUBLISH_STATUS,INT_PORTAL_TYPE FROM t_plugin WHERE BIT_DELETED_FLAG=0';



     IF(P_FUNCTION_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_FN_ID=',P_FUNCTION_ID);

     END IF;



     IF(P_FUN_CAT_TYPE>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_SUBCAT_ID=',P_FUN_CAT_TYPE);

     END IF;



    IF(P_PUB_STATUS>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS=',P_PUB_STATUS);

    END IF;



    IF(CHAR_LENGTH(P_HEADLINE)>0)THEN

				SET @P_SQL	= CONCAT(@P_SQL,' AND VCH_HEADLINE LIKE "%',P_HEADLINE,'%"');

			END IF;



    IF(P_ARC_START_DATE!='0000-00-00' and P_ARC_END_DATE='0000-00-00')THEN

        SET @P_SQL  = CONCAT(@P_SQL,' AND date(DTM_ARCHIVE_ON)>="',P_ARC_START_DATE,'"');

      END IF;



      IF(P_ARC_END_DATE!='0000-00-00' and P_ARC_START_DATE='0000-00-00')THEN

        SET @P_SQL  = CONCAT(@P_SQL,' AND date(DTM_ARCHIVE_ON)<="',P_ARC_END_DATE,'"');

      END IF;



      IF(P_ARC_END_DATE!='0000-00-00' and P_ARC_START_DATE!='0000-00-00')THEN

        SET @P_SQL  = CONCAT(@P_SQL,' AND date(DTM_ARCHIVE_ON) BETWEEN "',P_ARC_START_DATE,'" AND "',P_ARC_END_DATE,'"');

      END IF;



    SET @P_SQL=CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS = ',P_ARC_STATUS,' ORDER BY DTM_CREATED_ON DESC ');

    PREPARE STMT FROM @P_SQL;



    EXECUTE STMT;

    END IF;



    IF(P_ACTION='PG') THEN

      SET @START_REC=P_PLUGIN_ID;

       SET @P_SQL='SELECT INT_PLUGIN_ID,INT_FN_ID,INT_SUBCAT_ID,VCH_HEADLINE,VCH_DESCRIPTION,VCH_DOCFILE,DTM_CREATED_ON,INT_PUBLISH_STATUS,INT_PORTAL_TYPE FROM t_plugin WHERE BIT_DELETED_FLAG=0';



      IF(P_FUNCTION_ID>0)THEN

       SET @P_SQL=CONCAT(@P_SQL,' AND INT_FN_ID=',P_FUNCTION_ID);

     END IF;



      IF(P_FUN_CAT_TYPE>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_SUBCAT_ID=',P_FUN_CAT_TYPE);

     END IF;



    IF(P_PUB_STATUS>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS=',P_PUB_STATUS);

    END IF;



    IF(P_ARC_START_DATE!='0000-00-00' and P_ARC_END_DATE='0000-00-00')THEN

        SET @P_SQL  = CONCAT(@P_SQL,' AND date(DTM_ARCHIVE_ON)>="',P_ARC_START_DATE,'"');

      END IF;



      IF(P_ARC_END_DATE!='0000-00-00' and P_ARC_START_DATE='0000-00-00')THEN

        SET @P_SQL  = CONCAT(@P_SQL,' AND date(DTM_ARCHIVE_ON)<="',P_ARC_END_DATE,'"');

      END IF;



      IF(P_ARC_END_DATE!='0000-00-00' and P_ARC_START_DATE!='0000-00-00')THEN

        SET @P_SQL  = CONCAT(@P_SQL,' AND date(DTM_ARCHIVE_ON) BETWEEN "',P_ARC_START_DATE,'" AND "',P_ARC_END_DATE,'"');

      END IF;



    IF(CHAR_LENGTH(P_HEADLINE)>0)THEN

				SET @P_SQL	= CONCAT(@P_SQL,' AND VCH_HEADLINE LIKE "%',P_HEADLINE,'%"');

			END IF;



    SET @P_SQL=CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS = ',P_ARC_STATUS,' ORDER BY DTM_CREATED_ON DESC LIMIT ?,10');



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT USING @START_REC;

    END IF;







IF(P_ACTION='VP') THEN



      SET @P_SQL='SELECT intRuleId,VCH_HEADLINE,intShowHome,VCH_HEADLINEH,VCH_DESCRIPTION,vchImageFile,vchDescriptionE,vchDescriptionH,dtmCreatedOn,INT_PUBLISH_STATUS FROM t_plugin WHERE BIT_DELETED_FLAG=0';





    IF(P_PUB_STATUS>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS=',P_PUB_STATUS);

    END IF;



    IF(CHAR_LENGTH(P_HEADLINE)>0)THEN

				SET @P_SQL	= CONCAT(@P_SQL,' AND VCH_HEADLINE LIKE "%',P_HEADLINE,'%"');

			END IF;



    IF(P_ARC_START_DATE!='0000-00-00' and P_ARC_END_DATE='0000-00-00')THEN

        SET @P_SQL  = CONCAT(@P_SQL,' AND date(DTM_ARCHIVE_ON)>="',P_ARC_START_DATE,'"');

      END IF;



      IF(P_ARC_END_DATE!='0000-00-00' and P_ARC_START_DATE='0000-00-00')THEN

        SET @P_SQL  = CONCAT(@P_SQL,' AND date(DTM_ARCHIVE_ON)<="',P_ARC_END_DATE,'"');

      END IF;



      IF(P_ARC_END_DATE!='0000-00-00' and P_ARC_START_DATE!='0000-00-00')THEN

        SET @P_SQL  = CONCAT(@P_SQL,' AND date(DTM_ARCHIVE_ON) BETWEEN "',P_ARC_START_DATE,'" AND "',P_ARC_END_DATE,'"');

      END IF;



    SET @P_SQL=CONCAT(@P_SQL,' AND intShowHome=1 AND INT_ARCHIVE_STATUS = ',P_ARC_STATUS,' ORDER BY dtmCreatedOn DESC ');

    PREPARE STMT FROM @P_SQL;



    EXECUTE STMT;

    END IF;



IF(P_ACTION='PPG') THEN

      SET @START_REC=P_RULE_ID;

       SET @P_SQL='SELECT intRuleId,VCH_HEADLINE,intShowHome,VCH_HEADLINEH,VCH_DESCRIPTION,vchImageFile,vchDescriptionE,vchDescriptionH,dtmCreatedOn,INT_PUBLISH_STATUS FROM t_plugin WHERE BIT_DELETED_FLAG=0';



    IF(P_PUB_STATUS>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS=',P_PUB_STATUS);

    END IF;



    IF(P_ARC_START_DATE!='0000-00-00' and P_ARC_END_DATE='0000-00-00')THEN

        SET @P_SQL  = CONCAT(@P_SQL,' AND date(DTM_ARCHIVE_ON)>="',P_ARC_START_DATE,'"');

      END IF;



      IF(P_ARC_END_DATE!='0000-00-00' and P_ARC_START_DATE='0000-00-00')THEN

        SET @P_SQL  = CONCAT(@P_SQL,' AND date(DTM_ARCHIVE_ON)<="',P_ARC_END_DATE,'"');

      END IF;



      IF(P_ARC_END_DATE!='0000-00-00' and P_ARC_START_DATE!='0000-00-00')THEN

        SET @P_SQL  = CONCAT(@P_SQL,' AND date(DTM_ARCHIVE_ON) BETWEEN "',P_ARC_START_DATE,'" AND "',P_ARC_END_DATE,'"');

      END IF;



    IF(CHAR_LENGTH(P_HEADLINE)>0)THEN

				SET @P_SQL	= CONCAT(@P_SQL,' AND VCH_HEADLINE LIKE "%',P_HEADLINE,'%"');

			END IF;



    SET @P_SQL=CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS = ',P_ARC_STATUS,' ORDER BY intShowHome DESC, dtmCreatedOn DESC LIMIT ?,20');



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT USING @START_REC;

    END IF;



END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_SEARCH`
--

DROP PROCEDURE IF EXISTS `USP_SEARCH`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_SEARCH`(

  IN  P_ACTION      VARCHAR(3),

  IN  P_CMS_ID      INT,

  IN  P_SEARCH_TXT  TEXT





)
BEGIN

IF (P_ACTION='V') THEN

    SET @P_SQL= "SELECT Q1.PID,IFNULL(Q1.COL1,'') AS HEAD_LINE , IFNULL(Q1.COL2,'') AS DESCRIPTION ,

     IFNULL(Q1.COL3,'0') AS FUNCTION_NAME,IFNULL(Q1.COL4,'0') AS VCH_URL, Q1.UPDATE_ON ,Q1.CREATED_ON, Q1.GL_ID , Q1.PL_ID ,

    Q1.SL_ID , Q1.TL_ID, Q1.LINK_TYPE, Q1.WINDOW_TYPE, Q1.URL FROM (";



    SET @P_SQL= CONCAT(@P_SQL,"



    SELECT intPageId AS PID, vchTitle AS COL1,(SELECT vchContentE FROM t_pages_content_e WHERE intPageId = p.intPageId limit 0,1)

AS COL2, 'content' AS COL3,(SELECT VCH_WEB_LAND_URL FROM t_function_master WHERE INT_FN_ID = p.INT_FUNCTION_ID)

AS COL4,dtmUpdatedOn AS UPDATE_ON,dtmCreatedOn AS CREATED_ON,0 as GL_ID,0 as PL_ID,

    0 as SL_ID,0 as TL_ID ,1 AS LINK_TYPE, 1 AS WINDOW_TYPE, vchUrl AS URL FROM t_pages p

    WHERE bitDeletedFlag=0 AND intPublishStatus=2



   UNION ALL



SELECT INT_RULE_ID AS PID, VCH_HEADLINE AS COL1,VCH_DOCUMENT AS COL2,'' AS COL3,VCH_PLUGIN_TYPE AS COL4, DTM_UPDATED_ON AS UPDATE_ON,DTM_CREATED_ON AS CREATED_ON,0 as GL_ID,0 as PL_ID,

    0 as SL_ID,0 as TL_ID ,1 AS LINK_TYPE, 1 AS WINDOW_TYPE, '' AS URL FROM t_actrule WHERE BIT_DELETED_FLAG=0 AND INT_ARC_STATUS=0

    AND INT_PUBLISH_STATUS=2



 UNION ALL



SELECT INT_NOTIFICATION_ID AS PID, VCH_HEADLINE AS COL1,VCH_DOCUMENT AS COL2,'' AS COL3,'' AS COL4, DTM_UPDATED_ON AS UPDATE_ON,DTM_CREATED_ON AS CREATED_ON,0 as GL_ID,0 as PL_ID,

    0 as SL_ID,0 as TL_ID ,INT_LINK_TYPE AS LINK_TYPE, 1 AS WINDOW_TYPE, '' AS URL FROM t_notification WHERE BIT_DELETED_FLAG=0 AND INT_ARC_STATUS=0

    AND INT_PUBLISH_STATUS=2

  

  UNION ALL



SELECT intLinkId AS PID, vchLinkNameE AS COL1,vchDocument AS COL2,'' AS COL3,vchUrl AS COL4, dtmUpdatedOn AS UPDATE_ON,stmCreatedOn AS CREATED_ON,0 as GL_ID,0 as PL_ID,

    0 as SL_ID,0 as TL_ID ,tinLinkType AS LINK_TYPE, 1 AS WINDOW_TYPE, '' AS URL FROM t_important_links WHERE bitDeletedFlag=0 AND tinArcStatus=0

    AND tinPublishStatus=2

    

 UNION ALL



SELECT intServiceId AS PID, vchServiceNameE AS COL1,vchDetailE AS COL2,'' AS COL3,vchUrl AS COL4, dtmUpdatedOn AS UPDATE_ON,stmCreatedOn AS CREATED_ON,0 as GL_ID,0 as PL_ID,

    0 as SL_ID,0 as TL_ID ,intLinkType AS LINK_TYPE, intWindowStatus AS WINDOW_TYPE, '' AS URL FROM t_services WHERE bitDeletedFlag=0 AND intArcStatus=0

    AND intPublishStatus=2

    

 UNION ALL



SELECT intProfileId AS PID, vchMinisterNameE AS COL1,vchDesignationE AS COL2,'' AS COL3,vchUrl AS COL4, dtmUpdatedOn AS UPDATE_ON,stmCreatedOn AS CREATED_ON,0 as GL_ID,0 as PL_ID,

    0 as SL_ID,0 as TL_ID ,1 AS LINK_TYPE, 1 AS WINDOW_TYPE, '' AS URL FROM t_officer_profile WHERE bitDeletedFlag=0 AND tinArcStatus=0

    AND tinPublishStatus=2



   ");



    SET @P_SQL= CONCAT(@P_SQL,")Q1 ");



          IF (P_SEARCH_TXT IS NOT NULL) THEN

           SET @P_SQL=CONCAT(@P_SQL," WHERE IFNULL(Q1.COL1,'') LIKE '%",P_SEARCH_TXT,"%' OR IFNULL(Q1.COL2,'')

           LIKE '%",P_SEARCH_TXT,"%'");

          END IF;

SET @P_SQL=CONCAT(@P_SQL," ORDER BY Q1.COL1,Q1.COL2 ASC");





  PREPARE STMT FROM @P_SQL;

  EXECUTE STMT;

  

  END IF;



IF (P_ACTION='PG') THEN

    SET @P_STARTREC=P_CMS_ID;

    SET @P_SQL= "SELECT Q1.PID,IFNULL(Q1.COL1,'') AS HEAD_LINE , IFNULL(Q1.COL2,'') AS DESCRIPTION ,

     IFNULL(Q1.COL3,'0') AS FUNCTION_NAME,IFNULL(Q1.COL4,'0') AS VCH_URL, Q1.UPDATE_ON ,Q1.CREATED_ON, Q1.GL_ID , Q1.PL_ID ,

    Q1.SL_ID , Q1.TL_ID, Q1.LINK_TYPE, Q1.WINDOW_TYPE, Q1.URL FROM (";



       SET @P_SQL= CONCAT(@P_SQL,"



    SELECT intPageId AS PID, vchTitle AS COL1,(SELECT vchContentE FROM t_pages_content_e WHERE intPageId = p.intPageId limit 0,1)

AS COL2, 'content' AS COL3,(SELECT VCH_WEB_LAND_URL FROM t_function_master WHERE INT_FN_ID = p.INT_FUNCTION_ID)

AS COL4, dtmUpdatedOn AS UPDATE_ON,dtmCreatedOn AS CREATED_ON,0 as GL_ID,0 as PL_ID,

    0 as SL_ID,0 as TL_ID ,1 AS LINK_TYPE, 1 AS WINDOW_TYPE, vchUrl AS URL FROM t_pages p

    WHERE bitDeletedFlag=0 AND intPublishStatus=2



 UNION ALL



SELECT INT_RULE_ID AS PID, VCH_HEADLINE AS COL1,VCH_DOCUMENT AS COL2,'' AS COL3,VCH_PLUGIN_TYPE AS COL4, DTM_UPDATED_ON AS UPDATE_ON,DTM_CREATED_ON AS CREATED_ON,0 as GL_ID,0 as PL_ID,

    0 as SL_ID,0 as TL_ID ,1 AS LINK_TYPE, 1 AS WINDOW_TYPE, '' AS URL FROM t_actrule WHERE BIT_DELETED_FLAG=0 AND INT_ARC_STATUS=0

    AND INT_PUBLISH_STATUS=2



 UNION ALL



SELECT INT_NOTIFICATION_ID AS PID, VCH_HEADLINE AS COL1,VCH_DOCUMENT AS COL2,'' AS COL3,'' AS COL4, DTM_UPDATED_ON AS UPDATE_ON,DTM_CREATED_ON AS CREATED_ON,0 as GL_ID,0 as PL_ID,

    0 as SL_ID,0 as TL_ID ,INT_LINK_TYPE AS LINK_TYPE, 1 AS WINDOW_TYPE, '' AS URL FROM t_notification WHERE BIT_DELETED_FLAG=0 AND INT_ARC_STATUS=0

    AND INT_PUBLISH_STATUS=2

  

  UNION ALL



SELECT intLinkId AS PID, vchLinkNameE AS COL1,vchDocument AS COL2,'' AS COL3,vchUrl AS COL4, dtmUpdatedOn AS UPDATE_ON,stmCreatedOn AS CREATED_ON,0 as GL_ID,0 as PL_ID,

    0 as SL_ID,0 as TL_ID ,tinLinkType AS LINK_TYPE, 1 AS WINDOW_TYPE, '' AS URL FROM t_important_links WHERE bitDeletedFlag=0 AND tinArcStatus=0

    AND tinPublishStatus=2

    

 UNION ALL



SELECT intServiceId AS PID, vchServiceNameE AS COL1,vchDetailE AS COL2,'' AS COL3,vchUrl AS COL4, dtmUpdatedOn AS UPDATE_ON,stmCreatedOn AS CREATED_ON,0 as GL_ID,0 as PL_ID,

    0 as SL_ID,0 as TL_ID ,intLinkType AS LINK_TYPE, intWindowStatus AS WINDOW_TYPE, '' AS URL FROM t_services WHERE bitDeletedFlag=0 AND intArcStatus=0

    AND intPublishStatus=2

    

 UNION ALL



SELECT intProfileId AS PID, vchMinisterNameE AS COL1,vchDesignationE AS COL2,'' AS COL3,vchUrl AS COL4, dtmUpdatedOn AS UPDATE_ON,stmCreatedOn AS CREATED_ON,0 as GL_ID,0 as PL_ID,

    0 as SL_ID,0 as TL_ID ,1 AS LINK_TYPE, 1 AS WINDOW_TYPE, '' AS URL FROM t_officer_profile WHERE bitDeletedFlag=0 AND tinArcStatus=0

    AND tinPublishStatus=2



   ");





    SET @P_SQL= CONCAT(@P_SQL,")Q1 ");



          IF (P_SEARCH_TXT IS NOT NULL) THEN

           SET @P_SQL=CONCAT(@P_SQL," WHERE IFNULL(Q1.COL1,'') LIKE '%",P_SEARCH_TXT,"%' OR IFNULL(Q1.COL2,'')

           LIKE '%",P_SEARCH_TXT,"%'");

          END IF;

SET @P_SQL=CONCAT(@P_SQL," ORDER BY Q1.COL1,Q1.COL2 ASC LIMIT ?,10");



    

   PREPARE STMT FROM @P_SQL;

 EXECUTE STMT USING @P_STARTREC;

   END IF;





END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_SERVICES`
--

DROP PROCEDURE IF EXISTS `USP_SERVICES`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_SERVICES`(



  IN  P_ACTION            VARCHAR(3),

  IN  P_NOTIFICATION_ID   INT,

  IN  P_LINK_TYPE         INT,

  IN  P_PLUGIN_TYPE       INT,

  IN  P_HEADLINE_NAME     VARCHAR(256),

  IN  P_HEADLINE_NAME_O   VARCHAR(256),

  IN  P_CODE              VARCHAR(10),

  IN  P_DECUMENT          Text,

  IN  P_START_DATE        DATE,

  IN  P_DATE              DATE,

  IN  P_PUB_STATUS        INT,

  IN  P_CREATED_BY        INT,

  IN  P_ARC_STATUS        INT,

  IN  P_BLINK_STATUS      INT,

  OUT P_OUT               VARCHAR(256)





)
BEGIN







  IF(P_ACTION='A')THEN



    DELETE FROM t_notification WHERE INT_NOTIFICATION_ID=P_NOTIFICATION_ID;

    INSERT INTO t_notification (INT_LINK_TYPE,VCH_CODE,DTM_NOTICE_START,VCH_HEADLINE,VCH_HEADLINE_O, VCH_DOCUMENT,DTM_NOTIFICATION_DATE, INT_PUBLISH_STATUS, INT_CREATED_BY, INT_PLUGIN_TYPE,INT_ARC_STATUS,INT_BLINK_STATUS)

    VALUES(P_LINK_TYPE,P_CODE,P_START_DATE,P_HEADLINE_NAME,P_HEADLINE_NAME_O,P_DECUMENT,P_DATE,P_PUB_STATUS,P_CREATED_BY,P_PLUGIN_TYPE,P_ARC_STATUS,P_BLINK_STATUS);



    



  END IF;







  IF(P_ACTION='CD')THEN

    SET @P_SQL=CONCAT('SELECT VCH_HEADLINE FROM t_notification WHERE BIT_DELETED_FLAG=0  AND INT_LINK_TYPE= ',P_LINK_TYPE,' AND VCH_HEADLINE="',P_HEADLINE_NAME,'"');



    IF(P_NOTIFICATION_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_NOTIFICATION_ID!=',P_NOTIFICATION_ID);

    END IF;



   PREPARE STMT FROM @P_SQL;

   EXECUTE STMT;



  END IF;







  IF(P_ACTION='R')THEN

      SELECT INT_LINK_TYPE,VCH_CODE,DTM_NOTICE_START,INT_NOTIFICATION_ID, VCH_HEADLINE,VCH_HEADLINE_O,INT_BLINK_STATUS, VCH_DOCUMENT, INT_PUBLISH_STATUS, DTM_CREATED_ON, INT_CREATED_BY,

      DTM_UPDATED_ON, INT_UPDATED_BY,  INT_PLUGIN_TYPE, DTM_NOTIFICATION_DATE, INT_ARC_STATUS

      FROM t_notification WHERE BIT_DELETED_FLAG=0 and INT_NOTIFICATION_ID=P_NOTIFICATION_ID;





  END IF;



  IF(P_ACTION='U')THEN

    UPDATE t_notification SET

    INT_LINK_TYPE = P_LINK_TYPE,

    VCH_CODE = P_CODE,

    DTM_NOTICE_START = P_START_DATE,

    INT_PLUGIN_TYPE = P_PLUGIN_TYPE,

    VCH_HEADLINE    = P_HEADLINE_NAME,

    VCH_HEADLINE_O  = P_HEADLINE_NAME_O,

    VCH_DOCUMENT    = P_DECUMENT,

    DTM_NOTIFICATION_DATE = P_DATE,

    INT_PUBLISH_STATUS    = P_PUB_STATUS,

    INT_UPDATED_BY        = P_CREATED_BY,

    INT_ARC_STATUS        = P_ARC_STATUS,

    INT_BLINK_STATUS      = P_BLINK_STATUS,

    DTM_UPDATED_ON        = NOW()

    WHERE  INT_NOTIFICATION_ID=P_NOTIFICATION_ID;

    SELECT "Notification Updated Successfully";

  END IF;





  IF(P_ACTION='V')THEN

  SET @P_SQL='SELECT N.DTM_NOTICE_START,N.INT_LINK_TYPE,N.VCH_CODE,N.INT_NOTIFICATION_ID,N.INT_BLINK_STATUS, N.VCH_HEADLINE,N.VCH_HEADLINE_O, N.VCH_DOCUMENT, N.INT_PUBLISH_STATUS, N.DTM_CREATED_ON, N.INT_CREATED_BY,

     N.DTM_UPDATED_ON, N.INT_UPDATED_BY,  N.INT_PLUGIN_TYPE, N.DTM_NOTIFICATION_DATE, N.INT_ARC_STATUS,(SELECT C.vchCirculaName FROM m_circular_master C WHERE C.bitDeleteflag=0 and  C.intCircularId=1 and C.intmId = N.INT_PLUGIN_TYPE) AS sectorName FROM t_notification N WHERE N.BIT_DELETED_FLAG=0';



  IF(P_NOTIFICATION_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_NOTIFICATION_ID = "'),P_NOTIFICATION_ID,'"');

    END IF;



  IF(CHAR_LENGTH(P_HEADLINE_NAME)>0)THEN

     SET @P_SQL  = CONCAT(@P_SQL,' AND VCH_HEADLINE LIKE "%',P_HEADLINE_NAME,'%"');

  END IF;

   IF(P_LINK_TYPE>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_LINK_TYPE = "'),P_LINK_TYPE,'"');

    END IF;



  IF(P_PLUGIN_TYPE>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PLUGIN_TYPE = "'),P_PLUGIN_TYPE,'"');

    END IF;



  IF(P_ARC_STATUS>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_ARC_STATUS = "'),P_ARC_STATUS,'"');

  END IF;

 IF(P_PUB_STATUS>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUB_STATUS,'"');

  END IF;



  SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON DESC');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;







  IF(P_ACTION='PG')THEN

      SET @START_REC=P_NOTIFICATION_ID;

     SET @P_SQL='SELECT N.DTM_NOTICE_START,N.INT_LINK_TYPE,N.VCH_CODE,N.INT_NOTIFICATION_ID,N.INT_BLINK_STATUS, N.VCH_HEADLINE,N.VCH_HEADLINE_O, N.VCH_DOCUMENT, N.INT_PUBLISH_STATUS, N.DTM_CREATED_ON, N.INT_CREATED_BY,

     N.DTM_UPDATED_ON, N.INT_UPDATED_BY,  N.INT_PLUGIN_TYPE, N.DTM_NOTIFICATION_DATE, N.INT_ARC_STATUS,(SELECT C.vchCirculaName FROM m_circular_master C WHERE C.bitDeleteflag=0 and  C.intCircularId=1 and C.intmId = N.INT_PLUGIN_TYPE) AS sectorName FROM t_notification N WHERE N.BIT_DELETED_FLAG=0';



  IF(P_NOTIFICATION_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_NOTIFICATION_ID = "'),P_NOTIFICATION_ID,'"');

    END IF;



  IF(P_LINK_TYPE>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_LINK_TYPE = "'),P_LINK_TYPE,'"');

    END IF;



  IF(P_PLUGIN_TYPE>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PLUGIN_TYPE = "'),P_PLUGIN_TYPE,'"');

    END IF;

  IF(P_ARC_STATUS>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_ARC_STATUS = "'),P_ARC_STATUS,'"');

  END IF;



  IF(CHAR_LENGTH(P_HEADLINE_NAME)>0)THEN

     SET @P_SQL  = CONCAT(@P_SQL,' AND VCH_HEADLINE LIKE "%',P_HEADLINE_NAME,'%"');

  END IF;



  SET @P_SQL=CONCAT(@P_SQL,' ORDER BY DTM_CREATED_ON DESC LIMIT ?,20');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT USING @START_REC;

  END IF;









  IF(P_ACTION='IN')THEN

    UPDATE t_notification SET INT_PUBLISH_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

    WHERE  INT_NOTIFICATION_ID=P_NOTIFICATION_ID AND BIT_DELETED_FLAG=0 ;

     SELECT "Unpublished Successfully";

  END IF;







  IF(P_ACTION='AR')THEN

    UPDATE t_notification SET INT_ARC_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_NOTIFICATION_ID=P_NOTIFICATION_ID;

    SELECT "Archived Successfully";

  END IF;







   IF(P_ACTION='P')THEN

    UPDATE t_notification SET INT_PUBLISH_STATUS=2,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_NOTIFICATION_ID=P_NOTIFICATION_ID;

    SELECT "publish Successfully";

  END IF;







  IF(P_ACTION='D')THEN



	UPDATE t_notification SET BIT_DELETED_FLAG=1 WHERE INT_NOTIFICATION_ID=P_NOTIFICATION_ID;

    SELECT '0';

  END IF;









  IF(P_ACTION = 'AC')THEN

     UPDATE t_notification SET INT_ARC_STATUS = 2,DTM_UPDATED_ON = NOW(),INT_UPDATED_BY = P_CREATED_BY WHERE INT_NOTIFICATION_ID=P_NOTIFICATION_ID;

	 SELECT "Activated Successfully";

  END IF;







END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_SERVICE_MASTER`
--

DROP PROCEDURE IF EXISTS `USP_SERVICE_MASTER`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_SERVICE_MASTER`(

IN   P_ACTION           VARCHAR(2),
IN   P_SID              INT,
IN   P_SERVICE_NAME     VARCHAR(64),
OUT  P_OUT              VARCHAR(64)


)
BEGIN


IF(P_ACTION = 'RC') THEN

SELECT intCatId,vchService FROM m_service_category WHERE bitDeleteflag=0 LIMIT 7;



END IF;

IF(P_ACTION = 'RA') THEN

SELECT intCatId,vchService FROM m_service_category WHERE bitDeleteflag=0;



END IF;

END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_TENDER_DETAILS`
--

DROP PROCEDURE IF EXISTS `USP_TENDER_DETAILS`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_TENDER_DETAILS`(

  IN  P_ACTION           VARCHAR(3),

  IN  P_TENDER_ID        INT,

  IN  P_TENDER_NO        VARCHAR(50),

  IN  P_HEADLINE         VARCHAR(250),

  IN  P_OPENING_DATE     VARCHAR(32),

  IN  P_CLOSING_DATE     VARCHAR(32),

  IN  P_TENDER_FILE      VARCHAR(50),

  IN  P_DESCRIPTION      mediumtext,
  
  IN  P_PUB_STATUS       INT,

  IN  P_PUBLISH_ON       INT,

  IN  P_ARC_STATUS       INT,

  IN  P_APPROVAL         INT,

  IN  P_CREATED_BY       INT,

  OUT P_OUT              VARCHAR(200)

)
BEGIN

  IF(P_ACTION='CD')THEN

    SET @P_SQL=CONCAT('SELECT VCH_REF_NO FROM t_tender_details WHERE BIT_DELETED_FLAG=0 AND INT_ARCHIVE_STATUS=0 AND VCH_REF_NO="',P_TENDER_NO,'"');



    IF(P_TENDER_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND INT_TENDER_ID!=',P_TENDER_ID);

    END IF;



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



  END IF;





  IF(P_ACTION='A')THEN

    INSERT INTO t_tender_details (VCH_REF_NO,VCH_HEAD_LINE_E,DTM_OPENING_DATETIME,DTM_CLOSING_DATETIME,VCH_DOCUMENT_NAME,VCH_DESCRIPTION_E,INT_PUBLISH_STATUS,INT_PREVILIGE_STATUS,INT_APPROVAL_STATUS,INT_CREATED_BY)

    VALUES (P_TENDER_NO,P_HEADLINE,P_OPENING_DATE,P_CLOSING_DATE,P_TENDER_FILE,P_DESCRIPTION,P_PUB_STATUS,P_PUBLISH_ON,P_APPROVAL,P_CREATED_BY);

    SELECT "Tender Added Successfully";

  END IF;





  IF(P_ACTION='U')THEN

    UPDATE t_tender_details SET VCH_REF_NO=P_TENDER_NO,VCH_HEAD_LINE_E=P_HEADLINE,DTM_OPENING_DATETIME=P_OPENING_DATE,DTM_CLOSING_DATETIME=P_CLOSING_DATE,VCH_DOCUMENT_NAME=P_TENDER_FILE,VCH_DESCRIPTION_E=P_DESCRIPTION,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE INT_TENDER_ID=P_TENDER_ID;



    SELECT "Tender Updated Successfully";

  END IF;



  IF(P_ACTION='V')THEN



    UPDATE t_tender_details SET INT_ARCHIVE_STATUS=1 WHERE DTM_CLOSING_DATETIME<NOW();



    SET @P_SQL='SELECT INT_TENDER_ID, VCH_REF_NO, VCH_HEAD_LINE_E, DTM_OPENING_DATETIME, DTM_CLOSING_DATETIME, VCH_DOCUMENT_NAME,VCH_DESCRIPTION_E, INT_PUBLISH_STATUS,INT_PREVILIGE_STATUS,INT_APPROVAL_STATUS,INT_ARCHIVE_STATUS,INT_CREATED_BY,DTM_CREATED_ON FROM t_tender_details WHERE BIT_DELETED_FLAG=0';



    IF(CHAR_LENGTH(P_TENDER_NO)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND VCH_REF_NO = "'),P_TENDER_NO,'"');

    END IF;

   IF(CHAR_LENGTH(P_HEADLINE)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND VCH_HEAD_LINE_E LIKE "%'),P_HEADLINE,'%"');

    END IF;



    IF(P_PUBLISH_ON>0 AND P_CREATED_BY=0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PREVILIGE_STATUS = "'),P_PUBLISH_ON,'"');

    END IF;



      IF(P_CREATED_BY>0 AND P_PUBLISH_ON>0) THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND (INT_PREVILIGE_STATUS = ',P_PUBLISH_ON ,' OR INT_PREVILIGE_STATUS = "3")');

    END IF;



    IF(P_PUB_STATUS>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_PUBLISH_STATUS = "'),P_PUB_STATUS,'"');

    END IF;

   IF(P_TENDER_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_TENDER_ID = "'),P_TENDER_ID,'"');

    END IF;


      SET @P_SQL=CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS=',P_ARC_STATUS,' ORDER BY DTM_CREATED_ON DESC');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;





  IF(P_ACTION='PG')THEN



    UPDATE t_tender_details SET INT_ARCHIVE_STATUS=1 WHERE DTM_CLOSING_DATETIME<NOW();



    SET @START_REC=P_TENDER_ID;

    SET @P_SQL='SELECT INT_TENDER_ID,VCH_REF_NO, VCH_HEAD_LINE_E, DTM_OPENING_DATETIME, DTM_CLOSING_DATETIME, VCH_DOCUMENT_NAME, VCH_DESCRIPTION_E, INT_PUBLISH_STATUS,INT_PREVILIGE_STATUS,INT_APPROVAL_STATUS,INT_ARCHIVE_STATUS,INT_CREATED_BY,DTM_CREATED_ON FROM t_tender_details WHERE BIT_DELETED_FLAG=0';



    IF(CHAR_LENGTH(P_TENDER_NO)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND VCH_REF_NO = "'),P_TENDER_NO,'"');

    END IF;

    IF(CHAR_LENGTH(P_HEADLINE)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND VCH_HEAD_LINE_E LIKE "%'),P_HEADLINE,'%"');

    END IF;



    IF(P_CREATED_BY>0 AND P_PUBLISH_ON>0) THEN

      SET @P_SQL=CONCAT(@P_SQL,' AND (INT_PREVILIGE_STATUS = ',P_PUBLISH_ON ,' OR INT_PREVILIGE_STATUS = "3")');

    END IF;



    IF(P_APPROVAL>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_APPROVAL_STATUS = "'),P_APPROVAL,'"');

    END IF;



      SET @P_SQL=CONCAT(@P_SQL,' AND INT_ARCHIVE_STATUS=',P_ARC_STATUS,' ORDER BY DTM_CREATED_ON DESC LIMIT ?,10');



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT USING @START_REC;

  END IF;





  IF(P_ACTION='R')THEN

    SET @P_SQL='SELECT INT_TENDER_ID, VCH_REF_NO, VCH_HEAD_LINE_E, DTM_OPENING_DATETIME, DTM_CLOSING_DATETIME, VCH_DOCUMENT_NAME,  VCH_DESCRIPTION_E, INT_PUBLISH_STATUS,INT_PREVILIGE_STATUS,INT_APPROVAL_STATUS,INT_CREATED_BY,DTM_CREATED_ON FROM t_tender_details WHERE BIT_DELETED_FLAG=0';



    IF(P_TENDER_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL,' AND INT_TENDER_ID = "'),P_TENDER_ID,'"');

    END IF;



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;





  IF(P_ACTION='IN')THEN

    UPDATE t_tender_details SET INT_PUBLISH_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

    WHERE  INT_TENDER_ID=P_TENDER_ID;
    
    SELECT "Tender UnPublished Successfully";

  END IF;





  IF(P_ACTION='D')THEN

    DELETE FROM t_tender_details WHERE  INT_TENDER_ID=P_TENDER_ID;

    SELECT 0;

  END IF;



  IF(P_ACTION='P')THEN

    UPDATE t_tender_details SET INT_PUBLISH_STATUS=2,INT_ARCHIVE_STATUS=0,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_TENDER_ID=P_TENDER_ID;

  SELECT "Tender Published Successfully";

  END IF;

  IF(P_ACTION='UP')THEN

    UPDATE t_tender_details SET INT_APPROVAL_STATUS=P_APPROVAL,INT_ARCHIVE_STATUS=0,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_TENDER_ID=P_TENDER_ID;

    SELECT "Tender Unpublished Successfully";

  END IF;





  IF(P_ACTION='AR')THEN

    UPDATE t_tender_details SET INT_ARCHIVE_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_TENDER_ID=P_TENDER_ID;

    SELECT "Tender Archived Successfully";

  END IF;





  IF(P_ACTION = 'AC')THEN

    UPDATE t_tender_details SET INT_ARCHIVE_STATUS =0,DTM_UPDATED_ON = NOW(),INT_UPDATED_BY = P_CREATED_BY WHERE INT_TENDER_ID=P_TENDER_ID;

    SELECT "Tender Activated Successfully";

  END IF;





  



  

  IF(P_ACTION='SHP')THEN



    UPDATE t_tender_details SET INT_PUBLISH_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_TENDER_ID=P_TENDER_ID;



  END IF;





  IF(P_ACTION='UHP')THEN



    UPDATE t_tender_details SET INT_PUBLISH_STATUS=0,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_TENDER_ID=P_TENDER_ID;



  END IF;

  



END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_USER_FEEDBACK`
--

DROP PROCEDURE IF EXISTS `USP_USER_FEEDBACK`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_USER_FEEDBACK`(
IN P_ACTION             VARCHAR(3),
IN P_ID                 INT,
IN P_NAME               VARCHAR(512),
IN P_EMAIL              VARCHAR(512),
IN P_MOBILE_NO          VARCHAR(16),
IN P_SUBJECT            VARCHAR(640),
IN P_FEEDBACK           TEXT,
IN P_CREATED_DATE       DATE,
IN P_PUBLISH_STATUS     TINYINT,
IN P_ARC_STATUS         TINYINT,
IN P_CREATED_BY         INT,
IN P_ATTR1              VARCHAR(256),
IN P_ATTR2              VARCHAR(256),
IN P_INTATTR1           INT,
IN P_INTATTR2           INT,
OUT P_OUT               VARCHAR(256)
)
BEGIN
/* Procedure : USP_USER_FEEDBACK 
   Created by:: AJMAL AKHTAR
   On:: 21-12-2020
*/
IF(P_ACTION='A')THEN
	INSERT INTO t_user_feedback (VCH_NAME,VCH_EMAIL,VCH_MOBILENO,VCH_SUBJECT,VCH_FEEDBACK,DTM_CREATED_ON,INT_CREATED_BY,INT_PUBLISH_STATUS,INT_ARCHIVE_STATUS) VALUES(P_NAME,P_EMAIL,P_MOBILE_NO,P_SUBJECT,P_FEEDBACK,NOW(),P_CREATED_BY,P_PUBLISH_STATUS,P_ARC_STATUS);
END IF;

IF(P_ACTION='V')THEN
	SET @P_SQL='SELECT INT_FEEDBACK_ID, VCH_NAME, VCH_EMAIL, VCH_MOBILENO, VCH_SUBJECT, VCH_FEEDBACK, DTM_CREATED_ON, INT_CREATED_BY, INT_PUBLISH_STATUS, INT_ARCHIVE_STATUS FROM t_user_feedback WHERE BIT_DELETED_FLAG=0';
        
	IF(CHAR_LENGTH(P_NAME)>0)THEN
		SET @P_SQL  = CONCAT(@P_SQL,' AND VCH_NAME LIKE "%',P_NAME,'%"');
	END IF;
	SET @P_SQL=CONCAT(@P_SQL,' ORDER BY INT_FEEDBACK_ID ASC,DTM_CREATED_ON ASC');

    PREPARE STMT FROM @P_SQL;
    EXECUTE STMT;
END IF;
  
IF(P_ACTION='PG')THEN
	SET @START_REC=P_ID;
	SET @P_SQL='SELECT INT_FEEDBACK_ID, VCH_NAME, VCH_EMAIL, VCH_MOBILENO, VCH_SUBJECT, VCH_FEEDBACK, DTM_CREATED_ON, INT_CREATED_BY, INT_PUBLISH_STATUS, INT_ARCHIVE_STATUS FROM t_user_feedback WHERE BIT_DELETED_FLAG=0';
	IF(CHAR_LENGTH(P_NAME)>0)THEN
		SET @P_SQL  = CONCAT(@P_SQL,' AND VCH_NAME LIKE "%',P_NAME,'%"');
	END IF;
    SET @P_SQL=CONCAT(@P_SQL,' ORDER BY INT_FEEDBACK_ID ASC,DTM_CREATED_ON ASC LIMIT ?,10');

	PREPARE STMT FROM @P_SQL;
	EXECUTE STMT USING @START_REC;
END IF;

IF(P_ACTION='D')THEN
	UPDATE t_user_feedback SET BIT_DELETED_FLAG=1 WHERE INT_FEEDBACK_ID=P_ID;      
    SELECT '0';
END IF;

END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_USER_PERMISSION`
--

DROP PROCEDURE IF EXISTS `USP_USER_PERMISSION`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_USER_PERMISSION`(

  IN  P_ACTION      VARCHAR(3),

  IN  P_ID          INT,

  IN  P_USER_ID     INT,

  IN  P_GL_ID       INT,

  IN  P_PL_ID       INT,

  IN  P_AUTHOR      INT,

  IN  P_EDITOR      INT,

  IN  P_PUBLISHER   INT,

  IN  P_MANAGER     INT,

  IN  P_PRIVILEGE   INT,

  IN  P_CREATED_BY  INT,

  OUT P_OUT        VARCHAR(200)

)
BEGIN



  IF(P_ACTION='A')THEN

    INSERT INTO t_user_permission(INT_USER_ID,INT_GL_ID,INT_PL_ID,INT_AUTHOR,INT_EDITOR,INT_PUBLISHER,INT_MANAGER,INT_PRIVILEGE,INT_CREATED_BY) VALUES

    (P_USER_ID,P_GL_ID,P_PL_ID,P_AUTHOR,P_EDITOR,P_PUBLISHER,P_MANAGER,P_PRIVILEGE,P_CREATED_BY);

  END IF;



  IF(P_ACTION='U')THEN

    SET @CHECK  = (SELECT COUNT(1) FROM t_user_permission WHERE INT_USER_ID=P_USER_ID AND INT_GL_ID=P_GL_ID AND INT_PL_ID=P_PL_ID AND BIT_DELETED_FLAG=0);

    IF(@CHECK>0)THEN

      UPDATE t_user_permission SET INT_AUTHOR=P_AUTHOR,INT_EDITOR=P_EDITOR,INT_PUBLISHER=P_PUBLISHER,INT_MANAGER=P_MANAGER,INT_PRIVILEGE=P_PRIVILEGE,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

      WHERE INT_USER_ID=P_USER_ID AND INT_GL_ID=P_GL_ID AND INT_PL_ID=P_PL_ID AND BIT_DELETED_FLAG=0;

    ELSE

      INSERT INTO t_user_permission(INT_USER_ID,INT_GL_ID,INT_PL_ID,INT_AUTHOR,INT_EDITOR,INT_PUBLISHER,INT_MANAGER,INT_PRIVILEGE,INT_CREATED_BY) VALUES

      (P_USER_ID,P_GL_ID,P_PL_ID,P_AUTHOR,P_EDITOR,P_PUBLISHER,P_MANAGER,P_PRIVILEGE,P_CREATED_BY);

    END IF;

  END IF;



  IF(P_ACTION='S')THEN

    SET @P_SQL = "SELECT INT_USER_ID,INT_GL_ID,INT_PL_ID,INT_AUTHOR,INT_EDITOR,INT_PUBLISHER,INT_MANAGER,INT_PRIVILEGE,

    (SELECT P.VCH_PL_NAME FROM m_admin_primary_menu P WHERE P.INT_DELETED_FLAG=0 AND P.INT_ADMIN_GL_ID=INT_GL_ID AND P.INT_ADMIN_PL_ID=INT_PL_ID) AS PL_NAME,

    (SELECT P.VCH_URL FROM m_admin_primary_menu P WHERE P.INT_DELETED_FLAG=0 AND P.INT_ADMIN_GL_ID=INT_GL_ID AND P.INT_ADMIN_PL_ID=INT_PL_ID) AS PL_URL,

    (SELECT P.VCH_RELATED_PAGES FROM m_admin_primary_menu P WHERE P.INT_DELETED_FLAG=0 AND P.INT_ADMIN_GL_ID=INT_GL_ID AND P.INT_ADMIN_PL_ID=INT_PL_ID) AS RELATED_PAGES,

    (SELECT P.INT_FUNCTION_ID FROM m_admin_primary_menu P WHERE P.INT_DELETED_FLAG=0 AND P.INT_ADMIN_GL_ID=INT_GL_ID AND P.INT_ADMIN_PL_ID=INT_PL_ID) AS INT_FUNCTION_ID

    FROM t_user_permission WHERE BIT_DELETED_FLAG=0   ";



    IF(P_USER_ID>0)THEN

      SET @P_SQL = CONCAT(@P_SQL," AND INT_USER_ID=",P_USER_ID);

    END IF;



    IF(P_GL_ID>0)THEN

      SET @P_SQL = CONCAT(@P_SQL," AND INT_GL_ID=",P_GL_ID);

    END IF;



    IF(P_PL_ID>0)THEN

      SET @P_SQL = CONCAT(@P_SQL," AND INT_PL_ID=",P_PL_ID);

    END IF;



    SET @P_SQL = CONCAT(@P_SQL," ORDER BY INT_GL_ID,INT_PL_ID ASC");



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



  END IF;





  IF(P_ACTION='DG')THEN

    SET @P_SQL = "SELECT DISTINCT(INT_GL_ID) AS GL_ID,(SELECT G.VCH_GL_NAME FROM m_admin_global_menu G WHERE

     G.INT_DELETED_FLAG=0 AND G.INT_ADMIN_GL_ID=INT_GL_ID) AS GL_NAME,(SELECT G.VCH_IMAGE FROM m_admin_global_menu G WHERE

     G.INT_DELETED_FLAG=0 AND G.INT_ADMIN_GL_ID=INT_GL_ID) AS GL_IMAGE FROM t_user_permission WHERE BIT_DELETED_FLAG=0";



    IF(P_USER_ID>0)THEN

      SET @P_SQL = CONCAT(@P_SQL," AND INT_USER_ID=",P_USER_ID);

    END IF;



    SET @P_SQL = CONCAT(@P_SQL," ORDER BY INT_GL_ID,INT_PL_ID ASC");



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



  END IF;



  IF(P_ACTION='DP')THEN

    SET @P_SQL = "SELECT DISTINCT(INT_PL_ID) AS PL_ID FROM t_user_permission WHERE BIT_DELETED_FLAG=0";



    IF(P_USER_ID>0)THEN

      SET @P_SQL = CONCAT(@P_SQL," AND INT_USER_ID=",P_USER_ID);

    END IF;



    IF(P_GL_ID>0)THEN

      SET @P_SQL = CONCAT(@P_SQL," AND INT_GL_ID=",P_GL_ID);

    END IF;



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



  END IF;



  IF(P_ACTION='D')THEN

    SET @P_SQL = "DELETE FROM t_user_permission WHERE BIT_DELETED_FLAG=0";



    IF(P_USER_ID>0)THEN

      SET @P_SQL = CONCAT(@P_SQL," AND INT_USER_ID=",P_USER_ID);

    END IF;



    IF(P_GL_ID>0)THEN

      SET @P_SQL = CONCAT(@P_SQL," AND INT_GL_ID=",P_GL_ID);

    END IF;



    IF(P_PL_ID>0)THEN

      SET @P_SQL = CONCAT(@P_SQL," AND INT_PL_ID=",P_PL_ID);

    END IF;



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



  END IF;



END $$

DELIMITER ;

--
-- Procedure `ORBPM_devdb`.`USP_USER_PROFILE`
--

DROP PROCEDURE IF EXISTS `USP_USER_PROFILE`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` PROCEDURE `USP_USER_PROFILE`( 

  IN   P_ACTION          VARCHAR(2),

  IN   P_ID              INT,

  IN   P_PORTAL_TYPE     INT,

  IN   P_LOCATION_ID     INT,

  IN   P_DEPARTMENT_ID   INT,

  IN   P_DESIGNATION_ID  INT,

  IN   P_FULL_NAME       VARCHAR(50),

  IN   P_GENDER          INT,

  IN   P_BIRTH_DATE      VARCHAR(15),

  IN   P_JOINING_DATE    VARCHAR(15),

  IN   P_QUALIFICATION   VARCHAR(200),

  IN   P_SPECIALISATION  VARCHAR(100),

  IN   P_HOBBY           VARCHAR(500),

  IN   P_IMAGE           VARCHAR(100),

  IN   P_OFFICE_PHNO     VARCHAR(15),

  IN   P_MOBILE_NO       VARCHAR(10),

  IN   P_EMAIL           VARCHAR(30),

  IN   P_ADDRESS         VARCHAR(500),

  IN   P_USER_ID         VARCHAR(50),

  IN   P_PASSWORD        VARCHAR(50),

  IN   P_PUB_STATUS      INT,

  IN   P_PUBLISH_ON      INT,

  IN   P_ADMIN_PRIV        INT,

  IN   P_PASSWORD_CHECK  INT,

  IN   P_CREATED_BY      INT,

  IN   P_ARC_STATUS      INT,

  IN   P_SL_NO           INT,

  OUT  P_OUT             VARCHAR(200)



)
BEGIN





  IF (P_ACTION='CD')THEN

  SET @P_SQL=CONCAT("SELECT VCH_FULL_NAME FROM m_user_master WHERE BIT_DELETED_FLAG=0 AND VCH_FULL_NAME='",P_FULL_NAME,"'");



    IF(P_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL," AND INT_ID!=",P_ID);

    END IF;



    IF(P_DESIGNATION_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL," AND INT_DESIGNATION_ID=",P_DESIGNATION_ID);

    END IF;



    IF(P_DEPARTMENT_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL," AND INT_DEPARTMENT_ID=",P_DEPARTMENT_ID);

    END IF;



    IF(P_LOCATION_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL," AND INT_LOCATION_ID=",P_LOCATION_ID);

    END IF;



    IF(P_USER_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL," AND VCH_USER_ID=",P_USER_ID);

    END IF;



    IF(CHAR_LENGTH(P_EMAIL)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND VCH_EMAIL = '"),P_EMAIL,"'");

    END IF;



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



  END IF;





  IF(P_ACTION='A') THEN



     



      INSERT INTO m_user_master (INT_PORTAL_TYPE,INT_LOCATION_ID,INT_DEPARTMENT_ID,INT_DESIGNATION_ID,VCH_FULL_NAME,VCH_GENDER,VCH_DATE_OF_BIRTH,VCH_DATE_OF_JOIN,VCH_QUALIFICATION,VCH_SPECIALIZATION,VCH_HOBBY,VCH_IMAGE,VCH_PH_NO,VCH_MOBILE_NO,VCH_EMAIL,VCH_ADDRESS,

      VCH_USER_ID,VCH_PASSWORD,INT_ADMIN_PRIVILEGE,INT_PUBLISH_STATUS,INT_PREVILIGE_STATUS,INT_CREATED_BY,INT_SLNO)

       VALUES (P_PORTAL_TYPE,P_LOCATION_ID,P_DEPARTMENT_ID,P_DESIGNATION_ID,P_FULL_NAME,P_GENDER,P_BIRTH_DATE,P_JOINING_DATE,P_QUALIFICATION,P_SPECIALISATION,P_HOBBY,P_IMAGE,P_OFFICE_PHNO,P_MOBILE_NO,

       P_EMAIL,P_ADDRESS,P_USER_ID,P_PASSWORD,P_ADMIN_PRIV,P_PUB_STATUS,P_PUBLISH_ON,P_CREATED_BY,P_SL_NO);



      SELECT "User Profile Details Added Successfully";

    END IF;



  IF(P_ACTION='U') THEN



      UPDATE m_user_master SET INT_PORTAL_TYPE=P_PORTAL_TYPE,INT_LOCATION_ID=P_LOCATION_ID,INT_DEPARTMENT_ID=P_DEPARTMENT_ID,INT_DESIGNATION_ID=P_DESIGNATION_ID,VCH_FULL_NAME=P_FULL_NAME,VCH_GENDER=P_GENDER,VCH_DATE_OF_BIRTH=P_BIRTH_DATE,VCH_DATE_OF_JOIN=P_JOINING_DATE,

      VCH_QUALIFICATION=P_QUALIFICATION,VCH_SPECIALIZATION=P_SPECIALISATION,VCH_HOBBY=P_HOBBY,VCH_IMAGE=P_IMAGE,VCH_PH_NO=P_OFFICE_PHNO,VCH_MOBILE_NO=P_MOBILE_NO,

      VCH_EMAIL=P_EMAIL,VCH_ADDRESS=P_ADDRESS,VCH_PASSWORD=P_PASSWORD,VCH_USER_ID=P_USER_ID,INT_ADMIN_PRIVILEGE=P_ADMIN_PRIV,INT_PUBLISH_STATUS=P_PUB_STATUS,INT_PREVILIGE_STATUS=P_PUBLISH_ON,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

      WHERE INT_ID=P_ID AND BIT_DELETED_FLAG=0;

      SELECT "User Profile Details Updated Successfully";



    END IF;



  IF(P_ACTION='V') THEN

  SET @P_SQL="SELECT INT_ID,INT_PORTAL_TYPE,INT_LOCATION_ID,INT_DEPARTMENT_ID,INT_DESIGNATION_ID,VCH_FULL_NAME,VCH_GENDER,VCH_DATE_OF_BIRTH,VCH_DATE_OF_JOIN,VCH_QUALIFICATION,

  VCH_SPECIALIZATION,VCH_HOBBY,VCH_IMAGE,VCH_PH_NO,VCH_MOBILE_NO,VCH_EMAIL,VCH_ADDRESS,VCH_USER_ID,INT_ADMIN_PRIVILEGE,INT_PUBLISH_STATUS,INT_PREVILIGE_STATUS,INT_CREATED_BY,

  DTM_CREATED_ON,VCH_USER_ID,INT_SLNO FROM m_user_master WHERE BIT_DELETED_FLAG=0";





    IF(P_LOCATION_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND INT_LOCATION_ID = '"),P_LOCATION_ID,"'");

    END IF;

    IF(P_PORTAL_TYPE>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND INT_PORTAL_TYPE = '"),P_PORTAL_TYPE,"'");

    END IF;



    IF(P_DEPARTMENT_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND INT_DEPARTMENT_ID = '"),P_DEPARTMENT_ID,"'");

    END IF;



    IF(CHAR_LENGTH(P_FULL_NAME)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND VCH_FULL_NAME LIKE '%"),P_FULL_NAME,"%'");

    END IF;



    IF(CHAR_LENGTH(P_USER_ID)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND VCH_USER_ID = '"),P_USER_ID,"'");

    END IF;



    IF(CHAR_LENGTH(P_EMAIL)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND VCH_EMAIL = '"),P_EMAIL,"'");

    END IF;







     SET @P_SQL=CONCAT(@P_SQL," AND INT_ARCHIVE_STATUS=",P_ARC_STATUS," AND INT_PREVILIGE_STATUS!=0 ORDER BY INT_SLNO ASC");



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;



    END IF;



    IF(P_ACTION='HV') THEN

    SET @P_SQL="SELECT INT_ID,INT_PORTAL_TYPE,INT_LOCATION_ID,INT_DEPARTMENT_ID,INT_DESIGNATION_ID,VCH_FULL_NAME,VCH_GENDER,

    VCH_DATE_OF_BIRTH,VCH_DATE_OF_JOIN,VCH_QUALIFICATION,VCH_SPECIALIZATION,VCH_HOBBY,VCH_IMAGE,VCH_PH_NO,VCH_MOBILE_NO,VCH_EMAIL,

    VCH_ADDRESS,VCH_USER_ID,INT_ADMIN_PRIVILEGE,INT_PUBLISH_STATUS,INT_PREVILIGE_STATUS,INT_CREATED_BY,DTM_CREATED_ON,VCH_USER_ID,

    INT_SLNO FROM m_user_master WHERE BIT_DELETED_FLAG=0";



    



    IF(P_DEPARTMENT_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND INT_DEPARTMENT_ID = '"),P_DEPARTMENT_ID,"'");

    END IF;



    SET @P_SQL=CONCAT(@P_SQL," AND INT_ARCHIVE_STATUS=",P_ARC_STATUS," ORDER BY VCH_FULL_NAME ASC");



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



  END IF;



    IF(P_ACTION='HG') THEN



    SET @START_REC=P_ID;



    SET @P_SQL="SELECT INT_ID,INT_PORTAL_TYPE,INT_LOCATION_ID,INT_DEPARTMENT_ID,INT_DESIGNATION_ID,VCH_FULL_NAME,VCH_GENDER,

    VCH_DATE_OF_BIRTH,VCH_DATE_OF_JOIN,VCH_QUALIFICATION,VCH_SPECIALIZATION,VCH_HOBBY,VCH_IMAGE,VCH_PH_NO,VCH_MOBILE_NO,

    VCH_EMAIL,VCH_ADDRESS,VCH_USER_ID,INT_ADMIN_PRIVILEGE,INT_PUBLISH_STATUS,INT_PREVILIGE_STATUS,INT_CREATED_BY,DTM_CREATED_ON,

    VCH_USER_ID,INT_SLNO FROM m_user_master WHERE BIT_DELETED_FLAG=0";



    



    IF(P_DEPARTMENT_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND INT_DEPARTMENT_ID = '"),P_DEPARTMENT_ID,"'");

    END IF;



    SET @P_SQL=CONCAT(@P_SQL," AND INT_ARCHIVE_STATUS=",P_ARC_STATUS," AND INT_PREVILIGE_STATUS!=0 ORDER BY INT_SLNO ASC LIMIT ?,20");



    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT USING @START_REC;



  END IF;





IF(P_ACTION='XM') THEN

  SET @P_SQL="SELECT INT_ID,INT_PORTAL_TYPE,INT_LOCATION_ID,INT_DEPARTMENT_ID,INT_DESIGNATION_ID,VCH_FULL_NAME,VCH_GENDER,VCH_DATE_OF_BIRTH,VCH_DATE_OF_JOIN,VCH_QUALIFICATION,

  VCH_SPECIALIZATION,VCH_HOBBY,VCH_IMAGE,VCH_PH_NO,VCH_MOBILE_NO,VCH_EMAIL,VCH_ADDRESS,VCH_USER_ID,INT_ADMIN_PRIVILEGE,INT_PUBLISH_STATUS,INT_PREVILIGE_STATUS,INT_CREATED_BY,

  DTM_CREATED_ON,VCH_USER_ID,INT_SLNO FROM m_user_master WHERE BIT_DELETED_FLAG=0";





    IF(P_LOCATION_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND INT_LOCATION_ID = '"),P_LOCATION_ID,"'");

    END IF;

    IF(P_PORTAL_TYPE>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND INT_PORTAL_TYPE = '"),P_PORTAL_TYPE,"'");

    END IF;







    IF(P_DEPARTMENT_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND INT_DEPARTMENT_ID = '"),P_DEPARTMENT_ID,"'");

    END IF;



    IF(CHAR_LENGTH(P_FULL_NAME)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND VCH_FULL_NAME LIKE '%"),P_FULL_NAME,"%'");

    END IF;



    IF(CHAR_LENGTH(P_USER_ID)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND VCH_USER_ID = '"),P_USER_ID,"'");

    END IF;



    IF(CHAR_LENGTH(P_EMAIL)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND VCH_EMAIL = '"),P_EMAIL,"'");

    END IF;







     SET @P_SQL=CONCAT(@P_SQL," AND INT_ARCHIVE_STATUS=",P_ARC_STATUS," AND INT_PREVILIGE_STATUS IN(1,2) ORDER BY INT_SLNO ASC");



      PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;



    END IF;



  IF(P_ACTION='PG') THEN

  SET @START_REC=P_ID;

  SET @P_SQL="SELECT INT_ID,INT_PORTAL_TYPE,INT_LOCATION_ID,INT_DEPARTMENT_ID,INT_DESIGNATION_ID,VCH_FULL_NAME,VCH_GENDER,VCH_DATE_OF_BIRTH,VCH_DATE_OF_JOIN,VCH_QUALIFICATION,

  VCH_SPECIALIZATION,VCH_HOBBY,VCH_IMAGE,VCH_PH_NO,VCH_MOBILE_NO,VCH_EMAIL,VCH_ADDRESS,VCH_USER_ID,INT_ADMIN_PRIVILEGE,INT_PUBLISH_STATUS,INT_PREVILIGE_STATUS,INT_CREATED_BY,

  DTM_CREATED_ON,VCH_USER_ID,INT_SLNO FROM m_user_master WHERE BIT_DELETED_FLAG=0";



    IF(P_LOCATION_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND INT_LOCATION_ID = '"),P_LOCATION_ID,"'");

          END IF;







    IF(P_DEPARTMENT_ID>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND INT_DEPARTMENT_ID = '"),P_DEPARTMENT_ID,"'");

    END IF;

IF(P_PORTAL_TYPE>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND INT_PORTAL_TYPE = '"),P_PORTAL_TYPE,"'");

    END IF;



    IF(CHAR_LENGTH(P_FULL_NAME)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND VCH_FULL_NAME LIKE '%"),P_FULL_NAME,"%'");

    END IF;



    SET @P_SQL=CONCAT(@P_SQL," AND INT_ARCHIVE_STATUS=",P_ARC_STATUS," AND INT_PREVILIGE_STATUS!=0 ORDER BY INT_SLNO ASC LIMIT ?,10");





    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT USING @START_REC;

  END IF;



  IF(P_ACTION='R') THEN

     SELECT INT_ID,INT_PORTAL_TYPE,INT_LOCATION_ID,INT_DEPARTMENT_ID,INT_DESIGNATION_ID,VCH_FULL_NAME,VCH_GENDER,VCH_DATE_OF_BIRTH,VCH_DATE_OF_JOIN,VCH_QUALIFICATION,VCH_SPECIALIZATION,VCH_HOBBY,VCH_IMAGE,VCH_PH_NO,VCH_MOBILE_NO,VCH_EMAIL,VCH_ADDRESS,

      VCH_USER_ID,INT_ADMIN_PRIVILEGE,INT_PUBLISH_STATUS,INT_PREVILIGE_STATUS,INT_CREATED_BY,DTM_CREATED_ON,INT_SLNO,VCH_PASSWORD FROM m_user_master WHERE INT_ID=P_ID AND BIT_DELETED_FLAG=0;

  END IF;



  IF(P_ACTION='S') THEN

      SET @P_SQL="SELECT INT_ID,INT_PORTAL_TYPE,INT_LOCATION_ID,INT_DEPARTMENT_ID,INT_DESIGNATION_ID,VCH_FULL_NAME,VCH_GENDER,VCH_DATE_OF_BIRTH,VCH_DATE_OF_JOIN,VCH_QUALIFICATION,VCH_SPECIALIZATION,VCH_HOBBY,VCH_IMAGE,VCH_PH_NO,VCH_MOBILE_NO,VCH_EMAIL,VCH_ADDRESS,

      VCH_USER_ID,INT_ADMIN_PRIVILEGE,INT_PUBLISH_STATUS,INT_PREVILIGE_STATUS,INT_CREATED_BY,DTM_CREATED_ON FROM m_user_master WHERE BIT_DELETED_FLAG=0 AND INT_ARCHIVE_STATUS=0";



    IF(P_ID>0)THEN

      SET @P_SQL=CONCAT(@P_SQL," AND INT_ID!=",P_ID);

    END IF;



    IF(CHAR_LENGTH(P_USER_ID)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND VCH_USER_ID = '"),P_USER_ID,"'");

    END IF;



    IF(CHAR_LENGTH(P_EMAIL)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND VCH_EMAIL = '"),P_EMAIL,"'");

    END IF;





    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;



  END IF;



   IF(P_ACTION='IN')THEN

    UPDATE m_user_master SET INT_PUBLISH_STATUS=2,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

    WHERE  INT_ID=P_ID;

    SELECT "User Inactive Successfully";

  END IF;



   IF(P_ACTION='AC')THEN

    UPDATE m_user_master SET INT_PUBLISH_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW()

    WHERE  INT_ID=P_ID;

    SELECT "User activated Successfully";

  END IF;





    IF(P_ACTION='AR')THEN

    SET @P_TYPE    = (SELECT INT_PORTAL_TYPE FROM m_user_master  WHERE BIT_DELETED_FLAG=0 AND INT_ID=P_ID);

    SET @SL_NO     = (select int_slno from m_user_master where  BIT_DELETED_FLAG=0 AND INT_PORTAL_TYPE=@P_TYPE and int_id=P_ID);

    SET @NO_REC    = (select count(1) from m_user_master  where INT_PORTAL_TYPE=@P_TYPE);



    UPDATE m_user_master SET INT_ARCHIVE_STATUS=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_ID=P_ID;

    UPDATE m_user_master SET INT_SLNO=(INT_SLNO-1)  WHERE BIT_DELETED_FLAG=0 and

    INT_PORTAL_TYPE=@P_TYPE  and INT_SLNO between @SL_NO and @NO_REC  ;

    SELECT "User Profile Archived Successfully";

  END IF;





  IF(P_ACTION='D')THEN

   UPDATE m_user_master SET BIT_DELETED_FLAG=1,INT_UPDATED_BY=P_CREATED_BY,DTM_UPDATED_ON=NOW() WHERE  INT_ID=P_ID;

   SELECT 0;

  END IF;



  



    IF(P_ACTION='VP')THEN



    SET @P_SQL="SELECT INT_ID,VCH_USER_ID,VCH_PASSWORD,INT_DESIGNATION_ID,INT_ADMIN_PRIVILEGE,INT_PREVILIGE_STATUS,

    INT_PUBLISH_STATUS,INT_PORTAL_TYPE,VCH_FULL_NAME,VCH_IMAGE,VCH_EMAIL,INT_PASSWORD_CHECK,INT_ARCHIVE_STATUS

    FROM m_user_master WHERE BIT_DELETED_FLAG=0 AND INT_ARCHIVE_STATUS = 0";



    IF(CHAR_LENGTH(P_USER_ID)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND VCH_USER_ID = '"),P_USER_ID,"'");

    END IF;



    IF(CHAR_LENGTH(P_PASSWORD)>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND VCH_PASSWORD = '"),P_PASSWORD,"'");

    END IF;

    PREPARE STMT FROM @P_SQL;

      EXECUTE STMT;



    END IF;

   

  IF(P_ACTION='CP')THEN

  UPDATE m_user_master SET VCH_PASSWORD=P_PASSWORD,INT_PASSWORD_CHECK=P_PASSWORD_CHECK,INT_CREATED_BY=P_CREATED_BY WHERE VCH_USER_ID=P_USER_ID AND BIT_DELETED_FLAG=0;

  SELECT "Password Updated Successfully";

  END IF;





  IF(P_ACTION='CS')THEN

    SET @P_SQL=CONCAT("SELECT VCH_FULL_NAME FROM m_user_master WHERE BIT_DELETED_FLAG=0 AND INT_SLNO='",P_SL_NO,"'");



    IF(P_ID>0)THEN

        SET @P_SQL=CONCAT(@P_SQL," AND INT_ID!=",P_ID);

      END IF;

    IF(P_PORTAL_TYPE>0) THEN

      SET @P_SQL=CONCAT(CONCAT(@P_SQL," AND INT_PORTAL_TYPE = '"),P_PORTAL_TYPE,"'");

    END IF;

 END IF;



 IF(P_ACTION='CM')THEN

    SET @P_SQL="SELECT COALESCE(MAX(INT_SLNO),0)+1 as MAX_SL FROM m_user_master WHERE BIT_DELETED_FLAG=0 AND INT_ARCHIVE_STATUS=0 ";

    IF(P_PORTAL_TYPE>0)THEN

      SET @P_SQL=CONCAT(@P_SQL," AND INT_PORTAL_TYPE=",P_PORTAL_TYPE);

    END IF;

    PREPARE STMT FROM @P_SQL;

    EXECUTE STMT;

  END IF;





   IF(P_ACTION='US')THEN



    SET @PA_ID  = (SELECT INT_ID FROM m_user_master  WHERE BIT_DELETED_FLAG=0 AND INT_SLNO=P_SL_NO);



    SET @P_SL  = (SELECT INT_SLNO FROM m_user_master WHERE BIT_DELETED_FLAG=0 AND INT_ID=P_ID);



    UPDATE m_user_master SET INT_SLNO=@P_SL  WHERE INT_ID=@PA_ID;



    UPDATE m_user_master SET INT_SLNO=P_SL_NO WHERE INT_ID=P_ID;

      SELECT "Sl No  Updated Successfully";

  END IF;



 IF(P_ACTION='PS')THEN

    SET @P_TYPE    = (SELECT INT_PORTAL_TYPE FROM m_user_master  WHERE BIT_DELETED_FLAG=0 AND INT_ID=P_ID);

    PREPARE STMT FROM @P_TYPE;

    EXECUTE STMT;

  END IF;



END $$

DELIMITER ;

--
-- Function `ORBPM_devdb`.`FN_ALL_PARENT_VALUES_NAMES`
--

DROP FUNCTION IF EXISTS `FN_ALL_PARENT_VALUES_NAMES`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` FUNCTION `FN_ALL_PARENT_VALUES_NAMES`(P_NODE    INT,P_TYPE  INT) RETURNS varchar(640) CHARSET latin1
BEGIN
SET @ALL_NODE_IDS = P_NODE;
SET @menu_type = P_TYPE;
SET @ALL_NODE_NAMES ='';

         SET @INT_NODE_ID = P_NODE;
         WHILE(@INT_NODE_ID >0) DO
          
         SET @INT_NODE_ID = (SELECT intParentId FROM 
t_menus WHERE intPageId=@INT_NODE_ID AND tinMenuType = @menu_type);

SET @INT_NODE_NAME = (SELECT vchName FROM 
t_pages WHERE bitDeletedFlag =0 AND 
intPageId=@INT_NODE_ID AND intPublishStatus = 2);

SET @INT_NODE_ALIAS = (SELECT vchPageAlias FROM 
t_pages WHERE bitDeletedFlag =0 AND 
intPageId=@INT_NODE_ID AND intPublishStatus = 2);

         IF(@INT_NODE_ID > 0 or CHAR_LENGTH(@INT_NODE_NAME)>0) THEN
          SET @ALL_NODE_NAMES = CONCAT(@ALL_NODE_NAMES,'_',@INT_NODE_ID) ;
         END IF;
 END WHILE;
  SET @ALL_NODE_IDS = TRIM(BOTH '_' FROM @ALL_NODE_NAMES);       
RETURN @ALL_NODE_IDS;
END $$

DELIMITER ;

--
-- Function `ORBPM_devdb`.`FN_GET_ACKNO`
--

DROP FUNCTION IF EXISTS `FN_GET_ACKNO`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` FUNCTION `FN_GET_ACKNO`(
	
) RETURNS varchar(64) CHARSET utf8
BEGIN


		SET @CUR_YEAR	= DATE_FORMAT(NOW(),'%y');

	    SELECT COUNT(1)+1 INTO @reg_max_no FROM t_road_survey ;            
		SET @P_ID 		= LPAD(@reg_max_no,6,0);
            
        SET @ACK_STR	= CONCAT('A',@P_ID);
		RETURN @ACK_STR;
		


END $$

DELIMITER ;

--
-- Function `ORBPM_devdb`.`SPLIT_STR`
--

DROP FUNCTION IF EXISTS `SPLIT_STR`;
DELIMITER $$

CREATE DEFINER=`orbpmDevu1`@`%` FUNCTION `SPLIT_STR`(



x VARCHAR(255),

  delim VARCHAR(12),

  pos INT



) RETURNS varchar(255) CHARSET latin1
RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(x, delim, pos),

       LENGTH(SUBSTRING_INDEX(x, delim, pos -1)) + 1),

       delim, '') $$

DELIMITER ;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
