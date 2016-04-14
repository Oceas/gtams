-- MySQL dump 10.16  Distrib 10.1.13-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: gtams
-- ------------------------------------------------------
-- Server version	10.1.13-MariaDB

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advisors`
--

LOCK TABLES `advisors` WRITE;
/*!40000 ALTER TABLE `advisors` DISABLE KEYS */;
INSERT INTO `advisors` VALUES (1,'NA','NA'),(2,'Joe Doe','joedoe@email.com'),(3,'Jane Doe','janedoe@email.com');
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
  CONSTRAINT `applicant_advisors_advisors` FOREIGN KEY (`advisor_id`) REFERENCES `advisors` (`id`),
  CONSTRAINT `applicant_advisors_applicants` FOREIGN KEY (`applicant_pid`) REFERENCES `applicants` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applicant_advisors`
--

LOCK TABLES `applicant_advisors` WRITE;
/*!40000 ALTER TABLE `applicant_advisors` DISABLE KEYS */;
INSERT INTO `applicant_advisors` VALUES (1,1,23,2,'0000-00-00','0000-00-00'),(2,0,23,1,'0002-12-31','0003-02-12'),(3,1,233,2,'0000-00-00','0000-00-00'),(4,0,233,1,'0003-02-13','0032-02-02');
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
  PRIMARY KEY (`pid`),
  UNIQUE KEY `applicants_ak_1` (`pid`),
  UNIQUE KEY `applicants_ak_2` (`email`),
  UNIQUE KEY `applicants_ak_3` (`link_id`),
  KEY `applicant_form_idx_1` (`pid`,`email`),
  KEY `applicants_sessions` (`semester_session_id`),
  CONSTRAINT `applicants_sessions` FOREIGN KEY (`semester_session_id`) REFERENCES `semester_sessions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applicants`
--

LOCK TABLES `applicants` WRITE;
/*!40000 ALTER TABLE `applicants` DISABLE KEYS */;
INSERT INTO `applicants` VALUES (23,'email@email.com','Ussama','Azam',1786859239,1,0,6,4,0,4.000,'2016-04-13 04:02:08',1,NULL,NULL,1,0,0,NULL),(233,'nuclear.oreo@gmail.com','Brandon','Aulet',2147483647,1,1,6,4,0,4.000,'2016-04-13 04:03:10',2,NULL,NULL,1,0,0,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gc_members`
--

LOCK TABLES `gc_members` WRITE;
/*!40000 ALTER TABLE `gc_members` DISABLE KEYS */;
INSERT INTO `gc_members` VALUES (1,'','','','Aulet',0,1),(3,'yup','','','Johnny',0,1);
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
  CONSTRAINT `gc_score_applicants` FOREIGN KEY (`applicants_pid`) REFERENCES `applicants` (`pid`),
  CONSTRAINT `gc_score_gc_members` FOREIGN KEY (`gc_members_id`) REFERENCES `gc_members` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gc_scores`
--

LOCK TABLES `gc_scores` WRITE;
/*!40000 ALTER TABLE `gc_scores` DISABLE KEYS */;
INSERT INTO `gc_scores` VALUES (1,50,23,1),(2,50,233,3),(3,70,233,1),(5,70,23,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grad_courses`
--

LOCK TABLES `grad_courses` WRITE;
/*!40000 ALTER TABLE `grad_courses` DISABLE KEYS */;
INSERT INTO `grad_courses` VALUES (1,'cop1223',4,23),(2,'cop1223',4,233);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publications`
--

LOCK TABLES `publications` WRITE;
/*!40000 ALTER TABLE `publications` DISABLE KEYS */;
INSERT INTO `publications` VALUES (1,'Changes in dog for cat','ACM: 2016 48156',23),(2,'Changes in dog for cat','ACM: 2016 48156',233);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semester_sessions`
--

LOCK TABLES `semester_sessions` WRITE;
/*!40000 ALTER TABLE `semester_sessions` DISABLE KEYS */;
INSERT INTO `semester_sessions` VALUES (1,'Fall 2024','2016-04-13 04:00:48','0000-00-00 00:00:00'),(2,'Spring 2025','2016-04-13 04:00:48','0000-00-00 00:00:00');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_admins`
--

LOCK TABLES `system_admins` WRITE;
/*!40000 ALTER TABLE `system_admins` DISABLE KEYS */;
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

-- Dump completed on 2016-04-13 20:01:23
