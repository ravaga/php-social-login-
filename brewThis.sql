-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 19, 2016 at 09:29 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brewThis`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `format` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `type`, `format`, `route`, `user`, `date`) VALUES
(1, 'profile_picture', 'image/jpeg', 'uploads/users/profile_pictures/profile_picture.rafa20160719103037.jpg', 35, '0000-00-00 00:00:00'),
(2, 'profile_picture', 'image/jpeg', 'uploads/users/profile_pictures/profile_picture.rafa20160719103131.jpg', 35, '2016-07-19 08:31:31'),
(3, 'profile_picture', 'image/jpeg', 'uploads/users/profile_pictures/profile_picture.rafa20160719103510.jpg', 35, '2016-07-19 08:35:10'),
(4, 'profile_picture', 'image/jpeg', 'uploads/users/profile_pictures/profile_picture.rafa20160719103704.jpg', 35, '2016-07-19 08:37:04'),
(5, 'profile_picture', 'image/jpeg', 'uploads/users/profile_pictures/profile_picture.rafa20160719103730.jpg', 35, '2016-07-19 08:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login_status` varchar(255) NOT NULL,
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `hash`, `email`, `login_status`, `user_id`) VALUES
(21, 'Mikanos', '$2y$10$dPDJCFkDzxa9mhjXeFefw.B9tKJj3j6LSWY7E1XydHfeYsgRoH1QC', 'miname@email.com', 'self', 0),
(22, 'b', '$2y$10$93hJj0VB3IjObpLJpvygr.acp43bTkTKdKHmr6OUIHwak3PKBKoVC', 'b', 'self', 0),
(23, 'trikanos', '$2y$10$oOAzEZiSZuZB/lzfj0cIB.2SLJLzOlsoTBjlMbrxyRdNWUjLLRTMW', 't', 'self', 0),
(24, 'trikanost', '$2y$10$ocT0zqcBlcdjGr5SkNVYcOuW72Iorb.Zmd1KA7yGaswhXhXPybXdy', 'troksn', 'self', 0),
(25, 'user1', '$2y$10$EzLLzkp.7mGaQaPrXsddzeheIDsCU2VTXEWxWZVhZQXnhBvmRbaUy', 'user', 'self', 0),
(26, 'rafackyou', '$2y$10$Qb1ax2tVGvMA7sUuox9QGu/1FB09RX8mRLEBdjinkG7M91bmuzqe2', 'rafa31v6@gmail.com', 'self', 0),
(27, 'hh', '$2y$10$XnNanQON8NnkRjKzC/S6m.4N/4FZyw7yKyREtQoh8MQVV.3gMGwNW', 'hh', 'self', 0),
(28, 'gfd', '$2y$10$2nfMtu203WGfXNaJcVBXaOFyQkfYBydF2YTZr9BYLXprpskOCTqqu', 'dfg', 'self', 0),
(29, 'tre', '$2y$10$9jI8.wUb3LVJ7GI0enQNLuJlsiqV0zFzh1rxC0m4ZKwY7ZYV6UNwW', 'ert', 'self', 0),
(30, 'qwe', '$2y$10$7LWYh/3rDUNnIvay3js46eip9P2zPtv4Z4EnBFWPPAS3xX3ISVIe2', 'qwe', 'self', 0),
(31, 'wer', '$2y$10$jbivKf2bRhcl6ZdbZoK8h.A5hcIxVmz8ir9U0lM6C0FsE54lHVWe2', 'wer', 'self', 0),
(32, 'ravaga', '$2y$10$scz3UA2Xf2BGRFb.M5kbuuwBCVswJ8zBdYsldChPMkSTOjOvMQGFu', 'ra', 'self', 0),
(33, '123', '$2y$10$6KNzFgEskYl87z2lGS52aO0VwSSRjLGP0GLdpmDMOkirQF5HhEUj2', '123', 'self', 0),
(34, '234', '$2y$10$tJM4zaTkQLK7vswkD8zIrOL7tltIeGba2q2VZmQ/MoczEgDeNL1wm', '234', 'self', 0),
(35, 'rafa', '$2y$10$9Jgw6cjpACzJw.WPZY95cuI8UOkOH2vvb.WXHHlZnbJfKVivh0.Qm', 'rafa@rafa.com', 'self', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
