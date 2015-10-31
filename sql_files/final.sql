-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2015 at 11:26 PM
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
(19, 'TBlocks', 'Match up images to the correct words as fast as possible...<br/>A combination of random te reo words and english words, levels get faster and words get harder <strong>play now!</strong>', 'index.html', 'images/title_image.png', 'Luke Hardiman', 'tblocks', '2015-10-30 23:24:38', '2015-09-24 10:33:43'),
(20, 'Guess Te Reo Maori', 'Based off the very popular game 4 Pics 1 Word, can you guess the Te Reo Maori puzzles that are waiting for you. Use the four images to try guess what the word could be, but if you get stuck you can always use the hint button to get the english word.', 'index.php', 'src/img/guessTeReoLogo.jpg', 'Carl Blance', 'GuessTeReo', '2015-10-30 23:24:38', '2015-09-24 10:33:43'),
(21, 'HangiMan', 'Keep the Hangi going by correctly guessing the right word!', 'index.php', 'images/logo.png', 'Nikolai Allen', 'gameHangiman', '2015-10-30 23:24:38', '2015-09-24 10:33:43'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=57 ;

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
(34, 28, '202.20.5.108', 0, 0, 0, '2', NULL, NULL),
(35, 8, '122.61.18.251', 0, 0, 0, NULL, NULL, NULL),
(36, 27, '0.0.0.0', 0, 0, 0, '2', NULL, NULL),
(37, 31, '0.0.0.0', 1, 0, 0, '2', NULL, NULL),
(38, 27, '202.2.11.40', 0, 0, 0, NULL, NULL, NULL),
(39, 29, '202.2.11.40', 0, 0, 0, NULL, NULL, NULL),
(40, 34, '202.20.5.108', 1, 0, 0, '2', NULL, NULL),
(41, 28, '122.62.57.122', 0, 0, 0, '2', NULL, NULL),
(42, 34, '122.62.57.122', 1, 0, 0, '2', NULL, NULL),
(43, 35, '122.62.57.122', 0, 0, 0, NULL, NULL, NULL),
(44, 29, '122.62.57.122', 0, 0, 0, NULL, NULL, NULL),
(45, 29, '122.56.204.32', 0, 0, 0, NULL, NULL, NULL),
(46, 8, '222.153.55.207', 0, 0, 0, NULL, NULL, NULL),
(47, 7, '222.153.55.207', 0, 0, 0, NULL, NULL, NULL),
(48, 29, '122.56.204.91', 0, 0, 0, NULL, NULL, NULL),
(49, 36, '101.100.138.6', 0, 0, 0, NULL, NULL, NULL),
(50, 8, '49.224.84.165', 0, 0, 0, NULL, NULL, NULL),
(51, 37, '49.224.84.165', 0, 0, 0, NULL, NULL, NULL),
(52, 28, '49.224.104.234', 0, 0, 0, NULL, NULL, NULL),
(53, 29, '49.224.104.234', 0, 0, 0, NULL, NULL, NULL),
(54, 38, '202.20.5.108', 0, 0, 0, NULL, NULL, NULL),
(55, 37, '49.224.105.146', 0, 0, 0, NULL, NULL, NULL),
(56, 28, '122.56.210.198', 0, 0, 0, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `username`, `created_at`, `updated_at`, `feathers_earned`, `experience`) VALUES
(7, 'nik.allen101@gmail.com', '$2y$10$SMwAO18AKm8u4KZ9FM3Xw.84/ts4pKJTQSltKBJqgqrKppO7Sfpju', NULL, 1, NULL, NULL, '2015-10-30 16:29:46', '$2y$10$siSmLJ8U1V8n6Nicf4J1h.Kei8jDTcKACMUu7qmCAden8NZaWiMZu', NULL, NULL, NULL, 'test3', '2', '2', 341, 2),
(8, 'tester@tester.com', '$2y$10$k7T7Mb8e1Ent8kTRUtLKCuJbkT2qhmi28DSDYEpp9PUBJBPoiTu.O', NULL, 1, NULL, NULL, '2015-10-30 17:22:56', '$2y$10$CYmpBszBHPYrfo3hd9MkR.YwumLo/7xi6OzNWNyWSr18FN.M4u3Em', NULL, NULL, NULL, 'tester', '2', '2', 27, 13),
(27, 'test5@test.com', '$2y$10$qbz95pZulZ9wVh05NQJOB.qs9AcEFafT1Enpe.vniNEGFXZ4.UDXa', NULL, 1, NULL, NULL, '2015-10-27 12:46:03', '$2y$10$OmEpAinm9J7SuKx8juITfuUJLQeVpTBoPG52AJvejeUr3WSxaegYG', NULL, NULL, NULL, 'test5', '2', '2', 0, 10),
(28, 'carl.blance@live.com', '$2y$10$3aJmcfY22zUCRtx/ZnkoX.dGZEiFg7aV1qw1vjihIVpaIOgRNYqMK', NULL, 1, NULL, NULL, '2015-10-30 19:26:52', '$2y$10$fzb2tPtf19pTIynwbRuEW.WPG4vBTA1GJCfhk4lgLIrzW3es.sL3W', NULL, NULL, NULL, 'lxPuRgExl', '2', '2', 19, 42),
(29, 'admin@admin.com', '$2y$10$t065QaCEq9unxHT4DSb8fOqf9vrhNKjUixzVj1kE87n6VVW0dyFqS', NULL, 1, NULL, NULL, '2015-10-30 23:23:52', '$2y$10$o/ohJKm6/zd4ru6Kjs3yhO53hp7uTGq3C7LrAvumoDr/rqcEaONL6', NULL, NULL, NULL, 'admin', '2', '2', 1, 22),
(30, 'raylene@ngatitoa.iwi.nz', '$2y$10$gyJspha8Mi7VoadX/5jho.oh9my87PBVwikfOgNYWyvcIqWVOuFz2', NULL, 1, NULL, NULL, '2015-10-22 10:33:42', '$2y$10$gRJSTwN8v.4wl3CFrNbleOJAeEmsQsPYY.kxfwcOvnNWmVFJWmRTS', NULL, NULL, NULL, 'raylenebishop', '2', '2', 0, 0),
(31, 'tester7@tester.com', '$2y$10$uiAp.qi/1Ik9b9duJqK8F.Pr8VOTjRaw7uKUCLIJnf6aaHXHxXelq', NULL, 1, NULL, NULL, '2015-10-26 15:42:11', '$2y$10$s/zMcfARe346K9O.s8iZauvlUVzi/Ehdf7SAiAIoSNbSzezprmOWu', NULL, NULL, NULL, 'test7', '2', '2', 0, 0),
(32, 'test8@test.com', '$2y$10$7WfxQOlFkl3NHVcKi0Y.A.WnnB1woV1BvUYYd7waD.hhchM2Q5a/m', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test8', '2', '2', 0, 0),
(33, 'test9@test.com', '$2y$10$ZoeaGqySwYeJArsIa2JlCeUD3h8c4cR2PbzsS65mNmBSljwpwZrvi', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test9', '2', '2', 0, 0),
(34, 'test@test.com', '$2y$10$0CzIjFZQ//q0XX20V47cdudOZT9OoUIqvlP6jS9UP8Zvt5gRY01ni', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tester6', '2', '2', 0, 0),
(35, 'xpurgex@gmail.com', '$2y$10$2gJzDB//5uSBrDv9eLbKQOkZgATahCawjc8HDFS3br0cNw0zbacSS', NULL, 1, NULL, NULL, '2015-10-30 05:57:30', '$2y$10$IOuhmk0BWhnkgklDNp8KpO2ZPFXNBgGOKfhVuC57tGfrOHSxLzUpK', NULL, NULL, NULL, 'yoloswagger', '2', '2', 0, 0),
(36, 'luke@hardiman.co.nz', '$2y$10$4dD0MfELFZJIsTBLTi0H6.ahT2dXmxpU0kH5Rcq9goimcskvAMpSO', NULL, 1, NULL, NULL, '2015-10-30 01:27:54', '$2y$10$S7vOZ3/fUkM7GnLxWN.qg.WtE5KcfXHc5omLIt2rzbRgMKWceOsn2', NULL, NULL, NULL, 'lukesubuntu', '2', '2', 0, 0),
(37, 'fh@fh.com', '$2y$10$oOOSK9aQIRuIKxtHM2UoSOIvWMp7x/gd0I5iDEOctV0rjRpjl.22W', NULL, 1, NULL, NULL, '2015-10-30 14:15:36', '$2y$10$Trrnvm9lMbtXS47iPPWpVeg/NB6J1OzcI4GZeca1rBfLLZs1kx4NC', NULL, NULL, NULL, 'fh', '2', '2', 0, 1),
(38, 'test10@test.com', '$2y$10$aqvPEPboQOSgZF6SO5KmSOdj151v.0JgcvBFkqxKFghmaU382.Zk.', NULL, 1, NULL, NULL, '2015-10-30 11:12:50', '$2y$10$K5TmF8vvvyDn249j0VxdJeluvn0lsH.W1u0uVAhtk7jWdlSSgLvQ.', NULL, NULL, NULL, 'test10', '2', '2', 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(2, 29, 1),
(3, 30, 1);

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
(19, 4, 7),
(19, 750, 8),
(19, 5, 27),
(19, 1150, 28),
(19, 100, 29),
(19, 222, 34),
(20, 56, 7),
(20, 56, 8),
(21, 56, 7),
(21, 585, 8),
(21, 22, 34);

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE IF NOT EXISTS `words` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `mri_word` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `eng_word` text NOT NULL,
  `img_src1` text,
  `word_desc` text,
  `img_src2` text,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`index`, `mri_word`, `eng_word`, `img_src1`, `word_desc`, `img_src2`) VALUES
(2, 'kia ora', 'hello', 'http://toa.devlab.ac.nz/public/assets/imgs/2_img_src1_.gif', 'When two or people interact with each other, and the polite thing is to say Hello', 'http://toa.devlab.ac.nz/public/assets/imgs/2_img_src2_.jpg'),
(3, 'pounemu', 'green stone', 'http://toa.devlab.ac.nz/public/assets/imgs/3_img_src1_.jpg', 'PLACEHOLDER DESCRIPTION', 'http://toa.devlab.ac.nz/public/assets/imgs/3_img_src2_.jpg'),
(4, 'haupa', 'food', 'http://toa.devlab.ac.nz/public/assets/imgs/4_img_src1_.jpg', 'A substance that can be consumed', 'http://toa.devlab.ac.nz/public/assets/imgs/4_img_src2_.jpg'),
(5, 'iwi', 'tribe', 'http://toa.devlab.ac.nz/public/assets/imgs/5_img_src1_.jpg', 'A small to large group of people who belong in the same clan or team, for example Ngati Toa', 'http://toa.devlab.ac.nz/public/assets/imgs/5_img_src2_.jpg'),
(6, 'koha', 'gift', 'http://toa.devlab.ac.nz/public/assets/imgs/6_img_src1_.jpg', 'When you receive an item from someone', 'http://toa.devlab.ac.nz/public/assets/imgs/6_img_src2_.jpg'),
(7, 'koro', 'grandpa', 'http://toa.devlab.ac.nz/public/assets/imgs/7_img_src1_.jpg', 'A male elderly person', 'http://toa.devlab.ac.nz/public/assets/imgs/7_img_src2_.jpg'),
(8, 'tÄ“tÄ“ kura', 'chief', '', 'PLACEHOLDER DESCRIPTION', ''),
(10, 'motukÄ', 'car', 'http://toa.devlab.ac.nz/public/assets/imgs/10_img_src1_.jpg', 'A piece of metal thats welded together that rolls', 'http://toa.devlab.ac.nz/public/assets/imgs/10_img_src2_.jpg'),
(11, 'pÄ“pe', 'baby', 'http://toa.devlab.ac.nz/public/assets/imgs/11_img_src1_.jpg', 'PLACEHOLDER DESCRIPTION', 'http://toa.devlab.ac.nz/public/assets/imgs/11_img_src2_.jpg'),
(12, 'whakairo', 'carving', 'http://toa.devlab.ac.nz/public/assets/imgs/12_img_src1_.jpg', 'PLACEHOLDER DESCRIPTION', 'http://toa.devlab.ac.nz/public/assets/imgs/12_img_src2_.jpg'),
(13, 'rorohiko', 'computer', '', 'PLACEHOLDER DESCRIPTION', ''),
(14, 'taniwha', 'water monster', '', 'PLACEHOLDER DESCRIPTION', ''),
(15, 'kÅhiwihiwi', 'skeleton', 'http://toa.devlab.ac.nz/public/assets/imgs/15_img_src1_.jpg', 'The frame of a humans body', 'http://toa.devlab.ac.nz/public/assets/imgs/15_img_src2_.jpg'),
(16, 'wÄkÄinga', 'home', '', 'PLACEHOLDER DESCRIPTION', ''),
(17, 'whÄnau', 'family', 'http://toa.devlab.ac.nz/public/assets/imgs/17_img_src1_.jpg', 'PLACEHOLDER DESCRIPTION', 'http://toa.devlab.ac.nz/public/assets/imgs/17_img_src2_.png'),
(18, 'haere mai', 'welcomes', 'http://toa.devlab.ac.nz/public/assets/imgs/18_img_src1_.jpg', 'Welcoming people', 'http://toa.devlab.ac.nz/public/assets/imgs/18_img_src2_.jpg'),
(19, 'herengi', 'money', 'http://toa.devlab.ac.nz/public/assets/imgs/19_img_src1_.jpg', 'Currency that is used to purchase items, for example buying haupa', 'http://toa.devlab.ac.nz/public/assets/imgs/19_img_src2_.jpg'),
(20, 'tapu', 'forbidden', '', 'PLACEHOLDER DESCRIPTION', ''),
(21, 'ra', 'sun', 'http://toa.devlab.ac.nz/public/assets/imgs/21_img_src1_.jpg', 'PLACEHOLDER DESCRIPTION', 'http://toa.devlab.ac.nz/public/assets/imgs/21_img_src2_.jpg'),
(22, 'matÄ kai kutu', 'warrior', 'http://toa.devlab.ac.nz/public/assets/imgs/22_img_src1_.jpg', 'A brave or experienced soldier or fighter', 'http://toa.devlab.ac.nz/public/assets/imgs/22_img_src2_.jpg'),
(23, 'marae', 'courtyard', 'http://toa.devlab.ac.nz/public/assets/imgs/23_img_src1_.jpg', 'This is a meeting house especially for a social or ceremonial forum', 'http://toa.devlab.ac.nz/public/assets/imgs/23_img_src2_.jpg'),
(26, 'test', 'test', NULL, 'test', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_has_game`
--
ALTER TABLE `users_has_game`
  ADD CONSTRAINT `fk_users_has_game_game1` FOREIGN KEY (`game_game_id`) REFERENCES `game` (`game_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_game_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

