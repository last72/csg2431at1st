-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2018 at 10:45 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movietalkat1`
--

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE `discussion` (
  `discussion_id` int(5) NOT NULL,
  `movie_id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `content` varchar(500) NOT NULL,
  `post_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discussion`
--

INSERT INTO `discussion` (`discussion_id`, `movie_id`, `username`, `content`, `post_date`) VALUES
(1, 1, 'asmith', 'This movie is good', '2018-08-07 15:00:00'),
(2, 1, 'jbloggs', 'This movie is not good', '2018-08-07 17:00:00'),
(3, 2, 'jbloggs', 'I like this movie', '2018-08-07 18:00:00'),
(4, 3, 'jbloggs', 'I hate this movie', '2018-08-07 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(5) NOT NULL,
  `movie_name` varchar(50) NOT NULL,
  `release_year` int(4) NOT NULL,
  `director` varchar(50) NOT NULL,
  `writers` varchar(50) NOT NULL,
  `duration` int(4) NOT NULL,
  `summary` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_name`, `release_year`, `director`, `writers`, `duration`, `summary`) VALUES
(1, 'Jaws 2', 1978, 'Jeannot Szwarc', 'Peter Benchler, Carl Gottlieb', 116, 'Years after the shark attacks that left Amity Island reeling, Sheriff Martin Brody (Roy Scheider) finds new trouble lurking in the waters. Mayor Vaughn (Murray Hamilton) wants to rid the beach town of the stain on its reputation.'),
(2, 'Inception', 2010, 'Christoper Nolan', 'Christoper Nolan', 148, 'Dom Cobb (Leonardo DiCaprio) is a thief with the rare ability to enter people\'s dreams and steal their secrets from their subconscious. His skill has made him a hot commodity in the world of corporate espionage but has also cost him everything he loves.'),
(3, 'Avartar', 2009, 'James Cameron', 'James Cameron', 162, 'On the lush alien world of Pandora live the Na\'vi, beings who appear primitive but are highly evolved. Because the planet\'s environment is poisonous, human/Na\'vi hybrids, called Avatars, must link to human minds to allow for free movement on Pandora.');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `movie_id` int(5) NOT NULL,
  `username` varchar(100) NOT NULL,
  `rating` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`movie_id`, `username`, `rating`) VALUES
(1, 'asmith', 6),
(1, 'jbolggs', 8),
(2, 'jbloggs', 4),
(3, 'jbloggs', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `real_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birth_year` int(4) UNSIGNED NOT NULL,
  `country` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `access_level` varchar(10) NOT NULL,
  `banned_until` datetime DEFAULT NULL,
  `ban_reason` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `real_name`, `email`, `birth_year`, `country`, `password`, `access_level`, `banned_until`, `ban_reason`) VALUES
('1', '', '', 0, '', '1', 'member', '0000-00-00 00:00:00', ''),
('2', '', '', 0, '', '2', 'admin', '0000-00-00 00:00:00', ''),
('3', '3 is number', 'a@a.com', 1999, '3', '3', 'moderator', '0000-00-00 00:00:00', ''),
('adams', 'Kushal', 'kushalp169@gmail.com', 1994, 'United States', 'admas', 'Admin', '0000-00-00 00:00:00', ''),
('admin', 'admin', '11@a.com', 1998, 'United States', '$2y$10$l.QqVO3NUVweKk58XvHviu.Mv7f.ApjTJx7wh4YO6tS', 'member', '0000-00-00 00:00:00', ''),
('asmith', 'Adam Smith', 'smitho@gmail.com', 1984, '', 'abc123', 'member', '0000-00-00 00:00:00', ''),
('editor', 'editor', '11@a.com', 1998, 'United States', '$2y$10$YbSch4indqWY8FSA81ykU.MV3Qgkb6SXL/S45aPGrg4', 'member', '0000-00-00 00:00:00', ''),
('jbloggs', 'Joe Bloggs', 'Howard', 1990, 'Australia', 'swordfish99', 'member', '0000-00-00 00:00:00', ''),
('member', 'member is my', '11@a.com', 2000, 'United States', '$2y$10$MOqlMDsvJqzfwkskKq5EPO0rV6Je9hEfwnA90VDcXBe', 'moderator', '0000-00-00 00:00:00', '');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`discussion_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`movie_id`,`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `discussion_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
