hiking-- phpMyAdmin SQL Dump
-- version 4.0.10deb1idid
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 19 Mai 2016 à 11:34
-- Version du serveur: 5.5.49-0ubuntu0.14.04.1-log
-- Version de PHP: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `reunion_island`
--
CREATE DATABASE IF NOT EXISTS `reunion_island` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `reunion_island`;

-- --------------------------------------------------------

--
-- Structure de la table `hiking`
--

DROP TABLE IF EXISTS `hiking`;
CREATE TABLE IF NOT EXISTS `hiking` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `difficulty` enum('très facile','facile','moyen','difficile','très difficile') NOT NULL,
  `distance` int(11) NOT NULL COMMENT 'in km',
  `duration` time NOT NULL,
  `height_difference` int(6) NOT NULL COMMENT 'in m',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;




-- INSERT INTO hiking( name, difficulty, distance, duration, height_difference) VALUES("La traversée du Grand Brulé", "Très difficile", 15, '07:00:00', 100);
I-- NSERT INTO hiking( name, difficulty, distance, duration, height_difference) VALUES("Le grand tour de la Plaine des Sables par le Piton Rouge et l'Oratoire Sainte-Thérèse", "Facile", 15, '05:00:00', 350), ('La boucle du Grand Cap au Brisant par le Sentier des Laves', 'moyen', 5.8, '02:00:00', 120), ('Cassé de la Rivière de l\'Est depuis le Pas de Bellecombe et par le Nez Coupé de Sainte-Rose', 'Difficile', 17.5, '06:30:00', 750),(' La grotte de la Ravine la Source depuis la Plaine des Sables', 'Très difficile', 15.6, '04:30:00', 440);



