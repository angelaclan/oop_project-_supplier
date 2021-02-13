-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 29 oct. 2019 à 16:41
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ikea_exercise`
--

-- --------------------------------------------------------

--
-- Structure de la table `commend`
--

CREATE TABLE `commend` (
  `id_command` int(11) NOT NULL,
  `date_command` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commend`
--

INSERT INTO `commend` (`id_command`, `date_command`) VALUES
(20, '2019-10-01'),
(21, '2019-10-02'),
(22, '2019-10-03'),
(23, '2019-10-04'),
(24, '2019-10-05'),
(25, '2019-10-06'),
(26, '2019-10-07');

-- --------------------------------------------------------

--
-- Structure de la table `compose`
--

CREATE TABLE `compose` (
  `id_commend` int(11) NOT NULL,
  `id_product` char(5) NOT NULL,
  `price_unit` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compose`
--

INSERT INTO `compose` (`id_commend`, `id_product`, `price_unit`, `quantity`) VALUES
(20, '101', 5, 5),
(21, '102', 7, 9);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id_product` char(5) NOT NULL,
  `name_product` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'le numéro, la désignation, la couleur et le poids',
  `color` char(8) NOT NULL,
  `Weight` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id_product`, `name_product`, `color`, `Weight`) VALUES
('101', 'VINTERFEST_Couronne ', 'vert', '0.17 k'),
('102', 'STR?LA_D?coration de', 'blanc', '0.52 k'),
('103', 'GODAFTON_Bougie bloc', 'naturel', '0.43 k'),
('104', 'BL?TSN?_Guirlande lu', 'noir', '0.2 kg'),
('105', 'STR?LA_D?coration de', 'rouge', '0.58 k'),
('106', 'STR?LA_Abat-jour', 'bleu', '0.21 k');

-- --------------------------------------------------------

--
-- Structure de la table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL COMMENT 'leur numéro, leur nom, leur prénom, leur adresse et leur téléphone.',
  `name_supplier` varchar(15) NOT NULL COMMENT 'leur numéro, leur nom, leur prénom, leur adresse et leur téléphone',
  `address_line1` varchar(20) NOT NULL,
  `address_city` char(10) NOT NULL,
  `address_country` char(10) NOT NULL,
  `Contact` varchar(15) NOT NULL COMMENT 'leur numéro, leur nom, leur prénom, leur adresse et leur téléphone.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `name_supplier`, `address_line1`, `address_city`, `address_country`, `Contact`) VALUES
(10, 'kiea', '164 Avenue de la Pla', ' 95500 Gon', 'France', '+33969362006'),
(11, 'aeik', 'Rue du Grand But Lom', '59160 Lill', 'France', '+33969362006'),
(12, 'eika', ' Place des Grands Pr', '7000 Mons', 'Belgique', '+3227191933');

-- --------------------------------------------------------

--
-- Structure de la table `supply`
--

CREATE TABLE `supply` (
  `id_product` char(5) NOT NULL,
  `id_supplier` int(11) NOT NULL COMMENT 'leur numéro, leur nom, leur prénom, leur adresse et leur téléphone.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `supply`
--

INSERT INTO `supply` (`id_product`, `id_supplier`) VALUES
('101', 10),
('102', 12),
('103', 12),
('104', 11),
('105', 11);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commend`
--
ALTER TABLE `commend`
  ADD PRIMARY KEY (`id_command`);

--
-- Index pour la table `compose`
--
ALTER TABLE `compose`
  ADD PRIMARY KEY (`id_commend`,`id_product`),
  ADD KEY `compose_product0_FK` (`id_product`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Index pour la table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Index pour la table `supply`
--
ALTER TABLE `supply`
  ADD PRIMARY KEY (`id_product`,`id_supplier`),
  ADD KEY `supply_supplier0_FK` (`id_supplier`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `compose`
--
ALTER TABLE `compose`
  ADD CONSTRAINT `compose_commend_FK` FOREIGN KEY (`id_commend`) REFERENCES `commend` (`id_command`),
  ADD CONSTRAINT `compose_product0_FK` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`);

--
-- Contraintes pour la table `supply`
--
ALTER TABLE `supply`
  ADD CONSTRAINT `supply_product_FK` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`),
  ADD CONSTRAINT `supply_supplier0_FK` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
