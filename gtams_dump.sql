-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: gtasm
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `advisors`
--

DROP TABLE IF EXISTS `advisors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advisors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advisors`
--

LOCK TABLES `advisors` WRITE;
/*!40000 ALTER TABLE `advisors` DISABLE KEYS */;
INSERT INTO `advisors` VALUES (1,'Chet Wiggums','chwiggs@yahoo.com'),(2,'test test1','test@test1.com'),(3,'test2 test2','test2@test2.com'),(4,'Brandon Aulet','brandonaulet500@gmail.com');
/*!40000 ALTER TABLE `advisors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applicant_advisors`
--

DROP TABLE IF EXISTS `applicant_advisors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applicant_advisors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `current` tinyint(1) NOT NULL DEFAULT '0',
  `applicant_pid` int(11) NOT NULL,
  `advisor_id` int(11) NOT NULL,
  `time_period_start` date NOT NULL,
  `time_period_end` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `applicant_advisors_advisors` (`advisor_id`),
  KEY `applicant_advisors_applicants` (`applicant_pid`),
  CONSTRAINT `applicant_advisors_applicants` FOREIGN KEY (`applicant_pid`) REFERENCES `applicants` (`pid`),
  CONSTRAINT `applicant_advisors_advisors` FOREIGN KEY (`advisor_id`) REFERENCES `advisors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applicant_advisors`
--

LOCK TABLES `applicant_advisors` WRITE;
/*!40000 ALTER TABLE `applicant_advisors` DISABLE KEYS */;
INSERT INTO `applicant_advisors` VALUES (1,1,4345897,2,'0000-00-00','0000-00-00'),(2,0,4345897,1,'1969-12-31','1969-12-31'),(3,1,4021235,3,'0000-00-00','0000-00-00'),(4,0,4021235,1,'1969-12-31','1969-12-31'),(5,1,9877892,2,'0000-00-00','0000-00-00'),(6,0,9877892,1,'2014-03-05','2014-05-05'),(7,1,6532548,4,'0000-00-00','0000-00-00'),(8,0,6532548,1,'2014-01-03','2014-05-05');
/*!40000 ALTER TABLE `applicant_advisors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applicants`
--

DROP TABLE IF EXISTS `applicants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applicants` (
  `pid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `phd_of_cs` tinyint(1) NOT NULL,
  `passed_speak` tinyint(1) NOT NULL,
  `student_semesters` int(11) NOT NULL,
  `employee_semesters` int(11) NOT NULL,
  `application_status` int(11) NOT NULL DEFAULT '0',
  `gpa` decimal(4,3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `link_id` int(11) NOT NULL,
  `letter` text,
  `letter_pdf` blob,
  `semester_session_id` int(11) NOT NULL,
  `advisor_rank` int(11) NOT NULL DEFAULT '0',
  `advisor_verified` tinyint(1) NOT NULL DEFAULT '0',
  `responded` tinyint(1) DEFAULT NULL,
  `warning_sent` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `applicants_ak_1` (`pid`),
  UNIQUE KEY `applicants_ak_2` (`email`),
  UNIQUE KEY `applicants_ak_3` (`link_id`),
  KEY `applicant_form_idx_1` (`pid`,`email`),
  KEY `applicants_sessions` (`semester_session_id`),
  CONSTRAINT `applicants_sessions` FOREIGN KEY (`semester_session_id`) REFERENCES `semester_sessions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applicants`
--

LOCK TABLES `applicants` WRITE;
/*!40000 ALTER TABLE `applicants` DISABLE KEYS */;
INSERT INTO `applicants` VALUES (4021235,'arnold@knights.ucf.edu','Arnold','Palmer',-8224,1,1,5,5,0,2.500,'2016-04-13 09:44:03',2,NULL,NULL,1,0,0,NULL,NULL),(4345897,'freddy@knights.ucf.edu','Fred','Doe',-8224,1,1,5,5,0,4.000,'2016-04-13 09:42:49',1,NULL,NULL,1,0,0,NULL,NULL),(6532548,'sammysosa@hotmail.com','Sammy','Samsterton',-9072,1,1,3,4,0,2.000,'2016-04-14 07:03:45',4,NULL,NULL,3,0,1,NULL,1),(9877892,'notificationtest@email.com','Jeff','Bridges',-8232,1,1,5,5,3,4.000,'2016-04-14 07:04:02',3,NULL,NULL,3,0,0,NULL,1);
/*!40000 ALTER TABLE `applicants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gc_members`
--

DROP TABLE IF EXISTS `gc_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gc_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password_digest` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `chair` tinyint(1) NOT NULL DEFAULT '0',
  `semester_session_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gc_member_ak_1` (`email`),
  KEY `gc_member_sessions` (`semester_session_id`),
  CONSTRAINT `gc_member_sessions` FOREIGN KEY (`semester_session_id`) REFERENCES `semester_sessions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gc_members`
--

LOCK TABLES `gc_members` WRITE;
/*!40000 ALTER TABLE `gc_members` DISABLE KEYS */;
INSERT INTO `gc_members` VALUES (1,'test@chair1.com','testchair1','Test','Chair1',1,1),(2,'test@other1.com','testother1','Test','Other1',0,1),(3,'test@other2.com','testother2','test','Other2',0,1),(6,'brandonaulet500@gmail.com','This is a test.','test','Other2',0,2),(7,'ss@hotmail.com','ssasifrass','Susan','Sassafrass',1,3),(8,'tester@testen.com','tester10','Tester','10',0,3);
/*!40000 ALTER TABLE `gc_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gc_scores`
--

DROP TABLE IF EXISTS `gc_scores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gc_scores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL,
  `applicants_pid` int(11) NOT NULL,
  `gc_members_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gc_score_applicants` (`applicants_pid`),
  KEY `gc_score_gc_members` (`gc_members_id`),
  CONSTRAINT `gc_score_gc_members` FOREIGN KEY (`gc_members_id`) REFERENCES `gc_members` (`id`),
  CONSTRAINT `gc_score_applicants` FOREIGN KEY (`applicants_pid`) REFERENCES `applicants` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gc_scores`
--

LOCK TABLES `gc_scores` WRITE;
/*!40000 ALTER TABLE `gc_scores` DISABLE KEYS */;
INSERT INTO `gc_scores` VALUES (1,50,4021235,3),(2,40,4021235,2),(3,70,4021235,1),(4,100,4345897,1),(5,60,4345897,2),(6,10,4345897,3);
/*!40000 ALTER TABLE `gc_scores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grad_courses`
--

DROP TABLE IF EXISTS `grad_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grad_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(255) NOT NULL,
  `grade` int(11) NOT NULL,
  `applicant_pid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `grad_courses_take_idx_1` (`applicant_pid`),
  CONSTRAINT `grad_courses_take_applicant_forms` FOREIGN KEY (`applicant_pid`) REFERENCES `applicants` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grad_courses`
--

LOCK TABLES `grad_courses` WRITE;
/*!40000 ALTER TABLE `grad_courses` DISABLE KEYS */;
INSERT INTO `grad_courses` VALUES (1,'COP 4980',4,4345897),(2,'ATP 9999',4,4021235),(3,'CDL 4980',1,4021235),(4,'CDL 4980',4,9877892),(5,'CAB 5678',2,6532548);
/*!40000 ALTER TABLE `grad_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publications`
--

DROP TABLE IF EXISTS `publications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `citation` varchar(255) NOT NULL,
  `applicant_pid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `publications_applicants` (`applicant_pid`),
  CONSTRAINT `publications_applicants` FOREIGN KEY (`applicant_pid`) REFERENCES `applicants` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publications`
--

LOCK TABLES `publications` WRITE;
/*!40000 ALTER TABLE `publications` DISABLE KEYS */;
INSERT INTO `publications` VALUES (1,'Changes in XXXX for XXXX','ACM: 2016 XXXX',4345897),(2,'Changes in XXXX for XXXX','ACM: 2016 XXXX',4021235),(3,'Changes in XXXX for XXXX','ACM: 2016 XXXX',9877892),(4,'Changes in XXXX for XXXX','ACM: 2016 XXXX',6532548);
/*!40000 ALTER TABLE `publications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semester_sessions`
--

DROP TABLE IF EXISTS `semester_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `semester_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `form_deadline` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `letter_deadline` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semester_sessions`
--

LOCK TABLES `semester_sessions` WRITE;
/*!40000 ALTER TABLE `semester_sessions` DISABLE KEYS */;
INSERT INTO `semester_sessions` VALUES (1,'Spring 2016','2016-02-14 05:00:00','2016-07-06 04:00:00'),(2,'Spring 2017','2016-02-14 05:00:00','2016-07-06 04:00:00'),(3,'Fall 2016','2017-04-14 03:30:00','2016-04-13 03:30:00');
/*!40000 ALTER TABLE `semester_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_admins`
--

DROP TABLE IF EXISTS `system_admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password_digest` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `system_admins_ak_1` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_admins`
--

LOCK TABLES `system_admins` WRITE;
/*!40000 ALTER TABLE `system_admins` DISABLE KEYS */;
INSERT INTO `system_admins` VALUES (1,'test@test.com','tester1');
/*!40000 ALTER TABLE `system_admins` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-14 10:56:21
