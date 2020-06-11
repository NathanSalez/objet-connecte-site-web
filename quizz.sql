-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Sam 23 Mai 2020 à 15:44
-- Version du serveur :  5.7.30-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `quizz`
--

-- --------------------------------------------------------

--
-- Structure de la table `propositions`
--

CREATE TABLE `propositions` (
  `id` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL COMMENT 'Clé étrangère vers questions.id',
  `intitule` text NOT NULL,
  `vraie` tinyint(1) NOT NULL,
  `couleur` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `propositions`
--

INSERT INTO `propositions` (`id`, `idQuestion`, `intitule`, `vraie`, `couleur`) VALUES
(1, 1, 'Marseille', 0, 'ROUGE'),
(2, 1, 'Roubaix', 0, 'JAUNE'),
(3, 1, 'Paris', 1, 'VERT'),
(4, 1, 'Lille', 0, 'ORANGE');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `intitule` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`id`, `intitule`) VALUES
(1, 'Quelle est la capitale de la France ?');

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `id` int(11) NOT NULL,
  `idProposition` int(11) NOT NULL COMMENT 'clé étrangère vers propositions.id',
  `identifiantUser` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reponses`
--

INSERT INTO `reponses` (`id`, `idProposition`, `identifiantUser`) VALUES
(1, 3, 'EE:EE:EE:EE:EE'),
(2, 2, 'AA:AA:AA:AA:AA');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `propositions`
--
ALTER TABLE `propositions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `propositions`
--
ALTER TABLE `propositions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
