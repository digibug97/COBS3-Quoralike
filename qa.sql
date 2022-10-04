-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2021 at 10:18 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qa`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `questionid` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `questionid`, `text`, `username`) VALUES
(1, 1, 'Just one. Anymore is excessive, and could lead to issues.', 'darcy'),
(2, 1, 'Limit?! The more the better!', 'anne'),
(3, 1, 'Questions like this are the reason I hate this website. Q+A is supposed to be for asking genuine, intellectual questions, not fretting about what other think about the number of dogs you have. Want 1 dog? Get 1 dog. Want 10? Get 10.', 'bob');

-- --------------------------------------------------------

--
-- Table structure for table `answerlike`
--

CREATE TABLE `answerlike` (
  `answerid` int(11) NOT NULL,
  `username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answerlike`
--

INSERT INTO `answerlike` (`answerid`, `username`) VALUES
(2, 'anne'),
(2, 'bob'),
(2, 'shannon'),
(3, 'bob');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `body` varchar(255) NOT NULL,
  `username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `title`, `body`, `username`) VALUES
(1, 'How many puppies is an acceptable amount?', 'I want to purchase several small puppies, but I\'m not sure if this would be socially accepted. What\'s a suitable limit to enjoy the wonderful bundles of fluff without being an outcast?', 'shannon'),
(2, 'Test Question', 'This is another question', 'shannon');

-- --------------------------------------------------------

--
-- Table structure for table `questionlike`
--

CREATE TABLE `questionlike` (
  `questionid` int(11) NOT NULL,
  `username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questionlike`
--

INSERT INTO `questionlike` (`questionid`, `username`) VALUES
(1, 'anne'),
(1, 'bob'),
(1, 'charles'),
(1, 'shannon'),
(2, 'charles'),
(2, 'darcy');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `joindate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `joindate`) VALUES
('anne', '$2y$10$8kBDSRzZBAg2zk5GxZYoqeAZVCJBqTveqHtDRi1YPQCoeSOJZ2Sja', '0000-00-00'),
('bob', '$2y$10$xEFp5B/Vv.tEZvwRiDN4teXdeDLSrFg2oZZtsYZdT3o27AfJTkkAO', '0000-00-00'),
('charles', '$2y$10$4IIpQzN9VUTnj0IYDXFPxOuRrlw3JQSacSePVpMow.Na1iWCNRrG6', '0000-00-00'),
('darcy', '$2y$10$4L/5e2L2PohGThMI1o7cxe3LFJXc562yqQ.I51Lci97NW6MgOYF/C', '0000-00-00'),
('shannon', '$2y$10$I8qcrXx8bIBDDDhMrnUyP.H7iaK6VriHU5RMp4tgZ3nF5/6dWABbm', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answer_questionid` (`questionid`),
  ADD KEY `answer_username` (`username`);

--
-- Indexes for table `answerlike`
--
ALTER TABLE `answerlike`
  ADD PRIMARY KEY (`answerid`,`username`),
  ADD KEY `answerlike_username` (`username`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_username` (`username`);

--
-- Indexes for table `questionlike`
--
ALTER TABLE `questionlike`
  ADD PRIMARY KEY (`questionid`,`username`),
  ADD KEY `questionlike_username` (`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_questionid` FOREIGN KEY (`questionid`) REFERENCES `question` (`id`),
  ADD CONSTRAINT `answer_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `answerlike`
--
ALTER TABLE `answerlike`
  ADD CONSTRAINT `answerlike_answerid` FOREIGN KEY (`answerid`) REFERENCES `answer` (`id`),
  ADD CONSTRAINT `answerlike_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `questionlike`
--
ALTER TABLE `questionlike`
  ADD CONSTRAINT `questionlike_questionid` FOREIGN KEY (`questionid`) REFERENCES `question` (`id`),
  ADD CONSTRAINT `questionlike_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
