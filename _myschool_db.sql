-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2024 at 11:52 AM
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
(36, 'Admin with <strong>ID: 1</strong> added <strong>student: ali</strong> to Database!', '07/08/2024 12:30 pm'),
(37, 'Admin with <strong>ID: 1</strong> added <strong>student: hamza</strong> to Database!', '07/08/2024 12:31 pm'),
(38, 'Admin with <strong>ID: 1</strong> added <strong>student: talha</strong> to Database!', '07/08/2024 12:31 pm'),
(39, 'Admin with <strong>ID: 1</strong> added <strong>student: Butt</strong> to Database!', '07/08/2024 12:32 pm'),
(40, 'Admin with <strong>ID: 1</strong> added <strong>teacher: mbvdfghj</strong> to Database!', '07/08/2024 01:20 pm');

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
(1, 1, 'present', '2024-08-07'),
(2, 1, 'present', '2024-08-07'),
(3, 5, 'absent', '2024-08-07'),
(4, 13, 'present', '2024-08-07'),
(5, 14, 'present', '2024-08-07');

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
(20, 10, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedule`
--

CREATE TABLE `exam_schedule` (
  `exam_schedule_id` int(11) NOT NULL,
  `fk_section_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(20) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_receiving`
--

CREATE TABLE `expense_receiving` (
  `er_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `expense` varchar(100) NOT NULL,
  `receiving` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense_receiving`
--

INSERT INTO `expense_receiving` (`er_id`, `image`, `comment`, `expense`, `receiving`, `date`) VALUES
(3, 'images-2.jpg', 'The exp', '12', '0', '2024-08-06'),
(4, '_large_image_4.jpg', 'The tea', '635', '0', '2024-08-06'),
(5, '_large_image_3.jpg', 'Given to owner', '10000', '0', '2024-08-06'),
(6, 'images-4.jpg', 'Spent on construction', '20000', '0', '2024-08-06'),
(7, 'images-6.jpg', 'the expense', '1200', '0', '2024-08-06'),
(8, 'images-44.jpg', 'a new table test', '1200', '0', '2024-08-07'),
(9, 'images-28.jpg', 'the new test', '1200', '0', '2024-08-07'),
(10, '_large_image_2.jpg', 'refresh test', '12000', '0', '2024-08-07'),
(11, 'images-50.jpg', 'refresh test', '120489', '0', '2024-08-07'),
(12, 'images-31.jpg', 'the receiving', '0', '1399347', '2024-08-07'),
(13, '_large_image_1.jpg', 'expense 1', '13000', '0', '2024-08-08'),
(14, 'images-3.jpg', 'expense 3', '340000', '0', '2024-08-08'),
(15, 'images-20.jpg', 'new receiving', '0', '12000', '2024-08-08'),
(16, 'images-32.jpg', 'ecpence', '120000', '0', '2024-08-08'),
(17, 'images-33.jpg', 'the cost', '30000', '0', '2024-08-08'),
(18, 'images-43.jpg', 'the cost 2', '70000', '0', '2024-08-08');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `notice_id` int(20) NOT NULL,
  `fk_student_id` int(20) NOT NULL,
  `notice_description` varchar(1000) NOT NULL,
  `notice_status` varchar(20) NOT NULL DEFAULT 'global',
  `notice_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`notice_id`, `fk_student_id`, `notice_description`, `notice_status`, `notice_date`) VALUES
(1, 0, 'This is notice', 'global', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE `periods` (
  `period_id` int(11) NOT NULL,
  `fk_section_id` int(11) NOT NULL,
  `fk_timetable_id` int(11) NOT NULL,
  `period_name` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
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
(11, 'A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school A school ', '', '3', 'Dar e Arqam School', 'Altaf Hussain', '', 'private', 'Gujrnawala', 'Lahore', '03245434454534', 'darearqam@gmail.com', '2025-03-03'),
(12, 'It has good teachers who teach in a way that helps students learn. My school has 2 grassy playgrounds for outdoor sports. There is a good reputation for my school in the city.', '', '2', 'Savy School', 'Munawwar Hussain', 'We strive to Learn', 'private', 'Rahwali, Gujranwala Cantt', 'Gujranwala', '03265434765', 'savyschool@gmail.com', '2025-03-04');

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
(1, 1, 1, 1, 1),
(2, 2, 1, 2, 1),
(3, 3, 2, 3, 1),
(4, 4, 6, 12, 1),
(5, 5, 10, 20, 1),
(7, 6, 5, 9, 1),
(8, 5, 10, 20, 1),
(9, 9, 9, 17, 1),
(10, 10, 4, 8, 1),
(11, 1, 1, 1, 1),
(12, 5, 1, 1, 1),
(13, 13, 1, 1, 1),
(14, 14, 1, 1, 1);

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
(1, 'ali', '34567890', '2024-08-07', 'gujranwala', '4567845678', '23445g', '', 'email@mail.com', '1234567', 1),
(2, 'abdullah', '23456789', '2024-07-30', 'Rahwali Cantt', '345678678', '342342', '', 'email', '1234567', 1),
(3, 'mukarram ali', '09876543', '2024-08-07', 'sargoodha', '1234567890', '0987654321', '', 'email@mail.com', '1234567', 1),
(4, 'new name', '673938738903', '2024-08-30', 'sjkd', '038763536789', '386378', '', 'email@mail.com', '1234567', 1),
(5, 'hamza', 'A', '0000-00-00', 'A', 'A', 'A', '', 'email@mail.com', '1234567', 1),
(6, 'Cccc', 'c', '0000-00-00', 'c', 'c', 'c', '', 'email', '1234567', 1),
(7, 'Cccc', 'c', '0000-00-00', 'c', 'c', 'c', '', 'email', '1234567', 1),
(8, '', 'l', '0000-00-00', 'l', 'l', 'l', '', 'email', '1234567', 1),
(9, 'o', 'o', '0000-00-00', 'o', 'o', 'o', '', 'email', '1234567', 1),
(10, 'faizan', '345734895', '2024-08-02', 'lahore', '1234567890', '789', '', 'email', '1234567', 1),
(11, 'ali', '9389', '2024-08-07', 'lajkfd', '0287389', '9387893', '', 'email', '1234567', 1),
(12, 'hamza', '09876378390', '2024-08-15', 'kjhdgshjkdsl', '928778290', '0928789', '', 'email', '1234567', 1),
(13, 'talha', '039873890', '2024-08-23', 'ksjhdhjkdl', '0398763789', '93873890', '', 'email', '1234567', 1),
(14, 'Butt', '039873890', '2024-08-07', 'sjhjskd', '03987839', '9387839', '', 'email', '1234567', 1);

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
(181, 'Maria', '0938763583373', 'Abdul Ghafoor', '0387389', 'jdk', '0000-00-00', '', 'email@mail.com', '937u3', '', ''),
(182, 'Ghazanfar', '', '', '', 'k', '0000-00-00', '', '', '', '', ''),
(183, 'Hammad', '9398763789029', 'ajdl', '09876289373', 'cs', '2024-08-13', 'Gujranwala', 'email@mail.com', '9387484', '', '123'),
(184, 'Ayesha', '08763563789383', 'Abdul Ghani', '08736673893', 'BS(Botany)', '2024-08-22', 'Gujranwala', 'eamil@mail.com', '93873', '', '123'),
(185, 'Ali', '', '', '', '', '0000-00-00', '', '', '', '', '');

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
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`timetable_id`, `fk_section_id`, `day`) VALUES
(7, 9, 'Monday'),
(8, 9, 'Tuesday'),
(9, 9, 'Wednesday'),
(10, 9, 'Thursday'),
(11, 9, 'Friday'),
(12, 9, 'Saturday'),
(13, 10, 'Monday'),
(14, 10, 'Tuesday'),
(15, 10, 'Wednesday'),
(16, 10, 'Thursday'),
(17, 10, 'Friday'),
(18, 10, 'Saturday'),
(19, 17, 'Monday'),
(20, 17, 'Tuesday'),
(21, 17, 'Wednesday'),
(22, 17, 'Thursday'),
(23, 17, 'Friday'),
(24, 17, 'Saturday'),
(25, 2, 'Monday'),
(26, 2, 'Tuesday'),
(27, 2, 'Wednesday'),
(28, 2, 'Thursday'),
(29, 2, 'Friday'),
(30, 2, 'Saturday');

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
-- Indexes for table `expense_receiving`
--
ALTER TABLE `expense_receiving`
  ADD PRIMARY KEY (`er_id`);

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
  MODIFY `admin_log_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
  MODIFY `attendance_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `class_sections`
--
ALTER TABLE `class_sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  MODIFY `exam_schedule_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_receiving`
--
ALTER TABLE `expense_receiving`
  MODIFY `er_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `notice_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `period_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `progress_report`
--
ALTER TABLE `progress_report`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_profile_`
--
ALTER TABLE `school_profile_`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_class`
--
ALTER TABLE `student_class`
  MODIFY `student_class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student_fee`
--
ALTER TABLE `student_fee`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_profile`
--
ALTER TABLE `student_profile`
  MODIFY `student_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
