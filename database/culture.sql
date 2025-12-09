-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 09 déc. 2025 à 04:10
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
-- Base de données : `culture`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnements`
--

CREATE TABLE `abonnements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'inactive',
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `statut` varchar(255) NOT NULL,
  `texte` text NOT NULL,
  `note` int(11) NOT NULL,
  `datecomment` datetime NOT NULL,
  `contenu` bigint(20) UNSIGNED NOT NULL,
  `utilisateur` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contenus`
--

CREATE TABLE `contenus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `texte` text NOT NULL,
  `datepub` datetime NOT NULL,
  `statut` varchar(255) NOT NULL,
  `dateval` datetime NOT NULL,
  `region` bigint(20) UNSIGNED NOT NULL,
  `langue` bigint(20) UNSIGNED NOT NULL,
  `type` bigint(20) UNSIGNED NOT NULL,
  `auteur` bigint(20) UNSIGNED NOT NULL,
  `moderateur` bigint(20) UNSIGNED NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `langues`
--

CREATE TABLE `langues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `langues`
--

INSERT INTO `langues` (`id`, `code`, `nom`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Fn', 'Fon', '..', '2025-12-08 21:31:05', '2025-12-08 21:31:05'),
(4, 'KTF', 'Kotafon', NULL, '2025-12-09 01:54:27', '2025-12-09 01:54:27'),
(5, 'Adj', 'Adja', NULL, '2025-12-09 01:54:46', '2025-12-09 01:54:46');

-- --------------------------------------------------------

--
-- Structure de la table `medias`
--

CREATE TABLE `medias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `fichier` varchar(255) NOT NULL,
  `datepub` datetime NOT NULL,
  `contenu` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_11_21_114708_create_roles_table', 1),
(2, '2025_11_21_114537_create_langues_table', 2),
(3, '2025_11_21_114550_create_regions_table', 3),
(4, '0001_01_01_000000_create_users_table', 4),
(5, '2025_11_21_114656_create_typecontenus_table', 5),
(6, '2025_11_21_113422_create_contenus_table', 6),
(7, '2025_11_21_114511_create_commentaires_table', 7),
(8, '2025_11_21_114605_create_medias_table', 8),
(9, '2025_11_21_114637_create_parlers_table', 9),
(10, '0001_01_01_000001_create_cache_table', 10),
(11, '0001_01_01_000002_create_jobs_table', 10),
(12, '2025_08_26_100418_add_two_factor_columns_to_users_table', 10),
(13, '2025_11_22_134847_add_columns_to_langues_table', 11),
(14, '2025_11_22_211101_rename_desciption_to_description_in_langues_table', 12),
(15, '2025_11_22_214800_rename_desciption_to_description_in_regions_table', 13),
(16, '2025_11_30_154324_rename_desciption_to_description_in_medias_table', 13),
(17, '2025_11_30_154605_rename_desciption_to_description_in_medias_table', 13),
(18, '2025_12_04_063928_add_columns_to_users_table', 13),
(19, '2025_12_07_235838_add_column_to_users_table', 13),
(20, '2025_12_08_031102_add_two_factor_columns_to_users_table', 13),
(21, '2025_12_08_075223_create_abonnements_table', 13);

-- --------------------------------------------------------

--
-- Structure de la table `parlers`
--

CREATE TABLE `parlers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `region` bigint(20) UNSIGNED NOT NULL,
  `langue` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `localisation` text DEFAULT NULL,
  `superficie` varchar(255) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id`, `nom`, `description`, `localisation`, `superficie`, `population`, `created_at`, `updated_at`) VALUES
(1, 'Litoral', '..', NULL, NULL, NULL, '2025-12-08 21:33:46', '2025-12-08 21:33:46');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
(1, 'Administrateur', '2025-12-08 21:28:21', '2025-12-08 21:28:21'),
(3, 'Modérateur', '2025-12-08 21:35:44', '2025-12-08 21:35:44'),
(4, 'Contributeur', '2025-12-08 21:35:44', '2025-12-08 21:35:44'),
(5, 'Lecteur', '2025-12-08 21:35:44', '2025-12-08 21:35:44');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('hRXxoOgCO4l3pulEegCSxZyZ6kA2NoADEA4WmCV3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1FWdk9VWGJCYmVTbXBXaTlMYUxNM2kxZTg4d0RiMjFqaDB3UTBYaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765249699);

-- --------------------------------------------------------

--
-- Structure de la table `typecontenus`
--

CREATE TABLE `typecontenus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `statut` varchar(255) NOT NULL,
  `sexe` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `dateins` datetime NOT NULL DEFAULT current_timestamp(),
  `langue` bigint(20) UNSIGNED NOT NULL,
  `region` bigint(20) UNSIGNED NOT NULL,
  `role` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `two_factor_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `google2fa_secret` text DEFAULT NULL,
  `google2fa_enabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `photo`, `statut`, `sexe`, `email`, `tel`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `dateins`, `langue`, `region`, `role`, `remember_token`, `created_at`, `updated_at`, `two_factor_enabled`, `google2fa_secret`, `google2fa_enabled`) VALUES
(1, 'Cakpo', 'Fréjus', 'avatars/69377f5d4a194.png', 'actif', 'Masculin', 'ckpfrejus@gmail.com', NULL, NULL, '$2y$12$2.kqFs7J4q205v.9IoPKP.NYmS5NDHmiNdMABo9K4RfKrz28jxyK6', NULL, NULL, NULL, '2025-12-08 23:38:25', 1, 1, 1, NULL, '2025-12-08 21:38:25', '2025-12-09 00:46:05', 0, NULL, 0),
(6, 'COMLAN', 'Maurice', 'avatars/693784ccc4a5a.svg', 'actif', 'Masculin', 'mauricecomlan@uac.bj', NULL, NULL, '$2y$12$Bqn/n9zp1Ui/tqgoo1TUlOgdoS9LxwA8ddCp3lK1ZF0kNBhq6nn5q', NULL, NULL, NULL, '2025-12-09 03:09:16', 1, 1, 1, NULL, '2025-12-09 01:09:16', '2025-12-09 01:09:16', 0, NULL, 0),
(7, 'Mahinou', 'Fanta', 'avatars/69379040b5cce.svg', 'actif', 'Féminin', 'Faramojaveli@gmail.com', NULL, NULL, '$2y$12$yQP2WPhobPqfY6xbBP7fC.qT2ta4EZoYYiOKvknTkKb5LtK3JNJ0.', NULL, NULL, NULL, '2025-12-09 03:58:08', 5, 1, 4, NULL, '2025-12-09 01:58:08', '2025-12-09 01:58:08', 0, NULL, 0),
(8, 'HD', 'Carlos', 'avatars/6937923693964.svg', 'actif', 'Masculin', 'carloshd@gmail.com', NULL, NULL, '$2y$12$RRErca/3Q2Qdt4D8qmttvO/oT.UveYZ8BXKLThbNd2xGqrq7qOgX2', NULL, NULL, NULL, '2025-12-09 04:06:30', 1, 1, 3, NULL, '2025-12-09 02:06:30', '2025-12-09 02:06:30', 0, NULL, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonnements`
--
ALTER TABLE `abonnements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abonnements_user_foreign` (`user`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentaires_contenu_foreign` (`contenu`),
  ADD KEY `commentaires_utilisateur_foreign` (`utilisateur`);

--
-- Index pour la table `contenus`
--
ALTER TABLE `contenus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contenus_region_foreign` (`region`),
  ADD KEY `contenus_langue_foreign` (`langue`),
  ADD KEY `contenus_type_foreign` (`type`),
  ADD KEY `contenus_auteur_foreign` (`auteur`),
  ADD KEY `contenus_moderateur_foreign` (`moderateur`),
  ADD KEY `contenus_parent_foreign` (`parent`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `langues`
--
ALTER TABLE `langues`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medias_contenu_foreign` (`contenu`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parlers`
--
ALTER TABLE `parlers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parlers_region_foreign` (`region`),
  ADD KEY `parlers_langue_foreign` (`langue`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `typecontenus`
--
ALTER TABLE `typecontenus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_langue_foreign` (`langue`),
  ADD KEY `users_region_foreign` (`region`),
  ADD KEY `users_role_foreign` (`role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonnements`
--
ALTER TABLE `abonnements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contenus`
--
ALTER TABLE `contenus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `langues`
--
ALTER TABLE `langues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `medias`
--
ALTER TABLE `medias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `parlers`
--
ALTER TABLE `parlers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `typecontenus`
--
ALTER TABLE `typecontenus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abonnements`
--
ALTER TABLE `abonnements`
  ADD CONSTRAINT `abonnements_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_contenu_foreign` FOREIGN KEY (`contenu`) REFERENCES `contenus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaires_utilisateur_foreign` FOREIGN KEY (`utilisateur`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `contenus`
--
ALTER TABLE `contenus`
  ADD CONSTRAINT `contenus_auteur_foreign` FOREIGN KEY (`auteur`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contenus_langue_foreign` FOREIGN KEY (`langue`) REFERENCES `langues` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contenus_moderateur_foreign` FOREIGN KEY (`moderateur`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contenus_parent_foreign` FOREIGN KEY (`parent`) REFERENCES `contenus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contenus_region_foreign` FOREIGN KEY (`region`) REFERENCES `regions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contenus_type_foreign` FOREIGN KEY (`type`) REFERENCES `typecontenus` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `medias`
--
ALTER TABLE `medias`
  ADD CONSTRAINT `medias_contenu_foreign` FOREIGN KEY (`contenu`) REFERENCES `contenus` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `parlers`
--
ALTER TABLE `parlers`
  ADD CONSTRAINT `parlers_langue_foreign` FOREIGN KEY (`langue`) REFERENCES `langues` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parlers_region_foreign` FOREIGN KEY (`region`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_langue_foreign` FOREIGN KEY (`langue`) REFERENCES `langues` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_region_foreign` FOREIGN KEY (`region`) REFERENCES `regions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_role_foreign` FOREIGN KEY (`role`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
