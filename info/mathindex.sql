-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 11 mars 2025 à 23:11
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
-- Base de données : `mathindex`
--

-- --------------------------------------------------------

--
-- Structure de la table `classroom`
--

CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `classroom`
--

INSERT INTO `classroom` (`id`, `name`, `created_at`) VALUES
(1, 'Seconde A', '2025-03-11 19:56:04'),
(2, 'Seconde B', '2025-03-11 19:56:32'),
(3, 'Seconde C', '2025-03-11 19:56:37'),
(4, 'Seconde D', '2025-03-11 19:56:56'),
(5, 'Première A', '2025-03-11 19:57:02'),
(6, 'Première B', '2025-03-11 19:57:08'),
(7, 'Première C', '2025-03-11 19:57:14'),
(8, 'Première D', '2025-03-11 19:57:19');

-- --------------------------------------------------------

--
-- Structure de la table `exercise`
--

CREATE TABLE `exercise` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `thematic_id` int(11) NOT NULL,
  `chapter` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `difficulty` int(2) NOT NULL,
  `duration` float NOT NULL,
  `origin_id` int(11) NOT NULL,
  `origin_name` varchar(255) NOT NULL,
  `origin_information` text NOT NULL,
  `exercice_file_id` int(11) NOT NULL,
  `correction_file_id` int(11) NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matter`
--

CREATE TABLE `matter` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `matter`
--

INSERT INTO `matter` (`id`, `name`, `created_at`) VALUES
(1, 'Mathématiques', '2025-03-11 22:18:34');

-- --------------------------------------------------------

--
-- Structure de la table `origin`
--

CREATE TABLE `origin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `thematic`
--

CREATE TABLE `thematic` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `thematic`
--

INSERT INTO `thematic` (`id`, `name`, `created_at`) VALUES
(2, 'La 2ème guerres mondiales', '2025-03-11 22:49:45');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `last_name`, `first_name`, `role`, `password`, `created_at`) VALUES
(1, 'admin@test.com', 'admin', 'test', 'enseignant', '$2y$10$LpV/ra5VIKPVy8VLj.PbF.Lg9fWEOLpw758qepJgIyzC57y2daMX6', '2025-03-11 19:55:48');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`,`name`);

--
-- Index pour la table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classroom_id` (`classroom_id`),
  ADD KEY `thematic_id` (`thematic_id`),
  ADD KEY `origin_id` (`origin_id`),
  ADD KEY `exercice_file_id` (`exercice_file_id`),
  ADD KEY `correction_file_id` (`correction_file_id`),
  ADD KEY `created_by_id` (`created_by_id`);

--
-- Index pour la table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `matter`
--
ALTER TABLE `matter`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `origin`
--
ALTER TABLE `origin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `thematic`
--
ALTER TABLE `thematic`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`,`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `exercise`
--
ALTER TABLE `exercise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `matter`
--
ALTER TABLE `matter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `origin`
--
ALTER TABLE `origin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `thematic`
--
ALTER TABLE `thematic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `exercise`
--
ALTER TABLE `exercise`
  ADD CONSTRAINT `exercise_ibfk_1` FOREIGN KEY (`classroom_id`) REFERENCES `classroom` (`id`),
  ADD CONSTRAINT `exercise_ibfk_2` FOREIGN KEY (`thematic_id`) REFERENCES `thematic` (`id`),
  ADD CONSTRAINT `exercise_ibfk_3` FOREIGN KEY (`origin_id`) REFERENCES `origin` (`id`),
  ADD CONSTRAINT `exercise_ibfk_4` FOREIGN KEY (`exercice_file_id`) REFERENCES `file` (`id`),
  ADD CONSTRAINT `exercise_ibfk_5` FOREIGN KEY (`correction_file_id`) REFERENCES `file` (`id`),
  ADD CONSTRAINT `exercise_ibfk_6` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
