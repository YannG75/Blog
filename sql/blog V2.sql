-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 15 avr. 2019 à 02:08
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `published_at` date NOT NULL,
  `summary` text,
  `content` longtext,
  `image` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `published_at`, `summary`, `content`, `image`, `is_published`) VALUES
(1, 'Hellfest 2018, l\'affiche quasi-complète', '2017-01-06', 'Résumé de l\'article Hellfest', '<p>Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. </p>', NULL, 1),
(2, 'Critique « Star Wars 8 – Les derniers Jedi » de Rian Johnson : le renouveau de la saga ?', '2017-01-07', 'Résumé de l\'article Star Wars 8', '<p>Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue.</p>', NULL, 1),
(3, 'Revue - The Ramones', '2017-01-01', 'Résumé de l\'article The Ramones', '<p>Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh.</p>', NULL, 1),
(4, 'De “Skyrim” à “L.A. Noire” ou “Doom” : pourquoi les vieux jeux sont meilleurs sur la Switch', '2017-01-03', 'Résumé de l\'article Switch', '<p>Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.</p>', NULL, 1),
(5, 'Comment “Assassin’s Creed” trouve un nouveau souffle en Egypte', '2017-01-04', 'Résumé de l\'article Assassin’s Creed', '<p>Ut velit mauris, egestas sed, gravida nec, ornare ut, mi. Aenean ut orci vel massa suscipit pulvinar.</p>', NULL, 1),
(6, 'BO de « Les seigneurs de Dogtown » : l’époque bénie du rock.', '2017-01-05', 'Résumé de l\'article Les seigneurs de Dogtown', '<p>Nulla sollicitudin. Fusce varius, ligula non tempus aliquam, nunc turpis ullamcorper nibh, in tempus sapien eros vitae ligula.</p>', NULL, 1),
(7, 'Pourquoi \"Destiny 2\" est un remède à l’ultra-moderne solitude', '2019-04-01', 'Résumé de l\'article Destiny 2', '<p>Pellentesque rhoncus nunc et augue. Integer id felis. Curabitur aliquet pellentesque diam.</p>', NULL, 1),
(8, 'Pourquoi \"Mario + Lapins Crétins : Kingdom Battle\" est le jeu de la rentrée', '2017-01-08', 'Résumé de l\'article Mario + Lapins Crétins', '<p>Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>', NULL, 1),
(9, '« Le Crime de l’Orient Express » : rencontre avec Kenneth Branagh', '2017-01-17', 'Résumé de l\'article Le Crime de l’Orient Express', '<p>Morbi vel erat non mauris convallis vehicula. Nulla et sapien. Integer tortor tellus, aliquam faucibus, convallis id, congue eu, quam. Mauris ullamcorper felis vitae erat.</p>', NULL, 1),
(18, 'Kratos le bogoss', '2019-04-12', 'ATTENTION SPOIL !!! ', 'caca', NULL, 0),
(35, 'Archer', '2019-04-12', 'bg dla night', 'tro cho', '1542833869.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `article_category`
--

DROP TABLE IF EXISTS `article_category`;
CREATE TABLE IF NOT EXISTS `article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article_category`
--

INSERT INTO `article_category` (`id`, `article_id`, `category_id`) VALUES
(1, 1, 47),
(2, 3, 47),
(3, 6, 47),
(4, 2, 9),
(5, 9, 9),
(6, 4, 108),
(7, 5, 108),
(8, 7, 108),
(9, 8, 108),
(27, 18, 9),
(28, 18, 108),
(46, 35, 9),
(47, 35, 108);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(9, 'Cinéma', 'Trailers, infos, sorties...'),
(47, 'Musique', 'Concerts, sorties d\'albums, festivals...'),
(52, 'Théâtre', 'Dates, représentations, avis...'),
(108, 'Jeux vidéos', 'Videos, tests...');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `bio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `lastname`, `firstname`, `email`, `password`, `is_admin`, `bio`) VALUES
(10, 'Admin', 'Admin', 'admin@thebrickbox.net', 'b53759f3ce692de7aff1b5779d3964da', 1, 'Admin du site'),
(11, 'User', 'User', 'user@thebrickbox.net', 'b53759f3ce692de7aff1b5779d3964da', 0, 'Utilisateur du site');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
