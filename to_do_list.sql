-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2026 at 06:47 PM
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
-- Table structure for table `to_do_list_stickywall`
--

CREATE TABLE `to_do_list_stickywall` (
  `to_do_list_stickywall_id` varchar(64) NOT NULL,
  `to_do_list_user_id` varchar(64) NOT NULL,
  `to_do_list_stickywall_date` date NOT NULL,
  `to_do_list_stickywall_title` varchar(150) NOT NULL,
  `to_do_list_stickywall_description` text DEFAULT NULL,
  `to_do_list_stickywall_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `to_do_list_stickywall`
--

INSERT INTO `to_do_list_stickywall` (`to_do_list_stickywall_id`, `to_do_list_user_id`, `to_do_list_stickywall_date`, `to_do_list_stickywall_title`, `to_do_list_stickywall_description`, `to_do_list_stickywall_created_at`) VALUES
('TODO_699a20fa976fa803278072', 'TODO_699a06cd3f46f728189204', '2026-02-03', 'sdfg', 'sdfgh', '2026-02-21 21:17:46'),
('TODO_699ab19cd7a8e497222038', 'TODO_699a06cd3f46f728189204', '2026-02-18', 'asdfgh', 'asdfgh', '2026-02-22 07:34:52'),
('TODO_699ab81ed5663900271448', 'TODO_699a06cd3f46f728189204', '2026-02-17', 'asdfg', 'asdfghj', '2026-02-22 08:02:38'),
('TODO_699aba7486c6f978372905', 'TODO_699a06cd3f46f728189204', '2026-02-26', 'asdfgh', 'asdfghjk', '2026-02-22 08:12:36'),
('TODO_699abb57f2bad230873337', 'TODO_699a06cd3f46f728189204', '2026-02-26', 'asdfgh', 'asdfgh', '2026-02-22 08:16:23'),
('TODO_699abc4c73bf3944798420', 'TODO_699a06cd3f46f728189204', '2026-02-17', 'ASDFGHJ', 'ASDFGHJK', '2026-02-22 08:20:28'),
('TODO_699ac6b72aaa0734450039', 'TODO_699a06cd3f46f728189204', '2026-02-18', 'SDFGHJK', 'ASDFGHJ', '2026-02-22 09:04:55'),
('TODO_699aca8196eb6983704862', 'TODO_699a06cd3f46f728189204', '2026-03-06', 'asdfghj', 'sdfghjki', '2026-02-22 09:21:05'),
('TODO_699aca9457ec9040948891', 'TODO_699a06cd3f46f728189204', '2026-02-25', 'sdfghjk', 'cvbnm,.', '2026-02-22 09:21:24'),
('TODO_699acaa50c436293479450', 'TODO_699a06cd3f46f728189204', '2026-02-18', 'zxcvbnm,.', 'xcvbnm,./', '2026-02-22 09:21:41'),
('TODO_699acac4e0746385297504', 'TODO_699a06cd3f46f728189204', '2026-02-25', 'asdfghuj', 'asdfghjkl', '2026-02-22 09:22:12'),
('TODO_699acad701ad7875631542', 'TODO_699a06cd3f46f728189204', '2026-02-18', 'zxcvbnm,', 'bnm,./zxcfvgbnm', '2026-02-22 09:22:31'),
('TODO_699acae66a764105350099', 'TODO_699a06cd3f46f728189204', '2026-03-06', 'AZsxdcfvbnm', 'zxcvbnm', '2026-02-22 09:22:46'),
('TODO_699ad5c066812250392393', 'TODO_699a06cd3f46f728189204', '2026-02-25', 'asdfghjk', 'sdfghjkl', '2026-02-22 10:09:04'),
('TODO_699ad5dd1c381714993249', 'TODO_699a06cd3f46f728189204', '2026-02-26', 'asdfghjk', 'sdfghjkl', '2026-02-22 10:09:33'),
('TODO_699ad6e703788086584239', 'TODO_699a06cd3f46f728189204', '2026-02-18', 'sdfghjk', 'sdfghjkl', '2026-02-22 10:13:59'),
('TODO_699b1d6588f9d785662338', 'TODO_699a06cd3f46f728189204', '2026-02-18', 'asdfg', 'sdfghj', '2026-02-22 15:14:45'),
('TODO_699b1d8985690680013781', 'TODO_699a06cd3f46f728189204', '2026-02-28', 'dfghjik', 'fghjkl;', '2026-02-22 15:15:21'),
('TODO_699b1dd08c11c143977189', 'TODO_699a06cd3f46f728189204', '2026-02-26', 'noah', 'noahasdfghjk', '2026-02-22 15:16:32');

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

-- --------------------------------------------------------

--
-- Table structure for table `to_do_list_user`
--

CREATE TABLE `to_do_list_user` (
  `to_do_list_user_id` varchar(64) NOT NULL,
  `to_do_list_user_username` varchar(50) NOT NULL,
  `to_do_list_user_email` varchar(100) NOT NULL,
  `to_do_list_user_password` varchar(255) NOT NULL,
  `to_do_list_user_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `to_do_list_user`
--

INSERT INTO `to_do_list_user` (`to_do_list_user_id`, `to_do_list_user_username`, `to_do_list_user_email`, `to_do_list_user_password`, `to_do_list_user_created_at`) VALUES
('TODO_699a0184443bf389695290', 'Noah', 'noah@gmail.com', '$2y$10$OaK9VouTH9Nshs396l4HY.yj8T9xobnJWS3Z3s0mIjOhm9K9utnja', '2026-02-21 19:03:32'),
('TODO_699a06cd3f46f728189204', 'Voldermort', 'voldermort@gmail.com', '$2y$10$rrLi1OauNFw/lzSSnoAUvOsFDMhM0UolDpH2zqMtv0F5YMhe4tBp2', '2026-02-21 19:26:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `to_do_list_stickywall`
--
ALTER TABLE `to_do_list_stickywall`
  ADD PRIMARY KEY (`to_do_list_stickywall_id`),
  ADD KEY `fk_stickywall_user` (`to_do_list_user_id`);

--
-- Indexes for table `to_do_list_task`
--
ALTER TABLE `to_do_list_task`
  ADD PRIMARY KEY (`to_do_list_task_id`),
  ADD KEY `fk_task_user` (`to_do_list_user_id`);

--
-- Indexes for table `to_do_list_user`
--
ALTER TABLE `to_do_list_user`
  ADD PRIMARY KEY (`to_do_list_user_id`),
  ADD UNIQUE KEY `to_do_list_user_username` (`to_do_list_user_username`),
  ADD UNIQUE KEY `to_do_list_user_email` (`to_do_list_user_email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `to_do_list_stickywall`
--
ALTER TABLE `to_do_list_stickywall`
  ADD CONSTRAINT `fk_stickywall_user` FOREIGN KEY (`to_do_list_user_id`) REFERENCES `to_do_list_user` (`to_do_list_user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `to_do_list_task`
--
ALTER TABLE `to_do_list_task`
  ADD CONSTRAINT `fk_task_user` FOREIGN KEY (`to_do_list_user_id`) REFERENCES `to_do_list_user` (`to_do_list_user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
