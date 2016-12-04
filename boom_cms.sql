-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 04 Décembre 2016 à 18:28
-- Version du serveur :  5.7.16-0ubuntu0.16.04.1
-- Version de PHP :  7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boom_cms`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `content`) VALUES
(1, 'cat1 updated', 'cat1', '<p>je suis la cat1</p>');

-- --------------------------------------------------------

--
-- Structure de la table `form_contact`
--

CREATE TABLE `form_contact` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `autre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `form_contact`
--

INSERT INTO `form_contact` (`id`, `email`, `autre`) VALUES
(1, 'destvincent@hotmail.fr', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `main_config`
--

CREATE TABLE `main_config` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `menu` int(11) NOT NULL DEFAULT '1',
  `logo` varchar(255) DEFAULT NULL,
  `image_header` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `main_config`
--

INSERT INTO `main_config` (`id`, `title`, `menu`, `logo`, `image_header`) VALUES
(1, 'Kim tan', 1, '/Static/img/cms/admin/update/MainConfig/1/logo.png', '/Static/img/cms/admin/update/MainConfig/1/image_header.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `map`
--

CREATE TABLE `map` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `longitude` double(11,6) NOT NULL,
  `latitude` double(11,6) NOT NULL,
  `text` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `map`
--

INSERT INTO `map` (`id`, `title`, `longitude`, `latitude`, `text`) VALUES
(1, 'Kim tan', 45.766067, 4.843673, '<p>BANANALUL MOGOYO</p>');

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `menus`
--

INSERT INTO `menus` (`id`, `title`) VALUES
(1, 'menu principale');

-- --------------------------------------------------------

--
-- Structure de la table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `display_order` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `arg` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='`id`, `name`, `parent_id`, `display_order`';

--
-- Contenu de la table `menu_items`
--

INSERT INTO `menu_items` (`id`, `parent_id`, `display_order`, `menu_id`, `title`, `arg`, `type`) VALUES
(21, NULL, 0, 1, 'Accueil', '5', 'pages'),
(22, NULL, 1, 1, 'Maison traditionnelle & contemporaine', '6', 'pages'),
(23, NULL, 2, 1, 'Maison bois', '7', 'pages'),
(24, NULL, 4, 1, 'Nos services', '8', 'pages'),
(25, NULL, 5, 1, 'Contact', '9', 'pages'),
(26, NULL, 3, 1, 'Rénovation', '10', 'pages');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content_gauche` text,
  `image_gauche` varchar(255) DEFAULT NULL,
  `layout` varchar(255) NOT NULL DEFAULT 'default',
  `content_droit` text,
  `image_droit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content_gauche`, `image_gauche`, `layout`, `content_droit`, `image_droit`) VALUES
(5, 'Accueil', 'accueil', '<p>TRUC CHOSE</p>', '/Static/img/cms/admin/update/Pages/Pages/5/image_gauche.jpg', 'homepage', '<p>autre content</p>', '/Static/img/cms/admin/update/Pages/Pages/5/image_droit.jpg'),
(6, 'Maison traditionnelle & contemporaine', 'maison-traditionnelle-contemporaine', '<p>Nous vous accompagnons et r&eacute;alision votre projet de construction de maison traditionnelle et/ou contemporaine.</p>\r\n<p>&nbsp;</p>\r\n<p>Nous accordons une attention particuli&egrave;re &agrave; l\'int&eacute;gration de votre projet aux contraintes de site (exposition, pente, optimisation du terrain...)</p>', '/Static/img/cms/admin/update/Pages/Pages/6/image_gauche.jpg', 'default', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis gravida libero sem, nec dictum lorem cursus quis. Aliquam augue elit, auctor a felis quis, commodo aliquam orci. In mollis diam libero, at placerat eros bibendum ut. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis sed egestas lorem. Curabitur facilisis justo sit amet nulla euismod, tempus gravida magna consequat. Vestibulum mattis lectus a mauris pulvinar, aliquet porttitor dui condimentum. Donec pretium ipsum massa, in facilisis lectus lobortis vitae. Fusce nec eros tincidunt, egestas est sit amet, tincidunt dui. Aenean sed ex lobortis, sollicitudin est ac, feugiat risus.</p>', '/Static/img/cms/admin/update/Pages/Pages/6/image_droit.jpg'),
(7, 'Maison bois', 'maison-bois', '<p>Tan Ma&icirc;trise d\'oeuvre vous propose de r&eacute;aliser votre projet de maison ossature bois.</p>\r\n<p>Pour cela, nous travaillons en partenariat avec Olivier Juredieu, architecte DPLG, qui est expert en la mati&egrave;re et &agrave; la recherche de produits et solutions innovantes afin de vous proposer une maison globalement efficiente.</p>', '/Static/img/cms/admin/update/Pages/Pages/7/image_gauche.jpg', 'default', '', '/Static/img/cms/admin/update/Pages/Pages/7/image_droit.jpg'),
(8, 'Nos services', 'nos-services', '<p>Nous vous accompagnons aux travers de plusieurs missions :</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Mission globale (conception et r&eacute;alisation)</li>\r\n<li>Etude avant projet</li>\r\n<li>Permis de construire</li>\r\n<li>Consultation des entreprises</li>\r\n<li>Ex&eacute;cution des travaux</li>\r\n<li>Mission d\'ex&eacute;cution</li>\r\n<li>Consultation des entreprises</li>\r\n<li>Consultation des entreprises</li>\r\n</ul>', NULL, 'default', '', '/Static/img/cms/admin/update/Pages/Pages/8/image_droit.jpg'),
(9, 'Contact', 'contact', '<p><enhancer class="noneditable form_contact" data-params="{\'appname\':\'FormContact\',\'name\':\'Formulaire de contact\',\'controller\':\'FormContact\',\'action\':\'main\'}">Formulaire de contact</enhancer></p>', NULL, 'default', '<p><enhancer class="noneditable map" data-params="{\'appname\':\'Map\',\'name\':\'Google Map\',\'controller\':\'Map\',\'action\':\'main\'}">Google Map</enhancer></p>', ''),
(10, 'Rénovation', 'renovation', '<p>Vous souhaitez r&eacute;nover une maison, un appartement ou encore un vieux corps de ferme, TAN Ma&icirc;trise dOeuvre vous conseille et vous accompagne dans la r&eacute;alisatio de votre projet.</p>\r\n<p>&nbsp;</p>\r\n<p>Ainsi notre objectif est de vous permettre de valoriser votre bien tout en respectant votre enveloppe budg&eacute;taire.</p>', '/Static/img/cms/admin/update/Pages/Pages/10/image_gauche.jpg', 'default', '', '/Static/img/cms/admin/update/Pages/Pages/10/image_droit.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `content` text,
  `category_id` int(1) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `content`, `category_id`, `reference`) VALUES
(1, 'produit1 updated', 'produit1', '<p>sqdsd</p>', 1, NULL),
(2, 'test', '', '&lt;p&gt;test&lt;/p&gt;', 0, NULL),
(3, 'Nouveau produit', '', '<p>blabablabla</p>', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `login` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `login`, `password`, `token`) VALUES
(1, 'admin', 'admin', 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', '4eae373e342dc8d487e98aa95931969c10ee2d4c'),
(2, 'Kim', 'Tan', 'kimtan', 'a346bc80408d9b2a5063fd1bddb20e2d5586ec30', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `form_contact`
--
ALTER TABLE `form_contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `main_config`
--
ALTER TABLE `main_config`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `form_contact`
--
ALTER TABLE `form_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `main_config`
--
ALTER TABLE `main_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `map`
--
ALTER TABLE `map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
