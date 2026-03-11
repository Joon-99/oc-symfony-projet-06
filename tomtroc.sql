-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 11 mars 2026 à 17:24
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS=0;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tomtroc`
--
CREATE DATABASE IF NOT EXISTS `tomtroc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci;
USE `tomtroc`;

-- --------------------------------------------------------

--
-- Structure de la table `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `pen_name` varchar(255) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `valid` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `authors`
--

INSERT INTO `authors` (`id`, `first_name`, `last_name`, `pen_name`, `biography`, `valid`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'Alabaster', NULL, 1, '2025-04-07 02:17:29', '2025-04-07 02:17:29'),
(2, 'Nathan', 'Williams', NULL, NULL, 1, '2025-04-07 02:17:29', '2025-04-07 02:17:29'),
(3, 'Beth', 'Kempton', NULL, NULL, 1, '2025-04-07 02:17:29', '2025-04-07 02:17:29'),
(4, 'Rupi', 'Kaur', NULL, NULL, 1, '2025-04-07 02:17:29', '2025-04-07 02:17:29'),
(5, 'Justin', 'Rossow', NULL, NULL, 1, '2025-04-14 05:50:06', '2025-04-14 05:50:06');

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `cover_img_id` int(11) DEFAULT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `valid` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `author_id`, `owner_id`, `cover_img_id`, `available`, `valid`, `created_at`, `updated_at`) VALUES
(1, 'Esther', NULL, 1, 2, 1, 1, 1, '2025-04-07 02:25:39', '2025-04-07 03:36:39'),
(2, 'The Kinfolk Table', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table.<br><br> Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité.<br><br> Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers.<br><br> \'The Kinfolk Table\' incarne parfaitement l\'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.', 2, 3, 2, 1, 1, '2025-04-07 02:25:39', '2025-04-14 11:32:15'),
(3, 'Wabi Sabi', 'Super bouquin', 3, 4, 17, 1, 1, '2025-04-07 02:25:39', '2026-03-10 20:54:12'),
(4, 'Milk & honey', NULL, 4, 5, 4, 1, 1, '2025-04-07 02:25:39', '2025-04-07 03:37:24'),
(5, 'Delight!', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. \r\n\r\nLes photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. \r\n\r\nChaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. \r\n\r\n\'The Kinfolk Table\' incarne parfaitement l\'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.', 5, 6, 14, 1, 1, '2025-04-14 06:03:27', '2025-11-03 16:11:06'),
(7, 'test', 'testtest', 2, 3, 8, 1, 1, '2025-05-09 04:33:46', '2025-05-09 04:33:46'),
(8, 'test', 'testtest', 2, 3, 8, 1, 1, '2025-05-09 04:33:57', '2025-05-09 04:33:57'),
(9, 'test', 'testtest', 2, 3, 8, 1, 1, '2025-05-09 04:34:05', '2025-05-09 04:34:05'),
(14, 'test', 'sdfsdfsdf', 1, 4, 18, 1, 1, '2026-02-23 18:40:50', '2026-02-23 18:40:50'),
(15, 'My Book', 'Super                                            ', 2, 1, 8, 1, 1, '2026-03-11 13:10:49', '2026-03-11 13:10:49');

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `valid` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `files`
--

INSERT INTO `files` (`id`, `user_id`, `title`, `mime_type`, `file_path`, `valid`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Esther', 'image/jpeg', 'esther.jpg', 1, '2025-04-07 03:24:34', '2025-04-14 09:02:50'),
(2, NULL, 'The Kinfolk Table', 'image/jpeg', 'the-kinfolk-table.jpg', 1, '2025-04-07 03:24:34', '2025-04-14 09:03:04'),
(3, NULL, 'Wabi Sabi', 'image/jpeg', 'wabi-sabi.jpg', 1, '2025-04-07 03:24:34', '2025-04-14 09:03:11'),
(4, NULL, 'Milk & honey', 'image/jpeg', 'milk-honey.jpg', 1, '2025-04-07 03:24:34', '2025-04-14 09:03:16'),
(5, NULL, 'delight', 'image/jpeg', 'delight.jfif', 1, '2025-04-14 06:02:58', '2025-04-14 09:03:23'),
(6, 3, 'nathalire', 'image/jpeg', 'nathalire.jfif', 1, '2025-04-14 11:51:50', '2025-04-14 11:51:50'),
(7, NULL, 'anonymous user profile image', 'image/png', 'anonymous-user.png', 1, '2025-04-22 11:49:10', '2025-04-22 11:49:10'),
(8, NULL, 'placeholder', 'image/jpg', 'placeholder.jpg', 1, '2025-05-09 03:12:37', '2025-05-09 03:12:37'),
(14, NULL, 'Delight! - Cover', 'image/jpeg', '5-delight-68f7c412ddf90.jfif', 1, '2025-10-21 19:34:10', '2025-10-21 19:34:10'),
(15, 4, 'alexlecture', 'image/jpeg', 'alexlecture.jfif', 1, '2025-11-03 17:03:23', '2025-11-03 17:03:23'),
(16, NULL, 'test - Cover', 'image/jpeg', '0-test-699c8d3938d59.jpg', 1, '2026-02-23 18:24:09', '2026-02-23 18:24:09'),
(17, NULL, 'Wabi Sabi - Cover', 'image/jpeg', '3-wabi-sabi-699c8f266d60d.jpg', 1, '2026-02-23 18:32:22', '2026-02-23 18:32:22'),
(18, NULL, 'test - Cover', 'image/jpeg', '0-test-699c9122aaafc.jpg', 1, '2026-02-23 18:40:50', '2026-02-23 18:40:50'),
(19, NULL, 'admin - Profile', 'image/png', 'admin-69b157dbd7d39.png', 1, '2026-03-11 12:54:03', '2026-03-11 12:54:03'),
(20, NULL, 'admin - Profile', 'image/jpeg', 'admin-69b15d2993711.jpg', 1, '2026-03-11 13:16:41', '2026-03-11 13:16:41');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `valid` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `content`, `valid`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Hey, are you coming to the meeting?', 1, '2025-10-27 09:00:00', '2025-10-27 09:00:00'),
(2, 2, 1, 'Yes, I\'ll be there in 10.', 1, '2025-10-27 09:05:00', '2025-10-27 09:05:00'),
(3, 1, 2, 'Great, see you.', 1, '2025-10-27 09:12:00', '2025-10-27 09:12:00'),
(4, 4, 2, 'Can you review my PR?', 1, '2025-10-26 14:00:00', '2025-10-26 14:00:00'),
(5, 2, 4, 'On it, give me 30 mins.', 1, '2025-10-26 14:30:00', '2025-10-26 14:30:00'),
(6, 5, 3, 'Happy birthday!', 1, '2025-10-25 18:00:00', '2025-10-25 18:00:00'),
(7, 3, 5, 'Thanks a lot!', 1, '2025-10-25 18:10:00', '2025-10-25 18:10:00'),
(8, 4, 1, 'Hey, what\'s up?', 1, '2025-10-27 09:00:00', '2025-10-27 09:00:00'),
(9, 1, 4, 'test', 1, '2025-11-03 13:53:15', '2025-11-03 13:53:15'),
(10, 4, 1, 'testback\r\n', 1, '2025-11-03 13:58:46', '2025-11-03 13:58:46'),
(11, 1, 2, 'test', 1, '2025-11-03 17:54:29', '2025-11-03 17:54:29'),
(12, 4, 1, 'sad', 1, '2025-11-03 18:22:28', '2025-11-03 18:22:28'),
(13, 4, 1, 'test3', 1, '2026-03-10 17:48:11', '2026-03-10 17:48:11'),
(14, 1, 4, 'Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor ', 1, '2026-03-10 18:52:21', '2026-03-10 18:52:21'),
(15, 1, 2, 'test', 1, '2026-03-10 20:34:46', '2026-03-10 20:34:46'),
(16, 4, 1, 'youp', 1, '2026-03-10 20:35:24', '2026-03-10 20:35:24'),
(17, 4, 1, 'testt', 1, '2026-03-11 00:11:19', '2026-03-11 00:11:19'),
(18, 1, 5, 'test', 1, '2026-03-11 14:04:29', '2026-03-11 14:04:29');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_img_id` int(11) DEFAULT NULL,
  `valid` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `email`, `profile_img_id`, `valid`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$NcQ43lIvd.xHHDelK8RwDe8EX2f0fdJygH3mM21qHdA0gya7DMe/q', 'admin@admin.com', 20, 1, '2025-04-07 02:12:17', '2026-03-11 13:16:41'),
(2, 'CamilleClubLit', '$2y$12$2jRWNlNeXtzp9LhultGsFuCnTIMWQB3mc0DdJpC9bh1ui0YcdTc92', 'camilleclublit@test.com', 7, 1, '2025-04-07 02:12:17', '2025-10-27 17:32:40'),
(3, 'Nathalire', '$2y$12$aZnirVmKIDJ083SisgmFjO.q5.PnLkki47xBmI/0.o.YLR0G9Bi9O', 'nathalire@test.com', 6, 1, '2025-04-07 02:12:17', '2025-04-14 11:57:39'),
(4, 'Alexlecture', '$2y$10$hG1NarABm03HQVNZxQo0q.Xhjj1dKL29XxvxvtSLlf7.mPK/Ol22q', 'alexlecture@test.com', 15, 1, '2025-04-07 02:12:17', '2025-11-03 17:04:17'),
(5, 'Hugo1990_12', '$2y$12$EP4DqI1Zj3ENHHUku7zudO6A6j1yh.VuSUXFp.gQmKZh8pRdMIWRi', 'hugo1990_12@test.com', 7, 1, '2025-04-07 02:12:17', '2025-10-27 17:32:52'),
(6, 'juju1432', '$2y$10$HgFz.0Ql0p4oOvkXbU4Di.ZgeXueqvbIlYQ5ovU/8wJGR6ylJTf62', 'juju@juju.com', 7, 1, '2025-04-14 05:57:59', '2025-10-27 17:32:55'),
(7, 'test', '$2y$10$CTQOvLDfL4vrJl1rVJsJbeBV6EK0IAJpf9/PeGkGoNDG8Ysq.Zk4q', 'test@test.com', 7, 1, '2025-04-21 20:36:46', '2025-05-02 08:44:36'),
(8, 'test2', '$2y$10$4bBQTFq81Y8I9Mhs7hzDVOiUTc1PjqVoqMjO2GK777RF0nMtH5ANa', 'test2@test.com', 7, 1, '2025-04-21 22:30:43', '2025-10-27 17:33:01'),
(9, 'test3', '$2y$10$AG9xhVZB28e/d0H83uZrWeFwJW87Tokuu4DHIokIuKajC65GIXfBm', 'test3@test.com', 7, 1, '2025-04-22 13:13:17', '2025-10-27 17:33:03'),
(10, 'usertest1', '$2y$10$zbOSrUPPABHIvU0GgzOuTeJGcdQ0VV9HSf264TVJDJDTto/BjB9mm', 'utest1@utest1.com', NULL, 1, '2026-02-23 15:53:23', '2026-02-23 16:37:14');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author_id`),
  ADD KEY `owner` (`owner_id`),
  ADD KEY `cover_img_id` (`cover_img_id`);

--
-- Index pour la table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_files` (`profile_img_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `books_ibfk_3` FOREIGN KEY (`cover_img_id`) REFERENCES `files` (`id`);

--
-- Contraintes pour la table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_files` FOREIGN KEY (`profile_img_id`) REFERENCES `files` (`id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
