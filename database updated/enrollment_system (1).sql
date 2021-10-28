-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2021 at 06:37 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enrollment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `profile_pic`, `password`, `created`) VALUES
(16, 'Daniel Paolo', 'danielpaolo@gmail.com', 'https://www.w3schools.com/w3images/avatar6.png', '3d0f3b9ddcacec30c4008c5e030e6c13a478cb4f', ''),
(15, 'James Basti', 'Jamesbasti@gmail.com', 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fpickaface.net%2Favatar%2F5998%2Fnice%2Bguy.html&psig=AOvVaw1RcPQ7v07pzHzEX8UydKIG&ust=1607914764938000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCODYm7f7ye0CFQAAAAAdAAAAABAI', '474ba67bdb289c6263b36dfd8a7bed6c85b04943', ''),
(14, 'mjcayas', 'mjcayas@gmail.com', 'https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/117796916/original/63535411336d226c2a23e0caea4c8e2337fc6cae/draw-a-cute-and-nice-avatar-or-portrait-for-you.png', '0b6d9ffef35ed870b74b818eda355f86c91fbf46', ''),
(20, 'Redge Tan', 'RedgeTan@gmail.com', 'https://www.w3schools.com/w3images/avatar6.png', '74fa20ec92024f9dd63de90fd930279a9c9f2868', '');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course`, `created`) VALUES
(25, 'TVL', '2020-12-13 03:55:11'),
(26, 'HUMSS', '2020-12-13 03:55:23'),
(27, 'STEM', '2020-12-13 03:55:38'),
(28, 'HIGHSCHOOL', '2021-01-09 16:35:07'),
(29, 'ELEMENTARY', '2021-01-09 16:35:15'),
(30, 'KINDER GARTEN ', '2021-01-09 16:35:24'),
(31, 'ABM', '2021-01-21 10:19:51'),
(32, 'ICT', '2021-01-21 10:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `enrollies`
--

CREATE TABLE `enrollies` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(1) NOT NULL,
  `course` varchar(255) NOT NULL,
  `birth_place` varchar(255) NOT NULL,
  `contact_number` bigint(255) NOT NULL,
  `sex` varchar(1) NOT NULL,
  `fathersname` varchar(255) NOT NULL,
  `mothersname` varchar(255) NOT NULL,
  `father_occupation` varchar(255) NOT NULL,
  `mother_occupation` varchar(255) NOT NULL,
  `guardian` varchar(255) NOT NULL,
  `guardian_addr` varchar(255) NOT NULL,
  `guardian_relation` varchar(255) NOT NULL,
  `grade_level` varchar(255) NOT NULL,
  `addr` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `schoolyear` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enrollies`
--

INSERT INTO `enrollies` (`id`, `student_id`, `name`, `surname`, `firstname`, `middlename`, `course`, `birth_place`, `contact_number`, `sex`, `fathersname`, `mothersname`, `father_occupation`, `mother_occupation`, `guardian`, `guardian_addr`, `guardian_relation`, `grade_level`, `addr`, `religion`, `status`, `schoolyear`) VALUES
(34, '46820374108', 'Alyssa Pagatpat', 'Pagatpat', 'Alyssa', 'G', '28', 'Pasig', 9054845323, 'F', 'Papa Pagatpat', 'Mama Pagatpat', 'Engineer', 'House Wife', 'Mama Pagatpat', '21 N.cuevas St. Kalawaan Pasig', 'Mother', 'Grade 9', '21 N.cuevas St. Kalawaan Pasig', 'Catholic', 'Enrolled', '2020-2021'),
(33, '46820398032', 'Janella Salvador', 'Salvador', 'Janella', 'B', '27', 'Pasig', 639054845323, 'F', 'Bayani Salvador', 'Carmela Salvador', 'Construction', 'Engineer', 'Carmela Salvador', '21 N.cuevas St. Kalawaan Pasig', 'Mother', 'Grade 12', '21 N.cuevas St. Kalawaan Pasig', 'Catholic', 'Enrolled', '2020-2021'),
(35, '46820419667', 'Baby Ruth Adeva', 'Adeva', 'Baby Ruth', 'C', '28', 'Pasig', 954845223, 'F', 'Daddy Adeva', 'Myra Adeva', 'Driver', 'House Wife', 'Myra Adeva', '41 Paulino St. Kalawaan Pasig ', 'Mother', 'Grade 8', '41 Paulino St. Kalawaan Pasig ', 'Catholic', 'Enrolled', '2021-2022'),
(37, '46820421168', 'Alden Richard', 'Richard', 'Alden', 'M', '27', 'Pasig', 9054845323, 'M', 'Papa Richard', 'Mama Richard', 'Construction', 'House Wife', 'Mama Richard', '12 Paulino St. Kalawaan Pasig', 'Mother', 'Grade 12', '12 Paulino St. Kalawaan Pasig', 'Catholic', 'Enrolled', '2021-2022'),
(38, '46820362263', 'Peppa Pig', 'Pig', 'Peppa', 'P', '26', 'Pasig', 9014859087, 'F', 'Papa Pig', 'Mama Pig', 'Construction', 'House Wife', 'Mama Pig', '42 Paulino St. Kalawaan Pasig', 'Mother', 'Grade 7', '42 Paulino St. Kalawaan Pasig', 'Catholic', 'Enrolled', '2021-2022'),
(39, '46820382668', 'Daisy Abing', 'ABING', 'DAISY', 'D', '25', 'Pasig', 9123451234, 'F', 'RODOLFO ABING', 'DEZZA ABING', 'Engineer', 'H', 'DEZZA ABING', '123 VISITACION ST. KALAWAAN PASIG CITY', 'MOTHER', 'Grade 12', '123 VISITACION ST. KALAWAAN PASIG CITY', 'Catholic', 'Enrolled', '2021-2022'),
(40, '46820410734', 'Baby Sandoval', 'Sandoval', 'Baby', 'Y', '28', 'Pasig', 9128765434, 'F', 'Dadi Sandoval', 'Mami Sandoval', 'Construction', 'House Wife', 'Mami Sandoval', '1234 Paulino St. Kalawaan Pasig City', 'MOTHER', 'Grade 8', '1234 Paulino St. Kalawaan Pasig City', 'Catholic', 'Enrolled', '2021-2022'),
(41, '46820421020', 'Name', 'Cayas', 'Mary joy', 'Y', '26', 'Pasig', 639054845323, 'F', 'Rodrigo Cayas', 'Flora Cayas', 'Ofw', 'Goverment Employee', 'Flora Cayas', '21 N.cuevas St. Kalawaan Pasig', 'Mother', 'Grade 10', '21 N.cuevas St. Kalawaan Pasig', 'Catholic', 'Enrolled', '2022-2023'),
(42, '46820350660', 'Theresa', 'Cayas', 'Theresa', 'B', '28', 'Pasig', 639054845323, 'F', 'Arnel Cayas', 'Joanna Cayas', 'Engineer', 'Accountant', 'Joanna Cayas', '21 N.cuevas St. Kalawaan Pasig', 'MOTHER', 'Grade 9', '21 N.cuevas St. Kalawaan Pasig', 'Catholic', 'Enrolled', '2022-2023');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `final_grade` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `student_name`, `course`, `subject`, `final_grade`) VALUES
(27, 'Janella Salvador', '27', '2', '88'),
(28, 'Alyssa Pagatpat', '27', '3', '83'),
(30, 'Baby Ruth Adeva', '28', '5', '94'),
(32, 'Alden Richard', '27', '6', '90'),
(33, 'Daisy Abing', '25', '9', '95'),
(34, 'Baby Sandoval', '28', '3', '85'),
(35, 'Baby Sandoval', '28', '5', '84'),
(36, 'Daisy Abing', '25', '6', '93'),
(37, 'Theresa', '28', '6', '96');

-- --------------------------------------------------------

--
-- Table structure for table `grade_levels`
--

CREATE TABLE `grade_levels` (
  `id` int(11) NOT NULL,
  `grade_level` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grade_levels`
--

INSERT INTO `grade_levels` (`id`, `grade_level`, `created`) VALUES
(24, 'Grade 12', '2020-12-12 07:44:13'),
(21, 'Grade 11', '2020-12-12 07:44:27'),
(25, 'Kinder 1', '2021-01-09 16:37:21'),
(26, 'Grade 2', '2021-01-09 16:37:28'),
(27, 'Grade 3', '2021-01-09 16:37:33'),
(28, 'Grade 4', '2021-01-09 16:37:39'),
(29, 'Grade 5', '2021-01-09 16:37:47'),
(30, 'Grade 6', '2021-01-09 16:37:59'),
(31, 'Grade 7', '2021-01-09 16:38:07'),
(32, 'Grade 8', '2021-01-09 16:38:14'),
(33, 'Grade 9', '2021-01-09 16:38:22'),
(34, 'Grade 10', '2021-01-09 16:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `oras`
--

CREATE TABLE `oras` (
  `id` int(25) NOT NULL,
  `oras` varchar(25) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `oras`
--

INSERT INTO `oras` (`id`, `oras`, `created`) VALUES
(1, '1:00 - 2:00 PM', '2021-08-19'),
(2, '2:00 - 3:00 PM', '2021-08-19'),
(3, '3:00 - 4:00 PM', '2021-08-19'),
(5, '4:00 - 5:00 PM', '2021-08-19');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `position`, `created`) VALUES
(31, 'Teacher II', '2021-01-09 16:36:58'),
(30, 'Teacher I', '2020-12-13 03:57:01'),
(32, 'Teacher V', '2021-01-21 10:50:01');

-- --------------------------------------------------------

--
-- Table structure for table `registered`
--

CREATE TABLE `registered` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `statuss` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registered`
--

INSERT INTO `registered` (`id`, `name`, `email`, `profile_image`, `password`, `status`, `code`, `statuss`) VALUES
(42, 'Nikki Pagatpat', 'nikkipagatpat@gmail.com', 'https://pickaface.net/gallery/avatar/43235812_161230_1542_3hqcg.png', '7cc4b0387fa92a70c4512ff5b2ae8734102be91a', 'Not Enroll', 0, ''),
(41, 'Juswa', 'juswa@gmail.com', 'https://pickaface.net/gallery/avatar/Identical52046a933b5e3.png', 'ea841d502f6981b30d859e46d3dc0681af1c738b', 'Not Enroll', 0, ''),
(37, 'Alden Richard', 'alden@gmail.com', 'https://pickaface.net/gallery/avatar/55373343_180307_1836_cojv.png', '54af3a4b8bac0f6f997e8a25e86f7e794e9ff85b', 'Enrolled', 0, ''),
(27, 'Janella Salvador', 'janellaS@gmail.com', 'https://pickaface.net/gallery/avatar/55373343_180307_1836_cojv.png', '43cbbf07ed7581774ebe81bd9c922d4324e6bb63', 'Enrolled', 0, ''),
(28, 'Alyssa Pagatpat', 'alyssa@gmail.com', 'https://pickaface.net/gallery/avatar/43235812_161230_1542_3hqcg.png', '636f5dbc72c1a3d15a8005bf85e3c58fc76ca95d', 'Enrolled', 0, ''),
(39, 'daisy abing', 'daisyabing@gmail.com', 'https://pickaface.net/gallery/avatar/.1967556f8245f14e5.png', '0f91787c8088296ea1439e159e4845b7b4cb5df5', 'Enrolled', 0, ''),
(40, 'Baby Sandoval', 'babysandoval@gmail.com', 'https://pickaface.net/gallery/avatar/43235812_161230_1542_3hqcg.png', '07531f695c7268a0d7dcccee53673f6d426c2b18', 'Enrolled', 0, ''),
(44, 'Mathew Dela Cruz', 'mathew@gmail.com', 'https://pickaface.net/gallery/avatar/43235812_161230_1542_3hqcg.png', '77447f779a24f225d070c6644d769f43943561ee', 'Not Enroll', 0, ''),
(45, 'Theresa', 'theresa@gmail.com', 'https://pickaface.net/gallery/avatar/Identical52046a933b5e3.png', 'd48fb850258d70befab7f052f64a8aa5f925da51', 'Enrolled', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `schedule` varchar(255) NOT NULL,
  `oras` varchar(25) NOT NULL,
  `created` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `schedule`, `oras`, `created`) VALUES
(26, 'MONDAY', '1:00 - 2:00 PM', '2020-12-13 03:48:27'),
(27, 'TUESDAY', '3:00 - 4:00 PM', '2021-01-19 14:45:13'),
(28, 'WEDNESDAY', '12:00 -2:00', '2021-01-21 10:05:44'),
(29, 'THURSDAY', '', '2021-01-21 10:11:02'),
(35, 'FRIDAY', '', '2021-01-21 10:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `schoolyear`
--

CREATE TABLE `schoolyear` (
  `id` int(11) NOT NULL,
  `schoolyear` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schoolyear`
--

INSERT INTO `schoolyear` (`id`, `schoolyear`, `created`) VALUES
(25, '2020-2022', '2021-01-19 14:54:42'),
(26, '2021-2022', '2021-01-09 17:00:52'),
(35, '2022-2023', '2021-07-20 10:02:02');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section`, `created`) VALUES
(10, 'Banana', '2020-12-13 03:58:21'),
(11, 'Rizal', '2020-12-13 03:58:42'),
(13, 'St. Lorenzo Ruiz', '2021-01-21 10:52:00'),
(16, 'ST. CATHERINE', '2021-01-21 11:14:07'),
(17, 'Sta. Martha', '2021-01-21 11:16:12'),
(19, 'St. Claire', '2021-07-20 10:04:59');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subject`, `created`) VALUES
(2, 'Filipino', '2020-12-12 07:52:02'),
(3, 'Science', '2020-12-11 08:09:31'),
(5, 'Math', '2020-12-11 08:17:02'),
(6, 'Science', '2020-12-12 07:52:09'),
(7, 'Araling Panlipunan', '2020-12-13 03:49:21'),
(9, 'CSS', '2020-12-13 03:52:44'),
(10, 'Media and Information Literacy', '2020-12-13 03:54:26'),
(12, 'CALCULUS I', '2021-01-21 10:06:33'),
(13, 'Pre Calculus', '2021-07-20 10:03:02');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `schedule` varchar(255) NOT NULL,
  `oras` char(25) NOT NULL,
  `created` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `student_name`, `course_id`, `subject`, `schedule`, `oras`, `created`) VALUES
(19, 'Janella Salvador', 27, 'Filipino', 'TUESDAY', '1:00 - 2:00 PM', '2021-08-20 11:05:22'),
(20, 'Alyssa Pagatpat', 28, 'Science', 'MONDAY', '3:00 - 4:00 PM', '2021-09-17 10:16:47'),
(21, 'Baby Ruth Adeva', 28, 'Math', 'TUESDAY', '3:00 - 4:00 PM', '2021-09-26 16:56:28'),
(22, 'Baby Ruth Adeva', 28, 'Araling Panlipunan', 'THURSDAY', '1:00 - 2:00 PM', '2021-09-26 16:56:55'),
(24, 'Alden Richard', 27, 'Science', 'TUESDAY', '1:00 - 2:00 PM', '2021-09-26 16:56:10'),
(25, 'Daisy Abing', 25, 'Filipino', 'MONDAY', '1:00 - 2:00 PM', '2021-09-17 10:23:56'),
(26, 'Daisy Abing', 25, 'Math', 'TUESDAY', '3:00 - 4:00 PM', '2021-09-17 10:24:11'),
(27, 'Baby Sandoval', 28, 'Math', 'THURSDAY', '3:00 - 4:00 PM', '2021-10-09 15:13:12'),
(28, 'Baby Sandoval', 28, 'Araling Panlipunan', 'TUESDAY', '3:00 - 4:00 PM', '2021-10-09 15:13:30'),
(29, 'Peppa Pig', 27, 'Media and Information Literacy', 'WEDNESDAY', '1:00 - 2:00 PM', '2021-10-09 15:13:43'),
(30, 'Baby Ruth Adeva', 26, '5', 'sunday ', 'wed', '2021-08-18 07:47:48'),
(31, 'Baby Sandoval', 26, 'Media and Information Literacy', 'MONDAY', '1:00 - 2:00', '2021-08-20 10:46:36'),
(32, 'Daisy Abing', 28, 'Science', 'TUESDAY', '12:00 -2:00', '2021-09-17 11:25:48'),
(33, 'Alyssa Pagatpat', 26, 'Science', 'TRYING', 'Select Time', '2021-08-20 10:42:33'),
(34, 'Alden Richard', 26, 'Pre Calculus', 'WEDNESDAY', '', '2021-08-20 10:38:55'),
(35, 'Name', 26, 'Science', 'TUESDAY', '2:00 - 3:00 PM', '2021-10-20 19:32:30'),
(36, 'Theresa', 28, 'Araling Panlipunan', 'WEDNESDAY', '2:00 - 3:00 PM', '2021-10-25 05:57:27');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `email`, `position`) VALUES
(10, 'MJ CAYAS', 'mjcayas@gmail.com', 'Teacher I'),
(14, 'JAMES BASTI VICTORIA', 'Jamesbasti@gmail.com', 'Teacher III'),
(15, 'Riegie Tan', 'riegietan@gmail.com', 'Teacher I');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `verification_code` text NOT NULL,
  `emaill_verified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `state` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`id`, `name`, `email`, `profile_image`, `password`, `status`, `code`, `state`) VALUES
(13, 'joshua', 'sandoval.joshuacute@gmail.com', '', '$2y$10$eE5HGTHMD6H.DVFSzE97EeCNTTIWy3G7lxgADH.a5/DIVM9lXkl8.', 'Pending', 0, 'verified'),
(23, 'maryjoy', 'maryjoycayas@gmail.com', 'https://pickaface.net/gallery/avatar/43235812_161230_1542_3hqcg.png', '$2y$10$B5p7XLTLojZSXJ8V.jY3yutGogKCiyuQKR/gDEVg/jtN21TKty9GO', 'Pending', 0, 'verified'),
(25, 'maryjoycayas', 'cayas_maryjoy@plpasig.edu.ph', 'https://pickaface.net/gallery/avatar/55373343_180307_1836_cojv.png', '$2y$10$Q70Ol3VI.cpnkoaqoKTX5OqzBnBJeuvgUjvP3.P9cQM2D7kF.7wCy', 'Pending', 0, 'verified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `enrollies`
--
ALTER TABLE `enrollies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_levels`
--
ALTER TABLE `grade_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oras`
--
ALTER TABLE `oras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered`
--
ALTER TABLE `registered`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `schoolyear`
--
ALTER TABLE `schoolyear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `enrollies`
--
ALTER TABLE `enrollies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `grade_levels`
--
ALTER TABLE `grade_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `oras`
--
ALTER TABLE `oras`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `registered`
--
ALTER TABLE `registered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `schoolyear`
--
ALTER TABLE `schoolyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
