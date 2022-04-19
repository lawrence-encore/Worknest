-- MariaDB dump 10.19  Distrib 10.4.20-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: worknestdb
-- ------------------------------------------------------
-- Server version	10.4.20-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tblallowance`
--

DROP TABLE IF EXISTS `tblallowance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblallowance` (
  `ALLOWANCE_ID` varchar(100) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `ALLOWANCE_TYPE` varchar(100) NOT NULL,
  `PAYROLL_ID` date DEFAULT NULL,
  `PAYROLL_DATE` date NOT NULL,
  `AMOUNT` double DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ALLOWANCE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblallowance`
--

LOCK TABLES `tblallowance` WRITE;
/*!40000 ALTER TABLE `tblallowance` DISABLE KEYS */;
INSERT INTO `tblallowance` VALUES ('1','7','2',NULL,'0000-00-00',500,'TL-818','UPD->LDAGULTO->2022-04-06 04:04:41'),('10','7','2',NULL,'0000-00-00',1000,'TL-827','INS->LDAGULTO->2022-04-06 03:29:23'),('11','7','2',NULL,'0000-00-00',1000,'TL-828','INS->LDAGULTO->2022-04-06 03:29:23'),('12','7','2',NULL,'0000-00-00',1000,'TL-829','INS->LDAGULTO->2022-04-06 03:29:23'),('13','7','2',NULL,'0000-00-00',1000,'TL-830','INS->LDAGULTO->2022-04-06 03:29:23'),('14','7','2',NULL,'0000-00-00',500,'TL-831','UPD->LDAGULTO->2022-04-06 04:04:55'),('15','7','2',NULL,'0000-00-00',1000,'TL-832','INS->LDAGULTO->2022-04-06 03:30:12'),('16','7','2',NULL,'0000-00-00',1000,'TL-833','INS->LDAGULTO->2022-04-06 03:30:12'),('17','7','2',NULL,'0000-00-00',1000,'TL-834','INS->LDAGULTO->2022-04-06 03:30:12'),('18','7','2',NULL,'0000-00-00',1000,'TL-835','INS->LDAGULTO->2022-04-06 03:30:13'),('19','7','2',NULL,'0000-00-00',1000,'TL-836','INS->LDAGULTO->2022-04-06 03:30:13'),('2','7','2',NULL,'0000-00-00',1000,'TL-819','INS->LDAGULTO->2022-04-06 03:29:21'),('20','7','2',NULL,'0000-00-00',1000,'TL-837','INS->LDAGULTO->2022-04-06 03:30:13'),('21','7','2',NULL,'0000-00-00',1000,'TL-838','INS->LDAGULTO->2022-04-06 03:30:13'),('22','7','2',NULL,'0000-00-00',1000,'TL-839','INS->LDAGULTO->2022-04-06 03:30:13'),('23','7','2',NULL,'0000-00-00',1000,'TL-840','INS->LDAGULTO->2022-04-06 03:30:13'),('24','7','2',NULL,'0000-00-00',1000,'TL-841','INS->LDAGULTO->2022-04-06 03:30:13'),('25','7','2',NULL,'0000-00-00',1000,'TL-842','INS->LDAGULTO->2022-04-06 03:30:14'),('26','7','2',NULL,'0000-00-00',1000,'TL-843','INS->LDAGULTO->2022-04-06 03:30:14'),('3','7','2',NULL,'0000-00-00',1000,'TL-820','INS->LDAGULTO->2022-04-06 03:29:21'),('4','7','2',NULL,'0000-00-00',1000,'TL-821','INS->LDAGULTO->2022-04-06 03:29:22'),('5','7','2',NULL,'0000-00-00',1000,'TL-822','INS->LDAGULTO->2022-04-06 03:29:22'),('6','7','2',NULL,'0000-00-00',1000,'TL-823','INS->LDAGULTO->2022-04-06 03:29:22'),('65','7','2',NULL,'2022-01-01',10000,'TL-925','INS->LDAGULTO->2022-04-11 09:14:59'),('66','7','2',NULL,'2022-02-01',10000,'TL-926','INS->LDAGULTO->2022-04-11 09:14:59'),('67','7','2',NULL,'2022-03-01',10000,'TL-927','INS->LDAGULTO->2022-04-11 09:14:59'),('68','7','2',NULL,'2022-04-01',10000,'TL-928','INS->LDAGULTO->2022-04-11 09:15:00'),('69','7','2',NULL,'2022-05-01',10000,'TL-929','INS->LDAGULTO->2022-04-11 09:15:00'),('7','7','2',NULL,'0000-00-00',1000,'TL-824','INS->LDAGULTO->2022-04-06 03:29:22'),('70','7','2',NULL,'2022-06-01',10000,'TL-930','INS->LDAGULTO->2022-04-11 09:15:00'),('71','7','2',NULL,'2022-07-01',10000,'TL-931','INS->LDAGULTO->2022-04-11 09:15:00'),('72','7','2',NULL,'2022-08-01',10000,'TL-932','INS->LDAGULTO->2022-04-11 09:15:00'),('73','7','2',NULL,'2022-09-01',10000,'TL-933','INS->LDAGULTO->2022-04-11 09:15:00'),('74','7','2',NULL,'2022-10-01',10000,'TL-934','INS->LDAGULTO->2022-04-11 09:15:01'),('75','7','2',NULL,'2022-11-01',10000,'TL-935','INS->LDAGULTO->2022-04-11 09:15:01'),('76','7','2',NULL,'2022-12-01',10000,'TL-936','INS->LDAGULTO->2022-04-11 09:15:01'),('8','7','2',NULL,'0000-00-00',1000,'TL-825','INS->LDAGULTO->2022-04-06 03:29:22'),('9','7','2',NULL,'0000-00-00',1000,'TL-826','INS->LDAGULTO->2022-04-06 03:29:23');
/*!40000 ALTER TABLE `tblallowance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblallowancetype`
--

DROP TABLE IF EXISTS `tblallowancetype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblallowancetype` (
  `ALLOWANCE_TYPE_ID` varchar(100) NOT NULL,
  `ALLOWANCE_TYPE` varchar(50) NOT NULL,
  `TAXABLE` varchar(5) NOT NULL,
  `DESCRIPTION` varchar(100) NOT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ALLOWANCE_TYPE_ID`),
  KEY `allowance_type_index` (`ALLOWANCE_TYPE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblallowancetype`
--

LOCK TABLES `tblallowancetype` WRITE;
/*!40000 ALTER TABLE `tblallowancetype` DISABLE KEYS */;
INSERT INTO `tblallowancetype` VALUES ('2','Rice Subsidy','NTAX','Allowance for rice subsidy.','TL-802','UPD->LDAGULTO->2022-04-05 10:54:21');
/*!40000 ALTER TABLE `tblallowancetype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblattendanceadjustment`
--

DROP TABLE IF EXISTS `tblattendanceadjustment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblattendanceadjustment` (
  `REQUEST_ID` varchar(100) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `ATTENDANCE_ID` varchar(100) NOT NULL,
  `TIME_IN_DATE` date DEFAULT NULL,
  `TIME_IN` time DEFAULT NULL,
  `TIME_IN_DATE_ADJUSTED` date DEFAULT NULL,
  `TIME_IN_ADJUSTED` time DEFAULT NULL,
  `TIME_OUT_DATE` date DEFAULT NULL,
  `TIME_OUT` time DEFAULT NULL,
  `TIME_OUT_DATE_ADJUSTED` date DEFAULT NULL,
  `TIME_OUT_ADJUSTED` time DEFAULT NULL,
  `STATUS` varchar(10) DEFAULT NULL,
  `REASON` varchar(500) DEFAULT NULL,
  `FILE_PATH` varchar(500) NOT NULL,
  `SANCTION` int(1) NOT NULL,
  `REQUEST_DATE` date DEFAULT NULL,
  `REQUEST_TIME` time DEFAULT NULL,
  `FOR_RECOMMENDATION_DATE` date DEFAULT NULL,
  `FOR_RECOMMENDATION_TIME` time DEFAULT NULL,
  `RECOMMENDATION_DATE` date DEFAULT NULL,
  `RECOMMENDATION_TIME` time DEFAULT NULL,
  `RECOMMENDED_BY` varchar(50) DEFAULT NULL,
  `DECISION_REMARKS` varchar(500) DEFAULT NULL,
  `DECISION_DATE` date DEFAULT NULL,
  `DECISION_TIME` time DEFAULT NULL,
  `DECISION_BY` varchar(50) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`REQUEST_ID`),
  KEY `attendance_adjustment_index` (`REQUEST_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblattendanceadjustment`
--

LOCK TABLES `tblattendanceadjustment` WRITE;
/*!40000 ALTER TABLE `tblattendanceadjustment` DISABLE KEYS */;
INSERT INTO `tblattendanceadjustment` VALUES ('1','7','','2022-03-11','13:14:00','2022-03-12','12:30:00',NULL,NULL,NULL,NULL,'CAN','Test','./attendance_adjustment/cgf5r9ki52.pdf',0,'2022-03-17','10:31:48','2022-03-17','14:22:49',NULL,NULL,NULL,'Test','2022-03-17','14:25:13','LDAGULTO','TL-640','CAN->LDAGULTO->2022-03-17 02:25:13'),('10','7','25','2022-03-24','09:38:00','2022-03-24','08:30:00','2022-03-24','17:33:00','2022-03-24','17:33:00','APV','Test','./attendance_adjustment/ck3not9eun.pdf',0,'2022-03-24','14:16:28','2022-03-24','14:16:53','2022-03-24','14:17:01','LDAGULTO','','2022-03-24','14:33:49','LDAGULTO','TL-724','APV->LDAGULTO->2022-03-24 02:33:49'),('11','7','24','2022-03-23','10:15:00','2022-03-23','08:30:00','2022-03-23','19:20:00','2022-03-23','19:20:00','APV','Test','./attendance_adjustment/zyo16n8bkj.pdf',0,'2022-03-24','14:16:41','2022-03-24','14:16:54','2022-03-24','14:17:02','LDAGULTO','','2022-03-24','14:32:55','LDAGULTO','TL-725','APV->LDAGULTO->2022-03-24 02:32:55'),('12','7','28','2022-03-18','09:57:00','2022-03-18','08:30:00','2022-03-18','09:57:00','2022-03-18','21:57:00','APV','Test','./attendance_adjustment/ypkbp8utoi.pdf',0,'2022-03-24','14:59:30','2022-03-24','14:59:53','2022-03-24','15:00:01','LDAGULTO','','2022-03-24','15:00:14','LDAGULTO','TL-726','APV->LDAGULTO->2022-03-24 03:00:14'),('13','7','27','2022-03-17','09:56:00','2022-03-17','08:30:00','2022-03-17','21:56:00','2022-03-17','21:56:00','APV','Test','./attendance_adjustment/v1dkc0i59k.pdf',0,'2022-03-24','14:59:44','2022-03-24','14:59:54','2022-03-24','15:00:03','LDAGULTO','','2022-03-24','15:03:11','LDAGULTO','TL-727','APV->LDAGULTO->2022-03-24 03:03:11'),('14','7','27','2022-03-17','08:30:00','2022-03-17','08:30:00','2022-03-17','21:56:00','2022-03-17','21:56:00','APV','Test','./attendance_adjustment/i9snxnskvf.pdf',0,'2022-03-24','15:04:04','2022-03-24','15:04:28','2022-03-24','15:04:34','LDAGULTO','','2022-03-24','15:04:41','LDAGULTO','TL-728','APV->LDAGULTO->2022-03-24 03:04:41'),('15','7','27','2022-03-17','08:30:00','2022-03-17','07:30:00','2022-03-17','21:56:00','2022-03-17','17:29:00','APV','Test','./attendance_adjustment/82h5m1hi92.pdf',0,'2022-03-24','15:14:19','2022-03-24','15:14:27','2022-03-24','15:14:33','LDAGULTO','','2022-03-24','15:14:39','LDAGULTO','TL-729','APV->LDAGULTO->2022-03-24 03:14:39'),('16','7','29','2022-04-14','09:09:00','2022-04-14','08:30:00','2022-04-14','16:31:00','2022-04-14','17:30:00','APV','Test','./attendance_adjustment/hphy8zx1si.png',2022,'2022-04-15','19:58:45','2022-04-15','19:58:51','2022-04-15','19:59:11','LDAGULTO','Test','0000-00-00','14:56:52','LDAGULTO','TL-1108','APV->LDAGULTO->2022-04-16 02:56:52'),('2','7','','2022-03-10','14:09:00','2022-03-10','08:30:00','2022-03-10','14:11:00','2022-03-10','17:30:00','CAN','Test','./attendance_adjustment/q0whfhzg67.pdf',0,'2022-03-17','14:31:29','2022-03-17','14:31:53',NULL,NULL,NULL,'Test','2022-03-17','14:32:08','LDAGULTO','TL-641','CAN->LDAGULTO->2022-03-17 02:32:08'),('3','7','','2022-03-11','13:14:00','2022-03-11','13:14:00',NULL,NULL,NULL,NULL,'CAN','Test','./attendance_adjustment/c2mq2cuenw.pdf',0,'2022-03-18','11:43:02','2022-03-18','11:43:08','2022-03-18','16:02:30','LDAGULTO','Test','2022-03-23','08:32:07','LDAGULTO','TL-656','CAN->LDAGULTO->2022-03-23 08:32:07'),('4','7','','2022-03-10','14:09:00','2022-03-10','14:09:00','2022-03-10','14:11:00','2022-03-10','14:11:00','CAN','Test','./attendance_adjustment/pz6rlxbhsu.pdf',0,'2022-03-18','11:44:16','2022-03-18','11:44:22','2022-03-18','16:02:36','LDAGULTO','Test','2022-03-23','08:32:09','LDAGULTO','TL-657','CAN->LDAGULTO->2022-03-23 08:32:09'),('5','7','','2022-03-10','14:09:00','2022-03-10','14:09:00','2022-03-10','14:11:00','2022-03-10','14:11:00','CAN','Test','./attendance_adjustment/68r6xbyoga.pdf',0,'2022-03-21','09:12:29',NULL,NULL,NULL,NULL,NULL,'Test','2022-03-21','09:24:19','LDAGULTO','TL-670','CAN->LDAGULTO->2022-03-21 09:24:19'),('6','7','','2022-03-11','13:14:00','2022-03-11','13:14:00',NULL,NULL,NULL,NULL,'CAN','Test','./attendance_adjustment/umigjouw75.pdf',0,'2022-03-22','11:20:39',NULL,NULL,'2022-03-22','11:22:55','LDAGULTO','Test','2022-03-23','08:32:08','LDAGULTO','TL-680','CAN->LDAGULTO->2022-03-23 08:32:08'),('7','7','','2022-03-11','13:14:00','2022-03-11','13:14:00',NULL,NULL,NULL,NULL,'CAN','Test','./attendance_adjustment/6iv4uwi7ca.pdf',0,'2022-03-22','11:35:21',NULL,NULL,'2022-03-22','11:36:04','LDAGULTO','Test','2022-03-23','08:32:09','LDAGULTO','TL-682','CAN->LDAGULTO->2022-03-23 08:32:09'),('8','7','','2022-03-11','13:14:00','2022-03-11','17:30:00',NULL,NULL,NULL,NULL,'REJ','Test Rejection','./attendance_adjustment/xd80ss61fa.pdf',0,'2022-03-23','09:59:15','2022-03-23','09:59:50',NULL,NULL,NULL,'Test','2022-03-23','10:00:38','LDAGULTO','TL-709','REJ->LDAGULTO->2022-03-23 10:00:38'),('9','7','','2022-03-10','14:09:00','2022-03-10','08:30:00','2022-03-10','14:11:00','2022-03-10','17:30:00','REJ','Test Approval','./attendance_adjustment/7h5hvk9mlq.pdf',0,'2022-03-23','09:59:44','2022-03-23','09:59:55','2022-03-23','10:03:02','LDAGULTO','Test','2022-03-24','11:20:24','LDAGULTO','TL-710','REJ->LDAGULTO->2022-03-24 11:20:24');
/*!40000 ALTER TABLE `tblattendanceadjustment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblattendanceadjustmentexception`
--

DROP TABLE IF EXISTS `tblattendanceadjustmentexception`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblattendanceadjustmentexception` (
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblattendanceadjustmentexception`
--

LOCK TABLES `tblattendanceadjustmentexception` WRITE;
/*!40000 ALTER TABLE `tblattendanceadjustmentexception` DISABLE KEYS */;
INSERT INTO `tblattendanceadjustmentexception` VALUES ('','INS->LDAGULTO->2022-03-23 08:22:49');
/*!40000 ALTER TABLE `tblattendanceadjustmentexception` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblattendancecreation`
--

DROP TABLE IF EXISTS `tblattendancecreation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblattendancecreation` (
  `REQUEST_ID` varchar(100) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `TIME_IN_DATE` date DEFAULT NULL,
  `TIME_IN` time DEFAULT NULL,
  `TIME_OUT_DATE` date DEFAULT NULL,
  `TIME_OUT` time DEFAULT NULL,
  `STATUS` varchar(10) DEFAULT NULL,
  `REASON` varchar(500) DEFAULT NULL,
  `FILE_PATH` varchar(500) NOT NULL,
  `SANCTION` int(1) NOT NULL,
  `REQUEST_DATE` date DEFAULT NULL,
  `REQUEST_TIME` time DEFAULT NULL,
  `FOR_RECOMMENDATION_DATE` date DEFAULT NULL,
  `FOR_RECOMMENDATION_TIME` time DEFAULT NULL,
  `RECOMMENDATION_DATE` date DEFAULT NULL,
  `RECOMMENDATION_TIME` time DEFAULT NULL,
  `RECOMMENDED_BY` varchar(50) DEFAULT NULL,
  `DECISION_REMARKS` varchar(500) DEFAULT NULL,
  `DECISION_DATE` date DEFAULT NULL,
  `DECISION_TIME` time DEFAULT NULL,
  `DECISION_BY` varchar(50) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`REQUEST_ID`),
  KEY `attendance_creation_index` (`REQUEST_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblattendancecreation`
--

LOCK TABLES `tblattendancecreation` WRITE;
/*!40000 ALTER TABLE `tblattendancecreation` DISABLE KEYS */;
INSERT INTO `tblattendancecreation` VALUES ('10','7','2022-03-02','11:24:00','2022-03-02','11:24:00','REJ','Test','./attendance_creation/1znfu6cpus.pdf',0,'2022-03-18','11:25:13','2022-03-18','14:22:56','2022-03-18','14:48:29','LDAGULTO','Test','2022-03-24','09:21:41','LDAGULTO','TL-654','REJ->LDAGULTO->2022-03-24 09:21:41'),('11','7','2022-03-04','11:26:00','2022-03-04','11:26:00','CAN','Test','./attendance_creation/7unpgygmev.pdf',0,'2022-03-18','11:26:12','2022-03-18','14:22:58','2022-03-18','14:50:55','LDAGULTO','Test','2022-03-24','09:21:50','LDAGULTO','TL-655','CAN->LDAGULTO->2022-03-24 09:21:50'),('12','7','2022-03-04','11:34:00','2022-03-10','11:34:00','APV','Test','./attendance_creation/f29256dppj.pdf',0,'2022-03-22','11:34:19',NULL,NULL,'2022-03-22','11:34:22','LDAGULTO','','2022-03-24','09:25:35','LDAGULTO','TL-681','APV->LDAGULTO->2022-03-24 09:25:35'),('13','7','2022-03-03','11:41:00','2022-03-03','11:41:00','APV','Test','./attendance_creation/weghy3z015.pdf',0,'2022-03-22','11:41:18',NULL,NULL,'2022-03-22','11:41:21','LDAGULTO','Test','2022-03-24','09:56:01','LDAGULTO','TL-683','APV->LDAGULTO->2022-03-24 09:56:01'),('14','7','2022-03-03','11:50:00',NULL,NULL,'CAN','Test','./attendance_creation/dlwy5wupsz.pdf',0,'2022-03-22','11:50:57',NULL,NULL,'2022-03-22','11:51:03','LDAGULTO','Test','2022-03-24','09:56:27','LDAGULTO','TL-684','CAN->LDAGULTO->2022-03-24 09:56:27'),('15','7','2022-03-03','11:53:00',NULL,NULL,'CAN','Test','./attendance_creation/djxjaotvca.pdf',0,'2022-03-22','11:53:23',NULL,NULL,'2022-03-22','11:53:25','LDAGULTO','Test','2022-03-24','09:56:28','LDAGULTO','TL-685','CAN->LDAGULTO->2022-03-24 09:56:28'),('16','7','2022-03-23','09:08:00','2022-03-23','17:36:00','CAN','Test','./attendance_creation/sjnrkqmhaa.pdf',0,'2022-03-23','09:08:44','2022-03-23','09:08:53',NULL,NULL,NULL,'Test','2022-03-23','10:11:08','LDAGULTO','TL-700','CAN->LDAGULTO->2022-03-23 10:11:08'),('17','7','2022-03-23','10:03:00','2022-03-23','17:46:00','REJ','Test Rejection','./attendance_creation/fdeuk2pidw.pdf',0,'2022-03-23','10:04:05','2022-03-23','10:04:45',NULL,NULL,NULL,'Test','2022-03-23','10:10:50','LDAGULTO','TL-711','REJ->LDAGULTO->2022-03-23 10:10:50'),('18','7','2022-03-23','07:21:00','2022-03-23','17:42:00','CAN','Test Approval','./attendance_creation/b5p2vhlhwy.pdf',0,'2022-03-23','10:04:42','2022-03-23','10:04:50','2022-03-23','10:10:56','LDAGULTO','Test','2022-03-24','09:56:28','LDAGULTO','TL-712','CAN->LDAGULTO->2022-03-24 09:56:28'),('19','7','2022-03-03','10:12:00','2022-03-04','10:12:00','CAN','Test','./attendance_creation/aiy08y3vo1.pdf',0,'2022-03-23','10:13:06','2022-03-23','10:13:08','2022-03-23','10:13:20','LDAGULTO','Test','2022-03-24','09:56:29','LDAGULTO','TL-713','CAN->LDAGULTO->2022-03-24 09:56:29'),('20','7','2022-03-23','10:15:00','2022-03-23','19:20:00','APV','Test','./attendance_creation/2ys9ojc1cn.pdf',0,'2022-03-23','10:15:49','2022-03-23','10:15:51','2022-03-23','10:16:22','LDAGULTO','','2022-03-24','09:31:28','LDAGULTO','TL-714','APV->LDAGULTO->2022-03-24 09:31:28'),('21','7','2022-03-24','09:38:00','2022-03-24','17:33:00','APV','Test','./attendance_creation/8qv6l6px5m.pdf',0,'2022-03-24','09:38:44','2022-03-24','09:38:47','2022-03-24','09:38:55','LDAGULTO','','2022-03-24','09:39:12','LDAGULTO','TL-717','APV->LDAGULTO->2022-03-24 09:39:12'),('22','7','2022-03-17','09:56:00','2022-03-17','21:56:00','APV','Test','./attendance_creation/twylu6zhox.pdf',0,'2022-03-24','09:56:58','2022-03-24','09:57:36','2022-03-24','09:58:27','LDAGULTO','','2022-03-24','10:00:37','LDAGULTO','TL-720','APV->LDAGULTO->2022-03-24 10:00:37'),('23','7','2022-03-18','09:57:00','2022-03-18','09:57:00','APV','Test','./attendance_creation/xmal0m7sfs.pdf',0,'2022-03-24','09:57:14','2022-03-24','09:58:50','2022-03-24','09:59:59','LDAGULTO','','2022-03-24','10:00:38','LDAGULTO','TL-721','APV->LDAGULTO->2022-03-24 10:00:38'),('24','7','2022-04-15','08:30:00','2022-04-15','17:30:00','APV','Test','./attendance_creation/sf1lefnj3k.jpg',1,'2022-04-16','15:34:39','2022-04-16','15:34:41','2022-04-16','15:34:56','LDAGULTO','','2022-04-16','15:35:29','LDAGULTO','TL-1109','APV->LDAGULTO->2022-04-16 03:35:29'),('6','7','2022-03-01','10:19:00','2022-03-01','22:20:00','CAN','34','./attendance_creation/nesbv39vw4.pdf',0,'2022-03-15','10:20:15',NULL,NULL,NULL,NULL,NULL,'Test','2022-03-16','15:45:10','LDAGULTO','TL-601','CAN->LDAGULTO->2022-03-16 03:45:10'),('7','7','2022-03-02','23:39:00','2022-03-03','11:39:00','CAN','Test','./attendance_creation/ktsvjukacd.pdf',0,'2022-03-16','11:39:15',NULL,NULL,NULL,NULL,NULL,'Test','2022-03-16','14:36:02','LDAGULTO','TL-629','CAN->LDAGULTO->2022-03-16 02:36:02'),('8','7','2022-03-03','15:57:00','2022-03-04','15:57:00','CAN','Test','./attendance_creation/ap32kr7guj.pdf',0,'2022-03-16','15:57:59',NULL,NULL,NULL,NULL,NULL,'Test','2022-03-16','16:57:15','LDAGULTO','TL-638','CAN->LDAGULTO->2022-03-16 04:57:15'),('9','7','2022-03-17','09:12:00','2022-03-17','09:12:00','CAN','Test','./attendance_creation/mt4o8r4rhn.pdf',0,'2022-03-17','09:12:58','2022-03-17','09:13:06',NULL,NULL,NULL,'Test','2022-03-21','09:07:38','LDAGULTO','TL-639','CAN->LDAGULTO->2022-03-21 09:07:38');
/*!40000 ALTER TABLE `tblattendancecreation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblattendancecreationexception`
--

DROP TABLE IF EXISTS `tblattendancecreationexception`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblattendancecreationexception` (
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblattendancecreationexception`
--

LOCK TABLES `tblattendancecreationexception` WRITE;
/*!40000 ALTER TABLE `tblattendancecreationexception` DISABLE KEYS */;
INSERT INTO `tblattendancecreationexception` VALUES ('','INS->LDAGULTO->2022-03-23 08:22:49');
/*!40000 ALTER TABLE `tblattendancecreationexception` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblattendancerecord`
--

DROP TABLE IF EXISTS `tblattendancerecord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblattendancerecord` (
  `ATTENDANCE_ID` varchar(100) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `TIME_IN_DATE` date DEFAULT NULL,
  `TIME_IN` time DEFAULT NULL,
  `TIME_IN_LOCATION` varchar(100) DEFAULT NULL,
  `TIME_IN_IP_ADDRESS` varchar(20) DEFAULT NULL,
  `TIME_IN_BY` varchar(100) DEFAULT NULL,
  `TIME_IN_BEHAVIOR` varchar(10) DEFAULT NULL,
  `TIME_IN_NOTE` varchar(200) DEFAULT NULL,
  `TIME_OUT_DATE` date DEFAULT NULL,
  `TIME_OUT` time DEFAULT NULL,
  `TIME_OUT_LOCATION` varchar(100) DEFAULT NULL,
  `TIME_OUT_IP_ADDRESS` varchar(20) DEFAULT NULL,
  `TIME_OUT_BY` varchar(100) DEFAULT NULL,
  `TIME_OUT_BEHAVIOR` varchar(10) DEFAULT NULL,
  `TIME_OUT_NOTE` varchar(200) DEFAULT NULL,
  `LATE` double DEFAULT NULL,
  `EARLY_LEAVING` double DEFAULT NULL,
  `OVERTIME` double DEFAULT NULL,
  `TOTAL_WORKING_HOURS` double DEFAULT NULL,
  `REMARKS` varchar(500) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ATTENDANCE_ID`),
  KEY `attendance_record_index` (`ATTENDANCE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblattendancerecord`
--

LOCK TABLES `tblattendancerecord` WRITE;
/*!40000 ALTER TABLE `tblattendancerecord` DISABLE KEYS */;
INSERT INTO `tblattendancerecord` VALUES ('19','7','2022-02-28','09:42:00',NULL,'::1','LDAGULTO','LATE','Scanned','2022-03-11','13:13:00','120.9761487, 15.4943473','::1','7','EL','',210,270,259,264,'','TL-563','UPD->LDAGULTO->2022-03-11 01:13:02'),('20','7','2022-03-10','14:09:00',NULL,'::1','LDAGULTO','LATE','Scanned','2022-03-10','14:11:00',NULL,'::1','LDAGULTO','EL','Scanned',210,270,0,0,NULL,'TL-564','UPD->LDAGULTO->2022-03-10 02:11:11'),('21','48','2022-03-10','08:31:00',NULL,'::1','LDAGULTO','LATE','Scanned','2022-03-10','17:30:00',NULL,'::1','LDAGULTO','REG','Scanned',1,0,0,7.9833333333333,'','TL-565','UPD->LDAGULTO->2022-03-10 05:05:39'),('22','7','2022-03-11','13:14:00','15.4943473, 120.9761487','::1','7','LATE','Scanned','2022-03-11','15:00:00','120.9561362, 15.4735138','::1','7','EL','',14,270,0,3.2666666666667,'','TL-576','UPD->LDAGULTO->2022-04-14 02:13:24'),('23','7','2022-03-04','11:34:00',NULL,NULL,NULL,'LATE',NULL,'2022-03-10','11:34:00',NULL,NULL,NULL,'EL',NULL,210,270,138,144,'Created through attendance creation.','TL-715','INS->LDAGULTO->2022-03-24 09:25:34'),('24','7','0000-00-00','00:00:03',NULL,NULL,NULL,'EARLY',NULL,'0000-00-00','00:00:03',NULL,NULL,NULL,'',NULL,0,0,0,0,'Adjusted using attendance adjustment.','TL-716','UPD->LDAGULTO->2022-03-24 02:32:54'),('25','7','0000-00-00','00:00:03',NULL,NULL,NULL,'EARLY',NULL,'0000-00-00','00:00:03',NULL,NULL,NULL,'',NULL,0,0,0,0,'Adjusted using attendance adjustment.','TL-718','UPD->LDAGULTO->2022-03-24 02:33:49'),('26','7','2022-03-03','11:41:00',NULL,NULL,NULL,'LATE',NULL,'2022-03-03','11:41:00',NULL,NULL,NULL,'EL',NULL,210,270,0,0,'Created through attendance creation.','TL-719','INS->LDAGULTO->2022-03-24 09:56:01'),('27','7','2022-03-17','07:30:00',NULL,NULL,NULL,'EARLY',NULL,'2022-03-17','17:29:00',NULL,NULL,NULL,'EL',NULL,0,1,0,7.9833333333333,'Adjusted using attendance adjustment.','TL-722','UPD->LDAGULTO->2022-03-24 03:14:39'),('28','7','0000-00-00','00:00:03',NULL,NULL,NULL,'EARLY',NULL,'0000-00-00','00:00:03',NULL,NULL,NULL,'',NULL,0,0,0,0,'Adjusted using attendance adjustment.','TL-723','UPD->LDAGULTO->2022-03-24 03:00:14'),('29','7','2022-04-14','08:30:00','120.9561362, 15.4735138','::1','7','REG','','2022-04-14','17:30:00','120.654491, 15.0847034','::1','7','REG','',0,0,0,8,'Adjusted using attendance adjustment.','TL-1101','UPD->LDAGULTO->2022-04-16 02:56:52'),('30','7','2022-04-15','08:30:00',NULL,NULL,NULL,'REG',NULL,'2022-04-15','17:30:00',NULL,NULL,NULL,'REG',NULL,0,0,0,8,'Created through attendance creation.','TL-1110','INS->LDAGULTO->2022-04-16 03:35:29'),('4','7','2022-02-18','07:30:00',NULL,NULL,NULL,'EARLY',NULL,'2022-02-18','18:00:00',NULL,NULL,NULL,'OT',NULL,0,0,0,8,'','TL-535','UPD->LDAGULTO->2022-02-21 09:33:54'),('6','7','2022-02-07','08:05:00',NULL,NULL,NULL,'EARLY',NULL,'2022-02-07','14:44:00',NULL,NULL,NULL,'EL',NULL,0,270,0,3.5,'','TL-544','UPD->LDAGULTO->2022-02-22 11:43:08');
/*!40000 ALTER TABLE `tblattendancerecord` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblattendancesetting`
--

DROP TABLE IF EXISTS `tblattendancesetting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblattendancesetting` (
  `SETTING_ID` int(11) NOT NULL,
  `MAX_ATTENDANCE` int(11) NOT NULL,
  `TIME_OUT_ALLOWANCE` int(11) DEFAULT NULL,
  `LATE_ALLOWANCE` int(11) NOT NULL,
  `LATE_POLICY` int(11) NOT NULL,
  `EARLY_LEAVING_POLICY` int(11) NOT NULL,
  `ATTENDANCE_CREATION_RECOMMENDATION` int(1) NOT NULL,
  `ATTENDANCE_ADJUSTMENT_RECOMMENDATION` int(1) NOT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`SETTING_ID`),
  KEY `attendance_setting_index` (`SETTING_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblattendancesetting`
--

LOCK TABLES `tblattendancesetting` WRITE;
/*!40000 ALTER TABLE `tblattendancesetting` DISABLE KEYS */;
INSERT INTO `tblattendancesetting` VALUES (1,1,1,1,30,30,1,1,'TL-671','UPD->LDAGULTO->2022-03-23 08:22:49');
/*!40000 ALTER TABLE `tblattendancesetting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblbranch`
--

DROP TABLE IF EXISTS `tblbranch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblbranch` (
  `BRANCH_ID` varchar(50) NOT NULL,
  `BRANCH` varchar(200) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PHONE` varchar(30) DEFAULT NULL,
  `TELEPHONE` varchar(30) DEFAULT NULL,
  `ADDRESS` varchar(500) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`BRANCH_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblbranch`
--

LOCK TABLES `tblbranch` WRITE;
/*!40000 ALTER TABLE `tblbranch` DISABLE KEYS */;
INSERT INTO `tblbranch` VALUES ('BRCH-1','Main Branch','','','','Cabanatuan','TL-125','UPD->ADMIN->2022-01-05 09:31:32'),('BRCH-2','Pampanga Branch','','','','Pampanga','TL-133','INS->ADMIN->2022-01-05 10:41:21'),('BRCH-3','Tarlac Branch','','','','Tarlac','TL-134','UPD->LDAGULTO->2022-04-14 10:03:31');
/*!40000 ALTER TABLE `tblbranch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcity`
--

DROP TABLE IF EXISTS `tblcity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblcity` (
  `CITY_ID` int(11) NOT NULL,
  `PROVINCE_ID` int(11) NOT NULL,
  `CITY` varchar(300) NOT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CITY_ID`),
  KEY `city_index` (`CITY_ID`,`PROVINCE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcity`
--

LOCK TABLES `tblcity` WRITE;
/*!40000 ALTER TABLE `tblcity` DISABLE KEYS */;
INSERT INTO `tblcity` VALUES (1,2,'Adams',NULL),(2,2,'Bacarra',NULL),(3,2,'Badoc',NULL),(4,2,'Bangui',NULL),(5,2,'City of Batac',NULL),(6,2,'Burgos',NULL),(7,2,'Carasi',NULL),(8,2,'Currimao',NULL),(9,2,'Dingras',NULL),(10,2,'Dumalneg',NULL),(11,2,'Banna',NULL),(12,2,'City of Laoag',NULL),(13,2,'Marcos',NULL),(14,2,'Nueva Era',NULL),(15,2,'Pagudpud',NULL),(16,2,'Paoay',NULL),(17,2,'Pasuquin',NULL),(18,2,'Piddig',NULL),(19,2,'Pinili',NULL),(20,2,'San Nicolas',NULL),(21,2,'Sarrat',NULL),(22,2,'Solsona',NULL),(23,2,'Vintar',NULL),(24,3,'Alilem',NULL),(25,3,'Banayoyo',NULL),(26,3,'Bantay',NULL),(27,3,'Burgos',NULL),(28,3,'Cabugao',NULL),(29,3,'City of Candon',NULL),(30,3,'Caoayan',NULL),(31,3,'Cervantes',NULL),(32,3,'Galimuyod',NULL),(33,3,'Gregorio del Pilar',NULL),(34,3,'Lidlidda',NULL),(35,3,'Magsingal',NULL),(36,3,'Nagbukel',NULL),(37,3,'Narvacan',NULL),(38,3,'Quirino',NULL),(39,3,'Salcedo',NULL),(40,3,'San Emilio',NULL),(41,3,'San Esteban',NULL),(42,3,'San Ildefonso',NULL),(43,3,'San Juan',NULL),(44,3,'San Vicente',NULL),(45,3,'Santa',NULL),(46,3,'Santa Catalina',NULL),(47,3,'Santa Cruz',NULL),(48,3,'Santa Lucia',NULL),(49,3,'Santa Maria',NULL),(50,3,'Santiago',NULL),(51,3,'Santo Domingo',NULL),(52,3,'Sigay',NULL),(53,3,'Sinait',NULL),(54,3,'Sugpon',NULL),(55,3,'Suyo',NULL),(56,3,'Tagudin',NULL),(57,3,'City of Vigan',NULL),(58,4,'Agoo',NULL),(59,4,'Aringay',NULL),(60,4,'Bacnotan',NULL),(61,4,'Bagulin',NULL),(62,4,'Balaoan',NULL),(63,4,'Bangar',NULL),(64,4,'Bauang',NULL),(65,4,'Burgos',NULL),(66,4,'Caba',NULL),(67,4,'Luna',NULL),(68,4,'Naguilian',NULL),(69,4,'Pugo',NULL),(70,4,'Rosario',NULL),(71,4,'City of San Fernando',NULL),(72,4,'San Gabriel',NULL),(73,4,'San Juan',NULL),(74,4,'Santo Tomas',NULL),(75,4,'Santol',NULL),(76,4,'Sudipen',NULL),(77,4,'Tubao',NULL),(78,5,'Agno',NULL),(79,5,'Aguilar',NULL),(80,5,'City of Alaminos',NULL),(81,5,'Alcala',NULL),(82,5,'Anda',NULL),(83,5,'Asingan',NULL),(84,5,'Balungao',NULL),(85,5,'Bani',NULL),(86,5,'Basista',NULL),(87,5,'Bautista',NULL),(88,5,'Bayambang',NULL),(89,5,'Binalonan',NULL),(90,5,'Binmaley',NULL),(91,5,'Bolinao',NULL),(92,5,'Bugallon',NULL),(93,5,'Burgos',NULL),(94,5,'Calasiao',NULL),(95,5,'City of Dagupan',NULL),(96,5,'Dasol',NULL),(97,5,'Infanta',NULL),(98,5,'Labrador',NULL),(99,5,'Lingayen',NULL),(100,5,'Mabini',NULL),(101,5,'Malasiqui',NULL),(102,5,'Manaoag',NULL),(103,5,'Mangaldan',NULL),(104,5,'Mangatarem',NULL),(105,5,'Mapandan',NULL),(106,5,'Natividad',NULL),(107,5,'Pozorrubio',NULL),(108,5,'Rosales',NULL),(109,5,'City of San Carlos',NULL),(110,5,'San Fabian',NULL),(111,5,'San Jacinto',NULL),(112,5,'San Manuel',NULL),(113,5,'San Nicolas',NULL),(114,5,'San Quintin',NULL),(115,5,'Santa Barbara',NULL),(116,5,'Santa Maria',NULL),(117,5,'Santo Tomas',NULL),(118,5,'Sison',NULL),(119,5,'Sual',NULL),(120,5,'Tayug',NULL),(121,5,'Umingan',NULL),(122,5,'Urbiztondo',NULL),(123,5,'City of Urdaneta',NULL),(124,5,'Villasis',NULL),(125,5,'Laoac',NULL),(126,6,'Basco',NULL),(127,6,'Itbayat',NULL),(128,6,'Ivana',NULL),(129,6,'Mahatao',NULL),(130,6,'Sabtang',NULL),(131,6,'Uyugan',NULL),(132,7,'Abulug',NULL),(133,7,'Alcala',NULL),(134,7,'Allacapan',NULL),(135,7,'Amulung',NULL),(136,7,'Aparri',NULL),(137,7,'Baggao',NULL),(138,7,'Ballesteros',NULL),(139,7,'Buguey',NULL),(140,7,'Calayan',NULL),(141,7,'Camalaniugan',NULL),(142,7,'Claveria',NULL),(143,7,'Enrile',NULL),(144,7,'Gattaran',NULL),(145,7,'Gonzaga',NULL),(146,7,'Iguig',NULL),(147,7,'Lal-Lo',NULL),(148,7,'Lasam',NULL),(149,7,'Pamplona',NULL),(150,7,'Peñablanca',NULL),(151,7,'Piat',NULL),(152,7,'Rizal',NULL),(153,7,'Sanchez-Mira',NULL),(154,7,'Santa Ana',NULL),(155,7,'Santa Praxedes',NULL),(156,7,'Santa Teresita',NULL),(157,7,'Santo Niño',NULL),(158,7,'Solana',NULL),(159,7,'Tuao',NULL),(160,7,'Tuguegarao City',NULL),(161,8,'Alicia',NULL),(162,8,'Angadanan',NULL),(163,8,'Aurora',NULL),(164,8,'Benito Soliven',NULL),(165,8,'Burgos',NULL),(166,8,'Cabagan',NULL),(167,8,'Cabatuan',NULL),(168,8,'City of Cauayan',NULL),(169,8,'Cordon',NULL),(170,8,'Dinapigue',NULL),(171,8,'Divilacan',NULL),(172,8,'Echague',NULL),(173,8,'Gamu',NULL),(174,8,'City of Ilagan',NULL),(175,8,'Jones',NULL),(176,8,'Luna',NULL),(177,8,'Maconacon',NULL),(178,8,'Delfin Albano',NULL),(179,8,'Mallig',NULL),(180,8,'Naguilian',NULL),(181,8,'Palanan',NULL),(182,8,'Quezon',NULL),(183,8,'Quirino',NULL),(184,8,'Ramon',NULL),(185,8,'Reina Mercedes',NULL),(186,8,'Roxas',NULL),(187,8,'San Agustin',NULL),(188,8,'San Guillermo',NULL),(189,8,'San Isidro',NULL),(190,8,'San Manuel',NULL),(191,8,'San Mariano',NULL),(192,8,'San Mateo',NULL),(193,8,'San Pablo',NULL),(194,8,'Santa Maria',NULL),(195,8,'City of Santiago',NULL),(196,8,'Santo Tomas',NULL),(197,8,'Tumauini',NULL),(198,9,'Ambaguio',NULL),(199,9,'Aritao',NULL),(200,9,'Bagabag',NULL),(201,9,'Bambang',NULL),(202,9,'Bayombong',NULL),(203,9,'Diadi',NULL),(204,9,'Dupax del Norte',NULL),(205,9,'Dupax del Sur',NULL),(206,9,'Kasibu',NULL),(207,9,'Kayapa',NULL),(208,9,'Quezon',NULL),(209,9,'Santa Fe',NULL),(210,9,'Solano',NULL),(211,9,'Villaverde',NULL),(212,9,'Alfonso Castaneda',NULL),(213,10,'Aglipay',NULL),(214,10,'Cabarroguis',NULL),(215,10,'Diffun',NULL),(216,10,'Maddela',NULL),(217,10,'Saguday',NULL),(218,10,'Nagtipunan',NULL),(219,11,'Abucay',NULL),(220,11,'Bagac',NULL),(221,11,'City of Balanga',NULL),(222,11,'Dinalupihan',NULL),(223,11,'Hermosa',NULL),(224,11,'Limay',NULL),(225,11,'Mariveles',NULL),(226,11,'Morong',NULL),(227,11,'Orani',NULL),(228,11,'Orion',NULL),(229,11,'Pilar',NULL),(230,11,'Samal',NULL),(231,12,'Angat',NULL),(232,12,'Balagtas',NULL),(233,12,'Baliuag',NULL),(234,12,'Bocaue',NULL),(235,12,'Bulacan',NULL),(236,12,'Bustos',NULL),(237,12,'Calumpit',NULL),(238,12,'Guiguinto',NULL),(239,12,'Hagonoy',NULL),(240,12,'City of Malolos',NULL),(241,12,'Marilao',NULL),(242,12,'City of Meycauayan',NULL),(243,12,'Norzagaray',NULL),(244,12,'Obando',NULL),(245,12,'Pandi',NULL),(246,12,'Paombong',NULL),(247,12,'Plaridel',NULL),(248,12,'Pulilan',NULL),(249,12,'San Ildefonso',NULL),(250,12,'City of San Jose Del Monte',NULL),(251,12,'San Miguel',NULL),(252,12,'San Rafael',NULL),(253,12,'Santa Maria',NULL),(254,12,'Doña Remedios Trinidad',NULL),(255,13,'Aliaga',NULL),(256,13,'Bongabon',NULL),(257,13,'City of Cabanatuan',NULL),(258,13,'Cabiao',NULL),(259,13,'Carranglan',NULL),(260,13,'Cuyapo',NULL),(261,13,'Gabaldon',NULL),(262,13,'City of Gapan',NULL),(263,13,'General Mamerto Natividad',NULL),(264,13,'General Tinio',NULL),(265,13,'Guimba',NULL),(266,13,'Jaen',NULL),(267,13,'Laur',NULL),(268,13,'Licab',NULL),(269,13,'Llanera',NULL),(270,13,'Lupao',NULL),(271,13,'Science City of Muñoz',NULL),(272,13,'Nampicuan',NULL),(273,13,'City of Palayan',NULL),(274,13,'Pantabangan',NULL),(275,13,'Peñaranda',NULL),(276,13,'Quezon',NULL),(277,13,'Rizal',NULL),(278,13,'San Antonio',NULL),(279,13,'San Isidro',NULL),(280,13,'San Jose City',NULL),(281,13,'San Leonardo',NULL),(282,13,'Santa Rosa',NULL),(283,13,'Santo Domingo',NULL),(284,13,'Talavera',NULL),(285,13,'Talugtug',NULL),(286,13,'Zaragoza',NULL),(287,14,'City of Angeles',NULL),(288,14,'Apalit',NULL),(289,14,'Arayat',NULL),(290,14,'Bacolor',NULL),(291,14,'Candaba',NULL),(292,14,'Floridablanca',NULL),(293,14,'Guagua',NULL),(294,14,'Lubao',NULL),(295,14,'Mabalacat City',NULL),(296,14,'Macabebe',NULL),(297,14,'Magalang',NULL),(298,14,'Masantol',NULL),(299,14,'Mexico',NULL),(300,14,'Minalin',NULL),(301,14,'Porac',NULL),(302,14,'City of San Fernando',NULL),(303,14,'San Luis',NULL),(304,14,'San Simon',NULL),(305,14,'Santa Ana',NULL),(306,14,'Santa Rita',NULL),(307,14,'Santo Tomas',NULL),(308,14,'Sasmuan',NULL),(309,15,'Anao',NULL),(310,15,'Bamban',NULL),(311,15,'Camiling',NULL),(312,15,'Capas',NULL),(313,15,'Concepcion',NULL),(314,15,'Gerona',NULL),(315,15,'La Paz',NULL),(316,15,'Mayantoc',NULL),(317,15,'Moncada',NULL),(318,15,'Paniqui',NULL),(319,15,'Pura',NULL),(320,15,'Ramos',NULL),(321,15,'San Clemente',NULL),(322,15,'San Manuel',NULL),(323,15,'Santa Ignacia',NULL),(324,15,'City of Tarlac',NULL),(325,15,'Victoria',NULL),(326,15,'San Jose',NULL),(327,16,'Botolan',NULL),(328,16,'Cabangan',NULL),(329,16,'Candelaria',NULL),(330,16,'Castillejos',NULL),(331,16,'Iba',NULL),(332,16,'Masinloc',NULL),(333,16,'City of Olongapo',NULL),(334,16,'Palauig',NULL),(335,16,'San Antonio',NULL),(336,16,'San Felipe',NULL),(337,16,'San Marcelino',NULL),(338,16,'San Narciso',NULL),(339,16,'Santa Cruz',NULL),(340,16,'Subic',NULL),(341,17,'Baler',NULL),(342,17,'Casiguran',NULL),(343,17,'Dilasag',NULL),(344,17,'Dinalungan',NULL),(345,17,'Dingalan',NULL),(346,17,'Dipaculao',NULL),(347,17,'Maria Aurora',NULL),(348,17,'San Luis',NULL),(349,18,'Agoncillo',NULL),(350,18,'Alitagtag',NULL),(351,18,'Balayan',NULL),(352,18,'Balete',NULL),(353,18,'Batangas City',NULL),(354,18,'Bauan',NULL),(355,18,'Calaca',NULL),(356,18,'Calatagan',NULL),(357,18,'Cuenca',NULL),(358,18,'Ibaan',NULL),(359,18,'Laurel',NULL),(360,18,'Lemery',NULL),(361,18,'Lian',NULL),(362,18,'City of Lipa',NULL),(363,18,'Lobo',NULL),(364,18,'Mabini',NULL),(365,18,'Malvar',NULL),(366,18,'Mataasnakahoy',NULL),(367,18,'Nasugbu',NULL),(368,18,'Padre Garcia',NULL),(369,18,'Rosario',NULL),(370,18,'San Jose',NULL),(371,18,'San Juan',NULL),(372,18,'San Luis',NULL),(373,18,'San Nicolas',NULL),(374,18,'San Pascual',NULL),(375,18,'Santa Teresita',NULL),(376,18,'City of Sto. Tomas',NULL),(377,18,'Taal',NULL),(378,18,'Talisay',NULL),(379,18,'City of Tanauan',NULL),(380,18,'Taysan',NULL),(381,18,'Tingloy',NULL),(382,18,'Tuy',NULL),(383,19,'Alfonso',NULL),(384,19,'Amadeo',NULL),(385,19,'City of Bacoor',NULL),(386,19,'Carmona',NULL),(387,19,'City of Cavite',NULL),(388,19,'City of Dasmariñas',NULL),(389,19,'General Emilio Aguinaldo',NULL),(390,19,'City of General Trias',NULL),(391,19,'City of Imus',NULL),(392,19,'Indang',NULL),(393,19,'Kawit',NULL),(394,19,'Magallanes',NULL),(395,19,'Maragondon',NULL),(396,19,'Mendez',NULL),(397,19,'Naic',NULL),(398,19,'Noveleta',NULL),(399,19,'Rosario',NULL),(400,19,'Silang',NULL),(401,19,'City of Tagaytay',NULL),(402,19,'Tanza',NULL),(403,19,'Ternate',NULL),(404,19,'City of Trece Martires',NULL),(405,19,'Gen. Mariano Alvarez',NULL),(406,20,'Alaminos',NULL),(407,20,'Bay',NULL),(408,20,'City of Biñan',NULL),(409,20,'City of Cabuyao',NULL),(410,20,'City of Calamba',NULL),(411,20,'Calauan',NULL),(412,20,'Cavinti',NULL),(413,20,'Famy',NULL),(414,20,'Kalayaan',NULL),(415,20,'Liliw',NULL),(416,20,'Los Baños',NULL),(417,20,'Luisiana',NULL),(418,20,'Lumban',NULL),(419,20,'Mabitac',NULL),(420,20,'Magdalena',NULL),(421,20,'Majayjay',NULL),(422,20,'Nagcarlan',NULL),(423,20,'Paete',NULL),(424,20,'Pagsanjan',NULL),(425,20,'Pakil',NULL),(426,20,'Pangil',NULL),(427,20,'Pila',NULL),(428,20,'Rizal',NULL),(429,20,'City of San Pablo',NULL),(430,20,'City of San Pedro',NULL),(431,20,'Santa Cruz',NULL),(432,20,'Santa Maria',NULL),(433,20,'City of Santa Rosa',NULL),(434,20,'Siniloan',NULL),(435,20,'Victoria',NULL),(436,21,'Agdangan',NULL),(437,21,'Alabat',NULL),(438,21,'Atimonan',NULL),(439,21,'Buenavista',NULL),(440,21,'Burdeos',NULL),(441,21,'Calauag',NULL),(442,21,'Candelaria',NULL),(443,21,'Catanauan',NULL),(444,21,'Dolores',NULL),(445,21,'General Luna',NULL),(446,21,'General Nakar',NULL),(447,21,'Guinayangan',NULL),(448,21,'Gumaca',NULL),(449,21,'Infanta',NULL),(450,21,'Jomalig',NULL),(451,21,'Lopez',NULL),(452,21,'Lucban',NULL),(453,21,'City of Lucena',NULL),(454,21,'Macalelon',NULL),(455,21,'Mauban',NULL),(456,21,'Mulanay',NULL),(457,21,'Padre Burgos',NULL),(458,21,'Pagbilao',NULL),(459,21,'Panukulan',NULL),(460,21,'Patnanungan',NULL),(461,21,'Perez',NULL),(462,21,'Pitogo',NULL),(463,21,'Plaridel',NULL),(464,21,'Polillo',NULL),(465,21,'Quezon',NULL),(466,21,'Real',NULL),(467,21,'Sampaloc',NULL),(468,21,'San Andres',NULL),(469,21,'San Antonio',NULL),(470,21,'San Francisco',NULL),(471,21,'San Narciso',NULL),(472,21,'Sariaya',NULL),(473,21,'Tagkawayan',NULL),(474,21,'City of Tayabas',NULL),(475,21,'Tiaong',NULL),(476,21,'Unisan',NULL),(477,22,'Angono',NULL),(478,22,'City of Antipolo',NULL),(479,22,'Baras',NULL),(480,22,'Binangonan',NULL),(481,22,'Cainta',NULL),(482,22,'Cardona',NULL),(483,22,'Jala-Jala',NULL),(484,22,'Rodriguez',NULL),(485,22,'Morong',NULL),(486,22,'Pililla',NULL),(487,22,'San Mateo',NULL),(488,22,'Tanay',NULL),(489,22,'Taytay',NULL),(490,22,'Teresa',NULL),(491,23,'Boac',NULL),(492,23,'Buenavista',NULL),(493,23,'Gasan',NULL),(494,23,'Mogpog',NULL),(495,23,'Santa Cruz',NULL),(496,23,'Torrijos',NULL),(497,24,'Abra De Ilog',NULL),(498,24,'Calintaan',NULL),(499,24,'Looc',NULL),(500,24,'Lubang',NULL),(501,24,'Magsaysay',NULL),(502,24,'Mamburao',NULL),(503,24,'Paluan',NULL),(504,24,'Rizal',NULL),(505,24,'Sablayan',NULL),(506,24,'San Jose',NULL),(507,24,'Santa Cruz',NULL),(508,25,'Baco',NULL),(509,25,'Bansud',NULL),(510,25,'Bongabong',NULL),(511,25,'Bulalacao',NULL),(512,25,'City of Calapan',NULL),(513,25,'Gloria',NULL),(514,25,'Mansalay',NULL),(515,25,'Naujan',NULL),(516,25,'Pinamalayan',NULL),(517,25,'Pola',NULL),(518,25,'Puerto Galera',NULL),(519,25,'Roxas',NULL),(520,25,'San Teodoro',NULL),(521,25,'Socorro',NULL),(522,25,'Victoria',NULL),(523,26,'Aborlan',NULL),(524,26,'Agutaya',NULL),(525,26,'Araceli',NULL),(526,26,'Balabac',NULL),(527,26,'Bataraza',NULL),(528,26,'Brooke\'S Point',NULL),(529,26,'Busuanga',NULL),(530,26,'Cagayancillo',NULL),(531,26,'Coron',NULL),(532,26,'Cuyo',NULL),(533,26,'Dumaran',NULL),(534,26,'El Nido',NULL),(535,26,'Linapacan',NULL),(536,26,'Magsaysay',NULL),(537,26,'Narra',NULL),(538,26,'City of Puerto Princesa',NULL),(539,26,'Quezon',NULL),(540,26,'Roxas',NULL),(541,26,'San Vicente',NULL),(542,26,'Taytay',NULL),(543,26,'Kalayaan',NULL),(544,26,'Culion',NULL),(545,26,'Rizal',NULL),(546,26,'Sofronio Española',NULL),(547,27,'Alcantara',NULL),(548,27,'Banton',NULL),(549,27,'Cajidiocan',NULL),(550,27,'Calatrava',NULL),(551,27,'Concepcion',NULL),(552,27,'Corcuera',NULL),(553,27,'Looc',NULL),(554,27,'Magdiwang',NULL),(555,27,'Odiongan',NULL),(556,27,'Romblon',NULL),(557,27,'San Agustin',NULL),(558,27,'San Andres',NULL),(559,27,'San Fernando',NULL),(560,27,'San Jose',NULL),(561,27,'Santa Fe',NULL),(562,27,'Ferrol',NULL),(563,27,'Santa Maria',NULL),(564,28,'Bacacay',NULL),(565,28,'Camalig',NULL),(566,28,'Daraga',NULL),(567,28,'Guinobatan',NULL),(568,28,'Jovellar',NULL),(569,28,'City of Legazpi',NULL),(570,28,'Libon',NULL),(571,28,'City of Ligao',NULL),(572,28,'Malilipot',NULL),(573,28,'Malinao',NULL),(574,28,'Manito',NULL),(575,28,'Oas',NULL),(576,28,'Pio Duran',NULL),(577,28,'Polangui',NULL),(578,28,'Rapu-Rapu',NULL),(579,28,'Santo Domingo',NULL),(580,28,'City of Tabaco',NULL),(581,28,'Tiwi',NULL),(582,29,'Basud',NULL),(583,29,'Capalonga',NULL),(584,29,'Daet',NULL),(585,29,'San Lorenzo Ruiz',NULL),(586,29,'Jose Panganiban',NULL),(587,29,'Labo',NULL),(588,29,'Mercedes',NULL),(589,29,'Paracale',NULL),(590,29,'San Vicente',NULL),(591,29,'Santa Elena',NULL),(592,29,'Talisay',NULL),(593,29,'Vinzons',NULL),(594,30,'Baao',NULL),(595,30,'Balatan',NULL),(596,30,'Bato',NULL),(597,30,'Bombon',NULL),(598,30,'Buhi',NULL),(599,30,'Bula',NULL),(600,30,'Cabusao',NULL),(601,30,'Calabanga',NULL),(602,30,'Camaligan',NULL),(603,30,'Canaman',NULL),(604,30,'Caramoan',NULL),(605,30,'Del Gallego',NULL),(606,30,'Gainza',NULL),(607,30,'Garchitorena',NULL),(608,30,'Goa',NULL),(609,30,'City of Iriga',NULL),(610,30,'Lagonoy',NULL),(611,30,'Libmanan',NULL),(612,30,'Lupi',NULL),(613,30,'Magarao',NULL),(614,30,'Milaor',NULL),(615,30,'Minalabac',NULL),(616,30,'Nabua',NULL),(617,30,'City of Naga',NULL),(618,30,'Ocampo',NULL),(619,30,'Pamplona',NULL),(620,30,'Pasacao',NULL),(621,30,'Pili',NULL),(622,30,'Presentacion',NULL),(623,30,'Ragay',NULL),(624,30,'Sagñay',NULL),(625,30,'San Fernando',NULL),(626,30,'San Jose',NULL),(627,30,'Sipocot',NULL),(628,30,'Siruma',NULL),(629,30,'Tigaon',NULL),(630,30,'Tinambac',NULL),(631,31,'Bagamanoc',NULL),(632,31,'Baras',NULL),(633,31,'Bato',NULL),(634,31,'Caramoran',NULL),(635,31,'Gigmoto',NULL),(636,31,'Pandan',NULL),(637,31,'Panganiban',NULL),(638,31,'San Andres',NULL),(639,31,'San Miguel',NULL),(640,31,'Viga',NULL),(641,31,'Virac',NULL),(642,32,'Aroroy',NULL),(643,32,'Baleno',NULL),(644,32,'Balud',NULL),(645,32,'Batuan',NULL),(646,32,'Cataingan',NULL),(647,32,'Cawayan',NULL),(648,32,'Claveria',NULL),(649,32,'Dimasalang',NULL),(650,32,'Esperanza',NULL),(651,32,'Mandaon',NULL),(652,32,'City of Masbate',NULL),(653,32,'Milagros',NULL),(654,32,'Mobo',NULL),(655,32,'Monreal',NULL),(656,32,'Palanas',NULL),(657,32,'Pio V. Corpuz',NULL),(658,32,'Placer',NULL),(659,32,'San Fernando',NULL),(660,32,'San Jacinto',NULL),(661,32,'San Pascual',NULL),(662,32,'Uson',NULL),(663,33,'Barcelona',NULL),(664,33,'Bulan',NULL),(665,33,'Bulusan',NULL),(666,33,'Casiguran',NULL),(667,33,'Castilla',NULL),(668,33,'Donsol',NULL),(669,33,'Gubat',NULL),(670,33,'Irosin',NULL),(671,33,'Juban',NULL),(672,33,'Magallanes',NULL),(673,33,'Matnog',NULL),(674,33,'Pilar',NULL),(675,33,'Prieto Diaz',NULL),(676,33,'Santa Magdalena',NULL),(677,33,'City of Sorsogon',NULL),(678,34,'Altavas',NULL),(679,34,'Balete',NULL),(680,34,'Banga',NULL),(681,34,'Batan',NULL),(682,34,'Buruanga',NULL),(683,34,'Ibajay',NULL),(684,34,'Kalibo',NULL),(685,34,'Lezo',NULL),(686,34,'Libacao',NULL),(687,34,'Madalag',NULL),(688,34,'Makato',NULL),(689,34,'Malay',NULL),(690,34,'Malinao',NULL),(691,34,'Nabas',NULL),(692,34,'New Washington',NULL),(693,34,'Numancia',NULL),(694,34,'Tangalan',NULL),(695,35,'Anini-Y',NULL),(696,35,'Barbaza',NULL),(697,35,'Belison',NULL),(698,35,'Bugasong',NULL),(699,35,'Caluya',NULL),(700,35,'Culasi',NULL),(701,35,'Tobias Fornier',NULL),(702,35,'Hamtic',NULL),(703,35,'Laua-An',NULL),(704,35,'Libertad',NULL),(705,35,'Pandan',NULL),(706,35,'Patnongon',NULL),(707,35,'San Jose',NULL),(708,35,'San Remigio',NULL),(709,35,'Sebaste',NULL),(710,35,'Sibalom',NULL),(711,35,'Tibiao',NULL),(712,35,'Valderrama',NULL),(713,36,'Cuartero',NULL),(714,36,'Dao',NULL),(715,36,'Dumalag',NULL),(716,36,'Dumarao',NULL),(717,36,'Ivisan',NULL),(718,36,'Jamindan',NULL),(719,36,'Ma-Ayon',NULL),(720,36,'Mambusao',NULL),(721,36,'Panay',NULL),(722,36,'Panitan',NULL),(723,36,'Pilar',NULL),(724,36,'Pontevedra',NULL),(725,36,'President Roxas',NULL),(726,36,'City of Roxas',NULL),(727,36,'Sapi-An',NULL),(728,36,'Sigma',NULL),(729,36,'Tapaz',NULL),(730,37,'Ajuy',NULL),(731,37,'Alimodian',NULL),(732,37,'Anilao',NULL),(733,37,'Badiangan',NULL),(734,37,'Balasan',NULL),(735,37,'Banate',NULL),(736,37,'Barotac Nuevo',NULL),(737,37,'Barotac Viejo',NULL),(738,37,'Batad',NULL),(739,37,'Bingawan',NULL),(740,37,'Cabatuan',NULL),(741,37,'Calinog',NULL),(742,37,'Carles',NULL),(743,37,'Concepcion',NULL),(744,37,'Dingle',NULL),(745,37,'Dueñas',NULL),(746,37,'Dumangas',NULL),(747,37,'Estancia',NULL),(748,37,'Guimbal',NULL),(749,37,'Igbaras',NULL),(750,37,'City of Iloilo',NULL),(751,37,'Janiuay',NULL),(752,37,'Lambunao',NULL),(753,37,'Leganes',NULL),(754,37,'Lemery',NULL),(755,37,'Leon',NULL),(756,37,'Maasin',NULL),(757,37,'Miagao',NULL),(758,37,'Mina',NULL),(759,37,'New Lucena',NULL),(760,37,'Oton',NULL),(761,37,'City of Passi',NULL),(762,37,'Pavia',NULL),(763,37,'Pototan',NULL),(764,37,'San Dionisio',NULL),(765,37,'San Enrique',NULL),(766,37,'San Joaquin',NULL),(767,37,'San Miguel',NULL),(768,37,'San Rafael',NULL),(769,37,'Santa Barbara',NULL),(770,37,'Sara',NULL),(771,37,'Tigbauan',NULL),(772,37,'Tubungan',NULL),(773,37,'Zarraga',NULL),(774,38,'City of Bacolod',NULL),(775,38,'City of Bago',NULL),(776,38,'Binalbagan',NULL),(777,38,'City of Cadiz',NULL),(778,38,'Calatrava',NULL),(779,38,'Candoni',NULL),(780,38,'Cauayan',NULL),(781,38,'Enrique B. Magalona',NULL),(782,38,'City of Escalante',NULL),(783,38,'City of Himamaylan',NULL),(784,38,'Hinigaran',NULL),(785,38,'Hinoba-an',NULL),(786,38,'Ilog',NULL),(787,38,'Isabela',NULL),(788,38,'City of Kabankalan',NULL),(789,38,'City of La Carlota',NULL),(790,38,'La Castellana',NULL),(791,38,'Manapla',NULL),(792,38,'Moises Padilla',NULL),(793,38,'Murcia',NULL),(794,38,'Pontevedra',NULL),(795,38,'Pulupandan',NULL),(796,38,'City of Sagay',NULL),(797,38,'City of San Carlos',NULL),(798,38,'San Enrique',NULL),(799,38,'City of Silay',NULL),(800,38,'City of Sipalay',NULL),(801,38,'City of Talisay',NULL),(802,38,'Toboso',NULL),(803,38,'Valladolid',NULL),(804,38,'City of Victorias',NULL),(805,38,'Salvador Benedicto',NULL),(806,39,'Buenavista',NULL),(807,39,'Jordan',NULL),(808,39,'Nueva Valencia',NULL),(809,39,'San Lorenzo',NULL),(810,39,'Sibunag',NULL),(811,40,'Alburquerque',NULL),(812,40,'Alicia',NULL),(813,40,'Anda',NULL),(814,40,'Antequera',NULL),(815,40,'Baclayon',NULL),(816,40,'Balilihan',NULL),(817,40,'Batuan',NULL),(818,40,'Bilar',NULL),(819,40,'Buenavista',NULL),(820,40,'Calape',NULL),(821,40,'Candijay',NULL),(822,40,'Carmen',NULL),(823,40,'Catigbian',NULL),(824,40,'Clarin',NULL),(825,40,'Corella',NULL),(826,40,'Cortes',NULL),(827,40,'Dagohoy',NULL),(828,40,'Danao',NULL),(829,40,'Dauis',NULL),(830,40,'Dimiao',NULL),(831,40,'Duero',NULL),(832,40,'Garcia Hernandez',NULL),(833,40,'Guindulman',NULL),(834,40,'Inabanga',NULL),(835,40,'Jagna',NULL),(836,40,'Getafe',NULL),(837,40,'Lila',NULL),(838,40,'Loay',NULL),(839,40,'Loboc',NULL),(840,40,'Loon',NULL),(841,40,'Mabini',NULL),(842,40,'Maribojoc',NULL),(843,40,'Panglao',NULL),(844,40,'Pilar',NULL),(845,40,'Pres. Carlos P. Garcia',NULL),(846,40,'Sagbayan',NULL),(847,40,'San Isidro',NULL),(848,40,'San Miguel',NULL),(849,40,'Sevilla',NULL),(850,40,'Sierra Bullones',NULL),(851,40,'Sikatuna',NULL),(852,40,'City of Tagbilaran',NULL),(853,40,'Talibon',NULL),(854,40,'Trinidad',NULL),(855,40,'Tubigon',NULL),(856,40,'Ubay',NULL),(857,40,'Valencia',NULL),(858,40,'Bien Unido',NULL),(859,41,'Alcantara',NULL),(860,41,'Alcoy',NULL),(861,41,'Alegria',NULL),(862,41,'Aloguinsan',NULL),(863,41,'Argao',NULL),(864,41,'Asturias',NULL),(865,41,'Badian',NULL),(866,41,'Balamban',NULL),(867,41,'Bantayan',NULL),(868,41,'Barili',NULL),(869,41,'City of Bogo',NULL),(870,41,'Boljoon',NULL),(871,41,'Borbon',NULL),(872,41,'City of Carcar',NULL),(873,41,'Carmen',NULL),(874,41,'Catmon',NULL),(875,41,'City of Cebu',NULL),(876,41,'Compostela',NULL),(877,41,'Consolacion',NULL),(878,41,'Cordova',NULL),(879,41,'Daanbantayan',NULL),(880,41,'Dalaguete',NULL),(881,41,'Danao City',NULL),(882,41,'Dumanjug',NULL),(883,41,'Ginatilan',NULL),(884,41,'City of Lapu-Lapu',NULL),(885,41,'Liloan',NULL),(886,41,'Madridejos',NULL),(887,41,'Malabuyoc',NULL),(888,41,'City of Mandaue',NULL),(889,41,'Medellin',NULL),(890,41,'Minglanilla',NULL),(891,41,'Moalboal',NULL),(892,41,'City of Naga',NULL),(893,41,'Oslob',NULL),(894,41,'Pilar',NULL),(895,41,'Pinamungajan',NULL),(896,41,'Poro',NULL),(897,41,'Ronda',NULL),(898,41,'Samboan',NULL),(899,41,'San Fernando',NULL),(900,41,'San Francisco',NULL),(901,41,'San Remigio',NULL),(902,41,'Santa Fe',NULL),(903,41,'Santander',NULL),(904,41,'Sibonga',NULL),(905,41,'Sogod',NULL),(906,41,'Tabogon',NULL),(907,41,'Tabuelan',NULL),(908,41,'City of Talisay',NULL),(909,41,'City of Toledo',NULL),(910,41,'Tuburan',NULL),(911,41,'Tudela',NULL),(912,42,'Amlan',NULL),(913,42,'Ayungon',NULL),(914,42,'Bacong',NULL),(915,42,'City of Bais',NULL),(916,42,'Basay',NULL),(917,42,'City of Bayawan',NULL),(918,42,'Bindoy',NULL),(919,42,'City of Canlaon',NULL),(920,42,'Dauin',NULL),(921,42,'City of Dumaguete',NULL),(922,42,'City of Guihulngan',NULL),(923,42,'Jimalalud',NULL),(924,42,'La Libertad',NULL),(925,42,'Mabinay',NULL),(926,42,'Manjuyod',NULL),(927,42,'Pamplona',NULL),(928,42,'San Jose',NULL),(929,42,'Santa Catalina',NULL),(930,42,'Siaton',NULL),(931,42,'Sibulan',NULL),(932,42,'City of Tanjay',NULL),(933,42,'Tayasan',NULL),(934,42,'Valencia',NULL),(935,42,'Vallehermoso',NULL),(936,42,'Zamboanguita',NULL),(937,43,'Enrique Villanueva',NULL),(938,43,'Larena',NULL),(939,43,'Lazi',NULL),(940,43,'Maria',NULL),(941,43,'San Juan',NULL),(942,43,'Siquijor',NULL),(943,44,'Arteche',NULL),(944,44,'Balangiga',NULL),(945,44,'Balangkayan',NULL),(946,44,'City of Borongan',NULL),(947,44,'Can-Avid',NULL),(948,44,'Dolores',NULL),(949,44,'General Macarthur',NULL),(950,44,'Giporlos',NULL),(951,44,'Guiuan',NULL),(952,44,'Hernani',NULL),(953,44,'Jipapad',NULL),(954,44,'Lawaan',NULL),(955,44,'Llorente',NULL),(956,44,'Maslog',NULL),(957,44,'Maydolong',NULL),(958,44,'Mercedes',NULL),(959,44,'Oras',NULL),(960,44,'Quinapondan',NULL),(961,44,'Salcedo',NULL),(962,44,'San Julian',NULL),(963,44,'San Policarpo',NULL),(964,44,'Sulat',NULL),(965,44,'Taft',NULL),(966,45,'Abuyog',NULL),(967,45,'Alangalang',NULL),(968,45,'Albuera',NULL),(969,45,'Babatngon',NULL),(970,45,'Barugo',NULL),(971,45,'Bato',NULL),(972,45,'City of Baybay',NULL),(973,45,'Burauen',NULL),(974,45,'Calubian',NULL),(975,45,'Capoocan',NULL),(976,45,'Carigara',NULL),(977,45,'Dagami',NULL),(978,45,'Dulag',NULL),(979,45,'Hilongos',NULL),(980,45,'Hindang',NULL),(981,45,'Inopacan',NULL),(982,45,'Isabel',NULL),(983,45,'Jaro',NULL),(984,45,'Javier',NULL),(985,45,'Julita',NULL),(986,45,'Kananga',NULL),(987,45,'La Paz',NULL),(988,45,'Leyte',NULL),(989,45,'Macarthur',NULL),(990,45,'Mahaplag',NULL),(991,45,'Matag-Ob',NULL),(992,45,'Matalom',NULL),(993,45,'Mayorga',NULL),(994,45,'Merida',NULL),(995,45,'Ormoc City',NULL),(996,45,'Palo',NULL),(997,45,'Palompon',NULL),(998,45,'Pastrana',NULL),(999,45,'San Isidro',NULL),(1000,45,'San Miguel',NULL),(1001,45,'Santa Fe',NULL),(1002,45,'Tabango',NULL),(1003,45,'Tabontabon',NULL),(1004,45,'City of Tacloban',NULL),(1005,45,'Tanauan',NULL),(1006,45,'Tolosa',NULL),(1007,45,'Tunga',NULL),(1008,45,'Villaba',NULL),(1009,46,'Allen',NULL),(1010,46,'Biri',NULL),(1011,46,'Bobon',NULL),(1012,46,'Capul',NULL),(1013,46,'Catarman',NULL),(1014,46,'Catubig',NULL),(1015,46,'Gamay',NULL),(1016,46,'Laoang',NULL),(1017,46,'Lapinig',NULL),(1018,46,'Las Navas',NULL),(1019,46,'Lavezares',NULL),(1020,46,'Mapanas',NULL),(1021,46,'Mondragon',NULL),(1022,46,'Palapag',NULL),(1023,46,'Pambujan',NULL),(1024,46,'Rosario',NULL),(1025,46,'San Antonio',NULL),(1026,46,'San Isidro',NULL),(1027,46,'San Jose',NULL),(1028,46,'San Roque',NULL),(1029,46,'San Vicente',NULL),(1030,46,'Silvino Lobos',NULL),(1031,46,'Victoria',NULL),(1032,46,'Lope De Vega',NULL),(1033,47,'Almagro',NULL),(1034,47,'Basey',NULL),(1035,47,'City of Calbayog',NULL),(1036,47,'Calbiga',NULL),(1037,47,'City of Catbalogan',NULL),(1038,47,'Daram',NULL),(1039,47,'Gandara',NULL),(1040,47,'Hinabangan',NULL),(1041,47,'Jiabong',NULL),(1042,47,'Marabut',NULL),(1043,47,'Matuguinao',NULL),(1044,47,'Motiong',NULL),(1045,47,'Pinabacdao',NULL),(1046,47,'San Jose De Buan',NULL),(1047,47,'San Sebastian',NULL),(1048,47,'Santa Margarita',NULL),(1049,47,'Santa Rita',NULL),(1050,47,'Santo Niño',NULL),(1051,47,'Talalora',NULL),(1052,47,'Tarangnan',NULL),(1053,47,'Villareal',NULL),(1054,47,'Paranas',NULL),(1055,47,'Zumarraga',NULL),(1056,47,'Tagapul-An',NULL),(1057,47,'San Jorge',NULL),(1058,47,'Pagsanghan',NULL),(1059,48,'Anahawan',NULL),(1060,48,'Bontoc',NULL),(1061,48,'Hinunangan',NULL),(1062,48,'Hinundayan',NULL),(1063,48,'Libagon',NULL),(1064,48,'Liloan',NULL),(1065,48,'City of Maasin',NULL),(1066,48,'Macrohon',NULL),(1067,48,'Malitbog',NULL),(1068,48,'Padre Burgos',NULL),(1069,48,'Pintuyan',NULL),(1070,48,'Saint Bernard',NULL),(1071,48,'San Francisco',NULL),(1072,48,'San Juan',NULL),(1073,48,'San Ricardo',NULL),(1074,48,'Silago',NULL),(1075,48,'Sogod',NULL),(1076,48,'Tomas Oppus',NULL),(1077,48,'Limasawa',NULL),(1078,49,'Almeria',NULL),(1079,49,'Biliran',NULL),(1080,49,'Cabucgayan',NULL),(1081,49,'Caibiran',NULL),(1082,49,'Culaba',NULL),(1083,49,'Kawayan',NULL),(1084,49,'Maripipi',NULL),(1085,49,'Naval',NULL),(1086,50,'City of Dapitan',NULL),(1087,50,'City of Dipolog',NULL),(1088,50,'Katipunan',NULL),(1089,50,'La Libertad',NULL),(1090,50,'Labason',NULL),(1091,50,'Liloy',NULL),(1092,50,'Manukan',NULL),(1093,50,'Mutia',NULL),(1094,50,'Piñan',NULL),(1095,50,'Polanco',NULL),(1096,50,'Pres. Manuel A. Roxas',NULL),(1097,50,'Rizal',NULL),(1098,50,'Salug',NULL),(1099,50,'Sergio Osmeña Sr.',NULL),(1100,50,'Siayan',NULL),(1101,50,'Sibuco',NULL),(1102,50,'Sibutad',NULL),(1103,50,'Sindangan',NULL),(1104,50,'Siocon',NULL),(1105,50,'Sirawai',NULL),(1106,50,'Tampilisan',NULL),(1107,50,'Jose Dalman',NULL),(1108,50,'Gutalac',NULL),(1109,50,'Baliguian',NULL),(1110,50,'Godod',NULL),(1111,50,'Bacungan',NULL),(1112,50,'Kalawit',NULL),(1113,51,'Aurora',NULL),(1114,51,'Bayog',NULL),(1115,51,'Dimataling',NULL),(1116,51,'Dinas',NULL),(1117,51,'Dumalinao',NULL),(1118,51,'Dumingag',NULL),(1119,51,'Kumalarang',NULL),(1120,51,'Labangan',NULL),(1121,51,'Lapuyan',NULL),(1122,51,'Mahayag',NULL),(1123,51,'Margosatubig',NULL),(1124,51,'Midsalip',NULL),(1125,51,'Molave',NULL),(1126,51,'City of Pagadian',NULL),(1127,51,'Ramon Magsaysay',NULL),(1128,51,'San Miguel',NULL),(1129,51,'San Pablo',NULL),(1130,51,'Tabina',NULL),(1131,51,'Tambulig',NULL),(1132,51,'Tukuran',NULL),(1133,51,'City of Zamboanga',NULL),(1134,51,'Lakewood',NULL),(1135,51,'Josefina',NULL),(1136,51,'Pitogo',NULL),(1137,51,'Sominot',NULL),(1138,51,'Vincenzo A. Sagun',NULL),(1139,51,'Guipos',NULL),(1140,51,'Tigbao',NULL),(1141,52,'Alicia',NULL),(1142,52,'Buug',NULL),(1143,52,'Diplahan',NULL),(1144,52,'Imelda',NULL),(1145,52,'Ipil',NULL),(1146,52,'Kabasalan',NULL),(1147,52,'Mabuhay',NULL),(1148,52,'Malangas',NULL),(1149,52,'Naga',NULL),(1150,52,'Olutanga',NULL),(1151,52,'Payao',NULL),(1152,52,'Roseller Lim',NULL),(1153,52,'Siay',NULL),(1154,52,'Talusan',NULL),(1155,52,'Titay',NULL),(1156,52,'Tungawan',NULL),(1157,52,'City of Isabela',NULL),(1158,53,'Baungon',NULL),(1159,53,'Damulog',NULL),(1160,53,'Dangcagan',NULL),(1161,53,'Don Carlos',NULL),(1162,53,'Impasug-ong',NULL),(1163,53,'Kadingilan',NULL),(1164,53,'Kalilangan',NULL),(1165,53,'Kibawe',NULL),(1166,53,'Kitaotao',NULL),(1167,53,'Lantapan',NULL),(1168,53,'Libona',NULL),(1169,53,'City of Malaybalay',NULL),(1170,53,'Malitbog',NULL),(1171,53,'Manolo Fortich',NULL),(1172,53,'Maramag',NULL),(1173,53,'Pangantucan',NULL),(1174,53,'Quezon',NULL),(1175,53,'San Fernando',NULL),(1176,53,'Sumilao',NULL),(1177,53,'Talakag',NULL),(1178,53,'City of Valencia',NULL),(1179,53,'Cabanglasan',NULL),(1180,54,'Catarman',NULL),(1181,54,'Guinsiliban',NULL),(1182,54,'Mahinog',NULL),(1183,54,'Mambajao',NULL),(1184,54,'Sagay',NULL),(1185,55,'Bacolod',NULL),(1186,55,'Baloi',NULL),(1187,55,'Baroy',NULL),(1188,55,'City of Iligan',NULL),(1189,55,'Kapatagan',NULL),(1190,55,'Sultan Naga Dimaporo',NULL),(1191,55,'Kauswagan',NULL),(1192,55,'Kolambugan',NULL),(1193,55,'Lala',NULL),(1194,55,'Linamon',NULL),(1195,55,'Magsaysay',NULL),(1196,55,'Maigo',NULL),(1197,55,'Matungao',NULL),(1198,55,'Munai',NULL),(1199,55,'Nunungan',NULL),(1200,55,'Pantao Ragat',NULL),(1201,55,'Poona Piagapo',NULL),(1202,55,'Salvador',NULL),(1203,55,'Sapad',NULL),(1204,55,'Tagoloan',NULL),(1205,55,'Tangcal',NULL),(1206,55,'Tubod',NULL),(1207,55,'Pantar',NULL),(1208,56,'Aloran',NULL),(1209,56,'Baliangao',NULL),(1210,56,'Bonifacio',NULL),(1211,56,'Calamba',NULL),(1212,56,'Clarin',NULL),(1213,56,'Concepcion',NULL),(1214,56,'Jimenez',NULL),(1215,56,'Lopez Jaena',NULL),(1216,56,'City of Oroquieta',NULL),(1217,56,'City of Ozamiz',NULL),(1218,56,'Panaon',NULL),(1219,56,'Plaridel',NULL),(1220,56,'Sapang Dalaga',NULL),(1221,56,'Sinacaban',NULL),(1222,56,'City of Tangub',NULL),(1223,56,'Tudela',NULL),(1224,56,'Don Victoriano Chiongbian',NULL),(1225,57,'Alubijid',NULL),(1226,57,'Balingasag',NULL),(1227,57,'Balingoan',NULL),(1228,57,'Binuangan',NULL),(1229,57,'City of Cagayan De Oro',NULL),(1230,57,'Claveria',NULL),(1231,57,'City of El Salvador',NULL),(1232,57,'City of Gingoog',NULL),(1233,57,'Gitagum',NULL),(1234,57,'Initao',NULL),(1235,57,'Jasaan',NULL),(1236,57,'Kinoguitan',NULL),(1237,57,'Lagonglong',NULL),(1238,57,'Laguindingan',NULL),(1239,57,'Libertad',NULL),(1240,57,'Lugait',NULL),(1241,57,'Magsaysay',NULL),(1242,57,'Manticao',NULL),(1243,57,'Medina',NULL),(1244,57,'Naawan',NULL),(1245,57,'Opol',NULL),(1246,57,'Salay',NULL),(1247,57,'Sugbongcogon',NULL),(1248,57,'Tagoloan',NULL),(1249,57,'Talisayan',NULL),(1250,57,'Villanueva',NULL),(1251,58,'Asuncion',NULL),(1252,58,'Carmen',NULL),(1253,58,'Kapalong',NULL),(1254,58,'New Corella',NULL),(1255,58,'City of Panabo',NULL),(1256,58,'Island Garden City of Samal',NULL),(1257,58,'Santo Tomas',NULL),(1258,58,'City of Tagum',NULL),(1259,58,'Talaingod',NULL),(1260,58,'Braulio E. Dujali',NULL),(1261,58,'San Isidro',NULL),(1262,59,'Bansalan',NULL),(1263,59,'City of Davao',NULL),(1264,59,'City of Digos',NULL),(1265,59,'Hagonoy',NULL),(1266,59,'Kiblawan',NULL),(1267,59,'Magsaysay',NULL),(1268,59,'Malalag',NULL),(1269,59,'Matanao',NULL),(1270,59,'Padada',NULL),(1271,59,'Santa Cruz',NULL),(1272,59,'Sulop',NULL),(1273,60,'Baganga',NULL),(1274,60,'Banaybanay',NULL),(1275,60,'Boston',NULL),(1276,60,'Caraga',NULL),(1277,60,'Cateel',NULL),(1278,60,'Governor Generoso',NULL),(1279,60,'Lupon',NULL),(1280,60,'Manay',NULL),(1281,60,'City of Mati',NULL),(1282,60,'San Isidro',NULL),(1283,60,'Tarragona',NULL),(1284,61,'Compostela',NULL),(1285,61,'Laak',NULL),(1286,61,'Mabini',NULL),(1287,61,'Maco',NULL),(1288,61,'Maragusan',NULL),(1289,61,'Mawab',NULL),(1290,61,'Monkayo',NULL),(1291,61,'Montevista',NULL),(1292,61,'Nabunturan',NULL),(1293,61,'New Bataan',NULL),(1294,61,'Pantukan',NULL),(1295,62,'Don Marcelino',NULL),(1296,62,'Jose Abad Santos',NULL),(1297,62,'Malita',NULL),(1298,62,'Santa Maria',NULL),(1299,62,'Sarangani',NULL),(1300,63,'Alamada',NULL),(1301,63,'Carmen',NULL),(1302,63,'Kabacan',NULL),(1303,63,'City of Kidapawan',NULL),(1304,63,'Libungan',NULL),(1305,63,'Magpet',NULL),(1306,63,'Makilala',NULL),(1307,63,'Matalam',NULL),(1308,63,'Midsayap',NULL),(1309,63,'M\'Lang',NULL),(1310,63,'Pigkawayan',NULL),(1311,63,'Pikit',NULL),(1312,63,'President Roxas',NULL),(1313,63,'Tulunan',NULL),(1314,63,'Antipas',NULL),(1315,63,'Banisilan',NULL),(1316,63,'Aleosan',NULL),(1317,63,'Arakan',NULL),(1318,64,'Banga',NULL),(1319,64,'City of General Santos',NULL),(1320,64,'City of Koronadal',NULL),(1321,64,'Norala',NULL),(1322,64,'Polomolok',NULL),(1323,64,'Surallah',NULL),(1324,64,'Tampakan',NULL),(1325,64,'Tantangan',NULL),(1326,64,'T\'Boli',NULL),(1327,64,'Tupi',NULL),(1328,64,'Santo Niño',NULL),(1329,64,'Lake Sebu',NULL),(1330,65,'Bagumbayan',NULL),(1331,65,'Columbio',NULL),(1332,65,'Esperanza',NULL),(1333,65,'Isulan',NULL),(1334,65,'Kalamansig',NULL),(1335,65,'Lebak',NULL),(1336,65,'Lutayan',NULL),(1337,65,'Lambayong',NULL),(1338,65,'Palimbang',NULL),(1339,65,'President Quirino',NULL),(1340,65,'City of Tacurong',NULL),(1341,65,'Sen. Ninoy Aquino',NULL),(1342,66,'Alabel',NULL),(1343,66,'Glan',NULL),(1344,66,'Kiamba',NULL),(1345,66,'Maasim',NULL),(1346,66,'Maitum',NULL),(1347,66,'Malapatan',NULL),(1348,66,'Malungon',NULL),(1349,66,'Cotabato City',NULL),(1350,1,'Manila',NULL),(1351,1,'Mandaluyong City',NULL),(1352,1,'Marikina City',NULL),(1353,1,'Pasig City',NULL),(1354,1,'Quezon City',NULL),(1355,1,'San Juan City',NULL),(1356,1,'Caloocan City',NULL),(1357,1,'Malabon City',NULL),(1358,1,'Navotas City',NULL),(1359,1,'Valenzuela City',NULL),(1360,1,'Las Piñas City',NULL),(1361,1,'Makati City',NULL),(1362,1,'Muntinlupa City',NULL),(1363,1,'Parañaque City',NULL),(1364,1,'Pasay City',NULL),(1365,1,'Pateros',NULL),(1366,1,'Taguig City',NULL),(1367,67,'Bangued',NULL),(1368,67,'Boliney',NULL),(1369,67,'Bucay',NULL),(1370,67,'Bucloc',NULL),(1371,67,'Daguioman',NULL),(1372,67,'Danglas',NULL),(1373,67,'Dolores',NULL),(1374,67,'La Paz',NULL),(1375,67,'Lacub',NULL),(1376,67,'Lagangilang',NULL),(1377,67,'Lagayan',NULL),(1378,67,'Langiden',NULL),(1379,67,'Licuan-Baay',NULL),(1380,67,'Luba',NULL),(1381,67,'Malibcong',NULL),(1382,67,'Manabo',NULL),(1383,67,'Peñarrubia',NULL),(1384,67,'Pidigan',NULL),(1385,67,'Pilar',NULL),(1386,67,'Sallapadan',NULL),(1387,67,'San Isidro',NULL),(1388,67,'San Juan',NULL),(1389,67,'San Quintin',NULL),(1390,67,'Tayum',NULL),(1391,67,'Tineg',NULL),(1392,67,'Tubo',NULL),(1393,67,'Villaviciosa',NULL),(1394,68,'Atok',NULL),(1395,68,'City of Baguio',NULL),(1396,68,'Bakun',NULL),(1397,68,'Bokod',NULL),(1398,68,'Buguias',NULL),(1399,68,'Itogon',NULL),(1400,68,'Kabayan',NULL),(1401,68,'Kapangan',NULL),(1402,68,'Kibungan',NULL),(1403,68,'La Trinidad',NULL),(1404,68,'Mankayan',NULL),(1405,68,'Sablan',NULL),(1406,68,'Tuba',NULL),(1407,68,'Tublay',NULL),(1408,69,'Banaue',NULL),(1409,69,'Hungduan',NULL),(1410,69,'Kiangan',NULL),(1411,69,'Lagawe',NULL),(1412,69,'Lamut',NULL),(1413,69,'Mayoyao',NULL),(1414,69,'Alfonso Lista',NULL),(1415,69,'Aguinaldo',NULL),(1416,69,'Hingyon',NULL),(1417,69,'Tinoc',NULL),(1418,69,'Asipulo',NULL),(1419,70,'Balbalan',NULL),(1420,70,'Lubuagan',NULL),(1421,70,'Pasil',NULL),(1422,70,'Pinukpuk',NULL),(1423,70,'Rizal',NULL),(1424,70,'City of Tabuk',NULL),(1425,70,'Tanudan',NULL),(1426,70,'Tinglayan',NULL),(1427,71,'Barlig',NULL),(1428,71,'Bauko',NULL),(1429,71,'Besao',NULL),(1430,71,'Bontoc',NULL),(1431,71,'Natonin',NULL),(1432,71,'Paracelis',NULL),(1433,71,'Sabangan',NULL),(1434,71,'Sadanga',NULL),(1435,71,'Sagada',NULL),(1436,71,'Tadian',NULL),(1437,72,'Calanasan',NULL),(1438,72,'Conner',NULL),(1439,72,'Flora',NULL),(1440,72,'Kabugao',NULL),(1441,72,'Luna',NULL),(1442,72,'Pudtol',NULL),(1443,72,'Santa Marcela',NULL),(1444,73,'City of Lamitan',NULL),(1445,73,'Lantawan',NULL),(1446,73,'Maluso',NULL),(1447,73,'Sumisip',NULL),(1448,73,'Tipo-Tipo',NULL),(1449,73,'Tuburan',NULL),(1450,73,'Akbar',NULL),(1451,73,'Al-Barka',NULL),(1452,73,'Hadji Mohammad Ajul',NULL),(1453,73,'Ungkaya Pukan',NULL),(1454,73,'Hadji Muhtamad',NULL),(1455,73,'Tabuan-Lasa',NULL),(1456,74,'Bacolod-Kalawi',NULL),(1457,74,'Balabagan',NULL),(1458,74,'Balindong',NULL),(1459,74,'Bayang',NULL),(1460,74,'Binidayan',NULL),(1461,74,'Bubong',NULL),(1462,74,'Butig',NULL),(1463,74,'Ganassi',NULL),(1464,74,'Kapai',NULL),(1465,74,'Lumba-Bayabao',NULL),(1466,74,'Lumbatan',NULL),(1467,74,'Madalum',NULL),(1468,74,'Madamba',NULL),(1469,74,'Malabang',NULL),(1470,74,'Marantao',NULL),(1471,74,'City of Marawi',NULL),(1472,74,'Masiu',NULL),(1473,74,'Mulondo',NULL),(1474,74,'Pagayawan',NULL),(1475,74,'Piagapo',NULL),(1476,74,'Poona Bayabao',NULL),(1477,74,'Pualas',NULL),(1478,74,'Ditsaan-Ramain',NULL),(1479,74,'Saguiaran',NULL),(1480,74,'Tamparan',NULL),(1481,74,'Taraka',NULL),(1482,74,'Tubaran',NULL),(1483,74,'Tugaya',NULL),(1484,74,'Wao',NULL),(1485,74,'Marogong',NULL),(1486,74,'Calanogas',NULL),(1487,74,'Buadiposo-Buntong',NULL),(1488,74,'Maguing',NULL),(1489,74,'Picong',NULL),(1490,74,'Lumbayanague',NULL),(1491,74,'Amai Manabilang',NULL),(1492,74,'Tagoloan Ii',NULL),(1493,74,'Kapatagan',NULL),(1494,74,'Sultan Dumalondong',NULL),(1495,74,'Lumbaca-Unayan',NULL),(1496,75,'Ampatuan',NULL),(1497,75,'Buldon',NULL),(1498,75,'Buluan',NULL),(1499,75,'Datu Paglas',NULL),(1500,75,'Datu Piang',NULL),(1501,75,'Datu Odin Sinsuat',NULL),(1502,75,'Shariff Aguak',NULL),(1503,75,'Matanog',NULL),(1504,75,'Pagalungan',NULL),(1505,75,'Parang',NULL),(1506,75,'Sultan Kudarat',NULL),(1507,75,'Sultan Sa Barongis',NULL),(1508,75,'Kabuntalan',NULL),(1509,75,'Upi',NULL),(1510,75,'Talayan',NULL),(1511,75,'South Upi',NULL),(1512,75,'Barira',NULL),(1513,75,'Gen. S.K. Pendatun',NULL),(1514,75,'Mamasapano',NULL),(1515,75,'Talitay',NULL),(1516,75,'Pagagawan',NULL),(1517,75,'Paglat',NULL),(1518,75,'Sultan Mastura',NULL),(1519,75,'Guindulungan',NULL),(1520,75,'Datu Saudi-Ampatuan',NULL),(1521,75,'Datu Unsay',NULL),(1522,75,'Datu Abdullah Sangki',NULL),(1523,75,'Rajah Buayan',NULL),(1524,75,'Datu Blah T. Sinsuat',NULL),(1525,75,'Datu Anggal Midtimbang',NULL),(1526,75,'Mangudadatu',NULL),(1527,75,'Pandag',NULL),(1528,75,'Northern Kabuntalan',NULL),(1529,75,'Datu Hoffer Ampatuan',NULL),(1530,75,'Datu Salibo',NULL),(1531,75,'Shariff Saydona Mustapha',NULL),(1532,76,'Indanan',NULL),(1533,76,'Jolo',NULL),(1534,76,'Kalingalan Caluang',NULL),(1535,76,'Luuk',NULL),(1536,76,'Maimbung',NULL),(1537,76,'Hadji Panglima Tahil',NULL),(1538,76,'Old Panamao',NULL),(1539,76,'Pangutaran',NULL),(1540,76,'Parang',NULL),(1541,76,'Pata',NULL),(1542,76,'Patikul',NULL),(1543,76,'Siasi',NULL),(1544,76,'Talipao',NULL),(1545,76,'Tapul',NULL),(1546,76,'Tongkil',NULL),(1547,76,'Panglima Estino',NULL),(1548,76,'Lugus',NULL),(1549,76,'Pandami',NULL),(1550,76,'Omar',NULL),(1551,77,'Panglima Sugala',NULL),(1552,77,'Bongao (Capital)',NULL),(1553,77,'Mapun',NULL),(1554,77,'Simunul',NULL),(1555,77,'Sitangkai',NULL),(1556,77,'South Ubian',NULL),(1557,77,'Tandubas',NULL),(1558,77,'Turtle Islands',NULL),(1559,77,'Languyan',NULL),(1560,77,'Sapa-Sapa',NULL),(1561,77,'Sibutu',NULL),(1562,78,'Buenavista',NULL),(1563,78,'City of Butuan',NULL),(1564,78,'City of Cabadbaran',NULL),(1565,78,'Carmen',NULL),(1566,78,'Jabonga',NULL),(1567,78,'Kitcharao',NULL),(1568,78,'Las Nieves',NULL),(1569,78,'Magallanes',NULL),(1570,78,'Nasipit',NULL),(1571,78,'Santiago',NULL),(1572,78,'Tubay',NULL),(1573,78,'Remedios T. Romualdez',NULL),(1574,79,'City of Bayugan',NULL),(1575,79,'Bunawan',NULL),(1576,79,'Esperanza',NULL),(1577,79,'La Paz',NULL),(1578,79,'Loreto',NULL),(1579,79,'Prosperidad',NULL),(1580,79,'Rosario',NULL),(1581,79,'San Francisco',NULL),(1582,79,'San Luis',NULL),(1583,79,'Santa Josefa',NULL),(1584,79,'Talacogon',NULL),(1585,79,'Trento',NULL),(1586,79,'Veruela',NULL),(1587,79,'Sibagat',NULL),(1588,80,'Alegria',NULL),(1589,80,'Bacuag',NULL),(1590,80,'Burgos',NULL),(1591,80,'Claver',NULL),(1592,80,'Dapa',NULL),(1593,80,'Del Carmen',NULL),(1594,80,'General Luna',NULL),(1595,80,'Gigaquit',NULL),(1596,80,'Mainit',NULL),(1597,80,'Malimono',NULL),(1598,80,'Pilar',NULL),(1599,80,'Placer',NULL),(1600,80,'San Benito',NULL),(1601,80,'San Francisco',NULL),(1602,80,'San Isidro',NULL),(1603,80,'Santa Monica',NULL),(1604,80,'Sison',NULL),(1605,80,'Socorro',NULL),(1606,80,'City of Surigao',NULL),(1607,80,'Tagana-An',NULL),(1608,80,'Tubod',NULL),(1609,81,'Barobo',NULL),(1610,81,'Bayabas',NULL),(1611,81,'City of Bislig',NULL),(1612,81,'Cagwait',NULL),(1613,81,'Cantilan',NULL),(1614,81,'Carmen',NULL),(1615,81,'Carrascal',NULL),(1616,81,'Cortes',NULL),(1617,81,'Hinatuan',NULL),(1618,81,'Lanuza',NULL),(1619,81,'Lianga',NULL),(1620,81,'Lingig',NULL),(1621,81,'Madrid',NULL),(1622,81,'Marihatag',NULL),(1623,81,'San Agustin',NULL),(1624,81,'San Miguel',NULL),(1625,81,'Tagbina',NULL),(1626,81,'Tago',NULL),(1627,81,'City of Tandag',NULL),(1628,82,'Basilisa',NULL),(1629,82,'Cagdianao',NULL),(1630,82,'Dinagat',NULL),(1631,82,'Libjo',NULL),(1632,82,'Loreto',NULL),(1633,82,'San Jose',NULL),(1634,82,'Tubajon',NULL);
/*!40000 ALTER TABLE `tblcity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcompany`
--

DROP TABLE IF EXISTS `tblcompany`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblcompany` (
  `COMPANY_ID` varchar(50) NOT NULL,
  `COMPANY_NAME` varchar(100) NOT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `TELEPHONE` varchar(20) DEFAULT NULL,
  `PHONE` varchar(20) DEFAULT NULL,
  `WEBSITE` varchar(100) DEFAULT NULL,
  `ADDRESS` varchar(200) DEFAULT NULL,
  `PROVINCE_ID` int(11) DEFAULT NULL,
  `CITY_ID` int(11) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`COMPANY_ID`),
  KEY `company_index` (`COMPANY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcompany`
--

LOCK TABLES `tblcompany` WRITE;
/*!40000 ALTER TABLE `tblcompany` DISABLE KEYS */;
INSERT INTO `tblcompany` VALUES ('1','Encore Leasing and Finance Corporation','customercare@encorefinancials.com','0449405625','09178389361','http://www.encorefinancials.com','Km 114',13,257,'TL-84','UPD->ADMIN->2022-02-08 10:55:36');
/*!40000 ALTER TABLE `tblcompany` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcontributionbracket`
--

DROP TABLE IF EXISTS `tblcontributionbracket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblcontributionbracket` (
  `CONTRIBUTION_BRACKET_ID` varchar(100) NOT NULL,
  `GOVERNMENT_CONTRIBUTION_ID` varchar(100) DEFAULT NULL,
  `START_RANGE` double DEFAULT NULL,
  `END_RANGE` double DEFAULT NULL,
  `DEDUCTION_AMOUNT` double DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CONTRIBUTION_BRACKET_ID`),
  KEY `contribution_bracket_index` (`CONTRIBUTION_BRACKET_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcontributionbracket`
--

LOCK TABLES `tblcontributionbracket` WRITE;
/*!40000 ALTER TABLE `tblcontributionbracket` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcontributionbracket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcontributiondeduction`
--

DROP TABLE IF EXISTS `tblcontributiondeduction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblcontributiondeduction` (
  `CONTRIBUTION_DEDUCTION_ID` varchar(100) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `GOVERNMENT_CONTRIBUTION_TYPE` varchar(50) NOT NULL,
  `PAYROLL_ID` date DEFAULT NULL,
  `PAYROLL_DATE` date NOT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CONTRIBUTION_DEDUCTION_ID`),
  KEY `contribution_deduction_index` (`CONTRIBUTION_DEDUCTION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcontributiondeduction`
--

LOCK TABLES `tblcontributiondeduction` WRITE;
/*!40000 ALTER TABLE `tblcontributiondeduction` DISABLE KEYS */;
INSERT INTO `tblcontributiondeduction` VALUES ('1','7','5',NULL,'2022-04-01','TL-1083','UPD->LDAGULTO->2022-04-13 01:42:35'),('10','7','5',NULL,'2023-01-01','TL-1092','INS->LDAGULTO->2022-04-13 01:35:10'),('11','7','5',NULL,'2023-02-01','TL-1093','INS->LDAGULTO->2022-04-13 01:35:10'),('12','7','5',NULL,'2023-03-01','TL-1094','INS->LDAGULTO->2022-04-13 01:35:10'),('2','7','5',NULL,'2022-05-01','TL-1084','INS->LDAGULTO->2022-04-13 01:35:08'),('3','7','5',NULL,'2022-06-01','TL-1085','INS->LDAGULTO->2022-04-13 01:35:09'),('4','7','5',NULL,'2022-07-01','TL-1086','INS->LDAGULTO->2022-04-13 01:35:09'),('5','7','5',NULL,'2022-08-01','TL-1087','INS->LDAGULTO->2022-04-13 01:35:09'),('6','7','5',NULL,'2022-09-01','TL-1088','INS->LDAGULTO->2022-04-13 01:35:10'),('7','7','5',NULL,'2022-10-01','TL-1089','INS->LDAGULTO->2022-04-13 01:35:10'),('8','7','5',NULL,'2022-11-01','TL-1090','INS->LDAGULTO->2022-04-13 01:35:10'),('9','7','5',NULL,'2022-12-01','TL-1091','INS->LDAGULTO->2022-04-13 01:35:10');
/*!40000 ALTER TABLE `tblcontributiondeduction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbldeduction`
--

DROP TABLE IF EXISTS `tbldeduction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbldeduction` (
  `DEDUCTION_ID` varchar(100) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `DEDUCTION_TYPE` varchar(100) NOT NULL,
  `PAYROLL_ID` date DEFAULT NULL,
  `PAYROLL_DATE` date NOT NULL,
  `AMOUNT` double DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`DEDUCTION_ID`),
  KEY `deduction_index` (`DEDUCTION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbldeduction`
--

LOCK TABLES `tbldeduction` WRITE;
/*!40000 ALTER TABLE `tbldeduction` DISABLE KEYS */;
INSERT INTO `tbldeduction` VALUES ('10','7','1',NULL,'2022-06-01',1000,'TL-1064','UPD->LDAGULTO->2022-04-13 10:46:38'),('11','7','1',NULL,'2022-07-01',12,'TL-1065','INS->LDAGULTO->2022-04-13 10:44:21'),('12','7','1',NULL,'2022-08-01',12,'TL-1066','INS->LDAGULTO->2022-04-13 10:44:21'),('13','7','1',NULL,'2022-09-01',12,'TL-1067','INS->LDAGULTO->2022-04-13 10:44:21'),('14','7','1',NULL,'2022-10-01',12,'TL-1068','INS->LDAGULTO->2022-04-13 10:44:21'),('15','7','1',NULL,'2022-11-01',12,'TL-1069','INS->LDAGULTO->2022-04-13 10:44:21'),('16','7','1',NULL,'2022-12-01',12,'TL-1070','INS->LDAGULTO->2022-04-13 10:44:22'),('17','7','1',NULL,'2023-01-01',12,'TL-1071','INS->LDAGULTO->2022-04-13 10:44:22'),('18','7','1',NULL,'2023-02-01',12,'TL-1072','INS->LDAGULTO->2022-04-13 10:44:22'),('19','7','1',NULL,'2023-03-01',12,'TL-1073','INS->LDAGULTO->2022-04-13 10:44:22'),('8','7','1',NULL,'2022-04-01',12,'TL-1062','INS->LDAGULTO->2022-04-13 10:44:20'),('9','7','1',NULL,'2022-05-01',12,'TL-1063','INS->LDAGULTO->2022-04-13 10:44:20');
/*!40000 ALTER TABLE `tbldeduction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbldeductiontype`
--

DROP TABLE IF EXISTS `tbldeductiontype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbldeductiontype` (
  `DEDUCTION_TYPE_ID` varchar(100) NOT NULL,
  `DEDUCTION_TYPE` varchar(50) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`DEDUCTION_TYPE_ID`),
  KEY `deduction_type_index` (`DEDUCTION_TYPE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbldeductiontype`
--

LOCK TABLES `tbldeductiontype` WRITE;
/*!40000 ALTER TABLE `tbldeductiontype` DISABLE KEYS */;
INSERT INTO `tbldeductiontype` VALUES ('1','Cash Advance','Deduction for employees that availed a cash advance.','TL-877','UPD->LDAGULTO->2022-04-13 10:28:29');
/*!40000 ALTER TABLE `tbldeductiontype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbldepartment`
--

DROP TABLE IF EXISTS `tbldepartment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbldepartment` (
  `DEPARTMENT_ID` varchar(50) NOT NULL,
  `DEPARTMENT` varchar(200) NOT NULL,
  `DESCRIPTION` varchar(200) NOT NULL,
  `DEPARTMENT_HEAD` varchar(100) DEFAULT NULL,
  `PARENT_DEPARTMENT` varchar(50) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`DEPARTMENT_ID`),
  KEY `department_index` (`DEPARTMENT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbldepartment`
--

LOCK TABLES `tbldepartment` WRITE;
/*!40000 ALTER TABLE `tbldepartment` DISABLE KEYS */;
INSERT INTO `tbldepartment` VALUES ('DEPT-1','Data Center','Data Center Department','7','','TL-94','UPD->LDAGULTO->2022-03-18 10:12:28'),('DEPT-2','HR And Admin','Human Resource and Admin Department',NULL,NULL,'TL-95','UPD->ADMIN->2022-01-03 04:48:40'),('DEPT-3','Operations','Operations Department',NULL,NULL,'TL-96','INS->ADMIN->2022-01-03 04:48:19'),('DEPT-4','CI And Collection','Credit Investigation and Collection Department',NULL,NULL,'TL-97','INS->ADMIN->2022-01-03 04:48:35'),('DEPT-5','Sales','Sales Department',NULL,NULL,'TL-98','INS->ADMIN->2022-01-03 04:48:52'),('DEPT-6','Finance','Finance Department',NULL,NULL,'TL-99','INS->ADMIN->2022-01-03 04:49:02'),('DEPT-7','Executive','Executive Department',NULL,NULL,'TL-100','INS->ADMIN->2022-01-03 04:49:17'),('DEPT-8','CRCP','CRCP Department','','','TL-101','UPD->ADMIN->2022-02-08 01:11:37');
/*!40000 ALTER TABLE `tbldepartment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbldesignation`
--

DROP TABLE IF EXISTS `tbldesignation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbldesignation` (
  `DESIGNATION_ID` varchar(50) NOT NULL,
  `DESIGNATION` varchar(200) NOT NULL,
  `DESCRIPTION` varchar(200) NOT NULL,
  `JOB_DESCRIPTION` varchar(500) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`DESIGNATION_ID`),
  KEY `designation_index` (`DESIGNATION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbldesignation`
--

LOCK TABLES `tbldesignation` WRITE;
/*!40000 ALTER TABLE `tbldesignation` DISABLE KEYS */;
INSERT INTO `tbldesignation` VALUES ('DES-1','Data Center Staff','Data Center Staff',NULL,'TL-108','INS->ADMIN->2022-01-04 02:20:04'),('DES-10','Sales Staff','Sales Staff',NULL,'TL-117','INS->ADMIN->2022-01-04 02:30:19'),('DES-11','Finance Head','Finance Head',NULL,'TL-118','INS->ADMIN->2022-01-04 02:30:26'),('DES-12','Finance Staff','Finance Staff',NULL,'TL-119','INS->ADMIN->2022-01-04 02:30:31'),('DES-13','CRCP Head','CRCP Head',NULL,'TL-120','INS->ADMIN->2022-01-04 02:30:38'),('DES-14','President & CEO','President & CEO',NULL,'TL-121','INS->ADMIN->2022-01-04 02:30:49'),('DES-15','Security Guard','Security Guard',NULL,'TL-122','INS->ADMIN->2022-01-04 02:31:01'),('DES-16','Executive Staff','Executive Staff',NULL,'TL-123','INS->ADMIN->2022-01-04 02:31:09'),('DES-17','General Manager','General Manager',NULL,'TL-124','INS->ADMIN->2022-01-04 02:31:17'),('DES-2','Data Center Head','Data Center Head',NULL,'TL-109','INS->ADMIN->2022-01-04 02:29:12'),('DES-3','HR and Admin Head','HR and Admin Head',NULL,'TL-110','INS->ADMIN->2022-01-04 02:29:26'),('DES-4','HR and Admin Staff','HR and Admin Staff',NULL,'TL-111','INS->ADMIN->2022-01-04 02:29:35'),('DES-5','Operations Head','Operations Head',NULL,'TL-112','INS->ADMIN->2022-01-04 02:29:43'),('DES-6','Operations Staff','Operations Staff',NULL,'TL-113','INS->ADMIN->2022-01-04 02:29:49'),('DES-7','CI and Collection Head','CI and Collection Head','./job_description/9q6aw31f2y.pdf','TL-114','UPD->ADMIN->2022-01-05 09:45:19'),('DES-8','CI and Collection Staff','CI and Collection Staff',NULL,'TL-115','INS->ADMIN->2022-01-04 02:30:04'),('DES-9','Sales Head','Sales Head',NULL,'TL-116','INS->ADMIN->2022-01-04 02:30:14');
/*!40000 ALTER TABLE `tbldesignation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemergencycontact`
--

DROP TABLE IF EXISTS `tblemergencycontact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblemergencycontact` (
  `CONTACT_ID` varchar(100) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `NAME` varchar(300) NOT NULL,
  `RELATIONSHIP` varchar(20) NOT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `PHONE` varchar(30) NOT NULL,
  `TELEPHONE` varchar(30) DEFAULT NULL,
  `ADDRESS` varchar(200) DEFAULT NULL,
  `CITY` int(11) DEFAULT NULL,
  `PROVINCE` int(11) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CONTACT_ID`),
  KEY `emergency_contact_index` (`CONTACT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemergencycontact`
--

LOCK TABLES `tblemergencycontact` WRITE;
/*!40000 ALTER TABLE `tblemergencycontact` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemergencycontact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemployee`
--

DROP TABLE IF EXISTS `tblemployee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblemployee` (
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `ID_NUMBER` varchar(100) NOT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `FILE_AS` varchar(500) NOT NULL,
  `FIRST_NAME` varchar(100) NOT NULL,
  `MIDDLE_NAME` varchar(100) DEFAULT NULL,
  `LAST_NAME` varchar(100) NOT NULL,
  `SUFFIX` varchar(20) DEFAULT NULL,
  `BIRTHDAY` date NOT NULL,
  `EMPLOYMENT_STATUS` varchar(50) NOT NULL,
  `JOIN_DATE` date NOT NULL,
  `EXIT_DATE` date DEFAULT NULL,
  `PERMANENCY_DATE` date DEFAULT NULL,
  `EXIT_REASON` varchar(500) DEFAULT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PHONE` varchar(30) DEFAULT NULL,
  `TELEPHONE` varchar(30) DEFAULT NULL,
  `DEPARTMENT` varchar(50) NOT NULL,
  `DESIGNATION` varchar(50) NOT NULL,
  `BRANCH` varchar(50) NOT NULL,
  `GENDER` varchar(20) NOT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`EMPLOYEE_ID`),
  KEY `employee_index` (`EMPLOYEE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemployee`
--

LOCK TABLES `tblemployee` WRITE;
/*!40000 ALTER TABLE `tblemployee` DISABLE KEYS */;
INSERT INTO `tblemployee` VALUES ('10','9',NULL,'Garsula, Mark Anthony','Mark Anthony','','Garsula','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'magarsula@encorefinancials.com','','','DEPT-4','DES-7','BRCH-1','','TL-223','INS->ADMIN->2022-01-14 02:47:45'),('11','41',NULL,'Rivera, Carlo','Carlo','','Rivera','','0000-00-00','3','2021-10-01',NULL,NULL,NULL,'csrivera@encorefinancials.com','','','DEPT-5','DES-9','BRCH-1','','TL-224','UPD->ADMIN->2022-01-14 02:48:33'),('12','46',NULL,'Duclayan, Ariel','Ariel','','Duclayan','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'adduclayan@encorefinancials.co','','','DEPT-4','DES-8','BRCH-1','','TL-225','INS->ADMIN->2022-01-14 02:49:19'),('13','7',NULL,'Fernandez, Francisco','Francisco','','Fernandez','','0000-00-00','3','2021-10-01',NULL,NULL,NULL,'ffernandez@encorefinancials.com','','','DEPT-5','DES-9','BRCH-1','','TL-226','INS->ADMIN->2022-01-14 02:50:20'),('14','35',NULL,'Reyes, Camille','Camille','','Reyes','','0000-00-00','3','2021-10-01',NULL,NULL,NULL,'creyes@encorefinancials.com','','','DEPT-5','DES-10','BRCH-1','','TL-227','INS->ADMIN->2022-01-14 02:51:25'),('15','5',NULL,'Cadiz-Baena, Anjeli','Anjeli','','Cadiz-Baena','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'ascadiz@encorefinancials.com','','','DEPT-6','DES-11','BRCH-1','','TL-228','INS->ADMIN->2022-01-14 02:51:57'),('16','1',NULL,'Cadiz, Jose Imperial, Jr.','Jose','Imperial','Cadiz','JR','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'jscadiz@encorefinancials.com','','','DEPT-7','DES-14','BRCH-1','','TL-229','UPD->ADMIN->2022-01-14 02:55:29'),('17','68',NULL,'Cajucom, Alyssa Keith Sarondo','Alyssa Keith','Sarondo','Cajucom','','0000-00-00','3','2021-10-01',NULL,NULL,NULL,'ascajucom@encorefinancials.com','','','DEPT-5','DES-10','BRCH-1','','TL-230','INS->ADMIN->2022-01-14 02:53:57'),('19','71',NULL,'Santiago, Melvin','Melvin','','Santiago','','0000-00-00','3','2021-10-01',NULL,NULL,NULL,'mbsantiago@encorefinancials.com','','','DEPT-4','DES-8','BRCH-2','','TL-231','UPD->ADMIN->2022-01-14 02:57:47'),('2','8','GTBONITA','Bonita, Glen Tacadino','Glen','Tacadino','Bonita','','0000-00-00','1','2015-10-05',NULL,NULL,NULL,'gtbonita@encorefinancials.com','','','DEPT-1','DES-2','BRCH-1','','TL-215','INS->ADMIN->2022-01-12 05:04:41'),('20','4',NULL,'Dela Fuente, Albert','Albert','','Dela Fuente','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'adelafuente@encorefinancials.com','','','DEPT-8','DES-13','BRCH-1','','TL-232','INS->ADMIN->2022-01-14 02:58:37'),('21','37',NULL,'Dela Cruz, Rogelio','Rogelio','','Dela Cruz','','0000-00-00','1','2021-09-30',NULL,NULL,NULL,'rfdelacruz@encorefinancials.co','','','DEPT-4','DES-8','BRCH-1','','TL-233','INS->ADMIN->2022-01-14 02:59:15'),('27','73',NULL,'Ganias, Kristine','Kristine','','Ganias','','0000-00-00','3','2021-10-01',NULL,NULL,NULL,'ksganias@encorefinancials.com','','','DEPT-2','DES-3','BRCH-1','','TL-234','INS->ADMIN->2022-01-14 03:00:11'),('28','69',NULL,'Gutierrez, Nadine Mickaela','Nadine Mickaela','','Gutierrez','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'ngutierrez@encorefinancials.com','','','DEPT-6','DES-12','BRCH-1','','TL-235','INS->ADMIN->2022-01-14 03:01:30'),('29','54',NULL,'Juanani, Alejandro','Alejandro','','Juanani','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'abjuanani@encorefinancials.com','','','DEPT-4','DES-8','BRCH-1','','TL-236','INS->ADMIN->2022-01-14 03:01:59'),('3','34',NULL,'Alejo, Jedd','Jedd','','Alejo','','1995-01-01','3','2021-10-01','2022-02-01',NULL,'Test','jbalejo@encorefinancials.com','','','DEPT-2','DES-4','BRCH-1','FEMALE','TL-216','UPD->ADMIN->2022-02-07 02:18:04'),('31','74',NULL,'Lopez, Marvic','Marvic','','Lopez','','0000-00-00','3','2021-10-01',NULL,NULL,NULL,'mclopez@encorefinancials.com','','','DEPT-5','DES-9','BRCH-1','','TL-237','INS->ADMIN->2022-01-14 03:02:50'),('32','40',NULL,'Pangilinan, Gidget','Gidget','','Pangilinan','','0000-00-00','3','2021-10-01',NULL,NULL,NULL,'gbpangilinan@encorefinancials.com','','','DEPT-5','DES-10','BRCH-2','','TL-238','INS->ADMIN->2022-01-14 03:03:31'),('33','3',NULL,'Punsalan, Lynn','Lynn','','Punsalan','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'ltpunsalan@encorefinancials.com','','','DEPT-5','DES-9','BRCH-2','','TL-239','INS->ADMIN->2022-01-14 03:04:02'),('35','33',NULL,'San Pedro, Nina Camille Corpuz','Nina Camille','Corpuz','San Pedro','','0000-00-00','3','2021-10-01',NULL,NULL,NULL,'ncsanpedro@encorefinancials.com','','','DEPT-6','DES-12','BRCH-1','','TL-240','INS->ADMIN->2022-01-14 03:05:15'),('36','20','KSVILLAR','Villar, Karla','Karla','','Villar','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'ksvillar@encorefinancials.com','','','DEPT-6','DES-12','BRCH-1','','TL-241','UPD->ADMIN->2022-02-09 02:32:18'),('37','84',NULL,'Cadiz, Ma. Kristine Santos','Ma. Kristine','Santos','Cadiz','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'mkcadiz@encorefinancials.com','','','DEPT-7','DES-16','BRCH-1','','TL-242','INS->ADMIN->2022-01-14 03:06:28'),('38','38',NULL,'Palo, Charlene Baltazar','Charlene','Baltazar','Palo','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'cbpalo@encorefinancials.com','','','DEPT-3','DES-6','BRCH-2','','TL-243','INS->ADMIN->2022-01-14 03:07:04'),('39','77',NULL,'Quimzon, Jerucel Cobarrubias','Jerucel','Cobarrubias','Quimzon','','0000-00-00','3','2021-10-01',NULL,NULL,NULL,'jcquimzon@encorefinancials.com','','','DEPT-5','DES-10','BRCH-1','','TL-244','INS->ADMIN->2022-01-14 03:07:42'),('4','50',NULL,'Puno, Bernadeth','Bernadeth','','Puno','','0000-00-00','3','2021-10-01',NULL,NULL,NULL,'bdpuno@encorefinancials.com','','','DEPT-3','DES-6','BRCH-1','','TL-217','INS->ADMIN->2022-01-14 02:40:04'),('40','76',NULL,'Mateo, Mariah Angelika Alfaro','Mariah Angelika','Alfaro','Mateo','','0000-00-00','3','2021-10-01',NULL,NULL,NULL,'mamateo@encorefinancials.com','','','DEPT-2','DES-4','BRCH-1','','TL-245','INS->ADMIN->2022-01-14 03:08:27'),('41','78',NULL,'Quiruben, Jessa Victorio','Jessa','Victorio','Quiruben','','0000-00-00','3','2021-10-01',NULL,NULL,NULL,'jvquiruben@encorefinancials.com','','','DEPT-4','DES-8','BRCH-1','','TL-246','INS->ADMIN->2022-01-14 03:09:00'),('42','79',NULL,'Yalung, James Yumul','James','Yumul','Yalung','','0000-00-00','2','2021-10-01',NULL,NULL,NULL,'jyyalung@encorefinancials.com','','','DEPT-4','DES-8','BRCH-2','','TL-247','INS->ADMIN->2022-01-14 03:10:45'),('43','80',NULL,'Lorenzo, Pamela Louie Blas','Pamela Louie','Blas','Lorenzo','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'pblorenzo@encorefinancials.com','','','DEPT-2','DES-4','BRCH-1','','TL-248','INS->ADMIN->2022-01-14 03:11:38'),('44','81',NULL,'Carreon, Fatine Pascua','Fatine','Pascua','Carreon','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'fcarreon@encorefinancials.com','','','DEPT-5','DES-10','BRCH-3','','TL-249','INS->ADMIN->2022-01-14 03:12:25'),('45','82',NULL,'Javier, Ron Joseph Monje','Ron Joseph','Monje','Javier','','0000-00-00','3','2021-10-01',NULL,NULL,NULL,'rmjavier@encorefinancials.com','','','DEPT-4','DES-8','BRCH-1','','TL-250','INS->ADMIN->2022-01-14 03:13:11'),('46','83',NULL,'Mesina, Honey Pearl Parungao','Honey Pearl','Parungao','Mesina','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'hpmesina@encorefinancials.com','','','DEPT-5','DES-10','BRCH-2','','TL-251','INS->ADMIN->2022-01-14 03:13:45'),('47','85',NULL,'Ibay, Rhodora Margaret Reyes','Rhodora Margaret','Reyes','Ibay','','0000-00-00','3','2021-10-01',NULL,NULL,NULL,'rribay@encorefinancials.com','','','DEPT-2','DES-3','BRCH-1','','TL-252','INS->ADMIN->2022-01-14 03:14:21'),('48','86',NULL,'Aguilar, Christopher','Christopher','','Aguilar','','1995-02-03','2','2021-10-01',NULL,NULL,'','caguilar@encorefinancials.com','','','DEPT-4','DES-8','BRCH-1','MALE','TL-253','UPD->LDAGULTO->2022-03-15 01:04:12'),('49','87',NULL,'Ronquillo, Crispina Sanchez','Crispina','Sanchez','Ronquillo','','0000-00-00','2','2021-10-01',NULL,NULL,NULL,'csronquillo@encorefinancials.com','','','DEPT-5','DES-10','BRCH-1','','TL-254','INS->ADMIN->2022-01-14 03:15:51'),('5','63',NULL,'Dela Cruz, Rellie Ann','Rellie Ann','','Dela Cruz','','0000-00-00','3','2021-10-01',NULL,NULL,NULL,'rsdelacruz@encorefinancials.co','','','DEPT-3','DES-6','BRCH-1','','TL-218','INS->ADMIN->2022-01-14 02:40:39'),('50','88',NULL,'Rivera, Annalyn Lacsina','Annalyn','Lacsina','Rivera','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'alrivera.ftcleasing@gmail.com','','','DEPT-2','DES-4','BRCH-1','','TL-255','INS->ADMIN->2022-01-14 03:16:32'),('51','89',NULL,'Amadora, Levy Patricio, Jr.','Levy','Patricio','Amadora','JR','2004-03-06','2','2021-10-01',NULL,'2022-03-02','','lpamadora@encorefinancials.com','','','DEPT-4','DES-8','BRCH-1','MALE','TL-256','UPD->LDAGULTO->2022-03-15 01:02:35'),('52','90',NULL,'Saulo, Pauline Marie Bañes','Pauline Marie','Bañes','Saulo','','0000-00-00','2','2021-11-24',NULL,NULL,NULL,'pbsaulo@encorefinancials.com','','','DEPT-3','DES-6','BRCH-1','','TL-257','INS->ADMIN->2022-01-14 03:17:51'),('53','91',NULL,'Lopez, Jeremiah Casanes','Jeremiah','Casanes','Lopez','','0000-00-00','2','2021-12-01',NULL,NULL,NULL,'jclopez@encorefinancials.com','','','DEPT-4','DES-8','BRCH-2','','TL-258','INS->ADMIN->2022-01-14 03:18:33'),('54','92',NULL,'De Guzman, Arvy Joyce Garcia','Arvy Joyce','Garcia','De Guzman','','0000-00-00','1','0000-00-00','0000-00-00','0000-00-00','','agdeguzman@encorefinancials.com','9303927230','','DEPT-1','DES-3','BRCH-1','MALE','TL-1115','UPD->LDAGULTO->2022-04-19 02:31:05'),('55','93',NULL,'Agustin, Johanna Mae Muncal','Johanna Mae','Muncal','Agustin','','0000-00-00','1','0000-00-00','0000-00-00','0000-00-00','','jmagustin@encorefinancials.com','9957560260','','DEPT-2','DES-4','BRCH-1','MALE','TL-1116','UPD->LDAGULTO->2022-04-19 02:31:05'),('6','70','LVMICAYAS','Micayas, Lemar Bill','Lemar Bill','','Micayas','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'lmicayas@encorefinancials.com','','','DEPT-1','DES-1','BRCH-1','','TL-219','UPD->ADMIN->2022-02-09 02:01:11'),('7','53','LDAGULTO','Agulto, Lawrence De Vera','Lawrence','De Vera','Agulto','','1995-08-03','1','2021-10-01',NULL,'2020-09-04','','ldagulto@encorefinancials.com','09614917005','','DEPT-1','DES-1','BRCH-1','MALE','TL-220','UPD->LDAGULTO->2022-03-15 01:31:19'),('8','15',NULL,'Lim, Sarah Jane','Sarah Jane','','Lim','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'sjmdejesus@encorefinancials.com','','','DEPT-3','DES-5','BRCH-1','','TL-221','UPD->ADMIN->2022-01-14 02:45:51'),('9','6',NULL,'Soniga, Mary Ann','Mary Ann','','Soniga','','0000-00-00','1','2021-10-01',NULL,NULL,NULL,'msoniga@encorefinancials.com','','','DEPT-4','DES-17','BRCH-1','','TL-222','INS->ADMIN->2022-01-14 02:47:05');
/*!40000 ALTER TABLE `tblemployee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemployeeaddress`
--

DROP TABLE IF EXISTS `tblemployeeaddress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblemployeeaddress` (
  `ADDRESS_ID` varchar(100) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `ADDRESS_TYPE` varchar(20) NOT NULL,
  `ADDRESS` varchar(200) DEFAULT NULL,
  `CITY` int(11) DEFAULT NULL,
  `PROVINCE` int(11) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ADDRESS_ID`),
  KEY `employee_address_index` (`ADDRESS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemployeeaddress`
--

LOCK TABLES `tblemployeeaddress` WRITE;
/*!40000 ALTER TABLE `tblemployeeaddress` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemployeeaddress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemployeefile`
--

DROP TABLE IF EXISTS `tblemployeefile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblemployeefile` (
  `FILE_ID` varchar(50) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `FILE_NAME` varchar(100) NOT NULL,
  `FILE_CATEGORY` varchar(50) NOT NULL,
  `REMARKS` varchar(100) NOT NULL,
  `FILE_DATE` date NOT NULL,
  `UPLOAD_DATE` date NOT NULL,
  `UPLOAD_TIME` time NOT NULL,
  `UPLOAD_BY` varchar(50) NOT NULL,
  `FILE_PATH` varchar(500) NOT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`FILE_ID`),
  KEY `employee_file_index` (`FILE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemployeefile`
--

LOCK TABLES `tblemployeefile` WRITE;
/*!40000 ALTER TABLE `tblemployeefile` DISABLE KEYS */;
INSERT INTO `tblemployeefile` VALUES ('1','7','Test','COMMENDATION','Terst','2022-02-02','2022-02-10','13:30:05','LDAGULTO','./employee_file/b9tiyzwlgi.pdf','TL-494','UPD->LDAGULTO->2022-03-15 01:31:10');
/*!40000 ALTER TABLE `tblemployeefile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemployeesocial`
--

DROP TABLE IF EXISTS `tblemployeesocial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblemployeesocial` (
  `SOCIAL_ID` varchar(100) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `SOCIAL_TYPE` varchar(20) NOT NULL,
  `LINK` varchar(300) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`SOCIAL_ID`),
  KEY `employee_social_index` (`SOCIAL_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemployeesocial`
--

LOCK TABLES `tblemployeesocial` WRITE;
/*!40000 ALTER TABLE `tblemployeesocial` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemployeesocial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemployeeworkshift`
--

DROP TABLE IF EXISTS `tblemployeeworkshift`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblemployeeworkshift` (
  `WORK_SHIFT_ID` varchar(100) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemployeeworkshift`
--

LOCK TABLES `tblemployeeworkshift` WRITE;
/*!40000 ALTER TABLE `tblemployeeworkshift` DISABLE KEYS */;
INSERT INTO `tblemployeeworkshift` VALUES ('6','48','INS->LDAGULTO->2022-04-15 09:59:36'),('7','7','INS->LDAGULTO->2022-04-15 09:59:40');
/*!40000 ALTER TABLE `tblemployeeworkshift` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemploymentstatus`
--

DROP TABLE IF EXISTS `tblemploymentstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblemploymentstatus` (
  `EMPLOYMENT_STATUS_ID` varchar(50) DEFAULT NULL,
  `EMPLOYMENT_STATUS` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(200) NOT NULL,
  `COLOR_VALUE` varchar(20) NOT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  KEY `employment_status_index` (`EMPLOYMENT_STATUS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemploymentstatus`
--

LOCK TABLES `tblemploymentstatus` WRITE;
/*!40000 ALTER TABLE `tblemploymentstatus` DISABLE KEYS */;
INSERT INTO `tblemploymentstatus` VALUES ('1','Permanent','Employees that are regular/permanent.','success','TL-211','INS->ADMIN->2022-01-12 04:34:35'),('2','Probation','Employees that are under probationary.','info','TL-212','UPD->ADMIN->2022-01-14 02:55:52'),('3','Resigned','Employees that are resigned.','warning','TL-213','UPD->ADMIN->2022-01-14 02:55:55'),('4','Terminated','Employees that are terminated.','danger','TL-214','INS->ADMIN->2022-01-12 04:35:36'),('5','Suspended','Employees that are suspended.','dark','TL-265','INS->ADMIN->2022-01-16 03:03:23');
/*!40000 ALTER TABLE `tblemploymentstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblgovernmentcontribution`
--

DROP TABLE IF EXISTS `tblgovernmentcontribution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblgovernmentcontribution` (
  `GOVERNMENT_CONTRIBUTION_ID` varchar(100) NOT NULL,
  `GOVERNMENT_CONTRIBUTION` varchar(50) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`GOVERNMENT_CONTRIBUTION_ID`),
  KEY `government_contribution_index` (`GOVERNMENT_CONTRIBUTION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblgovernmentcontribution`
--

LOCK TABLES `tblgovernmentcontribution` WRITE;
/*!40000 ALTER TABLE `tblgovernmentcontribution` DISABLE KEYS */;
INSERT INTO `tblgovernmentcontribution` VALUES ('4','SSS','Contribution for SSS.','TL-1061','UPD->LDAGULTO->2022-04-13 09:57:11'),('5','Philhealth','Contribution for Philhealth.','TL-1082','INS->LDAGULTO->2022-04-13 11:45:46');
/*!40000 ALTER TABLE `tblgovernmentcontribution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblhealthdeclaration`
--

DROP TABLE IF EXISTS `tblhealthdeclaration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblhealthdeclaration` (
  `DECLARATION_ID` varchar(50) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `TEMPERATURE` double NOT NULL,
  `QUESTION_1` int(11) DEFAULT NULL,
  `QUESTION_2` int(11) DEFAULT NULL,
  `QUESTION_3` int(11) DEFAULT NULL,
  `QUESTION_4` int(11) DEFAULT NULL,
  `QUESTION_5` int(11) DEFAULT NULL,
  `QUESTION_5_SPECIFIC` varchar(100) DEFAULT NULL,
  `SUBMIT_DATE` date NOT NULL,
  `SUBMIT_TIME` time NOT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`DECLARATION_ID`),
  KEY `health_declaration_index` (`DECLARATION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblhealthdeclaration`
--

LOCK TABLES `tblhealthdeclaration` WRITE;
/*!40000 ALTER TABLE `tblhealthdeclaration` DISABLE KEYS */;
INSERT INTO `tblhealthdeclaration` VALUES ('1','7',36.5,0,0,0,0,0,'0','2022-02-21','14:15:46','TL-538','INS->LDAGULTO->2022-02-21 02:15:46');
/*!40000 ALTER TABLE `tblhealthdeclaration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblholiday`
--

DROP TABLE IF EXISTS `tblholiday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblholiday` (
  `HOLIDAY_ID` varchar(50) NOT NULL,
  `HOLIDAY` varchar(200) NOT NULL,
  `HOLIDAY_DATE` date NOT NULL,
  `HOLIDAY_TYPE` varchar(20) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`HOLIDAY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblholiday`
--

LOCK TABLES `tblholiday` WRITE;
/*!40000 ALTER TABLE `tblholiday` DISABLE KEYS */;
INSERT INTO `tblholiday` VALUES ('HOL-9','test','2022-02-04','REGHOL','TL-510','INS->LDAGULTO->2022-02-10 04:58:33');
/*!40000 ALTER TABLE `tblholiday` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblholidaybranch`
--

DROP TABLE IF EXISTS `tblholidaybranch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblholidaybranch` (
  `HOLIDAY_ID` varchar(50) NOT NULL,
  `BRANCH_ID` varchar(50) NOT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblholidaybranch`
--

LOCK TABLES `tblholidaybranch` WRITE;
/*!40000 ALTER TABLE `tblholidaybranch` DISABLE KEYS */;
INSERT INTO `tblholidaybranch` VALUES ('HOL-9','BRCH-1','INS->LDAGULTO->2022-02-10 04:58:34'),('HOL-9','BRCH-2','INS->LDAGULTO->2022-02-10 04:58:34'),('HOL-9','BRCH-3','INS->LDAGULTO->2022-02-10 04:58:34');
/*!40000 ALTER TABLE `tblholidaybranch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblleave`
--

DROP TABLE IF EXISTS `tblleave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblleave` (
  `LEAVE_ID` varchar(50) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `LEAVE_TYPE` varchar(50) NOT NULL,
  `LEAVE_DATE` date NOT NULL,
  `START_TIME` time DEFAULT NULL,
  `END_TIME` time DEFAULT NULL,
  `LEAVE_STATUS` varchar(10) DEFAULT NULL,
  `LEAVE_REASON` varchar(500) DEFAULT NULL,
  `FILE_PATH` varchar(500) DEFAULT NULL,
  `DECISION_REMARKS` varchar(500) DEFAULT NULL,
  `DECISION_DATE` date DEFAULT NULL,
  `DECISION_TIME` time DEFAULT NULL,
  `DECISION_BY` varchar(50) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`LEAVE_ID`),
  KEY `leave_index` (`LEAVE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblleave`
--

LOCK TABLES `tblleave` WRITE;
/*!40000 ALTER TABLE `tblleave` DISABLE KEYS */;
INSERT INTO `tblleave` VALUES ('LV-1','7','LEAVETP-5','2022-02-02','08:30:00','17:30:00','APV','Test',NULL,'','2022-02-02','10:33:08','ADMIN','TL-417','APV->ADMIN->2022-02-02 10:33:08'),('LV-13','7','LEAVETP-5','2022-02-01','08:30:00','17:30:00','PEN','Test',NULL,NULL,NULL,NULL,NULL,'TL-516','INS->LDAGULTO->2022-02-11 11:28:52'),('LV-14','7','LEAVETP-5','2022-02-03','08:30:00','17:30:00','PEN','Test',NULL,NULL,NULL,NULL,NULL,'TL-517','INS->LDAGULTO->2022-02-11 11:28:52'),('LV-15','7','LEAVETP-5','2022-02-04','08:30:00','17:30:00','PEN','Test',NULL,NULL,NULL,NULL,NULL,'TL-518','INS->LDAGULTO->2022-02-11 11:28:52'),('LV-16','7','LEAVETP-5','2022-02-02','08:30:00','17:30:00','PEN','Test',NULL,NULL,NULL,NULL,NULL,'TL-519','INS->LDAGULTO->2022-02-11 11:28:53'),('LV-17','7','LEAVETP-5','2022-03-03','08:30:00','17:30:00','APV','te',NULL,'Test','2022-03-15','14:43:07','LDAGULTO','TL-600','APV->LDAGULTO->2022-03-15 02:43:07'),('LV-18','7','LEAVETP-5','2022-03-10','12:00:00','17:30:00','APV','Test',NULL,'Test','2022-03-15','17:29:19','LDAGULTO','TL-603','APV->LDAGULTO->2022-03-15 05:29:19'),('LV-19','7','LEAVETP-5','2022-03-03','14:23:00','14:23:00','REJ','Test',NULL,'Test','2022-03-15','17:30:21','LDAGULTO','TL-604','REJ->LDAGULTO->2022-03-15 05:30:21'),('LV-2','7','LEAVETP-5','2022-02-02','08:30:00','17:30:00','APV','Test',NULL,'','2022-02-02','10:24:43','ADMIN','TL-418','APV->ADMIN->2022-02-02 10:24:43'),('LV-20','7','LEAVETP-5','2022-03-18','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-15','17:30:12','LDAGULTO','TL-605','CAN->LDAGULTO->2022-03-15 05:30:12'),('LV-21','7','LEAVETP-5','2022-03-07','08:30:00','17:30:00','APV','Test',NULL,'','2022-03-15','17:31:40','LDAGULTO','TL-606','APV->LDAGULTO->2022-03-15 05:31:40'),('LV-22','7','LEAVETP-5','2022-03-08','08:30:00','17:30:00','APV','Test',NULL,'','2022-03-15','17:31:40','LDAGULTO','TL-607','APV->LDAGULTO->2022-03-15 05:31:40'),('LV-23','7','LEAVETP-5','2022-03-09','08:30:00','17:30:00','APV','Test',NULL,'','2022-03-15','17:31:40','LDAGULTO','TL-608','APV->LDAGULTO->2022-03-15 05:31:40'),('LV-24','7','LEAVETP-5','2022-03-10','08:30:00','17:30:00','REJ','Test',NULL,'Test','2022-03-15','17:31:50','LDAGULTO','TL-609','REJ->LDAGULTO->2022-03-15 05:31:50'),('LV-25','7','LEAVETP-5','2022-03-11','08:30:00','17:30:00','APV','Test',NULL,'','2022-03-15','17:31:40','LDAGULTO','TL-610','APV->LDAGULTO->2022-03-15 05:31:40'),('LV-26','7','LEAVETP-5','2022-03-21','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-16','11:21:37','LDAGULTO','TL-611','CAN->LDAGULTO->2022-03-16 11:21:37'),('LV-27','7','LEAVETP-5','2022-03-22','08:30:00','17:30:00','APV','Test',NULL,'','2022-03-16','09:54:18','LDAGULTO','TL-612','APV->LDAGULTO->2022-03-16 09:54:18'),('LV-28','7','LEAVETP-5','2022-03-23','08:30:00','17:30:00','REJ','Test',NULL,'Test','2022-03-16','09:55:50','LDAGULTO','TL-613','REJ->LDAGULTO->2022-03-16 09:55:50'),('LV-29','7','LEAVETP-5','2022-03-24','08:30:00','17:30:00','REJ','Test',NULL,'Test','2022-03-16','09:55:51','LDAGULTO','TL-614','REJ->LDAGULTO->2022-03-16 09:55:51'),('LV-30','7','LEAVETP-5','2022-03-25','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-16','09:55:58','LDAGULTO','TL-615','CAN->LDAGULTO->2022-03-16 09:55:58'),('LV-31','7','LEAVETP-5','2022-03-03','08:30:00','17:30:00','CAN','Test',NULL,'Tre','2022-03-16','10:08:33','LDAGULTO','TL-616','CAN->LDAGULTO->2022-03-16 10:08:33'),('LV-32','7','LEAVETP-5','2022-03-03','08:30:00','17:30:00','REJ','Test',NULL,'Rejected','2022-03-16','10:08:39','LDAGULTO','TL-617','REJ->LDAGULTO->2022-03-16 10:08:39'),('LV-33','7','LEAVETP-5','2022-03-10','08:30:00','17:30:00','APV','TEST',NULL,NULL,'2022-03-16','10:52:46','LDAGULTO','TL-618','INS->LDAGULTO->2022-03-16 10:52:46'),('LV-34','7','LEAVETP-5','2022-03-28','08:30:00','17:30:00','APV','Test',NULL,'Test','2022-03-16','11:30:12','LDAGULTO','TL-625','APV->LDAGULTO->2022-03-16 11:30:12'),('LV-35','7','LEAVETP-5','2022-03-29','08:30:00','17:30:00','REJ','Test',NULL,'Test','2022-03-16','11:30:15','LDAGULTO','TL-626','REJ->LDAGULTO->2022-03-16 11:30:15'),('LV-36','7','LEAVETP-5','2022-03-30','08:30:00','17:30:00','REJ','Test',NULL,'Test','2022-03-16','11:30:21','LDAGULTO','TL-627','REJ->LDAGULTO->2022-03-16 11:30:21'),('LV-37','7','LEAVETP-5','2022-03-31','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-16','11:30:24','LDAGULTO','TL-628','CAN->LDAGULTO->2022-03-16 11:30:24'),('LV-38','7','LEAVETP-5','2022-03-04','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-28','13:16:55','LDAGULTO','TL-637','CAN->LDAGULTO->2022-03-28 01:16:55'),('LV-39','7','LEAVETP-5','2022-03-11','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-25','14:09:09','LDAGULTO','TL-738','CAN->LDAGULTO->2022-03-25 02:09:09'),('LV-4','7','LEAVETP-5','2022-02-08','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-02-02','11:07:18','ADMIN','TL-428','CAN->ADMIN->2022-02-02 11:07:18'),('LV-40','7','LEAVETP-5','2022-03-14','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-28','13:17:03','LDAGULTO','TL-740','CAN->LDAGULTO->2022-03-28 01:17:03'),('LV-41','7','LEAVETP-5','2022-03-16','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-28','13:16:58','LDAGULTO','TL-741','CAN->LDAGULTO->2022-03-28 01:16:58'),('LV-42','7','LEAVETP-5','2022-03-15','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-28','13:17:00','LDAGULTO','TL-742','CAN->LDAGULTO->2022-03-28 01:17:00'),('LV-43','7','LEAVETP-5','2022-03-14','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-28','13:17:06','LDAGULTO','TL-743','CAN->LDAGULTO->2022-03-28 01:17:06'),('LV-44','7','LEAVETP-5','2022-03-16','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-28','13:17:09','LDAGULTO','TL-744','CAN->LDAGULTO->2022-03-28 01:17:09'),('LV-45','7','LEAVETP-5','2022-03-15','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-28','13:17:11','LDAGULTO','TL-745','CAN->LDAGULTO->2022-03-28 01:17:11'),('LV-46','7','LEAVETP-5','2022-03-14','08:30:00','17:30:00','REJ','Test','./leave_attachment/vfview0xtn.pdf','Test','2022-03-28','13:18:55','LDAGULTO','TL-746','REJ->LDAGULTO->2022-03-28 01:18:55'),('LV-47','7','LEAVETP-5','2022-03-15','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-28','13:18:44','LDAGULTO','TL-747','CAN->LDAGULTO->2022-03-28 01:18:44'),('LV-48','7','LEAVETP-5','2022-03-14','08:30:00','17:30:00','CAN','Test','./leave_attachment/7snvc1yxh2.pdf','Test','2022-03-28','13:18:47','LDAGULTO','TL-748','CAN->LDAGULTO->2022-03-28 01:18:47'),('LV-49','7','LEAVETP-5','2022-03-15','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-28','13:18:50','LDAGULTO','TL-749','CAN->LDAGULTO->2022-03-28 01:18:50'),('LV-5','7','LEAVETP-5','2022-02-09','08:30:00','17:30:00','REJ','Test',NULL,'Test','2022-02-02','11:07:09','ADMIN','TL-429','REJ->ADMIN->2022-02-02 11:07:09'),('LV-50','7','LEAVETP-5','2022-03-07','08:30:00','17:30:00','APV','Test','./leave_attachment/krhpe1g2oa.pdf','','2022-03-30','10:58:18','LDAGULTO','TL-750','APV->LDAGULTO->2022-03-30 10:58:18'),('LV-51','7','LEAVETP-5','2022-03-08','08:30:00','17:30:00','APV','Test',NULL,'','2022-03-30','10:58:19','LDAGULTO','TL-751','APV->LDAGULTO->2022-03-30 10:58:19'),('LV-52','7','LEAVETP-5','2022-03-07','08:30:00','17:30:00','REJ','Test','./leave_attachment/pbvi1p9kaj.pdf','Test','2022-03-30','10:58:39','LDAGULTO','TL-752','REJ->LDAGULTO->2022-03-30 10:58:39'),('LV-53','7','LEAVETP-5','2022-03-08','08:30:00','17:30:00','REJ','Test',NULL,'Test','2022-03-30','10:58:40','LDAGULTO','TL-753','REJ->LDAGULTO->2022-03-30 10:58:40'),('LV-54','7','LEAVETP-5','2022-03-07','08:30:00','17:30:00','CAN','Test','./leave_attachment/6thszzytl7.pdf','Test','2022-03-30','10:59:38','LDAGULTO','TL-754','CAN->LDAGULTO->2022-03-30 10:59:38'),('LV-55','7','LEAVETP-5','2022-03-08','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-30','10:59:38','LDAGULTO','TL-755','CAN->LDAGULTO->2022-03-30 10:59:38'),('LV-56','7','LEAVETP-5','2022-03-07','08:30:00','17:30:00','CAN','Test','./leave_attachment/y9nghs3fbm.pdf','Test','2022-03-30','11:06:14','LDAGULTO','TL-756','CAN->LDAGULTO->2022-03-30 11:06:14'),('LV-57','7','LEAVETP-5','2022-03-08','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-30','11:06:14','LDAGULTO','TL-757','CAN->LDAGULTO->2022-03-30 11:06:14'),('LV-58','7','LEAVETP-5','2022-03-07','08:30:00','17:30:00','CAN','Test','./leave_attachment/huhphri5pi.pdf','Test','2022-03-30','11:06:15','LDAGULTO','TL-758','CAN->LDAGULTO->2022-03-30 11:06:15'),('LV-59','7','LEAVETP-5','2022-03-08','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-30','11:06:15','LDAGULTO','TL-759','CAN->LDAGULTO->2022-03-30 11:06:15'),('LV-60','7','LEAVETP-5','2022-03-14','08:30:00','17:30:00','CAN','Test','./leave_attachment/o5hwedb2zj.pdf','Test','2022-03-30','11:06:15','LDAGULTO','TL-760','CAN->LDAGULTO->2022-03-30 11:06:15'),('LV-61','7','LEAVETP-5','2022-03-15','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-30','11:06:15','LDAGULTO','TL-761','CAN->LDAGULTO->2022-03-30 11:06:15'),('LV-62','7','LEAVETP-5','2022-03-14','08:30:00','17:30:00','CAN','Test','./leave_attachment/jg537xyek3.pdf','Test','2022-03-30','11:06:16','LDAGULTO','TL-762','CAN->LDAGULTO->2022-03-30 11:06:16'),('LV-63','7','LEAVETP-5','2022-03-15','08:30:00','17:30:00','CAN','Test','./leave_attachment/wl8w6wdiu0.pdf','Test','2022-03-30','11:06:16','LDAGULTO','TL-763','CAN->LDAGULTO->2022-03-30 11:06:16'),('LV-64','7','LEAVETP-5','2022-03-16','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-30','11:06:16','LDAGULTO','TL-764','CAN->LDAGULTO->2022-03-30 11:06:16'),('LV-65','7','LEAVETP-5','2022-03-15','08:30:00','17:30:00','CAN','Test','./leave_attachment/d99sqykuri.pdf','Test','2022-03-30','11:06:16','LDAGULTO','TL-765','CAN->LDAGULTO->2022-03-30 11:06:16'),('LV-66','7','LEAVETP-5','2022-03-16','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-30','13:28:50','LDAGULTO','TL-766','CAN->LDAGULTO->2022-03-30 01:28:50'),('LV-67','7','LEAVETP-5','2022-03-01','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-30','13:28:50','LDAGULTO','TL-767','CAN->LDAGULTO->2022-03-30 01:28:50'),('LV-68','7','LEAVETP-5','2022-03-04','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-30','13:28:50','LDAGULTO','TL-768','CAN->LDAGULTO->2022-03-30 01:28:50'),('LV-69','7','LEAVETP-5','2022-03-02','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-30','13:28:50','LDAGULTO','TL-769','CAN->LDAGULTO->2022-03-30 01:28:50'),('LV-70','7','LEAVETP-5','2022-03-03','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-30','13:28:50','LDAGULTO','TL-770','CAN->LDAGULTO->2022-03-30 01:28:50'),('LV-71','7','LEAVETP-5','2022-03-31','08:30:00','17:30:00','APV','Test',NULL,'','2022-03-30','16:23:00','LDAGULTO','TL-771','APV->LDAGULTO->2022-03-30 04:23:00'),('LV-72','7','LEAVETP-5','2022-03-07','08:30:00','17:30:00','REJ','Test',NULL,'TesTest','2022-03-30','16:24:38','LDAGULTO','TL-774','REJ->LDAGULTO->2022-03-30 04:24:38'),('LV-73','7','LEAVETP-5','2022-03-07','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-30','16:24:42','LDAGULTO','TL-775','CAN->LDAGULTO->2022-03-30 04:24:42'),('LV-74','7','LEAVETP-5','2022-04-04','08:30:00','17:30:00','APV','Test',NULL,'Test','2022-03-30','17:12:31','LDAGULTO','TL-788','APV->LDAGULTO->2022-03-30 05:12:31'),('LV-75','7','LEAVETP-5','2022-04-05','08:30:00','17:30:00','REJ','Test',NULL,'Test','2022-03-30','17:12:39','LDAGULTO','TL-789','REJ->LDAGULTO->2022-03-30 05:12:39'),('LV-76','7','LEAVETP-5','2022-04-06','08:30:00','17:30:00','CAN','Test',NULL,'Test','2022-03-30','17:12:45','LDAGULTO','TL-790','CAN->LDAGULTO->2022-03-30 05:12:45');
/*!40000 ALTER TABLE `tblleave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblleaveentitlement`
--

DROP TABLE IF EXISTS `tblleaveentitlement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblleaveentitlement` (
  `LEAVE_ENTITLEMENT_ID` varchar(50) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `LEAVE_TYPE` varchar(50) NOT NULL,
  `NO_LEAVES` int(11) DEFAULT NULL,
  `ACQUIRED_LEAVES` double DEFAULT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date NOT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`LEAVE_ENTITLEMENT_ID`),
  KEY `leave_entitlement_index` (`LEAVE_ENTITLEMENT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblleaveentitlement`
--

LOCK TABLES `tblleaveentitlement` WRITE;
/*!40000 ALTER TABLE `tblleaveentitlement` DISABLE KEYS */;
INSERT INTO `tblleaveentitlement` VALUES ('LVENT-1','7','LEAVETP-5',50,7.388888888888889,'2022-01-01','2022-12-31','TL-416','UPD->LDAGULTO->2022-03-30 05:12:45');
/*!40000 ALTER TABLE `tblleaveentitlement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblleavetype`
--

DROP TABLE IF EXISTS `tblleavetype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblleavetype` (
  `LEAVE_TYPE_ID` varchar(50) NOT NULL,
  `LEAVE_NAME` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(200) NOT NULL,
  `NO_LEAVES` double DEFAULT NULL,
  `PAID_STATUS` varchar(20) NOT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`LEAVE_TYPE_ID`),
  KEY `leave_type_index` (`LEAVE_TYPE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblleavetype`
--

LOCK TABLES `tblleavetype` WRITE;
/*!40000 ALTER TABLE `tblleavetype` DISABLE KEYS */;
INSERT INTO `tblleavetype` VALUES ('LEAVETP-1','Vacation Leave','A leave of absence with pay for the purpose of rest, relaxation, or personal business at the request of the employee.',5,'PAID','TL-351','INS->ADMIN->2022-01-27 11:58:59'),('LEAVETP-2','Sick Leave','A paid time off from work that employees can use to stay home to address their health needs without losing pay.',5,'PAID','TL-352','INS->ADMIN->2022-01-27 12:00:15'),('LEAVETP-3','Leave w/o Pay','To be absent from duty with the employer\'s permission but without pay.',365,'UNPAID','TL-353','INS->ADMIN->2022-01-27 12:40:47'),('LEAVETP-4','Special Non-Working Holiday','Days that are given as leave by the government.',365,'UNPAID','TL-354','UPD->ADMIN->2022-01-27 01:08:25'),('LEAVETP-5','Emergency Leave','An employee\'s absence from work is not planned because of serious external causes.',365,'UNPAID','TL-355','INS->ADMIN->2022-01-27 12:51:56'),('LEAVETP-6','Maternity Leave','Refers to the period of time when a mother stops working following the birth of a child.',105,'UNPAID','TL-356','INS->ADMIN->2022-01-27 12:53:25'),('LEAVETP-7','Paternity Leave','A leave of absence from a job for a father to care for a new baby,',7,'PAID','TL-357','INS->ADMIN->2022-01-27 12:56:38'),('LEAVETP-8','Official Business (Paid)','Authorized business of the department.',365,'PAID','TL-358','INS->ADMIN->2022-01-27 01:09:47'),('LEAVETP-9','Official Business (Unpaid)','Authorized business of the department.',365,'UNPAID','TL-359','INS->ADMIN->2022-01-27 01:10:03');
/*!40000 ALTER TABLE `tblleavetype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbllocation`
--

DROP TABLE IF EXISTS `tbllocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbllocation` (
  `LOCATION_ID` varchar(50) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `POSITION` varchar(100) DEFAULT NULL,
  `LOG_DATE` date NOT NULL,
  `LOG_TIME` time NOT NULL,
  `REMARKS` varchar(500) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`LOCATION_ID`),
  KEY `location_index` (`LOCATION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbllocation`
--

LOCK TABLES `tbllocation` WRITE;
/*!40000 ALTER TABLE `tbllocation` DISABLE KEYS */;
INSERT INTO `tbllocation` VALUES ('1','7','120.9761487, 15.4735062','2022-02-22','10:29:10','','TL-543','INS->LDAGULTO->2022-02-22 10:29:10');
/*!40000 ALTER TABLE `tbllocation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblmailconfig`
--

DROP TABLE IF EXISTS `tblmailconfig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblmailconfig` (
  `MAIL_ID` int(11) NOT NULL,
  `MAIL_HOST` varchar(100) NOT NULL,
  `PORT` int(11) NOT NULL,
  `SMTP_AUTH` int(1) NOT NULL,
  `SMTP_AUTO_TLS` int(1) NOT NULL,
  `USERNAME` varchar(200) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `MAIL_ENCRYPTION` varchar(20) DEFAULT NULL,
  `MAIL_FROM_NAME` varchar(200) DEFAULT NULL,
  `MAIL_FROM_EMAIL` varchar(200) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`MAIL_ID`),
  KEY `mail_config_index` (`MAIL_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblmailconfig`
--

LOCK TABLES `tblmailconfig` WRITE;
/*!40000 ALTER TABLE `tblmailconfig` DISABLE KEYS */;
INSERT INTO `tblmailconfig` VALUES (1,'mail.encorefinancials.com',26,1,0,'encore-noreply@encorefinancials.com','4288c70b3967d16556906334','None','Encore Notification','encore-noreply@encorefinancials.com','TL-90','UPD->LDAGULTO->2022-02-22 02:32:26');
/*!40000 ALTER TABLE `tblmailconfig` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblnotification`
--

DROP TABLE IF EXISTS `tblnotification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblnotification` (
  `NOTIFICATION_ID` int(11) NOT NULL,
  `NOTIFICATION_FROM` varchar(100) DEFAULT NULL,
  `NOTIFICATION_TO` varchar(100) DEFAULT NULL,
  `STATUS` int(1) DEFAULT NULL,
  `NOTIFICATION_TITLE` varchar(200) DEFAULT NULL,
  `NOTIFICATION` varchar(1000) DEFAULT NULL,
  `LINK` varchar(500) DEFAULT NULL,
  `NOTIFICATION_DATE` date DEFAULT NULL,
  `NOTIFICATION_TIME` time DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`NOTIFICATION_ID`),
  KEY `notification_index` (`NOTIFICATION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblnotification`
--

LOCK TABLES `tblnotification` WRITE;
/*!40000 ALTER TABLE `tblnotification` DISABLE KEYS */;
INSERT INTO `tblnotification` VALUES (1,'','7',0,'Time In Notification','You time in on February 24, 2022 12:00 am.','employee-attendance-record.php','2022-02-24','09:56:34','INS->->2022-02-24 09:56:34'),(2,'','7',0,'Time In Notification','You time in on February 24, 2022 12:00 am.','employee-attendance-record.php','2022-02-24','10:07:24','INS->LDAGULTO->2022-02-24 10:07:24'),(3,'','7',0,'Time In Notification','You time in on February 24, 2022 12:00 am.','employee-attendance-record.php','2022-02-24','10:36:20','INS->LDAGULTO->2022-02-24 10:36:20'),(4,'','7',0,'Time Out Notification','You time out on February 24, 2022 10:36 am.','employee-attendance-record.php','2022-02-24','10:36:24','INS->LDAGULTO->2022-02-24 10:36:24'),(5,'','7',0,'Time In Notification','You time in on February 24, 2022 12:00 am.','employee-attendance-record.php','2022-02-24','10:39:47','INS->LDAGULTO->2022-02-24 10:39:47'),(6,'','7',0,'Time Out Notification','You time out on February 24, 2022 at 10:50 am.','employee-attendance-record.php','2022-02-24','10:50:28','INS->LDAGULTO->2022-02-24 10:50:28'),(7,'','7',0,'Time In Notification','You time in on February 24, 2022 at 12:00 am.','employee-attendance-record.php','2022-02-24','10:51:01','INS->LDAGULTO->2022-02-24 10:51:01'),(8,'','7',0,'Time Out Notification','You time out on February 24, 2022 at 10:52 am.','employee-attendance-record.php','2022-02-24','10:52:33','INS->LDAGULTO->2022-02-24 10:52:33'),(9,'','7',0,'Time In Notification','You time in on February 24, 2022 at 12:00 am.','employee-attendance-record.php','2022-02-24','10:56:41','INS->LDAGULTO->2022-02-24 10:56:41'),(10,'','7',0,'Time Out Notification','You time out on February 24, 2022 at 10:56 am.','employee-attendance-record.php','2022-02-24','10:56:45','INS->LDAGULTO->2022-02-24 10:56:45'),(11,'','7',0,'Time In Notification','You time in on February 24, 2022 at 12:00 am.','employee-attendance-record.php','2022-02-24','11:36:32','INS->LDAGULTO->2022-02-24 11:36:32'),(12,'','7',0,'Time Out Notification','You time out on February 24, 2022 at 11:36 am.','employee-attendance-record.php','2022-02-24','11:36:59','INS->LDAGULTO->2022-02-24 11:36:59'),(13,'','7',0,'Time In Notification','You time in on February 24, 2022 at 12:00 am.','employee-attendance-record.php','2022-02-24','13:13:56','INS->LDAGULTO->2022-02-24 01:13:56'),(14,'','7',0,'Time Out Notification','You time out on February 24, 2022 at 01:14 pm.','employee-attendance-record.php','2022-02-24','13:14:38','INS->LDAGULTO->2022-02-24 01:14:38'),(15,'','7',0,'Time In Notification','You time in on February 24, 2022 at 12:00 am.','employee-attendance-record.php','2022-02-24','14:16:02','INS->LDAGULTO->2022-02-24 02:16:02'),(16,'','7',0,'Time Out Notification','You time out on February 24, 2022 at 02:16 pm.','employee-attendance-record.php','2022-02-24','14:16:22','INS->LDAGULTO->2022-02-24 02:16:22'),(17,'','7',0,'Time In Notification','You time in on March 10, 2022 at 02:09 pm.',NULL,'2022-03-10','14:09:13','INS->LDAGULTO->2022-03-10 02:09:13'),(18,'','7',0,'Time Out Notification','You time out on March 10, 2022 at 02:11 pm.',NULL,'2022-03-10','14:11:11','INS->LDAGULTO->2022-03-10 02:11:11'),(19,'','48',0,'Time In Notification','You time in on March 10, 2022 at 02:11 pm.',NULL,'2022-03-10','14:11:46','INS->LDAGULTO->2022-03-10 02:11:46'),(20,'','48',0,'Time Out Notification','You time out on March 10, 2022 at 02:13 pm.',NULL,'2022-03-10','14:13:09','INS->LDAGULTO->2022-03-10 02:13:09'),(21,'','7',0,'Time Out Notification','You time out on March 11, 2022 at 01:13 pm.',NULL,'2022-03-11','13:13:02','INS->LDAGULTO->2022-03-11 01:13:02'),(22,'','7',0,'Time In Notification','You time in on March 11, 2022 at 01:14 pm.',NULL,'2022-03-11','13:14:15','INS->LDAGULTO->2022-03-11 01:14:15'),(23,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from .','attendance-creation-recommendation.php','2022-03-18','11:25:16','INS->LDAGULTO->2022-03-18 11:25:16'),(24,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-18','11:26:15','INS->LDAGULTO->2022-03-18 11:26:15'),(25,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-18','11:28:22','INS->LDAGULTO->2022-03-18 11:28:22'),(26,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-adjustment-recommendation.php','2022-03-18','11:43:08','INS->LDAGULTO->2022-03-18 11:43:08'),(27,'7','7',0,'Attendance Adjustment For Recommendation Notification','There is an attendance adjustment for recommendation coming from Agulto, Lawrence De Vera.','attendance-adjustment-recommendation.php','2022-03-18','11:44:22','INS->LDAGULTO->2022-03-18 11:44:22'),(28,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-18','14:22:57','INS->LDAGULTO->2022-03-18 02:22:57'),(29,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-18','14:22:58','INS->LDAGULTO->2022-03-18 02:22:58'),(30,NULL,'7',0,'Attendance Creation Recommendation','Your attendance recommendation was recommended by .','attendance-creation.php','2022-03-18','14:49:50','INS->LDAGULTO->2022-03-18 02:49:50'),(31,'LDAGULTO','7',0,'Attendance Creation Recommendation','Your attendance recommendation was recommended by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-18','14:50:55','INS->LDAGULTO->2022-03-18 02:50:55'),(32,NULL,NULL,0,'Attendance Adjustment Recommendation','Your attendance recommendation was recommended by .','attendance-adjustment.php','2022-03-18','15:58:08','INS->LDAGULTO->2022-03-18 03:58:08'),(33,NULL,NULL,0,'Attendance Adjustment Recommendation','Your attendance recommendation was recommended by .','attendance-adjustment.php','2022-03-18','15:59:03','INS->LDAGULTO->2022-03-18 03:59:03'),(34,NULL,NULL,0,'Attendance Adjustment Recommendation','Your attendance recommendation was recommended by .','attendance-adjustment.php','2022-03-18','15:59:50','INS->LDAGULTO->2022-03-18 03:59:50'),(35,NULL,NULL,0,'Attendance Adjustment Recommendation','Your attendance recommendation was recommended by .','attendance-adjustment.php','2022-03-18','16:01:38','INS->LDAGULTO->2022-03-18 04:01:38'),(36,'LDAGULTO','7',0,'Attendance Adjustment Recommendation','Your attendance recommendation was recommended by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-18','16:01:57','INS->LDAGULTO->2022-03-18 04:01:57'),(37,'LDAGULTO','7',0,'Attendance Adjustment Recommendation','Your attendance recommendation was recommended by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-18','16:02:30','INS->LDAGULTO->2022-03-18 04:02:30'),(38,'LDAGULTO','7',0,'Attendance Adjustment Recommendation','Your attendance recommendation was recommended by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-18','16:02:36','INS->LDAGULTO->2022-03-18 04:02:36'),(39,'LDAGULTO','7',0,'Attendance Creation Cancellation Notification','The attendance creation was cancelled by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-21','09:06:48','INS->LDAGULTO->2022-03-21 09:06:48'),(40,'LDAGULTO','7',0,'Attendance Creation Cancellation Notification','The attendance creation was cancelled by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-21','09:07:38','INS->LDAGULTO->2022-03-21 09:07:38'),(41,NULL,NULL,0,'Attendance Adjustment Cancellation Notification','The attendance adjustment has been cancelled by .','attendance-adjustment.php','2022-03-21','09:12:38','INS->LDAGULTO->2022-03-21 09:12:38'),(42,NULL,NULL,0,'Attendance Adjustment Cancellation Notification','The attendance adjustment has been cancelled by .','attendance-adjustment.php','2022-03-21','09:13:55','INS->LDAGULTO->2022-03-21 09:13:55'),(43,NULL,NULL,0,'Attendance Adjustment Cancellation Notification','The attendance adjustment has been cancelled by .','attendance-adjustment.php','2022-03-21','09:14:36','INS->LDAGULTO->2022-03-21 09:14:36'),(44,NULL,NULL,0,'Attendance Adjustment Cancellation Notification','The attendance adjustment has been cancelled by .','attendance-adjustment.php','2022-03-21','09:20:16','INS->LDAGULTO->2022-03-21 09:20:16'),(45,NULL,NULL,0,'Attendance Adjustment Cancellation Notification','The attendance adjustment has been cancelled by .','attendance-adjustment.php','2022-03-21','09:21:15','INS->LDAGULTO->2022-03-21 09:21:15'),(46,NULL,NULL,0,'Attendance Adjustment Cancellation Notification','The attendance adjustment has been cancelled by .','attendance-adjustment.php','2022-03-21','09:21:33','INS->LDAGULTO->2022-03-21 09:21:33'),(47,'LDAGULTO','7',0,'Attendance Adjustment Cancellation Notification','The attendance adjustment has been cancelled by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-21','09:24:19','INS->LDAGULTO->2022-03-21 09:24:19'),(48,'7','7',0,'Attendance Adjustment For Approval Notification','There is an attendance adjustment for recommendation coming from Agulto, Lawrence De Vera.','attendance-adjustment-approval.php','2022-03-22','11:35:25','INS->LDAGULTO->2022-03-22 11:35:25'),(49,'7','7',0,'Attendance Adjustment For Approval Notification','There is an attendance adjustment for recommendation coming from Agulto, Lawrence De Vera.','attendance-adjustment-approval.php','2022-03-22','11:36:04','INS->LDAGULTO->2022-03-22 11:36:04'),(50,'7','7',0,'Attendance Creation For Approval Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-approval.php','2022-03-22','11:41:21','INS->LDAGULTO->2022-03-22 11:41:21'),(51,'7','7',0,'Attendance Creation For Approval Notification','There is an attendance creation for approval from .','attendance-creation-approval.php','2022-03-22','11:51:03','INS->LDAGULTO->2022-03-22 11:51:03'),(52,'7','7',0,'Attendance Creation For Approval Notification','There is an attendance creation for approval from Agulto, Lawrence De Vera.','attendance-creation-approval.php','2022-03-22','11:53:25','INS->LDAGULTO->2022-03-22 11:53:25'),(53,'LDAGULTO','7',0,'Attendance Adjustment Cancellation Notification','The attendance adjustment has been cancelled by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-23','08:32:07','INS->LDAGULTO->2022-03-23 08:32:07'),(54,'LDAGULTO','7',0,'Attendance Adjustment Cancellation Notification','The attendance adjustment has been cancelled by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-23','08:32:08','INS->LDAGULTO->2022-03-23 08:32:08'),(55,'LDAGULTO','7',0,'Attendance Adjustment Cancellation Notification','The attendance adjustment has been cancelled by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-23','08:32:09','INS->LDAGULTO->2022-03-23 08:32:09'),(56,'LDAGULTO','7',0,'Attendance Adjustment Cancellation Notification','The attendance adjustment has been cancelled by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-23','08:32:10','INS->LDAGULTO->2022-03-23 08:32:10'),(57,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-23','09:08:53','INS->LDAGULTO->2022-03-23 09:08:53'),(58,'7','7',0,'Attendance Adjustment For Recommendation Notification','There is an attendance adjustment for recommendation coming from Agulto, Lawrence De Vera.','attendance-adjustment-recommendation.php','2022-03-23','09:59:50','INS->LDAGULTO->2022-03-23 09:59:50'),(59,'7','7',0,'Attendance Adjustment For Recommendation Notification','There is an attendance adjustment for recommendation coming from Agulto, Lawrence De Vera.','attendance-adjustment-recommendation.php','2022-03-23','09:59:55','INS->LDAGULTO->2022-03-23 09:59:55'),(60,'LDAGULTO','7',0,'Attendance Adjustment Rejection Notification','The attendance adjustment has been rejected by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-23','10:00:38','INS->LDAGULTO->2022-03-23 10:00:38'),(61,'LDAGULTO','7',0,'Attendance Adjustment Recommendation Notification','Your attendance adjustment was recommended by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-23','10:03:02','INS->LDAGULTO->2022-03-23 10:03:02'),(62,'7','7',0,'Attendance Adjustment For Approval Notification','Your attendance adjustment was recommended by Agulto, Lawrence De Vera.','attendance-adjustment-approval.php','2022-03-23','10:03:03','INS->LDAGULTO->2022-03-23 10:03:03'),(63,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-23','10:04:45','INS->LDAGULTO->2022-03-23 10:04:45'),(64,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-23','10:04:50','INS->LDAGULTO->2022-03-23 10:04:50'),(65,'LDAGULTO','7',0,'Attendance Creation Rejection Notification','The attendance creation has been rejected by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-23','10:10:51','INS->LDAGULTO->2022-03-23 10:10:51'),(66,NULL,'7',0,'Attendance Creation Recommendation Notification','Your attendance creation was recommended by .','attendance-creation.php','2022-03-23','10:10:56','INS->LDAGULTO->2022-03-23 10:10:56'),(67,'7','7',0,'Attendance Creation For Approval Notification','Your attendance creation was recommended by .','attendance-creation-approval.php','2022-03-23','10:10:57','INS->LDAGULTO->2022-03-23 10:10:57'),(68,'LDAGULTO','7',0,'Attendance Creation Cancellation Notification','The attendance adjustment has been cancelled by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-23','10:11:08','INS->LDAGULTO->2022-03-23 10:11:08'),(69,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-23','10:13:08','INS->LDAGULTO->2022-03-23 10:13:08'),(70,NULL,'7',0,'Attendance Creation Recommendation Notification','Your attendance creation was recommended by .','attendance-creation.php','2022-03-23','10:13:20','INS->LDAGULTO->2022-03-23 10:13:20'),(71,'7','7',0,'Attendance Creation For Approval Notification','There is an attendance creation for approval from Agulto, Lawrence De Vera.','attendance-creation-approval.php','2022-03-23','10:13:20','INS->LDAGULTO->2022-03-23 10:13:20'),(72,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-23','10:15:51','INS->LDAGULTO->2022-03-23 10:15:51'),(73,'LDAGULTO','7',0,'Attendance Creation Recommendation Notification','Your attendance creation was recommended by .','attendance-creation.php','2022-03-23','10:16:05','INS->LDAGULTO->2022-03-23 10:16:05'),(74,'7','7',0,'Attendance Creation For Approval Notification','There is an attendance creation for approval from Agulto, Lawrence De Vera.','attendance-creation-approval.php','2022-03-23','10:16:05','INS->LDAGULTO->2022-03-23 10:16:05'),(75,'LDAGULTO','7',0,'Attendance Creation Recommendation Notification','Your attendance creation was recommended by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-23','10:16:22','INS->LDAGULTO->2022-03-23 10:16:22'),(76,'7','7',0,'Attendance Creation For Approval Notification','There is an attendance creation for approval from Agulto, Lawrence De Vera.','attendance-creation-approval.php','2022-03-23','10:16:23','INS->LDAGULTO->2022-03-23 10:16:23'),(77,'LDAGULTO','7',0,'Attendance Creation Rejection Notification','The attendance creation has been rejected by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-24','09:21:42','INS->LDAGULTO->2022-03-24 09:21:42'),(78,'LDAGULTO','7',0,'Attendance Creation Cancellation Notification','The attendance adjustment has been cancelled by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-24','09:21:50','INS->LDAGULTO->2022-03-24 09:21:50'),(79,'LDAGULTO','7',0,'Attendance Creation Approval Notification','The attendance creation has been approved by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-24','09:25:35','INS->LDAGULTO->2022-03-24 09:25:35'),(80,'LDAGULTO','7',0,'Attendance Creation Approval Notification','The attendance creation has been approved by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-24','09:31:28','INS->LDAGULTO->2022-03-24 09:31:28'),(81,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-24','09:38:47','INS->LDAGULTO->2022-03-24 09:38:47'),(82,'LDAGULTO','7',0,'Attendance Creation Recommendation Notification','Your attendance creation was recommended by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-24','09:38:56','INS->LDAGULTO->2022-03-24 09:38:56'),(83,'7','7',0,'Attendance Creation For Approval Notification','There is an attendance creation for approval from Agulto, Lawrence De Vera.','attendance-creation-approval.php','2022-03-24','09:38:56','INS->LDAGULTO->2022-03-24 09:38:56'),(84,'LDAGULTO','7',0,'Attendance Creation Approval Notification','The attendance creation has been approved by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-24','09:39:12','INS->LDAGULTO->2022-03-24 09:39:12'),(85,'LDAGULTO','7',0,'Attendance Creation Approval Notification','The attendance creation has been approved by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-24','09:56:01','INS->LDAGULTO->2022-03-24 09:56:01'),(86,'LDAGULTO','7',0,'Attendance Creation Cancellation Notification','The attendance adjustment has been cancelled by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-24','09:56:27','INS->LDAGULTO->2022-03-24 09:56:27'),(87,'LDAGULTO','7',0,'Attendance Creation Cancellation Notification','The attendance adjustment has been cancelled by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-24','09:56:28','INS->LDAGULTO->2022-03-24 09:56:28'),(88,'LDAGULTO','7',0,'Attendance Creation Cancellation Notification','The attendance adjustment has been cancelled by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-24','09:56:29','INS->LDAGULTO->2022-03-24 09:56:29'),(89,'LDAGULTO','7',0,'Attendance Creation Cancellation Notification','The attendance adjustment has been cancelled by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-24','09:56:29','INS->LDAGULTO->2022-03-24 09:56:29'),(90,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-24','09:57:18','INS->LDAGULTO->2022-03-24 09:57:18'),(91,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-24','09:57:18','INS->LDAGULTO->2022-03-24 09:57:18'),(92,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-24','09:57:26','INS->LDAGULTO->2022-03-24 09:57:26'),(93,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-24','09:57:26','INS->LDAGULTO->2022-03-24 09:57:26'),(94,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-24','09:57:36','INS->LDAGULTO->2022-03-24 09:57:36'),(95,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-24','09:57:36','INS->LDAGULTO->2022-03-24 09:57:36'),(96,'LDAGULTO','7',0,'Attendance Creation Recommendation Notification','Your attendance creation was recommended by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-24','09:58:27','INS->LDAGULTO->2022-03-24 09:58:27'),(97,'7','7',0,'Attendance Creation For Approval Notification','There is an attendance creation for approval from Agulto, Lawrence De Vera.','attendance-creation-approval.php','2022-03-24','09:58:27','INS->LDAGULTO->2022-03-24 09:58:27'),(98,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-03-24','09:58:50','INS->LDAGULTO->2022-03-24 09:58:50'),(99,'LDAGULTO','7',0,'Attendance Creation Recommendation Notification','Your attendance creation was recommended by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-24','09:59:59','INS->LDAGULTO->2022-03-24 09:59:59'),(100,'7','7',0,'Attendance Creation For Approval Notification','Your attendance creation was recommended by Agulto, Lawrence De Vera.','attendance-creation-approval.php','2022-03-24','10:00:06','INS->LDAGULTO->2022-03-24 10:00:06'),(101,'LDAGULTO','7',0,'Attendance Creation Approval Notification','The attendance creation has been approved by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-24','10:00:37','INS->LDAGULTO->2022-03-24 10:00:37'),(102,'LDAGULTO','7',0,'Attendance Creation Approval Notification','The attendance creation has been approved by Agulto, Lawrence De Vera.','attendance-creation.php','2022-03-24','10:00:38','INS->LDAGULTO->2022-03-24 10:00:38'),(103,'LDAGULTO','7',0,'Attendance Adjustment Rejection Notification','The attendance adjustment has been rejected by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-24','11:20:24','INS->LDAGULTO->2022-03-24 11:20:24'),(104,'7','7',0,'Attendance Adjustment For Recommendation Notification','There is an attendance adjustment for recommendation coming from Agulto, Lawrence De Vera.','attendance-adjustment-recommendation.php','2022-03-24','14:16:53','INS->LDAGULTO->2022-03-24 02:16:53'),(105,'7','7',0,'Attendance Adjustment For Recommendation Notification','There is an attendance adjustment for recommendation coming from Agulto, Lawrence De Vera.','attendance-adjustment-recommendation.php','2022-03-24','14:16:54','INS->LDAGULTO->2022-03-24 02:16:54'),(106,'LDAGULTO','7',0,'Attendance Adjustment Recommendation Notification','Your attendance adjustment was recommended by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-24','14:17:01','INS->LDAGULTO->2022-03-24 02:17:01'),(107,'7','7',0,'Attendance Adjustment For Approval Notification','Your attendance adjustment was recommended by Agulto, Lawrence De Vera.','attendance-adjustment-approval.php','2022-03-24','14:17:02','INS->LDAGULTO->2022-03-24 02:17:02'),(108,'LDAGULTO','7',0,'Attendance Adjustment Recommendation Notification','Your attendance adjustment was recommended by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-24','14:17:03','INS->LDAGULTO->2022-03-24 02:17:03'),(109,'7','7',0,'Attendance Adjustment For Approval Notification','Your attendance adjustment was recommended by Agulto, Lawrence De Vera.','attendance-adjustment-approval.php','2022-03-24','14:17:03','INS->LDAGULTO->2022-03-24 02:17:03'),(110,'LDAGULTO','7',0,'Attendance Adjustment Approval Notification','The attendance adjustment has been approved by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-24','14:32:55','INS->LDAGULTO->2022-03-24 02:32:55'),(111,'LDAGULTO','7',0,'Attendance Adjustment Approval Notification','The attendance adjustment has been approved by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-24','14:33:49','INS->LDAGULTO->2022-03-24 02:33:49'),(112,'7','7',0,'Attendance Adjustment For Recommendation Notification','There is an attendance adjustment for recommendation coming from Agulto, Lawrence De Vera.','attendance-adjustment-recommendation.php','2022-03-24','14:59:53','INS->LDAGULTO->2022-03-24 02:59:53'),(113,'7','7',0,'Attendance Adjustment For Recommendation Notification','There is an attendance adjustment for recommendation coming from Agulto, Lawrence De Vera.','attendance-adjustment-recommendation.php','2022-03-24','14:59:54','INS->LDAGULTO->2022-03-24 02:59:54'),(114,'LDAGULTO','7',0,'Attendance Adjustment Recommendation Notification','Your attendance adjustment was recommended by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-24','15:00:02','INS->LDAGULTO->2022-03-24 03:00:02'),(115,'7','7',0,'Attendance Adjustment For Approval Notification','Your attendance adjustment was recommended by Agulto, Lawrence De Vera.','attendance-adjustment-approval.php','2022-03-24','15:00:02','INS->LDAGULTO->2022-03-24 03:00:02'),(116,'LDAGULTO','7',0,'Attendance Adjustment Recommendation Notification','Your attendance adjustment was recommended by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-24','15:00:03','INS->LDAGULTO->2022-03-24 03:00:03'),(117,'7','7',0,'Attendance Adjustment For Approval Notification','Your attendance adjustment was recommended by Agulto, Lawrence De Vera.','attendance-adjustment-approval.php','2022-03-24','15:00:04','INS->LDAGULTO->2022-03-24 03:00:04'),(118,'LDAGULTO','7',0,'Attendance Adjustment Approval Notification','The attendance adjustment has been approved by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-24','15:00:14','INS->LDAGULTO->2022-03-24 03:00:14'),(119,'LDAGULTO','7',0,'Attendance Adjustment Approval Notification','The attendance adjustment has been approved by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-24','15:03:11','INS->LDAGULTO->2022-03-24 03:03:11'),(120,'7','7',0,'Attendance Adjustment For Recommendation Notification','There is an attendance adjustment for recommendation coming from Agulto, Lawrence De Vera.','attendance-adjustment-recommendation.php','2022-03-24','15:04:29','INS->LDAGULTO->2022-03-24 03:04:29'),(121,'LDAGULTO','7',0,'Attendance Adjustment Recommendation Notification','Your attendance adjustment was recommended by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-24','15:04:34','INS->LDAGULTO->2022-03-24 03:04:34'),(122,'7','7',0,'Attendance Adjustment For Approval Notification','Your attendance adjustment was recommended by Agulto, Lawrence De Vera.','attendance-adjustment-approval.php','2022-03-24','15:04:35','INS->LDAGULTO->2022-03-24 03:04:35'),(123,'LDAGULTO','7',0,'Attendance Adjustment Approval Notification','The attendance adjustment has been approved by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-24','15:04:41','INS->LDAGULTO->2022-03-24 03:04:41'),(124,'7','7',0,'Attendance Adjustment For Recommendation Notification','There is an attendance adjustment for recommendation coming from Agulto, Lawrence De Vera.','attendance-adjustment-recommendation.php','2022-03-24','15:14:27','INS->LDAGULTO->2022-03-24 03:14:27'),(125,'LDAGULTO','7',0,'Attendance Adjustment Recommendation Notification','Your attendance adjustment was recommended by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-24','15:14:33','INS->LDAGULTO->2022-03-24 03:14:33'),(126,'7','7',0,'Attendance Adjustment For Approval Notification','Your attendance adjustment was recommended by Agulto, Lawrence De Vera.','attendance-adjustment-approval.php','2022-03-24','15:14:33','INS->LDAGULTO->2022-03-24 03:14:33'),(127,'LDAGULTO','7',0,'Attendance Adjustment Approval Notification','The attendance adjustment has been approved by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-03-24','15:14:39','INS->LDAGULTO->2022-03-24 03:14:39'),(128,'7','7',0,'Leave Application Notification','There is a leave for approval from Agulto, Lawrence De Vera.','leave-approval.php','2022-03-30','14:10:19','INS->LDAGULTO->2022-03-30 02:10:19'),(129,'7','7',0,'Leave Application Notification','There is a leave for approval from Agulto, Lawrence De Vera.','leave-approval.php','2022-03-30','14:13:51','INS->LDAGULTO->2022-03-30 02:13:51'),(130,'7','7',0,'Leave Application Notification','There is a leave for approval from Agulto, Lawrence De Vera.','leave-approval.php','2022-03-30','16:59:02','INS->LDAGULTO->2022-03-30 04:59:02'),(131,'LDAGULTO',NULL,0,'Leave Approval Notification','The leave has been approved by Agulto, Lawrence De Vera.','employee-leave-management.php','2022-03-30','17:06:47','INS->LDAGULTO->2022-03-30 05:06:47'),(132,'LDAGULTO','7',0,'Leave Approval Notification','The leave has been approved by Agulto, Lawrence De Vera.','employee-leave-management.php','2022-03-30','17:07:56','INS->LDAGULTO->2022-03-30 05:07:56'),(133,'LDAGULTO','7',0,'Leave Approval Notification','The leave has been approved by Agulto, Lawrence De Vera.','employee-leave-management.php','2022-03-30','17:12:31','INS->LDAGULTO->2022-03-30 05:12:31'),(134,'LDAGULTO','7',0,'Leave Rejection Notification','The leave has been rejected by Agulto, Lawrence De Vera.','employee-leave-management.php','2022-03-30','17:12:39','INS->LDAGULTO->2022-03-30 05:12:39'),(135,'LDAGULTO','7',0,'Leave Cancellation Notification','The leave has been cancelled by Agulto, Lawrence De Vera.','employee-leave-management.php','2022-03-30','17:12:45','INS->LDAGULTO->2022-03-30 05:12:45'),(136,NULL,'7',0,'Time Out Notification','You time out on April 14, 2022 on 01:49 pm.','employee-attendance-record.php','2022-04-14','13:49:38','INS->LDAGULTO->2022-04-14 01:49:38'),(137,NULL,'7',0,'Attendance Time In','You time in on April 14, 2022 at 01:50 pm.','attendance-record.php','2022-04-14','13:50:18','INS->LDAGULTO->2022-04-14 01:50:18'),(138,NULL,'7',0,'Time Out Notification','You time out on April 14, 2022 on 01:52 pm.','employee-attendance-record.php','2022-04-14','13:52:50','INS->LDAGULTO->2022-04-14 01:52:50'),(139,'7','7',0,'Attendance Adjustment For Recommendation Notification','There is an attendance adjustment for recommendation coming from Agulto, Lawrence De Vera.','attendance-adjustment-recommendation.php','2022-04-15','19:58:51','INS->LDAGULTO->2022-04-15 07:58:51'),(140,'LDAGULTO','7',0,'Attendance Adjustment Recommendation Notification','Your attendance adjustment was recommended by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-04-15','19:59:11','INS->LDAGULTO->2022-04-15 07:59:11'),(141,'7','7',0,'Attendance Adjustment For Approval Notification','Your attendance adjustment was recommended by Agulto, Lawrence De Vera.','attendance-adjustment-approval.php','2022-04-15','19:59:12','INS->LDAGULTO->2022-04-15 07:59:12'),(142,'LDAGULTO','7',0,'Attendance Adjustment Approval Notification','The attendance adjustment has been approved by Agulto, Lawrence De Vera.','attendance-adjustment.php','2022-04-16','14:56:52','INS->LDAGULTO->2022-04-16 02:56:52'),(143,'7','7',0,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from Agulto, Lawrence De Vera.','attendance-creation-recommendation.php','2022-04-16','15:34:41','INS->LDAGULTO->2022-04-16 03:34:41'),(144,'LDAGULTO','7',0,'Attendance Creation Recommendation Notification','Your attendance creation was recommended by Agulto, Lawrence De Vera.','attendance-creation.php','2022-04-16','15:34:56','INS->LDAGULTO->2022-04-16 03:34:56'),(145,'7','7',0,'Attendance Creation For Approval Notification','There is an attendance creation for approval from Agulto, Lawrence De Vera.','attendance-creation-approval.php','2022-04-16','15:34:57','INS->LDAGULTO->2022-04-16 03:34:57'),(146,'LDAGULTO','7',0,'Attendance Creation Approval Notification','The attendance creation has been approved by Agulto, Lawrence De Vera.','attendance-creation.php','2022-04-16','15:35:29','INS->LDAGULTO->2022-04-16 03:35:29');
/*!40000 ALTER TABLE `tblnotification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblnotificationdetails`
--

DROP TABLE IF EXISTS `tblnotificationdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblnotificationdetails` (
  `NOTIFICATION_ID` int(50) NOT NULL,
  `NOTIFICATION_TITLE` varchar(500) DEFAULT NULL,
  `NOTIFICATION_MESSAGE` varchar(500) DEFAULT NULL,
  `SYSTEM_LINK` varchar(200) DEFAULT NULL,
  `WEB_LINK` varchar(200) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`NOTIFICATION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblnotificationdetails`
--

LOCK TABLES `tblnotificationdetails` WRITE;
/*!40000 ALTER TABLE `tblnotificationdetails` DISABLE KEYS */;
INSERT INTO `tblnotificationdetails` VALUES (1,'Attendance Time In','You time in on {date} at {time}.','attendance-record.php','https://127.0.0.0/worknest/employee-attendance-record.php','TL-648','INS->LDAGULTO->2022-03-18 10:03:46'),(2,'Time Out Notification','You time out on {date} on {time}.','employee-attendance-record.php','http://127.0.0.0/worknest/employee-attendance-record.php','TL-649','INS->LDAGULTO->2022-03-18 10:04:38'),(3,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from {name}.','attendance-creation-recommendation.php','http://127.0.0.0/worknest/attendance-creation-recommendation.php','TL-650','UPD->LDAGULTO->2022-03-18 10:10:23'),(4,'Attendance Adjustment For Recommendation Notification','There is an attendance adjustment for recommendation coming from {name}.','attendance-adjustment-recommendation.php','http://127.0.0.0/worknest/attendance-adjustment-recommendation.php','TL-653','INS->LDAGULTO->2022-03-18 10:11:35'),(5,'Attendance Creation Recommendation Notification','Your attendance creation was recommended by {name}.','attendance-creation.php','http://127.0.0.0/worknest/attendance-creation.php','TL-658','UPD->LDAGULTO->2022-03-23 09:29:15'),(6,'Attendance Adjustment Recommendation Notification','Your attendance adjustment was recommended by {name}.','attendance-adjustment.php','http://127.0.0.0/worknest/attendance-adjustment.php','TL-659','UPD->LDAGULTO->2022-03-23 09:29:46'),(7,'Attendance Creation Cancellation Notification','The attendance adjustment has been cancelled by {name}.','attendance-creation.php','http://127.0.0.0/worknest/attendance-creation.php','TL-666','UPD->LDAGULTO->2022-03-21 05:38:29'),(8,'Attendance Adjustment Cancellation Notification','The attendance adjustment has been cancelled by {name}.','attendance-adjustment.php','http://127.0.0.0/worknest/attendance-adjustment.php','TL-669','INS->LDAGULTO->2022-03-21 08:46:41'),(9,'Attendance Creation For Approval Notification','There is an attendance creation for approval from {name}.','attendance-creation-approval.php','http://127.0.0.0/worknest/attendance-creation-approval.php','TL-672','UPD->LDAGULTO->2022-03-21 05:39:14'),(10,'Attendance Adjustment For Approval Notification','There is an attendance adjustment for approval from {name}.','attendance-adjustment-approval.php','http://127.0.0.0/worknest/attendance-adjustment-approval.php','TL-673','UPD->LDAGULTO->2022-03-21 05:37:33'),(11,'Attendance Creation Rejection Notification','The attendance creation has been rejected by {name}.','attendance-creation.php','http://127.0.0.0/worknest/attendance-creation.php','TL-703','INS->LDAGULTO->2022-03-23 09:28:36'),(12,'Attendance Adjustment Rejection Notification','The attendance adjustment has been rejected by {name}.','attendance-adjustment.php','http://127.0.0.0/worknest/attendance-adjustment.php','TL-704','INS->LDAGULTO->2022-03-23 09:30:11'),(13,'Attendance Creation Approval Notification','The attendance creation has been approved by {name}.','attendance-creation.php','http://127.0.0.0/worknest/attendance-creation.php','TL-705','UPD->LDAGULTO->2022-03-23 09:35:22'),(14,'Attendance Adjustment Approval Notification','The attendance adjustment has been approved by {name}.','attendance-adjustment.php','http://127.0.0.0/worknest/attendance-adjustment.php','TL-708','INS->LDAGULTO->2022-03-23 09:35:11'),(15,'Leave Application Notification','There is a leave for approval from {name}.','leave-approval.php','http://127.0.0.0/worknest/leave-approval.php','TL-773','INS->LDAGULTO->2022-03-30 01:52:09'),(16,'Leave Approval Notification','The leave has been approved by {name}.','employee-leave-management.php','http://127.0.0.0/worknest/employee-leave-management.php','TL-785','INS->LDAGULTO->2022-03-30 04:30:25'),(17,'Leave Rejection Notification','The leave has been rejected by {name}.','employee-leave-management.php','http://127.0.0.0/worknest/employee-leave-management.php','TL-786','INS->LDAGULTO->2022-03-30 04:31:05'),(18,'Leave Cancellation Notification','The leave has been cancelled by {name}.','employee-leave-management.php','http://127.0.0.0/worknest/employee-leave-management.php','TL-787','INS->LDAGULTO->2022-03-30 04:31:25');
/*!40000 ALTER TABLE `tblnotificationdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblnotificationrecipient`
--

DROP TABLE IF EXISTS `tblnotificationrecipient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblnotificationrecipient` (
  `NOTIFICATION_ID` int(50) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblnotificationrecipient`
--

LOCK TABLES `tblnotificationrecipient` WRITE;
/*!40000 ALTER TABLE `tblnotificationrecipient` DISABLE KEYS */;
INSERT INTO `tblnotificationrecipient` VALUES (10,'7','INS->LDAGULTO->2022-03-21 05:37:33'),(7,'','INS->LDAGULTO->2022-03-21 05:38:29'),(9,'7','INS->LDAGULTO->2022-03-21 05:39:14'),(11,'','INS->LDAGULTO->2022-03-23 09:28:37'),(5,'','INS->LDAGULTO->2022-03-23 09:29:15'),(6,'','INS->LDAGULTO->2022-03-23 09:29:46'),(12,'','INS->LDAGULTO->2022-03-23 09:30:11'),(14,'','INS->LDAGULTO->2022-03-23 09:35:11'),(13,'','INS->LDAGULTO->2022-03-23 09:35:22'),(15,'','INS->LDAGULTO->2022-03-30 01:52:09'),(16,'','INS->LDAGULTO->2022-03-30 04:30:25'),(17,'','INS->LDAGULTO->2022-03-30 04:31:05'),(18,'','INS->LDAGULTO->2022-03-30 04:31:25');
/*!40000 ALTER TABLE `tblnotificationrecipient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblnotificationtype`
--

DROP TABLE IF EXISTS `tblnotificationtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblnotificationtype` (
  `NOTIFICATION_ID` int(50) NOT NULL,
  `NOTIFICATION` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(200) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`NOTIFICATION_ID`),
  KEY `notification_type_index` (`NOTIFICATION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblnotificationtype`
--

LOCK TABLES `tblnotificationtype` WRITE;
/*!40000 ALTER TABLE `tblnotificationtype` DISABLE KEYS */;
INSERT INTO `tblnotificationtype` VALUES (1,'Time In Notification','Notification for time in.','TL-491','UPD->LDAGULTO->2022-02-24 03:41:39'),(2,'Time Out Notification','Notification for time out.','TL-545','UPD->LDAGULTO->2022-02-24 02:10:29'),(3,'Attendance Creation For Recommendation','Notification to the department head that there is a attendance creation for recommendation.','TL-650','INS->LDAGULTO->2022-03-18 10:05:29'),(4,'Attendance Adjustment For Recommendation','Notification to the department head that there is an attendance adjustment for recommendation.','TL-651','UPD->LDAGULTO->2022-03-30 01:47:41'),(5,'Attendance Creation Recommendation','Notification to the requester that the attendance creation is recommended.','TL-658','INS->LDAGULTO->2022-03-18 02:27:52'),(6,'Attendance Adjustment Recommendation','Notification to the requester that the attendance adjustment is recommended.','TL-659','INS->LDAGULTO->2022-03-18 02:28:14'),(7,'Attendance Creation Cancellation','Notification to the requester that the attendance creation is cancelled.','TL-666','INS->LDAGULTO->2022-03-21 08:43:42'),(8,'Attendance Adjustment Cancellation','Notification to the requester that the attendance adjustment is cancelled.','TL-667','INS->LDAGULTO->2022-03-21 08:44:09'),(9,'Attendance Creation For Approval','Notification to the HR Head that there is an attendance creation for approval.','TL-672','INS->LDAGULTO->2022-03-21 03:49:16'),(10,'Attendance Adjustment For Approval','Notification to the HR Head that there is an attendance adjustment for approval.','TL-673','INS->LDAGULTO->2022-03-21 03:50:29'),(11,'Attendance Creation Rejection','Notification to the requester that the attendance creation is rejected.','TL-701','INS->LDAGULTO->2022-03-23 09:26:44'),(12,'Attendance Adjustment Rejection','Notification to the requester that the attendance adjustment is rejected.','TL-702','INS->LDAGULTO->2022-03-23 09:27:09'),(13,'Attendance Creation Approval','Notification to the requester that the attendance creation is approved.','TL-705','INS->LDAGULTO->2022-03-23 09:33:28'),(14,'Attendance Adjustment Approval','Notification to the requester that the attendance adjustment is approved.','TL-706','INS->LDAGULTO->2022-03-23 09:33:52'),(15,'Leave Application','Notification to the department head that there is a leave for approval.','TL-772','INS->LDAGULTO->2022-03-30 01:47:32'),(16,'Leave Approval','Notification to the requester that the leave is approved.','TL-782','INS->LDAGULTO->2022-03-30 04:27:39'),(17,'Leave Rejection','Notification to the requester that the leave is rejected.','TL-783','INS->LDAGULTO->2022-03-30 04:27:53'),(18,'Leave Cancellation','Notification to the requester that the leave is cancellation.','TL-784','INS->LDAGULTO->2022-03-30 04:28:03');
/*!40000 ALTER TABLE `tblnotificationtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpermission`
--

DROP TABLE IF EXISTS `tblpermission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblpermission` (
  `PERMISSION_ID` int(50) NOT NULL,
  `POLICY` int(50) NOT NULL,
  `PERMISSION` varchar(100) NOT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PERMISSION_ID`),
  KEY `permission_index` (`PERMISSION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpermission`
--

LOCK TABLES `tblpermission` WRITE;
/*!40000 ALTER TABLE `tblpermission` DISABLE KEYS */;
INSERT INTO `tblpermission` VALUES (1,1,'View Dashboard Page','TL-23','INS->ADMIN->2022-01-03 02:33:17'),(2,2,'View Policy Page','TL-24','INS->ADMIN->2022-01-03 02:33:36'),(3,2,'Add Policy','TL-25','INS->ADMIN->2022-01-03 02:33:41'),(4,2,'Update Policy','TL-26','INS->ADMIN->2022-01-03 02:33:46'),(5,2,'Delete Policy','TL-27','INS->ADMIN->2022-01-03 02:33:51'),(6,2,'View Transaction Log','TL-28','INS->ADMIN->2022-01-03 02:34:02'),(7,3,'View Permission Page','TL-29','INS->ADMIN->2022-01-03 02:34:42'),(8,3,'Add Permission','TL-30','INS->ADMIN->2022-01-03 02:34:47'),(9,3,'Update Permission','TL-31','INS->ADMIN->2022-01-03 02:34:52'),(10,3,'Delete Permission','TL-32','INS->ADMIN->2022-01-03 02:35:43'),(11,3,'View Transaction Log','TL-33','INS->ADMIN->2022-01-03 02:35:48'),(12,4,'View Role Page','TL-34','INS->ADMIN->2022-01-03 02:35:52'),(13,4,'Add Role','TL-35','INS->ADMIN->2022-01-03 02:35:56'),(14,4,'Update Role','TL-36','INS->ADMIN->2022-01-03 02:36:09'),(15,4,'Delete Role','TL-37','INS->ADMIN->2022-01-03 02:36:15'),(16,4,'View Transaction Log','TL-38','INS->ADMIN->2022-01-03 02:36:36'),(17,5,'View Role Permission Page','TL-39','INS->ADMIN->2022-01-03 02:36:41'),(18,5,'Update Role Permission','TL-40','INS->ADMIN->2022-01-03 02:36:46'),(19,6,'View System Parameter Page','TL-41','INS->ADMIN->2022-01-03 02:36:51'),(20,6,'Add System Parameter','TL-42','INS->ADMIN->2022-01-03 02:37:07'),(21,6,'Update System Parameter','TL-43','INS->ADMIN->2022-01-03 02:37:11'),(22,6,'Delete System Parameter','TL-44','INS->ADMIN->2022-01-03 02:37:17'),(23,6,'View Transaction Log','TL-45','INS->ADMIN->2022-01-03 02:37:23'),(24,7,'View System Code Page','TL-46','INS->ADMIN->2022-01-03 02:37:39'),(25,7,'Add System Code','TL-47','INS->ADMIN->2022-01-03 02:37:51'),(26,7,'Update System Code','TL-48','INS->ADMIN->2022-01-03 02:37:59'),(27,7,'Delete System Code','TL-49','INS->ADMIN->2022-01-03 02:38:04'),(28,7,'View Transaction Log','TL-50','INS->ADMIN->2022-01-03 02:38:30'),(29,8,'View Notification Type Page','TL-51','INS->ADMIN->2022-01-03 02:39:00'),(30,8,'Add Notification Type','TL-52','INS->ADMIN->2022-01-03 02:39:19'),(31,8,'Update Notification Type','TL-53','INS->ADMIN->2022-01-03 02:39:36'),(32,8,'Delete Notification Type','TL-54','INS->ADMIN->2022-01-03 02:40:30'),(33,8,'View Transaction Log','TL-55','INS->ADMIN->2022-01-03 02:40:36'),(34,9,'View User Interface Setting Page','TL-56','INS->ADMIN->2022-01-03 02:40:54'),(35,9,'Update User Interface Setting','TL-57','INS->ADMIN->2022-01-03 02:40:59'),(36,9,'View Transaction Log','TL-58','INS->ADMIN->2022-01-03 02:41:18'),(37,10,'View Application Notification Page','TL-59','INS->ADMIN->2022-01-03 02:41:23'),(38,10,'Update Application Notification','TL-60','INS->ADMIN->2022-01-03 02:41:27'),(39,11,'View Company Setting Page','TL-61','INS->ADMIN->2022-01-03 02:41:32'),(40,11,'Update Company Setting','TL-62','INS->ADMIN->2022-01-03 02:41:43'),(41,11,'View Transaction Log','TL-63','INS->ADMIN->2022-01-03 02:41:48'),(42,12,'View Email Setting Page','TL-64','INS->ADMIN->2022-01-03 02:42:08'),(43,12,'Update Email Setting','TL-65','INS->ADMIN->2022-01-03 02:42:13'),(44,12,'View Transaction Log','TL-66','INS->ADMIN->2022-01-03 02:42:26'),(45,13,'View Department Page','TL-67','INS->ADMIN->2022-01-03 02:42:31'),(46,13,'Add Department','TL-68','INS->ADMIN->2022-01-03 02:42:37'),(47,13,'Update Department','TL-69','INS->ADMIN->2022-01-03 02:42:44'),(48,13,'Delete Department','TL-70','INS->ADMIN->2022-01-03 03:33:36'),(49,13,'View Transaction Log','TL-71','INS->ADMIN->2022-01-03 03:33:42'),(50,14,'View Designation Page','TL-72','INS->ADMIN->2022-01-03 03:33:55'),(51,14,'Add Designation','TL-73','INS->ADMIN->2022-01-03 03:33:59'),(52,14,'Update Designation','TL-74','INS->ADMIN->2022-01-03 03:34:04'),(53,14,'Delete Designation','TL-75','INS->ADMIN->2022-01-03 03:34:10'),(54,14,'View Transaction Log','TL-76','INS->ADMIN->2022-01-03 03:34:15'),(55,15,'View Branch Page','TL-77','INS->ADMIN->2022-01-03 03:34:26'),(56,15,'Add Branch','TL-78','INS->ADMIN->2022-01-03 03:34:31'),(57,15,'Update Branch','TL-79','INS->ADMIN->2022-01-03 03:34:35'),(58,15,'Delete Branch','TL-80','INS->ADMIN->2022-01-03 03:34:39'),(59,15,'View Transaction Log','TL-81','INS->ADMIN->2022-01-03 03:34:49'),(60,16,'View Upload Setting Page','TL-128','INS->ADMIN->2022-01-05 10:13:05'),(61,16,'Add Upload Setting','TL-129','INS->ADMIN->2022-01-05 10:13:12'),(62,16,'Update Upload Setting','TL-130','INS->ADMIN->2022-01-05 10:13:19'),(63,16,'Delete Upload Setting','TL-131','INS->ADMIN->2022-01-05 10:13:27'),(64,16,'View Transaction Log','TL-132','INS->ADMIN->2022-01-05 10:13:34'),(65,17,'View Employment Status Page','TL-177','INS->ADMIN->2022-01-10 10:02:53'),(66,17,'Add Employment Status','TL-178','INS->ADMIN->2022-01-10 10:02:58'),(67,17,'Update Employment Status','TL-179','INS->ADMIN->2022-01-10 10:03:04'),(68,17,'Delete Employment Status','TL-180','INS->ADMIN->2022-01-10 10:03:20'),(69,17,'View Transaction Log','TL-181','INS->ADMIN->2022-01-10 10:03:34'),(70,18,'View Employee Page','TL-198','INS->ADMIN->2022-01-10 11:34:43'),(71,18,'Add Employee','TL-199','INS->ADMIN->2022-01-10 11:34:50'),(72,18,'Update Employee','TL-200','INS->ADMIN->2022-01-10 11:34:55'),(73,18,'Delete Employee','TL-201','INS->ADMIN->2022-01-10 11:35:00'),(74,18,'View Transaction Log','TL-202','INS->ADMIN->2022-01-10 11:35:08'),(75,19,'View Employee Details Page','TL-260','INS->ADMIN->2022-01-14 03:40:06'),(76,19,'Update Employee Details','TL-261','INS->ADMIN->2022-01-14 03:40:17'),(77,20,'View Emergency Contact','TL-281','INS->ADMIN->2022-01-16 06:51:48'),(78,20,'Add Emergency Contact','TL-282','INS->ADMIN->2022-01-16 06:51:55'),(79,20,'Update Emergency Contact','TL-283','INS->ADMIN->2022-01-16 06:52:02'),(80,20,'Delete Emergency Contact','TL-284','INS->ADMIN->2022-01-16 06:52:18'),(81,20,'View Transaction Log','TL-285','INS->ADMIN->2022-01-16 06:52:45'),(82,21,'View Employee Address','TL-289','INS->ADMIN->2022-01-17 10:57:25'),(83,21,'Add Employee Address','TL-290','INS->ADMIN->2022-01-17 10:57:31'),(84,21,'Update Employee Address','TL-291','UPD->ADMIN->2022-01-17 10:57:42'),(85,21,'Delete Employee Address','TL-292','INS->ADMIN->2022-01-17 10:57:47'),(86,21,'View Transaction Log','TL-293','INS->ADMIN->2022-01-17 10:57:53'),(87,22,'View Employee Social','TL-306','INS->ADMIN->2022-01-17 01:12:12'),(88,22,'Add Employee Social','TL-307','INS->ADMIN->2022-01-17 01:12:17'),(89,22,'Update Employee Social','TL-308','UPD->ADMIN->2022-01-17 01:12:29'),(90,22,'Delete Employee Social','TL-309','INS->ADMIN->2022-01-17 01:12:36'),(91,22,'View Transaction Log','TL-310','INS->ADMIN->2022-01-17 01:12:45'),(92,23,'View Work Shift Page','TL-314','INS->ADMIN->2022-01-17 01:54:56'),(93,23,'Add Work Shift','TL-315','INS->ADMIN->2022-01-17 01:55:05'),(94,23,'Update Work Shift','TL-316','INS->ADMIN->2022-01-17 01:55:14'),(95,23,'Update Work Shift Schedule','TL-317','UPD->ADMIN->2022-01-18 04:28:09'),(96,23,'Assign Work Shift','TL-318','UPD->ADMIN->2022-01-21 09:56:37'),(97,23,'Delete Work Shift','TL-322','UPD->ADMIN->2022-01-21 09:56:45'),(98,23,'View Transaction Log','TL-330','INS->ADMIN->2022-01-21 10:05:48'),(99,24,'View Employee Attendance','TL-334','UPD->ADMIN->2022-01-25 11:34:08'),(100,24,'Add Employee Attendance','TL-335','UPD->ADMIN->2022-01-25 11:34:12'),(101,24,'Update Employee Attendance','TL-336','UPD->ADMIN->2022-01-25 11:34:17'),(102,24,'Delete Employee Attendance','TL-337','UPD->ADMIN->2022-01-25 11:34:23'),(103,24,'View Transaction Log','TL-338','INS->ADMIN->2022-01-25 11:34:29'),(104,25,'View Leave Type Page','TL-345','INS->ADMIN->2022-01-27 10:22:20'),(105,25,'Add Leave Type','TL-346','INS->ADMIN->2022-01-27 10:22:27'),(106,25,'Update Leave Type','TL-347','INS->ADMIN->2022-01-27 10:22:35'),(107,25,'Delete Leave Type','TL-348','INS->ADMIN->2022-01-27 10:22:40'),(108,25,'View Transaction Log','TL-349','INS->ADMIN->2022-01-27 10:22:46'),(109,26,'View Leave Entitlement Page','TL-362','INS->ADMIN->2022-01-27 01:13:08'),(110,26,'Add Leave Entitlement','TL-363','INS->ADMIN->2022-01-27 01:13:13'),(111,26,'Update Leave Entitlement','TL-364','INS->ADMIN->2022-01-27 01:13:21'),(112,26,'Delete Leave Entitlement','TL-365','INS->ADMIN->2022-01-27 01:13:28'),(113,26,'View Transaction Log','TL-366','INS->ADMIN->2022-01-27 01:13:34'),(114,27,'View Leave Entitlement','TL-369','INS->ADMIN->2022-01-27 03:39:07'),(115,27,'Add Leave Entitlement','TL-370','UPD->ADMIN->2022-01-27 03:39:31'),(116,27,'Update Leave Entitlement','TL-371','INS->ADMIN->2022-01-27 03:39:26'),(117,27,'Delete Leave Entitlement','TL-372','INS->ADMIN->2022-01-27 03:39:40'),(118,27,'View Transaction Log','TL-373','INS->ADMIN->2022-01-27 03:40:02'),(119,28,'View Leave Management Page','TL-384','INS->ADMIN->2022-01-27 05:03:14'),(120,28,'Add Leave','TL-385','INS->ADMIN->2022-01-27 05:03:18'),(121,28,'Delete Leave','TL-386','UPD->ADMIN->2022-01-28 04:17:18'),(122,28,'Approve Leave','TL-387','UPD->ADMIN->2022-01-28 04:17:23'),(123,28,'Reject Leave','TL-388','UPD->ADMIN->2022-01-28 04:17:35'),(124,28,'Cancel Leave','TL-410','INS->ADMIN->2022-01-28 04:17:40'),(125,28,'View Transaction Log','TL-411','INS->ADMIN->2022-01-28 04:17:46'),(126,29,'View Leave','TL-420','INS->ADMIN->2022-02-02 10:39:02'),(127,29,'Add Leave','TL-421','INS->ADMIN->2022-02-02 10:39:21'),(128,29,'Delete Leave','TL-422','INS->ADMIN->2022-02-02 10:39:38'),(129,29,'Approve Leave','TL-423','INS->ADMIN->2022-02-02 10:39:44'),(130,29,'Reject Leave','TL-424','INS->ADMIN->2022-02-02 10:39:50'),(131,29,'Cancel Leave','TL-425','INS->ADMIN->2022-02-02 10:39:56'),(132,29,'View Transaction Log','TL-426','INS->ADMIN->2022-02-02 10:40:04'),(133,30,'View Employee File Management Page','TL-431','UPD->ADMIN->2022-02-02 11:17:41'),(134,30,'Add File','TL-432','INS->ADMIN->2022-02-02 11:14:45'),(135,30,'Update File','TL-433','INS->ADMIN->2022-02-02 11:14:49'),(136,30,'Delete File','TL-434','INS->ADMIN->2022-02-02 11:14:52'),(137,30,'View Transaction Log','TL-435','INS->ADMIN->2022-02-02 11:16:06'),(138,31,'View Employee File','TL-444','INS->ADMIN->2022-02-07 10:18:04'),(139,31,'Add Employee File','TL-445','INS->ADMIN->2022-02-07 10:18:09'),(140,31,'Update Employee File','TL-446','INS->ADMIN->2022-02-07 10:18:16'),(141,31,'Delete Employee File','TL-447','UPD->ADMIN->2022-02-07 10:18:25'),(142,31,'View Transaction Log','TL-448','INS->ADMIN->2022-02-07 10:18:30'),(143,32,'View User Account Page','TL-452','INS->ADMIN->2022-02-08 02:37:31'),(144,32,'Add User Account','TL-453','INS->ADMIN->2022-02-08 02:37:38'),(145,32,'Update User Account','TL-454','INS->ADMIN->2022-02-08 02:37:46'),(146,32,'Lock User Account','TL-455','INS->ADMIN->2022-02-08 02:41:31'),(147,32,'Unlock User Account','TL-456','INS->ADMIN->2022-02-08 02:41:37'),(148,32,'Activate User Account','TL-457','INS->ADMIN->2022-02-08 02:41:57'),(149,32,'De-activate User Account','TL-458','INS->ADMIN->2022-02-08 02:42:05'),(150,32,'View Transaction Log','TL-459','INS->ADMIN->2022-02-08 02:42:15'),(151,33,'View Holiday Page','TL-486','INS->LDAGULTO->2022-02-10 01:00:20'),(152,33,'Add Holiday','TL-487','UPD->LDAGULTO->2022-02-10 01:00:38'),(153,33,'Update Holiday','TL-488','INS->LDAGULTO->2022-02-10 01:00:33'),(154,33,'Delete Holiday','TL-489','INS->LDAGULTO->2022-02-10 01:00:43'),(155,33,'View Transaction Log','TL-490','INS->LDAGULTO->2022-02-10 01:00:49'),(156,34,'View Attendance Setting Page','TL-521','INS->LDAGULTO->2022-02-15 04:34:16'),(157,34,'Update Attendance Setting','TL-522','INS->LDAGULTO->2022-02-15 04:36:55'),(158,34,'View Transaction Log','TL-523','INS->LDAGULTO->2022-02-15 04:37:02'),(159,1,'Record Attendance','TL-525','INS->LDAGULTO->2022-02-17 09:46:50'),(160,35,'View Attendance Record Page','TL-530','UPD->LDAGULTO->2022-02-18 03:48:21'),(161,35,'Add Attendance Record','TL-531','UPD->LDAGULTO->2022-02-18 03:48:25'),(162,35,'Update Attendance Record','TL-532','UPD->LDAGULTO->2022-02-18 03:48:29'),(163,35,'Delete Attendance Record','TL-533','UPD->LDAGULTO->2022-02-18 03:48:35'),(164,35,'View Transaction Log','TL-534','INS->LDAGULTO->2022-02-18 03:42:14'),(165,1,'Submit Health Declaration','TL-536','INS->LDAGULTO->2022-02-21 10:15:56'),(166,1,'Get Location','TL-539','INS->LDAGULTO->2022-02-21 02:23:44'),(167,1,'Scan QR Code','TL-540','INS->LDAGULTO->2022-02-21 02:23:49'),(168,36,'View Notification Details Page','TL-559','INS->LDAGULTO->2022-02-24 04:32:30'),(169,36,'Update Notification Details','TL-560','INS->LDAGULTO->2022-02-24 04:32:59'),(170,36,'View Transaction Log','TL-561','INS->LDAGULTO->2022-02-24 04:33:08'),(171,37,'View Employee Attendance Record Page','TL-567','INS->LDAGULTO->2022-03-11 08:49:56'),(172,37,'Add Attendance Creation','TL-568','UPD->LDAGULTO->2022-03-11 09:47:00'),(173,37,'Add Attendance Adjustment','TL-569','UPD->LDAGULTO->2022-03-11 09:47:05'),(174,37,'View Transaction Log','TL-570','UPD->LDAGULTO->2022-03-11 09:46:52'),(175,38,'View Attendance Creation Page','TL-588','INS->LDAGULTO->2022-03-14 02:59:39'),(176,38,'Add Attendance Creation','TL-589','UPD->LDAGULTO->2022-03-14 02:59:50'),(177,38,'Update Attendance Creation','TL-590','INS->LDAGULTO->2022-03-14 03:00:02'),(178,38,'Delete Attendance Creation','TL-591','INS->LDAGULTO->2022-03-14 03:00:08'),(179,38,'Tag Attendance Creation For Recommendation','TL-592','UPD->LDAGULTO->2022-03-16 01:46:02'),(180,38,'Cancel Attendance Creation','TL-593','UPD->LDAGULTO->2022-03-16 01:26:52'),(181,38,'View Transaction Log','TL-630','INS->LDAGULTO->2022-03-16 01:27:17'),(182,39,'View Attendance Adjustment Page','TL-631','INS->LDAGULTO->2022-03-16 01:27:47'),(183,39,'Update Attendance Adjustment','TL-632','INS->LDAGULTO->2022-03-16 01:27:56'),(184,39,'Delete Attendance Adjustment','TL-633','INS->LDAGULTO->2022-03-16 01:28:03'),(185,39,'Tag Attendance Adjustment For Recommendation','TL-634','UPD->LDAGULTO->2022-03-16 01:45:41'),(186,39,'Cancel Attendance Adjustment','TL-635','INS->LDAGULTO->2022-03-16 01:28:19'),(187,39,'View Transaction Log','TL-636','INS->LDAGULTO->2022-03-16 01:28:30'),(188,40,'View Attendance Creation Recommendation Page','TL-644','INS->LDAGULTO->2022-03-18 09:45:04'),(189,40,'Recommend Attendance Creation','TL-645','INS->LDAGULTO->2022-03-18 09:45:14'),(190,40,'Reject Attendance Creation','TL-646','INS->LDAGULTO->2022-03-18 09:45:21'),(191,40,'Cancel Attendance Creation','TL-647','INS->LDAGULTO->2022-03-18 09:45:32'),(192,40,'View Transaction Log','TL-662','INS->LDAGULTO->2022-03-18 03:15:09'),(193,41,'View Attendance Adjustment Recommendation Page','TL-663','INS->LDAGULTO->2022-03-18 03:15:18'),(194,41,'Recommend Attendance Adjustment','TL-664','INS->LDAGULTO->2022-03-18 03:15:26'),(195,41,'Reject Attendance Adjustment','TL-665','INS->LDAGULTO->2022-03-18 03:15:32'),(196,41,'Cancel Attendance Adjustment','TL-688','INS->LDAGULTO->2022-03-23 08:40:11'),(197,41,'View Transaction Log','TL-689','INS->LDAGULTO->2022-03-23 08:40:19'),(198,42,'View Attendance Creation Approval Page','TL-690','INS->LDAGULTO->2022-03-23 08:40:28'),(199,42,'Approve Attendance Creation','TL-691','INS->LDAGULTO->2022-03-23 08:40:35'),(200,42,'Reject Attendance Creation','TL-692','INS->LDAGULTO->2022-03-23 08:40:42'),(201,42,'Cancel Attendance Creation','TL-693','INS->LDAGULTO->2022-03-23 08:58:05'),(202,42,'View Transaction Log','TL-694','INS->LDAGULTO->2022-03-23 08:58:10'),(203,43,'View Attendance Adjustment Approval Page','TL-695','UPD->LDAGULTO->2022-03-23 08:58:31'),(204,43,'Approve Attendance Adjustment','TL-696','INS->LDAGULTO->2022-03-23 08:58:40'),(205,43,'Reject Attendance Adjustment','TL-697','INS->LDAGULTO->2022-03-23 08:58:48'),(206,43,'Cancel Attendance Adjustment','TL-698','INS->LDAGULTO->2022-03-23 08:58:53'),(207,43,'View Transaction Log','TL-699','INS->LDAGULTO->2022-03-23 08:58:58'),(208,44,'View Leave Management Page','TL-731','INS->LDAGULTO->2022-03-24 03:48:01'),(209,44,'Add Leave','TL-732','INS->LDAGULTO->2022-03-24 03:48:06'),(210,44,'Delete Leave','TL-733','UPD->LDAGULTO->2022-03-30 09:08:24'),(211,44,'Cancel Leave','TL-734','UPD->LDAGULTO->2022-03-30 09:08:29'),(212,44,'View Transaction Log','TL-735','UPD->LDAGULTO->2022-03-30 09:08:38'),(213,45,'View Leave Approval Page','TL-777','INS->LDAGULTO->2022-03-30 02:42:18'),(214,45,'Approve Leave','TL-778','INS->LDAGULTO->2022-03-30 02:42:28'),(215,45,'Reject Leave','TL-779','INS->LDAGULTO->2022-03-30 02:42:32'),(216,45,'Cancel Leave','TL-780','INS->LDAGULTO->2022-03-30 02:42:38'),(217,45,'View Transaction Log','TL-781','INS->LDAGULTO->2022-03-30 02:42:43'),(218,46,'View Allowance Type','TL-795','INS->LDAGULTO->2022-04-01 03:35:22'),(219,46,'Add Allowance Type','TL-796','INS->LDAGULTO->2022-04-01 03:35:28'),(220,46,'Update Allowance Type','TL-797','INS->LDAGULTO->2022-04-01 03:35:35'),(221,46,'Delete Allowance Type','TL-798','INS->LDAGULTO->2022-04-01 03:35:41'),(222,46,'View Transaction Log','TL-799','INS->LDAGULTO->2022-04-01 03:35:48'),(223,47,'View Allowance Page','TL-804','INS->LDAGULTO->2022-04-05 11:38:49'),(224,47,'Add Allowance','TL-805','INS->LDAGULTO->2022-04-05 11:38:53'),(225,47,'Update Allowance','TL-806','INS->LDAGULTO->2022-04-05 11:39:00'),(226,47,'Delete Allowance','TL-807','INS->LDAGULTO->2022-04-05 11:39:05'),(227,47,'View Transaction Log','TL-808','INS->LDAGULTO->2022-04-05 11:39:16'),(228,48,'View Deduction Type Page','TL-871','UPD->LDAGULTO->2022-04-06 05:10:22'),(229,48,'Add Deduction Type','TL-872','INS->LDAGULTO->2022-04-06 05:10:33'),(230,48,'Update Deduction Type','TL-873','INS->LDAGULTO->2022-04-06 05:10:39'),(231,48,'Delete Deduction Type','TL-874','INS->LDAGULTO->2022-04-06 05:10:45'),(232,48,'View Transaction Log','TL-875','INS->LDAGULTO->2022-04-06 05:10:54'),(233,49,'View Government Contribution Page','TL-879','UPD->LDAGULTO->2022-04-08 10:31:52'),(234,49,'Add Government Contribution','TL-880','INS->LDAGULTO->2022-04-08 10:32:02'),(235,49,'Update Government Contribution','TL-881','INS->LDAGULTO->2022-04-08 10:32:17'),(236,49,'Delete Government Contribution','TL-882','INS->LDAGULTO->2022-04-08 10:32:31'),(237,49,'View Transaction Log','TL-883','INS->LDAGULTO->2022-04-08 10:32:36'),(238,50,'View Contribution Bracket Page','TL-889','INS->LDAGULTO->2022-04-08 11:19:39'),(239,50,'Add Contribution Bracket','TL-890','INS->LDAGULTO->2022-04-08 11:19:54'),(240,50,'Update Contribution Bracket','TL-891','INS->LDAGULTO->2022-04-08 11:20:06'),(241,50,'Delete Contribution Bracket','TL-892','INS->LDAGULTO->2022-04-08 11:20:12'),(242,50,'View Transaction Log','TL-893','INS->LDAGULTO->2022-04-08 11:20:18'),(243,51,'View Deduction Page','TL-899','UPD->LDAGULTO->2022-04-13 09:10:04'),(244,51,'Add Deduction','TL-900','UPD->LDAGULTO->2022-04-13 09:10:08'),(245,51,'Update Deduction','TL-901','UPD->LDAGULTO->2022-04-13 09:10:12'),(246,51,'Delete Deduction','TL-902','UPD->LDAGULTO->2022-04-13 09:10:16'),(247,51,'View Transaction Log','TL-903','INS->LDAGULTO->2022-04-09 06:09:32'),(248,52,'View Contribution Deduction Page','TL-1077','INS->LDAGULTO->2022-04-13 10:55:39'),(249,52,'Add Contribution Deduction','TL-1078','INS->LDAGULTO->2022-04-13 10:55:50'),(250,52,'Update Contribution Deduction','TL-1079','INS->LDAGULTO->2022-04-13 10:55:57'),(251,52,'Delete Contribution Deduction','TL-1080','INS->LDAGULTO->2022-04-13 10:56:04'),(252,52,'View Transaction Log','TL-1081','INS->LDAGULTO->2022-04-13 10:56:10'),(253,53,'View Employee Allowance','TL-1096','INS->LDAGULTO->2022-04-13 01:51:39'),(254,53,'Add Employee Allowance','TL-1097','INS->LDAGULTO->2022-04-13 01:51:49'),(255,53,'Update Employee Allowance','TL-1098','INS->LDAGULTO->2022-04-13 01:51:56'),(256,53,'Delete Employee Allowance','TL-1099','INS->LDAGULTO->2022-04-13 01:52:03'),(257,53,'View Transaction Log','TL-1100','INS->LDAGULTO->2022-04-13 01:52:11'),(258,54,'View Attendance Summary Page','TL-1103','INS->LDAGULTO->2022-04-14 03:46:33'),(259,54,'Export Attendance Summary','TL-1104','INS->LDAGULTO->2022-04-14 03:46:43'),(260,55,'View Import Employee Page','TL-1112','INS->LDAGULTO->2022-04-16 06:40:28'),(261,55,'Import Employee','TL-1113','INS->LDAGULTO->2022-04-16 06:40:34'),(262,56,'View Import Attendance Record','TL-1118','INS->LDAGULTO->2022-04-19 02:54:34'),(263,56,'Import Attendance Record','TL-1119','INS->LDAGULTO->2022-04-19 02:54:46');
/*!40000 ALTER TABLE `tblpermission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpolicy`
--

DROP TABLE IF EXISTS `tblpolicy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblpolicy` (
  `POLICY_ID` int(50) NOT NULL,
  `POLICY` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(200) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`POLICY_ID`),
  KEY `permission_group_index` (`POLICY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpolicy`
--

LOCK TABLES `tblpolicy` WRITE;
/*!40000 ALTER TABLE `tblpolicy` DISABLE KEYS */;
INSERT INTO `tblpolicy` VALUES (1,'Dashboard','Policies on dashboard page.','TL-8','INS->ADMIN->2022-01-03 02:25:40'),(2,'Policy','Policies on policy page.','TL-9','INS->ADMIN->2022-01-03 02:28:07'),(3,'Permission','Policies on permission page.','TL-10','INS->ADMIN->2022-01-03 02:28:20'),(4,'Role','Policies on role page.','TL-11','INS->ADMIN->2022-01-03 02:28:33'),(5,'Role Permission','Policies on role permission page.','TL-12','INS->ADMIN->2022-01-03 02:29:02'),(6,'System Parameter','Policies on system parameter page.','TL-13','INS->ADMIN->2022-01-03 02:29:17'),(7,'System Code','Policies on system code page.','TL-14','INS->ADMIN->2022-01-03 02:29:27'),(8,'Notification Type','Policies on notification type page.','TL-15','INS->ADMIN->2022-01-03 02:29:39'),(9,'User Interface Setting','Policies on user interface setting page.','TL-16','INS->ADMIN->2022-01-03 02:30:20'),(10,'Application Notification','Policies on application notification page.','TL-17','INS->ADMIN->2022-01-03 02:30:36'),(11,'Company Setting','Policies on company setting page.','TL-18','INS->ADMIN->2022-01-03 02:30:49'),(12,'Email Setting','Policies on email setting page.','TL-19','INS->ADMIN->2022-01-03 02:31:02'),(13,'Department','Policies on department page.','TL-20','INS->ADMIN->2022-01-03 02:31:13'),(14,'Designation','Policies on designation page.','TL-21','INS->ADMIN->2022-01-03 02:31:23'),(15,'Branch','Policies on branch page.','TL-22','INS->ADMIN->2022-01-03 02:31:35'),(16,'Upload Setting','Policies on upload setting page.','TL-127','INS->ADMIN->2022-01-05 10:12:04'),(17,'Employment Status','Policies on employment status page.','TL-176','INS->ADMIN->2022-01-10 09:58:49'),(18,'Employee','Policies on all employees page.','TL-197','UPD->ADMIN->2022-01-10 11:37:40'),(19,'Employee Details','Policies on employee details page.','TL-259','INS->ADMIN->2022-01-14 03:39:53'),(20,'Emergency Contact','Policies on emergency contact on employee details page.','TL-280','UPD->ADMIN->2022-01-25 11:30:06'),(21,'Employee Address','Policies on employee address on employee details page.','TL-288','UPD->ADMIN->2022-01-25 11:30:18'),(22,'Employee Social','Policies on employee social on employee details page.','TL-305','UPD->ADMIN->2022-01-25 11:30:29'),(23,'Work Shift','Policies on work shift page.','TL-313','INS->ADMIN->2022-01-17 01:54:39'),(24,'Employee Attendance','Policies on employee attendance on employee details page.','TL-333','INS->ADMIN->2022-01-25 11:29:54'),(25,'Leave Type','Policies on leave type page.','TL-344','UPD->ADMIN->2022-01-27 10:22:10'),(26,'Leave Entitlement','Policies on leave entitlement page.','TL-361','INS->ADMIN->2022-01-27 01:12:48'),(27,'Employee Leave Entitlement','Policies on leave entitlement on employee details page.','TL-368','INS->ADMIN->2022-01-27 03:38:47'),(28,'Leave Management','Policies on leave management page.','TL-383','INS->ADMIN->2022-01-27 05:03:00'),(29,'Employee Leave','Policies on leave on employee details page.','TL-419','UPD->ADMIN->2022-02-02 10:49:04'),(30,'Employee File Management','Policies on employee file management page.','TL-430','UPD->ADMIN->2022-02-02 11:18:03'),(31,'Employee File','Policies on employee file on employee details page.','TL-443','INS->ADMIN->2022-02-07 10:17:49'),(32,'User Account','Policies on user account page.','TL-451','INS->ADMIN->2022-02-08 02:36:36'),(33,'Holiday','Policies on holiday page.','TL-485','INS->LDAGULTO->2022-02-10 01:00:06'),(34,'Attendance Setting','Policies on attendance setting.','TL-520','INS->LDAGULTO->2022-02-15 04:34:05'),(35,'Attendance Record','Policies on attendance record page.','TL-529','UPD->LDAGULTO->2022-02-18 03:48:48'),(36,'Notification Details','Policies on notification details page.','TL-558','INS->LDAGULTO->2022-02-24 04:32:10'),(37,'Employee Attendance Record','Policies on employee attendance record page.','TL-566','INS->LDAGULTO->2022-03-11 08:49:30'),(38,'Attendance Creation','Policies on attendance creation page.','TL-586','INS->LDAGULTO->2022-03-14 02:57:21'),(39,'Attendance Adjustment','Polices attendance adjustment page.','TL-587','INS->LDAGULTO->2022-03-14 02:58:35'),(40,'Attendance Creation Recommendation','Policies for attendance creation recommendation page.','TL-642','INS->LDAGULTO->2022-03-18 09:44:10'),(41,'Attendance Adjustment Recommendation','Policies on attendance adjustment recommendation page.','TL-643','INS->LDAGULTO->2022-03-18 09:44:30'),(42,'Attendance Creation Approval','Policies on attendance creation approval page.','TL-686','INS->LDAGULTO->2022-03-23 08:32:49'),(43,'Attendance Adjustment Approval','Policies on attendance adjustment approval page.','TL-687','INS->LDAGULTO->2022-03-23 08:39:52'),(44,'Employee Leave Management','Policies on leave management page.','TL-730','UPD->LDAGULTO->2022-03-24 04:54:36'),(45,'Leave Approval','Policies on leave approval page.','TL-776','INS->LDAGULTO->2022-03-30 02:42:08'),(46,'Allowance Type','Policies on allowance type page.','TL-794','INS->LDAGULTO->2022-04-01 03:35:06'),(47,'Allowance','Policies on allowance page.','TL-803','INS->LDAGULTO->2022-04-05 11:38:39'),(48,'Deduction Type','Policies on deduction type page.','TL-870','INS->LDAGULTO->2022-04-06 05:10:06'),(49,'Government Contributions','Policies on government contributions page.','TL-878','INS->LDAGULTO->2022-04-08 10:31:37'),(50,'Contribution Bracket','Policies on contribution bracket page.','TL-888','INS->LDAGULTO->2022-04-08 11:19:21'),(51,'Deduction','Policies on deduction page.','TL-898','UPD->LDAGULTO->2022-04-13 09:09:09'),(52,'Contribution Deduction','Policies on contribution deduction page.','TL-1076','INS->LDAGULTO->2022-04-13 10:55:21'),(53,'Employee Allowance','Policies on employee allowance on employee details page.','TL-1095','INS->LDAGULTO->2022-04-13 01:51:04'),(54,'Attendance Summary','Policies on attendance summary page.','TL-1102','INS->LDAGULTO->2022-04-14 03:46:16'),(55,'Import Employee','Policies on import employee page.','TL-1111','INS->LDAGULTO->2022-04-16 06:40:15'),(56,'Import Attendance Record','Policies on import attendance record page.','TL-1117','INS->LDAGULTO->2022-04-19 02:54:20');
/*!40000 ALTER TABLE `tblpolicy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblprovince`
--

DROP TABLE IF EXISTS `tblprovince`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblprovince` (
  `PROVINCE_ID` int(11) NOT NULL,
  `PROVINCE` varchar(300) NOT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PROVINCE_ID`),
  KEY `province_index` (`PROVINCE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblprovince`
--

LOCK TABLES `tblprovince` WRITE;
/*!40000 ALTER TABLE `tblprovince` DISABLE KEYS */;
INSERT INTO `tblprovince` VALUES (1,'Metro Manila',NULL),(2,'Ilocos Norte',NULL),(3,'Ilocos Sur',NULL),(4,'La Union',NULL),(5,'Pangasinan',NULL),(6,'Batanes',NULL),(7,'Cagayan',NULL),(8,'Isabela',NULL),(9,'Nueva Vizcaya',NULL),(10,'Quirino',NULL),(11,'Bataan',NULL),(12,'Bulacan',NULL),(13,'Nueva Ecija',NULL),(14,'Pampanga',NULL),(15,'Tarlac',NULL),(16,'Zambales',NULL),(17,'Aurora',NULL),(18,'Batangas',NULL),(19,'Cavite',NULL),(20,'Laguna',NULL),(21,'Quezon',NULL),(22,'Rizal',NULL),(23,'Marinduque',NULL),(24,'Occidental Mindoro',NULL),(25,'Oriental Mindoro',NULL),(26,'Palawan',NULL),(27,'Romblon',NULL),(28,'Albay',NULL),(29,'Camarines Norte',NULL),(30,'Camarines Sur',NULL),(31,'Catanduanes',NULL),(32,'Masbate',NULL),(33,'Sorsogon',NULL),(34,'Aklan',NULL),(35,'Antique',NULL),(36,'Capiz',NULL),(37,'Iloilo',NULL),(38,'Negros Occidental',NULL),(39,'Guimaras',NULL),(40,'Bohol',NULL),(41,'Cebu',NULL),(42,'Negros Oriental',NULL),(43,'Siquijor',NULL),(44,'Eastern Samar',NULL),(45,'Leyte',NULL),(46,'Northern Samar',NULL),(47,'Samar',NULL),(48,'Southern Leyte',NULL),(49,'Biliran',NULL),(50,'Zamboanga del Norte',NULL),(51,'Zamboanga del Sur',NULL),(52,'Zamboanga Sibugay',NULL),(53,'Bukidnon',NULL),(54,'Camiguin',NULL),(55,'Lanao del Norte',NULL),(56,'Misamis Occidental',NULL),(57,'Misamis Oriental',NULL),(58,'Davao del Norte',NULL),(59,'Davao del Sur',NULL),(60,'Davao Oriental',NULL),(61,'Davao de Oro',NULL),(62,'Davao Occidental',NULL),(63,'Cotabato',NULL),(64,'South Cotabato',NULL),(65,'Sultan Kudarat',NULL),(66,'Sarangani',NULL),(67,'Abra',NULL),(68,'Benguet',NULL),(69,'Ifugao',NULL),(70,'Kalinga',NULL),(71,'Mountain Province',NULL),(72,'Apayao',NULL),(73,'Basilan',NULL),(74,'Lanao del Sur',NULL),(75,'Maguindanao',NULL),(76,'Sulu',NULL),(77,'Tawi-Tawi',NULL),(78,'Agusan del Norte',NULL),(79,'Agusan del Sur',NULL),(80,'Surigao del Norte',NULL),(81,'Surigao del Sur',NULL),(82,'Dinagat Islands',NULL);
/*!40000 ALTER TABLE `tblprovince` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblrole`
--

DROP TABLE IF EXISTS `tblrole`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblrole` (
  `ROLE_ID` varchar(50) NOT NULL,
  `ROLE` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(200) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ROLE_ID`),
  KEY `role_index` (`ROLE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblrole`
--

LOCK TABLES `tblrole` WRITE;
/*!40000 ALTER TABLE `tblrole` DISABLE KEYS */;
INSERT INTO `tblrole` VALUES ('RL-1','Super Administrator','Role for super administrator.','TL-82','UPD->ADMIN->2022-02-08 04:16:38'),('RL-10','General Manager','Role for general managers.','TL-468','INS->ADMIN->2022-02-08 04:18:40'),('RL-2','Human Resources','Role for human resources.','TL-460','INS->ADMIN->2022-02-08 04:16:09'),('RL-3','Employee','Role for employees.','TL-461','INS->ADMIN->2022-02-08 04:16:26'),('RL-4','Guard','Role for guards.','TL-462','UPD->ADMIN->2022-02-08 04:17:13'),('RL-5','Department Head','Role for department heads.','TL-463','INS->ADMIN->2022-02-08 04:17:09'),('RL-6','Finance','Role for finance.','TL-464','INS->ADMIN->2022-02-08 04:17:30'),('RL-7','President','Role for presidents.','TL-465','INS->ADMIN->2022-02-08 04:17:44'),('RL-8','Supervisor','Role for supervisors.','TL-466','INS->ADMIN->2022-02-08 04:18:01'),('RL-9','CRECOM','Role for CRECOM members.','TL-467','INS->ADMIN->2022-02-08 04:18:21');
/*!40000 ALTER TABLE `tblrole` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblrolepermission`
--

DROP TABLE IF EXISTS `tblrolepermission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblrolepermission` (
  `ROLE_ID` varchar(50) NOT NULL,
  `PERMISSION_ID` int(20) NOT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  KEY `role_permission_index` (`ROLE_ID`,`PERMISSION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblrolepermission`
--

LOCK TABLES `tblrolepermission` WRITE;
/*!40000 ALTER TABLE `tblrolepermission` DISABLE KEYS */;
INSERT INTO `tblrolepermission` VALUES ('ROLE1',32,'INS->ADMIN->2022-01-03 01:50:33'),('ROLE1',33,'INS->ADMIN->2022-01-03 01:50:33'),('ROLE1',24,'INS->ADMIN->2022-01-03 01:50:33'),('ROLE1',25,'INS->ADMIN->2022-01-03 01:50:33'),('ROLE1',44,'INS->ADMIN->2022-01-03 01:50:33'),('ROLE1',45,'INS->ADMIN->2022-01-03 01:50:33'),('ROLE1',46,'INS->ADMIN->2022-01-03 01:50:33'),('ROLE1',47,'INS->ADMIN->2022-01-03 01:50:33'),('ROLE1',34,'INS->ADMIN->2022-01-03 01:50:33'),('ROLE1',35,'INS->ADMIN->2022-01-03 01:50:33'),('ROLE1',1,'INS->ADMIN->2022-01-03 01:50:33'),('ROLE1',36,'INS->ADMIN->2022-01-03 01:50:33'),('ROLE1',37,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',38,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',39,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',40,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',41,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',42,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',43,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',26,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',27,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',28,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',29,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',30,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',31,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',6,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',7,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',8,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',9,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',2,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',3,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',4,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',5,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',18,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',19,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',20,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',21,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',22,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',23,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',10,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',11,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',12,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',13,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',14,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',15,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',16,'INS->ADMIN->2022-01-03 01:50:34'),('ROLE1',17,'INS->ADMIN->2022-01-03 01:50:35'),('ROLE2',32,'INS->ADMIN->2022-01-03 01:51:43'),('ROLE2',33,'INS->ADMIN->2022-01-03 01:51:43'),('ROLE2',24,'INS->ADMIN->2022-01-03 01:51:43'),('ROLE2',25,'INS->ADMIN->2022-01-03 01:51:43'),('ROLE2',44,'INS->ADMIN->2022-01-03 01:51:43'),('ROLE2',45,'INS->ADMIN->2022-01-03 01:51:43'),('ROLE2',46,'INS->ADMIN->2022-01-03 01:51:43'),('ROLE2',47,'INS->ADMIN->2022-01-03 01:51:43'),('ROLE2',34,'INS->ADMIN->2022-01-03 01:51:43'),('ROLE2',35,'INS->ADMIN->2022-01-03 01:51:43'),('ROLE2',1,'INS->ADMIN->2022-01-03 01:51:43'),('ROLE2',36,'INS->ADMIN->2022-01-03 01:51:43'),('ROLE2',37,'INS->ADMIN->2022-01-03 01:51:43'),('ROLE2',38,'INS->ADMIN->2022-01-03 01:51:43'),('ROLE2',39,'INS->ADMIN->2022-01-03 01:51:43'),('ROLE2',40,'INS->ADMIN->2022-01-03 01:51:43'),('ROLE2',41,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',42,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',43,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',26,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',27,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',28,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',29,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',30,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',31,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',6,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',7,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',8,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',9,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',2,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',3,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',4,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',5,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',18,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',19,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',20,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',21,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',22,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',23,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',10,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',11,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',12,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',13,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',14,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',15,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',16,'INS->ADMIN->2022-01-03 01:51:44'),('ROLE2',17,'INS->ADMIN->2022-01-03 01:51:44'),('RL-1',223,'INS->LDAGULTO->2022-04-19 03:04:49'),('RL-1',224,'INS->LDAGULTO->2022-04-19 03:04:49'),('RL-1',225,'INS->LDAGULTO->2022-04-19 03:04:49'),('RL-1',226,'INS->LDAGULTO->2022-04-19 03:04:49'),('RL-1',227,'INS->LDAGULTO->2022-04-19 03:04:49'),('RL-1',218,'INS->LDAGULTO->2022-04-19 03:04:49'),('RL-1',219,'INS->LDAGULTO->2022-04-19 03:04:49'),('RL-1',220,'INS->LDAGULTO->2022-04-19 03:04:49'),('RL-1',221,'INS->LDAGULTO->2022-04-19 03:04:49'),('RL-1',222,'INS->LDAGULTO->2022-04-19 03:04:49'),('RL-1',37,'INS->LDAGULTO->2022-04-19 03:04:49'),('RL-1',38,'INS->LDAGULTO->2022-04-19 03:04:49'),('RL-1',182,'INS->LDAGULTO->2022-04-19 03:04:49'),('RL-1',183,'INS->LDAGULTO->2022-04-19 03:04:49'),('RL-1',184,'INS->LDAGULTO->2022-04-19 03:04:49'),('RL-1',185,'INS->LDAGULTO->2022-04-19 03:04:49'),('RL-1',186,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',187,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',203,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',204,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',205,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',206,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',207,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',193,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',194,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',195,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',196,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',197,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',175,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',176,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',177,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',178,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',179,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',180,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',181,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',198,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',199,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',200,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',201,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',202,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',188,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',189,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',190,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',191,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',192,'INS->LDAGULTO->2022-04-19 03:04:50'),('RL-1',160,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',161,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',162,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',163,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',164,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',156,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',157,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',158,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',258,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',259,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',55,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',56,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',57,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',58,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',59,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',39,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',40,'INS->LDAGULTO->2022-04-19 03:04:51'),('RL-1',41,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',238,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',239,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',240,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',241,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',242,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',248,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',249,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',250,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',251,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',252,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',1,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',159,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',165,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',166,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',167,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',243,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',244,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',245,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',246,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',247,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',228,'INS->LDAGULTO->2022-04-19 03:04:52'),('RL-1',229,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',230,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',231,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',232,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',45,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',46,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',47,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',48,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',49,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',50,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',51,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',52,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',53,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',54,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',42,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',43,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',44,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',77,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',78,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',79,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',80,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',81,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',70,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',71,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',72,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',73,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',74,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',82,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',83,'INS->LDAGULTO->2022-04-19 03:04:53'),('RL-1',84,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',85,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',86,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',253,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',254,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',255,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',256,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',257,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',99,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',100,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',101,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',102,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',103,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',171,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',172,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',173,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',174,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',75,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',76,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',138,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',139,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',140,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',141,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',142,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',133,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',134,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',135,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',136,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',137,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',126,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',127,'INS->LDAGULTO->2022-04-19 03:04:54'),('RL-1',128,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',129,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',130,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',131,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',132,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',114,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',115,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',116,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',117,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',118,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',208,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',209,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',210,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',211,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',212,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',87,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',88,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',89,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',90,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',91,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',65,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',66,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',67,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',68,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',69,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',233,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',234,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',235,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',236,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',237,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',151,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',152,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',153,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',154,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',155,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',262,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',263,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',260,'INS->LDAGULTO->2022-04-19 03:04:55'),('RL-1',261,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',213,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',214,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',215,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',216,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',217,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',109,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',110,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',111,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',112,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',113,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',119,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',120,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',121,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',122,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',123,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',124,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',125,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',104,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',105,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',106,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',107,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',108,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',168,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',169,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',170,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',29,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',30,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',31,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',32,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',33,'INS->LDAGULTO->2022-04-19 03:04:56'),('RL-1',7,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',8,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',9,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',10,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',11,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',2,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',3,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',4,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',5,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',6,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',12,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',13,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',14,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',15,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',16,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',17,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',18,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',24,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',25,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',26,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',27,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',28,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',19,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',20,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',21,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',22,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',23,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',60,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',61,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',62,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',63,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',64,'INS->LDAGULTO->2022-04-19 03:04:57'),('RL-1',143,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',144,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',145,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',146,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',147,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',148,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',149,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',150,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',34,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',35,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',36,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',92,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',93,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',94,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',95,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',96,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',97,'INS->LDAGULTO->2022-04-19 03:04:58'),('RL-1',98,'INS->LDAGULTO->2022-04-19 03:04:58');
/*!40000 ALTER TABLE `tblrolepermission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblroleuser`
--

DROP TABLE IF EXISTS `tblroleuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblroleuser` (
  `ROLE_ID` varchar(50) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblroleuser`
--

LOCK TABLES `tblroleuser` WRITE;
/*!40000 ALTER TABLE `tblroleuser` DISABLE KEYS */;
INSERT INTO `tblroleuser` VALUES ('RL-1','ADMIN',NULL),('RL-1','LVMICAYAS','INS->ADMIN->2022-02-09 02:01:24'),('RL-1','GTBONITA','INS->ADMIN->2022-02-09 02:31:40'),('RL-3','KSVILLAR','INS->ADMIN->2022-02-09 02:32:18'),('RL-6','KSVILLAR','INS->ADMIN->2022-02-09 02:32:18'),('RL-1','LDAGULTO','INS->ADMIN->2022-02-09 05:22:25');
/*!40000 ALTER TABLE `tblroleuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsystemcode`
--

DROP TABLE IF EXISTS `tblsystemcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblsystemcode` (
  `SYSTEM_TYPE` varchar(20) NOT NULL,
  `SYSTEM_CODE` varchar(20) NOT NULL,
  `DESCRIPTION` varchar(100) NOT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  KEY `system_code_index` (`SYSTEM_TYPE`,`SYSTEM_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsystemcode`
--

LOCK TABLES `tblsystemcode` WRITE;
/*!40000 ALTER TABLE `tblsystemcode` DISABLE KEYS */;
INSERT INTO `tblsystemcode` VALUES ('SYSTYPE','SYSTYPE','System Type','TL-3',NULL),('SYSTYPE','MAILENCRYPTION','Mail Encryption','TL-85','INS->ADMIN->2022-01-03 04:05:06'),('MAILENCRYPTION','None','None','TL-86','INS->ADMIN->2022-01-03 04:05:16'),('MAILENCRYPTION','TLS','TLS','TL-87','INS->ADMIN->2022-01-03 04:05:35'),('MAILENCRYPTION','SSL','SSL','TL-88','INS->ADMIN->2022-01-03 04:05:41'),('MAILENCRYPTION','STARTTLS','STARTTLS','TL-89','INS->ADMIN->2022-01-03 04:07:42'),('SYSTYPE','FILETYPE','File Type','TL-135','INS->ADMIN->2022-01-05 10:44:52'),('FILETYPE','doc','Word (.doc)','TL-136','INS->ADMIN->2022-01-05 10:47:34'),('FILETYPE','docx','Word (.docx)','TL-137','INS->ADMIN->2022-01-05 10:47:41'),('FILETYPE','xls','Excel (.xls)','TL-138','INS->ADMIN->2022-01-05 10:48:04'),('FILETYPE','xlsx','Excel (.xlsx)','TL-139','INS->ADMIN->2022-01-05 10:48:14'),('FILETYPE','ppt','Powerpoint (.ppt)','TL-140','INS->ADMIN->2022-01-05 10:48:33'),('FILETYPE','pptx','Powerpoint (.pptx)','TL-141','INS->ADMIN->2022-01-05 10:48:44'),('FILETYPE','zip','Compressed (.zip)','TL-142','INS->ADMIN->2022-01-05 10:49:22'),('FILETYPE','7z','Compressed (.7z)','TL-143','INS->ADMIN->2022-01-05 10:49:32'),('FILETYPE','rar','Compressed (.rar)','TL-144','INS->ADMIN->2022-01-05 10:49:40'),('FILETYPE','pdf','Document (.pdf)','TL-145','INS->ADMIN->2022-01-05 10:50:00'),('FILETYPE','txt','Document (.txt)','TL-146','INS->ADMIN->2022-01-05 10:50:15'),('FILETYPE','csv','Data (.csv)','TL-147','UPD->ADMIN->2022-01-05 10:53:40'),('FILETYPE','mp3','Audio (.mp3)','TL-148','INS->ADMIN->2022-01-05 10:52:38'),('FILETYPE','wav','Audio (.wav)','TL-149','INS->ADMIN->2022-01-05 10:52:57'),('FILETYPE','sql','Data (.sql)','TL-150','INS->ADMIN->2022-01-05 10:53:52'),('FILETYPE','db','Data (.db)','TL-151','INS->ADMIN->2022-01-05 10:54:14'),('FILETYPE','dbf','Data (.dbf)','TL-152','INS->ADMIN->2022-01-05 10:54:33'),('FILETYPE','gif','Image (.gif)','TL-153','INS->ADMIN->2022-01-05 10:55:08'),('FILETYPE','.ico','Image (.ico)','TL-154','INS->ADMIN->2022-01-05 10:55:20'),('FILETYPE','jpeg','Image (.jpeg)','TL-155','INS->ADMIN->2022-01-05 11:07:24'),('FILETYPE','jpg','Image (.jpg)','TL-156','INS->ADMIN->2022-01-05 11:07:36'),('FILETYPE','png','Image (.png)','TL-157','INS->ADMIN->2022-01-05 11:08:03'),('FILETYPE','svg','Image (.svg)','TL-158','INS->ADMIN->2022-01-05 11:08:18'),('FILETYPE','mp4','Video (.mp4)','TL-159','INS->ADMIN->2022-01-05 11:09:34'),('FILETYPE','mkv','Video (.mkv)','TL-160','INS->ADMIN->2022-01-05 11:09:49'),('FILETYPE','mov','Video (.mov)','TL-161','INS->ADMIN->2022-01-05 11:10:02'),('FILETYPE','mpg','Video (.mpg)','TL-162','INS->ADMIN->2022-01-05 11:10:16'),('FILETYPE','mpeg','Video (.mpeg)','TL-163','INS->ADMIN->2022-01-05 11:10:29'),('FILETYPE','wmv','Video (.wmv)','TL-164','INS->ADMIN->2022-01-05 11:10:42'),('FILETYPE','avi','Video (.avi)','TL-165','INS->ADMIN->2022-01-05 11:10:57'),('FILETYPE','flv','Video (.flv)','TL-166','INS->ADMIN->2022-01-05 11:11:09'),('SYSTYPE','COLORVALUE','Color Value','TL-183','INS->ADMIN->2022-01-10 10:12:43'),('COLORVALUE','primary','Primary','TL-184','INS->ADMIN->2022-01-10 10:13:01'),('COLORVALUE','secondary','Secondary','TL-185','INS->ADMIN->2022-01-10 10:13:10'),('COLORVALUE','success','Success','TL-186','INS->ADMIN->2022-01-10 10:13:18'),('COLORVALUE','info','Info','TL-187','INS->ADMIN->2022-01-10 10:13:26'),('COLORVALUE','warning','Warning','TL-188','UPD->ADMIN->2022-01-10 10:13:39'),('COLORVALUE','danger','Danger','TL-189','INS->ADMIN->2022-01-10 10:13:54'),('COLORVALUE','dark','Dark','TL-190','INS->ADMIN->2022-01-10 10:14:08'),('COLORVALUE','light','Light','TL-191','INS->ADMIN->2022-01-10 10:14:18'),('SYSTYPE','SUFFIX','Suffix','TL-203','INS->ADMIN->2022-01-11 08:48:51'),('SUFFIX','JR','Jr.','TL-204','INS->ADMIN->2022-01-11 08:49:03'),('SUFFIX','SR','Sr.','TL-205','INS->ADMIN->2022-01-11 08:49:09'),('SUFFIX','I','I','TL-206','INS->ADMIN->2022-01-11 08:49:15'),('SUFFIX','II','II','TL-207','INS->ADMIN->2022-01-11 08:49:20'),('SUFFIX','III','III','TL-208','INS->ADMIN->2022-01-11 08:49:26'),('SYSTYPE','GENDER','Gender','TL-262','INS->ADMIN->2022-01-15 09:03:48'),('GENDER','MALE','Male','TL-263','INS->ADMIN->2022-01-15 09:03:56'),('GENDER','FEMALE','Female','TL-264','INS->ADMIN->2022-01-15 09:04:22'),('SYSTYPE','RELATIONSHIP','Relationship','TL-266','INS->ADMIN->2022-01-16 03:11:52'),('RELATIONSHIP','MOTHER','Mother','TL-267','INS->ADMIN->2022-01-16 03:12:00'),('RELATIONSHIP','FATHER','Father','TL-268','INS->ADMIN->2022-01-16 03:12:12'),('RELATIONSHIP','SISTER','Sister','TL-269','INS->ADMIN->2022-01-16 03:12:28'),('RELATIONSHIP','BROTHER','Brother','TL-270','INS->ADMIN->2022-01-16 03:12:39'),('RELATIONSHIP','GRANDMOTHER','Grand Mother','TL-271','INS->ADMIN->2022-01-16 03:12:55'),('RELATIONSHIP','GRANDFATHER','Grand Father','TL-272','INS->ADMIN->2022-01-16 03:13:10'),('RELATIONSHIP','HUSBAND','Husband','TL-273','INS->ADMIN->2022-01-16 03:13:19'),('RELATIONSHIP','WIFE','Wife','TL-274','INS->ADMIN->2022-01-16 03:13:27'),('RELATIONSHIP','SON','Son','TL-275','INS->ADMIN->2022-01-16 03:13:35'),('RELATIONSHIP','DAUGTHER','Daughter','TL-276','INS->ADMIN->2022-01-16 03:13:48'),('RELATIONSHIP','GRANDSON','Grand Son','TL-277','INS->ADMIN->2022-01-16 03:13:58'),('RELATIONSHIP','GRANDDAUGHTER','Grand Daughter','TL-278','INS->ADMIN->2022-01-16 03:14:21'),('RELATIONSHIP','FRIEND','Friend','TL-279','INS->ADMIN->2022-01-16 03:14:31'),('SYSTYPE','ADDRESSTYPE','Address Type','TL-295','INS->ADMIN->2022-01-17 11:03:52'),('ADDRESSTYPE','PERMANENT','Permanent','TL-296','INS->ADMIN->2022-01-17 11:04:00'),('ADDRESSTYPE','CURRENT','Current','TL-297','INS->ADMIN->2022-01-17 11:04:08'),('SYSTYPE','SOCIAL','Social','TL-299','INS->ADMIN->2022-01-17 01:02:20'),('SOCIAL','FACEBOOK','Facebook','TL-300','INS->ADMIN->2022-01-17 01:02:29'),('SOCIAL','TWITTER','Twitter','TL-301','INS->ADMIN->2022-01-17 01:02:39'),('SOCIAL','LINKEDIN','LinkedIn','TL-302','INS->ADMIN->2022-01-17 01:02:49'),('SOCIAL','INSTAGRAM','Instagram','TL-303','INS->ADMIN->2022-01-17 01:03:00'),('SYSTYPE','WORKSHIFT','Work Shift','TL-319','INS->ADMIN->2022-01-18 11:23:04'),('WORKSHIFT','REGULAR','Regular','TL-320','INS->ADMIN->2022-01-18 11:23:11'),('WORKSHIFT','SCHEDULED','Scheduled','TL-321','INS->ADMIN->2022-01-18 11:25:10'),('SYSTYPE','PAIDSTATUS','Paid Status','TL-340','INS->ADMIN->2022-01-27 10:20:17'),('PAIDSTATUS','PAID','Paid','TL-341','INS->ADMIN->2022-01-27 10:20:23'),('PAIDSTATUS','UNPAID','Unpaid','TL-342','INS->ADMIN->2022-01-27 10:20:34'),('SYSTYPE','LEAVEDURATION','Leave Duration','TL-390','INS->ADMIN->2022-01-28 09:28:03'),('LEAVEDURATION','SINGLE','Single','TL-391','INS->ADMIN->2022-01-28 09:28:49'),('LEAVEDURATION','MULTIPLE','Multiple','TL-392','INS->ADMIN->2022-01-28 09:28:58'),('LEAVEDURATION','HLFDAYMOR','Half Day (Morning)','TL-393','INS->ADMIN->2022-01-28 09:29:12'),('LEAVEDURATION','CUSTOM','Custom','TL-394','INS->ADMIN->2022-01-28 09:29:20'),('LEAVEDURATION','HLFDAYAFT','Half Day (Afternoon)','TL-395','INS->ADMIN->2022-01-28 09:29:35'),('SYSTYPE','FILECATEGORY','File Category','TL-438','INS->ADMIN->2022-02-02 11:53:57'),('FILECATEGORY','COMMENDATION','Commendation','TL-439','INS->ADMIN->2022-02-02 11:54:29'),('FILECATEGORY','PAYSLIP','Pay Slip','TL-440','INS->ADMIN->2022-02-02 11:54:39'),('SYSTYPE','HOLIDAYTYPE','Holiday Type','TL-496','INS->LDAGULTO->2022-02-10 02:24:07'),('HOLIDAYTYPE','SPCWORKHOL','Special Working Holiday','TL-497','INS->LDAGULTO->2022-02-10 02:25:27'),('HOLIDAYTYPE','LOCHOL','Local Holiday','TL-498','INS->LDAGULTO->2022-02-10 02:25:39'),('HOLIDAYTYPE','SPCNONWORKHOL','Special Non-working Holiday','TL-499','INS->LDAGULTO->2022-02-10 02:25:51'),('HOLIDAYTYPE','REGHOL','Regular Holiday','TL-500','INS->LDAGULTO->2022-02-10 02:26:03'),('SYSTYPE','LVAPVSTAT','Leave Approval Status','TL-619','INS->LDAGULTO->2022-03-16 10:57:12'),('LVAPVSTAT','APV','Approved','TL-620','INS->LDAGULTO->2022-03-16 10:57:23'),('LVAPVSTAT','APVSYS','Approved (System Generated)','TL-621','INS->LDAGULTO->2022-03-16 10:57:36'),('LVAPVSTAT','CAN','Cancelled','TL-622','INS->LDAGULTO->2022-03-16 10:57:44'),('LVAPVSTAT','PEN','Pending','TL-623','INS->LDAGULTO->2022-03-16 10:57:53'),('LVAPVSTAT','REJ','Rejected','TL-624','INS->LDAGULTO->2022-03-16 10:58:04'),('SYSTYPE','RECURRENCEPATTERN','Recurrence Pattern','TL-811','INS->LDAGULTO->2022-04-06 10:02:42'),('RECURRENCEPATTERN','MONTHLY','Monthly','TL-812','INS->LDAGULTO->2022-04-06 10:02:57'),('RECURRENCEPATTERN','DAILY','Daily','TL-813','INS->LDAGULTO->2022-04-06 10:03:06'),('RECURRENCEPATTERN','WEEKLY','Weekly','TL-814','INS->LDAGULTO->2022-04-06 10:03:17'),('RECURRENCEPATTERN','BIWEEKLY','Bi-Weekly','TL-815','INS->LDAGULTO->2022-04-06 10:03:29'),('RECURRENCEPATTERN','QUARTERLY','Quarterly','TL-816','INS->LDAGULTO->2022-04-06 10:03:48'),('RECURRENCEPATTERN','YEARLY','Yearly','TL-817','INS->LDAGULTO->2022-04-06 10:03:58');
/*!40000 ALTER TABLE `tblsystemcode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsystemnotification`
--

DROP TABLE IF EXISTS `tblsystemnotification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblsystemnotification` (
  `NOTIFICATION_ID` int(50) DEFAULT NULL,
  `NOTIFICATION` varchar(5) NOT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  KEY `system_notification_index` (`NOTIFICATION_ID`,`NOTIFICATION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsystemnotification`
--

LOCK TABLES `tblsystemnotification` WRITE;
/*!40000 ALTER TABLE `tblsystemnotification` DISABLE KEYS */;
INSERT INTO `tblsystemnotification` VALUES (1,'S','INS->LDAGULTO->2022-03-30 04:43:43'),(1,'E','INS->LDAGULTO->2022-03-30 04:43:43'),(2,'S','INS->LDAGULTO->2022-03-30 04:43:43'),(2,'E','INS->LDAGULTO->2022-03-30 04:43:43'),(3,'S','INS->LDAGULTO->2022-03-30 04:43:43'),(3,'E','INS->LDAGULTO->2022-03-30 04:43:43'),(15,'S','INS->LDAGULTO->2022-03-30 04:43:43'),(15,'E','INS->LDAGULTO->2022-03-30 04:43:43'),(4,'S','INS->LDAGULTO->2022-03-30 04:43:43'),(4,'E','INS->LDAGULTO->2022-03-30 04:43:43'),(10,'S','INS->LDAGULTO->2022-03-30 04:43:43'),(10,'E','INS->LDAGULTO->2022-03-30 04:43:43'),(9,'S','INS->LDAGULTO->2022-03-30 04:43:43'),(9,'E','INS->LDAGULTO->2022-03-30 04:43:43'),(14,'S','INS->LDAGULTO->2022-03-30 04:43:43'),(14,'E','INS->LDAGULTO->2022-03-30 04:43:44'),(8,'S','INS->LDAGULTO->2022-03-30 04:43:44'),(8,'E','INS->LDAGULTO->2022-03-30 04:43:44'),(6,'S','INS->LDAGULTO->2022-03-30 04:43:44'),(6,'E','INS->LDAGULTO->2022-03-30 04:43:44'),(12,'S','INS->LDAGULTO->2022-03-30 04:43:44'),(12,'E','INS->LDAGULTO->2022-03-30 04:43:44'),(13,'S','INS->LDAGULTO->2022-03-30 04:43:44'),(13,'E','INS->LDAGULTO->2022-03-30 04:43:44'),(7,'S','INS->LDAGULTO->2022-03-30 04:43:44'),(7,'E','INS->LDAGULTO->2022-03-30 04:43:44'),(5,'S','INS->LDAGULTO->2022-03-30 04:43:44'),(5,'E','INS->LDAGULTO->2022-03-30 04:43:44'),(11,'S','INS->LDAGULTO->2022-03-30 04:43:44'),(11,'E','INS->LDAGULTO->2022-03-30 04:43:44'),(16,'S','INS->LDAGULTO->2022-03-30 04:43:44'),(16,'E','INS->LDAGULTO->2022-03-30 04:43:44'),(18,'S','INS->LDAGULTO->2022-03-30 04:43:44'),(18,'E','INS->LDAGULTO->2022-03-30 04:43:44'),(17,'S','INS->LDAGULTO->2022-03-30 04:43:44'),(17,'E','INS->LDAGULTO->2022-03-30 04:43:44');
/*!40000 ALTER TABLE `tblsystemnotification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsystemparameters`
--

DROP TABLE IF EXISTS `tblsystemparameters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblsystemparameters` (
  `PARAMETER_ID` int(11) NOT NULL,
  `PARAMETER_DESC` varchar(100) NOT NULL,
  `PARAMETER_EXTENSION` varchar(10) DEFAULT NULL,
  `PARAMETER_NUMBER` int(11) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) NOT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PARAMETER_ID`),
  KEY `system_parameters_index` (`PARAMETER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsystemparameters`
--

LOCK TABLES `tblsystemparameters` WRITE;
/*!40000 ALTER TABLE `tblsystemparameters` DISABLE KEYS */;
INSERT INTO `tblsystemparameters` VALUES (1,'System Parameter','',34,'TL-1','UPD->LDAGULTO->2022-04-13 10:52:32'),(2,'Transaction Log','TL-',1120,'TL-2','UPD->LDAGULTO->2022-04-19 04:30:41'),(3,'Policy','',56,'TL-4','UPD->LDAGULTO->2022-04-19 02:54:20'),(4,'Permission','',263,'TL-5','UPD->LDAGULTO->2022-04-19 02:54:46'),(5,'Role','RL-',10,'TL-6','UPD->ADMIN->2022-02-08 04:18:40'),(6,'Notification Type','',18,'TL-7','UPD->LDAGULTO->2022-03-30 04:28:03'),(7,'Department','DEPT-',8,'TL-91','UPD->ADMIN->2022-01-03 04:51:46'),(8,'Designation','DES-',18,'TL-92','UPD->LDAGULTO->2022-03-15 01:18:39'),(9,'Branch','BRCH-',3,'TL-93','UPD->ADMIN->2022-01-05 10:41:33'),(10,'Upload Setting','',13,'TL-126','UPD->LDAGULTO->2022-04-19 04:30:41'),(11,'Employment Status','',5,'TL-182','UPD->ADMIN->2022-01-16 03:03:23'),(12,'Employee ID','',55,'TL-209','UPD->LDAGULTO->2022-04-19 02:24:59'),(13,'Emergency Contact','',0,'TL-286','UPD->ADMIN->2022-01-17 10:52:33'),(14,'Employee Address','',0,'TL-294','UPD->ADMIN->2022-01-17 01:00:19'),(15,'Employee Social','',0,'TL-304','UPD->ADMIN->2022-01-17 01:43:00'),(16,'Work Shift','',7,'TL-323','UPD->LDAGULTO->2022-04-15 09:57:53'),(17,'Employee Attendance','',30,'TL-332','UPD->LDAGULTO->2022-04-16 03:35:29'),(18,'Leave Type','LEAVETP-',9,'TL-343','UPD->ADMIN->2022-01-27 01:10:03'),(19,'Leave Entitlement','LVENT-',1,'TL-360','UPD->ADMIN->2022-02-02 10:05:10'),(20,'Leave','LV-',76,'TL-389','UPD->LDAGULTO->2022-03-30 04:59:01'),(21,'Employee File','',1,'TL-437','UPD->LDAGULTO->2022-02-10 01:30:05'),(22,'Holiday','HOL-',9,'TL-495','UPD->LDAGULTO->2022-02-10 04:58:33'),(23,'Health Declaration','',1,'TL-537','UPD->LDAGULTO->2022-02-21 02:15:46'),(24,'Location','',1,'TL-542','UPD->LDAGULTO->2022-02-22 10:29:10'),(25,'Notification','',146,'TL-546','UPD->LDAGULTO->2022-04-16 03:35:29'),(26,'Attendance Creation','',24,'TL-579','UPD->LDAGULTO->2022-04-16 03:34:39'),(27,'Attendance Adjustment','',16,'TL-580','UPD->LDAGULTO->2022-04-15 07:58:45'),(28,'Allowance Type','',2,'TL-800','UPD->LDAGULTO->2022-04-05 10:53:55'),(29,'Allowance','',76,'TL-809','UPD->LDAGULTO->2022-04-11 09:15:01'),(30,'Deduction Type','',1,'TL-876','UPD->LDAGULTO->2022-04-06 05:31:30'),(31,'Government Contribution','',5,'TL-885','UPD->LDAGULTO->2022-04-13 11:45:46'),(32,'Contribution Bracket','',3,'TL-894','UPD->LDAGULTO->2022-04-09 06:05:55'),(33,'Deduction','',19,'TL-937','UPD->LDAGULTO->2022-04-13 10:44:22'),(34,'Contribution Deduction','',12,'TL-1074','UPD->LDAGULTO->2022-04-13 01:35:10');
/*!40000 ALTER TABLE `tblsystemparameters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltransactionlog`
--

DROP TABLE IF EXISTS `tbltransactionlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbltransactionlog` (
  `TRANSACTION_LOG_ID` varchar(500) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `LOG_TYPE` varchar(100) NOT NULL,
  `LOG_DATE` datetime NOT NULL,
  `LOG` varchar(4000) DEFAULT NULL,
  KEY `transaction_log_index` (`TRANSACTION_LOG_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltransactionlog`
--

LOCK TABLES `tbltransactionlog` WRITE;
/*!40000 ALTER TABLE `tbltransactionlog` DISABLE KEYS */;
INSERT INTO `tbltransactionlog` VALUES ('TL-4','ADMIN','Insert','2022-01-03 14:24:22','User ADMIN inserted system parameter (3).'),('TL-5','ADMIN','Insert','2022-01-03 14:24:26','User ADMIN inserted system parameter (4).'),('TL-6','ADMIN','Insert','2022-01-03 14:24:34','User ADMIN inserted system parameter (5).'),('TL-7','ADMIN','Insert','2022-01-03 14:25:15','User ADMIN inserted system parameter (6).'),('TL-8','ADMIN','Insert','2022-01-03 14:25:40','User ADMIN inserted policy (1).'),('TL-1','ADMIN','Insert','2022-01-03 08:30:00','User ADMIN inserted system parameter (1).'),('TL-2','ADMIN','Insert','2022-01-03 08:30:00','User ADMIN inserted system parameter (1).'),('TL-3','ADMIN','Insert','2022-01-03 08:30:00','User ADMIN inserted system code(SYSTYPE).'),('TL-9','ADMIN','Insert','2022-01-03 14:28:08','User ADMIN inserted policy (2).'),('TL-10','ADMIN','Insert','2022-01-03 14:28:21','User ADMIN inserted policy (3).'),('TL-11','ADMIN','Insert','2022-01-03 14:28:33','User ADMIN inserted policy (4).'),('TL-12','ADMIN','Insert','2022-01-03 14:29:02','User ADMIN inserted policy (5).'),('TL-13','ADMIN','Insert','2022-01-03 14:29:17','User ADMIN inserted policy (6).'),('TL-14','ADMIN','Insert','2022-01-03 14:29:28','User ADMIN inserted policy (7).'),('TL-15','ADMIN','Insert','2022-01-03 14:29:39','User ADMIN inserted policy (8).'),('TL-16','ADMIN','Insert','2022-01-03 14:30:20','User ADMIN inserted policy (9).'),('TL-17','ADMIN','Insert','2022-01-03 14:30:36','User ADMIN inserted policy (10).'),('TL-18','ADMIN','Insert','2022-01-03 14:30:50','User ADMIN inserted policy (11).'),('TL-19','ADMIN','Insert','2022-01-03 14:31:02','User ADMIN inserted policy (12).'),('TL-20','ADMIN','Insert','2022-01-03 14:31:13','User ADMIN inserted policy (13).'),('TL-21','ADMIN','Insert','2022-01-03 14:31:24','User ADMIN inserted policy (14).'),('TL-22','ADMIN','Insert','2022-01-03 14:31:35','User ADMIN inserted policy (15).'),('TL-23','ADMIN','Insert','2022-01-03 14:33:17','User ADMIN inserted permission (1).'),('TL-24','ADMIN','Insert','2022-01-03 14:33:36','User ADMIN inserted permission (2).'),('TL-25','ADMIN','Insert','2022-01-03 14:33:41','User ADMIN inserted permission (3).'),('TL-26','ADMIN','Insert','2022-01-03 14:33:46','User ADMIN inserted permission (4).'),('TL-27','ADMIN','Insert','2022-01-03 14:33:51','User ADMIN inserted permission (5).'),('TL-28','ADMIN','Insert','2022-01-03 14:34:02','User ADMIN inserted permission (6).'),('TL-29','ADMIN','Insert','2022-01-03 14:34:42','User ADMIN inserted permission (7).'),('TL-30','ADMIN','Insert','2022-01-03 14:34:47','User ADMIN inserted permission (8).'),('TL-31','ADMIN','Insert','2022-01-03 14:34:52','User ADMIN inserted permission (9).'),('TL-32','ADMIN','Insert','2022-01-03 14:35:43','User ADMIN inserted permission (10).'),('TL-33','ADMIN','Insert','2022-01-03 14:35:48','User ADMIN inserted permission (11).'),('TL-34','ADMIN','Insert','2022-01-03 14:35:52','User ADMIN inserted permission (12).'),('TL-35','ADMIN','Insert','2022-01-03 14:35:56','User ADMIN inserted permission (13).'),('TL-36','ADMIN','Insert','2022-01-03 14:36:09','User ADMIN inserted permission (14).'),('TL-37','ADMIN','Insert','2022-01-03 14:36:15','User ADMIN inserted permission (15).'),('TL-38','ADMIN','Insert','2022-01-03 14:36:36','User ADMIN inserted permission (16).'),('TL-39','ADMIN','Insert','2022-01-03 14:36:41','User ADMIN inserted permission (17).'),('TL-40','ADMIN','Insert','2022-01-03 14:36:47','User ADMIN inserted permission (18).'),('TL-41','ADMIN','Insert','2022-01-03 14:36:51','User ADMIN inserted permission (19).'),('TL-42','ADMIN','Insert','2022-01-03 14:37:07','User ADMIN inserted permission (20).'),('TL-43','ADMIN','Insert','2022-01-03 14:37:11','User ADMIN inserted permission (21).'),('TL-44','ADMIN','Insert','2022-01-03 14:37:18','User ADMIN inserted permission (22).'),('TL-45','ADMIN','Insert','2022-01-03 14:37:23','User ADMIN inserted permission (23).'),('TL-46','ADMIN','Insert','2022-01-03 14:37:40','User ADMIN inserted permission (24).'),('TL-47','ADMIN','Insert','2022-01-03 14:37:51','User ADMIN inserted permission (25).'),('TL-48','ADMIN','Insert','2022-01-03 14:37:59','User ADMIN inserted permission (26).'),('TL-49','ADMIN','Insert','2022-01-03 14:38:05','User ADMIN inserted permission (27).'),('TL-50','ADMIN','Insert','2022-01-03 14:38:30','User ADMIN inserted permission (28).'),('TL-51','ADMIN','Insert','2022-01-03 14:39:01','User ADMIN inserted permission (29).'),('TL-52','ADMIN','Insert','2022-01-03 14:39:19','User ADMIN inserted permission (30).'),('TL-53','ADMIN','Insert','2022-01-03 14:39:37','User ADMIN inserted permission (31).'),('TL-54','ADMIN','Insert','2022-01-03 14:40:30','User ADMIN inserted permission (32).'),('TL-55','ADMIN','Insert','2022-01-03 14:40:36','User ADMIN inserted permission (33).'),('TL-56','ADMIN','Insert','2022-01-03 14:40:54','User ADMIN inserted permission (34).'),('TL-57','ADMIN','Insert','2022-01-03 14:41:00','User ADMIN inserted permission (35).'),('TL-58','ADMIN','Insert','2022-01-03 14:41:18','User ADMIN inserted permission (36).'),('TL-59','ADMIN','Insert','2022-01-03 14:41:23','User ADMIN inserted permission (37).'),('TL-60','ADMIN','Insert','2022-01-03 14:41:27','User ADMIN inserted permission (38).'),('TL-61','ADMIN','Insert','2022-01-03 14:41:32','User ADMIN inserted permission (39).'),('TL-62','ADMIN','Insert','2022-01-03 14:41:43','User ADMIN inserted permission (40).'),('TL-63','ADMIN','Insert','2022-01-03 14:41:48','User ADMIN inserted permission (41).'),('TL-64','ADMIN','Insert','2022-01-03 14:42:08','User ADMIN inserted permission (42).'),('TL-65','ADMIN','Insert','2022-01-03 14:42:13','User ADMIN inserted permission (43).'),('TL-66','ADMIN','Insert','2022-01-03 14:42:26','User ADMIN inserted permission (44).'),('TL-67','ADMIN','Insert','2022-01-03 14:42:31','User ADMIN inserted permission (45).'),('TL-68','ADMIN','Insert','2022-01-03 14:42:37','User ADMIN inserted permission (46).'),('TL-69','ADMIN','Insert','2022-01-03 14:42:44','User ADMIN inserted permission (47).'),('TL-70','ADMIN','Insert','2022-01-03 15:33:36','User ADMIN inserted permission (48).'),('TL-71','ADMIN','Insert','2022-01-03 15:33:42','User ADMIN inserted permission (49).'),('TL-72','ADMIN','Insert','2022-01-03 15:33:55','User ADMIN inserted permission (50).'),('TL-73','ADMIN','Insert','2022-01-03 15:33:59','User ADMIN inserted permission (51).'),('TL-74','ADMIN','Insert','2022-01-03 15:34:05','User ADMIN inserted permission (52).'),('TL-75','ADMIN','Insert','2022-01-03 15:34:10','User ADMIN inserted permission (53).'),('TL-76','ADMIN','Insert','2022-01-03 15:34:15','User ADMIN inserted permission (54).'),('TL-77','ADMIN','Insert','2022-01-03 15:34:26','User ADMIN inserted permission (55).'),('TL-78','ADMIN','Insert','2022-01-03 15:34:31','User ADMIN inserted permission (56).'),('TL-79','ADMIN','Insert','2022-01-03 15:34:35','User ADMIN inserted permission (57).'),('TL-80','ADMIN','Insert','2022-01-03 15:34:39','User ADMIN inserted permission (58).'),('TL-81','ADMIN','Insert','2022-01-03 15:34:50','User ADMIN inserted permission (59).'),('TL-82','ADMIN','Insert','2022-01-03 15:37:37','User ADMIN inserted role (RL-1).'),('TL-82','ADMIN','Insert','2022-01-03 15:43:10','User ADMIN updated role permission (RL-1).'),('TL-83','ADMIN','Update','2022-01-03 16:03:37','User ADMIN updated login background.'),('TL-84','ADMIN','Update','2022-01-03 16:04:03','User ADMIN updated company setting (1).'),('TL-85','ADMIN','Insert','2022-01-03 16:05:06','User ADMIN inserted system code (MAILENCRYPTION).'),('TL-86','ADMIN','Insert','2022-01-03 16:05:16','User ADMIN inserted system code (None).'),('TL-87','ADMIN','Insert','2022-01-03 16:05:35','User ADMIN inserted system code (TLS).'),('TL-88','ADMIN','Insert','2022-01-03 16:05:41','User ADMIN inserted system code (SSL).'),('TL-89','ADMIN','Insert','2022-01-03 16:07:42','User ADMIN inserted system code (STARTTLS).'),('TL-90','ADMIN','Update','2022-01-03 16:10:25','User ADMIN updated email configuration (1).'),('TL-91','ADMIN','Insert','2022-01-03 16:25:06','User ADMIN inserted system parameter (7).'),('TL-92','ADMIN','Insert','2022-01-03 16:26:36','User ADMIN inserted system parameter (8).'),('TL-93','ADMIN','Insert','2022-01-03 16:27:08','User ADMIN inserted system parameter (9).'),('TL-94','ADMIN','Insert','2022-01-03 16:44:10','User ADMIN inserted department (DEPT-1).'),('TL-94','ADMIN','Update','2022-01-03 16:47:34','User ADMIN updated department (DEPT-1).'),('TL-95','ADMIN','Insert','2022-01-03 16:48:07','User ADMIN inserted department (DEPT-2).'),('TL-96','ADMIN','Insert','2022-01-03 16:48:19','User ADMIN inserted department (DEPT-3).'),('TL-97','ADMIN','Insert','2022-01-03 16:48:35','User ADMIN inserted department (DEPT-4).'),('TL-95','ADMIN','Update','2022-01-03 16:48:40','User ADMIN updated department (DEPT-2).'),('TL-98','ADMIN','Insert','2022-01-03 16:48:53','User ADMIN inserted department (DEPT-5).'),('TL-99','ADMIN','Insert','2022-01-03 16:49:02','User ADMIN inserted department (DEPT-6).'),('TL-100','ADMIN','Insert','2022-01-03 16:49:17','User ADMIN inserted department (DEPT-7).'),('TL-101','ADMIN','Insert','2022-01-03 16:51:47','User ADMIN inserted department (DEPT-8).'),('TL-102','Data Center Head','Insert','2022-01-04 13:56:14','User Data Center Head inserted designation (DES-1).'),('TL-92','ADMIN','Update','2022-01-04 14:13:42','User ADMIN updated system parameter (8).'),('TL-103','ADMIN','Insert','2022-01-04 14:14:56','User ADMIN inserted designation (DES-1).'),('TL-104','ADMIN','Insert','2022-01-04 14:15:08','User ADMIN inserted designation (DES-2).'),('TL-105','ADMIN','Insert','2022-01-04 14:15:15','User ADMIN inserted designation (DES-3).'),('TL-106','ADMIN','Insert','2022-01-04 14:16:24','User ADMIN inserted designation (DES-4).'),('TL-106','ADMIN','Update','2022-01-04 14:16:25','User ADMIN updated designation job description (DES-4).'),('TL-103','ADMIN','Delete','2022-01-04 14:16:43','User ADMIN deleted designation (DES-1).'),('TL-104','ADMIN','Delete','2022-01-04 14:16:43','User ADMIN deleted designation (DES-2).'),('TL-105','ADMIN','Delete','2022-01-04 14:16:43','User ADMIN deleted designation (DES-3).'),('TL-106','ADMIN','Delete','2022-01-04 14:16:43','User ADMIN deleted designation (DES-4).'),('TL-107','ADMIN','Insert','2022-01-04 14:19:10','User ADMIN inserted designation (DES-5).'),('TL-107','ADMIN','Update','2022-01-04 14:19:11','User ADMIN updated designation job description (DES-5).'),('TL-107','ADMIN','Delete','2022-01-04 14:19:14','User ADMIN deleted designation (DES-5).'),('TL-92','ADMIN','Update','2022-01-04 14:19:31','User ADMIN updated system parameter (8).'),('TL-108','ADMIN','Insert','2022-01-04 14:20:04','User ADMIN inserted designation (DES-1).'),('TL-109','ADMIN','Insert','2022-01-04 14:29:12','User ADMIN inserted designation (DES-2).'),('TL-110','ADMIN','Insert','2022-01-04 14:29:26','User ADMIN inserted designation (DES-3).'),('TL-111','ADMIN','Insert','2022-01-04 14:29:35','User ADMIN inserted designation (DES-4).'),('TL-112','ADMIN','Insert','2022-01-04 14:29:43','User ADMIN inserted designation (DES-5).'),('TL-113','ADMIN','Insert','2022-01-04 14:29:49','User ADMIN inserted designation (DES-6).'),('TL-114','ADMIN','Insert','2022-01-04 14:29:57','User ADMIN inserted designation (DES-7).'),('TL-115','ADMIN','Insert','2022-01-04 14:30:05','User ADMIN inserted designation (DES-8).'),('TL-116','ADMIN','Insert','2022-01-04 14:30:14','User ADMIN inserted designation (DES-9).'),('TL-117','ADMIN','Insert','2022-01-04 14:30:20','User ADMIN inserted designation (DES-10).'),('TL-118','ADMIN','Insert','2022-01-04 14:30:26','User ADMIN inserted designation (DES-11).'),('TL-119','ADMIN','Insert','2022-01-04 14:30:31','User ADMIN inserted designation (DES-12).'),('TL-120','ADMIN','Insert','2022-01-04 14:30:38','User ADMIN inserted designation (DES-13).'),('TL-121','ADMIN','Insert','2022-01-04 14:30:49','User ADMIN inserted designation (DES-14).'),('TL-122','ADMIN','Insert','2022-01-04 14:31:01','User ADMIN inserted designation (DES-15).'),('TL-123','ADMIN','Insert','2022-01-04 14:31:09','User ADMIN inserted designation (DES-16).'),('TL-124','ADMIN','Insert','2022-01-04 14:31:17','User ADMIN inserted designation (DES-17).'),('TL-114','ADMIN','Update','2022-01-05 09:16:24','User ADMIN updated designation (DES-7).'),('TL-125','ADMIN','Insert','2022-01-05 09:31:25','User ADMIN inserted branch (BRCH-1).'),('TL-125','ADMIN','Update','2022-01-05 09:31:32','User ADMIN updated branch (BRCH-1).'),('TL-114','ADMIN','Update','2022-01-05 09:45:19','User ADMIN updated designation job description (DES-7).'),('TL-114','ADMIN','Update','2022-01-05 09:45:19','User ADMIN updated designation (DES-7).'),('TL-126','ADMIN','Insert','2022-01-05 10:10:24','User ADMIN inserted system parameter (10).'),('TL-127','ADMIN','Insert','2022-01-05 10:12:04','User ADMIN inserted policy (16).'),('TL-126','ADMIN','Update','2022-01-05 10:12:36','User ADMIN updated system parameter (10).'),('TL-128','ADMIN','Insert','2022-01-05 10:13:05','User ADMIN inserted permission (60).'),('TL-129','ADMIN','Insert','2022-01-05 10:13:12','User ADMIN inserted permission (61).'),('TL-130','ADMIN','Insert','2022-01-05 10:13:19','User ADMIN inserted permission (62).'),('TL-131','ADMIN','Insert','2022-01-05 10:13:27','User ADMIN inserted permission (63).'),('TL-132','ADMIN','Insert','2022-01-05 10:13:34','User ADMIN inserted permission (64).'),('TL-82','ADMIN','Update','2022-01-05 10:28:56','User ADMIN updated role permission (RL-1).'),('TL-133','ADMIN','Insert','2022-01-05 10:41:22','User ADMIN inserted branch (BRCH-2).'),('TL-134','ADMIN','Insert','2022-01-05 10:41:33','User ADMIN inserted branch (BRCH-3).'),('TL-135','ADMIN','Insert','2022-01-05 10:44:52','User ADMIN inserted system code (FILETYPE).'),('TL-136','ADMIN','Insert','2022-01-05 10:47:34','User ADMIN inserted system code (doc).'),('TL-137','ADMIN','Insert','2022-01-05 10:47:42','User ADMIN inserted system code (docx).'),('TL-138','ADMIN','Insert','2022-01-05 10:48:04','User ADMIN inserted system code (xls).'),('TL-139','ADMIN','Insert','2022-01-05 10:48:15','User ADMIN inserted system code (xlsx).'),('TL-140','ADMIN','Insert','2022-01-05 10:48:33','User ADMIN inserted system code (ppt).'),('TL-141','ADMIN','Insert','2022-01-05 10:48:44','User ADMIN inserted system code (pptx).'),('TL-142','ADMIN','Insert','2022-01-05 10:49:22','User ADMIN inserted system code (zip).'),('TL-143','ADMIN','Insert','2022-01-05 10:49:32','User ADMIN inserted system code (7z).'),('TL-144','ADMIN','Insert','2022-01-05 10:49:40','User ADMIN inserted system code (rar).'),('TL-145','ADMIN','Insert','2022-01-05 10:50:00','User ADMIN inserted system code (pdf).'),('TL-146','ADMIN','Insert','2022-01-05 10:50:15','User ADMIN inserted system code (txt).'),('TL-147','ADMIN','Insert','2022-01-05 10:50:57','User ADMIN inserted system code (csv).'),('TL-147','ADMIN','Update','2022-01-05 10:51:09','User ADMIN updated system code (csv).'),('TL-148','ADMIN','Insert','2022-01-05 10:52:38','User ADMIN inserted system code (mp3).'),('TL-149','ADMIN','Insert','2022-01-05 10:52:57','User ADMIN inserted system code (wav).'),('TL-147','ADMIN','Update','2022-01-05 10:53:40','User ADMIN updated system code (csv).'),('TL-150','ADMIN','Insert','2022-01-05 10:53:52','User ADMIN inserted system code (sql).'),('TL-151','ADMIN','Insert','2022-01-05 10:54:14','User ADMIN inserted system code (db).'),('TL-152','ADMIN','Insert','2022-01-05 10:54:33','User ADMIN inserted system code (dbf).'),('TL-153','ADMIN','Insert','2022-01-05 10:55:08','User ADMIN inserted system code (gif).'),('TL-154','ADMIN','Insert','2022-01-05 10:55:20','User ADMIN inserted system code (.ico).'),('TL-155','ADMIN','Insert','2022-01-05 11:07:25','User ADMIN inserted system code (jpeg).'),('TL-156','ADMIN','Insert','2022-01-05 11:07:37','User ADMIN inserted system code (jpg).'),('TL-157','ADMIN','Insert','2022-01-05 11:08:03','User ADMIN inserted system code (png).'),('TL-158','ADMIN','Insert','2022-01-05 11:08:18','User ADMIN inserted system code (svg).'),('TL-159','ADMIN','Insert','2022-01-05 11:09:34','User ADMIN inserted system code (mp4).'),('TL-160','ADMIN','Insert','2022-01-05 11:09:49','User ADMIN inserted system code (mkv).'),('TL-161','ADMIN','Insert','2022-01-05 11:10:03','User ADMIN inserted system code (mov).'),('TL-162','ADMIN','Insert','2022-01-05 11:10:16','User ADMIN inserted system code (mpg).'),('TL-163','ADMIN','Insert','2022-01-05 11:10:29','User ADMIN inserted system code (mpeg).'),('TL-164','ADMIN','Insert','2022-01-05 11:10:42','User ADMIN inserted system code (wmv).'),('TL-165','ADMIN','Insert','2022-01-05 11:10:57','User ADMIN inserted system code (avi).'),('TL-166','ADMIN','Insert','2022-01-05 11:11:09','User ADMIN inserted system code (flv).'),('TL-126','ADMIN','Update','2022-01-06 10:35:17','User ADMIN updated system parameter (10).'),('TL-126','ADMIN','Update','2022-01-06 10:38:00','User ADMIN updated system parameter (10).'),('TL-167','ADMIN','Insert','2022-01-06 10:38:03','User ADMIN inserted upload setting (3).'),('TL-167','ADMIN','Delete','2022-01-06 11:17:33','User ADMIN deleted upload setting (3).'),('TL-167','ADMIN','Delete','2022-01-06 11:17:33','User ADMIN deleted upload setting (1).'),('TL-167','ADMIN','Delete','2022-01-06 11:17:33','User ADMIN deleted upload setting (2).'),('TL-126','ADMIN','Update','2022-01-06 11:17:41','User ADMIN updated system parameter (10).'),('TL-168','ADMIN','Insert','2022-01-06 11:18:39','User ADMIN inserted upload setting (1).'),('TL-169','ADMIN','Update','2022-01-06 11:38:01','User ADMIN updated upload setting ().'),('TL-168','ADMIN','Update','2022-01-06 11:38:20','User ADMIN updated upload setting (1).'),('TL-170','ADMIN','Insert','2022-01-06 11:47:55','User ADMIN inserted upload setting (2).'),('TL-171','ADMIN','Insert','2022-01-06 11:48:17','User ADMIN inserted upload setting (3).'),('TL-172','ADMIN','Insert','2022-01-06 11:49:57','User ADMIN inserted upload setting (4).'),('TL-173','ADMIN','Insert','2022-01-06 11:50:27','User ADMIN inserted upload setting (5).'),('TL-174','ADMIN','Insert','2022-01-06 11:50:59','User ADMIN inserted upload setting (6).'),('TL-175','ADMIN','Insert','2022-01-06 11:56:11','User ADMIN inserted upload setting (7).'),('TL-83','ADMIN','Update','2022-01-06 15:31:25','User ADMIN updated login background.'),('TL-83','ADMIN','Update','2022-01-06 15:31:52','User ADMIN updated login background.'),('TL-176','ADMIN','Insert','2022-01-10 09:58:50','User ADMIN inserted policy (17).'),('TL-177','ADMIN','Insert','2022-01-10 10:02:53','User ADMIN inserted permission (65).'),('TL-178','ADMIN','Insert','2022-01-10 10:02:58','User ADMIN inserted permission (66).'),('TL-179','ADMIN','Insert','2022-01-10 10:03:05','User ADMIN inserted permission (67).'),('TL-180','ADMIN','Insert','2022-01-10 10:03:20','User ADMIN inserted permission (68).'),('TL-181','ADMIN','Insert','2022-01-10 10:03:35','User ADMIN inserted permission (69).'),('TL-182','ADMIN','Insert','2022-01-10 10:07:50','User ADMIN inserted system parameter (11).'),('TL-82','ADMIN','Update','2022-01-10 10:08:07','User ADMIN updated role permission (RL-1).'),('TL-183','ADMIN','Insert','2022-01-10 10:12:44','User ADMIN inserted system code (COLORVALUE).'),('TL-184','ADMIN','Insert','2022-01-10 10:13:01','User ADMIN inserted system code (primary).'),('TL-185','ADMIN','Insert','2022-01-10 10:13:11','User ADMIN inserted system code (secondary).'),('TL-186','ADMIN','Insert','2022-01-10 10:13:18','User ADMIN inserted system code (success).'),('TL-187','ADMIN','Insert','2022-01-10 10:13:26','User ADMIN inserted system code (info).'),('TL-188','ADMIN','Insert','2022-01-10 10:13:33','User ADMIN inserted system code (warning).'),('TL-188','ADMIN','Update','2022-01-10 10:13:39','User ADMIN updated system code (warning).'),('TL-189','ADMIN','Insert','2022-01-10 10:13:54','User ADMIN inserted system code (danger).'),('TL-190','ADMIN','Insert','2022-01-10 10:14:08','User ADMIN inserted system code (dark).'),('TL-191','ADMIN','Insert','2022-01-10 10:14:18','User ADMIN inserted system code (light).'),('TL-192','ADMIN','Insert','2022-01-10 11:21:36','User ADMIN inserted employment status (1).'),('TL-192','ADMIN','Update','2022-01-10 11:21:41','User ADMIN updated employment status (1).'),('TL-192','ADMIN','Update','2022-01-10 11:21:47','User ADMIN updated employment status (1).'),('TL-182','ADMIN','Update','2022-01-10 11:23:03','User ADMIN updated system parameter (11).'),('TL-193','ADMIN','Insert','2022-01-10 11:23:37','User ADMIN inserted employment status (1).'),('TL-194','ADMIN','Insert','2022-01-10 11:23:59','User ADMIN inserted employment status (2).'),('TL-193','ADMIN','Update','2022-01-10 11:24:22','User ADMIN updated employment status (1).'),('TL-194','ADMIN','Update','2022-01-10 11:24:29','User ADMIN updated employment status (2).'),('TL-195','ADMIN','Insert','2022-01-10 11:24:53','User ADMIN inserted employment status (3).'),('TL-196','ADMIN','Insert','2022-01-10 11:25:25','User ADMIN inserted employment status (4).'),('TL-197','ADMIN','Insert','2022-01-10 11:34:32','User ADMIN inserted policy (18).'),('TL-198','ADMIN','Insert','2022-01-10 11:34:43','User ADMIN inserted permission (70).'),('TL-199','ADMIN','Insert','2022-01-10 11:34:50','User ADMIN inserted permission (71).'),('TL-200','ADMIN','Insert','2022-01-10 11:34:55','User ADMIN inserted permission (72).'),('TL-201','ADMIN','Insert','2022-01-10 11:35:01','User ADMIN inserted permission (73).'),('TL-202','ADMIN','Insert','2022-01-10 11:35:08','User ADMIN inserted permission (74).'),('TL-82','ADMIN','Update','2022-01-10 11:37:24','User ADMIN updated role permission (RL-1).'),('TL-197','ADMIN','Update','2022-01-10 11:37:40','User ADMIN updated policy (18).'),('TL-82','ADMIN','Update','2022-01-10 13:20:47','User ADMIN updated role permission (RL-1).'),('TL-94','ADMIN','Update','2022-01-10 15:05:43','User ADMIN updated department (DEPT-1).'),('TL-94','ADMIN','Update','2022-01-10 15:07:48','User ADMIN updated department (DEPT-1).'),('TL-203','ADMIN','Insert','2022-01-11 08:48:51','User ADMIN inserted system code (SUFFIX).'),('TL-204','ADMIN','Insert','2022-01-11 08:49:03','User ADMIN inserted system code (JR).'),('TL-205','ADMIN','Insert','2022-01-11 08:49:09','User ADMIN inserted system code (SR).'),('TL-206','ADMIN','Insert','2022-01-11 08:49:15','User ADMIN inserted system code (I).'),('TL-207','ADMIN','Insert','2022-01-11 08:49:20','User ADMIN inserted system code (II).'),('TL-208','ADMIN','Insert','2022-01-11 08:49:26','User ADMIN inserted system code (III).'),('TL-209','ADMIN','Insert','2022-01-12 10:12:18','User ADMIN inserted system parameter (12).'),('TL-209','ADMIN','Update','2022-01-12 13:45:01','User ADMIN updated system parameter (12).'),('TL-210','ADMIN','Insert','2022-01-12 13:45:54','User ADMIN inserted employee (2).'),('TL-210','ADMIN','Update','2022-01-12 16:15:40','User ADMIN updated employee (2).'),('TL-210','ADMIN','Delete','2022-01-12 16:29:25','User ADMIN deleted employee (2).'),('TL-195','ADMIN','Delete','2022-01-12 16:33:09','User ADMIN deleted employment status (3).'),('TL-196','ADMIN','Delete','2022-01-12 16:33:10','User ADMIN deleted employment status (4).'),('TL-193','ADMIN','Delete','2022-01-12 16:33:10','User ADMIN deleted employment status (1).'),('TL-182','ADMIN','Update','2022-01-12 16:34:05','User ADMIN updated system parameter (11).'),('TL-211','ADMIN','Insert','2022-01-12 16:34:35','User ADMIN inserted employment status (1).'),('TL-212','ADMIN','Insert','2022-01-12 16:34:55','User ADMIN inserted employment status (2).'),('TL-213','ADMIN','Insert','2022-01-12 16:35:27','User ADMIN inserted employment status (3).'),('TL-214','ADMIN','Insert','2022-01-12 16:35:36','User ADMIN inserted employment status (4).'),('TL-210','ADMIN','Update','2022-01-12 16:35:48','User ADMIN updated employee (2).'),('TL-210','ADMIN','Delete','2022-01-12 16:35:53','User ADMIN deleted employee (2).'),('TL-209','ADMIN','Update','2022-01-12 16:36:07','User ADMIN updated system parameter (12).'),('TL-209','ADMIN','Update','2022-01-12 16:36:12','User ADMIN updated system parameter (12).'),('TL-215','ADMIN','Insert','2022-01-12 17:04:42','User ADMIN inserted employee (2).'),('TL-216','ADMIN','Insert','2022-01-14 14:39:04','User ADMIN inserted employee (3).'),('TL-217','ADMIN','Insert','2022-01-14 14:40:04','User ADMIN inserted employee (4).'),('TL-218','ADMIN','Insert','2022-01-14 14:40:39','User ADMIN inserted employee (5).'),('TL-219','ADMIN','Insert','2022-01-14 14:41:12','User ADMIN inserted employee (6).'),('TL-220','ADMIN','Insert','2022-01-14 14:42:03','User ADMIN inserted employee (7).'),('TL-221','ADMIN','Insert','2022-01-14 14:45:44','User ADMIN inserted employee (8).'),('TL-221','ADMIN','Update','2022-01-14 14:45:51','User ADMIN updated employee (8).'),('TL-222','ADMIN','Insert','2022-01-14 14:47:06','User ADMIN inserted employee (9).'),('TL-223','ADMIN','Insert','2022-01-14 14:47:45','User ADMIN inserted employee (10).'),('TL-224','ADMIN','Insert','2022-01-14 14:48:22','User ADMIN inserted employee (11).'),('TL-224','ADMIN','Update','2022-01-14 14:48:33','User ADMIN updated employee (11).'),('TL-225','ADMIN','Insert','2022-01-14 14:49:19','User ADMIN inserted employee (12).'),('TL-226','ADMIN','Insert','2022-01-14 14:50:21','User ADMIN inserted employee (13).'),('TL-227','ADMIN','Insert','2022-01-14 14:51:25','User ADMIN inserted employee (14).'),('TL-228','ADMIN','Insert','2022-01-14 14:51:57','User ADMIN inserted employee (15).'),('TL-229','ADMIN','Insert','2022-01-14 14:52:35','User ADMIN inserted employee (16).'),('TL-230','ADMIN','Insert','2022-01-14 14:53:57','User ADMIN inserted employee (17).'),('TL-229','ADMIN','Update','2022-01-14 14:54:56','User ADMIN updated employee (16).'),('TL-229','ADMIN','Update','2022-01-14 14:55:02','User ADMIN updated employee (16).'),('TL-229','ADMIN','Update','2022-01-14 14:55:29','User ADMIN updated employee (16).'),('TL-212','ADMIN','Update','2022-01-14 14:55:52','User ADMIN updated employment status (2).'),('TL-213','ADMIN','Update','2022-01-14 14:55:55','User ADMIN updated employment status (3).'),('TL-209','ADMIN','Update','2022-01-14 14:56:16','User ADMIN updated system parameter (12).'),('TL-231','ADMIN','Insert','2022-01-14 14:57:12','User ADMIN inserted employee (19).'),('TL-231','ADMIN','Update','2022-01-14 14:57:47','User ADMIN updated employee (19).'),('TL-232','ADMIN','Insert','2022-01-14 14:58:37','User ADMIN inserted employee (20).'),('TL-233','ADMIN','Insert','2022-01-14 14:59:15','User ADMIN inserted employee (21).'),('TL-209','ADMIN','Update','2022-01-14 14:59:35','User ADMIN updated system parameter (12).'),('TL-234','ADMIN','Insert','2022-01-14 15:00:11','User ADMIN inserted employee (27).'),('TL-235','ADMIN','Insert','2022-01-14 15:01:30','User ADMIN inserted employee (28).'),('TL-236','ADMIN','Insert','2022-01-14 15:01:59','User ADMIN inserted employee (29).'),('TL-209','ADMIN','Update','2022-01-14 15:02:13','User ADMIN updated system parameter (12).'),('TL-237','ADMIN','Insert','2022-01-14 15:02:51','User ADMIN inserted employee (31).'),('TL-238','ADMIN','Insert','2022-01-14 15:03:31','User ADMIN inserted employee (32).'),('TL-239','ADMIN','Insert','2022-01-14 15:04:02','User ADMIN inserted employee (33).'),('TL-209','ADMIN','Update','2022-01-14 15:04:29','User ADMIN updated system parameter (12).'),('TL-240','ADMIN','Insert','2022-01-14 15:05:15','User ADMIN inserted employee (35).'),('TL-241','ADMIN','Insert','2022-01-14 15:05:56','User ADMIN inserted employee (36).'),('TL-242','ADMIN','Insert','2022-01-14 15:06:28','User ADMIN inserted employee (37).'),('TL-243','ADMIN','Insert','2022-01-14 15:07:04','User ADMIN inserted employee (38).'),('TL-244','ADMIN','Insert','2022-01-14 15:07:43','User ADMIN inserted employee (39).'),('TL-245','ADMIN','Insert','2022-01-14 15:08:27','User ADMIN inserted employee (40).'),('TL-246','ADMIN','Insert','2022-01-14 15:09:00','User ADMIN inserted employee (41).'),('TL-247','ADMIN','Insert','2022-01-14 15:10:45','User ADMIN inserted employee (42).'),('TL-248','ADMIN','Insert','2022-01-14 15:11:38','User ADMIN inserted employee (43).'),('TL-249','ADMIN','Insert','2022-01-14 15:12:25','User ADMIN inserted employee (44).'),('TL-250','ADMIN','Insert','2022-01-14 15:13:11','User ADMIN inserted employee (45).'),('TL-251','ADMIN','Insert','2022-01-14 15:13:45','User ADMIN inserted employee (46).'),('TL-252','ADMIN','Insert','2022-01-14 15:14:21','User ADMIN inserted employee (47).'),('TL-253','ADMIN','Insert','2022-01-14 15:14:53','User ADMIN inserted employee (48).'),('TL-254','ADMIN','Insert','2022-01-14 15:15:51','User ADMIN inserted employee (49).'),('TL-255','ADMIN','Insert','2022-01-14 15:16:33','User ADMIN inserted employee (50).'),('TL-256','ADMIN','Insert','2022-01-14 15:17:17','User ADMIN inserted employee (51).'),('TL-257','ADMIN','Insert','2022-01-14 15:17:51','User ADMIN inserted employee (52).'),('TL-258','ADMIN','Insert','2022-01-14 15:18:33','User ADMIN inserted employee (53).'),('TL-259','ADMIN','Insert','2022-01-14 15:39:53','User ADMIN inserted policy (19).'),('TL-260','ADMIN','Insert','2022-01-14 15:40:06','User ADMIN inserted permission (75).'),('TL-261','ADMIN','Insert','2022-01-14 15:40:17','User ADMIN inserted permission (76).'),('TL-82','ADMIN','Update','2022-01-14 15:44:18','User ADMIN updated role permission (RL-1).'),('TL-262','ADMIN','Insert','2022-01-15 09:03:48','User ADMIN inserted system code (GENDER).'),('TL-263','ADMIN','Insert','2022-01-15 09:03:56','User ADMIN inserted system code (MALE).'),('TL-264','ADMIN','Insert','2022-01-15 09:04:22','User ADMIN inserted system code (FEMALE).'),('TL-220','ADMIN','Update','2022-01-15 13:12:31','User ADMIN updated employee (7).'),('TL-220','ADMIN','Update','2022-01-15 18:05:54','User ADMIN updated employee (7).'),('TL-220','ADMIN','Update','2022-01-15 18:06:05','User ADMIN updated employee (7).'),('TL-265','ADMIN','Insert','2022-01-16 15:03:23','User ADMIN inserted employment status (5).'),('TL-266','ADMIN','Insert','2022-01-16 15:11:52','User ADMIN inserted system code (RELATIONSHIP).'),('TL-267','ADMIN','Insert','2022-01-16 15:12:00','User ADMIN inserted system code (MOTHER).'),('TL-268','ADMIN','Insert','2022-01-16 15:12:12','User ADMIN inserted system code (FATHER).'),('TL-269','ADMIN','Insert','2022-01-16 15:12:28','User ADMIN inserted system code (SISTER).'),('TL-270','ADMIN','Insert','2022-01-16 15:12:39','User ADMIN inserted system code (BROTHER).'),('TL-271','ADMIN','Insert','2022-01-16 15:12:55','User ADMIN inserted system code (GRANDMOTHER).'),('TL-272','ADMIN','Insert','2022-01-16 15:13:10','User ADMIN inserted system code (GRANDFATHER).'),('TL-273','ADMIN','Insert','2022-01-16 15:13:19','User ADMIN inserted system code (HUSBAND).'),('TL-274','ADMIN','Insert','2022-01-16 15:13:27','User ADMIN inserted system code (WIFE).'),('TL-275','ADMIN','Insert','2022-01-16 15:13:35','User ADMIN inserted system code (SON).'),('TL-276','ADMIN','Insert','2022-01-16 15:13:48','User ADMIN inserted system code (DAUGTHER).'),('TL-277','ADMIN','Insert','2022-01-16 15:13:58','User ADMIN inserted system code (GRANDSON).'),('TL-278','ADMIN','Insert','2022-01-16 15:14:21','User ADMIN inserted system code (GRANDDAUGHTER).'),('TL-279','ADMIN','Insert','2022-01-16 15:14:31','User ADMIN inserted system code (FRIEND).'),('TL-280','ADMIN','Insert','2022-01-16 15:26:26','User ADMIN inserted policy (20).'),('TL-281','ADMIN','Insert','2022-01-16 18:51:48','User ADMIN inserted permission (77).'),('TL-282','ADMIN','Insert','2022-01-16 18:51:55','User ADMIN inserted permission (78).'),('TL-283','ADMIN','Insert','2022-01-16 18:52:02','User ADMIN inserted permission (79).'),('TL-284','ADMIN','Insert','2022-01-16 18:52:18','User ADMIN inserted permission (80).'),('TL-285','ADMIN','Insert','2022-01-16 18:52:45','User ADMIN inserted permission (81).'),('TL-82','ADMIN','Update','2022-01-16 18:54:39','User ADMIN updated role permission (RL-1).'),('TL-286','ADMIN','Insert','2022-01-17 08:41:54','User ADMIN inserted system parameter (13).'),('TL-287','ADMIN','Insert','2022-01-17 10:50:06','User ADMIN inserted emergency contact (1).'),('TL-287','ADMIN','Update','2022-01-17 10:51:51','User ADMIN updated emergency contact (1).'),('TL-287','ADMIN','Delete','2022-01-17 10:52:04','User ADMIN deleted emergency contact ().'),('TL-286','ADMIN','Update','2022-01-17 10:52:33','User ADMIN updated system parameter (13).'),('TL-288','ADMIN','Insert','2022-01-17 10:57:14','User ADMIN inserted policy (21).'),('TL-289','ADMIN','Insert','2022-01-17 10:57:25','User ADMIN inserted permission (82).'),('TL-290','ADMIN','Insert','2022-01-17 10:57:31','User ADMIN inserted permission (83).'),('TL-291','ADMIN','Insert','2022-01-17 10:57:36','User ADMIN inserted permission (84).'),('TL-291','ADMIN','Update','2022-01-17 10:57:42','User ADMIN updated permission (84).'),('TL-292','ADMIN','Insert','2022-01-17 10:57:48','User ADMIN inserted permission (85).'),('TL-293','ADMIN','Insert','2022-01-17 10:57:54','User ADMIN inserted permission (86).'),('TL-82','ADMIN','Update','2022-01-17 11:00:43','User ADMIN updated role permission (RL-1).'),('TL-294','ADMIN','Insert','2022-01-17 11:01:27','User ADMIN inserted system parameter (14).'),('TL-295','ADMIN','Insert','2022-01-17 11:03:52','User ADMIN inserted system code (ADDRESSTYPE).'),('TL-296','ADMIN','Insert','2022-01-17 11:04:00','User ADMIN inserted system code (PERMANENT).'),('TL-297','ADMIN','Insert','2022-01-17 11:04:08','User ADMIN inserted system code (CURRENT).'),('TL-298','ADMIN','Insert','2022-01-17 11:47:52','User ADMIN inserted employee address (1).'),('TL-298','ADMIN','Update','2022-01-17 12:57:11','User ADMIN updated employee address (1).'),('TL-298','ADMIN','Update','2022-01-17 13:00:04','User ADMIN updated employee address (1).'),('TL-298','ADMIN','Delete','2022-01-17 13:00:07','User ADMIN deleted employee address (1).'),('TL-294','ADMIN','Update','2022-01-17 13:00:19','User ADMIN updated system parameter (14).'),('TL-299','ADMIN','Insert','2022-01-17 13:02:20','User ADMIN inserted system code (SOCIAL).'),('TL-300','ADMIN','Insert','2022-01-17 13:02:29','User ADMIN inserted system code (FACEBOOK).'),('TL-301','ADMIN','Insert','2022-01-17 13:02:39','User ADMIN inserted system code (TWITTER).'),('TL-302','ADMIN','Insert','2022-01-17 13:02:50','User ADMIN inserted system code (LINKEDIN).'),('TL-303','ADMIN','Insert','2022-01-17 13:03:01','User ADMIN inserted system code (INSTAGRAM).'),('TL-304','ADMIN','Insert','2022-01-17 13:11:41','User ADMIN inserted system parameter (15).'),('TL-305','ADMIN','Insert','2022-01-17 13:12:01','User ADMIN inserted policy (22).'),('TL-306','ADMIN','Insert','2022-01-17 13:12:12','User ADMIN inserted permission (87).'),('TL-307','ADMIN','Insert','2022-01-17 13:12:17','User ADMIN inserted permission (88).'),('TL-308','ADMIN','Insert','2022-01-17 13:12:23','User ADMIN inserted permission (89).'),('TL-308','ADMIN','Update','2022-01-17 13:12:29','User ADMIN updated permission (89).'),('TL-309','ADMIN','Insert','2022-01-17 13:12:36','User ADMIN inserted permission (90).'),('TL-310','ADMIN','Insert','2022-01-17 13:12:45','User ADMIN inserted permission (91).'),('TL-82','ADMIN','Update','2022-01-17 13:14:56','User ADMIN updated role permission (RL-1).'),('TL-311','ADMIN','Insert','2022-01-17 13:39:14','User ADMIN inserted employee social (1).'),('TL-312','ADMIN','Insert','2022-01-17 13:41:09','User ADMIN inserted employee social (2).'),('TL-312','ADMIN','Update','2022-01-17 13:42:41','User ADMIN updated employee social (2).'),('TL-312','ADMIN','Delete','2022-01-17 13:42:45','User ADMIN deleted employee social (2).'),('TL-311','ADMIN','Delete','2022-01-17 13:42:48','User ADMIN deleted employee social (1).'),('TL-304','ADMIN','Update','2022-01-17 13:43:00','User ADMIN updated system parameter (15).'),('TL-313','ADMIN','Insert','2022-01-17 13:54:39','User ADMIN inserted policy (23).'),('TL-314','ADMIN','Insert','2022-01-17 13:54:56','User ADMIN inserted permission (92).'),('TL-315','ADMIN','Insert','2022-01-17 13:55:06','User ADMIN inserted permission (93).'),('TL-316','ADMIN','Insert','2022-01-17 13:55:14','User ADMIN inserted permission (94).'),('TL-317','ADMIN','Insert','2022-01-17 13:55:25','User ADMIN inserted permission (95).'),('TL-318','ADMIN','Insert','2022-01-17 13:55:32','User ADMIN inserted permission (96).'),('TL-82','ADMIN','Update','2022-01-17 13:56:49','User ADMIN updated role permission (RL-1).'),('TL-319','ADMIN','Insert','2022-01-18 11:23:04','User ADMIN inserted system code (WORKSHIFT).'),('TL-320','ADMIN','Insert','2022-01-18 11:23:11','User ADMIN inserted system code (REGULAR).'),('TL-321','ADMIN','Insert','2022-01-18 11:25:10','User ADMIN inserted system code (SCHEDULED).'),('TL-317','ADMIN','Update','2022-01-18 16:28:09','User ADMIN updated permission (95).'),('TL-318','ADMIN','Update','2022-01-18 16:28:18','User ADMIN updated permission (96).'),('TL-322','ADMIN','Insert','2022-01-18 16:28:25','User ADMIN inserted permission (97).'),('TL-323','ADMIN','Insert','2022-01-19 09:10:22','User ADMIN inserted system parameter (16).'),('TL-324','ADMIN','Insert','2022-01-19 09:56:42','User ADMIN inserted work shift (1).'),('TL-324','ADMIN','Update','2022-01-19 09:57:08','User ADMIN updated work shift (1).'),('TL-82','ADMIN','Update','2022-01-19 09:59:05','User ADMIN updated role permission (RL-1).'),('TL-324','ADMIN','Delete','2022-01-19 09:59:58','User ADMIN deleted work shift (1).'),('TL-323','ADMIN','Update','2022-01-19 10:00:08','User ADMIN updated system parameter (16).'),('TL-325','ADMIN','Insert','2022-01-19 10:02:03','User ADMIN inserted work shift (1).'),('TL-326','ADMIN','Insert','2022-01-19 16:49:25','User ADMIN inserted work shift (2).'),('TL-325','ADMIN','Insert','2022-01-20 15:23:09','User ADMIN inserted work shift schedule (1).'),('TL-325','ADMIN','Update','2022-01-20 15:34:56','User ADMIN updated work shift schedule (1).'),('TL-325','ADMIN','Update','2022-01-20 15:35:35','User ADMIN updated work shift schedule (1).'),('TL-326','ADMIN','Insert','2022-01-20 16:02:46','User ADMIN inserted work shift schedule (2).'),('TL-326','ADMIN','Update','2022-01-20 16:05:02','User ADMIN updated work shift schedule (2).'),('TL-326','ADMIN','Update','2022-01-20 16:06:09','User ADMIN updated work shift schedule (2).'),('TL-326','ADMIN','Update','2022-01-20 16:08:12','User ADMIN updated work shift schedule (2).'),('TL-326','ADMIN','Update','2022-01-20 16:08:58','User ADMIN updated work shift schedule (2).'),('TL-327','ADMIN','Insert','2022-01-20 16:12:37','User ADMIN inserted work shift (3).'),('TL-327','ADMIN','Insert','2022-01-20 16:12:48','User ADMIN inserted work shift schedule (3).'),('TL-328','ADMIN','Insert','2022-01-20 16:16:11','User ADMIN inserted work shift (4).'),('TL-328','ADMIN','Insert','2022-01-20 16:16:25','User ADMIN inserted work shift schedule (4).'),('TL-325','ADMIN','Delete','2022-01-20 16:35:57','User ADMIN deleted work shift (1).'),('TL-326','ADMIN','Delete','2022-01-20 16:35:58','User ADMIN deleted work shift (2).'),('TL-328','ADMIN','Delete','2022-01-20 16:35:58','User ADMIN deleted work shift (4).'),('TL-327','ADMIN','Delete','2022-01-20 16:35:58','User ADMIN deleted work shift (3).'),('TL-323','ADMIN','Update','2022-01-20 16:36:09','User ADMIN updated system parameter (16).'),('TL-329','ADMIN','Insert','2022-01-20 16:36:58','User ADMIN inserted work shift (1).'),('TL-329','ADMIN','Insert','2022-01-20 16:45:30','User ADMIN inserted work shift schedule (1).'),('TL-329','ADMIN','Update','2022-01-20 16:46:12','User ADMIN updated work shift schedule (1).'),('TL-329','ADMIN','Update','2022-01-20 16:48:19','User ADMIN updated work shift schedule (1).'),('TL-329','ADMIN','Update','2022-01-20 17:20:45','User ADMIN updated work shift schedule (1).'),('TL-329','ADMIN','Update','2022-01-21 08:48:11','User ADMIN updated work shift schedule (1).'),('TL-329','ADMIN','Update','2022-01-21 08:50:00','User ADMIN updated work shift schedule (1).'),('TL-329','ADMIN','Update','2022-01-21 09:12:48','User ADMIN updated work shift schedule (1).'),('TL-329','ADMIN','Update','2022-01-21 09:14:40','User ADMIN updated work shift schedule (1).'),('TL-329','ADMIN','Update','2022-01-21 09:27:15','User ADMIN updated work shift schedule (1).'),('TL-329','ADMIN','Update','2022-01-21 09:27:25','User ADMIN updated work shift schedule (1).'),('TL-329','ADMIN','Update','2022-01-21 09:27:41','User ADMIN updated work shift schedule (1).'),('TL-329','ADMIN','Update','2022-01-21 09:39:41','User ADMIN updated work shift schedule (1).'),('TL-318','ADMIN','Update','2022-01-21 09:56:37','User ADMIN updated permission (96).'),('TL-322','ADMIN','Update','2022-01-21 09:56:45','User ADMIN updated permission (97).'),('TL-330','ADMIN','Insert','2022-01-21 10:05:48','User ADMIN inserted permission (98).'),('TL-331','ADMIN','Insert','2022-01-25 09:05:41','User ADMIN inserted work shift (2).'),('TL-331','ADMIN','Delete','2022-01-25 09:06:05','User ADMIN deleted work shift (2).'),('TL-323','ADMIN','Update','2022-01-25 09:06:56','User ADMIN updated system parameter (16).'),('TL-332','ADMIN','Insert','2022-01-25 10:42:50','User ADMIN inserted system parameter (17).'),('TL-333','ADMIN','Insert','2022-01-25 11:29:54','User ADMIN inserted policy (24).'),('TL-280','ADMIN','Update','2022-01-25 11:30:06','User ADMIN updated policy (20).'),('TL-288','ADMIN','Update','2022-01-25 11:30:18','User ADMIN updated policy (21).'),('TL-305','ADMIN','Update','2022-01-25 11:30:30','User ADMIN updated policy (22).'),('TL-334','ADMIN','Insert','2022-01-25 11:31:24','User ADMIN inserted permission (99).'),('TL-335','ADMIN','Insert','2022-01-25 11:31:31','User ADMIN inserted permission (100).'),('TL-336','ADMIN','Insert','2022-01-25 11:31:39','User ADMIN inserted permission (101).'),('TL-337','ADMIN','Insert','2022-01-25 11:31:45','User ADMIN inserted permission (102).'),('TL-334','ADMIN','Update','2022-01-25 11:34:08','User ADMIN updated permission (99).'),('TL-335','ADMIN','Update','2022-01-25 11:34:12','User ADMIN updated permission (100).'),('TL-336','ADMIN','Update','2022-01-25 11:34:17','User ADMIN updated permission (101).'),('TL-337','ADMIN','Update','2022-01-25 11:34:23','User ADMIN updated permission (102).'),('TL-338','ADMIN','Insert','2022-01-25 11:34:29','User ADMIN inserted permission (103).'),('TL-82','ADMIN','Update','2022-01-25 11:36:53','User ADMIN updated role permission (RL-1).'),('TL-339','ADMIN','Insert','2022-01-27 09:27:32','User ADMIN inserted employee attendance (1).'),('TL-339','ADMIN','Update','2022-01-27 09:34:53','User ADMIN updated employee attendance (1).'),('TL-339','ADMIN','Update','2022-01-27 09:35:01','User ADMIN updated employee attendance (1).'),('TL-339','ADMIN','Update','2022-01-27 09:38:29','User ADMIN updated employee attendance (1).'),('TL-339','ADMIN','Update','2022-01-27 09:38:47','User ADMIN updated employee attendance (1).'),('TL-329','ADMIN','Update','2022-01-27 09:52:32','User ADMIN updated work shift schedule (1).'),('TL-339','ADMIN','Update','2022-01-27 09:53:26','User ADMIN updated employee attendance (1).'),('TL-339','ADMIN','Update','2022-01-27 09:53:49','User ADMIN updated employee attendance (1).'),('TL-339','ADMIN','Update','2022-01-27 09:54:03','User ADMIN updated employee attendance (1).'),('TL-339','ADMIN','Update','2022-01-27 09:54:16','User ADMIN updated employee attendance (1).'),('TL-339','ADMIN','Update','2022-01-27 09:54:23','User ADMIN updated employee attendance (1).'),('TL-339','ADMIN','Update','2022-01-27 10:04:08','User ADMIN updated employee attendance (1).'),('TL-339','ADMIN','Update','2022-01-27 10:05:17','User ADMIN updated employee attendance (1).'),('TL-339','ADMIN','Update','2022-01-27 10:05:41','User ADMIN updated employee attendance (1).'),('TL-339','ADMIN','Update','2022-01-27 10:06:27','User ADMIN updated employee attendance (1).'),('TL-339','ADMIN','Update','2022-01-27 10:06:36','User ADMIN updated employee attendance (1).'),('TL-339','ADMIN','Update','2022-01-27 10:06:43','User ADMIN updated employee attendance (1).'),('TL-339','ADMIN','Update','2022-01-27 10:07:53','User ADMIN updated employee attendance (1).'),('TL-339','ADMIN','Update','2022-01-27 10:08:01','User ADMIN updated employee attendance (1).'),('TL-340','ADMIN','Insert','2022-01-27 10:20:17','User ADMIN inserted system code (PAIDSTATUS).'),('TL-341','ADMIN','Insert','2022-01-27 10:20:24','User ADMIN inserted system code (PAID).'),('TL-342','ADMIN','Insert','2022-01-27 10:20:34','User ADMIN inserted system code (UNPAID).'),('TL-343','ADMIN','Insert','2022-01-27 10:21:08','User ADMIN inserted system parameter (18).'),('TL-344','ADMIN','Insert','2022-01-27 10:21:44','User ADMIN inserted policy (25).'),('TL-344','ADMIN','Update','2022-01-27 10:22:10','User ADMIN updated policy (25).'),('TL-345','ADMIN','Insert','2022-01-27 10:22:20','User ADMIN inserted permission (104).'),('TL-346','ADMIN','Insert','2022-01-27 10:22:27','User ADMIN inserted permission (105).'),('TL-347','ADMIN','Insert','2022-01-27 10:22:35','User ADMIN inserted permission (106).'),('TL-348','ADMIN','Insert','2022-01-27 10:22:40','User ADMIN inserted permission (107).'),('TL-349','ADMIN','Insert','2022-01-27 10:22:46','User ADMIN inserted permission (108).'),('TL-82','ADMIN','Update','2022-01-27 10:41:07','User ADMIN updated role permission (RL-1).'),('TL-350','ADMIN','Insert','2022-01-27 11:55:04','User ADMIN inserted leave type (LEAVETP-1).'),('TL-350','ADMIN','Update','2022-01-27 11:57:21','User ADMIN updated leave type (LEAVETP-1).'),('TL-350','ADMIN','Update','2022-01-27 11:57:24','User ADMIN updated leave type (LEAVETP-1).'),('TL-350','ADMIN','Delete','2022-01-27 11:57:34','User ADMIN deleted leave type (LEAVETP-1).'),('TL-343','ADMIN','Update','2022-01-27 11:57:46','User ADMIN updated system parameter (18).'),('TL-351','ADMIN','Insert','2022-01-27 11:58:59','User ADMIN inserted leave type (LEAVETP-1).'),('TL-352','ADMIN','Insert','2022-01-27 12:00:15','User ADMIN inserted leave type (LEAVETP-2).'),('TL-353','ADMIN','Insert','2022-01-27 12:40:47','User ADMIN inserted leave type (LEAVETP-3).'),('TL-354','ADMIN','Insert','2022-01-27 12:48:34','User ADMIN inserted leave type (LEAVETP-4).'),('TL-355','ADMIN','Insert','2022-01-27 12:51:56','User ADMIN inserted leave type (LEAVETP-5).'),('TL-356','ADMIN','Insert','2022-01-27 12:53:25','User ADMIN inserted leave type (LEAVETP-6).'),('TL-357','ADMIN','Insert','2022-01-27 12:56:38','User ADMIN inserted leave type (LEAVETP-7).'),('TL-354','ADMIN','Update','2022-01-27 13:08:08','User ADMIN updated leave type (LEAVETP-4).'),('TL-354','ADMIN','Update','2022-01-27 13:08:25','User ADMIN updated leave type (LEAVETP-4).'),('TL-358','ADMIN','Insert','2022-01-27 13:09:47','User ADMIN inserted leave type (LEAVETP-8).'),('TL-359','ADMIN','Insert','2022-01-27 13:10:03','User ADMIN inserted leave type (LEAVETP-9).'),('TL-360','ADMIN','Insert','2022-01-27 13:12:31','User ADMIN inserted system parameter (19).'),('TL-361','ADMIN','Insert','2022-01-27 13:12:49','User ADMIN inserted policy (26).'),('TL-362','ADMIN','Insert','2022-01-27 13:13:08','User ADMIN inserted permission (109).'),('TL-363','ADMIN','Insert','2022-01-27 13:13:13','User ADMIN inserted permission (110).'),('TL-364','ADMIN','Insert','2022-01-27 13:13:21','User ADMIN inserted permission (111).'),('TL-365','ADMIN','Insert','2022-01-27 13:13:28','User ADMIN inserted permission (112).'),('TL-366','ADMIN','Insert','2022-01-27 13:13:34','User ADMIN inserted permission (113).'),('TL-82','ADMIN','Update','2022-01-27 13:15:04','User ADMIN updated role permission (RL-1).'),('TL-367','ADMIN','Insert','2022-01-27 15:25:13','User ADMIN inserted leave entitlement (LVENT-1).'),('TL-367','ADMIN','Update','2022-01-27 15:31:45','User ADMIN updated leave entitlement (LVENT-1).'),('TL-367','ADMIN','Update','2022-01-27 15:36:15','User ADMIN updated leave entitlement (LVENT-1).'),('TL-367','ADMIN','Update','2022-01-27 15:36:23','User ADMIN updated leave entitlement (LVENT-1).'),('TL-367','ADMIN','Delete','2022-01-27 15:37:33','User ADMIN deleted leave entitlement (LVENT-1).'),('TL-360','ADMIN','Update','2022-01-27 15:37:55','User ADMIN updated system parameter (19).'),('TL-368','ADMIN','Insert','2022-01-27 15:38:47','User ADMIN inserted policy (27).'),('TL-369','ADMIN','Insert','2022-01-27 15:39:07','User ADMIN inserted permission (114).'),('TL-370','ADMIN','Insert','2022-01-27 15:39:14','User ADMIN inserted permission (115).'),('TL-371','ADMIN','Insert','2022-01-27 15:39:26','User ADMIN inserted permission (116).'),('TL-370','ADMIN','Update','2022-01-27 15:39:32','User ADMIN updated permission (115).'),('TL-372','ADMIN','Insert','2022-01-27 15:39:40','User ADMIN inserted permission (117).'),('TL-373','ADMIN','Insert','2022-01-27 15:40:02','User ADMIN inserted permission (118).'),('TL-82','ADMIN','Update','2022-01-27 15:43:20','User ADMIN updated role permission (RL-1).'),('TL-332','ADMIN','Update','2022-01-27 15:44:44','User ADMIN updated system parameter (17).'),('TL-374','ADMIN','Insert','2022-01-27 16:21:30','User ADMIN inserted leave entitlement (LVENT-1).'),('TL-374','ADMIN','Update','2022-01-27 16:22:45','User ADMIN updated leave entitlement (LVENT-1).'),('TL-375','ADMIN','Insert','2022-01-27 16:23:25','User ADMIN inserted leave entitlement (LVENT-2).'),('TL-376','ADMIN','Insert','2022-01-27 16:25:08','User ADMIN inserted leave entitlement (LVENT-3).'),('TL-375','ADMIN','Update','2022-01-27 16:33:48','User ADMIN updated leave entitlement (LVENT-2).'),('TL-377','ADMIN','Insert','2022-01-27 16:35:38','User ADMIN inserted leave entitlement (LVENT-4).'),('TL-377','ADMIN','Delete','2022-01-27 16:36:13','User ADMIN deleted leave entitlement (LVENT-4).'),('TL-376','ADMIN','Delete','2022-01-27 16:36:15','User ADMIN deleted leave entitlement (LVENT-3).'),('TL-375','ADMIN','Delete','2022-01-27 16:36:19','User ADMIN deleted leave entitlement (LVENT-2).'),('TL-378','ADMIN','Insert','2022-01-27 16:37:50','User ADMIN inserted leave entitlement (LVENT-5).'),('TL-379','ADMIN','Insert','2022-01-27 16:38:34','User ADMIN inserted leave entitlement (LVENT-6).'),('TL-380','ADMIN','Insert','2022-01-27 16:41:15','User ADMIN inserted leave entitlement (LVENT-7).'),('TL-381','ADMIN','Insert','2022-01-27 16:41:48','User ADMIN inserted leave entitlement (LVENT-8).'),('TL-380','ADMIN','Delete','2022-01-27 16:41:52','User ADMIN deleted leave entitlement (LVENT-7).'),('TL-381','ADMIN','Delete','2022-01-27 16:41:54','User ADMIN deleted leave entitlement (LVENT-8).'),('TL-379','ADMIN','Delete','2022-01-27 16:41:56','User ADMIN deleted leave entitlement (LVENT-6).'),('TL-378','ADMIN','Delete','2022-01-27 16:41:57','User ADMIN deleted leave entitlement (LVENT-5).'),('TL-382','ADMIN','Insert','2022-01-27 16:44:52','User ADMIN inserted leave entitlement (LVENT-9).'),('TL-382','ADMIN','Delete','2022-01-27 16:45:00','User ADMIN deleted leave entitlement (LVENT-9).'),('TL-374','ADMIN','Delete','2022-01-27 16:45:01','User ADMIN deleted leave entitlement (LVENT-1).'),('TL-360','ADMIN','Update','2022-01-27 16:45:09','User ADMIN updated system parameter (19).'),('TL-383','ADMIN','Insert','2022-01-27 17:03:01','User ADMIN inserted policy (28).'),('TL-384','ADMIN','Insert','2022-01-27 17:03:14','User ADMIN inserted permission (119).'),('TL-385','ADMIN','Insert','2022-01-27 17:03:18','User ADMIN inserted permission (120).'),('TL-386','ADMIN','Insert','2022-01-27 17:03:22','User ADMIN inserted permission (121).'),('TL-387','ADMIN','Insert','2022-01-27 17:03:28','User ADMIN inserted permission (122).'),('TL-388','ADMIN','Insert','2022-01-27 17:03:34','User ADMIN inserted permission (123).'),('TL-82','ADMIN','Update','2022-01-27 17:04:46','User ADMIN updated role permission (RL-1).'),('TL-389','ADMIN','Insert','2022-01-27 17:26:50','User ADMIN inserted system parameter (20).'),('TL-390','ADMIN','Insert','2022-01-28 09:28:03','User ADMIN inserted system code (LEAVEDURATION).'),('TL-391','ADMIN','Insert','2022-01-28 09:28:49','User ADMIN inserted system code (SINGLE).'),('TL-392','ADMIN','Insert','2022-01-28 09:28:58','User ADMIN inserted system code (MULTIPLE).'),('TL-393','ADMIN','Insert','2022-01-28 09:29:13','User ADMIN inserted system code (HLFDAYMOR).'),('TL-394','ADMIN','Insert','2022-01-28 09:29:21','User ADMIN inserted system code (CUSTOM).'),('TL-395','ADMIN','Insert','2022-01-28 09:29:35','User ADMIN inserted system code (HLFDAYAFT).'),('TL-396','ADMIN','Insert','2022-01-28 11:22:41','User ADMIN inserted leave entitlement (LVENT-1).'),('TL-397','ADMIN','Insert','2022-01-28 11:57:14','User ADMIN inserted leave (LV-1).'),('TL-398','ADMIN','Insert','2022-01-28 11:58:36','User ADMIN inserted leave (LV-2).'),('TL-396','ADMIN','Update','2022-01-28 11:58:36','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-399','ADMIN','Insert','2022-01-28 13:43:23','User ADMIN inserted leave (LV-3).'),('TL-396','ADMIN','Update','2022-01-28 13:43:23','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-400','ADMIN','Insert','2022-01-28 13:43:23','User ADMIN inserted leave (LV-4).'),('TL-396','ADMIN','Update','2022-01-28 13:43:24','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-401','ADMIN','Insert','2022-01-28 13:43:24','User ADMIN inserted leave (LV-5).'),('TL-396','ADMIN','Update','2022-01-28 13:43:24','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-402','ADMIN','Insert','2022-01-28 13:59:06','User ADMIN inserted leave (LV-6).'),('TL-396','ADMIN','Update','2022-01-28 13:59:06','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-403','ADMIN','Insert','2022-01-28 13:59:06','User ADMIN inserted leave (LV-7).'),('TL-396','ADMIN','Update','2022-01-28 13:59:06','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-404','ADMIN','Insert','2022-01-28 13:59:07','User ADMIN inserted leave (LV-8).'),('TL-396','ADMIN','Update','2022-01-28 13:59:07','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-405','ADMIN','Insert','2022-01-28 14:00:08','User ADMIN inserted leave (LV-9).'),('TL-396','ADMIN','Update','2022-01-28 14:00:09','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-406','ADMIN','Insert','2022-01-28 14:00:09','User ADMIN inserted leave (LV-10).'),('TL-396','ADMIN','Update','2022-01-28 14:00:09','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-407','ADMIN','Insert','2022-01-28 14:00:09','User ADMIN inserted leave (LV-11).'),('TL-396','ADMIN','Update','2022-01-28 14:00:09','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-408','ADMIN','Insert','2022-01-28 14:00:10','User ADMIN inserted leave (LV-12).'),('TL-396','ADMIN','Update','2022-01-28 14:00:10','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-409','ADMIN','Insert','2022-01-28 14:00:10','User ADMIN inserted leave (LV-13).'),('TL-396','ADMIN','Update','2022-01-28 14:00:10','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-386','ADMIN','Update','2022-01-28 16:17:14','User ADMIN updated permission (121).'),('TL-386','ADMIN','Update','2022-01-28 16:17:18','User ADMIN updated permission (121).'),('TL-387','ADMIN','Update','2022-01-28 16:17:24','User ADMIN updated permission (122).'),('TL-388','ADMIN','Update','2022-01-28 16:17:31','User ADMIN updated permission (123).'),('TL-388','ADMIN','Update','2022-01-28 16:17:35','User ADMIN updated permission (123).'),('TL-410','ADMIN','Insert','2022-01-28 16:17:41','User ADMIN inserted permission (124).'),('TL-411','ADMIN','Insert','2022-01-28 16:17:46','User ADMIN inserted permission (125).'),('TL-82','ADMIN','Update','2022-01-28 16:34:10','User ADMIN updated role permission (RL-1).'),('TL-406','ADMIN','Approve','2022-01-31 11:46:32','User ADMIN approved leave (LV-10).'),('TL-407','ADMIN','Reject','2022-01-31 14:24:09','User ADMIN rejected leave (LV-11).'),('TL-396','ADMIN','Update','2022-01-31 14:24:10','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-408','ADMIN','Cancel','2022-01-31 14:24:58','User ADMIN cancelled leave (LV-12).'),('TL-396','ADMIN','Update','2022-01-31 14:24:58','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-409','ADMIN','Reject','2022-01-31 14:29:58','User ADMIN rejected leave (LV-13).'),('TL-396','ADMIN','Update','2022-01-31 14:29:58','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-401','ADMIN','Delete','2022-01-31 14:45:33','User ADMIN deleted leave (LV-5).'),('TL-396','ADMIN','Update','2022-01-31 14:45:33','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-400','ADMIN','Delete','2022-01-31 14:45:36','User ADMIN deleted leave (LV-4).'),('TL-396','ADMIN','Update','2022-01-31 14:45:36','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-402','ADMIN','Delete','2022-01-31 14:46:04','User ADMIN deleted leave (LV-6).'),('TL-396','ADMIN','Update','2022-01-31 14:46:04','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-403','ADMIN','Delete','2022-01-31 14:46:04','User ADMIN deleted leave (LV-7).'),('TL-396','ADMIN','Update','2022-01-31 14:46:04','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-404','ADMIN','Delete','2022-01-31 14:46:04','User ADMIN deleted leave (LV-8).'),('TL-396','ADMIN','Update','2022-01-31 14:46:04','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-405','ADMIN','Delete','2022-01-31 14:46:04','User ADMIN deleted leave (LV-9).'),('TL-396','ADMIN','Update','2022-01-31 14:46:04','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-396','ADMIN','Delete','2022-01-31 14:46:34','User ADMIN deleted leave entitlement (LVENT-1).'),('TL-389','ADMIN','Update','2022-01-31 14:46:44','User ADMIN updated system parameter (20).'),('TL-360','ADMIN','Update','2022-01-31 14:46:49','User ADMIN updated system parameter (19).'),('TL-412','ADMIN','Insert','2022-01-31 16:40:33','User ADMIN inserted leave entitlement (LVENT-1).'),('TL-413','ADMIN','Insert','2022-01-31 16:40:51','User ADMIN inserted leave (LV-1).'),('TL-412','ADMIN','Update','2022-01-31 16:40:51','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-414','ADMIN','Insert','2022-01-31 16:40:51','User ADMIN inserted leave (LV-2).'),('TL-412','ADMIN','Update','2022-01-31 16:40:52','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-415','ADMIN','Insert','2022-01-31 16:40:52','User ADMIN inserted leave (LV-3).'),('TL-412','ADMIN','Update','2022-01-31 16:40:52','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-415','ADMIN','Delete','2022-01-31 16:54:49','User ADMIN deleted leave (LV-3).'),('TL-412','ADMIN','Update','2022-01-31 16:54:49','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-413','ADMIN','Reject','2022-01-31 17:23:31','User ADMIN rejected leave (LV-1).'),('TL-412','ADMIN','Update','2022-01-31 17:23:31','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-389','ADMIN','Update','2022-01-31 17:24:53','User ADMIN updated system parameter (20).'),('TL-360','ADMIN','Update','2022-01-31 17:24:58','User ADMIN updated system parameter (19).'),('TL-416','ADMIN','Insert','2022-02-02 10:05:10','User ADMIN inserted leave entitlement (LVENT-1).'),('TL-417','ADMIN','Insert','2022-02-02 10:06:06','User ADMIN inserted leave (LV-1).'),('TL-416','ADMIN','Update','2022-02-02 10:06:06','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-418','ADMIN','Insert','2022-02-02 10:24:20','User ADMIN inserted leave (LV-2).'),('TL-416','ADMIN','Update','2022-02-02 10:24:20','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-418','ADMIN','Approve','2022-02-02 10:24:43','User ADMIN approved leave (LV-2).'),('TL-417','ADMIN','Approve','2022-02-02 10:33:08','User ADMIN approved leave (LV-1).'),('TL-419','ADMIN','Insert','2022-02-02 10:38:31','User ADMIN inserted policy (29).'),('TL-420','ADMIN','Insert','2022-02-02 10:39:03','User ADMIN inserted permission (126).'),('TL-421','ADMIN','Insert','2022-02-02 10:39:22','User ADMIN inserted permission (127).'),('TL-422','ADMIN','Insert','2022-02-02 10:39:38','User ADMIN inserted permission (128).'),('TL-423','ADMIN','Insert','2022-02-02 10:39:44','User ADMIN inserted permission (129).'),('TL-424','ADMIN','Insert','2022-02-02 10:39:50','User ADMIN inserted permission (130).'),('TL-425','ADMIN','Insert','2022-02-02 10:39:56','User ADMIN inserted permission (131).'),('TL-426','ADMIN','Insert','2022-02-02 10:40:05','User ADMIN inserted permission (132).'),('TL-82','ADMIN','Update','2022-02-02 10:42:20','User ADMIN updated role permission (RL-1).'),('TL-419','ADMIN','Update','2022-02-02 10:49:04','User ADMIN updated policy (29).'),('TL-427','ADMIN','Insert','2022-02-02 11:01:18','User ADMIN inserted leave (LV-3).'),('TL-416','ADMIN','Update','2022-02-02 11:01:18','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-428','ADMIN','Insert','2022-02-02 11:01:18','User ADMIN inserted leave (LV-4).'),('TL-416','ADMIN','Update','2022-02-02 11:01:18','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-429','ADMIN','Insert','2022-02-02 11:01:18','User ADMIN inserted leave (LV-5).'),('TL-416','ADMIN','Update','2022-02-02 11:01:18','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-427','ADMIN','Delete','2022-02-02 11:04:14','User ADMIN deleted leave (LV-3).'),('TL-416','ADMIN','Update','2022-02-02 11:04:15','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-428','ADMIN','Approve','2022-02-02 11:06:03','User ADMIN approved leave (LV-4).'),('TL-429','ADMIN','Reject','2022-02-02 11:07:09','User ADMIN rejected leave (LV-5).'),('TL-416','ADMIN','Update','2022-02-02 11:07:09','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-428','ADMIN','Cancel','2022-02-02 11:07:18','User ADMIN cancelled leave (LV-4).'),('TL-416','ADMIN','Update','2022-02-02 11:07:18','User ADMIN updated leave entitlement count (LVENT-1).'),('TL-430','ADMIN','Insert','2022-02-02 11:14:17','User ADMIN inserted policy (30).'),('TL-431','ADMIN','Insert','2022-02-02 11:14:40','User ADMIN inserted permission (133).'),('TL-432','ADMIN','Insert','2022-02-02 11:14:45','User ADMIN inserted permission (134).'),('TL-433','ADMIN','Insert','2022-02-02 11:14:49','User ADMIN inserted permission (135).'),('TL-434','ADMIN','Insert','2022-02-02 11:14:52','User ADMIN inserted permission (136).'),('TL-435','ADMIN','Insert','2022-02-02 11:16:06','User ADMIN inserted permission (137).'),('TL-82','ADMIN','Update','2022-02-02 11:16:22','User ADMIN updated role permission (RL-1).'),('TL-431','ADMIN','Update','2022-02-02 11:17:41','User ADMIN updated permission (133).'),('TL-430','ADMIN','Update','2022-02-02 11:18:03','User ADMIN updated policy (30).'),('TL-436','ADMIN','Insert','2022-02-02 11:20:52','User ADMIN inserted upload setting (8).'),('TL-436','ADMIN','Update','2022-02-02 11:34:54','User ADMIN updated upload setting (8).'),('TL-437','ADMIN','Insert','2022-02-02 11:47:10','User ADMIN inserted system parameter (21).'),('TL-438','ADMIN','Insert','2022-02-02 11:53:57','User ADMIN inserted system code (FILECATEGORY).'),('TL-439','ADMIN','Insert','2022-02-02 11:54:29','User ADMIN inserted system code (COMMENDATION).'),('TL-440','ADMIN','Insert','2022-02-02 11:54:39','User ADMIN inserted system code (PAYSLIP).'),('TL-441','ADMIN','Insert','2022-02-07 09:58:13','User ADMIN inserted employee file (1).'),('TL-441','ADMIN','Update','2022-02-07 09:58:13','User ADMIN updated employee file (1).'),('TL-442','ADMIN','Insert','2022-02-07 10:05:32','User ADMIN inserted employee file (2).'),('TL-442','ADMIN','Update','2022-02-07 10:05:32','User ADMIN updated employee file (2).'),('TL-442','ADMIN','Update','2022-02-07 10:12:49','User ADMIN updated designation ().'),('TL-442','ADMIN','Update','2022-02-07 10:13:09','User ADMIN updated employee file (2).'),('TL-442','ADMIN','Update','2022-02-07 10:13:53','User ADMIN updated employee file (2).'),('TL-442','ADMIN','Update','2022-02-07 10:15:21','User ADMIN updated employee file (2).'),('TL-442','ADMIN','Update','2022-02-07 10:15:52','User ADMIN updated employee file (2).'),('TL-442','ADMIN','Update','2022-02-07 10:15:52','User ADMIN updated employee file (2).'),('TL-442','ADMIN','Delete','2022-02-07 10:16:03','User ADMIN deleted employee file (2).'),('TL-443','ADMIN','Insert','2022-02-07 10:17:50','User ADMIN inserted policy (31).'),('TL-444','ADMIN','Insert','2022-02-07 10:18:04','User ADMIN inserted permission (138).'),('TL-445','ADMIN','Insert','2022-02-07 10:18:09','User ADMIN inserted permission (139).'),('TL-446','ADMIN','Insert','2022-02-07 10:18:16','User ADMIN inserted permission (140).'),('TL-447','ADMIN','Insert','2022-02-07 10:18:21','User ADMIN inserted permission (141).'),('TL-447','ADMIN','Update','2022-02-07 10:18:25','User ADMIN updated permission (141).'),('TL-448','ADMIN','Insert','2022-02-07 10:18:30','User ADMIN inserted permission (142).'),('TL-82','ADMIN','Update','2022-02-07 10:18:50','User ADMIN updated role permission (RL-1).'),('TL-449','ADMIN','Insert','2022-02-07 10:41:07','User ADMIN inserted employee file (3).'),('TL-449','ADMIN','Update','2022-02-07 10:41:07','User ADMIN updated employee file (3).'),('TL-449','ADMIN','Update','2022-02-07 11:38:23','User ADMIN updated employee file (3).'),('TL-450','ADMIN','Insert','2022-02-07 11:39:29','User ADMIN inserted employee file (4).'),('TL-450','ADMIN','Update','2022-02-07 11:39:29','User ADMIN updated employee file (4).'),('TL-450','ADMIN','Delete','2022-02-07 11:39:46','User ADMIN deleted employee file (4).'),('TL-449','ADMIN','Delete','2022-02-07 11:39:48','User ADMIN deleted employee file (3).'),('TL-437','ADMIN','Update','2022-02-07 11:39:58','User ADMIN updated system parameter (21).'),('TL-220','ADMIN','Update','2022-02-07 14:10:48','User ADMIN updated employee (7).'),('TL-216','ADMIN','Update','2022-02-07 14:18:05','User ADMIN updated employee (3).'),('TL-84','ADMIN','Update','2022-02-08 10:55:36','User ADMIN updated company setting (1).'),('TL-220','ADMIN','Update','2022-02-08 13:11:15','User ADMIN updated employee (7).'),('TL-101','ADMIN','Update','2022-02-08 13:11:37','User ADMIN updated department (DEPT-8).'),('TL-451','ADMIN','Insert','2022-02-08 14:36:36','User ADMIN inserted policy (32).'),('TL-452','ADMIN','Insert','2022-02-08 14:37:32','User ADMIN inserted permission (143).'),('TL-453','ADMIN','Insert','2022-02-08 14:37:38','User ADMIN inserted permission (144).'),('TL-454','ADMIN','Insert','2022-02-08 14:37:47','User ADMIN inserted permission (145).'),('TL-455','ADMIN','Insert','2022-02-08 14:41:31','User ADMIN inserted permission (146).'),('TL-456','ADMIN','Insert','2022-02-08 14:41:38','User ADMIN inserted permission (147).'),('TL-457','ADMIN','Insert','2022-02-08 14:41:57','User ADMIN inserted permission (148).'),('TL-458','ADMIN','Insert','2022-02-08 14:42:05','User ADMIN inserted permission (149).'),('TL-459','ADMIN','Insert','2022-02-08 14:42:16','User ADMIN inserted permission (150).'),('TL-82','ADMIN','Update','2022-02-08 14:45:15','User ADMIN updated role permission (RL-1).'),('TL-6','ADMIN','Update','2022-02-08 16:15:46','User ADMIN updated system parameter (5).'),('TL-460','ADMIN','Insert','2022-02-08 16:16:10','User ADMIN inserted role (RL-2).'),('TL-461','ADMIN','Insert','2022-02-08 16:16:26','User ADMIN inserted role (RL-3).'),('TL-82','ADMIN','Update','2022-02-08 16:16:38','User ADMIN updated role (RL-1).'),('TL-462','ADMIN','Insert','2022-02-08 16:16:55','User ADMIN inserted role (RL-4).'),('TL-463','ADMIN','Insert','2022-02-08 16:17:09','User ADMIN inserted role (RL-5).'),('TL-462','ADMIN','Update','2022-02-08 16:17:13','User ADMIN updated role (RL-4).'),('TL-464','ADMIN','Insert','2022-02-08 16:17:30','User ADMIN inserted role (RL-6).'),('TL-465','ADMIN','Insert','2022-02-08 16:17:44','User ADMIN inserted role (RL-7).'),('TL-466','ADMIN','Insert','2022-02-08 16:18:01','User ADMIN inserted role (RL-8).'),('TL-467','ADMIN','Insert','2022-02-08 16:18:22','User ADMIN inserted role (RL-9).'),('TL-468','ADMIN','Insert','2022-02-08 16:18:41','User ADMIN inserted role (RL-10).'),('TL-469','ADMIN','Insert','2022-02-09 13:45:01','User ADMIN inserted user account (LDAGULTO).'),('TL-470','ADMIN','Update','2022-02-09 13:47:00','User ADMIN updated user account (LDAGULTO).'),('TL-471','ADMIN','Update','2022-02-09 13:47:59','User ADMIN updated user account (LDAGULTO).'),('TL-472','ADMIN','Update','2022-02-09 13:48:45','User ADMIN updated user account (LDAGULTO).'),('TL-473','ADMIN','Insert','2022-02-09 13:57:26','User ADMIN inserted user account (GTBONITA).'),('TL-474','ADMIN','Update','2022-02-09 13:59:00','User ADMIN updated user account (GTBONITA).'),('TL-475','ADMIN','Insert','2022-02-09 14:01:11','User ADMIN inserted user account (LVMICAYAS).'),('TL-219','ADMIN','Update','2022-02-09 14:01:12','User ADMIN updated employee user account (6).'),('TL-476','ADMIN','Update','2022-02-09 14:01:24','User ADMIN updated user account (LVMICAYAS).'),('TL-477','ADMIN','Update','2022-02-09 14:31:29','User ADMIN updated user account (GTBONITA).'),('TL-478','ADMIN','Update','2022-02-09 14:31:35','User ADMIN updated user account (GTBONITA).'),('TL-479','ADMIN','Update','2022-02-09 14:31:39','User ADMIN updated user account (GTBONITA).'),('TL-480','ADMIN','Insert','2022-02-09 14:32:18','User ADMIN inserted user account (KSVILLAR).'),('TL-241','ADMIN','Update','2022-02-09 14:32:18','User ADMIN updated employee user account (36).'),('TL-481','ADMIN','Update','2022-02-09 17:10:05','User ADMIN updated user account (LDAGULTO).'),('TL-482','ADMIN','Update','2022-02-09 17:14:50','User ADMIN updated user account (LDAGULTO).'),('TL-482','ADMIN','Activate','2022-02-09 17:17:21','User ADMIN activated user account (LDAGULTO).'),('TL-482','ADMIN','Update','2022-02-09 17:17:41','User ADMIN updated user account (LDAGULTO).'),('TL-482','ADMIN','Deactivated','2022-02-09 17:19:06','User ADMIN deactivated user account (LDAGULTO).'),('TL-482','ADMIN','Lock','2022-02-09 17:20:27','User ADMIN locked user account (LDAGULTO).'),('TL-483','ADMIN','Update','2022-02-09 17:21:58','User ADMIN updated user account (LDAGULTO).'),('TL-483','ADMIN','Lock','2022-02-09 17:22:05','User ADMIN locked user account (LDAGULTO).'),('TL-484','ADMIN','Update','2022-02-09 17:22:25','User ADMIN updated user account (LDAGULTO).'),('TL-484','ADMIN','Lock','2022-02-09 17:23:35','User ADMIN locked user account (LDAGULTO).'),('TL-484','ADMIN','Unlock','2022-02-09 17:23:38','User ADMIN unlocked user account (LDAGULTO).'),('TL-484','ADMIN','Activate','2022-02-09 17:25:53','User ADMIN activated user account (LDAGULTO).'),('TL-479','ADMIN','Activate','2022-02-09 17:25:56','User ADMIN activated user account (GTBONITA).'),('TL-476','ADMIN','Activate','2022-02-09 17:25:58','User ADMIN activated user account (LVMICAYAS).'),('TL-480','ADMIN','Activate','2022-02-09 17:26:00','User ADMIN activated user account (KSVILLAR).'),('TL-480','LDAGULTO','Deactivated','2022-02-10 10:32:34','User LDAGULTO deactivated user account (KSVILLAR).'),('TL-480','LDAGULTO','Lock','2022-02-10 10:32:36','User LDAGULTO locked user account (KSVILLAR).'),('TL-479','LDAGULTO','Lock','2022-02-10 11:36:12','User LDAGULTO locked user account (GTBONITA).'),('TL-476','LDAGULTO','Lock','2022-02-10 11:36:12','User LDAGULTO locked user account (LVMICAYAS).'),('TL-479','LDAGULTO','Deactivated','2022-02-10 11:36:19','User LDAGULTO deactivated user account (GTBONITA).'),('TL-476','LDAGULTO','Deactivated','2022-02-10 11:36:19','User LDAGULTO deactivated user account (LVMICAYAS).'),('TL-479','LDAGULTO','Unlock','2022-02-10 11:36:52','User LDAGULTO unlocked user account (GTBONITA).'),('TL-476','LDAGULTO','Unlock','2022-02-10 11:36:52','User LDAGULTO unlocked user account (LVMICAYAS).'),('TL-480','LDAGULTO','Unlock','2022-02-10 11:36:53','User LDAGULTO unlocked user account (KSVILLAR).'),('TL-479','LDAGULTO','Activate','2022-02-10 11:36:58','User LDAGULTO activated user account (GTBONITA).'),('TL-476','LDAGULTO','Activate','2022-02-10 11:36:58','User LDAGULTO activated user account (LVMICAYAS).'),('TL-480','LDAGULTO','Activate','2022-02-10 11:36:58','User LDAGULTO activated user account (KSVILLAR).'),('TL-479','LDAGULTO','Lock','2022-02-10 11:40:59','User LDAGULTO locked user account (GTBONITA).'),('TL-476','LDAGULTO','Lock','2022-02-10 11:40:59','User LDAGULTO locked user account (LVMICAYAS).'),('TL-480','LDAGULTO','Lock','2022-02-10 11:40:59','User LDAGULTO locked user account (KSVILLAR).'),('TL-479','LDAGULTO','Unlock','2022-02-10 11:41:07','User LDAGULTO unlocked user account (GTBONITA).'),('TL-476','LDAGULTO','Unlock','2022-02-10 11:41:07','User LDAGULTO unlocked user account (LVMICAYAS).'),('TL-480','LDAGULTO','Unlock','2022-02-10 11:41:07','User LDAGULTO unlocked user account (KSVILLAR).'),('TL-485','LDAGULTO','Insert','2022-02-10 13:00:06','User LDAGULTO inserted policy (33).'),('TL-486','LDAGULTO','Insert','2022-02-10 13:00:21','User LDAGULTO inserted permission (151).'),('TL-487','LDAGULTO','Insert','2022-02-10 13:00:26','User LDAGULTO inserted permission (152).'),('TL-488','LDAGULTO','Insert','2022-02-10 13:00:34','User LDAGULTO inserted permission (153).'),('TL-487','LDAGULTO','Update','2022-02-10 13:00:38','User LDAGULTO updated permission (152).'),('TL-489','LDAGULTO','Insert','2022-02-10 13:00:43','User LDAGULTO inserted permission (154).'),('TL-490','LDAGULTO','Insert','2022-02-10 13:00:49','User LDAGULTO inserted permission (155).'),('TL-491','LDAGULTO','Insert','2022-02-10 13:23:08','User LDAGULTO inserted notification type (1).'),('TL-492','LDAGULTO','Insert','2022-02-10 13:27:02','User LDAGULTO inserted leave (LV-6).'),('TL-416','LDAGULTO','Update','2022-02-10 13:27:02','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-493','LDAGULTO','Insert','2022-02-10 13:27:03','User LDAGULTO inserted leave (LV-7).'),('TL-416','LDAGULTO','Update','2022-02-10 13:27:03','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-494','LDAGULTO','Insert','2022-02-10 13:30:05','User LDAGULTO inserted employee file (1).'),('TL-494','LDAGULTO','Update','2022-02-10 13:30:05','User LDAGULTO updated employee file (1).'),('TL-480','LDAGULTO','Deactivated','2022-02-10 13:49:35','User LDAGULTO deactivated user account (KSVILLAR).'),('TL-82','LDAGULTO','Update','2022-02-10 13:58:14','User LDAGULTO updated role permission (RL-1).'),('TL-495','LDAGULTO','Insert','2022-02-10 14:23:37','User LDAGULTO inserted system parameter (22).'),('TL-496','LDAGULTO','Insert','2022-02-10 14:24:07','User LDAGULTO inserted system code (HOLIDAYTYPE).'),('TL-497','LDAGULTO','Insert','2022-02-10 14:25:28','User LDAGULTO inserted system code (SPCWORKHOL).'),('TL-498','LDAGULTO','Insert','2022-02-10 14:25:40','User LDAGULTO inserted system code (LOCHOL).'),('TL-499','LDAGULTO','Insert','2022-02-10 14:25:51','User LDAGULTO inserted system code (SPCNONWORKHOL).'),('TL-500','LDAGULTO','Insert','2022-02-10 14:26:03','User LDAGULTO inserted system code (REGHOL).'),('TL-501','LDAGULTO','Insert','2022-02-10 16:30:32','User LDAGULTO inserted holiday (HOL-1).'),('TL-502','LDAGULTO','Update','2022-02-10 16:36:31','User LDAGULTO updated holiday (HOL-1).'),('TL-503','LDAGULTO','Insert','2022-02-10 16:37:04','User LDAGULTO inserted holiday (HOL-2).'),('TL-503','LDAGULTO','Update','2022-02-10 16:37:09','User LDAGULTO updated holiday (HOL-2).'),('TL-504','LDAGULTO','Insert','2022-02-10 16:39:22','User LDAGULTO inserted holiday (HOL-3).'),('TL-505','LDAGULTO','Insert','2022-02-10 16:46:15','User LDAGULTO inserted holiday (HOL-4).'),('TL-506','LDAGULTO','Insert','2022-02-10 16:46:25','User LDAGULTO inserted holiday (HOL-5).'),('TL-505','LDAGULTO','Delete','2022-02-10 16:46:33','User LDAGULTO deleted holiday (HOL-4).'),('TL-506','LDAGULTO','Delete','2022-02-10 16:49:20','User LDAGULTO deleted holiday (HOL-5).'),('TL-507','LDAGULTO','Insert','2022-02-10 16:49:41','User LDAGULTO inserted holiday (HOL-6).'),('TL-507','LDAGULTO','Delete','2022-02-10 16:57:51','User LDAGULTO deleted holiday (HOL-6).'),('TL-508','LDAGULTO','Insert','2022-02-10 16:57:58','User LDAGULTO inserted holiday (HOL-7).'),('TL-508','LDAGULTO','Delete','2022-02-10 16:58:04','User LDAGULTO deleted holiday (HOL-7).'),('TL-509','LDAGULTO','Insert','2022-02-10 16:58:20','User LDAGULTO inserted holiday (HOL-8).'),('TL-509','LDAGULTO','Delete','2022-02-10 16:58:26','User LDAGULTO deleted holiday (HOL-8).'),('TL-510','LDAGULTO','Insert','2022-02-10 16:58:34','User LDAGULTO inserted holiday (HOL-9).'),('TL-493','LDAGULTO','Delete','2022-02-11 11:14:42','User LDAGULTO deleted leave (LV-7).'),('TL-416','LDAGULTO','Update','2022-02-11 11:14:43','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-511','LDAGULTO','Insert','2022-02-11 11:17:47','User LDAGULTO inserted leave (LV-8).'),('TL-416','LDAGULTO','Update','2022-02-11 11:17:47','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-512','LDAGULTO','Insert','2022-02-11 11:17:47','User LDAGULTO inserted leave (LV-9).'),('TL-416','LDAGULTO','Update','2022-02-11 11:17:47','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-513','LDAGULTO','Insert','2022-02-11 11:17:47','User LDAGULTO inserted leave (LV-10).'),('TL-416','LDAGULTO','Update','2022-02-11 11:17:47','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-514','LDAGULTO','Insert','2022-02-11 11:17:48','User LDAGULTO inserted leave (LV-11).'),('TL-416','LDAGULTO','Update','2022-02-11 11:17:48','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-515','LDAGULTO','Insert','2022-02-11 11:17:48','User LDAGULTO inserted leave (LV-12).'),('TL-416','LDAGULTO','Update','2022-02-11 11:17:48','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-513','LDAGULTO','Delete','2022-02-11 11:17:55','User LDAGULTO deleted leave (LV-10).'),('TL-416','LDAGULTO','Update','2022-02-11 11:17:55','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-514','LDAGULTO','Delete','2022-02-11 11:17:55','User LDAGULTO deleted leave (LV-11).'),('TL-416','LDAGULTO','Update','2022-02-11 11:17:55','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-515','LDAGULTO','Delete','2022-02-11 11:17:55','User LDAGULTO deleted leave (LV-12).'),('TL-416','LDAGULTO','Update','2022-02-11 11:17:55','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-492','LDAGULTO','Delete','2022-02-11 11:17:55','User LDAGULTO deleted leave (LV-6).'),('TL-416','LDAGULTO','Update','2022-02-11 11:17:55','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-511','LDAGULTO','Delete','2022-02-11 11:17:55','User LDAGULTO deleted leave (LV-8).'),('TL-416','LDAGULTO','Update','2022-02-11 11:17:55','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-512','LDAGULTO','Delete','2022-02-11 11:17:55','User LDAGULTO deleted leave (LV-9).'),('TL-416','LDAGULTO','Update','2022-02-11 11:17:55','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-516','LDAGULTO','Insert','2022-02-11 11:28:52','User LDAGULTO inserted leave (LV-13).'),('TL-416','LDAGULTO','Update','2022-02-11 11:28:52','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-517','LDAGULTO','Insert','2022-02-11 11:28:52','User LDAGULTO inserted leave (LV-14).'),('TL-416','LDAGULTO','Update','2022-02-11 11:28:52','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-518','LDAGULTO','Insert','2022-02-11 11:28:53','User LDAGULTO inserted leave (LV-15).'),('TL-416','LDAGULTO','Update','2022-02-11 11:28:53','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-519','LDAGULTO','Insert','2022-02-11 11:28:53','User LDAGULTO inserted leave (LV-16).'),('TL-416','LDAGULTO','Update','2022-02-11 11:28:53','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-484','LDAGULTO','Deactivated','2022-02-11 13:10:46','User LDAGULTO deactivated user account (LDAGULTO).'),('TL-484','ADMIN','Activate','2022-02-11 13:12:36','User ADMIN activated user account (LDAGULTO).'),('TL-520','LDAGULTO','Insert','2022-02-15 16:34:05','User LDAGULTO inserted policy (34).'),('TL-521','LDAGULTO','Insert','2022-02-15 16:34:16','User LDAGULTO inserted permission (156).'),('TL-522','LDAGULTO','Insert','2022-02-15 16:36:56','User LDAGULTO inserted permission (157).'),('TL-523','LDAGULTO','Insert','2022-02-15 16:37:03','User LDAGULTO inserted permission (158).'),('TL-82','LDAGULTO','Update','2022-02-15 16:38:38','User LDAGULTO updated role permission (RL-1).'),('TL-524','LDAGULTO','Insert','2022-02-16 16:26:06','User LDAGULTO inserted attendance setting (1).'),('TL-524','LDAGULTO','Update','2022-02-16 16:26:22','User LDAGULTO updated attendance setting (1).'),('TL-524','LDAGULTO','Update','2022-02-16 16:26:30','User LDAGULTO updated attendance setting (1).'),('TL-524','LDAGULTO','Update','2022-02-16 16:30:18','User LDAGULTO updated attendance setting (1).'),('TL-524','LDAGULTO','Update','2022-02-16 16:31:20','User LDAGULTO updated attendance setting (1).'),('TL-524','LDAGULTO','Update','2022-02-16 16:39:20','User LDAGULTO updated attendance setting (1).'),('TL-524','LDAGULTO','Update','2022-02-16 16:40:45','User LDAGULTO updated attendance setting (1).'),('TL-524','LDAGULTO','Update','2022-02-16 16:40:53','User LDAGULTO updated attendance setting (1).'),('TL-524','LDAGULTO','Update','2022-02-16 16:57:20','User LDAGULTO updated attendance setting (1).'),('TL-524','LDAGULTO','Update','2022-02-16 16:57:24','User LDAGULTO updated attendance setting (1).'),('TL-525','LDAGULTO','Insert','2022-02-17 09:46:51','User LDAGULTO inserted permission (159).'),('TL-82','LDAGULTO','Update','2022-02-17 10:00:41','User LDAGULTO updated role permission (RL-1).'),('TL-526','LDAGULTO','Insert','2022-02-18 10:48:54','User LDAGULTO inserted attendance time in (1).'),('TL-526','LDAGULTO','Update','2022-02-18 13:56:10','User LDAGULTO updated attendance time out (1).'),('TL-527','LDAGULTO','Insert','2022-02-18 15:16:07','User LDAGULTO inserted attendance time in (2).'),('TL-527','LDAGULTO','Update','2022-02-18 15:16:13','User LDAGULTO updated attendance time out (2).'),('TL-528','LDAGULTO','Insert','2022-02-18 15:16:45','User LDAGULTO inserted attendance time in (3).'),('TL-528','LDAGULTO','Update','2022-02-18 15:17:46','User LDAGULTO updated attendance time out (3).'),('TL-529','LDAGULTO','Insert','2022-02-18 15:40:57','User LDAGULTO inserted policy (35).'),('TL-530','LDAGULTO','Insert','2022-02-18 15:41:40','User LDAGULTO inserted permission (160).'),('TL-531','LDAGULTO','Insert','2022-02-18 15:41:57','User LDAGULTO inserted permission (161).'),('TL-532','LDAGULTO','Insert','2022-02-18 15:42:02','User LDAGULTO inserted permission (162).'),('TL-533','LDAGULTO','Insert','2022-02-18 15:42:07','User LDAGULTO inserted permission (163).'),('TL-534','LDAGULTO','Insert','2022-02-18 15:42:14','User LDAGULTO inserted permission (164).'),('TL-530','LDAGULTO','Update','2022-02-18 15:48:21','User LDAGULTO updated permission (160).'),('TL-531','LDAGULTO','Update','2022-02-18 15:48:25','User LDAGULTO updated permission (161).'),('TL-532','LDAGULTO','Update','2022-02-18 15:48:29','User LDAGULTO updated permission (162).'),('TL-533','LDAGULTO','Update','2022-02-18 15:48:35','User LDAGULTO updated permission (163).'),('TL-529','LDAGULTO','Update','2022-02-18 15:48:48','User LDAGULTO updated policy (35).'),('TL-82','LDAGULTO','Update','2022-02-18 15:49:13','User LDAGULTO updated role permission (RL-1).'),('TL-528','LDAGULTO','Update','2022-02-21 08:52:38','User LDAGULTO updated employee attendance (3).'),('TL-528','LDAGULTO','Update','2022-02-21 08:59:40','User LDAGULTO updated employee attendance (3).'),('TL-535','LDAGULTO','Insert','2022-02-21 09:04:46','User LDAGULTO inserted employee attendance (4).'),('TL-535','LDAGULTO','Update','2022-02-21 09:33:54','User LDAGULTO updated employee attendance (4).'),('TL-536','LDAGULTO','Insert','2022-02-21 10:15:56','User LDAGULTO inserted permission (165).'),('TL-82','LDAGULTO','Update','2022-02-21 10:27:09','User LDAGULTO updated role permission (RL-1).'),('TL-537','LDAGULTO','Insert','2022-02-21 14:11:16','User LDAGULTO inserted system parameter (23).'),('TL-538','LDAGULTO','Insert','2022-02-21 14:15:46','User LDAGULTO inserted health declaration (1).'),('TL-539','LDAGULTO','Insert','2022-02-21 14:23:44','User LDAGULTO inserted permission (166).'),('TL-540','LDAGULTO','Insert','2022-02-21 14:23:49','User LDAGULTO inserted permission (167).'),('TL-82','LDAGULTO','Update','2022-02-21 14:33:27','User LDAGULTO updated role permission (RL-1).'),('TL-541','LDAGULTO','Insert','2022-02-21 16:16:03','User LDAGULTO inserted attendance time in (5).'),('TL-541','LDAGULTO','Update','2022-02-21 16:16:26','User LDAGULTO updated attendance time out (5).'),('TL-542','LDAGULTO','Insert','2022-02-21 17:16:11','User LDAGULTO inserted system parameter (24).'),('TL-543','LDAGULTO','Insert','2022-02-22 10:29:10','User LDAGULTO inserted location (1).'),('TL-544','LDAGULTO','Insert','2022-02-22 10:40:15','User LDAGULTO inserted employee attendance (6).'),('TL-544','LDAGULTO','Update','2022-02-22 11:21:25','User LDAGULTO updated employee attendance (6).'),('TL-544','LDAGULTO','Update','2022-02-22 11:21:57','User LDAGULTO updated employee attendance (6).'),('TL-544','LDAGULTO','Update','2022-02-22 11:35:58','User LDAGULTO updated employee attendance (6).'),('TL-544','LDAGULTO','Update','2022-02-22 11:36:07','User LDAGULTO updated employee attendance (6).'),('TL-544','LDAGULTO','Update','2022-02-22 11:38:33','User LDAGULTO updated employee attendance (6).'),('TL-544','LDAGULTO','Update','2022-02-22 11:38:50','User LDAGULTO updated employee attendance (6).'),('TL-544','LDAGULTO','Update','2022-02-22 11:40:16','User LDAGULTO updated employee attendance (6).'),('TL-544','LDAGULTO','Update','2022-02-22 11:40:27','User LDAGULTO updated employee attendance (6).'),('TL-544','LDAGULTO','Update','2022-02-22 11:40:56','User LDAGULTO updated employee attendance (6).'),('TL-544','LDAGULTO','Update','2022-02-22 11:41:06','User LDAGULTO updated employee attendance (6).'),('TL-544','LDAGULTO','Update','2022-02-22 11:41:28','User LDAGULTO updated employee attendance (6).'),('TL-544','LDAGULTO','Update','2022-02-22 11:41:33','User LDAGULTO updated employee attendance (6).'),('TL-544','LDAGULTO','Update','2022-02-22 11:41:43','User LDAGULTO updated employee attendance (6).'),('TL-544','LDAGULTO','Update','2022-02-22 11:43:08','User LDAGULTO updated employee attendance (6).'),('TL-491','LDAGULTO','Update','2022-02-22 13:09:48','User LDAGULTO updated notification type (1).'),('TL-545','LDAGULTO','Insert','2022-02-22 13:10:01','User LDAGULTO inserted notification type (2).'),('TL-90','LDAGULTO','Update','2022-02-22 13:39:30','User LDAGULTO updated email configuration (1).'),('TL-90','LDAGULTO','Update','2022-02-22 14:32:26','User LDAGULTO updated email configuration (1).'),('TL-546','LDAGULTO','Insert','2022-02-23 09:10:34','User LDAGULTO inserted system parameter (25).'),('TL-547','LDAGULTO','Insert','2022-02-23 11:54:42','User LDAGULTO inserted attendance time in (7).'),('TL-547','LDAGULTO','Update','2022-02-23 11:55:00','User LDAGULTO updated attendance time out (7).'),('TL-548','LDAGULTO','Insert','2022-02-24 09:56:34','User LDAGULTO inserted attendance time in (8).'),('TL-549','LDAGULTO','Insert','2022-02-24 10:07:24','User LDAGULTO inserted attendance time in (9).'),('TL-548','LDAGULTO','Update','2022-02-24 10:07:33','User LDAGULTO updated attendance time out (8).'),('TL-550','LDAGULTO','Insert','2022-02-24 10:36:20','User LDAGULTO inserted attendance time in (10).'),('TL-550','LDAGULTO','Update','2022-02-24 10:36:24','User LDAGULTO updated attendance time out (10).'),('TL-551','LDAGULTO','Insert','2022-02-24 10:39:47','User LDAGULTO inserted attendance time in (11).'),('TL-551','LDAGULTO','Update','2022-02-24 10:50:28','User LDAGULTO updated attendance time out (11).'),('TL-552','LDAGULTO','Insert','2022-02-24 10:51:01','User LDAGULTO inserted attendance time in (12).'),('TL-552','LDAGULTO','Update','2022-02-24 10:52:33','User LDAGULTO updated attendance time out (12).'),('TL-553','LDAGULTO','Insert','2022-02-24 10:56:41','User LDAGULTO inserted attendance time in (13).'),('TL-553','LDAGULTO','Update','2022-02-24 10:56:45','User LDAGULTO updated attendance time out (13).'),('TL-554','LDAGULTO','Insert','2022-02-24 11:36:32','User LDAGULTO inserted attendance time in (14).'),('TL-554','LDAGULTO','Update','2022-02-24 11:36:59','User LDAGULTO updated attendance time out (14).'),('TL-555','LDAGULTO','Insert','2022-02-24 13:13:56','User LDAGULTO inserted attendance time in (15).'),('TL-555','LDAGULTO','Update','2022-02-24 13:14:38','User LDAGULTO updated attendance time out (15).'),('TL-491','LDAGULTO','Update','2022-02-24 14:08:27','User LDAGULTO updated notification type (1).'),('TL-491','LDAGULTO','Update','2022-02-24 14:10:05','User LDAGULTO updated notification type (1).'),('TL-545','LDAGULTO','Update','2022-02-24 14:10:29','User LDAGULTO updated notification type (2).'),('TL-556','LDAGULTO','Insert','2022-02-24 14:15:54','User LDAGULTO inserted attendance time in (16).'),('TL-557','LDAGULTO','Insert','2022-02-24 14:16:02','User LDAGULTO inserted attendance time in (17).'),('TL-556','LDAGULTO','Update','2022-02-24 14:16:22','User LDAGULTO updated attendance time out (16).'),('TL-491','LDAGULTO','Update','2022-02-24 15:41:39','User LDAGULTO updated notification type (1).'),('TL-558','LDAGULTO','Insert','2022-02-24 16:32:10','User LDAGULTO inserted policy (36).'),('TL-559','LDAGULTO','Insert','2022-02-24 16:32:30','User LDAGULTO inserted permission (168).'),('TL-560','LDAGULTO','Insert','2022-02-24 16:32:59','User LDAGULTO inserted permission (169).'),('TL-561','LDAGULTO','Insert','2022-02-24 16:33:08','User LDAGULTO inserted permission (170).'),('TL-82','LDAGULTO','Update','2022-02-24 16:39:29','User LDAGULTO updated role permission (RL-1).'),('TL-562','LDAGULTO','Insert','2022-02-28 09:37:40','User LDAGULTO inserted attendance time in (18).'),('TL-562','LDAGULTO','Update','2022-02-28 09:38:12','User LDAGULTO updated attendance time out (18).'),('TL-563','LDAGULTO','Insert','2022-02-28 09:42:12','User LDAGULTO inserted attendance time in (19).'),('TL-563','LDAGULTO','Update','2022-02-28 09:42:36','User LDAGULTO updated attendance time out (19).'),('TL-524','LDAGULTO','Update','2022-03-10 13:18:19','User LDAGULTO updated attendance setting (1).'),('TL-524','LDAGULTO','Update','2022-03-10 13:18:28','User LDAGULTO updated attendance setting (1).'),('TL-564','LDAGULTO','Insert','2022-03-10 14:09:13','User LDAGULTO inserted attendance time in (20).'),('TL-524','LDAGULTO','Update','2022-03-10 14:09:54','User LDAGULTO updated attendance setting (1).'),('TL-564','LDAGULTO','Update','2022-03-10 14:11:11','User LDAGULTO updated attendance time out (20).'),('TL-565','LDAGULTO','Insert','2022-03-10 14:11:46','User LDAGULTO inserted attendance time in (21).'),('TL-565','LDAGULTO','Update','2022-03-10 14:13:09','User LDAGULTO updated attendance time out (21).'),('TL-563','LDAGULTO','Update','2022-03-10 14:15:14','User LDAGULTO updated employee attendance (19).'),('TL-524','LDAGULTO','Update','2022-03-10 15:30:10','User LDAGULTO updated attendance setting (1).'),('TL-524','LDAGULTO','Update','2022-03-10 15:41:19','User LDAGULTO updated attendance setting (1).'),('TL-524','LDAGULTO','Update','2022-03-10 16:17:18','User LDAGULTO updated attendance setting (1).'),('TL-565','LDAGULTO','Update','2022-03-10 16:20:51','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:21:06','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:21:29','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:22:10','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:22:20','User LDAGULTO updated employee attendance (21).'),('TL-524','LDAGULTO','Update','2022-03-10 16:22:39','User LDAGULTO updated attendance setting (1).'),('TL-565','LDAGULTO','Update','2022-03-10 16:22:44','User LDAGULTO updated employee attendance (21).'),('TL-524','LDAGULTO','Update','2022-03-10 16:22:51','User LDAGULTO updated attendance setting (1).'),('TL-524','LDAGULTO','Update','2022-03-10 16:22:55','User LDAGULTO updated attendance setting (1).'),('TL-565','LDAGULTO','Update','2022-03-10 16:23:03','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:23:14','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:24:53','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:25:00','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:28:28','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:43:17','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:47:14','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:47:20','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:47:38','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:47:43','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:47:53','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:58:14','User LDAGULTO updated employee attendance (21).'),('TL-524','LDAGULTO','Update','2022-03-10 16:58:20','User LDAGULTO updated attendance setting (1).'),('TL-565','LDAGULTO','Update','2022-03-10 16:58:25','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:58:56','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:59:15','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:59:22','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 16:59:34','User LDAGULTO updated employee attendance (21).'),('TL-524','LDAGULTO','Update','2022-03-10 17:01:15','User LDAGULTO updated attendance setting (1).'),('TL-565','LDAGULTO','Update','2022-03-10 17:01:19','User LDAGULTO updated employee attendance (21).'),('TL-565','LDAGULTO','Update','2022-03-10 17:05:39','User LDAGULTO updated employee attendance (21).'),('TL-524','LDAGULTO','Update','2022-03-10 17:13:40','User LDAGULTO updated attendance setting (1).'),('TL-566','LDAGULTO','Insert','2022-03-11 08:49:31','User LDAGULTO inserted policy (37).'),('TL-567','LDAGULTO','Insert','2022-03-11 08:49:56','User LDAGULTO inserted permission (171).'),('TL-82','LDAGULTO','Update','2022-03-11 08:56:16','User LDAGULTO updated role permission (RL-1).'),('TL-568','LDAGULTO','Insert','2022-03-11 09:28:34','User LDAGULTO inserted permission (172).'),('TL-569','LDAGULTO','Insert','2022-03-11 09:29:01','User LDAGULTO inserted permission (173).'),('TL-570','LDAGULTO','Insert','2022-03-11 09:29:09','User LDAGULTO inserted permission (174).'),('TL-568','LDAGULTO','Update','2022-03-11 09:29:45','User LDAGULTO updated permission (172).'),('TL-569','LDAGULTO','Update','2022-03-11 09:29:49','User LDAGULTO updated permission (173).'),('TL-570','LDAGULTO','Update','2022-03-11 09:29:55','User LDAGULTO updated permission (174).'),('TL-571','LDAGULTO','Insert','2022-03-11 09:30:02','User LDAGULTO inserted permission (175).'),('TL-572','LDAGULTO','Insert','2022-03-11 09:30:19','User LDAGULTO inserted permission (176).'),('TL-573','LDAGULTO','Insert','2022-03-11 09:31:07','User LDAGULTO inserted permission (177).'),('TL-574','LDAGULTO','Insert','2022-03-11 09:31:15','User LDAGULTO inserted permission (178).'),('TL-575','LDAGULTO','Insert','2022-03-11 09:31:21','User LDAGULTO inserted permission (179).'),('TL-569','LDAGULTO','Update','2022-03-11 09:41:04','User LDAGULTO updated permission (173).'),('TL-570','LDAGULTO','Update','2022-03-11 09:41:09','User LDAGULTO updated permission (174).'),('TL-569','LDAGULTO','Update','2022-03-11 09:42:21','User LDAGULTO updated permission (173).'),('TL-570','LDAGULTO','Update','2022-03-11 09:42:36','User LDAGULTO updated permission (174).'),('TL-571','LDAGULTO','Delete','2022-03-11 09:42:46','User LDAGULTO deleted permission (175).'),('TL-572','LDAGULTO','Delete','2022-03-11 09:42:46','User LDAGULTO deleted permission (176).'),('TL-573','LDAGULTO','Delete','2022-03-11 09:42:46','User LDAGULTO deleted permission (177).'),('TL-574','LDAGULTO','Delete','2022-03-11 09:42:46','User LDAGULTO deleted permission (178).'),('TL-575','LDAGULTO','Delete','2022-03-11 09:42:46','User LDAGULTO deleted permission (179).'),('TL-5','LDAGULTO','Update','2022-03-11 09:42:59','User LDAGULTO updated system parameter (4).'),('TL-568','LDAGULTO','Update','2022-03-11 09:43:18','User LDAGULTO updated permission (172).'),('TL-82','LDAGULTO','Update','2022-03-11 09:46:27','User LDAGULTO updated role permission (RL-1).'),('TL-570','LDAGULTO','Update','2022-03-11 09:46:52','User LDAGULTO updated permission (174).'),('TL-568','LDAGULTO','Update','2022-03-11 09:47:00','User LDAGULTO updated permission (172).'),('TL-569','LDAGULTO','Update','2022-03-11 09:47:05','User LDAGULTO updated permission (173).'),('TL-563','LDAGULTO','Update','2022-03-11 13:13:02','User LDAGULTO updated attendance time out (19).'),('TL-576','LDAGULTO','Insert','2022-03-11 13:14:15','User LDAGULTO inserted attendance time in (22).'),('TL-577','LDAGULTO','Insert','2022-03-11 14:42:17','User LDAGULTO inserted upload setting (9).'),('TL-578','LDAGULTO','Insert','2022-03-11 14:48:59','User LDAGULTO inserted upload setting (10).'),('TL-577','LDAGULTO','Update','2022-03-11 14:50:47','User LDAGULTO updated upload setting (9).'),('TL-579','LDAGULTO','Insert','2022-03-11 14:53:22','User LDAGULTO inserted system parameter (26).'),('TL-580','LDAGULTO','Insert','2022-03-11 14:53:31','User LDAGULTO inserted system parameter (27).'),('TL-581','LDAGULTO','Insert','2022-03-11 16:31:39','User LDAGULTO inserted attendance creation (1).'),('TL-582','LDAGULTO','Insert','2022-03-11 16:33:33','User LDAGULTO inserted attendance creation (2).'),('TL-583','LDAGULTO','Insert','2022-03-11 16:40:37','User LDAGULTO inserted attendance creation (3).'),('TL-584','LDAGULTO','Insert','2022-03-11 16:41:03','User LDAGULTO inserted attendance creation (4).'),('TL-585','LDAGULTO','Insert','2022-03-11 16:41:26','User LDAGULTO inserted attendance creation (5).'),('TL-585','LDAGULTO','Update','2022-03-11 16:41:27','User LDAGULTO updated attendance creation file (5).'),('TL-586','LDAGULTO','Insert','2022-03-14 14:57:21','User LDAGULTO inserted policy (38).'),('TL-587','LDAGULTO','Insert','2022-03-14 14:58:35','User LDAGULTO inserted policy (39).'),('TL-588','LDAGULTO','Insert','2022-03-14 14:59:39','User LDAGULTO inserted permission (175).'),('TL-589','LDAGULTO','Insert','2022-03-14 14:59:45','User LDAGULTO inserted permission (176).'),('TL-589','LDAGULTO','Update','2022-03-14 14:59:50','User LDAGULTO updated permission (176).'),('TL-590','LDAGULTO','Insert','2022-03-14 15:00:02','User LDAGULTO inserted permission (177).'),('TL-591','LDAGULTO','Insert','2022-03-14 15:00:09','User LDAGULTO inserted permission (178).'),('TL-592','LDAGULTO','Insert','2022-03-14 15:00:14','User LDAGULTO inserted permission (179).'),('TL-593','LDAGULTO','Insert','2022-03-14 15:00:26','User LDAGULTO inserted permission (180).'),('TL-594','LDAGULTO','Insert','2022-03-14 15:01:37','User LDAGULTO inserted permission (181).'),('TL-595','LDAGULTO','Insert','2022-03-14 15:01:44','User LDAGULTO inserted permission (182).'),('TL-596','LDAGULTO','Insert','2022-03-14 15:01:51','User LDAGULTO inserted permission (183).'),('TL-597','LDAGULTO','Insert','2022-03-14 15:01:58','User LDAGULTO inserted permission (184).'),('TL-597','LDAGULTO','Update','2022-03-14 15:02:04','User LDAGULTO updated permission (184).'),('TL-598','LDAGULTO','Insert','2022-03-14 15:02:14','User LDAGULTO inserted permission (185).'),('TL-599','LDAGULTO','Insert','2022-03-14 15:02:21','User LDAGULTO inserted permission (186).'),('TL-82','LDAGULTO','Update','2022-03-14 15:04:53','User LDAGULTO updated role permission (RL-1).'),('TL-600','LDAGULTO','Insert','2022-03-14 15:51:34','User LDAGULTO inserted leave (LV-17).'),('TL-416','LDAGULTO','Update','2022-03-14 15:51:34','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-601','LDAGULTO','Insert','2022-03-15 10:20:16','User LDAGULTO inserted attendance creation (6).'),('TL-601','LDAGULTO','Update','2022-03-15 10:20:16','User LDAGULTO updated attendance creation file (6).'),('TL-601','LDAGULTO','Update','2022-03-15 10:43:23','User LDAGULTO updated attendance creation (6).'),('TL-581','LDAGULTO','Update','2022-03-15 10:52:17','User LDAGULTO updated attendance creation file (1).'),('TL-581','LDAGULTO','Update','2022-03-15 10:52:17','User LDAGULTO updated attendance creation (1).'),('TL-581','LDAGULTO','Update','2022-03-15 10:52:46','User LDAGULTO updated attendance creation file (1).'),('TL-581','LDAGULTO','Update','2022-03-15 10:52:46','User LDAGULTO updated attendance creation (1).'),('TL-581','LDAGULTO','Delete','2022-03-15 11:45:20','User LDAGULTO deleted attendance creation (1).'),('TL-582','LDAGULTO','Delete','2022-03-15 11:45:35','User LDAGULTO deleted attendance creation (2).'),('TL-583','LDAGULTO','Delete','2022-03-15 11:46:06','User LDAGULTO deleted attendance creation (3).'),('TL-584','LDAGULTO','Delete','2022-03-15 11:47:31','User LDAGULTO deleted attendance creation (4).'),('TL-585','LDAGULTO','Delete','2022-03-15 11:47:31','User LDAGULTO deleted attendance creation (5).'),('TL-601','LDAGULTO','Update','2022-03-15 11:55:16','User LDAGULTO updated attendance creation (6).'),('TL-601','LDAGULTO','Update','2022-03-15 11:55:25','User LDAGULTO updated attendance creation (6).'),('TL-253','LDAGULTO','Update','2022-03-15 13:01:23','User LDAGULTO updated employee (48).'),('TL-256','LDAGULTO','Update','2022-03-15 13:01:56','User LDAGULTO updated employee (51).'),('TL-253','LDAGULTO','Update','2022-03-15 13:02:27','User LDAGULTO updated employee (48).'),('TL-256','LDAGULTO','Update','2022-03-15 13:02:35','User LDAGULTO updated employee (51).'),('TL-253','LDAGULTO','Update','2022-03-15 13:03:30','User LDAGULTO updated employee (48).'),('TL-253','LDAGULTO','Update','2022-03-15 13:03:37','User LDAGULTO updated employee (48).'),('TL-253','LDAGULTO','Update','2022-03-15 13:04:12','User LDAGULTO updated employee (48).'),('TL-602','LDAGULTO','Insert','2022-03-15 13:18:39','User LDAGULTO inserted designation (DES-18).'),('TL-602','LDAGULTO','Update','2022-03-15 13:18:56','User LDAGULTO updated designation (DES-18).'),('TL-602','LDAGULTO','Delete','2022-03-15 13:19:09','User LDAGULTO deleted designation (DES-18).'),('TL-480','LDAGULTO','Activate','2022-03-15 13:29:05','User LDAGULTO activated user account (KSVILLAR).'),('TL-220','LDAGULTO','Update','2022-03-15 13:30:36','User LDAGULTO updated employee (7).'),('TL-220','LDAGULTO','Update','2022-03-15 13:30:44','User LDAGULTO updated employee (7).'),('TL-220','LDAGULTO','Update','2022-03-15 13:30:55','User LDAGULTO updated employee (7).'),('TL-494','LDAGULTO','Update','2022-03-15 13:31:10','User LDAGULTO updated employee file (1).'),('TL-220','LDAGULTO','Update','2022-03-15 13:31:19','User LDAGULTO updated employee (7).'),('TL-479','LDAGULTO','Lock','2022-03-15 13:31:53','User LDAGULTO locked user account (GTBONITA).'),('TL-479','LDAGULTO','Unlock','2022-03-15 13:32:03','User LDAGULTO unlocked user account (GTBONITA).'),('TL-603','LDAGULTO','Insert','2022-03-15 14:21:29','User LDAGULTO inserted leave (LV-18).'),('TL-416','LDAGULTO','Update','2022-03-15 14:21:29','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-604','LDAGULTO','Insert','2022-03-15 14:22:33','User LDAGULTO inserted leave (LV-19).'),('TL-416','LDAGULTO','Update','2022-03-15 14:22:33','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-600','LDAGULTO','Approve','2022-03-15 14:43:07','User LDAGULTO approved leave (LV-17).'),('TL-605','LDAGULTO','Insert','2022-03-15 17:27:24','User LDAGULTO inserted leave (LV-20).'),('TL-416','LDAGULTO','Update','2022-03-15 17:27:24','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-603','LDAGULTO','Approve','2022-03-15 17:28:25','User LDAGULTO approved leave (LV-18).'),('TL-603','LDAGULTO','Approve','2022-03-15 17:28:40','User LDAGULTO approved leave (LV-18).'),('TL-603','LDAGULTO','Approve','2022-03-15 17:29:19','User LDAGULTO approved leave (LV-18).'),('TL-605','LDAGULTO','Approve','2022-03-15 17:29:51','User LDAGULTO approved leave (LV-20).'),('TL-605','LDAGULTO','Cancel','2022-03-15 17:29:56','User LDAGULTO cancelled leave (LV-20).'),('TL-416','LDAGULTO','Update','2022-03-15 17:29:56','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-605','LDAGULTO','Cancel','2022-03-15 17:30:12','User LDAGULTO cancelled leave (LV-20).'),('TL-416','LDAGULTO','Update','2022-03-15 17:30:12','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-604','LDAGULTO','Reject','2022-03-15 17:30:21','User LDAGULTO rejected leave (LV-19).'),('TL-416','LDAGULTO','Update','2022-03-15 17:30:21','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-606','LDAGULTO','Insert','2022-03-15 17:31:29','User LDAGULTO inserted leave (LV-21).'),('TL-416','LDAGULTO','Update','2022-03-15 17:31:29','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-607','LDAGULTO','Insert','2022-03-15 17:31:29','User LDAGULTO inserted leave (LV-22).'),('TL-416','LDAGULTO','Update','2022-03-15 17:31:29','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-608','LDAGULTO','Insert','2022-03-15 17:31:30','User LDAGULTO inserted leave (LV-23).'),('TL-416','LDAGULTO','Update','2022-03-15 17:31:30','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-609','LDAGULTO','Insert','2022-03-15 17:31:30','User LDAGULTO inserted leave (LV-24).'),('TL-416','LDAGULTO','Update','2022-03-15 17:31:30','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-610','LDAGULTO','Insert','2022-03-15 17:31:30','User LDAGULTO inserted leave (LV-25).'),('TL-416','LDAGULTO','Update','2022-03-15 17:31:31','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-606','LDAGULTO','Approve','2022-03-15 17:31:40','User LDAGULTO approved leave (LV-21).'),('TL-607','LDAGULTO','Approve','2022-03-15 17:31:40','User LDAGULTO approved leave (LV-22).'),('TL-608','LDAGULTO','Approve','2022-03-15 17:31:40','User LDAGULTO approved leave (LV-23).'),('TL-610','LDAGULTO','Approve','2022-03-15 17:31:40','User LDAGULTO approved leave (LV-25).'),('TL-609','LDAGULTO','Reject','2022-03-15 17:31:50','User LDAGULTO rejected leave (LV-24).'),('TL-416','LDAGULTO','Update','2022-03-15 17:31:50','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-611','LDAGULTO','Insert','2022-03-16 09:54:11','User LDAGULTO inserted leave (LV-26).'),('TL-416','LDAGULTO','Update','2022-03-16 09:54:11','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-612','LDAGULTO','Insert','2022-03-16 09:54:11','User LDAGULTO inserted leave (LV-27).'),('TL-416','LDAGULTO','Update','2022-03-16 09:54:11','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-613','LDAGULTO','Insert','2022-03-16 09:54:12','User LDAGULTO inserted leave (LV-28).'),('TL-416','LDAGULTO','Update','2022-03-16 09:54:12','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-614','LDAGULTO','Insert','2022-03-16 09:54:12','User LDAGULTO inserted leave (LV-29).'),('TL-416','LDAGULTO','Update','2022-03-16 09:54:12','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-615','LDAGULTO','Insert','2022-03-16 09:54:12','User LDAGULTO inserted leave (LV-30).'),('TL-416','LDAGULTO','Update','2022-03-16 09:54:13','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-611','LDAGULTO','Approve','2022-03-16 09:54:18','User LDAGULTO approved leave (LV-26).'),('TL-612','LDAGULTO','Approve','2022-03-16 09:54:18','User LDAGULTO approved leave (LV-27).'),('TL-613','LDAGULTO','Reject','2022-03-16 09:55:51','User LDAGULTO rejected leave (LV-28).'),('TL-416','LDAGULTO','Update','2022-03-16 09:55:51','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-614','LDAGULTO','Reject','2022-03-16 09:55:51','User LDAGULTO rejected leave (LV-29).'),('TL-416','LDAGULTO','Update','2022-03-16 09:55:51','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-615','LDAGULTO','Cancel','2022-03-16 09:55:58','User LDAGULTO cancelled leave (LV-30).'),('TL-416','LDAGULTO','Update','2022-03-16 09:55:58','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-616','LDAGULTO','Insert','2022-03-16 09:56:18','User LDAGULTO inserted leave (LV-31).'),('TL-416','LDAGULTO','Update','2022-03-16 09:56:18','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-617','LDAGULTO','Insert','2022-03-16 10:01:11','User LDAGULTO inserted leave (LV-32).'),('TL-416','LDAGULTO','Update','2022-03-16 10:01:11','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-616','LDAGULTO','Cancel','2022-03-16 10:08:33','User LDAGULTO cancelled leave (LV-31).'),('TL-416','LDAGULTO','Update','2022-03-16 10:08:33','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-617','LDAGULTO','Reject','2022-03-16 10:08:39','User LDAGULTO rejected leave (LV-32).'),('TL-416','LDAGULTO','Update','2022-03-16 10:08:39','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-618','LDAGULTO','Insert','2022-03-16 10:52:46','User LDAGULTO inserted leave (LV-33).'),('TL-416','LDAGULTO','Update','2022-03-16 10:52:46','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-619','LDAGULTO','Insert','2022-03-16 10:57:12','User LDAGULTO inserted system code (LVAPVSTAT).'),('TL-620','LDAGULTO','Insert','2022-03-16 10:57:23','User LDAGULTO inserted system code (APV).'),('TL-621','LDAGULTO','Insert','2022-03-16 10:57:36','User LDAGULTO inserted system code (APVSYS).'),('TL-622','LDAGULTO','Insert','2022-03-16 10:57:44','User LDAGULTO inserted system code (CAN).'),('TL-623','LDAGULTO','Insert','2022-03-16 10:57:53','User LDAGULTO inserted system code (PEN).'),('TL-624','LDAGULTO','Insert','2022-03-16 10:58:04','User LDAGULTO inserted system code (REJ).'),('TL-625','LDAGULTO','Insert','2022-03-16 11:17:57','User LDAGULTO inserted leave (LV-34).'),('TL-416','LDAGULTO','Update','2022-03-16 11:17:57','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-626','LDAGULTO','Insert','2022-03-16 11:17:58','User LDAGULTO inserted leave (LV-35).'),('TL-416','LDAGULTO','Update','2022-03-16 11:17:58','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-627','LDAGULTO','Insert','2022-03-16 11:17:58','User LDAGULTO inserted leave (LV-36).'),('TL-416','LDAGULTO','Update','2022-03-16 11:17:58','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-628','LDAGULTO','Insert','2022-03-16 11:17:58','User LDAGULTO inserted leave (LV-37).'),('TL-416','LDAGULTO','Update','2022-03-16 11:17:58','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-611','LDAGULTO','Cancel','2022-03-16 11:21:37','User LDAGULTO approved leave (LV-26).'),('TL-416','LDAGULTO','Update','2022-03-16 11:21:37','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-625','LDAGULTO','Approve','2022-03-16 11:30:12','User LDAGULTO approved leave (LV-34).'),('TL-626','LDAGULTO','Reject','2022-03-16 11:30:15','User LDAGULTO rejected leave (LV-35).'),('TL-416','LDAGULTO','Update','2022-03-16 11:30:16','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-627','LDAGULTO','Reject','2022-03-16 11:30:21','User LDAGULTO rejected leave (LV-36).'),('TL-416','LDAGULTO','Update','2022-03-16 11:30:21','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-628','LDAGULTO','Cancel','2022-03-16 11:30:24','User LDAGULTO approved leave (LV-37).'),('TL-416','LDAGULTO','Update','2022-03-16 11:30:25','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-629','LDAGULTO','Insert','2022-03-16 11:39:15','User LDAGULTO inserted attendance creation (7).'),('TL-629','LDAGULTO','Update','2022-03-16 11:39:16','User LDAGULTO updated attendance creation file (7).'),('TL-592','LDAGULTO','Update','2022-03-16 13:26:40','User LDAGULTO updated permission (179).'),('TL-593','LDAGULTO','Update','2022-03-16 13:26:52','User LDAGULTO updated permission (180).'),('TL-594','LDAGULTO','Delete','2022-03-16 13:26:57','User LDAGULTO deleted permission (181).'),('TL-595','LDAGULTO','Delete','2022-03-16 13:26:57','User LDAGULTO deleted permission (182).'),('TL-596','LDAGULTO','Delete','2022-03-16 13:26:57','User LDAGULTO deleted permission (183).'),('TL-597','LDAGULTO','Delete','2022-03-16 13:26:57','User LDAGULTO deleted permission (184).'),('TL-598','LDAGULTO','Delete','2022-03-16 13:26:58','User LDAGULTO deleted permission (185).'),('TL-599','LDAGULTO','Delete','2022-03-16 13:26:58','User LDAGULTO deleted permission (186).'),('TL-5','LDAGULTO','Update','2022-03-16 13:27:08','User LDAGULTO updated system parameter (4).'),('TL-630','LDAGULTO','Insert','2022-03-16 13:27:17','User LDAGULTO inserted permission (181).'),('TL-631','LDAGULTO','Insert','2022-03-16 13:27:47','User LDAGULTO inserted permission (182).'),('TL-632','LDAGULTO','Insert','2022-03-16 13:27:56','User LDAGULTO inserted permission (183).'),('TL-633','LDAGULTO','Insert','2022-03-16 13:28:03','User LDAGULTO inserted permission (184).'),('TL-634','LDAGULTO','Insert','2022-03-16 13:28:10','User LDAGULTO inserted permission (185).'),('TL-635','LDAGULTO','Insert','2022-03-16 13:28:19','User LDAGULTO inserted permission (186).'),('TL-634','LDAGULTO','Update','2022-03-16 13:28:24','User LDAGULTO updated permission (185).'),('TL-636','LDAGULTO','Insert','2022-03-16 13:28:31','User LDAGULTO inserted permission (187).'),('TL-82','LDAGULTO','Update','2022-03-16 13:41:00','User LDAGULTO updated role permission (RL-1).'),('TL-634','LDAGULTO','Update','2022-03-16 13:45:41','User LDAGULTO updated permission (185).'),('TL-592','LDAGULTO','Update','2022-03-16 13:46:02','User LDAGULTO updated permission (179).'),('TL-637','LDAGULTO','Insert','2022-03-16 13:55:01','User LDAGULTO inserted leave (LV-38).'),('TL-416','LDAGULTO','Update','2022-03-16 13:55:01','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-629','LDAGULTO','Cancel','2022-03-16 14:36:02','User LDAGULTO cancelled attendance creation (7).'),('TL-601','LDAGULTO','For Recommendation','2022-03-16 15:05:47','User LDAGULTO tagged the attendance creation for recommendation (6).'),('TL-601','LDAGULTO','Cancel','2022-03-16 15:45:10','User LDAGULTO cancelled attendance creation (6).'),('TL-638','LDAGULTO','Insert','2022-03-16 15:58:00','User LDAGULTO inserted attendance creation (8).'),('TL-638','LDAGULTO','Update','2022-03-16 15:58:00','User LDAGULTO updated attendance creation file (8).'),('TL-638','LDAGULTO','For Recommendation','2022-03-16 16:19:45','User LDAGULTO tagged the attendance creation for recommendation (8).'),('TL-638','LDAGULTO','Cancel','2022-03-16 16:57:15','User LDAGULTO cancelled attendance creation (8).'),('TL-639','LDAGULTO','Insert','2022-03-17 09:12:58','User LDAGULTO inserted attendance creation (9).'),('TL-639','LDAGULTO','Update','2022-03-17 09:12:58','User LDAGULTO updated attendance creation file (9).'),('TL-639','LDAGULTO','For Recommendation','2022-03-17 09:13:06','User LDAGULTO tagged the attendance creation for recommendation (9).'),('TL-640','LDAGULTO','Insert','2022-03-17 10:31:48','User LDAGULTO inserted attendance adjustment (1).'),('TL-640','LDAGULTO','Update','2022-03-17 10:31:48','User LDAGULTO updated attendance adjustment file (1).'),('TL-640','LDAGULTO','Update','2022-03-17 14:06:30','User LDAGULTO updated attendance adjustment (1).'),('TL-640','LDAGULTO','Update','2022-03-17 14:06:41','User LDAGULTO updated attendance adjustment (1).'),('TL-640','LDAGULTO','Update','2022-03-17 14:07:17','User LDAGULTO updated attendance adjustment (1).'),('TL-640','LDAGULTO','Update','2022-03-17 14:07:18','User LDAGULTO updated attendance adjustment file (1).'),('TL-640','LDAGULTO','For Recommendation','2022-03-17 14:22:49','User LDAGULTO tagged the attendance adjustment for recommendation (1).'),('TL-640','LDAGULTO','Cancel','2022-03-17 14:25:13','User LDAGULTO cancelled attendance adjustment (1).'),('TL-641','LDAGULTO','Insert','2022-03-17 14:31:30','User LDAGULTO inserted attendance adjustment (2).'),('TL-641','LDAGULTO','Update','2022-03-17 14:31:30','User LDAGULTO updated attendance adjustment file (2).'),('TL-641','LDAGULTO','For Recommendation','2022-03-17 14:31:53','User LDAGULTO tagged the attendance adjustment for recommendation (2).'),('TL-641','LDAGULTO','Cancel','2022-03-17 14:32:08','User LDAGULTO cancelled attendance adjustment (2).'),('TL-642','LDAGULTO','Insert','2022-03-18 09:44:10','User LDAGULTO inserted policy (40).'),('TL-643','LDAGULTO','Insert','2022-03-18 09:44:30','User LDAGULTO inserted policy (41).'),('TL-644','LDAGULTO','Insert','2022-03-18 09:45:04','User LDAGULTO inserted permission (188).'),('TL-645','LDAGULTO','Insert','2022-03-18 09:45:14','User LDAGULTO inserted permission (189).'),('TL-646','LDAGULTO','Insert','2022-03-18 09:45:21','User LDAGULTO inserted permission (190).'),('TL-647','LDAGULTO','Insert','2022-03-18 09:45:32','User LDAGULTO inserted permission (191).'),('TL-82','LDAGULTO','Update','2022-03-18 09:49:17','User LDAGULTO updated role permission (RL-1).'),('TL-648','LDAGULTO','Insert','2022-03-18 10:03:46','User LDAGULTO inserted notification details (1).'),('TL-649','LDAGULTO','Insert','2022-03-18 10:04:38','User LDAGULTO inserted notification details (2).'),('TL-650','LDAGULTO','Insert','2022-03-18 10:05:29','User LDAGULTO inserted notification type (3).'),('TL-651','LDAGULTO','Insert','2022-03-18 10:05:41','User LDAGULTO inserted notification type (4).'),('TL-652','LDAGULTO','Insert','2022-03-18 10:07:27','User LDAGULTO inserted notification details (3).'),('TL-650','LDAGULTO','Update','2022-03-18 10:09:45','User LDAGULTO updated notification details (3).'),('TL-650','LDAGULTO','Update','2022-03-18 10:10:23','User LDAGULTO updated notification details (3).'),('TL-653','LDAGULTO','Insert','2022-03-18 10:11:35','User LDAGULTO inserted notification details (4).'),('TL-94','LDAGULTO','Update','2022-03-18 10:12:28','User LDAGULTO updated department (DEPT-1).'),('TL-654','LDAGULTO','Insert','2022-03-18 11:25:13','User LDAGULTO inserted attendance creation (10).'),('TL-654','LDAGULTO','Update','2022-03-18 11:25:13','User LDAGULTO updated attendance creation file (10).'),('TL-654','LDAGULTO','For Recommendation','2022-03-18 11:25:16','User LDAGULTO tagged the attendance creation for recommendation (10).'),('TL-655','LDAGULTO','Insert','2022-03-18 11:26:13','User LDAGULTO inserted attendance creation (11).'),('TL-655','LDAGULTO','Update','2022-03-18 11:26:13','User LDAGULTO updated attendance creation file (11).'),('TL-655','LDAGULTO','For Recommendation','2022-03-18 11:26:15','User LDAGULTO tagged the attendance creation for recommendation (11).'),('TL-655','LDAGULTO','For Recommendation','2022-03-18 11:28:22','User LDAGULTO tagged the attendance creation for recommendation (11).'),('TL-656','LDAGULTO','Insert','2022-03-18 11:43:02','User LDAGULTO inserted attendance adjustment (3).'),('TL-656','LDAGULTO','Update','2022-03-18 11:43:02','User LDAGULTO updated attendance adjustment file (3).'),('TL-656','LDAGULTO','For Recommendation','2022-03-18 11:43:08','User LDAGULTO tagged the attendance adjustment for recommendation (3).'),('TL-657','LDAGULTO','Insert','2022-03-18 11:44:16','User LDAGULTO inserted attendance adjustment (4).'),('TL-657','LDAGULTO','Update','2022-03-18 11:44:17','User LDAGULTO updated attendance adjustment file (4).'),('TL-657','LDAGULTO','For Recommendation','2022-03-18 11:44:22','User LDAGULTO tagged the attendance adjustment for recommendation (4).'),('TL-654','LDAGULTO','For Recommendation','2022-03-18 14:22:56','User LDAGULTO tagged the attendance creation for recommendation (10).'),('TL-655','LDAGULTO','For Recommendation','2022-03-18 14:22:58','User LDAGULTO tagged the attendance creation for recommendation (11).'),('TL-658','LDAGULTO','Insert','2022-03-18 14:27:52','User LDAGULTO inserted notification type (5).'),('TL-659','LDAGULTO','Insert','2022-03-18 14:28:14','User LDAGULTO inserted notification type (6).'),('TL-660','LDAGULTO','Insert','2022-03-18 14:37:10','User LDAGULTO inserted notification details (5).'),('TL-661','LDAGULTO','Insert','2022-03-18 14:37:44','User LDAGULTO inserted notification details (6).'),('TL-654','LDAGULTO','Recommend','2022-03-18 14:48:29','User LDAGULTO recommended attendance creation (10).'),('TL-655','LDAGULTO','Recommend','2022-03-18 14:49:50','User LDAGULTO recommended attendance creation (11).'),('TL-655','LDAGULTO','Recommend','2022-03-18 14:50:55','User LDAGULTO recommended attendance creation (11).'),('TL-662','LDAGULTO','Insert','2022-03-18 15:15:09','User LDAGULTO inserted permission (192).'),('TL-663','LDAGULTO','Insert','2022-03-18 15:15:18','User LDAGULTO inserted permission (193).'),('TL-664','LDAGULTO','Insert','2022-03-18 15:15:26','User LDAGULTO inserted permission (194).'),('TL-665','LDAGULTO','Insert','2022-03-18 15:15:33','User LDAGULTO inserted permission (195).'),('TL-82','LDAGULTO','Update','2022-03-18 15:24:07','User LDAGULTO updated role permission (RL-1).'),('TL-656','LDAGULTO','Recommend','2022-03-18 15:58:08','User LDAGULTO recommended attendance adjustment (3).'),('TL-656','LDAGULTO','Recommend','2022-03-18 15:59:03','User LDAGULTO recommended attendance adjustment (3).'),('TL-656','LDAGULTO','Recommend','2022-03-18 15:59:49','User LDAGULTO recommended attendance adjustment (3).'),('TL-656','LDAGULTO','Recommend','2022-03-18 16:01:38','User LDAGULTO recommended attendance adjustment (3).'),('TL-656','LDAGULTO','Recommend','2022-03-18 16:01:57','User LDAGULTO recommended attendance adjustment (3).'),('TL-656','LDAGULTO','Recommend','2022-03-18 16:02:30','User LDAGULTO recommended attendance adjustment (3).'),('TL-657','LDAGULTO','Recommend','2022-03-18 16:02:36','User LDAGULTO recommended attendance adjustment (4).'),('TL-666','LDAGULTO','Insert','2022-03-21 08:43:43','User LDAGULTO inserted notification type (7).'),('TL-667','LDAGULTO','Insert','2022-03-21 08:44:10','User LDAGULTO inserted notification type (8).'),('TL-668','LDAGULTO','Insert','2022-03-21 08:45:49','User LDAGULTO inserted notification details (7).'),('TL-669','LDAGULTO','Insert','2022-03-21 08:46:41','User LDAGULTO inserted notification details (8).'),('TL-639','LDAGULTO','Cancel','2022-03-21 09:06:48','User LDAGULTO cancelled attendance creation (9).'),('TL-639','LDAGULTO','Cancel','2022-03-21 09:07:38','User LDAGULTO cancelled attendance creation (9).'),('TL-670','LDAGULTO','Insert','2022-03-21 09:12:30','User LDAGULTO inserted attendance adjustment (5).'),('TL-670','LDAGULTO','Update','2022-03-21 09:12:30','User LDAGULTO updated attendance adjustment file (5).'),('TL-670','LDAGULTO','Cancel','2022-03-21 09:12:38','User LDAGULTO cancelled attendance adjustment (5).'),('TL-670','LDAGULTO','Cancel','2022-03-21 09:13:32','User LDAGULTO cancelled attendance adjustment (5).'),('TL-670','LDAGULTO','Cancel','2022-03-21 09:13:55','User LDAGULTO cancelled attendance adjustment (5).'),('TL-670','LDAGULTO','Cancel','2022-03-21 09:14:36','User LDAGULTO cancelled attendance adjustment (5).'),('TL-670','LDAGULTO','Cancel','2022-03-21 09:20:16','User LDAGULTO cancelled attendance adjustment (5).'),('TL-670','LDAGULTO','Cancel','2022-03-21 09:21:15','User LDAGULTO cancelled attendance adjustment (5).'),('TL-670','LDAGULTO','Cancel','2022-03-21 09:21:32','User LDAGULTO cancelled attendance adjustment (5).'),('TL-670','LDAGULTO','Cancel','2022-03-21 09:24:19','User LDAGULTO cancelled attendance adjustment (5).'),('TL-524','LDAGULTO','Update','2022-03-21 11:51:13','User LDAGULTO updated attendance setting (1).'),('1','LDAGULTO','Update','2022-03-21 11:54:40','User LDAGULTO updated attendance setting (1).'),('1','LDAGULTO','Update','2022-03-21 11:54:52','User LDAGULTO updated attendance setting (1).'),('1','LDAGULTO','Update','2022-03-21 12:58:14','User LDAGULTO updated attendance setting (1).'),('1','LDAGULTO','Update','2022-03-21 12:58:25','User LDAGULTO updated attendance setting (1).'),('1','LDAGULTO','Update','2022-03-21 13:02:21','User LDAGULTO updated attendance setting (1).'),('1','LDAGULTO','Update','2022-03-21 13:03:37','User LDAGULTO updated attendance setting (1).'),('TL-671','LDAGULTO','Update','2022-03-21 13:03:57','User LDAGULTO updated attendance setting (1).'),('TL-671','LDAGULTO','Update','2022-03-21 13:06:53','User LDAGULTO updated attendance setting (1).'),('TL-671','LDAGULTO','Update','2022-03-21 13:24:27','User LDAGULTO updated attendance setting (1).'),('TL-671','LDAGULTO','Update','2022-03-21 15:13:18','User LDAGULTO updated attendance setting (1).'),('TL-672','LDAGULTO','Insert','2022-03-21 15:49:16','User LDAGULTO inserted notification type (9).'),('TL-673','LDAGULTO','Insert','2022-03-21 15:50:30','User LDAGULTO inserted notification type (10).'),('TL-666','LDAGULTO','Update','2022-03-21 16:20:04','User LDAGULTO updated notification details (7).'),('TL-666','LDAGULTO','Update','2022-03-21 16:20:39','User LDAGULTO updated notification details (7).'),('TL-674','LDAGULTO','Insert','2022-03-21 16:25:37','User LDAGULTO inserted notification details (9).'),('TL-675','LDAGULTO','Insert','2022-03-21 16:27:58','User LDAGULTO inserted notification details (7).'),('TL-666','LDAGULTO','Update','2022-03-21 16:28:08','User LDAGULTO updated notification details (7).'),('TL-676','LDAGULTO','Insert','2022-03-21 16:33:55','User LDAGULTO inserted notification details (10).'),('TL-673','LDAGULTO','Update','2022-03-21 16:59:25','User LDAGULTO updated notification details (10).'),('TL-672','LDAGULTO','Update','2022-03-21 16:59:32','User LDAGULTO updated notification details (9).'),('TL-677','LDAGULTO','Insert','2022-03-21 17:37:27','User LDAGULTO inserted notification details (10).'),('TL-673','LDAGULTO','Update','2022-03-21 17:37:33','User LDAGULTO updated notification details (10).'),('TL-678','LDAGULTO','Insert','2022-03-21 17:38:18','User LDAGULTO inserted notification details (7).'),('TL-666','LDAGULTO','Update','2022-03-21 17:38:29','User LDAGULTO updated notification details (7).'),('TL-679','LDAGULTO','Insert','2022-03-21 17:39:07','User LDAGULTO inserted notification details (9).'),('TL-672','LDAGULTO','Update','2022-03-21 17:39:14','User LDAGULTO updated notification details (9).'),('TL-680','LDAGULTO','Insert','2022-03-22 11:20:39','User LDAGULTO inserted attendance adjustment (6).'),('TL-680','LDAGULTO','Update','2022-03-22 11:20:40','User LDAGULTO updated attendance adjustment file (6).'),('TL-671','LDAGULTO','Update','2022-03-22 11:21:38','User LDAGULTO updated attendance setting (1).'),('TL-680','LDAGULTO','Recommend','2022-03-22 11:21:48','User LDAGULTO recommended attendance adjustment (6).'),('TL-680','LDAGULTO','Recommend','2022-03-22 11:22:55','User LDAGULTO recommended attendance adjustment (6).'),('TL-681','LDAGULTO','Insert','2022-03-22 11:34:19','User LDAGULTO inserted attendance creation (12).'),('TL-681','LDAGULTO','Update','2022-03-22 11:34:20','User LDAGULTO updated attendance creation file (12).'),('TL-681','LDAGULTO','Recommend','2022-03-22 11:34:22','User LDAGULTO recommended attendance creation (12).'),('TL-682','LDAGULTO','Insert','2022-03-22 11:35:21','User LDAGULTO inserted attendance adjustment (7).'),('TL-682','LDAGULTO','Update','2022-03-22 11:35:21','User LDAGULTO updated attendance adjustment file (7).'),('TL-682','LDAGULTO','Recommend','2022-03-22 11:35:25','User LDAGULTO recommended attendance adjustment (7).'),('TL-682','LDAGULTO','Recommend','2022-03-22 11:36:04','User LDAGULTO recommended attendance adjustment (7).'),('TL-683','LDAGULTO','Insert','2022-03-22 11:41:18','User LDAGULTO inserted attendance creation (13).'),('TL-683','LDAGULTO','Update','2022-03-22 11:41:19','User LDAGULTO updated attendance creation file (13).'),('TL-683','LDAGULTO','Recommend','2022-03-22 11:41:21','User LDAGULTO recommended attendance creation (13).'),('TL-684','LDAGULTO','Insert','2022-03-22 11:50:57','User LDAGULTO inserted attendance creation (14).'),('TL-684','LDAGULTO','Update','2022-03-22 11:50:58','User LDAGULTO updated attendance creation file (14).'),('TL-684','LDAGULTO','Recommend','2022-03-22 11:51:03','User LDAGULTO recommended attendance creation (14).'),('TL-685','LDAGULTO','Insert','2022-03-22 11:53:23','User LDAGULTO inserted attendance creation (15).'),('TL-685','LDAGULTO','Update','2022-03-22 11:53:23','User LDAGULTO updated attendance creation file (15).'),('TL-685','LDAGULTO','Recommend','2022-03-22 11:53:25','User LDAGULTO recommended attendance creation (15).'),('TL-671','LDAGULTO','Update','2022-03-23 08:22:49','User LDAGULTO updated attendance setting (1).'),('TL-656','LDAGULTO','Cancel','2022-03-23 08:32:07','User LDAGULTO cancelled attendance adjustment (3).'),('TL-680','LDAGULTO','Cancel','2022-03-23 08:32:08','User LDAGULTO cancelled attendance adjustment (6).'),('TL-682','LDAGULTO','Cancel','2022-03-23 08:32:09','User LDAGULTO cancelled attendance adjustment (7).'),('TL-657','LDAGULTO','Cancel','2022-03-23 08:32:09','User LDAGULTO cancelled attendance adjustment (4).'),('TL-686','LDAGULTO','Insert','2022-03-23 08:32:49','User LDAGULTO inserted policy (42).'),('TL-687','LDAGULTO','Insert','2022-03-23 08:39:52','User LDAGULTO inserted policy (43).'),('TL-688','LDAGULTO','Insert','2022-03-23 08:40:11','User LDAGULTO inserted permission (196).'),('TL-689','LDAGULTO','Insert','2022-03-23 08:40:19','User LDAGULTO inserted permission (197).'),('TL-690','LDAGULTO','Insert','2022-03-23 08:40:28','User LDAGULTO inserted permission (198).'),('TL-691','LDAGULTO','Insert','2022-03-23 08:40:35','User LDAGULTO inserted permission (199).'),('TL-692','LDAGULTO','Insert','2022-03-23 08:40:42','User LDAGULTO inserted permission (200).'),('TL-693','LDAGULTO','Insert','2022-03-23 08:58:06','User LDAGULTO inserted permission (201).'),('TL-694','LDAGULTO','Insert','2022-03-23 08:58:11','User LDAGULTO inserted permission (202).'),('TL-695','LDAGULTO','Insert','2022-03-23 08:58:27','User LDAGULTO inserted permission (203).'),('TL-695','LDAGULTO','Update','2022-03-23 08:58:32','User LDAGULTO updated permission (203).'),('TL-696','LDAGULTO','Insert','2022-03-23 08:58:41','User LDAGULTO inserted permission (204).'),('TL-697','LDAGULTO','Insert','2022-03-23 08:58:48','User LDAGULTO inserted permission (205).'),('TL-698','LDAGULTO','Insert','2022-03-23 08:58:54','User LDAGULTO inserted permission (206).'),('TL-699','LDAGULTO','Insert','2022-03-23 08:58:58','User LDAGULTO inserted permission (207).'),('TL-82','LDAGULTO','Update','2022-03-23 09:00:35','User LDAGULTO updated role permission (RL-1).'),('TL-700','LDAGULTO','Insert','2022-03-23 09:08:44','User LDAGULTO inserted attendance creation (16).'),('TL-700','LDAGULTO','Update','2022-03-23 09:08:44','User LDAGULTO updated attendance creation file (16).'),('TL-700','LDAGULTO','For Recommendation','2022-03-23 09:08:53','User LDAGULTO tagged the attendance creation for recommendation (16).'),('TL-701','LDAGULTO','Insert','2022-03-23 09:26:45','User LDAGULTO inserted notification type (11).'),('TL-702','LDAGULTO','Insert','2022-03-23 09:27:09','User LDAGULTO inserted notification type (12).'),('TL-658','LDAGULTO','Update','2022-03-23 09:27:42','User LDAGULTO updated notification details (5).'),('TL-659','LDAGULTO','Update','2022-03-23 09:28:00','User LDAGULTO updated notification details (6).'),('TL-703','LDAGULTO','Insert','2022-03-23 09:28:37','User LDAGULTO inserted notification details (11).'),('TL-658','LDAGULTO','Update','2022-03-23 09:29:15','User LDAGULTO updated notification details (5).'),('TL-659','LDAGULTO','Update','2022-03-23 09:29:46','User LDAGULTO updated notification details (6).'),('TL-704','LDAGULTO','Insert','2022-03-23 09:30:11','User LDAGULTO inserted notification details (12).'),('TL-705','LDAGULTO','Insert','2022-03-23 09:33:28','User LDAGULTO inserted notification type (13).'),('TL-706','LDAGULTO','Insert','2022-03-23 09:33:52','User LDAGULTO inserted notification type (14).'),('TL-707','LDAGULTO','Insert','2022-03-23 09:34:35','User LDAGULTO inserted notification details (13).'),('TL-708','LDAGULTO','Insert','2022-03-23 09:35:11','User LDAGULTO inserted notification details (14).'),('TL-705','LDAGULTO','Update','2022-03-23 09:35:22','User LDAGULTO updated notification details (13).'),('TL-709','LDAGULTO','Insert','2022-03-23 09:59:16','User LDAGULTO inserted attendance adjustment (8).'),('TL-709','LDAGULTO','Update','2022-03-23 09:59:16','User LDAGULTO updated attendance adjustment file (8).'),('TL-710','LDAGULTO','Insert','2022-03-23 09:59:45','User LDAGULTO inserted attendance adjustment (9).'),('TL-710','LDAGULTO','Update','2022-03-23 09:59:45','User LDAGULTO updated attendance adjustment file (9).'),('TL-709','LDAGULTO','For Recommendation','2022-03-23 09:59:50','User LDAGULTO tagged the attendance adjustment for recommendation (8).'),('TL-710','LDAGULTO','For Recommendation','2022-03-23 09:59:55','User LDAGULTO tagged the attendance adjustment for recommendation (9).'),('TL-709','LDAGULTO','Reject','2022-03-23 10:00:38','User LDAGULTO rejected attendance adjustment (8).'),('TL-710','LDAGULTO','Recommend','2022-03-23 10:03:02','User LDAGULTO recommended attendance adjustment (9).'),('TL-711','LDAGULTO','Insert','2022-03-23 10:04:05','User LDAGULTO inserted attendance creation (17).'),('TL-711','LDAGULTO','Update','2022-03-23 10:04:05','User LDAGULTO updated attendance creation file (17).'),('TL-712','LDAGULTO','Insert','2022-03-23 10:04:42','User LDAGULTO inserted attendance creation (18).'),('TL-712','LDAGULTO','Update','2022-03-23 10:04:42','User LDAGULTO updated attendance creation file (18).'),('TL-711','LDAGULTO','For Recommendation','2022-03-23 10:04:45','User LDAGULTO tagged the attendance creation for recommendation (17).'),('TL-712','LDAGULTO','For Recommendation','2022-03-23 10:04:50','User LDAGULTO tagged the attendance creation for recommendation (18).'),('TL-711','LDAGULTO','Reject','2022-03-23 10:10:50','User LDAGULTO rejected attendance creation (17).'),('TL-712','LDAGULTO','Recommend','2022-03-23 10:10:56','User LDAGULTO recommended attendance creation (18).'),('TL-700','LDAGULTO','Cancel','2022-03-23 10:11:08','User LDAGULTO cancelled attendance creation (16).'),('TL-713','LDAGULTO','Insert','2022-03-23 10:13:06','User LDAGULTO inserted attendance creation (19).'),('TL-713','LDAGULTO','Update','2022-03-23 10:13:06','User LDAGULTO updated attendance creation file (19).'),('TL-713','LDAGULTO','For Recommendation','2022-03-23 10:13:08','User LDAGULTO tagged the attendance creation for recommendation (19).'),('TL-713','LDAGULTO','Recommend','2022-03-23 10:13:20','User LDAGULTO recommended attendance creation (19).'),('TL-714','LDAGULTO','Insert','2022-03-23 10:15:49','User LDAGULTO inserted attendance creation (20).'),('TL-714','LDAGULTO','Update','2022-03-23 10:15:49','User LDAGULTO updated attendance creation file (20).'),('TL-714','LDAGULTO','For Recommendation','2022-03-23 10:15:51','User LDAGULTO tagged the attendance creation for recommendation (20).'),('TL-714','LDAGULTO','Recommend','2022-03-23 10:16:05','User LDAGULTO recommended attendance creation (20).'),('TL-714','LDAGULTO','Recommend','2022-03-23 10:16:22','User LDAGULTO recommended attendance creation (20).'),('TL-654','LDAGULTO','Reject','2022-03-24 09:21:41','User LDAGULTO rejected attendance creation (10).'),('TL-655','LDAGULTO','Cancel','2022-03-24 09:21:50','User LDAGULTO cancelled attendance creation (11).'),('TL-715','LDAGULTO','Insert','2022-03-24 09:25:35','User LDAGULTO inserted employee attendance (23).'),('TL-681','LDAGULTO','Approve','2022-03-24 09:25:35','User LDAGULTO approved attendance creation (12).'),('TL-716','LDAGULTO','Insert','2022-03-24 09:31:28','User LDAGULTO inserted employee attendance (24).'),('TL-714','LDAGULTO','Approve','2022-03-24 09:31:28','User LDAGULTO approved attendance creation (20).'),('TL-717','LDAGULTO','Insert','2022-03-24 09:38:45','User LDAGULTO inserted attendance creation (21).'),('TL-717','LDAGULTO','Update','2022-03-24 09:38:45','User LDAGULTO updated attendance creation file (21).'),('TL-717','LDAGULTO','For Recommendation','2022-03-24 09:38:47','User LDAGULTO tagged the attendance creation for recommendation (21).'),('TL-717','LDAGULTO','Recommend','2022-03-24 09:38:56','User LDAGULTO recommended attendance creation (21).'),('TL-718','LDAGULTO','Insert','2022-03-24 09:39:12','User LDAGULTO inserted employee attendance (25).'),('TL-717','LDAGULTO','Approve','2022-03-24 09:39:12','User LDAGULTO approved attendance creation (21).'),('TL-719','LDAGULTO','Insert','2022-03-24 09:56:01','User LDAGULTO inserted employee attendance (26).'),('TL-683','LDAGULTO','Approve','2022-03-24 09:56:01','User LDAGULTO approved attendance creation (13).'),('TL-684','LDAGULTO','Cancel','2022-03-24 09:56:27','User LDAGULTO cancelled attendance creation (14).'),('TL-685','LDAGULTO','Cancel','2022-03-24 09:56:28','User LDAGULTO cancelled attendance creation (15).'),('TL-712','LDAGULTO','Cancel','2022-03-24 09:56:29','User LDAGULTO cancelled attendance creation (18).'),('TL-713','LDAGULTO','Cancel','2022-03-24 09:56:29','User LDAGULTO cancelled attendance creation (19).'),('TL-720','LDAGULTO','Insert','2022-03-24 09:56:58','User LDAGULTO inserted attendance creation (22).'),('TL-720','LDAGULTO','Update','2022-03-24 09:56:59','User LDAGULTO updated attendance creation file (22).'),('TL-721','LDAGULTO','Insert','2022-03-24 09:57:14','User LDAGULTO inserted attendance creation (23).'),('TL-721','LDAGULTO','Update','2022-03-24 09:57:15','User LDAGULTO updated attendance creation file (23).'),('TL-721','LDAGULTO','For Recommendation','2022-03-24 09:57:18','User LDAGULTO tagged the attendance creation for recommendation (23).'),('TL-720','LDAGULTO','For Recommendation','2022-03-24 09:57:18','User LDAGULTO tagged the attendance creation for recommendation (22).'),('TL-720','LDAGULTO','For Recommendation','2022-03-24 09:57:25','User LDAGULTO tagged the attendance creation for recommendation (22).'),('TL-721','LDAGULTO','For Recommendation','2022-03-24 09:57:26','User LDAGULTO tagged the attendance creation for recommendation (23).'),('TL-720','LDAGULTO','For Recommendation','2022-03-24 09:57:36','User LDAGULTO tagged the attendance creation for recommendation (22).'),('TL-721','LDAGULTO','For Recommendation','2022-03-24 09:57:36','User LDAGULTO tagged the attendance creation for recommendation (23).'),('TL-720','LDAGULTO','Recommend','2022-03-24 09:58:27','User LDAGULTO recommended attendance creation (22).'),('TL-721','LDAGULTO','For Recommendation','2022-03-24 09:58:50','User LDAGULTO tagged the attendance creation for recommendation (23).'),('TL-721','LDAGULTO','Recommend','2022-03-24 09:59:59','User LDAGULTO recommended attendance creation (23).'),('TL-722','LDAGULTO','Insert','2022-03-24 10:00:37','User LDAGULTO inserted employee attendance (27).'),('TL-720','LDAGULTO','Approve','2022-03-24 10:00:37','User LDAGULTO approved attendance creation (22).'),('TL-723','LDAGULTO','Insert','2022-03-24 10:00:38','User LDAGULTO inserted employee attendance (28).'),('TL-721','LDAGULTO','Approve','2022-03-24 10:00:38','User LDAGULTO approved attendance creation (23).'),('TL-710','LDAGULTO','Reject','2022-03-24 11:20:24','User LDAGULTO rejected attendance adjustment (9).'),('TL-724','LDAGULTO','Insert','2022-03-24 14:16:29','User LDAGULTO inserted attendance adjustment (10).'),('TL-724','LDAGULTO','Update','2022-03-24 14:16:29','User LDAGULTO updated attendance adjustment file (10).'),('TL-725','LDAGULTO','Insert','2022-03-24 14:16:42','User LDAGULTO inserted attendance adjustment (11).'),('TL-725','LDAGULTO','Update','2022-03-24 14:16:42','User LDAGULTO updated attendance adjustment file (11).'),('TL-724','LDAGULTO','For Recommendation','2022-03-24 14:16:53','User LDAGULTO tagged the attendance adjustment for recommendation (10).'),('TL-725','LDAGULTO','For Recommendation','2022-03-24 14:16:54','User LDAGULTO tagged the attendance adjustment for recommendation (11).'),('TL-724','LDAGULTO','Recommend','2022-03-24 14:17:01','User LDAGULTO recommended attendance adjustment (10).'),('TL-725','LDAGULTO','Recommend','2022-03-24 14:17:02','User LDAGULTO recommended attendance adjustment (11).'),('TL-716','LDAGULTO','Update','2022-03-24 14:32:55','User LDAGULTO updated employee attendance (24).'),('TL-725','LDAGULTO','Approve','2022-03-24 14:32:55','User LDAGULTO approved attendance adjustment (11).'),('TL-718','LDAGULTO','Update','2022-03-24 14:33:49','User LDAGULTO updated employee attendance (25).'),('TL-724','LDAGULTO','Approve','2022-03-24 14:33:49','User LDAGULTO approved attendance adjustment (10).'),('TL-726','LDAGULTO','Insert','2022-03-24 14:59:30','User LDAGULTO inserted attendance adjustment (12).'),('TL-726','LDAGULTO','Update','2022-03-24 14:59:30','User LDAGULTO updated attendance adjustment file (12).'),('TL-727','LDAGULTO','Insert','2022-03-24 14:59:45','User LDAGULTO inserted attendance adjustment (13).'),('TL-727','LDAGULTO','Update','2022-03-24 14:59:45','User LDAGULTO updated attendance adjustment file (13).'),('TL-726','LDAGULTO','For Recommendation','2022-03-24 14:59:53','User LDAGULTO tagged the attendance adjustment for recommendation (12).'),('TL-727','LDAGULTO','For Recommendation','2022-03-24 14:59:54','User LDAGULTO tagged the attendance adjustment for recommendation (13).'),('TL-726','LDAGULTO','Recommend','2022-03-24 15:00:02','User LDAGULTO recommended attendance adjustment (12).'),('TL-727','LDAGULTO','Recommend','2022-03-24 15:00:03','User LDAGULTO recommended attendance adjustment (13).'),('TL-723','LDAGULTO','Update','2022-03-24 15:00:14','User LDAGULTO updated employee attendance (28).'),('TL-726','LDAGULTO','Approve','2022-03-24 15:00:14','User LDAGULTO approved attendance adjustment (12).'),('TL-722','LDAGULTO','Update','2022-03-24 15:03:11','User LDAGULTO updated employee attendance (27).'),('TL-727','LDAGULTO','Approve','2022-03-24 15:03:11','User LDAGULTO approved attendance adjustment (13).'),('TL-728','LDAGULTO','Insert','2022-03-24 15:04:04','User LDAGULTO inserted attendance adjustment (14).'),('TL-728','LDAGULTO','Update','2022-03-24 15:04:04','User LDAGULTO updated attendance adjustment file (14).'),('TL-728','LDAGULTO','For Recommendation','2022-03-24 15:04:28','User LDAGULTO tagged the attendance adjustment for recommendation (14).'),('TL-728','LDAGULTO','Recommend','2022-03-24 15:04:34','User LDAGULTO recommended attendance adjustment (14).'),('TL-722','LDAGULTO','Update','2022-03-24 15:04:41','User LDAGULTO updated employee attendance (27).'),('TL-728','LDAGULTO','Approve','2022-03-24 15:04:41','User LDAGULTO approved attendance adjustment (14).'),('TL-729','LDAGULTO','Insert','2022-03-24 15:14:19','User LDAGULTO inserted attendance adjustment (15).'),('TL-729','LDAGULTO','Update','2022-03-24 15:14:19','User LDAGULTO updated attendance adjustment file (15).'),('TL-729','LDAGULTO','For Recommendation','2022-03-24 15:14:27','User LDAGULTO tagged the attendance adjustment for recommendation (15).'),('TL-729','LDAGULTO','Recommend','2022-03-24 15:14:33','User LDAGULTO recommended attendance adjustment (15).'),('TL-722','LDAGULTO','Update','2022-03-24 15:14:39','User LDAGULTO updated employee attendance (27).'),('TL-729','LDAGULTO','Approve','2022-03-24 15:14:39','User LDAGULTO approved attendance adjustment (15).'),('TL-730','LDAGULTO','Insert','2022-03-24 15:47:42','User LDAGULTO inserted policy (44).'),('TL-731','LDAGULTO','Insert','2022-03-24 15:48:01','User LDAGULTO inserted permission (208).'),('TL-732','LDAGULTO','Insert','2022-03-24 15:48:06','User LDAGULTO inserted permission (209).'),('TL-733','LDAGULTO','Insert','2022-03-24 15:48:13','User LDAGULTO inserted permission (210).'),('TL-734','LDAGULTO','Insert','2022-03-24 15:48:18','User LDAGULTO inserted permission (211).'),('TL-735','LDAGULTO','Insert','2022-03-24 15:48:57','User LDAGULTO inserted permission (212).'),('TL-736','LDAGULTO','Insert','2022-03-24 15:49:05','User LDAGULTO inserted permission (213).'),('TL-82','LDAGULTO','Update','2022-03-24 15:57:09','User LDAGULTO updated role permission (RL-1).'),('TL-736','LDAGULTO','Update','2022-03-24 16:54:10','User LDAGULTO updated permission (213).'),('TL-737','LDAGULTO','Insert','2022-03-24 16:54:18','User LDAGULTO inserted permission (214).'),('TL-730','LDAGULTO','Update','2022-03-24 16:54:36','User LDAGULTO updated policy (44).'),('TL-735','LDAGULTO','Update','2022-03-25 13:04:46','User LDAGULTO updated permission (212).'),('TL-736','LDAGULTO','Update','2022-03-25 13:04:53','User LDAGULTO updated permission (213).'),('TL-737','LDAGULTO','Delete','2022-03-25 13:04:56','User LDAGULTO deleted permission (214).'),('TL-5','LDAGULTO','Update','2022-03-25 13:05:10','User LDAGULTO updated system parameter (4).'),('TL-5','LDAGULTO','Update','2022-03-25 13:05:14','User LDAGULTO updated system parameter (4).'),('TL-738','LDAGULTO','Insert','2022-03-25 14:07:05','User LDAGULTO inserted leave (LV-39).'),('TL-416','LDAGULTO','Update','2022-03-25 14:07:05','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-738','LDAGULTO','Cancel','2022-03-25 14:09:09','User LDAGULTO approved leave (LV-39).'),('TL-416','LDAGULTO','Update','2022-03-25 14:09:09','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-739','LDAGULTO','Insert','2022-03-25 15:30:04','User LDAGULTO inserted upload setting (11).'),('TL-416','LDAGULTO','Update','2022-03-25 15:36:45','User LDAGULTO updated leave entitlement (LVENT-1).'),('TL-740','LDAGULTO','Insert','2022-03-28 13:14:50','User LDAGULTO inserted leave (LV-40).'),('TL-416','LDAGULTO','Update','2022-03-28 13:14:50','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-741','LDAGULTO','Insert','2022-03-28 13:14:50','User LDAGULTO inserted leave (LV-41).'),('TL-416','LDAGULTO','Update','2022-03-28 13:14:50','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-742','LDAGULTO','Insert','2022-03-28 13:14:51','User LDAGULTO inserted leave (LV-42).'),('TL-416','LDAGULTO','Update','2022-03-28 13:14:51','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-743','LDAGULTO','Insert','2022-03-28 13:16:36','User LDAGULTO inserted leave (LV-43).'),('TL-416','LDAGULTO','Update','2022-03-28 13:16:37','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-744','LDAGULTO','Insert','2022-03-28 13:16:37','User LDAGULTO inserted leave (LV-44).'),('TL-416','LDAGULTO','Update','2022-03-28 13:16:37','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-745','LDAGULTO','Insert','2022-03-28 13:16:38','User LDAGULTO inserted leave (LV-45).'),('TL-416','LDAGULTO','Update','2022-03-28 13:16:38','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-637','LDAGULTO','Cancel','2022-03-28 13:16:55','User LDAGULTO approved leave (LV-38).'),('TL-416','LDAGULTO','Update','2022-03-28 13:16:55','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-741','LDAGULTO','Cancel','2022-03-28 13:16:58','User LDAGULTO approved leave (LV-41).'),('TL-416','LDAGULTO','Update','2022-03-28 13:16:58','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-742','LDAGULTO','Cancel','2022-03-28 13:17:00','User LDAGULTO approved leave (LV-42).'),('TL-416','LDAGULTO','Update','2022-03-28 13:17:00','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-740','LDAGULTO','Cancel','2022-03-28 13:17:03','User LDAGULTO approved leave (LV-40).'),('TL-416','LDAGULTO','Update','2022-03-28 13:17:04','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-743','LDAGULTO','Cancel','2022-03-28 13:17:06','User LDAGULTO approved leave (LV-43).'),('TL-416','LDAGULTO','Update','2022-03-28 13:17:06','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-744','LDAGULTO','Cancel','2022-03-28 13:17:09','User LDAGULTO approved leave (LV-44).'),('TL-416','LDAGULTO','Update','2022-03-28 13:17:09','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-745','LDAGULTO','Cancel','2022-03-28 13:17:11','User LDAGULTO approved leave (LV-45).'),('TL-416','LDAGULTO','Update','2022-03-28 13:17:11','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-746','LDAGULTO','Insert','2022-03-28 13:17:31','User LDAGULTO inserted leave (LV-46).'),('TL-746','LDAGULTO','Update','2022-03-28 13:17:31','User LDAGULTO updated leave attachment (LV-46).'),('TL-416','LDAGULTO','Update','2022-03-28 13:17:32','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-747','LDAGULTO','Insert','2022-03-28 13:17:32','User LDAGULTO inserted leave (LV-47).'),('TL-748','LDAGULTO','Insert','2022-03-28 13:18:25','User LDAGULTO inserted leave (LV-48).'),('TL-748','LDAGULTO','Update','2022-03-28 13:18:25','User LDAGULTO updated leave attachment (LV-48).'),('TL-416','LDAGULTO','Update','2022-03-28 13:18:25','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-749','LDAGULTO','Insert','2022-03-28 13:18:26','User LDAGULTO inserted leave (LV-49).'),('TL-747','LDAGULTO','Cancel','2022-03-28 13:18:44','User LDAGULTO approved leave (LV-47).'),('TL-416','LDAGULTO','Update','2022-03-28 13:18:44','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-748','LDAGULTO','Cancel','2022-03-28 13:18:47','User LDAGULTO approved leave (LV-48).'),('TL-416','LDAGULTO','Update','2022-03-28 13:18:47','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-749','LDAGULTO','Cancel','2022-03-28 13:18:50','User LDAGULTO approved leave (LV-49).'),('TL-416','LDAGULTO','Update','2022-03-28 13:18:50','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-746','LDAGULTO','Reject','2022-03-28 13:18:55','User LDAGULTO rejected leave (LV-46).'),('TL-416','LDAGULTO','Update','2022-03-28 13:18:55','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-750','LDAGULTO','Insert','2022-03-28 13:22:23','User LDAGULTO inserted leave (LV-50).'),('TL-750','LDAGULTO','Update','2022-03-28 13:22:23','User LDAGULTO updated leave attachment (LV-50).'),('TL-416','LDAGULTO','Update','2022-03-28 13:22:24','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-751','LDAGULTO','Insert','2022-03-28 13:22:24','User LDAGULTO inserted leave (LV-51).'),('TL-752','LDAGULTO','Insert','2022-03-28 13:24:58','User LDAGULTO inserted leave (LV-52).'),('TL-752','LDAGULTO','Update','2022-03-28 13:24:59','User LDAGULTO updated leave attachment (LV-52).'),('TL-416','LDAGULTO','Update','2022-03-28 13:25:00','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-753','LDAGULTO','Insert','2022-03-28 13:25:01','User LDAGULTO inserted leave (LV-53).'),('TL-754','LDAGULTO','Insert','2022-03-28 13:31:27','User LDAGULTO inserted leave (LV-54).'),('TL-754','LDAGULTO','Update','2022-03-28 13:31:27','User LDAGULTO updated leave attachment (LV-54).'),('TL-416','LDAGULTO','Update','2022-03-28 13:31:27','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-755','LDAGULTO','Insert','2022-03-28 13:31:27','User LDAGULTO inserted leave (LV-55).'),('TL-756','LDAGULTO','Insert','2022-03-28 13:42:23','User LDAGULTO inserted leave (LV-56).'),('TL-756','LDAGULTO','Update','2022-03-28 13:42:23','User LDAGULTO updated leave attachment (LV-56).'),('TL-416','LDAGULTO','Update','2022-03-28 13:42:23','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-757','LDAGULTO','Insert','2022-03-28 13:42:23','User LDAGULTO inserted leave (LV-57).'),('TL-758','LDAGULTO','Insert','2022-03-28 13:43:43','User LDAGULTO inserted leave (LV-58).'),('TL-758','LDAGULTO','Update','2022-03-28 13:43:43','User LDAGULTO updated leave attachment (LV-58).'),('TL-416','LDAGULTO','Update','2022-03-28 13:43:43','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-759','LDAGULTO','Insert','2022-03-28 13:43:43','User LDAGULTO inserted leave (LV-59).'),('TL-760','LDAGULTO','Insert','2022-03-28 13:51:40','User LDAGULTO inserted leave (LV-60).'),('TL-760','LDAGULTO','Update','2022-03-28 13:51:40','User LDAGULTO updated leave attachment (LV-60).'),('TL-416','LDAGULTO','Update','2022-03-28 13:51:40','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-761','LDAGULTO','Insert','2022-03-28 13:51:41','User LDAGULTO inserted leave (LV-61).'),('TL-762','LDAGULTO','Insert','2022-03-28 13:53:21','User LDAGULTO inserted leave (LV-62).'),('TL-762','LDAGULTO','Update','2022-03-28 13:53:21','User LDAGULTO updated leave attachment (LV-62).'),('TL-416','LDAGULTO','Update','2022-03-28 13:53:21','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-763','LDAGULTO','Insert','2022-03-28 13:53:49','User LDAGULTO inserted leave (LV-63).'),('TL-763','LDAGULTO','Update','2022-03-28 13:53:49','User LDAGULTO updated leave attachment (LV-63).'),('TL-416','LDAGULTO','Update','2022-03-28 13:53:50','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-764','LDAGULTO','Insert','2022-03-28 13:53:50','User LDAGULTO inserted leave (LV-64).'),('TL-765','LDAGULTO','Insert','2022-03-28 14:33:40','User LDAGULTO inserted leave (LV-65).'),('TL-765','LDAGULTO','Update','2022-03-28 14:33:40','User LDAGULTO updated leave attachment (LV-65).'),('TL-416','LDAGULTO','Update','2022-03-28 14:33:40','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-766','LDAGULTO','Insert','2022-03-28 14:33:40','User LDAGULTO inserted leave (LV-66).'),('TL-767','LDAGULTO','Insert','2022-03-29 16:45:23','User LDAGULTO inserted leave (LV-67).'),('TL-416','LDAGULTO','Update','2022-03-29 16:45:23','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-768','LDAGULTO','Insert','2022-03-29 16:45:23','User LDAGULTO inserted leave (LV-68).'),('TL-416','LDAGULTO','Update','2022-03-29 16:45:23','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-769','LDAGULTO','Insert','2022-03-29 16:45:23','User LDAGULTO inserted leave (LV-69).'),('TL-416','LDAGULTO','Update','2022-03-29 16:45:23','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-770','LDAGULTO','Insert','2022-03-29 16:45:24','User LDAGULTO inserted leave (LV-70).'),('TL-416','LDAGULTO','Update','2022-03-29 16:45:24','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-733','LDAGULTO','Update','2022-03-30 09:08:24','User LDAGULTO updated permission (210).'),('TL-734','LDAGULTO','Update','2022-03-30 09:08:29','User LDAGULTO updated permission (211).'),('TL-735','LDAGULTO','Update','2022-03-30 09:08:38','User LDAGULTO updated permission (212).'),('TL-736','LDAGULTO','Delete','2022-03-30 09:08:46','User LDAGULTO deleted permission (213).'),('TL-5','LDAGULTO','Update','2022-03-30 09:08:59','User LDAGULTO updated system parameter (4).'),('TL-750','LDAGULTO','Approve','2022-03-30 10:58:19','User LDAGULTO approved leave (LV-50).'),('TL-751','LDAGULTO','Approve','2022-03-30 10:58:20','User LDAGULTO approved leave (LV-51).'),('TL-752','LDAGULTO','Reject','2022-03-30 10:58:39','User LDAGULTO rejected leave (LV-52).'),('TL-416','LDAGULTO','Update','2022-03-30 10:58:40','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-753','LDAGULTO','Reject','2022-03-30 10:58:40','User LDAGULTO rejected leave (LV-53).'),('TL-416','LDAGULTO','Update','2022-03-30 10:58:40','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-754','LDAGULTO','Cancel','2022-03-30 10:59:38','User LDAGULTO approved leave (LV-54).'),('TL-416','LDAGULTO','Update','2022-03-30 10:59:38','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-755','LDAGULTO','Cancel','2022-03-30 10:59:38','User LDAGULTO approved leave (LV-55).'),('TL-416','LDAGULTO','Update','2022-03-30 10:59:38','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-756','LDAGULTO','Cancel','2022-03-30 11:06:14','User LDAGULTO approved leave (LV-56).'),('TL-416','LDAGULTO','Update','2022-03-30 11:06:14','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-757','LDAGULTO','Cancel','2022-03-30 11:06:15','User LDAGULTO approved leave (LV-57).'),('TL-416','LDAGULTO','Update','2022-03-30 11:06:15','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-758','LDAGULTO','Cancel','2022-03-30 11:06:15','User LDAGULTO approved leave (LV-58).'),('TL-416','LDAGULTO','Update','2022-03-30 11:06:15','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-759','LDAGULTO','Cancel','2022-03-30 11:06:15','User LDAGULTO approved leave (LV-59).'),('TL-416','LDAGULTO','Update','2022-03-30 11:06:15','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-760','LDAGULTO','Cancel','2022-03-30 11:06:15','User LDAGULTO approved leave (LV-60).'),('TL-416','LDAGULTO','Update','2022-03-30 11:06:15','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-761','LDAGULTO','Cancel','2022-03-30 11:06:15','User LDAGULTO approved leave (LV-61).'),('TL-416','LDAGULTO','Update','2022-03-30 11:06:16','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-762','LDAGULTO','Cancel','2022-03-30 11:06:16','User LDAGULTO approved leave (LV-62).'),('TL-416','LDAGULTO','Update','2022-03-30 11:06:16','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-763','LDAGULTO','Cancel','2022-03-30 11:06:16','User LDAGULTO approved leave (LV-63).'),('TL-416','LDAGULTO','Update','2022-03-30 11:06:16','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-764','LDAGULTO','Cancel','2022-03-30 11:06:16','User LDAGULTO approved leave (LV-64).'),('TL-416','LDAGULTO','Update','2022-03-30 11:06:16','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-765','LDAGULTO','Cancel','2022-03-30 11:06:16','User LDAGULTO approved leave (LV-65).'),('TL-416','LDAGULTO','Update','2022-03-30 11:06:17','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-766','LDAGULTO','Cancel','2022-03-30 13:28:50','User LDAGULTO approved leave (LV-66).'),('TL-416','LDAGULTO','Update','2022-03-30 13:28:50','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-767','LDAGULTO','Cancel','2022-03-30 13:28:50','User LDAGULTO approved leave (LV-67).'),('TL-416','LDAGULTO','Update','2022-03-30 13:28:50','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-768','LDAGULTO','Cancel','2022-03-30 13:28:50','User LDAGULTO approved leave (LV-68).'),('TL-416','LDAGULTO','Update','2022-03-30 13:28:50','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-769','LDAGULTO','Cancel','2022-03-30 13:28:50','User LDAGULTO approved leave (LV-69).'),('TL-416','LDAGULTO','Update','2022-03-30 13:28:50','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-770','LDAGULTO','Cancel','2022-03-30 13:28:50','User LDAGULTO approved leave (LV-70).'),('TL-416','LDAGULTO','Update','2022-03-30 13:28:51','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-771','LDAGULTO','Insert','2022-03-30 13:34:52','User LDAGULTO inserted leave (LV-71).'),('TL-416','LDAGULTO','Update','2022-03-30 13:34:52','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-772','LDAGULTO','Insert','2022-03-30 13:47:33','User LDAGULTO inserted notification type (15).'),('TL-651','LDAGULTO','Update','2022-03-30 13:47:41','User LDAGULTO updated notification type (4).'),('TL-773','LDAGULTO','Insert','2022-03-30 13:52:09','User LDAGULTO inserted notification details (15).'),('TL-774','LDAGULTO','Insert','2022-03-30 14:10:19','User LDAGULTO inserted leave (LV-72).'),('TL-416','LDAGULTO','Update','2022-03-30 14:10:19','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-775','LDAGULTO','Insert','2022-03-30 14:13:51','User LDAGULTO inserted leave (LV-73).'),('TL-416','LDAGULTO','Update','2022-03-30 14:13:51','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-776','LDAGULTO','Insert','2022-03-30 14:42:08','User LDAGULTO inserted policy (45).'),('TL-777','LDAGULTO','Insert','2022-03-30 14:42:19','User LDAGULTO inserted permission (213).'),('TL-778','LDAGULTO','Insert','2022-03-30 14:42:28','User LDAGULTO inserted permission (214).'),('TL-779','LDAGULTO','Insert','2022-03-30 14:42:32','User LDAGULTO inserted permission (215).'),('TL-780','LDAGULTO','Insert','2022-03-30 14:42:38','User LDAGULTO inserted permission (216).'),('TL-781','LDAGULTO','Insert','2022-03-30 14:42:43','User LDAGULTO inserted permission (217).'),('TL-82','LDAGULTO','Update','2022-03-30 16:19:23','User LDAGULTO updated role permission (RL-1).'),('TL-771','LDAGULTO','Approve','2022-03-30 16:23:00','User LDAGULTO approved leave (LV-71).'),('TL-774','LDAGULTO','Reject','2022-03-30 16:24:38','User LDAGULTO rejected leave (LV-72).'),('TL-416','LDAGULTO','Update','2022-03-30 16:24:38','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-775','LDAGULTO','Cancel','2022-03-30 16:24:43','User LDAGULTO approved leave (LV-73).'),('TL-416','LDAGULTO','Update','2022-03-30 16:24:43','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-782','LDAGULTO','Insert','2022-03-30 16:27:39','User LDAGULTO inserted notification type (16).'),('TL-783','LDAGULTO','Insert','2022-03-30 16:27:54','User LDAGULTO inserted notification type (17).'),('TL-784','LDAGULTO','Insert','2022-03-30 16:28:04','User LDAGULTO inserted notification type (18).'),('TL-785','LDAGULTO','Insert','2022-03-30 16:30:25','User LDAGULTO inserted notification details (16).'),('TL-786','LDAGULTO','Insert','2022-03-30 16:31:05','User LDAGULTO inserted notification details (17).'),('TL-787','LDAGULTO','Insert','2022-03-30 16:31:25','User LDAGULTO inserted notification details (18).'),('TL-788','LDAGULTO','Insert','2022-03-30 16:59:01','User LDAGULTO inserted leave (LV-74).'),('TL-416','LDAGULTO','Update','2022-03-30 16:59:01','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-789','LDAGULTO','Insert','2022-03-30 16:59:01','User LDAGULTO inserted leave (LV-75).'),('TL-416','LDAGULTO','Update','2022-03-30 16:59:01','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-790','LDAGULTO','Insert','2022-03-30 16:59:01','User LDAGULTO inserted leave (LV-76).'),('TL-416','LDAGULTO','Update','2022-03-30 16:59:01','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-788','LDAGULTO','Approve','2022-03-30 17:06:47','User LDAGULTO approved leave (LV-74).'),('TL-788','LDAGULTO','Approve','2022-03-30 17:07:56','User LDAGULTO approved leave (LV-74).'),('TL-788','LDAGULTO','Approve','2022-03-30 17:12:31','User LDAGULTO approved leave (LV-74).'),('TL-789','LDAGULTO','Reject','2022-03-30 17:12:39','User LDAGULTO rejected leave (LV-75).'),('TL-416','LDAGULTO','Update','2022-03-30 17:12:39','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-790','LDAGULTO','Cancel','2022-03-30 17:12:45','User LDAGULTO approved leave (LV-76).'),('TL-416','LDAGULTO','Update','2022-03-30 17:12:45','User LDAGULTO updated leave entitlement count (LVENT-1).'),('TL-329','LDAGULTO','Update','2022-03-31 11:46:08','User LDAGULTO updated work shift schedule (1).'),('TL-791','LDAGULTO','Insert','2022-03-31 13:25:03','User LDAGULTO inserted work shift (2).'),('TL-791','LDAGULTO','Delete','2022-03-31 13:29:18','User LDAGULTO deleted work shift (2).'),('TL-792','LDAGULTO','Insert','2022-03-31 13:40:33','User LDAGULTO inserted work shift (3).'),('TL-793','LDAGULTO','Insert','2022-03-31 13:41:22','User LDAGULTO inserted work shift (4).'),('TL-792','LDAGULTO','Delete','2022-04-01 10:40:35','User LDAGULTO deleted work shift (3).'),('TL-793','LDAGULTO','Delete','2022-04-01 10:40:36','User LDAGULTO deleted work shift (4).'),('TL-794','LDAGULTO','Insert','2022-04-01 15:35:07','User LDAGULTO inserted policy (46).'),('TL-795','LDAGULTO','Insert','2022-04-01 15:35:22','User LDAGULTO inserted permission (218).'),('TL-796','LDAGULTO','Insert','2022-04-01 15:35:28','User LDAGULTO inserted permission (219).'),('TL-797','LDAGULTO','Insert','2022-04-01 15:35:35','User LDAGULTO inserted permission (220).'),('TL-798','LDAGULTO','Insert','2022-04-01 15:35:41','User LDAGULTO inserted permission (221).'),('TL-799','LDAGULTO','Insert','2022-04-01 15:35:48','User LDAGULTO inserted permission (222).'),('TL-82','LDAGULTO','Update','2022-04-01 15:41:51','User LDAGULTO updated role permission (RL-1).'),('TL-800','LDAGULTO','Insert','2022-04-05 08:59:58','User LDAGULTO inserted system parameter (28).'),('TL-801','LDAGULTO','Insert','2022-04-05 10:31:06','User LDAGULTO inserted allowance type (1).'),('TL-801','LDAGULTO','Update','2022-04-05 10:51:05','User LDAGULTO updated allowance type (1).'),('TL-802','LDAGULTO','Insert','2022-04-05 10:53:55','User LDAGULTO inserted allowance type (2).'),('TL-802','LDAGULTO','Update','2022-04-05 10:54:18','User LDAGULTO updated allowance type (2).'),('TL-802','LDAGULTO','Update','2022-04-05 10:54:21','User LDAGULTO updated allowance type (2).'),('TL-803','LDAGULTO','Insert','2022-04-05 11:38:39','User LDAGULTO inserted policy (47).'),('TL-804','LDAGULTO','Insert','2022-04-05 11:38:49','User LDAGULTO inserted permission (223).'),('TL-805','LDAGULTO','Insert','2022-04-05 11:38:54','User LDAGULTO inserted permission (224).'),('TL-806','LDAGULTO','Insert','2022-04-05 11:39:00','User LDAGULTO inserted permission (225).'),('TL-807','LDAGULTO','Insert','2022-04-05 11:39:05','User LDAGULTO inserted permission (226).'),('TL-808','LDAGULTO','Insert','2022-04-05 11:39:16','User LDAGULTO inserted permission (227).'),('TL-82','LDAGULTO','Update','2022-04-05 11:41:15','User LDAGULTO updated role permission (RL-1).'),('TL-809','LDAGULTO','Insert','2022-04-05 16:58:06','User LDAGULTO inserted system parameter (29).'),('TL-810','LDAGULTO','Insert','2022-04-06 10:02:03','User LDAGULTO inserted system code (RECURRENCYPATTERN).'),('TL-810','LDAGULTO','Delete','2022-04-06 10:02:28','User LDAGULTO deleted system code (RECURRENCYPATTERN).'),('TL-811','LDAGULTO','Insert','2022-04-06 10:02:42','User LDAGULTO inserted system code (RECURRENCEPATTERN).'),('TL-812','LDAGULTO','Insert','2022-04-06 10:02:57','User LDAGULTO inserted system code (MONTHLY).'),('TL-813','LDAGULTO','Insert','2022-04-06 10:03:06','User LDAGULTO inserted system code (DAILY).'),('TL-814','LDAGULTO','Insert','2022-04-06 10:03:17','User LDAGULTO inserted system code (WEEKLY).'),('TL-815','LDAGULTO','Insert','2022-04-06 10:03:29','User LDAGULTO inserted system code (BIWEEKLY).'),('TL-816','LDAGULTO','Insert','2022-04-06 10:03:48','User LDAGULTO inserted system code (QUARTERLY).'),('TL-817','LDAGULTO','Insert','2022-04-06 10:03:59','User LDAGULTO inserted system code (YEARLY).'),('TL-818','LDAGULTO','Insert','2022-04-06 15:29:21','User LDAGULTO inserted allowance (1).'),('TL-819','LDAGULTO','Insert','2022-04-06 15:29:21','User LDAGULTO inserted allowance (2).'),('TL-820','LDAGULTO','Insert','2022-04-06 15:29:22','User LDAGULTO inserted allowance (3).'),('TL-821','LDAGULTO','Insert','2022-04-06 15:29:22','User LDAGULTO inserted allowance (4).'),('TL-822','LDAGULTO','Insert','2022-04-06 15:29:22','User LDAGULTO inserted allowance (5).'),('TL-823','LDAGULTO','Insert','2022-04-06 15:29:22','User LDAGULTO inserted allowance (6).'),('TL-824','LDAGULTO','Insert','2022-04-06 15:29:22','User LDAGULTO inserted allowance (7).'),('TL-825','LDAGULTO','Insert','2022-04-06 15:29:23','User LDAGULTO inserted allowance (8).'),('TL-826','LDAGULTO','Insert','2022-04-06 15:29:23','User LDAGULTO inserted allowance (9).'),('TL-827','LDAGULTO','Insert','2022-04-06 15:29:23','User LDAGULTO inserted allowance (10).'),('TL-828','LDAGULTO','Insert','2022-04-06 15:29:23','User LDAGULTO inserted allowance (11).'),('TL-829','LDAGULTO','Insert','2022-04-06 15:29:23','User LDAGULTO inserted allowance (12).'),('TL-830','LDAGULTO','Insert','2022-04-06 15:29:23','User LDAGULTO inserted allowance (13).'),('TL-831','LDAGULTO','Insert','2022-04-06 15:30:12','User LDAGULTO inserted allowance (14).'),('TL-832','LDAGULTO','Insert','2022-04-06 15:30:12','User LDAGULTO inserted allowance (15).'),('TL-833','LDAGULTO','Insert','2022-04-06 15:30:12','User LDAGULTO inserted allowance (16).'),('TL-834','LDAGULTO','Insert','2022-04-06 15:30:13','User LDAGULTO inserted allowance (17).'),('TL-835','LDAGULTO','Insert','2022-04-06 15:30:13','User LDAGULTO inserted allowance (18).'),('TL-836','LDAGULTO','Insert','2022-04-06 15:30:13','User LDAGULTO inserted allowance (19).'),('TL-837','LDAGULTO','Insert','2022-04-06 15:30:13','User LDAGULTO inserted allowance (20).'),('TL-838','LDAGULTO','Insert','2022-04-06 15:30:13','User LDAGULTO inserted allowance (21).'),('TL-839','LDAGULTO','Insert','2022-04-06 15:30:13','User LDAGULTO inserted allowance (22).'),('TL-840','LDAGULTO','Insert','2022-04-06 15:30:13','User LDAGULTO inserted allowance (23).'),('TL-841','LDAGULTO','Insert','2022-04-06 15:30:14','User LDAGULTO inserted allowance (24).'),('TL-842','LDAGULTO','Insert','2022-04-06 15:30:14','User LDAGULTO inserted allowance (25).'),('TL-843','LDAGULTO','Insert','2022-04-06 15:30:14','User LDAGULTO inserted allowance (26).'),('TL-844','LDAGULTO','Insert','2022-04-06 15:35:19','User LDAGULTO inserted allowance (27).'),('TL-845','LDAGULTO','Insert','2022-04-06 15:35:19','User LDAGULTO inserted allowance (28).'),('TL-846','LDAGULTO','Insert','2022-04-06 15:35:19','User LDAGULTO inserted allowance (29).'),('TL-847','LDAGULTO','Insert','2022-04-06 15:35:19','User LDAGULTO inserted allowance (30).'),('TL-848','LDAGULTO','Insert','2022-04-06 15:35:20','User LDAGULTO inserted allowance (31).'),('TL-849','LDAGULTO','Insert','2022-04-06 15:35:20','User LDAGULTO inserted allowance (32).'),('TL-850','LDAGULTO','Insert','2022-04-06 15:35:20','User LDAGULTO inserted allowance (33).'),('TL-851','LDAGULTO','Insert','2022-04-06 15:35:20','User LDAGULTO inserted allowance (34).'),('TL-852','LDAGULTO','Insert','2022-04-06 15:35:20','User LDAGULTO inserted allowance (35).'),('TL-853','LDAGULTO','Insert','2022-04-06 15:35:21','User LDAGULTO inserted allowance (36).'),('TL-854','LDAGULTO','Insert','2022-04-06 15:35:21','User LDAGULTO inserted allowance (37).'),('TL-855','LDAGULTO','Insert','2022-04-06 15:35:21','User LDAGULTO inserted allowance (38).'),('TL-856','LDAGULTO','Insert','2022-04-06 15:35:21','User LDAGULTO inserted allowance (39).'),('TL-857','LDAGULTO','Insert','2022-04-06 15:35:27','User LDAGULTO inserted allowance (40).'),('TL-858','LDAGULTO','Insert','2022-04-06 15:35:28','User LDAGULTO inserted allowance (41).'),('TL-859','LDAGULTO','Insert','2022-04-06 15:35:28','User LDAGULTO inserted allowance (42).'),('TL-860','LDAGULTO','Insert','2022-04-06 15:35:28','User LDAGULTO inserted allowance (43).'),('TL-861','LDAGULTO','Insert','2022-04-06 15:35:28','User LDAGULTO inserted allowance (44).'),('TL-862','LDAGULTO','Insert','2022-04-06 15:35:28','User LDAGULTO inserted allowance (45).'),('TL-863','LDAGULTO','Insert','2022-04-06 15:35:28','User LDAGULTO inserted allowance (46).'),('TL-864','LDAGULTO','Insert','2022-04-06 15:35:29','User LDAGULTO inserted allowance (47).'),('TL-865','LDAGULTO','Insert','2022-04-06 15:35:29','User LDAGULTO inserted allowance (48).'),('TL-866','LDAGULTO','Insert','2022-04-06 15:35:29','User LDAGULTO inserted allowance (49).'),('TL-867','LDAGULTO','Insert','2022-04-06 15:35:29','User LDAGULTO inserted allowance (50).'),('TL-868','LDAGULTO','Insert','2022-04-06 15:35:29','User LDAGULTO inserted allowance (51).'),('TL-869','LDAGULTO','Insert','2022-04-06 15:35:29','User LDAGULTO inserted allowance (52).'),('TL-818','LDAGULTO','Update','2022-04-06 16:04:41','User LDAGULTO updated allowance (1).'),('TL-831','LDAGULTO','Update','2022-04-06 16:04:55','User LDAGULTO updated allowance (14).'),('TL-844','LDAGULTO','Update','2022-04-06 16:05:16','User LDAGULTO updated allowance (27).'),('TL-844','LDAGULTO','Update','2022-04-06 16:05:20','User LDAGULTO updated allowance (27).'),('TL-870','LDAGULTO','Insert','2022-04-06 17:10:06','User LDAGULTO inserted policy (48).'),('TL-871','LDAGULTO','Insert','2022-04-06 17:10:18','User LDAGULTO inserted permission (228).'),('TL-871','LDAGULTO','Update','2022-04-06 17:10:22','User LDAGULTO updated permission (228).'),('TL-872','LDAGULTO','Insert','2022-04-06 17:10:33','User LDAGULTO inserted permission (229).'),('TL-873','LDAGULTO','Insert','2022-04-06 17:10:39','User LDAGULTO inserted permission (230).'),('TL-874','LDAGULTO','Insert','2022-04-06 17:10:45','User LDAGULTO inserted permission (231).'),('TL-875','LDAGULTO','Insert','2022-04-06 17:10:54','User LDAGULTO inserted permission (232).'),('TL-82','LDAGULTO','Update','2022-04-06 17:15:26','User LDAGULTO updated role permission (RL-1).'),('TL-876','LDAGULTO','Insert','2022-04-06 17:20:14','User LDAGULTO inserted system parameter (30).'),('TL-877','LDAGULTO','Insert','2022-04-06 17:31:30','User LDAGULTO inserted deduction type (1).'),('TL-877','LDAGULTO','Update','2022-04-06 17:35:28','User LDAGULTO updated deduction type (1).'),('TL-878','LDAGULTO','Insert','2022-04-08 10:31:37','User LDAGULTO inserted policy (49).'),('TL-879','LDAGULTO','Insert','2022-04-08 10:31:49','User LDAGULTO inserted permission (233).'),('TL-879','LDAGULTO','Update','2022-04-08 10:31:52','User LDAGULTO updated permission (233).'),('TL-880','LDAGULTO','Insert','2022-04-08 10:32:02','User LDAGULTO inserted permission (234).'),('TL-881','LDAGULTO','Insert','2022-04-08 10:32:17','User LDAGULTO inserted permission (235).'),('TL-882','LDAGULTO','Insert','2022-04-08 10:32:31','User LDAGULTO inserted permission (236).'),('TL-883','LDAGULTO','Insert','2022-04-08 10:32:36','User LDAGULTO inserted permission (237).'),('TL-82','LDAGULTO','Update','2022-04-08 10:34:45','User LDAGULTO updated role permission (RL-1).'),('TL-884','LDAGULTO','Insert','2022-04-08 10:55:07','User LDAGULTO inserted government contribution (1).'),('TL-885','LDAGULTO','Insert','2022-04-08 10:55:33','User LDAGULTO inserted system parameter (31).'),('TL-885','LDAGULTO','Update','2022-04-08 10:56:28','User LDAGULTO updated system parameter (31).'),('TL-886','LDAGULTO','Insert','2022-04-08 10:56:31','User LDAGULTO inserted government contribution (2).'),('TL-886','LDAGULTO','Update','2022-04-08 10:56:45','User LDAGULTO updated government contribution (2).'),('TL-886','LDAGULTO','Update','2022-04-08 10:56:51','User LDAGULTO updated government contribution (2).'),('TL-887','LDAGULTO','Insert','2022-04-08 10:57:12','User LDAGULTO inserted government contribution (3).'),('TL-888','LDAGULTO','Insert','2022-04-08 11:19:22','User LDAGULTO inserted policy (50).'),('TL-889','LDAGULTO','Insert','2022-04-08 11:19:39','User LDAGULTO inserted permission (238).'),('TL-890','LDAGULTO','Insert','2022-04-08 11:19:54','User LDAGULTO inserted permission (239).'),('TL-891','LDAGULTO','Insert','2022-04-08 11:20:06','User LDAGULTO inserted permission (240).'),('TL-892','LDAGULTO','Insert','2022-04-08 11:20:12','User LDAGULTO inserted permission (241).'),('TL-893','LDAGULTO','Insert','2022-04-08 11:20:18','User LDAGULTO inserted permission (242).'),('TL-894','LDAGULTO','Insert','2022-04-08 11:34:30','User LDAGULTO inserted system parameter (32).'),('TL-82','LDAGULTO','Update','2022-04-08 11:34:49','User LDAGULTO updated role permission (RL-1).'),('TL-895','LDAGULTO','Insert','2022-04-09 17:54:16','User LDAGULTO inserted contribution bracket (1).'),('TL-896','LDAGULTO','Insert','2022-04-09 17:55:41','User LDAGULTO inserted contribution bracket (2).'),('TL-896','LDAGULTO','Update','2022-04-09 17:55:50','User LDAGULTO updated contribution bracket (2).'),('TL-897','LDAGULTO','Insert','2022-04-09 18:05:55','User LDAGULTO inserted contribution bracket (3).'),('TL-898','LDAGULTO','Insert','2022-04-09 18:08:51','User LDAGULTO inserted policy (51).'),('TL-899','LDAGULTO','Insert','2022-04-09 18:09:01','User LDAGULTO inserted permission (243).'),('TL-900','LDAGULTO','Insert','2022-04-09 18:09:07','User LDAGULTO inserted permission (244).'),('TL-901','LDAGULTO','Insert','2022-04-09 18:09:12','User LDAGULTO inserted permission (245).'),('TL-902','LDAGULTO','Insert','2022-04-09 18:09:16','User LDAGULTO inserted permission (246).'),('TL-903','LDAGULTO','Insert','2022-04-09 18:09:32','User LDAGULTO inserted permission (247).'),('TL-82','LDAGULTO','Update','2022-04-09 18:12:08','User LDAGULTO updated role permission (RL-1).'),('TL-904','LDAGULTO','Insert','2022-04-09 18:43:28','User LDAGULTO inserted system code (LOANTYPE).'),('TL-905','LDAGULTO','Insert','2022-04-09 18:43:38','User LDAGULTO inserted system code (SALARYLOAN).'),('TL-906','LDAGULTO','Insert','2022-04-10 15:25:10','User LDAGULTO inserted system code (LOANTERM).'),('TL-907','LDAGULTO','Insert','2022-04-10 15:25:35','User LDAGULTO inserted system code (MONTHS).'),('TL-908','LDAGULTO','Insert','2022-04-10 15:25:50','User LDAGULTO inserted system code (BIWEEKLY).'),('TL-908','LDAGULTO','Delete','2022-04-10 15:26:55','User LDAGULTO deleted system code (BIWEEKLY).'),('TL-909','LDAGULTO','Insert','2022-04-10 15:27:14','User LDAGULTO inserted system code (BIWEEKLY).'),('TL-910','LDAGULTO','Insert','2022-04-10 15:29:23','User LDAGULTO inserted system code (WEEKLY).'),('TL-911','LDAGULTO','Insert','2022-04-10 15:29:37','User LDAGULTO inserted system code (YEARLY).'),('TL-907','LDAGULTO','Delete','2022-04-10 15:30:44','User LDAGULTO deleted system code (MONTHS).'),('TL-912','LDAGULTO','Insert','2022-04-10 15:31:03','User LDAGULTO inserted system code (MONTHLY).'),('TL-913','LDAGULTO','Insert','2022-04-11 09:06:25','User LDAGULTO inserted allowance (53).'),('TL-914','LDAGULTO','Insert','2022-04-11 09:06:25','User LDAGULTO inserted allowance (54).'),('TL-915','LDAGULTO','Insert','2022-04-11 09:06:26','User LDAGULTO inserted allowance (55).'),('TL-916','LDAGULTO','Insert','2022-04-11 09:06:26','User LDAGULTO inserted allowance (56).'),('TL-917','LDAGULTO','Insert','2022-04-11 09:06:26','User LDAGULTO inserted allowance (57).'),('TL-918','LDAGULTO','Insert','2022-04-11 09:06:26','User LDAGULTO inserted allowance (58).'),('TL-919','LDAGULTO','Insert','2022-04-11 09:06:26','User LDAGULTO inserted allowance (59).'),('TL-920','LDAGULTO','Insert','2022-04-11 09:06:27','User LDAGULTO inserted allowance (60).'),('TL-921','LDAGULTO','Insert','2022-04-11 09:06:27','User LDAGULTO inserted allowance (61).'),('TL-922','LDAGULTO','Insert','2022-04-11 09:06:27','User LDAGULTO inserted allowance (62).'),('TL-923','LDAGULTO','Insert','2022-04-11 09:06:27','User LDAGULTO inserted allowance (63).'),('TL-924','LDAGULTO','Insert','2022-04-11 09:06:27','User LDAGULTO inserted allowance (64).'),('TL-925','LDAGULTO','Insert','2022-04-11 09:14:59','User LDAGULTO inserted allowance (65).'),('TL-926','LDAGULTO','Insert','2022-04-11 09:14:59','User LDAGULTO inserted allowance (66).'),('TL-927','LDAGULTO','Insert','2022-04-11 09:15:00','User LDAGULTO inserted allowance (67).'),('TL-928','LDAGULTO','Insert','2022-04-11 09:15:00','User LDAGULTO inserted allowance (68).'),('TL-929','LDAGULTO','Insert','2022-04-11 09:15:00','User LDAGULTO inserted allowance (69).'),('TL-930','LDAGULTO','Insert','2022-04-11 09:15:00','User LDAGULTO inserted allowance (70).'),('TL-931','LDAGULTO','Insert','2022-04-11 09:15:00','User LDAGULTO inserted allowance (71).'),('TL-932','LDAGULTO','Insert','2022-04-11 09:15:00','User LDAGULTO inserted allowance (72).'),('TL-933','LDAGULTO','Insert','2022-04-11 09:15:01','User LDAGULTO inserted allowance (73).'),('TL-934','LDAGULTO','Insert','2022-04-11 09:15:01','User LDAGULTO inserted allowance (74).'),('TL-935','LDAGULTO','Insert','2022-04-11 09:15:01','User LDAGULTO inserted allowance (75).'),('TL-936','LDAGULTO','Insert','2022-04-11 09:15:01','User LDAGULTO inserted allowance (76).'),('TL-937','LDAGULTO','Insert','2022-04-11 11:21:54','User LDAGULTO inserted system parameter (33).'),('TL-938','LDAGULTO','Insert','2022-04-11 13:10:24','User LDAGULTO inserted system parameter (34).'),('TL-942','LDAGULTO','Insert','2022-04-11 13:16:50','User LDAGULTO inserted loan details (1).'),('TL-943','LDAGULTO','Insert','2022-04-11 13:16:50','User LDAGULTO inserted loan details (2).'),('TL-944','LDAGULTO','Insert','2022-04-11 13:16:51','User LDAGULTO inserted loan details (3).'),('TL-945','LDAGULTO','Insert','2022-04-11 13:16:51','User LDAGULTO inserted loan details (4).'),('TL-946','LDAGULTO','Insert','2022-04-11 13:16:51','User LDAGULTO inserted loan details (5).'),('TL-947','LDAGULTO','Insert','2022-04-11 13:16:51','User LDAGULTO inserted loan details (6).'),('TL-948','LDAGULTO','Insert','2022-04-11 13:16:51','User LDAGULTO inserted loan details (7).'),('TL-949','LDAGULTO','Insert','2022-04-11 13:16:52','User LDAGULTO inserted loan details (8).'),('TL-950','LDAGULTO','Insert','2022-04-11 13:16:52','User LDAGULTO inserted loan details (9).'),('TL-951','LDAGULTO','Insert','2022-04-11 13:16:52','User LDAGULTO inserted loan details (10).'),('TL-952','LDAGULTO','Insert','2022-04-11 13:16:52','User LDAGULTO inserted loan details (11).'),('TL-953','LDAGULTO','Insert','2022-04-11 13:16:52','User LDAGULTO inserted loan details (12).'),('TL-941','LDAGULTO','Insert','2022-04-11 13:16:52','User LDAGULTO inserted loan (3).'),('TL-955','LDAGULTO','Insert','2022-04-11 13:36:12','User LDAGULTO inserted loan details (13).'),('TL-956','LDAGULTO','Insert','2022-04-11 13:36:12','User LDAGULTO inserted loan details (14).'),('TL-957','LDAGULTO','Insert','2022-04-11 13:36:12','User LDAGULTO inserted loan details (15).'),('TL-958','LDAGULTO','Insert','2022-04-11 13:36:13','User LDAGULTO inserted loan details (16).'),('TL-959','LDAGULTO','Insert','2022-04-11 13:36:13','User LDAGULTO inserted loan details (17).'),('TL-960','LDAGULTO','Insert','2022-04-11 13:36:13','User LDAGULTO inserted loan details (18).'),('TL-961','LDAGULTO','Insert','2022-04-11 13:36:13','User LDAGULTO inserted loan details (19).'),('TL-962','LDAGULTO','Insert','2022-04-11 13:36:13','User LDAGULTO inserted loan details (20).'),('TL-963','LDAGULTO','Insert','2022-04-11 13:36:13','User LDAGULTO inserted loan details (21).'),('TL-964','LDAGULTO','Insert','2022-04-11 13:36:14','User LDAGULTO inserted loan details (22).'),('TL-965','LDAGULTO','Insert','2022-04-11 13:36:14','User LDAGULTO inserted loan details (23).'),('TL-966','LDAGULTO','Insert','2022-04-11 13:36:14','User LDAGULTO inserted loan details (24).'),('TL-954','LDAGULTO','Insert','2022-04-11 13:36:14','User LDAGULTO inserted loan (4).'),('TL-968','LDAGULTO','Insert','2022-04-11 13:37:45','User LDAGULTO inserted loan details (25).'),('TL-969','LDAGULTO','Insert','2022-04-11 13:37:45','User LDAGULTO inserted loan details (26).'),('TL-970','LDAGULTO','Insert','2022-04-11 13:37:46','User LDAGULTO inserted loan details (27).'),('TL-971','LDAGULTO','Insert','2022-04-11 13:37:46','User LDAGULTO inserted loan details (28).'),('TL-972','LDAGULTO','Insert','2022-04-11 13:37:46','User LDAGULTO inserted loan details (29).'),('TL-973','LDAGULTO','Insert','2022-04-11 13:37:46','User LDAGULTO inserted loan details (30).'),('TL-974','LDAGULTO','Insert','2022-04-11 13:37:46','User LDAGULTO inserted loan details (31).'),('TL-975','LDAGULTO','Insert','2022-04-11 13:37:46','User LDAGULTO inserted loan details (32).'),('TL-976','LDAGULTO','Insert','2022-04-11 13:37:47','User LDAGULTO inserted loan details (33).'),('TL-977','LDAGULTO','Insert','2022-04-11 13:37:47','User LDAGULTO inserted loan details (34).'),('TL-978','LDAGULTO','Insert','2022-04-11 13:37:47','User LDAGULTO inserted loan details (35).'),('TL-979','LDAGULTO','Insert','2022-04-11 13:37:47','User LDAGULTO inserted loan details (36).'),('TL-967','LDAGULTO','Insert','2022-04-11 13:37:47','User LDAGULTO inserted loan (5).'),('TL-967','LDAGULTO','Update','2022-04-11 13:46:47','User LDAGULTO updated loan ().'),('TL-967','LDAGULTO','Update','2022-04-11 13:53:54','User LDAGULTO updated loan (5).'),('TL-967','LDAGULTO','Update','2022-04-11 13:55:59','User LDAGULTO updated loan (5).'),('TL-980','LDAGULTO','Insert','2022-04-11 13:56:00','User LDAGULTO inserted loan details (37).'),('TL-981','LDAGULTO','Insert','2022-04-11 13:56:00','User LDAGULTO inserted loan details (38).'),('TL-982','LDAGULTO','Insert','2022-04-11 13:56:00','User LDAGULTO inserted loan details (39).'),('TL-983','LDAGULTO','Insert','2022-04-11 13:56:00','User LDAGULTO inserted loan details (40).'),('TL-984','LDAGULTO','Insert','2022-04-11 13:56:00','User LDAGULTO inserted loan details (41).'),('TL-985','LDAGULTO','Insert','2022-04-11 13:56:00','User LDAGULTO inserted loan details (42).'),('TL-986','LDAGULTO','Insert','2022-04-11 13:56:01','User LDAGULTO inserted loan details (43).'),('TL-987','LDAGULTO','Insert','2022-04-11 13:56:01','User LDAGULTO inserted loan details (44).'),('TL-988','LDAGULTO','Insert','2022-04-11 13:56:01','User LDAGULTO inserted loan details (45).'),('TL-989','LDAGULTO','Insert','2022-04-11 13:56:01','User LDAGULTO inserted loan details (46).'),('TL-990','LDAGULTO','Insert','2022-04-11 13:56:01','User LDAGULTO inserted loan details (47).'),('TL-991','LDAGULTO','Insert','2022-04-11 13:56:02','User LDAGULTO inserted loan details (48).'),('TL-992','LDAGULTO','Insert','2022-04-11 13:56:02','User LDAGULTO inserted loan details (49).'),('TL-967','LDAGULTO','Update','2022-04-11 13:56:52','User LDAGULTO updated loan (5).'),('TL-993','LDAGULTO','Insert','2022-04-11 13:56:53','User LDAGULTO inserted loan details (50).'),('TL-994','LDAGULTO','Insert','2022-04-11 13:56:53','User LDAGULTO inserted loan details (51).'),('TL-995','LDAGULTO','Insert','2022-04-11 13:56:53','User LDAGULTO inserted loan details (52).'),('TL-996','LDAGULTO','Insert','2022-04-11 13:56:53','User LDAGULTO inserted loan details (53).'),('TL-997','LDAGULTO','Insert','2022-04-11 13:56:53','User LDAGULTO inserted loan details (54).'),('TL-998','LDAGULTO','Insert','2022-04-11 13:56:53','User LDAGULTO inserted loan details (55).'),('TL-999','LDAGULTO','Insert','2022-04-11 13:56:53','User LDAGULTO inserted loan details (56).'),('TL-1000','LDAGULTO','Insert','2022-04-11 13:56:53','User LDAGULTO inserted loan details (57).'),('TL-1001','LDAGULTO','Insert','2022-04-11 13:56:54','User LDAGULTO inserted loan details (58).'),('TL-1002','LDAGULTO','Insert','2022-04-11 13:56:54','User LDAGULTO inserted loan details (59).'),('TL-1003','LDAGULTO','Insert','2022-04-11 13:56:54','User LDAGULTO inserted loan details (60).'),('TL-1004','LDAGULTO','Insert','2022-04-11 13:56:54','User LDAGULTO inserted loan details (61).'),('TL-1005','LDAGULTO','Insert','2022-04-11 13:56:54','User LDAGULTO inserted loan details (62).'),('TL-967','LDAGULTO','Update','2022-04-11 13:56:59','User LDAGULTO updated loan (5).'),('TL-1006','LDAGULTO','Insert','2022-04-11 13:56:59','User LDAGULTO inserted loan details (63).'),('TL-1007','LDAGULTO','Insert','2022-04-11 13:56:59','User LDAGULTO inserted loan details (64).'),('TL-1008','LDAGULTO','Insert','2022-04-11 13:56:59','User LDAGULTO inserted loan details (65).'),('TL-1009','LDAGULTO','Insert','2022-04-11 13:57:00','User LDAGULTO inserted loan details (66).'),('TL-1010','LDAGULTO','Insert','2022-04-11 13:57:00','User LDAGULTO inserted loan details (67).'),('TL-1011','LDAGULTO','Insert','2022-04-11 13:57:00','User LDAGULTO inserted loan details (68).'),('TL-1012','LDAGULTO','Insert','2022-04-11 13:57:00','User LDAGULTO inserted loan details (69).'),('TL-1013','LDAGULTO','Insert','2022-04-11 13:57:00','User LDAGULTO inserted loan details (70).'),('TL-1014','LDAGULTO','Insert','2022-04-11 13:57:00','User LDAGULTO inserted loan details (71).'),('TL-1015','LDAGULTO','Insert','2022-04-11 13:57:00','User LDAGULTO inserted loan details (72).'),('TL-1016','LDAGULTO','Insert','2022-04-11 13:57:01','User LDAGULTO inserted loan details (73).'),('TL-1017','LDAGULTO','Insert','2022-04-11 13:57:01','User LDAGULTO inserted loan details (74).'),('TL-967','LDAGULTO','Update','2022-04-11 13:58:16','User LDAGULTO updated loan (5).'),('TL-1018','LDAGULTO','Insert','2022-04-11 13:58:16','User LDAGULTO inserted loan details (75).'),('TL-1019','LDAGULTO','Insert','2022-04-11 13:58:16','User LDAGULTO inserted loan details (76).'),('TL-1020','LDAGULTO','Insert','2022-04-11 13:58:16','User LDAGULTO inserted loan details (77).'),('TL-1021','LDAGULTO','Insert','2022-04-11 13:58:16','User LDAGULTO inserted loan details (78).'),('TL-1022','LDAGULTO','Insert','2022-04-11 13:58:16','User LDAGULTO inserted loan details (79).'),('TL-1023','LDAGULTO','Insert','2022-04-11 13:58:16','User LDAGULTO inserted loan details (80).'),('TL-1024','LDAGULTO','Insert','2022-04-11 13:58:17','User LDAGULTO inserted loan details (81).'),('TL-1025','LDAGULTO','Insert','2022-04-11 13:58:17','User LDAGULTO inserted loan details (82).'),('TL-1026','LDAGULTO','Insert','2022-04-11 13:58:17','User LDAGULTO inserted loan details (83).'),('TL-1027','LDAGULTO','Insert','2022-04-11 13:58:17','User LDAGULTO inserted loan details (84).'),('TL-1028','LDAGULTO','Insert','2022-04-11 13:58:17','User LDAGULTO inserted loan details (85).'),('TL-1029','LDAGULTO','Insert','2022-04-11 13:58:17','User LDAGULTO inserted loan details (86).'),('TL-1030','LDAGULTO','Insert','2022-04-11 15:36:03','User LDAGULTO inserted policy (52).'),('TL-1031','LDAGULTO','Insert','2022-04-11 15:36:26','User LDAGULTO inserted permission (248).'),('TL-82','LDAGULTO','Update','2022-04-11 15:40:38','User LDAGULTO updated role permission (RL-1).'),('TL-1032','LDAGULTO','Insert','2022-04-12 09:08:34','User LDAGULTO inserted permission (249).'),('TL-1034','LDAGULTO','Insert','2022-04-12 09:19:28','User LDAGULTO inserted loan details (87).'),('TL-1035','LDAGULTO','Insert','2022-04-12 09:19:28','User LDAGULTO inserted loan details (88).'),('TL-1036','LDAGULTO','Insert','2022-04-12 09:19:29','User LDAGULTO inserted loan details (89).'),('TL-1037','LDAGULTO','Insert','2022-04-12 09:19:29','User LDAGULTO inserted loan details (90).'),('TL-1038','LDAGULTO','Insert','2022-04-12 09:19:29','User LDAGULTO inserted loan details (91).'),('TL-1039','LDAGULTO','Insert','2022-04-12 09:19:29','User LDAGULTO inserted loan details (92).'),('TL-1040','LDAGULTO','Insert','2022-04-12 09:19:30','User LDAGULTO inserted loan details (93).'),('TL-1041','LDAGULTO','Insert','2022-04-12 09:19:30','User LDAGULTO inserted loan details (94).'),('TL-1042','LDAGULTO','Insert','2022-04-12 09:19:30','User LDAGULTO inserted loan details (95).'),('TL-1043','LDAGULTO','Insert','2022-04-12 09:19:30','User LDAGULTO inserted loan details (96).'),('TL-1044','LDAGULTO','Insert','2022-04-12 09:19:30','User LDAGULTO inserted loan details (97).'),('TL-1045','LDAGULTO','Insert','2022-04-12 09:19:30','User LDAGULTO inserted loan details (98).'),('TL-1033','LDAGULTO','Insert','2022-04-12 09:19:30','User LDAGULTO inserted loan (6).'),('TL-82','LDAGULTO','Update','2022-04-12 09:51:46','User LDAGULTO updated role permission (RL-1).'),('TL-1032','LDAGULTO','Update','2022-04-12 10:25:12','User LDAGULTO updated permission (249).'),('TL-1032','LDAGULTO','Update','2022-04-12 10:46:02','User LDAGULTO updated permission (249).'),('TL-1032','LDAGULTO','Update','2022-04-12 11:30:36','User LDAGULTO updated permission (249).'),('TL-1047','LDAGULTO','Insert','2022-04-12 13:54:22','User LDAGULTO inserted loan details (99).'),('TL-1048','LDAGULTO','Insert','2022-04-12 13:54:23','User LDAGULTO inserted loan details (100).'),('TL-1049','LDAGULTO','Insert','2022-04-12 13:54:23','User LDAGULTO inserted loan details (101).'),('TL-1050','LDAGULTO','Insert','2022-04-12 13:54:23','User LDAGULTO inserted loan details (102).'),('TL-1051','LDAGULTO','Insert','2022-04-12 13:54:23','User LDAGULTO inserted loan details (103).'),('TL-1052','LDAGULTO','Insert','2022-04-12 13:54:24','User LDAGULTO inserted loan details (104).'),('TL-1053','LDAGULTO','Insert','2022-04-12 13:54:24','User LDAGULTO inserted loan details (105).'),('TL-1054','LDAGULTO','Insert','2022-04-12 13:54:24','User LDAGULTO inserted loan details (106).'),('TL-1055','LDAGULTO','Insert','2022-04-12 13:54:24','User LDAGULTO inserted loan details (107).'),('TL-1056','LDAGULTO','Insert','2022-04-12 13:54:24','User LDAGULTO inserted loan details (108).'),('TL-1057','LDAGULTO','Insert','2022-04-12 13:54:24','User LDAGULTO inserted loan details (109).'),('TL-1058','LDAGULTO','Insert','2022-04-12 13:54:24','User LDAGULTO inserted loan details (110).'),('TL-1046','LDAGULTO','Insert','2022-04-12 13:54:24','User LDAGULTO inserted loan (7).'),('TL-1032','LDAGULTO','Update','2022-04-12 13:59:30','User LDAGULTO updated permission (249).'),('TL-1032','LDAGULTO','Update','2022-04-12 14:10:28','User LDAGULTO updated permission (249).'),('TL-1059','LDAGULTO','Insert','2022-04-12 14:10:41','User LDAGULTO inserted permission (250).'),('TL-1060','LDAGULTO','Insert','2022-04-12 14:13:19','User LDAGULTO inserted permission (251).'),('TL-82','LDAGULTO','Update','2022-04-12 14:24:54','User LDAGULTO updated role permission (RL-1).'),('TL-937','LDAGULTO','Update','2022-04-13 09:08:30','User LDAGULTO updated system parameter (33).'),('TL-938','LDAGULTO','Delete','2022-04-13 09:08:34','User LDAGULTO deleted system parameter (34).'),('TL-1','LDAGULTO','Update','2022-04-13 09:08:41','User LDAGULTO updated system parameter (1).'),('TL-898','LDAGULTO','Update','2022-04-13 09:09:09','User LDAGULTO updated policy (51).'),('TL-1030','LDAGULTO','Delete','2022-04-13 09:09:24','User LDAGULTO deleted policy (52).'),('TL-5','LDAGULTO','Update','2022-04-13 09:09:39','User LDAGULTO updated system parameter (4).'),('TL-899','LDAGULTO','Update','2022-04-13 09:10:04','User LDAGULTO updated permission (243).'),('TL-900','LDAGULTO','Update','2022-04-13 09:10:08','User LDAGULTO updated permission (244).'),('TL-901','LDAGULTO','Update','2022-04-13 09:10:12','User LDAGULTO updated permission (245).'),('TL-902','LDAGULTO','Update','2022-04-13 09:10:16','User LDAGULTO updated permission (246).'),('TL-909','LDAGULTO','Delete','2022-04-13 09:25:31','User LDAGULTO deleted system code (BIWEEKLY).'),('TL-910','LDAGULTO','Delete','2022-04-13 09:25:31','User LDAGULTO deleted system code (WEEKLY).'),('TL-911','LDAGULTO','Delete','2022-04-13 09:25:31','User LDAGULTO deleted system code (YEARLY).'),('TL-912','LDAGULTO','Delete','2022-04-13 09:25:31','User LDAGULTO deleted system code (MONTHLY).'),('TL-905','LDAGULTO','Delete','2022-04-13 09:25:31','User LDAGULTO deleted system code (SALARYLOAN).'),('TL-904','LDAGULTO','Delete','2022-04-13 09:25:31','User LDAGULTO deleted system code (LOANTYPE).'),('TL-906','LDAGULTO','Delete','2022-04-13 09:25:31','User LDAGULTO deleted system code (LOANTERM).'),('TL-1061','LDAGULTO','Insert','2022-04-13 09:57:08','User LDAGULTO inserted government contribution (4).'),('TL-1061','LDAGULTO','Update','2022-04-13 09:57:11','User LDAGULTO updated government contribution (4).'),('TL-877','LDAGULTO','Update','2022-04-13 10:28:07','User LDAGULTO updated deduction type (1).'),('TL-877','LDAGULTO','Update','2022-04-13 10:28:29','User LDAGULTO updated deduction type (1).'),('TL-1062','LDAGULTO','Insert','2022-04-13 10:44:20','User LDAGULTO inserted deduction (8).'),('TL-1063','LDAGULTO','Insert','2022-04-13 10:44:20','User LDAGULTO inserted deduction (9).'),('TL-1064','LDAGULTO','Insert','2022-04-13 10:44:21','User LDAGULTO inserted deduction (10).'),('TL-1065','LDAGULTO','Insert','2022-04-13 10:44:21','User LDAGULTO inserted deduction (11).'),('TL-1066','LDAGULTO','Insert','2022-04-13 10:44:21','User LDAGULTO inserted deduction (12).'),('TL-1067','LDAGULTO','Insert','2022-04-13 10:44:21','User LDAGULTO inserted deduction (13).'),('TL-1068','LDAGULTO','Insert','2022-04-13 10:44:21','User LDAGULTO inserted deduction (14).'),('TL-1069','LDAGULTO','Insert','2022-04-13 10:44:22','User LDAGULTO inserted deduction (15).'),('TL-1070','LDAGULTO','Insert','2022-04-13 10:44:22','User LDAGULTO inserted deduction (16).'),('TL-1071','LDAGULTO','Insert','2022-04-13 10:44:22','User LDAGULTO inserted deduction (17).'),('TL-1072','LDAGULTO','Insert','2022-04-13 10:44:22','User LDAGULTO inserted deduction (18).'),('TL-1073','LDAGULTO','Insert','2022-04-13 10:44:22','User LDAGULTO inserted deduction (19).'),('TL-1064','LDAGULTO','Update','2022-04-13 10:46:38','User LDAGULTO updated deduction (10).'),('TL-1074','LDAGULTO','Insert','2022-04-13 10:52:32','User LDAGULTO inserted system parameter (34).'),('TL-1075','LDAGULTO','Insert','2022-04-13 10:53:08','User LDAGULTO inserted policy (53).'),('TL-1075','LDAGULTO','Delete','2022-04-13 10:53:41','User LDAGULTO deleted policy (53).'),('TL-4','LDAGULTO','Update','2022-04-13 10:54:07','User LDAGULTO updated system parameter (3).'),('TL-1076','LDAGULTO','Insert','2022-04-13 10:55:21','User LDAGULTO inserted policy (52).'),('TL-1077','LDAGULTO','Insert','2022-04-13 10:55:39','User LDAGULTO inserted permission (248).'),('TL-1078','LDAGULTO','Insert','2022-04-13 10:55:50','User LDAGULTO inserted permission (249).'),('TL-1079','LDAGULTO','Insert','2022-04-13 10:55:57','User LDAGULTO inserted permission (250).'),('TL-1080','LDAGULTO','Insert','2022-04-13 10:56:04','User LDAGULTO inserted permission (251).'),('TL-1081','LDAGULTO','Insert','2022-04-13 10:56:11','User LDAGULTO inserted permission (252).'),('TL-82','LDAGULTO','Update','2022-04-13 10:58:11','User LDAGULTO updated role permission (RL-1).'),('TL-1082','LDAGULTO','Insert','2022-04-13 11:45:46','User LDAGULTO inserted government contribution (5).'),('TL-1083','LDAGULTO','Insert','2022-04-13 13:35:08','User LDAGULTO inserted contribution deduction (1).'),('TL-1084','LDAGULTO','Insert','2022-04-13 13:35:09','User LDAGULTO inserted contribution deduction (2).'),('TL-1085','LDAGULTO','Insert','2022-04-13 13:35:09','User LDAGULTO inserted contribution deduction (3).'),('TL-1086','LDAGULTO','Insert','2022-04-13 13:35:09','User LDAGULTO inserted contribution deduction (4).'),('TL-1087','LDAGULTO','Insert','2022-04-13 13:35:09','User LDAGULTO inserted contribution deduction (5).'),('TL-1088','LDAGULTO','Insert','2022-04-13 13:35:10','User LDAGULTO inserted contribution deduction (6).'),('TL-1089','LDAGULTO','Insert','2022-04-13 13:35:10','User LDAGULTO inserted contribution deduction (7).'),('TL-1090','LDAGULTO','Insert','2022-04-13 13:35:10','User LDAGULTO inserted contribution deduction (8).'),('TL-1091','LDAGULTO','Insert','2022-04-13 13:35:10','User LDAGULTO inserted contribution deduction (9).'),('TL-1092','LDAGULTO','Insert','2022-04-13 13:35:10','User LDAGULTO inserted contribution deduction (10).'),('TL-1093','LDAGULTO','Insert','2022-04-13 13:35:10','User LDAGULTO inserted contribution deduction (11).'),('TL-1094','LDAGULTO','Insert','2022-04-13 13:35:10','User LDAGULTO inserted contribution deduction (12).'),('TL-1083','LDAGULTO','Update','2022-04-13 13:41:48','User LDAGULTO updated contribution deduction (1).'),('TL-1083','LDAGULTO','Update','2022-04-13 13:41:54','User LDAGULTO updated contribution deduction (1).'),('TL-1083','LDAGULTO','Update','2022-04-13 13:42:02','User LDAGULTO updated contribution deduction (1).'),('TL-1083','LDAGULTO','Update','2022-04-13 13:42:32','User LDAGULTO updated contribution deduction (1).'),('TL-1083','LDAGULTO','Update','2022-04-13 13:42:36','User LDAGULTO updated contribution deduction (1).'),('TL-1095','LDAGULTO','Insert','2022-04-13 13:51:04','User LDAGULTO inserted policy (53).'),('TL-1096','LDAGULTO','Insert','2022-04-13 13:51:39','User LDAGULTO inserted permission (253).'),('TL-1097','LDAGULTO','Insert','2022-04-13 13:51:49','User LDAGULTO inserted permission (254).'),('TL-1098','LDAGULTO','Insert','2022-04-13 13:51:57','User LDAGULTO inserted permission (255).'),('TL-1099','LDAGULTO','Insert','2022-04-13 13:52:03','User LDAGULTO inserted permission (256).'),('TL-1100','LDAGULTO','Insert','2022-04-13 13:52:12','User LDAGULTO inserted permission (257).'),('TL-82','LDAGULTO','Update','2022-04-13 13:56:51','User LDAGULTO updated role permission (RL-1).'),('TL-134','LDAGULTO','Update','2022-04-14 10:03:31','User LDAGULTO updated branch (BRCH-3).'),('TL-576','LDAGULTO','Update','2022-04-14 13:49:38','User LDAGULTO updated attendance time out (22).'),('TL-1101','LDAGULTO','Insert','2022-04-14 13:50:18','User LDAGULTO inserted attendance time in (29).'),('TL-1101','LDAGULTO','Update','2022-04-14 13:52:50','User LDAGULTO updated attendance time out (29).'),('TL-1101','LDAGULTO','Update','2022-04-14 14:01:04','User LDAGULTO updated employee attendance (29).'),('TL-1101','LDAGULTO','Update','2022-04-14 14:02:17','User LDAGULTO updated employee attendance (29).'),('TL-1101','LDAGULTO','Update','2022-04-14 14:02:51','User LDAGULTO updated employee attendance (29).'),('TL-1101','LDAGULTO','Update','2022-04-14 14:03:46','User LDAGULTO updated employee attendance (29).'),('TL-1101','LDAGULTO','Update','2022-04-14 14:03:53','User LDAGULTO updated employee attendance (29).'),('TL-1101','LDAGULTO','Update','2022-04-14 14:05:54','User LDAGULTO updated employee attendance (29).'),('TL-1101','LDAGULTO','Update','2022-04-14 14:05:59','User LDAGULTO updated employee attendance (29).'),('TL-1101','LDAGULTO','Update','2022-04-14 14:06:10','User LDAGULTO updated employee attendance (29).'),('TL-576','LDAGULTO','Update','2022-04-14 14:13:12','User LDAGULTO updated employee attendance (22).'),('TL-576','LDAGULTO','Update','2022-04-14 14:13:24','User LDAGULTO updated employee attendance (22).'),('TL-1101','LDAGULTO','Update','2022-04-14 14:24:30','User LDAGULTO updated employee attendance (29).'),('TL-1102','LDAGULTO','Insert','2022-04-14 15:46:16','User LDAGULTO inserted policy (54).'),('TL-1103','LDAGULTO','Insert','2022-04-14 15:46:33','User LDAGULTO inserted permission (258).'),('TL-1104','LDAGULTO','Insert','2022-04-14 15:46:43','User LDAGULTO inserted permission (259).'),('TL-82','LDAGULTO','Update','2022-04-14 15:48:18','User LDAGULTO updated role permission (RL-1).'),('TL-1105','LDAGULTO','Insert','2022-04-14 19:53:11','User LDAGULTO inserted work shift (5).'),('TL-1105','LDAGULTO','Update','2022-04-14 19:53:26','User LDAGULTO updated work shift (5).'),('TL-1105','LDAGULTO','Insert','2022-04-15 09:21:26','User LDAGULTO inserted work shift schedule (5).'),('TL-329','LDAGULTO','Delete','2022-04-15 09:43:23','User LDAGULTO deleted work shift (1).'),('TL-1105','LDAGULTO','Delete','2022-04-15 09:43:23','User LDAGULTO deleted work shift (5).'),('TL-1106','LDAGULTO','Insert','2022-04-15 09:43:32','User LDAGULTO inserted work shift (6).'),('TL-1106','LDAGULTO','Insert','2022-04-15 09:47:50','User LDAGULTO inserted work shift schedule (6).'),('TL-1107','LDAGULTO','Insert','2022-04-15 09:57:53','User LDAGULTO inserted work shift (7).'),('TL-1107','LDAGULTO','Insert','2022-04-15 09:59:29','User LDAGULTO inserted work shift schedule (7).'),('TL-1101','LDAGULTO','Update','2022-04-15 13:14:59','User LDAGULTO updated employee attendance (29).'),('TL-1108','LDAGULTO','Insert','2022-04-15 19:58:45','User LDAGULTO inserted attendance adjustment (16).'),('TL-1108','LDAGULTO','Update','2022-04-15 19:58:45','User LDAGULTO updated attendance adjustment file (16).'),('TL-1108','LDAGULTO','For Recommendation','2022-04-15 19:58:51','User LDAGULTO tagged the attendance adjustment for recommendation (16).'),('TL-1108','LDAGULTO','Recommend','2022-04-15 19:59:11','User LDAGULTO recommended attendance adjustment (16).'),('TL-1101','LDAGULTO','Update','2022-04-16 14:56:52','User LDAGULTO updated employee attendance (29).'),('TL-1108','LDAGULTO','Approve','2022-04-16 14:56:52','User LDAGULTO approved attendance adjustment (16).'),('TL-1109','LDAGULTO','Insert','2022-04-16 15:34:39','User LDAGULTO inserted attendance creation (24).'),('TL-1109','LDAGULTO','Update','2022-04-16 15:34:39','User LDAGULTO updated attendance creation file (24).'),('TL-1109','LDAGULTO','For Recommendation','2022-04-16 15:34:41','User LDAGULTO tagged the attendance creation for recommendation (24).'),('TL-1109','LDAGULTO','Recommend','2022-04-16 15:34:56','User LDAGULTO recommended attendance creation (24).'),('TL-1110','LDAGULTO','Insert','2022-04-16 15:35:29','User LDAGULTO inserted employee attendance (30).'),('TL-1109','LDAGULTO','Approve','2022-04-16 15:35:29','User LDAGULTO approved attendance creation (24).'),('TL-1111','LDAGULTO','Insert','2022-04-16 18:40:15','User LDAGULTO inserted policy (55).'),('TL-1112','LDAGULTO','Insert','2022-04-16 18:40:28','User LDAGULTO inserted permission (260).'),('TL-1113','LDAGULTO','Insert','2022-04-16 18:40:34','User LDAGULTO inserted permission (261).'),('TL-82','LDAGULTO','Update','2022-04-16 18:42:46','User LDAGULTO updated role permission (RL-1).'),('TL-1114','LDAGULTO','Insert','2022-04-18 09:56:09','User LDAGULTO inserted upload setting (12).'),('TL-1114','LDAGULTO','Update','2022-04-18 09:56:21','User LDAGULTO updated upload setting (12).'),('TL-1115','LDAGULTO','Insert','2022-04-19 14:24:59','User LDAGULTO inserted employee (54).'),('TL-1116','LDAGULTO','Insert','2022-04-19 14:24:59','User LDAGULTO inserted employee (55).'),('TL-1115','LDAGULTO','Update','2022-04-19 14:31:05','User LDAGULTO updated employee (54).'),('TL-1116','LDAGULTO','Update','2022-04-19 14:31:06','User LDAGULTO updated employee (55).'),('TL-1117','LDAGULTO','Insert','2022-04-19 14:54:20','User LDAGULTO inserted policy (56).'),('TL-1118','LDAGULTO','Insert','2022-04-19 14:54:34','User LDAGULTO inserted permission (262).'),('TL-1119','LDAGULTO','Insert','2022-04-19 14:54:46','User LDAGULTO inserted permission (263).'),('TL-82','LDAGULTO','Update','2022-04-19 15:04:58','User LDAGULTO updated role permission (RL-1).'),('TL-1120','LDAGULTO','Insert','2022-04-19 16:30:41','User LDAGULTO inserted upload setting (13).'),('TL-1120','LDAGULTO','Update','2022-04-19 16:30:47','User LDAGULTO updated upload setting (13).');
/*!40000 ALTER TABLE `tbltransactionlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbluploadfiletype`
--

DROP TABLE IF EXISTS `tbluploadfiletype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbluploadfiletype` (
  `UPLOAD_SETTING_ID` int(50) DEFAULT NULL,
  `FILE_TYPE` varchar(50) NOT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbluploadfiletype`
--

LOCK TABLES `tbluploadfiletype` WRITE;
/*!40000 ALTER TABLE `tbluploadfiletype` DISABLE KEYS */;
INSERT INTO `tbluploadfiletype` VALUES (NULL,'gif','INS->ADMIN->2022-01-06 11:38:01'),(NULL,'jpeg','INS->ADMIN->2022-01-06 11:38:01'),(NULL,'jpg','INS->ADMIN->2022-01-06 11:38:01'),(NULL,'png','INS->ADMIN->2022-01-06 11:38:01'),(NULL,'svg','INS->ADMIN->2022-01-06 11:38:01'),(1,'gif','INS->ADMIN->2022-01-06 11:38:21'),(1,'jpeg','INS->ADMIN->2022-01-06 11:38:21'),(1,'jpg','INS->ADMIN->2022-01-06 11:38:21'),(1,'png','INS->ADMIN->2022-01-06 11:38:21'),(1,'svg','INS->ADMIN->2022-01-06 11:38:21'),(2,'gif','INS->ADMIN->2022-01-06 11:47:55'),(2,'jpeg','INS->ADMIN->2022-01-06 11:47:55'),(2,'jpg','INS->ADMIN->2022-01-06 11:47:55'),(2,'png','INS->ADMIN->2022-01-06 11:47:55'),(2,'svg','INS->ADMIN->2022-01-06 11:47:55'),(3,'gif','INS->ADMIN->2022-01-06 11:48:16'),(3,'jpeg','INS->ADMIN->2022-01-06 11:48:16'),(3,'jpg','INS->ADMIN->2022-01-06 11:48:16'),(3,'png','INS->ADMIN->2022-01-06 11:48:17'),(3,'svg','INS->ADMIN->2022-01-06 11:48:17'),(4,'gif','INS->ADMIN->2022-01-06 11:49:56'),(4,'jpeg','INS->ADMIN->2022-01-06 11:49:56'),(4,'jpg','INS->ADMIN->2022-01-06 11:49:56'),(4,'png','INS->ADMIN->2022-01-06 11:49:56'),(4,'svg','INS->ADMIN->2022-01-06 11:49:56'),(5,'gif','INS->ADMIN->2022-01-06 11:50:27'),(5,'jpeg','INS->ADMIN->2022-01-06 11:50:27'),(5,'jpg','INS->ADMIN->2022-01-06 11:50:27'),(5,'png','INS->ADMIN->2022-01-06 11:50:27'),(5,'svg','INS->ADMIN->2022-01-06 11:50:27'),(6,'gif','INS->ADMIN->2022-01-06 11:50:58'),(6,'.ico','INS->ADMIN->2022-01-06 11:50:58'),(6,'jpeg','INS->ADMIN->2022-01-06 11:50:58'),(6,'jpg','INS->ADMIN->2022-01-06 11:50:59'),(6,'png','INS->ADMIN->2022-01-06 11:50:59'),(6,'svg','INS->ADMIN->2022-01-06 11:50:59'),(7,'pdf','INS->ADMIN->2022-01-06 11:56:11'),(8,'pdf','INS->ADMIN->2022-02-02 11:34:54'),(8,'txt','INS->ADMIN->2022-02-02 11:34:54'),(8,'xls','INS->ADMIN->2022-02-02 11:34:54'),(8,'xlsx','INS->ADMIN->2022-02-02 11:34:54'),(8,'jpeg','INS->ADMIN->2022-02-02 11:34:54'),(8,'jpg','INS->ADMIN->2022-02-02 11:34:54'),(8,'png','INS->ADMIN->2022-02-02 11:34:54'),(8,'svg','INS->ADMIN->2022-02-02 11:34:54'),(8,'ppt','INS->ADMIN->2022-02-02 11:34:54'),(8,'pptx','INS->ADMIN->2022-02-02 11:34:54'),(8,'doc','INS->ADMIN->2022-02-02 11:34:54'),(8,'docx','INS->ADMIN->2022-02-02 11:34:54'),(10,'pdf','INS->LDAGULTO->2022-03-11 02:48:59'),(10,'gif','INS->LDAGULTO->2022-03-11 02:48:59'),(10,'jpeg','INS->LDAGULTO->2022-03-11 02:48:59'),(10,'jpg','INS->LDAGULTO->2022-03-11 02:48:59'),(10,'png','INS->LDAGULTO->2022-03-11 02:48:59'),(10,'svg','INS->LDAGULTO->2022-03-11 02:48:59'),(9,'pdf','INS->LDAGULTO->2022-03-11 02:50:47'),(9,'gif','INS->LDAGULTO->2022-03-11 02:50:47'),(9,'jpeg','INS->LDAGULTO->2022-03-11 02:50:47'),(9,'jpg','INS->LDAGULTO->2022-03-11 02:50:47'),(9,'png','INS->LDAGULTO->2022-03-11 02:50:47'),(9,'svg','INS->LDAGULTO->2022-03-11 02:50:47'),(11,'pdf','INS->LDAGULTO->2022-03-25 03:30:04'),(11,'jpeg','INS->LDAGULTO->2022-03-25 03:30:04'),(11,'jpg','INS->LDAGULTO->2022-03-25 03:30:04'),(11,'png','INS->LDAGULTO->2022-03-25 03:30:04'),(12,'csv','INS->LDAGULTO->2022-04-18 09:56:21'),(13,'csv','INS->LDAGULTO->2022-04-19 04:30:47');
/*!40000 ALTER TABLE `tbluploadfiletype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbluploadsetting`
--

DROP TABLE IF EXISTS `tbluploadsetting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbluploadsetting` (
  `UPLOAD_SETTING_ID` int(50) NOT NULL,
  `UPLOAD_SETTING` varchar(200) NOT NULL,
  `DESCRIPTION` varchar(200) NOT NULL,
  `MAX_FILE_SIZE` double DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`UPLOAD_SETTING_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbluploadsetting`
--

LOCK TABLES `tbluploadsetting` WRITE;
/*!40000 ALTER TABLE `tbluploadsetting` DISABLE KEYS */;
INSERT INTO `tbluploadsetting` VALUES (1,'Login Background','Setting for login background on user interface setting page.',2,'TL-168','UPD->ADMIN->2022-01-06 11:38:20'),(2,'Logo Light','Setting for logo light on user interface setting page.',2,'TL-170','INS->ADMIN->2022-01-06 11:47:55'),(3,'Logo Dark','Setting for logo dark on user interface setting page.',2,'TL-171','INS->ADMIN->2022-01-06 11:48:16'),(4,'Logo Icon Light','Setting for logo icon light on user interface setting page.',2,'TL-172','INS->ADMIN->2022-01-06 11:49:56'),(5,'Logo Icon Dark','Setting for logo icon dark on user interface setting page.',2,'TL-173','INS->ADMIN->2022-01-06 11:50:27'),(6,'Favicon','Setting for favicon on user interface setting page.',2,'TL-174','INS->ADMIN->2022-01-06 11:50:58'),(7,'Job Description','Setting for job description on designation page.',2,'TL-175','INS->ADMIN->2022-01-06 11:56:11'),(8,'Employee Files','Setting for employee files on employee file management page and employee details page.',2,'TL-436','UPD->ADMIN->2022-02-02 11:34:54'),(9,'Attendance Creation','Settings for attendance creation.',2,'TL-577','UPD->LDAGULTO->2022-03-11 02:50:47'),(10,'Attendace Adjustment','Settings for attendance adjustment.',2,'TL-578','INS->LDAGULTO->2022-03-11 02:48:58'),(11,'Leave Attachment','Settings for leave attachment.',2,'TL-739','INS->LDAGULTO->2022-03-25 03:30:03'),(12,'Import Employee','Setting for import on import employee page.',2,'TL-1114','UPD->LDAGULTO->2022-04-18 09:56:21'),(13,'Import Attendance Record','Setting for import on import attendance record page.',2,'TL-1120','UPD->LDAGULTO->2022-04-19 04:30:47');
/*!40000 ALTER TABLE `tbluploadsetting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbluseraccount`
--

DROP TABLE IF EXISTS `tbluseraccount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbluseraccount` (
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `ACTIVE` int(1) DEFAULT NULL,
  `PASSWORD_EXPIRY_DATE` date NOT NULL,
  `FAILED_LOGIN` int(1) DEFAULT NULL,
  `LAST_FAILED_LOGIN` date DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`USERNAME`),
  KEY `user_account_index` (`USERNAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbluseraccount`
--

LOCK TABLES `tbluseraccount` WRITE;
/*!40000 ALTER TABLE `tbluseraccount` DISABLE KEYS */;
INSERT INTO `tbluseraccount` VALUES ('ADMIN','68aff5412f35ed76',1,'2022-06-01',0,NULL,NULL,NULL),('GTBONITA','68aff5412f35ed76',1,'2022-08-09',0,NULL,'TL-479','ULCK->LDAGULTO->2022-03-15 01:32:03'),('KSVILLAR','68aff5412f35ed76',1,'2022-08-09',0,NULL,'TL-480','ACT->LDAGULTO->2022-03-15 01:29:05'),('LDAGULTO','68aff5412f35ed76',1,'2022-08-09',0,NULL,'TL-484','ACT->ADMIN->2022-02-11 01:12:36'),('LVMICAYAS','68aff5412f35ed76',1,'2022-08-09',0,NULL,'TL-476','ULCK->LDAGULTO->2022-02-10 11:41:07');
/*!40000 ALTER TABLE `tbluseraccount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbluserinterfacesettings`
--

DROP TABLE IF EXISTS `tbluserinterfacesettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbluserinterfacesettings` (
  `SETTINGS_ID` int(11) NOT NULL,
  `LOGIN_BG` varchar(500) DEFAULT NULL,
  `LOGO_LIGHT` varchar(500) DEFAULT NULL,
  `LOGO_DARK` varchar(500) DEFAULT NULL,
  `LOGO_ICON_LIGHT` varchar(500) DEFAULT NULL,
  `LOGO_ICON_DARK` varchar(500) DEFAULT NULL,
  `FAVICON` varchar(500) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`SETTINGS_ID`),
  KEY `user_interface_setting_index` (`SETTINGS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbluserinterfacesettings`
--

LOCK TABLES `tbluserinterfacesettings` WRITE;
/*!40000 ALTER TABLE `tbluserinterfacesettings` DISABLE KEYS */;
INSERT INTO `tbluserinterfacesettings` VALUES (1,'./assets/images/application-settings/login-bg.jpg','./assets/images/application-settings/logo-light.png','./assets/images/application-settings/logo-dark.png','./assets/images/application-settings/logo-icon-light.png','./assets/images/application-settings/logo-icon-dark.png','./assets/images/application-settings/favicon.png','TL-83','UPD->ADMIN->2022-01-06 03:31:52');
/*!40000 ALTER TABLE `tbluserinterfacesettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblworkshift`
--

DROP TABLE IF EXISTS `tblworkshift`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblworkshift` (
  `WORK_SHIFT_ID` varchar(100) NOT NULL,
  `WORK_SHIFT` varchar(100) NOT NULL,
  `WORK_SHIFT_TYPE` varchar(20) NOT NULL,
  `DESCRIPTION` varchar(200) NOT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`WORK_SHIFT_ID`),
  KEY `work_shift_index` (`WORK_SHIFT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblworkshift`
--

LOCK TABLES `tblworkshift` WRITE;
/*!40000 ALTER TABLE `tblworkshift` DISABLE KEYS */;
INSERT INTO `tblworkshift` VALUES ('6','Regular','REGULAR','Test','TL-1106','INS->LDAGULTO->2022-04-15 09:43:32'),('7','Scheduled','SCHEDULED','Test','TL-1107','INS->LDAGULTO->2022-04-15 09:57:53');
/*!40000 ALTER TABLE `tblworkshift` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblworkshiftschedule`
--

DROP TABLE IF EXISTS `tblworkshiftschedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblworkshiftschedule` (
  `WORK_SHIFT_ID` varchar(100) NOT NULL,
  `START_DATE` date DEFAULT NULL,
  `END_DATE` date DEFAULT NULL,
  `MONDAY_START_TIME` time DEFAULT NULL,
  `MONDAY_END_TIME` time DEFAULT NULL,
  `MONDAY_LUNCH_START_TIME` time DEFAULT NULL,
  `MONDAY_LUNCH_END_TIME` time DEFAULT NULL,
  `MONDAY_HALF_DAY_MARK` time DEFAULT NULL,
  `TUESDAY_START_TIME` time DEFAULT NULL,
  `TUESDAY_END_TIME` time DEFAULT NULL,
  `TUESDAY_LUNCH_START_TIME` time DEFAULT NULL,
  `TUESDAY_LUNCH_END_TIME` time DEFAULT NULL,
  `TUESDAY_HALF_DAY_MARK` time DEFAULT NULL,
  `WEDNESDAY_START_TIME` time DEFAULT NULL,
  `WEDNESDAY_END_TIME` time DEFAULT NULL,
  `WEDNESDAY_LUNCH_START_TIME` time DEFAULT NULL,
  `WEDNESDAY_LUNCH_END_TIME` time DEFAULT NULL,
  `WEDNESDAY_HALF_DAY_MARK` time DEFAULT NULL,
  `THURSDAY_START_TIME` time DEFAULT NULL,
  `THURSDAY_END_TIME` time DEFAULT NULL,
  `THURSDAY_LUNCH_START_TIME` time DEFAULT NULL,
  `THURSDAY_LUNCH_END_TIME` time DEFAULT NULL,
  `THURSDAY_HALF_DAY_MARK` time DEFAULT NULL,
  `FRIDAY_START_TIME` time DEFAULT NULL,
  `FRIDAY_END_TIME` time DEFAULT NULL,
  `FRIDAY_LUNCH_START_TIME` time DEFAULT NULL,
  `FRIDAY_LUNCH_END_TIME` time DEFAULT NULL,
  `FRIDAY_HALF_DAY_MARK` time DEFAULT NULL,
  `SATURDAY_START_TIME` time DEFAULT NULL,
  `SATURDAY_END_TIME` time DEFAULT NULL,
  `SATURDAY_LUNCH_START_TIME` time DEFAULT NULL,
  `SATURDAY_LUNCH_END_TIME` time DEFAULT NULL,
  `SATURDAY_HALF_DAY_MARK` time DEFAULT NULL,
  `SUNDAY_START_TIME` time DEFAULT NULL,
  `SUNDAY_END_TIME` time DEFAULT NULL,
  `SUNDAY_LUNCH_START_TIME` time DEFAULT NULL,
  `SUNDAY_LUNCH_END_TIME` time DEFAULT NULL,
  `SUNDAY_HALF_DAY_MARK` time DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`WORK_SHIFT_ID`),
  KEY `work_shift_schedule_index` (`WORK_SHIFT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblworkshiftschedule`
--

LOCK TABLES `tblworkshiftschedule` WRITE;
/*!40000 ALTER TABLE `tblworkshiftschedule` DISABLE KEYS */;
INSERT INTO `tblworkshiftschedule` VALUES ('6',NULL,NULL,'08:30:00','17:30:00','12:00:00','13:00:00','12:30:00','08:30:00','17:30:00','12:00:00','13:00:00','12:30:00','08:30:00','17:30:00','12:00:00','13:00:00','12:30:00','08:30:00','17:30:00','12:00:00','13:00:00','12:30:00','08:30:00','17:30:00','12:00:00','13:00:00','12:30:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'INS->LDAGULTO->2022-04-15 09:47:50'),('7','2022-04-01','2022-04-15','08:30:00','17:30:00','12:00:00','13:00:00','12:30:00','08:30:00','17:30:00','12:00:00','13:00:00','12:30:00','08:30:00','17:30:00','12:00:00','13:00:00','12:30:00','08:30:00','17:30:00','12:00:00','13:00:00','12:30:00','08:30:00','17:30:00','12:00:00','13:00:00','12:30:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'INS->LDAGULTO->2022-04-15 09:59:29');
/*!40000 ALTER TABLE `tblworkshiftschedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_attendance_record`
--

DROP TABLE IF EXISTS `temp_attendance_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_attendance_record` (
  `EMPLOYEE_ID` varchar(100) DEFAULT NULL,
  `TIME_IN_DATE` date NOT NULL,
  `TIME_IN` time NOT NULL,
  `TIME_OUT_DATE` date DEFAULT NULL,
  `TIME_OUT` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_attendance_record`
--

LOCK TABLES `temp_attendance_record` WRITE;
/*!40000 ALTER TABLE `temp_attendance_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_attendance_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_employee`
--

DROP TABLE IF EXISTS `temp_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_employee` (
  `EMPLOYEE_ID` varchar(100) DEFAULT NULL,
  `ID_NUMBER` varchar(100) NOT NULL,
  `FILE_AS` varchar(500) NOT NULL,
  `FIRST_NAME` varchar(100) NOT NULL,
  `MIDDLE_NAME` varchar(100) NOT NULL,
  `LAST_NAME` varchar(100) NOT NULL,
  `SUFFIX` varchar(20) DEFAULT NULL,
  `BIRTHDAY` date NOT NULL,
  `EMPLOYMENT_STATUS` varchar(50) NOT NULL,
  `JOIN_DATE` date DEFAULT NULL,
  `EXIT_DATE` date DEFAULT NULL,
  `PERMANENCY_DATE` date DEFAULT NULL,
  `EXIT_REASON` varchar(500) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `PHONE` varchar(30) DEFAULT NULL,
  `TELEPHONE` varchar(30) DEFAULT NULL,
  `DEPARTMENT` varchar(50) DEFAULT NULL,
  `DESIGNATION` varchar(50) DEFAULT NULL,
  `BRANCH` varchar(50) DEFAULT NULL,
  `GENDER` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_employee`
--

LOCK TABLES `temp_employee` WRITE;
/*!40000 ALTER TABLE `temp_employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'worknestdb'
--
/*!50003 DROP PROCEDURE IF EXISTS `check_allowance_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_allowance_exist`(IN `allowance_id` VARCHAR(100))
BEGIN
	SET @allowance_id = allowance_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblallowance WHERE ALLOWANCE_ID = @allowance_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_allowance_type_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_allowance_type_exist`(IN `allowance_type_id` VARCHAR(100))
BEGIN
	SET @allowance_type_id = allowance_type_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblallowancetype WHERE ALLOWANCE_TYPE_ID = @allowance_type_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_attendance_adjustment_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_attendance_adjustment_exist`(IN `request_id` VARCHAR(100))
BEGIN
	SET @request_id = request_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblattendanceadjustment WHERE REQUEST_ID = @request_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_attendance_adjustment_recommendation_exception_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_attendance_adjustment_recommendation_exception_exist`(IN `employee_id` VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblattendanceadjustmentexception WHERE EMPLOYEE_ID = @employee_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_attendance_creation_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_attendance_creation_exist`(IN `request_id` VARCHAR(100))
BEGIN
	SET @request_id = request_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblattendancecreation WHERE REQUEST_ID = @request_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_attendance_creation_recommendation_exception_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_attendance_creation_recommendation_exception_exist`(IN `employee_id` VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblattendancecreationexception WHERE EMPLOYEE_ID = @employee_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_attendance_setting_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_attendance_setting_exist`(IN `setting_id` INT)
BEGIN
	SET @setting_id = setting_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblattendancesetting WHERE SETTING_ID = @setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_branch_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_branch_exist`(IN `branch_id` VARCHAR(50))
BEGIN
	SET @branch_id = branch_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblbranch WHERE BRANCH_ID = @branch_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_company_setting_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_company_setting_exist`(IN `company_id` VARCHAR(50))
BEGIN
	SET @company_id = company_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblcompany WHERE COMPANY_ID = @company_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_contribution_bracket_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_contribution_bracket_exist`(IN `contribution_bracket_id` VARCHAR(100))
BEGIN
	SET @contribution_bracket_id = contribution_bracket_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblcontributionbracket WHERE CONTRIBUTION_BRACKET_ID = @contribution_bracket_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_contribution_bracket_overlap` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_contribution_bracket_overlap`(IN `contribution_bracket_id` VARCHAR(100), IN `government_contribution_id` VARCHAR(100))
BEGIN
	SET @contribution_bracket_id = contribution_bracket_id;
	SET @government_contribution_id = government_contribution_id;

	IF @contribution_bracket_id IS NULL OR @contribution_bracket_id = '' THEN
		SET @query = 'SELECT START_RANGE, END_RANGE FROM tblcontributionbracket WHERE GOVERNMENT_CONTRIBUTION_ID = @government_contribution_id';
	ELSE
		SET @query = 'SELECT START_RANGE, END_RANGE FROM tblcontributionbracket WHERE CONTRIBUTION_BRACKET_ID != @contribution_bracket_id AND GOVERNMENT_CONTRIBUTION_ID = @government_contribution_id';
    END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_contribution_deduction_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_contribution_deduction_exist`(IN `contribution_deduction_id` VARCHAR(100))
BEGIN
	SET @contribution_deduction_id = contribution_deduction_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblcontributiondeduction WHERE CONTRIBUTION_DEDUCTION_ID = @contribution_deduction_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_deduction_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_deduction_exist`(IN `deduction_id` VARCHAR(100))
BEGIN
	SET @deduction_id = deduction_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tbldeduction WHERE DEDUCTION_ID = @deduction_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_deduction_type_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_deduction_type_exist`(IN `deduction_type_id` VARCHAR(100))
BEGIN
	SET @deduction_type_id = deduction_type_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tbldeductiontype WHERE DEDUCTION_TYPE_ID = @deduction_type_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_department_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_department_exist`(IN `department_id` VARCHAR(50))
BEGIN
	SET @department_id = department_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tbldepartment WHERE DEPARTMENT_ID = @department_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_designation_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_designation_exist`(IN `designation_id` VARCHAR(50))
BEGIN
	SET @designation_id = designation_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tbldesignation WHERE DESIGNATION_ID = @designation_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_emergency_contact_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_emergency_contact_exist`(IN `contact_id` VARCHAR(100))
BEGIN
	SET @contact_id = contact_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblemergencycontact WHERE CONTACT_ID = @contact_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_employee_address_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_employee_address_exist`(IN `address_id` VARCHAR(100))
BEGIN
	SET @address_id = address_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblemployeeaddress WHERE ADDRESS_ID = @address_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_employee_attendance_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_employee_attendance_exist`(IN `attendance_id` VARCHAR(100))
BEGIN
	SET @attendance_id = attendance_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblattendancerecord WHERE ATTENDANCE_ID = @attendance_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_employee_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_employee_exist`(IN `employee_id` VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblemployee WHERE EMPLOYEE_ID = @employee_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_employee_file_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_employee_file_exist`(IN `file_id` VARCHAR(50))
BEGIN
	SET @file_id = file_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblemployeefile WHERE FILE_ID = @file_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_employee_id_number_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_employee_id_number_exist`(IN `id_number` VARCHAR(100))
BEGIN
	SET @id_number = id_number;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblemployee WHERE ID_NUMBER = @id_number';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_employee_social_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_employee_social_exist`(IN `social_id` VARCHAR(100))
BEGIN
	SET @social_id = social_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblemployeesocial WHERE SOCIAL_ID = @social_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_employment_status_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_employment_status_exist`(IN `employment_status_id` VARCHAR(50))
BEGIN
	SET @employment_status_id = employment_status_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblemploymentstatus WHERE EMPLOYMENT_STATUS_ID = @employment_status_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_government_contribution_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_government_contribution_exist`(IN `government_contribution_id` VARCHAR(100))
BEGIN
	SET @government_contribution_id = government_contribution_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblgovernmentcontribution WHERE GOVERNMENT_CONTRIBUTION_ID = @government_contribution_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_holiday_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_holiday_exist`(IN `holiday_id` VARCHAR(50))
BEGIN
	SET @holiday_id = holiday_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblholiday WHERE HOLIDAY_ID = @holiday_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_leave_entitlement_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_leave_entitlement_exist`(IN `leave_entitlement_id` VARCHAR(50))
BEGIN
	SET @leave_entitlement_id = leave_entitlement_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblleaveentitlement WHERE LEAVE_ENTITLEMENT_ID = @leave_entitlement_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_leave_entitlement_overlap` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_leave_entitlement_overlap`(IN `leave_entitlement_id` VARCHAR(50), IN `employee_id` VARCHAR(100), IN `leave_type` VARCHAR(50))
BEGIN
	SET @leave_entitlement_id = leave_entitlement_id;
	SET @employee_id = employee_id;
	SET @leave_type = leave_type;

	SET @query = 'SELECT START_DATE, END_DATE FROM tblleaveentitlement WHERE LEAVE_ENTITLEMENT_ID != @leave_entitlement_id AND EMPLOYEE_ID = @employee_id AND LEAVE_TYPE = @leave_type';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_leave_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_leave_exist`(IN `leave_id` VARCHAR(50))
BEGIN
	SET @leave_id = leave_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblleave WHERE LEAVE_ID = @leave_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_leave_overlap` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_leave_overlap`(IN `leave_id` VARCHAR(50), IN `employee_id` VARCHAR(100))
BEGIN
	SET @leave_id = leave_id;
	SET @employee_id = employee_id;

	SET @query = 'SELECT LEAVE_DATE, START_TIME, END_TIME FROM tblleave WHERE LEAVE_STATUS IN ("1", "4") AND EMPLOYEE_ID = @employee_id AND LEAVE_TYPE NOT IN ("LEAVETP-8", "LEAVETP-9") AND LEAVE_ID != @leave_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_leave_type_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_leave_type_exist`(IN `leave_type_id` VARCHAR(50))
BEGIN
	SET @leave_type_id = leave_type_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblleavetype WHERE LEAVE_TYPE_ID = @leave_type_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_mail_configuration_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_mail_configuration_exist`(IN `mail_id` INT)
BEGIN
	SET @mail_id = mail_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblmailconfig WHERE MAIL_ID = @mail_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_notification_details_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_notification_details_exist`(IN `notification_id` INT)
BEGIN
	SET @notification_id = notification_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblnotificationdetails WHERE NOTIFICATION_ID = @notification_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_notification_type_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_notification_type_exist`(IN `notification_id` INT)
BEGIN
	SET @notification_id = notification_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblnotificationtype WHERE NOTIFICATION_ID = @notification_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_permission_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_permission_exist`(IN `permission_id` INT)
BEGIN
	SET @permission_id = permission_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblpermission WHERE PERMISSION_ID = @permission_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_policy_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_policy_exist`(IN `policy_id` INT)
BEGIN
	SET @policy_id = policy_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblpolicy WHERE POLICY_ID = @policy_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_role_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_role_exist`(IN `role_id` VARCHAR(50))
BEGIN
	SET @role_id = role_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblrole WHERE ROLE_ID = @role_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_system_code_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_system_code_exist`(IN `system_type` VARCHAR(20), IN `system_code` VARCHAR(20))
BEGIN
	SET @system_type = system_type;
	SET @system_code = system_code;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblsystemcode WHERE SYSTEM_TYPE = @system_type AND SYSTEM_CODE = @system_code';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_system_notification_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_system_notification_exist`(IN `notification_id` INT, IN `notification_type` VARCHAR(5))
BEGIN
	SET @notification_id = notification_id;
	SET @notification_type = notification_type;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblsystemnotification WHERE NOTIFICATION_ID = @notification_id AND NOTIFICATION = @notification_type';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_system_parameter_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_system_parameter_exist`(IN `parameter_id` INT)
BEGIN
	SET @parameter_id = parameter_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblsystemparameters WHERE PARAMETER_ID = @parameter_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_upload_setting_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_upload_setting_exist`(IN `upload_setting_id` INT(50))
BEGIN
	SET @upload_setting_id = upload_setting_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tbluploadsetting WHERE UPLOAD_SETTING_ID = @upload_setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_user_account_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_user_account_exist`(IN `username` VARCHAR(50))
BEGIN
	SET @username = username;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tbluseraccount WHERE USERNAME = @username';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_user_interface_settings_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_user_interface_settings_exist`(IN `setting_id` INT)
BEGIN
	SET @setting_id = setting_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tbluserinterfacesettings WHERE SETTINGS_ID = @setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_work_shift_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_work_shift_exist`(IN `work_shift_id` VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblworkshift WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_work_shift_schedule_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_work_shift_schedule_exist`(IN `work_shift_id` VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblworkshiftschedule WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_allowance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_allowance`(IN `allowance_id` VARCHAR(100))
BEGIN
	SET @allowance_id = allowance_id;

	SET @query = 'DELETE FROM tblallowance WHERE ALLOWANCE_ID = @allowance_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_allowance_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_allowance_type`(IN `allowance_type_id` VARCHAR(100))
BEGIN
	SET @allowance_type_id = allowance_type_id;

	SET @query = 'DELETE FROM tblallowancetype WHERE ALLOWANCE_TYPE_ID = @allowance_type_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_all_application_notification` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_all_application_notification`()
BEGIN

	SET @query = 'DELETE FROM tblsystemnotification';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_all_contribution_bracket` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_all_contribution_bracket`(IN `government_contribution_id` VARCHAR(100))
BEGIN
	SET @government_contribution_id = government_contribution_id;

	SET @query = 'DELETE FROM tblcontributionbracket WHERE GOVERNMENT_CONTRIBUTION_ID = @government_contribution_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_all_holiday_branch` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_all_holiday_branch`(IN `holiday_id` VARCHAR(50))
BEGIN
	SET @holiday_id = holiday_id;

	SET @query = 'DELETE FROM tblholidaybranch WHERE HOLIDAY_ID = @holiday_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_all_permission` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_all_permission`(IN `policy` INT)
BEGIN
	SET @policy = policy;

	SET @query = 'DELETE FROM tblpermission WHERE POLICY = @policy';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_all_upload_file_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_all_upload_file_type`(IN `upload_setting_id` INT(50))
BEGIN
	SET @upload_setting_id = upload_setting_id;

	SET @query = 'DELETE FROM tbluploadfiletype WHERE UPLOAD_SETTING_ID = @upload_setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_all_user_role` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_all_user_role`(IN `user_code` VARCHAR(50))
BEGIN
	SET @user_code = user_code;

	SET @query = 'DELETE FROM tblroleuser WHERE USERNAME = @user_code';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_attendance_adjustment` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_attendance_adjustment`(IN `request_id` VARCHAR(100))
BEGIN
	SET @file_id = file_id;

	SET @query = 'DELETE FROM tblattendanceadjustment WHERE REQUEST_ID = @request_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_attendance_adjustment_approval` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_attendance_adjustment_approval`()
BEGIN
	SET @query = 'DELETE FROM tblattendanceadjustmentexception';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_attendance_creation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_attendance_creation`(IN `request_id` VARCHAR(100))
BEGIN
	SET @request_id = request_id;

	SET @query = 'DELETE FROM tblattendancecreation WHERE REQUEST_ID = @request_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_attendance_creation_approval` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_attendance_creation_approval`()
BEGIN
	SET @query = 'DELETE FROM tblattendancecreationexception';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_branch` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_branch`(IN `branch_id` VARCHAR(50))
BEGIN
	SET @branch_id = branch_id;

	SET @query = 'DELETE FROM tblbranch WHERE BRANCH_ID = @branch_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_contribution_bracket` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_contribution_bracket`(IN `contribution_bracket_id` VARCHAR(100))
BEGIN
	SET @contribution_bracket_id = contribution_bracket_id;

	SET @query = 'DELETE FROM tblcontributionbracket WHERE CONTRIBUTION_BRACKET_ID = @contribution_bracket_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_contribution_deduction` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_contribution_deduction`(IN `contribution_deduction_id` VARCHAR(100))
BEGIN
	SET @contribution_deduction_id = contribution_deduction_id;

	SET @query = 'DELETE FROM tblcontributiondeduction WHERE CONTRIBUTION_DEDUCTION_ID = @contribution_deduction_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_deduction` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_deduction`(IN `deduction_id` VARCHAR(100))
BEGIN
	SET @deduction_id = deduction_id;

	SET @query = 'DELETE FROM tbldeduction WHERE DEDUCTION_ID = @deduction_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_deduction_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_deduction_type`(IN `deduction_type_id` VARCHAR(100))
BEGIN
	SET @deduction_type_id = deduction_type_id;

	SET @query = 'DELETE FROM tbldeductiontype WHERE DEDUCTION_TYPE_ID = @deduction_type_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_department` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_department`(IN `department_id` VARCHAR(50))
BEGIN
	SET @department_id = department_id;

	SET @query = 'DELETE FROM tbldepartment WHERE DEPARTMENT_ID = @department_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_designation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_designation`(IN `designation_id` VARCHAR(100))
BEGIN
	SET @designation_id = designation_id;

	SET @query = 'DELETE FROM tbldesignation WHERE DESIGNATION_ID = @designation_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_emergency_contact` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_emergency_contact`(IN `contact_id` VARCHAR(100))
BEGIN
	SET @contact_id = contact_id;

	SET @query = 'DELETE FROM tblemergencycontact WHERE CONTACT_ID = @contact_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_employee` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_employee`(IN `employee_id` VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;

	SET @query = 'DELETE FROM tblemployee WHERE EMPLOYEE_ID = @employee_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_employee_address` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_employee_address`(IN `address_id` VARCHAR(100))
BEGIN
	SET @address_id = address_id;

	SET @query = 'DELETE FROM tblemployeeaddress WHERE ADDRESS_ID = @address_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_employee_attendance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_employee_attendance`(IN `attendance_id` VARCHAR(100))
BEGIN
	SET @attendance_id = attendance_id;

	SET @query = 'DELETE FROM tblattendancerecord WHERE ATTENDANCE_ID = @attendance_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_employee_file` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_employee_file`(IN `file_id` VARCHAR(50))
BEGIN
	SET @file_id = file_id;

	SET @query = 'DELETE FROM tblemployeefile WHERE FILE_ID = @file_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_employee_social` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_employee_social`(IN `social_id` VARCHAR(100))
BEGIN
	SET @social_id = social_id;

	SET @query = 'DELETE FROM tblemployeesocial WHERE SOCIAL_ID = @social_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_employee_work_shift` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_employee_work_shift`(IN `work_shift_id` VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'DELETE FROM tblemployeeworkshift WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_employee_work_shift_assignment` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_employee_work_shift_assignment`(IN `employee_id` VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;

	SET @query = 'DELETE FROM tblemployeeworkshift WHERE EMPLOYEE_ID = @employee_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_employment_status` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_employment_status`(IN `employment_status_id` VARCHAR(50))
BEGIN
	SET @employment_status_id = employment_status_id;

	SET @query = 'DELETE FROM tblemploymentstatus WHERE EMPLOYMENT_STATUS_ID = @employment_status_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_government_contribution` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_government_contribution`(IN `government_contribution_id` VARCHAR(100))
BEGIN
	SET @government_contribution_id = government_contribution_id;

	SET @query = 'DELETE FROM tblgovernmentcontribution WHERE GOVERNMENT_CONTRIBUTION_ID = @government_contribution_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_holiday` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_holiday`(IN `holiday_id` VARCHAR(50))
BEGIN
	SET @holiday_id = holiday_id;

	SET @query = 'DELETE FROM tblholiday WHERE HOLIDAY_ID = @holiday_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_leave` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_leave`(IN `leave_id` VARCHAR(50))
BEGIN
	SET @leave_id = leave_id;

	SET @query = 'DELETE FROM tblleave WHERE LEAVE_ID = @leave_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_leave_entitlement` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_leave_entitlement`(IN `leave_entitlement_id` VARCHAR(50))
BEGIN
	SET @leave_entitlement_id = leave_entitlement_id;

	SET @query = 'DELETE FROM tblleaveentitlement WHERE LEAVE_ENTITLEMENT_ID = @leave_entitlement_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_leave_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_leave_type`(IN `leave_type_id` VARCHAR(50))
BEGIN
	SET @leave_type_id = leave_type_id;

	SET @query = 'DELETE FROM tblleavetype WHERE LEAVE_TYPE_ID = @leave_type_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_notification_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_notification_details`(IN `notification_id` INT)
BEGIN
	SET @notification_id = notification_id;

	SET @query = 'DELETE FROM tblnotificationdetails WHERE NOTIFICATION_ID = @notification_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_notification_recipient` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_notification_recipient`(IN `notification_id` INT(50))
BEGIN
	SET @notification_id = notification_id;

	SET @query = 'DELETE FROM tblnotificationrecipient WHERE NOTIFICATION_ID = @notification_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_notification_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_notification_type`(IN `notification_id` INT)
BEGIN
	SET @notification_id = notification_id;

	SET @query = 'DELETE FROM tblnotificationtype WHERE NOTIFICATION_ID = @notification_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_permission` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_permission`(IN `permission_id` INT)
BEGIN
	SET @permission_id = permission_id;

	SET @query = 'DELETE FROM tblpermission WHERE PERMISSION_ID = @permission_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_permission_role` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_permission_role`(IN `role_id` VARCHAR(100))
BEGIN
	SET @role_id = role_id;

	SET @query = 'DELETE FROM tblrolepermission WHERE ROLE_ID = @role_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_policy` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_policy`(IN `policy_id` INT)
BEGIN
	SET @policy_id = policy_id;

	SET @query = 'DELETE FROM tblpolicy WHERE POLICY_ID = @policy_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_role` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_role`(IN `role_id` VARCHAR(100))
BEGIN
	SET @role_id = role_id;

	SET @query = 'DELETE FROM tblrole WHERE ROLE_ID = @role_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_system_code` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_system_code`(IN `system_type` VARCHAR(100), IN `system_code` VARCHAR(100))
BEGIN
	SET @system_type = system_type;
	SET @system_code = system_code;

	SET @query = 'DELETE FROM tblsystemcode WHERE SYSTEM_TYPE = @system_type AND SYSTEM_CODE = @system_code';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_system_parameter` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_system_parameter`(IN `parameter_id` INT)
BEGIN
	SET @parameter_id = parameter_id;

	SET @query = 'DELETE FROM tblsystemparameters WHERE PARAMETER_ID = @parameter_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_upload_setting` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_upload_setting`(IN `upload_setting_id` INT(50))
BEGIN
	SET @upload_setting_id = upload_setting_id;

	SET @query = 'DELETE FROM tbluploadsetting WHERE UPLOAD_SETTING_ID = @upload_setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_work_shift` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_work_shift`(IN `work_shift_id` VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'DELETE FROM tblworkshift WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_work_shift_schedule` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_work_shift_schedule`(IN `work_shift_id` VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'DELETE FROM tblworkshiftschedule WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_active_employee_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_active_employee_options`()
BEGIN
	SET @query = 'SELECT EMPLOYEE_ID, FILE_AS FROM tblemployee WHERE EMPLOYMENT_STATUS IN ("1", "2", "5") ORDER BY FILE_AS';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_allowance_type_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_allowance_type_options`()
BEGIN
	SET @query = 'SELECT ALLOWANCE_TYPE_ID, ALLOWANCE_TYPE FROM tblallowancetype ORDER BY ALLOWANCE_TYPE';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_branch_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_branch_options`()
BEGIN
	SET @query = 'SELECT BRANCH_ID, BRANCH FROM tblbranch ORDER BY BRANCH';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_city` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_city`(IN `province_id` INT)
BEGIN
	SET @province_id = province_id;

	SET @query = 'SELECT CITY_ID, CITY FROM tblcity WHERE PROVINCE_ID = @province_id ORDER BY CITY';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_contribution_deduction_type_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_contribution_deduction_type_options`()
BEGIN
	SET @query = 'SELECT GOVERNMENT_CONTRIBUTION_ID, GOVERNMENT_CONTRIBUTION FROM tblgovernmentcontribution ORDER BY GOVERNMENT_CONTRIBUTION';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_deduction_type_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_deduction_type_options`()
BEGIN
	SET @query = 'SELECT DEDUCTION_TYPE_ID, DEDUCTION_TYPE FROM tbldeductiontype ORDER BY DEDUCTION_TYPE';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_department_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_department_options`()
BEGIN
	SET @query = 'SELECT DEPARTMENT_ID, DEPARTMENT FROM tbldepartment ORDER BY DEPARTMENT';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_designation_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_designation_options`()
BEGIN
	SET @query = 'SELECT DESIGNATION_ID, DESIGNATION FROM tbldesignation ORDER BY DESIGNATION';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_employee_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_employee_options`()
BEGIN
	SET @query = 'SELECT EMPLOYEE_ID, FILE_AS FROM tblemployee ORDER BY FILE_AS';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_employee_without_user_account_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_employee_without_user_account_options`()
BEGIN
	SET @query = 'SELECT EMPLOYEE_ID, FILE_AS FROM tblemployee WHERE EMPLOYMENT_STATUS IN ("1", "2", "5") AND USERNAME IS NULL ORDER BY FILE_AS';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_employee_without_workshift_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_employee_without_workshift_options`()
BEGIN
	SET @query = 'SELECT EMPLOYEE_ID, FILE_AS FROM tblemployee WHERE EMPLOYEE_ID NOT IN (SELECT EMPLOYEE_ID FROM tblemployeeworkshift) ORDER BY FILE_AS';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_employment_status_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_employment_status_options`()
BEGIN
	SET @query = 'SELECT EMPLOYMENT_STATUS_ID, EMPLOYMENT_STATUS FROM tblemploymentstatus ORDER BY EMPLOYMENT_STATUS';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_government_contribution_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_government_contribution_options`()
BEGIN
	SET @query = 'SELECT GOVERNMENT_CONTRIBUTION_ID, GOVERNMENT_CONTRIBUTION FROM tblgovernmentcontribution ORDER BY GOVERNMENT_CONTRIBUTION';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_leave_type_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_leave_type_options`()
BEGIN
	SET @query = 'SELECT LEAVE_TYPE_ID, LEAVE_NAME FROM tblleavetype ORDER BY LEAVE_NAME';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_province` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_province`()
BEGIN
	SET @query = 'SELECT PROVINCE_ID, PROVINCE FROM tblprovince ORDER BY PROVINCE';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_province_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_province_options`()
BEGIN
	SET @query = 'SELECT PROVINCE_ID, PROVINCE FROM tblprovince ORDER BY PROVINCE';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_role_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_role_options`()
BEGIN
	SET @query = 'SELECT ROLE_ID, ROLE FROM tblrole ORDER BY ROLE';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_system_code_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_system_code_options`(IN `system_type` VARCHAR(100))
BEGIN
	SET @system_type = system_type;

	SET @query = 'SELECT SYSTEM_CODE, DESCRIPTION FROM tblsystemcode WHERE SYSTEM_TYPE = @system_type ORDER BY DESCRIPTION';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_allowance_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_allowance_details`(IN `allowance_id` VARCHAR(100))
BEGIN
	SET @allowance_id = allowance_id;

	SET @query = 'SELECT EMPLOYEE_ID, ALLOWANCE_TYPE, PAYROLL_ID, PAYROLL_DATE, AMOUNT, TRANSACTION_LOG_ID, RECORD_LOG FROM tblallowance WHERE ALLOWANCE_ID = @allowance_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_allowance_type_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_allowance_type_details`(IN `allowance_type_id` VARCHAR(100))
BEGIN
	SET @allowance_type_id = allowance_type_id;

	SET @query = 'SELECT ALLOWANCE_TYPE, TAXABLE, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblallowancetype WHERE ALLOWANCE_TYPE_ID = @allowance_type_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_application_notification_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_application_notification_details`()
BEGIN

	SET @query = 'SELECT NOTIFICATION_ID, NOTIFICATION, RECORD_LOG FROM tblsystemnotification';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_attendance_adjustments_sanction_count` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_attendance_adjustments_sanction_count`(IN sanction INT(1), IN employee_id VARCHAR(100), IN start_date DATE, IN end_date DATE)
BEGIN
	SET @sanction = sanction;
	SET @employee_id = employee_id;
	SET @start_date = start_date;
	SET @end_date = end_date;

	IF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendanceadjustment WHERE EMPLOYEE_ID = @employee_id AND REQUEST_DATE BETWEEN @start_date AND @end_date AND SANCTION = @sanction';
	ELSEIF (@employee_id IS NULL OR @employee_id = '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendanceadjustment WHERE REQUEST_DATE BETWEEN @start_date AND @end_date AND SANCTION = @sanction';
	ELSEIF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NULL OR @start_date = '') AND (@end_date IS NULL OR @end_date = '') THEN
		SET @query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendanceadjustment WHERE EMPLOYEE_ID = @employee_id AND SANCTION = @sanction';
	ELSE
		SET @query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendanceadjustment WHERE SANCTION = @sanction';
	END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_attendance_adjustment_count` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_attendance_adjustment_count`(IN `status` VARCHAR(10), IN `employee_id` VARCHAR(100), IN `start_date` DATE, IN `end_date` DATE)
BEGIN
	SET @status = status;
	SET @employee_id = employee_id;
	SET @start_date = start_date;
	SET @end_date = end_date;

	IF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendanceadjustment WHERE EMPLOYEE_ID = @employee_id AND REQUEST_DATE BETWEEN @start_date AND @end_date AND STATUS = @status';
	ELSEIF (@employee_id IS NULL OR @employee_id = '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendanceadjustment WHERE REQUEST_DATE BETWEEN @start_date AND @end_date AND STATUS = @status';
	ELSEIF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NULL OR @start_date = '') AND (@end_date IS NULL OR @end_date = '') THEN
		SET @query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendanceadjustment WHERE EMPLOYEE_ID = @employee_id AND STATUS = @status';
	ELSE
		SET @query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendanceadjustment WHERE STATUS = @status';
	END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_attendance_adjustment_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_attendance_adjustment_details`(IN `request_id` VARCHAR(100))
BEGIN
	SET @request_id = request_id;

	SET @query = 'SELECT EMPLOYEE_ID, ATTENDANCE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_DATE_ADJUSTED, TIME_IN_ADJUSTED, TIME_OUT_DATE, TIME_OUT, TIME_OUT_DATE_ADJUSTED, TIME_OUT_ADJUSTED, STATUS, REASON, FILE_PATH, SANCTION, REQUEST_DATE, REQUEST_TIME, FOR_RECOMMENDATION_DATE, FOR_RECOMMENDATION_TIME, RECOMMENDATION_DATE, RECOMMENDATION_TIME, RECOMMENDED_BY, DECISION_REMARKS, DECISION_DATE, DECISION_TIME, DECISION_BY, TRANSACTION_LOG_ID, RECORD_LOG FROM tblattendanceadjustment WHERE REQUEST_ID = @request_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_attendance_adjustment_exception_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_attendance_adjustment_exception_details`()
BEGIN
	SET @query = 'SELECT EMPLOYEE_ID, RECORD_LOG FROM tblattendanceadjustmentexception';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_attendance_creation_count` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_attendance_creation_count`(IN `status` VARCHAR(10), IN `employee_id` VARCHAR(100), IN `start_date` DATE, IN `end_date` DATE)
BEGIN
	SET @status = status;
	SET @employee_id = employee_id;
	SET @start_date = start_date;
	SET @end_date = end_date;

	IF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendancecreation WHERE EMPLOYEE_ID = @employee_id AND REQUEST_DATE BETWEEN @start_date AND @end_date AND STATUS = @status';
	ELSEIF (@employee_id IS NULL OR @employee_id = '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendancecreation WHERE REQUEST_DATE BETWEEN @start_date AND @end_date AND STATUS = @status';
	ELSEIF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NULL OR @start_date = '') AND (@end_date IS NULL OR @end_date = '') THEN
		SET @query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendancecreation WHERE EMPLOYEE_ID = @employee_id AND STATUS = @status';
	ELSE
		SET @query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendancecreation WHERE STATUS = @status';
	END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_attendance_creation_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_attendance_creation_details`(IN `request_id` VARCHAR(100))
BEGIN
	SET @request_id = request_id;

	SET @query = 'SELECT EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_OUT_DATE, TIME_OUT, STATUS, REASON, FILE_PATH, SANCTION, REQUEST_DATE, REQUEST_TIME, FOR_RECOMMENDATION_DATE, FOR_RECOMMENDATION_TIME, RECOMMENDATION_DATE, RECOMMENDATION_TIME, RECOMMENDED_BY, DECISION_REMARKS, DECISION_DATE, DECISION_TIME, DECISION_BY, TRANSACTION_LOG_ID, RECORD_LOG FROM tblattendancecreation WHERE REQUEST_ID = @request_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_attendance_creation_exception_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_attendance_creation_exception_details`()
BEGIN
	SET @query = 'SELECT EMPLOYEE_ID, RECORD_LOG FROM tblattendancecreationexception';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_attendance_creation_sanction_count` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_attendance_creation_sanction_count`(IN sanction INT(1), IN employee_id VARCHAR(100), IN start_date DATE, IN end_date DATE)
BEGIN
	SET @sanction = sanction;
	SET @employee_id = employee_id;
	SET @start_date = start_date;
	SET @end_date = end_date;

	IF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendancecreation WHERE EMPLOYEE_ID = @employee_id AND REQUEST_DATE BETWEEN @start_date AND @end_date AND SANCTION = @sanction';
	ELSEIF (@employee_id IS NULL OR @employee_id = '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendancecreation WHERE REQUEST_DATE BETWEEN @start_date AND @end_date AND SANCTION = @sanction';
	ELSEIF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NULL OR @start_date = '') AND (@end_date IS NULL OR @end_date = '') THEN
		SET @query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendancecreation WHERE EMPLOYEE_ID = @employee_id AND SANCTION = @sanction';
	ELSE
		SET @query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendancecreation WHERE SANCTION = @sanction';
	END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_attendance_setting_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_attendance_setting_details`(IN `setting_id` INT)
BEGIN
	SET @setting_id = setting_id;

	SET @query = 'SELECT MAX_ATTENDANCE, TIME_OUT_ALLOWANCE, LATE_ALLOWANCE, LATE_POLICY, EARLY_LEAVING_POLICY, ATTENDANCE_CREATION_RECOMMENDATION, ATTENDANCE_ADJUSTMENT_RECOMMENDATION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblattendancesetting WHERE SETTING_ID = @setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_attendance_summary_attendance_adjustments_sanction_count` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_attendance_summary_attendance_adjustments_sanction_count`(IN sanction INT(1), IN start_date DATE, IN end_date DATE, IN branch VARCHAR(50), IN department VARCHAR(50))
BEGIN
	SET @sanction = sanction;
	SET @branch = branch;
	SET @department = department;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @sub_query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendanceadjustment WHERE SANCTION = @sanction';

	IF (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @date_query = ' AND REQUEST_DATE BETWEEN @start_date AND @end_date';
	ELSE
		SET @date_query = '';
	END IF;

	IF (@branch IS NOT NULL OR @branch != '') THEN
		SET @branch_query = ' AND EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = @branch)';
	ELSE
		SET @branch_query = '';
	END IF;

	IF (@department IS NOT NULL OR @department != '') THEN
		SET @department_query = ' AND EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = @department)';
	ELSE
		SET @department_query = '';
	END IF;

	SET @query = CONCAT(@sub_query, @date_query, @branch_query, @department_query);

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_attendance_summary_attendance_creation_sanction_count` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_attendance_summary_attendance_creation_sanction_count`(IN sanction INT(1), IN start_date DATE, IN end_date DATE, IN branch VARCHAR(50), IN department VARCHAR(50))
BEGIN
	SET @sanction = sanction;
	SET @branch = branch;
	SET @department = department;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @sub_query = 'SELECT COUNT(REQUEST_ID) AS TOTAL FROM tblattendancecreation WHERE SANCTION = @sanction';

	IF (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @date_query = ' AND REQUEST_DATE BETWEEN @start_date AND @end_date';
	ELSE
		SET @date_query = '';
	END IF;

	IF (@branch IS NOT NULL OR @branch != '') THEN
		SET @branch_query = ' AND EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = @branch)';
	ELSE
		SET @branch_query = '';
	END IF;

	IF (@department IS NOT NULL OR @department != '') THEN
		SET @department_query = ' AND EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = @department)';
	ELSE
		SET @department_query = '';
	END IF;

	SET @query = CONCAT(@sub_query, @date_query, @branch_query, @department_query);

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_attendance_summary_time_in_count` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_attendance_summary_time_in_count`(IN `time_in_behavior` VARCHAR(10), IN `start_date` DATE, IN `end_date` DATE, IN `branch` VARCHAR(50), IN `department` VARCHAR(50))
BEGIN
	SET @time_in_behavior = time_in_behavior;
	SET @branch = branch;
	SET @department = department;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @sub_query = 'SELECT COUNT(ATTENDANCE_ID) AS TOTAL FROM tblattendancerecord WHERE TIME_IN_BEHAVIOR = @time_in_behavior';

	IF (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @date_query = ' AND TIME_IN_DATE BETWEEN @start_date AND @end_date';
	ELSE
		SET @date_query = '';
	END IF;

	IF (@branch IS NOT NULL OR @branch != '') THEN
		SET @branch_query = ' AND EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = @branch)';
	ELSE
		SET @branch_query = '';
	END IF;

	IF (@department IS NOT NULL OR @department != '') THEN
		SET @department_query = ' AND EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = @department)';
	ELSE
		SET @department_query = '';
	END IF;

	SET @query = CONCAT(@sub_query, @date_query, @branch_query, @department_query);

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_attendance_summary_time_out_count` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_attendance_summary_time_out_count`(IN `time_out_behavior` VARCHAR(10), IN `start_date` DATE, IN `end_date` DATE, IN `branch` VARCHAR(50), IN `department` VARCHAR(50))
BEGIN
	SET @time_out_behavior = time_out_behavior;
	SET @branch = branch;
	SET @department = department;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @sub_query = 'SELECT COUNT(ATTENDANCE_ID) AS TOTAL FROM tblattendancerecord WHERE TIME_OUT_BEHAVIOR = @time_out_behavior';

	IF (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @date_query = ' AND TIME_IN_DATE BETWEEN @start_date AND @end_date';
	ELSE
		SET @date_query = '';
	END IF;

	IF (@branch IS NOT NULL OR @branch != '') THEN
		SET @branch_query = ' AND EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE BRANCH = @branch)';
	ELSE
		SET @branch_query = '';
	END IF;

	IF (@department IS NOT NULL OR @department != '') THEN
		SET @department_query = ' AND EMPLOYEE_ID IN (SELECT EMPLOYEE_ID FROM tblemployee WHERE DEPARTMENT = @department)';
	ELSE
		SET @department_query = '';
	END IF;

	SET @query = CONCAT(@sub_query, @date_query, @branch_query, @department_query);

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_attendance_time_in_count` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_attendance_time_in_count`(IN `time_in_behavior` VARCHAR(10), IN `employee_id` VARCHAR(100), IN `start_date` DATE, IN `end_date` DATE)
BEGIN
	SET @time_in_behavior = time_in_behavior;
	SET @employee_id = employee_id;
	SET @start_date = start_date;
	SET @end_date = end_date;

	IF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @query = 'SELECT COUNT(ATTENDANCE_ID) AS TOTAL FROM tblattendancerecord WHERE EMPLOYEE_ID = @employee_id AND TIME_IN_DATE BETWEEN @start_date AND @end_date AND TIME_IN_BEHAVIOR = @time_in_behavior';
	ELSEIF (@employee_id IS NULL OR @employee_id = '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @query = 'SELECT COUNT(ATTENDANCE_ID) AS TOTAL FROM tblattendancerecord WHERE TIME_IN_DATE BETWEEN @start_date AND @end_date AND TIME_IN_BEHAVIOR = @time_in_behavior';
	ELSEIF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NULL OR @start_date = '') AND (@end_date IS NULL OR @end_date = '') THEN
		SET @query = 'SELECT COUNT(ATTENDANCE_ID) AS TOTAL FROM tblattendancerecord WHERE EMPLOYEE_ID = @employee_id AND TIME_IN_BEHAVIOR = @time_in_behavior';
	ELSE
		SET @query = 'SELECT COUNT(ATTENDANCE_ID) AS TOTAL FROM tblattendancerecord WHERE TIME_IN_BEHAVIOR = @time_in_behavior';
    END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_attendance_time_out_count` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_attendance_time_out_count`(IN `time_out_behavior` VARCHAR(10), IN `employee_id` VARCHAR(100), IN `start_date` DATE, IN `end_date` DATE)
BEGIN
	SET @time_out_behavior = time_out_behavior;
	SET @employee_id = employee_id;
	SET @start_date = start_date;
	SET @end_date = end_date;

	IF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @query = 'SELECT COUNT(ATTENDANCE_ID) AS TOTAL FROM tblattendancerecord WHERE EMPLOYEE_ID = @employee_id AND TIME_IN_DATE BETWEEN @start_date AND @end_date AND TIME_OUT_BEHAVIOR = @time_out_behavior';
	ELSEIF (@employee_id IS NULL OR @employee_id = '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @query = 'SELECT COUNT(ATTENDANCE_ID) AS TOTAL FROM tblattendancerecord WHERE TIME_IN_DATE BETWEEN @start_date AND @end_date AND TIME_OUT_BEHAVIOR = @time_out_behavior';
	ELSEIF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NULL OR @start_date = '') AND (@end_date IS NULL OR @end_date = '') THEN
		SET @query = 'SELECT COUNT(ATTENDANCE_ID) AS TOTAL FROM tblattendancerecord WHERE EMPLOYEE_ID = @employee_id AND TIME_OUT_BEHAVIOR = @time_out_behavior';
	ELSE
		SET @query = 'SELECT COUNT(ATTENDANCE_ID) AS TOTAL FROM tblattendancerecord WHERE TIME_OUT_BEHAVIOR = @time_out_behavior';
    END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_available_leave_entitlement` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_available_leave_entitlement`(IN `employee_id` VARCHAR(100), IN `leave_type` VARCHAR(50), IN `leave_date` DATE)
BEGIN
	SET @employee_id = employee_id;
	SET @leave_type = leave_type;
	SET @leave_date = leave_date;

	SET @query = 'SELECT (NO_LEAVES - ACQUIRED_LEAVES) AS TOTAL FROM tblleaveentitlement WHERE EMPLOYEE_ID = @employee_id AND LEAVE_TYPE = @leave_type AND (START_DATE <= @leave_date AND END_DATE >= @leave_date)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_branch_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_branch_details`(IN `branch_id` VARCHAR(50))
BEGIN
	SET @branch_id = branch_id;

	SET @query = 'SELECT BRANCH, EMAIL, PHONE, TELEPHONE, ADDRESS, TRANSACTION_LOG_ID, RECORD_LOG FROM tblbranch WHERE BRANCH_ID = @branch_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_city_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_city_details`(IN `city_id` INT, IN `province_id` INT)
BEGIN
	SET @city_id = city_id;
	SET @province_id = province_id;

	SET @query = 'SELECT CITY, RECORD_LOG FROM tblcity WHERE CITY_ID = @city_id AND PROVINCE_ID  = @province_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_company_setting_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_company_setting_details`(IN `company_id` VARCHAR(50))
BEGIN
	SET @company_id = company_id;

	SET @query = 'SELECT COMPANY_NAME, EMAIL, TELEPHONE, PHONE, WEBSITE, ADDRESS, PROVINCE_ID, CITY_ID, TRANSACTION_LOG_ID, RECORD_LOG FROM tblcompany WHERE COMPANY_ID = @company_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_contribution_bracket_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_contribution_bracket_details`(IN `contribution_bracket_id` VARCHAR(100))
BEGIN
	SET @contribution_bracket_id = contribution_bracket_id;

	SET @query = 'SELECT GOVERNMENT_CONTRIBUTION_ID, START_RANGE, END_RANGE, DEDUCTION_AMOUNT, TRANSACTION_LOG_ID, RECORD_LOG FROM tblcontributionbracket WHERE CONTRIBUTION_BRACKET_ID = @contribution_bracket_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_contribution_deduction_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_contribution_deduction_details`(IN `contribution_deduction_id` VARCHAR(100))
BEGIN
	SET @contribution_deduction_id = contribution_deduction_id;

	SET @query = 'SELECT EMPLOYEE_ID, GOVERNMENT_CONTRIBUTION_TYPE, PAYROLL_ID, PAYROLL_DATE, TRANSACTION_LOG_ID, RECORD_LOG FROM tblcontributiondeduction WHERE CONTRIBUTION_DEDUCTION_ID = @contribution_deduction_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_days_worked` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_days_worked`(IN `employee_id` VARCHAR(100), IN `start_date` DATE, IN `end_date` DATE)
BEGIN
	SET @employee_id = employee_id;
	SET @start_date = start_date;
	SET @end_date = end_date;

	IF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @query = 'SELECT COUNT(ATTENDANCE_ID) AS TOTAL FROM tblattendancerecord WHERE EMPLOYEE_ID = @employee_id AND TIME_IN_DATE BETWEEN @start_date AND @end_date';
	ELSEIF (@employee_id IS NULL OR @employee_id = '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
		SET @query = 'SELECT COUNT(ATTENDANCE_ID) AS TOTAL FROM tblattendancerecord WHERE TIME_IN_DATE BETWEEN @start_date AND @end_date';
	ELSEIF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NULL OR @start_date = '') AND (@end_date IS NULL OR @end_date = '') THEN
		SET @query = 'SELECT COUNT(ATTENDANCE_ID) AS TOTAL FROM tblattendancerecord WHERE EMPLOYEE_ID = @employee_i';
	ELSE
		SET @query = 'SELECT COUNT(ATTENDANCE_ID) AS TOTAL FROM tblattendancerecord';
    END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_deduction_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_deduction_details`(IN `deduction_id` VARCHAR(100))
BEGIN
	SET @deduction_id = deduction_id;

	SET @query = 'SELECT EMPLOYEE_ID, DEDUCTION_TYPE, PAYROLL_ID, PAYROLL_DATE, AMOUNT, TRANSACTION_LOG_ID, RECORD_LOG FROM tbldeduction WHERE DEDUCTION_ID = @deduction_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_deduction_type_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_deduction_type_details`(IN `deduction_type_id` VARCHAR(100))
BEGIN
	SET @deduction_type_id = deduction_type_id;

	SET @query = 'SELECT DEDUCTION_TYPE, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG FROM tbldeductiontype WHERE DEDUCTION_TYPE_ID = @deduction_type_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_department_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_department_details`(IN `department_id` VARCHAR(50))
BEGIN
	SET @department_id = department_id;

	SET @query = 'SELECT DEPARTMENT, DESCRIPTION, DEPARTMENT_HEAD, PARENT_DEPARTMENT, TRANSACTION_LOG_ID, RECORD_LOG FROM tbldepartment WHERE DEPARTMENT_ID = @department_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_designation_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_designation_details`(IN `designation_id` VARCHAR(100))
BEGIN
	SET @designation_id = designation_id;

	SET @query = 'SELECT DESIGNATION, DESCRIPTION, JOB_DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG FROM tbldesignation WHERE DESIGNATION_ID = @designation_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_email_configuration_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_email_configuration_details`(IN `mail_id` INT)
BEGIN
	SET @mail_id = mail_id;

	SET @query = 'SELECT MAIL_HOST, PORT, SMTP_AUTH, SMTP_AUTO_TLS, USERNAME, PASSWORD, MAIL_ENCRYPTION, MAIL_FROM_NAME, MAIL_FROM_EMAIL, TRANSACTION_LOG_ID, RECORD_LOG FROM tblmailconfig WHERE MAIL_ID = @mail_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_emergency_contact_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_emergency_contact_details`(IN `contact_id` VARCHAR(100))
BEGIN
	SET @contact_id = contact_id;

	SET @query = 'SELECT EMPLOYEE_ID, NAME, RELATIONSHIP, EMAIL, PHONE, TELEPHONE, ADDRESS, CITY, PROVINCE, TRANSACTION_LOG_ID, RECORD_LOG FROM tblemergencycontact WHERE CONTACT_ID = @contact_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_employee_address_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_employee_address_details`(IN `address_id` VARCHAR(100))
BEGIN
	SET @address_id = address_id;

	SET @query = 'SELECT EMPLOYEE_ID, ADDRESS_TYPE, ADDRESS, CITY, PROVINCE, TRANSACTION_LOG_ID, RECORD_LOG FROM tblemployeeaddress WHERE ADDRESS_ID = @address_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_employee_attendance_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_employee_attendance_details`(IN `attendance_id` VARCHAR(100))
BEGIN
	SET @attendance_id = attendance_id;

	SET @query = 'SELECT EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_LOCATION, TIME_IN_IP_ADDRESS, TIME_IN_BY, TIME_IN_BEHAVIOR, TIME_IN_NOTE, TIME_OUT_DATE, TIME_OUT, TIME_OUT_LOCATION, TIME_OUT_IP_ADDRESS, TIME_OUT_BY, TIME_OUT_BEHAVIOR, TIME_OUT_NOTE, LATE, EARLY_LEAVING, OVERTIME, TOTAL_WORKING_HOURS, REMARKS, TRANSACTION_LOG_ID, RECORD_LOG FROM tblattendancerecord WHERE ATTENDANCE_ID = @attendance_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_employee_attendance_total` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_employee_attendance_total`(IN `request_type` VARCHAR(20), IN `employee_id` VARCHAR(100), IN `start_date` DATE, IN `end_date` DATE)
BEGIN
	SET @request_type = request_type;
	SET @employee_id = employee_id;
	SET @start_date = start_date;
	SET @end_date = end_date;

	IF @request_type = 'Late' THEN
		IF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
			SET @query = 'SELECT SUM(LATE) AS TOTAL FROM tblattendancerecord WHERE EMPLOYEE_ID = @employee_id AND TIME_IN_DATE BETWEEN @start_date AND @end_date';
		ELSEIF (@employee_id IS NULL OR @employee_id = '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
			SET @query = 'SELECT SUM(LATE) AS TOTAL FROM tblattendancerecord WHERE TIME_IN_DATE BETWEEN @start_date AND @end_date';
		ELSEIF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NULL OR @start_date = '') AND (@end_date IS NULL OR @end_date = '') THEN
			SET @query = 'SELECT SUM(LATE) AS TOTAL FROM tblattendancerecord WHERE EMPLOYEE_ID = @employee_id';
		ELSE
			SET @query = 'SELECT SUM(LATE) AS TOTAL FROM tblattendancerecord';
		END IF;
	ELSEIF @request_type = 'Early Leaving' THEN
		IF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
			SET @query = 'SELECT SUM(EARLY_LEAVING) AS TOTAL FROM tblattendancerecord WHERE EMPLOYEE_ID = @employee_id AND TIME_IN_DATE BETWEEN @start_date AND @end_date';
		ELSEIF (@employee_id IS NULL OR @employee_id = '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
			SET @query = 'SELECT SUM(EARLY_LEAVING) AS TOTAL FROM tblattendancerecord WHERE TIME_IN_DATE BETWEEN @start_date AND @end_date';
		ELSEIF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NULL OR @start_date = '') AND (@end_date IS NULL OR @end_date = '') THEN
			SET @query = 'SELECT SUM(EARLY_LEAVING) AS TOTAL FROM tblattendancerecord WHERE EMPLOYEE_ID = @employee_id';
		ELSE
			SET @query = 'SELECT SUM(EARLY_LEAVING) AS TOTAL FROM tblattendancerecord';
		END IF;
	ELSEIF @request_type = 'Total Hours' THEN
		IF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
			SET @query = 'SELECT SUM(TOTAL_WORKING_HOURS) AS TOTAL FROM tblattendancerecord WHERE EMPLOYEE_ID = @employee_id AND TIME_IN_DATE BETWEEN @start_date AND @end_date';
		ELSEIF (@employee_id IS NULL OR @employee_id = '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
			SET @query = 'SELECT SUM(TOTAL_WORKING_HOURS) AS TOTAL FROM tblattendancerecord WHERE TIME_IN_DATE BETWEEN @start_date AND @end_date';
		ELSEIF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NULL OR @start_date = '') AND (@end_date IS NULL OR @end_date = '') THEN
			SET @query = 'SELECT SUM(TOTAL_WORKING_HOURS) AS TOTAL FROM tblattendancerecord WHERE EMPLOYEE_ID = @employee_id';
		ELSE
			SET @query = 'SELECT SUM(TOTAL_WORKING_HOURS) AS TOTAL FROM tblattendancerecord';
		END IF;
	ELSE
		IF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
			SET @query = 'SELECT SUM(OVERTIME) AS TOTAL FROM tblattendancerecord WHERE EMPLOYEE_ID = @employee_id AND TIME_IN_DATE BETWEEN @start_date AND @end_date';
		ELSEIF (@employee_id IS NULL OR @employee_id = '') AND (@start_date IS NOT NULL OR @start_date != '') AND (@end_date IS NOT NULL OR @end_date != '') THEN
			SET @query = 'SELECT SUM(OVERTIME) AS TOTAL FROM tblattendancerecord WHERE TIME_IN_DATE BETWEEN @start_date AND @end_date';
		ELSEIF (@employee_id IS NOT NULL OR @employee_id != '') AND (@start_date IS NULL OR @start_date = '') AND (@end_date IS NULL OR @end_date = '') THEN
			SET @query = 'SELECT SUM(OVERTIME) AS TOTAL FROM tblattendancerecord WHERE EMPLOYEE_ID = @employee_id';
		ELSE
			SET @query = 'SELECT SUM(OVERTIME) AS TOTAL FROM tblattendancerecord';
		END IF;
	END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_employee_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_employee_details`(IN `employee_id` VARCHAR(100), IN `username` VARCHAR(50))
BEGIN
	SET @employee_id = employee_id;
	SET @username = username;

	SET @query = 'SELECT EMPLOYEE_ID, ID_NUMBER, USERNAME, FILE_AS, FIRST_NAME, MIDDLE_NAME, LAST_NAME, SUFFIX, BIRTHDAY, EMPLOYMENT_STATUS, JOIN_DATE, EXIT_DATE, PERMANENCY_DATE, EXIT_REASON, EMAIL, PHONE, TELEPHONE, DEPARTMENT, DESIGNATION, BRANCH, GENDER, TRANSACTION_LOG_ID, RECORD_LOG FROM tblemployee WHERE EMPLOYEE_ID = @employee_id OR USERNAME = @username';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_employee_file_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_employee_file_details`(IN `file_id` VARCHAR(50))
BEGIN
	SET @file_id = file_id;

	SET @query = 'SELECT EMPLOYEE_ID, FILE_NAME, FILE_CATEGORY, REMARKS, FILE_DATE, UPLOAD_DATE, UPLOAD_TIME, UPLOAD_BY, FILE_PATH, TRANSACTION_LOG_ID, RECORD_LOG FROM tblemployeefile WHERE FILE_ID = @file_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_employee_leave_entitlement_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_employee_leave_entitlement_details`(IN `employee_id` VARCHAR(100), IN `leave_type` VARCHAR(50), IN `leave_date` DATE)
BEGIN
	SET @employee_id = employee_id;
	SET @leave_type = leave_type;
	SET @leave_date = leave_date;

	SET @query = 'SELECT LEAVE_ENTITLEMENT_ID, NO_LEAVES, ACQUIRED_LEAVES, START_DATE, END_DATE, TRANSACTION_LOG_ID, RECORD_LOG FROM tblleaveentitlement WHERE EMPLOYEE_ID = @employee_id AND LEAVE_TYPE = @leave_type AND (START_DATE <= @leave_date AND END_DATE >= @leave_date)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_employee_social_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_employee_social_details`(IN `social_id` VARCHAR(100))
BEGIN
	SET @social_id = social_id;

	SET @query = 'SELECT EMPLOYEE_ID, SOCIAL_TYPE, LINK, TRANSACTION_LOG_ID, RECORD_LOG FROM tblemployeesocial WHERE SOCIAL_ID = @social_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_employee_work_shift_schedule_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_employee_work_shift_schedule_details`(IN `employee_id` VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;

	SET @query = 'SELECT WORK_SHIFT_ID, RECORD_LOG FROM tblemployeeworkshift WHERE EMPLOYEE_ID = @employee_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_employment_status_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_employment_status_details`(IN `employment_status_id` VARCHAR(50))
BEGIN
	SET @employment_status_id = employment_status_id;

	SET @query = 'SELECT EMPLOYMENT_STATUS, DESCRIPTION, COLOR_VALUE, TRANSACTION_LOG_ID, RECORD_LOG FROM tblemploymentstatus WHERE EMPLOYMENT_STATUS_ID = @employment_status_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_government_contribution_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_government_contribution_details`(IN `government_contribution_id` VARCHAR(100))
BEGIN
	SET @government_contribution_id = government_contribution_id;

	SET @query = 'SELECT GOVERNMENT_CONTRIBUTION, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblgovernmentcontribution WHERE GOVERNMENT_CONTRIBUTION_ID = @government_contribution_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_holiday_branch_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_holiday_branch_details`(IN `holiday_id` VARCHAR(50))
BEGIN
	SET @holiday_id = holiday_id;

	SET @query = 'SELECT BRANCH_ID, RECORD_LOG FROM tblholidaybranch WHERE HOLIDAY_ID = @holiday_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_holiday_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_holiday_details`(IN `holiday_id` VARCHAR(50))
BEGIN
	SET @holiday_id = holiday_id;

	SET @query = 'SELECT HOLIDAY, HOLIDAY_DATE, HOLIDAY_TYPE, TRANSACTION_LOG_ID, RECORD_LOG FROM tblholiday WHERE HOLIDAY_ID = @holiday_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_leave_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_leave_details`(IN `leave_id` VARCHAR(50))
BEGIN
	SET @leave_id = leave_id;

	SET @query = 'SELECT EMPLOYEE_ID, LEAVE_TYPE, LEAVE_DATE, START_TIME, END_TIME, LEAVE_STATUS, LEAVE_REASON, FILE_PATH, DECISION_REMARKS, DECISION_DATE, DECISION_TIME, DECISION_BY, TRANSACTION_LOG_ID, RECORD_LOG FROM tblleave WHERE LEAVE_ID = @leave_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_leave_entitlement_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_leave_entitlement_details`(IN `leave_entitlement_id` VARCHAR(50))
BEGIN
	SET @leave_entitlement_id = leave_entitlement_id;

	SET @query = 'SELECT EMPLOYEE_ID, LEAVE_TYPE, NO_LEAVES, ACQUIRED_LEAVES, START_DATE, END_DATE, TRANSACTION_LOG_ID, RECORD_LOG FROM tblleaveentitlement WHERE LEAVE_ENTITLEMENT_ID = @leave_entitlement_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_leave_statistics` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_leave_statistics`(IN `employee_id` VARCHAR(100), IN `leave_type` VARCHAR(50), IN `leave_date` DATE)
BEGIN
	SET @employee_id = employee_id;
	SET @leave_type = leave_type;
	SET @leave_date = leave_date;

	SET @query = 'SELECT NO_LEAVES, ACQUIRED_LEAVES FROM tblleaveentitlement WHERE EMPLOYEE_ID = @employee_id AND LEAVE_TYPE = @leave_type AND (START_DATE <= @leave_date AND END_DATE >= @leave_date)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_leave_type_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_leave_type_details`(IN `leave_type_id` VARCHAR(50))
BEGIN
	SET @leave_type_id = leave_type_id;

	SET @query = 'SELECT LEAVE_NAME, DESCRIPTION, NO_LEAVES, PAID_STATUS, TRANSACTION_LOG_ID, RECORD_LOG FROM tblleavetype WHERE LEAVE_TYPE_ID = @leave_type_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_notification_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_notification_details`(IN `notification_id` INT)
BEGIN
	SET @notification_id = notification_id;

	SET @query = 'SELECT NOTIFICATION_TITLE, NOTIFICATION_MESSAGE, SYSTEM_LINK, WEB_LINK, TRANSACTION_LOG_ID, RECORD_LOG FROM tblnotificationdetails WHERE NOTIFICATION_ID = @notification_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_notification_recipient_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_notification_recipient_details`(IN `notification_id` INT(50))
BEGIN
	SET @notification_id = notification_id;

	SET @query = 'SELECT EMPLOYEE_ID, RECORD_LOG FROM tblnotificationrecipient WHERE NOTIFICATION_ID = @notification_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_notification_type_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_notification_type_details`(IN `notification_id` INT)
BEGIN
	SET @notification_id = notification_id;

	SET @query = 'SELECT NOTIFICATION, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblnotificationtype WHERE NOTIFICATION_ID = @notification_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_permission_count` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_permission_count`(IN `role_id` VARCHAR(50), IN `permission_id` INT)
BEGIN
	SET @role_id = role_id;
	SET @permission_id = permission_id;

	SET @query = 'SELECT COUNT(PERMISSION_ID) AS TOTAL FROM tblrolepermission WHERE ROLE_ID = @role_id AND PERMISSION_ID = @permission_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_permission_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_permission_details`(IN `permission_id` INT)
BEGIN
	SET @permission_id = permission_id;

	SET @query = 'SELECT POLICY, PERMISSION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblpermission WHERE PERMISSION_ID = @permission_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_policy_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_policy_details`(IN `policy_id` INT)
BEGIN
	SET @policy_id = policy_id;

	SET @query = 'SELECT POLICY, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblpolicy WHERE POLICY_ID = @policy_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_province_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_province_details`(IN `province_id` INT)
BEGIN
	SET @province_id = province_id;

	SET @query = 'SELECT PROVINCE, RECORD_LOG FROM tblprovince WHERE PROVINCE_ID  = @province_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_role_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_role_details`(IN `role_id` VARCHAR(100))
BEGIN
	SET @role_id = role_id;

	SET @query = 'SELECT ROLE, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblrole WHERE ROLE_ID = @role_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_role_permission_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_role_permission_details`(IN `role_id` VARCHAR(100))
BEGIN
	SET @role_id = role_id;

	SET @query = 'SELECT PERMISSION_ID, RECORD_LOG FROM tblrolepermission WHERE ROLE_ID = @role_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_role_user_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_role_user_details`(IN `role_id` VARCHAR(50), IN `username` VARCHAR(50))
BEGIN
	SET @role_id = role_id;
	SET @username = username;

	SET @query = 'SELECT ROLE_ID, USERNAME, RECORD_LOG FROM tblroleuser WHERE ROLE_ID = @role_id OR USERNAME = @username';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_system_code_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_system_code_details`(IN `system_type` VARCHAR(100), IN `system_code` VARCHAR(100))
BEGIN
	SET @system_type = system_type;
	SET @system_code = system_code;

	SET @query = 'SELECT DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblsystemcode WHERE SYSTEM_TYPE = @system_type AND SYSTEM_CODE = @system_code';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_system_parameter` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_system_parameter`(IN `parameter_id` INT)
BEGIN
	SET @parameter_id = parameter_id;

	SET @query = 'SELECT PARAMETER_EXTENSION, PARAMETER_NUMBER FROM tblsystemparameters WHERE PARAMETER_ID = @parameter_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_system_parameter_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_system_parameter_details`(IN `parameter_id` INT)
BEGIN
	SET @parameter_id = parameter_id;

	SET @query = 'SELECT PARAMETER_DESC, PARAMETER_EXTENSION, PARAMETER_NUMBER, TRANSACTION_LOG_ID, RECORD_LOG FROM tblsystemparameters WHERE PARAMETER_ID = @parameter_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_transaction_log_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_transaction_log_details`(IN `transaction_log_id` VARCHAR(500))
BEGIN
	SET @transaction_log_id = transaction_log_id;

	SET @query = 'SELECT USERNAME, LOG_TYPE, LOG_DATE, LOG FROM tbltransactionlog WHERE TRANSACTION_LOG_ID = @transaction_log_id ORDER BY LOG_DATE DESC';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_upload_file_type_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_upload_file_type_details`(IN `upload_setting_id` INT(50))
BEGIN
	SET @upload_setting_id = upload_setting_id;

	SET @query = 'SELECT FILE_TYPE, RECORD_LOG FROM tbluploadfiletype WHERE UPLOAD_SETTING_ID = @upload_setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_upload_setting_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_upload_setting_details`(IN `upload_setting_id` INT(50))
BEGIN
	SET @upload_setting_id = upload_setting_id;

	SET @query = 'SELECT UPLOAD_SETTING, DESCRIPTION, MAX_FILE_SIZE, TRANSACTION_LOG_ID, RECORD_LOG FROM tbluploadsetting WHERE UPLOAD_SETTING_ID = @upload_setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_user_account_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_user_account_details`(IN `username` VARCHAR(50))
BEGIN
	SET @username = username;

	SET @query = 'SELECT PASSWORD, ACTIVE, PASSWORD_EXPIRY_DATE, FAILED_LOGIN, LAST_FAILED_LOGIN, TRANSACTION_LOG_ID, RECORD_LOG FROM tbluseraccount WHERE USERNAME = @username';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_user_interface_settings_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_user_interface_settings_details`(IN `setting_id` INT)
BEGIN
	SET @setting_id = setting_id;

	SET @query = 'SELECT LOGIN_BG, LOGO_LIGHT, LOGO_DARK, LOGO_ICON_LIGHT, LOGO_ICON_DARK, FAVICON, TRANSACTION_LOG_ID, RECORD_LOG FROM tbluserinterfacesettings WHERE SETTINGS_ID = @setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_work_shift_assignment_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_work_shift_assignment_details`(IN `work_shift_id` VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'SELECT EMPLOYEE_ID, RECORD_LOG FROM tblemployeeworkshift WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_work_shift_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_work_shift_details`(IN `work_shift_id` VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'SELECT WORK_SHIFT, WORK_SHIFT_TYPE, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblworkshift WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_work_shift_schedule_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_work_shift_schedule_details`(IN `work_shift_id` VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;

	SET @query = 'SELECT WORK_SHIFT_ID, START_DATE, END_DATE, MONDAY_START_TIME,MONDAY_END_TIME, MONDAY_LUNCH_START_TIME, MONDAY_LUNCH_END_TIME, MONDAY_HALF_DAY_MARK, TUESDAY_START_TIME, TUESDAY_END_TIME, TUESDAY_LUNCH_START_TIME, TUESDAY_LUNCH_END_TIME, TUESDAY_HALF_DAY_MARK, WEDNESDAY_START_TIME, WEDNESDAY_END_TIME, WEDNESDAY_LUNCH_START_TIME, WEDNESDAY_LUNCH_END_TIME, WEDNESDAY_HALF_DAY_MARK,THURSDAY_START_TIME, THURSDAY_END_TIME, THURSDAY_LUNCH_START_TIME, THURSDAY_LUNCH_END_TIME, THURSDAY_HALF_DAY_MARK,FRIDAY_START_TIME,FRIDAY_END_TIME, FRIDAY_LUNCH_START_TIME, FRIDAY_LUNCH_END_TIME, FRIDAY_HALF_DAY_MARK, SATURDAY_START_TIME, SATURDAY_END_TIME, SATURDAY_LUNCH_START_TIME, SATURDAY_LUNCH_END_TIME, SATURDAY_HALF_DAY_MARK, SUNDAY_START_TIME,SUNDAY_END_TIME, SUNDAY_LUNCH_START_TIME, SUNDAY_LUNCH_END_TIME, SUNDAY_HALF_DAY_MARK, RECORD_LOG FROM tblworkshiftschedule WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_allowance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_allowance`(IN `allowance_id` VARCHAR(100), IN `employee_id` VARCHAR(100), IN `allowance_type` VARCHAR(100), IN `payroll_date` DATE, IN `amount` DOUBLE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @allowance_id = allowance_id;
	SET @employee_id = employee_id;
	SET @allowance_type = allowance_type;
	SET @payroll_date = payroll_date;
	SET @amount = amount;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblallowance (ALLOWANCE_ID, EMPLOYEE_ID, ALLOWANCE_TYPE, PAYROLL_DATE, AMOUNT, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@allowance_id, @employee_id, @allowance_type, @payroll_date, @amount, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_allowance_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_allowance_type`(IN `allowance_type_id` VARCHAR(100), IN `allowance_type` VARCHAR(50), IN `taxable` VARCHAR(5), IN `description` VARCHAR(100), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @allowance_type_id = allowance_type_id;
	SET @allowance_type = allowance_type;
	SET @taxable = taxable;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblallowancetype (ALLOWANCE_TYPE_ID, ALLOWANCE_TYPE, TAXABLE, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@allowance_type_id, @allowance_type, @taxable, @description, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_application_notification` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_application_notification`(IN `notification_id` INT, IN `notification` VARCHAR(5), IN `record_log` VARCHAR(100))
BEGIN
	SET @notification_id = notification_id;
	SET @notification = notification;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblsystemnotification (NOTIFICATION_ID, NOTIFICATION, RECORD_LOG) VALUES(@notification_id, @notification, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_attendance_adjustment` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_attendance_adjustment`(IN `request_id` VARCHAR(100), IN `employee_id` VARCHAR(100), IN `attendance_id` VARCHAR(100), IN `time_in_date` DATE, IN `time_in` TIME, IN `time_in_date_adjusted` DATE, IN `time_in_adjusted` TIME, IN `time_out_date` DATE, IN `time_out` TIME, IN `time_out_date_adjusted` DATE, IN `time_out_adjusted` TIME, IN `reason` VARCHAR(500), IN `request_date` DATE, IN `request_time` TIME, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @request_id = request_id;
	SET @employee_id = employee_id;
    SET @attendance_id = attendance_id;
	SET @time_in_date = time_in_date;
	SET @time_in = time_in;
	SET @time_in_date_adjusted = time_in_date_adjusted;
	SET @time_in_adjusted = time_in_adjusted;
	SET @time_out_date = time_out_date;
	SET @time_out = time_out;
	SET @time_out_date_adjusted = time_out_date_adjusted;
	SET @time_out_adjusted = time_out_adjusted;
	SET @reason = reason;
	SET @request_date = request_date;
	SET @request_time = request_time;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblattendanceadjustment (REQUEST_ID, EMPLOYEE_ID, ATTENDANCE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_DATE_ADJUSTED, TIME_IN_ADJUSTED, TIME_OUT_DATE, TIME_OUT, TIME_OUT_DATE_ADJUSTED, TIME_OUT_ADJUSTED, STATUS, REASON, REQUEST_DATE, REQUEST_TIME, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@request_id, @employee_id, @attendance_id, @time_in_date, @time_in, @time_in_date_adjusted, @time_in_adjusted, @time_out_date, @time_out, @time_out_date_adjusted, @time_out_adjusted, "PEN", @reason, @request_date, @request_time, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_attendance_adjustment_approval` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_attendance_adjustment_approval`(IN `employee_id` VARCHAR(100), IN `record_log` VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblattendanceadjustmentexception (EMPLOYEE_ID, RECORD_LOG) VALUES(@employee_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_attendance_creation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_attendance_creation`(IN `request_id` VARCHAR(100), IN `employee_id` VARCHAR(100), IN `time_in_date` DATE, IN `time_in` TIME, IN `time_out_date` DATE, IN `time_out` TIME, IN `reason` VARCHAR(500), IN `request_date` DATE, IN `request_time` TIME, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @request_id = request_id;
	SET @employee_id = employee_id;
	SET @time_in_date = time_in_date;
	SET @time_in = time_in;
	SET @time_out_date = time_out_date;
	SET @time_out = time_out;
	SET @reason = reason;
	SET @request_date = request_date;
	SET @request_time = request_time;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblattendancecreation (REQUEST_ID, EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_OUT_DATE, TIME_OUT, STATUS, REASON, REQUEST_DATE, REQUEST_TIME, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@request_id, @employee_id, @time_in_date, @time_in, @time_out_date, @time_out, "PEN", @reason, @request_date, @request_time, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_attendance_creation_approval` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_attendance_creation_approval`(IN `employee_id` VARCHAR(100), IN `record_log` VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblattendancecreationexception (EMPLOYEE_ID, RECORD_LOG) VALUES(@employee_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_attendance_setting` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_attendance_setting`(IN `setting_id` INT, IN `maximum_attendance` INT, IN `time_out_allowance` INT, IN `late_allowance` INT, IN `late_policy` INT, IN `early_leaving_policy` INT, IN `attendance_creation_recommendation` INT(1), IN `attendance_adjustment_recommendation` INT(1), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @setting_id = setting_id;
	SET @maximum_attendance = maximum_attendance;
    SET @time_out_allowance = time_out_allowance;
    SET @late_allowance = late_allowance;
    SET @late_policy = late_policy;
    SET @early_leaving_policy = early_leaving_policy;
    SET @attendance_creation_recommendation = attendance_creation_recommendation;
    SET @attendance_adjustment_recommendation = attendance_adjustment_recommendation;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblattendancesetting (SETTING_ID, MAX_ATTENDANCE, TIME_OUT_ALLOWANCE, LATE_ALLOWANCE, LATE_POLICY, EARLY_LEAVING_POLICY, ATTENDANCE_CREATION_RECOMMENDATION, ATTENDANCE_ADJUSTMENT_RECOMMENDATION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@setting_id, @maximum_attendance, @time_out_allowance, @late_allowance, @late_policy, @early_leaving_policy, @attendance_creation_recommendation, @attendance_adjustment_recommendation, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_branch` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_branch`(IN `branch_id` VARCHAR(50), IN `branch` VARCHAR(100), IN `email` VARCHAR(50), IN `phone` VARCHAR(30), IN `telephone` VARCHAR(30), IN `address` VARCHAR(500), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @branch_id = branch_id;
	SET @branch = branch;
	SET @email = email;
	SET @phone = phone;
	SET @telephone = telephone;
	SET @address = address;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblbranch (BRANCH_ID, BRANCH, EMAIL, PHONE, TELEPHONE, ADDRESS, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@branch_id, @branch, @email, @phone, @telephone, @address, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_company_setting` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_company_setting`(IN `company_id` VARCHAR(50), IN `company_name` VARCHAR(100), IN `email` VARCHAR(50), IN `telephone` VARCHAR(20), IN `phone` VARCHAR(20), IN `website` VARCHAR(100), IN `address` VARCHAR(200), IN `province_id` INT, IN `city_id` INT, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @company_id = company_id;
	SET @company_name = company_name;
	SET @email = email;
	SET @telephone = telephone;
	SET @phone = phone;
	SET @website = website;
	SET @address = address;
	SET @province_id = province_id;
	SET @city_id = city_id;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblcompany (COMPANY_ID, COMPANY_NAME, EMAIL, TELEPHONE, PHONE, WEBSITE, ADDRESS, PROVINCE_ID, CITY_ID, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@company_id, @company_name, @email, @telephone, @phone, @website, @address, @province_id, @city_id, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_contribution_bracket` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_contribution_bracket`(IN `contribution_bracket_id` VARCHAR(100), IN `government_contribution_id` VARCHAR(100), IN `start_range` DOUBLE, IN `end_range` DOUBLE, IN `deduction_amount` DOUBLE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @contribution_bracket_id = contribution_bracket_id;
	SET @government_contribution_id = government_contribution_id;
	SET @start_range = start_range;
	SET @end_range = end_range;
	SET @deduction_amount = deduction_amount;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblcontributionbracket (CONTRIBUTION_BRACKET_ID, GOVERNMENT_CONTRIBUTION_ID, START_RANGE, END_RANGE, DEDUCTION_AMOUNT, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@contribution_bracket_id, @government_contribution_id, @start_range, @end_range, @deduction_amount, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_contribution_deduction` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_contribution_deduction`(IN `contribution_deduction_id` VARCHAR(100), IN `employee_id` VARCHAR(100), IN `government_contribution_type` VARCHAR(100), IN `payroll_date` DATE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @contribution_deduction_id = contribution_deduction_id;
	SET @employee_id = employee_id;
	SET @government_contribution_type = government_contribution_type;
	SET @payroll_date = payroll_date;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblcontributiondeduction (CONTRIBUTION_DEDUCTION_ID, EMPLOYEE_ID, GOVERNMENT_CONTRIBUTION_TYPE, PAYROLL_DATE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@contribution_deduction_id, @employee_id, @government_contribution_type, @payroll_date, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_deduction` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_deduction`(IN `deduction_id` VARCHAR(100), IN `employee_id` VARCHAR(100), IN `deduction_type` VARCHAR(100), IN `payroll_date` DATE, IN `amount` DOUBLE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @deduction_id = deduction_id;
	SET @employee_id = employee_id;
	SET @deduction_type = deduction_type;
	SET @payroll_date = payroll_date;
	SET @amount = amount;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tbldeduction (DEDUCTION_ID, EMPLOYEE_ID, DEDUCTION_TYPE, PAYROLL_DATE, AMOUNT, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@deduction_id, @employee_id, @deduction_type, @payroll_date, @amount, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_deduction_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_deduction_type`(IN `deduction_type_id` VARCHAR(100), IN `deduction_type` VARCHAR(50), IN `description` VARCHAR(100), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @deduction_type_id = deduction_type_id;
	SET @deduction_type = deduction_type;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tbldeductiontype (DEDUCTION_TYPE_ID, DEDUCTION_TYPE, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@deduction_type_id, @deduction_type, @description, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_department` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_department`(IN `department_id` VARCHAR(50), IN `department` VARCHAR(100), IN `description` VARCHAR(100), IN `department_head` VARCHAR(100), IN `parent_department` VARCHAR(50), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @department_id = department_id;
	SET @department = department;
	SET @description = description;
	SET @department_head = department_head;
	SET @parent_department = parent_department;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tbldepartment (DEPARTMENT_ID, DEPARTMENT, DESCRIPTION, DEPARTMENT_HEAD, PARENT_DEPARTMENT, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@department_id, @department, @description, @department_head, @parent_department, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_designation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_designation`(IN `designation_id` VARCHAR(100), IN `designation` VARCHAR(100), IN `description` VARCHAR(100), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @designation_id = designation_id;
	SET @designation = designation;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tbldesignation (DESIGNATION_ID, DESIGNATION, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@designation_id, @designation, @description, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_email_configuration` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_email_configuration`(IN `mail_id` INT, IN `mail_host` VARCHAR(100), IN `port` INT, IN `smtp_auth` INT(1), IN `smtp_auto_tls` INT(1), IN `username` VARCHAR(200), IN `password` VARCHAR(200), IN `mail_encryption` VARCHAR(20), IN `mail_from_name` VARCHAR(200), IN `mail_from_email` VARCHAR(200), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @mail_id = mail_id;
	SET @mail_host = mail_host;
	SET @port = port;
	SET @smtp_auth = smtp_auth;
	SET @smtp_auto_tls = smtp_auto_tls;
	SET @username = username;
	SET @password = password;
	SET @mail_encryption = mail_encryption;
	SET @mail_from_name = mail_from_name;
	SET @mail_from_email = mail_from_email;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;


	SET @query = 'INSERT INTO tblmailconfig (MAIL_ID, MAIL_HOST, PORT, SMTP_AUTH, SMTP_AUTO_TLS, USERNAME, PASSWORD, MAIL_ENCRYPTION, MAIL_FROM_NAME, MAIL_FROM_EMAIL, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@mail_id, @mail_host, @port, @smtp_auth, @smtp_auto_tls, @username, @password, @mail_encryption, @mail_from_name, @mail_from_email, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_emergency_contact` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_emergency_contact`(IN `contact_id` VARCHAR(100), IN `employee_id` VARCHAR(100), IN `contact_name` VARCHAR(300), IN `relationship` VARCHAR(20), IN `email` VARCHAR(100), IN `phone` VARCHAR(30), IN `telephone` VARCHAR(30), IN `address` VARCHAR(200), IN `city` INT, IN `province` INT, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @contact_id = contact_id;
	SET @employee_id = employee_id;
	SET @contact_name = contact_name;
	SET @relationship = relationship;
	SET @email = email;
	SET @phone = phone;
	SET @telephone = telephone;
	SET @address = address;
	SET @city = city;
	SET @province = province;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblemergencycontact (CONTACT_ID, EMPLOYEE_ID, NAME, RELATIONSHIP, EMAIL, PHONE, TELEPHONE, ADDRESS, CITY, PROVINCE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@contact_id, @employee_id, @contact_name, @relationship, @email, @phone, @telephone, @address, @city, @province, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_employee` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_employee`(IN `employee_id` VARCHAR(100), IN `id_number` VARCHAR(100), IN `file_as` VARCHAR(500), IN `first_name` VARCHAR(100), IN `middle_name` VARCHAR(100), IN `last_name` VARCHAR(100), IN `suffix` VARCHAR(20), IN `birthday` DATE, IN `employment_status` VARCHAR(50), IN `joining_date` DATE, IN `permanency_date` DATE, IN `exit_date` DATE, IN `exit_reason` VARCHAR(500), IN `email` VARCHAR(100), IN `phone` VARCHAR(30), IN `telephone` VARCHAR(30), IN `department` VARCHAR(50), IN `designation` VARCHAR(50), IN `branch` VARCHAR(50), IN `gender` VARCHAR(20), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;
	SET @file_as = file_as;
	SET @first_name = first_name;
	SET @middle_name = middle_name;
	SET @last_name = last_name;
	SET @suffix = suffix;
	SET @birthday = birthday;
	SET @employment_status = employment_status;
	SET @joining_date = joining_date;
	SET @permanency_date = permanency_date;
	SET @exit_date = exit_date;
	SET @exit_reason = exit_reason;
	SET @email = email;
	SET @phone = phone;
	SET @telephone = telephone;
	SET @department = department;
	SET @designation = designation;
	SET @branch = branch;
	SET @gender = gender;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblemployee (EMPLOYEE_ID, ID_NUMBER, FILE_AS, FIRST_NAME, MIDDLE_NAME, LAST_NAME, SUFFIX, BIRTHDAY, EMPLOYMENT_STATUS, JOIN_DATE, PERMANENCY_DATE, EXIT_DATE, EXIT_REASON, EMAIL, PHONE, TELEPHONE, DEPARTMENT, DESIGNATION, BRANCH, GENDER, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@employee_id, @id_number, @file_as, @first_name, @middle_name, @last_name, @suffix, @birthday, @employment_status, @joining_date, @permanency_date, @exit_date, @exit_reason, @email, @phone, @telephone, @department, @designation, @branch, @gender, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_employee_address` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_employee_address`(IN `address_id` VARCHAR(100), IN `employee_id` VARCHAR(100), IN `address_type` VARCHAR(20), IN `address` VARCHAR(200), IN `city` INT, IN `province` INT, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @address_id = address_id;
	SET @employee_id = employee_id;
	SET @address_type = address_type;
	SET @address = address;
	SET @city = city;
	SET @province = province;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblemployeeaddress (ADDRESS_ID, EMPLOYEE_ID, ADDRESS_TYPE, ADDRESS, CITY, PROVINCE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@address_id, @employee_id, @address_type, @address, @city, @province, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_employee_file` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_employee_file`(IN `file_id` VARCHAR(50), IN `employee_id` VARCHAR(100), IN `file_name` VARCHAR(100), IN `file_category` VARCHAR(50), IN `remarks` VARCHAR(100), IN `file_date` DATE, IN `upload_date` DATE, IN `upload_time` TIME, IN `upload_by` VARCHAR(50), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @file_id = file_id;
	SET @employee_id = employee_id;
	SET @file_name = file_name;
	SET @file_category = file_category;
	SET @remarks = remarks;
	SET @file_date = file_date;
	SET @upload_date = upload_date;
	SET @upload_time = upload_time;
	SET @upload_by = upload_by;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblemployeefile (FILE_ID, EMPLOYEE_ID, FILE_NAME, FILE_CATEGORY, REMARKS, FILE_DATE, UPLOAD_DATE, UPLOAD_TIME, UPLOAD_BY, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@file_id, @employee_id, @file_name, @file_category, @remarks, @file_date, @upload_date, @upload_time, @upload_by, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_employee_social` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_employee_social`(IN `social_id` VARCHAR(100), IN `employee_id` VARCHAR(100), IN `social_type` VARCHAR(20), IN `link` VARCHAR(300), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @social_id = social_id;
	SET @employee_id = employee_id;
	SET @social_type = social_type;
	SET @link = link;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblemployeesocial (SOCIAL_ID, EMPLOYEE_ID, SOCIAL_TYPE, LINK, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@social_id, @employee_id, @social_type, @link, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_employee_work_shift` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_employee_work_shift`(IN `work_shift_id` VARCHAR(100), IN `employee_id` VARCHAR(100), IN `record_log` VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;
	SET @employee_id = employee_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblemployeeworkshift (WORK_SHIFT_ID, EMPLOYEE_ID, RECORD_LOG) VALUES(@work_shift_id, @employee_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_employment_status` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_employment_status`(IN `employment_status_id` VARCHAR(50), IN `employment_status` VARCHAR(100), IN `description` VARCHAR(100), IN `color_value` VARCHAR(20), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @employment_status_id = employment_status_id;
	SET @employment_status = employment_status;
	SET @description = description;
	SET @color_value = color_value;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblemploymentstatus (EMPLOYMENT_STATUS_ID, EMPLOYMENT_STATUS, DESCRIPTION, COLOR_VALUE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@employment_status_id, @employment_status, @description, @color_value, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_government_contribution` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_government_contribution`(IN `government_contribution_id` VARCHAR(100), IN `government_contribution` VARCHAR(50), IN `description` VARCHAR(100), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @government_contribution_id = government_contribution_id;
	SET @government_contribution = government_contribution;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblgovernmentcontribution (GOVERNMENT_CONTRIBUTION_ID, GOVERNMENT_CONTRIBUTION, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@government_contribution_id, @government_contribution, @description, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_health_declaration` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_health_declaration`(IN `declaration_id` VARCHAR(50), IN `employee_id` VARCHAR(100), IN `temperature` DOUBLE, IN `question_1` INT, IN `question_2` INT, IN `question_3` INT, IN `question_4` INT, IN `question_5` INT, IN `question_5_specific` INT, IN `submit_date` DATE, IN `submit_time` TIME, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @declaration_id = declaration_id;
	SET @employee_id = employee_id;
	SET @temperature = temperature;
	SET @question_1 = question_1;
	SET @question_2 = question_2;
	SET @question_3 = question_3;
	SET @question_4 = question_4;
	SET @question_5 = question_5;
	SET @question_5_specific = question_5_specific;
	SET @submit_date = submit_date;
	SET @submit_time = submit_time;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblhealthdeclaration (DECLARATION_ID, EMPLOYEE_ID, TEMPERATURE, QUESTION_1, QUESTION_2, QUESTION_3, QUESTION_4, QUESTION_5, QUESTION_5_SPECIFIC, SUBMIT_DATE, SUBMIT_TIME, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@declaration_id, @employee_id, @temperature, @question_1, @question_2, @question_3, @question_4, @question_5, @question_5_specific, @submit_date, @submit_time, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_holiday` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_holiday`(IN `holiday_id` VARCHAR(50), IN `holiday` VARCHAR(200), IN `holiday_date` DATE, IN `holiday_type` VARCHAR(20), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @holiday_id = holiday_id;
	SET @holiday = holiday;
	SET @holiday_date = holiday_date;
	SET @holiday_type = holiday_type;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblholiday (HOLIDAY_ID, HOLIDAY, HOLIDAY_DATE, HOLIDAY_TYPE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@holiday_id, @holiday, @holiday_date, @holiday_type, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_holiday_branch` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_holiday_branch`(IN `holiday_id` VARCHAR(50), IN `branch_id` VARCHAR(50), IN `record_log` VARCHAR(100))
BEGIN
	SET @holiday_id = holiday_id;
	SET @branch_id = branch_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblholidaybranch (HOLIDAY_ID, BRANCH_ID, RECORD_LOG) VALUES(@holiday_id, @branch_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_leave` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_leave`(IN `leave_id` VARCHAR(50), IN `employee_id` VARCHAR(100), IN `leave_type` VARCHAR(50), IN `leave_date` DATE, IN `start_time` TIME, IN `end_time` TIME, IN `leave_status` VARCHAR(10), IN `reason` VARCHAR(500), IN `decision_date` DATE, IN `decision_time` TIME, IN `decision_by` VARCHAR(50), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @leave_id = leave_id;
	SET @employee_id = employee_id;
	SET @leave_type = leave_type;
	SET @leave_date = leave_date;
	SET @start_time = start_time;
	SET @end_time = end_time;
	SET @leave_status = leave_status;
	SET @reason = reason;
	SET @decision_date = decision_date;
	SET @decision_time = decision_time;
	SET @decision_by = decision_by;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblleave (LEAVE_ID, EMPLOYEE_ID, LEAVE_TYPE, LEAVE_DATE, START_TIME, END_TIME, LEAVE_STATUS, LEAVE_REASON, DECISION_DATE, DECISION_TIME, DECISION_BY, TRANSACTION_LOG_ID, RECORD_LOG) VALUES (@leave_id, @employee_id, @leave_type, @leave_date, @start_time, @end_time, @leave_status, @reason, @decision_date, @decision_time, @decision_by, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_leave_entitlement` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_leave_entitlement`(IN `leave_entitlement_id` VARCHAR(50), IN `employee_id` VARCHAR(100), IN `leave_type` VARCHAR(50), IN `no_leaves` DOUBLE, IN `start_date` DATE, IN `end_date` DATE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @leave_entitlement_id = leave_entitlement_id;
	SET @employee_id = employee_id;
	SET @leave_type = leave_type;
	SET @no_leaves = no_leaves;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblleaveentitlement (LEAVE_ENTITLEMENT_ID, EMPLOYEE_ID, LEAVE_TYPE, NO_LEAVES, ACQUIRED_LEAVES, START_DATE, END_DATE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@leave_entitlement_id, @employee_id, @leave_type, @no_leaves, 0, @start_date, @end_date, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_leave_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_leave_type`(IN `leave_type_id` VARCHAR(50), IN `leave_name` VARCHAR(100), IN `description` VARCHAR(200), IN `no_leaves` DOUBLE, IN `paid_status` VARCHAR(20), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @leave_type_id = leave_type_id;
	SET @leave_name = leave_name;
	SET @description = description;
	SET @no_leaves = no_leaves;
	SET @paid_status = paid_status;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblleavetype (LEAVE_TYPE_ID, LEAVE_NAME, DESCRIPTION, NO_LEAVES, PAID_STATUS, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@leave_type_id, @leave_name, @description, @no_leaves, @paid_status, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_location` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_location`(IN `location_id` VARCHAR(50), IN `employee_id` VARCHAR(100), IN `position` VARCHAR(100), IN `log_date` DATE, IN `log_time` TIME, IN `remarks` VARCHAR(500), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @location_id = location_id;
	SET @employee_id = employee_id;
	SET @position = position;
	SET @log_date = log_date;
	SET @log_time = log_time;
	SET @remarks = remarks;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tbllocation (LOCATION_ID, EMPLOYEE_ID, POSITION, LOG_DATE, LOG_TIME, REMARKS, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@location_id, @employee_id, @position, @log_date, @log_time, @remarks, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_manual_employee_attendance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_manual_employee_attendance`(IN `attendance_id` VARCHAR(100), IN `employee_id` VARCHAR(100), IN `time_in_date` DATE, IN `time_in` TIME, IN `time_in_behavior` VARCHAR(10), IN `time_out_date` DATE, IN `time_out` TIME, IN `time_out_behavior` VARCHAR(10), IN `late` DOUBLE, IN `early_leaving` DOUBLE, IN `overtime` DOUBLE, IN `total_hours_worked` DOUBLE, IN `remarks` VARCHAR(500), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @attendance_id = attendance_id;
	SET @employee_id = employee_id;
	SET @time_in_date = time_in_date;
	SET @time_in = time_in;
	SET @time_in_behavior = time_in_behavior;
	SET @time_out_date = time_out_date;
	SET @time_out = time_out;
	SET @time_out_behavior = time_out_behavior;
	SET @late = late;
	SET @early_leaving = early_leaving;
	SET @overtime = overtime;
	SET @total_hours_worked = total_hours_worked;
	SET @remarks = remarks;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblattendancerecord (ATTENDANCE_ID, EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_BEHAVIOR, TIME_OUT_DATE, TIME_OUT, TIME_OUT_BEHAVIOR, LATE, EARLY_LEAVING, OVERTIME, TOTAL_WORKING_HOURS, REMARKS, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@attendance_id, @employee_id, @time_in_date, @time_in, @time_in_behavior, @time_out_date, @time_out, @time_out_behavior, @late, @early_leaving, @overtime, @total_hours_worked, @remarks, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_notification_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_notification_details`(IN `notification_id` INT, IN `notification_title` VARCHAR(500), IN `notification_message` VARCHAR(500), IN `system_link` VARCHAR(200), IN `web_link` VARCHAR(200), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @notification_id = notification_id;
	SET @notification_title = notification_title;
	SET @notification_message = notification_message;
	SET @system_link = system_link;
	SET @web_link = web_link;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblnotificationdetails (NOTIFICATION_ID, NOTIFICATION_TITLE, NOTIFICATION_MESSAGE, SYSTEM_LINK, WEB_LINK, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@notification_id, @notification_title, @notification_message, @system_link, @web_link, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_notification_recipient` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_notification_recipient`(IN `notification_id` INT(50), IN `employee_id` VARCHAR(100), IN `record_log` VARCHAR(100))
BEGIN
	SET @notification_id = notification_id;
	SET @employee_id = employee_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblnotificationrecipient (NOTIFICATION_ID, EMPLOYEE_ID, RECORD_LOG) VALUES(@notification_id, @employee_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_notification_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_notification_type`(IN `notification_id` INT, IN `notification` VARCHAR(100), IN `description` VARCHAR(200), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @notification_id = notification_id;
	SET @notification = notification;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblnotificationtype (NOTIFICATION_ID, NOTIFICATION, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@notification_id, @notification, @description, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_permission` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_permission`(IN `permission_id` INT, IN `policy` INT, IN `permission` VARCHAR(100), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @permission_id = permission_id;
	SET @policy = policy;
	SET @permission = permission;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblpermission (PERMISSION_ID, POLICY, PERMISSION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@permission_id, @policy, @permission, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_permission_role` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_permission_role`(IN `role_id` VARCHAR(100), IN `permission_id` INT, IN `record_log` VARCHAR(100))
BEGIN
	SET @role_id = role_id;
	SET @permission_id = permission_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblrolepermission (ROLE_ID, PERMISSION_ID, RECORD_LOG) VALUES (@role_id, @permission_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_policy` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_policy`(IN `policy_id` INT, IN `policy` VARCHAR(100), IN `description` VARCHAR(200), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @policy_id = policy_id;
	SET @policy = policy;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblpolicy (POLICY_ID, POLICY, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@policy_id, @policy, @description, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_role` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_role`(IN `role_id` VARCHAR(100), IN `role` VARCHAR(100), IN `description` VARCHAR(100), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @role_id = role_id;
	SET @role = role;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblrole (ROLE_ID, ROLE, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@role_id, @role, @description, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_system_code` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_system_code`(IN `system_type` VARCHAR(100), IN `system_code` VARCHAR(100), IN `description` VARCHAR(100), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @system_type = system_type;
	SET @system_code = system_code;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblsystemcode (SYSTEM_TYPE, SYSTEM_CODE, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@system_type, @system_code, @description, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_system_notification` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_system_notification`(IN `notification_id` INT, IN `notification_from` VARCHAR(100), IN `notification_to` VARCHAR(100), IN `notification_title` VARCHAR(200), IN `notification` VARCHAR(1000), IN `link` VARCHAR(500), IN `notification_date` DATE, IN `notification_time` TIME, IN `record_log` VARCHAR(100))
BEGIN
	SET @notification_id = notification_id;
	SET @notification_from = notification_from;
	SET @notification_to = notification_to;
	SET @notification_title = notification_title;
	SET @notification = notification;
	SET @link = link;
	SET @notification_date = notification_date;
	SET @notification_time = notification_time;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblnotification (NOTIFICATION_ID, NOTIFICATION_FROM, NOTIFICATION_TO, STATUS, NOTIFICATION_TITLE, NOTIFICATION, LINK, NOTIFICATION_DATE, NOTIFICATION_TIME, RECORD_LOG) VALUES(@notification_id, @notification_from, @notification_to, "0", @notification_title, @notification, @link, @notification_date, @notification_time, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_system_parameter` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_system_parameter`(IN `parameter_id` INT, IN `parameter` VARCHAR(100), IN `extension` VARCHAR(10), IN `parameter_number` INT, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @parameter_id = parameter_id;
	SET @parameter = parameter;
	SET @extension = extension;
	SET @parameter_number = parameter_number;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblsystemparameters (PARAMETER_ID, PARAMETER_DESC, PARAMETER_EXTENSION, PARAMETER_NUMBER, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@parameter_id, @parameter, @extension, @parameter_number, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_temporary_attendance_record` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_temporary_attendance_record`(IN employee_id VARCHAR(100), IN time_in_date DATE, IN time_in TIME, IN time_out_date DATE, IN time_out TIME)
BEGIN
	SET @employee_id = employee_id;
	SET @time_in_date = time_in_date;
	SET @time_in = time_in;
	SET @time_out_date = time_out_date;
	SET @time_out = time_out;

	SET @query = 'INSERT INTO temp_attendance_record (EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_OUT_DATE, TIME_OUT) VALUES(@employee_id, @time_in_date, @time_in, @time_out_date, @time_out)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_temporary_employee` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_temporary_employee`(IN employee_id VARCHAR(100), IN id_number VARCHAR(100), IN file_as VARCHAR(500), IN first_name VARCHAR(100), IN middle_name VARCHAR(100), IN last_name VARCHAR(100), IN suffix VARCHAR(20), IN birthday DATE, IN employment_status VARCHAR(50), IN join_date DATE, IN exit_date DATE, IN permanency_date DATE, IN exit_reason VARCHAR(500), IN email VARCHAR(100), IN phone VARCHAR(30), IN telephone VARCHAR(30), IN department VARCHAR(50), IN designation VARCHAR(50), IN branch VARCHAR(50), IN gender VARCHAR(20))
BEGIN
	SET @employee_id = employee_id;
	SET @id_number = id_number;
	SET @file_as = file_as;
	SET @first_name = first_name;
	SET @middle_name = middle_name;
	SET @last_name = last_name;
	SET @suffix = suffix;
	SET @birthday = birthday;
	SET @employment_status = employment_status;
	SET @join_date = join_date;
	SET @exit_date = exit_date;
	SET @permanency_date = permanency_date;
	SET @exit_reason = exit_reason;
	SET @email = email;
	SET @phone = phone;
	SET @telephone = telephone;
	SET @department = department;
	SET @designation = designation;
	SET @branch = branch;
	SET @gender = gender;

	SET @query = 'INSERT INTO temp_employee (EMPLOYEE_ID, ID_NUMBER, FILE_AS, FIRST_NAME, MIDDLE_NAME, LAST_NAME, SUFFIX, BIRTHDAY, EMPLOYMENT_STATUS, JOIN_DATE, EXIT_DATE, PERMANENCY_DATE, EXIT_REASON, EMAIL, PHONE, TELEPHONE, DEPARTMENT, DESIGNATION, BRANCH, GENDER) VALUES(@employee_id, @id_number, @file_as, @first_name, @middle_name, @last_name, @suffix, @birthday, @employment_status, @join_date, @exit_date, @permanency_date, @exit_reason, @email, @phone, @telephone, @department, @designation, @branch, @gender)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_time_in` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_time_in`(IN `attendance_id` VARCHAR(100), IN `employee_id` VARCHAR(100), IN `time_in_date` DATE, IN `time_in` TIME, IN `time_in_locaton` VARCHAR(100), IN `time_in_ip_address` VARCHAR(20), IN `time_in_by` VARCHAR(100), IN `time_in_behavior` VARCHAR(20), IN `time_in_note` VARCHAR(200), IN `late` DOUBLE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @attendance_id = attendance_id;
	SET @employee_id = employee_id;
	SET @time_in_date = time_in_date;
	SET @time_in = time_in;
	SET @time_in_locaton = time_in_locaton;
	SET @time_in_ip_address = time_in_ip_address;
	SET @time_in_by = time_in_by;
	SET @time_in_behavior = time_in_behavior;
	SET @time_in_note = time_in_note;
	SET @late = late;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblattendancerecord (ATTENDANCE_ID, EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_LOCATION, TIME_IN_IP_ADDRESS, TIME_IN_BY, TIME_IN_BEHAVIOR, TIME_IN_NOTE, LATE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@attendance_id, @employee_id, @time_in_date, @time_in, @time_in_locaton, @time_in_ip_address, @time_in_by, @time_in_behavior, @time_in_note, @late, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_transaction_log` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_transaction_log`(IN `transaction_log_id` VARCHAR(500), IN `username` VARCHAR(50), IN `log_type` VARCHAR(100), IN `log_date` DATETIME, IN `log` VARCHAR(4000))
BEGIN
	SET @transaction_log_id = transaction_log_id;
	SET @username = username;
	SET @log_type = log_type;
	SET @log_date = log_date;
	SET @log = log;

	SET @query = 'INSERT INTO tbltransactionlog (TRANSACTION_LOG_ID, USERNAME, LOG_TYPE, LOG_DATE, LOG) VALUES(@transaction_log_id, @username, @log_type, @log_date, @log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_upload_file_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_upload_file_type`(IN `upload_setting_id` INT(50), IN `file_type` VARCHAR(50), IN `record_log` VARCHAR(100))
BEGIN
	SET @upload_setting_id = upload_setting_id;
	SET @file_type = file_type;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tbluploadfiletype (UPLOAD_SETTING_ID, FILE_TYPE, RECORD_LOG) VALUES(@upload_setting_id, @file_type, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_upload_setting` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_upload_setting`(IN `upload_setting_id` INT(50), IN `upload_setting` VARCHAR(200), IN `description` VARCHAR(200), IN `max_file_size` DOUBLE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @upload_setting_id = upload_setting_id;
	SET @upload_setting = upload_setting;
	SET @description = description;
	SET @max_file_size = max_file_size;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tbluploadsetting (UPLOAD_SETTING_ID, UPLOAD_SETTING, DESCRIPTION, MAX_FILE_SIZE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@upload_setting_id, @upload_setting, @description, @max_file_size, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_user_account` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_user_account`(IN `username` VARCHAR(50), IN `password` VARCHAR(200), IN `password_expiry_date` DATE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @username = username;
	SET @password = password;
	SET @password_expiry_date = password_expiry_date;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tbluseraccount (USERNAME, PASSWORD, ACTIVE, PASSWORD_EXPIRY_DATE, FAILED_LOGIN, LAST_FAILED_LOGIN, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@username, @password, 0, @password_expiry_date, 0, null, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_user_interface_settings` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_user_interface_settings`(IN `setting_id` INT, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @setting_id = setting_id;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tbluserinterfacesettings (SETTINGS_ID, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@setting_id, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_user_log` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_user_log`(IN `username` VARCHAR(50), `log_type` VARCHAR(100), `log_date` DATETIME, `log` VARCHAR(4000))
BEGIN
	SET @username = username;
	SET @log_type = log_type;
	SET @log_date = log_date;
	SET @log = log;

	SET @query = 'INSERT INTO tbluserlogs (USERNAME, LOG_TYPE, LOG_DATE, LOG) VALUES(@username, @log_type, @log_date, @log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_user_role` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_user_role`(IN `username` VARCHAR(50), IN `role_id` VARCHAR(50), IN `record_log` VARCHAR(100))
BEGIN
	SET @username = username;
	SET @role_id = role_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblroleuser (ROLE_ID, USERNAME, RECORD_LOG) VALUES(@role_id, @username, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_work_shift` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_work_shift`(IN `work_shift_id` VARCHAR(100), IN `work_shift` VARCHAR(100), IN `work_shift_type` VARCHAR(20), IN `description` VARCHAR(200), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;
	SET @work_shift = work_shift;
	SET @work_shift_type = work_shift_type;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblworkshift (WORK_SHIFT_ID, WORK_SHIFT, WORK_SHIFT_TYPE, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@work_shift_id, @work_shift, @work_shift_type, @description, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_work_shift_schedule` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_work_shift_schedule`(IN `work_shift_id` VARCHAR(100), IN `start_date` DATE, IN `end_date` DATE, IN `monday_start_time` TIME, IN `monday_end_time` TIME, IN `monday_lunch_start_time` TIME, IN `monday_lunch_end_time` TIME, IN `monday_half_day_mark` TIME, IN `tuesday_start_time` TIME, IN `tuesday_end_time` TIME, IN `tuesday_lunch_start_time` TIME, IN `tuesday_lunch_end_time` TIME, IN `tuesday_half_day_mark` TIME, IN `wednesday_start_time` TIME, IN `wednesday_end_time` TIME, IN `wednesday_lunch_start_time` TIME, IN `wednesday_lunch_end_time` TIME, IN `wednesday_half_day_mark` TIME, IN `thursday_start_time` TIME, IN `thursday_end_time` TIME, IN `thursday_lunch_start_time` TIME, IN `thursday_lunch_end_time` TIME, IN `thursday_half_day_mark` TIME, IN `friday_start_time` TIME, IN `friday_end_time` TIME, IN `friday_lunch_start_time` TIME, IN `friday_lunch_end_time` TIME, IN `friday_half_day_mark` TIME, IN `saturday_start_time` TIME, IN `saturday_end_time` TIME, IN `saturday_lunch_start_time` TIME, IN `saturday_lunch_end_time` TIME, IN `saturday_half_day_mark` TIME, IN `sunday_start_time` TIME, IN `sunday_end_time` TIME, IN `sunday_lunch_start_time` TIME, IN `sunday_lunch_end_time` TIME, IN `sunday_half_day_mark` TIME, IN `record_log` VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @monday_start_time = monday_start_time;
	SET @monday_end_time = monday_end_time;
	SET @monday_lunch_start_time = monday_lunch_start_time;
	SET @monday_lunch_end_time = monday_lunch_end_time;
	SET @monday_half_day_mark = monday_half_day_mark;
	SET @tuesday_start_time = tuesday_start_time;
	SET @tuesday_end_time = tuesday_end_time;
	SET @tuesday_lunch_start_time = tuesday_lunch_start_time;
	SET @tuesday_lunch_end_time = tuesday_lunch_end_time;
	SET @tuesday_half_day_mark = tuesday_half_day_mark;
	SET @wednesday_start_time = wednesday_start_time;
	SET @wednesday_end_time = wednesday_end_time;
	SET @wednesday_lunch_start_time = wednesday_lunch_start_time;
	SET @wednesday_lunch_end_time = wednesday_lunch_end_time;
	SET @wednesday_half_day_mark = wednesday_half_day_mark;
	SET @thursday_start_time = wednesday_start_time;
	SET @thursday_end_time = thursday_end_time;
	SET @thursday_lunch_start_time = thursday_lunch_start_time;
	SET @thursday_lunch_end_time = thursday_lunch_end_time;
	SET @thursday_half_day_mark = thursday_half_day_mark;
	SET @friday_start_time = wednesday_start_time;
	SET @friday_end_time = friday_end_time;
	SET @friday_lunch_start_time = friday_lunch_start_time;
	SET @friday_lunch_end_time = friday_lunch_end_time;
	SET @friday_half_day_mark = friday_half_day_mark;
	SET @saturday_start_time = saturday_start_time;
	SET @saturday_end_time = saturday_end_time;
	SET @saturday_lunch_start_time = saturday_lunch_start_time;
	SET @saturday_lunch_end_time = saturday_lunch_end_time;
	SET @saturday_half_day_mark = saturday_half_day_mark;
	SET @sunday_start_time = sunday_start_time;
	SET @sunday_end_time = sunday_end_time;
	SET @sunday_lunch_start_time = sunday_lunch_start_time;
	SET @sunday_lunch_end_time = sunday_lunch_end_time;
	SET @sunday_half_day_mark = sunday_half_day_mark;
	SET @record_log = record_log;
    
		SET @query = 'INSERT INTO tblworkshiftschedule (WORK_SHIFT_ID, START_DATE, END_DATE, MONDAY_START_TIME,MONDAY_END_TIME, MONDAY_LUNCH_START_TIME, MONDAY_LUNCH_END_TIME, MONDAY_HALF_DAY_MARK,TUESDAY_START_TIME,TUESDAY_END_TIME, TUESDAY_LUNCH_START_TIME, TUESDAY_LUNCH_END_TIME, TUESDAY_HALF_DAY_MARK, WEDNESDAY_START_TIME, WEDNESDAY_END_TIME, WEDNESDAY_LUNCH_START_TIME, WEDNESDAY_LUNCH_END_TIME, WEDNESDAY_HALF_DAY_MARK,THURSDAY_START_TIME, THURSDAY_END_TIME, THURSDAY_LUNCH_START_TIME, THURSDAY_LUNCH_END_TIME, THURSDAY_HALF_DAY_MARK,FRIDAY_START_TIME,FRIDAY_END_TIME, FRIDAY_LUNCH_START_TIME, FRIDAY_LUNCH_END_TIME, FRIDAY_HALF_DAY_MARK, SATURDAY_START_TIME, SATURDAY_END_TIME, SATURDAY_LUNCH_START_TIME, SATURDAY_LUNCH_END_TIME, SATURDAY_HALF_DAY_MARK, SUNDAY_START_TIME,SUNDAY_END_TIME, SUNDAY_LUNCH_START_TIME, SUNDAY_LUNCH_END_TIME, SUNDAY_HALF_DAY_MARK, RECORD_LOG) VALUES(@work_shift_id, @start_date, @end_date, @monday_start_time, @monday_end_time, @monday_lunch_start_time, @monday_lunch_end_time, @monday_half_day_mark, @tuesday_start_time, @tuesday_end_time, @tuesday_lunch_start_time, @tuesday_lunch_end_time, @tuesday_half_day_mark, @wednesday_start_time, @wednesday_end_time, @wednesday_lunch_start_time, @wednesday_lunch_end_time, @wednesday_half_day_mark, @thursday_start_time, @thursday_end_time, @thursday_lunch_start_time, @thursday_lunch_end_time, @thursday_half_day_mark, @friday_start_time, @friday_end_time, @friday_lunch_start_time, @friday_lunch_end_time, @friday_half_day_mark, @saturday_start_time, @saturday_end_time, @saturday_lunch_start_time, @saturday_lunch_end_time, @saturday_half_day_mark, @sunday_start_time, @sunday_end_time, @sunday_lunch_start_time, @sunday_lunch_end_time, @sunday_half_day_mark, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `truncate_temporary_table` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `truncate_temporary_table`(IN table_name VARCHAR(50))
BEGIN
	SET @table_name = table_name;
	SET @sub_query = 'TRUNCATE TABLE ';

	SET @query = CONCAT(@sub_query, @table_name);

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_allowance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_allowance`(IN `allowance_id` VARCHAR(100), IN `payroll_date` DATE, IN `amount` DOUBLE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @allowance_id = allowance_id;
	SET @payroll_date = payroll_date;
	SET @amount = amount;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblallowance SET PAYROLL_DATE = @payroll_date, AMOUNT = @amount, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE ALLOWANCE_ID = @allowance_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_allowance_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_allowance_type`(IN `allowance_type_id` VARCHAR(100), IN `allowance_type` VARCHAR(50), IN `taxable` VARCHAR(5), IN `description` VARCHAR(100), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @allowance_type_id = allowance_type_id;
	SET @allowance_type = allowance_type;
	SET @taxable = taxable;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblallowancetype SET ALLOWANCE_TYPE = @allowance_type, TAXABLE = @taxable, DESCRIPTION = @description, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE ALLOWANCE_TYPE_ID = @allowance_type_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_attendance_adjustment` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_attendance_adjustment`(IN `request_id` VARCHAR(100), IN `time_in_date` DATE, IN `time_in` TIME, IN `time_out_date` DATE, IN `time_out` TIME, IN `reason` VARCHAR(500), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @request_id = request_id;
	SET @time_in_date = time_in_date;
	SET @time_in = time_in;
	SET @time_out_date = time_out_date;
	SET @time_out = time_out;
	SET @reason = reason;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblattendanceadjustment SET TIME_IN_DATE_ADJUSTED = @time_in_date, TIME_IN_ADJUSTED = @time_in, TIME_OUT_DATE_ADJUSTED = @time_out_date, TIME_OUT_ADJUSTED = @time_out, REASON = @reason, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE REQUEST_ID = @request_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_attendance_adjustment_file` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_attendance_adjustment_file`(IN `request_id` VARCHAR(100), IN `file_path` VARCHAR(500), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @request_id = request_id;
	SET @file_path = file_path;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblattendanceadjustment SET FILE_PATH = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE REQUEST_ID = @request_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_attendance_adjustment_status` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_attendance_adjustment_status`(IN `request_id` VARCHAR(100), IN `status` VARCHAR(10), IN `decision_remarks` VARCHAR(500), IN `sanction` INT(1), IN `decision_date` DATE, IN `decision_time` TIME, IN `decision_by` VARCHAR(50), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @request_id = request_id;
	SET @status = status;
	SET @decision_remarks = decision_remarks;
	SET @sanction = sanction;
	SET @decision_date = decision_date;
	SET @decision_time = decision_time;
	SET @decision_by = decision_by;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	IF @status = 'APV' THEN
		SET @query = 'UPDATE tblattendanceadjustment SET STATUS = @status, DECISION_REMARKS = @decision_remarks, SANCTION = @sanction, DECISION_DATE = @decision_date, DECISION_TIME = @decision_time, DECISION_BY = @decision_by, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE REQUEST_ID = @request_id';
    ELSEIF @status = 'REJ' OR @status = 'CAN' THEN
		SET @query = 'UPDATE tblattendanceadjustment SET STATUS = @status, DECISION_REMARKS = @decision_remarks, DECISION_DATE = @decision_date, DECISION_TIME = @decision_time, DECISION_BY = @decision_by, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE REQUEST_ID = @request_id';
    ELSEIF @status = 'FRREC' THEN
    	SET @query = 'UPDATE tblattendanceadjustment SET STATUS = @status, FOR_RECOMMENDATION_DATE = @decision_date, FOR_RECOMMENDATION_TIME = @decision_time, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE REQUEST_ID = @request_id';
    ELSEIF @status = 'REC' THEN
    	SET @query = 'UPDATE tblattendanceadjustment SET STATUS = @status, RECOMMENDATION_DATE = @decision_date, RECOMMENDATION_TIME = @decision_time, RECOMMENDED_BY = @decision_by, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE REQUEST_ID = @request_id';
	ELSE
		SET @query = 'UPDATE tblattendanceadjustment SET STATUS = @status, FOR_RECOMMENDATION_DATE = null, FOR_RECOMMENDATION_TIME = null, RECOMMENDATION_DATE = null, RECOMMENDATION_TIME = null, RECOMMENDED_BY = null, DECISION_REMARKS = null, DECISION_DATE = null, DECISION_TIME = null, DECISION_BY = null, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE REQUEST_ID = @request_id';
    END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_attendance_creation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_attendance_creation`(IN `request_id` VARCHAR(100), IN `time_in_date` DATE, IN `time_in` TIME, IN `time_out_date` DATE, IN `time_out` TIME, IN `reason` VARCHAR(500), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @request_id = request_id;
	SET @time_in_date = time_in_date;
	SET @time_in = time_in;
	SET @time_out_date = time_out_date;
	SET @time_out = time_out;
	SET @reason = reason;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblattendancecreation SET TIME_IN_DATE = @time_in_date, TIME_IN = @time_in, TIME_OUT_DATE = @time_out_date, TIME_OUT = @time_out, REASON = @reason, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE REQUEST_ID = @request_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_attendance_creation_file` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_attendance_creation_file`(IN `request_id` VARCHAR(100), IN `file_path` VARCHAR(500), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @request_id = request_id;
	SET @file_path = file_path;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblattendancecreation SET FILE_PATH = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE REQUEST_ID = @request_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_attendance_creation_status` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_attendance_creation_status`(IN `request_id` VARCHAR(100), IN `status` VARCHAR(10), IN `decision_remarks` VARCHAR(500), IN `sanction` INT(1), IN `decision_date` DATE, IN `decision_time` TIME, IN `decision_by` VARCHAR(50), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @request_id = request_id;
	SET @status = status;
	SET @decision_remarks = decision_remarks;
    SET @sanction = sanction;
	SET @decision_date = decision_date;
	SET @decision_time = decision_time;
	SET @decision_by = decision_by;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	IF @status = 'APV'THEN
		SET @query = 'UPDATE tblattendancecreation SET STATUS = @status, DECISION_REMARKS = @decision_remarks, DECISION_DATE = @decision_date, SANCTION = @sanction, DECISION_TIME = @decision_time, DECISION_BY = @decision_by, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE REQUEST_ID = @request_id';
    ELSEIF @status = 'REJ' OR @status = 'CAN' THEN
		SET @query = 'UPDATE tblattendancecreation SET STATUS = @status, DECISION_REMARKS = @decision_remarks, DECISION_DATE = @decision_date, DECISION_TIME = @decision_time, DECISION_BY = @decision_by, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE REQUEST_ID = @request_id';
    ELSEIF @status = 'FRREC' THEN
    	SET @query = 'UPDATE tblattendancecreation SET STATUS = @status, FOR_RECOMMENDATION_DATE = @decision_date, FOR_RECOMMENDATION_TIME = @decision_time, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE REQUEST_ID = @request_id';
    ELSEIF @status = 'REC' THEN
    	SET @query = 'UPDATE tblattendancecreation SET STATUS = @status, RECOMMENDATION_DATE = @decision_date, RECOMMENDATION_TIME = @decision_time, RECOMMENDED_BY = @decision_by, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE REQUEST_ID = @request_id';
	ELSE
		SET @query = 'UPDATE tblattendancecreation SET STATUS = @status, FOR_RECOMMENDATION_DATE = null, FOR_RECOMMENDATION_TIME = null, RECOMMENDATION_DATE = null, RECOMMENDATION_TIME = null, RECOMMENDED_BY = null, DECISION_REMARKS = null, DECISION_DATE = null, DECISION_TIME = null, DECISION_BY = null, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE REQUEST_ID = @request_id';
    END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_attendance_setting` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_attendance_setting`(IN `setting_id` INT, IN `maximum_attendance` INT, IN `time_out_allowance` INT, IN `late_allowance` INT, IN `late_policy` INT, IN `early_leaving_policy` INT, IN `attendance_creation_recommendation` INT(1), IN `attendance_adjustment_recommendation` INT(1), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @setting_id = setting_id;
	SET @maximum_attendance = maximum_attendance;
    SET @time_out_allowance = time_out_allowance;
    SET @late_allowance = late_allowance;
    SET @late_policy = late_policy;
    SET @early_leaving_policy = early_leaving_policy;
    SET @attendance_creation_recommendation = attendance_creation_recommendation;
    SET @attendance_adjustment_recommendation = attendance_adjustment_recommendation;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblattendancesetting SET MAX_ATTENDANCE = @maximum_attendance, TIME_OUT_ALLOWANCE = @time_out_allowance, LATE_ALLOWANCE = @late_allowance, LATE_POLICY = @late_policy, EARLY_LEAVING_POLICY = @early_leaving_policy, ATTENDANCE_CREATION_RECOMMENDATION = @attendance_creation_recommendation, ATTENDANCE_ADJUSTMENT_RECOMMENDATION = @attendance_adjustment_recommendation, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SETTING_ID = @setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_branch` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_branch`(IN `branch_id` VARCHAR(50), IN `branch` VARCHAR(100), IN `email` VARCHAR(50), IN `phone` VARCHAR(30), IN `telephone` VARCHAR(30), IN `address` VARCHAR(500), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @branch_id = branch_id;
	SET @branch = branch;
	SET @email = email;
	SET @phone = phone;
	SET @telephone = telephone;
	SET @address = address;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblbranch SET BRANCH = @branch, EMAIL = @email, PHONE = @phone, TELEPHONE = @telephone, ADDRESS = @address, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE BRANCH_ID = @branch_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_company_setting` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_company_setting`(IN `company_id` VARCHAR(50), IN `company_name` VARCHAR(100), IN `email` VARCHAR(50), IN `telephone` VARCHAR(20), IN `phone` VARCHAR(20), IN `website` VARCHAR(100), IN `address` VARCHAR(200), IN `province_id` INT, IN `city_id` INT, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @company_id = company_id;
	SET @company_name = company_name;
	SET @email = email;
	SET @telephone = telephone;
	SET @phone = phone;
	SET @website = website;
	SET @address = address;
	SET @province_id = province_id;
	SET @city_id = city_id;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblcompany SET COMPANY_NAME = @company_name, EMAIL = @email, TELEPHONE = @telephone, PHONE = @phone, WEBSITE = @website, ADDRESS = @address, PROVINCE_ID = @province_id, CITY_ID = @city_id, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE COMPANY_ID = @company_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_contribution_bracket` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_contribution_bracket`(IN `contribution_bracket_id` VARCHAR(100), IN `start_range` DOUBLE, IN `end_range` DOUBLE, IN `deduction_amount` DOUBLE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @contribution_bracket_id = contribution_bracket_id;
	SET @start_range = start_range;
	SET @end_range = end_range;
	SET @deduction_amount = deduction_amount;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblcontributionbracket SET START_RANGE = @start_range, END_RANGE = @end_range, DEDUCTION_AMOUNT = @deduction_amount, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE CONTRIBUTION_BRACKET_ID = @contribution_bracket_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_contribution_deduction` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_contribution_deduction`(IN `contribution_deduction_id` VARCHAR(100), IN `payroll_date` DATE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @contribution_deduction_id = contribution_deduction_id;
	SET @payroll_date = payroll_date;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblcontributiondeduction SET PAYROLL_DATE = @payroll_date, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE CONTRIBUTION_DEDUCTION_ID = @contribution_deduction_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_deduction` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_deduction`(IN `deduction_id` VARCHAR(100), IN `payroll_date` DATE, IN `amount` DOUBLE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @deduction_id = deduction_id;
	SET @payroll_date = payroll_date;
	SET @amount = amount;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tbldeduction SET PAYROLL_DATE = @payroll_date, AMOUNT = @amount, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE DEDUCTION_ID = @deduction_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_deduction_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_deduction_type`(IN `deduction_type_id` VARCHAR(100), IN `deduction_type` VARCHAR(50), IN `description` VARCHAR(100), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @deduction_type_id = deduction_type_id;
	SET @deduction_type = deduction_type;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tbldeductiontype SET DEDUCTION_TYPE = @deduction_type, DESCRIPTION = @description, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE DEDUCTION_TYPE_ID = @deduction_type_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_department` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_department`(IN `department_id` VARCHAR(50), IN `department` VARCHAR(100), IN `description` VARCHAR(100), IN `department_head` VARCHAR(100), IN `parent_department` VARCHAR(50), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @department_id = department_id;
	SET @department = department;
	SET @description = description;
	SET @department_head = department_head;
	SET @parent_department = parent_department;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tbldepartment SET DEPARTMENT = @department, DESCRIPTION = @description, DEPARTMENT_HEAD = @department_head, PARENT_DEPARTMENT = @parent_department, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE DEPARTMENT_ID = @department_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_designation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_designation`(IN `designation_id` VARCHAR(100), IN `designation` VARCHAR(100), IN `description` VARCHAR(100), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @designation_id = designation_id;
	SET @designation = designation;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tbldesignation SET DESIGNATION = @designation, DESCRIPTION = @description, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE DESIGNATION_ID = @designation_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_designation_file` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_designation_file`(IN `designation_id` VARCHAR(100), IN `file_path` VARCHAR(500), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @designation_id = designation_id;
	SET @file_path = file_path;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tbldesignation SET JOB_DESCRIPTION = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE DESIGNATION_ID = @designation_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_email_configuration` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_email_configuration`(IN `mail_id` INT, IN `mail_host` VARCHAR(100), IN `port` INT, IN `smtp_auth` INT(1), IN `smtp_auto_tls` INT(1), IN `username` VARCHAR(200), IN `password` VARCHAR(200), IN `mail_encryption` VARCHAR(20), IN `mail_from_name` VARCHAR(200), IN `mail_from_email` VARCHAR(200), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @mail_id = mail_id;
	SET @mail_host = mail_host;
	SET @port = port;
	SET @smtp_auth = smtp_auth;
	SET @smtp_auto_tls = smtp_auto_tls;
	SET @username = username;
	SET @password = password;
	SET @mail_encryption = mail_encryption;
	SET @mail_from_name = mail_from_name;
	SET @mail_from_email = mail_from_email;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	IF @password IS NULL OR @password = '' THEN
		SET @query = 'UPDATE tblmailconfig SET MAIL_HOST = @mail_host, PORT = @port, SMTP_AUTH = @smtp_auth, SMTP_AUTO_TLS = @smtp_auto_tls, USERNAME = @username, MAIL_ENCRYPTION = @mail_encryption, MAIL_FROM_NAME = @mail_from_name, MAIL_FROM_EMAIL = @mail_from_email, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE MAIL_ID = @mail_id';
	ELSE
		SET @query = 'UPDATE tblmailconfig SET MAIL_HOST = @mail_host, PORT = @port, SMTP_AUTH = @smtp_auth, SMTP_AUTO_TLS = @smtp_auto_tls, USERNAME = @username, PASSWORD = @password, MAIL_ENCRYPTION = @mail_encryption, MAIL_FROM_NAME = @mail_from_name, MAIL_FROM_EMAIL = @mail_from_email, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE MAIL_ID = @mail_id';
    END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_emergency_contact` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_emergency_contact`(IN `contact_id` VARCHAR(100), IN `contact_name` VARCHAR(300), IN `relationship` VARCHAR(20), IN `email` VARCHAR(100), IN `phone` VARCHAR(30), IN `telephone` VARCHAR(30), IN `address` VARCHAR(200), IN `city` INT, IN `province` INT, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @contact_id = contact_id;
	SET @contact_name = contact_name;
	SET @relationship = relationship;
	SET @email = email;
	SET @phone = phone;
	SET @telephone = telephone;
	SET @address = address;
	SET @city = city;
	SET @province = province;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblemergencycontact SET NAME = @contact_name, RELATIONSHIP = @relationship, EMAIL = @email, PHONE = @phone, TELEPHONE = @telephone, ADDRESS = @address, CITY = @city, PROVINCE = @province, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE CONTACT_ID = @contact_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_employee` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_employee`(IN `employee_id` VARCHAR(100), IN `file_as` VARCHAR(500), IN `first_name` VARCHAR(100), IN `middle_name` VARCHAR(100), IN `last_name` VARCHAR(100), IN `suffix` VARCHAR(20), IN `birthday` DATE, IN `employment_status` VARCHAR(50), IN `joining_date` DATE, IN `permanency_date` DATE, IN `exit_date` DATE, IN `exit_reason` VARCHAR(500), IN `email` VARCHAR(100), IN `phone` VARCHAR(30), IN `telephone` VARCHAR(30), IN `department` VARCHAR(50), IN `designation` VARCHAR(50), IN `branch` VARCHAR(50), IN `gender` VARCHAR(20), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;
	SET @file_as = file_as;
	SET @first_name = first_name;
	SET @middle_name = middle_name;
	SET @last_name = last_name;
	SET @suffix = suffix;
	SET @birthday = birthday;
	SET @employment_status = employment_status;
	SET @joining_date = joining_date;
	SET @permanency_date = permanency_date;
	SET @exit_date = exit_date;
	SET @exit_reason = exit_reason;
	SET @email = email;
	SET @phone = phone;
	SET @telephone = telephone;
	SET @department = department;
	SET @designation = designation;
	SET @branch = branch;
	SET @gender = gender;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblemployee SET FILE_AS = @file_as, FIRST_NAME = @first_name, MIDDLE_NAME = @middle_name, LAST_NAME = @last_name, SUFFIX = @suffix, BIRTHDAY = @birthday, EMPLOYMENT_STATUS = @employment_status, JOIN_DATE = @joining_date, PERMANENCY_DATE = @permanency_date, EXIT_DATE = @exit_date, EXIT_REASON = @exit_reason, EMAIL = @email, PHONE = @phone, TELEPHONE = @telephone, DEPARTMENT = @department, DESIGNATION = @designation, BRANCH = @branch, GENDER = @gender, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE EMPLOYEE_ID = @employee_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_employee_address` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_employee_address`(IN `address_id` VARCHAR(100), IN `address_type` VARCHAR(20), IN `address` VARCHAR(200), IN `city` INT, IN `province` INT, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @address_id = address_id;
	SET @address_type = address_type;
	SET @address = address;
	SET @city = city;
	SET @province = province;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblemployeeaddress SET ADDRESS_TYPE = @address_type, ADDRESS = @address, CITY = @city, PROVINCE = @province, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE ADDRESS_ID = @address_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_employee_file` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_employee_file`(IN `file_id` VARCHAR(50), IN `file_path` VARCHAR(500), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @file_id = file_id;
	SET @file_path = file_path;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblemployeefile SET FILE_PATH = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE FILE_ID = @file_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_employee_file_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_employee_file_details`(IN `file_id` VARCHAR(50), IN `file_name` VARCHAR(100), IN `file_category` VARCHAR(50), IN `remarks` VARCHAR(100), IN `file_date` DATE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @file_id = file_id;
	SET @file_name = file_name;
	SET @file_category = file_category;
	SET @remarks = remarks;
	SET @file_date = file_date;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblemployeefile SET FILE_NAME = @file_name, FILE_CATEGORY = @file_category, REMARKS = @remarks, FILE_DATE = @file_date, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE FILE_ID = @file_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_employee_social` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_employee_social`(IN `social_id` VARCHAR(100), IN `social_type` VARCHAR(20), IN `link` VARCHAR(300), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @social_id = social_id;
	SET @social_type = social_type;
	SET @link = link;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblemployeesocial SET SOCIAL_TYPE = @social_type, LINK = @link, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SOCIAL_ID = @social_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_employee_user_account` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_employee_user_account`(IN `employee_id` VARCHAR(100), IN `username` VARCHAR(50), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;
	SET @username = username;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblemployee SET USERNAME = @username, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE EMPLOYEE_ID = @employee_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_employment_status` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_employment_status`(IN `employment_status_id` VARCHAR(50), IN `employment_status` VARCHAR(100), IN `description` VARCHAR(100), IN `color_value` VARCHAR(20), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @employment_status_id = employment_status_id;
	SET @employment_status = employment_status;
	SET @description = description;
	SET @color_value = color_value;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblemploymentstatus SET EMPLOYMENT_STATUS = @employment_status, DESCRIPTION = @description, COLOR_VALUE = @color_value, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE EMPLOYMENT_STATUS_ID = @employment_status_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_government_contribution` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_government_contribution`(IN `government_contribution_id` VARCHAR(100), IN `government_contribution` VARCHAR(50), IN `description` VARCHAR(100), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @government_contribution_id = government_contribution_id;
	SET @government_contribution = government_contribution;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblgovernmentcontribution SET GOVERNMENT_CONTRIBUTION = @government_contribution, DESCRIPTION = @description, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE GOVERNMENT_CONTRIBUTION_ID = @government_contribution_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_holiday` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_holiday`(IN `holiday_id` VARCHAR(50), IN `holiday` VARCHAR(200), IN `holiday_date` DATE, IN `holiday_type` VARCHAR(20), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @holiday_id = holiday_id;
	SET @holiday = holiday;
	SET @holiday_date = holiday_date;
	SET @holiday_type = holiday_type;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblholiday SET HOLIDAY = @holiday, HOLIDAY_DATE = @holiday_date, HOLIDAY_TYPE = @holiday_type, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE HOLIDAY_ID = @holiday_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_leave_entitlement` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_leave_entitlement`(IN `leave_entitlement_id` VARCHAR(50), IN `no_leaves` DOUBLE, IN `start_date` DATE, IN `end_date` DATE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @leave_entitlement_id = leave_entitlement_id;
	SET @no_leaves = no_leaves;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblleaveentitlement SET NO_LEAVES = @no_leaves, START_DATE = @start_date, END_DATE = @end_date, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE LEAVE_ENTITLEMENT_ID = @leave_entitlement_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_leave_entitlement_count` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_leave_entitlement_count`(IN `leave_entitlement_id` VARCHAR(50), IN `total_hours` DOUBLE, IN `record_log` VARCHAR(100))
BEGIN
	SET @leave_entitlement_id = leave_entitlement_id;
	SET @total_hours = total_hours;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblleaveentitlement SET ACQUIRED_LEAVES = (ACQUIRED_LEAVES + @total_hours), RECORD_LOG = @record_log WHERE LEAVE_ENTITLEMENT_ID = @leave_entitlement_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_leave_file` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_leave_file`(IN `leave_id` VARCHAR(50), IN `file_path` VARCHAR(500), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @leave_id = leave_id;
	SET @file_path = file_path;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblleave SET FILE_PATH = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE LEAVE_ID = @leave_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_leave_status` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_leave_status`(IN `leave_id` VARCHAR(50), IN `leave_status` VARCHAR(10), IN `decision_remarks` VARCHAR(500), IN `decision_date` DATE, IN `decision_time` TIME, IN `decision_by` VARCHAR(50), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @leave_id = leave_id;
	SET @leave_status = leave_status;
	SET @decision_remarks = decision_remarks;
	SET @decision_date = decision_date;
	SET @decision_time = decision_time;
	SET @decision_by = decision_by;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblleave SET LEAVE_STATUS = @leave_status, DECISION_REMARKS = @decision_remarks, DECISION_DATE = @decision_date, DECISION_TIME = @decision_time, DECISION_BY = @decision_by, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE LEAVE_ID = @leave_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_leave_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_leave_type`(IN `leave_type_id` VARCHAR(50), IN `leave_name` VARCHAR(100), IN `description` VARCHAR(200), IN `no_leaves` DOUBLE, IN `paid_status` VARCHAR(20), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @leave_type_id = leave_type_id;
	SET @leave_name = leave_name;
	SET @description = description;
	SET @no_leaves = no_leaves;
	SET @paid_status = paid_status;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblleavetype SET LEAVE_NAME = @leave_name, DESCRIPTION = @description, NO_LEAVES = @no_leaves, PAID_STATUS = @paid_status, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE LEAVE_TYPE_ID = @leave_type_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_login_attempt` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_login_attempt`(IN `username` VARCHAR(50), `login_attemp` INT(1), `last_failed_attempt_date` DATE)
BEGIN
	SET @username = username;
	SET @login_attemp = login_attemp;
	SET @last_failed_attempt_date = last_failed_attempt_date;

	SET @query = 'UPDATE tbluseraccount SET FAILED_LOGIN = @login_attemp, LAST_FAILED_LOGIN = @last_failed_attempt_date WHERE USERNAME = @username';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_manual_employee_attendance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_manual_employee_attendance`(IN `attendance_id` VARCHAR(100), IN `time_in_date` DATE, IN `time_in` TIME, IN `time_in_behavior` VARCHAR(10), IN `time_out_date` DATE, IN `time_out` TIME, IN `time_out_behavior` VARCHAR(10), IN `late` DOUBLE, IN `early_leaving` DOUBLE, IN `overtime` DOUBLE, IN `total_hours_worked` DOUBLE, IN `remarks` VARCHAR(500), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @attendance_id = attendance_id;
	SET @time_in_date = time_in_date;
	SET @time_in = time_in;
	SET @time_in_behavior = time_in_behavior;
	SET @time_out_date = time_out_date;
	SET @time_out = time_out;
	SET @time_out_behavior = time_out_behavior;
	SET @late = late;
	SET @early_leaving = early_leaving;
	SET @overtime = overtime;
	SET @total_hours_worked = total_hours_worked;
	SET @remarks = remarks;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblattendancerecord SET TIME_IN_DATE = @time_in_date, TIME_IN = @time_in, TIME_IN_BEHAVIOR = @time_in_behavior, TIME_OUT_DATE = @time_out_date, TIME_OUT = @time_out, TIME_OUT_BEHAVIOR = @time_out_behavior, LATE = @late, EARLY_LEAVING = @early_leaving, OVERTIME = @overtime, TOTAL_WORKING_HOURS = @total_hours_worked, REMARKS = @remarks, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE ATTENDANCE_ID = @attendance_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_notification_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_notification_details`(IN `notification_id` INT, IN `notification_title` VARCHAR(500), IN `notification_message` VARCHAR(500), IN `system_link` VARCHAR(200), IN `web_link` VARCHAR(200), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @notification_id = notification_id;
	SET @notification_title = notification_title;
	SET @notification_message = notification_message;
	SET @system_link = system_link;
	SET @web_link = web_link;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblnotificationdetails SET NOTIFICATION_TITLE = @notification_title, NOTIFICATION_MESSAGE = @notification_message, SYSTEM_LINK = @system_link, WEB_LINK = @web_link, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE NOTIFICATION_ID = @notification_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_notification_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_notification_type`(IN `notification_id` INT, IN `notification` VARCHAR(100), IN `description` VARCHAR(200), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @notification_id = notification_id;
	SET @notification = notification;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblnotificationtype SET NOTIFICATION = @notification, DESCRIPTION = @description, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE NOTIFICATION_ID = @notification_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_permission` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_permission`(IN `permission_id` INT, IN `policy` INT, IN `permission` VARCHAR(100), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @permission_id = permission_id;
	SET @permission = permission;
	SET @policy = policy;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblpermission SET POLICY = @policy, PERMISSION = @permission, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE PERMISSION_ID = @permission_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_policy` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_policy`(IN `policy_id` INT, IN `policy` VARCHAR(100), IN `description` VARCHAR(200), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @policy_id = policy_id;
	SET @policy = policy;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblpolicy SET POLICY = @policy, DESCRIPTION = @description, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE POLICY_ID = @policy_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_role` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_role`(IN `role_id` VARCHAR(100), IN `role` VARCHAR(100), IN `description` VARCHAR(100), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @role_id = role_id;
	SET @role = role;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblrole SET ROLE = @role, DESCRIPTION = @description, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE ROLE_ID = @role_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_system_code` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_system_code`(IN `system_type` VARCHAR(100), IN `system_code` VARCHAR(100), IN `description` VARCHAR(100), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @system_type = system_type;
	SET @system_code = system_code;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblsystemcode SET DESCRIPTION = @description, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SYSTEM_TYPE = @system_type AND SYSTEM_CODE = @system_code';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_system_parameter` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_system_parameter`(IN `parameter_id` INT, IN `parameter` VARCHAR(100), IN `extension` VARCHAR(10), IN `parameter_number` INT, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @parameter_id = parameter_id;
	SET @parameter = parameter;
	SET @extension = extension;
	SET @parameter_number = parameter_number;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblsystemparameters SET PARAMETER_DESC = @parameter, PARAMETER_EXTENSION = @extension, PARAMETER_NUMBER = @parameter_number, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE PARAMETER_ID = @parameter_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_system_parameter_value` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_system_parameter_value`(IN `parameter_id` INT, IN `parameter_number` INT, IN `record_log` VARCHAR(100))
BEGIN
	SET @parameter_id = parameter_id;
	SET @parameter_number = parameter_number;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblsystemparameters SET PARAMETER_NUMBER = @parameter_number, RECORD_LOG = @record_log WHERE PARAMETER_ID = @parameter_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_time_out` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_time_out`(IN `attendance_id` VARCHAR(100), IN `time_out_date` DATE, IN `time_out` TIME, IN `time_out_locaton` VARCHAR(100), IN `time_out_ip_address` VARCHAR(20), IN `time_out_by` VARCHAR(100), IN `time_out_behavior` VARCHAR(20), IN `time_out_note` VARCHAR(200), IN `early_leaving` DOUBLE, IN `overtime` DOUBLE, IN `total_working_hours` DOUBLE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @attendance_id = attendance_id;
	SET @time_out_date = time_out_date;
	SET @time_out = time_out;
	SET @time_out_locaton = time_out_locaton;
	SET @time_out_ip_address = time_out_ip_address;
	SET @time_out_by = time_out_by;
	SET @time_out_behavior = time_out_behavior;
	SET @time_out_note = time_out_note;
	SET @early_leaving = early_leaving;
	SET @overtime = overtime;
	SET @total_working_hours = total_working_hours;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblattendancerecord SET TIME_OUT_DATE = @time_out_date, TIME_OUT = @time_out, TIME_OUT_LOCATION = @time_out_locaton, TIME_OUT_IP_ADDRESS = @time_out_ip_address, TIME_OUT_BY = @time_out_by, TIME_OUT_BEHAVIOR = @time_out_behavior, TIME_OUT_NOTE = @time_out_note, EARLY_LEAVING = @early_leaving, OVERTIME = @overtime, TOTAL_WORKING_HOURS = @total_working_hours, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE ATTENDANCE_ID = @attendance_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_upload_setting` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_upload_setting`(IN `upload_setting_id` INT(50), IN `upload_setting` VARCHAR(200), IN `description` VARCHAR(200), IN `max_file_size` DOUBLE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @upload_setting_id = upload_setting_id;
	SET @upload_setting = upload_setting;
	SET @description = description;
	SET @max_file_size = max_file_size;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tbluploadsetting SET UPLOAD_SETTING = @upload_setting, DESCRIPTION = @description, MAX_FILE_SIZE = @max_file_size, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE UPLOAD_SETTING_ID = @upload_setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_user_account` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_user_account`(IN `username` VARCHAR(50), IN `password` VARCHAR(200), IN `password_expiry_date` DATE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @username = username;
	SET @password = password;
	SET @password_expiry_date = password_expiry_date;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	IF @password IS NULL OR @password = '' THEN
		SET @query = 'UPDATE tbluseraccount SET TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE USERNAME = @username';
	ELSE
		SET @query = 'UPDATE tbluseraccount SET PASSWORD = @password, PASSWORD_EXPIRY_DATE = @password_expiry_date, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE USERNAME = @username';
    END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_user_account_lock_status` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_user_account_lock_status`(IN `username` VARCHAR(50), IN `transaction_type` VARCHAR(10), IN `last_failed_login` DATE, IN `record_log` VARCHAR(100))
BEGIN
	SET @username = username;
	SET @transaction_type = transaction_type;
	SET @last_failed_login = last_failed_login;
	SET @record_log = record_log;

	IF @transaction_type = 'unlock' THEN
		SET @query = 'UPDATE tbluseraccount SET FAILED_LOGIN = 0, LAST_FAILED_LOGIN = null, RECORD_LOG = @record_log WHERE USERNAME = @username';
	ELSE
		SET @query = 'UPDATE tbluseraccount SET FAILED_LOGIN = 5, LAST_FAILED_LOGIN = @last_failed_login, RECORD_LOG = @record_log WHERE USERNAME = @username';
    END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_user_account_status` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_user_account_status`(IN `username` VARCHAR(50), IN `active` INT(1), IN `record_log` VARCHAR(100))
BEGIN
	SET @username = username;
	SET @active = active;
	SET @record_log = record_log;

	SET @query = 'UPDATE tbluseraccount SET ACTIVE = @active, RECORD_LOG = @record_log WHERE USERNAME = @username';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_user_interface_settings_images` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_user_interface_settings_images`(IN `setting_id` INT, IN `file_path` VARCHAR(500), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100), IN `request_type` VARCHAR(20))
BEGIN
	SET @setting_id = setting_id;
	SET @file_path = file_path;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;
	SET @request_type = request_type;

	IF @request_type = 'login background' THEN
		SET @query = 'UPDATE tbluserinterfacesettings SET LOGIN_BG = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SETTINGS_ID = @setting_id';
	ELSEIF @request_type = 'logo light' THEN
		SET @query = 'UPDATE tbluserinterfacesettings SET LOGO_LIGHT = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SETTINGS_ID = @setting_id';
	ELSEIF @request_type = 'logo dark' THEN
		SET @query = 'UPDATE tbluserinterfacesettings SET LOGO_DARK = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SETTINGS_ID = @setting_id';
	ELSEIF @request_type = 'logo icon light' THEN
		SET @query = 'UPDATE tbluserinterfacesettings SET LOGO_ICON_LIGHT = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SETTINGS_ID = @setting_id';
	ELSEIF @request_type = 'logo icon dark' THEN
		SET @query = 'UPDATE tbluserinterfacesettings SET LOGO_ICON_DARK = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SETTINGS_ID = @setting_id';
	ELSE
		SET @query = 'UPDATE tbluserinterfacesettings SET FAVICON = @file_path, TRANSACTION_LOG_ID = @transaction_log_id RECORD_LOG = @record_log WHERE SETTINGS_ID = @setting_id';
    END IF;

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_user_password` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_user_password`(IN `username` VARCHAR(50), `password` VARCHAR(200), `password_expiry_date` DATE)
BEGIN
	SET @username = username;
	SET @password = password;
	SET @password_expiry_date = password_expiry_date;

	SET @query = 'UPDATE tbluseraccount SET PASSWORD = @password, PASSWORD_EXPIRY_DATE = @password_expiry_date WHERE USERNAME = @username';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_work_shift` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_work_shift`(IN `work_shift_id` VARCHAR(100), IN `work_shift` VARCHAR(100), IN `work_shift_type` VARCHAR(20), IN `description` VARCHAR(200), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;
	SET @work_shift = work_shift;
	SET @work_shift_type = work_shift_type;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblworkshift SET WORK_SHIFT = @work_shift, WORK_SHIFT_TYPE = @work_shift_type, DESCRIPTION = @description, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_work_shift_schedule` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_work_shift_schedule`(IN `work_shift_id` VARCHAR(100), IN `start_date` DATE, IN `end_date` DATE, IN `monday_start_time` TIME, IN `monday_end_time` TIME, IN `monday_lunch_start_time` TIME, IN `monday_lunch_end_time` TIME, IN `monday_half_day_mark` TIME, IN `tuesday_start_time` TIME, IN `tuesday_end_time` TIME, IN `tuesday_lunch_start_time` TIME, IN `tuesday_lunch_end_time` TIME, IN `tuesday_half_day_mark` TIME, IN `wednesday_start_time` TIME, IN `wednesday_end_time` TIME, IN `wednesday_lunch_start_time` TIME, IN `wednesday_lunch_end_time` TIME, IN `wednesday_half_day_mark` TIME, IN `thursday_start_time` TIME, IN `thursday_end_time` TIME, IN `thursday_lunch_start_time` TIME, IN `thursday_lunch_end_time` TIME, IN `thursday_half_day_mark` TIME, IN `friday_start_time` TIME, IN `friday_end_time` TIME, IN `friday_lunch_start_time` TIME, IN `friday_lunch_end_time` TIME, IN `friday_half_day_mark` TIME, IN `saturday_start_time` TIME, IN `saturday_end_time` TIME, IN `saturday_lunch_start_time` TIME, IN `saturday_lunch_end_time` TIME, IN `saturday_half_day_mark` TIME, IN `sunday_start_time` TIME, IN `sunday_end_time` TIME, IN `sunday_lunch_start_time` TIME, IN `sunday_lunch_end_time` TIME, IN `sunday_half_day_mark` TIME, IN `record_log` VARCHAR(100))
BEGIN
	SET @work_shift_id = work_shift_id;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @monday_start_time = monday_start_time;
	SET @monday_end_time = monday_end_time;
	SET @monday_lunch_start_time = monday_lunch_start_time;
	SET @monday_lunch_end_time = monday_lunch_end_time;
	SET @monday_half_day_mark = monday_half_day_mark;
	SET @tuesday_start_time = tuesday_start_time;
	SET @tuesday_end_time = tuesday_end_time;
	SET @tuesday_lunch_start_time = tuesday_lunch_start_time;
	SET @tuesday_lunch_end_time = tuesday_lunch_end_time;
	SET @tuesday_half_day_mark = tuesday_half_day_mark;
	SET @wednesday_start_time = wednesday_start_time;
	SET @wednesday_end_time = wednesday_end_time;
	SET @wednesday_lunch_start_time = wednesday_lunch_start_time;
	SET @wednesday_lunch_end_time = wednesday_lunch_end_time;
	SET @wednesday_half_day_mark = wednesday_half_day_mark;
	SET @thursday_start_time = wednesday_start_time;
	SET @thursday_end_time = thursday_end_time;
	SET @thursday_lunch_start_time = thursday_lunch_start_time;
	SET @thursday_lunch_end_time = thursday_lunch_end_time;
	SET @thursday_half_day_mark = thursday_half_day_mark;
	SET @friday_start_time = wednesday_start_time;
	SET @friday_end_time = friday_end_time;
	SET @friday_lunch_start_time = friday_lunch_start_time;
	SET @friday_lunch_end_time = friday_lunch_end_time;
	SET @friday_half_day_mark = friday_half_day_mark;
	SET @saturday_start_time = saturday_start_time;
	SET @saturday_end_time = saturday_end_time;
	SET @saturday_lunch_start_time = saturday_lunch_start_time;
	SET @saturday_lunch_end_time = saturday_lunch_end_time;
	SET @saturday_half_day_mark = saturday_half_day_mark;
	SET @sunday_start_time = sunday_start_time;
	SET @sunday_end_time = sunday_end_time;
	SET @sunday_lunch_start_time = sunday_lunch_start_time;
	SET @sunday_lunch_end_time = sunday_lunch_end_time;
	SET @sunday_half_day_mark = sunday_half_day_mark;
	SET @record_log = record_log;
    
	SET @query = 'UPDATE tblworkshiftschedule SET START_DATE = @start_date, END_DATE = @end_date, MONDAY_START_TIME = @monday_start_time, MONDAY_END_TIME = @monday_end_time, MONDAY_LUNCH_START_TIME = @monday_lunch_start_time, MONDAY_LUNCH_END_TIME = @monday_lunch_end_time, MONDAY_HALF_DAY_MARK = @monday_half_day_mark, TUESDAY_START_TIME = @tuesday_start_time, TUESDAY_END_TIME = @tuesday_end_time, TUESDAY_LUNCH_START_TIME = @tuesday_lunch_start_time, TUESDAY_LUNCH_END_TIME = @tuesday_lunch_end_time, TUESDAY_HALF_DAY_MARK = @tuesday_half_day_mark, WEDNESDAY_START_TIME = @wednesday_start_time, WEDNESDAY_END_TIME = @wednesday_end_time, WEDNESDAY_LUNCH_START_TIME = @wednesday_lunch_start_time, WEDNESDAY_LUNCH_END_TIME = @wednesday_lunch_end_time, WEDNESDAY_HALF_DAY_MARK = @wednesday_half_day_mark, THURSDAY_START_TIME = @thursday_start_time, THURSDAY_END_TIME = @thursday_end_time, THURSDAY_LUNCH_START_TIME = @thursday_lunch_start_time, THURSDAY_LUNCH_END_TIME = @thursday_lunch_end_time, THURSDAY_HALF_DAY_MARK = @thursday_half_day_mark, FRIDAY_START_TIME = @friday_start_time, FRIDAY_END_TIME = @friday_end_time, FRIDAY_LUNCH_START_TIME = @friday_lunch_start_time, FRIDAY_LUNCH_END_TIME = @friday_lunch_end_time, FRIDAY_HALF_DAY_MARK = @friday_half_day_mark, SATURDAY_START_TIME = @saturday_start_time, SATURDAY_END_TIME = @saturday_end_time, SATURDAY_LUNCH_START_TIME = @saturday_lunch_start_time, SATURDAY_LUNCH_END_TIME = @saturday_lunch_end_time, SATURDAY_HALF_DAY_MARK = @saturday_half_day_mark, SUNDAY_START_TIME = @sunday_start_time, SUNDAY_END_TIME = @sunday_end_time, SUNDAY_LUNCH_START_TIME = @sunday_lunch_start_time, SUNDAY_LUNCH_END_TIME = @sunday_lunch_end_time, SUNDAY_HALF_DAY_MARK = @sunday_half_day_mark, RECORD_LOG = @record_log WHERE WORK_SHIFT_ID = @work_shift_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-19 17:37:36
