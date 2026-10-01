-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2026 at 03:08 AM
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
-- Database: `e_schedule`
--

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `subject_type` enum('minor','major') NOT NULL,
  `category` enum('lecture','laboratory') NOT NULL,
  `units` decimal(3,1) NOT NULL DEFAULT 3.0,
  `required_hours` decimal(3,1) NOT NULL COMMENT 'Auto-computed: minor=3hrs, major=5hrs',
  `department` varchar(255) NOT NULL,
  `year_level` varchar(255) DEFAULT NULL COMMENT 'e.g., 1st Year, 2nd Year',
  `semester` varchar(255) DEFAULT NULL COMMENT '1st or 2nd',
  `curriculum` varchar(255) DEFAULT NULL COMMENT 'e.g., Old Curriculum, New Curriculum (Revised 2025)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `subject_name`, `subject_type`, `category`, `units`, `required_hours`, `department`, `year_level`, `semester`, `curriculum`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CC111', 'Introduction to Computing', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '1st Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(2, 'CC112', 'Computer Programming 1', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '1st Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(3, 'ISP111', 'Organization & Management Concepts', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '1st Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(4, 'GE-PurCom', 'Purposive Communication', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '1st Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(5, 'GE-UTS', 'Understanding the Self', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '1st Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(6, 'GE-MMW', 'Mathematics in the Modern World', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '1st Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(7, 'GEE111', 'Logic and Critical Thinking', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '1st Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(8, 'PATHFit1', 'Movement Competency Training', 'minor', 'lecture', 2.0, 2.0, 'BSIS', '1st Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-17 16:14:46', NULL),
(9, 'NSTP1', 'National Service Training Program 1', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '1st Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(10, 'CC121', 'Computer Programming 2', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '1st Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(11, 'ISP121', 'Fundamentals of Information Systems', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '1st Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(12, 'ISP122', 'Introduction to Human-Computer Interaction', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '1st Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(13, 'ISP123', 'Information Technology Infrastructure & Network Technology', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '1st Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(14, 'GE-Ethics', 'Ethics', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '1st Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(15, 'GE-TCW', 'The Contemporary World', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '1st Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(16, 'GEE121', 'Modern Communication and Technical Writing', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '1st Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(17, 'PATHFit2', 'Exercise-based Fitness Activities', 'minor', 'lecture', 2.0, 2.0, 'BSIS', '1st Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-17 16:14:46', NULL),
(18, 'NSTP2', 'National Service Training Program 2', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '1st Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(19, 'CC211', 'Data Structures and Algorithms', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '2nd Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(20, 'ISP211', 'Professional Issues in Information Systems', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(21, 'ISP212', 'Business Process Design and Management', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(22, 'ISP213', 'Financial Management', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(23, 'ISE211', 'Elective 1: Presentation Skills Using Information Technology', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '2nd Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(24, 'GE-STS', 'Science, Technology and Society', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(25, 'GEM-Rizal', 'Life and Works of Rizal', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(26, 'PATHFit3', 'Sports', 'minor', 'lecture', 2.0, 2.0, 'BSIS', '2nd Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-17 16:14:46', NULL),
(27, 'CC222', 'Information Management', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '2nd Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(28, 'ISP221', 'Systems Analysis and Design', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '2nd Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(29, 'ISP222', 'Quantitative Methods', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(30, 'ISP223', 'Evaluation of Business Performance', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(31, 'GE-RPH', 'Readings in Philippine History', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(32, 'GEE221', 'Living in the IT Era', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(33, 'GE-ArtApp', 'Arts Appreciation', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(34, 'PATHFit4', 'Sports', 'minor', 'lecture', 2.0, 2.0, 'BSIS', '2nd Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-17 16:14:46', NULL),
(35, 'CC311', 'Applications Development and Emerging Technologies', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '3rd Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(36, 'ISP311', 'Data Miining', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '3rd Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(37, 'ISP312', 'Information Systems Project Management 1', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '3rd Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(38, 'ISP313', 'Methods of Research in Information Systems', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '3rd Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(39, 'ISP314', 'Introduction to Web Systems and Technology', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '3rd Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(40, 'ISE311', 'Elective 2: Seminar in Special Information Systems Topic', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '3rd Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(41, 'ISE312', 'Elective 3:Advanced Database Management System', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '3rd Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(42, 'ISCAP321', 'Capstone Project 1 - Proposal Writing and Presentation', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '3rd Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(43, 'ISP321', 'Information Systems  Project Management 2', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '3rd Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(44, 'ISP322', 'Business Intelligence', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '3rd Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(45, 'ISP323', 'Enterprise Architecture', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '3rd Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(46, 'ISP324', 'Advanced Web Systems and Technology', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '3rd Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(47, 'ISCAP411', 'Capstone Project 2 - Development and Implementation', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '4th Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(48, 'ISP411', 'Information Systems Strategy Management and Acquisition', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '4th Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(49, 'ISP412', 'Information Technology Audit and Control', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '4th Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(50, 'ISE411', 'Elective 4:Enterprise Resource Plan', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '4th Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(51, 'ISE412', 'Elective 5:Artificial Intelligence', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '4th Year', '1st', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(52, 'ISOJT', 'On the Job Training  - 486 hours', 'minor', 'lecture', 9.0, 9.0, 'BSIS', '4th Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-17 16:14:46', NULL),
(53, 'NSTP 2', 'National Service Training Program', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '1st Year', '2nd', 'New Curriculum (Revised 2025)', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(54, 'CC201', 'Computer Programming 2', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '2nd Year', '1st', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(55, 'CC203', 'Data Structure and Algorithms', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '2nd', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(56, 'CC202', 'Information Management', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '1st', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(57, 'ISP204', 'System Analysis and Design', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '2nd', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(58, 'ISP201', 'Professional Issues in IS', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '1st', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(59, 'ISP205', 'Quantitative Methods', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '2nd', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(60, 'ISP202', 'Enterprise Architecture', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '1st', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(61, 'ISP206', 'Intorduction to Human-Computer Interaction', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '2nd', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(62, 'ISP203', 'IT Infrastructure & Network Technology', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '1st', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(63, 'ISP207', 'Evaluation of Business Performance', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '2nd', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(64, 'ISE201', 'Elective 1: Presentation Skills Using Information Technology', 'major', 'lecture', 3.0, 5.0, 'BSIS', '2nd Year', '1st', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-16 17:05:14', NULL),
(65, 'GE202', 'The Contemporary World', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '2nd Year', '2nd', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(66, 'CC301', 'Applications Development and Emerging Technologies', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '3rd Year', '1st', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(67, 'ISCAP301', 'Capstone Project 1 - Proposal Writing and Presentation', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '3rd Year', '2nd', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(68, 'ISP301', 'Financial Management', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '3rd Year', '1st', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(69, 'ISP305', 'Information Systems Project Management 2', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '3rd Year', '2nd', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(70, 'ISP302', 'Business Intelligence', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '3rd Year', '1st', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(71, 'ISP306', 'Enterprise Resource Plan', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '3rd Year', '2nd', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(72, 'ISP303', 'IS Project Management 1', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '3rd Year', '1st', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(73, 'ISP307', 'Data Mining', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '3rd Year', '2nd', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(74, 'ISP304', 'Methods of Research in IS', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '3rd Year', '1st', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(75, 'ISE303', 'Elective 4: Seminar in Special Information Systems Topic', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '3rd Year', '2nd', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(76, 'ISE301', 'Elective 2: Web Systems and Technology', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '3rd Year', '1st', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(77, 'ISE302', 'Elective 3: Advanced Database Systems', 'major', 'laboratory', 3.0, 5.0, 'BSIS', '3rd Year', '1st', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(78, 'ISCAP401', 'Capstone Project 2 - Development and Implementation', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '4th Year', '1st', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-17 04:22:01', NULL),
(79, 'ISP401', 'IS Strategy Management and Acquisition', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '4th Year', '1st', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL),
(80, 'ISP402', 'IT Audit and Control', 'minor', 'lecture', 3.0, 3.0, 'BSIS', '4th Year', '1st', 'Old Curriculum', '2026-06-15 22:14:35', '2026-06-15 22:14:35', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_subject_code_unique` (`subject_code`),
  ADD KEY `subjects_subject_type_index` (`subject_type`),
  ADD KEY `subjects_category_index` (`category`),
  ADD KEY `subjects_department_index` (`department`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
