-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 27 Janvier 2016 à 14:48
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `bateau`
--

INSERT INTO `bateau` (`idbateau`, `nom`, `longueurBat`, `largeurBat`, `heritage`) VALUES
(1, 'Kor''Ant', 10, 5, 0),
(2, 'Ar Solen', 20, 10, 0),
(3, 'Al''xi', 10, 5, 0),
(4, 'Luce isle', 37.2, 8.6, 0),
(5, 'Maëllys', 23, 11.5, 0),
(6, 'Pippo', 12.5, 6.125, 1);

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
(6, 600);

-- --------------------------------------------------------

--
-- Structure de la table `bvoyageur`
--

CREATE TABLE IF NOT EXISTS `bvoyageur` (
  `idbateau` int(20) NOT NULL,
  `imageBatVoyageur` varchar(50) NOT NULL,
  `vitesseBatVoy` float NOT NULL,
  PRIMARY KEY (`idbateau`),
  KEY `batHeritageVoy` (`idbateau`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bvoyageur`
--

INSERT INTO `bvoyageur` (`idbateau`, `imageBatVoyageur`, `vitesseBatVoy`) VALUES
(1, 'Kor_Ant.jpg', 13),
(2, 'Ar_Solen.jpg', 130),
(3, 'Al_xi.jpg', 29),
(4, 'Luce_isle.jpeg', 26),
(5, 'Maellys.jpg', 2);

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
('A', 2, 1, 1),
('A', 2, 8, 2),
('A', 2, 12, 1),
('A', 3, 1, 2),
('A', 3, 8, 3),
('A', 3, 12, 0),
('B', 1, 1, 0),
('B', 1, 8, 2),
('B', 1, 12, 0),
('B', 2, 1, 1),
('B', 2, 8, 4),
('B', 2, 12, 0),
('C', 1, 1, 0),
('C', 1, 8, 3),
('C', 1, 12, 0),
('C', 2, 1, 0),
('C', 2, 8, 6),
('C', 2, 12, 0),
('C', 3, 1, 0),
('C', 3, 8, 9),
('C', 3, 12, 0);

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE IF NOT EXISTS `equipement` (
  `idequip` int(20) NOT NULL AUTO_INCREMENT,
  `libequip` varchar(50) NOT NULL,
  PRIMARY KEY (`idequip`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `equipement`
--

INSERT INTO `equipement` (`idequip`, `libequip`) VALUES
(1, 'Accès Handicapé'),
(2, 'Bar'),
(3, 'Pont Promenade'),
(4, 'Salon Vidéo'),
(5, 'Piscine'),
(6, 'Salle de spéctacle');

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
(4, 1),
(4, 5),
(5, 2);

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
  KEY `port_depart_fkey` (`idportdepart`),
  KEY `port_arrivee_fkey` (`idportarrivee`),
  KEY `liaison_secteur_fkey` (`idsecteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `liaison`
--

INSERT INTO `liaison` (`code`, `idsecteur`, `idportdepart`, `idportarrivee`, `distance`) VALUES
(11, 3, 2, 4, 25.1),
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
  `mdp` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `droit` int(11) NOT NULL DEFAULT '0',
  `dateInsc` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `login`, `mdp`, `nom`, `prenom`, `mail`, `droit`, `dateInsc`) VALUES
(1, 'ppe', 'ppe', 'vdsp', 'pierre', 'blabla@tak.com', 1, '2016-01-16 17:32:03'),
(2, 'ppe2', 'ppe2', 'plwzk', 'raphael', 'blabla2@tak.com', 0, '2016-01-16 17:32:03');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `periode`
--

INSERT INTO `periode` (`idperiode`, `datedeb`, `datefin`) VALUES
(1, '2014-09-01', '2015-06-15'),
(2, '2015-06-16', '2015-09-15'),
(3, '2015-09-16', '2016-05-31');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `reservation`
--

INSERT INTO `reservation` (`idreservation`, `nom`, `adresse`, `cp`, `ville`, `idtraversee`, `dateEnregistrement`) VALUES
(1, 'Tiprez', '15 rue de l''industrie', '19290', 'Peyrelevade', 1, '2016-01-27 11:36:31'),
(8, 'Vandesompele Pierre', '71/109', '59000', 'V. d''Ascq', 1, '2016-01-27 13:14:58'),
(12, 'Vandesompele Luis', '71/109', '59000', 'V. d''Ascq', 1, '2016-01-27 13:50:03');

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

CREATE TABLE IF NOT EXISTS `secteur` (
  `idsecteur` int(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`idsecteur`),
  UNIQUE KEY `idsecteur` (`idsecteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

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
(19, 3, 'C', 3, 422);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Contenu de la table `traversee`
--

INSERT INTO `traversee` (`num`, `dateTraversee`, `heure`, `idliaison`, `idbateau`) VALUES
(1, '2016-01-05', '7:45', 15, 1),
(2, '2016-01-07', '9:30', 15, 3),
(3, '2016-01-03', '15:35', 11, 2),
(4, '2015-12-16', '8:16', 11, 4),
(5, '2016-01-09', '15:35', 11, 1),
(6, '2015-12-15', '9:30', 15, 2),
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
(40, '2016-01-05', '12:45', 15, 1);

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
