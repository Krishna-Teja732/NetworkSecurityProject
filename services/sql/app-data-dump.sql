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
  `sender_username` varchar(20) NOT NULL,
  `receiver_username` varchar(20) NOT NULL,
  `amount_sent` decimal(65,2) NOT NULL,
  `transaction_remark` varchar(200) DEFAULT NULL,
  `transaction_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `username_transaction_index` (`sender_username`,`receiver_username`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`sender_username`) REFERENCES `users` (`username`) ON DELETE RESTRICT,
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`receiver_username`) REFERENCES `users` (`username`) ON DELETE RESTRICT,
  CONSTRAINT `positive_amount_sent_check` CHECK ((`amount_sent` > 0)),
  CONSTRAINT `sender_not_eq_receiver_check` CHECK ((`sender_username` <> `receiver_username`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (_binary '\Ât¬üå8°ò	M~o\‘\„\ﬂ','b','a',10.00,'new transaction with date','2025-03-04 07:26:08'),(_binary 'brª®\–\Ì≠^R\ \‚EJcÇñ','c','b',10.00,'new transaction with date','2025-03-04 07:26:08'),(_binary 'y„Üå´ıjı™&~?µDv','aa','c',10.00,'new transaction with date','2025-03-04 07:26:08'),(_binary 'X\·-g]vâﬂ™1wuØ4•','a','c',20.00,'new transaction with date','2025-03-04 07:26:08'),(_binary '\Ìe!ß\Ó†9{\ÈaX⁄®°','b','a',10.00,'new transaction with date','2025-03-04 07:26:08'),(_binary '\ﬂdDn\Ì˘6Mè-¥3†¢Z','c','b',10.00,'new transaction with date','2025-03-04 07:26:08'),(_binary '\Èﬁ∂Å\Í’æ˘\Ó\ƒyc˛¢n','aa','c',10.00,'new transaction with date','2025-03-04 07:26:08'),(_binary '\Ô´ï\Z;7Nã§\’¬¨ø','a','c',20.00,'new transaction with date','2025-03-04 07:26:08'),(_binary 'IHbBÉóè\·òX¶\\˝©ü','b','a',10.00,'new transaction with date','2025-03-04 07:26:08'),(_binary '\”«Åd0\¬Dµ2\ÿtt`L\‡','c','b',10.00,'new transaction with date','2025-03-04 07:26:08'),(_binary '<Çá˜wd5ûü#µ\⁄cn','aa','c',10.00,'new transaction with date','2025-03-04 07:26:08'),(_binary '\∆˚ëRU\…>ªx5\«uå/&','a','c',20.00,'new transaction with date','2025-03-04 07:26:08'),(_binary '\‹YÒú\√8\¬\\î]¥ap','babbaa','b',5.00,'new transaction with date','2025-03-04 07:29:29'),(_binary 'ñz¯°Oó2Bº{1Ø^˝','b','babbaa',7.00,'new transaction with date','2025-03-04 07:29:29'),(_binary 'ÿ¥îf\Â\\c\‘oOÉ$≤1ß','babbaa','b',5.00,'new transaction with date','2025-03-04 07:29:30'),(_binary 'ZzS/◊¥e]®;Q¶ı','b','babbaa',7.00,'new transaction with date','2025-03-04 07:29:30'),(_binary 'L®ï•∂úZ‘àG-W_\"','babbaa','b',5.00,'new transaction with date','2025-03-04 07:29:30'),(_binary '¥æ∫\⁄*oPR\Èä\·|','b','babbaa',7.00,'new transaction with date','2025-03-04 07:29:30');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `profile_picture_path` char(36) NOT NULL,
  `password` char(60) NOT NULL,
  `balance` decimal(65,2) NOT NULL,
  PRIMARY KEY (`username`),
  CONSTRAINT `users_chk_1` CHECK ((`balance` >= 0))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('a','a@mail.com','This is a new description','default-user-icon.png','$2y$10$1qBwcvnRq/ocoAzX8IzdGu3T5yE/Dls/v81U2erHv4jit1n2WV7f6',110.00),('aa','aa@gmail.com','No description added','default-user-icon.png','$2y$10$ht4bURNw36nH9rsNq7396u/Fbi2m8qVfmGZdnBA7cTner4BeepDAy',40.00),('b','b@mail','No description added','default-user-icon.png','$2y$10$ZZVbRxNutHCSmZD8kIIEYOVjtVq56O0iz1Ni3vjX9hr74x/6dPM6K',94.00),('babbaa','babbaa@gmail.com','No description added','default-user-icon.png','$2y$10$3xy11k9x8VnU6xMMhx3fq.BCH/vem2oQLBM/FBsAG8w5O1QAFFwBq',106.00),('c','c@mail.com','No description added','default-user-icon.png','$2y$10$yyZLCgwJSv21YOjVyESGXuOPgRAYTr1jTKB9ji3Ozy/kb7ZhHOnLm',150.00);
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

-- Dump completed on 2025-03-04 13:06:07
