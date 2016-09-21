-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 21 Septembre 2016 à 23:40
-- Version du serveur :  5.7.13-0ubuntu0.16.04.2
-- Version de PHP :  7.0.8-0ubuntu0.16.04.2

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
  `cate_title` varchar(255) NOT NULL,
  `cate_slug` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `cate_title`, `cate_slug`, `content`) VALUES
(1, 'cat1', 'cat1', 'je suis la cat1');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`) VALUES
(1, 'page1', 'page1', '&lt;p&gt;debut enhancer 1&lt;/p&gt;\r\n&lt;p&gt;&lt;enhancer class=&quot;noneditable list_categories&quot; data-params=&quot;{&amp;quot;appname&amp;quot;:&amp;quot;catalogue&amp;quot;,&amp;quot;name&amp;quot;:&amp;quot;Liste les cat\\u00e9gories&amp;quot;,&amp;quot;controller&amp;quot;:&amp;quot;categories&amp;quot;,&amp;quot;action&amp;quot;:&amp;quot;categories&amp;quot;}&quot;&gt;Liste les cat&amp;eacute;gories&lt;/enhancer&gt;&lt;/p&gt;\r\n&lt;p&gt;fin enhancer 1&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;debut enhancer 2&lt;/p&gt;\r\n&lt;p&gt;&lt;enhancer class=&quot;noneditable list_products_category&quot; data-params=&quot;{&amp;quot;appname&amp;quot;:&amp;quot;catalogue&amp;quot;,&amp;quot;name&amp;quot;:&amp;quot;Liste les produits d&#039;une cat\\u00e9gorie&amp;quot;,&amp;quot;controller&amp;quot;:&amp;quot;categories&amp;quot;,&amp;quot;action&amp;quot;:&amp;quot;main&amp;quot;}&quot;&gt;Liste les produits d&#039;une cat&amp;eacute;gorie&lt;/enhancer&gt;&lt;/p&gt;\r\n&lt;p&gt;fin enhancer 2&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;'),
(2, 'page2', 'page2', '&lt;p&gt;&lt;enhancer class=&quot;noneditable list_products_category&quot; data-params=&quot;{&amp;quot;appname&amp;quot;:&amp;quot;catalogue&amp;quot;,&amp;quot;name&amp;quot;:&amp;quot;Liste les produits d&#039;une cat\\u00e9gorie&amp;quot;,&amp;quot;controller&amp;quot;:&amp;quot;categories&amp;quot;,&amp;quot;action&amp;quot;:&amp;quot;main&amp;quot;}&quot;&gt;Liste les produits d&#039;une cat&amp;eacute;gorie&lt;/enhancer&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `prod_title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `prod_category_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `prod_title`, `slug`, `content`, `prod_category_id`) VALUES
(1, 'produit1', 'produit1', '&lt;p&gt;sqdsd&lt;/p&gt;', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pages`
--
ALTER TABLE `pages`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
