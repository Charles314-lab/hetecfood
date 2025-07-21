-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 20 juil. 2025 à 16:03
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
-- Base de données : `hetecfood_app`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `github_id` varchar(255) DEFAULT NULL,
  `apple_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `provider` enum('email','facebook','apple','google') DEFAULT 'email',
  `tel` varchar(20) DEFAULT NULL,
  `adr` text DEFAULT NULL,
  `prenom` varchar(50) DEFAULT '',
  `date_inscription` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `boissons`
--

CREATE TABLE `boissons` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `boisson_client`
--

CREATE TABLE `boisson_client` (
  `client_id` int(11) NOT NULL,
  `boisson_id` int(11) NOT NULL,
  `livreur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Entrées'),
(2, 'Plats Principaux'),
(3, 'Desserts'),
(4, 'Boissons'),
(5, 'Menus Spéciaux'),
(6, 'Promotions');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tel` varchar(20) NOT NULL,
  `adr` text NOT NULL,
  `date_inscription` datetime DEFAULT current_timestamp(),
  `pwd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client_plat`
--

CREATE TABLE `client_plat` (
  `client_id` int(11) NOT NULL,
  `plat_id` int(11) NOT NULL,
  `livreur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commandepubs`
--

CREATE TABLE `commandepubs` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `plat_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT 1,
  `tel` varchar(11) DEFAULT NULL,
  `prix_total` decimal(10,2) NOT NULL,
  `statut` enum('en attente','en préparation','en livraison','livrée','annulée') DEFAULT 'en attente',
  `date_commande` datetime DEFAULT current_timestamp(),
  `date_livraison` datetime DEFAULT NULL,
  `adr` varchar(50) NOT NULL,
  `livreur_id` int(11) DEFAULT NULL,
  `vu` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandepubs`
--

INSERT INTO `commandepubs` (`id`, `nom`, `prenom`, `plat_id`, `quantite`, `tel`, `prix_total`, `statut`, `date_commande`, `date_livraison`, `adr`, `livreur_id`, `vu`) VALUES
(13, 'Berthe', 'Mamoun', 10, 3, '76979879', 6000.00, 'en attente', '2025-07-20 01:53:39', NULL, 'Banankabougou', NULL, 0),
(14, 'Kante', 'Adama', 11, 5, '89879870', 10000.00, 'en attente', '2025-07-20 01:54:22', NULL, 'Sokorodji', NULL, 0),
(15, 'moun', 'berthe', 10, 3, '97908779', 6000.00, 'en attente', '2025-07-20 02:13:54', NULL, 'Banankabougou', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `livreur_id` int(11) DEFAULT NULL,
  `plat_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT 1,
  `prix_total` decimal(10,2) NOT NULL,
  `statut` enum('en attente','en préparation','en livraison','livrée','annulée') DEFAULT 'en attente',
  `date_commande` datetime DEFAULT current_timestamp(),
  `date_livraison` datetime DEFAULT NULL,
  `adr_livraison` text NOT NULL,
  `notes` text DEFAULT NULL,
  `vu` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande_plat`
--

CREATE TABLE `commande_plat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commande_id` bigint(20) UNSIGNED NOT NULL,
  `plat_id` bigint(20) UNSIGNED NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT 1,
  `prix_unitaire` decimal(10,2) NOT NULL,
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
-- Structure de la table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `unite_mesure` varchar(20) DEFAULT NULL,
  `stock` decimal(10,2) DEFAULT 0.00,
  `alerte_stock` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ingredient_plat`
--

CREATE TABLE `ingredient_plat` (
  `plat_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `quantite` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Structure de la table `livreurs`
--

CREATE TABLE `livreurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `adr` text NOT NULL,
  `statut` enum('disponible','indisponible','en livraison') DEFAULT 'disponible',
  `date_embauche` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `nom`) VALUES
(1, 'Menu Classique'),
(2, 'Menu Végétarien'),
(3, 'Menu Enfant'),
(4, 'Menu Spécial');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `date_rec` datetime DEFAULT current_timestamp(),
  `status` enum('non-lu','lu') DEFAULT 'non-lu',
  `vu` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscribed_at` datetime DEFAULT current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1,
  `unsubscribe_token` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
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
-- Structure de la table `plats`
--

CREATE TABLE `plats` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `origine` varchar(50) DEFAULT NULL,
  `tps_cuisson` varchar(10) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `image` varchar(20) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `plats`
--

INSERT INTO `plats` (`id`, `nom`, `origine`, `tps_cuisson`, `prix`, `image`, `menu_id`, `categorie_id`, `deleted_at`) VALUES
(10, 'Macaroni', 'Italie', '15min', 2000, NULL, 1, 2, NULL),
(11, 'Spaguetti bolognaise', 'Bologne', '20min', 2000, NULL, 1, 2, NULL),
(12, 'Salade Cesar', 'Italie', '15min', 3000, NULL, 2, 1, NULL),
(13, 'Salade Cesar', 'Italie', '15min', 3000, NULL, 2, 1, '2025-07-20 23:02:57'),
(14, 'Soupe à l\'oignon', 'France', '15 min', 1200, NULL, NULL, 1, NULL),
(15, 'Bruschetta', 'Italie', '5 min', 1000, NULL, NULL, 1, NULL),
(16, 'Spaghetti Bolognese', 'Italie', '20 min', 2500, NULL, NULL, 2, NULL),
(17, 'Poulet rôti', 'France', '45 min', 3000, NULL, NULL, 2, NULL),
(18, 'Steak frites', 'France', '15 min', 3500, NULL, NULL, 2, NULL),
(19, 'Tiramisu', 'Italie', '0 min', 1000, NULL, NULL, 3, NULL),
(20, 'Fondant au chocolat', 'France', '10 min', 1200, NULL, NULL, 3, NULL),
(21, 'Crème brûlée', 'France', '0 min', 1500, NULL, NULL, 3, NULL),
(22, 'Jus d\'orange', '', '0 min', 500, NULL, NULL, 4, NULL),
(23, 'Coca-Cola', '', '0 min', 600, NULL, NULL, 4, NULL),
(24, 'Eau minérale', '', '0 min', 300, NULL, NULL, 4, NULL),
(25, 'Menu du chef', '', '', 5000, NULL, NULL, 5, NULL),
(26, 'Menu dégustation', '', '', 4500, NULL, NULL, 5, NULL),
(27, 'Menu végétarien', '', '', 4000, NULL, NULL, 5, NULL),
(28, 'Plat du jour', '', '', 2000, NULL, NULL, 6, NULL),
(29, 'Menu étudiant', '', '', 1800, NULL, NULL, 6, NULL),
(30, 'Spécial weekend', '', '', 2200, NULL, NULL, 6, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reservation_date` date DEFAULT NULL,
  `reservation_time` time DEFAULT NULL,
  `nb_personnes` int(11) DEFAULT NULL,
  `vu` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `nom`, `email`, `telephone`, `message`, `created_at`, `reservation_date`, `reservation_time`, `nb_personnes`, `vu`) VALUES
(8, 'Sacko', 'sacko@gmail.com', '98687697', 'miuh', '2025-07-20 13:10:59', '2025-04-30', '22:00:00', 2, 0),
(9, 'Mounn', 'moun@gmail.com', '89097070', 'nvhjgh', '2025-07-20 13:11:46', '2025-03-03', '23:00:00', 2, 0);

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
('NElzHRmsiaR55Tk6HwyODePtbt7dZKyBB0Q6rKSC', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOGhMOXFxbVV4alR2eGdQcHNwZWZHa0xEWGVKdHpld05CVDBVS2szZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1753020157);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'fournisseur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(3, 'Mamoun', 'mamounberthe@gmail.com', NULL, '$2y$12$1/0QbzLw8cshOVsn9Aw7I.yMC.yLlDk6mwDhiedu1/Q7jNAk58xju', NULL, '2025-07-18 23:04:58', '2025-07-18 23:04:58', 'fournisseur');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_commandes_en_attente`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_commandes_en_attente` (
`id` int(11)
,`client` varchar(50)
,`plat` varchar(20)
,`quantite` int(11)
,`prix_total` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Structure de la vue `vue_commandes_en_attente`
--
DROP TABLE IF EXISTS `vue_commandes_en_attente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_commandes_en_attente`  AS SELECT `c`.`id` AS `id`, `cl`.`nom` AS `client`, `p`.`nom` AS `plat`, `c`.`quantite` AS `quantite`, `c`.`prix_total` AS `prix_total` FROM ((`commandes` `c` join `clients` `cl` on(`c`.`client_id` = `cl`.`id`)) join `plats` `p` on(`c`.`plat_id` = `p`.`id`)) WHERE `c`.`statut` = 'en attente' ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `boissons`
--
ALTER TABLE `boissons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_boi_menu` (`menu_id`);

--
-- Index pour la table `boisson_client`
--
ALTER TABLE `boisson_client`
  ADD PRIMARY KEY (`client_id`,`boisson_id`,`livreur_id`),
  ADD KEY `fk_bc_boisson` (`boisson_id`),
  ADD KEY `fk_bc_livreur` (`livreur_id`),
  ADD KEY `idx_boisson_client` (`client_id`,`boisson_id`);

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
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_nom` (`nom`),
  ADD KEY `idx_email` (`email`);

--
-- Index pour la table `client_plat`
--
ALTER TABLE `client_plat`
  ADD PRIMARY KEY (`client_id`,`plat_id`,`livreur_id`),
  ADD KEY `fk_cp_plat` (`plat_id`),
  ADD KEY `fk_cp_livreur` (`livreur_id`),
  ADD KEY `idx_client_plat` (`client_id`,`plat_id`);

--
-- Index pour la table `commandepubs`
--
ALTER TABLE `commandepubs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `com_plat` (`plat_id`),
  ADD KEY `livreur_id` (`livreur_id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plat_id` (`plat_id`),
  ADD KEY `idx_client` (`client_id`),
  ADD KEY `idx_livreur` (`livreur_id`),
  ADD KEY `idx_date` (`date_commande`),
  ADD KEY `idx_statut` (`statut`);

--
-- Index pour la table `commande_plat`
--
ALTER TABLE `commande_plat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD KEY `idx_nom` (`nom`);

--
-- Index pour la table `ingredient_plat`
--
ALTER TABLE `ingredient_plat`
  ADD PRIMARY KEY (`plat_id`,`ingredient_id`),
  ADD KEY `ing_plt` (`ingredient_id`),
  ADD KEY `idx_ingredient_plat` (`plat_id`,`ingredient_id`);

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
-- Index pour la table `livreurs`
--
ALTER TABLE `livreurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_nom` (`nom`),
  ADD KEY `idx_statut` (`statut`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `plats`
--
ALTER TABLE `plats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_plt_menu` (`menu_id`),
  ADD KEY `FK_plt_cat` (`categorie_id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `boissons`
--
ALTER TABLE `boissons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `commandepubs`
--
ALTER TABLE `commandepubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `commande_plat`
--
ALTER TABLE `commande_plat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livreurs`
--
ALTER TABLE `livreurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `plats`
--
ALTER TABLE `plats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `boissons`
--
ALTER TABLE `boissons`
  ADD CONSTRAINT `FK_boi_menu` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);

--
-- Contraintes pour la table `boisson_client`
--
ALTER TABLE `boisson_client`
  ADD CONSTRAINT `fk_bc_boisson` FOREIGN KEY (`boisson_id`) REFERENCES `boissons` (`id`),
  ADD CONSTRAINT `fk_bc_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `fk_bc_livreur` FOREIGN KEY (`livreur_id`) REFERENCES `livreurs` (`id`);

--
-- Contraintes pour la table `client_plat`
--
ALTER TABLE `client_plat`
  ADD CONSTRAINT `fk_cp_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `fk_cp_livreur` FOREIGN KEY (`livreur_id`) REFERENCES `livreurs` (`id`),
  ADD CONSTRAINT `fk_cp_plat` FOREIGN KEY (`plat_id`) REFERENCES `plats` (`id`);

--
-- Contraintes pour la table `commandepubs`
--
ALTER TABLE `commandepubs`
  ADD CONSTRAINT `com_plat` FOREIGN KEY (`plat_id`) REFERENCES `plats` (`id`),
  ADD CONSTRAINT `commandepubs_ibfk_1` FOREIGN KEY (`livreur_id`) REFERENCES `livreurs` (`id`);

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`livreur_id`) REFERENCES `livreurs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `commandes_ibfk_3` FOREIGN KEY (`plat_id`) REFERENCES `plats` (`id`),
  ADD CONSTRAINT `fk_commande_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Contraintes pour la table `ingredient_plat`
--
ALTER TABLE `ingredient_plat`
  ADD CONSTRAINT `ing_plt` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plt_ing` FOREIGN KEY (`plat_id`) REFERENCES `plats` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `plats`
--
ALTER TABLE `plats`
  ADD CONSTRAINT `FK_plt_cat` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `FK_plt_menu` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
