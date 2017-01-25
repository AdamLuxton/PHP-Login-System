-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2017 at 05:51 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logina`
--

CREATE TABLE `tbl_logina` (
  `login_id` smallint(5) UNSIGNED NOT NULL,
  `login_user` varchar(15) NOT NULL,
  `login_count` tinyint(4) NOT NULL,
  `login_time` varchar(11) NOT NULL,
  `login_ip` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_logina`
--

INSERT INTO `tbl_logina` (`login_id`, `login_user`, `login_count`, `login_time`, `login_ip`) VALUES
(3, 'aluxton', 10, '1484946854', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` smallint(5) UNSIGNED NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_lastLogin` varchar(40) DEFAULT NULL,
  `user_ip` varchar(20) DEFAULT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_status` tinyint(4) NOT NULL DEFAULT '1',
  `user_token` varchar(16) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_name`, `user_password`, `user_lastLogin`, `user_ip`, `user_email`, `user_status`, `user_token`) VALUES
(1, 'aluxton', 'password', '22nd of January, 2017', '::1', 'adam@luxtondesign.com', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_logina`
--
ALTER TABLE `tbl_logina`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_logina`
--
ALTER TABLE `tbl_logina`
  MODIFY `login_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
