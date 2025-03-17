CREATE DATABASE  IF NOT EXISTS `app_database` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `app_database`;
-- MySQL dump 10.13  Distrib 8.4.3, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: app_database
-- ------------------------------------------------------
-- Server version	8.4.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `transaction_id` binary(16) NOT NULL,
  `sender_username` varchar(20) COLLATE utf8mb4_0900_bin NOT NULL,
  `receiver_username` varchar(20) COLLATE utf8mb4_0900_bin NOT NULL,
  `amount_sent` decimal(65,2) NOT NULL,
  `transaction_remark` varchar(200) COLLATE utf8mb4_0900_bin DEFAULT NULL,
  `transaction_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `username_transaction_index` (`sender_username`),
  KEY `transactions_ibfk_2` (`receiver_username`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`sender_username`) REFERENCES `users` (`username`) ON DELETE RESTRICT,
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`receiver_username`) REFERENCES `users` (`username`) ON DELETE RESTRICT,
  CONSTRAINT `positive_amount_sent_check` CHECK ((`amount_sent` > 0)),
  CONSTRAINT `sender_not_eq_receiver_check` CHECK ((`sender_username` <> `receiver_username`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (_binary 'ó¤‰²0v9\ë¬R\Ö\éŒ','ktb','sai',10.00,'','2025-03-17 08:23:01');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `username` varchar(20) COLLATE utf8mb4_0900_bin NOT NULL,
  `email` varchar(20) COLLATE utf8mb4_0900_bin NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_0900_bin NOT NULL,
  `profile_picture_path` char(36) COLLATE utf8mb4_0900_bin NOT NULL,
  `password` char(60) COLLATE utf8mb4_0900_bin NOT NULL,
  `balance` decimal(65,2) NOT NULL,
  `uploaded_file_name` char(36) COLLATE utf8mb4_0900_bin DEFAULT NULL,
  PRIMARY KEY (`username`),
  CONSTRAINT `users_chk_1` CHECK ((`balance` >= 0))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('ktb','ktb@gmail.com','No description added','default-user-icon.png','$2y$10$pHec1/cjjbyrPUOgOgdroeSQVcrbRUfDH6nCPuPRjZpMVNyW//2/W',90.00,NULL),('sai','sai@gmail.com','No description added','default-user-icon.png','$2y$10$YivsxQ6uACC/MBqz7tTAlO7OtbH7SBYeewUqJc9JeNQLu7NA/YXBS',110.00,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-17 13:55:01
