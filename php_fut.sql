-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 19 déc. 2024 à 16:36
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `php_fut`
--

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `club` varchar(100) NOT NULL,
  `logo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clubs`
--

INSERT INTO `clubs` (`id`, `club`, `logo`) VALUES
(28, 'Real', 'https://cdn.sofifa.net/players/235/212/25_120.png');

-- --------------------------------------------------------

--
-- Structure de la table `fplayer`
--

CREATE TABLE `fplayer` (
  `id` int(11) NOT NULL,
  `player_id` int(11) DEFAULT NULL,
  `pace` int(11) DEFAULT NULL,
  `shooting` int(11) DEFAULT NULL,
  `passing` int(11) DEFAULT NULL,
  `dribbling` int(11) DEFAULT NULL,
  `defending` int(11) DEFAULT NULL,
  `physical` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `goalkeeper`
--

CREATE TABLE `goalkeeper` (
  `id` int(11) NOT NULL,
  `player_id` int(11) DEFAULT NULL,
  `diving` int(11) DEFAULT NULL,
  `handling` int(11) DEFAULT NULL,
  `kicking` int(11) DEFAULT NULL,
  `reflexes` int(11) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `positioning` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `nationalities`
--

CREATE TABLE `nationalities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `flag` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `nationalities`
--

INSERT INTO `nationalities` (`id`, `name`, `flag`) VALUES
(57, 'marocain', 'https://cdn.sofifa.net/players/235/212/25_120.png'),
(59, 'algerian', 'https://cdn.sofifa.net/players/235/212/25_120.png');

-- --------------------------------------------------------

--
-- Structure de la table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `position` varchar(50) NOT NULL,
  `rating` int(11) NOT NULL,
  `nationality_id` int(11) DEFAULT NULL,
  `club_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `club` (`club`);

--
-- Index pour la table `fplayer`
--
ALTER TABLE `fplayer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_id` (`player_id`);

--
-- Index pour la table `goalkeeper`
--
ALTER TABLE `goalkeeper`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player_id` (`player_id`);

--
-- Index pour la table `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `fplayer`
--
ALTER TABLE `fplayer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `goalkeeper`
--
ALTER TABLE `goalkeeper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fplayer`
--
ALTER TABLE `fplayer`
  ADD CONSTRAINT `fplayer_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`);

--
-- Contraintes pour la table `goalkeeper`
--
ALTER TABLE `goalkeeper`
  ADD CONSTRAINT `goalkeeper_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`);

--
-- Contraintes pour la table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `club_player_fk` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`),
  ADD CONSTRAINT `nationality_player_fk` FOREIGN KEY (`nationality_id`) REFERENCES `nationalities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
