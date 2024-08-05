-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2024 at 06:19 PM
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
-- Database: `_myschool_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `role`, `status`) VALUES
(1, 'email@mail.com', 'pass', 'developer', 1),
(2, 'email@mail.com', 'pass', 'developer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_logs`
--

CREATE TABLE `admin_logs` (
  `admin_log_id` int(20) NOT NULL,
  `log_message` varchar(500) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_logs`
--

INSERT INTO `admin_logs` (`admin_log_id`, `log_message`, `time`) VALUES
(1, 'Admin with <strong>ID: 1</strong> added <strong>student: ali</strong> to Database!', '03/08/2024 11:54 am'),
(2, 'Admin with <strong>ID: 1</strong> added <strong>student: abdullah</strong> to Database!', '03/08/2024 11:55 am'),
(3, 'Admin with <strong>ID: 1</strong> added <strong>student: mukarram</strong> to Database!', '03/08/2024 11:57 am'),
(4, 'Admin with <strong>ID: 1</strong> added <strong>student: qQQq</strong> to Database!', '03/08/2024 11:57 am'),
(5, 'Admin with <strong>ID: 1</strong> added <strong>student: </strong> to Database!', '03/08/2024 11:58 am'),
(6, 'Admin with <strong>ID: 1</strong> added <strong>student: Cccc</strong> to Database!', '03/08/2024 11:58 am'),
(7, 'Admin with <strong>ID: 1</strong> added <strong>student: </strong> to Database!', '03/08/2024 11:58 am'),
(8, 'Admin with <strong>ID: 1</strong> added <strong>student: o</strong> to Database!', '03/08/2024 11:59 am'),
(9, 'Admin with <strong>ID: 1</strong> added <strong>student: faizan</strong> to Database!', '03/08/2024 11:59 am'),
(10, 'Admin with <strong>ID: 1</strong> edited profile of <strong>student: new name</strong>!', '03/08/2024 01:22 pm'),
(11, 'Admin with <strong>ID: 1</strong> edited profile of <strong>student: ali</strong>!', '03/08/2024 01:27 pm'),
(12, 'Admin with <strong>ID: 1</strong> edited profile of <strong>student: ali</strong>!', '03/08/2024 01:27 pm'),
(13, 'Admin with <strong>ID: 1</strong> edited profile of <strong>student: ali</strong>!', '03/08/2024 01:27 pm'),
(14, 'Admin with <strong>ID: 1</strong> edited profile of <strong>student: Abdul Ghafoor</strong>!', '03/08/2024 02:39 pm'),
(15, 'Admin with <strong>ID: 1</strong> edited profile of <strong>teacher: Moawia</strong>!', '03/08/2024 02:50 pm'),
(16, 'Admin with <strong>ID: 1</strong> edited profile of <strong>teacher: Moawia</strong>!', '03/08/2024 02:51 pm'),
(17, 'Admin with <strong>ID: 1</strong> edited profile of <strong>teacher: Moawia</strong>!', '03/08/2024 02:52 pm'),
(18, 'Admin with <strong>ID: 1</strong> edited profile of <strong>teacher: Abdul Ghafoor</strong>!', '03/08/2024 02:53 pm'),
(19, 'Admin with <strong>ID: 1</strong> edited profile of <strong>student: new name</strong>!', '03/08/2024 02:54 pm'),
(20, 'Admin with <strong>ID: 1</strong> edited profile of <strong>student: ali</strong>!', '03/08/2024 02:54 pm'),
(21, 'Admin with <strong>ID: 1</strong> edited profile of <strong>student: ali</strong>!', '03/08/2024 02:54 pm'),
(22, 'Admin with <strong>ID: 1</strong> edited profile of <strong>student: ali</strong>!', '03/08/2024 02:54 pm'),
(23, 'Admin with <strong>ID: 1</strong> edited profile of <strong>teacher: Moawia</strong>!', '03/08/2024 02:55 pm'),
(24, 'Admin with <strong>ID: 1</strong> edited profile of <strong>teacher: Moawia</strong>!', '03/08/2024 02:59 pm'),
(25, 'Admin with <strong>ID: 1</strong> edited profile of <strong>teacher: Moaz</strong>!', '03/08/2024 03:07 pm'),
(26, 'Admin with <strong>ID: 1</strong> edited profile of <strong>teacher: Abdul Ghafoor</strong>!', '03/08/2024 03:09 pm'),
(27, 'Admin with <strong>ID: 1</strong> edited profile of <strong>teacher: ali</strong>!', '03/08/2024 03:10 pm'),
(28, 'Admin with <strong>ID: 1</strong> edited profile of <strong>teacher: ali</strong>!', '03/08/2024 03:12 pm'),
(29, 'Admin with <strong>ID: 1</strong> edited profile of <strong>teacher: addg</strong>!', '03/08/2024 03:12 pm'),
(30, 'Admin with <strong>ID: 1</strong> edited profile of <strong>teacher: addg</strong>!', '03/08/2024 03:13 pm'),
(31, 'Admin with <strong>ID: 1</strong> edited profile of <strong>teacher: addg</strong>!', '03/08/2024 03:14 pm'),
(32, 'Admin with <strong>ID: 1</strong> edited profile of <strong>teacher: Moa</strong>!', '03/08/2024 03:26 pm'),
(33, 'Admin with <strong>ID: 1</strong> edited profile of <strong>teacher: Mo</strong>!', '03/08/2024 03:26 pm'),
(34, 'Admin with <strong>ID: 1</strong> added <strong>teacher: Ibrar</strong> to Database!', '03/08/2024 03:30 pm'),
(35, 'Admin with <strong>ID: 1</strong> edited profile of <strong>student: hamza</strong>!', '03/08/2024 05:05 pm'),
(36, 'Admin with <strong>ID: 1</strong> added <strong>student: Ali</strong> to Database!', '04/08/2024 10:19 pm'),
(37, 'Admin with <strong>ID: 1</strong> added <strong>student: Hmaza</strong> to Database!', '04/08/2024 10:19 pm'),
(38, 'Admin with <strong>ID: 1</strong> added <strong>student: Elahi</strong> to Database!', '04/08/2024 10:20 pm'),
(39, 'Admin with <strong>ID: 1</strong> added <strong>student: Abu Bakar</strong> to Database!', '04/08/2024 10:21 pm'),
(40, 'Admin with <strong>ID: 1</strong> added <strong>student: Sultan</strong> to Database!', '04/08/2024 10:22 pm'),
(41, 'Admin with <strong>ID: 1</strong> added <strong>student: Butt</strong> to Database!', '04/08/2024 10:22 pm'),
(42, 'Admin with <strong>ID: 1</strong> added <strong>student: Talha</strong> to Database!', '04/08/2024 10:23 pm'),
(43, 'Admin with <strong>ID: 1</strong> added <strong>student: Nouman</strong> to Database!', '04/08/2024 10:24 pm');

-- --------------------------------------------------------

--
-- Table structure for table `all_classes`
--

CREATE TABLE `all_classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all_classes`
--

INSERT INTO `all_classes` (`class_id`, `class_name`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9'),
(10, '10');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_classes`
--

CREATE TABLE `assigned_classes` (
  `id` int(11) NOT NULL,
  `fk_teacher_id` int(11) NOT NULL,
  `fk_class_id` int(11) NOT NULL,
  `fk_section_id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(20) NOT NULL,
  `fk_student_id` int(20) NOT NULL,
  `attendance` varchar(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `fk_student_id`, `attendance`, `date`) VALUES
(25, 11, 'present', '2024-08-05'),
(26, 12, 'absent', '2024-08-05'),
(27, 13, 'present', '2024-08-05'),
(28, 14, 'present', '2024-08-05'),
(29, 15, 'present', '2024-08-05'),
(30, 16, 'present', '2024-08-05'),
(31, 17, 'present', '2024-08-05'),
(32, 18, 'present', '2024-08-05'),
(33, 11, 'present', '2024-08-05'),
(34, 12, 'absent', '2024-08-05'),
(35, 13, 'present', '2024-08-05'),
(36, 14, 'present', '2024-08-05'),
(37, 15, 'leave', '2024-08-05'),
(38, 16, 'present', '2024-08-05'),
(39, 17, 'absent', '2024-08-05'),
(40, 18, 'present', '2024-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `class_sections`
--

CREATE TABLE `class_sections` (
  `section_id` int(11) NOT NULL,
  `fk_class_id` int(11) NOT NULL,
  `section_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_sections`
--

INSERT INTO `class_sections` (`section_id`, `fk_class_id`, `section_name`) VALUES
(1, 1, 'A'),
(2, 1, 'B'),
(3, 2, 'A'),
(4, 2, 'B'),
(5, 3, 'A'),
(6, 3, 'B'),
(7, 4, 'A'),
(8, 4, 'B'),
(9, 5, 'A'),
(10, 5, 'B'),
(11, 6, 'A'),
(12, 6, 'B'),
(13, 7, 'A'),
(14, 7, 'B'),
(15, 8, 'A'),
(16, 8, 'B'),
(17, 9, 'A'),
(18, 9, 'B'),
(19, 10, 'A'),
(20, 10, 'B'),
(21, 10, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedule`
--

CREATE TABLE `exam_schedule` (
  `exam_schedule_id` int(11) NOT NULL,
  `fk_section_id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `notice_id` int(20) NOT NULL,
  `fk_student_id` int(20) NOT NULL,
  `notice_description` varchar(1000) NOT NULL,
  `notice_status` varchar(20) NOT NULL DEFAULT 'global',
  `time` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE `periods` (
  `period_id` int(11) NOT NULL,
  `fk_section_id` int(11) NOT NULL,
  `fk_timetable_id` int(11) NOT NULL,
  `period_name` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progress_report`
--

CREATE TABLE `progress_report` (
  `progress_id` int(11) NOT NULL,
  `fk_student_id` int(20) NOT NULL,
  `progress_remarks` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_profile_`
--

CREATE TABLE `school_profile_` (
  `id` int(11) NOT NULL,
  `about` varchar(400) NOT NULL,
  `image` varchar(255) NOT NULL,
  `school_id` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `o_name` varchar(255) NOT NULL,
  `slogan` varchar(255) NOT NULL,
  `private` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(150) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `email` varchar(150) NOT NULL,
  `expiry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_profile_`
--

INSERT INTO `school_profile_` (`id`, `about`, `image`, `school_id`, `name`, `o_name`, `slogan`, `private`, `address`, `city`, `contact`, `email`, `expiry`) VALUES
(5, 'A school is an educational institution where students receive formal instruction and learning under the guidance of teachers. Schools play a vital role in shaping the intellectual, social, and emotional development of students. They provide a structured environment for acquiring knowledge in various subjects, fostering critical thinking, creativity, and problem-solving skills. Schools also promote', '', '', 'allied', 'Ali raza', 'secure your future with allied', 'private', 'defence ', 'islambad', '78907876878', 'allieda@gmail.com', '0000-00-00'),
(6, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00'),
(7, '', '', '', '', '', '', '', '', '', '', '', '2024-08-14'),
(8, '', '', '', '', '', '', '', '', '', '', '', '2024-08-14'),
(9, 'A school is an educational institution where students receive formal instruction and learning under the guidance of teachers. Schools play a vital role in shaping the intellectual, social, and emotional development of students. They provide a structured environment for acquiring knowledge in various subjects, fostering critical thinking, creativity, and problem-solving skills. Schools also promote', '', '', 'Dar e Arqam School', 'Altaf Hussain', '\"Empowering Minds, Shaping Futures\"', 'private', 'Gulbarg Lahore', 'Lahore', '03245434454534', 'darearqam@gmail.com', '2025-03-03'),
(10, 'A school is an educational institution where students receive formal instruction and learning under the guidance of teachers. Schools play a vital role in shaping the intellectual, social, and emotional development of students. They provide a structured environment for acquiring knowledge in various subjects, fostering critical thinking, creativity, and problem-solving skills. Schools also promote', '', '', 'Dar e Arqam School', 'Altaf Hussain', '', 'private', 'Gujrnawala', 'Lahore', '03245434454534', 'darearqam@gmail.com', '2025-03-03'),
(11, 'A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school ', '', '3', 'Dar e Arqam School', 'Altaf Hussain', '', 'private', 'Gujrnawala', 'Lahore', '03245434454534', 'darearqam@gmail.com', '2025-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `student_class`
--

CREATE TABLE `student_class` (
  `student_class_id` int(11) NOT NULL,
  `fk_student_id` int(20) NOT NULL,
  `fk_class_id` int(11) NOT NULL,
  `fk_section_id` int(11) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_class`
--

INSERT INTO `student_class` (`student_class_id`, `fk_student_id`, `fk_class_id`, `fk_section_id`, `status`) VALUES
(11, 11, 1, 1, 1),
(12, 12, 1, 1, 1),
(13, 13, 1, 1, 1),
(14, 14, 1, 1, 1),
(15, 15, 1, 1, 1),
(16, 16, 1, 1, 1),
(17, 17, 1, 1, 1),
(18, 18, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_fee`
--

CREATE TABLE `student_fee` (
  `fee_id` int(11) NOT NULL,
  `fk_student_id` int(20) NOT NULL,
  `year` varchar(20) NOT NULL,
  `month` varchar(20) NOT NULL,
  `fee_status` varchar(20) NOT NULL,
  `pending_dues` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_profile`
--

CREATE TABLE `student_profile` (
  `student_id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cnic` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(500) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `roll_no` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `student_status` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_profile`
--

INSERT INTO `student_profile` (`student_id`, `name`, `cnic`, `dob`, `address`, `mobile_no`, `roll_no`, `image`, `email`, `password`, `student_status`) VALUES
(11, 'Ali', '038484767777', '2024-08-04', 'gujranwala', '0378383883', '937839', '', 'email', '1234567', 1),
(12, 'Hmaza', '0398390883', '2024-08-04', 'gujranwala', '903293739', '937387', '', 'email', '1234567', 1),
(13, 'Elahi', '8329798234', '2024-08-04', 'Gujranwala', '03983793', '039803893', '', 'email', '1234567', 1),
(14, 'Abu Bakar', '038393983', '2024-08-04', 'Gujranwala', '0399303993', '309894', '', 'email', '1234567', 1),
(15, 'Sultan', '039404949', '2024-08-04', 'Gujranwala', '038333783', '039388', '', 'email', '1234567', 1),
(16, 'Butt', '23893883773', '2024-08-04', 'Gujranwala', '0937839', '0393893', '', 'email', '1234567', 1),
(17, 'Talha', '0893883883', '2024-08-04', 'Gujranwala', '038389837', '0383783', '', 'email', '1234567', 1),
(18, 'Nouman', '03883834443', '2024-08-04', 'Gujranwala', '083378838', '837848', '', 'email', '1234567', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_profile`
--

CREATE TABLE `teacher_profile` (
  `teacher_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cnic` varchar(100) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `phone_no` varchar(50) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `school_id` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_profile`
--

INSERT INTO `teacher_profile` (`teacher_id`, `name`, `cnic`, `f_name`, `phone_no`, `qualification`, `dob`, `address`, `email`, `school_id`, `image`, `password`) VALUES
(181, 'Mo', '0938763583373', 'Abdul Ghafoor', '0387389', 'jdk', '0000-00-00', '', 'email@mail.com', '937u3', '', ''),
(182, '', '', '', '', 'k', '0000-00-00', '', '', '', '', ''),
(183, 'addg', '9398763789029', 'ajdl', '09876289373', 'cs', '2024-08-13', 'Gujranwala', 'email@mail.com', '9387484', '', '123'),
(184, 'Ibrar', '08763563789383', 'Abdul Ghani', '08736673893', 'BS(Botany)', '2024-08-22', 'Gujranwala', 'eamil@mail.com', '93873', '', '123');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `timetable_id` int(11) NOT NULL,
  `fk_section_id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`admin_log_id`);

--
-- Indexes for table `all_classes`
--
ALTER TABLE `all_classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `assigned_classes`
--
ALTER TABLE `assigned_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_teacher_id` (`fk_teacher_id`),
  ADD KEY `fk_teacher_section_id` (`fk_section_id`),
  ADD KEY `fk_teacher_class_id` (`fk_class_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `fk_student_attendance_id` (`fk_student_id`);

--
-- Indexes for table `class_sections`
--
ALTER TABLE `class_sections`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `fk_class_section_id` (`fk_class_id`);

--
-- Indexes for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD PRIMARY KEY (`exam_schedule_id`),
  ADD KEY `fk_section_exam_id` (`fk_section_id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`period_id`),
  ADD KEY `fk_section_period_id` (`fk_section_id`),
  ADD KEY `fk_section_timetable_id` (`fk_timetable_id`);

--
-- Indexes for table `progress_report`
--
ALTER TABLE `progress_report`
  ADD PRIMARY KEY (`progress_id`),
  ADD KEY `fk_student_progress_id` (`fk_student_id`);

--
-- Indexes for table `school_profile_`
--
ALTER TABLE `school_profile_`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_class`
--
ALTER TABLE `student_class`
  ADD PRIMARY KEY (`student_class_id`),
  ADD KEY `fk_student_class_id` (`fk_student_id`),
  ADD KEY `fk_student_class` (`fk_class_id`),
  ADD KEY `fk_student_section` (`fk_section_id`);

--
-- Indexes for table `student_fee`
--
ALTER TABLE `student_fee`
  ADD PRIMARY KEY (`fee_id`),
  ADD KEY `fk_student_fee_id` (`fk_student_id`);

--
-- Indexes for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`timetable_id`),
  ADD KEY `fk_section_table_id` (`fk_section_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `admin_log_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `all_classes`
--
ALTER TABLE `all_classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `assigned_classes`
--
ALTER TABLE `assigned_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `class_sections`
--
ALTER TABLE `class_sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  MODIFY `exam_schedule_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `notice_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `period_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `progress_report`
--
ALTER TABLE `progress_report`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_profile_`
--
ALTER TABLE `school_profile_`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_class`
--
ALTER TABLE `student_class`
  MODIFY `student_class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `student_fee`
--
ALTER TABLE `student_fee`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_profile`
--
ALTER TABLE `student_profile`
  MODIFY `student_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigned_classes`
--
ALTER TABLE `assigned_classes`
  ADD CONSTRAINT `fk_teacher_class_id` FOREIGN KEY (`fk_class_id`) REFERENCES `all_classes` (`class_id`),
  ADD CONSTRAINT `fk_teacher_id` FOREIGN KEY (`fk_teacher_id`) REFERENCES `teacher_profile` (`teacher_id`),
  ADD CONSTRAINT `fk_teacher_section_id` FOREIGN KEY (`fk_section_id`) REFERENCES `class_sections` (`section_id`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_student_attendance_id` FOREIGN KEY (`fk_student_id`) REFERENCES `student_profile` (`student_id`);

--
-- Constraints for table `class_sections`
--
ALTER TABLE `class_sections`
  ADD CONSTRAINT `fk_class_section_id` FOREIGN KEY (`fk_class_id`) REFERENCES `all_classes` (`class_id`);

--
-- Constraints for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD CONSTRAINT `fk_section_exam_id` FOREIGN KEY (`fk_section_id`) REFERENCES `class_sections` (`section_id`);

--
-- Constraints for table `periods`
--
ALTER TABLE `periods`
  ADD CONSTRAINT `fk_section_period_id` FOREIGN KEY (`fk_section_id`) REFERENCES `class_sections` (`section_id`),
  ADD CONSTRAINT `fk_section_timetable_id` FOREIGN KEY (`fk_timetable_id`) REFERENCES `timetable` (`timetable_id`);

--
-- Constraints for table `progress_report`
--
ALTER TABLE `progress_report`
  ADD CONSTRAINT `fk_student_progress_id` FOREIGN KEY (`fk_student_id`) REFERENCES `student_profile` (`student_id`);

--
-- Constraints for table `student_class`
--
ALTER TABLE `student_class`
  ADD CONSTRAINT `fk_student_class` FOREIGN KEY (`fk_class_id`) REFERENCES `all_classes` (`class_id`),
  ADD CONSTRAINT `fk_student_class_id` FOREIGN KEY (`fk_student_id`) REFERENCES `student_profile` (`student_id`),
  ADD CONSTRAINT `fk_student_section` FOREIGN KEY (`fk_section_id`) REFERENCES `class_sections` (`section_id`);

--
-- Constraints for table `student_fee`
--
ALTER TABLE `student_fee`
  ADD CONSTRAINT `fk_student_fee_id` FOREIGN KEY (`fk_student_id`) REFERENCES `student_profile` (`student_id`);

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `fk_section_table_id` FOREIGN KEY (`fk_section_id`) REFERENCES `class_sections` (`section_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
