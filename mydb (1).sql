-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2015 at 05:55 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE IF NOT EXISTS `favourite` (
  `idUser` int(11) NOT NULL,
  `idNote` int(11) NOT NULL,
  PRIMARY KEY (`idUser`,`idNote`),
  KEY `fkUser_idx` (`idUser`),
  KEY `fkNote_idx` (`idNote`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

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
(49, 'grupa', 59, '2015-05-29 07:02:19');

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
(3, 2, '0', 14);

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
(3, 2);

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
(59, 49, '2015-05-29 07:02:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `idNote` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(500) NOT NULL,
  `created_On` datetime NOT NULL,
  `last_Edited_On` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(45) DEFAULT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idNote`),
  UNIQUE KEY `idNote_UNIQUE` (`idNote`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`idNote`, `text`, `created_On`, `last_Edited_On`, `title`, `idUser`) VALUES
(1, 'Neki tamo textjksfnkjdsfkja', '2015-05-30 03:00:00', '2015-05-30 17:32:17', 'Prvi', 4),
(2, 'ksfjdskfjkdsnvkjdsnvjk', '2015-05-30 10:00:00', '2015-05-30 17:32:17', 'Drugi', 4),
(3, 'Ovo je beleska iz grupe u kojoj je vbogdana', '2015-05-30 11:00:00', '2015-05-30 17:32:17', 'Grupna', 2),
(4, 'nije bogdanina beleska vec dulova', '2015-05-28 00:00:00', '2015-05-30 17:32:17', 'Dulova', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE IF NOT EXISTS `reminder` (
  `idUser` int(11) NOT NULL,
  `idNote` int(11) NOT NULL,
  `datetime` datetime DEFAULT NULL,
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
  `nickname` varchar(45) NOT NULL,
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
-- Constraints for table `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `fkNote_Fav` FOREIGN KEY (`idNote`) REFERENCES `note` (`idNote`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkUser_Fav` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `ismember`
--
ALTER TABLE `ismember`
  ADD CONSTRAINT `fkGroup_IM` FOREIGN KEY (`id_Group`) REFERENCES `group` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkUser_IM` FOREIGN KEY (`id_User`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reminder`
--
ALTER TABLE `reminder`
  ADD CONSTRAINT `fkNote_RM` FOREIGN KEY (`idNote`) REFERENCES `note` (`idNote`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkUser_RM` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
