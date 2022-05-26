-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: worknestdb
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
  `PAYROLL_ID` varchar(100) DEFAULT NULL,
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
  `OVERTIME_POLICY` int(11) DEFAULT NULL,
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
INSERT INTO `tblattendancesetting` VALUES (1,1,1,1,30,30,60,1,1,'TL-502','UPD->LDAGULTO->2022-05-02 11:12:49');
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
  `COMPANY_LOGO` varchar(500) DEFAULT NULL,
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
INSERT INTO `tblcompany` VALUES ('1','Encore Leasing and Finance Corporation','customercare@encorefinancials.com','0449405625','09178389361','http://www.encorefinancials.com','Km 114',13,257,'./assets/images/company/hwy66ay15c.png','TL-501','UPD->LDAGULTO->2022-05-22 09:31:55');
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
  `GOVERNMENT_CONTRIBUTION_TYPE` varchar(100) NOT NULL,
  `PAYROLL_ID` varchar(100) DEFAULT NULL,
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
  `PAYROLL_ID` varchar(100) DEFAULT NULL,
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
INSERT INTO `tblmailconfig` VALUES (1,'mail.encorefinancials.com',26,1,0,'encore-noreply@encorefinancials.com','4288c70b3967d16556906334','None','Encore Notification','encore-noreply@encorefinancials.com','TL-503','UPD->LDAGULTO->2022-02-22 02:32:26');
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
INSERT INTO `tblnotificationdetails` VALUES (1,'Attendance Time In','You time in on {date} at {time}.','attendance-record.php','https://127.0.0.0/worknest/employee-attendance-record.php','TL-523','INS->LDAGULTO->2022-03-18 10:03:46'),(2,'Time Out Notification','You time out on {date} on {time}.','employee-attendance-record.php','http://127.0.0.0/worknest/employee-attendance-record.php','TL-524','INS->LDAGULTO->2022-03-18 10:04:38'),(3,'Attendance Creation For Recommendation Notification','There is an attendance creation for recommendation coming from {name}.','attendance-creation-recommendation.php','http://127.0.0.0/worknest/attendance-creation-recommendation.php','TL-525','UPD->LDAGULTO->2022-03-18 10:10:23'),(4,'Attendance Adjustment For Recommendation Notification','There is an attendance adjustment for recommendation coming from {name}.','attendance-adjustment-recommendation.php','http://127.0.0.0/worknest/attendance-adjustment-recommendation.php','TL-526','INS->LDAGULTO->2022-03-18 10:11:35'),(5,'Attendance Creation Recommendation Notification','Your attendance creation was recommended by {name}.','attendance-creation.php','http://127.0.0.0/worknest/attendance-creation.php','TL-527','UPD->LDAGULTO->2022-03-23 09:29:15'),(6,'Attendance Adjustment Recommendation Notification','Your attendance adjustment was recommended by {name}.','attendance-adjustment.php','http://127.0.0.0/worknest/attendance-adjustment.php','TL-528','UPD->LDAGULTO->2022-03-23 09:29:46'),(7,'Attendance Creation Cancellation Notification','The attendance adjustment has been cancelled by {name}.','attendance-creation.php','http://127.0.0.0/worknest/attendance-creation.php','TL-529','UPD->LDAGULTO->2022-03-21 05:38:29'),(8,'Attendance Adjustment Cancellation Notification','The attendance adjustment has been cancelled by {name}.','attendance-adjustment.php','http://127.0.0.0/worknest/attendance-adjustment.php','TL-530','INS->LDAGULTO->2022-03-21 08:46:41'),(9,'Attendance Creation For Approval Notification','There is an attendance creation for approval from {name}.','attendance-creation-approval.php','http://127.0.0.0/worknest/attendance-creation-approval.php','TL-531','UPD->LDAGULTO->2022-03-21 05:39:14'),(10,'Attendance Adjustment For Approval Notification','There is an attendance adjustment for approval from {name}.','attendance-adjustment-approval.php','http://127.0.0.0/worknest/attendance-adjustment-approval.php','TL-532','UPD->LDAGULTO->2022-03-21 05:37:33'),(11,'Attendance Creation Rejection Notification','The attendance creation has been rejected by {name}.','attendance-creation.php','http://127.0.0.0/worknest/attendance-creation.php','TL-533','INS->LDAGULTO->2022-03-23 09:28:36'),(12,'Attendance Adjustment Rejection Notification','The attendance adjustment has been rejected by {name}.','attendance-adjustment.php','http://127.0.0.0/worknest/attendance-adjustment.php','TL-534','INS->LDAGULTO->2022-03-23 09:30:11'),(13,'Attendance Creation Approval Notification','The attendance creation has been approved by {name}.','attendance-creation.php','http://127.0.0.0/worknest/attendance-creation.php','TL-535','UPD->LDAGULTO->2022-03-23 09:35:22'),(14,'Attendance Adjustment Approval Notification','The attendance adjustment has been approved by {name}.','attendance-adjustment.php','http://127.0.0.0/worknest/attendance-adjustment.php','TL-536','INS->LDAGULTO->2022-03-23 09:35:11'),(15,'Leave Application Notification','There is a leave for approval from {name}.','leave-approval.php','http://127.0.0.0/worknest/leave-approval.php','TL-537','INS->LDAGULTO->2022-03-30 01:52:09'),(16,'Leave Approval Notification','The leave has been approved by {name}.','employee-leave-management.php','http://127.0.0.0/worknest/employee-leave-management.php','TL-538','INS->LDAGULTO->2022-03-30 04:30:25'),(17,'Leave Rejection Notification','The leave has been rejected by {name}.','employee-leave-management.php','http://127.0.0.0/worknest/employee-leave-management.php','TL-539','INS->LDAGULTO->2022-03-30 04:31:05'),(18,'Leave Cancellation Notification','The leave has been cancelled by {name}.','employee-leave-management.php','http://127.0.0.0/worknest/employee-leave-management.php','TL-540','INS->LDAGULTO->2022-03-30 04:31:25'),(19,'Payslip Notification','You can now view your latest payslip ({coverage_date}).','profile.php','http://127.0.0.0/worknest/profile.php','TL-541','UPD->LDAGULTO->2022-05-25 11:38:16');
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
INSERT INTO `tblnotificationrecipient` VALUES (10,'7','INS->LDAGULTO->2022-03-21 05:37:33'),(7,'','INS->LDAGULTO->2022-03-21 05:38:29'),(9,'7','INS->LDAGULTO->2022-03-21 05:39:14'),(11,'','INS->LDAGULTO->2022-03-23 09:28:37'),(5,'','INS->LDAGULTO->2022-03-23 09:29:15'),(6,'','INS->LDAGULTO->2022-03-23 09:29:46'),(12,'','INS->LDAGULTO->2022-03-23 09:30:11'),(14,'','INS->LDAGULTO->2022-03-23 09:35:11'),(13,'','INS->LDAGULTO->2022-03-23 09:35:22'),(15,'','INS->LDAGULTO->2022-03-30 01:52:09'),(16,'','INS->LDAGULTO->2022-03-30 04:30:25'),(17,'','INS->LDAGULTO->2022-03-30 04:31:05'),(18,'','INS->LDAGULTO->2022-03-30 04:31:25'),(19,'','INS->LDAGULTO->2022-05-25 11:38:16');
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
INSERT INTO `tblnotificationtype` VALUES (1,'Time In Notification','Notification for time in.','TL-504','UPD->LDAGULTO->2022-02-24 03:41:39'),(2,'Time Out Notification','Notification for time out.','TL-505','UPD->LDAGULTO->2022-02-24 02:10:29'),(3,'Attendance Creation For Recommendation','Notification to the department head that there is a attendance creation for recommendation.','TL-506','INS->LDAGULTO->2022-03-18 10:05:29'),(4,'Attendance Adjustment For Recommendation','Notification to the department head that there is an attendance adjustment for recommendation.','TL-507','UPD->LDAGULTO->2022-03-30 01:47:41'),(5,'Attendance Creation Recommendation','Notification to the requester that the attendance creation is recommended.','TL-508','INS->LDAGULTO->2022-03-18 02:27:52'),(6,'Attendance Adjustment Recommendation','Notification to the requester that the attendance adjustment is recommended.','TL-509','INS->LDAGULTO->2022-03-18 02:28:14'),(7,'Attendance Creation Cancellation','Notification to the requester that the attendance creation is cancelled.','TL-510','INS->LDAGULTO->2022-03-21 08:43:42'),(8,'Attendance Adjustment Cancellation','Notification to the requester that the attendance adjustment is cancelled.','TL-511','INS->LDAGULTO->2022-03-21 08:44:09'),(9,'Attendance Creation For Approval','Notification to the HR Head that there is an attendance creation for approval.','TL-512','INS->LDAGULTO->2022-03-21 03:49:16'),(10,'Attendance Adjustment For Approval','Notification to the HR Head that there is an attendance adjustment for approval.','TL-513','INS->LDAGULTO->2022-03-21 03:50:29'),(11,'Attendance Creation Rejection','Notification to the requester that the attendance creation is rejected.','TL-514','INS->LDAGULTO->2022-03-23 09:26:44'),(12,'Attendance Adjustment Rejection','Notification to the requester that the attendance adjustment is rejected.','TL-515','INS->LDAGULTO->2022-03-23 09:27:09'),(13,'Attendance Creation Approval','Notification to the requester that the attendance creation is approved.','TL-516','INS->LDAGULTO->2022-03-23 09:33:28'),(14,'Attendance Adjustment Approval','Notification to the requester that the attendance adjustment is approved.','TL-517','INS->LDAGULTO->2022-03-23 09:33:52'),(15,'Leave Application','Notification to the department head that there is a leave for approval.','TL-518','INS->LDAGULTO->2022-03-30 01:47:32'),(16,'Leave Approval','Notification to the requester that the leave is approved.','TL-519','INS->LDAGULTO->2022-03-30 04:27:39'),(17,'Leave Rejection','Notification to the requester that the leave is rejected.','TL-520','INS->LDAGULTO->2022-03-30 04:27:53'),(18,'Leave Cancellation','Notification to the requester that the leave is cancellation.','TL-521','INS->LDAGULTO->2022-03-30 04:28:03'),(19,'Payslip Notification','Notification to the payee that the payslip is available.','TL-522','INS->LDAGULTO->2022-05-24 05:16:31');
/*!40000 ALTER TABLE `tblnotificationtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblotherincome`
--

DROP TABLE IF EXISTS `tblotherincome`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblotherincome` (
  `OTHER_INCOME_ID` varchar(100) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `OTHER_INCOME_TYPE` varchar(100) NOT NULL,
  `PAYROLL_ID` date DEFAULT NULL,
  `PAYROLL_DATE` date NOT NULL,
  `AMOUNT` double DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`OTHER_INCOME_ID`),
  KEY `other_income_index` (`OTHER_INCOME_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblotherincome`
--

LOCK TABLES `tblotherincome` WRITE;
/*!40000 ALTER TABLE `tblotherincome` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblotherincome` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblotherincometype`
--

DROP TABLE IF EXISTS `tblotherincometype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblotherincometype` (
  `OTHER_INCOME_TYPE_ID` varchar(100) NOT NULL,
  `OTHER_INCOME_TYPE` varchar(50) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `TAXABLE` varchar(5) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`OTHER_INCOME_TYPE_ID`),
  KEY `other_income_type_index` (`OTHER_INCOME_TYPE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblotherincometype`
--

LOCK TABLES `tblotherincometype` WRITE;
/*!40000 ALTER TABLE `tblotherincometype` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblotherincometype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpayrollgroup`
--

DROP TABLE IF EXISTS `tblpayrollgroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblpayrollgroup` (
  `PAYROLL_GROUP_ID` int(11) NOT NULL,
  `PAYROLL_GROUP` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(200) NOT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PAYROLL_GROUP_ID`),
  KEY `payroll_group_index` (`PAYROLL_GROUP_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpayrollgroup`
--

LOCK TABLES `tblpayrollgroup` WRITE;
/*!40000 ALTER TABLE `tblpayrollgroup` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpayrollgroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpayrollgroupemployee`
--

DROP TABLE IF EXISTS `tblpayrollgroupemployee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblpayrollgroupemployee` (
  `PAYROLL_GROUP_ID` int(11) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpayrollgroupemployee`
--

LOCK TABLES `tblpayrollgroupemployee` WRITE;
/*!40000 ALTER TABLE `tblpayrollgroupemployee` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpayrollgroupemployee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpayrollsetting`
--

DROP TABLE IF EXISTS `tblpayrollsetting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblpayrollsetting` (
  `SETTING_ID` int(11) NOT NULL,
  `LATE_DEDUCTION_RATE` double NOT NULL,
  `EARLY_LEAVING_DEDUCTION_RATE` double NOT NULL,
  `OVERTIME_RATE` double DEFAULT NULL,
  `NIGHT_DIFFERENTIAL_RATE` double NOT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`SETTING_ID`),
  KEY `payroll_setting_index` (`SETTING_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpayrollsetting`
--

LOCK TABLES `tblpayrollsetting` WRITE;
/*!40000 ALTER TABLE `tblpayrollsetting` DISABLE KEYS */;
INSERT INTO `tblpayrollsetting` VALUES (1,5,5,125,20,'TL-542','UPD->LDAGULTO->2022-05-20 09:30:34');
/*!40000 ALTER TABLE `tblpayrollsetting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpayrun`
--

DROP TABLE IF EXISTS `tblpayrun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblpayrun` (
  `PAY_RUN_ID` int(11) NOT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date NOT NULL,
  `PAYSLIP_NOTE` varchar(500) DEFAULT NULL,
  `CONSIDER_OVERTIME` int(1) NOT NULL,
  `CONSIDER_WITHHOLDING_TAX` int(1) NOT NULL,
  `CONSIDER_HOLIDAY_PAY` int(1) NOT NULL,
  `CONSIDER_NIGHT_DIFFERENTIAL` int(1) NOT NULL,
  `STATUS` varchar(10) NOT NULL,
  `GENERATION_DATE` date DEFAULT NULL,
  `GENERATION_TIME` time DEFAULT NULL,
  `GENERATED_BY` varchar(50) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PAY_RUN_ID`),
  KEY `pay_run_index` (`PAY_RUN_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpayrun`
--

LOCK TABLES `tblpayrun` WRITE;
/*!40000 ALTER TABLE `tblpayrun` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpayrun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpayrunpayee`
--

DROP TABLE IF EXISTS `tblpayrunpayee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblpayrunpayee` (
  `PAY_RUN_ID` int(11) DEFAULT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpayrunpayee`
--

LOCK TABLES `tblpayrunpayee` WRITE;
/*!40000 ALTER TABLE `tblpayrunpayee` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpayrunpayee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpayslip`
--

DROP TABLE IF EXISTS `tblpayslip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblpayslip` (
  `PAYSLIP_ID` int(11) NOT NULL,
  `PAY_RUN_ID` int(11) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `ABSENT` int(11) NOT NULL,
  `ABSENT_DEDUCTION` double NOT NULL,
  `LATE_MINUTES` double NOT NULL,
  `LATE_DEDUCTION` double NOT NULL,
  `EARLY_LEAVING_MINUTES` double NOT NULL,
  `EARLY_LEAVING_DEDUCTION` double NOT NULL,
  `OVERTIME_HOURS` double NOT NULL,
  `OVERTIME_EARNING` double NOT NULL,
  `HOURS_WORKED` double NOT NULL,
  `WITHHOLDING_TAX` double NOT NULL,
  `TOTAL_DEDUCTION` double NOT NULL,
  `TOTAL_ALLOWANCE` double NOT NULL,
  `GROSS_PAY` double NOT NULL,
  `NET_PAY` double NOT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PAYSLIP_ID`),
  KEY `payslip_index` (`PAYSLIP_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpayslip`
--

LOCK TABLES `tblpayslip` WRITE;
/*!40000 ALTER TABLE `tblpayslip` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpayslip` ENABLE KEYS */;
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
INSERT INTO `tblpermission` VALUES (1,1,'View Dashboard Page','TL-123','INS->ADMIN->2022-01-03 02:33:17'),(2,2,'View Policy Page','TL-124','INS->ADMIN->2022-01-03 02:33:36'),(3,2,'Add Policy','TL-125','INS->ADMIN->2022-01-03 02:33:41'),(4,2,'Update Policy','TL-126','INS->ADMIN->2022-01-03 02:33:46'),(5,2,'Delete Policy','TL-127','INS->ADMIN->2022-01-03 02:33:51'),(6,2,'View Transaction Log','TL-128','INS->ADMIN->2022-01-03 02:34:02'),(7,3,'View Permission Page','TL-129','INS->ADMIN->2022-01-03 02:34:42'),(8,3,'Add Permission','TL-130','INS->ADMIN->2022-01-03 02:34:47'),(9,3,'Update Permission','TL-131','INS->ADMIN->2022-01-03 02:34:52'),(10,3,'Delete Permission','TL-132','INS->ADMIN->2022-01-03 02:35:43'),(11,3,'View Transaction Log','TL-133','INS->ADMIN->2022-01-03 02:35:48'),(12,4,'View Role Page','TL-134','INS->ADMIN->2022-01-03 02:35:52'),(13,4,'Add Role','TL-135','INS->ADMIN->2022-01-03 02:35:56'),(14,4,'Update Role','TL-136','INS->ADMIN->2022-01-03 02:36:09'),(15,4,'Delete Role','TL-137','INS->ADMIN->2022-01-03 02:36:15'),(16,4,'View Transaction Log','TL-138','INS->ADMIN->2022-01-03 02:36:36'),(17,5,'View Role Permission Page','TL-139','INS->ADMIN->2022-01-03 02:36:41'),(18,5,'Update Role Permission','TL-140','INS->ADMIN->2022-01-03 02:36:46'),(19,6,'View System Parameter Page','TL-141','INS->ADMIN->2022-01-03 02:36:51'),(20,6,'Add System Parameter','TL-142','INS->ADMIN->2022-01-03 02:37:07'),(21,6,'Update System Parameter','TL-143','INS->ADMIN->2022-01-03 02:37:11'),(22,6,'Delete System Parameter','TL-144','INS->ADMIN->2022-01-03 02:37:17'),(23,6,'View Transaction Log','TL-145','INS->ADMIN->2022-01-03 02:37:23'),(24,7,'View System Code Page','TL-146','INS->ADMIN->2022-01-03 02:37:39'),(25,7,'Add System Code','TL-147','INS->ADMIN->2022-01-03 02:37:51'),(26,7,'Update System Code','TL-148','INS->ADMIN->2022-01-03 02:37:59'),(27,7,'Delete System Code','TL-149','INS->ADMIN->2022-01-03 02:38:04'),(28,7,'View Transaction Log','TL-150','INS->ADMIN->2022-01-03 02:38:30'),(29,8,'View Notification Type Page','TL-151','INS->ADMIN->2022-01-03 02:39:00'),(30,8,'Add Notification Type','TL-152','INS->ADMIN->2022-01-03 02:39:19'),(31,8,'Update Notification Type','TL-153','INS->ADMIN->2022-01-03 02:39:36'),(32,8,'Delete Notification Type','TL-154','INS->ADMIN->2022-01-03 02:40:30'),(33,8,'View Transaction Log','TL-155','INS->ADMIN->2022-01-03 02:40:36'),(34,9,'View User Interface Setting Page','TL-156','INS->ADMIN->2022-01-03 02:40:54'),(35,9,'Update User Interface Setting','TL-157','INS->ADMIN->2022-01-03 02:40:59'),(36,9,'View Transaction Log','TL-158','INS->ADMIN->2022-01-03 02:41:18'),(37,10,'View Application Notification Page','TL-159','INS->ADMIN->2022-01-03 02:41:23'),(38,10,'Update Application Notification','TL-160','INS->ADMIN->2022-01-03 02:41:27'),(39,11,'View Company Setting Page','TL-161','INS->ADMIN->2022-01-03 02:41:32'),(40,11,'Update Company Setting','TL-162','INS->ADMIN->2022-01-03 02:41:43'),(41,11,'View Transaction Log','TL-163','INS->ADMIN->2022-01-03 02:41:48'),(42,12,'View Email Setting Page','TL-164','INS->ADMIN->2022-01-03 02:42:08'),(43,12,'Update Email Setting','TL-165','INS->ADMIN->2022-01-03 02:42:13'),(44,12,'View Transaction Log','TL-166','INS->ADMIN->2022-01-03 02:42:26'),(45,13,'View Department Page','TL-167','INS->ADMIN->2022-01-03 02:42:31'),(46,13,'Add Department','TL-168','INS->ADMIN->2022-01-03 02:42:37'),(47,13,'Update Department','TL-169','INS->ADMIN->2022-01-03 02:42:44'),(48,13,'Delete Department','TL-170','INS->ADMIN->2022-01-03 03:33:36'),(49,13,'View Transaction Log','TL-171','INS->ADMIN->2022-01-03 03:33:42'),(50,14,'View Designation Page','TL-172','INS->ADMIN->2022-01-03 03:33:55'),(51,14,'Add Designation','TL-173','INS->ADMIN->2022-01-03 03:33:59'),(52,14,'Update Designation','TL-174','INS->ADMIN->2022-01-03 03:34:04'),(53,14,'Delete Designation','TL-175','INS->ADMIN->2022-01-03 03:34:10'),(54,14,'View Transaction Log','TL-176','INS->ADMIN->2022-01-03 03:34:15'),(55,15,'View Branch Page','TL-177','INS->ADMIN->2022-01-03 03:34:26'),(56,15,'Add Branch','TL-178','INS->ADMIN->2022-01-03 03:34:31'),(57,15,'Update Branch','TL-179','INS->ADMIN->2022-01-03 03:34:35'),(58,15,'Delete Branch','TL-180','INS->ADMIN->2022-01-03 03:34:39'),(59,15,'View Transaction Log','TL-181','INS->ADMIN->2022-01-03 03:34:49'),(60,16,'View Upload Setting Page','TL-182','INS->ADMIN->2022-01-05 10:13:05'),(61,16,'Add Upload Setting','TL-183','INS->ADMIN->2022-01-05 10:13:12'),(62,16,'Update Upload Setting','TL-184','INS->ADMIN->2022-01-05 10:13:19'),(63,16,'Delete Upload Setting','TL-185','INS->ADMIN->2022-01-05 10:13:27'),(64,16,'View Transaction Log','TL-186','INS->ADMIN->2022-01-05 10:13:34'),(65,17,'View Employment Status Page','TL-187','INS->ADMIN->2022-01-10 10:02:53'),(66,17,'Add Employment Status','TL-188','INS->ADMIN->2022-01-10 10:02:58'),(67,17,'Update Employment Status','TL-189','INS->ADMIN->2022-01-10 10:03:04'),(68,17,'Delete Employment Status','TL-190','INS->ADMIN->2022-01-10 10:03:20'),(69,17,'View Transaction Log','TL-191','INS->ADMIN->2022-01-10 10:03:34'),(70,18,'View Employee Page','TL-192','INS->ADMIN->2022-01-10 11:34:43'),(71,18,'Add Employee','TL-193','INS->ADMIN->2022-01-10 11:34:50'),(72,18,'Update Employee','TL-194','INS->ADMIN->2022-01-10 11:34:55'),(73,18,'Delete Employee','TL-195','INS->ADMIN->2022-01-10 11:35:00'),(74,18,'View Transaction Log','TL-196','INS->ADMIN->2022-01-10 11:35:08'),(75,19,'View Employee Details Page','TL-197','INS->ADMIN->2022-01-14 03:40:06'),(76,19,'Update Employee Details','TL-198','INS->ADMIN->2022-01-14 03:40:17'),(77,20,'View Emergency Contact','TL-199','INS->ADMIN->2022-01-16 06:51:48'),(78,20,'Add Emergency Contact','TL-200','INS->ADMIN->2022-01-16 06:51:55'),(79,20,'Update Emergency Contact','TL-201','INS->ADMIN->2022-01-16 06:52:02'),(80,20,'Delete Emergency Contact','TL-202','INS->ADMIN->2022-01-16 06:52:18'),(81,20,'View Transaction Log','TL-203','INS->ADMIN->2022-01-16 06:52:45'),(82,21,'View Employee Address','TL-204','INS->ADMIN->2022-01-17 10:57:25'),(83,21,'Add Employee Address','TL-205','INS->ADMIN->2022-01-17 10:57:31'),(84,21,'Update Employee Address','TL-206','UPD->ADMIN->2022-01-17 10:57:42'),(85,21,'Delete Employee Address','TL-207','INS->ADMIN->2022-01-17 10:57:47'),(86,21,'View Transaction Log','TL-208','INS->ADMIN->2022-01-17 10:57:53'),(87,22,'View Employee Social','TL-209','INS->ADMIN->2022-01-17 01:12:12'),(88,22,'Add Employee Social','TL-210','INS->ADMIN->2022-01-17 01:12:17'),(89,22,'Update Employee Social','TL-211','UPD->ADMIN->2022-01-17 01:12:29'),(90,22,'Delete Employee Social','TL-212','INS->ADMIN->2022-01-17 01:12:36'),(91,22,'View Transaction Log','TL-213','INS->ADMIN->2022-01-17 01:12:45'),(92,23,'View Work Shift Page','TL-214','INS->ADMIN->2022-01-17 01:54:56'),(93,23,'Add Work Shift','TL-215','INS->ADMIN->2022-01-17 01:55:05'),(94,23,'Update Work Shift','TL-216','INS->ADMIN->2022-01-17 01:55:14'),(95,23,'Update Work Shift Schedule','TL-217','UPD->ADMIN->2022-01-18 04:28:09'),(96,23,'Assign Work Shift','TL-218','UPD->ADMIN->2022-01-21 09:56:37'),(97,23,'Delete Work Shift','TL-219','UPD->ADMIN->2022-01-21 09:56:45'),(98,23,'View Transaction Log','TL-220','INS->ADMIN->2022-01-21 10:05:48'),(99,24,'View Employee Attendance','TL-221','UPD->ADMIN->2022-01-25 11:34:08'),(100,24,'Add Employee Attendance','TL-222','UPD->ADMIN->2022-01-25 11:34:12'),(101,24,'Update Employee Attendance','TL-223','UPD->ADMIN->2022-01-25 11:34:17'),(102,24,'Delete Employee Attendance','TL-224','UPD->ADMIN->2022-01-25 11:34:23'),(103,24,'View Transaction Log','TL-225','INS->ADMIN->2022-01-25 11:34:29'),(104,25,'View Leave Type Page','TL-226','INS->ADMIN->2022-01-27 10:22:20'),(105,25,'Add Leave Type','TL-227','INS->ADMIN->2022-01-27 10:22:27'),(106,25,'Update Leave Type','TL-228','INS->ADMIN->2022-01-27 10:22:35'),(107,25,'Delete Leave Type','TL-229','INS->ADMIN->2022-01-27 10:22:40'),(108,25,'View Transaction Log','TL-230','INS->ADMIN->2022-01-27 10:22:46'),(109,26,'View Leave Entitlement Page','TL-231','INS->ADMIN->2022-01-27 01:13:08'),(110,26,'Add Leave Entitlement','TL-232','INS->ADMIN->2022-01-27 01:13:13'),(111,26,'Update Leave Entitlement','TL-233','INS->ADMIN->2022-01-27 01:13:21'),(112,26,'Delete Leave Entitlement','TL-234','INS->ADMIN->2022-01-27 01:13:28'),(113,26,'View Transaction Log','TL-235','INS->ADMIN->2022-01-27 01:13:34'),(114,27,'View Leave Entitlement','TL-236','INS->ADMIN->2022-01-27 03:39:07'),(115,27,'Add Leave Entitlement','TL-237','UPD->ADMIN->2022-01-27 03:39:31'),(116,27,'Update Leave Entitlement','TL-238','INS->ADMIN->2022-01-27 03:39:26'),(117,27,'Delete Leave Entitlement','TL-239','INS->ADMIN->2022-01-27 03:39:40'),(118,27,'View Transaction Log','TL-240','INS->ADMIN->2022-01-27 03:40:02'),(119,28,'View Leave Management Page','TL-241','INS->ADMIN->2022-01-27 05:03:14'),(120,28,'Add Leave','TL-242','INS->ADMIN->2022-01-27 05:03:18'),(121,28,'Delete Leave','TL-243','UPD->ADMIN->2022-01-28 04:17:18'),(122,28,'Approve Leave','TL-244','UPD->ADMIN->2022-01-28 04:17:23'),(123,28,'Reject Leave','TL-245','UPD->ADMIN->2022-01-28 04:17:35'),(124,28,'Cancel Leave','TL-246','INS->ADMIN->2022-01-28 04:17:40'),(125,28,'View Transaction Log','TL-247','INS->ADMIN->2022-01-28 04:17:46'),(126,29,'View Leave','TL-248','INS->ADMIN->2022-02-02 10:39:02'),(127,29,'Add Leave','TL-249','INS->ADMIN->2022-02-02 10:39:21'),(128,29,'Delete Leave','TL-250','INS->ADMIN->2022-02-02 10:39:38'),(129,29,'Approve Leave','TL-251','INS->ADMIN->2022-02-02 10:39:44'),(130,29,'Reject Leave','TL-252','INS->ADMIN->2022-02-02 10:39:50'),(131,29,'Cancel Leave','TL-253','INS->ADMIN->2022-02-02 10:39:56'),(132,29,'View Transaction Log','TL-254','INS->ADMIN->2022-02-02 10:40:04'),(133,30,'View Employee File Management Page','TL-255','UPD->ADMIN->2022-02-02 11:17:41'),(134,30,'Add File','TL-256','INS->ADMIN->2022-02-02 11:14:45'),(135,30,'Update File','TL-257','INS->ADMIN->2022-02-02 11:14:49'),(136,30,'Delete File','TL-258','INS->ADMIN->2022-02-02 11:14:52'),(137,30,'View Transaction Log','TL-259','INS->ADMIN->2022-02-02 11:16:06'),(138,31,'View Employee File','TL-260','INS->ADMIN->2022-02-07 10:18:04'),(139,31,'Add Employee File','TL-261','INS->ADMIN->2022-02-07 10:18:09'),(140,31,'Update Employee File','TL-262','INS->ADMIN->2022-02-07 10:18:16'),(141,31,'Delete Employee File','TL-263','UPD->ADMIN->2022-02-07 10:18:25'),(142,31,'View Transaction Log','TL-264','INS->ADMIN->2022-02-07 10:18:30'),(143,32,'View User Account Page','TL-265','INS->ADMIN->2022-02-08 02:37:31'),(144,32,'Add User Account','TL-266','INS->ADMIN->2022-02-08 02:37:38'),(145,32,'Update User Account','TL-267','INS->ADMIN->2022-02-08 02:37:46'),(146,32,'Lock User Account','TL-268','INS->ADMIN->2022-02-08 02:41:31'),(147,32,'Unlock User Account','TL-269','INS->ADMIN->2022-02-08 02:41:37'),(148,32,'Activate User Account','TL-270','INS->ADMIN->2022-02-08 02:41:57'),(149,32,'De-activate User Account','TL-271','INS->ADMIN->2022-02-08 02:42:05'),(150,32,'View Transaction Log','TL-272','INS->ADMIN->2022-02-08 02:42:15'),(151,33,'View Holiday Page','TL-273','INS->LDAGULTO->2022-02-10 01:00:20'),(152,33,'Add Holiday','TL-274','UPD->LDAGULTO->2022-02-10 01:00:38'),(153,33,'Update Holiday','TL-275','INS->LDAGULTO->2022-02-10 01:00:33'),(154,33,'Delete Holiday','TL-276','INS->LDAGULTO->2022-02-10 01:00:43'),(155,33,'View Transaction Log','TL-277','INS->LDAGULTO->2022-02-10 01:00:49'),(156,34,'View Attendance Setting Page','TL-278','INS->LDAGULTO->2022-02-15 04:34:16'),(157,34,'Update Attendance Setting','TL-279','INS->LDAGULTO->2022-02-15 04:36:55'),(158,34,'View Transaction Log','TL-280','INS->LDAGULTO->2022-02-15 04:37:02'),(159,1,'Record Attendance','TL-281','INS->LDAGULTO->2022-02-17 09:46:50'),(160,35,'View Attendance Record Page','TL-282','UPD->LDAGULTO->2022-02-18 03:48:21'),(161,35,'Add Attendance Record','TL-283','UPD->LDAGULTO->2022-02-18 03:48:25'),(162,35,'Update Attendance Record','TL-284','UPD->LDAGULTO->2022-02-18 03:48:29'),(163,35,'Delete Attendance Record','TL-285','UPD->LDAGULTO->2022-02-18 03:48:35'),(164,35,'View Transaction Log','TL-286','INS->LDAGULTO->2022-02-18 03:42:14'),(165,1,'Submit Health Declaration','TL-287','INS->LDAGULTO->2022-02-21 10:15:56'),(166,1,'Get Location','TL-288','INS->LDAGULTO->2022-02-21 02:23:44'),(167,1,'Scan QR Code','TL-289','INS->LDAGULTO->2022-02-21 02:23:49'),(168,36,'View Notification Details Page','TL-290','INS->LDAGULTO->2022-02-24 04:32:30'),(169,36,'Update Notification Details','TL-291','INS->LDAGULTO->2022-02-24 04:32:59'),(170,36,'View Transaction Log','TL-292','INS->LDAGULTO->2022-02-24 04:33:08'),(171,37,'View Employee Attendance Record Page','TL-293','INS->LDAGULTO->2022-03-11 08:49:56'),(172,37,'Add Attendance Creation','TL-294','UPD->LDAGULTO->2022-03-11 09:47:00'),(173,37,'Add Attendance Adjustment','TL-295','UPD->LDAGULTO->2022-03-11 09:47:05'),(174,37,'View Transaction Log','TL-296','UPD->LDAGULTO->2022-03-11 09:46:52'),(175,38,'View Attendance Creation Page','TL-297','INS->LDAGULTO->2022-03-14 02:59:39'),(176,38,'Add Attendance Creation','TL-298','UPD->LDAGULTO->2022-03-14 02:59:50'),(177,38,'Update Attendance Creation','TL-299','INS->LDAGULTO->2022-03-14 03:00:02'),(178,38,'Delete Attendance Creation','TL-300','INS->LDAGULTO->2022-03-14 03:00:08'),(179,38,'Tag Attendance Creation For Recommendation','TL-301','UPD->LDAGULTO->2022-03-16 01:46:02'),(180,38,'Cancel Attendance Creation','TL-302','UPD->LDAGULTO->2022-03-16 01:26:52'),(181,38,'View Transaction Log','TL-303','INS->LDAGULTO->2022-03-16 01:27:17'),(182,39,'View Attendance Adjustment Page','TL-304','INS->LDAGULTO->2022-03-16 01:27:47'),(183,39,'Update Attendance Adjustment','TL-305','INS->LDAGULTO->2022-03-16 01:27:56'),(184,39,'Delete Attendance Adjustment','TL-306','INS->LDAGULTO->2022-03-16 01:28:03'),(185,39,'Tag Attendance Adjustment For Recommendation','TL-307','UPD->LDAGULTO->2022-03-16 01:45:41'),(186,39,'Cancel Attendance Adjustment','TL-308','INS->LDAGULTO->2022-03-16 01:28:19'),(187,39,'View Transaction Log','TL-309','INS->LDAGULTO->2022-03-16 01:28:30'),(188,40,'View Attendance Creation Recommendation Page','TL-310','INS->LDAGULTO->2022-03-18 09:45:04'),(189,40,'Recommend Attendance Creation','TL-311','INS->LDAGULTO->2022-03-18 09:45:14'),(190,40,'Reject Attendance Creation','TL-312','INS->LDAGULTO->2022-03-18 09:45:21'),(191,40,'Cancel Attendance Creation','TL-313','INS->LDAGULTO->2022-03-18 09:45:32'),(192,40,'View Transaction Log','TL-314','INS->LDAGULTO->2022-03-18 03:15:09'),(193,41,'View Attendance Adjustment Recommendation Page','TL-315','INS->LDAGULTO->2022-03-18 03:15:18'),(194,41,'Recommend Attendance Adjustment','TL-316','INS->LDAGULTO->2022-03-18 03:15:26'),(195,41,'Reject Attendance Adjustment','TL-317','INS->LDAGULTO->2022-03-18 03:15:32'),(196,41,'Cancel Attendance Adjustment','TL-318','INS->LDAGULTO->2022-03-23 08:40:11'),(197,41,'View Transaction Log','TL-319','INS->LDAGULTO->2022-03-23 08:40:19'),(198,42,'View Attendance Creation Approval Page','TL-320','INS->LDAGULTO->2022-03-23 08:40:28'),(199,42,'Approve Attendance Creation','TL-321','INS->LDAGULTO->2022-03-23 08:40:35'),(200,42,'Reject Attendance Creation','TL-322','INS->LDAGULTO->2022-03-23 08:40:42'),(201,42,'Cancel Attendance Creation','TL-323','INS->LDAGULTO->2022-03-23 08:58:05'),(202,42,'View Transaction Log','TL-324','INS->LDAGULTO->2022-03-23 08:58:10'),(203,43,'View Attendance Adjustment Approval Page','TL-325','UPD->LDAGULTO->2022-03-23 08:58:31'),(204,43,'Approve Attendance Adjustment','TL-326','INS->LDAGULTO->2022-03-23 08:58:40'),(205,43,'Reject Attendance Adjustment','TL-327','INS->LDAGULTO->2022-03-23 08:58:48'),(206,43,'Cancel Attendance Adjustment','TL-328','INS->LDAGULTO->2022-03-23 08:58:53'),(207,43,'View Transaction Log','TL-329','INS->LDAGULTO->2022-03-23 08:58:58'),(208,44,'View Leave Management Page','TL-330','INS->LDAGULTO->2022-03-24 03:48:01'),(209,44,'Add Leave','TL-331','INS->LDAGULTO->2022-03-24 03:48:06'),(210,44,'Delete Leave','TL-332','UPD->LDAGULTO->2022-03-30 09:08:24'),(211,44,'Cancel Leave','TL-333','UPD->LDAGULTO->2022-03-30 09:08:29'),(212,44,'View Transaction Log','TL-334','UPD->LDAGULTO->2022-03-30 09:08:38'),(213,45,'View Leave Approval Page','TL-335','INS->LDAGULTO->2022-03-30 02:42:18'),(214,45,'Approve Leave','TL-336','INS->LDAGULTO->2022-03-30 02:42:28'),(215,45,'Reject Leave','TL-337','INS->LDAGULTO->2022-03-30 02:42:32'),(216,45,'Cancel Leave','TL-338','INS->LDAGULTO->2022-03-30 02:42:38'),(217,45,'View Transaction Log','TL-339','INS->LDAGULTO->2022-03-30 02:42:43'),(218,46,'View Allowance Type','TL-340','INS->LDAGULTO->2022-04-01 03:35:22'),(219,46,'Add Allowance Type','TL-341','INS->LDAGULTO->2022-04-01 03:35:28'),(220,46,'Update Allowance Type','TL-342','INS->LDAGULTO->2022-04-01 03:35:35'),(221,46,'Delete Allowance Type','TL-343','INS->LDAGULTO->2022-04-01 03:35:41'),(222,46,'View Transaction Log','TL-344','INS->LDAGULTO->2022-04-01 03:35:48'),(223,47,'View Allowance Page','TL-345','INS->LDAGULTO->2022-04-05 11:38:49'),(224,47,'Add Allowance','TL-346','INS->LDAGULTO->2022-04-05 11:38:53'),(225,47,'Update Allowance','TL-347','INS->LDAGULTO->2022-04-05 11:39:00'),(226,47,'Delete Allowance','TL-348','INS->LDAGULTO->2022-04-05 11:39:05'),(227,47,'View Transaction Log','TL-349','INS->LDAGULTO->2022-04-05 11:39:16'),(228,48,'View Deduction Type Page','TL-350','UPD->LDAGULTO->2022-04-06 05:10:22'),(229,48,'Add Deduction Type','TL-351','INS->LDAGULTO->2022-04-06 05:10:33'),(230,48,'Update Deduction Type','TL-352','INS->LDAGULTO->2022-04-06 05:10:39'),(231,48,'Delete Deduction Type','TL-353','INS->LDAGULTO->2022-04-06 05:10:45'),(232,48,'View Transaction Log','TL-354','INS->LDAGULTO->2022-04-06 05:10:54'),(233,49,'View Government Contribution Page','TL-355','UPD->LDAGULTO->2022-04-08 10:31:52'),(234,49,'Add Government Contribution','TL-356','INS->LDAGULTO->2022-04-08 10:32:02'),(235,49,'Update Government Contribution','TL-357','INS->LDAGULTO->2022-04-08 10:32:17'),(236,49,'Delete Government Contribution','TL-358','INS->LDAGULTO->2022-04-08 10:32:31'),(237,49,'View Transaction Log','TL-359','INS->LDAGULTO->2022-04-08 10:32:36'),(238,50,'View Contribution Bracket Page','TL-360','INS->LDAGULTO->2022-04-08 11:19:39'),(239,50,'Add Contribution Bracket','TL-361','INS->LDAGULTO->2022-04-08 11:19:54'),(240,50,'Update Contribution Bracket','TL-362','INS->LDAGULTO->2022-04-08 11:20:06'),(241,50,'Delete Contribution Bracket','TL-363','INS->LDAGULTO->2022-04-08 11:20:12'),(242,50,'View Transaction Log','TL-364','INS->LDAGULTO->2022-04-08 11:20:18'),(243,51,'View Deduction Page','TL-365','UPD->LDAGULTO->2022-04-13 09:10:04'),(244,51,'Add Deduction','TL-366','UPD->LDAGULTO->2022-04-13 09:10:08'),(245,51,'Update Deduction','TL-367','UPD->LDAGULTO->2022-04-13 09:10:12'),(246,51,'Delete Deduction','TL-368','UPD->LDAGULTO->2022-04-13 09:10:16'),(247,51,'View Transaction Log','TL-369','INS->LDAGULTO->2022-04-09 06:09:32'),(248,52,'View Contribution Deduction Page','TL-370','INS->LDAGULTO->2022-04-13 10:55:39'),(249,52,'Add Contribution Deduction','TL-371','INS->LDAGULTO->2022-04-13 10:55:50'),(250,52,'Update Contribution Deduction','TL-372','INS->LDAGULTO->2022-04-13 10:55:57'),(251,52,'Delete Contribution Deduction','TL-373','INS->LDAGULTO->2022-04-13 10:56:04'),(252,52,'View Transaction Log','TL-374','INS->LDAGULTO->2022-04-13 10:56:10'),(253,53,'View Employee Allowance','TL-375','INS->LDAGULTO->2022-04-13 01:51:39'),(254,53,'Add Employee Allowance','TL-376','INS->LDAGULTO->2022-04-13 01:51:49'),(255,53,'Update Employee Allowance','TL-377','INS->LDAGULTO->2022-04-13 01:51:56'),(256,53,'Delete Employee Allowance','TL-378','INS->LDAGULTO->2022-04-13 01:52:03'),(257,53,'View Transaction Log','TL-379','INS->LDAGULTO->2022-04-13 01:52:11'),(258,54,'View Attendance Summary Page','TL-380','INS->LDAGULTO->2022-04-14 03:46:33'),(259,54,'Export Attendance Summary','TL-381','INS->LDAGULTO->2022-04-14 03:46:43'),(260,55,'View Import Employee Page','TL-382','INS->LDAGULTO->2022-04-16 06:40:28'),(261,55,'Import Employee','TL-383','INS->LDAGULTO->2022-04-16 06:40:34'),(262,56,'View Import Attendance Record','TL-384','INS->LDAGULTO->2022-04-19 02:54:34'),(263,56,'Import Attendance Record','TL-385','INS->LDAGULTO->2022-04-19 02:54:46'),(264,57,'View Import Leave Entitlement Page','TL-386','UPD->LDAGULTO->2022-04-20 11:07:00'),(265,57,'Import Leave Entitlement','TL-387','INS->LDAGULTO->2022-04-20 11:07:07'),(266,58,'View Import Leave Page','TL-388','INS->LDAGULTO->2022-04-20 02:20:08'),(267,58,'Import Leave','TL-389','INS->LDAGULTO->2022-04-20 02:20:13'),(268,59,'View Import Attendance Adjustment Page','TL-390','INS->LDAGULTO->2022-04-21 09:29:19'),(269,59,'Import Attendance Adjustment','TL-391','INS->LDAGULTO->2022-04-21 09:29:27'),(270,60,'View Import Attendance Creation Page','TL-392','INS->LDAGULTO->2022-04-21 09:29:43'),(271,60,'Import Attendance Creation','TL-393','INS->LDAGULTO->2022-04-21 09:29:51'),(272,61,'View Import Allowance Page','TL-394','INS->LDAGULTO->2022-04-22 02:23:51'),(273,61,'Import Allowance','TL-395','INS->LDAGULTO->2022-04-22 02:24:00'),(274,62,'View Import Deduction Page','TL-396','INS->LDAGULTO->2022-04-22 03:54:10'),(275,62,'Import Deduction','TL-397','INS->LDAGULTO->2022-04-22 03:54:17'),(276,63,'View Import Government Contribution Page','TL-398','UPD->LDAGULTO->2022-04-22 04:31:16'),(277,63,'Import Government Contribution','TL-399','INS->LDAGULTO->2022-04-22 04:31:10'),(278,64,'View Import  Contribution Bracket Page','TL-400','UPD->LDAGULTO->2022-05-18 07:54:14'),(279,64,'Import Contribution Bracket','TL-401','INS->LDAGULTO->2022-04-22 05:01:47'),(280,65,'View Import Contribution Deduction Page','TL-402','INS->LDAGULTO->2022-04-22 07:16:58'),(281,65,'Import Contribution Deduction','TL-403','INS->LDAGULTO->2022-04-22 07:17:08'),(282,66,'View Notification Page','TL-404','UPD->LDAGULTO->2022-04-26 09:04:00'),(283,67,'Backup Database','TL-405','INS->LDAGULTO->2022-04-26 11:04:55'),(284,68,'View Salary Page','TL-406','INS->LDAGULTO->2022-04-26 01:56:37'),(285,68,'Add Salary','TL-407','INS->LDAGULTO->2022-04-26 01:56:41'),(286,68,'Update Salary','TL-408','INS->LDAGULTO->2022-04-26 01:56:47'),(287,68,'Delete Salary','TL-409','INS->LDAGULTO->2022-04-26 01:56:52'),(288,68,'View Transaction Log','TL-410','INS->LDAGULTO->2022-04-26 01:56:58'),(289,69,'View Payroll Setting Page','TL-411','INS->LDAGULTO->2022-04-28 10:27:41'),(290,69,'Update Payroll Setting','TL-412','INS->LDAGULTO->2022-04-28 10:27:47'),(291,69,'View Transaction Log','TL-413','INS->LDAGULTO->2022-04-28 10:42:03'),(292,70,'View Payroll Group Page','TL-414','INS->LDAGULTO->2022-05-08 06:17:43'),(293,70,'Add Payroll Group','TL-415','INS->LDAGULTO->2022-05-08 06:17:49'),(294,70,'Update Payroll Group','TL-416','INS->LDAGULTO->2022-05-08 06:17:56'),(295,70,'Delete Payroll Group','TL-417','INS->LDAGULTO->2022-05-08 06:18:06'),(296,70,'View Transaction Log','TL-418','INS->LDAGULTO->2022-05-08 06:18:13'),(297,71,'View Pay Run Page','TL-419','UPD->LDAGULTO->2022-05-08 07:55:08'),(298,71,'Add Pay Run','TL-420','UPD->LDAGULTO->2022-05-08 07:55:00'),(299,71,'Delete Pay Run','TL-421','UPD->LDAGULTO->2022-05-11 11:12:22'),(300,71,'Lock Pay Run','TL-422','UPD->LDAGULTO->2022-05-11 11:12:30'),(301,71,'Unlock Pay Run','TL-423','UPD->LDAGULTO->2022-05-11 11:12:35'),(302,71,'Send Payslip','TL-424','UPD->LDAGULTO->2022-05-11 11:12:42'),(303,71,'View Transaction Log','TL-425','UPD->LDAGULTO->2022-05-11 11:12:47'),(304,72,'View Payslip Page','TL-426','INS->LDAGULTO->2022-05-12 10:15:07'),(305,72,'Delete Payslip','TL-427','UPD->LDAGULTO->2022-05-12 10:15:31'),(306,72,'Send Payslip','TL-428','INS->LDAGULTO->2022-05-12 10:15:36'),(307,72,'Print Payslip','TL-429','INS->LDAGULTO->2022-05-12 10:20:30'),(308,72,'View Transaction Log','TL-430','INS->LDAGULTO->2022-05-12 10:20:35'),(309,73,'View Withholding Tax Page','TL-431','INS->LDAGULTO->2022-05-18 05:07:44'),(310,73,'Add Withholding Tax','TL-432','INS->LDAGULTO->2022-05-18 05:07:56'),(311,73,'Update Withholding Tax','TL-433','INS->LDAGULTO->2022-05-18 05:08:07'),(312,73,'Delete Withholding Tax','TL-434','INS->LDAGULTO->2022-05-18 05:08:15'),(313,73,'View Transaction Log','TL-435','INS->LDAGULTO->2022-05-18 05:08:55'),(314,74,'View Import Withholding Tax Page','TL-436','INS->LDAGULTO->2022-05-18 07:54:10'),(315,74,'Import Withholding Tax','TL-437','INS->LDAGULTO->2022-05-18 07:54:35'),(316,75,'View Other Income Type','TL-438','UPD->LDAGULTO->2022-05-19 04:10:32'),(317,75,'Add Other Income Type','TL-439','UPD->LDAGULTO->2022-05-19 04:10:52'),(318,75,'Update Other Income Type','TL-440','INS->LDAGULTO->2022-05-19 04:10:57'),(319,75,'Delete Other Income Type','TL-441','INS->LDAGULTO->2022-05-19 04:11:02'),(320,75,'View Transaction Log','TL-442','INS->LDAGULTO->2022-05-19 04:11:33'),(321,76,'View Other Income Page','TL-443','INS->LDAGULTO->2022-05-19 04:46:29'),(322,76,'Add Other Income','TL-444','INS->LDAGULTO->2022-05-19 04:46:36'),(323,76,'Update Other Income','TL-445','INS->LDAGULTO->2022-05-19 04:46:44'),(324,76,'Delete Other Income','TL-446','INS->LDAGULTO->2022-05-19 04:46:52'),(325,76,'View Transaction Log','TL-447','INS->LDAGULTO->2022-05-19 04:46:59'),(326,77,'View Other Income Page','TL-448','INS->LDAGULTO->2022-05-19 07:24:52'),(327,77,'Import Other Income','TL-449','INS->LDAGULTO->2022-05-19 07:25:00'),(328,78,'View Payroll Summary','TL-450','INS->LDAGULTO->2022-05-24 05:20:54'),(329,78,'Delete Payslip','TL-451','UPD->LDAGULTO->2022-05-25 08:45:37'),(330,78,'Send Payslip','TL-452','UPD->LDAGULTO->2022-05-25 08:45:41'),(331,78,'Print Payslip','TL-453','INS->LDAGULTO->2022-05-25 08:45:49'),(332,78,'View Transaction Log','TL-454','INS->LDAGULTO->2022-05-25 08:45:55'),(333,79,'View Employee Payroll Summary','TL-455','INS->LDAGULTO->2022-05-25 11:46:09'),(334,79,'Delete Payslip','TL-456','UPD->LDAGULTO->2022-05-25 11:46:31'),(335,79,'Send Payslip','TL-457','INS->LDAGULTO->2022-05-25 11:46:36'),(336,79,'Print Payslip','TL-458','INS->LDAGULTO->2022-05-25 11:46:43'),(337,79,'View Transaction Log','TL-459','INS->LDAGULTO->2022-05-25 11:46:48'),(338,80,'View Profile Page','TL-460','INS->LDAGULTO->2022-05-25 02:53:15'),(339,80,'Change Password','TL-461','INS->LDAGULTO->2022-05-25 04:39:55');
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
INSERT INTO `tblpolicy` VALUES (1,'Dashboard','Policies on dashboard page.','TL-43','INS->ADMIN->2022-01-03 02:25:40'),(2,'Policy','Policies on policy page.','TL-44','INS->ADMIN->2022-01-03 02:28:07'),(3,'Permission','Policies on permission page.','TL-45','INS->ADMIN->2022-01-03 02:28:20'),(4,'Role','Policies on role page.','TL-46','INS->ADMIN->2022-01-03 02:28:33'),(5,'Role Permission','Policies on role permission page.','TL-47','INS->ADMIN->2022-01-03 02:29:02'),(6,'System Parameter','Policies on system parameter page.','TL-48','INS->ADMIN->2022-01-03 02:29:17'),(7,'System Code','Policies on system code page.','TL-49','INS->ADMIN->2022-01-03 02:29:27'),(8,'Notification Type','Policies on notification type page.','TL-50','INS->ADMIN->2022-01-03 02:29:39'),(9,'User Interface Setting','Policies on user interface setting page.','TL-51','INS->ADMIN->2022-01-03 02:30:20'),(10,'Application Notification','Policies on application notification page.','TL-52','INS->ADMIN->2022-01-03 02:30:36'),(11,'Company Setting','Policies on company setting page.','TL-53','INS->ADMIN->2022-01-03 02:30:49'),(12,'Email Setting','Policies on email setting page.','TL-54','INS->ADMIN->2022-01-03 02:31:02'),(13,'Department','Policies on department page.','TL-55','INS->ADMIN->2022-01-03 02:31:13'),(14,'Designation','Policies on designation page.','TL-56','INS->ADMIN->2022-01-03 02:31:23'),(15,'Branch','Policies on branch page.','TL-57','INS->ADMIN->2022-01-03 02:31:35'),(16,'Upload Setting','Policies on upload setting page.','TL-58','INS->ADMIN->2022-01-05 10:12:04'),(17,'Employment Status','Policies on employment status page.','TL-59','INS->ADMIN->2022-01-10 09:58:49'),(18,'Employee','Policies on all employees page.','TL-60','UPD->ADMIN->2022-01-10 11:37:40'),(19,'Employee Details','Policies on employee details page.','TL-61','INS->ADMIN->2022-01-14 03:39:53'),(20,'Emergency Contact','Policies on emergency contact on employee details page.','TL-62','UPD->ADMIN->2022-01-25 11:30:06'),(21,'Employee Address','Policies on employee address on employee details page.','TL-63','UPD->ADMIN->2022-01-25 11:30:18'),(22,'Employee Social','Policies on employee social on employee details page.','TL-64','UPD->ADMIN->2022-01-25 11:30:29'),(23,'Work Shift','Policies on work shift page.','TL-65','INS->ADMIN->2022-01-17 01:54:39'),(24,'Employee Attendance','Policies on employee attendance on employee details page.','TL-66','INS->ADMIN->2022-01-25 11:29:54'),(25,'Leave Type','Policies on leave type page.','TL-67','UPD->ADMIN->2022-01-27 10:22:10'),(26,'Leave Entitlement','Policies on leave entitlement page.','TL-68','INS->ADMIN->2022-01-27 01:12:48'),(27,'Employee Leave Entitlement','Policies on leave entitlement on employee details page.','TL-69','INS->ADMIN->2022-01-27 03:38:47'),(28,'Leave Management','Policies on leave management page.','TL-70','INS->ADMIN->2022-01-27 05:03:00'),(29,'Employee Leave','Policies on leave on employee details page.','TL-71','UPD->ADMIN->2022-02-02 10:49:04'),(30,'Employee File Management','Policies on employee file management page.','TL-72','UPD->ADMIN->2022-02-02 11:18:03'),(31,'Employee File','Policies on employee file on employee details page.','TL-73','INS->ADMIN->2022-02-07 10:17:49'),(32,'User Account','Policies on user account page.','TL-74','INS->ADMIN->2022-02-08 02:36:36'),(33,'Holiday','Policies on holiday page.','TL-75','INS->LDAGULTO->2022-02-10 01:00:06'),(34,'Attendance Setting','Policies on attendance setting.','TL-76','INS->LDAGULTO->2022-02-15 04:34:05'),(35,'Attendance Record','Policies on attendance record page.','TL-77','UPD->LDAGULTO->2022-02-18 03:48:48'),(36,'Notification Details','Policies on notification details page.','TL-78','INS->LDAGULTO->2022-02-24 04:32:10'),(37,'Employee Attendance Record','Policies on employee attendance record page.','TL-79','INS->LDAGULTO->2022-03-11 08:49:30'),(38,'Attendance Creation','Policies on attendance creation page.','TL-80','INS->LDAGULTO->2022-03-14 02:57:21'),(39,'Attendance Adjustment','Polices attendance adjustment page.','TL-81','INS->LDAGULTO->2022-03-14 02:58:35'),(40,'Attendance Creation Recommendation','Policies for attendance creation recommendation page.','TL-82','INS->LDAGULTO->2022-03-18 09:44:10'),(41,'Attendance Adjustment Recommendation','Policies on attendance adjustment recommendation page.','TL-83','INS->LDAGULTO->2022-03-18 09:44:30'),(42,'Attendance Creation Approval','Policies on attendance creation approval page.','TL-84','INS->LDAGULTO->2022-03-23 08:32:49'),(43,'Attendance Adjustment Approval','Policies on attendance adjustment approval page.','TL-85','INS->LDAGULTO->2022-03-23 08:39:52'),(44,'Employee Leave Management','Policies on leave management page.','TL-86','UPD->LDAGULTO->2022-03-24 04:54:36'),(45,'Leave Approval','Policies on leave approval page.','TL-87','INS->LDAGULTO->2022-03-30 02:42:08'),(46,'Allowance Type','Policies on allowance type page.','TL-88','INS->LDAGULTO->2022-04-01 03:35:06'),(47,'Allowance','Policies on allowance page.','TL-89','INS->LDAGULTO->2022-04-05 11:38:39'),(48,'Deduction Type','Policies on deduction type page.','TL-90','INS->LDAGULTO->2022-04-06 05:10:06'),(49,'Government Contributions','Policies on government contributions page.','TL-91','INS->LDAGULTO->2022-04-08 10:31:37'),(50,'Contribution Bracket','Policies on contribution bracket page.','TL-92','INS->LDAGULTO->2022-04-08 11:19:21'),(51,'Deduction','Policies on deduction page.','TL-93','UPD->LDAGULTO->2022-04-13 09:09:09'),(52,'Contribution Deduction','Policies on contribution deduction page.','TL-94','INS->LDAGULTO->2022-04-13 10:55:21'),(53,'Employee Allowance','Policies on employee allowance on employee details page.','TL-95','INS->LDAGULTO->2022-04-13 01:51:04'),(54,'Attendance Summary','Policies on attendance summary page.','TL-96','INS->LDAGULTO->2022-04-14 03:46:16'),(55,'Import Employee','Policies on import employee page.','TL-97','INS->LDAGULTO->2022-04-16 06:40:15'),(56,'Import Attendance Record','Policies on import attendance record page.','TL-98','INS->LDAGULTO->2022-04-19 02:54:20'),(57,'Import Leave Entitlement','Policies on import leave entitlement page.','TL-99','INS->LDAGULTO->2022-04-20 11:06:41'),(58,'Import Leave','Policies on import leave page.','TL-100','INS->LDAGULTO->2022-04-20 02:19:55'),(59,'Import Attendance Adjustment','Policies on attendance adjustment page.','TL-101','UPD->LDAGULTO->2022-04-21 09:28:45'),(60,'Import Attendance Creation','Policies on attendance creation page.','TL-102','INS->LDAGULTO->2022-04-21 09:29:00'),(61,'Import Allowance','Policies on import allowance page.','TL-103','INS->LDAGULTO->2022-04-22 02:23:37'),(62,'Import Deduction','Policies on import deduction page.','TL-104','INS->LDAGULTO->2022-04-22 03:53:38'),(63,'Import Government Contribution','Policies on government contribution page.','TL-105','INS->LDAGULTO->2022-04-22 04:30:38'),(64,'Import Contribution Bracket','Policies on import contribution bracket page.','TL-106','UPD->LDAGULTO->2022-05-18 07:53:30'),(65,'Import Contribution Deduction','Policies on import contribution deduction page.','TL-107','INS->LDAGULTO->2022-04-22 07:16:33'),(66,'Notification','Policies on notification page.','TL-108','INS->LDAGULTO->2022-04-26 09:03:21'),(67,'General','Global policies of the system.','TL-109','INS->LDAGULTO->2022-04-26 11:04:41'),(68,'Salary','Policies on salary page.','TL-110','INS->LDAGULTO->2022-04-26 01:56:24'),(69,'Payroll Setting','Policies  on payroll setting page.','TL-111','INS->LDAGULTO->2022-04-28 09:42:41'),(70,'Payroll Group','Policies on payroll group page.','TL-112','INS->LDAGULTO->2022-05-08 06:17:30'),(71,'Pay Run','Policies on pay run page.','TL-113','UPD->LDAGULTO->2022-05-08 07:54:35'),(72,'Payslip','Policies on payslip page.','TL-114','UPD->LDAGULTO->2022-05-22 09:48:30'),(73,'Withholding Tax','Policies on withholding tax page.','TL-115','INS->LDAGULTO->2022-05-18 05:06:59'),(74,'Import Withholding Tax','Policies on import withholding tax page.','TL-116','INS->LDAGULTO->2022-05-18 07:53:20'),(75,'Other Income Type','Policies on other income type page.','TL-117','INS->LDAGULTO->2022-05-19 04:10:17'),(76,'Other Income','Policies on other income page.','TL-118','INS->LDAGULTO->2022-05-19 04:46:14'),(77,'Import Other Income','Policies on import other income page.','TL-119','INS->LDAGULTO->2022-05-19 07:24:37'),(78,'Payroll Summary','Policies on payroll summary page.','TL-120','INS->LDAGULTO->2022-05-24 05:20:41'),(79,'Employee Payroll Summary','Policies on payroll summary on employee details page.','TL-121','INS->LDAGULTO->2022-05-25 11:45:47'),(80,'Profile','Policies on profile page.','TL-122','INS->LDAGULTO->2022-05-25 02:52:50');
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
INSERT INTO `tblrole` VALUES ('RL-1','Super Administrator','Role for super administrator.','TL-462','UPD->ADMIN->2022-02-08 04:16:38');
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
INSERT INTO `tblrolepermission` VALUES ('RL-1',223,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',224,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',225,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',226,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',227,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',218,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',219,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',220,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',221,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',222,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',37,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',38,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',182,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',183,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',184,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',185,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',186,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',187,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',203,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',204,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',205,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',206,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',207,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',193,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',194,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',195,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',196,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',197,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',175,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',176,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',177,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',178,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',179,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',180,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',181,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',198,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',199,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',200,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',201,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',202,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',188,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',189,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',190,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',191,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',192,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',160,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',161,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',162,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',163,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',164,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',156,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',157,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',158,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',258,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',259,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',55,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',56,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',57,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',58,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',59,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',39,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',40,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',41,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',238,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',239,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',240,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',241,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',242,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',248,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',249,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',250,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',251,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',252,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',1,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',159,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',165,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',166,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',167,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',243,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',244,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',245,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',246,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',247,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',228,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',229,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',230,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',231,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',232,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',45,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',46,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',47,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',48,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',49,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',50,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',51,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',52,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',53,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',54,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',42,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',43,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',44,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',77,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',78,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',79,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',80,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',81,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',70,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',71,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',72,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',73,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',74,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',82,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',83,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',84,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',85,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',86,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',253,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',254,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',255,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',256,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',257,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',99,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',100,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',101,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',102,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',103,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',171,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',172,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',173,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',174,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',75,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',76,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',138,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',139,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',140,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',141,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',142,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',133,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',134,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',135,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',136,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',137,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',126,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',127,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',128,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',129,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',130,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',131,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',132,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',114,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',115,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',116,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',117,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',118,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',208,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',209,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',210,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',211,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',212,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',333,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',334,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',335,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',336,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',337,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',87,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',88,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',89,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',90,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',91,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',65,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',66,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',67,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',68,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',69,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',283,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',233,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',234,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',235,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',236,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',237,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',151,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',152,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',153,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',154,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',155,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',272,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',273,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',268,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',269,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',270,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',271,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',262,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',263,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',278,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',279,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',280,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',281,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',274,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',275,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',260,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',261,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',276,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',277,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',266,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',267,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',264,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',265,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',326,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',327,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',314,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',315,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',213,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',214,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',215,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',216,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',217,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',109,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',110,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',111,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',112,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',113,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',119,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',120,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',121,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',122,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',123,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',124,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',125,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',104,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',105,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',106,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',107,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',108,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',282,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',168,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',169,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',170,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',29,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',30,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',31,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',32,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',33,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',321,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',322,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',323,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',324,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',325,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',316,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',317,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',318,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',319,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',320,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',297,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',298,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',299,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',300,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',301,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',302,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',303,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',292,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',293,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',294,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',295,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',296,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',289,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',290,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',291,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',328,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',329,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',330,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',331,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',332,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',304,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',305,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',306,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',307,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',308,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',7,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',8,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',9,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',10,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',11,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',2,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',3,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',4,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',5,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',6,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',338,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',339,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',12,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',13,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',14,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',15,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',16,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',17,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',18,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',284,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',285,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',286,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',287,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',288,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',24,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',25,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',26,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',27,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',28,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',19,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',20,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',21,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',22,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',23,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',60,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',61,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',62,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',63,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',64,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',143,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',144,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',145,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',146,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',147,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',148,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',149,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',150,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',34,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',35,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',36,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',309,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',310,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',311,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',312,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',313,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',92,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',93,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',94,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',95,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',96,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',97,'INS->ADMIN->2022-05-25 09:07:59'),('RL-1',98,'INS->ADMIN->2022-05-25 09:07:59');
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
INSERT INTO `tblroleuser` VALUES ('RL-1','ADMIN',NULL);
/*!40000 ALTER TABLE `tblroleuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsalary`
--

DROP TABLE IF EXISTS `tblsalary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblsalary` (
  `SALARY_ID` varchar(100) NOT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `SALARY_AMOUNT` double NOT NULL,
  `SALARY_FREQUENCY` varchar(20) NOT NULL,
  `HOURS_PER_WEEK` int(11) NOT NULL,
  `HOURS_PER_DAY` int(11) NOT NULL,
  `MINUTE_RATE` double NOT NULL,
  `HOURLY_RATE` double NOT NULL,
  `DAILY_RATE` double NOT NULL,
  `WEEKLY_RATE` double NOT NULL,
  `BI_WEEKLY_RATE` double NOT NULL,
  `MONTHLY_RATE` double NOT NULL,
  `EFFECTIVITY_DATE` date NOT NULL,
  `REMARKS` varchar(500) DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`SALARY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsalary`
--

LOCK TABLES `tblsalary` WRITE;
/*!40000 ALTER TABLE `tblsalary` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblsalary` ENABLE KEYS */;
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
INSERT INTO `tblsystemcode` VALUES ('SYSTYPE','SYSTYPE','System Type','TL-463',NULL),('SYSTYPE','MAILENCRYPTION','Mail Encryption','TL-464','INS->ADMIN->2022-01-03 04:05:06'),('MAILENCRYPTION','None','None','TL-465','INS->ADMIN->2022-01-03 04:05:16'),('MAILENCRYPTION','TLS','TLS','TL-466','INS->ADMIN->2022-01-03 04:05:35'),('MAILENCRYPTION','SSL','SSL','TL-467','INS->ADMIN->2022-01-03 04:05:41'),('MAILENCRYPTION','STARTTLS','STARTTLS','TL-468','INS->ADMIN->2022-01-03 04:07:42'),('SYSTYPE','FILETYPE','File Type','TL-469','INS->ADMIN->2022-01-05 10:44:52'),('FILETYPE','doc','Word (.doc)','TL-470','INS->ADMIN->2022-01-05 10:47:34'),('FILETYPE','docx','Word (.docx)','TL-471','INS->ADMIN->2022-01-05 10:47:41'),('FILETYPE','xls','Excel (.xls)','TL-472','INS->ADMIN->2022-01-05 10:48:04'),('FILETYPE','xlsx','Excel (.xlsx)','TL-473','INS->ADMIN->2022-01-05 10:48:14'),('FILETYPE','ppt','Powerpoint (.ppt)','TL-474','INS->ADMIN->2022-01-05 10:48:33'),('FILETYPE','pptx','Powerpoint (.pptx)','TL-475','INS->ADMIN->2022-01-05 10:48:44'),('FILETYPE','zip','Compressed (.zip)','TL-476','INS->ADMIN->2022-01-05 10:49:22'),('FILETYPE','7z','Compressed (.7z)','TL-477','INS->ADMIN->2022-01-05 10:49:32'),('FILETYPE','rar','Compressed (.rar)','TL-478','INS->ADMIN->2022-01-05 10:49:40'),('FILETYPE','pdf','Document (.pdf)','TL-479','INS->ADMIN->2022-01-05 10:50:00'),('FILETYPE','txt','Document (.txt)','TL-480','INS->ADMIN->2022-01-05 10:50:15'),('FILETYPE','csv','Data (.csv)','TL-481','UPD->ADMIN->2022-01-05 10:53:40'),('FILETYPE','mp3','Audio (.mp3)','TL-482','INS->ADMIN->2022-01-05 10:52:38'),('FILETYPE','wav','Audio (.wav)','TL-483','INS->ADMIN->2022-01-05 10:52:57'),('FILETYPE','sql','Data (.sql)','TL-484','INS->ADMIN->2022-01-05 10:53:52'),('FILETYPE','db','Data (.db)','TL-485','INS->ADMIN->2022-01-05 10:54:14'),('FILETYPE','dbf','Data (.dbf)','TL-486','INS->ADMIN->2022-01-05 10:54:33'),('FILETYPE','gif','Image (.gif)','TL-487','INS->ADMIN->2022-01-05 10:55:08'),('FILETYPE','.ico','Image (.ico)','TL-488','INS->ADMIN->2022-01-05 10:55:20'),('FILETYPE','jpeg','Image (.jpeg)','TL-489','INS->ADMIN->2022-01-05 11:07:24'),('FILETYPE','jpg','Image (.jpg)','TL-490','INS->ADMIN->2022-01-05 11:07:36'),('FILETYPE','png','Image (.png)','TL-491','INS->ADMIN->2022-01-05 11:08:03'),('FILETYPE','svg','Image (.svg)','TL-492','INS->ADMIN->2022-01-05 11:08:18'),('FILETYPE','mp4','Video (.mp4)','TL-493','INS->ADMIN->2022-01-05 11:09:34'),('FILETYPE','mkv','Video (.mkv)','TL-494','INS->ADMIN->2022-01-05 11:09:49'),('FILETYPE','mov','Video (.mov)','TL-495','INS->ADMIN->2022-01-05 11:10:02'),('FILETYPE','mpg','Video (.mpg)','TL-496','INS->ADMIN->2022-01-05 11:10:16'),('FILETYPE','mpeg','Video (.mpeg)','TL-497','INS->ADMIN->2022-01-05 11:10:29'),('FILETYPE','wmv','Video (.wmv)','TL-498','INS->ADMIN->2022-01-05 11:10:42'),('FILETYPE','avi','Video (.avi)','TL-499','INS->ADMIN->2022-01-05 11:10:57'),('FILETYPE','flv','Video (.flv)','TL-500','INS->ADMIN->2022-01-05 11:11:09'),('SYSTYPE','COLORVALUE','Color Value','TL-501','INS->ADMIN->2022-01-10 10:12:43'),('COLORVALUE','primary','Primary','TL-502','INS->ADMIN->2022-01-10 10:13:01'),('COLORVALUE','secondary','Secondary','TL-503','INS->ADMIN->2022-01-10 10:13:10'),('COLORVALUE','success','Success','TL-504','INS->ADMIN->2022-01-10 10:13:18'),('COLORVALUE','info','Info','TL-505','INS->ADMIN->2022-01-10 10:13:26'),('COLORVALUE','warning','Warning','TL-506','UPD->ADMIN->2022-01-10 10:13:39'),('COLORVALUE','danger','Danger','TL-507','INS->ADMIN->2022-01-10 10:13:54'),('COLORVALUE','dark','Dark','TL-508','INS->ADMIN->2022-01-10 10:14:08'),('COLORVALUE','light','Light','TL-509','INS->ADMIN->2022-01-10 10:14:18'),('SYSTYPE','SUFFIX','Suffix','TL-510','INS->ADMIN->2022-01-11 08:48:51'),('SUFFIX','JR','Jr.','TL-511','INS->ADMIN->2022-01-11 08:49:03'),('SUFFIX','SR','Sr.','TL-512','INS->ADMIN->2022-01-11 08:49:09'),('SUFFIX','I','I','TL-513','INS->ADMIN->2022-01-11 08:49:15'),('SUFFIX','II','II','TL-514','INS->ADMIN->2022-01-11 08:49:20'),('SUFFIX','III','III','TL-515','INS->ADMIN->2022-01-11 08:49:26'),('SYSTYPE','GENDER','Gender','TL-516','INS->ADMIN->2022-01-15 09:03:48'),('GENDER','MALE','Male','TL-517','INS->ADMIN->2022-01-15 09:03:56'),('GENDER','FEMALE','Female','TL-518','INS->ADMIN->2022-01-15 09:04:22'),('SYSTYPE','RELATIONSHIP','Relationship','TL-519','INS->ADMIN->2022-01-16 03:11:52'),('RELATIONSHIP','MOTHER','Mother','TL-520','INS->ADMIN->2022-01-16 03:12:00'),('RELATIONSHIP','FATHER','Father','TL-521','INS->ADMIN->2022-01-16 03:12:12'),('RELATIONSHIP','SISTER','Sister','TL-522','INS->ADMIN->2022-01-16 03:12:28'),('RELATIONSHIP','BROTHER','Brother','TL-523','INS->ADMIN->2022-01-16 03:12:39'),('RELATIONSHIP','GRANDMOTHER','Grand Mother','TL-524','INS->ADMIN->2022-01-16 03:12:55'),('RELATIONSHIP','GRANDFATHER','Grand Father','TL-525','INS->ADMIN->2022-01-16 03:13:10'),('RELATIONSHIP','HUSBAND','Husband','TL-526','INS->ADMIN->2022-01-16 03:13:19'),('RELATIONSHIP','WIFE','Wife','TL-527','INS->ADMIN->2022-01-16 03:13:27'),('RELATIONSHIP','SON','Son','TL-528','INS->ADMIN->2022-01-16 03:13:35'),('RELATIONSHIP','DAUGTHER','Daughter','TL-529','INS->ADMIN->2022-01-16 03:13:48'),('RELATIONSHIP','GRANDSON','Grand Son','TL-530','INS->ADMIN->2022-01-16 03:13:58'),('RELATIONSHIP','GRANDDAUGHTER','Grand Daughter','TL-531','INS->ADMIN->2022-01-16 03:14:21'),('RELATIONSHIP','FRIEND','Friend','TL-532','INS->ADMIN->2022-01-16 03:14:31'),('SYSTYPE','ADDRESSTYPE','Address Type','TL-533','INS->ADMIN->2022-01-17 11:03:52'),('ADDRESSTYPE','PERMANENT','Permanent','TL-534','INS->ADMIN->2022-01-17 11:04:00'),('ADDRESSTYPE','CURRENT','Current','TL-535','INS->ADMIN->2022-01-17 11:04:08'),('SYSTYPE','SOCIAL','Social','TL-536','INS->ADMIN->2022-01-17 01:02:20'),('SOCIAL','FACEBOOK','Facebook','TL-537','INS->ADMIN->2022-01-17 01:02:29'),('SOCIAL','TWITTER','Twitter','TL-538','INS->ADMIN->2022-01-17 01:02:39'),('SOCIAL','LINKEDIN','LinkedIn','TL-539','INS->ADMIN->2022-01-17 01:02:49'),('SOCIAL','INSTAGRAM','Instagram','TL-540','INS->ADMIN->2022-01-17 01:03:00'),('SYSTYPE','WORKSHIFT','Work Shift','TL-541','INS->ADMIN->2022-01-18 11:23:04'),('WORKSHIFT','REGULAR','Regular','TL-542','INS->ADMIN->2022-01-18 11:23:11'),('WORKSHIFT','SCHEDULED','Scheduled','TL-543','INS->ADMIN->2022-01-18 11:25:10'),('SYSTYPE','PAIDSTATUS','Paid Status','TL-544','INS->ADMIN->2022-01-27 10:20:17'),('PAIDSTATUS','PAID','Paid','TL-545','INS->ADMIN->2022-01-27 10:20:23'),('PAIDSTATUS','UNPAID','Unpaid','TL-546','INS->ADMIN->2022-01-27 10:20:34'),('SYSTYPE','LEAVEDURATION','Leave Duration','TL-547','INS->ADMIN->2022-01-28 09:28:03'),('LEAVEDURATION','SINGLE','Single','TL-548','INS->ADMIN->2022-01-28 09:28:49'),('LEAVEDURATION','MULTIPLE','Multiple','TL-549','INS->ADMIN->2022-01-28 09:28:58'),('LEAVEDURATION','HLFDAYMOR','Half Day (Morning)','TL-550','INS->ADMIN->2022-01-28 09:29:12'),('LEAVEDURATION','CUSTOM','Custom','TL-551','INS->ADMIN->2022-01-28 09:29:20'),('LEAVEDURATION','HLFDAYAFT','Half Day (Afternoon)','TL-552','INS->ADMIN->2022-01-28 09:29:35'),('SYSTYPE','FILECATEGORY','File Category','TL-553','INS->ADMIN->2022-02-02 11:53:57'),('FILECATEGORY','COMMENDATION','Commendation','TL-554','INS->ADMIN->2022-02-02 11:54:29'),('FILECATEGORY','PAYSLIP','Pay Slip','TL-555','INS->ADMIN->2022-02-02 11:54:39'),('SYSTYPE','HOLIDAYTYPE','Holiday Type','TL-556','INS->LDAGULTO->2022-02-10 02:24:07'),('HOLIDAYTYPE','SPCWORKHOL','Special Working Holiday','TL-557','INS->LDAGULTO->2022-02-10 02:25:27'),('HOLIDAYTYPE','LOCHOL','Local Holiday','TL-558','INS->LDAGULTO->2022-02-10 02:25:39'),('HOLIDAYTYPE','SPCNONWORKHOL','Special Non-working Holiday','TL-559','INS->LDAGULTO->2022-02-10 02:25:51'),('HOLIDAYTYPE','REGHOL','Regular Holiday','TL-560','INS->LDAGULTO->2022-02-10 02:26:03'),('SYSTYPE','LVAPVSTAT','Leave Approval Status','TL-561','INS->LDAGULTO->2022-03-16 10:57:12'),('LVAPVSTAT','APV','Approved','TL-562','INS->LDAGULTO->2022-03-16 10:57:23'),('LVAPVSTAT','APVSYS','Approved (System Generated)','TL-564','INS->LDAGULTO->2022-03-16 10:57:36'),('LVAPVSTAT','CAN','Cancelled','TL-565','INS->LDAGULTO->2022-03-16 10:57:44'),('LVAPVSTAT','PEN','Pending','TL-566','INS->LDAGULTO->2022-03-16 10:57:53'),('LVAPVSTAT','REJ','Rejected','TL-567','INS->LDAGULTO->2022-03-16 10:58:04'),('SYSTYPE','RECURRENCEPATTERN','Recurrence Pattern','TL-568','INS->LDAGULTO->2022-04-06 10:02:42'),('RECURRENCEPATTERN','MONTHLY','Monthly','TL-569','INS->LDAGULTO->2022-04-06 10:02:57'),('RECURRENCEPATTERN','DAILY','Daily','TL-570','INS->LDAGULTO->2022-04-06 10:03:06'),('RECURRENCEPATTERN','WEEKLY','Weekly','TL-571','INS->LDAGULTO->2022-04-06 10:03:17'),('RECURRENCEPATTERN','BIWEEKLY','Bi-Weekly','TL-572','INS->LDAGULTO->2022-04-06 10:03:29'),('RECURRENCEPATTERN','QUARTERLY','Quarterly','TL-573','INS->LDAGULTO->2022-04-06 10:03:48'),('RECURRENCEPATTERN','YEARLY','Yearly','TL-574','INS->LDAGULTO->2022-04-06 10:03:58'),('SYSTYPE','SALARYFREQUENCY','Salary Frequency','TL-575','INS->LDAGULTO->2022-05-05 04:05:54'),('SALARYFREQUENCY','MONTHLY','Monthly','TL-576','INS->LDAGULTO->2022-05-05 04:06:07'),('SALARYFREQUENCY','BIWEEKLY','Bi-Weekly','TL-577','INS->LDAGULTO->2022-05-05 04:06:21'),('SALARYFREQUENCY','WEEKLY','Weekly','TL-578','INS->LDAGULTO->2022-05-05 04:06:32'),('SALARYFREQUENCY','DAILY','Daily','TL-579','INS->LDAGULTO->2022-05-05 04:06:42');
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
INSERT INTO `tblsystemnotification` VALUES (1,'S','INS->LDAGULTO->2022-05-25 11:42:58'),(1,'E','INS->LDAGULTO->2022-05-25 11:42:58'),(2,'S','INS->LDAGULTO->2022-05-25 11:42:58'),(2,'E','INS->LDAGULTO->2022-05-25 11:42:58'),(3,'S','INS->LDAGULTO->2022-05-25 11:42:58'),(3,'E','INS->LDAGULTO->2022-05-25 11:42:58'),(15,'S','INS->LDAGULTO->2022-05-25 11:42:58'),(15,'E','INS->LDAGULTO->2022-05-25 11:42:58'),(4,'S','INS->LDAGULTO->2022-05-25 11:42:58'),(4,'E','INS->LDAGULTO->2022-05-25 11:42:58'),(10,'S','INS->LDAGULTO->2022-05-25 11:42:58'),(10,'E','INS->LDAGULTO->2022-05-25 11:42:58'),(9,'S','INS->LDAGULTO->2022-05-25 11:42:58'),(9,'E','INS->LDAGULTO->2022-05-25 11:42:58'),(19,'S','INS->LDAGULTO->2022-05-25 11:42:58'),(19,'E','INS->LDAGULTO->2022-05-25 11:42:58'),(14,'S','INS->LDAGULTO->2022-05-25 11:42:58'),(14,'E','INS->LDAGULTO->2022-05-25 11:42:58'),(8,'S','INS->LDAGULTO->2022-05-25 11:42:58'),(8,'E','INS->LDAGULTO->2022-05-25 11:42:58'),(6,'S','INS->LDAGULTO->2022-05-25 11:42:58'),(6,'E','INS->LDAGULTO->2022-05-25 11:42:58'),(12,'S','INS->LDAGULTO->2022-05-25 11:42:58'),(12,'E','INS->LDAGULTO->2022-05-25 11:42:59'),(13,'S','INS->LDAGULTO->2022-05-25 11:42:59'),(13,'E','INS->LDAGULTO->2022-05-25 11:42:59'),(7,'S','INS->LDAGULTO->2022-05-25 11:42:59'),(7,'E','INS->LDAGULTO->2022-05-25 11:42:59'),(5,'S','INS->LDAGULTO->2022-05-25 11:42:59'),(5,'E','INS->LDAGULTO->2022-05-25 11:42:59'),(11,'S','INS->LDAGULTO->2022-05-25 11:42:59'),(11,'E','INS->LDAGULTO->2022-05-25 11:42:59'),(16,'S','INS->LDAGULTO->2022-05-25 11:42:59'),(16,'E','INS->LDAGULTO->2022-05-25 11:42:59'),(18,'S','INS->LDAGULTO->2022-05-25 11:42:59'),(18,'E','INS->LDAGULTO->2022-05-25 11:42:59'),(17,'S','INS->LDAGULTO->2022-05-25 11:42:59'),(17,'E','INS->LDAGULTO->2022-05-25 11:42:59');
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
INSERT INTO `tblsystemparameters` VALUES (1,'System Parameter','',41,'TL-2','UPD->LDAGULTO->2022-05-19 04:21:27'),(2,'Transaction Log','TL-',542,'TL-3','UPD->LDAGULTO->2022-05-25 08:00:38'),(3,'Policy','',80,'TL-4','UPD->LDAGULTO->2022-05-25 02:52:51'),(4,'Permission','',339,'TL-5','UPD->LDAGULTO->2022-05-25 04:39:55'),(5,'Role','RL-',1,'TL-6','UPD->LDAGULTO->2022-05-25 08:00:47'),(6,'Notification Type','',19,'TL-7','UPD->LDAGULTO->2022-05-24 05:16:31'),(7,'Department','DEPT-',0,'TL-8','UPD->LDAGULTO->2022-05-25 08:01:20'),(8,'Designation','DES-',0,'TL-9','UPD->LDAGULTO->2022-05-25 08:01:23'),(9,'Branch','BRCH-',0,'TL-10','UPD->LDAGULTO->2022-05-25 08:01:26'),(10,'Upload Setting','',20,'TL-11','UPD->LDAGULTO->2022-05-22 09:01:34'),(11,'Employment Status','',0,'TL-12','UPD->ADMIN->2022-05-25 09:12:43'),(12,'Employee ID','',0,'TL-13','UPD->LDAGULTO->2022-05-25 08:01:33'),(13,'Emergency Contact','',0,'TL-14','UPD->ADMIN->2022-01-17 10:52:33'),(14,'Employee Address','',0,'TL-15','UPD->ADMIN->2022-01-17 01:00:19'),(15,'Employee Social','',0,'TL-16','UPD->ADMIN->2022-01-17 01:43:00'),(16,'Work Shift','',0,'TL-17','UPD->LDAGULTO->2022-05-25 08:01:56'),(17,'Employee Attendance','',0,'TL-18','UPD->LDAGULTO->2022-05-25 08:02:01'),(18,'Leave Type','LEAVETP-',0,'TL-19','UPD->ADMIN->2022-05-25 09:13:07'),(19,'Leave Entitlement','LVENT-',0,'TL-20','UPD->LDAGULTO->2022-05-25 08:02:08'),(20,'Leave','LV-',0,'TL-21','UPD->LDAGULTO->2022-05-25 08:02:11'),(21,'Employee File','',0,'TL-22','UPD->LDAGULTO->2022-05-25 08:02:16'),(22,'Holiday','HOL-',0,'TL-23','UPD->LDAGULTO->2022-05-25 08:01:43'),(23,'Health Declaration','',0,'TL-24','UPD->LDAGULTO->2022-05-25 08:02:21'),(24,'Location','',0,'TL-25','UPD->LDAGULTO->2022-05-25 08:02:25'),(25,'Notification','',0,'TL-26','UPD->LDAGULTO->2022-05-25 08:02:59'),(26,'Attendance Creation','',0,'TL-27','UPD->LDAGULTO->2022-05-25 08:03:06'),(27,'Attendance Adjustment','',0,'TL-28','UPD->LDAGULTO->2022-05-25 08:03:09'),(28,'Allowance Type','',0,'TL-29','UPD->LDAGULTO->2022-05-25 08:03:47'),(29,'Allowance','',0,'TL-30','UPD->LDAGULTO->2022-05-22 08:48:30'),(30,'Deduction Type','',0,'TL-31','UPD->LDAGULTO->2022-05-25 08:03:55'),(31,'Government Contribution','',0,'TL-32','UPD->LDAGULTO->2022-05-25 08:04:03'),(32,'Contribution Bracket','',0,'TL-33','UPD->LDAGULTO->2022-05-25 08:04:07'),(33,'Deduction','',0,'TL-34','UPD->LDAGULTO->2022-05-25 08:04:11'),(34,'Contribution Deduction','',0,'TL-35','UPD->LDAGULTO->2022-05-25 08:04:14'),(35,'Salary','',0,'TL-36','UPD->LDAGULTO->2022-05-25 08:04:25'),(36,'Payroll Group','',0,'TL-37','UPD->LDAGULTO->2022-05-25 08:04:20'),(37,'Pay Run','',0,'TL-38','UPD->LDAGULTO->2022-05-25 08:04:29'),(38,'Payslip','',0,'TL-39','UPD->LDAGULTO->2022-05-25 08:04:37'),(39,'Withholding Tax','',0,'TL-40','UPD->LDAGULTO->2022-05-25 08:04:46'),(40,'Other Income Type','',0,'TL-41','UPD->LDAGULTO->2022-05-25 08:04:50'),(41,'Other Income','',0,'TL-42','UPD->LDAGULTO->2022-05-25 08:04:54');
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
INSERT INTO `tbltransactionlog` VALUES ('TL-1','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-2','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-3','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-4','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-5','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-6','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-7','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-8','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-9','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-10','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-11','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-12','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-13','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-14','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-15','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-16','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-17','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-18','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-19','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-20','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-21','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-22','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-23','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-24','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-25','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-26','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-27','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-28','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-29','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-30','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-31','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-32','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-33','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-34','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-35','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-36','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-37','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-38','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-39','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-40','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-41','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-42','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-43','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-44','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-45','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-46','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-47','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-48','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-49','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-50','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-51','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-52','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-53','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-54','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-55','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-56','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-57','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-58','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-59','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-60','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-61','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-62','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-63','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-64','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-65','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-66','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-67','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-68','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-69','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-70','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-71','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-72','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-73','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-74','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-75','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-76','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-77','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-78','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-79','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-80','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-81','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-82','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-83','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-84','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-85','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-86','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-87','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-88','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-89','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-90','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-91','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-92','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-93','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-94','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-95','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-96','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-97','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-98','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-99','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-100','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-101','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-102','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-103','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-104','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-105','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-106','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-107','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-108','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-109','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-110','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-111','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-112','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-113','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-114','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-115','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-116','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-117','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-118','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-119','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-120','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-121','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-122','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-123','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-124','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-125','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-126','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-127','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-128','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-129','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-130','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-131','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-132','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-133','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-134','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-135','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-136','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-137','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-138','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-139','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-140','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-141','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-142','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-143','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-144','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-145','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-146','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-147','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-148','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-149','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-150','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-151','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-152','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-153','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-154','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-155','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-156','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-157','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-158','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-159','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-160','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-161','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-162','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-163','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-164','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-165','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-166','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-167','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-168','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-169','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-170','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-171','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-172','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-173','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-174','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-175','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-176','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-177','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-178','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-179','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-180','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-181','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-182','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-183','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-184','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-185','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-186','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-187','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-188','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-189','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-190','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-191','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-192','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-193','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-194','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-195','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-196','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-197','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-198','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-199','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-200','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-201','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-202','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-203','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-204','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-205','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-206','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-207','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-208','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-209','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-210','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-211','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-212','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-213','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-214','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-215','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-216','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-217','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-218','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-219','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-220','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-221','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-222','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-223','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-224','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-225','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-226','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-227','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-228','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-229','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-230','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-231','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-232','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-233','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-234','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-235','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-236','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-237','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-238','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-239','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-240','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-241','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-242','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-243','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-244','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-245','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-246','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-247','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-248','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-249','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-250','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-251','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-252','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-253','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-254','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-255','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-256','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-257','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-258','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-259','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-260','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-261','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-262','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-263','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-264','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-265','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-266','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-267','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-268','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-269','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-270','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-271','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-272','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-273','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-274','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-275','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-276','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-277','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-278','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-279','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-280','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-281','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-282','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-283','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-284','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-285','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-286','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-287','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-288','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-289','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-290','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-291','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-292','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-293','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-294','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-295','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-296','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-297','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-298','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-299','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-300','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-301','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-302','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-303','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-304','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-305','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-306','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-307','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-308','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-309','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-310','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-311','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-312','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-313','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-314','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-315','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-316','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-317','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-318','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-319','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-320','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-321','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-322','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-323','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-324','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-325','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-326','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-327','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-328','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-329','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-330','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-331','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-332','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-333','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-334','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-335','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-336','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-337','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-338','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-339','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-340','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-341','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-342','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-343','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-344','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-345','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-346','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-347','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-348','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-349','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-350','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-351','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-352','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-353','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-354','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-355','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-356','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-357','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-358','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-359','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-360','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-361','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-362','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-363','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-364','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-365','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-366','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-367','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-368','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-369','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-370','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-371','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-372','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-373','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-374','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-375','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-376','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-377','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-378','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-379','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-380','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-381','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-382','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-383','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-384','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-385','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-386','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-387','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-388','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-389','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-390','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-391','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-392','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-393','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-394','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-395','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-396','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-397','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-398','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-399','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-400','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-401','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-402','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-403','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-404','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-405','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-406','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-407','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-408','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-409','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-410','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-411','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-412','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-413','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-414','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-415','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-416','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-417','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-418','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-419','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-420','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-421','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-422','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-423','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-424','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-425','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-426','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-427','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-428','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-429','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-430','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-431','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-432','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-433','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-434','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-435','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-436','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-437','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-438','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-439','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-440','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-441','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-442','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-443','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-444','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-445','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-446','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-447','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-448','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-449','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-450','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-451','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-452','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-453','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-454','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-455','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-456','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-457','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-458','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-459','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-460','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-461','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-462','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-463','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-464','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-465','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-466','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-467','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-468','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-469','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-470','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-471','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-472','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-473','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-474','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-475','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-476','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-477','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-478','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-479','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-480','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-481','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-482','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-483','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-484','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-485','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-486','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-487','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-488','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-489','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-490','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-491','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-492','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-493','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-494','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-495','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-496','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-497','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-498','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-499','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-500','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-501','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-502','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-503','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-504','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-505','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-506','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-507','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-508','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-509','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-510','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-511','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-512','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-513','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-514','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-515','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-516','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-517','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-518','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-519','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-520','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-521','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-522','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-523','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-524','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-525','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-526','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-527','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-528','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-529','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-530','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-531','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-532','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-533','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-534','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-535','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-536','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-537','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-538','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-539','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-540','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-541','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.'),('TL-542','ADMIN','Insert','2022-05-26 00:00:00','User ADMIN inserted this data.');
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
INSERT INTO `tbluploadfiletype` VALUES (NULL,'gif','INS->ADMIN->2022-01-06 11:38:01'),(NULL,'jpeg','INS->ADMIN->2022-01-06 11:38:01'),(NULL,'jpg','INS->ADMIN->2022-01-06 11:38:01'),(NULL,'png','INS->ADMIN->2022-01-06 11:38:01'),(NULL,'svg','INS->ADMIN->2022-01-06 11:38:01'),(1,'gif','INS->ADMIN->2022-01-06 11:38:21'),(1,'jpeg','INS->ADMIN->2022-01-06 11:38:21'),(1,'jpg','INS->ADMIN->2022-01-06 11:38:21'),(1,'png','INS->ADMIN->2022-01-06 11:38:21'),(1,'svg','INS->ADMIN->2022-01-06 11:38:21'),(2,'gif','INS->ADMIN->2022-01-06 11:47:55'),(2,'jpeg','INS->ADMIN->2022-01-06 11:47:55'),(2,'jpg','INS->ADMIN->2022-01-06 11:47:55'),(2,'png','INS->ADMIN->2022-01-06 11:47:55'),(2,'svg','INS->ADMIN->2022-01-06 11:47:55'),(3,'gif','INS->ADMIN->2022-01-06 11:48:16'),(3,'jpeg','INS->ADMIN->2022-01-06 11:48:16'),(3,'jpg','INS->ADMIN->2022-01-06 11:48:16'),(3,'png','INS->ADMIN->2022-01-06 11:48:17'),(3,'svg','INS->ADMIN->2022-01-06 11:48:17'),(4,'gif','INS->ADMIN->2022-01-06 11:49:56'),(4,'jpeg','INS->ADMIN->2022-01-06 11:49:56'),(4,'jpg','INS->ADMIN->2022-01-06 11:49:56'),(4,'png','INS->ADMIN->2022-01-06 11:49:56'),(4,'svg','INS->ADMIN->2022-01-06 11:49:56'),(5,'gif','INS->ADMIN->2022-01-06 11:50:27'),(5,'jpeg','INS->ADMIN->2022-01-06 11:50:27'),(5,'jpg','INS->ADMIN->2022-01-06 11:50:27'),(5,'png','INS->ADMIN->2022-01-06 11:50:27'),(5,'svg','INS->ADMIN->2022-01-06 11:50:27'),(6,'gif','INS->ADMIN->2022-01-06 11:50:58'),(6,'.ico','INS->ADMIN->2022-01-06 11:50:58'),(6,'jpeg','INS->ADMIN->2022-01-06 11:50:58'),(6,'jpg','INS->ADMIN->2022-01-06 11:50:59'),(6,'png','INS->ADMIN->2022-01-06 11:50:59'),(6,'svg','INS->ADMIN->2022-01-06 11:50:59'),(7,'pdf','INS->ADMIN->2022-01-06 11:56:11'),(8,'pdf','INS->ADMIN->2022-02-02 11:34:54'),(8,'txt','INS->ADMIN->2022-02-02 11:34:54'),(8,'xls','INS->ADMIN->2022-02-02 11:34:54'),(8,'xlsx','INS->ADMIN->2022-02-02 11:34:54'),(8,'jpeg','INS->ADMIN->2022-02-02 11:34:54'),(8,'jpg','INS->ADMIN->2022-02-02 11:34:54'),(8,'png','INS->ADMIN->2022-02-02 11:34:54'),(8,'svg','INS->ADMIN->2022-02-02 11:34:54'),(8,'ppt','INS->ADMIN->2022-02-02 11:34:54'),(8,'pptx','INS->ADMIN->2022-02-02 11:34:54'),(8,'doc','INS->ADMIN->2022-02-02 11:34:54'),(8,'docx','INS->ADMIN->2022-02-02 11:34:54'),(10,'pdf','INS->LDAGULTO->2022-03-11 02:48:59'),(10,'gif','INS->LDAGULTO->2022-03-11 02:48:59'),(10,'jpeg','INS->LDAGULTO->2022-03-11 02:48:59'),(10,'jpg','INS->LDAGULTO->2022-03-11 02:48:59'),(10,'png','INS->LDAGULTO->2022-03-11 02:48:59'),(10,'svg','INS->LDAGULTO->2022-03-11 02:48:59'),(9,'pdf','INS->LDAGULTO->2022-03-11 02:50:47'),(9,'gif','INS->LDAGULTO->2022-03-11 02:50:47'),(9,'jpeg','INS->LDAGULTO->2022-03-11 02:50:47'),(9,'jpg','INS->LDAGULTO->2022-03-11 02:50:47'),(9,'png','INS->LDAGULTO->2022-03-11 02:50:47'),(9,'svg','INS->LDAGULTO->2022-03-11 02:50:47'),(11,'pdf','INS->LDAGULTO->2022-03-25 03:30:04'),(11,'jpeg','INS->LDAGULTO->2022-03-25 03:30:04'),(11,'jpg','INS->LDAGULTO->2022-03-25 03:30:04'),(11,'png','INS->LDAGULTO->2022-03-25 03:30:04'),(12,'csv','INS->LDAGULTO->2022-04-18 09:56:21'),(13,'csv','INS->LDAGULTO->2022-04-19 04:30:47'),(14,'csv','INS->LDAGULTO->2022-04-20 11:16:08'),(15,'csv','INS->LDAGULTO->2022-04-20 01:57:42'),(16,'csv','INS->LDAGULTO->2022-04-21 09:27:16'),(17,'csv','INS->LDAGULTO->2022-04-21 09:27:35'),(18,'csv','INS->LDAGULTO->2022-05-19 12:09:24'),(19,'csv','INS->LDAGULTO->2022-05-19 07:39:48'),(20,'jpeg','INS->LDAGULTO->2022-05-22 09:01:34'),(20,'jpg','INS->LDAGULTO->2022-05-22 09:01:34'),(20,'png','INS->LDAGULTO->2022-05-22 09:01:34');
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
INSERT INTO `tbluploadsetting` VALUES (1,'Login Background','Setting for login background on user interface setting page.',2,'TL-480','UPD->ADMIN->2022-01-06 11:38:20'),(2,'Logo Light','Setting for logo light on user interface setting page.',2,'TL-481','INS->ADMIN->2022-01-06 11:47:55'),(3,'Logo Dark','Setting for logo dark on user interface setting page.',2,'TL-482','INS->ADMIN->2022-01-06 11:48:16'),(4,'Logo Icon Light','Setting for logo icon light on user interface setting page.',2,'TL-483','INS->ADMIN->2022-01-06 11:49:56'),(5,'Logo Icon Dark','Setting for logo icon dark on user interface setting page.',2,'TL-484','INS->ADMIN->2022-01-06 11:50:27'),(6,'Favicon','Setting for favicon on user interface setting page.',2,'TL-485','INS->ADMIN->2022-01-06 11:50:58'),(7,'Job Description','Setting for job description on designation page.',2,'TL-486','INS->ADMIN->2022-01-06 11:56:11'),(8,'Employee Files','Setting for employee files on employee file management page and employee details page.',2,'TL-487','UPD->ADMIN->2022-02-02 11:34:54'),(9,'Attendance Creation','Settings for attendance creation.',2,'TL-488','UPD->LDAGULTO->2022-03-11 02:50:47'),(10,'Attendace Adjustment','Settings for attendance adjustment.',2,'TL-489','INS->LDAGULTO->2022-03-11 02:48:58'),(11,'Leave Attachment','Settings for leave attachment.',2,'TL-490','INS->LDAGULTO->2022-03-25 03:30:03'),(12,'Import Employee','Setting for import on import employee page.',2,'TL-491','UPD->LDAGULTO->2022-04-18 09:56:21'),(13,'Import Attendance Record','Setting for import on import attendance record page.',2,'TL-492','UPD->LDAGULTO->2022-04-19 04:30:47'),(14,'Import Leave Entitlement','Setting for import on import leave entitlement page.',2,'TL-493','INS->LDAGULTO->2022-04-20 11:16:08'),(15,'Import Leave','Setting for import on import leave page.',2,'TL-494','INS->LDAGULTO->2022-04-20 01:57:42'),(16,'Import Attendance Adjustment','Setting for import on import attendance adjustment page.',2,'TL-495','INS->LDAGULTO->2022-04-21 09:27:16'),(17,'Import Attendance Creation','Setting for import on import attendance creation page.',2,'TL-496','INS->LDAGULTO->2022-04-21 09:27:35'),(18,'Import Withholding Tax','Setting for import withholding tax page.',2,'TL-497','INS->LDAGULTO->2022-05-19 12:09:24'),(19,'Import Other Income','Setting for import on import other income page.',2,'TL-498','INS->LDAGULTO->2022-05-19 07:39:48'),(20,'Company Logo','Setting for company logo on company setting page.',2,'TL-499','INS->LDAGULTO->2022-05-22 09:01:34');
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
INSERT INTO `tbluseraccount` VALUES ('ADMIN','68aff5412f35ed76',1,'2022-06-01',0,NULL,'TL-1',NULL);
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
INSERT INTO `tbluserinterfacesettings` VALUES (1,'./assets/images/application-settings/login-bg.jpg','./assets/images/application-settings/logo-light.png','./assets/images/application-settings/logo-dark.png','./assets/images/application-settings/logo-icon-light.png','./assets/images/application-settings/logo-icon-dark.png','./assets/images/application-settings/favicon.png','TL-500','UPD->LDAGULTO->2022-05-22 08:59:54');
/*!40000 ALTER TABLE `tbluserinterfacesettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblwithholdingtax`
--

DROP TABLE IF EXISTS `tblwithholdingtax`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblwithholdingtax` (
  `WITHHOLDING_TAX_ID` varchar(100) NOT NULL,
  `SALARY_FREQUENCY` varchar(50) DEFAULT NULL,
  `START_RANGE` double DEFAULT NULL,
  `END_RANGE` double DEFAULT NULL,
  `FIX_COMPENSATION_LEVEL` double NOT NULL,
  `BASE_TAX` double NOT NULL,
  `PERCENT_OVER` double DEFAULT NULL,
  `TRANSACTION_LOG_ID` varchar(500) DEFAULT NULL,
  `RECORD_LOG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`WITHHOLDING_TAX_ID`),
  KEY `withholding_tax_index` (`WITHHOLDING_TAX_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblwithholdingtax`
--

LOCK TABLES `tblwithholdingtax` WRITE;
/*!40000 ALTER TABLE `tblwithholdingtax` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblwithholdingtax` ENABLE KEYS */;
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
/*!40000 ALTER TABLE `tblworkshiftschedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_allowance`
--

DROP TABLE IF EXISTS `temp_allowance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_allowance` (
  `ALLOWANCE_ID` varchar(100) DEFAULT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `ALLOWANCE_TYPE` varchar(100) NOT NULL,
  `PAYROLL_ID` varchar(100) DEFAULT NULL,
  `PAYROLL_DATE` date NOT NULL,
  `AMOUNT` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_allowance`
--

LOCK TABLES `temp_allowance` WRITE;
/*!40000 ALTER TABLE `temp_allowance` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_allowance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_attendance_adjustment`
--

DROP TABLE IF EXISTS `temp_attendance_adjustment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_attendance_adjustment` (
  `REQUEST_ID` varchar(100) DEFAULT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `ATTENDANCE_ID` varchar(100) NOT NULL,
  `TIME_IN_DATE_ADJUSTED` date DEFAULT NULL,
  `TIME_IN_ADJUSTED` time DEFAULT NULL,
  `TIME_OUT_DATE_ADJUSTED` date DEFAULT NULL,
  `TIME_OUT_ADJUSTED` time DEFAULT NULL,
  `STATUS` varchar(10) NOT NULL,
  `REASON` varchar(500) NOT NULL,
  `FILE_PATH` varchar(500) NOT NULL,
  `SANCTION` int(1) NOT NULL,
  `REQUEST_DATE` date NOT NULL,
  `REQUEST_TIME` time NOT NULL,
  `FOR_RECOMMENDATION_DATE` date DEFAULT NULL,
  `FOR_RECOMMENDATION_TIME` time DEFAULT NULL,
  `RECOMMENDATION_DATE` date DEFAULT NULL,
  `RECOMMENDATION_TIME` time DEFAULT NULL,
  `RECOMMENDED_BY` varchar(50) DEFAULT NULL,
  `DECISION_REMARKS` varchar(500) DEFAULT NULL,
  `DECISION_DATE` date DEFAULT NULL,
  `DECISION_TIME` time DEFAULT NULL,
  `DECISION_BY` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_attendance_adjustment`
--

LOCK TABLES `temp_attendance_adjustment` WRITE;
/*!40000 ALTER TABLE `temp_attendance_adjustment` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_attendance_adjustment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_attendance_creation`
--

DROP TABLE IF EXISTS `temp_attendance_creation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_attendance_creation` (
  `REQUEST_ID` varchar(100) DEFAULT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `TIME_IN_DATE` date DEFAULT NULL,
  `TIME_IN` time DEFAULT NULL,
  `TIME_OUT_DATE` date DEFAULT NULL,
  `TIME_OUT` time DEFAULT NULL,
  `STATUS` varchar(10) NOT NULL,
  `REASON` varchar(500) NOT NULL,
  `FILE_PATH` varchar(500) NOT NULL,
  `SANCTION` int(1) NOT NULL,
  `REQUEST_DATE` date NOT NULL,
  `REQUEST_TIME` time NOT NULL,
  `FOR_RECOMMENDATION_DATE` date DEFAULT NULL,
  `FOR_RECOMMENDATION_TIME` time DEFAULT NULL,
  `RECOMMENDATION_DATE` date DEFAULT NULL,
  `RECOMMENDATION_TIME` time DEFAULT NULL,
  `RECOMMENDED_BY` varchar(50) DEFAULT NULL,
  `DECISION_REMARKS` varchar(500) DEFAULT NULL,
  `DECISION_DATE` date DEFAULT NULL,
  `DECISION_TIME` time DEFAULT NULL,
  `DECISION_BY` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_attendance_creation`
--

LOCK TABLES `temp_attendance_creation` WRITE;
/*!40000 ALTER TABLE `temp_attendance_creation` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_attendance_creation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_attendance_record`
--

DROP TABLE IF EXISTS `temp_attendance_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_attendance_record` (
  `ATTENDANCE_ID` varchar(100) DEFAULT NULL,
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
-- Table structure for table `temp_contribution_bracket`
--

DROP TABLE IF EXISTS `temp_contribution_bracket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_contribution_bracket` (
  `CONTRIBUTION_BRACKET_ID` varchar(100) DEFAULT NULL,
  `GOVERNMENT_CONTRIBUTION_ID` varchar(100) NOT NULL,
  `START_RANGE` double NOT NULL,
  `END_RANGE` double NOT NULL,
  `DEDUCTION_AMOUNT` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_contribution_bracket`
--

LOCK TABLES `temp_contribution_bracket` WRITE;
/*!40000 ALTER TABLE `temp_contribution_bracket` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_contribution_bracket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_contribution_deduction`
--

DROP TABLE IF EXISTS `temp_contribution_deduction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_contribution_deduction` (
  `CONTRIBUTION_DEDUCTION_ID` varchar(100) DEFAULT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `GOVERNMENT_CONTRIBUTION_TYPE` varchar(100) NOT NULL,
  `PAYROLL_ID` varchar(100) DEFAULT NULL,
  `PAYROLL_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_contribution_deduction`
--

LOCK TABLES `temp_contribution_deduction` WRITE;
/*!40000 ALTER TABLE `temp_contribution_deduction` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_contribution_deduction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_deduction`
--

DROP TABLE IF EXISTS `temp_deduction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_deduction` (
  `DEDUCTION_ID` varchar(100) DEFAULT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `DEDUCTION_TYPE` varchar(100) NOT NULL,
  `PAYROLL_ID` varchar(100) DEFAULT NULL,
  `PAYROLL_DATE` date NOT NULL,
  `AMOUNT` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_deduction`
--

LOCK TABLES `temp_deduction` WRITE;
/*!40000 ALTER TABLE `temp_deduction` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_deduction` ENABLE KEYS */;
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
-- Table structure for table `temp_government_contribution`
--

DROP TABLE IF EXISTS `temp_government_contribution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_government_contribution` (
  `GOVERNMENT_CONTRIBUTION_ID` varchar(100) DEFAULT NULL,
  `GOVERNMENT_CONTRIBUTION` varchar(50) NOT NULL,
  `DESCRIPTION` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_government_contribution`
--

LOCK TABLES `temp_government_contribution` WRITE;
/*!40000 ALTER TABLE `temp_government_contribution` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_government_contribution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_leave`
--

DROP TABLE IF EXISTS `temp_leave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_leave` (
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `LEAVE_TYPE` varchar(50) NOT NULL,
  `LEAVE_DATE` date NOT NULL,
  `START_TIME` time NOT NULL,
  `END_TIME` time NOT NULL,
  `LEAVE_STATUS` varchar(10) NOT NULL,
  `LEAVE_REASON` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_leave`
--

LOCK TABLES `temp_leave` WRITE;
/*!40000 ALTER TABLE `temp_leave` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_leave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_leave_entitlement`
--

DROP TABLE IF EXISTS `temp_leave_entitlement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_leave_entitlement` (
  `LEAVE_ENTITLEMENT_ID` varchar(50) DEFAULT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `LEAVE_TYPE` varchar(50) NOT NULL,
  `NO_LEAVES` int(11) NOT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_leave_entitlement`
--

LOCK TABLES `temp_leave_entitlement` WRITE;
/*!40000 ALTER TABLE `temp_leave_entitlement` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_leave_entitlement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_other_income`
--

DROP TABLE IF EXISTS `temp_other_income`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_other_income` (
  `OTHER_INCOME_ID` varchar(100) DEFAULT NULL,
  `EMPLOYEE_ID` varchar(100) NOT NULL,
  `OTHER_INCOME_TYPE` varchar(100) NOT NULL,
  `PAYROLL_ID` date DEFAULT NULL,
  `PAYROLL_DATE` date NOT NULL,
  `AMOUNT` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_other_income`
--

LOCK TABLES `temp_other_income` WRITE;
/*!40000 ALTER TABLE `temp_other_income` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_other_income` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_withholding_tax`
--

DROP TABLE IF EXISTS `temp_withholding_tax`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_withholding_tax` (
  `WITHHOLDING_TAX_ID` varchar(100) DEFAULT NULL,
  `SALARY_FREQUENCY` varchar(50) DEFAULT NULL,
  `START_RANGE` double DEFAULT NULL,
  `END_RANGE` double DEFAULT NULL,
  `FIX_COMPENSATION_LEVEL` double NOT NULL,
  `BASE_TAX` double NOT NULL,
  `PERCENT_OVER` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_withholding_tax`
--

LOCK TABLES `temp_withholding_tax` WRITE;
/*!40000 ALTER TABLE `temp_withholding_tax` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_withholding_tax` ENABLE KEYS */;
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
/*!50003 DROP PROCEDURE IF EXISTS `check_other_income_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_other_income_exist`(IN other_income_id VARCHAR(100))
BEGIN
	SET @other_income_id = other_income_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblotherincome WHERE OTHER_INCOME_ID = @other_income_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_other_income_type_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_other_income_type_exist`(IN other_income_id VARCHAR(100))
BEGIN
	SET @other_income_id = other_income_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblotherincometype WHERE OTHER_INCOME_TYPE_ID = @other_income_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_payroll_group_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_payroll_group_exist`(IN payroll_group_id INT(50))
BEGIN
	SET @payroll_group_id = payroll_group_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblpayrollgroup WHERE PAYROLL_GROUP_ID = @payroll_group_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_payroll_setting_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_payroll_setting_exist`(IN setting_id INT)
BEGIN
	SET @setting_id = setting_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblpayrollsetting WHERE SETTING_ID = @setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_payslip_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_payslip_exist`(IN payslip_id VARCHAR(100))
BEGIN
	SET @payslip_id = payslip_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblpayslip WHERE PAYSLIP_ID = @payslip_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_pay_run_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_pay_run_exist`(IN pay_run_id INT(50))
BEGIN
	SET @pay_run_id = pay_run_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblpayrun WHERE PAY_RUN_ID = @pay_run_id';

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
/*!50003 DROP PROCEDURE IF EXISTS `check_salary_effectivity_date_conflict` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_salary_effectivity_date_conflict`(IN salary_id VARCHAR(100), IN employee_id VARCHAR(100), IN effectivity_date DATE)
BEGIN
	SET @salary_id = salary_id;
	SET @employee_id = employee_id;
	SET @effectivity_date = effectivity_date;

	IF @salary_id IS NULL OR @salary_id = '' THEN
		SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblsalary WHERE EMPLOYEE_ID = @employee_id AND EFFECTIVITY_DATE = @effectivity_date';
	ELSE
		SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblsalary WHERE EMPLOYEE_ID = @employee_id AND EFFECTIVITY_DATE = @effectivity_date AND SALARY_ID != @salary_id';
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
/*!50003 DROP PROCEDURE IF EXISTS `check_salary_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_salary_exist`(IN salary_id VARCHAR(100))
BEGIN
	SET @salary_id = salary_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblsalary WHERE SALARY_ID = @salary_id';

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
/*!50003 DROP PROCEDURE IF EXISTS `check_withholding_tax_exist` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_withholding_tax_exist`(IN withholding_tax_id VARCHAR(100))
BEGIN
	SET @withholding_tax_id = withholding_tax_id;

	SET @query = 'SELECT COUNT(1) AS TOTAL FROM tblwithholdingtax WHERE WITHHOLDING_TAX_ID = @withholding_tax_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_withholding_tax_overlap` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_withholding_tax_overlap`(IN withholding_tax_id VARCHAR(100), IN salary_frequency VARCHAR(50))
BEGIN
	SET @withholding_tax_id = withholding_tax_id;
	SET @salary_frequency = salary_frequency;

	IF @withholding_tax_id IS NULL OR @withholding_tax_id = '' THEN
		SET @query = 'SELECT START_RANGE, END_RANGE FROM tblwithholdingtax WHERE SALARY_FREQUENCY = @salary_frequency';
	ELSE
		SET @query = 'SELECT START_RANGE, END_RANGE FROM tblwithholdingtax WHERE WITHHOLDING_TAX_ID != @withholding_tax_id AND SALARY_FREQUENCY = @salary_frequency';
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
/*!50003 DROP PROCEDURE IF EXISTS `delete_all_payroll_group_employee` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_all_payroll_group_employee`(IN payroll_group_id INT(50))
BEGIN
	SET @payroll_group_id = payroll_group_id;

	SET @query = 'DELETE FROM tblpayrollgroupemployee WHERE PAYROLL_GROUP_ID = @payroll_group_id';

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
/*!50003 DROP PROCEDURE IF EXISTS `delete_other_income` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_other_income`(IN other_income_id VARCHAR(100))
BEGIN
	SET @other_income_id = other_income_id;

	SET @query = 'DELETE FROM tblotherincome WHERE OTHER_INCOME_ID = @other_income_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_other_income_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_other_income_type`(IN other_income_id VARCHAR(100))
BEGIN
	SET @other_income_id = other_income_id;

	SET @query = 'DELETE FROM tblotherincometype WHERE OTHER_INCOME_TYPE_ID = @other_income_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_payroll_group` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_payroll_group`(IN payroll_group_id INT(50))
BEGIN
	SET @payroll_group_id = payroll_group_id;

	SET @query = 'DELETE FROM tblpayrollgroup WHERE PAYROLL_GROUP_ID = @payroll_group_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_payslip` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_payslip`(IN payslip_id VARCHAR(100))
BEGIN
	SET @payslip_id = payslip_id;

	SET @query = 'DELETE FROM tblpayslip WHERE PAYSLIP_ID = @payslip_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_pay_run` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_pay_run`(IN pay_run_id INT)
BEGIN
	SET @pay_run_id = pay_run_id;

	SET @query = 'DELETE FROM tblpayrun WHERE PAY_RUN_ID = @pay_run_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `delete_pay_run_payee` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_pay_run_payee`(IN pay_run_id INT, IN employee_id VARCHAR(100))
BEGIN
	SET @pay_run_id = pay_run_id;
	SET @employee_id = employee_id;

	SET @query = 'DELETE FROM tblpayrunpayee WHERE PAY_RUN_ID = @pay_run_id AND EMPLOYEE_ID = @employee_id';

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
/*!50003 DROP PROCEDURE IF EXISTS `delete_salary` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_salary`(IN salary_id VARCHAR(100))
BEGIN
	SET @salary_id = salary_id;

	SET @query = 'DELETE FROM tblsalary WHERE SALARY_ID = @salary_id';

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
/*!50003 DROP PROCEDURE IF EXISTS `delete_withholding_tax` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_withholding_tax`(IN withholding_tax_id VARCHAR(100))
BEGIN
	SET @withholding_tax_id = withholding_tax_id;

	SET @query = 'DELETE FROM tblwithholdingtax WHERE WITHHOLDING_TAX_ID = @withholding_tax_id';

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
/*!50003 DROP PROCEDURE IF EXISTS `generate_other_income_type_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_other_income_type_options`()
BEGIN
	SET @query = 'SELECT OTHER_INCOME_TYPE_ID, OTHER_INCOME_TYPE FROM tblotherincometype ORDER BY OTHER_INCOME_TYPE';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `generate_payroll_group_options` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_payroll_group_options`()
BEGIN
	SET @query = 'SELECT PAYROLL_GROUP_ID, PAYROLL_GROUP FROM tblpayrollgroup ORDER BY PAYROLL_GROUP';

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
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_attendance_setting_details`(IN `setting_id` INT)
BEGIN
	SET @setting_id = setting_id;

	SET @query = 'SELECT MAX_ATTENDANCE, TIME_OUT_ALLOWANCE, LATE_ALLOWANCE, LATE_POLICY, EARLY_LEAVING_POLICY, OVERTIME_POLICY, ATTENDANCE_CREATION_RECOMMENDATION, ATTENDANCE_ADJUSTMENT_RECOMMENDATION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblattendancesetting WHERE SETTING_ID = @setting_id';

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
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_company_setting_details`(IN `company_id` VARCHAR(50))
BEGIN
	SET @company_id = company_id;

	SET @query = 'SELECT COMPANY_NAME, EMAIL, TELEPHONE, PHONE, WEBSITE, ADDRESS, PROVINCE_ID, CITY_ID, COMPANY_LOGO, TRANSACTION_LOG_ID, RECORD_LOG FROM tblcompany WHERE COMPANY_ID = @company_id';

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
/*!50003 DROP PROCEDURE IF EXISTS `get_employee_attendance_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_employee_attendance_id`(IN employee_id VARCHAR(100), IN time_in_date DATE)
BEGIN
	SET @employee_id = employee_id;
	SET @time_in_date = time_in_date;

	SET @query = 'SELECT ATTENDANCE_ID FROM tblattendancerecord WHERE EMPLOYEE_ID = @employee_id AND TIME_IN_DATE = @time_in_date';

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
/*!50003 DROP PROCEDURE IF EXISTS `get_employee_contribution_deduction_total` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_employee_contribution_deduction_total`(IN employee_id VARCHAR(100), IN payroll_date DATE)
BEGIN
	SET @employee_id = employee_id;
	SET @payroll_date = payroll_date;

	SET @query = 'SELECT GOVERNMENT_CONTRIBUTION_TYPE FROM tblcontributiondeduction WHERE EMPLOYEE_ID = @employee_id AND PAYROLL_DATE = @payroll_date AND PAYROLL_ID IS NULL';

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
/*!50003 DROP PROCEDURE IF EXISTS `get_employee_salary` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_employee_salary`(IN `employee_id` VARCHAR(100))
BEGIN
	SET @employee_id = employee_id;

	SET @query = 'SELECT SALARY_ID, SALARY_AMOUNT, SALARY_FREQUENCY, HOURS_PER_WEEK, HOURS_PER_DAY, MINUTE_RATE, HOURLY_RATE, DAILY_RATE, WEEKLY_RATE, BI_WEEKLY_RATE, MONTHLY_RATE FROM tblsalary WHERE EMPLOYEE_ID = @employee_id ORDER BY EFFECTIVITY_DATE DESC LIMIT 1';

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
/*!50003 DROP PROCEDURE IF EXISTS `get_other_income_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_other_income_details`(IN other_income_id VARCHAR(100))
BEGIN
	SET @other_income_id = other_income_id;

	SET @query = 'SELECT EMPLOYEE_ID, OTHER_INCOME_TYPE, PAYROLL_ID, PAYROLL_DATE, AMOUNT, TRANSACTION_LOG_ID, RECORD_LOG FROM tblotherincome WHERE OTHER_INCOME_ID = @other_income_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_other_income_type_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_other_income_type_details`(IN other_income_id VARCHAR(100))
BEGIN
	SET @other_income_id = other_income_id;

	SET @query = 'SELECT OTHER_INCOME_TYPE, TAXABLE, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblotherincometype WHERE OTHER_INCOME_TYPE_ID = @other_income_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_paid_employee_leave` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_paid_employee_leave`(IN `employee_id` VARCHAR(100), IN `leave_date` DATE)
BEGIN
	SET @employee_id = employee_id;
	SET @leave_date = leave_date;

	SET @query = 'SELECT LEAVE_ID, START_TIME, END_TIME FROM tblleave WHERE EMPLOYEE_ID = @employee_id AND LEAVE_DATE = @leave_date AND LEAVE_STATUS = "APV" AND LEAVE_TYPE IN (SELECT LEAVE_TYPE_ID FROM tblleavetype WHERE PAID_STATUS = "PAID")';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_payroll_allowance_total` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_payroll_allowance_total`(IN employee_id VARCHAR(100), IN payroll_date DATE)
BEGIN
	SET @employee_id = employee_id;
	SET @payroll_date = payroll_date;

	SET @query = 'SELECT SUM(AMOUNT) AS AMOUNT FROM tblallowance WHERE EMPLOYEE_ID = @employee_id AND PAYROLL_DATE = @payroll_date AND PAYROLL_ID IS NULL';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_payroll_deduction_total` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_payroll_deduction_total`(IN employee_id VARCHAR(100), IN payroll_date DATE)
BEGIN
	SET @employee_id = employee_id;
	SET @payroll_date = payroll_date;

	SET @query = 'SELECT SUM(AMOUNT) AS AMOUNT FROM tbldeduction WHERE EMPLOYEE_ID = @employee_id AND PAYROLL_DATE = @payroll_date AND PAYROLL_ID IS NULL';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_payroll_group_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_payroll_group_details`(IN payroll_group_id INT(50))
BEGIN
	SET @payroll_group_id = payroll_group_id;

	SET @query = 'SELECT PAYROLL_GROUP, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG FROM tblpayrollgroup WHERE PAYROLL_GROUP_ID = @payroll_group_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_payroll_group_employee_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_payroll_group_employee_details`(IN payroll_group_id INT(50))
BEGIN
	SET @payroll_group_id = payroll_group_id;

	SET @query = 'SELECT EMPLOYEE_ID, RECORD_LOG FROM tblpayrollgroupemployee WHERE PAYROLL_GROUP_ID = @payroll_group_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_payroll_other_income_total` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_payroll_other_income_total`(IN employee_id VARCHAR(100), IN payroll_date DATE)
BEGIN
	SET @employee_id = employee_id;
	SET @payroll_date = payroll_date;

	SET @query = 'SELECT SUM(AMOUNT) AS AMOUNT FROM tblotherincome WHERE EMPLOYEE_ID = @employee_id AND PAYROLL_DATE = @payroll_date AND PAYROLL_ID IS NULL';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_payroll_setting_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_payroll_setting_details`(IN `setting_id` INT)
BEGIN
	SET @setting_id = setting_id;

	SET @query = 'SELECT LATE_DEDUCTION_RATE, EARLY_LEAVING_DEDUCTION_RATE, OVERTIME_RATE, NIGHT_DIFFERENTIAL_RATE, TRANSACTION_LOG_ID, RECORD_LOG FROM tblpayrollsetting WHERE SETTING_ID = @setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_payslip_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_payslip_details`(IN payslip_id INT)
BEGIN
	SET @payslip_id = payslip_id;

	SET @query = 'SELECT PAY_RUN_ID, EMPLOYEE_ID, ABSENT, ABSENT_DEDUCTION, LATE_MINUTES, LATE_DEDUCTION, EARLY_LEAVING_MINUTES, EARLY_LEAVING_DEDUCTION, OVERTIME_HOURS, OVERTIME_EARNING, HOURS_WORKED, WITHHOLDING_TAX, TOTAL_DEDUCTION, TOTAL_ALLOWANCE, GROSS_PAY, NET_PAY, TRANSACTION_LOG_ID, RECORD_LOG FROM tblpayslip WHERE PAYSLIP_ID = @payslip_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_pay_run_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_pay_run_details`(IN `pay_run_id` INT(50))
BEGIN
	SET @pay_run_id = pay_run_id;

	SET @query = 'SELECT START_DATE, END_DATE, PAYSLIP_NOTE, CONSIDER_OVERTIME, CONSIDER_WITHHOLDING_TAX, CONSIDER_HOLIDAY_PAY, CONSIDER_NIGHT_DIFFERENTIAL, STATUS, GENERATION_DATE, GENERATION_TIME, GENERATED_BY, TRANSACTION_LOG_ID, RECORD_LOG FROM tblpayrun WHERE PAY_RUN_ID = @pay_run_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_pay_run_payee_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_pay_run_payee_details`(IN pay_run_id INT(50))
BEGIN
	SET @pay_run_id = pay_run_id;

	SET @query = 'SELECT EMPLOYEE_ID, RECORD_LOG FROM tblpayrunpayee WHERE PAY_RUN_ID = @pay_run_id';

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
/*!50003 DROP PROCEDURE IF EXISTS `get_salary_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_salary_details`(IN salary_id VARCHAR(100))
BEGIN
	SET @salary_id = salary_id;

	SET @query = 'SELECT EMPLOYEE_ID, SALARY_AMOUNT, SALARY_FREQUENCY, HOURS_PER_WEEK, HOURS_PER_DAY, MINUTE_RATE, HOURLY_RATE, DAILY_RATE, WEEKLY_RATE, BI_WEEKLY_RATE, MONTHLY_RATE, EFFECTIVITY_DATE, REMARKS, TRANSACTION_LOG_ID, RECORD_LOG FROM tblsalary WHERE SALARY_ID = @salary_id';

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
/*!50003 DROP PROCEDURE IF EXISTS `get_taxable_allowance_total` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_taxable_allowance_total`(IN employee_id VARCHAR(100), IN payroll_date DATE)
BEGIN
	SET @employee_id = employee_id;
	SET @payroll_date = payroll_date;

	SET @query = 'SELECT SUM(AMOUNT) AS AMOUNT FROM tblallowance WHERE EMPLOYEE_ID = @employee_id  AND PAYROLL_DATE = @payroll_date AND PAYROLL_ID IS NULL AND ALLOWANCE_TYPE IN (SELECT ALLOWANCE_TYPE_ID FROM tblallowancetype WHERE TAXABLE = "TAX")';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_taxable_other_income_total` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_taxable_other_income_total`(IN employee_id VARCHAR(100), IN payroll_date DATE)
BEGIN
	SET @employee_id = employee_id;
	SET @payroll_date = payroll_date;

	SET @query = 'SELECT SUM(AMOUNT) AS AMOUNT FROM tblotherincome WHERE EMPLOYEE_ID = @employee_id AND PAYROLL_DATE = @payroll_date AND PAYROLL_ID IS NULL AND OTHER_INCOME_TYPE IN (SELECT OTHER_INCOME_TYPE_ID FROM tblotherincometype WHERE TAXABLE = "TAX")';

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
/*!50003 DROP PROCEDURE IF EXISTS `get_withholding_tax` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_withholding_tax`(IN `salary_frequency` VARCHAR(50))
BEGIN
	SET @salary_frequency = salary_frequency;

	SET @query = 'SELECT START_RANGE, END_RANGE, FIX_COMPENSATION_LEVEL, BASE_TAX, PERCENT_OVER FROM tblwithholdingtax WHERE SALARY_FREQUENCY = @salary_frequency';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_withholding_tax_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_withholding_tax_details`(IN `withholding_tax_id` VARCHAR(100))
BEGIN
	SET @withholding_tax_id = withholding_tax_id;

	SET @query = 'SELECT SALARY_FREQUENCY, START_RANGE, END_RANGE, FIX_COMPENSATION_LEVEL, BASE_TAX, PERCENT_OVER, TRANSACTION_LOG_ID, RECORD_LOG FROM tblwithholdingtax WHERE WITHHOLDING_TAX_ID = @withholding_tax_id';

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
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_attendance_setting`(IN `setting_id` INT, IN `maximum_attendance` INT, IN `time_out_allowance` INT, IN `late_allowance` INT, IN `late_policy` INT, IN `early_leaving_policy` INT, IN `overtime_policy` INT, IN `attendance_creation_recommendation` INT(1), IN `attendance_adjustment_recommendation` INT(1), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @setting_id = setting_id;
	SET @maximum_attendance = maximum_attendance;
    SET @time_out_allowance = time_out_allowance;
    SET @late_allowance = late_allowance;
    SET @late_policy = late_policy;
    SET @early_leaving_policy = early_leaving_policy;
    SET @overtime_policy = overtime_policy;
    SET @attendance_creation_recommendation = attendance_creation_recommendation;
    SET @attendance_adjustment_recommendation = attendance_adjustment_recommendation;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblattendancesetting (SETTING_ID, MAX_ATTENDANCE, TIME_OUT_ALLOWANCE, LATE_ALLOWANCE, LATE_POLICY, EARLY_LEAVING_POLICY, OVERTIME_POLICY, ATTENDANCE_CREATION_RECOMMENDATION, ATTENDANCE_ADJUSTMENT_RECOMMENDATION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@setting_id, @maximum_attendance, @time_out_allowance, @late_allowance, @late_policy, @early_leaving_policy, @overtime_policy, @attendance_creation_recommendation, @attendance_adjustment_recommendation, @transaction_log_id, @record_log)';

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
/*!50003 DROP PROCEDURE IF EXISTS `insert_imported_attendance_adjustment` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_imported_attendance_adjustment`(IN request_id VARCHAR(100), IN employee_id VARCHAR(100), IN attendance_id VARCHAR(100), IN time_in_date_default DATE, IN time_in_default TIME, IN time_in_date_adjusted DATE, IN time_in_adjusted TIME, IN time_out_date_default DATE, IN time_out_default TIME, IN time_out_date_adjusted DATE, IN time_out_adjusted TIME, IN status VARCHAR(10), IN reason VARCHAR(500), IN file_path VARCHAR(500), IN sanction INT(1), IN request_date DATE, IN request_time TIME, IN for_recommendation_date DATE, IN for_recommendation_time TIME, IN recommendation_date DATE, IN recommendation_time TIME, IN recommended_by VARCHAR(50), IN decision_remarks VARCHAR(500), IN decision_date DATE, IN decision_time TIME, IN decision_by VARCHAR(50), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @request_id = request_id;
	SET @employee_id = employee_id;
	SET @attendance_id = attendance_id;
	SET @time_in_date_default = time_in_date_default;
	SET @time_in_default = time_in_default;
	SET @time_in_date_adjusted = time_in_date_adjusted;
	SET @time_in_adjusted = time_in_adjusted;
	SET @time_out_date_default = time_out_date_default;
	SET @time_out_default = time_out_default;
	SET @time_out_date_adjusted = time_out_date_adjusted;
	SET @time_out_adjusted = time_out_adjusted;
	SET @status = status;
	SET @reason = reason;
	SET @file_path = file_path;
	SET @sanction = sanction;
	SET @request_date = request_date;
	SET @request_time = request_time;
	SET @for_recommendation_date = for_recommendation_date;
	SET @for_recommendation_time = for_recommendation_time;
	SET @recommendation_date = recommendation_date;
	SET @recommendation_time = recommendation_time;
	SET @recommended_by = recommended_by;
	SET @decision_remarks = decision_remarks;
	SET @decision_date = decision_date;
	SET @decision_time = decision_time;
	SET @decision_by = decision_by;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblattendanceadjustment (REQUEST_ID, EMPLOYEE_ID, ATTENDANCE_ID, TIME_IN_DATE, TIME_IN, TIME_IN_DATE_ADJUSTED, TIME_IN_ADJUSTED, TIME_OUT_DATE, TIME_OUT, TIME_OUT_DATE_ADJUSTED, TIME_OUT_ADJUSTED, STATUS, REASON, FILE_PATH, SANCTION, REQUEST_DATE, REQUEST_TIME, FOR_RECOMMENDATION_DATE, FOR_RECOMMENDATION_TIME, RECOMMENDATION_DATE, RECOMMENDATION_TIME, RECOMMENDED_BY, DECISION_REMARKS, DECISION_DATE, DECISION_TIME, DECISION_BY, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@request_id, @employee_id, @attendance_id, @time_in_date_default, @time_in_default, @time_in_date_adjusted, @time_in_adjusted, @time_out_date_default, @time_out_default, @time_out_date_adjusted, @time_out_adjusted, @status, @reason, @file_path, @sanction, @request_date, @request_time, @for_recommendation_date, @for_recommendation_time, @recommendation_date, @recommendation_time, @recommended_by, @decision_remarks, @decision_date, @decision_time, @decision_by, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_imported_attendance_creation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_imported_attendance_creation`(IN request_id VARCHAR(100), IN employee_id VARCHAR(100), IN time_in_date DATE, IN time_in TIME, IN time_out_date DATE, IN time_out TIME, IN status VARCHAR(10), IN reason VARCHAR(500), IN file_path VARCHAR(500), IN sanction INT(1), IN request_date DATE, IN request_time TIME, IN for_recommendation_date DATE, IN for_recommendation_time TIME, IN recommendation_date DATE, IN recommendation_time TIME, IN recommended_by VARCHAR(50), IN decision_remarks VARCHAR(500), IN decision_date DATE, IN decision_time TIME, IN decision_by VARCHAR(50), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @request_id = request_id;
	SET @employee_id = employee_id;
	SET @time_in_date = time_in_date;
	SET @time_in = time_in;
	SET @time_out_date = time_out_date;
	SET @time_out = time_out;
	SET @status = status;
	SET @reason = reason;
	SET @file_path = file_path;
	SET @sanction = sanction;
	SET @request_date = request_date;
	SET @request_time = request_time;
	SET @for_recommendation_date = for_recommendation_date;
	SET @for_recommendation_time = for_recommendation_time;
	SET @recommendation_date = recommendation_date;
	SET @recommendation_time = recommendation_time;
	SET @recommended_by = recommended_by;
	SET @decision_remarks = decision_remarks;
	SET @decision_date = decision_date;
	SET @decision_time = decision_time;
	SET @decision_by = decision_by;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblattendancecreation (REQUEST_ID, EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_OUT_DATE, TIME_OUT, STATUS, REASON, FILE_PATH, SANCTION, REQUEST_DATE, REQUEST_TIME, FOR_RECOMMENDATION_DATE, FOR_RECOMMENDATION_TIME, RECOMMENDATION_DATE, RECOMMENDATION_TIME, RECOMMENDED_BY, DECISION_REMARKS, DECISION_DATE, DECISION_TIME, DECISION_BY, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@request_id, @employee_id, @time_in_date, @time_in, @time_out_date, @time_out, @status, @reason, @file_path, @sanction, @request_date, @request_time, @for_recommendation_date, @for_recommendation_time, @recommendation_date, @recommendation_time, @recommended_by, @decision_remarks, @decision_date, @decision_time, @decision_by, @transaction_log_id, @record_log)';

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
/*!50003 DROP PROCEDURE IF EXISTS `insert_other_income` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_other_income`(IN other_income_id VARCHAR(100), IN employee_id VARCHAR(100), IN other_income VARCHAR(100), IN payroll_date DATE, IN amount DOUBLE, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @other_income_id = other_income_id;
	SET @employee_id = employee_id;
	SET @other_income = other_income;
	SET @payroll_date = payroll_date;
	SET @amount = amount;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblotherincome (OTHER_INCOME_ID, EMPLOYEE_ID, OTHER_INCOME_TYPE, PAYROLL_DATE, AMOUNT, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@other_income_id, @employee_id, @other_income, @payroll_date, @amount, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_other_income_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_other_income_type`(IN other_income_id VARCHAR(100), IN other_income VARCHAR(50), IN taxable VARCHAR(5), IN description VARCHAR(100), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @other_income_id = other_income_id;
	SET @other_income = other_income;
	SET @taxable = taxable;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblotherincometype (OTHER_INCOME_TYPE_ID, OTHER_INCOME_TYPE, TAXABLE, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@other_income_id, @other_income, @taxable, @description, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_payroll_group` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_payroll_group`(IN payroll_group_id INT(50), IN payroll_group VARCHAR(100), IN description VARCHAR(200), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @payroll_group_id = payroll_group_id;
	SET @payroll_group = payroll_group;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblpayrollgroup (PAYROLL_GROUP_ID, PAYROLL_GROUP, DESCRIPTION, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@payroll_group_id, @payroll_group, @description, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_payroll_group_employee` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_payroll_group_employee`(IN payroll_group_id INT(50), IN employee_id VARCHAR(100), IN record_log VARCHAR(100))
BEGIN
	SET @payroll_group_id = payroll_group_id;
	SET @employee_id = employee_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblpayrollgroupemployee (PAYROLL_GROUP_ID, EMPLOYEE_ID, RECORD_LOG) VALUES(@payroll_group_id, @employee_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_payroll_setting` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_payroll_setting`(IN `setting_id` INT, IN `late_deduction_rate` DOUBLE, IN `early_leaving_deduction_rate` DOUBLE, IN `overtime_rate` DOUBLE, IN `night_differential_rate` DOUBLE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @setting_id = setting_id;
	SET @late_deduction_rate = late_deduction_rate;
	SET @early_leaving_deduction_rate = early_leaving_deduction_rate;
	SET @overtime_rate = overtime_rate;
    SET @night_differential_rate = night_differential_rate;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblpayrollsetting (SETTING_ID, LATE_DEDUCTION_RATE, EARLY_LEAVING_DEDUCTION_RATE, OVERTIME_RATE, NIGHT_DIFFERENTIAL_RATE, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@setting_id, @late_deduction_rate, @early_leaving_deduction_rate, @overtime_rate, @night_differential_rate, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_payslip` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_payslip`(IN payslip_id INT, IN pay_run_id INT, IN employee_id VARCHAR(100), IN absent DOUBLE, IN absent_deduction DOUBLE, IN late_minutes DOUBLE, IN late_deduction DOUBLE, IN early_leaving_minutes DOUBLE, IN early_leaving_deduction DOUBLE, IN overtime_hours DOUBLE, IN overtime_earning DOUBLE, IN total_hours_worked DOUBLE, IN withholding_tax DOUBLE, IN total_deductions DOUBLE, IN total_allowance DOUBLE, IN gross_pay DOUBLE, IN net_pay DOUBLE, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @payslip_id = payslip_id;
	SET @pay_run_id = pay_run_id;
	SET @employee_id = employee_id;
	SET @absent = absent;
	SET @absent_deduction = absent_deduction;
	SET @late_minutes = late_minutes;
	SET @late_deduction = late_deduction;
	SET @early_leaving_minutes = early_leaving_minutes;
	SET @early_leaving_deduction = early_leaving_deduction;
	SET @overtime_hours = overtime_hours;
	SET @overtime_earning = overtime_earning;
	SET @total_hours_worked = total_hours_worked;
	SET @withholding_tax = withholding_tax;
	SET @total_deductions = total_deductions;
	SET @total_allowance = total_allowance;
	SET @gross_pay = gross_pay;
	SET @net_pay = net_pay;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblpayslip (PAYSLIP_ID, PAY_RUN_ID, EMPLOYEE_ID, ABSENT, ABSENT_DEDUCTION, LATE_MINUTES, LATE_DEDUCTION, EARLY_LEAVING_MINUTES, EARLY_LEAVING_DEDUCTION, OVERTIME_HOURS, OVERTIME_EARNING, HOURS_WORKED, WITHHOLDING_TAX, TOTAL_DEDUCTION, TOTAL_ALLOWANCE, GROSS_PAY, NET_PAY, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@payslip_id, @pay_run_id, @employee_id, @absent, @absent_deduction, @late_minutes, @late_deduction, @early_leaving_minutes, @early_leaving_deduction, @overtime_hours, @overtime_earning, @total_hours_worked, @withholding_tax, @total_deductions, @total_allowance, @gross_pay, @net_pay, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_pay_run` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_pay_run`(IN `pay_run_id` INT(50), IN `start_date` DATE, IN `end_date` DATE, IN `payslip_note` VARCHAR(500), IN `consider_overtime` INT(1), IN `consider_withholding_tax` INT, IN `consider_holiday_pay` INT, IN `consider_night_differential` INT, IN `generation_date` DATE, IN `generation_time` TIME, IN `generated_by` VARCHAR(50), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @pay_run_id = pay_run_id;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @payslip_note = payslip_note;
	SET @consider_overtime = consider_overtime;
    SET @consider_withholding_tax = consider_withholding_tax;
    SET @consider_holiday_pay = consider_holiday_pay;
    SET @consider_night_differential = consider_night_differential;
	SET @generation_date = generation_date;
	SET @generation_time = generation_time;
	SET @generated_by = generated_by;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblpayrun (PAY_RUN_ID, START_DATE, END_DATE, PAYSLIP_NOTE, CONSIDER_OVERTIME, CONSIDER_WITHHOLDING_TAX, CONSIDER_HOLIDAY_PAY, CONSIDER_NIGHT_DIFFERENTIAL, STATUS, GENERATION_DATE, GENERATION_TIME, GENERATED_BY, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@pay_run_id, @start_date, @end_date, @payslip_note, @consider_overtime, @consider_withholding_tax, @consider_holiday_pay, @consider_night_differential, "GEN", @generation_date, @generation_time, @generated_by, @transaction_log_id, @record_log)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_pay_run_payee` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_pay_run_payee`(IN pay_run_id INT(50), IN employee_id VARCHAR(100), IN record_log VARCHAR(100))
BEGIN
	SET @pay_run_id = pay_run_id;
	SET @employee_id = employee_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblpayrunpayee (PAY_RUN_ID, EMPLOYEE_ID, RECORD_LOG) VALUES(@pay_run_id, @employee_id, @record_log)';

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
/*!50003 DROP PROCEDURE IF EXISTS `insert_salary` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_salary`(IN salary_id VARCHAR(100), IN employee_id VARCHAR(100), IN salary_amount DOUBLE, IN salary_frequency VARCHAR(20), IN hours_per_week INT, IN hours_per_day INT, IN minute_rate DOUBLE, IN hourly_rate DOUBLE, IN daily_rate DOUBLE, IN weekly_rate DOUBLE, IN bi_weekly_rate DOUBLE, IN monthly_rate DOUBLE, IN effectivity_date DATE, IN remarks VARCHAR(500), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @salary_id = salary_id;
	SET @employee_id = employee_id;
	SET @salary_amount = salary_amount;
	SET @salary_frequency = salary_frequency;
	SET @hours_per_week = hours_per_week;
	SET @hours_per_day = hours_per_day;
	SET @minute_rate = minute_rate;
	SET @hourly_rate = hourly_rate;
	SET @daily_rate = daily_rate;
	SET @weekly_rate = weekly_rate;
	SET @bi_weekly_rate = bi_weekly_rate;
	SET @monthly_rate = monthly_rate;
	SET @effectivity_date = effectivity_date;
	SET @remarks = remarks;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblsalary (SALARY_ID, EMPLOYEE_ID, SALARY_AMOUNT, SALARY_FREQUENCY, HOURS_PER_WEEK, HOURS_PER_DAY, MINUTE_RATE, HOURLY_RATE, DAILY_RATE, WEEKLY_RATE, BI_WEEKLY_RATE, MONTHLY_RATE, EFFECTIVITY_DATE, REMARKS, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@salary_id, @employee_id, @salary_amount, @salary_frequency, @hours_per_week, @hours_per_day, @minute_rate, @hourly_rate, @daily_rate, @weekly_rate, @bi_weekly_rate, @monthly_rate, @effectivity_date, @remarks, @transaction_log_id, @record_log)';

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
/*!50003 DROP PROCEDURE IF EXISTS `insert_temporary_allowance` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_temporary_allowance`(IN allowance_id VARCHAR(100), IN employee_id VARCHAR(100), IN allowance_type VARCHAR(100), IN payroll_id VARCHAR(100), IN payroll_date DATE, IN amount DOUBLE)
BEGIN
	SET @allowance_id = allowance_id;
	SET @employee_id = employee_id;
	SET @allowance_type = allowance_type;
	SET @payroll_id = payroll_id;
	SET @payroll_date = payroll_date;
	SET @amount = amount;

	SET @query = 'INSERT INTO temp_allowance (ALLOWANCE_ID, EMPLOYEE_ID, ALLOWANCE_TYPE, PAYROLL_ID, PAYROLL_DATE, AMOUNT) VALUES(@allowance_id, @employee_id, @allowance_type, @payroll_id, @payroll_date, @amount)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_temporary_attendance_adjustment` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_temporary_attendance_adjustment`(IN request_id VARCHAR(100), IN employee_id VARCHAR(100), IN attendance_id VARCHAR(100), IN time_in_date_adjusted DATE, IN time_in_adjusted TIME, IN time_out_date_adjusted DATE, IN time_out_adjusted TIME, IN status VARCHAR(10), IN reason VARCHAR(500), IN file_path VARCHAR(500), IN sanction INT(1), IN request_date DATE, IN request_time TIME, IN for_recommendation_date DATE, IN for_recommendation_time TIME, IN recommendation_date DATE, IN recommendation_time TIME, IN recommended_by VARCHAR(50), IN decision_remarks VARCHAR(500), IN decision_date DATE, IN decision_time TIME, IN decision_by VARCHAR(50))
BEGIN
	SET @request_id = request_id;
	SET @employee_id = employee_id;
	SET @attendance_id = attendance_id;
	SET @time_in_date_adjusted = time_in_date_adjusted;
	SET @time_in_adjusted = time_in_adjusted;
	SET @time_out_date_adjusted = time_out_date_adjusted;
	SET @time_out_adjusted = time_out_adjusted;
	SET @status = status;
	SET @reason = reason;
	SET @file_path = file_path;
	SET @sanction = sanction;
	SET @request_date = request_date;
	SET @request_time = request_time;
	SET @for_recommendation_date = for_recommendation_date;
	SET @for_recommendation_time = for_recommendation_time;
	SET @recommendation_date = recommendation_date;
	SET @recommendation_time = recommendation_time;
	SET @recommended_by = recommended_by;
	SET @decision_remarks = decision_remarks;
	SET @decision_date = decision_date;
	SET @decision_time = decision_time;
	SET @decision_by = decision_by;

	SET @query = 'INSERT INTO temp_attendance_adjustment (REQUEST_ID, EMPLOYEE_ID, ATTENDANCE_ID, TIME_IN_DATE_ADJUSTED, TIME_IN_ADJUSTED, TIME_OUT_DATE_ADJUSTED, TIME_OUT_ADJUSTED, STATUS, REASON, FILE_PATH, SANCTION, REQUEST_DATE, REQUEST_TIME, FOR_RECOMMENDATION_DATE, FOR_RECOMMENDATION_TIME, RECOMMENDATION_DATE, RECOMMENDATION_TIME, RECOMMENDED_BY, DECISION_REMARKS, DECISION_DATE, DECISION_TIME, DECISION_BY) VALUES(@request_id, @employee_id, @attendance_id, @time_in_date_adjusted, @time_in_adjusted, @time_out_date_adjusted, @time_out_adjusted, @status, @reason, @file_path, @sanction, @request_date, @request_time, @for_recommendation_date, @for_recommendation_time, @recommendation_date, @recommendation_time, @recommended_by, @decision_remarks, @decision_date, @decision_time, @decision_by)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_temporary_attendance_creation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_temporary_attendance_creation`(IN request_id VARCHAR(100), IN employee_id VARCHAR(100), IN time_in_date DATE, IN time_in TIME, IN time_out_date DATE, IN time_out TIME, IN status VARCHAR(10), IN reason VARCHAR(500), IN file_path VARCHAR(500), IN sanction INT(1), IN request_date DATE, IN request_time TIME, IN for_recommendation_date DATE, IN for_recommendation_time TIME, IN recommendation_date DATE, IN recommendation_time TIME, IN recommended_by VARCHAR(50), IN decision_remarks VARCHAR(500), IN decision_date DATE, IN decision_time TIME, IN decision_by VARCHAR(50))
BEGIN
	SET @request_id = request_id;
	SET @employee_id = employee_id;
	SET @time_in_date = time_in_date;
	SET @time_in = time_in;
	SET @time_out_date = time_out_date;
	SET @time_out = time_out;
	SET @status = status;
	SET @reason = reason;
	SET @file_path = file_path;
	SET @sanction = sanction;
	SET @request_date = request_date;
	SET @request_time = request_time;
	SET @for_recommendation_date = for_recommendation_date;
	SET @for_recommendation_time = for_recommendation_time;
	SET @recommendation_date = recommendation_date;
	SET @recommendation_time = recommendation_time;
	SET @recommended_by = recommended_by;
	SET @decision_remarks = decision_remarks;
	SET @decision_date = decision_date;
	SET @decision_time = decision_time;
	SET @decision_by = decision_by;

	SET @query = 'INSERT INTO temp_attendance_creation (REQUEST_ID, EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_OUT_DATE, TIME_OUT, STATUS, REASON, FILE_PATH, SANCTION, REQUEST_DATE, REQUEST_TIME, FOR_RECOMMENDATION_DATE, FOR_RECOMMENDATION_TIME, RECOMMENDATION_DATE, RECOMMENDATION_TIME, RECOMMENDED_BY, DECISION_REMARKS, DECISION_DATE, DECISION_TIME, DECISION_BY) VALUES(@request_id, @employee_id, @time_in_date, @time_in, @time_out_date, @time_out, @status, @reason, @file_path, @sanction, @request_date, @request_time, @for_recommendation_date, @for_recommendation_time, @recommendation_date, @recommendation_time, @recommended_by, @decision_remarks, @decision_date, @decision_time, @decision_by)';

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_temporary_attendance_record`(IN attendance_id VARCHAR(100), IN employee_id VARCHAR(100), IN time_in_date DATE, IN time_in TIME, IN time_out_date DATE, IN time_out TIME)
BEGIN
	SET @attendance_id = attendance_id;
	SET @employee_id = employee_id;
	SET @time_in_date = time_in_date;
	SET @time_in = time_in;
	SET @time_out_date = time_out_date;
	SET @time_out = time_out;

	SET @query = 'INSERT INTO temp_attendance_record (ATTENDANCE_ID, EMPLOYEE_ID, TIME_IN_DATE, TIME_IN, TIME_OUT_DATE, TIME_OUT) VALUES(@attendance_id, @employee_id, @time_in_date, @time_in, @time_out_date, @time_out)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_temporary_contribution_bracket` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_temporary_contribution_bracket`(IN contribution_bracket_id VARCHAR(100), IN government_contribution_id VARCHAR(100), IN start_range DOUBLE, IN end_range DOUBLE, IN deduction_amount DOUBLE)
BEGIN
	SET @contribution_bracket_id = contribution_bracket_id;
	SET @government_contribution_id = government_contribution_id;
	SET @start_range = start_range;
	SET @end_range = end_range;
	SET @deduction_amount = deduction_amount;

	SET @query = 'INSERT INTO temp_contribution_bracket (CONTRIBUTION_BRACKET_ID, GOVERNMENT_CONTRIBUTION_ID, START_RANGE, END_RANGE, DEDUCTION_AMOUNT) VALUES(@contribution_bracket_id, @government_contribution_id, @start_range, @end_range, @deduction_amount)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_temporary_contribution_deduction` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_temporary_contribution_deduction`(IN contribution_deduction_id VARCHAR(100), IN employee_id VARCHAR(100), IN government_contribution_type VARCHAR(100), IN payroll_id VARCHAR(100), IN payroll_date DATE)
BEGIN
	SET @contribution_deduction_id = contribution_deduction_id;
	SET @employee_id = employee_id;
	SET @government_contribution_type = government_contribution_type;
	SET @payroll_id = payroll_id;
	SET @payroll_date = payroll_date;

	SET @query = 'INSERT INTO temp_contribution_deduction (CONTRIBUTION_DEDUCTION_ID, EMPLOYEE_ID, GOVERNMENT_CONTRIBUTION_TYPE, PAYROLL_ID, PAYROLL_DATE) VALUES(@contribution_deduction_id, @employee_id, @government_contribution_type, @payroll_id, @payroll_date)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_temporary_deduction` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_temporary_deduction`(IN deduction_id VARCHAR(100), IN employee_id VARCHAR(100), IN deduction_type VARCHAR(100), IN payroll_id VARCHAR(100), IN payroll_date DATE, IN amount DOUBLE)
BEGIN
	SET @deduction_id = deduction_id;
	SET @employee_id = employee_id;
	SET @deduction_type = deduction_type;
	SET @payroll_id = payroll_id;
	SET @payroll_date = payroll_date;
	SET @amount = amount;

	SET @query = 'INSERT INTO temp_deduction (DEDUCTION_ID, EMPLOYEE_ID, DEDUCTION_TYPE, PAYROLL_ID, PAYROLL_DATE, AMOUNT) VALUES(@deduction_id, @employee_id, @deduction_type, @payroll_id, @payroll_date, @amount)';

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
/*!50003 DROP PROCEDURE IF EXISTS `insert_temporary_government_contribution` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_temporary_government_contribution`(IN government_contribution_id VARCHAR(100), IN government_contribution VARCHAR(50), IN description VARCHAR(100))
BEGIN
	SET @government_contribution_id = government_contribution_id;
	SET @government_contribution = government_contribution;
	SET @description = description;

	SET @query = 'INSERT INTO temp_government_contribution (GOVERNMENT_CONTRIBUTION_ID, GOVERNMENT_CONTRIBUTION, DESCRIPTION) VALUES(@government_contribution_id, @government_contribution, @description)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_temporary_leave` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_temporary_leave`(IN employee_id VARCHAR(100), IN leave_type VARCHAR(50), IN leave_date DATE, IN start_time TIME, IN end_time TIME, IN leave_status VARCHAR(10), IN leave_reason VARCHAR(500))
BEGIN
	SET @employee_id = employee_id;
	SET @leave_type = leave_type;
	SET @leave_date = leave_date;
	SET @start_time = start_time;
	SET @end_time = end_time;
	SET @leave_status = leave_status;
	SET @leave_reason = leave_reason;

	SET @query = 'INSERT INTO temp_leave (EMPLOYEE_ID, LEAVE_TYPE, LEAVE_DATE, START_TIME, END_TIME, LEAVE_STATUS, LEAVE_REASON) VALUES(@employee_id, @leave_type, @leave_date, @start_time, @end_time, @leave_status, @leave_reason)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_temporary_leave_entitlement` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_temporary_leave_entitlement`(IN leave_entitlement_id VARCHAR(50), IN employee_id VARCHAR(100), IN leave_type VARCHAR(50), IN no_leaves INT(11), IN start_date DATE, IN end_date DATE)
BEGIN
	SET @leave_entitlement_id = leave_entitlement_id;
	SET @employee_id = employee_id;
	SET @leave_type = leave_type;
	SET @no_leaves = no_leaves;
	SET @start_date = start_date;
	SET @end_date = end_date;

	SET @query = 'INSERT INTO temp_leave_entitlement (LEAVE_ENTITLEMENT_ID, EMPLOYEE_ID, LEAVE_TYPE, NO_LEAVES, START_DATE, END_DATE) VALUES(@leave_entitlement_id, @employee_id, @leave_type, @no_leaves, @start_date, @end_date)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_temporary_other_income` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_temporary_other_income`(IN other_income_id VARCHAR(100), IN employee_id VARCHAR(100), IN other_income_type VARCHAR(100), IN payroll_id VARCHAR(100), IN payroll_date DATE, IN amount DOUBLE)
BEGIN
	SET @other_income_id = other_income_id;
	SET @employee_id = employee_id;
	SET @other_income_type = other_income_type;
	SET @payroll_id = payroll_id;
	SET @payroll_date = payroll_date;
	SET @amount = amount;

	SET @query = 'INSERT INTO temp_other_income (OTHER_INCOME_ID, EMPLOYEE_ID, OTHER_INCOME_TYPE, PAYROLL_ID, PAYROLL_DATE, AMOUNT) VALUES(@other_income_id, @employee_id, @other_income_type, @payroll_id, @payroll_date, @amount)';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_temporary_withholding_tax` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_temporary_withholding_tax`(IN `withholding_tax_id` VARCHAR(100), IN `salary_frequency` VARCHAR(50), IN `start_range` DOUBLE, IN `end_range` DOUBLE, IN `fix_compensation_level` DOUBLE, IN `base_tax` DOUBLE, IN `percent_over` DOUBLE)
BEGIN
	SET @withholding_tax_id = withholding_tax_id;
	SET @salary_frequency = salary_frequency;
	SET @start_range = start_range;
	SET @end_range = end_range;
    SET @fix_compensation_level = fix_compensation_level;
    SET @base_tax = base_tax;
	SET @percent_over = percent_over;

	SET @query = 'INSERT INTO temp_withholding_tax (WITHHOLDING_TAX_ID, SALARY_FREQUENCY, START_RANGE, END_RANGE, FIX_COMPENSATION_LEVEL, BASE_TAX, PERCENT_OVER) VALUES(@withholding_tax_id, @salary_frequency, @start_range, @end_range, @fix_compensation_level, @base_tax, @percent_over)';

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
/*!50003 DROP PROCEDURE IF EXISTS `insert_withholding_tax` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_withholding_tax`(IN `withholding_tax_id` VARCHAR(100), IN `salary_frequency` VARCHAR(50), IN `start_range` DOUBLE, IN `end_range` DOUBLE, IN `fix_compensation_level` DOUBLE, IN `base_tax` DOUBLE, IN `percent_over` DOUBLE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @withholding_tax_id = withholding_tax_id;
	SET @salary_frequency = salary_frequency;
	SET @start_range = start_range;
	SET @end_range = end_range;
    SET @fix_compensation_level = fix_compensation_level;
    SET @base_tax = base_tax;
	SET @percent_over = percent_over;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'INSERT INTO tblwithholdingtax (WITHHOLDING_TAX_ID, SALARY_FREQUENCY, START_RANGE, END_RANGE, FIX_COMPENSATION_LEVEL, BASE_TAX, PERCENT_OVER, TRANSACTION_LOG_ID, RECORD_LOG) VALUES(@withholding_tax_id, @salary_frequency, @start_range, @end_range, @fix_compensation_level, @base_tax, @percent_over, @transaction_log_id, @record_log)';

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
/*!50003 DROP PROCEDURE IF EXISTS `update_allowance_payroll_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_allowance_payroll_id`(IN payslip_id INT, IN employee_id VARCHAR(100), IN start_date DATE, IN end_date DATE, IN record_log VARCHAR(100))
BEGIN
	SET @payslip_id = payslip_id;
	SET @employee_id = employee_id;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblallowance SET PAYROLL_ID = @payslip_id, RECORD_LOG = @record_log WHERE EMPLOYEE_ID = @employee_id AND PAYROLL_DATE BETWEEN @start_date AND @end_date AND PAYROLL_ID IS NULL';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_allowance_reversal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_allowance_reversal`(IN payslip_id INT, IN record_log VARCHAR(100))
BEGIN
	SET @payslip_id = payslip_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblallowance SET PAYROLL_ID = null, RECORD_LOG = @record_log WHERE PAYROLL_ID = @payslip_id';

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
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_attendance_setting`(IN `setting_id` INT, IN `maximum_attendance` INT, IN `time_out_allowance` INT, IN `late_allowance` INT, IN `late_policy` INT, IN `early_leaving_policy` INT, IN `overtime_policy` INT, IN `attendance_creation_recommendation` INT(1), IN `attendance_adjustment_recommendation` INT(1), IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @setting_id = setting_id;
	SET @maximum_attendance = maximum_attendance;
    SET @time_out_allowance = time_out_allowance;
    SET @late_allowance = late_allowance;
    SET @late_policy = late_policy;
    SET @early_leaving_policy = early_leaving_policy;
    SET @overtime_policy = overtime_policy;
    SET @attendance_creation_recommendation = attendance_creation_recommendation;
    SET @attendance_adjustment_recommendation = attendance_adjustment_recommendation;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblattendancesetting SET MAX_ATTENDANCE = @maximum_attendance, TIME_OUT_ALLOWANCE = @time_out_allowance, LATE_ALLOWANCE = @late_allowance, LATE_POLICY = @late_policy, EARLY_LEAVING_POLICY = @early_leaving_policy, OVERTIME_POLICY = @overtime_policy, ATTENDANCE_CREATION_RECOMMENDATION = @attendance_creation_recommendation, ATTENDANCE_ADJUSTMENT_RECOMMENDATION = @attendance_adjustment_recommendation, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SETTING_ID = @setting_id';

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
/*!50003 DROP PROCEDURE IF EXISTS `update_company_logo_file` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_company_logo_file`(IN company_id VARCHAR(50), IN company_logo VARCHAR(500), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @company_id = company_id;
	SET @company_logo = company_logo;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblcompany SET COMPANY_LOGO = @company_logo, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE COMPANY_ID  = @company_id';

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
/*!50003 DROP PROCEDURE IF EXISTS `update_contribution_deduction_payroll_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_contribution_deduction_payroll_id`(IN payslip_id INT, IN employee_id VARCHAR(100), IN start_date DATE, IN end_date DATE, IN record_log VARCHAR(100))
BEGIN
	SET @payslip_id = payslip_id;
	SET @employee_id = employee_id;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblcontributiondeduction SET PAYROLL_ID = @payslip_id, RECORD_LOG = @record_log WHERE EMPLOYEE_ID = @employee_id AND PAYROLL_DATE BETWEEN @start_date AND @end_date AND PAYROLL_ID IS NULL';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_contribution_deduction_reversal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_contribution_deduction_reversal`(IN payslip_id INT, IN record_log VARCHAR(100))
BEGIN
	SET @payslip_id = payslip_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblcontributiondeduction SET PAYROLL_ID = null, RECORD_LOG = @record_log WHERE PAYROLL_ID = @payslip_id';

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
/*!50003 DROP PROCEDURE IF EXISTS `update_deduction_payroll_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_deduction_payroll_id`(IN payslip_id INT, IN employee_id VARCHAR(100), IN start_date DATE, IN end_date DATE, IN record_log VARCHAR(100))
BEGIN
	SET @payslip_id = payslip_id;
	SET @employee_id = employee_id;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @record_log = record_log;

	SET @query = 'UPDATE tbldeduction SET PAYROLL_ID = @payslip_id, RECORD_LOG = @record_log WHERE EMPLOYEE_ID = @employee_id AND PAYROLL_DATE BETWEEN @start_date AND @end_date AND PAYROLL_ID IS NULL';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_deduction_reversal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_deduction_reversal`(IN payslip_id INT, IN record_log VARCHAR(100))
BEGIN
	SET @payslip_id = payslip_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tbldeduction SET PAYROLL_ID = null, RECORD_LOG = @record_log WHERE PAYROLL_ID = @payslip_id';

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
/*!50003 DROP PROCEDURE IF EXISTS `update_notification_status` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_notification_status`(IN employee_id VARCHAR(100), IN notification_id INT, IN status INT)
BEGIN
	SET @employee_id = employee_id;
	SET @status = status;
	SET @notification_id = notification_id;

	IF @status = 2 THEN
		SET @query = 'UPDATE tblnotification SET STATUS = @status WHERE NOTIFICATION_TO = @employee_id AND STATUS = 0';
	ELSE
		SET @query = 'UPDATE tblnotification SET STATUS = @status WHERE NOTIFICATION_TO = @employee_id AND NOTIFICATION_ID = @notification_id';
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
/*!50003 DROP PROCEDURE IF EXISTS `update_other_income` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_other_income`(IN other_income_id VARCHAR(100), IN payroll_date DATE, IN amount DOUBLE, IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @other_income_id = other_income_id;
	SET @payroll_date = payroll_date;
	SET @amount = amount;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblotherincome SET PAYROLL_DATE = @payroll_date, AMOUNT = @amount, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE OTHER_INCOME_ID = @other_income_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_other_income_payroll_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_other_income_payroll_id`(IN payslip_id INT, IN employee_id VARCHAR(100), IN start_date DATE, IN end_date DATE, IN record_log VARCHAR(100))
BEGIN
	SET @payslip_id = payslip_id;
	SET @employee_id = employee_id;
	SET @start_date = start_date;
	SET @end_date = end_date;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblotherincome SET PAYROLL_ID = @payslip_id, RECORD_LOG = @record_log WHERE EMPLOYEE_ID = @employee_id AND PAYROLL_DATE BETWEEN @start_date AND @end_date AND PAYROLL_ID IS NULL';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_other_income_reversal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_other_income_reversal`(IN payslip_id INT, IN record_log VARCHAR(100))
BEGIN
	SET @payslip_id = payslip_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblotherincome SET PAYROLL_ID = null, RECORD_LOG = @record_log WHERE PAYROLL_ID = @payslip_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_other_income_type` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_other_income_type`(IN other_income_id VARCHAR(100), IN other_income VARCHAR(50), IN taxable VARCHAR(5), IN description VARCHAR(100), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @other_income_id = other_income_id;
	SET @other_income = other_income;
	SET @taxable = taxable;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblotherincometype SET OTHER_INCOME_TYPE = @other_income, TAXABLE = @taxable, DESCRIPTION = @description, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE OTHER_INCOME_TYPE_ID = @other_income_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_payroll_group` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_payroll_group`(IN payroll_group_id INT(50), IN payroll_group VARCHAR(100), IN description VARCHAR(200), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @payroll_group_id = payroll_group_id;
	SET @payroll_group = payroll_group;
	SET @description = description;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblpayrollgroup SET PAYROLL_GROUP = @payroll_group, DESCRIPTION = @description, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE PAYROLL_GROUP_ID = @payroll_group_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_payroll_setting` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_payroll_setting`(IN `setting_id` INT, IN `late_deduction_rate` DOUBLE, IN `early_leaving_deduction_rate` DOUBLE, IN `overtime_rate` DOUBLE, IN `night_differential_rate` DOUBLE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @setting_id = setting_id;
	SET @late_deduction_rate = late_deduction_rate;
	SET @early_leaving_deduction_rate = early_leaving_deduction_rate;
	SET @overtime_rate = overtime_rate;
    SET @night_differential_rate = night_differential_rate;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblpayrollsetting SET LATE_DEDUCTION_RATE = @late_deduction_rate, EARLY_LEAVING_DEDUCTION_RATE = @early_leaving_deduction_rate, OVERTIME_RATE = @overtime_rate, NIGHT_DIFFERENTIAL_RATE = @night_differential_rate, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SETTING_ID = @setting_id';

	PREPARE stmt FROM @query;
	EXECUTE stmt;
	DROP PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_pay_run_status` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_pay_run_status`(IN pay_run_id VARCHAR(50), IN status VARCHAR(10), IN record_log VARCHAR(100))
BEGIN
	SET @pay_run_id = pay_run_id;
	SET @status = status;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblpayrun SET STATUS = @status, RECORD_LOG = @record_log WHERE PAY_RUN_ID = @pay_run_id';

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
/*!50003 DROP PROCEDURE IF EXISTS `update_salary` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_salary`(IN salary_id VARCHAR(100), IN salary_amount DOUBLE, IN salary_frequency VARCHAR(20), IN hours_per_week INT, IN hours_per_day INT, IN minute_rate DOUBLE, IN hourly_rate DOUBLE, IN daily_rate DOUBLE, IN weekly_rate DOUBLE, IN bi_weekly_rate DOUBLE, IN monthly_rate DOUBLE, IN effectivity_date DATE, IN remarks VARCHAR(500), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100))
BEGIN
	SET @salary_id = salary_id;
	SET @salary_amount = salary_amount;
	SET @salary_frequency = salary_frequency;
	SET @hours_per_week = hours_per_week;
	SET @hours_per_day = hours_per_day;

	SET @minute_rate = minute_rate;
	SET @hourly_rate = hourly_rate;
	SET @daily_rate = daily_rate;
	SET @weekly_rate = weekly_rate;
	SET @bi_weekly_rate = bi_weekly_rate;
	SET @monthly_rate = monthly_rate;
	SET @effectivity_date = effectivity_date;
	SET @remarks = remarks;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblsalary SET SALARY_AMOUNT = @salary_amount, SALARY_FREQUENCY = @salary_frequency, HOURS_PER_WEEK = @hours_per_week, HOURS_PER_DAY = @hours_per_day, MINUTE_RATE = @minute_rate, HOURLY_RATE = @hourly_rate, DAILY_RATE = @daily_rate, WEEKLY_RATE = @weekly_rate, BI_WEEKLY_RATE = @bi_weekly_rate, MONTHLY_RATE = @monthly_rate, EFFECTIVITY_DATE = @effectivity_date, REMARKS = @remarks, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SALARY_ID = @salary_id';

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
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_user_interface_settings_images`(IN setting_id INT, IN file_path VARCHAR(500), IN transaction_log_id VARCHAR(500), IN record_log VARCHAR(100), IN request_type VARCHAR(20))
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
		SET @query = 'UPDATE tbluserinterfacesettings SET FAVICON = @file_path, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE SETTINGS_ID = @setting_id';
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
/*!50003 DROP PROCEDURE IF EXISTS `update_withholding_tax` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_withholding_tax`(IN `withholding_tax_id` VARCHAR(100), IN `salary_frequency` VARCHAR(50), IN `start_range` DOUBLE, IN `end_range` DOUBLE, IN `fix_compensation_level` DOUBLE, IN `base_tax` DOUBLE, IN `percent_over` DOUBLE, IN `transaction_log_id` VARCHAR(500), IN `record_log` VARCHAR(100))
BEGIN
	SET @withholding_tax_id = withholding_tax_id;
	SET @salary_frequency = salary_frequency;
	SET @start_range = start_range;
	SET @end_range = end_range;
    SET @fix_compensation_level = fix_compensation_level;
    SET @base_tax = base_tax;
	SET @percent_over = percent_over;
	SET @transaction_log_id = transaction_log_id;
	SET @record_log = record_log;

	SET @query = 'UPDATE tblwithholdingtax SET SALARY_FREQUENCY = @salary_frequency, START_RANGE = @start_range, END_RANGE = @end_range, FIX_COMPENSATION_LEVEL = @fix_compensation_level, BASE_TAX = @base_tax, PERCENT_OVER = @percent_over, TRANSACTION_LOG_ID = @transaction_log_id, RECORD_LOG = @record_log WHERE WITHHOLDING_TAX_ID = @withholding_tax_id';

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

-- Dump completed on 2022-05-26  9:05:35
