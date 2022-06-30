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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum.categorie : ~5 rows (environ)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`id_categorie`, `name`) VALUES
	(1, 'categorie1'),
	(2, 'categorie2'),
	(3, 'categorie3'),
	(4, 'categorie4'),
	(5, 'categorie5');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum.post : ~3 rows (environ)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id_post`, `message_date`, `text`, `topic_id`, `user_id`) VALUES
	(1, '2022-06-23 15:31:22', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit. ', 1, 32),
	(2, '2022-06-27 09:20:58', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor.. ', 2, 29),
	(3, '2022-06-27 09:21:11', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam ', 3, 30),
	(4, '2022-06-30 09:04:30', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit. ', 1, 30),
	(5, '2022-06-30 10:42:47', 'fdssssssssssssssssssssbgdnfgdjnv;v,nyjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjty', 4, 33),
	(6, '2022-06-30 22:02:56', 'aaaaaaaaaaaaaaaabvbfdngfdgd', 4, 37),
	(7, '2022-06-30 22:11:33', 'gfhdddddddhgfdgggggggggggggggggggggggggggggggggggggggggg', 4, 37),
	(8, '2022-06-30 22:11:40', 'hgdfffffffffffffffffffffffffffffffffffffffffffffffffffffff', 4, 37);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum.topic : ~4 rows (environ)
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` (`id_topic`, `title`, `topic_date`, `is_locked`, `categorie_id`, `user_id`) VALUES
	(1, 'sujet1', '2022-06-23 16:14:43', 0, 1, 30),
	(2, 'sujet2', '2022-06-23 16:14:44', 0, 1, 30),
	(3, 'sujet3', '2022-06-27 09:18:11', 0, 2, 32),
	(4, 'sujet4', '2022-06-27 09:20:07', 0, 3, 32);
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum.user : ~3 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `pseudonyme`, `register_date`, `email`, `password`, `role`, `estBanni`) VALUES
	(29, 'user1', '2022-06-22 00:43:29', 'user1@user1.u', '$2y$10$mNMcgavUpj5obfVrPuirJ.TZU1rp3Qfqx2FyUsH.JOTgG6Jh/6v7e', 'membre', 0),
	(30, 'user2', '2022-06-22 01:03:15', 'user2@user2.u', '$2y$10$4Z..Cepgu4vYo8v77qX9bukANrUhFH6OSx3akK8sn7r2O2J.wy6ye', 'membre', 0),
	(32, 'user3', '2022-06-23 10:37:23', 'user3@user3.u', '$2y$10$xKBGm1/rOlCgUk96E0pdO.MXnF1BXJP9SKNw/ASkAQJPifUAxdgx6', 'membre', 1),
	(33, 'user4', '2022-06-30 10:41:45', 'user4@user4.user4', '$2y$10$ikiREY4DGjvNv7foPI5CrOG2LQLRQO6j86F65vUxOosV3ijF7umBa', 'membre', 0),
	(34, 'user5', '2022-06-30 15:26:06', 'user5@user5.fr', '$2y$10$oiht6ZfujgazLy4ELOF9B.6elcW4.zehYToSlll62taoyiJ9zQzr6', 'membre', 0),
	(35, 'user6', '2022-06-30 18:45:51', 'user6@user6.fr', '$2y$10$PPmrWwGYyP7wxu44rC1e7OrNQ5tqKOCmuBeZsFhFtmRAZx.vvKwCO', 'membre', 0),
	(36, 'user7', '2022-06-30 18:46:40', 'user7@user7.fr', '$2y$10$/lWOvqNUFV42SZ6woYO3/OcmReB8wT/21mmvxy.PLMgfHVi944PSe', 'membre', 0),
	(37, 'User8', '2022-06-30 19:15:48', 'user8@user8.fr', '$2y$10$Rvkf7vurYI7D.KsONDWuL.d49ShKWTKPHejfLrSXCcIPYkp7813YS', 'admin', 0),
	(39, 'User11', '2022-06-30 22:49:37', 'user11@user11.fr', '$2y$10$W7fA/Lll8rjRv5COjGchU.cUeVxTokVE7XlcCCCTq6lxuYlFVybi2', 'membre', 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
