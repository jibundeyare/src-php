-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  ven. 23 nov. 2018 à 12:09
-- Version du serveur :  10.1.35-MariaDB
-- Version de PHP :  7.2.9

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `src_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
CREATE TABLE IF NOT EXISTS `promotions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `promotions`
--

INSERT INTO `promotions` (`id`, `name`, `startdate`, `enddate`) VALUES
(1, 'Promo 1', '2010-09-01', '2011-06-30'),
(2, 'Promo 2', '2011-09-01', '2012-06-30'),
(3, 'Promo 3', '2012-09-01', '2013-06-30'),

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `promotion_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `promotion_id` (`promotion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `students`
--

INSERT INTO `students` (`id`, `firstname`, `lastname`, `sex`, `birthdate`, `postcode`, `address`, `promotion_id`) VALUES
(1, 'Foo', 'Foo', NULL, NULL, NULL, NULL, 1),
(3, 'Bar', 'Bar', NULL, NULL, NULL, NULL, 1),
(4, 'Baz', 'Baz', NULL, NULL, NULL, NULL, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `promotion_id` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
