-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 05:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `to-do_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar_events`
--

CREATE TABLE `calendar_events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `all_day` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calendar_events`
--

INSERT INTO `calendar_events` (`id`, `user_id`, `title`, `start`, `end`, `all_day`, `created_at`) VALUES
(15, 21, 'friday class', '2025-06-27 00:00:00', '2025-06-28 00:00:00', 1, '2025-06-12 00:48:01'),
(17, 21, 'good evening', '2025-06-09 00:00:00', '2025-06-12 00:00:00', 1, '2025-06-12 00:49:37'),
(18, 21, 'camping', '2025-06-18 00:00:00', '2025-06-21 00:00:00', 1, '2025-06-12 00:50:02'),
(38, 19, 'ccccc', '2025-06-30 00:00:00', '2025-07-02 23:59:59', 1, '2025-06-18 10:57:58'),
(39, 19, '2132131', '2025-06-10 06:00:00', '2025-06-10 12:00:00', 0, '2025-06-18 11:01:50'),
(40, 19, '41111111', '2025-06-17 00:00:00', '2025-06-20 23:59:59', 1, '2025-06-18 11:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(6) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `created_at`) VALUES
(18, 19, 'meeting', 'xccx', '2025-06-05'),
(19, 19, 'interview', 'sf', '2025-06-05'),
(20, 19, 'job interview', 's', '2025-06-05'),
(21, 19, 'class schedule', 'Monday class schedule', '2025-06-09'),
(22, 21, 'edited', 'edited description', '2025-06-12'),
(24, 19, 'my todo list', 'my description', '2025-06-17');

-- --------------------------------------------------------

--
-- Table structure for table `todo_tasks`
--

CREATE TABLE `todo_tasks` (
  `id` int(11) NOT NULL,
  `tasks_id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `is_done` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `todo_tasks`
--

INSERT INTO `todo_tasks` (`id`, `tasks_id`, `task_name`, `is_done`) VALUES
(72, 18, 'b', 0),
(73, 18, 'n', 0),
(74, 19, 'g', 1),
(75, 20, 's', 1),
(77, 20, 'd', 0),
(79, 21, 'Itec 106', 1),
(82, 22, '2', 0),
(83, 22, '3', 0),
(84, 22, '4', 1),
(85, 22, '5', 0),
(89, 24, 'my task 1', 1),
(90, 24, 'my task 2', 1),
(91, 24, 'task 3', 0),
(92, 24, 'task 4', 0),
(98, 21, 'hello', 0),
(99, 21, 'hi', 1),
(100, 21, 'world', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `image`) VALUES
(19, 'asd', '$2y$10$Of8JyEzWjNcJTpRVDOtsPuylRFh6Gb1zrWAr98w3yyhRl6pqviBQ2', 'jnaag42@gmail.com', 'asd', '1748686168_23e31e5c4fac47687c59.webp'),
(20, 'qwer', '$2y$10$TrKmmTpBoPV2SQ3n3Ai9buq6dparub9cM8/DcliMnOtqtHttqvlGq', 'jnaag41@gmail.com', 'qwer', '1748786860_26dd4e46dac7b5594568.jpg'),
(21, 'doenut', '$2y$10$7kWSCBD4ZLpwxqJnHaIOH.9LLC16RpwvlflMbmoCSBnv7V7pIsmVC', 'johnpaulnaag10@gmail.com', 'john doe', '1749689111_a801d547e600d1f6f874.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar_events`
--
ALTER TABLE `calendar_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_event` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_tasks` (`user_id`);

--
-- Indexes for table `todo_tasks`
--
ALTER TABLE `todo_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `todo_id` (`tasks_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar_events`
--
ALTER TABLE `calendar_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `todo_tasks`
--
ALTER TABLE `todo_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calendar_events`
--
ALTER TABLE `calendar_events`
  ADD CONSTRAINT `fk_user_event` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_user_tasks` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `todo_tasks`
--
ALTER TABLE `todo_tasks`
  ADD CONSTRAINT `todo_tasks_ibfk_1` FOREIGN KEY (`tasks_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
