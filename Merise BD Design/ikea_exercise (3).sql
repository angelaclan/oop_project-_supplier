-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 02 nov. 2019 à 15:39
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
-- Structure de la table `compose`
--

CREATE TABLE `compose` (
  `id` int(6) NOT NULL,
  `id_command` int(6) NOT NULL,
  `id_product` int(6) NOT NULL,
  `quantity` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id_product` int(6) NOT NULL,
  `name_product` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'le numéro, la désignation, la couleur et le poids',
  `color` char(8) NOT NULL,
  `Weight` varchar(6) NOT NULL,
  `date_issue` date NOT NULL DEFAULT current_timestamp(),
  `id_supplier` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id_product`, `name_product`, `color`, `Weight`, `date_issue`, `id_supplier`) VALUES
(101, 'VINTERFEST_Couronne ', 'vert', '0.17 k', '2019-10-01', 10),
(102, 'STR?LA_D?coration de', 'blanc', '0.52 k', '2019-10-02', 11),
(103, 'GODAFTON_Bougie bloc', 'naturel', '0.43 k', '2019-10-03', 12),
(104, 'BL?TSN?_Guirlande lu', 'noir', '0.2 kg', '2019-10-04', 10),
(105, 'STR?LA_D?coration de', 'rouge', '0.58 k', '2019-10-31', 11),
(106, 'STR?LA_Abat-jour', 'bleu', '0.21 k', '2019-10-31', 12),
(107, 'VINTERFEST_Photophor', 'blanc', '0.41 k', '0000-00-00', 10),
(108, 'dfgrt', 'rt', '0.52', '0000-00-00', 11),
(123, 'lamp', 'red', '1 kg', '2019-11-01', 12),
(258, 'sfeq', 'klmjl', '545', '2019-11-01', 10),
(741, 'jhj', 'lkml', '56', '2019-11-01', 11),
(789, 'ghj', 'kjl', '45', '2019-11-01', 12);

-- --------------------------------------------------------

--
-- Structure de la table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(6) NOT NULL COMMENT 'leur numéro, leur nom, leur prénom, leur adresse et leur téléphone.',
  `name_supplier` varchar(15) NOT NULL COMMENT 'leur numéro, leur nom, leur prénom, leur adresse et leur téléphone',
  `address_line1` varchar(20) NOT NULL,
  `address_city` char(10) NOT NULL,
  `address_country` char(10) NOT NULL,
  `Contact` varchar(15) NOT NULL COMMENT 'leur numéro, leur nom, leur prénom, leur adresse et leur téléphone.',
  `date_issue` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `name_supplier`, `address_line1`, `address_city`, `address_country`, `Contact`, `date_issue`) VALUES
(10, 'kiea', '164 Avenue de la Pla', ' 95500 Gon', 'France', '+33969362006', '0000-00-00'),
(11, 'aeik', 'Rue du Grand But Lom', '59160 Lill', 'France', '+33969362006', '0000-00-00'),
(12, 'eika', ' Place des Grands Pr', '7000 Mons', 'Belgique', '+3227191933', '0000-00-00'),
(5456, 'kllm', 'khmlkjml', 'lilel', 'fr', '+254554323564', '2019-11-01');

-- --------------------------------------------------------

--
-- Structure de la table `supply`
--

CREATE TABLE `supply` (
  `id` int(6) NOT NULL,
  `id_supplier` int(6) NOT NULL,
  `id_product` int(6) NOT NULL,
  `price` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `compose`
--
ALTER TABLE `compose`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `compose`
--
ALTER TABLE `compose`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=790;

--
-- AUTO_INCREMENT pour la table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(6) NOT NULL AUTO_INCREMENT COMMENT 'leur numéro, leur nom, leur prénom, leur adresse et leur téléphone.', AUTO_INCREMENT=5457;

--
-- AUTO_INCREMENT pour la table `supply`
--
ALTER TABLE `supply`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
