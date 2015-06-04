-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2015 at 11:30 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`idGroup`, `name`, `id_Creator`, `created_On`) VALUES
(62, 'College', 4, '2015-06-03 20:01:04'),
(63, 'Highschool', 4, '2015-06-03 20:06:52'),
(64, 'Family', 4, '2015-06-03 20:50:23'),
(65, 'Friends', 4, '2015-06-03 20:52:31'),
(66, 'Hometown', 2, '2015-06-04 11:22:33');

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
(94, 4, '1', 62),
(96, 2, '0', 62),
(97, 3, '0', 62),
(98, 3, '0', 62),
(99, 1, '0', 62);

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

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `image` int(11) NOT NULL AUTO_INCREMENT,
  `product_pic` varchar(500) NOT NULL,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`image`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image`, `product_pic`, `title`) VALUES
(1, 'profilea.jpg', 'mracnivitez'),
(2, 'profilef.jpg', 'dulenba'),
(3, 'profiled.jpg', 'dule'),
(4, 'profilec.jpg', 'vbogdana'),
(5, 'profileb.jpg', 'marija'),
(6, 'profilee.jpg', 'cmiki');

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
(2, 95),
(4, 94),
(4, 98),
(4, 99),
(4, 100);

-- --------------------------------------------------------

--
-- Table structure for table `ismember`
--

CREATE TABLE IF NOT EXISTS `ismember` (
  `id_User` int(11) NOT NULL,
  `id_Group` int(11) NOT NULL,
  `joined_On` datetime NOT NULL,
  `is_Admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_Group`,`id_User`),
  KEY `fkUser_idx` (`id_User`),
  KEY `fkGroup_idx` (`id_Group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ismember`
--

INSERT INTO `ismember` (`id_User`, `id_Group`, `joined_On`, `is_Admin`) VALUES
(1, 62, '2015-06-03 20:01:04', 0),
(2, 62, '2015-06-03 20:01:04', 0),
(3, 62, '2015-06-03 20:01:04', 0),
(4, 62, '2015-06-03 20:01:04', 1),
(5, 62, '2015-06-03 20:01:04', 0),
(6, 62, '2015-06-03 20:01:05', 0),
(2, 63, '2015-06-03 20:06:52', 0),
(4, 63, '2015-06-03 20:06:52', 1),
(5, 63, '2015-06-03 20:06:52', 0),
(2, 64, '2015-06-03 20:50:23', 0),
(4, 64, '2015-06-03 20:50:23', 1),
(1, 65, '2015-06-03 20:52:31', 0),
(2, 65, '2015-06-03 20:52:31', 0),
(3, 65, '2015-06-03 20:52:31', 0),
(4, 65, '2015-06-03 20:52:31', 1),
(5, 65, '2015-06-03 20:52:31', 0),
(6, 65, '2015-06-03 20:52:31', 0),
(2, 66, '2015-06-04 11:22:34', 1),
(4, 66, '2015-06-04 11:22:34', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`idNote`, `text`, `created_On`, `last_Edited_On`, `title`, `idUser`) VALUES
(93, 'Dentist''s appointment Monday at 5:00 PM. Buy 3 lollipops. :)', '2015-06-03 19:58:19', '2015-06-03 19:58:19', 'My first personal note', 4),
(94, 'Hey guys, I think this is a very good way for us to keep in touch and manage our mutual tasks. Hope you''ll like it, check it out and post your impressions! :)', '2015-06-03 20:05:42', '2015-06-03 20:05:49', 'Welcome to our Group', 4),
(95, '1. Avengers Age of Ultron\n2. Testament of Youth\n3. Hunger Games Mockingjay Part II\n4. Birdman\n5. The Age of Adaline\n6. Chappie', '2015-06-03 20:10:54', '2015-06-03 20:10:54', 'Movies to watch in 2015', 2),
(96, 'Wow, this is great! I''m really glad you pointed out this cool web site. Hopefully now we can easily make arrangements, organize are chores, and what is most important - never forget to sign up our exams!!! Hahaha...', '2015-06-03 20:15:26', '2015-06-03 20:15:26', 'Well Hello as Well', 2),
(97, 'Hey guys, I don''t know if you have read the email. The deadline for turning over our implementation is Friday the 10th. Hope we will make it :)\nI will send you the assignments by tomorrow evening. In the meantime, everyone can express their desires. :)\n--- Edit by Dule\nWoohoo the deadline is postponed for June 15th!! :D', '2015-06-03 20:22:02', '2015-06-07 16:27:14', 'Project deadline', 1),
(98, 'People, let''s relax a little bit and enjoy for tonight! My place at 9 o''clock. Don''t forget to buy beer and chips! Who forgets buys me a drink at the Pub! :D\n\nSee you tonight! :D', '2015-06-03 20:29:39', '2015-06-05 13:38:47', 'Nightout', 3),
(99, 'Guys, last night was awesome! We have to repeat it! :D\n\nBut, by then, I need all of you to concentrate on the project.\nvbogdana - database and models\ndulenba - panels\nnatasa - board\ncmiki - notifications\n\nHere we go guys, good luck!', '2015-06-03 20:33:45', '2015-06-04 19:14:07', 'Assignments', 1),
(100, 'Anyone wants to go to the movies tonight? Reply here :D', '2015-06-03 20:36:29', '2015-06-11 09:51:32', 'Movies tonight', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `idNotification` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idGroup` int(11) NOT NULL,
  `content` varchar(100) DEFAULT NULL,
  `created_On` datetime DEFAULT NULL,
  PRIMARY KEY (`idNotification`),
  KEY `fkGroup_idx` (`idGroup`),
  KEY `fkUser_idx` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`idNotification`, `idUser`, `idGroup`, `content`, `created_On`) VALUES
(18, 2, 62, 'You were added to the group College 2015-06-03 20:01:04.', '2015-06-03 20:01:04'),
(19, 5, 62, 'You were added to the group College 2015-06-03 20:01:04.', '2015-06-03 20:01:04'),
(20, 3, 62, 'You were added to the group College 2015-06-03 20:01:04.', '2015-06-03 20:01:04'),
(21, 1, 62, 'You were added to the group College 2015-06-03 20:01:04.', '2015-06-03 20:01:04'),
(22, 6, 62, 'You were added to the group College 2015-06-03 20:01:05.', '2015-06-03 20:01:05'),
(23, 2, 63, 'You were added to the group Highschool 2015-06-03 20:06:52.', '2015-06-03 20:06:52'),
(24, 5, 63, 'You were added to the group Highschool 2015-06-03 20:06:52.', '2015-06-03 20:06:52'),
(26, 2, 64, 'You were added to the group Family 2015-06-03 20:50:23.', '2015-06-03 20:50:23'),
(27, 3, 65, 'You were added to the group Friends 2015-06-03 20:52:31.', '2015-06-03 20:52:31'),
(28, 2, 65, 'You were added to the group Friends 2015-06-03 20:52:31.', '2015-06-03 20:52:31'),
(29, 5, 65, 'You were added to the group Friends 2015-06-03 20:52:31.', '2015-06-03 20:52:31'),
(30, 1, 65, 'You were added to the group Friends 2015-06-03 20:52:31.', '2015-06-03 20:52:31'),
(31, 6, 65, 'You were added to the group Friends 2015-06-03 20:52:31.', '2015-06-03 20:52:31');

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE IF NOT EXISTS `reminder` (
  `idUser` int(11) NOT NULL,
  `idNote` int(11) NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `personal` tinyint(4) NOT NULL,
  `mute` tinyint(4) DEFAULT NULL,
  `seen` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUser`,`idNote`,`personal`),
  KEY `fkNote_idx` (`idNote`),
  KEY `fkUser_idx` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`idUser`, `idNote`, `datetime`, `personal`, `mute`, `seen`) VALUES
(1, 97, '2015-06-04 15:00:00', 0, 0, 0),
(1, 97, '2015-06-04 17:00:00', 1, 0, 0),
(1, 98, '2015-06-08 19:30:00', 0, 0, 0),
(1, 99, '2015-06-08 12:00:00', 0, 0, 0),
(2, 97, '2015-06-04 15:00:00', 0, 0, 0),
(2, 97, '2015-06-04 11:25:00', 1, 0, 0),
(2, 98, '2015-06-08 19:30:00', 0, 0, 0),
(2, 99, '2015-06-08 12:00:00', 0, 0, 0),
(3, 97, '2015-06-04 15:00:00', 0, 0, 0),
(3, 98, '2015-06-08 19:30:00', 0, 0, 0),
(3, 99, '2015-06-08 12:00:00', 0, 0, 0),
(4, 93, '2015-06-08 15:20:00', 1, 0, 0),
(4, 97, '2015-06-04 15:00:00', 0, 0, 0),
(4, 98, '2015-06-08 19:30:00', 0, 0, 0),
(4, 99, '2015-06-08 12:00:00', 0, 0, 0),
(4, 100, '2015-06-11 21:05:00', 1, 0, 0),
(5, 97, '2015-06-04 15:00:00', 0, 0, 0),
(5, 98, '2015-06-08 19:30:00', 0, 0, 0),
(5, 99, '2015-06-08 12:00:00', 0, 0, 0),
(6, 97, '2015-06-04 15:00:00', 0, 0, 0),
(6, 98, '2015-06-08 19:30:00', 0, 0, 0),
(6, 99, '2015-06-08 12:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `is_Admin` tinyint(4) DEFAULT '0',
  `note_Color` varchar(6) DEFAULT 'FFFFFF',
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `idUser_UNIQUE` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `nickname`, `email`, `is_Admin`, `note_Color`, `password`) VALUES
(1, 'mracnivitez', 'mracnivitez@mail.com', 0, 'FFFAF0', '11111'),
(2, 'dulenba', 'dulenba@mail.com', 1, 'E3FFDA', '22222'),
(3, 'dule', 'dule@mail.com', 0, 'FFFFD1', '33333'),
(4, 'vbogdana', 'vbogdana@mail.com', 1, 'E9FFFF', '44444'),
(5, 'natasa', 'natasa@mail.com', 0, 'E9FFFF', '55555'),
(6, 'cmiki', 'cmiki@mail.com', 0, 'FFFFFF', '66666'),
(60, 'novikorisnik', 'novikorisnik@mail.com', 0, 'FFFFFF', '777777'),
(61, 'novikorisnik1', 'novikorisnik1@mail.com', 0, 'FFFFFF', '888888');

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
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `fkGroup_NT` FOREIGN KEY (`idGroup`) REFERENCES `group` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkUser_NT` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reminder`
--
ALTER TABLE `reminder`
  ADD CONSTRAINT `fkNote_RM` FOREIGN KEY (`idNote`) REFERENCES `note` (`idNote`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkUser_RM` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
