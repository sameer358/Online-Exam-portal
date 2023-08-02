-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 08:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `admin_username`, `admin_password`) VALUES
(1, 'sameer', 'sameer');

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `correct_answers` int(11) NOT NULL,
  `score` decimal(5,2) NOT NULL,
  `attempt_date` datetime DEFAULT NULL,
  `attempt_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`id`, `username`, `total_questions`, `correct_answers`, `score`, `attempt_date`, `attempt_time`) VALUES
(138, 'test', 9, 2, 22.22, NULL, NULL),
(139, 'test', 9, 3, 33.33, NULL, NULL),
(140, 'test', 9, 3, 33.33, NULL, NULL),
(141, 'test', 9, 1, 11.11, NULL, NULL),
(142, 'test', 9, 1, 11.11, NULL, NULL),
(143, 'test', 9, 1, 11.11, NULL, NULL),
(144, 'test', 9, 2, 22.22, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL,
  `option4` varchar(255) DEFAULT NULL,
  `answer` int(11) DEFAULT NULL,
  `answer_options` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `answer_options`) VALUES
(1, 'What is the capital of Australia?', 'Sydney', 'Melbourne', 'Canberra', 'Perth', 3, '[Sydney,Melbourne,Canberra,Perth]'),
(2, 'Who wrote the novel \"Pride and Prejudice\"?', 'Jane Austen', 'Emily Brontë', 'Charlotte Brontë', 'Louisa May Alcott', 1, '[Jane Austen,Emily Brontë,Charlotte Brontë,Louisa May Alcott]'),
(3, 'Which country is known for its tulips and windmills?', 'France', 'Germany', 'Netherlands', 'Italy', 3, '[France,Germany,Netherlands,Italy]'),
(4, 'What is the chemical symbol for gold?', 'Au', 'Ag', 'G', 'Go', 1, '[Au,Ag,G,Go]'),
(5, 'Which planet is known as the \"Red Planet\"?', 'Mars', 'Jupiter', 'Saturn', 'Neptune', 1, '[Mars,Jupiter,Saturn,Neptune]'),
(6, 'Who is the CEO', 'w', 'r', 'r', 't', 0, '[w,r,r,t]'),
(7, 'Who is the CEO', 'w', 'r', 'r', 't', 0, '[w,r,r,t]'),
(8, 'who is manager ', 'Ts', 'tg', 'tg', 'tg', 0, '[Ts,tg,tg,tg]'),
(9, 'What is the capital of Bihar?', 'Chhapra', 'Patna', 'Siwan', 'Gaya', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `username`, `student_id`) VALUES
(1, 'test34', 39835);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `student_id` varchar(10) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `student_id`, `id`, `email`, `full_name`) VALUES
('administrators', 'administrators', '5E6OQD', 1, NULL, NULL),
('sameer', 'sameer', NULL, 34, NULL, NULL),
('Sameer', 'Sameer', NULL, 36, NULL, NULL),
('test', 'test', NULL, 37, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
