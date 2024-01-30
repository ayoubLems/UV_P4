-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 26 jan. 2024 à 17:36
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `UV_P4`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'customer',
  `clé_API` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `clé_API`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$eIUI0tDGqwqqUIJsH2neFeqd9yG.FoqUw/xC7xHGzpzZGtYHibNh6', 'admin', NULL),
(15, 'mhgj', 'jhg@gmail.com', '$2y$10$IXE.FG4gi0ozzMj40gdawendkE5zR6h.9AakGILX.e/3LJaWXJv.2', 'customer', NULL),
(16, 'ayoub', 'ayoub@gmail.com', '$2y$10$eZD1ccZIulV3Qn4BXJA6m.Ln2/9LZnQ.rG7Bhzc8xHnP7Imkjv9Lu', 'customer', NULL),
(14, 'lemsoudi', 'bouzadi@gmail.com', '$2y$10$D/.nDiyjGpAT/AifY2nJ1eUck.N2382A.BcGyZj7Y7SDhO.lkwNS2', 'customer', NULL),
(17, 'ssdfsd', 'test@gmail.com', '$2y$10$j65i3vQfvKtGqwPe4acjOOnDj2xhjriwd5wYw1GSxLXhvMAmQUpKe', 'customer', 'sdfsd'),
(18, 'sdf', 'teeestttt@gmail.com', '$2y$10$0hJEk0vnarwdIEggxizPMe2t0tkeieQbm2gyQqmb02OyyqChwZ7G6', 'customer', 'asdfad657_kjhk^'),
(19, 'ayoub', 'testF@gmail.com', '$2y$10$ipHxd9iqxHtgZ7RvX478Su.i0yAPTZfKWnVCqXIDDs0ye9NSwSOLa', 'customer', 'lasdhflkds080384'),
(20, 'es', 'csdc@fg.com', '$2y$10$IbpXLKjyGJqr06fqz0xEg.aKHZgyWl4FIBuuGbhoCH0O/rwHMNz.O', 'customer', 'lkjlk');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
