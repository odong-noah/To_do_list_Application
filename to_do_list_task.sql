-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2026 at 06:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `to_do_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `to_do_list_task`
--

CREATE TABLE `to_do_list_task` (
  `to_do_list_task_id` varchar(64) NOT NULL,
  `to_do_list_user_id` varchar(64) NOT NULL,
  `to_do_list_task_category` varchar(50) NOT NULL,
  `to_do_list_task_title` varchar(150) NOT NULL,
  `to_do_list_task_description` text DEFAULT NULL,
  `to_do_list_task_date` date NOT NULL,
  `to_do_list_task_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `to_do_list_task`
--

INSERT INTO `to_do_list_task` (`to_do_list_task_id`, `to_do_list_user_id`, `to_do_list_task_category`, `to_do_list_task_title`, `to_do_list_task_description`, `to_do_list_task_date`, `to_do_list_task_created_at`) VALUES
('TODO_699b2b6be48c5549349451', 'TODO_699a06cd3f46f728189204', 'Personal', 'asdrfghjk', 'asdfghjkl', '2026-02-13', '2026-02-22 16:14:35'),
('TODO_699b3173ca757194053089', 'TODO_699a06cd3f46f728189204', 'Personal', 'asdfghj', 'asdfghjkl', '2026-02-12', '2026-02-22 16:40:19'),
('TODO_699b37edead9c560513340', 'TODO_699a06cd3f46f728189204', 'Personal', 'sdfghj', 'asdfgjk', '2026-02-13', '2026-02-22 17:07:57'),
('TODO_699b3d2517b3c571414168', 'TODO_699a06cd3f46f728189204', 'Personal', 'adfgh', 'ajhgfdsa', '2026-02-13', '2026-02-22 17:30:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `to_do_list_task`
--
ALTER TABLE `to_do_list_task`
  ADD PRIMARY KEY (`to_do_list_task_id`),
  ADD KEY `fk_task_user` (`to_do_list_user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `to_do_list_task`
--
ALTER TABLE `to_do_list_task`
  ADD CONSTRAINT `fk_task_user` FOREIGN KEY (`to_do_list_user_id`) REFERENCES `to_do_list_user` (`to_do_list_user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
