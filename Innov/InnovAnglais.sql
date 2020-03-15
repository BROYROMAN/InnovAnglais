-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Dim 15 Mars 2020 à 17:35
-- Version du serveur :  10.3.11-MariaDB-1:10.3.11+maria~stretch
-- Version de PHP :  7.2.12-1+0~20181112102304.11+stretch~1.gbp55f215

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `InnovAnglais`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnements`
--

CREATE TABLE `abonnements` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paiment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `abonnements`
--

INSERT INTO `abonnements` (`id`, `libelle`, `paiment`) VALUES
(1, 'FORFAIT 1', 'CARTE_BANCAIRE'),
(3, 'FORFAIT 2', 'CHEQUE');

-- --------------------------------------------------------

--
-- Structure de la table `choix`
--

CREATE TABLE `choix` (
  `id` int(11) NOT NULL,
  `est_correct` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `choix_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `choix`
--

INSERT INTO `choix` (`id`, `est_correct`, `question_id`, `choix_id`) VALUES
(4, 0, 1, 8),
(5, 1, 1, 9),
(6, 0, 1, 10);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `libelle`) VALUES
(2, 'Guy Mollet'),
(3, 'GAMBETTA');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20181206124759'),
('20181206124807'),
('20181206163611'),
('20190311082927'),
('20190311083417'),
('20190311083730'),
('20190311140102'),
('20190311142443'),
('20190311142550'),
('20190311142625'),
('20190311142837'),
('20190312102046'),
('20190312102152'),
('20190312102925'),
('20190315094820'),
('20190315095856'),
('20190323101257'),
('20190323101630'),
('20190323102000'),
('20190323102229'),
('20190323102427'),
('20190326102330'),
('20190326103106');

-- --------------------------------------------------------

--
-- Structure de la table `obtenir`
--

CREATE TABLE `obtenir` (
  `id` int(11) NOT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`id`, `question`, `theme_id`, `test_id`) VALUES
(1, 'Choisissez la traduction de rouge :', 1, 1),
(2, 'Choisissez la traduction de jaune :', 1, 1),
(3, 'Choisissez la traduction de vert :', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `niveau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `test`
--

INSERT INTO `test` (`id`, `niveau`, `theme_id`) VALUES
(1, '1', 1),
(2, '2', 1),
(3, '3', 1),
(4, '3', 2),
(5, '2', 2),
(6, '1', 2);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `theme`
--

INSERT INTO `theme` (`id`, `libelle`) VALUES
(1, 'Couleur'),
(2, 'Animaux');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datenaissance` datetime NOT NULL,
  `abonnements_id` int(11) DEFAULT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taille` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomoriginalphoto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `email`, `nom`, `prenom`, `datenaissance`, `abonnements_id`, `entreprise_id`, `photo`, `date`, `extension`, `taille`, `nomoriginalphoto`) VALUES
(1, 'Roman', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=1024,t=2,p=2$aDYxdi4waWdNang0Y1lSWA$1SotiMSF/jraV7luOANSBole8Ne0PJY6Dlif+eAfffo', 'roman@hotmail.com', 'Roman', 'Broy', '1998-03-25 00:00:00', 1, 3, '3daae3ad961ec1fb745c6d128ee8a58f.jpeg', '0000-00-00 00:00:00', 'jpeg', '91022', 'screenshot.jpg'),
(2, 'Julien', '[\"ROLE_USER\"]', '$argon2i$v=19$m=1024,t=2,p=2$cmo5SzZIaGpkLzhUaFJtbw$6rXZiTOT7Y6iB6MkXERt38P7rETr0d05Y0AlF4gIvaY', 'Julien@julien.fra', 'Julien', 'Julien', '1998-07-25 00:00:00', 1, 2, 'ffd4f1404cdec21c6c6f4cd7e08739d4.jpeg', '0000-00-00 00:00:00', 'jpeg', '77643', '49419815_2339733279595855_1508827036196536320_n.jpg'),
(3, 'yiflah', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=1024,t=2,p=2$N1AxNXdXWFZScTA4eDVhYw$uklLXm0UZsvfHyR/nVI6IFqKkwv3W/gerirSU9QNaco', 'iflah.younesse@gmail.com', 'Iflah', 'Younesse', '1997-11-30 00:00:00', 3, 3, '3daae3ad961ec1fb745c6d128ee8a58f.jpeg', '0000-00-00 00:00:00', 'jpeg', '91022', 'screenshot.jpg'),
(5, 'Test', '[\"ROLE_USER\"]', '$argon2i$v=19$m=1024,t=2,p=2$N2NSQkxOT2hKZkg1aWFkZg$Fbb8zH8nZ/iy7aMfd87gQPHH59UonlH6HdwBiS8MJeQ', 'test@test.fr', 'test', 'test', '1998-03-25 00:00:00', 3, 3, 'ffd4f1404cdec21c6c6f4cd7e08739d4.jpeg', '2019-03-15 11:02:06', 'jpeg', '77643', '49419815_2339733279595855_1508827036196536320_n.jpg'),
(6, 'photo', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=1024,t=2,p=2$cnowOWJUVDF2eUp6d0VOTQ$3+BF37y/KO2i4f2ZBZXQLu/ftsYfNmokvHjwX5Z9tgs', 'test@test.fr', 'photo', 'photo', '1998-03-25 00:00:00', 1, 2, '3daae3ad961ec1fb745c6d128ee8a58f.jpeg', '2019-03-15 11:24:36', 'jpeg', '91022', 'screenshot.jpg'),
(7, 'yuuyu', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=1024,t=2,p=2$OTFLYjl2WlQuc0VGVHhVeg$xH9iz2Gs+iK+/Vr6bqd2oxTkl8YH+PlZ6/+knbFxbMA', 'younes@gmail.com', 'ifl', 'you', '1997-11-30 00:00:00', 1, 2, '2f80138ac2d7b5f51147a68bcaa64347.png', '2019-04-01 10:13:39', 'png', '48320', 'Capture d’écran_2019-04-01_09-05-13.png');

-- --------------------------------------------------------

--
-- Structure de la table `vocabulaire`
--

CREATE TABLE `vocabulaire` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taille` double NOT NULL,
  `nomoriginal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `vocabulaire`
--

INSERT INTO `vocabulaire` (`id`, `libelle`, `categories`, `user_id`, `nom`, `date`, `extension`, `taille`, `nomoriginal`) VALUES
(8, 'Vert', 'VERBE', 1, 'b1426ad314591cdf56f26263d8f466f5.jpeg', '2019-03-11 15:29:36', 'jpeg', 4450, 'proxy.duckduckgo.com.jpeg'),
(9, 'Rouge', 'ADJECTIF', 1, '804ab7bba46e44e650c6714915a1ce5b.jpeg', '2019-04-01 10:41:33', 'jpeg', 13145, 'vinyle-bague-12-mm-rouge-translucide-les-georgettes.jpg'),
(10, 'Jaune', 'ADJECTIF', 1, 'b0f399e72c1db886133120174efc3b09.jpeg', '2019-04-01 10:41:51', 'jpeg', 9582, 'peinture-pour-artiste-jaune-colza.jpg'),
(11, 'Tigre', 'NOM', 1, '4301896836b70f8556e7c93bdf13b2b1.jpeg', '2019-04-01 10:42:09', 'jpeg', 126238, '1038039205.jpg'),
(12, 'Lion', 'NOM', 1, '85a25ca04cf424b2577148e0d4ab6c7f.png', '2019-04-01 10:42:21', 'png', 393105, '2018-03-21_1816.png');

-- --------------------------------------------------------

--
-- Structure de la table `vocabulaire_theme`
--

CREATE TABLE `vocabulaire_theme` (
  `vocabulaire_id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `vocabulaire_theme`
--

INSERT INTO `vocabulaire_theme` (`vocabulaire_id`, `theme_id`) VALUES
(8, 1),
(9, 1),
(10, 1),
(11, 2),
(12, 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `abonnements`
--
ALTER TABLE `abonnements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `choix`
--
ALTER TABLE `choix`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4F4880911E27F6BF` (`question_id`),
  ADD KEY `IDX_4F488091D9144651` (`choix_id`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `obtenir`
--
ALTER TABLE `obtenir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ED792AC9A76ED395` (`user_id`),
  ADD KEY `IDX_ED792AC91E5D0459` (`test_id`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6F7494E59027487` (`theme_id`),
  ADD KEY `IDX_B6F7494E1E5D0459` (`test_id`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D87F7E0C59027487` (`theme_id`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  ADD KEY `IDX_8D93D649633E2BBF` (`abonnements_id`),
  ADD KEY `IDX_8D93D649A4AEAFEA` (`entreprise_id`);

--
-- Index pour la table `vocabulaire`
--
ALTER TABLE `vocabulaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DB1ADE7DA76ED395` (`user_id`);

--
-- Index pour la table `vocabulaire_theme`
--
ALTER TABLE `vocabulaire_theme`
  ADD PRIMARY KEY (`vocabulaire_id`,`theme_id`),
  ADD KEY `IDX_224CB999D8B12F03` (`vocabulaire_id`),
  ADD KEY `IDX_224CB99959027487` (`theme_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `abonnements`
--
ALTER TABLE `abonnements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `choix`
--
ALTER TABLE `choix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `obtenir`
--
ALTER TABLE `obtenir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `vocabulaire`
--
ALTER TABLE `vocabulaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `choix`
--
ALTER TABLE `choix`
  ADD CONSTRAINT `FK_4F4880911E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`),
  ADD CONSTRAINT `FK_4F488091D9144651` FOREIGN KEY (`choix_id`) REFERENCES `vocabulaire` (`id`);

--
-- Contraintes pour la table `obtenir`
--
ALTER TABLE `obtenir`
  ADD CONSTRAINT `FK_ED792AC91E5D0459` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`),
  ADD CONSTRAINT `FK_ED792AC9A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_B6F7494E1E5D0459` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`),
  ADD CONSTRAINT `FK_B6F7494E59027487` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`);

--
-- Contraintes pour la table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `FK_D87F7E0C59027487` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649633E2BBF` FOREIGN KEY (`abonnements_id`) REFERENCES `abonnements` (`id`),
  ADD CONSTRAINT `FK_8D93D649A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`);

--
-- Contraintes pour la table `vocabulaire`
--
ALTER TABLE `vocabulaire`
  ADD CONSTRAINT `FK_DB1ADE7DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `vocabulaire_theme`
--
ALTER TABLE `vocabulaire_theme`
  ADD CONSTRAINT `FK_224CB99959027487` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_224CB999D8B12F03` FOREIGN KEY (`vocabulaire_id`) REFERENCES `vocabulaire` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
