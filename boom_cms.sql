# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Hôte: 127.0.0.1 (MySQL 5.5.42)
# Base de données: boom_cms
# Temps de génération: 2016-09-23 11:36:29 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_title` varchar(255) NOT NULL,
  `cate_slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `cate_title`, `cate_slug`, `content`)
VALUES
	(1,'cat1','cat1','je suis la cat1');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;

INSERT INTO `pages` (`id`, `title`, `slug`, `content`)
VALUES
	(1,'page1','page1','&lt;p&gt;debut enhancer 1&lt;/p&gt;\r\n&lt;p&gt;&lt;enhancer class=&quot;noneditable list_categories&quot; data-params=&quot;{&amp;quot;appname&amp;quot;:&amp;quot;catalogue&amp;quot;,&amp;quot;name&amp;quot;:&amp;quot;Liste les cat\\u00e9gories&amp;quot;,&amp;quot;controller&amp;quot;:&amp;quot;categories&amp;quot;,&amp;quot;action&amp;quot;:&amp;quot;categories&amp;quot;}&quot;&gt;Liste les cat&amp;eacute;gories&lt;/enhancer&gt;&lt;/p&gt;\r\n&lt;p&gt;fin enhancer 1&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;debut enhancer 2&lt;/p&gt;\r\n&lt;p&gt;&lt;enhancer class=&quot;noneditable list_products_category&quot; data-params=&quot;{&amp;quot;appname&amp;quot;:&amp;quot;catalogue&amp;quot;,&amp;quot;name&amp;quot;:&amp;quot;Liste les produits d&#039;une cat\\u00e9gorie&amp;quot;,&amp;quot;controller&amp;quot;:&amp;quot;categories&amp;quot;,&amp;quot;action&amp;quot;:&amp;quot;main&amp;quot;}&quot;&gt;Liste les produits d&#039;une cat&amp;eacute;gorie&lt;/enhancer&gt;&lt;/p&gt;\r\n&lt;p&gt;fin enhancer 2&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;'),
	(2,'page2','page2','&lt;p&gt;&lt;enhancer class=&quot;noneditable list_products_category&quot; data-params=&quot;{&amp;quot;appname&amp;quot;:&amp;quot;catalogue&amp;quot;,&amp;quot;name&amp;quot;:&amp;quot;Liste les produits d&#039;une cat\\u00e9gorie&amp;quot;,&amp;quot;controller&amp;quot;:&amp;quot;categories&amp;quot;,&amp;quot;action&amp;quot;:&amp;quot;main&amp;quot;}&quot;&gt;Liste les produits d&#039;une cat&amp;eacute;gorie&lt;/enhancer&gt;&lt;/p&gt;');

/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `prod_category_id` int(1) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `prod_title`, `slug`, `content`, `prod_category_id`)
VALUES
	(1,'produit1','produit1','&lt;p&gt;sqdsd&lt;/p&gt;',1);

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `login` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `login`, `password`, `token`)
VALUES
	(1,'admin','admin','admin','90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad','0617c750ecb985b048b8b3b2dd9c42520faab6e4');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
