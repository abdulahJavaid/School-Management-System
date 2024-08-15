-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2024 at 05:41 PM
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
(2, 'email@mail.com', 'pass', 'developer', 1),
(3, 'email@gmail.com', 'pass', 'accountant', 1);

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
(40, 'Admin with <strong>ID: 1</strong> added <strong>teacher: mbvdfghj</strong> to Database!', '07/08/2024 01:20 pm'),
(41, 'Admin with <strong>ID: 1</strong> added <strong>student: Ali Abdullah</strong> to Database!', '12/08/2024 11:58 am'),
(42, 'Admin with <strong>ID: 1</strong> added <strong>student: Abdullah Cheema</strong> to Database!', '12/08/2024 11:59 am'),
(43, 'Admin with <strong>ID: 1</strong> added <strong>student: Tayyab Awan</strong> to Database!', '12/08/2024 12:03 pm'),
(44, 'Admin with <strong>ID: 1</strong> added <strong>student: Rana Hassan</strong> to Database!', '12/08/2024 12:05 pm'),
(45, 'Admin with <strong>ID: 1</strong> added <strong>student: Humayun</strong> to Database!', '12/08/2024 12:07 pm'),
(46, 'Admin with <strong>ID: 1</strong> added <strong>student: Rafay Saeed</strong> to Database!', '12/08/2024 12:08 pm'),
(47, 'Admin with <strong>ID: 1</strong> added <strong>student: Ibrar Ali</strong> to Database!', '12/08/2024 12:09 pm'),
(48, 'Admin with <strong>ID: 1</strong> added <strong>student: Talha Zahid</strong> to Database!', '12/08/2024 12:10 pm'),
(49, 'Admin with <strong>ID: 1</strong> added <strong>student: Gheyas Elahi</strong> to Database!', '12/08/2024 12:11 pm'),
(50, 'Admin with <strong>ID: 1</strong> added <strong>student: Ali Hassan</strong> to Database!', '12/08/2024 12:12 pm'),
(51, 'Admin with <strong>ID: 1</strong> added <strong>student: Asim Butt</strong> to Database!', '12/08/2024 12:13 pm'),
(52, 'Admin with <strong>ID: 1</strong> added <strong>student: Musa Butt</strong> to Database!', '12/08/2024 12:14 pm'),
(53, 'Admin with <strong>ID: 1</strong> added <strong>student: Aqib Jutt</strong> to Database!', '12/08/2024 12:15 pm'),
(54, 'Admin with <strong>ID: 1</strong> added <strong>student: Usman Shafique</strong> to Database!', '12/08/2024 12:18 pm'),
(55, 'Admin with <strong>ID: 1</strong> added <strong>student: Ahmad Talal</strong> to Database!', '12/08/2024 12:19 pm'),
(56, 'Admin with <strong>ID: 1</strong> added <strong>student: Mujhtaba Abid</strong> to Database!', '12/08/2024 12:20 pm'),
(57, 'Admin with <strong>ID: 1</strong> added <strong>student: Saqib Mehmood</strong> to Database!', '12/08/2024 12:21 pm'),
(58, 'Admin with <strong>ID: 1</strong> added <strong>student: Masood Faridi</strong> to Database!', '12/08/2024 12:22 pm'),
(59, 'Admin with <strong>ID: 1</strong> added <strong>student: Haider Niazi</strong> to Database!', '12/08/2024 12:23 pm'),
(60, 'Admin with <strong>ID: 1</strong> added <strong>student: Mehrose Niazi</strong> to Database!', '12/08/2024 12:24 pm'),
(61, 'Admin with <strong>ID: 1</strong> added <strong>student: Ali Zahid</strong> to Database!', '12/08/2024 12:25 pm'),
(62, 'Admin with <strong>ID: 1</strong> added <strong>student: Haroon Butt</strong> to Database!', '12/08/2024 12:30 pm'),
(63, 'Admin with <strong>ID: 1</strong> added <strong>student: Ali Raza</strong> to Database!', '12/08/2024 12:31 pm'),
(64, 'Admin with <strong>ID: 1</strong> added <strong>student: Khurram Shehzad</strong> to Database!', '12/08/2024 12:32 pm'),
(65, 'Admin with <strong>ID: 1</strong> added <strong>student: Babar Azam</strong> to Database!', '12/08/2024 12:33 pm'),
(66, 'Admin with <strong>ID: 1</strong> added <strong>student: Rizwan Malik</strong> to Database!', '12/08/2024 12:33 pm'),
(67, 'Admin with <strong>ID: 1</strong> added <strong>student: Shaheen Afridi</strong> to Database!', '12/08/2024 12:34 pm'),
(68, 'Admin with <strong>ID: 1</strong> added <strong>student: Haris Rouf</strong> to Database!', '12/08/2024 12:35 pm'),
(69, 'Admin with <strong>ID: 1</strong> added <strong>student: Misbah</strong> to Database!', '12/08/2024 12:37 pm'),
(70, 'Admin with <strong>ID: 1</strong> added <strong>student: Mateen Malik</strong> to Database!', '12/08/2024 12:38 pm'),
(71, 'Admin with <strong>ID: 1</strong> added <strong>student: Wahab Gujjar</strong> to Database!', '12/08/2024 12:38 pm'),
(72, 'Admin with <strong>ID: 1</strong> added <strong>student: Wahab Riaz</strong> to Database!', '12/08/2024 12:39 pm'),
(73, 'Admin with <strong>ID: 1</strong> added <strong>student: Muhammad Amir</strong> to Database!', '12/08/2024 12:40 pm'),
(74, 'Admin with <strong>ID: 1</strong> added <strong>student: Asif Butt</strong> to Database!', '12/08/2024 12:41 pm'),
(75, 'Admin with <strong>ID: 1</strong> added <strong>student: Rustam Virk</strong> to Database!', '12/08/2024 12:43 pm'),
(76, 'Admin with <strong>ID: 1</strong> added <strong>student: Talha Bajwa</strong> to Database!', '12/08/2024 12:44 pm'),
(77, 'Admin with <strong>ID: 1</strong> added <strong>student: Shahid Afridi</strong> to Database!', '12/08/2024 12:44 pm'),
(78, 'Admin with <strong>ID: 1</strong> added <strong>student: Abdullah Javaid</strong> to Database!', '12/08/2024 12:45 pm'),
(79, 'Admin with <strong>ID: 1</strong> added <strong>student: Abdul Rasheed</strong> to Database!', '12/08/2024 12:46 pm'),
(80, 'Admin with <strong>ID: 1</strong> added <strong>student: Abdul Razzaq</strong> to Database!', '12/08/2024 12:47 pm');

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
-- Table structure for table `combined_progress`
--

CREATE TABLE `combined_progress` (
  `combined_progress_id` int(11) NOT NULL,
  `fk_student_id` varchar(10) NOT NULL,
  `combined_grade` varchar(10) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(18, 'images-43.jpg', 'the cost 2', '70000', '0', '2024-08-08'),
(19, '', 'Student Ali Abdullah, reg# 233 - paid: Rs. 500 with pending dues: Rs. 1000', '0', '500', '2024-08-13'),
(20, '', 'Student: Shahid Afridi, reg# 269 paid full fee amount Rs.7000 (Monthly Fee)', '0', '7000', '2024-08-13'),
(21, '', 'Student Musa Butt, reg# 244 paid fee amount Rs.2000 with pending dues Rs.1000 (Monthly Fee)', '0', '2000', '2024-08-13'),
(22, '', 'Student Abdul Razzaq, reg# 272 paid full fee amount Rs.7000 (Monthly Fee)', '0', '7000', '2024-08-13'),
(23, '', 'Student Abdul Rasheed, reg# 271 paid fee amount Rs.6500 with pending dues Rs.500 (Monthly Fee)', '0', '6500', '2024-08-13'),
(24, '', 'Student Ibrar Ali, reg# 239 paid fee amount Rs.1800 with pending dues Rs.200 (Monthly Fee)', '0', '1800', '2024-08-13'),
(25, '', 'Student Ali Raza, reg# 255 paid fee amount Rs.4000 with pending dues Rs.1000 (Monthly Fee)', '0', '4000', '2024-08-13'),
(26, '', 'Student Ali Hassan, reg# 242 paid full fee amount Rs.3000 (Monthly Fee)', '0', '3000', '2024-08-13'),
(27, '', 'Student Gheyas Elahi, reg# 241 paid full fee amount Rs.3000 (Monthly Fee)', '0', '3000', '2024-08-13'),
(28, '', 'Student Rana Hassan, reg# 236 paid full fee amount Rs.1500 (Monthly Fee)', '0', '1500', '2024-08-13'),
(29, '', 'Student Abdullah Cheema, reg# 234 paid fee amount Rs.1450 with pending dues Rs.50 (Monthly Fee)', '0', '1450', '2024-08-13'),
(30, '', 'Student Rizwan Malik, reg# 258 paid fee amount Rs.5000 with pending dues Rs.500 (Monthly Fee)', '0', '5000', '2024-08-13'),
(31, '', 'Student Talha Zahid, reg# 240 paid full fee amount Rs.2000 (Monthly Fee)', '0', '2000', '2024-08-13'),
(32, '', 'Student Rafay Saeed, reg# 238 paid full fee amount Rs.2000 (Monthly Fee)', '0', '2000', '2024-08-13'),
(33, '', 'Student Usman Shafique, reg# 246 paid full fee amount Rs.4000 (Monthly Fee)', '0', '4000', '2024-08-13'),
(34, '', 'Student Ahmad Talal, reg# 247 paid fee amount Rs.1000 with pending dues Rs.3000 (Monthly Fee)', '0', '1000', '2024-08-13'),
(35, '', 'Student Wahab Riaz, reg# 264 paid fee amount Rs.5000 with pending dues Rs.1000 (Monthly Fee)', '0', '5000', '2024-08-13'),
(36, '', 'Student Haider Niazi, reg# 251 paid full fee amount Rs.4500 (Monthly Fee)', '0', '4500', '2024-08-13'),
(37, '', 'Student Saqib Mehmood, reg# 249 paid full fee amount Rs.4500 (Monthly Fee)', '0', '4500', '2024-08-13'),
(38, '', 'Student Masood Faridi, reg# 250 paid fee amount Rs.4200 with pending dues Rs.300 (Monthly Fee)', '0', '4200', '2024-08-13'),
(39, '', 'Student Tayyab Awan, reg# 235 paid full fee amount Rs.1500 (Monthly Fee)', '0', '1500', '2024-08-13'),
(40, '', 'Student Ali Zahid, reg# 253 paid fee amount Rs.4000 with pending dues Rs.1000 (Monthly Fee)', '0', '4000', '2024-08-13'),
(41, '', 'Student Ali Abdullah, reg# 233 paid full fee amount Rs.1500 (Monthly Fee)', '0', '1500', '2024-08-13'),
(42, '', 'Student Humayun, reg# 237 paid full fee amount Rs.2000 (Monthly Fee)', '0', '2000', '2024-08-13'),
(43, '', 'Student Aqib Jutt, reg# 245 paid fee amount Rs.3500 with pending dues Rs.500 (Monthly Fee)', '0', '3500', '2024-08-13'),
(44, '', 'Student Mujhtaba Abid, reg# 248 paid fee amount Rs.3400 with pending dues Rs.600 (Monthly Fee)', '0', '3400', '2024-08-13'),
(45, '', 'Student Haroon Butt, reg# 254 paid full fee amount Rs.5000 (Monthly Fee)', '0', '5000', '2024-08-13'),
(46, '', 'Student Mehrose Niazi, reg# 252 paid full fee amount Rs.4500 (Monthly Fee)', '0', '4500', '2024-08-13'),
(47, '', 'Student Khurram Shehzad, reg# 256 paid fee amount Rs.4000 with pending dues Rs.1000 (Monthly Fee)', '0', '4000', '2024-08-13'),
(48, '', 'Student Babar Azam, reg# 257 paid fee amount Rs.5400 with pending dues Rs.100 (Monthly Fee)', '0', '5400', '2024-08-13'),
(49, '', 'Student Shaheen Afridi, reg# 259 paid fee amount Rs.5300 with pending dues Rs.200 (Monthly Fee)', '0', '5300', '2024-08-13'),
(50, '', 'Student Haris Rouf, reg# 260 paid fee amount Rs.5000 with pending dues Rs.500 (Monthly Fee)', '0', '5000', '2024-08-13'),
(51, '', 'Student Misbah, reg# 261 paid full fee amount Rs.6000 (Monthly Fee)', '0', '6000', '2024-08-13'),
(52, '', 'Student Mateen Malik, reg# 262 paid full fee amount Rs.6000 (Monthly Fee)', '0', '6000', '2024-08-13'),
(53, '', 'Student Wahab Gujjar, reg# 263 paid fee amount Rs.5300 with pending dues Rs.700 (Monthly Fee)', '0', '5300', '2024-08-13'),
(54, '', 'Student Muhammad Amir, reg# 265 paid fee amount Rs.5600 with pending dues Rs.400 (Monthly Fee)', '0', '5600', '2024-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `homework_diary`
--

CREATE TABLE `homework_diary` (
  `homework_id` int(11) NOT NULL,
  `fk_section_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `subject_diary` text NOT NULL,
  `date` date NOT NULL
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

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`period_id`, `fk_section_id`, `fk_timetable_id`, `period_name`, `time`) VALUES
(379, 20, 31, 'Math - teacher not-assigned', 'time'),
(380, 20, 32, 'subject not-assigned - Maria', 'time'),
(381, 20, 33, 'Math - Maria', 'time'),
(382, 20, 34, 'break', 'time'),
(383, 20, 35, 'break', 'time'),
(384, 20, 36, '---', 'time'),
(385, 20, 31, '---', 'time'),
(386, 20, 32, '---', 'time'),
(387, 20, 33, '---', 'time'),
(388, 20, 34, '---', 'time'),
(389, 20, 35, '---', 'time'),
(390, 20, 36, '---', 'time'),
(391, 20, 31, '---', 'time'),
(392, 20, 32, '---', 'time'),
(393, 20, 33, '---', 'time'),
(394, 20, 34, '---', 'time'),
(395, 20, 35, '---', 'time'),
(396, 20, 36, '---', 'time'),
(397, 20, 31, '---', 'time'),
(398, 20, 32, '---', 'time'),
(399, 20, 33, '---', 'time'),
(400, 20, 34, '---', 'time'),
(401, 20, 35, '---', 'time'),
(402, 20, 36, '---', 'time'),
(403, 20, 31, '---', 'time'),
(404, 20, 32, '---', 'time'),
(405, 20, 33, '---', 'time'),
(406, 20, 34, '---', 'time'),
(407, 20, 35, '---', 'time'),
(408, 20, 36, '---', 'time'),
(409, 20, 31, '---', 'time'),
(410, 20, 32, '---', 'time'),
(411, 20, 33, '---', 'time'),
(412, 20, 34, '---', 'time'),
(413, 20, 35, '---', 'time'),
(414, 20, 36, '---', 'time'),
(415, 20, 31, '---', 'time'),
(416, 20, 32, '---', 'time'),
(417, 20, 33, '---', 'time'),
(418, 20, 34, '---', 'time'),
(419, 20, 35, '---', 'time'),
(420, 20, 36, '---', 'time'),
(421, 20, 31, '---', 'time'),
(422, 20, 32, '---', 'time'),
(423, 20, 33, '---', 'time'),
(424, 20, 34, '---', 'time'),
(425, 20, 35, '---', 'time'),
(426, 20, 36, '---', 'time'),
(427, 20, 31, '---', 'time'),
(428, 20, 32, '---', 'time'),
(429, 20, 33, '---', 'time'),
(430, 20, 34, '---', 'time'),
(431, 20, 35, '---', 'time'),
(432, 20, 36, '---', 'time'),
(433, 8, 37, 'subject not-assigned - Ghazanfar', '8:30 - 9:30'),
(434, 8, 38, 'English - teacher not-assigned', '8:30 - 9:30'),
(435, 8, 39, 'English - Hammad', '8:30 - 9:30'),
(436, 8, 40, 'History - Ali', '8:30 - 9:30'),
(437, 8, 41, 'Islamiat - Hammad', '8:30 - 9:30'),
(438, 8, 42, '---', '8:30 - 9:30'),
(439, 8, 37, 'Urdu - Hammad', '9:30-10:30'),
(440, 8, 38, 'Urdu - Ghazanfar', '9:30-10:30'),
(441, 8, 39, 'Urdu - Ayesha', '9:30-10:30'),
(442, 8, 40, 'Math - Ghazanfar', '9:30-10:30'),
(443, 8, 41, 'English - Ayesha', '9:30-10:30'),
(444, 8, 42, '---', '9:30-10:30'),
(445, 8, 37, 'Urdu - Maria', '10:30-11:30'),
(446, 8, 38, 'Math - Ghazanfar', '10:30-11:30'),
(447, 8, 39, 'Math - Ghazanfar', '10:30-11:30'),
(448, 8, 40, 'English - Maria', '10:30-11:30'),
(449, 8, 41, 'Urdu - Ayesha', '10:30-11:30'),
(450, 8, 42, '---', '10:30-11:30'),
(451, 8, 37, 'History - Maria', '11:30-12:30'),
(452, 8, 38, 'History - Maria', '11:30-12:30'),
(453, 8, 39, 'History - Ghazanfar', '11:30-12:30'),
(454, 8, 40, 'History - Hammad', '11:30-12:30'),
(455, 8, 41, 'History - Ghazanfar', '11:30-12:30'),
(456, 8, 42, '---', '11:30-12:30'),
(457, 8, 37, 'break', '12:30-1:00'),
(458, 8, 38, 'break', '12:30-1:00'),
(459, 8, 39, 'break', '12:30-1:00'),
(460, 8, 40, 'break', '12:30-1:00'),
(461, 8, 41, 'break', '12:30-1:00'),
(462, 8, 42, '---', '12:30-1:00'),
(463, 8, 37, 'Islamiat - Ghazanfar', '1:00-1:30'),
(464, 8, 38, 'Islamiat - Ghazanfar', '1:00-1:30'),
(465, 8, 39, 'Islamiat - Maria', '1:00-1:30'),
(466, 8, 40, 'Islamiat - Hammad', '1:00-1:30'),
(467, 8, 41, 'Math - Ghazanfar', '1:00-1:30'),
(468, 8, 42, '---', '1:00-1:30'),
(469, 8, 37, 'Spoken English - Ghazanfar', '1:30-2:00'),
(470, 8, 38, 'Spoken English - Hammad', '1:30-2:00'),
(471, 8, 39, 'Spoken English - Ghazanfar', '1:30-2:00'),
(472, 8, 40, 'Spoken English - Ghazanfar', '1:30-2:00'),
(473, 8, 41, '---', '1:30-2:00'),
(474, 8, 42, '---', '1:30-2:00'),
(475, 8, 37, 'Computer - Maria', '2:00-3:00'),
(476, 8, 38, 'Computer - Ghazanfar', '2:00-3:00'),
(477, 8, 39, 'Computer - Ghazanfar', '2:00-3:00'),
(478, 8, 40, 'Computer - Ghazanfar', '2:00-3:00'),
(479, 8, 41, '---', '2:00-3:00'),
(480, 8, 42, '---', '2:00-3:00'),
(481, 8, 37, 'Jymnastics - Maria', '3:00-4:00'),
(482, 8, 38, 'Jymnastics - Maria', '3:00-4:00'),
(483, 8, 39, 'Jymnastics - Maria', '3:00-4:00'),
(484, 8, 40, 'Jymnastics - Maria', '3:00-4:00'),
(485, 8, 41, '---', '3:00-4:00'),
(486, 8, 42, '---', '3:00-4:00');

-- --------------------------------------------------------

--
-- Table structure for table `progress_report`
--

CREATE TABLE `progress_report` (
  `progress_id` int(11) NOT NULL,
  `fk_student_id` int(20) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `progress_grade` varchar(5) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `progress_report`
--

INSERT INTO `progress_report` (`progress_id`, `fk_student_id`, `subject`, `progress_grade`, `date`) VALUES
(5, 1, '', 'A stu', '2024-08-06'),
(6, 2, '', 'A stu', '2024-08-06'),
(7, 1, '', 'A stu', '2024-08-06'),
(8, 2, '', 'A stu', '2024-08-06'),
(9, 4, '', 'A stu', '2024-08-02'),
(10, 4, '', 'A stu', '2024-08-02');

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
(12, 'It has good teachers who teach in a way that helps students learn. My school has 2 grassy playgrounds for outdoor sports. There is a good reputation for my school in the city.', 'school.png', '2', 'Savy School', 'Munawwar Hussain', 'We strive to Learn', 'private', 'Rahwali, Gujranwala Cantt', 'Gujranwala', '03265434765', 'savyschool@gmail.com', '2025-03-04');

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
(2, 2, 1, 1, 1),
(4, 3, 1, 2, 1),
(5, 4, 1, 2, 1),
(6, 5, 2, 3, 1),
(7, 6, 2, 3, 1),
(8, 7, 2, 4, 1),
(9, 8, 2, 4, 1),
(10, 9, 3, 5, 1),
(11, 10, 3, 5, 1),
(12, 11, 3, 6, 1),
(13, 12, 3, 6, 1),
(14, 13, 4, 7, 1),
(15, 14, 4, 7, 1),
(16, 15, 4, 8, 1),
(17, 16, 4, 8, 1),
(18, 17, 5, 9, 1),
(19, 18, 5, 9, 1),
(20, 19, 5, 10, 1),
(21, 20, 5, 10, 1),
(22, 21, 6, 11, 1),
(23, 22, 6, 11, 1),
(24, 23, 6, 12, 1),
(25, 24, 6, 12, 1),
(26, 25, 7, 13, 1),
(27, 26, 7, 13, 1),
(28, 27, 7, 14, 1),
(29, 28, 7, 14, 1),
(30, 29, 8, 15, 1),
(31, 30, 8, 15, 1),
(32, 31, 8, 16, 1),
(33, 32, 8, 16, 1),
(34, 33, 9, 17, 1),
(35, 34, 9, 17, 1),
(36, 35, 9, 18, 1),
(37, 36, 9, 18, 1),
(38, 37, 10, 19, 1),
(39, 38, 10, 19, 1),
(40, 39, 10, 20, 1),
(41, 40, 10, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_fee`
--

CREATE TABLE `student_fee` (
  `fee_id` int(11) NOT NULL,
  `fk_student_id` int(20) NOT NULL,
  `year` varchar(20) NOT NULL,
  `month` varchar(20) NOT NULL,
  `fee_method` varchar(255) NOT NULL,
  `receipt_image` varchar(255) NOT NULL,
  `monthly_fee` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `payment_date` date NOT NULL,
  `fee_status` varchar(50) NOT NULL DEFAULT 'unpaid',
  `pending_dues` int(10) NOT NULL DEFAULT 0,
  `admin_remarks` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_fee`
--

INSERT INTO `student_fee` (`fee_id`, `fk_student_id`, `year`, `month`, `fee_method`, `receipt_image`, `monthly_fee`, `due_date`, `payment_date`, `fee_status`, `pending_dues`, `admin_remarks`) VALUES
(12, 11, '2024', 'August', 'online', 'my-img23543.jpg', '3000', '2024-08-20', '2024-08-20', 'in_process', 0, ''),
(13, 12, '2024', 'August', 'cash', '', '3000', '2024-08-20', '2024-08-20', 'dues', 1000, ''),
(14, 17, '2024', 'August', 'cash', '', '4500', '2024-08-20', '2024-08-14', 'paid', 0, ''),
(15, 18, '2024', 'August', 'cash', '', '4500', '2024-08-20', '2024-08-20', 'dues', 300, ''),
(16, 21, '2024', 'August', 'cash', '', '5000', '2024-08-20', '2024-08-20', 'dues', 1000, ''),
(17, 23, '2024', 'August', 'cash', '', '5000', '2024-08-20', '2024-08-20', 'dues', 1000, ''),
(18, 26, '2024', 'August', 'cash', '', '5500', '2024-08-20', '2024-08-20', 'dues', 500, ''),
(19, 37, '2024', 'August', 'cash', '', '7000', '2024-08-20', '2024-08-20', 'paid', 0, ''),
(20, 1, '2024', 'August', 'cash', '', '1500', '2024-08-20', '2024-08-14', 'paid', 0, ''),
(21, 2, '2024', 'August', 'cash', '', '1500', '2024-08-20', '2024-08-12', 'dues', 50, ''),
(22, 3, '2024', 'August', 'cash', '', '1500', '2024-08-20', '2024-08-15', 'paid', 0, ''),
(23, 4, '2024', 'August', 'cash', '', '1500', '2024-08-20', '2024-08-11', 'paid', 0, ''),
(24, 5, '2024', 'August', 'cash', '', '2000', '2024-08-20', '2024-08-10', 'paid', 0, ''),
(25, 6, '2024', 'August', 'cash', '', '2000', '2024-08-20', '2024-08-09', 'paid', 0, ''),
(26, 7, '2024', 'August', 'cash', '', '2000', '2024-08-20', '2024-08-16', 'dues', 200, ''),
(27, 8, '2024', 'August', 'cash', '', '2000', '2024-08-20', '2024-08-06', 'paid', 0, ''),
(28, 9, '2024', 'August', 'cash', '', '3000', '2024-08-20', '2024-08-02', 'paid', 0, ''),
(29, 10, '2024', 'August', 'cash', '', '3000', '2024-08-20', '2024-08-19', 'paid', 0, ''),
(30, 13, '2024', 'August', 'cash', '', '4000', '2024-08-20', '2024-08-07', 'dues', 500, ''),
(31, 14, '2024', 'August', 'cash', '', '4000', '2024-08-20', '2024-08-14', 'paid', 0, ''),
(32, 15, '2024', 'August', 'cash', '', '4000', '2024-08-20', '2024-08-11', 'dues', 3000, ''),
(33, 16, '2024', 'August', 'cash', '', '4000', '2024-08-20', '2024-08-13', 'dues', 600, ''),
(34, 19, '2024', 'August', 'cash', '', '4500', '2024-08-20', '2024-08-15', 'paid', 0, ''),
(35, 20, '2024', 'August', 'cash', '', '4500', '2024-08-20', '2024-08-04', 'paid', 0, ''),
(36, 22, '2024', 'August', 'cash', '', '5000', '2024-08-20', '2024-08-01', 'paid', 0, ''),
(37, 24, '2024', 'August', 'cash', '', '5000', '2024-08-20', '2024-08-06', 'dues', 1000, ''),
(38, 25, '2024', 'August', 'cash', '', '5500', '2024-08-20', '2024-08-08', 'dues', 100, ''),
(39, 27, '2024', 'August', 'cash', '', '5500', '2024-08-20', '2024-08-15', 'dues', 200, ''),
(40, 28, '2024', 'August', 'cash', '', '5500', '2024-08-20', '2024-08-15', 'dues', 500, ''),
(41, 29, '2024', 'August', 'cash', '', '6000', '2024-08-20', '2024-08-03', 'paid', 0, ''),
(42, 30, '2024', 'August', 'cash', '', '6000', '2024-08-20', '2024-08-07', 'paid', 0, ''),
(43, 31, '2024', 'August', 'cash', '', '6000', '2024-08-20', '2024-08-09', 'dues', 700, ''),
(44, 32, '2024', 'August', 'cash', '', '6000', '2024-08-20', '2024-08-15', 'dues', 1000, ''),
(45, 33, '2024', 'August', 'cash', '', '6000', '2024-08-20', '2024-08-16', 'dues', 400, ''),
(46, 34, '2024', 'August', 'cash', '', '6000', '2024-08-20', '2024-08-19', 'in_process', 0, ''),
(47, 35, '2024', 'August', 'cash', '', '6000', '2024-08-20', '2024-08-14', 'in_process', 0, ''),
(48, 36, '2024', 'August', 'cash', '', '6000', '2024-08-20', '2024-08-18', 'in_process', 0, ''),
(49, 38, '2024', 'August', 'cash', '', '7000', '2024-08-20', '2024-08-12', 'in_process', 0, ''),
(50, 39, '2024', 'August', 'cash', '', '7000', '2024-08-20', '2024-08-14', 'dues', 500, ''),
(51, 40, '2024', 'August', 'cash', '', '7000', '2024-08-20', '2024-08-09', 'paid', 0, ''),
(52, 15, '2024', 'July', 'cash', '', '4000', '2024-07-20', '2024-08-08', 'paid', 0, ''),
(53, 15, '2023', 'July', 'cash', '', '4000', '2023-07-19', '2024-08-08', 'paid', 0, '');

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
  `fee_amount` varchar(155) NOT NULL,
  `password` varchar(255) NOT NULL,
  `student_status` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_profile`
--

INSERT INTO `student_profile` (`student_id`, `name`, `cnic`, `dob`, `address`, `mobile_no`, `roll_no`, `image`, `email`, `fee_amount`, `password`, `student_status`) VALUES
(1, 'Ali Abdullah', '654676545673', '1997-10-14', 'Gujranwala', '029879283', '233', '', 'email@mail.com', '1500', '1234567', 1),
(2, 'Abdullah Cheema', '0387389393', '2024-08-12', 'Gujranwala', '9393743', '234', '', 'email@mail.com', '1500', '1234567', 1),
(3, 'Tayyab Awan', '038837777377', '2024-08-09', 'Gujranwala', '938738903', '235', '', 'email@mail.com', '1500', '1234567', 1),
(4, 'Rana Hassan', '039883933', '2024-07-29', 'Gujranwala', '087389383', '236', '', 'email@mail.com', '1500', '1234567', 1),
(5, 'Humayun', '937483738', '2024-08-04', 'Gujranwala', '038737893', '237', '', 'email@mail.com', '2000', '1234567', 1),
(6, 'Rafay Saeed', '03873678390', '2024-08-06', 'Gujranwala', '0837839393', '238', '', 'email@mail.com', '2000', '1234567', 1),
(7, 'Ibrar Ali', '039848438743874', '2024-08-05', 'Gujranwala', '0387377377', '239', '', 'email@mail.com', '2000', '1234567', 1),
(8, 'Talha Zahid', '397393937', '2024-08-12', 'Gujranwala', '0338377773', '240', '', 'email@mail.com', '2000', '1234567', 1),
(9, 'Gheyas Elahi', '03393383883', '2024-08-06', 'Gujranwala', '033833', '241', '', 'email@mail.com', '3000', '1234567', 1),
(10, 'Ali Hassan', '0937437773', '2024-08-16', 'Gujranwala', '03739383', '242', '', 'email@mail.com', '3000', '1234567', 1),
(11, 'Asim Butt', '04347889394', '2024-08-15', 'Gujranwala', '0387637777', '243', '', 'email@mail.com', '3000', '1234567', 1),
(12, 'Musa Butt', '0943848884', '2024-08-07', 'Gujranwala', '8398938923892', '244', '', 'email@mail.com', '3000', '1234567', 1),
(13, 'Aqib Jutt', '938873982474', '2024-08-07', 'Gujranwala', '03383988838', '245', '', 'email@mail.com', '4000', '1234567', 1),
(14, 'Usman Shafique', '93938488848', '2024-08-08', 'Gujranwala', '0943884884', '246', '', 'email@mail.com', '4000', '1234567', 1),
(15, 'Ahmad Talal', '32934874774', '2024-08-08', 'Gujranwala', '989839843', '247', '', 'emai@mail.com', '4000', '1234567', 1),
(16, 'Mujhtaba Abid', '3937443743', '2024-08-22', 'Gujranwala', '09238877373', '248', '', 'email@mail.com', '4000', '1234567', 1),
(17, 'Saqib Mehmood', '8904835', '2024-08-15', 'Gujranwala', '03897387483', '249', '', 'email@mail.com', '4500', '1234567', 1),
(18, 'Masood Faridi', '38939873498743', '2024-08-16', 'Gujranwala', '90387432', '250', '', 'email@mail.com', '4500', '1234567', 1),
(19, 'Haider Niazi', '09839890543', '2024-08-24', 'Gujranwala', '9334983498', '251', '', 'email@mail.com', '4500', '1234567', 1),
(20, 'Mehrose Niazi', '93983984798', '2024-08-08', 'Gujranwla', '98734983749843', '252', '', 'email@mail.com', '4500', '1234567', 1),
(21, 'Ali Zahid', '938748', '2024-08-17', 'Gujranwala', '9873497439879843', '253', '', 'email@mail.com', '5000', '1234567', 1),
(22, 'Haroon Butt', '5987498743985', '2024-08-13', 'Gujranwala', '983374843', '254', '', 'email@mail.com', '5000', '1234567', 1),
(23, 'Ali Raza', '83490843290', '2024-08-15', 'Gujranwala', '8943798427984', '255', '', 'email@mail.com', '5000', '1234567', 1),
(24, 'Khurram Shehzad', '8927498742398', '2024-08-22', 'Gujranwala', '4398798473', '256', '', 'email@mail.com', '5000', '1234567', 1),
(25, 'Babar Azam', '98379847', '2024-08-09', 'Gujranwala', '93843487', '257', '', 'email@mail.com', '5500', '1234567', 1),
(26, 'Rizwan Malik', '9843979847984', '2024-08-21', 'Gujranwala', '984974398', '258', '', 'email@mail.com', '5500', '1234567', 1),
(27, 'Shaheen Afridi', '74987398749', '2024-08-15', 'email@mail.com', '83479438', '259', '', 'email@mail.com', '5500', '1234567', 1),
(28, 'Haris Rouf', '9875987539875', '2024-08-22', 'Gujranwala', '098390548', '260', '', 'email@mail.com', '5500', '1234567', 1),
(29, 'Misbah', '384837438', '2024-08-09', 'Gujranwala', '98734974398', '261', '', 'email@mail.com', '6000', '1234567', 1),
(30, 'Mateen Malik', '938490438', '2024-08-09', 'Gujranwala', '398490384', '262', '', 'email@mail.com', '6000', '1234567', 1),
(31, 'Wahab Gujjar', '0934809348', '2024-08-29', 'Gujranwala', '3798473', '263', '', 'email@mail.com', '6000', '1234567', 1),
(32, 'Wahab Riaz', '3749837498', '2024-08-23', 'Gujranwala', '90497394', '264', '', 'email@mail.com', '6000', '1234567', 1),
(33, 'Muhammad Amir', '98374937943', '2024-08-30', 'Gujranwala', '83477439', '265', '', 'email@mail.com', '6000', '1234567', 1),
(34, 'Asif Butt', '4794739743987', '2024-08-08', 'Gujranwala', '374983479', '266', '', 'email@mail.com', '6000', '1234567', 1),
(35, 'Rustam Virk', '734873948', '2024-08-13', 'Gujranwala', '873984743987', '267', '', 'email@mail.com', '6000', '1234567', 1),
(36, 'Talha Bajwa', '0934890384098243', '2024-08-15', 'Gujranwala', '9034934798', '268', '', 'email@mail.com', '6000', '1234567', 1),
(37, 'Shahid Afridi', '8397498734', '2024-08-30', 'Gujranwala', '8598734983', '269', '', 'email@mail.com', '7000', '1234567', 1),
(38, 'Abdullah Javaid', '4398793247', '2024-08-24', 'Gujranwala', '49837985', '270', '', 'email@mail.com', '7000', '1234567', 1),
(39, 'Abdul Rasheed', '973497439', '2024-08-23', 'Gujranwala', '74398739847', '271', '', 'email@mail.com', '7000', '1234567', 1),
(40, 'Abdul Razzaq', '983798347', '2024-08-02', 'Gujranwala', '937983749', '272', '', 'email@mail.com', '7000', '1234567', 1);

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
(31, 20, 'Monday'),
(32, 20, 'Tuesday'),
(33, 20, 'Wednesday'),
(34, 20, 'Thursday'),
(35, 20, 'Friday'),
(36, 20, 'Saturday'),
(37, 8, 'Monday'),
(38, 8, 'Tuesday'),
(39, 8, 'Wednesday'),
(40, 8, 'Thursday'),
(41, 8, 'Friday'),
(42, 8, 'Saturday');

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
-- Indexes for table `combined_progress`
--
ALTER TABLE `combined_progress`
  ADD PRIMARY KEY (`combined_progress_id`);

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
-- Indexes for table `homework_diary`
--
ALTER TABLE `homework_diary`
  ADD PRIMARY KEY (`homework_id`),
  ADD KEY `fk_section_homework_id` (`fk_section_id`);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `admin_log_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

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
  MODIFY `attendance_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_sections`
--
ALTER TABLE `class_sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `combined_progress`
--
ALTER TABLE `combined_progress`
  MODIFY `combined_progress_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  MODIFY `exam_schedule_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_receiving`
--
ALTER TABLE `expense_receiving`
  MODIFY `er_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `homework_diary`
--
ALTER TABLE `homework_diary`
  MODIFY `homework_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `notice_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `period_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=487;

--
-- AUTO_INCREMENT for table `progress_report`
--
ALTER TABLE `progress_report`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `school_profile_`
--
ALTER TABLE `school_profile_`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_class`
--
ALTER TABLE `student_class`
  MODIFY `student_class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `student_fee`
--
ALTER TABLE `student_fee`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `student_profile`
--
ALTER TABLE `student_profile`
  MODIFY `student_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
-- Constraints for table `homework_diary`
--
ALTER TABLE `homework_diary`
  ADD CONSTRAINT `fk_section_homework_id` FOREIGN KEY (`fk_section_id`) REFERENCES `class_sections` (`section_id`);

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
