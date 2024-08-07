-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 07 août 2024 à 15:26
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `transfert`
--

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

CREATE TABLE `agence` (
  `_idAgence` int(11) NOT NULL,
  `_reference` varchar(50) DEFAULT NULL,
  `_adresse` varchar(255) NOT NULL,
  `_idPays` int(11) NOT NULL,
  `_contact` varchar(100) NOT NULL,
  `_idUser` int(11) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `modifyAt` timestamp NULL DEFAULT NULL,
  `modifyBy` int(11) DEFAULT NULL,
  `statut` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `_idClient` int(11) NOT NULL,
  `_nom` varchar(100) NOT NULL,
  `_prenom` varchar(100) NOT NULL,
  `_telephone` varchar(15) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `modifyAt` timestamp NULL DEFAULT NULL,
  `modifyBy` int(11) DEFAULT NULL,
  `statut` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `devise`
--

CREATE TABLE `devise` (
  `_idDevise` int(11) NOT NULL,
  `_reference` varchar(30) DEFAULT NULL,
  `_sigle` varchar(10) NOT NULL,
  `_nbPays` int(11) DEFAULT 1,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `modifyAt` timestamp NULL DEFAULT NULL,
  `modifyBy` int(11) DEFAULT NULL,
  `statut` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `devise`
--

INSERT INTO `devise` (`_idDevise`, `_reference`, `_sigle`, `_nbPays`, `createdAt`, `createdBy`, `modifyAt`, `modifyBy`, `statut`) VALUES
(1, 'Franc Guinéen', 'GNF', 1, '2024-08-07 03:48:05', 1, NULL, 1, 1),
(2, 'Franc Canadien', 'CAD', 1, '2024-08-07 03:48:05', 1, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `listPays`
--

CREATE TABLE `listPays` (
  `_idPays` int(11) NOT NULL,
  `_pays` varchar(100) NOT NULL,
  `_code` varchar(10) DEFAULT NULL,
  `_idDevise` int(11) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `modifyAt` timestamp NULL DEFAULT NULL,
  `modifyBy` int(11) DEFAULT NULL,
  `statut` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `listPays`
--

INSERT INTO `listPays` (`_idPays`, `_pays`, `_code`, `_idDevise`, `createdAt`, `createdBy`, `modifyAt`, `modifyBy`, `statut`) VALUES
(1, 'GUINEE', '+224', 1, '2024-08-07 03:48:38', 1, NULL, 1, 1),
(2, 'CANADA', '+1', 2, '2024-08-07 03:48:38', 1, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `_idOperation` int(11) NOT NULL,
  `_idUser` int(11) DEFAULT NULL,
  `_idType` int(11) NOT NULL,
  `_devise` int(11) NOT NULL,
  `_montant` decimal(10,2) NOT NULL,
  `_tauxJour` double NOT NULL,
  `_motif` varchar(255) DEFAULT NULL,
  `_sousCouvert` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `modifyAt` timestamp NULL DEFAULT NULL,
  `modifyBy` int(11) DEFAULT NULL,
  `statut` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `planTarifaire`
--

CREATE TABLE `planTarifaire` (
  `_idTarif` int(11) NOT NULL,
  `_paysSource` int(11) NOT NULL,
  `_paysDest` int(11) NOT NULL,
  `_tauxEnvoie` decimal(10,2) NOT NULL,
  `_commentaire` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `modifyAt` timestamp NULL DEFAULT NULL,
  `modifyBy` int(11) DEFAULT NULL,
  `statut` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `retrait`
--

CREATE TABLE `retrait` (
  `_idRetrait` int(11) NOT NULL,
  `_idTransfert` int(11) NOT NULL,
  `_agenceConfirm` int(11) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `modifyAt` timestamp NULL DEFAULT NULL,
  `modifyBy` int(11) DEFAULT NULL,
  `statut` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `taux`
--

CREATE TABLE `taux` (
  `id` int(11) NOT NULL,
  `tauxJour` double DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `transfert`
--

CREATE TABLE `transfert` (
  `_idTransfert` int(11) NOT NULL,
  `_codeRetrait` varchar(50) NOT NULL,
  `_nomExp` varchar(100) DEFAULT NULL,
  `_prenomExp` varchar(100) DEFAULT NULL,
  `_telephoneExp` varchar(25) DEFAULT NULL,
  `_idClient` int(11) DEFAULT NULL,
  `_nomBenef` varchar(100) DEFAULT NULL,
  `_prenomBenef` varchar(100) NOT NULL,
  `_telephoneBenef` varchar(15) NOT NULL,
  `_pieceIdentite` varchar(50) DEFAULT NULL,
  `_numeroPiece` varchar(50) DEFAULT NULL,
  `_montant` decimal(10,2) NOT NULL DEFAULT 0.00,
  `_tauxTransfert` double NOT NULL DEFAULT 0,
  `_tauxJour` double NOT NULL DEFAULT 0,
  `_agenceStart` int(11) DEFAULT NULL,
  `_idAgence` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `modifyAt` timestamp NULL DEFAULT NULL,
  `modifyBy` int(11) DEFAULT NULL,
  `statut` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `typeOperation`
--

CREATE TABLE `typeOperation` (
  `_idType` int(11) NOT NULL,
  `_libelle` varchar(255) NOT NULL,
  `_commentaire` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `modifyAt` timestamp NULL DEFAULT NULL,
  `modifyBy` int(11) DEFAULT NULL,
  `statut` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `_idUser` int(11) NOT NULL,
  `_nom` varchar(100) NOT NULL,
  `_prenom` varchar(100) NOT NULL,
  `_telephone` varchar(20) NOT NULL,
  `_motDePasse` varchar(255) NOT NULL,
  `_codePin` varchar(255) DEFAULT NULL,
  `_paysID` int(11) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `modifyAt` timestamp NULL DEFAULT NULL,
  `modifyBy` int(11) DEFAULT NULL,
  `statut` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`_idUser`, `_nom`, `_prenom`, `_telephone`, `_motDePasse`, `_codePin`, `_paysID`, `createdAt`, `createdBy`, `modifyAt`, `modifyBy`, `statut`) VALUES
(1, 'Imourana', 'Cherif', '626370138', '81dc9bdb52d04dc20036dbd8313ed055', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2024-08-07 04:02:37', NULL, NULL, NULL, 1),
(17, 'Fanta', 'Kallo', '194894489', '81dc9bdb52d04dc20036dbd8313ed055', '81dc9bdb52d04dc20036dbd8313ed055', 2, '2024-08-07 04:26:57', NULL, NULL, NULL, 1),
(33, 'Souleymane', 'Diallo', '62429879', '81dc9bdb52d04dc20036dbd8313ed055', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2024-08-07 11:38:54', NULL, NULL, NULL, 1),
(34, 'Ramadane', 'Diallo', '624085523', '81dc9bdb52d04dc20036dbd8313ed055', '81dc9bdb52d04dc20036dbd8313ed055', 2, '2024-08-07 12:00:24', NULL, NULL, NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agence`
--
ALTER TABLE `agence`
  ADD PRIMARY KEY (`_idAgence`),
  ADD KEY `_idPays` (`_idPays`),
  ADD KEY `_idUser` (`_idUser`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`_idClient`);

--
-- Index pour la table `devise`
--
ALTER TABLE `devise`
  ADD PRIMARY KEY (`_idDevise`);

--
-- Index pour la table `listPays`
--
ALTER TABLE `listPays`
  ADD PRIMARY KEY (`_idPays`),
  ADD UNIQUE KEY `_pays` (`_pays`),
  ADD UNIQUE KEY `_code` (`_code`),
  ADD KEY `foreign_key` (`_idDevise`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`_idOperation`),
  ADD KEY `_devise` (`_devise`),
  ADD KEY `fk_user` (`_idUser`),
  ADD KEY `fk_Type` (`_idType`);

--
-- Index pour la table `planTarifaire`
--
ALTER TABLE `planTarifaire`
  ADD PRIMARY KEY (`_idTarif`),
  ADD KEY `_paysSource` (`_paysSource`),
  ADD KEY `_paysDest` (`_paysDest`);

--
-- Index pour la table `retrait`
--
ALTER TABLE `retrait`
  ADD PRIMARY KEY (`_idRetrait`),
  ADD KEY `_idTransfert` (`_idTransfert`);

--
-- Index pour la table `taux`
--
ALTER TABLE `taux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkUser` (`createdBy`);

--
-- Index pour la table `transfert`
--
ALTER TABLE `transfert`
  ADD PRIMARY KEY (`_idTransfert`),
  ADD UNIQUE KEY `_codeRetrait` (`_codeRetrait`),
  ADD KEY `_idClient` (`_idClient`),
  ADD KEY `_idAgence` (`_idAgence`);

--
-- Index pour la table `typeOperation`
--
ALTER TABLE `typeOperation`
  ADD PRIMARY KEY (`_idType`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`_idUser`),
  ADD UNIQUE KEY `_telephone` (`_telephone`),
  ADD KEY `_paysID` (`_paysID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `agence`
--
ALTER TABLE `agence`
  MODIFY `_idAgence` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `_idClient` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `devise`
--
ALTER TABLE `devise`
  MODIFY `_idDevise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `listPays`
--
ALTER TABLE `listPays`
  MODIFY `_idPays` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `operation`
--
ALTER TABLE `operation`
  MODIFY `_idOperation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `planTarifaire`
--
ALTER TABLE `planTarifaire`
  MODIFY `_idTarif` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `retrait`
--
ALTER TABLE `retrait`
  MODIFY `_idRetrait` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `taux`
--
ALTER TABLE `taux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transfert`
--
ALTER TABLE `transfert`
  MODIFY `_idTransfert` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typeOperation`
--
ALTER TABLE `typeOperation`
  MODIFY `_idType` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `_idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `agence`
--
ALTER TABLE `agence`
  ADD CONSTRAINT `agence_ibfk_1` FOREIGN KEY (`_idPays`) REFERENCES `listPays` (`_idPays`),
  ADD CONSTRAINT `agence_ibfk_2` FOREIGN KEY (`_idUser`) REFERENCES `users` (`_idUser`);

--
-- Contraintes pour la table `listPays`
--
ALTER TABLE `listPays`
  ADD CONSTRAINT `foreign_key` FOREIGN KEY (`_idDevise`) REFERENCES `devise` (`_idDevise`);

--
-- Contraintes pour la table `operation`
--
ALTER TABLE `operation`
  ADD CONSTRAINT `fk_Type` FOREIGN KEY (`_idType`) REFERENCES `typeOperation` (`_idType`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`_idUser`) REFERENCES `users` (`_idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `operation_ibfk_2` FOREIGN KEY (`_devise`) REFERENCES `devise` (`_idDevise`);

--
-- Contraintes pour la table `planTarifaire`
--
ALTER TABLE `planTarifaire`
  ADD CONSTRAINT `plantarifaire_ibfk_1` FOREIGN KEY (`_paysSource`) REFERENCES `listPays` (`_idPays`),
  ADD CONSTRAINT `plantarifaire_ibfk_2` FOREIGN KEY (`_paysDest`) REFERENCES `listPays` (`_idPays`);

--
-- Contraintes pour la table `retrait`
--
ALTER TABLE `retrait`
  ADD CONSTRAINT `retrait_ibfk_1` FOREIGN KEY (`_idTransfert`) REFERENCES `transfert` (`_idTransfert`);

--
-- Contraintes pour la table `taux`
--
ALTER TABLE `taux`
  ADD CONSTRAINT `fkUser` FOREIGN KEY (`createdBy`) REFERENCES `users` (`_idUser`);

--
-- Contraintes pour la table `transfert`
--
ALTER TABLE `transfert`
  ADD CONSTRAINT `transfert_ibfk_1` FOREIGN KEY (`_idClient`) REFERENCES `client` (`_idClient`),
  ADD CONSTRAINT `transfert_ibfk_2` FOREIGN KEY (`_idAgence`) REFERENCES `agence` (`_idAgence`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
