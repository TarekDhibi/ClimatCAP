-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 11 Avril 2018 à 17:23
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `id5369943_climatcap`
--

-- --------------------------------------------------------

--
-- Structure de la table `climat_table`
--

CREATE TABLE `climat_table` (
  `id` int(11) NOT NULL,
  `temp` text NOT NULL,
  `humd` text NOT NULL,
  `pouss` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `climat_table`
--

INSERT INTO `climat_table` (`id`, `temp`, `humd`, `pouss`) VALUES
(1, '20', '60', '455');

-- --------------------------------------------------------

--
-- Structure de la table `default_climat`
--

CREATE TABLE `default_climat` (
  `id` int(11) NOT NULL,
  `mode_auto` text NOT NULL,
  `demarrer` text NOT NULL,
  `def_temp` text NOT NULL,
  `def_humd` text NOT NULL,
  `def_pouss` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `default_climat`
--

INSERT INTO `default_climat` (`id`, `mode_auto`, `demarrer`, `def_temp`, `def_humd`, `def_pouss`) VALUES
(1, '0', '0', '40', '60', '500');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `climat_table`
--
ALTER TABLE `climat_table`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `default_climat`
--
ALTER TABLE `default_climat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `climat_table`
--
ALTER TABLE `climat_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `default_climat`
--
ALTER TABLE `default_climat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
