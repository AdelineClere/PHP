-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 08 mars 2018 à 14:38
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `exercice_3`
--

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id_movie` int(3) NOT NULL,
  `title` varchar(50) NOT NULL,
  `actors` varchar(30) NOT NULL,
  `director` varchar(30) NOT NULL,
  `producer` varchar(30) NOT NULL,
  `year_of_prod` year(4) NOT NULL,
  `language` varchar(20) NOT NULL,
  `category` enum('comedie','thriller','drame','horreur') NOT NULL,
  `storyline` text NOT NULL,
  `video` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id_movie`, `title`, `actors`, `director`, `producer`, `year_of_prod`, `language`, `category`, `storyline`, `video`) VALUES
(3, 'Fargo', 'steve Buscemi', 'Joel Ethan Cohen', 'Cohen Cie', 2005, 'anglais', 'thriller', 'Histoire de...', '<iframe width=\"560\" height=\"315\" src=\"https://www.'),
(14, 'Kill Bill', 'Uma Thurman', 'Quentin Tarentino', 'Tarentino', 2007, 'anglais', 'thriller', 'Story from ...', '<iframe width=\"560\" height=\"315\" src=\"https://www.');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id_movie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id_movie` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
