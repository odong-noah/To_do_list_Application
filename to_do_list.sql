-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2026 at 11:17 AM
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
-- Database: `interview_test`
--
CREATE DATABASE IF NOT EXISTS `interview_test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `interview_test`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `is_active`, `created_at`) VALUES
(1, 'admin', 'admin@test.com', '$2y$10$rj3AMGcmc.6oS9ub6qko5exKaXY45Xpg.zdnEUUhx2IFuxBnuErU.', 'user', 1, '2026-01-30 13:43:22'),
(2, 'Josh', 'josh@gmail.com', '$2y$10$oV.1pR/EsASooh.MVkgdHOIhgWiR6AKvZFM1NPfslNzcymfSsQTYq', 'user', 1, '2026-01-30 14:24:35'),
(3, 'joshua', 'joshua@gmail.com', '$2y$10$STbwp2jzN1MC9EBDbnUTyuwKmSgAiIiSLz4tsFenZzRgy2GUrkV56', 'user', 1, '2026-01-30 14:27:54'),
(4, 'kisakye', 'kisakye@gmail.com', '$2y$10$66q144RkX0CXYjfFyqQ8HuLCgQyXVpHCIQyRibN.SDuvpa7LXFqsK', 'user', 1, '2026-01-30 14:29:24'),
(5, 'noah', 'noah@gmail.com', '$2y$10$jo0N9.StRNb7nJCt28.GreRI5stvel4IPxxhN5zp/t2H8qd338mFm', 'user', 1, '2026-01-30 16:26:29'),
(6, 'elijah', 'elijah@gmail.com', '$2y$10$lSfGuMOHzhfYrcWtLqwrmOFjGlTQuy7ycMDKHcG5zioLH.3EOjBmC', 'user', 1, '2026-02-03 12:51:43'),
(7, 'simo', 'simon@gmail.com', '$2y$10$pZ4bCyF6q8u/OZDRcAGp/uwjiKu0fN28koqfXfOh65LJ/SubbWPtu', 'user', 1, '2026-02-03 12:54:04'),
(33, 'lawrence', 'lawrence@mail.com', '$2y$10$dbI1IX5KqqQxzfXVvfvRX.MMSXaDhYM2x7JOdzLsfCStl1A9wssIu', 'user', 1, '2026-02-04 09:16:53'),
(36, 'olara', 'olara@gmail.com', '$2y$10$8mOXkY9Ty.cjlvgyhtw7TeMxv.KXa1P1lpLZLtYxOIHhxNLmBXZgC', 'user', 1, '2026-02-04 09:23:43'),
(37, 'gamusi', 'gamusi@gmail.com', '$2y$10$togMo3WTSZbB9P2vBkHemeADOTXbqIjpLg/grlm2ja9MvxMlMTgNi', 'user', 1, '2026-02-04 09:27:28'),
(38, 'Awich', 'awich@gmail.com', '$2y$10$r0pJZn5CdkosMjBu//XWKOSusxaQa31UYKNG9VBJhuxg/nPk.STY.', 'user', 1, '2026-02-04 09:33:32'),
(40, 'junior', 'juniro@gmail.com', '$2y$10$iA71Ks7J1hnlGiUJ5pUsVu5tV4JaEHvatxOPlVwQCeEZPxx/kWPEi', 'admin', 1, '2026-02-04 09:51:07'),
(46, 'Angella', 'angella@gmail.com', '$2y$10$GCKE58nDNC3nxjzd.DsRxOXGA22MF70pkQGW4ObGo179juXoGlAb6', 'admin', 1, '2026-02-04 19:45:02'),
(48, 'rwot', 'rwot@gmail.com', '$2y$10$GKxq8jsBDNYzzLL0kaJUz.Vghx6RLfx3qp28rqvjVE.pCTdQI4R02', 'admin', 1, '2026-02-04 19:52:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- Database: `mini_auth_system`
--
CREATE DATABASE IF NOT EXISTS `mini_auth_system` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mini_auth_system`;

-- --------------------------------------------------------

--
-- Table structure for table `mini_auth_users`
--

CREATE TABLE `mini_auth_users` (
  `mini_auth_id` int(11) NOT NULL,
  `mini_auth_username` varchar(50) NOT NULL,
  `mini_auth_email` varchar(100) NOT NULL,
  `mini_auth_password` varchar(255) NOT NULL,
  `mini_auth_role` varchar(20) NOT NULL DEFAULT 'user',
  `mini_auth_is_active` tinyint(1) NOT NULL DEFAULT 1,
  `mini_auth_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mini_auth_users`
--

INSERT INTO `mini_auth_users` (`mini_auth_id`, `mini_auth_username`, `mini_auth_email`, `mini_auth_password`, `mini_auth_role`, `mini_auth_is_active`, `mini_auth_created_at`) VALUES
(1, 'alice', 'alice@gmail.com', '$2y$10$/US97zdl3g21bh4trihWgOQ3IvvusRKN6Oa9y6UBXwEfW2vKJlE3G', 'user', 1, '2026-02-04 20:44:19'),
(2, 'Whitney', 'whitney@gmail.com', '$2y$10$VtP44b2Xh.1TdxvK9p4URO/5Qy6KsYYDmw0eiLK7UQ6iy5Rr4/2NK', 'admin', 1, '2026-02-04 20:45:47'),
(3, 'Simon', 'simon@gmail.com', '$2y$10$DwAR8TK2uS35aW4hgDh8s.f3iX8v61M7d.3tZOADtjKk4I6Z2mMzq', 'admin', 1, '2026-02-05 06:52:20'),
(4, 'simo', 'simo@gmail.com', '$2y$10$EsWE5BFyXyUdIxH3bb8p8.TQQvRCvCyQSmWZHBn0IVtgY.pYVe38K', 'admin', 1, '2026-02-05 06:53:33'),
(5, 'Hector', 'hector@gmail.com', '$2y$10$0rEOwWGku8QROifKEcc1iOz0krgSvLzkl/AXL55ckwsNhbzKpFKH6', 'standard_user', 1, '2026-02-05 09:52:48'),
(6, 'admin', 'admin@gmail.com', '$2y$10$NsfK0xd3XRWRtHtSJjNZMOanh0KQu6yhd0QV0EZKl4NMWpDM0ZeQq', 'admin', 1, '2026-02-05 14:20:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mini_auth_users`
--
ALTER TABLE `mini_auth_users`
  ADD PRIMARY KEY (`mini_auth_id`),
  ADD UNIQUE KEY `mini_auth_username` (`mini_auth_username`),
  ADD UNIQUE KEY `mini_auth_email` (`mini_auth_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mini_auth_users`
--
ALTER TABLE `mini_auth_users`
  MODIFY `mini_auth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"to_do_list\",\"table\":\"to_do_list_task\"},{\"db\":\"to_do_list\",\"table\":\"to_do_list_stickywall\"},{\"db\":\"to_do_list\",\"table\":\"to_do_list_user\"},{\"db\":\"interview_test\",\"table\":\"users\"},{\"db\":\"mini_auth_system\",\"table\":\"mini_auth_users\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2026-02-18 10:15:46', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
--
-- Database: `to_do_list`
--
CREATE DATABASE IF NOT EXISTS `to_do_list` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `to_do_list`;

-- --------------------------------------------------------

--
-- Table structure for table `to_do_list_stickywall`
--

CREATE TABLE `to_do_list_stickywall` (
  `to_do_list_stickywall_id` int(10) UNSIGNED NOT NULL,
  `to_do_list_user_id` int(10) UNSIGNED NOT NULL,
  `to_do_list_stickywall_date` date NOT NULL,
  `to_do_list_stickywall_title` varchar(150) NOT NULL,
  `to_do_list_stickywall_description` text DEFAULT NULL,
  `to_do_list_stickywall_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `to_do_list_stickywall`
--

INSERT INTO `to_do_list_stickywall` (`to_do_list_stickywall_id`, `to_do_list_user_id`, `to_do_list_stickywall_date`, `to_do_list_stickywall_title`, `to_do_list_stickywall_description`, `to_do_list_stickywall_created_at`) VALUES
(2, 17, '2026-02-25', 'GYM', 'gym exercise and jogging', '2026-02-15 08:03:13'),
(3, 18, '2026-03-22', 'church service', 'i have to attend church service next sunday', '2026-02-15 10:17:05'),
(4, 18, '2026-02-11', 'work', 'i have pending work on thursday.', '2026-02-16 02:26:08'),
(5, 21, '2026-02-25', 'army', 'bootcamp for the army', '2026-02-16 02:46:58'),
(6, 21, '2026-02-17', 'gym', 'i have to go to the gym', '2026-02-16 02:49:14'),
(7, 21, '2026-02-18', 'fdstewwet', 'dtew4te', '2026-02-16 02:50:39'),
(8, 21, '2026-02-19', 'jjhkA', 'GJAHKU', '2026-02-18 07:11:16'),
(9, 21, '2026-02-19', 'fjgkhil', 'fjyk', '2026-02-18 07:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `to_do_list_task`
--

CREATE TABLE `to_do_list_task` (
  `to_do_list_task_id` int(10) UNSIGNED NOT NULL,
  `to_do_list_user_id` int(10) UNSIGNED NOT NULL,
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
(7, 10, 'Work', 'work from home', 'join the zoom meet to work from home.', '2026-02-18', '2026-02-14 18:17:00'),
(8, 10, 'Personal', 'go visist mum', 'I have to go visit my mum', '2026-02-25', '2026-02-14 18:35:17'),
(9, 10, 'Personal', 'going to church', 'i have to go to lunch on 24th.', '2026-02-23', '2026-02-14 18:48:48'),
(10, 10, 'Personal', 'sleep', 'jggggfagjgjhggfahgjhgjhajha', '2026-02-20', '2026-02-14 19:00:38'),
(11, 10, 'Personal', 'Alice', 'i have to check on alice on the d day', '2026-02-25', '2026-02-14 19:12:06'),
(12, 16, 'Personal', 'visit the doctor', 'i have to go to the hospital.', '2026-02-25', '2026-02-14 19:16:35'),
(13, 16, 'Personal', 'market day', 'go to the market and buy some groceries.', '2026-02-25', '2026-02-14 19:31:23'),
(14, 16, 'Work', 'work meeting', 'i have a work meeting to attend.', '2026-02-19', '2026-02-14 20:00:42'),
(15, 16, 'Personal', 'script acting', 'i have to go for script acting for a week.', '2026-02-26', '2026-02-14 21:57:39'),
(16, 17, 'Work', 'Work', 'I have to report back for work on 18th of this month.', '2026-02-18', '2026-02-15 07:10:09'),
(17, 17, 'Personal', 'Jogging', 'I have to go for jogging and gym on 20th.', '2026-02-20', '2026-02-15 07:14:11'),
(18, 17, 'Personal', 'movie night', 'I have to go for a movie night on 17th.', '2026-02-16', '2026-02-15 09:01:02'),
(19, 18, 'Personal', 'Visit my son', 'I have to go to Mbarara and visit my son.', '2026-02-19', '2026-02-15 10:15:59'),
(20, 18, 'Work', 'Travel upcountry', 'I have to travel upcountry to check on my businesses in the Western region of uganda.', '2026-02-26', '2026-02-15 12:47:57'),
(21, 18, 'Personal', 'REPORTING DAY', 'I have to take back my son to school.', '2026-02-28', '2026-02-16 02:20:08'),
(22, 21, 'Work', 'Army', 'I have an army bootcamp on the 25th.', '2026-02-25', '2026-02-16 02:41:41'),
(23, 21, 'Personal', 'john', 'visit john.', '2026-02-26', '2026-02-16 02:42:30'),
(24, 21, 'Personal', 'yyuffyfyy', 'yufyufuyfyfyfuyyufy', '2026-02-19', '2026-02-16 03:04:54'),
(25, 21, 'Personal', 'tfyfuyvhghjh', 'yfufyu fuyfuyuygyubuygyuguygyug ', '2026-02-26', '2026-02-16 12:58:43'),
(26, 21, 'Personal', 'noah', 'go and check on my friend noah', '2026-02-26', '2026-02-16 13:20:52'),
(27, 21, 'Personal', 'Banana', 'Banana', '2026-02-18', '2026-02-16 13:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `to_do_list_user`
--

CREATE TABLE `to_do_list_user` (
  `to_do_list_user_id` int(10) UNSIGNED NOT NULL,
  `to_do_list_user_username` varchar(50) NOT NULL,
  `to_do_list_user_email` varchar(100) NOT NULL,
  `to_do_list_user_password` varchar(255) NOT NULL,
  `to_do_list_user_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `to_do_list_user`
--

INSERT INTO `to_do_list_user` (`to_do_list_user_id`, `to_do_list_user_username`, `to_do_list_user_email`, `to_do_list_user_password`, `to_do_list_user_created_at`) VALUES
(10, 'Noah', 'noah@gmail.com', '$2y$12$l9DnJwVWXWiMgokosroXoeGwkMSR03eROzK..kPhJEPDmG8E1qES2', '2026-02-14 09:53:55'),
(11, 'Alice', 'alice@gmail.com', '$2y$12$oP4VGo2IG1wVAnjLZQNY9.NmZ0uYAOXMXMHRxK3/ExfesMKeWTLDe', '2026-02-14 11:04:30'),
(12, 'James', 'james@gmail.com', '$2y$12$pTm6NeYhJufafb6nrBqBPuWYeqnOeCovIVAQ8b712Nh65W3GiUSe.', '2026-02-14 11:22:12'),
(13, 'Elijah', 'elijah@gmail.com', '$2y$12$3F5V/tjxQ5RG2m6t6d8RXeUwMzVahuQOKANt7C0YE5E07xJ7AyQua', '2026-02-14 11:32:08'),
(14, 'Kisakye', 'kisakye@gmail.com', '$2y$12$XFNSlkiWRmmKt4uTpgB8d.rO57oCrUgBnYsHnVmvjOI8bQE9pqdcS', '2026-02-14 12:03:00'),
(16, 'Liam', 'liam@gmail.com', '$2y$12$MtwZMfdQlI/Pg923bZsLeeSgwEzPRi/o1.oay48rCan2M/pZqQ4aq', '2026-02-14 19:15:16'),
(17, 'cassa', 'sandra@gmail.com', '$2y$12$6ouPsle0ZDKy4T6pGH38nOnH11dcgIo.mVA0dLO5YbnS0MXzIY.ty', '2026-02-15 07:09:00'),
(18, 'Angella', 'angella@gmail.com', '$2y$12$uCsVpCk0LnknXLISrFajRu5B9AuDfjMLxc3JsZ7qXmc2Ag5.SrUMi', '2026-02-15 10:14:23'),
(19, 'Rain', 'rain@gmail.com', '$2y$12$NgkmXhhkgW6vLBvGpUqCIOAhuJJnSCNpGL8jetz1WzkBxo8Nkvo1W', '2026-02-16 00:48:22'),
(20, 'Rose', 'rose@gmail.com', '$2y$12$N24XxJkIcEq7aarvgQzTzulCcMtw8Oy2u1RCdSv1a9yvnMQyklKpi', '2026-02-16 01:34:18'),
(21, 'Jimmy', 'jimmy@gmail.com', '$2y$12$UWqvRuJRxgMGZA0N5NHdp.YmaJCCfTHhrm5P82OCV8Evl31cj3Y0G', '2026-02-16 02:11:58'),
(22, 'Login', 'login@gmail.com', '$2y$12$FgDZ34wWAEn.ufTNE7uzeO8B9pHe93gAn6loc1nbm1Z43J6sP5n9.', '2026-02-16 02:30:39');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `to_do_list_stickywall`
--
ALTER TABLE `to_do_list_stickywall`
  MODIFY `to_do_list_stickywall_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `to_do_list_task`
--
ALTER TABLE `to_do_list_task`
  MODIFY `to_do_list_task_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `to_do_list_user`
--
ALTER TABLE `to_do_list_user`
  MODIFY `to_do_list_user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
