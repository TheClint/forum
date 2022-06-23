-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `forum`;

-- Listage de la structure de la table forum. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum.categorie : ~1 rows (environ)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`id_categorie`, `name`) VALUES
	(1, 'tout');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Listage de la structure de la table forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `message_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `text` text COLLATE utf8_bin,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum.post : ~1 rows (environ)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id_post`, `message_date`, `text`, `topic_id`, `user_id`) VALUES
	(1, '2022-06-23 15:31:22', 'aaaaaaaaaaaaaaaaaaaaaaaaa', 1, 32);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Listage de la structure de la table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `topic_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_locked` tinyint(1) DEFAULT '0',
  `categorie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `categorie_id` (`categorie_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`),
  CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum.topic : ~2 rows (environ)
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` (`id_topic`, `title`, `topic_date`, `is_locked`, `categorie_id`, `user_id`) VALUES
	(1, 'aaa', '2022-06-23 16:14:43', 1, 1, 30),
	(2, 'bbb', '2022-06-23 16:14:44', 1, 1, 30);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;

-- Listage de la structure de la table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `pseudonyme` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `register_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `role` varchar(50) COLLATE utf8_bin DEFAULT 'membre',
  `estBanni` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `pseudonyme` (`pseudonyme`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum.user : ~23 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `pseudonyme`, `register_date`, `email`, `password`, `role`, `estBanni`) VALUES
	(7, 'user7', '2022-06-07 00:00:00', 'user7@abc.yz', '7777', 'membre', 1),
	(8, 'user8', '2022-06-08 00:00:00', 'user8@abc.yz', '8888', 'membre', 1),
	(9, 'user9', '2022-06-09 00:00:00', 'user9@abc.yz', '9999', 'membre', 1),
	(10, 'user10', '2022-06-10 00:00:00', 'user10@abc.yz', '10101010', 'membre', 1),
	(11, 'user11', '2022-06-11 00:15:00', 'user11@abc.yz', '11111111', 'membre', 0),
	(12, 'user12', '2022-06-12 00:00:00', 'user12@abc.yz', '12121212', 'membre', 1),
	(13, 'user13', '2022-06-13 00:00:00', 'user13@abc.yz', '13131313', 'membre', 1),
	(14, 'user14', '2022-06-14 00:00:00', 'user14@abc.yz', '14141414', 'membre', 1),
	(15, 'user15', '2022-06-15 00:00:00', 'user15@abc.yz', '15151515', 'membre', 1),
	(16, 'user16', '2022-06-16 00:00:00', 'user16@abc.yz', '16161616', 'membre', 1),
	(17, 'user17', '2022-06-17 00:00:00', 'user17@abc.yz', '17171717', 'membre', 1),
	(18, 'user18', '2022-06-18 00:00:00', 'user18@abc.yz', '18181818', 'membre', 1),
	(19, 'user19', '2022-06-19 00:00:00', 'user19@abc.yz', '19191919', 'membre', 1),
	(20, 'user0', '2022-06-01 00:00:00', 'user0@abc.yz', '0000', 'membre', 1),
	(21, 'user1', '2022-06-01 00:00:00', 'user1@abc.yz', '1111', 'membre', 1),
	(22, 'user2', '2022-06-02 00:00:00', 'user2@abc.yz', '2222', 'membre', 1),
	(23, 'user3', '2022-06-03 00:00:00', 'user3@abc.yz', '3333', 'membre', 1),
	(24, 'user4', '2022-06-04 00:00:00', 'user4@abc.yz', '4444', 'membre', 1),
	(25, 'user5', '2022-06-05 00:00:00', 'user5@abc.yz', '5555', 'membre', 1),
	(26, 'user6', '2022-06-06 00:00:00', 'user6@abc.yz', '6666', 'membre', 1),
	(29, 'abc', '2022-06-22 00:43:29', 'aaa@a', '$2y$10$mNMcgavUpj5obfVrPuirJ.TZU1rp3Qfqx2FyUsH.JOTgG6Jh/6v7e', 'membre', 0),
	(30, 'abcc', '2022-06-22 01:03:15', 'aaa@aaa', '$2y$10$4Z..Cepgu4vYo8v77qX9bukANrUhFH6OSx3akK8sn7r2O2J.wy6ye', 'membre', 0),
	(32, 'b', '2022-06-23 10:37:23', 'b@b', '$2y$10$xKBGm1/rOlCgUk96E0pdO.MXnF1BXJP9SKNw/ASkAQJPifUAxdgx6', 'membre', 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
