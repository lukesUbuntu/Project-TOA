-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2015 at 04:46 PM
-- Server version: 5.5.44
-- PHP Version: 5.4.43-1+deb.sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `toa`
--

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `game_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `description` text,
  `start_file` varchar(45) DEFAULT NULL,
  `logo` text NOT NULL,
  `author` varchar(45) DEFAULT NULL,
  `prefix` varchar(45) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`game_id`,`prefix`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`game_id`, `name`, `description`, `start_file`, `logo`, `author`, `prefix`, `updated_at`, `created_at`) VALUES
(19, 'TBlocks', 'Tblocks match up images and the correct words', 'index.html', 'images/title_image.png', 'Luke Hardiman', 'tblocks', '2015-10-28 16:45:04', '2015-09-24 10:33:43'),
(20, 'Guess the Te Reo Word', 'Based off the very popular game 4 Pics 1 Word, can you guess the Te Reo Maori puzzles that are waiting for you. Use the four images to try guess what the word could be, but if you get stuck you can always use the hint button to get the english word.', 'index.php', 'src/img/guessTeReoLogo.jpg', 'Carl Blance', 'GuessTeReo', '2015-10-28 16:45:04', '2015-09-24 10:33:43'),
(21, 'HangiMan', 'Keep the Hangi going by correctly guessing the right word!', 'index.php', 'images/logo.png', 'Nikolai Allen', 'gameHangiman', '2015-10-28 16:45:04', '2015-09-24 10:33:43'),
(22, 'Te Reo Adventures', 'Unavailable but coming soon', 'index.php', '', 'Unknown', 'TeReoAdventures', '2015-10-26 17:24:57', '2015-10-20 11:43:51');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'write', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE IF NOT EXISTS `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(4) NOT NULL DEFAULT '0',
  `banned` tinyint(4) NOT NULL DEFAULT '0',
  `last_attempt_at` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suspended_at` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banned_at` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(1, 2, '0.0.0.0', 0, 0, 0, NULL, NULL, NULL),
(2, 3, '202.2.10.2', 0, 0, 0, NULL, NULL, NULL),
(3, 4, '202.2.10.2', 0, 0, 0, NULL, NULL, NULL),
(4, 6, '202.20.5.108', 0, 0, 0, NULL, NULL, NULL),
(5, 2, '122.61.165.188', 1, 0, 0, '2', NULL, NULL),
(6, 5, '122.61.165.188', 0, 0, 0, NULL, NULL, NULL),
(7, 4, '202.20.5.108', 0, 0, 0, NULL, NULL, NULL),
(8, 7, '202.20.5.108', 0, 0, 0, NULL, NULL, NULL),
(9, 7, '202.2.11.40', 0, 0, 0, NULL, NULL, NULL),
(10, 4, '125.237.64.90', 0, 0, 0, NULL, NULL, NULL),
(11, 8, '202.20.5.108', 0, 0, 0, '2', NULL, NULL),
(12, 7, '163.47.21.96', 0, 0, 0, NULL, NULL, NULL),
(13, 7, '122.56.205.221', 0, 0, 0, NULL, NULL, NULL),
(14, 4, '49.224.71.136', 0, 0, 0, NULL, NULL, NULL),
(15, 4, '49.224.238.45', 0, 0, 0, NULL, NULL, NULL),
(16, 4, '163.47.21.61', 0, 0, 0, NULL, NULL, NULL),
(17, 8, '101.100.138.6', 0, 0, 0, '2', NULL, NULL),
(18, 7, '163.47.21.61', 0, 0, 0, NULL, NULL, NULL),
(19, 8, '163.47.21.65', 0, 0, 0, NULL, NULL, NULL),
(20, 7, '122.61.18.251', 0, 0, 0, NULL, NULL, NULL),
(21, 4, '122.61.166.233', 0, 0, 0, NULL, NULL, NULL),
(22, 4, '49.224.222.194', 0, 0, 0, NULL, NULL, NULL),
(23, 4, '202.2.11.40', 0, 0, 0, NULL, NULL, NULL),
(24, 8, '202.2.11.40', 0, 0, 0, NULL, NULL, NULL),
(25, 12, '202.20.5.108', 0, 0, 0, NULL, NULL, NULL),
(26, 27, '202.20.5.108', 0, 0, 0, NULL, NULL, NULL),
(27, 8, '122.56.200.6', 0, 0, 0, '2', NULL, NULL),
(28, 28, '122.61.166.233', 0, 0, 0, '2', NULL, NULL),
(29, 29, '101.100.138.6', 0, 0, 0, NULL, NULL, NULL),
(30, 29, '122.61.166.233', 0, 0, 0, '2', NULL, NULL),
(31, 29, '202.20.5.108', 0, 0, 0, '2', NULL, NULL),
(32, 30, '202.20.5.108', 0, 0, 0, NULL, NULL, NULL),
(33, 28, '49.224.196.129', 0, 0, 0, NULL, NULL, NULL),
(34, 28, '202.20.5.108', 0, 0, 0, NULL, NULL, NULL),
(35, 8, '122.61.18.251', 0, 0, 0, NULL, NULL, NULL),
(36, 27, '0.0.0.0', 0, 0, 0, '2', NULL, NULL),
(37, 31, '0.0.0.0', 1, 0, 0, '2', NULL, NULL),
(38, 27, '202.2.11.40', 0, 0, 0, NULL, NULL, NULL),
(39, 29, '202.2.11.40', 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(4) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `feathers_earned` int(11) NOT NULL,
  `experience` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `username`, `created_at`, `updated_at`, `feathers_earned`, `experience`) VALUES
(7, 'nik.allen101@gmail.com', '$2y$10$SMwAO18AKm8u4KZ9FM3Xw.84/ts4pKJTQSltKBJqgqrKppO7Sfpju', NULL, 1, NULL, NULL, '2015-10-27 23:17:54', '$2y$10$6ossdstjMSZmeoJIdOn.GOxgM.ar3x/vpobkoYwtD6n93Ic2hmLfK', NULL, NULL, NULL, 'test3', '2', '2', 341, 0),
(8, 'tester@tester.com', '$2y$10$k7T7Mb8e1Ent8kTRUtLKCuJbkT2qhmi28DSDYEpp9PUBJBPoiTu.O', NULL, 1, NULL, NULL, '2015-10-27 12:50:23', '$2y$10$LkwlVtreNFGfOjy8iIoBE.Ag4Kp/cwv0psw8euTOsRTIKwwf83JXm', NULL, NULL, NULL, 'tester', '2', '2', 16, 0),
(27, 'test5@test.com', '$2y$10$qbz95pZulZ9wVh05NQJOB.qs9AcEFafT1Enpe.vniNEGFXZ4.UDXa', NULL, 1, NULL, NULL, '2015-10-27 12:46:03', '$2y$10$OmEpAinm9J7SuKx8juITfuUJLQeVpTBoPG52AJvejeUr3WSxaegYG', NULL, NULL, NULL, 'test5', '2', '2', 0, 10),
(28, 'carl.blance@live.com', '$2y$10$3aJmcfY22zUCRtx/ZnkoX.dGZEiFg7aV1qw1vjihIVpaIOgRNYqMK', NULL, 1, NULL, NULL, '2015-10-28 16:35:41', '$2y$10$dfPE5AQTVKnAYKGubuil/eEL0PvjIY3jE00fod.1lzihtHE8cXe0i', NULL, NULL, NULL, 'lxPuRgExl', '2', '2', 0, 2),
(29, 'admin@admin.com', '$2y$10$t065QaCEq9unxHT4DSb8fOqf9vrhNKjUixzVj1kE87n6VVW0dyFqS', NULL, 1, NULL, NULL, '2015-10-28 14:21:33', '$2y$10$lwJMkHjDFMpehgDuADXc2ObmSn0Fg0DK2ItkVGB2dhHUKuIB2imhu', NULL, NULL, NULL, 'admin', '2', '2', 0, 3),
(30, 'raylene@ngatitoa.iwi.nz', '$2y$10$gyJspha8Mi7VoadX/5jho.oh9my87PBVwikfOgNYWyvcIqWVOuFz2', NULL, 1, NULL, NULL, '2015-10-22 10:33:42', '$2y$10$gRJSTwN8v.4wl3CFrNbleOJAeEmsQsPYY.kxfwcOvnNWmVFJWmRTS', NULL, NULL, NULL, 'raylenebishop', '2', '2', 0, 0),
(31, 'tester7@tester.com', '$2y$10$uiAp.qi/1Ik9b9duJqK8F.Pr8VOTjRaw7uKUCLIJnf6aaHXHxXelq', NULL, 1, NULL, NULL, '2015-10-26 15:42:11', '$2y$10$s/zMcfARe346K9O.s8iZauvlUVzi/Ehdf7SAiAIoSNbSzezprmOWu', NULL, NULL, NULL, 'test7', '2', '2', 0, 0),
(32, 'test8@test.com', '$2y$10$7WfxQOlFkl3NHVcKi0Y.A.WnnB1woV1BvUYYd7waD.hhchM2Q5a/m', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test8', '2', '2', 0, 0),
(33, 'test9@test.com', '$2y$10$ZoeaGqySwYeJArsIa2JlCeUD3h8c4cR2PbzsS65mNmBSljwpwZrvi', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test9', '2', '2', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 8, 1),
(2, 29, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_has_game`
--

CREATE TABLE IF NOT EXISTS `users_has_game` (
  `game_game_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_score` int(11) DEFAULT NULL,
  `users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`game_game_id`,`users_id`),
  KEY `fk_users_has_game_game1_idx` (`game_game_id`),
  KEY `fk_users_has_game_users1_idx` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `users_has_game`
--

INSERT INTO `users_has_game` (`game_game_id`, `game_score`, `users_id`) VALUES
(19, 150150, 7),
(19, 800, 8),
(19, 250250, 27),
(20, 10000, 7),
(20, 400, 8),
(21, 32727, 7),
(21, 7000, 8);

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE IF NOT EXISTS `words` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `mri_word` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `eng_word` text NOT NULL,
  `img_src` text,
  `word_desc` text,
  `audio_src` text,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`index`, `mri_word`, `eng_word`, `img_src`, `word_desc`, `audio_src`) VALUES
(2, 'kia ora', 'hello', '', '', ''),
(3, 'pounemu', 'green stone', '', '', ''),
(4, 'haupa', 'food', '', '', ''),
(5, 'iwi', 'tribe', '', '', ''),
(6, 'koha', 'gift', '', '', ''),
(7, 'koro', 'grandpa', '', '', ''),
(8, 'tētē kura', 'chief', '', '', ''),
(10, 'motukā', 'car', '', '', ''),
(11, 'pēpe', 'baby', '', '', ''),
(12, 'whakairo', 'carving', '', '', ''),
(13, 'rorohiko', 'computer', '', '', ''),
(14, 'taniwha', 'water monster', '', '', ''),
(15, 'kōhiwihiwi', 'skeleton', '', '', ''),
(16, 'wākāinga', 'home', '', '', ''),
(17, 'whānau', 'family', '', '', ''),
(18, 'haere mai', 'welcome', '', 'test', ''),
(19, 'herengi', 'money', '', '', ''),
(20, 'tapu', 'forbidden', '', '', ''),
(21, 'ra', 'sun', '', '', ''),
(22, 'matā kai kutu', 'warrior', '', '', ''),
(23, 'marae', 'courtyard', '', '', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_has_game`
--
ALTER TABLE `users_has_game`
  ADD CONSTRAINT `fk_users_has_game_game1` FOREIGN KEY (`game_game_id`) REFERENCES `game` (`game_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_game_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
