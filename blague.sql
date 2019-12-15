-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 13 Novembre 2019 à 14:21
-- Version du serveur :  5.7.26-0ubuntu0.18.04.1
-- Version de PHP :  7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blague`
--

-- --------------------------------------------------------

--
-- Structure de la table `blagues`
--

CREATE TABLE `blagues` (
  `Id` int(255) NOT NULL,
  `Id_auteur` int(255) NOT NULL,
  `Pointp` int(255) NOT NULL DEFAULT '0',
  `Blague` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Etat` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Attente',
  `Pointn` int(255) NOT NULL DEFAULT '0',
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `blagues`
--

INSERT INTO `blagues` (`Id`, `Id_auteur`, `Pointp`, `Blague`, `Etat`, `Pointn`, `Date`) VALUES
(2, 1, 0, 'yolo une une meuilleur ', 'Attente', 0, '2019-11-12'),
(4, 1, 20, 'C\'est quoi le point commun entre apprendre qu\'on à le cancer et la première fellation? Dans les deux cas c\'est dur à avaler.', 'Valide', 3, '2019-11-12'),
(5, 2, 0, 'C\'est une femme qui prend sont bain, sont chien pète elle se noie, pourquoi? \r\nParce que sont chien c\'est un Pékinois', 'Attente', 0, '2019-11-13'),
(7, 1, 0, '\"Pourquoi le corps de Ben Laden ne rouille pas dans l\'eau ?\r\nParce qu\'il est antioxydant (anti-occident) ', 'Attente', 0, '2019-11-13');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `Id` int(3) NOT NULL,
  `Pseudo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Mdp` blob NOT NULL,
  `Urlimage` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Roles` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Contributeur'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`Id`, `Pseudo`, `Email`, `Mdp`, `Urlimage`, `Roles`) VALUES
(1, 'Ogmog', 'Ogmog@mail.lol', 0x617a65727479, '', 'Contributeur'),
(2, 'Wisered', 'Wisered@mail.lol', 0x617a65727479, 'image/avatar.png', 'Contributeur'),
(11, 'TOKA974_', 'TOKA97421@mail.lol', 0x617a65727479, 'image/avatar.png', 'Contributeur');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `blagues`
--
ALTER TABLE `blagues`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `blagues`
--
ALTER TABLE `blagues`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
