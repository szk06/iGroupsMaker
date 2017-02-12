-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 14, 2016 at 10:03 AM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL,
  `ques_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `adata` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL,
  `gname` varchar(15) NOT NULL,
  `gpassword` varchar(15) NOT NULL,
  `numofstud` int(11) NOT NULL,
  `coursename` varchar(45) NOT NULL,
  `groupmakerid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `groupid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `gpassword` varchar(15) DEFAULT NULL,
  `gname2` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `projectid` int(11) NOT NULL,
  `groupname` int(11) DEFAULT NULL,
  `coursename` varchar(45) DEFAULT NULL,
  `projectname` varchar(45) DEFAULT NULL,
  `projectdescription` longtext
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `asker` varchar(40) NOT NULL,
  `replies` int(11) NOT NULL DEFAULT '0',
  `qdata` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `signed`
--

CREATE TABLE IF NOT EXISTS `signed` (
  `id` int(11) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `student_id` varchar(9) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signed`
--

INSERT INTO `signed` (`id`, `Email`, `password`, `student_id`, `first_name`, `last_name`) VALUES
(1, 'szk06@mail.aub.edu', 'sami12', '201402427', 'Sami', 'Kanafani'),
(2, 'haj13@mail.aub.edu', 'hani12', '201403295', 'Hani', 'Jazzar'),
(3, 'email1@gmail.com', 'pass11', '201403291', 'Student1', 'LastName1'),
(4, 'email2@gmail.com', 'pass22', '201403292', 'Student2', 'LastName2'),
(5, 'email4@gmail.com', 'pass44', '201403294', 'Student4', 'LastName4'),
(6, 'email3@gmail.com', 'pass33', '201403293', 'Student3', 'LastName3'),
(7, 'admin@gmail.com', 'adminadmin', '999999999', 'Admin', 'Admin'),
(9, 'hs@gmail.com', 'haidar12', '999999998', 'Haidar', 'Safa'),
(10, 'ahmad@gmail.com', 'ahmad12', '201403298', 'Ahmad', 'Hamandi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gpassword_UNIQUE` (`gpassword`),
  ADD UNIQUE KEY `gname_UNIQUE` (`gname`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`groupid`,`studentid`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`projectid`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signed`
--
ALTER TABLE `signed`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `student_id_UNIQUE` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `projectid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `signed`
--
ALTER TABLE `signed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
