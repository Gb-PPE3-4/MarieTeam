-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 04 Juin 2016 à 15:04
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `marieteam_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `bateau`
--

CREATE TABLE IF NOT EXISTS `bateau` (
  `idbateau` int(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `longueurBat` float NOT NULL,
  `largeurBat` float NOT NULL,
  `heritage` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idbateau`),
  UNIQUE KEY `idbateau` (`idbateau`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `bateau`
--

INSERT INTO `bateau` (`idbateau`, `nom`, `longueurBat`, `largeurBat`, `heritage`) VALUES
(1, 'Kor''Ant', 10, 5, 0),
(2, 'Ar Solen', 20, 10, 0),
(3, 'Al''xi', 10, 5, 0),
(4, 'Luce isle', 37.2, 8.6, 0),
(5, 'Maëllys', 23, 11.5, 0),
(6, 'Pippo', 12.5, 6.125, 1),
(10, 'BateauDuo', 5, 5, 0),
(12, 'Costa Concordia', 290, 8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `bfret`
--

CREATE TABLE IF NOT EXISTS `bfret` (
  `idbateau` int(20) NOT NULL,
  `poidsMaxBatFret` double NOT NULL,
  PRIMARY KEY (`idbateau`),
  KEY `batHeritageFret` (`idbateau`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bfret`
--

INSERT INTO `bfret` (`idbateau`, `poidsMaxBatFret`) VALUES
(6, 52432),
(12, 0);

-- --------------------------------------------------------

--
-- Structure de la table `bvoyageur`
--

CREATE TABLE IF NOT EXISTS `bvoyageur` (
  `idbateau` int(20) NOT NULL,
  `imageBatVoyageur` varchar(50) DEFAULT NULL,
  `vitesseBatVoy` float NOT NULL,
  PRIMARY KEY (`idbateau`),
  KEY `batHeritageVoy` (`idbateau`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bvoyageur`
--

INSERT INTO `bvoyageur` (`idbateau`, `imageBatVoyageur`, `vitesseBatVoy`) VALUES
(1, 'Kor_Ant.jpg', 134),
(2, 'Ar_Solen.jpg', 130),
(3, 'Al_xi.jpg', 29),
(4, 'Luce_isle.jpeg', 26),
(5, 'Maellys.jpg', 2),
(10, 'bateau-bbq.jpg', 2);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `lettre` varchar(1) NOT NULL,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`lettre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`lettre`, `nom`) VALUES
('A', 'Passager'),
('B', 'Véhicule inférieur à 2m'),
('C', 'Véhicule supérieur à 2m');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE IF NOT EXISTS `contenir` (
  `lettre` varchar(1) NOT NULL,
  `idbateau` int(20) NOT NULL,
  `capaciteMax` int(11) NOT NULL,
  PRIMARY KEY (`lettre`,`idbateau`),
  KEY `contenir_periode_fkey` (`idbateau`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contenir`
--

INSERT INTO `contenir` (`lettre`, `idbateau`, `capaciteMax`) VALUES
('A', 1, 238),
('A', 2, 276),
('A', 3, 238),
('A', 4, 276),
('A', 5, 250),
('B', 1, 119),
('B', 2, 138),
('B', 3, 119),
('B', 4, 138),
('B', 5, 119),
('C', 1, 59),
('C', 2, 69),
('C', 3, 59),
('C', 4, 59),
('C', 5, 69);

-- --------------------------------------------------------

--
-- Structure de la table `enregistrer`
--

CREATE TABLE IF NOT EXISTS `enregistrer` (
  `lettre` varchar(1) NOT NULL,
  `num` int(11) NOT NULL,
  `idreservation` int(11) NOT NULL,
  `quantite` int(11) DEFAULT '0',
  PRIMARY KEY (`lettre`,`num`,`idreservation`),
  KEY `enregistrer_reservation_fkey` (`idreservation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `enregistrer`
--

INSERT INTO `enregistrer` (`lettre`, `num`, `idreservation`, `quantite`) VALUES
('A', 1, 1, 2),
('A', 1, 8, 1),
('A', 1, 12, 0),
('A', 1, 13, 1),
('A', 1, 14, 2),
('A', 1, 20, 2),
('A', 1, 22, 5),
('A', 1, 23, 1),
('A', 1, 24, 5),
('A', 1, 25, 3),
('A', 1, 26, 1),
('A', 1, 27, 6),
('A', 1, 29, 1),
('A', 2, 1, 1),
('A', 2, 8, 2),
('A', 2, 12, 1),
('A', 2, 13, 0),
('A', 2, 14, 0),
('A', 2, 20, 0),
('A', 2, 22, 0),
('A', 2, 23, 3),
('A', 2, 24, 0),
('A', 2, 25, 0),
('A', 2, 26, 0),
('A', 2, 27, 0),
('A', 2, 29, 0),
('A', 3, 1, 2),
('A', 3, 8, 3),
('A', 3, 12, 0),
('A', 3, 13, 0),
('A', 3, 14, 0),
('A', 3, 20, 0),
('A', 3, 22, 0),
('A', 3, 23, 0),
('A', 3, 24, 0),
('A', 3, 25, 0),
('A', 3, 26, 0),
('A', 3, 27, 0),
('A', 3, 29, 0),
('B', 1, 1, 0),
('B', 1, 8, 2),
('B', 1, 12, 0),
('B', 1, 13, 0),
('B', 1, 14, 0),
('B', 1, 20, 0),
('B', 1, 22, 0),
('B', 1, 23, 0),
('B', 1, 24, 0),
('B', 1, 25, 0),
('B', 1, 26, 0),
('B', 1, 27, 0),
('B', 1, 29, 0),
('B', 2, 1, 1),
('B', 2, 8, 4),
('B', 2, 12, 0),
('B', 2, 13, 0),
('B', 2, 14, 0),
('B', 2, 20, 0),
('B', 2, 22, 0),
('B', 2, 23, 0),
('B', 2, 24, 0),
('B', 2, 25, 0),
('B', 2, 26, 0),
('B', 2, 27, 0),
('B', 2, 29, 0),
('C', 1, 1, 0),
('C', 1, 8, 3),
('C', 1, 12, 0),
('C', 1, 13, 0),
('C', 1, 14, 0),
('C', 1, 20, 0),
('C', 1, 22, 0),
('C', 1, 23, 0),
('C', 1, 24, 0),
('C', 1, 25, 0),
('C', 1, 26, 0),
('C', 1, 27, 0),
('C', 1, 29, 0),
('C', 2, 1, 0),
('C', 2, 8, 6),
('C', 2, 12, 0),
('C', 2, 13, 0),
('C', 2, 14, 0),
('C', 2, 20, 0),
('C', 2, 22, 0),
('C', 2, 23, 0),
('C', 2, 24, 0),
('C', 2, 25, 0),
('C', 2, 26, 0),
('C', 2, 27, 0),
('C', 2, 29, 0),
('C', 3, 1, 0),
('C', 3, 8, 9),
('C', 3, 12, 0),
('C', 3, 13, 0),
('C', 3, 14, 0),
('C', 3, 20, 0),
('C', 3, 22, 0),
('C', 3, 23, 0),
('C', 3, 24, 0),
('C', 3, 25, 0),
('C', 3, 26, 0),
('C', 3, 27, 0),
('C', 3, 29, 0);

--
-- Déclencheurs `enregistrer`
--
DROP TRIGGER IF EXISTS `VerifPlaces`;
DELIMITER //
CREATE TRIGGER `VerifPlaces` BEFORE INSERT ON `enregistrer`
 FOR EACH ROW BEGIN
	DECLARE places INT (4) ;
	DECLARE total INT(4) ;
    DECLARE msg VARCHAR(100) ;
    
	SELECT C.capaciteMax INTO places
	FROM contenir  AS C, reservation AS R, traversee AS T
	WHERE C.idbateau=T.idbateau
	AND T.num=R.idtraversee
    AND C.lettre=NEW.lettre 
	AND R.idreservation=NEW.idreservation ;
		
	SELECT SUM(E.quantite) INTO total 
	FROM enregistrer AS E, reservation AS R
	WHERE E.lettre=NEW.lettre
    AND E.idreservation=R.idreservation
	AND R.idtraversee=(
			SELECT idtraversee 
			FROM reservation 
			WHERE idreservation = NEW.idreservation);
						
	IF ((places - total - NEW.quantite) < 0) THEN 
    	DELETE FROM reservation
        WHERE idreservation=NEW.idreservation ;
        
		set msg = "DIE: You broke the rules... I will now Smite you, hold still...";
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
    END IF ;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE IF NOT EXISTS `equipement` (
  `idequip` int(20) NOT NULL AUTO_INCREMENT,
  `libequip` varchar(50) NOT NULL,
  PRIMARY KEY (`idequip`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `equipement`
--

INSERT INTO `equipement` (`idequip`, `libequip`) VALUES
(1, 'Accès Handicapé'),
(2, 'Bar'),
(3, 'Pont Promenade'),
(4, 'Salon Vidéo'),
(5, 'Piscine'),
(6, 'Salle de spéctacle'),
(8, 'Barbecue'),
(9, 'Gilets de sauvetage'),
(10, 'Pagaie');

-- --------------------------------------------------------

--
-- Structure de la table `equiper`
--

CREATE TABLE IF NOT EXISTS `equiper` (
  `idbateau` int(20) NOT NULL,
  `idequip` int(20) NOT NULL,
  KEY `equipBateau` (`idbateau`),
  KEY `equipEquip` (`idequip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `equiper`
--

INSERT INTO `equiper` (`idbateau`, `idequip`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(2, 6),
(3, 4),
(3, 5),
(5, 2),
(4, 1),
(4, 5),
(10, 2),
(10, 3),
(10, 6),
(10, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Structure de la table `liaison`
--

CREATE TABLE IF NOT EXISTS `liaison` (
  `code` int(20) NOT NULL,
  `idsecteur` int(20) NOT NULL,
  `idportdepart` int(20) NOT NULL,
  `idportarrivee` int(20) NOT NULL,
  `distance` double NOT NULL,
  PRIMARY KEY (`code`),
  UNIQUE KEY `code` (`code`),
  KEY `port_depart_fkey` (`idportdepart`),
  KEY `port_arrivee_fkey` (`idportarrivee`),
  KEY `liaison_secteur_fkey` (`idsecteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `liaison`
--

INSERT INTO `liaison` (`code`, `idsecteur`, `idportdepart`, `idportarrivee`, `distance`) VALUES
(11, 3, 2, 4, 21.1),
(15, 3, 1, 2, 8.3),
(16, 3, 1, 3, 8),
(17, 3, 3, 1, 7.9),
(19, 3, 4, 2, 23.7),
(21, 6, 6, 7, 7.7),
(22, 6, 7, 6, 7.4),
(24, 3, 2, 1, 9),
(25, 5, 1, 5, 8.8),
(30, 5, 5, 1, 8.8),
(31, 8, 1, 8, 17.4),
(32, 8, 8, 1, 9.3);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(100) DEFAULT 'mdp',
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `droit` int(11) NOT NULL DEFAULT '0',
  `dateInsc` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `login`, `mdp`, `nom`, `prenom`, `mail`, `droit`, `dateInsc`) VALUES
(1, 'ppe', '$2y$10$LMwus28X.bQ5l7ggUaSYP.F/AfJabgasfLYvlwotppCD4aw6eUvGW', 'Vandesompele', 'Pierre', 'blabla@tak.com', 1, '2016-01-16 17:32:03'),
(2, 'ppe2', '$2y$10$AIqIKaWAd44UtUTiQhh8yeJpqxb6viDSl4wfs0Ptpt29sOifYhBLW', 'Polowczak', 'Raphael', 'blabla2@tak.com', 0, '2016-01-16 17:32:03'),
(5, 'ppe3', '$2y$10$iGdVKWC9yTvX9nGTWJhsEewWs1h92q5v5zGXuhl.tPdnMONBsEASS', 'Faure', 'Robin', 'dfsd@df.com', 0, '2016-06-03 18:41:10'),
(6, 'DMarie', '$2y$10$5dAW.wyOfzC065Q3Fekh8elFsJwxCa.9uGa2x28WslH6ZBYWFXEBu', 'Dupont', 'Marie', 'd.marie@gmail.com', 1, '2016-06-03 18:41:36');

-- --------------------------------------------------------

--
-- Structure de la table `modifications`
--

CREATE TABLE IF NOT EXISTS `modifications` (
  `idmodif` int(20) NOT NULL AUTO_INCREMENT,
  `iduser` int(20) NOT NULL,
  `nom_prenom` varchar(70) DEFAULT NULL,
  `table_modifiee` varchar(30) NOT NULL,
  `action` varchar(30) NOT NULL,
  `donnees` text,
  `date_modif` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idmodif`),
  KEY `iduser` (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=128 ;

--
-- Contenu de la table `modifications`
--

INSERT INTO `modifications` (`idmodif`, `iduser`, `nom_prenom`, `table_modifiee`, `action`, `donnees`, `date_modif`) VALUES
(25, 1, 'Vandesompele Pierre', 'secteur', 'MODIFICATION', '{"idsecteur":"17","nom":"dfgdg"}', '2016-06-03 16:10:34'),
(26, 1, 'Vandesompele Pierre', 'membre', 'MODIFICATION', '{"id":"1","login":"ppe","nom":"Vandesompele","prenom":"Pierre","mail":"blabla@tak.com","droit":"1"}', '2016-06-03 16:17:28'),
(27, 1, 'Vandesompele Pierre', 'port', 'AJOUT', '{"nom":"sdf"}', '2016-06-03 16:17:39'),
(28, 1, 'Vandesompele Pierre', 'secteur', 'SUPPRESSION', '{"ID":"17","TABLE":"secteur","CHAMPS_ID":"idsecteur"}', '2016-06-03 16:17:44'),
(29, 1, 'Vandesompele Pierre', 'port', 'SUPPRESSION', '{"ID":"26","TABLE":"port","CHAMPS_ID":"idport"}', '2016-06-03 16:17:48'),
(30, 1, 'Vandesompele Pierre', 'secteur', 'SUPPRESSION', '{"ID":"15","TABLE":"secteur","CHAMPS_ID":"idsecteur"}', '2016-06-03 16:18:04'),
(31, 1, 'Vandesompele Pierre', 'secteur', 'AJOUT', '{"nom":"rg"}', '2016-06-03 16:42:14'),
(32, 1, 'Vandesompele Pierre', 'secteur', 'SUPPRESSION', '{"ID":"18","TABLE":"secteur","CHAMPS_ID":"idsecteur"}', '2016-06-03 16:46:30'),
(33, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","img":"C:\\\\fakepath\\\\Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:04:04'),
(34, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","img":"C:\\\\fakepath\\\\Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:04:04'),
(35, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","img":"C:\\\\fakepath\\\\Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:04:08'),
(36, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","img":"C:\\\\fakepath\\\\Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:04:08'),
(37, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","img":"C:\\\\fakepath\\\\Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:05:19'),
(38, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","img":"C:\\\\fakepath\\\\Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:05:19'),
(39, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","img":"C:\\\\fakepath\\\\Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:10:18'),
(40, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","img":"C:\\\\fakepath\\\\Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:10:18'),
(41, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","img":"C:\\\\fakepath\\\\Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:11:46'),
(42, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","img":"C:\\\\fakepath\\\\Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:11:47'),
(43, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","img":"C:\\\\fakepath\\\\Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:12:18'),
(44, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","img":"C:\\\\fakepath\\\\Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:12:18'),
(45, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","img":"C:\\\\fakepath\\\\Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:33:51'),
(46, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","img":"C:\\\\fakepath\\\\Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:33:52'),
(47, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:35:11'),
(48, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:35:11'),
(49, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:35:54'),
(50, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:35:54'),
(51, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:37:05'),
(52, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:37:05'),
(53, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:37:27'),
(54, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:37:27'),
(55, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:37:46'),
(56, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:37:46'),
(57, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:39:03'),
(58, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:39:03'),
(59, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:39:15'),
(60, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:39:15'),
(61, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:40:33'),
(62, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:40:33'),
(63, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:42:21'),
(64, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:42:21'),
(65, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:44:06'),
(66, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:44:06'),
(67, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:45:04'),
(68, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:45:04'),
(69, 1, 'Vandesompele Pierre', 'bateau', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:46:28'),
(70, 1, 'Vandesompele Pierre', 'bvoyageur', 'MODIFICATION', '{"idbateau":"1","nom":"Kor''Ant","longueur":"10","largeur":"5","heritage":"0","img_name":"Kor_Ant.jpg","vitesse":"134"}', '2016-06-03 17:46:28'),
(71, 1, 'Vandesompele Pierre', 'bateau', 'AJOUT', '{"nom":"BateauDuo","longueur":"5","largeur":"5","heritage":"0","img_name":"bateau-bbq.jpg","vitesse":"2"}', '2016-06-03 18:15:45'),
(72, 1, 'Vandesompele Pierre', 'bvoyageur', 'AJOUT', '{"nom":"BateauDuo","longueur":"5","largeur":"5","heritage":"0","img_name":"bateau-bbq.jpg","vitesse":"2"}', '2016-06-03 18:15:45'),
(73, 1, 'Vandesompele Pierre', 'bateau', 'AJOUT', '{"nom":"BateauDuo","longueur":"5","largeur":"5","heritage":"0","img_name":"bateau-bbq.jpg","vitesse":"2"}', '2016-06-03 18:15:55'),
(74, 1, 'Vandesompele Pierre', 'bvoyageur', 'AJOUT', '{"nom":"BateauDuo","longueur":"5","largeur":"5","heritage":"0","img_name":"bateau-bbq.jpg","vitesse":"2"}', '2016-06-03 18:15:55'),
(75, 1, 'Vandesompele Pierre', 'bateau', 'AJOUT', '{"nom":"BateauDuo","longueur":"5","largeur":"5","heritage":"0","img_name":"bateau-bbq.jpg","vitesse":"2"}', '2016-06-03 18:16:32'),
(76, 1, 'Vandesompele Pierre', 'bvoyageur', 'AJOUT', '{"nom":"BateauDuo","longueur":"5","largeur":"5","heritage":"0","img_name":"bateau-bbq.jpg","vitesse":"2"}', '2016-06-03 18:16:32'),
(77, 1, 'Vandesompele Pierre', 'equiper', 'MODIFICATION', '{"idbateau":"10","idequip":"2*3*6"}', '2016-06-03 18:18:14'),
(78, 1, 'Vandesompele Pierre', 'equiper', 'SUPPRESSION', '{"ID":"10","TABLE":"equiper","CHAMPS_ID":"idbateau"}', '2016-06-03 18:18:14'),
(79, 1, 'Vandesompele Pierre', 'bateau', 'AJOUT', '{"nom":"fdgd","longueur":"2","largeur":"15","heritage":"0","img_name":"","vitesse":"1"}', '2016-06-03 18:25:27'),
(80, 1, 'Vandesompele Pierre', 'bvoyageur', 'AJOUT', '{"nom":"fdgd","longueur":"2","largeur":"15","heritage":"0","img_name":"","vitesse":"1"}', '2016-06-03 18:25:27'),
(81, 1, 'Vandesompele Pierre', 'equiper', 'MODIFICATION', '{"idbateau":"11","idequip":"2"}', '2016-06-03 18:25:47'),
(82, 1, 'Vandesompele Pierre', 'equiper', 'SUPPRESSION', '{"ID":"11","TABLE":"equiper","CHAMPS_ID":"idbateau"}', '2016-06-03 18:25:47'),
(83, 1, 'Vandesompele Pierre', 'equiper', 'MODIFICATION', '{"idbateau":"11","idequip":"2*4"}', '2016-06-03 18:25:50'),
(84, 1, 'Vandesompele Pierre', 'equiper', 'SUPPRESSION', '{"ID":"11","TABLE":"equiper","CHAMPS_ID":"idbateau"}', '2016-06-03 18:25:50'),
(85, 1, 'Vandesompele Pierre', 'equiper', 'SUPPRESSION', '{"ID":"11","TABLE":"equiper","CHAMPS_ID":"idbateau"}', '2016-06-03 18:26:04'),
(86, 1, 'Vandesompele Pierre', 'bvoyageur', 'SUPPRESSION', '{"ID":"11","TABLE":"bvoyageur","CHAMPS_ID":"idbateau"}', '2016-06-03 18:26:04'),
(87, 1, 'Vandesompele Pierre', 'bateau', 'SUPPRESSION', '{"ID":"11","TABLE":"bateau","CHAMPS_ID":"idbateau"}', '2016-06-03 18:26:04'),
(88, 1, 'Vandesompele Pierre', 'membre', 'MODIFICATION', '{"id":"2","login":"ppe2","nom":"Polowczak","prenom":"Raphael","mail":"blabla2@tak.com","droit":"0"}', '2016-06-03 18:34:14'),
(89, 1, 'Vandesompele Pierre', 'membre', 'AJOUT', '{"login":"ppe3","nom":"Faure","prenom":"Robin","mail":"dnsdnhv@sdf.com","droit":"0"}', '2016-06-03 18:34:59'),
(90, 1, 'Vandesompele Pierre', 'membre', 'AJOUT', '{"login":"DMarie","nom":"Dupont","prenom":"Marie","mail":"d.marie@gmail.com","droit":"1"}', '2016-06-03 18:35:27'),
(91, 1, 'Vandesompele Pierre', 'membre', 'AJOUT', '{"login":"ppe3","nom":"Faure","prenom":"Robin","mail":"dfsd@df.com","droit":"0"}', '2016-06-03 18:41:10'),
(92, 1, 'Vandesompele Pierre', 'membre', 'AJOUT', '{"login":"DMarie","nom":"Dupont","prenom":"Marie","mail":"d.marie@gmail.com","droit":"1"}', '2016-06-03 18:41:36'),
(93, 1, 'Vandesompele Pierre', 'tarifer', 'AJOUT', '{"idliaison":"11","idperiode":"4","A-1":"2","A-2":"123","A-3":"45","B-1":"45","B-2":"245","C-1":"453","C-2":"254","C-3":"453545"}', '2016-06-03 20:12:19'),
(94, 1, 'Vandesompele Pierre', 'tarifer', 'AJOUT', '{"idliaison":"15","idperiode":"4","A-1":"2","A-2":"123","A-3":"45","B-1":"45","B-2":"245","C-1":"453","C-2":"254","C-3":"453545"}', '2016-06-03 20:12:30'),
(95, 1, 'Vandesompele Pierre', 'tarifer', 'AJOUT', '{"idliaison":"16","idperiode":"4","A-1":"2","A-2":"123","A-3":"45","B-1":"45","B-2":"245","C-1":"453","C-2":"254","C-3":"453545"}', '2016-06-03 20:12:33'),
(96, 1, 'Vandesompele Pierre', 'tarifer', 'AJOUT', '{"idliaison":"17","idperiode":"4","A-1":"2","A-2":"123","A-3":"45","B-1":"45","B-2":"245","C-1":"453","C-2":"254","C-3":"453545"}', '2016-06-03 20:12:38'),
(97, 1, 'Vandesompele Pierre', 'tarifer', 'AJOUT', '{"idliaison":"19","idperiode":"4","A-1":"2","A-2":"123","A-3":"45","B-1":"45","B-2":"245","C-1":"453","C-2":"254","C-3":"453545"}', '2016-06-03 20:12:43'),
(98, 1, 'Vandesompele Pierre', 'tarifer', 'AJOUT', '{"idliaison":"21","idperiode":"4","A-1":"2","A-2":"123","A-3":"45","B-1":"45","B-2":"245","C-1":"453","C-2":"254","C-3":"453545"}', '2016-06-03 20:12:47'),
(99, 1, 'Vandesompele Pierre', 'tarifer', 'AJOUT', '{"idliaison":"22","idperiode":"4","A-1":"2","A-2":"123","A-3":"45","B-1":"45","B-2":"245","C-1":"453","C-2":"254","C-3":"453545"}', '2016-06-03 20:12:50'),
(100, 1, 'Vandesompele Pierre', 'tarifer', 'AJOUT', '{"idliaison":"24","idperiode":"4","A-1":"2","A-2":"123","A-3":"45","B-1":"45","B-2":"245","C-1":"453","C-2":"254","C-3":"453545"}', '2016-06-03 20:12:54'),
(101, 1, 'Vandesompele Pierre', 'tarifer', 'AJOUT', '{"idliaison":"25","idperiode":"4","A-1":"2","A-2":"123","A-3":"45","B-1":"45","B-2":"245","C-1":"453","C-2":"254","C-3":"453545"}', '2016-06-03 20:12:59'),
(102, 1, 'Vandesompele Pierre', 'tarifer', 'AJOUT', '{"idliaison":"30","idperiode":"4","A-1":"2","A-2":"123","A-3":"45","B-1":"45","B-2":"245","C-1":"453","C-2":"254","C-3":"453545"}', '2016-06-03 20:13:02'),
(103, 1, 'Vandesompele Pierre', 'tarifer', 'AJOUT', '{"idliaison":"31","idperiode":"4","A-1":"2","A-2":"123","A-3":"45","B-1":"45","B-2":"245","C-1":"453","C-2":"254","C-3":"453545"}', '2016-06-03 20:13:06'),
(104, 1, 'Vandesompele Pierre', 'tarifer', 'AJOUT', '{"idliaison":"32","idperiode":"4","A-1":"2","A-2":"123","A-3":"45","B-1":"45","B-2":"245","C-1":"453","C-2":"254","C-3":"453545"}', '2016-06-03 20:13:13'),
(105, 1, 'Vandesompele Pierre', 'traversee', 'AJOUT', '{"dateTraversee":"2016-06-24","heure":"15:00","idliaison":"11","idbateau":"1"}', '2016-06-03 20:15:11'),
(106, 1, 'Vandesompele Pierre', 'traversee', 'AJOUT', '{"dateTraversee":"2016-06-23","heure":"15:00","idliaison":"15","idbateau":"2"}', '2016-06-03 20:15:17'),
(107, 1, 'Vandesompele Pierre', 'traversee', 'AJOUT', '{"dateTraversee":"2016-06-22","heure":"15:00","idliaison":"16","idbateau":"3"}', '2016-06-03 20:15:23'),
(108, 1, 'Vandesompele Pierre', 'traversee', 'AJOUT', '{"dateTraversee":"2016-06-21","heure":"15:00","idliaison":"17","idbateau":"4"}', '2016-06-03 20:15:29'),
(109, 1, 'Vandesompele Pierre', 'traversee', 'AJOUT', '{"dateTraversee":"2016-06-20","heure":"15:00","idliaison":"19","idbateau":"5"}', '2016-06-03 20:15:36'),
(110, 1, 'Vandesompele Pierre', 'traversee', 'AJOUT', '{"dateTraversee":"2016-06-19","heure":"15:00","idliaison":"21","idbateau":"6"}', '2016-06-03 20:15:43'),
(111, 1, 'Vandesompele Pierre', 'traversee', 'AJOUT', '{"dateTraversee":"2016-06-18","heure":"15:00","idliaison":"22","idbateau":"10"}', '2016-06-03 20:15:50'),
(112, 1, 'Vandesompele Pierre', 'traversee', 'AJOUT', '{"dateTraversee":"2016-06-19","heure":"15:00","idliaison":"24","idbateau":"10"}', '2016-06-03 20:15:58'),
(113, 1, 'Vandesompele Pierre', 'traversee', 'AJOUT', '{"dateTraversee":"2016-06-20","heure":"15:00","idliaison":"25","idbateau":"6"}', '2016-06-03 20:16:07'),
(114, 1, 'Vandesompele Pierre', 'traversee', 'AJOUT', '{"dateTraversee":"2016-06-21","heure":"15:00","idliaison":"30","idbateau":"5"}', '2016-06-03 20:16:13'),
(115, 1, 'Vandesompele Pierre', 'traversee', 'AJOUT', '{"dateTraversee":"2016-06-22","heure":"15:00","idliaison":"31","idbateau":"4"}', '2016-06-03 20:16:19'),
(116, 1, 'Vandesompele Pierre', 'traversee', 'AJOUT', '{"dateTraversee":"2016-06-23","heure":"15:00","idliaison":"32","idbateau":"3"}', '2016-06-03 20:16:27'),
(117, 1, 'Vandesompele Pierre', 'traversee', 'MODIFICATION', '{"num":"1","dateTraversee":"05\\/06\\/2016","heure":"7:45","idliaison":"15","idbateau":"1"}', '2016-06-03 20:17:04'),
(118, 1, 'Vandesompele Pierre', 'traversee', 'MODIFICATION', '{"num":"3","dateTraversee":"03\\/06\\/2016","heure":"15:35","idliaison":"11","idbateau":"2"}', '2016-06-03 20:17:21'),
(119, 1, 'Vandesompele Pierre', 'traversee', 'MODIFICATION', '{"num":"5","dateTraversee":"09\\/06\\/2016","heure":"15:35","idliaison":"11","idbateau":"1"}', '2016-06-03 20:17:36'),
(120, 1, 'Vandesompele Pierre', 'traversee', 'MODIFICATION', '{"num":"6","dateTraversee":"15\\/12\\/2016","heure":"9:30","idliaison":"15","idbateau":"2"}', '2016-06-03 20:17:47'),
(121, 1, 'Vandesompele Pierre', 'equipement', 'AJOUT', '{"libequip":"Barbecue"}', '2016-06-03 20:21:48'),
(122, 1, 'Vandesompele Pierre', 'equipement', 'AJOUT', '{"libequip":"Gilets de sauvetage"}', '2016-06-03 20:22:02'),
(123, 1, 'Vandesompele Pierre', 'equipement', 'AJOUT', '{"libequip":"Pagaie"}', '2016-06-03 20:23:17'),
(124, 1, 'Vandesompele Pierre', 'equiper', 'MODIFICATION', '{"idbateau":"10","idequip":"2*3*6*9*10"}', '2016-06-03 20:23:28'),
(125, 1, 'Vandesompele Pierre', 'equiper', 'SUPPRESSION', '{"ID":"10","TABLE":"equiper","CHAMPS_ID":"idbateau"}', '2016-06-03 20:23:28'),
(126, 1, 'Vandesompele Pierre', 'bateau', 'AJOUT', '{"nom":"Costa Concordia","longueur":"290","largeur":"8","heritage":"1","poidsMax":"0"}', '2016-06-03 20:24:54'),
(127, 1, 'Vandesompele Pierre', 'bfret', 'AJOUT', '{"nom":"Costa Concordia","longueur":"290","largeur":"8","heritage":"1","poidsMax":"0"}', '2016-06-03 20:24:54');

--
-- Déclencheurs `modifications`
--
DROP TRIGGER IF EXISTS `NomPrenom`;
DELIMITER //
CREATE TRIGGER `NomPrenom` BEFORE INSERT ON `modifications`
 FOR EACH ROW BEGIN
	DECLARE NOMP VARCHAR(70);
  	SELECT CONCAT(`nom`, ' ', `prenom`) INTO NOMP FROM `membre` WHERE `id`=NEW.iduser ;
    SET NEW.nom_prenom = NOMP;
  END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

CREATE TABLE IF NOT EXISTS `periode` (
  `idperiode` int(20) NOT NULL AUTO_INCREMENT,
  `datedeb` date NOT NULL,
  `datefin` date NOT NULL,
  PRIMARY KEY (`idperiode`),
  UNIQUE KEY `idperiode` (`idperiode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `periode`
--

INSERT INTO `periode` (`idperiode`, `datedeb`, `datefin`) VALUES
(1, '2014-09-01', '2015-06-15'),
(2, '2015-06-16', '2015-09-15'),
(3, '2015-09-16', '2016-01-14'),
(4, '2016-01-15', '2016-12-30');

-- --------------------------------------------------------

--
-- Structure de la table `port`
--

CREATE TABLE IF NOT EXISTS `port` (
  `idport` int(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`idport`),
  UNIQUE KEY `idport` (`idport`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `port`
--

INSERT INTO `port` (`idport`, `nom`) VALUES
(1, 'Quiberon'),
(2, 'Le Palais'),
(3, 'Sauzon'),
(4, 'Vannes'),
(5, 'Port St Gildas'),
(6, 'Lorient'),
(7, 'Port-Tudy'),
(8, 'Locmaria');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `idreservation` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `idtraversee` int(11) NOT NULL,
  `dateEnregistrement` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idreservation`),
  KEY `reservation_traversee_fkey` (`idtraversee`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `reservation`
--

INSERT INTO `reservation` (`idreservation`, `nom`, `adresse`, `cp`, `ville`, `idtraversee`, `dateEnregistrement`) VALUES
(1, 'Tiprez', '15 rue de l''industrie', '19290', 'Peyrelevade', 1, '2016-01-27 11:36:31'),
(8, 'Vandesompele Pierre', '71/109', '59000', 'V. d''Ascq', 1, '2016-01-27 13:14:58'),
(12, 'Vandesompele Luis', '71/109', '59000', 'V. d''Ascq', 1, '2016-01-27 13:50:03'),
(13, 'blablaReserv', 'APPT 109 ENTREE 71 Boulevard de Valmy', '59650', 'VILLENEUVE D''ASCQ', 40, '2016-05-02 18:24:33'),
(14, 'Tarmin Yann', '5/45 rue du marché', '59000', 'Lille', 2, '2016-06-03 21:28:19'),
(20, 'Dark Vador', 'Etoile Noire', '00000', 'Bordure Exterieure', 2, '2016-06-03 22:03:37'),
(22, 'Tintin', 'blabla', '12312', 'blabla', 2, '2016-06-03 22:05:27'),
(23, 'Virginie', 'blabla', '45645', 'blablak', 2, '2016-06-03 22:06:09'),
(24, 'Claire', 'blzbla', '78978', 'blabla', 2, '2016-06-03 22:06:33'),
(25, 'Marc', 'blazblaz', '78945', 'blazblaz', 2, '2016-06-03 22:13:51'),
(26, 'Robin', 'psl', '12345', 'psl', 2, '2016-06-03 22:14:35'),
(27, 'Pierre', '45dsc', '45678', 'VDASCQ', 40, '2016-06-03 22:16:48'),
(29, 'TestTrigger', 'TestTrigger', '12121', 'TestTrigger', 40, '2016-06-04 14:08:04');

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

CREATE TABLE IF NOT EXISTS `secteur` (
  `idsecteur` int(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`idsecteur`),
  UNIQUE KEY `idsecteur` (`idsecteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `secteur`
--

INSERT INTO `secteur` (`idsecteur`, `nom`) VALUES
(1, 'Aix'),
(2, 'Batz'),
(3, 'Belle-Ile-en-Mer'),
(4, 'Bréhat'),
(5, 'Houat'),
(6, 'Ile de Groix'),
(7, 'Molène'),
(8, 'Ouessant'),
(9, 'Sein'),
(10, 'Yeu');

-- --------------------------------------------------------

--
-- Structure de la table `tarifer`
--

CREATE TABLE IF NOT EXISTS `tarifer` (
  `idliaison` int(20) NOT NULL,
  `idperiode` int(20) NOT NULL,
  `lettre` varchar(1) NOT NULL,
  `num` int(11) NOT NULL,
  `tarif` double NOT NULL,
  PRIMARY KEY (`idliaison`,`idperiode`,`lettre`,`num`),
  KEY `tarifer_liaison_fkey` (`idliaison`),
  KEY `tarifer_periode_fkey` (`idperiode`),
  KEY `tarifer_type_fkey` (`lettre`,`num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tarifer`
--

INSERT INTO `tarifer` (`idliaison`, `idperiode`, `lettre`, `num`, `tarif`) VALUES
(11, 1, 'A', 1, 45),
(11, 1, 'A', 2, 25),
(11, 1, 'A', 3, 452),
(11, 1, 'B', 1, 87),
(11, 1, 'B', 2, 78),
(11, 1, 'C', 1, 6869),
(11, 1, 'C', 2, 7852),
(11, 1, 'C', 3, 39837),
(11, 4, 'A', 1, 2),
(11, 4, 'A', 2, 123),
(11, 4, 'A', 3, 45),
(11, 4, 'B', 1, 45),
(11, 4, 'B', 2, 245),
(11, 4, 'C', 1, 453),
(11, 4, 'C', 2, 254),
(11, 4, 'C', 3, 453545),
(15, 1, 'A', 1, 18),
(15, 1, 'A', 2, 11.1),
(15, 1, 'A', 3, 5.6),
(15, 1, 'B', 1, 86),
(15, 1, 'B', 2, 129),
(15, 1, 'C', 1, 189),
(15, 1, 'C', 2, 205),
(15, 1, 'C', 3, 268),
(15, 2, 'A', 1, 20),
(15, 2, 'A', 2, 13.1),
(15, 2, 'A', 3, 7),
(15, 2, 'B', 1, 95),
(15, 2, 'B', 2, 142),
(15, 2, 'C', 1, 208),
(15, 2, 'C', 2, 226),
(15, 2, 'C', 3, 295),
(15, 3, 'A', 1, 19),
(15, 3, 'A', 2, 12.1),
(15, 3, 'A', 3, 6.4),
(15, 3, 'B', 1, 91),
(15, 3, 'B', 2, 136),
(15, 3, 'C', 1, 199),
(15, 3, 'C', 2, 216),
(15, 3, 'C', 3, 282),
(15, 4, 'A', 1, 2),
(15, 4, 'A', 2, 123),
(15, 4, 'A', 3, 45),
(15, 4, 'B', 1, 45),
(15, 4, 'B', 2, 245),
(15, 4, 'C', 1, 453),
(15, 4, 'C', 2, 254),
(15, 4, 'C', 3, 453545),
(16, 4, 'A', 1, 2),
(16, 4, 'A', 2, 123),
(16, 4, 'A', 3, 45),
(16, 4, 'B', 1, 45),
(16, 4, 'B', 2, 245),
(16, 4, 'C', 1, 453),
(16, 4, 'C', 2, 254),
(16, 4, 'C', 3, 453545),
(17, 4, 'A', 1, 2),
(17, 4, 'A', 2, 123),
(17, 4, 'A', 3, 45),
(17, 4, 'B', 1, 45),
(17, 4, 'B', 2, 245),
(17, 4, 'C', 1, 453),
(17, 4, 'C', 2, 254),
(17, 4, 'C', 3, 453545),
(19, 1, 'A', 1, 27.2),
(19, 1, 'A', 2, 17.3),
(19, 1, 'A', 3, 9.8),
(19, 1, 'B', 1, 129),
(19, 1, 'B', 2, 194),
(19, 1, 'C', 1, 284),
(19, 1, 'C', 2, 308),
(19, 1, 'C', 3, 402),
(19, 2, 'A', 1, 29.3),
(19, 2, 'A', 2, 18.6),
(19, 2, 'A', 3, 10.6),
(19, 2, 'B', 1, 139),
(19, 2, 'B', 2, 209),
(19, 2, 'C', 1, 306),
(19, 2, 'C', 2, 332),
(19, 2, 'C', 3, 434),
(19, 3, 'A', 1, 28.5),
(19, 3, 'A', 2, 18.1),
(19, 3, 'A', 3, 10.2),
(19, 3, 'B', 1, 135),
(19, 3, 'B', 2, 203),
(19, 3, 'C', 1, 298),
(19, 3, 'C', 2, 323),
(19, 3, 'C', 3, 422),
(19, 4, 'A', 1, 2),
(19, 4, 'A', 2, 123),
(19, 4, 'A', 3, 45),
(19, 4, 'B', 1, 45),
(19, 4, 'B', 2, 245),
(19, 4, 'C', 1, 453),
(19, 4, 'C', 2, 254),
(19, 4, 'C', 3, 453545),
(21, 4, 'A', 1, 2),
(21, 4, 'A', 2, 123),
(21, 4, 'A', 3, 45),
(21, 4, 'B', 1, 45),
(21, 4, 'B', 2, 245),
(21, 4, 'C', 1, 453),
(21, 4, 'C', 2, 254),
(21, 4, 'C', 3, 453545),
(22, 4, 'A', 1, 2),
(22, 4, 'A', 2, 123),
(22, 4, 'A', 3, 45),
(22, 4, 'B', 1, 45),
(22, 4, 'B', 2, 245),
(22, 4, 'C', 1, 453),
(22, 4, 'C', 2, 254),
(22, 4, 'C', 3, 453545),
(24, 4, 'A', 1, 2),
(24, 4, 'A', 2, 123),
(24, 4, 'A', 3, 45),
(24, 4, 'B', 1, 45),
(24, 4, 'B', 2, 245),
(24, 4, 'C', 1, 453),
(24, 4, 'C', 2, 254),
(24, 4, 'C', 3, 453545),
(25, 4, 'A', 1, 2),
(25, 4, 'A', 2, 123),
(25, 4, 'A', 3, 45),
(25, 4, 'B', 1, 45),
(25, 4, 'B', 2, 245),
(25, 4, 'C', 1, 453),
(25, 4, 'C', 2, 254),
(25, 4, 'C', 3, 453545),
(30, 4, 'A', 1, 2),
(30, 4, 'A', 2, 123),
(30, 4, 'A', 3, 45),
(30, 4, 'B', 1, 45),
(30, 4, 'B', 2, 245),
(30, 4, 'C', 1, 453),
(30, 4, 'C', 2, 254),
(30, 4, 'C', 3, 453545),
(31, 4, 'A', 1, 2),
(31, 4, 'A', 2, 123),
(31, 4, 'A', 3, 45),
(31, 4, 'B', 1, 45),
(31, 4, 'B', 2, 245),
(31, 4, 'C', 1, 453),
(31, 4, 'C', 2, 254),
(31, 4, 'C', 3, 453545),
(32, 4, 'A', 1, 2),
(32, 4, 'A', 2, 123),
(32, 4, 'A', 3, 45),
(32, 4, 'B', 1, 45),
(32, 4, 'B', 2, 245),
(32, 4, 'C', 1, 453),
(32, 4, 'C', 2, 254),
(32, 4, 'C', 3, 453545);

-- --------------------------------------------------------

--
-- Structure de la table `traversee`
--

CREATE TABLE IF NOT EXISTS `traversee` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `dateTraversee` date NOT NULL,
  `heure` varchar(20) NOT NULL,
  `idliaison` int(20) NOT NULL,
  `idbateau` int(20) NOT NULL,
  PRIMARY KEY (`num`),
  KEY `traversee_liaison_fkey` (`idliaison`),
  KEY `traversee_bateau_fkey` (`idbateau`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Contenu de la table `traversee`
--

INSERT INTO `traversee` (`num`, `dateTraversee`, `heure`, `idliaison`, `idbateau`) VALUES
(1, '2016-06-05', '7:45', 15, 1),
(2, '2016-06-24', '9:30', 15, 3),
(3, '2016-06-03', '15:35', 11, 2),
(4, '2015-12-16', '8:16', 11, 4),
(5, '2016-06-09', '15:35', 11, 1),
(6, '2016-12-15', '9:30', 15, 2),
(7, '2016-01-15', '8:16', 16, 3),
(8, '2016-01-22', '9:30', 17, 4),
(9, '2016-01-15', '15:35', 19, 5),
(30, '2016-01-09', '7:45', 21, 2),
(31, '2016-01-01', '8:16', 19, 3),
(32, '2016-01-09', '15:35', 17, 4),
(33, '2016-01-24', '15:35', 16, 4),
(34, '2016-01-31', '15:35', 15, 2),
(35, '2015-11-12', '15:35', 11, 5),
(36, '2015-11-28', '15:35', 21, 3),
(37, '2015-12-18', '15:35', 22, 1),
(38, '2015-12-19', '8:16', 21, 3),
(39, '2016-01-02', '7:45', 22, 4),
(40, '2016-06-17', '12:45', 15, 1),
(41, '2016-01-05', '12:45', 19, 3),
(42, '2016-06-24', '15:00', 11, 1),
(43, '2016-06-23', '15:00', 15, 2),
(44, '2016-06-22', '15:00', 16, 3),
(45, '2016-06-21', '15:00', 17, 4),
(46, '2016-06-20', '15:00', 19, 5),
(47, '2016-06-19', '15:00', 21, 6),
(48, '2016-06-18', '15:00', 22, 10),
(49, '2016-06-19', '15:00', 24, 10),
(50, '2016-06-20', '15:00', 25, 6),
(51, '2016-06-21', '15:00', 30, 5),
(52, '2016-06-22', '15:00', 31, 4),
(53, '2016-06-23', '15:00', 32, 3);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `lettre` varchar(1) NOT NULL,
  `num` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`lettre`,`num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type`
--

INSERT INTO `type` (`lettre`, `num`, `libelle`) VALUES
('A', 1, 'Adulte'),
('A', 2, 'Junior 8 à  18 ans'),
('A', 3, 'Enfant 0 à 7 ans'),
('B', 1, 'Voiture à longueur inférieure à 4m'),
('B', 2, 'Voiture à longueur inférieure à 5m'),
('C', 1, 'Fourgon'),
('C', 2, 'Camping Car'),
('C', 3, 'Camion');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `bfret`
--
ALTER TABLE `bfret`
  ADD CONSTRAINT `batHeritageFret` FOREIGN KEY (`idbateau`) REFERENCES `bateau` (`idbateau`);

--
-- Contraintes pour la table `bvoyageur`
--
ALTER TABLE `bvoyageur`
  ADD CONSTRAINT `batHeritageVoy` FOREIGN KEY (`idbateau`) REFERENCES `bateau` (`idbateau`);

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_categorie_fkey` FOREIGN KEY (`lettre`) REFERENCES `categorie` (`lettre`),
  ADD CONSTRAINT `contenir_periode_fkey` FOREIGN KEY (`idbateau`) REFERENCES `bateau` (`idbateau`);

--
-- Contraintes pour la table `enregistrer`
--
ALTER TABLE `enregistrer`
  ADD CONSTRAINT `enregistrer_reservation_fkey` FOREIGN KEY (`idreservation`) REFERENCES `reservation` (`idreservation`),
  ADD CONSTRAINT `enregistrer_type_lettre_fkey` FOREIGN KEY (`lettre`, `num`) REFERENCES `type` (`lettre`, `num`);

--
-- Contraintes pour la table `equiper`
--
ALTER TABLE `equiper`
  ADD CONSTRAINT `equipBateau` FOREIGN KEY (`idbateau`) REFERENCES `bvoyageur` (`idbateau`),
  ADD CONSTRAINT `equipEquip` FOREIGN KEY (`idequip`) REFERENCES `equipement` (`idequip`);

--
-- Contraintes pour la table `liaison`
--
ALTER TABLE `liaison`
  ADD CONSTRAINT `liaison_secteur_fkey` FOREIGN KEY (`idsecteur`) REFERENCES `secteur` (`idsecteur`),
  ADD CONSTRAINT `port_arrivee_fkey` FOREIGN KEY (`idportarrivee`) REFERENCES `port` (`idport`),
  ADD CONSTRAINT `port_depart_fkey` FOREIGN KEY (`idportdepart`) REFERENCES `port` (`idport`);

--
-- Contraintes pour la table `modifications`
--
ALTER TABLE `modifications`
  ADD CONSTRAINT `iduser` FOREIGN KEY (`iduser`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_traversee_fkey` FOREIGN KEY (`idtraversee`) REFERENCES `traversee` (`num`);

--
-- Contraintes pour la table `tarifer`
--
ALTER TABLE `tarifer`
  ADD CONSTRAINT `tarifer_liaison_fkey` FOREIGN KEY (`idliaison`) REFERENCES `liaison` (`code`),
  ADD CONSTRAINT `tarifer_periode_fkey` FOREIGN KEY (`idperiode`) REFERENCES `periode` (`idperiode`),
  ADD CONSTRAINT `tarifer_type_fkey` FOREIGN KEY (`lettre`, `num`) REFERENCES `type` (`lettre`, `num`);

--
-- Contraintes pour la table `traversee`
--
ALTER TABLE `traversee`
  ADD CONSTRAINT `traversee_bateau_fkey` FOREIGN KEY (`idbateau`) REFERENCES `bateau` (`idbateau`),
  ADD CONSTRAINT `traversee_liaison_fkey` FOREIGN KEY (`idliaison`) REFERENCES `liaison` (`code`);

--
-- Contraintes pour la table `type`
--
ALTER TABLE `type`
  ADD CONSTRAINT `categorie_type_fkey` FOREIGN KEY (`lettre`) REFERENCES `categorie` (`lettre`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
