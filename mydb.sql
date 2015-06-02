-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2015 at 07:28 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydb`
--
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mydb`;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `idGroup` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `id_Creator` int(11) NOT NULL,
  `created_On` datetime NOT NULL,
  PRIMARY KEY (`idGroup`),
  UNIQUE KEY `idGroup_UNIQUE` (`idGroup`),
  KEY `id_Creator_idx` (`id_Creator`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`idGroup`, `name`, `id_Creator`, `created_On`) VALUES
(10, 'Aleksina grupa', 1, '2015-05-27 23:35:20'),
(11, 'grupa5', 5, '2015-05-29 00:34:27'),
(12, 'grupa5', 4, '2015-05-29 02:33:38'),
(13, 'grupa10', 4, '2015-05-29 02:36:51'),
(14, 'grupa100', 4, '2015-05-29 02:37:31'),
(41, 'grupa6', 4, '2015-05-29 03:22:30'),
(42, 'grupa2', 4, '2015-05-29 03:33:11'),
(43, 'grupa3', 4, '2015-05-29 03:33:14'),
(44, 'grupa7', 4, '2015-05-29 03:34:20'),
(45, 'grupa4', 4, '2015-05-29 03:34:22'),
(46, 'bogdanina', 4, '2015-05-29 05:56:00'),
(47, 'aleksina', 4, '2015-05-29 05:56:41'),
(48, 'dulovi', 4, '2015-05-29 06:00:21'),
(49, 'grupa', 59, '2015-05-29 07:02:19'),
(51, 'Grupa Bogdana', 4, '2015-05-31 18:51:25'),
(52, 'Bogdanina grupa', 4, '2015-05-31 18:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `group_note`
--

CREATE TABLE IF NOT EXISTS `group_note` (
  `idNote` int(11) NOT NULL,
  `last_Editor` int(11) NOT NULL,
  `is_Locked` varchar(45) NOT NULL,
  `id_Group` int(11) NOT NULL,
  PRIMARY KEY (`idNote`),
  UNIQUE KEY `idNote_UNIQUE` (`idNote`),
  KEY `fkEditor_idx` (`last_Editor`),
  KEY `fkGroup_idx` (`id_Group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group_note`
--

INSERT INTO `group_note` (`idNote`, `last_Editor`, `is_Locked`, `id_Group`) VALUES
(1, 4, '0', 14),
(3, 2, '1', 14),
(5, 4, '0', 14),
(7, 2, '0', 14),
(15, 2, '1', 14),
(17, 2, '1', 14),
(36, 4, '0', 14),
(38, 4, '0', 13);

-- --------------------------------------------------------

--
-- Table structure for table `hidden_note`
--

CREATE TABLE IF NOT EXISTS `hidden_note` (
  `idNote` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idNote`,`idUser`),
  KEY `fkNote_idx` (`idNote`),
  KEY `fkUser_idx` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hidden_note`
--

INSERT INTO `hidden_note` (`idNote`, `idUser`) VALUES
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `image` int(11) NOT NULL AUTO_INCREMENT,
  `product_pic` varchar(500) NOT NULL,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`image`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image`, `product_pic`, `title`) VALUES
(1, '', 'aaaaa'),
(2, '', 'aaaaa'),
(3, '', 'aaaaa'),
(4, '3fa876d9a117e256effd050fda5a886f.jpg', 'mmm'),
(5, '132277da6db62e08d2d41f1a814ab747.jpg', '$title'),
(6, 'cc4dd32ca0dc0d859cbe7278c6e800a4.jpg', 'dulenba'),
(7, '6acec4dd7184e3ccd970c7773c4db710.jpg', 'dulenba'),
(8, 'a63bdd8711a092ccf4b2abd2e00bbed8.jpg', 'dulenba'),
(9, '1198605485f1b2d8f45c9676c98e1fe1.jpg', 'dulenba'),
(10, 'fd1c38df1dcf84368b0112ac2c397c31.jpg', 'dulenba'),
(11, 'ff67fb6e6f9523a7a03460142b746ae4.jpg', 'dulenba'),
(12, '8c152aea644fff340f28d2b05d76bd31.jpg', 'dulenba'),
(13, '91986dca68cb8350e884f9de548c1757.jpg', 'dulenba'),
(14, 'ce53ae0578df8222c613282b80cda4be.jpg', 'dulenba'),
(15, 'aadb9fd406794ce1a797142370128a5d.jpg', 'dulence'),
(16, '', 'dulence'),
(17, '7b82818f2e89842c770966e0a41b59bb.jpg', 'dulence'),
(18, '', 'dulence'),
(19, '9d749736e9a43120358f3d5eafa6c8eb.jpg', 'dulence'),
(20, '1bd3599a6e96e9cb4fd974df3ff17e5e.jpg', 'dulence'),
(21, '', 'dulence'),
(22, '', 'dulence'),
(23, '0ff20b6a3218feacd3fe12714e0ac9ad.jpg', 'dulence'),
(24, 'f0184d2cca9bcd0338a2091b46f7c69d.jpg', 'dulence'),
(25, '', 'dulence'),
(26, 'd21a25babb1b60ac972cefbb2d41c10d.jpg', 'dulo'),
(27, '', 'dulo'),
(28, 'db7c3fa8af57f5a50986f8e56649f216.jpg', 'dulo'),
(29, 'c662711b7ec0fa300cdd267a98626801.jpg', 'dulence'),
(30, '', 'dulence'),
(31, '2d24dbb1d71ac102b244e808abee14c3.jpg', 'dulence'),
(32, '', 'dulence'),
(33, '46e35699ea1b9fa41d9bf4dfebf5b236.jpg', 'dulence'),
(34, '', 'dulence'),
(35, 'f3960e50cc424d200746aa339c26227b.jpg', 'dulence'),
(36, 'cc3d2212b3c317b9fc87094c731716e2.jpg', 'dulence'),
(37, '517108084baa3cdaf4a799fcac38e537.jpg', 'dulence'),
(38, '', 'dulence'),
(39, '722c1b30f82d9742f4faf86723389b89.jpg', 'dulence'),
(40, '', 'dulence'),
(41, '', 'dulence'),
(42, '23b957b53837150ff5f04db0104dd977.jpg', 'dulence'),
(43, 'f281b3f6cba28e9a5890224d96ea6c7d.jpg', 'dulence'),
(44, '6ee996dfca944092212749feecaac3f4.jpg', 'dulence'),
(45, '7685169c474bda0009ffe39a9f7588f7.jpg', 'dulence'),
(46, 'c47a4baca489ab05dea56e9926734131.jpg', 'dulence'),
(47, '', 'dulence'),
(48, '68476b684c7a320a85d21788d56e28fa.jpg', 'dulence'),
(49, '', 'dulence'),
(50, '9b9495f920f6930666b4cc037e30ae80.jpg', 'dulence'),
(51, '', 'dulence'),
(52, '', 'dulence'),
(53, '', 'dulence'),
(54, '', 'dulence'),
(55, '', 'dulence'),
(56, 'f2060bcbf107629e0b690be745497d79.jpg', 'dulence'),
(57, '', 'dulence'),
(58, '', 'dulence'),
(59, '', 'dulence'),
(60, '0564ec08834799600ecb961e704ba144.jpg', 'dulence'),
(61, '', 'dulence'),
(62, '', 'dulence'),
(63, '4b986ccad09a6cc56cf438026991f962.jpg', 'dulence'),
(64, '', 'dulence'),
(65, '', 'dulence'),
(66, 'e91b1a9aadfd36b92ac1e1827492b7d8.jpg', 'dulence'),
(67, '', 'dulence'),
(68, '', 'dulence'),
(69, '6748f08a34f87bf1263877ab0922e0e2.jpg', 'dulence'),
(70, 'e66f28eab50d58551aa78b0869348bbc.jpg', 'dulence'),
(71, '5f03584fbcdee81154567f3129af5c6e.jpg', 'dulence'),
(72, '42cd20ddd0f909422baba7b9369b644a.jpg', 'dulence'),
(73, '', 'dulence'),
(74, '3f73bae78d529aa623da289b799be0c5.jpg', 'dulence'),
(75, '5ffba5991955f1e2e19d1282d2d3e48e.jpg', 'dulence'),
(76, '1a7a4c79c11517925810e92fa2028252.jpg', 'vbogdana'),
(77, '93f181166083af05f428e3d35f95bb04.jpg', 'vbogdana');

-- --------------------------------------------------------

--
-- Table structure for table `important`
--

CREATE TABLE IF NOT EXISTS `important` (
  `idUser` int(11) NOT NULL,
  `idNote` int(11) NOT NULL,
  PRIMARY KEY (`idUser`,`idNote`),
  KEY `fkUser_idx` (`idUser`),
  KEY `fkNote_idx` (`idNote`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `important`
--

INSERT INTO `important` (`idUser`, `idNote`) VALUES
(4, 3),
(4, 9),
(4, 13),
(4, 14);

-- --------------------------------------------------------

--
-- Table structure for table `ismember`
--

CREATE TABLE IF NOT EXISTS `ismember` (
  `id_User` int(11) NOT NULL,
  `id_Group` int(11) NOT NULL,
  `joined_On` datetime NOT NULL,
  `is_Admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_Group`,`id_User`),
  KEY `fkUser_idx` (`id_User`),
  KEY `fkGroup_idx` (`id_Group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ismember`
--

INSERT INTO `ismember` (`id_User`, `id_Group`, `joined_On`, `is_Admin`) VALUES
(1, 10, '2015-05-27 23:40:00', 1),
(2, 10, '2015-05-27 23:44:00', 0),
(5, 11, '2015-05-29 00:34:27', 1),
(4, 12, '2015-05-29 02:33:38', 1),
(5, 12, '2015-05-29 02:33:38', 0),
(1, 13, '2015-05-29 02:36:51', 0),
(4, 13, '2015-05-29 02:36:51', 1),
(1, 14, '2015-05-29 02:37:31', 0),
(2, 14, '2015-05-29 02:37:31', 0),
(4, 14, '2015-05-29 02:37:31', 1),
(5, 14, '2015-05-29 02:37:31', 0),
(1, 41, '2015-05-29 03:22:30', 0),
(4, 41, '2015-05-29 03:22:30', 1),
(5, 41, '2015-05-29 03:22:30', 0),
(1, 42, '2015-05-29 03:33:12', 0),
(4, 42, '2015-05-29 03:33:11', 1),
(2, 43, '2015-05-29 03:33:14', 0),
(4, 43, '2015-05-29 03:33:14', 1),
(5, 43, '2015-05-29 03:33:14', 0),
(2, 44, '2015-05-29 03:34:20', 0),
(4, 44, '2015-05-29 03:34:20', 1),
(1, 45, '2015-05-29 03:34:22', 0),
(4, 45, '2015-05-29 03:34:22', 1),
(5, 45, '2015-05-29 03:34:22', 0),
(1, 46, '2015-05-29 05:56:01', 0),
(2, 46, '2015-05-29 05:56:01', 0),
(4, 46, '2015-05-29 05:56:01', 1),
(2, 47, '2015-05-29 05:56:41', 0),
(4, 47, '2015-05-29 05:56:41', 1),
(1, 48, '2015-05-29 06:00:21', 0),
(2, 48, '2015-05-29 06:00:21', 0),
(4, 48, '2015-05-29 06:00:21', 1),
(5, 48, '2015-05-29 06:00:21', 0),
(6, 48, '2015-05-29 06:00:21', 0),
(15, 48, '2015-05-29 06:00:21', 0),
(18, 48, '2015-05-29 06:00:21', 0),
(35, 48, '2015-05-29 06:00:21', 0),
(1, 49, '2015-05-29 07:02:19', 0),
(4, 49, '2015-05-29 07:02:19', 0),
(5, 49, '2015-05-29 07:02:19', 0),
(59, 49, '2015-05-29 07:02:19', 1),
(1, 51, '2015-05-31 18:51:26', 0),
(2, 51, '2015-05-31 18:51:26', 0),
(4, 51, '2015-05-31 18:51:25', 1),
(5, 51, '2015-05-31 18:51:26', 0),
(1, 52, '2015-05-31 18:52:37', 0),
(2, 52, '2015-05-31 18:52:37', 0),
(4, 52, '2015-05-31 18:52:36', 1),
(5, 52, '2015-05-31 18:52:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `idNote` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(500) NOT NULL,
  `created_On` datetime NOT NULL,
  `last_Edited_On` datetime NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idNote`),
  UNIQUE KEY `idNote_UNIQUE` (`idNote`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`idNote`, `text`, `created_On`, `last_Edited_On`, `title`, `idUser`) VALUES
(1, 'Neki tamo textjksfnkjdsfkja', '2015-05-30 03:00:00', '2015-05-31 08:16:01', 'Prvi', 4),
(3, 'Ovo je important beleska iz grupe u kojoj je vbogdana', '2015-05-30 11:00:00', '2015-05-30 17:32:17', 'Grupna Important', 2),
(4, 'nije bogdanina beleska vec dulova', '2015-05-28 00:00:00', '2015-05-30 17:32:17', 'Dulova', 2),
(5, 'Hidden beleska koju je dule napravio grupna', '2015-05-21 08:00:00', '2015-05-22 15:00:00', 'Hidden Dule grupna', 2),
(7, 'Grupna dule napravio', '2015-05-13 00:00:00', '2015-05-30 23:02:06', 'Grupna not important', 2),
(8, 'personalna kasnije izmenjena', '2015-05-20 10:00:00', '2015-05-31 05:53:21', 'Personalna', 4),
(9, 'fsdjkjfkjasnkjnfkjdf', '2015-05-28 13:25:00', '2015-05-28 19:00:28', 'Personalna', 4),
(11, 'lkfvkldsfgm;slkdf', '2015-05-21 00:00:00', '2015-05-22 00:00:00', 'id11', 4),
(12, 'krgmvklfdgks;gsklm', '2015-05-18 00:00:00', '2015-05-25 00:00:00', 'id12', 4),
(13, 'ldskmflkadfkladvm', '2015-05-04 00:00:00', '2015-05-04 00:00:00', 'id13', 4),
(14, 'lkdfvmkadfl', '2015-05-04 00:00:00', '2015-05-04 00:00:00', 'id14', 4),
(15, 'kfdsnvkkdzfnvkldfs creator Dule', '2015-05-21 00:00:00', '2015-05-25 00:00:00', 'Nova id15 grupna', 2),
(17, 'najranija creator Dule', '2015-05-02 00:00:00', '2015-05-03 00:00:00', 'id17', 2),
(18, 'Test 3', '2015-06-01 05:52:32', '2015-06-01 05:52:32', 'Novaa', 4),
(19, 'ajde ddkjnskjdkvad', '2015-06-01 05:56:31', '2015-06-01 05:56:31', 'IDemooooo', 4),
(35, 'ajmo', '2015-06-01 06:34:01', '2015-06-01 06:34:01', 'Personalna nova', 4),
(36, 'idemo', '2015-06-01 06:34:48', '2015-06-01 06:34:48', 'Grupna nova', 4),
(37, 'probandsvnkjsdlkkds', '2015-06-01 07:09:22', '2015-06-01 07:09:22', 'personalna nova 2 proba', 4),
(38, 'fkm vkds vkdsf k', '2015-06-01 07:10:32', '2015-06-01 07:12:47', 'nova grupna grupa 10 proba', 4);

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE IF NOT EXISTS `reminder` (
  `idUser` int(11) NOT NULL,
  `idNote` int(11) NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `personal` tinyint(4) DEFAULT NULL,
  `mute` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idUser`,`idNote`),
  KEY `fkNote_idx` (`idNote`),
  KEY `fkUser_idx` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `link_Photo` varchar(45) DEFAULT NULL,
  `is_Admin` tinyint(1) NOT NULL,
  `note_Color` int(11) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `idUser_UNIQUE` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `nickname`, `email`, `link_Photo`, `is_Admin`, `note_Color`, `password`) VALUES
(1, 'aleksa93', 'aleksa@mail.com', '', 0, 1, '1234'),
(2, 'dule', 'dule@mail.com', '', 0, 1, '1234'),
(4, 'vbogdana', 'bveselinovic555@gmail.com', '', 0, 1, 'sifrab'),
(5, 'dulenba', 'dulenba@gmail.com', NULL, 0, 2, 'sifrad'),
(6, 'dulo', 'dulo@gjdfk.com', NULL, 0, 5, 'dulo'),
(15, 'dulooo', 'dulooo@fkjs.com', NULL, 0, 5, 'dulooo'),
(18, 'duleee', 'duleee@gjdfk.com', NULL, 0, 5, 'duleee'),
(35, 'dulence', 'dulence@fkjs.com', NULL, 0, 5, 'dulence'),
(43, 'duleee1', 'duleee1@gjdfk.com', NULL, 0, 5, 'duleee1'),
(44, 'duleee2', 'duleee2@gjdfk.com', NULL, 0, 5, 'duleee2'),
(50, 'duleee3', 'duleee3@gjdfk.com', NULL, 0, 5, 'duleee3'),
(51, 'duleee5', 'duleee5@gjdfk.com', NULL, 0, 5, 'duleee5'),
(55, 'duleee7', 'duleee7@gjdfk.com', NULL, 0, 5, 'duleee7'),
(58, 'duleee8', 'duleee8@gjdfk.com', NULL, 0, 5, 'duleee8'),
(59, 'username', 'username@email.com', '', 0, 1, 'password');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `fkIdUser_Gr` FOREIGN KEY (`id_Creator`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_note`
--
ALTER TABLE `group_note`
  ADD CONSTRAINT `fkEditor_GN` FOREIGN KEY (`last_Editor`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkGroup_GN` FOREIGN KEY (`id_Group`) REFERENCES `group` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkNote_GN` FOREIGN KEY (`idNote`) REFERENCES `note` (`idNote`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hidden_note`
--
ALTER TABLE `hidden_note`
  ADD CONSTRAINT `fkNote_CN` FOREIGN KEY (`idNote`) REFERENCES `group_note` (`idNote`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkUser_CN` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `important`
--
ALTER TABLE `important`
  ADD CONSTRAINT `fkNote_Fav` FOREIGN KEY (`idNote`) REFERENCES `note` (`idNote`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkUser_Fav` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ismember`
--
ALTER TABLE `ismember`
  ADD CONSTRAINT `fkGroup_IM` FOREIGN KEY (`id_Group`) REFERENCES `group` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkUser_IM` FOREIGN KEY (`id_User`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reminder`
--
ALTER TABLE `reminder`
  ADD CONSTRAINT `fkNote_RM` FOREIGN KEY (`idNote`) REFERENCES `note` (`idNote`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkUser_RM` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
