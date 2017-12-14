-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2017 at 06:06 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bob`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `hashed_password` varchar(255) DEFAULT NULL,
  `isGlobalAdmin` tinyint(4) NOT NULL,
  `location` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `username`, `hashed_password`, `isGlobalAdmin`, `location`) VALUES
(1, 'Chris', 'Jasztrab', 'chris.jasztrab@mpl.on.ca', 'battleadmin', '$2y$10$UJM24GDgRoFd1M8vKAJ3z.gz8H13eEd6lQzzPoEts9hTvnjpR9oli', 1, 1),
(17, 'Halton', 'Hills', 'hhpl@hhpl.on.ca', 'hhpl', '$2y$10$8brrgGL5fYLvwiuXsTqYDO5MW5l95q/CGbL9rELJGPz9P/YXwoWBG', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `battle`
--

CREATE TABLE `battle` (
  `name` varchar(255) NOT NULL,
  `level` int(3) NOT NULL,
  `round` int(3) NOT NULL,
  `preamble` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `owner` int(3) NOT NULL,
  `creator` int(3) NOT NULL,
  `questions` text NOT NULL,
  `id` int(7) NOT NULL,
  `notes` varchar(4000) NOT NULL,
  `is_archived` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `battle`
--

INSERT INTO `battle` (`name`, `level`, `round`, `preamble`, `date_created`, `owner`, `creator`, `questions`, `id`, `notes`, `is_archived`) VALUES
('Battle of the Books 2018', 1, 0, 'This is the intro to the BOB', '2017-12-11 21:02:00', 5, 0, '', 25, 'Notes for the presenter', 0),
('MPL Jr Battle 2017', 1, 0, 'Preamble', '2017-12-11 23:50:24', 1, 0, '', 26, 'Notes', 0),
('Round Robin 1', 1, 0, 'this is the intro to the battle that will print on the sheet!', '2017-12-12 16:36:12', 1, 0, '', 27, 'The kids are great!', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `position` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `position`, `category`) VALUES
(3, 2, 'Classic'),
(4, 3, 'Mystery'),
(7, 4, 'Character'),
(8, 6, 'Award Winning'),
(10, 5, 'Canadian'),
(20, 1, 'Fantasy/SciFi'),
(21, 7, 'Folk/Fairy Tale'),
(22, 8, 'Myth/Legend'),
(23, 9, 'Popular'),
(24, 10, 'None Assigned'),
(25, 11, 'Horror'),
(26, 12, 'Action and Adventure'),
(27, 13, 'Historical Fiction'),
(28, 14, 'Genre'),
(29, 15, 'Graphic Novel'),
(30, 16, 'Humerious');

-- --------------------------------------------------------

--
-- Table structure for table `categories_v2`
--

CREATE TABLE `categories_v2` (
  `id` int(255) NOT NULL,
  `position` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories_v2`
--

INSERT INTO `categories_v2` (`id`, `position`, `category`) VALUES
(3, 3, 'Classic'),
(4, 4, 'Mystery'),
(7, 7, 'Character'),
(8, 8, 'Award Winning'),
(10, 10, 'Canadian'),
(20, 5, 'Fantasy/SciFi'),
(21, 3, 'Folk/Fairy Tale'),
(22, 6, 'Myth/Legend'),
(23, 2, 'Popular'),
(24, 10, 'None Assigned'),
(25, 11, 'Horror'),
(26, 12, 'Action and Adventure'),
(27, 13, 'Historical Fiction'),
(28, 14, 'Genre'),
(29, 15, 'Graphic Novel'),
(30, 16, 'Humerious');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(255) NOT NULL,
  `position` int(11) NOT NULL,
  `visible` int(11) NOT NULL,
  `level_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `position`, `visible`, `level_name`) VALUES
(1, 1, 1, 'Junior'),
(2, 2, 1, 'Senior'),
(4, 4, 1, 'None Chosen');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(4) NOT NULL,
  `location_name` varchar(255) DEFAULT NULL,
  `location_shortname` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_name`, `location_shortname`) VALUES
(1, 'Milton Public Library', 'MPL'),
(2, 'Oakville Public Library', 'OPL'),
(3, 'Burlington Public Library', 'BPL'),
(5, 'Halton Hills Public Library', 'HHPL');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `book_title` varchar(255) DEFAULT NULL,
  `question_text` varchar(10000) DEFAULT NULL,
  `question_answer` varchar(1000) DEFAULT NULL,
  `level` varchar(1000) DEFAULT NULL,
  `question_owner` int(3) DEFAULT NULL,
  `author_first_name` varchar(255) DEFAULT NULL,
  `author_last_name` varchar(255) DEFAULT NULL,
  `book_publication_year` int(4) DEFAULT NULL,
  `question_category` varchar(1000) DEFAULT NULL,
  `question_contributed_by` int(3) DEFAULT NULL,
  `last_edited_by` int(3) DEFAULT NULL,
  `public_or_private` tinyint(1) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notes` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `book_title`, `question_text`, `question_answer`, `level`, `question_owner`, `author_first_name`, `author_last_name`, `book_publication_year`, `question_category`, `question_contributed_by`, `last_edited_by`, `public_or_private`, `date_created`, `notes`) VALUES
(1, 'Ready Player One', 'What is the name of the main character?', 'Wade Watts', '2', 1, 'Ernest', 'Cline', 2015, '20', NULL, NULL, NULL, '2017-12-12 15:56:57', 'Being made into a movie'),
(2, 'Armada', 'What is the name of the video game store?', 'Star Base Ace', '2', 1, 'Ernest', 'Cline', 2015, '20', NULL, NULL, NULL, '2017-12-12 15:58:48', ''),
(3, 'IT', 'What is the name of the clown?', 'Pennywise', '2', 1, 'Stephen ', 'King ', 1978, '25', NULL, NULL, NULL, '2017-12-12 16:25:11', ''),
(4, 'Misery', 'Where does the book take place?', 'Castlerock', '2', 1, 'Stephen ', 'King ', 1995, '25', NULL, NULL, NULL, '2017-12-12 16:25:34', ''),
(5, 'Graveyard Shift', 'What is the poem in the book that gets repeated in the IT movie?', 'He thrusts his fists against the post and still insists he sees the ghosts.', '2', 1, 'Stephen ', 'King ', 1996, '28', NULL, NULL, NULL, '2017-12-12 16:26:26', ''),
(6, 'Diary of a Wimpy Kid', 'What is the main characters brothers name?', 'Rodrick', '1,2', 1, 'Jeff ', 'Kinney ', 2012, '23', NULL, NULL, NULL, '2017-12-12 16:35:39', 'New 2017');

-- --------------------------------------------------------

--
-- Table structure for table `round`
--

CREATE TABLE `round` (
  `id` int(3) NOT NULL,
  `round_name` varchar(255) NOT NULL,
  `round_preamble` varchar(1000) NOT NULL,
  `round_notes` varchar(1000) NOT NULL,
  `battle_id` int(7) NOT NULL,
  `round_questions` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `round`
--

INSERT INTO `round` (`id`, `round_name`, `round_preamble`, `round_notes`, `battle_id`, `round_questions`) VALUES
(30, '', '', '', 0, ''),
(31, '', '', '', 0, ''),
(32, '', '', '', 0, ''),
(33, '', '', '', 0, ''),
(34, 'Round 1', 'Preamble to this', 'Notes', 25, '51,52'),
(36, 'Round Robin 1', 'These questions will be blah!', 'None', 27, '2,5,1,3'),
(37, 'Round 2', 'PRE', 'NOTES', 27, '6,5');

-- --------------------------------------------------------

--
-- Table structure for table `round_questions`
--

CREATE TABLE `round_questions` (
  `id` int(11) NOT NULL,
  `round_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `round_questions`
--

INSERT INTO `round_questions` (`id`, `round_id`, `question_id`) VALUES
(36, 35, 1),
(37, 35, 2),
(38, 35, 3),
(39, 35, 4),
(40, 35, 5),
(41, 38, 4),
(42, 39, 6),
(43, 48, 6),
(51, 41, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_username` (`username`);

--
-- Indexes for table `battle`
--
ALTER TABLE `battle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories_v2`
--
ALTER TABLE `categories_v2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `round`
--
ALTER TABLE `round`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `round_questions`
--
ALTER TABLE `round_questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `battle`
--
ALTER TABLE `battle`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `categories_v2`
--
ALTER TABLE `categories_v2`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `round`
--
ALTER TABLE `round`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `round_questions`
--
ALTER TABLE `round_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
