-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: dentcare
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `dentist_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` enum('scheduled','completed','cancelled') DEFAULT 'scheduled',
  `notes` text DEFAULT NULL,
  PRIMARY KEY (`appointment_id`),
  KEY `user_id` (`user_id`),
  KEY `dentist_id` (`dentist_id`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`dentist_id`) REFERENCES `dentists` (`dentist_id`),
  CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (11,1,1,1,'2025-11-13','10:00:00','scheduled','No notes'),(12,1,1,1,'2025-11-13','10:00:00','scheduled','No notes'),(14,5,4,5,'2025-11-25','11:45:00','scheduled','Whitening for upcoming event'),(15,2,1,3,'2025-11-30','13:00:00','cancelled','Cancelled due to illness'),(16,2,1,1,'2025-11-03','10:00:00','scheduled','First visit'),(17,2,1,1,'2025-11-03','10:00:00','scheduled','First visit'),(18,1,2,1,'2025-11-13','10:00:00','scheduled','No notes'),(19,2,1,1,'2025-11-13','10:00:00','scheduled','No notes'),(20,2,1,1,'2025-11-13','10:00:00','scheduled','No notes'),(21,1,1,1,'2026-01-01','13:00:00','','Popravak');
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`message_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `contact_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
INSERT INTO `contact_messages` VALUES (1,2,'Amina Hadzic','amina@example.com','Question about services','Could you explain more about the whitening process?','2025-11-02 00:23:53'),(2,3,'Nedim Selimovic','nedim@example.com','Appointment follow-up','I need to reschedule my root canal appointment.','2025-11-02 00:23:53'),(3,4,'Emina Mujic','emina@example.com','Feedback','Great service, I will definitely come again!','2025-11-02 00:23:53'),(4,1,'Pero Peric','pero.peric@example.com','Subject','Message','2025-11-02 00:23:53'),(5,2,'Amina Hadzic','amina7745@example.com','Question about services','Do you offer whitening?','2025-11-02 00:54:31'),(6,2,'Amina Hadzic','amina97127@example.com','Question about services','Do you offer whitening?','2025-11-02 14:24:17'),(7,5,'Pero Peric','pero.peric@example.com','Subject','Message','2025-11-12 23:53:30'),(8,1,'Pero Peric','pero.peric@example.com','Subject','Hi !','2025-11-13 00:05:01');
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dentists`
--

DROP TABLE IF EXISTS `dentists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dentists` (
  `dentist_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `image_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`dentist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dentists`
--

LOCK TABLES `dentists` WRITE;
/*!40000 ALTER TABLE `dentists` DISABLE KEYS */;
INSERT INTO `dentists` VALUES (1,'Dr. Dino Dinic','General Dentist','https://i.ibb.co/kVHy6DVg/team-1.jpg'),(2,'Dr. Dino-Nino Dinic','General Dentist',NULL),(3,'Dr. Marko Markic','Orthodontic Specialist','https://i.ibb.co/QFB2b2dB/team-3.jpg'),(4,'Dr. Maja Majic','Pediatric Specialist','https://i.ibb.co/cK2s8TpT/team-4.jpg'),(5,'Dr. Ali Alic','Implant Surgeon','https://i.ibb.co/BjD76S2/team-5.jpg'),(6,'Dr. Dino Dinic','General Dentist',NULL),(7,'Dr. Ana Anic','Orthodontist','https://i.ibb.co/jPRbk8m5/team-2.jpg'),(8,'Dr. Dino Dinic','General Dentist',NULL),(9,'Dr. Ana Anic','Orthodontist',NULL),(10,'Dr. Dino-Nino Dinic','General Dentist',NULL);
/*!40000 ALTER TABLE `dentists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricing_plans`
--

DROP TABLE IF EXISTS `pricing_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pricing_plans` (
  `plan_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration_months` int(11) NOT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricing_plans`
--

LOCK TABLES `pricing_plans` WRITE;
/*!40000 ALTER TABLE `pricing_plans` DISABLE KEYS */;
INSERT INTO `pricing_plans` VALUES (1,'Basic Care',29.99,1),(2,'Premium Care',79.99,3),(3,'Basic Plan',400.00,1),(4,'Annual Smile Plan',349.99,12),(5,'Basic Care',29.99,1),(6,'Premium Care',79.99,3),(7,'Basic Care',29.99,1),(8,'Premium Care',79.99,3),(9,'Basic Plan',100.00,2);
/*!40000 ALTER TABLE `pricing_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Dental Check-up & Filling','Comprehensive dental check-up with cavity filling if needed.',90.00),(2,'Dental Check-up & Filling','Description',100.00),(3,'Child Dental Treatment','Gentle dental care and preventive treatments for children.',70.00),(4,'Dental Implant Placement','Surgical placement of dental implants to replace missing teeth.',1500.00),(5,'Teeth Whitening','Cosmetic whitening treatment for brighter teeth.',150.00),(6,'Dental Check-up & Filling','Comprehensive dental check-up with cavity filling if needed.',90.00),(7,'Braces / Clear Aligners','Orthodontic treatment for teeth alignment using braces or clear aligners.',1200.00),(8,'Dental Check-up & Filling','Comprehensive dental check-up with cavity filling if needed.',90.00),(9,'Braces / Clear Aligners','Orthodontic treatment for teeth alignment using braces or clear aligners.',1200.00),(10,'Dental Check-up & Filling','Description',200.00),(11,'Dental Check-up & Filling','Description',200.00);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Benjamin Suljevic','benjamin@example.com','$2a$12$Rt35IHQcehPbQDGta962Ae62pqmPnCWps9dxFGlbWNLELefZ7k3JW','admin'),(2,'Amina Hadzic','amina@example.com','amina2025','user'),(3,'Nedim Selimovic','nedim@example.com','nedim321','user'),(4,'Emina Mujic','emina@example.com','emina456','user'),(5,'Adnan Becirovic','adnan@example.com','adnan789','user'),(6,'John Doe','john@example.com','$2y$10$MyQrm3hIlFRSbzpcu8BmluRNHG7J8O61oaWLrQ6ZvMZhhgkXmZQ66',''),(8,'Benjamin Suljevic','benjamin8545@example.com','$2y$10$23FVTyZX0S4txUC0PYhlouR5h0G1qPEdjrmU2tKmE9JFuavcaeAY2','admin'),(9,'Amina Hadzic','amina7082@example.com','$2y$10$psiClquo7cF2lk.HF67T9.g6uDaKaUT1T74aEPPaHNVTWE4iWZu3K','user'),(10,'Nedim Selimovic','nedim4626@example.com','$2y$10$Smjm.TY9Ps10n9EMxINgx.sseBpvt38F/IYinPhqXm4ERLzzr4pi2','user'),(11,'Benjamin Suljevic','benjamin6439@example.com','$2y$10$b5/fcTH1yX5iScP76zev0OA8bPBQz52Qi5SVNbEbAtQTpbRmnn0gK','admin'),(12,'Amina Hadzic','amina56916@example.com','$2y$10$h5qu59y5gCxb/a62baxR9O/8q448ydcka8v6DPViEl7TI1xBpwVx2','user'),(20,'aaaa','aaaa@gmail.com','$2y$10$l2.UNAhAg0yskrk1oASGE.oO7n4q.j4LBBAyMJD./ldE05N2IgFQO','admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'dentcare'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-25 17:32:15
