-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 16, 2022 at 11:07 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_project_question`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessor`
--

CREATE TABLE `assessor` (
  `id` int(11) NOT NULL,
  `assessor_fullname_th` varchar(200) NOT NULL,
  `assessor_fullname_en` varchar(200) NOT NULL,
  `assessor_images` varchar(200) NOT NULL,
  `assessor_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assessor`
--

INSERT INTO `assessor` (`id`, `assessor_fullname_th`, `assessor_fullname_en`, `assessor_images`, `assessor_created`) VALUES
(2, 'แวน สกินเนอร์', 'Vance Skinner', 'assessor_5732096_20220216154551_181x174.jpg', '2022-02-16 08:45:51'),
(3, 'โยรันดะ โฮสก์', 'Yolanda Hodges', 'assessor_9466265_20220216154604_181x174.jpg', '2022-02-16 08:46:04'),
(4, 'ฮาซาด ริกส์', 'Hasad Riggs', 'assessor_3802856_20220216154617_181x174.jpg', '2022-02-16 08:46:17'),
(5, 'เมด โมริน', 'Medge Morin', 'assessor_9729657_20220216154655_181x174.jpg', '2022-02-16 08:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_type` enum('Admin','Manager') COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authkeys` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accesstokens` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `users_type`, `picture`, `name`, `email`, `email_verified_at`, `password`, `authkeys`, `accesstokens`, `remember_token`, `created_at`, `updated_at`) VALUES
(0, 'Admin', 'Profile-20201225234715_60x60.jpg', 'systems_admin', 'systems_admin@gmail.com', NULL, '$2y$10$nBH26yL.pTEFtErefH9s5.STnig/csUIK5ou8olypXCsYfwEoQZCC', '150accb88efe24d3516f59a55a6f2ba8', '$2y$10$9/aC2BKsbzQgBwUrmxcJ7O6RHL2eF0udx4g0HUuGzxzDbbGZE4/M.', '', '2019-08-30 07:50:10', '2020-12-25 16:47:15'),
(6, 'Admin', 'Profile-20200415172611_60x60.jpg', 'survey_admin', 'survey_admin@gmail.com', NULL, '$2y$10$43n7jfV/a6qN2LkCpE877uAKCiVUMOhlteQ9k11tO7dq970QAXWUW', 'bdd78bb1f1af08930156974292e9fb43', '$2y$10$nK/1AQOzavDCUec9vUe3ouMop7HBnasFPcrGomNx999MRBMHu6TEO', '', '2019-08-30 07:50:10', '2022-02-15 10:38:34'),
(7, 'Manager', 'Profile-20201225002541_60x60.jpg', 'manager_101', 'manager_101@gmail.com', NULL, '$2y$10$RV3wpPensaaMaIn9E/SMaeRusN3BQSkf932cBxEO4EqaztQgC017e', 'c94c64fc3553e9536a597e2bc0ff5f64', '$2y$10$AcYj/5OGpH0nSzWHyrrazO9V9VpZr33b7.6A2/5HzkuzzFMXN4SqK', '', '2020-12-24 17:21:29', '2020-12-24 18:03:13');

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `id` int(11) NOT NULL,
  `voter_rate` enum('แย่มาก','แย่','พอใช้','ดี','ดีมาก') NOT NULL,
  `assessor_id` int(11) NOT NULL,
  `voter_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`id`, `voter_rate`, `assessor_id`, `voter_created`) VALUES
(1, 'พอใช้', 2, '2022-02-16 09:21:47'),
(2, 'ดี', 3, '2022-02-16 09:21:47'),
(4, 'แย่มาก', 3, '2022-02-16 10:25:06'),
(5, 'ดี', 3, '2022-02-16 11:04:44'),
(6, 'ดีมาก', 5, '2022-02-16 11:05:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessor`
--
ALTER TABLE `assessor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voter`
--
ALTER TABLE `voter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessor`
--
ALTER TABLE `assessor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `voter`
--
ALTER TABLE `voter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
