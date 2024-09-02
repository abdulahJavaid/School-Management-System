-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2024 at 02:12 PM
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
  `admin_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `email`, `password`, `role`, `status`) VALUES
(1, 'Hamza', 'email@mail.com', 'pass', 'developer', 1),
(2, 'Ali', 'email@mail.com', 'pass', 'developer', 1),
(3, 'Talha', 'email@gmail.com', 'pass', 'accountant', 1);

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
(101, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Haroon Arshad</strong> to Database!', '31/08/2024 10:17 am'),
(102, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Sufyan Safdar</strong> to Database!', '31/08/2024 10:19 am'),
(103, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Hamid Tariq</strong> to Database!', '31/08/2024 10:22 am'),
(104, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Faheem Fayyaz</strong> to Database!', '31/08/2024 10:24 am'),
(105, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Uzair butt</strong> to Database!', '31/08/2024 10:26 am'),
(106, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Meerab Asif</strong> to Database!', '31/08/2024 10:30 am'),
(107, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Noor Amir</strong> to Database!', '31/08/2024 10:32 am'),
(108, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Alina Ali</strong> to Database!', '31/08/2024 10:34 am'),
(109, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ayesha</strong> to Database!', '31/08/2024 10:36 am'),
(110, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Maria</strong> to Database!', '31/08/2024 10:37 am'),
(111, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Areeba </strong> to Database!', '31/08/2024 10:40 am'),
(112, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Qahafa Mughal</strong> to Database!', '31/08/2024 10:41 am'),
(113, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> updated profile of <strong>student: Qahafa Mughal</strong>!', '31/08/2024 10:42 am'),
(114, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Anas Asif</strong> to Database!', '31/08/2024 10:44 am'),
(115, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: M.Ahmad</strong> to Database!', '31/08/2024 10:46 am'),
(116, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Abul Rahmen</strong> to Database!', '31/08/2024 11:03 am'),
(117, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Misba Jutt</strong> to Database!', '31/08/2024 11:04 am'),
(118, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Amer Hamza</strong> to Database!', '31/08/2024 11:06 am'),
(119, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Kinza Mehar</strong> to Database!', '31/08/2024 11:08 am'),
(120, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Maham Mughal</strong> to Database!', '31/08/2024 11:10 am'),
(121, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ali Raza</strong> to Database!', '31/08/2024 11:13 am'),
(122, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Bilal Butt</strong> to Database!', '31/08/2024 11:24 am'),
(123, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Bisma Khan</strong> to Database!', '31/08/2024 11:26 am'),
(124, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ali Hamza</strong> to Database!', '31/08/2024 11:37 am'),
(125, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Shahwaiz Jutt</strong> to Database!', '31/08/2024 11:39 am'),
(126, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Alishba Mughal</strong> to Database!', '31/08/2024 11:41 am'),
(127, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Waleed </strong> to Database!', '31/08/2024 12:14 pm'),
(128, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Arooj Khan </strong> to Database!', '31/08/2024 12:18 pm'),
(129, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Babar </strong> to Database!', '31/08/2024 12:19 pm'),
(130, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Teefa</strong> to Database!', '31/08/2024 12:21 pm'),
(131, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Fahad</strong> to Database!', '31/08/2024 12:23 pm'),
(132, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Eman shahzadi</strong> to Database!', '31/08/2024 12:26 pm'),
(133, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Hamid Cheema</strong> to Database!', '31/08/2024 12:28 pm'),
(134, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Sheza Eman</strong> to Database!', '31/08/2024 12:31 pm'),
(135, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ibrahim khan</strong> to Database!', '31/08/2024 12:33 pm'),
(136, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Abdullah perwaz</strong> to Database!', '31/08/2024 12:36 pm'),
(137, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Simra baloch</strong> to Database!', '31/08/2024 12:38 pm'),
(138, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Minahil mehar</strong> to Database!', '31/08/2024 12:40 pm'),
(139, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ali Shahwaiz</strong> to Database!', '31/08/2024 12:42 pm'),
(140, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Usman Mughal</strong> to Database!', '31/08/2024 12:44 pm'),
(141, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> updated profile of <strong>student: Ali Shahwaiz</strong>!', '31/08/2024 12:44 pm'),
(142, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Nimra Mehar</strong> to Database!', '31/08/2024 12:46 pm'),
(143, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Zinta rani</strong> to Database!', '31/08/2024 12:53 pm'),
(144, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Muskan Zulfiqar</strong> to Database!', '31/08/2024 12:56 pm'),
(145, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Rana Atif</strong> to Database!', '31/08/2024 12:59 pm'),
(146, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> updated profile of <strong>student: Nimra Mehar</strong>!', '31/08/2024 12:59 pm'),
(147, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ismail Khan</strong> to Database!', '31/08/2024 01:04 pm'),
(148, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Bushra</strong> to Database!', '31/08/2024 01:07 pm'),
(149, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Anaya Mughal</strong> to Database!', '31/08/2024 01:10 pm'),
(150, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Asim Butt</strong> to Database!', '31/08/2024 01:11 pm'),
(151, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Zainab khan</strong> to Database!', '31/08/2024 01:14 pm'),
(152, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: usama</strong> to Database!', '31/08/2024 01:15 pm'),
(153, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Faheem Cheema</strong> to Database!', '31/08/2024 01:16 pm'),
(154, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Uzair Insari</strong> to Database!', '31/08/2024 01:18 pm'),
(155, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: haroon jutt</strong> to Database!', '31/08/2024 01:19 pm'),
(156, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Abdullah cheema</strong> to Database!', '31/08/2024 01:20 pm'),
(157, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Rabiya omer</strong> to Database!', '31/08/2024 01:21 pm'),
(158, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: aatif</strong> to Database!', '31/08/2024 01:22 pm'),
(159, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Daniyal Saith</strong> to Database!', '31/08/2024 01:24 pm'),
(160, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: sufyab mehar</strong> to Database!', '31/08/2024 01:25 pm'),
(161, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Hira rani</strong> to Database!', '31/08/2024 01:27 pm'),
(162, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Imran khan</strong> to Database!', '31/08/2024 01:28 pm'),
(163, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: nimra jutt</strong> to Database!', '31/08/2024 01:29 pm'),
(164, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: saniya</strong> to Database!', '31/08/2024 01:31 pm'),
(165, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: aatif</strong> to Database!', '31/08/2024 01:32 pm'),
(166, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ayesha khan</strong> to Database!', '31/08/2024 01:34 pm'),
(167, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ibrar Ahmad</strong> to Database!', '31/08/2024 01:36 pm'),
(168, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Atif jutt</strong> to Database!', '31/08/2024 01:37 pm'),
(169, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Mossan cheema</strong> to Database!', '31/08/2024 01:38 pm'),
(170, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Taniya</strong> to Database!', '31/08/2024 01:40 pm'),
(171, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Arham Butt</strong> to Database!', '31/08/2024 01:41 pm'),
(172, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Misba Mughal</strong> to Database!', '31/08/2024 01:43 pm'),
(173, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ibrahim mehar</strong> to Database!', '31/08/2024 01:44 pm'),
(174, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ali hamza </strong> to Database!', '31/08/2024 02:08 pm'),
(175, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Amir Mughal</strong> to Database!', '31/08/2024 02:10 pm'),
(176, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Manan khan  </strong> to Database!', '31/08/2024 02:12 pm'),
(177, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Urwa khan</strong> to Database!', '31/08/2024 02:13 pm'),
(178, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Muneeb Ahmad</strong> to Database!', '31/08/2024 02:15 pm'),
(179, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: maya khan</strong> to Database!', '31/08/2024 02:17 pm'),
(180, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ibrar Ahmad</strong> to Database!', '31/08/2024 02:19 pm'),
(181, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Raza Mughal</strong> to Database!', '31/08/2024 02:21 pm'),
(182, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Mavish khan</strong> to Database!', '31/08/2024 02:23 pm'),
(183, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Abdul Raheem</strong> to Database!', '31/08/2024 02:24 pm'),
(184, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Arif Ali</strong> to Database!', '31/08/2024 02:27 pm'),
(185, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: john </strong> to Database!', '31/08/2024 02:28 pm'),
(186, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: shahwaiz Ali</strong> to Database!', '31/08/2024 02:30 pm'),
(187, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Alaya Ali</strong> to Database!', '31/08/2024 02:33 pm'),
(188, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Fahad saith</strong> to Database!', '31/08/2024 02:37 pm'),
(189, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Alishba</strong> to Database!', '31/08/2024 02:38 pm'),
(190, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Haroon malik</strong> to Database!', '31/08/2024 02:40 pm'),
(191, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Sufyan malik</strong> to Database!', '31/08/2024 02:41 pm'),
(192, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: uzair malik</strong> to Database!', '31/08/2024 02:42 pm'),
(193, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Hammad Jutt</strong> to Database!', '31/08/2024 02:43 pm'),
(194, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ali Butt</strong> to Database!', '31/08/2024 02:45 pm'),
(195, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Hamid malik</strong> to Database!', '31/08/2024 02:46 pm'),
(196, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Amna sheikh</strong> to Database!', '31/08/2024 02:48 pm'),
(197, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Qahafa jutt</strong> to Database!', '31/08/2024 02:49 pm'),
(198, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Minahil  Mughal</strong> to Database!', '31/08/2024 02:50 pm'),
(199, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Aiza mailk</strong> to Database!', '31/08/2024 02:52 pm'),
(200, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Furqan </strong> to Database!', '31/08/2024 02:53 pm'),
(201, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Atif Ali</strong> to Database!', '31/08/2024 02:55 pm'),
(202, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Eman choudary</strong> to Database!', '31/08/2024 02:58 pm'),
(203, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Alina mehar</strong> to Database!', '31/08/2024 02:59 pm'),
(204, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Haroon Butt</strong> to Database!', '31/08/2024 03:14 pm'),
(205, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: aatif</strong> to Database!', '31/08/2024 03:14 pm'),
(206, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Hamid Tariq</strong> to Database!', '31/08/2024 03:15 pm'),
(207, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: aiza</strong> to Database!', '31/08/2024 03:16 pm'),
(208, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: uzair</strong> to Database!', '31/08/2024 03:17 pm'),
(209, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Misba Jutt</strong> to Database!', '31/08/2024 03:18 pm'),
(210, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Babar </strong> to Database!', '31/08/2024 03:18 pm'),
(211, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: nimra</strong> to Database!', '31/08/2024 03:19 pm'),
(212, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: sufyan</strong> to Database!', '31/08/2024 03:20 pm'),
(213, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Awis</strong> to Database!', '31/08/2024 03:21 pm'),
(214, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: aatif</strong> to Database!', '31/08/2024 03:22 pm'),
(215, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Maryam</strong> to Database!', '31/08/2024 03:23 pm'),
(216, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Arooj </strong> to Database!', '31/08/2024 03:24 pm'),
(217, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: faheem</strong> to Database!', '31/08/2024 03:25 pm'),
(218, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ayesha</strong> to Database!', '31/08/2024 03:26 pm'),
(219, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Aiza mailk</strong> to Database!', '31/08/2024 03:27 pm'),
(220, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Hamid Cheema</strong> to Database!', '31/08/2024 03:28 pm'),
(221, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Faheem Fayyaz</strong> to Database!', '31/08/2024 03:29 pm'),
(222, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Sufyan Safdar</strong> to Database!', '31/08/2024 03:29 pm'),
(223, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Aiza butt</strong> to Database!', '31/08/2024 03:30 pm'),
(224, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Nimra  jutt</strong> to Database!', '31/08/2024 03:31 pm'),
(225, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: arham</strong> to Database!', '31/08/2024 03:32 pm'),
(226, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Muskan</strong> to Database!', '31/08/2024 03:32 pm'),
(227, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ali</strong> to Database!', '31/08/2024 03:33 pm'),
(228, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: uzair malik</strong> to Database!', '31/08/2024 03:34 pm'),
(229, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: faheem</strong> to Database!', '31/08/2024 03:35 pm'),
(230, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: shahwaiz butt</strong> to Database!', '31/08/2024 03:36 pm'),
(231, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: uswa khan</strong> to Database!', '31/08/2024 03:37 pm'),
(232, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: haroon jutt</strong> to Database!', '31/08/2024 03:38 pm'),
(233, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Hamid malik</strong> to Database!', '31/08/2024 03:39 pm'),
(234, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: aatif</strong> to Database!', '31/08/2024 03:40 pm'),
(235, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: hamza</strong> to Database!', '31/08/2024 03:40 pm'),
(236, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: ali haider</strong> to Database!', '31/08/2024 03:41 pm'),
(237, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Faheem Cheema</strong> to Database!', '31/08/2024 03:42 pm'),
(238, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: tahreem</strong> to Database!', '31/08/2024 03:43 pm'),
(239, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: hamid</strong> to Database!', '31/08/2024 03:44 pm'),
(240, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: alishba mailk</strong> to Database!', '31/08/2024 03:45 pm'),
(241, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Faheem</strong> to Database!', '31/08/2024 03:46 pm'),
(242, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Amir khan </strong> to Database!', '31/08/2024 03:47 pm'),
(243, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Haroon Butt</strong> to Database!', '31/08/2024 03:48 pm'),
(244, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Muskan malik</strong> to Database!', '31/08/2024 03:49 pm'),
(245, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Hamid Tariq</strong> to Database!', '31/08/2024 03:49 pm'),
(246, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Sufyan Safdar</strong> to Database!', '31/08/2024 03:50 pm'),
(247, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Uzair butt</strong> to Database!', '31/08/2024 03:51 pm'),
(248, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ayesha khan</strong> to Database!', '31/08/2024 03:52 pm'),
(249, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Eman choudary</strong> to Database!', '31/08/2024 03:53 pm'),
(250, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: nimra</strong> to Database!', '31/08/2024 03:54 pm'),
(251, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: misba Mehar</strong> to Database!', '31/08/2024 03:55 pm'),
(252, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Qahafa butt</strong> to Database!', '31/08/2024 03:56 pm'),
(253, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Alaya  jutt</strong> to Database!', '31/08/2024 03:58 pm'),
(254, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: faheem raza</strong> to Database!', '31/08/2024 04:05 pm'),
(255, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: ali raza</strong> to Database!', '31/08/2024 04:06 pm'),
(256, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Amna Jutt</strong> to Database!', '31/08/2024 04:07 pm'),
(257, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Manan khan  </strong> to Database!', '31/08/2024 04:07 pm'),
(258, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: haider</strong> to Database!', '31/08/2024 04:09 pm'),
(259, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Amer Hamza</strong> to Database!', '31/08/2024 04:10 pm'),
(260, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Alisha</strong> to Database!', '31/08/2024 04:11 pm'),
(261, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: shahwaiz</strong> to Database!', '31/08/2024 04:12 pm'),
(262, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: sufyan</strong> to Database!', '31/08/2024 04:13 pm'),
(263, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> updated profile of <strong>student: Alisha</strong>!', '31/08/2024 04:14 pm'),
(264, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Uzair Insari</strong> to Database!', '31/08/2024 04:15 pm'),
(265, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Muskan</strong> to Database!', '31/08/2024 04:17 pm'),
(266, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ahmad</strong> to Database!', '31/08/2024 04:18 pm'),
(267, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: hashim butt</strong> to Database!', '31/08/2024 04:19 pm'),
(268, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: hamid mughal</strong> to Database!', '31/08/2024 04:20 pm'),
(269, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: sufyan mahar</strong> to Database!', '31/08/2024 04:20 pm'),
(270, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Amna khan</strong> to Database!', '31/08/2024 04:22 pm'),
(271, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: faheem mughal</strong> to Database!', '31/08/2024 04:23 pm'),
(272, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Muskan </strong> to Database!', '31/08/2024 04:24 pm'),
(273, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: haider</strong> to Database!', '31/08/2024 04:25 pm'),
(274, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: NIMRA</strong> to Database!', '31/08/2024 04:27 pm'),
(275, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Faizan</strong> to Database!', '31/08/2024 04:31 pm'),
(276, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: muskan</strong> to Database!', '31/08/2024 04:31 pm'),
(277, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Sufyan Safdar</strong> to Database!', '31/08/2024 04:32 pm'),
(278, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: uzair</strong> to Database!', '31/08/2024 04:33 pm'),
(279, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Misba </strong> to Database!', '31/08/2024 04:33 pm'),
(280, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: hammad  mughal</strong> to Database!', '31/08/2024 04:34 pm'),
(281, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: atif mughal</strong> to Database!', '31/08/2024 04:35 pm'),
(282, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: abdullah maher</strong> to Database!', '31/08/2024 04:36 pm'),
(283, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ayesha</strong> to Database!', '31/08/2024 04:37 pm'),
(284, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: hamza</strong> to Database!', '31/08/2024 04:38 pm'),
(285, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Ali Shahwaiz</strong> to Database!', '31/08/2024 04:39 pm'),
(286, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Amna mughal</strong> to Database!', '31/08/2024 04:40 pm'),
(287, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: hamid</strong> to Database!', '31/08/2024 04:41 pm'),
(288, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: sufyan mughal</strong> to Database!', '31/08/2024 04:42 pm'),
(289, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: hamid</strong> to Database!', '31/08/2024 04:43 pm'),
(290, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: arshad </strong> to Database!', '31/08/2024 04:44 pm'),
(291, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: qaiser</strong> to Database!', '31/08/2024 04:45 pm'),
(292, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: ali raza</strong> to Database!', '31/08/2024 04:46 pm'),
(293, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: arslan cheema</strong> to Database!', '31/08/2024 04:47 pm'),
(294, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Eman rani</strong> to Database!', '31/08/2024 04:48 pm'),
(295, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Maryam mughal</strong> to Database!', '31/08/2024 04:50 pm'),
(296, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: haider ali</strong> to Database!', '31/08/2024 04:51 pm'),
(297, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Hamid Tariq</strong> to Database!', '31/08/2024 04:52 pm'),
(298, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: fahad mughal</strong> to Database!', '31/08/2024 04:53 pm'),
(299, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: aris maher</strong> to Database!', '31/08/2024 04:54 pm'),
(300, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: sufyan</strong> to Database!', '31/08/2024 04:55 pm'),
(301, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: hashim cheema</strong> to Database!', '31/08/2024 04:56 pm'),
(302, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: muskan</strong> to Database!', '31/08/2024 04:57 pm'),
(303, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Abdullah khan</strong> to Database!', '31/08/2024 04:59 pm'),
(304, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: waleed Butt</strong> to Database!', '31/08/2024 05:00 pm'),
(305, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>student: Asim Mughal</strong> to Database!', '01/09/2024 04:28 pm'),
(306, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Sir Imran</strong> to Database!', '01/09/2024 10:41 pm'),
(307, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Sir Tanveer</strong> to Database!', '02/09/2024 07:27 am'),
(308, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Miss Ayesha</strong> to Database!', '02/09/2024 07:30 am'),
(309, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Miss Anam</strong> to Database!', '02/09/2024 07:32 am'),
(310, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Sir Faisal</strong> to Database!', '02/09/2024 07:34 am'),
(311, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Sir Qaiser</strong> to Database!', '02/09/2024 08:14 am'),
(312, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Miss Nimra</strong> to Database!', '02/09/2024 08:18 am'),
(313, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Misba</strong> to Database!', '02/09/2024 08:21 am'),
(314, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Musab Butt</strong> to Database!', '02/09/2024 08:23 am'),
(315, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Sufyan Cheema</strong> to Database!', '02/09/2024 08:25 am'),
(316, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Arham Arshad</strong> to Database!', '02/09/2024 08:32 am'),
(317, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Waleed Mughal</strong> to Database!', '02/09/2024 08:38 am'),
(318, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Zaman Jutt</strong> to Database!', '02/09/2024 08:42 am'),
(319, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Ali Haider</strong> to Database!', '02/09/2024 08:43 am'),
(320, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Maryam</strong> to Database!', '02/09/2024 08:46 am'),
(321, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Aiza Mirza</strong> to Database!', '02/09/2024 08:49 am'),
(322, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Hamid Rajpoot</strong> to Database!', '02/09/2024 08:52 am'),
(323, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Nehal Butt</strong> to Database!', '02/09/2024 08:59 am'),
(324, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Rana Uzair </strong> to Database!', '02/09/2024 09:03 am'),
(325, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Kinza cheema</strong> to Database!', '02/09/2024 09:04 am'),
(326, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Usman Meer</strong> to Database!', '02/09/2024 09:09 am'),
(327, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Maqsood</strong> to Database!', '02/09/2024 09:10 am'),
(328, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Arslan Cheema</strong> to Database!', '02/09/2024 09:12 am'),
(329, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Hamza </strong> to Database!', '02/09/2024 09:13 am'),
(330, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Alina</strong> to Database!', '02/09/2024 09:16 am'),
(331, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Abdullah cheema</strong> to Database!', '02/09/2024 09:19 am'),
(332, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Adeel Mughal</strong> to Database!', '02/09/2024 09:21 am'),
(333, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Maria Mehar</strong> to Database!', '02/09/2024 09:22 am'),
(334, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Rana Adil </strong> to Database!', '02/09/2024 09:24 am'),
(335, 'Admin <strong>id: 1</strong>, <strong>name: Hamza</strong> added <strong>teacher: Tahreem </strong> to Database!', '02/09/2024 09:26 am');

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
(1, 'C76312024-09-021500expdownload (1).jfif', 'Chay pani', '1500', '0', '2024-09-02'),
(2, 'L87832024-09-0210000expdownload (2).jfif', 'Lunch', '10000', '0', '2024-09-02'),
(3, 'B2582024-09-0270000expdownload (3).jfif', 'Bijli ka bill', '70000', '0', '2024-09-02'),
(4, 'G254422024-09-0225000expdownload (4).jfif', 'Gas Bill', '25000', '0', '2024-09-02'),
(5, 'S156652024-09-0220000expdownload (5).jfif', 'Stationary', '20000', '0', '2024-09-02'),
(6, 'P109332024-09-0250000recdownload.jfif', 'Paper Fund', '0', '50000', '2024-09-02'),
(7, 'S83952024-09-02100000recimages (3).jfif', 'Swat Tour', '0', '100000', '2024-09-02'),
(8, 'A111752024-09-0250000recimages (1).jfif', 'Annual Dinner', '0', '50000', '2024-09-02'),
(9, 'S32602024-09-02100000recimages.png', 'Sports Gala', '0', '100000', '2024-09-02'),
(10, 'O151422024-09-0220000recimages.jfif', 'Others', '0', '20000', '2024-09-02');

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
  `notice_status` varchar(20) NOT NULL DEFAULT 'school',
  `notice_date` date NOT NULL,
  `mark_read` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE `periods` (
  `period_id` int(11) NOT NULL,
  `fk_section_id` int(11) NOT NULL,
  `fk_timetable_id` int(11) NOT NULL,
  `period_name` varchar(255) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`period_id`, `fk_section_id`, `fk_timetable_id`, `period_name`, `teacher_name`, `time`) VALUES
(73, 1, 1, 'Engilsh', 'Maryam', '8:00-8:40'),
(74, 1, 2, 'Engilsh', 'Maryam', '8:00-8:40'),
(75, 1, 3, 'Engilsh', 'Maryam', '8:00-8:40'),
(76, 1, 4, 'Engilsh', 'Maryam', '8:00-8:40'),
(77, 1, 5, 'Engilsh', 'Maryam', '8:00-8:40'),
(78, 1, 6, 'Engilsh', 'Maryam', '8:00-8:40'),
(79, 1, 1, 'Urdu', 'Aiza Mirza', '8:40-9:20'),
(80, 1, 2, 'Urdu', 'Aiza Mirza', '8:40-9:20'),
(81, 1, 3, 'Urdu', 'Aiza Mirza', '8:40-9:20'),
(82, 1, 4, 'Urdu', 'Aiza Mirza', '8:40-9:20'),
(83, 1, 5, 'Urdu', 'Aiza Mirza', '8:40-9:20'),
(84, 1, 6, 'Urdu', 'Aiza Mirza', '8:40-9:20'),
(85, 1, 1, 'Math', 'Nehal Butt', '9:20-10:00'),
(86, 1, 2, 'Math', 'Nehal Butt', '9:20-10:00'),
(87, 1, 3, 'Math', 'Nehal Butt', '9:20-10:00'),
(88, 1, 4, 'Math', 'Nehal Butt', '9:20-10:00'),
(89, 1, 5, 'Math', 'Nehal Butt', '9:20-10:00'),
(90, 1, 6, 'Math', 'Nehal Butt', '9:20-10:00'),
(91, 1, 1, 'Pak-Study', 'Misba', '10:00-11:40'),
(92, 1, 2, 'Pak-Study', 'Misba', '10:00-11:40'),
(93, 1, 3, 'Pak-Study', 'Misba', '10:00-11:40'),
(94, 1, 4, 'Pak-Study', 'Misba', '10:00-11:40'),
(95, 1, 5, 'Pak-Study', 'Misba', '10:00-11:40'),
(96, 1, 6, 'Pak-Study', 'Misba', '10:00-11:40'),
(97, 1, 1, 'computer', 'Maria Mehar', '10:40-11:20'),
(98, 1, 2, 'computer', 'Maria Mehar', '10:40-11:20'),
(99, 1, 3, 'computer', 'Maria Mehar', '10:40-11:20'),
(100, 1, 4, 'computer', 'Maria Mehar', '10:40-11:20'),
(101, 1, 5, 'computer', 'Maria Mehar', '10:40-11:20'),
(102, 1, 6, 'computer', 'Maria Mehar', '10:40-11:20'),
(103, 1, 1, 'Islamiat', 'Tahreem ', '11:50-12:30'),
(104, 1, 2, 'Islamiat', 'Tahreem ', '11:50-12:30'),
(105, 1, 3, 'Islamiat', 'Tahreem ', '11:50-12:30'),
(106, 1, 4, 'Islamiat', 'Tahreem ', '11:50-12:30'),
(107, 1, 5, '!', '!', '11:50-12:30'),
(108, 1, 6, 'Islamiat', 'Tahreem ', '11:50-12:30'),
(109, 1, 1, 'Science', 'Alina', '12:30-1:15'),
(110, 1, 2, 'Science', 'Alina', '12:30-1:15'),
(111, 1, 3, 'Science', 'Alina', '12:30-1:15'),
(112, 1, 4, 'Science', 'Alina', '12:30-1:15'),
(113, 1, 5, '!', '!', '12:30-1:15'),
(114, 1, 6, 'Science', 'Alina', '12:30-1:15'),
(115, 2, 7, 'Urdu', 'Aiza Mirza', '8:00-8:40'),
(116, 2, 8, 'Urdu', 'Aiza Mirza', '8:00-8:40'),
(117, 2, 9, 'Urdu', 'Aiza Mirza', '8:00-8:40'),
(118, 2, 10, 'Urdu', 'Aiza Mirza', '8:00-8:40'),
(119, 2, 11, 'Urdu', 'Aiza Mirza', '8:00-8:40'),
(120, 2, 12, 'Urdu', 'Aiza Mirza', '8:00-8:40'),
(121, 2, 7, 'Math', 'Nehal Butt', '8:40-9:20'),
(122, 2, 8, 'Math', 'Nehal Butt', '8:40-9:20'),
(123, 2, 9, 'Math', 'Nehal Butt', '8:40-9:20'),
(124, 2, 10, 'Math', 'Nehal Butt', '8:40-9:20'),
(125, 2, 11, 'Math', 'Nehal Butt', '8:40-9:20'),
(126, 2, 12, 'Math', 'Nehal Butt', '8:40-9:20'),
(127, 2, 7, 'English', 'Maryam', '9:20-10:00'),
(128, 2, 8, 'English', 'Maryam', '9:20-10:00'),
(129, 2, 9, 'English', 'Maryam', '9:20-10:00'),
(130, 2, 10, 'English', 'Maryam', '9:20-10:00'),
(131, 2, 11, 'English', 'Maryam', '9:20-10:00'),
(132, 2, 12, 'English', 'Maryam', '9:20-10:00'),
(133, 2, 7, 'Pak-Study', 'Maria Mehar', '10:00-11:40'),
(134, 2, 8, 'Pak-Study', 'Maria Mehar', '10:00-11:40'),
(135, 2, 9, 'Pak-Study', 'Maria Mehar', '10:00-11:40'),
(136, 2, 10, 'Pak-Study', 'Maria Mehar', '10:00-11:40'),
(137, 2, 11, 'Pak-Study', 'Maria Mehar', '10:00-11:40'),
(138, 2, 12, 'Pak-Study', 'Maria Mehar', '10:00-11:40'),
(139, 2, 7, 'science', 'Alina', '10:40-11:20'),
(140, 2, 8, 'science', 'Alina', '10:40-11:20'),
(141, 2, 9, 'science', 'Alina', '10:40-11:20'),
(142, 2, 10, 'science', 'Alina', '10:40-11:20'),
(143, 2, 11, 'science', 'Alina', '10:40-11:20'),
(144, 2, 12, 'science', 'Alina', '10:40-11:20'),
(145, 2, 7, 'break', '!', '11:20-11:50'),
(146, 2, 8, 'break', '!', '11:20-11:50'),
(147, 2, 9, 'break', '!', '11:20-11:50'),
(148, 2, 10, 'break', '!', '11:20-11:50'),
(149, 2, 11, '!', '!', '11:20-11:50'),
(150, 2, 12, 'break', '!', '11:20-11:50'),
(151, 2, 7, 'Pak-Study', 'Kinza cheema', '11:50-12:30'),
(152, 2, 8, 'Pak-Study', 'Kinza cheema', '11:50-12:30'),
(153, 2, 9, 'Pak-Study', 'Kinza cheema', '11:50-12:30'),
(154, 2, 10, 'Pak-Study', 'Kinza cheema', '11:50-12:30'),
(155, 2, 11, '!', '!', '11:50-12:30'),
(156, 2, 12, 'Pak-Study', 'Kinza cheema', '11:50-12:30'),
(157, 2, 7, 'Islamiat', 'Misba', '12:30-1:15'),
(158, 2, 8, 'Islamiat', 'Misba', '12:30-1:15'),
(159, 2, 9, 'Islamiat', 'Misba', '12:30-1:15'),
(160, 2, 10, 'Islamiat', 'Misba', '12:30-1:15'),
(161, 2, 11, '!', '!', '12:30-1:15'),
(162, 2, 12, 'Islamiat', 'Misba', '12:30-1:15'),
(163, 3, 13, 'Math', 'Nehal Butt', '8:00-8:40'),
(164, 3, 14, 'Math', 'Nehal Butt', '8:00-8:40'),
(165, 3, 15, 'Math', 'Nehal Butt', '8:00-8:40'),
(166, 3, 16, 'Math', 'Nehal Butt', '8:00-8:40'),
(167, 3, 17, 'Math', 'Nehal Butt', '8:00-8:40'),
(168, 3, 18, 'Math', 'Nehal Butt', '8:00-8:40'),
(169, 3, 13, 'English', 'Maryam', '8:40-9:20'),
(170, 3, 14, 'English', 'Maryam', '8:40-9:20'),
(171, 3, 15, 'English', 'Maryam', '8:40-9:20'),
(172, 3, 16, 'English', 'Maryam', '8:40-9:20'),
(173, 3, 17, 'English', 'Maryam', '8:40-9:20'),
(174, 3, 18, 'English', 'Maryam', '8:40-9:20'),
(175, 3, 13, 'Urdu', 'Aiza Mirza', '9:20-10:00'),
(176, 3, 14, 'Urdu', 'Aiza Mirza', '9:20-10:00'),
(177, 3, 15, 'Urdu', 'Aiza Mirza', '9:20-10:00'),
(178, 3, 16, 'Urdu', 'Aiza Mirza', '9:20-10:00'),
(179, 3, 17, 'Urdu', 'Aiza Mirza', '9:20-10:00'),
(180, 3, 18, 'Urdu', 'Aiza Mirza', '9:20-10:00'),
(181, 3, 13, 'science', 'Maria Mehar', '10:00-11:40'),
(182, 3, 14, 'science', 'Maria Mehar', '10:00-11:40'),
(183, 3, 15, 'science', 'Maria Mehar', '10:00-11:40'),
(184, 3, 16, 'science', 'Maria Mehar', '10:00-11:40'),
(185, 3, 17, 'science', 'Maria Mehar', '10:00-11:40'),
(186, 3, 18, 'science', 'Maria Mehar', '10:00-11:40'),
(187, 3, 13, 'Islamiat', 'Tahreem ', '10:40-11:20'),
(188, 3, 14, 'Islamiat', 'Tahreem ', '10:40-11:20'),
(189, 3, 15, 'Islamiat', 'Tahreem ', '10:40-11:20'),
(190, 3, 16, 'Islamiat', 'Tahreem ', '10:40-11:20'),
(191, 3, 17, 'Islamiat', 'Tahreem ', '10:40-11:20'),
(192, 3, 18, 'Islamiat', 'Tahreem ', '10:40-11:20'),
(193, 3, 13, 'break', '!', '11:20-11:50'),
(194, 3, 14, 'break', '!', '11:20-11:50'),
(195, 3, 15, 'break', '!', '11:20-11:50'),
(196, 3, 16, 'break', '!', '11:20-11:50'),
(197, 3, 17, '!', '!', '11:20-11:50'),
(198, 3, 18, 'break', '!', '11:20-11:50'),
(199, 3, 13, 'Pak-Study', 'Alina', '11:50-12:30'),
(200, 3, 14, 'Pak-Study', 'Alina', '11:50-12:30'),
(201, 3, 15, 'Pak-Study', 'Alina', '11:50-12:30'),
(202, 3, 16, 'Pak-Study', 'Alina', '11:50-12:30'),
(203, 3, 17, '!', '!', '11:50-12:30'),
(204, 3, 18, 'Pak-Study', 'Alina', '11:50-12:30'),
(205, 3, 13, 'computer', 'Kinza cheema', '12:30-1:15'),
(206, 3, 14, 'computer', 'Kinza cheema', '12:30-1:15'),
(207, 3, 15, 'computer', 'Kinza cheema', '12:30-1:15'),
(208, 3, 16, 'computer', 'Kinza cheema', '12:30-1:15'),
(209, 3, 17, '!', '!', '12:30-1:15'),
(210, 3, 18, 'computer', 'Kinza cheema', '12:30-1:15'),
(211, 4, 19, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(212, 4, 20, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(213, 4, 21, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(214, 4, 22, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(215, 4, 23, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(216, 4, 24, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(217, 4, 19, 'Urdu', 'Maryam', '8:40-9:20'),
(218, 4, 20, 'Urdu', 'Maryam', '8:40-9:20'),
(219, 4, 21, 'Urdu', 'Maryam', '8:40-9:20'),
(220, 4, 22, 'Urdu', 'Maryam', '8:40-9:20'),
(221, 4, 23, 'Urdu', 'Maryam', '8:40-9:20'),
(222, 4, 24, 'Urdu', 'Maryam', '8:40-9:20'),
(223, 4, 19, 'Math', 'Nehal Butt', '9:20-10:00'),
(224, 4, 20, 'Math', 'Nehal Butt', '9:20-10:00'),
(225, 4, 21, 'Math', 'Nehal Butt', '9:20-10:00'),
(226, 4, 22, 'Math', 'Nehal Butt', '9:20-10:00'),
(227, 4, 23, 'Math', 'Nehal Butt', '9:20-10:00'),
(228, 4, 24, 'Math', 'Nehal Butt', '9:20-10:00'),
(229, 4, 19, 'science', 'Tahreem ', '10:00-11:40'),
(230, 4, 20, 'science', 'Tahreem ', '10:00-11:40'),
(231, 4, 21, 'science', 'Tahreem ', '10:00-11:40'),
(232, 4, 22, 'science', 'Tahreem ', '10:00-11:40'),
(233, 4, 23, 'science', '!', '10:00-11:40'),
(234, 4, 24, 'science', 'Tahreem ', '10:00-11:40'),
(235, 4, 19, 'computer', 'Maria Mehar', '10:40-11:20'),
(236, 4, 20, 'computer', 'Maria Mehar', '10:40-11:20'),
(237, 4, 21, 'computer', 'Maria Mehar', '10:40-11:20'),
(238, 4, 22, 'computer', 'Maria Mehar', '10:40-11:20'),
(239, 4, 23, 'computer', 'Maria Mehar', '10:40-11:20'),
(240, 4, 24, 'computer', 'Maria Mehar', '10:40-11:20'),
(241, 4, 19, 'break', '!', '11:20-11:50'),
(242, 4, 20, 'break', '!', '11:20-11:50'),
(243, 4, 21, 'break', '!', '11:20-11:50'),
(244, 4, 22, 'break', '!', '11:20-11:50'),
(245, 4, 23, '!', '!', '11:20-11:50'),
(246, 4, 24, 'break', '!', '11:20-11:50'),
(247, 4, 19, 'Islamiat', 'Kinza cheema', '11:50-12:30'),
(248, 4, 20, 'Islamiat', 'Kinza cheema', '11:50-12:30'),
(249, 4, 21, 'Islamiat', 'Kinza cheema', '11:50-12:30'),
(250, 4, 22, 'Islamiat', 'Kinza cheema', '11:50-12:30'),
(251, 4, 23, '!', '!', '11:50-12:30'),
(252, 4, 24, 'Islamiat', 'Kinza cheema', '11:50-12:30'),
(253, 4, 19, 'Pak-Study', 'Alina', '12:30-1:15'),
(254, 4, 20, 'Pak-Study', 'Alina', '12:30-1:15'),
(255, 4, 21, 'Pak-Study', 'Alina', '12:30-1:15'),
(256, 4, 22, 'Pak-Study', 'Alina', '12:30-1:15'),
(257, 4, 23, '!', '!', '12:30-1:15'),
(258, 4, 24, 'Pak-Study', 'Alina', '12:30-1:15'),
(259, 5, 25, 'Math', 'Nehal Butt', '8:00-8:40'),
(260, 5, 26, 'Math', 'Nehal Butt', '8:00-8:40'),
(261, 5, 27, 'Math', 'Nehal Butt', '8:00-8:40'),
(262, 5, 28, 'Math', 'Nehal Butt', '8:00-8:40'),
(263, 5, 29, 'Math', 'Nehal Butt', '8:00-8:40'),
(264, 5, 30, 'Math', 'Nehal Butt', '8:00-8:40'),
(265, 5, 25, 'Urdu', 'Maryam', '8:40-9:20'),
(266, 5, 26, 'Urdu', 'Maryam', '8:40-9:20'),
(267, 5, 27, 'Urdu', 'Maryam', '8:40-9:20'),
(268, 5, 28, 'Urdu', 'Maryam', '8:40-9:20'),
(269, 5, 29, 'Urdu', 'Maryam', '8:40-9:20'),
(270, 5, 30, 'Urdu', 'Maryam', '8:40-9:20'),
(271, 5, 25, 'English', 'Aiza Mirza', '9:20-10:00'),
(272, 5, 26, 'English', 'Aiza Mirza', '9:20-10:00'),
(273, 5, 27, 'English', 'Aiza Mirza', '9:20-10:00'),
(274, 5, 28, 'English', 'Aiza Mirza', '9:20-10:00'),
(275, 5, 29, 'English', 'Aiza Mirza', '9:20-10:00'),
(276, 5, 30, 'English', 'Aiza Mirza', '9:20-10:00'),
(277, 5, 25, 'Pak-Study', 'Tahreem ', '10:00-11:40'),
(278, 5, 26, 'Pak-Study', 'Tahreem ', '10:00-11:40'),
(279, 5, 27, 'Pak-Study', 'Tahreem ', '10:00-11:40'),
(280, 5, 28, 'Pak-Study', 'Tahreem ', '10:00-11:40'),
(281, 5, 29, 'Pak-Study', 'Tahreem ', '10:00-11:40'),
(282, 5, 30, 'Pak-Study', 'Tahreem ', '10:00-11:40'),
(283, 5, 25, 'computer', 'Maria Mehar', '10:40-11:20'),
(284, 5, 26, 'computer', 'Maria Mehar', '10:40-11:20'),
(285, 5, 27, 'computer', 'Maria Mehar', '10:40-11:20'),
(286, 5, 28, 'computer', 'Maria Mehar', '10:40-11:20'),
(287, 5, 29, 'computer', 'Maria Mehar', '10:40-11:20'),
(288, 5, 30, 'computer', 'Maria Mehar', '10:40-11:20'),
(289, 5, 25, 'break', '!', '11:20-11:50'),
(290, 5, 26, 'break', '!', '11:20-11:50'),
(291, 5, 27, 'break', '!', '11:20-11:50'),
(292, 5, 28, 'break', '!', '11:20-11:50'),
(293, 5, 29, '!', '!', '11:20-11:50'),
(294, 5, 30, 'break', '!', '11:20-11:50'),
(295, 5, 25, 'Islamiat', 'Alina', '11:50-12:30'),
(296, 5, 26, 'Islamiat', 'Alina', '11:50-12:30'),
(297, 5, 27, 'Islamiat', 'Alina', '11:50-12:30'),
(298, 5, 28, 'Islamiat', 'Alina', '11:50-12:30'),
(299, 5, 29, '!', '!', '11:50-12:30'),
(300, 5, 30, 'Islamiat', 'Alina', '11:50-12:30'),
(301, 5, 25, 'Science', 'Kinza cheema', '12:30-1:15'),
(302, 5, 26, 'Science', 'Kinza cheema', '12:30-1:15'),
(303, 5, 27, 'Science', 'Kinza cheema', '12:30-1:15'),
(304, 5, 28, 'Science', 'Kinza cheema', '12:30-1:15'),
(305, 5, 29, '!', '!', '12:30-1:15'),
(306, 5, 30, 'Science', 'Kinza cheema', '12:30-1:15'),
(307, 6, 31, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(308, 6, 32, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(309, 6, 33, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(310, 6, 34, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(311, 6, 35, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(312, 6, 36, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(313, 6, 31, 'Math', 'Nehal Butt', '8:40-9:20'),
(314, 6, 32, 'Math', 'Nehal Butt', '8:40-9:20'),
(315, 6, 33, 'Math', 'Nehal Butt', '8:40-9:20'),
(316, 6, 34, 'Math', 'Nehal Butt', '8:40-9:20'),
(317, 6, 35, 'Math', 'Nehal Butt', '8:40-9:20'),
(318, 6, 36, 'Math', 'Nehal Butt', '8:40-9:20'),
(319, 6, 31, 'Urdu', 'Misba', '9:20-10:00'),
(320, 6, 32, 'Urdu', 'Misba', '9:20-10:00'),
(321, 6, 33, 'Urdu', 'Misba', '9:20-10:00'),
(322, 6, 34, 'Urdu', 'Misba', '9:20-10:00'),
(323, 6, 35, 'Urdu', 'Misba', '9:20-10:00'),
(324, 6, 36, 'Urdu', 'Misba', '9:20-10:00'),
(325, 6, 31, 'Pak-Study', 'Maryam', '10:00-11:40'),
(326, 6, 32, 'Pak-Study', 'Maryam', '10:00-11:40'),
(327, 6, 33, 'Pak-Study', 'Maryam', '10:00-11:40'),
(328, 6, 34, 'Pak-Study', 'Maryam', '10:00-11:40'),
(329, 6, 35, 'Pak-Study', 'Maryam', '10:00-11:40'),
(330, 6, 36, 'Pak-Study', 'Maryam', '10:00-11:40'),
(331, 6, 31, 'science', 'Tahreem ', '10:40-11:20'),
(332, 6, 32, 'science', 'Tahreem ', '10:40-11:20'),
(333, 6, 33, 'science', 'Tahreem ', '10:40-11:20'),
(334, 6, 34, 'science', 'Tahreem ', '10:40-11:20'),
(335, 6, 35, 'science', 'Tahreem ', '10:40-11:20'),
(336, 6, 36, 'science', 'Tahreem ', '10:40-11:20'),
(337, 6, 31, 'break', '!', '11:20-11:50'),
(338, 6, 32, 'break', '!', '11:20-11:50'),
(339, 6, 33, 'break', '!', '11:20-11:50'),
(340, 6, 34, 'break', '!', '11:20-11:50'),
(341, 6, 35, '!', '!', '11:20-11:50'),
(342, 6, 36, 'break', '!', '11:20-11:50'),
(343, 6, 31, 'Islamiat', 'Maria Mehar', '11:50-12:30'),
(344, 6, 32, 'Islamiat', 'Maria Mehar', '11:50-12:30'),
(345, 6, 33, 'Islamiat', 'Maria Mehar', '11:50-12:30'),
(346, 6, 34, 'Islamiat', 'Maria Mehar', '11:50-12:30'),
(347, 6, 35, '!', '!', '11:50-12:30'),
(348, 6, 36, 'Islamiat', 'Maria Mehar', '11:50-12:30'),
(349, 6, 31, 'computer', 'Alina', '12:30-1:15'),
(350, 6, 32, 'computer', 'Alina', '12:30-1:15'),
(351, 6, 33, 'computer', 'Alina', '12:30-1:15'),
(352, 6, 34, 'computer', 'Alina', '12:30-1:15'),
(353, 6, 35, '!', '!', '12:30-1:15'),
(354, 6, 36, 'computer', 'Alina', '12:30-1:15'),
(355, 7, 37, 'Math', 'Nehal Butt', '8:00-8:40'),
(356, 7, 38, 'Math', 'Nehal Butt', '8:00-8:40'),
(357, 7, 39, 'Math', 'Nehal Butt', '8:00-8:40'),
(358, 7, 40, 'Math', 'Nehal Butt', '8:00-8:40'),
(359, 7, 41, 'Math', 'Nehal Butt', '8:00-8:40'),
(360, 7, 42, 'Math', 'Nehal Butt', '8:00-8:40'),
(361, 7, 37, 'Urdu', 'Aiza Mirza', '8:40-9:20'),
(362, 7, 38, 'Urdu', 'Aiza Mirza', '8:40-9:20'),
(363, 7, 39, 'Urdu', 'Aiza Mirza', '8:40-9:20'),
(364, 7, 40, 'Urdu', 'Aiza Mirza', '8:40-9:20'),
(365, 7, 41, 'Urdu', 'Aiza Mirza', '8:40-9:20'),
(366, 7, 42, 'Urdu', 'Aiza Mirza', '8:40-9:20'),
(367, 7, 37, 'English', 'Maryam', '9:20-10:00'),
(368, 7, 38, 'English', 'Maryam', '9:20-10:00'),
(369, 7, 39, 'English', 'Maryam', '9:20-10:00'),
(370, 7, 40, 'English', 'Maryam', '9:20-10:00'),
(371, 7, 41, 'English', 'Maryam', '9:20-10:00'),
(372, 7, 42, 'English', 'Maryam', '9:20-10:00'),
(373, 7, 37, 'Pak-Study', 'Tahreem ', '10:00-11:40'),
(374, 7, 38, 'Pak-Study', 'Tahreem ', '10:00-11:40'),
(375, 7, 39, 'Pak-Study', 'Tahreem ', '10:00-11:40'),
(376, 7, 40, 'Pak-Study', 'Tahreem ', '10:00-11:40'),
(377, 7, 41, 'Pak-Study', 'Tahreem ', '10:00-11:40'),
(378, 7, 42, 'Pak-Study', 'Tahreem ', '10:00-11:40'),
(379, 7, 37, 'computer', 'Maria Mehar', '10:40-11:20'),
(380, 7, 38, 'computer', 'Maria Mehar', '10:40-11:20'),
(381, 7, 39, 'computer', 'Maria Mehar', '10:40-11:20'),
(382, 7, 40, 'computer', 'Maria Mehar', '10:40-11:20'),
(383, 7, 41, 'computer', 'Maria Mehar', '10:40-11:20'),
(384, 7, 42, 'computer', 'Maria Mehar', '10:40-11:20'),
(385, 7, 37, 'break', '!', '11:20-11:50'),
(386, 7, 38, 'break', '!', '11:20-11:50'),
(387, 7, 39, 'break', '!', '11:20-11:50'),
(388, 7, 40, 'break', '!', '11:20-11:50'),
(389, 7, 41, '!', '!', '11:20-11:50'),
(390, 7, 42, 'break', '!', '11:20-11:50'),
(391, 7, 37, 'Islamiat', 'Alina', '11:50-12:30'),
(392, 7, 38, 'Islamiat', 'Alina', '11:50-12:30'),
(393, 7, 39, 'Islamiat', 'Alina', '11:50-12:30'),
(394, 7, 40, 'Islamiat', 'Alina', '11:50-12:30'),
(395, 7, 41, '!', 'Alina', '11:50-12:30'),
(396, 7, 42, 'Islamiat', 'Alina', '11:50-12:30'),
(397, 8, 43, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(398, 8, 44, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(399, 8, 45, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(400, 8, 46, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(401, 8, 47, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(402, 8, 48, 'Engilsh', 'Aiza Mirza', '8:00-8:40'),
(403, 8, 43, 'Urdu', 'Maryam', '8:40-9:20'),
(404, 8, 44, 'Urdu', 'Maryam', '8:40-9:20'),
(405, 8, 45, 'Urdu', 'Maryam', '8:40-9:20'),
(406, 8, 46, 'Urdu', 'Maryam', '8:40-9:20'),
(407, 8, 47, 'Urdu', 'Maryam', '8:40-9:20'),
(408, 8, 48, 'Urdu', 'Maryam', '8:40-9:20'),
(409, 8, 43, 'Math', 'Nehal Butt', '9:20-10:00'),
(410, 8, 44, 'Math', 'Nehal Butt', '9:20-10:00'),
(411, 8, 45, 'Math', 'Nehal Butt', '9:20-10:00'),
(412, 8, 46, 'Math', 'Nehal Butt', '9:20-10:00'),
(413, 8, 47, 'Math', 'Nehal Butt', '9:20-10:00'),
(414, 8, 48, 'Math', 'Nehal Butt', '9:20-10:00'),
(415, 8, 43, 'Pak-Study', 'Alina', '10:00-11:40'),
(416, 8, 44, 'Pak-Study', 'Alina', '10:00-11:40'),
(417, 8, 45, 'Pak-Study', 'Alina', '10:00-11:40'),
(418, 8, 46, 'Pak-Study', 'Alina', '10:00-11:40'),
(419, 8, 47, 'Pak-Study', 'Alina', '10:00-11:40'),
(420, 8, 48, 'Pak-Study', 'Alina', '10:00-11:40'),
(421, 8, 43, 'computer', 'Maria Mehar', '10:40-11:20'),
(422, 8, 44, 'computer', 'Maria Mehar', '10:40-11:20'),
(423, 8, 45, 'computer', 'Maria Mehar', '10:40-11:20'),
(424, 8, 46, 'computer', 'Maria Mehar', '10:40-11:20'),
(425, 8, 47, 'computer', 'Maria Mehar', '10:40-11:20'),
(426, 8, 48, 'computer', 'Maria Mehar', '10:40-11:20'),
(427, 8, 43, 'break', '!', '11:20-11:50'),
(428, 8, 44, 'break', '!', '11:20-11:50'),
(429, 8, 45, 'break', '!', '11:20-11:50'),
(430, 8, 46, 'break', '!', '11:20-11:50'),
(431, 8, 47, '!', '!', '11:20-11:50'),
(432, 8, 48, 'break', '!', '11:20-11:50'),
(433, 8, 43, 'Islamiat', 'Kinza cheema', '11:50-12:30'),
(434, 8, 44, 'Islamiat', 'Kinza cheema', '11:50-12:30'),
(435, 8, 45, 'Islamiat', 'Kinza cheema', '11:50-12:30'),
(436, 8, 46, 'Islamiat', 'Kinza cheema', '11:50-12:30'),
(437, 8, 47, '!', '!', '11:50-12:30'),
(438, 8, 48, 'Islamiat', 'Kinza cheema', '11:50-12:30'),
(439, 8, 43, 'Science', 'Tahreem ', '12:30-1:15'),
(440, 8, 44, 'Science', 'Tahreem ', '12:30-1:15'),
(441, 8, 45, 'Science', 'Tahreem ', '12:30-1:15'),
(442, 8, 46, 'Science', 'Tahreem ', '12:30-1:15'),
(443, 8, 47, '!', '!', '12:30-1:15'),
(444, 8, 48, 'Science', 'Tahreem ', '12:30-1:15'),
(445, 9, 49, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(446, 9, 50, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(447, 9, 51, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(448, 9, 52, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(449, 9, 53, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(450, 9, 54, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(451, 9, 49, 'Math', 'Nehal Butt', '8:40-9:20'),
(452, 9, 50, 'Math', 'Nehal Butt', '8:40-9:20'),
(453, 9, 51, 'Math', 'Nehal Butt', '8:40-9:20'),
(454, 9, 52, 'Math', 'Nehal Butt', '8:40-9:20'),
(455, 9, 53, 'Math', 'Nehal Butt', '8:40-9:20'),
(456, 9, 54, 'Math', 'Nehal Butt', '8:40-9:20'),
(457, 9, 49, 'Urdu', 'Hamid Rajpoot', '9:20-10:00'),
(458, 9, 50, 'Urdu', 'Hamid Rajpoot', '9:20-10:00'),
(459, 9, 51, 'Urdu', 'Hamid Rajpoot', '9:20-10:00'),
(460, 9, 52, 'Urdu', 'Hamid Rajpoot', '9:20-10:00'),
(461, 9, 53, 'Urdu', 'Hamid Rajpoot', '9:20-10:00'),
(462, 9, 54, 'Urdu', 'Hamid Rajpoot', '9:20-10:00'),
(463, 9, 49, 'Pak-Study', 'Sir Imran', '10:00-11:40'),
(464, 9, 50, 'Pak-Study', 'Sir Imran', '10:00-11:40'),
(465, 9, 51, 'Pak-Study', 'Sir Imran', '10:00-11:40'),
(466, 9, 52, 'Pak-Study', 'Sir Imran', '10:00-11:40'),
(467, 9, 53, 'Pak-Study', 'Sir Imran', '10:00-11:40'),
(468, 9, 54, 'Pak-Study', 'Sir Imran', '10:00-11:40'),
(469, 9, 49, 'science', 'Sir Tanveer', '10:40-11:20'),
(470, 9, 50, 'science', 'Sir Tanveer', '10:40-11:20'),
(471, 9, 51, 'science', 'Sir Tanveer', '10:40-11:20'),
(472, 9, 52, 'science', 'Sir Tanveer', '10:40-11:20'),
(473, 9, 53, 'science', 'Sir Tanveer', '10:40-11:20'),
(474, 9, 54, 'science', 'Sir Tanveer', '10:40-11:20'),
(475, 9, 49, 'break', '!', '11:20-11:50'),
(476, 9, 50, 'break', '!', '11:20-11:50'),
(477, 9, 51, 'break', '!', '11:20-11:50'),
(478, 9, 52, 'break', '!', '11:20-11:50'),
(479, 9, 53, '!', '!', '11:20-11:50'),
(480, 9, 54, 'break', '!', '11:20-11:50'),
(481, 9, 49, 'Islamiat', 'Rana Adil ', '11:50-12:30'),
(482, 9, 50, 'Islamiat', 'Rana Adil ', '11:50-12:30'),
(483, 9, 51, 'Islamiat', 'Rana Adil ', '11:50-12:30'),
(484, 9, 52, 'Islamiat', 'Rana Adil ', '11:50-12:30'),
(485, 9, 53, '!', 'Rana Adil ', '11:50-12:30'),
(486, 9, 54, 'Islamiat', 'Rana Adil ', '11:50-12:30'),
(487, 9, 49, 'computer', 'Zaman Jutt', '12:30-1:15'),
(488, 9, 50, 'computer', 'Zaman Jutt', '12:30-1:15'),
(489, 9, 51, 'computer', 'Zaman Jutt', '12:30-1:15'),
(490, 9, 52, 'computer', 'Zaman Jutt', '12:30-1:15'),
(491, 9, 53, '!', '!', '12:30-1:15'),
(492, 9, 54, 'computer', 'Zaman Jutt', '12:30-1:15'),
(493, 10, 55, 'Urdu', 'Ali Haider', '8:00-8:40'),
(494, 10, 56, 'Urdu', 'Ali Haider', '8:00-8:40'),
(495, 10, 57, 'Urdu', 'Ali Haider', '8:00-8:40'),
(496, 10, 58, 'Urdu', 'Ali Haider', '8:00-8:40'),
(497, 10, 59, 'Urdu', 'Ali Haider', '8:00-8:40'),
(498, 10, 60, 'Urdu', 'Ali Haider', '8:00-8:40'),
(499, 10, 55, 'English', 'Waleed Mughal', '8:40-9:20'),
(500, 10, 56, 'English', 'Waleed Mughal', '8:40-9:20'),
(501, 10, 57, 'English', 'Waleed Mughal', '8:40-9:20'),
(502, 10, 58, 'English', 'Waleed Mughal', '8:40-9:20'),
(503, 10, 59, 'English', 'Waleed Mughal', '8:40-9:20'),
(504, 10, 60, 'English', 'Waleed Mughal', '8:40-9:20'),
(505, 10, 55, 'Math', 'Nehal Butt', '9:20-10:00'),
(506, 10, 56, 'Math', 'Nehal Butt', '9:20-10:00'),
(507, 10, 57, 'Math', 'Nehal Butt', '9:20-10:00'),
(508, 10, 58, 'Math', 'Nehal Butt', '9:20-10:00'),
(509, 10, 59, 'Math', 'Nehal Butt', '9:20-10:00'),
(510, 10, 60, 'Math', 'Nehal Butt', '9:20-10:00'),
(511, 10, 55, 'Pak-Study', 'Ali Haider', '10:00-11:40'),
(512, 10, 56, 'Pak-Study', 'Ali Haider', '10:00-11:40'),
(513, 10, 57, 'Pak-Study', 'Ali Haider', '10:00-11:40'),
(514, 10, 58, 'Pak-Study', 'Ali Haider', '10:00-11:40'),
(515, 10, 59, 'Pak-Study', 'Ali Haider', '10:00-11:40'),
(516, 10, 60, 'Pak-Study', 'Ali Haider', '10:00-11:40'),
(517, 10, 55, 'computer', 'Rana Uzair ', '10:40-11:20'),
(518, 10, 56, 'computer', 'Rana Uzair ', '10:40-11:20'),
(519, 10, 57, 'computer', 'Rana Uzair ', '10:40-11:20'),
(520, 10, 58, 'computer', 'Rana Uzair ', '10:40-11:20'),
(521, 10, 59, 'computer', 'Rana Uzair ', '10:40-11:20'),
(522, 10, 60, 'computer', 'Rana Uzair ', '10:40-11:20'),
(523, 10, 55, 'break', '!', '11:20-11:50'),
(524, 10, 56, 'break', '!', '11:20-11:50'),
(525, 10, 57, 'break', '!', '11:20-11:50'),
(526, 10, 58, 'break', '!', '11:20-11:50'),
(527, 10, 59, '!', '!', '11:20-11:50'),
(528, 10, 60, 'break', '!', '11:20-11:50'),
(529, 10, 55, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(530, 10, 56, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(531, 10, 57, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(532, 10, 58, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(533, 10, 59, '!', '!', '11:50-12:30'),
(534, 10, 60, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(535, 10, 55, 'computer', 'Sir Imran', '12:30-1:15'),
(536, 10, 56, 'computer', 'Sir Imran', '12:30-1:15'),
(537, 10, 57, 'computer', 'Sir Imran', '12:30-1:15'),
(538, 10, 58, 'computer', 'Sir Imran', '12:30-1:15'),
(539, 10, 59, '!', '!', '12:30-1:15'),
(540, 10, 60, 'computer', 'Sir Imran', '12:30-1:15'),
(541, 11, 61, 'Engilsh', 'Abdullah cheema', '8:00-8:40'),
(542, 11, 62, 'Engilsh', 'Abdullah cheema', '8:00-8:40'),
(543, 11, 63, 'Engilsh', 'Arslan Cheema', '8:00-8:40'),
(544, 11, 64, 'Engilsh', 'Abdullah cheema', '8:00-8:40'),
(545, 11, 65, 'Engilsh', 'Abdullah cheema', '8:00-8:40'),
(546, 11, 66, 'Engilsh', 'Abdullah cheema', '8:00-8:40'),
(547, 11, 61, 'Urdu', 'Arham Arshad', '8:40-9:20'),
(548, 11, 62, 'Urdu', 'Arham Arshad', '8:40-9:20'),
(549, 11, 63, 'Urdu', 'Arham Arshad', '8:40-9:20'),
(550, 11, 64, 'Urdu', 'Arham Arshad', '8:40-9:20'),
(551, 11, 65, 'Urdu', 'Arham Arshad', '8:40-9:20'),
(552, 11, 66, 'Urdu', 'Arham Arshad', '8:40-9:20'),
(553, 11, 61, 'Math', 'Nehal Butt', '9:20-10:00'),
(554, 11, 62, 'Math', 'Nehal Butt', '9:20-10:00'),
(555, 11, 63, 'Math', 'Nehal Butt', '9:20-10:00'),
(556, 11, 64, 'Math', 'Nehal Butt', '9:20-10:00'),
(557, 11, 65, 'Math', 'Nehal Butt', '9:20-10:00'),
(558, 11, 66, 'Math', 'Nehal Butt', '9:20-10:00'),
(559, 11, 61, 'Pak-Study', 'Maryam', '10:00-11:40'),
(560, 11, 62, 'Pak-Study', 'Maryam', '10:00-11:40'),
(561, 11, 63, 'Pak-Study', 'Maryam', '10:00-11:40'),
(562, 11, 64, 'Pak-Study', 'Maryam', '10:00-11:40'),
(563, 11, 65, 'Pak-Study', 'Maryam', '10:00-11:40'),
(564, 11, 66, 'Pak-Study', 'Maryam', '10:00-11:40'),
(565, 11, 61, 'computer', 'Rana Uzair ', '10:40-11:20'),
(566, 11, 62, 'computer', 'Rana Uzair ', '10:40-11:20'),
(567, 11, 63, 'computer', 'Rana Uzair ', '10:40-11:20'),
(568, 11, 64, 'computer', 'Rana Uzair ', '10:40-11:20'),
(569, 11, 65, 'computer', 'Rana Uzair ', '10:40-11:20'),
(570, 11, 66, 'computer', 'Rana Uzair ', '10:40-11:20'),
(571, 11, 61, 'break', '!', '11:20-11:50'),
(572, 11, 62, 'break', '!', '11:20-11:50'),
(573, 11, 63, 'break', '!', '11:20-11:50'),
(574, 11, 64, 'break', '!', '11:20-11:50'),
(575, 11, 65, '!', '!', '11:20-11:50'),
(576, 11, 66, 'break', '!', '11:20-11:50'),
(577, 11, 61, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(578, 11, 62, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(579, 11, 63, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(580, 11, 64, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(581, 11, 65, '!', 'Hamid Rajpoot', '11:50-12:30'),
(582, 11, 66, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(583, 11, 61, 'Science', 'Tahreem ', '12:30-1:15'),
(584, 11, 62, 'Science', 'Tahreem ', '12:30-1:15'),
(585, 11, 63, 'science', 'Tahreem ', '12:30-1:15'),
(586, 11, 64, 'Science', 'Tahreem ', '12:30-1:15'),
(587, 11, 65, '!', '!', '12:30-1:15'),
(588, 11, 66, 'Science', 'Tahreem ', '12:30-1:15'),
(589, 12, 67, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(590, 12, 68, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(591, 12, 69, 'Math', 'Rana Uzair ', '8:00-8:40'),
(592, 12, 70, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(593, 12, 71, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(594, 12, 72, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(595, 12, 67, 'Math', 'Nehal Butt', '8:40-9:20'),
(596, 12, 68, 'Math', 'Nehal Butt', '8:40-9:20'),
(597, 12, 69, 'Math', 'Nehal Butt', '8:40-9:20'),
(598, 12, 70, 'Math', 'Nehal Butt', '8:40-9:20'),
(599, 12, 71, 'Math', 'Nehal Butt', '8:40-9:20'),
(600, 12, 72, 'Math', 'Nehal Butt', '8:40-9:20'),
(601, 12, 67, 'Urdu', 'Sir Tanveer', '9:20-10:00'),
(602, 12, 68, 'Urdu', 'Sir Tanveer', '9:20-10:00'),
(603, 12, 69, 'Urdu', 'Sir Tanveer', '9:20-10:00'),
(604, 12, 70, 'Urdu', 'Sir Tanveer', '9:20-10:00'),
(605, 12, 71, 'Urdu', 'Sir Tanveer', '9:20-10:00'),
(606, 12, 72, 'Urdu', 'Sir Tanveer', '9:20-10:00'),
(607, 12, 67, 'Pak-Study', 'Zaman Jutt', '10:00-11:40'),
(608, 12, 68, 'Pak-Study', 'Zaman Jutt', '10:00-11:40'),
(609, 12, 69, 'Pak-Study', 'Zaman Jutt', '10:00-11:40'),
(610, 12, 70, 'Pak-Study', 'Zaman Jutt', '10:00-11:40'),
(611, 12, 71, 'Pak-Study', 'Zaman Jutt', '10:00-11:40'),
(612, 12, 72, 'Pak-Study', 'Zaman Jutt', '10:00-11:40'),
(613, 12, 67, 'computer', 'Ali Haider', '10:40-11:20'),
(614, 12, 68, 'computer', 'Ali Haider', '10:40-11:20'),
(615, 12, 69, 'computer', 'Ali Haider', '10:40-11:20'),
(616, 12, 70, 'computer', 'Ali Haider', '10:40-11:20'),
(617, 12, 71, 'computer', 'Ali Haider', '10:40-11:20'),
(618, 12, 72, 'computer', 'Ali Haider', '10:40-11:20'),
(619, 12, 67, 'break', '!', '11:20-11:50'),
(620, 12, 68, 'break', '!', '11:20-11:50'),
(621, 12, 69, 'break', '!', '11:20-11:50'),
(622, 12, 70, 'break', '!', '11:20-11:50'),
(623, 12, 71, '!', '!', '11:20-11:50'),
(624, 12, 72, 'break', '!', '11:20-11:50'),
(625, 12, 67, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(626, 12, 68, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(627, 12, 69, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(628, 12, 70, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(629, 12, 71, '!', '!', '11:50-12:30'),
(630, 12, 72, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(631, 12, 67, 'Science', 'Rana Adil ', '12:30-1:15'),
(632, 12, 68, 'Science', 'Rana Adil ', '12:30-1:15'),
(633, 12, 69, 'science', 'Rana Adil ', '12:30-1:15'),
(634, 12, 70, 'Science', 'Rana Adil ', '12:30-1:15'),
(635, 12, 71, '!', '!', '12:30-1:15'),
(636, 12, 72, 'Science', 'Rana Adil ', '12:30-1:15'),
(637, 13, 73, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(638, 13, 74, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(639, 13, 75, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(640, 13, 76, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(641, 13, 77, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(642, 13, 78, 'Engilsh', 'Rana Uzair ', '8:00-8:40'),
(643, 13, 73, 'Urdu', 'Waleed Mughal', '8:40-9:20'),
(644, 13, 74, 'Urdu', 'Waleed Mughal', '8:40-9:20'),
(645, 13, 75, 'Urdu', 'Waleed Mughal', '8:40-9:20'),
(646, 13, 76, 'Urdu', 'Waleed Mughal', '8:40-9:20'),
(647, 13, 77, 'Urdu', 'Waleed Mughal', '8:40-9:20'),
(648, 13, 78, 'Urdu', 'Waleed Mughal', '8:40-9:20'),
(649, 13, 73, 'Math', 'Aiza Mirza', '9:20-10:00'),
(650, 13, 74, 'Math', 'Aiza Mirza', '9:20-10:00'),
(651, 13, 75, 'Math', 'Aiza Mirza', '9:20-10:00'),
(652, 13, 76, 'Math', 'Aiza Mirza', '9:20-10:00'),
(653, 13, 77, 'Math', 'Aiza Mirza', '9:20-10:00'),
(654, 13, 78, 'Math', 'Aiza Mirza', '9:20-10:00'),
(655, 13, 73, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(656, 13, 74, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(657, 13, 75, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(658, 13, 76, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(659, 13, 77, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(660, 13, 78, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(661, 13, 73, 'computer', 'Arham Arshad', '10:40-11:20'),
(662, 13, 74, 'computer', 'Arham Arshad', '10:40-11:20'),
(663, 13, 75, 'computer', 'Arham Arshad', '10:40-11:20'),
(664, 13, 76, 'computer', 'Arham Arshad', '10:40-11:20'),
(665, 13, 77, 'computer', 'Arham Arshad', '10:40-11:20'),
(666, 13, 78, 'computer', 'Arham Arshad', '10:40-11:20'),
(667, 13, 73, 'break', '!', '11:20-11:50'),
(668, 13, 74, 'break', '!', '11:20-11:50'),
(669, 13, 75, 'break', '!', '11:20-11:50'),
(670, 13, 76, 'break', '!', '11:20-11:50'),
(671, 13, 77, '!', '!', '11:20-11:50'),
(672, 13, 78, 'break', '!', '11:20-11:50'),
(673, 13, 73, 'Islamiat', 'Sir Imran', '11:50-12:30'),
(674, 13, 74, 'Islamiat', 'Sir Imran', '11:50-12:30'),
(675, 13, 75, 'Islamiat', 'Sir Imran', '11:50-12:30'),
(676, 13, 76, 'Islamiat', 'Sir Imran', '11:50-12:30'),
(677, 13, 77, 'Islamiat', 'Sir Imran', '11:50-12:30'),
(678, 13, 78, 'Islamiat', 'Sir Imran', '11:50-12:30'),
(679, 13, 73, 'Science', 'Zaman Jutt', '12:30-1:15'),
(680, 13, 74, 'Science', 'Zaman Jutt', '12:30-1:15'),
(681, 13, 75, 'computer', 'Zaman Jutt', '12:30-1:15'),
(682, 13, 76, 'Science', 'Zaman Jutt', '12:30-1:15'),
(683, 13, 77, 'Science', 'Zaman Jutt', '12:30-1:15'),
(684, 13, 78, 'Science', 'Zaman Jutt', '12:30-1:15'),
(685, 14, 79, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(686, 14, 80, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(687, 14, 81, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(688, 14, 82, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(689, 14, 83, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(690, 14, 84, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(691, 14, 79, 'Urdu', 'Sir Tanveer', '8:40-9:20'),
(692, 14, 80, 'Urdu', 'Sir Tanveer', '8:40-9:20'),
(693, 14, 81, 'Urdu', 'Sir Tanveer', '8:40-9:20'),
(694, 14, 82, 'Urdu', 'Sir Tanveer', '8:40-9:20'),
(695, 14, 83, 'Urdu', 'Sir Tanveer', '8:40-9:20'),
(696, 14, 84, 'Urdu', 'Sir Tanveer', '8:40-9:20'),
(697, 14, 79, 'Math', 'Ali Haider', '9:20-10:00'),
(698, 14, 80, 'Math', 'Ali Haider', '9:20-10:00'),
(699, 14, 81, 'Math', 'Ali Haider', '9:20-10:00'),
(700, 14, 82, 'Math', 'Ali Haider', '9:20-10:00'),
(701, 14, 83, 'Math', 'Ali Haider', '9:20-10:00'),
(702, 14, 84, 'Math', 'Ali Haider', '9:20-10:00'),
(703, 14, 79, 'Pak-Study', 'Nehal Butt', '10:00-11:40'),
(704, 14, 80, 'Pak-Study', 'Nehal Butt', '10:00-11:40'),
(705, 14, 81, 'Pak-Study', 'Nehal Butt', '10:00-11:40'),
(706, 14, 82, 'Pak-Study', 'Nehal Butt', '10:00-11:40'),
(707, 14, 83, 'Pak-Study', 'Nehal Butt', '10:00-11:40'),
(708, 14, 84, 'Pak-Study', 'Nehal Butt', '10:00-11:40'),
(709, 14, 79, 'computer', 'Zaman Jutt', '10:40-11:20'),
(710, 14, 80, 'computer', 'Zaman Jutt', '10:40-11:20'),
(711, 14, 81, 'computer', 'Zaman Jutt', '10:40-11:20'),
(712, 14, 82, 'computer', 'Zaman Jutt', '10:40-11:20'),
(713, 14, 83, 'computer', 'Zaman Jutt', '10:40-11:20'),
(714, 14, 84, 'computer', 'Zaman Jutt', '10:40-11:20'),
(715, 14, 79, 'break', '!', '11:20-11:50'),
(716, 14, 80, 'break', '!', '11:20-11:50'),
(717, 14, 81, 'break', '!', '11:20-11:50'),
(718, 14, 82, 'break', '!', '11:20-11:50'),
(719, 14, 83, '!', '!', '11:20-11:50'),
(720, 14, 84, 'break', '!', '11:20-11:50'),
(721, 14, 79, 'Islamiat', 'Aiza Mirza', '11:50-12:30'),
(722, 14, 80, 'Islamiat', 'Aiza Mirza', '11:50-12:30'),
(723, 14, 81, 'Islamiat', 'Aiza Mirza', '11:50-12:30'),
(724, 14, 82, 'Islamiat', 'Aiza Mirza', '11:50-12:30'),
(725, 14, 83, '!', '!', '11:50-12:30'),
(726, 14, 84, 'Islamiat', 'Aiza Mirza', '11:50-12:30'),
(727, 14, 79, 'Science', 'Arham Arshad', '12:30-1:15'),
(728, 14, 80, 'Science', 'Arham Arshad', '12:30-1:15'),
(729, 14, 81, 'science', 'Arham Arshad', '12:30-1:15'),
(730, 14, 82, 'Science', 'Arham Arshad', '12:30-1:15'),
(731, 14, 83, '!', '!', '12:30-1:15'),
(732, 14, 84, 'Science', 'Arham Arshad', '12:30-1:15'),
(733, 15, 85, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(734, 15, 86, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(735, 15, 87, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(736, 15, 88, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(737, 15, 89, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(738, 15, 90, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(739, 15, 85, 'Urdu', 'Zaman Jutt', '8:40-9:20'),
(740, 15, 86, 'Urdu', 'Zaman Jutt', '8:40-9:20'),
(741, 15, 87, 'Urdu', 'Zaman Jutt', '8:40-9:20'),
(742, 15, 88, 'Urdu', 'Zaman Jutt', '8:40-9:20'),
(743, 15, 89, 'Urdu', 'Zaman Jutt', '8:40-9:20'),
(744, 15, 90, 'Urdu', 'Zaman Jutt', '8:40-9:20'),
(745, 15, 85, 'Math', 'Tahreem ', '9:20-10:00'),
(746, 15, 86, 'Math', 'Tahreem ', '9:20-10:00'),
(747, 15, 87, 'Math', 'Tahreem ', '9:20-10:00'),
(748, 15, 88, 'Math', 'Tahreem ', '9:20-10:00'),
(749, 15, 89, 'Math', 'Tahreem ', '9:20-10:00'),
(750, 15, 90, 'Math', 'Tahreem ', '9:20-10:00'),
(751, 15, 85, 'Pak-Study', 'Waleed Mughal', '10:00-11:40'),
(752, 15, 86, 'Pak-Study', 'Waleed Mughal', '10:00-11:40'),
(753, 15, 87, 'Pak-Study', 'Waleed Mughal', '10:00-11:40'),
(754, 15, 88, 'Pak-Study', 'Waleed Mughal', '10:00-11:40'),
(755, 15, 89, 'Pak-Study', 'Waleed Mughal', '10:00-11:40'),
(756, 15, 90, 'Pak-Study', 'Waleed Mughal', '10:00-11:40'),
(757, 15, 85, 'computer', 'Aiza Mirza', '10:40-11:20'),
(758, 15, 86, 'computer', 'Aiza Mirza', '10:40-11:20'),
(759, 15, 87, 'computer', 'Aiza Mirza', '10:40-11:20'),
(760, 15, 88, 'computer', 'Aiza Mirza', '10:40-11:20'),
(761, 15, 89, 'computer', 'Aiza Mirza', '10:40-11:20'),
(762, 15, 90, 'computer', 'Aiza Mirza', '10:40-11:20'),
(763, 15, 85, 'break', '!', '11:20-11:50'),
(764, 15, 86, 'break', '!', '11:20-11:50'),
(765, 15, 87, 'break', '!', '11:20-11:50'),
(766, 15, 88, 'break', '!', '11:20-11:50'),
(767, 15, 89, '!', '!', '11:20-11:50'),
(768, 15, 90, 'break', '!', '11:20-11:50'),
(769, 15, 85, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(770, 15, 86, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(771, 15, 87, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(772, 15, 88, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(773, 15, 89, '!', '!', '11:50-12:30'),
(774, 15, 90, 'Islamiat', 'Hamid Rajpoot', '11:50-12:30'),
(775, 15, 85, 'Science', 'Sir Tanveer', '12:30-1:15'),
(776, 15, 86, 'Science', 'Sir Tanveer', '12:30-1:15'),
(777, 15, 87, 'science', 'Sir Tanveer', '12:30-1:15'),
(778, 15, 88, 'Science', 'Sir Tanveer', '12:30-1:15'),
(779, 15, 89, '!', '!', '12:30-1:15'),
(780, 15, 90, 'Science', 'Sir Tanveer', '12:30-1:15'),
(781, 16, 91, 'Engilsh', 'Sufyan Cheema', '8:00-8:40'),
(782, 16, 92, 'Engilsh', 'Sufyan Cheema', '8:00-8:40'),
(783, 16, 93, 'Engilsh', 'Sufyan Cheema', '8:00-8:40'),
(784, 16, 94, 'Engilsh', 'Sufyan Cheema', '8:00-8:40'),
(785, 16, 95, 'Engilsh', 'Sufyan Cheema', '8:00-8:40'),
(786, 16, 96, 'Engilsh', 'Sufyan Cheema', '8:00-8:40'),
(787, 16, 91, 'Urdu', 'Ali Haider', '8:40-9:20'),
(788, 16, 92, 'Urdu', 'Ali Haider', '8:40-9:20'),
(789, 16, 93, 'Urdu', 'Ali Haider', '8:40-9:20'),
(790, 16, 94, 'Urdu', 'Ali Haider', '8:40-9:20'),
(791, 16, 95, 'Urdu', 'Ali Haider', '8:40-9:20'),
(792, 16, 96, 'Urdu', 'Ali Haider', '8:40-9:20'),
(793, 16, 91, 'Math', 'Nehal Butt', '9:20-10:00'),
(794, 16, 92, 'Math', 'Nehal Butt', '9:20-10:00'),
(795, 16, 93, 'Math', 'Nehal Butt', '9:20-10:00'),
(796, 16, 94, 'Math', 'Nehal Butt', '9:20-10:00'),
(797, 16, 95, 'Math', 'Nehal Butt', '9:20-10:00'),
(798, 16, 96, 'Math', 'Nehal Butt', '9:20-10:00'),
(799, 16, 91, 'Pak-Study', 'Zaman Jutt', '10:00-11:40'),
(800, 16, 92, 'Pak-Study', 'Zaman Jutt', '10:00-11:40'),
(801, 16, 93, 'Pak-Study', 'Zaman Jutt', '10:00-11:40'),
(802, 16, 94, 'Pak-Study', 'Zaman Jutt', '10:00-11:40'),
(803, 16, 95, 'Pak-Study', 'Zaman Jutt', '10:00-11:40'),
(804, 16, 96, 'Pak-Study', 'Zaman Jutt', '10:00-11:40'),
(805, 16, 91, 'computer', 'Sir Imran', '10:40-11:20'),
(806, 16, 92, 'computer', 'Sir Imran', '10:40-11:20'),
(807, 16, 93, 'computer', 'Sir Imran', '10:40-11:20'),
(808, 16, 94, 'computer', 'Sir Imran', '10:40-11:20'),
(809, 16, 95, 'computer', 'Sir Imran', '10:40-11:20'),
(810, 16, 96, 'computer', 'Sir Imran', '10:40-11:20'),
(811, 16, 91, 'break', '!', '11:20-11:50'),
(812, 16, 92, 'break', '!', '11:20-11:50'),
(813, 16, 93, 'break', '!', '11:20-11:50'),
(814, 16, 94, 'break', '!', '11:20-11:50'),
(815, 16, 95, '!', '!', '11:20-11:50'),
(816, 16, 96, 'break', '!', '11:20-11:50'),
(817, 16, 91, 'Islamiat', 'Maryam', '11:50-12:30'),
(818, 16, 92, 'Islamiat', 'Maryam', '11:50-12:30'),
(819, 16, 93, 'Islamiat', 'Maryam', '11:50-12:30'),
(820, 16, 94, 'Islamiat', 'Maryam', '11:50-12:30'),
(821, 16, 95, 'Islamiat', 'Maryam', '11:50-12:30'),
(822, 16, 96, 'Islamiat', 'Maryam', '11:50-12:30'),
(823, 16, 91, 'Science', 'Sir Qaiser', '12:30-1:15'),
(824, 16, 92, 'Science', 'Sir Qaiser', '12:30-1:15'),
(825, 16, 93, 'science', 'Sir Qaiser', '12:30-1:15'),
(826, 16, 94, 'Science', 'Sir Qaiser', '12:30-1:15'),
(827, 16, 95, '!', '!', '12:30-1:15'),
(828, 16, 96, 'Science', 'Sir Qaiser', '12:30-1:15'),
(829, 17, 97, 'Engilsh', 'Arham Arshad', '8:00-8:40'),
(830, 17, 98, 'Engilsh', 'Arham Arshad', '8:00-8:40'),
(831, 17, 99, 'Engilsh', 'Arham Arshad', '8:00-8:40'),
(832, 17, 100, 'Engilsh', 'Arham Arshad', '8:00-8:40'),
(833, 17, 101, 'Engilsh', 'Arham Arshad', '8:00-8:40'),
(834, 17, 102, 'Engilsh', 'Arham Arshad', '8:00-8:40'),
(835, 17, 97, 'Urdu', 'Maryam', '8:40-9:20'),
(836, 17, 98, 'Urdu', 'Maryam', '8:40-9:20'),
(837, 17, 99, 'Urdu', 'Maryam', '8:40-9:20'),
(838, 17, 100, 'Urdu', 'Maryam', '8:40-9:20'),
(839, 17, 101, 'Urdu', 'Maryam', '8:40-9:20'),
(840, 17, 102, 'Urdu', 'Maryam', '8:40-9:20'),
(841, 17, 97, 'Math', 'Rana Uzair ', '9:20-10:00'),
(842, 17, 98, 'Math', 'Rana Uzair ', '9:20-10:00'),
(843, 17, 99, 'Math', 'Rana Uzair ', '9:20-10:00'),
(844, 17, 100, 'Math', 'Rana Uzair ', '9:20-10:00'),
(845, 17, 101, 'Math', 'Rana Uzair ', '9:20-10:00'),
(846, 17, 102, 'Math', 'Rana Uzair ', '9:20-10:00'),
(847, 17, 97, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(848, 17, 98, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(849, 17, 99, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(850, 17, 100, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(851, 17, 101, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(852, 17, 102, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(853, 17, 97, 'computer', 'Hamza ', '10:40-11:20'),
(854, 17, 98, 'computer', 'Hamza ', '10:40-11:20'),
(855, 17, 99, 'computer', 'Hamza ', '10:40-11:20'),
(856, 17, 100, 'computer', 'Hamza ', '10:40-11:20'),
(857, 17, 101, 'computer', 'Hamza ', '10:40-11:20'),
(858, 17, 102, 'computer', 'Hamza ', '10:40-11:20'),
(859, 17, 97, 'break', '!', '11:20-11:50'),
(860, 17, 98, 'break', '!', '11:20-11:50'),
(861, 17, 99, 'break', '!', '11:20-11:50'),
(862, 17, 100, 'break', '!', '11:20-11:50'),
(863, 17, 101, '!', '!', '11:20-11:50'),
(864, 17, 102, 'break', '!', '11:20-11:50'),
(865, 17, 97, 'Islamiat', '!', '11:50-12:30'),
(866, 17, 98, 'Islamiat', 'Tahreem ', '11:50-12:30'),
(867, 17, 99, 'Islamiat', 'Tahreem ', '11:50-12:30'),
(868, 17, 100, 'Islamiat', 'Tahreem ', '11:50-12:30'),
(869, 17, 101, '!', 'Tahreem ', '11:50-12:30'),
(870, 17, 102, 'Islamiat', 'Tahreem ', '11:50-12:30'),
(871, 17, 97, 'Science', 'Zaman Jutt', '12:30-1:15'),
(872, 17, 98, 'Science', 'Zaman Jutt', '12:30-1:15'),
(873, 17, 99, 'science', 'Zaman Jutt', '12:30-1:15'),
(874, 17, 100, 'Science', 'Zaman Jutt', '12:30-1:15'),
(875, 17, 101, '!', '!', '12:30-1:15'),
(876, 17, 102, 'Science', 'Zaman Jutt', '12:30-1:15'),
(877, 18, 103, 'Engilsh', 'Ali Haider', '8:00-8:40'),
(878, 18, 104, 'Engilsh', 'Ali Haider', '8:00-8:40'),
(879, 18, 105, 'Engilsh', 'Ali Haider', '8:00-8:40'),
(880, 18, 106, 'Engilsh', 'Ali Haider', '8:00-8:40'),
(881, 18, 107, 'Engilsh', 'Ali Haider', '8:00-8:40'),
(882, 18, 108, 'Engilsh', 'Ali Haider', '8:00-8:40'),
(883, 18, 103, 'Urdu', 'Nehal Butt', '8:40-9:20'),
(884, 18, 104, 'Urdu', 'Nehal Butt', '8:40-9:20'),
(885, 18, 105, 'Urdu', 'Nehal Butt', '8:40-9:20'),
(886, 18, 106, 'Urdu', 'Nehal Butt', '8:40-9:20'),
(887, 18, 107, 'Urdu', 'Nehal Butt', '8:40-9:20'),
(888, 18, 108, 'Urdu', 'Nehal Butt', '8:40-9:20'),
(889, 18, 103, 'Math', 'Rana Uzair ', '9:20-10:00'),
(890, 18, 104, 'Math', 'Rana Uzair ', '9:20-10:00'),
(891, 18, 105, 'Math', 'Rana Uzair ', '9:20-10:00'),
(892, 18, 106, 'Math', 'Rana Uzair ', '9:20-10:00'),
(893, 18, 107, 'Math', 'Rana Uzair ', '9:20-10:00'),
(894, 18, 108, 'Math', 'Rana Uzair ', '9:20-10:00'),
(895, 18, 103, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(896, 18, 104, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(897, 18, 105, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(898, 18, 106, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(899, 18, 107, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(900, 18, 108, 'Pak-Study', 'Hamid Rajpoot', '10:00-11:40'),
(901, 18, 103, 'computer', 'Rana Adil ', '10:40-11:20'),
(902, 18, 104, 'computer', 'Rana Adil ', '10:40-11:20'),
(903, 18, 105, 'computer', 'Rana Adil ', '10:40-11:20'),
(904, 18, 106, 'computer', 'Rana Adil ', '10:40-11:20'),
(905, 18, 107, 'computer', 'Rana Adil ', '10:40-11:20'),
(906, 18, 108, 'computer', 'Rana Adil ', '10:40-11:20'),
(907, 18, 103, 'break', '!', '11:20-11:50'),
(908, 18, 104, 'break', '!', '11:20-11:50'),
(909, 18, 105, 'break', '!', '11:20-11:50'),
(910, 18, 106, 'break', '!', '11:20-11:50'),
(911, 18, 107, '!', '!', '11:20-11:50'),
(912, 18, 108, 'break', '!', '11:20-11:50'),
(913, 18, 103, 'Islamiat', 'Tahreem ', '11:50-12:30'),
(914, 18, 104, 'Islamiat', 'Tahreem ', '11:50-12:30'),
(915, 18, 105, 'Islamiat', 'Tahreem ', '11:50-12:30'),
(916, 18, 106, 'Islamiat', 'Tahreem ', '11:50-12:30'),
(917, 18, 107, '!', '!', '11:50-12:30'),
(918, 18, 108, 'Islamiat', 'Tahreem ', '11:50-12:30'),
(919, 18, 103, 'Science', 'Sir Imran', '12:30-1:15'),
(920, 18, 104, 'Science', 'Sir Imran', '12:30-1:15'),
(921, 18, 105, 'science', 'Sir Imran', '12:30-1:15'),
(922, 18, 106, 'Science', 'Sir Imran', '12:30-1:15'),
(923, 18, 107, '!', '!', '12:30-1:15'),
(924, 18, 108, 'Science', 'Sir Imran', '12:30-1:15'),
(925, 19, 109, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(926, 19, 110, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(927, 19, 111, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(928, 19, 112, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(929, 19, 113, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(930, 19, 114, 'Engilsh', 'Sir Imran', '8:00-8:40'),
(931, 19, 109, 'Urdu', 'Zaman Jutt', '8:40-9:20'),
(932, 19, 110, 'Urdu', 'Zaman Jutt', '8:40-9:20'),
(933, 19, 111, 'Urdu', 'Zaman Jutt', '8:40-9:20'),
(934, 19, 112, 'Urdu', 'Zaman Jutt', '8:40-9:20'),
(935, 19, 113, 'Urdu', 'Zaman Jutt', '8:40-9:20'),
(936, 19, 114, 'Urdu', 'Zaman Jutt', '8:40-9:20'),
(937, 19, 109, 'Math', 'Miss Ayesha', '9:20-10:00'),
(938, 19, 110, 'Math', 'Miss Ayesha', '9:20-10:00'),
(939, 19, 111, 'Math', 'Miss Ayesha', '9:20-10:00'),
(940, 19, 112, 'Math', 'Miss Ayesha', '9:20-10:00'),
(941, 19, 113, 'Math', 'Miss Ayesha', '9:20-10:00'),
(942, 19, 114, 'Math', 'Miss Ayesha', '9:20-10:00'),
(943, 19, 109, 'Pak-Study', 'Arham Arshad', '10:00-11:40'),
(944, 19, 110, 'Pak-Study', 'Arham Arshad', '10:00-11:40'),
(945, 19, 111, 'Pak-Study', 'Arham Arshad', '10:00-11:40'),
(946, 19, 112, 'Pak-Study', 'Arham Arshad', '10:00-11:40'),
(947, 19, 113, 'Pak-Study', 'Arham Arshad', '10:00-11:40'),
(948, 19, 114, 'Pak-Study', 'Arham Arshad', '10:00-11:40'),
(949, 19, 109, 'computer', 'Maryam', '10:40-11:20'),
(950, 19, 110, 'computer', 'Maryam', '10:40-11:20'),
(951, 19, 111, 'computer', 'Maryam', '10:40-11:20'),
(952, 19, 112, 'computer', 'Maryam', '10:40-11:20'),
(953, 19, 113, 'computer', 'Maryam', '10:40-11:20'),
(954, 19, 114, 'computer', 'Maryam', '10:40-11:20'),
(955, 19, 109, 'break', '!', '11:20-11:50'),
(956, 19, 110, 'break', '!', '11:20-11:50'),
(957, 19, 111, 'break', '!', '11:20-11:50'),
(958, 19, 112, 'break', '!', '11:20-11:50'),
(959, 19, 113, '!', '!', '11:20-11:50'),
(960, 19, 114, 'break', '!', '11:20-11:50'),
(961, 19, 109, 'Islamiat', 'Aiza Mirza', '11:50-12:30'),
(962, 19, 110, 'Islamiat', 'Aiza Mirza', '11:50-12:30'),
(963, 19, 111, 'Islamiat', 'Aiza Mirza', '11:50-12:30'),
(964, 19, 112, 'Islamiat', 'Aiza Mirza', '11:50-12:30'),
(965, 19, 113, '!', '!', '11:50-12:30'),
(966, 19, 114, 'Islamiat', 'Aiza Mirza', '11:50-12:30'),
(967, 19, 109, 'Science', 'Maria Mehar', '12:30-1:15'),
(968, 19, 110, 'Science', 'Maria Mehar', '12:30-1:15'),
(969, 19, 111, 'science', 'Maria Mehar', '12:30-1:15'),
(970, 19, 112, 'Science', 'Maria Mehar', '12:30-1:15'),
(971, 19, 113, '!', '!', '12:30-1:15'),
(972, 19, 114, 'Science', 'Maria Mehar', '12:30-1:15'),
(973, 20, 115, 'Engilsh', 'Zaman Jutt', '8:00-8:40'),
(974, 20, 116, 'Engilsh', 'Zaman Jutt', '8:00-8:40'),
(975, 20, 117, 'Engilsh', 'Zaman Jutt', '8:00-8:40'),
(976, 20, 118, 'Engilsh', 'Zaman Jutt', '8:00-8:40'),
(977, 20, 119, 'Engilsh', 'Zaman Jutt', '8:00-8:40'),
(978, 20, 120, 'Engilsh', 'Zaman Jutt', '8:00-8:40'),
(979, 20, 115, 'Urdu', 'Waleed Mughal', '8:40-9:20'),
(980, 20, 116, 'Urdu', 'Waleed Mughal', '8:40-9:20'),
(981, 20, 117, 'Urdu', 'Waleed Mughal', '8:40-9:20'),
(982, 20, 118, 'Urdu', 'Waleed Mughal', '8:40-9:20'),
(983, 20, 119, 'Urdu', 'Waleed Mughal', '8:40-9:20'),
(984, 20, 120, 'Urdu', 'Waleed Mughal', '8:40-9:20'),
(985, 20, 115, 'Math', 'Nehal Butt', '9:20-10:00'),
(986, 20, 116, 'Math', 'Nehal Butt', '9:20-10:00'),
(987, 20, 117, 'Math', 'Nehal Butt', '9:20-10:00'),
(988, 20, 118, 'Math', 'Nehal Butt', '9:20-10:00'),
(989, 20, 119, 'Math', 'Nehal Butt', '9:20-10:00'),
(990, 20, 120, 'Math', 'Nehal Butt', '9:20-10:00'),
(991, 20, 115, 'Pak-Study', 'Maryam', '10:00-11:40'),
(992, 20, 116, 'Pak-Study', 'Maryam', '10:00-11:40'),
(993, 20, 117, 'Pak-Study', 'Maryam', '10:00-11:40'),
(994, 20, 118, 'Pak-Study', 'Maryam', '10:00-11:40'),
(995, 20, 119, 'Pak-Study', 'Maryam', '10:00-11:40'),
(996, 20, 120, 'Pak-Study', 'Maryam', '10:00-11:40'),
(997, 20, 115, 'computer', 'Aiza Mirza', '10:40-11:20'),
(998, 20, 116, 'computer', 'Aiza Mirza', '10:40-11:20'),
(999, 20, 117, 'computer', 'Aiza Mirza', '10:40-11:20'),
(1000, 20, 118, 'computer', 'Aiza Mirza', '10:40-11:20'),
(1001, 20, 119, 'computer', 'Aiza Mirza', '10:40-11:20'),
(1002, 20, 120, 'computer', 'Aiza Mirza', '10:40-11:20'),
(1003, 20, 115, 'break', '!', '11:20-11:50'),
(1004, 20, 116, 'break', '!', '11:20-11:50'),
(1005, 20, 117, 'break', '!', '11:20-11:50'),
(1006, 20, 118, 'break', '!', '11:20-11:50'),
(1007, 20, 119, '!', '!', '11:20-11:50'),
(1008, 20, 120, 'break', '!', '11:20-11:50'),
(1009, 20, 115, 'Islamiat', 'Musab Butt', '11:50-12:30'),
(1010, 20, 116, 'Islamiat', 'Musab Butt', '11:50-12:30'),
(1011, 20, 117, 'Islamiat', 'Musab Butt', '11:50-12:30'),
(1012, 20, 118, 'Islamiat', 'Musab Butt', '11:50-12:30'),
(1013, 20, 119, '!', '!', '11:50-12:30'),
(1014, 20, 120, 'Islamiat', 'Musab Butt', '11:50-12:30'),
(1015, 20, 115, 'Science', 'Sir Imran', '12:30-1:15'),
(1016, 20, 116, 'Science', 'Sir Imran', '12:30-1:15'),
(1017, 20, 117, 'science', 'Sir Imran', '12:30-1:15'),
(1018, 20, 118, 'Science', 'Sir Imran', '12:30-1:15'),
(1019, 20, 119, '!', '!', '12:30-1:15'),
(1020, 20, 120, 'Science', 'Sir Imran', '12:30-1:15');

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
(3, 3, 1, 1, 1),
(4, 4, 1, 1, 1),
(5, 5, 1, 1, 1),
(6, 6, 1, 1, 1),
(7, 7, 1, 1, 1),
(8, 8, 1, 1, 1),
(9, 9, 1, 1, 1),
(10, 10, 1, 1, 1),
(11, 11, 1, 2, 1),
(12, 12, 1, 2, 1),
(13, 13, 1, 2, 1),
(14, 14, 1, 2, 1),
(15, 15, 1, 2, 1),
(16, 16, 1, 2, 1),
(17, 17, 1, 2, 1),
(18, 18, 1, 2, 1),
(19, 19, 1, 2, 1),
(20, 20, 1, 2, 1),
(21, 21, 2, 3, 1),
(22, 22, 2, 3, 1),
(23, 23, 2, 3, 1),
(24, 24, 2, 3, 1),
(25, 25, 2, 3, 1),
(26, 26, 2, 3, 1),
(27, 27, 2, 3, 1),
(28, 28, 2, 3, 1),
(29, 29, 2, 3, 1),
(30, 30, 2, 3, 1),
(31, 31, 2, 4, 1),
(32, 32, 2, 4, 1),
(33, 33, 2, 4, 1),
(34, 34, 2, 3, 1),
(35, 35, 2, 4, 1),
(36, 36, 2, 4, 1),
(37, 37, 2, 4, 1),
(38, 38, 2, 4, 1),
(39, 39, 2, 4, 1),
(40, 40, 2, 4, 1),
(41, 41, 3, 5, 1),
(42, 42, 3, 5, 1),
(43, 43, 3, 5, 1),
(44, 44, 3, 5, 1),
(45, 45, 3, 5, 1),
(46, 46, 3, 5, 1),
(47, 47, 3, 5, 1),
(48, 48, 3, 5, 1),
(49, 49, 3, 5, 1),
(50, 50, 3, 5, 1),
(51, 51, 3, 6, 1),
(52, 52, 3, 6, 1),
(53, 53, 3, 6, 1),
(54, 54, 3, 6, 1),
(55, 55, 3, 6, 1),
(56, 56, 3, 6, 1),
(57, 57, 3, 6, 1),
(58, 58, 3, 6, 1),
(59, 59, 3, 6, 1),
(60, 60, 3, 6, 1),
(61, 61, 4, 7, 1),
(62, 62, 4, 7, 1),
(63, 63, 4, 7, 1),
(64, 64, 4, 7, 1),
(65, 65, 4, 7, 1),
(66, 66, 4, 7, 1),
(67, 67, 4, 7, 1),
(68, 68, 4, 7, 1),
(69, 69, 4, 7, 1),
(70, 70, 4, 7, 1),
(71, 71, 4, 8, 1),
(72, 72, 4, 8, 1),
(73, 73, 4, 8, 1),
(74, 74, 4, 8, 1),
(75, 75, 4, 8, 1),
(76, 76, 4, 8, 1),
(77, 77, 4, 8, 1),
(78, 78, 4, 8, 1),
(79, 79, 4, 8, 1),
(80, 80, 4, 8, 1),
(81, 81, 5, 9, 1),
(82, 82, 5, 9, 1),
(83, 83, 5, 9, 1),
(84, 84, 5, 9, 1),
(85, 85, 5, 9, 1),
(86, 86, 5, 9, 1),
(87, 87, 5, 9, 1),
(88, 88, 5, 9, 1),
(89, 89, 5, 9, 1),
(90, 90, 5, 9, 1),
(91, 91, 5, 10, 1),
(92, 92, 5, 10, 1),
(93, 93, 5, 10, 1),
(94, 94, 5, 10, 1),
(95, 95, 5, 10, 1),
(96, 96, 5, 10, 1),
(97, 97, 5, 10, 1),
(98, 98, 5, 10, 1),
(99, 99, 5, 10, 1),
(100, 100, 5, 10, 1),
(101, 101, 6, 11, 1),
(102, 102, 6, 11, 1),
(103, 103, 6, 11, 1),
(104, 104, 6, 11, 1),
(105, 105, 6, 11, 1),
(106, 106, 6, 11, 1),
(107, 107, 6, 11, 1),
(108, 108, 6, 11, 1),
(109, 109, 6, 11, 1),
(110, 110, 6, 11, 1),
(111, 111, 6, 12, 1),
(112, 112, 6, 12, 1),
(113, 113, 6, 12, 1),
(114, 114, 6, 12, 1),
(115, 115, 6, 12, 1),
(116, 116, 6, 12, 1),
(117, 117, 6, 12, 1),
(118, 118, 6, 12, 1),
(119, 119, 6, 12, 1),
(120, 120, 7, 13, 1),
(121, 121, 7, 13, 1),
(122, 122, 7, 13, 1),
(123, 123, 7, 13, 1),
(124, 124, 7, 13, 1),
(125, 125, 7, 13, 1),
(126, 126, 7, 13, 1),
(127, 127, 7, 13, 1),
(128, 128, 7, 13, 1),
(129, 129, 7, 13, 1),
(130, 130, 7, 14, 1),
(131, 131, 7, 14, 1),
(132, 132, 7, 14, 1),
(133, 133, 7, 14, 1),
(134, 134, 7, 14, 1),
(135, 135, 7, 14, 1),
(136, 136, 7, 14, 1),
(137, 137, 7, 14, 1),
(138, 138, 7, 14, 1),
(139, 139, 7, 14, 1),
(140, 140, 8, 15, 1),
(141, 141, 8, 15, 1),
(142, 142, 8, 15, 1),
(143, 143, 8, 15, 1),
(144, 144, 8, 15, 1),
(145, 145, 8, 15, 1),
(146, 146, 8, 15, 1),
(147, 147, 8, 15, 1),
(148, 148, 8, 15, 1),
(149, 149, 8, 15, 1),
(150, 150, 8, 15, 1),
(151, 151, 8, 16, 1),
(152, 152, 8, 16, 1),
(153, 153, 8, 16, 1),
(154, 154, 8, 16, 1),
(155, 155, 8, 16, 1),
(156, 156, 8, 16, 1),
(157, 157, 8, 16, 1),
(158, 158, 8, 16, 1),
(159, 159, 8, 16, 1),
(160, 160, 8, 16, 1),
(161, 161, 9, 17, 1),
(162, 162, 9, 17, 1),
(163, 163, 9, 17, 1),
(164, 164, 9, 17, 1),
(165, 165, 9, 17, 1),
(166, 166, 9, 17, 1),
(167, 167, 9, 17, 1),
(168, 168, 9, 17, 1),
(169, 169, 9, 17, 1),
(170, 170, 9, 17, 1),
(171, 171, 9, 18, 1),
(172, 172, 9, 18, 1),
(173, 173, 9, 18, 1),
(174, 174, 9, 18, 1),
(175, 175, 9, 18, 1),
(176, 176, 9, 18, 1),
(177, 177, 9, 18, 1),
(178, 178, 9, 18, 1),
(179, 179, 9, 18, 1),
(180, 180, 9, 18, 1),
(181, 181, 10, 19, 1),
(182, 182, 10, 19, 1),
(183, 183, 10, 19, 1),
(184, 184, 10, 19, 1),
(185, 185, 10, 19, 1),
(186, 186, 10, 19, 1),
(187, 187, 10, 19, 1),
(188, 188, 10, 19, 1),
(189, 189, 10, 19, 1),
(190, 190, 10, 19, 1),
(191, 191, 10, 20, 1),
(192, 192, 10, 20, 1),
(193, 193, 10, 20, 1),
(194, 194, 10, 20, 1),
(195, 195, 10, 20, 1),
(196, 196, 10, 20, 1),
(197, 197, 10, 20, 1),
(198, 198, 10, 20, 1),
(199, 199, 10, 20, 1),
(200, 200, 10, 20, 1),
(201, 201, 1, 1, 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `student_profile`
--

CREATE TABLE `student_profile` (
  `student_id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cnic` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `father_cnic` varchar(50) NOT NULL,
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

INSERT INTO `student_profile` (`student_id`, `name`, `cnic`, `dob`, `father_name`, `father_cnic`, `address`, `mobile_no`, `roll_no`, `image`, `email`, `fee_amount`, `password`, `student_status`) VALUES
(1, 'Haroon Arshad', '34101567859367', '2015-03-11', 'Arshad Butt', '34101456789346', 'Gujranwala', '03126478245', '1', 'buttharoon@gmail.com1images (2).jfif', 'buttharoon@gmail.com', '1000', '12345', 1),
(2, 'Sufyan Safdar', '34101678964537', '2015-08-06', ' Muhammad Safdar ', '34101675434685', 'Gujranwala', '03246783467', '2', 'sufyan12@gmail.com2images (1).jfif', 'sufyan12@gmail.com', '1000', '12345', 1),
(3, 'Hamid Tariq', '34101745983872', '2015-12-04', 'Tariq Arif', '34101765342789', 'Gujranwala', '03246745638', '3', 'hamidtariq@gmail.com3images (10).jfif', 'hamidtariq@gmail.com', '1000', '12345', 1),
(4, 'Faheem Fayyaz', '34101567435678', '2015-09-14', 'Fayyaz sheikh', '34101876745362', 'gujranwala', '03246783474', '4', 'faheem1@gmail.com4images (26).jfif', 'faheem1@gmail.com', '1000', '12345', 1),
(5, 'Uzair butt', '3410167589875', '2015-03-12', 'Saleem Butt', '341017874563', 'gujranwala', '03246783478', '5', 'uzair12@gmail.com5images (25).jfif', 'uzair12@gmail.com', '1000', '12345', 1),
(6, 'Meerab Asif', '3410156743579', '2015-08-31', 'Asif Mughal', '341017874563345', 'Gujranwala', '03425674893', '6', 'meerab342@gmail.com6images (5).jfif', 'meerab342@gmail.com', '1000', '12345', 1),
(7, 'Noor Amir', '3410167478393', '2015-03-14', 'Amir mughal', '3410178745634', 'gujranwala', '03246783435', '7', 'noor12@gmail.com7images (9).jfif', 'noor12@gmail.com', '1000', '12345', 1),
(8, 'Alina Ali', '3410156743535', '2015-07-23', 'M.Ali', '34101876745368', 'Gujranwala', '03214536578', '8', 'alina45@gmail.com8images (4).jfif', 'alina45@gmail.com', '1000', '12345', 1),
(9, 'Ayesha', '34101678964556', '2015-09-21', 'Mahmood jutt', '34101765342756', 'Gujranwala', '03425674913', '9', 'ayesha2@gmail.com9download (2).jfif', 'ayesha2@gmail.com', '1000', '12345', 1),
(10, 'Maria', '34101745983856', '2016-05-04', 'Saleem Butt', '3410167543446', 'Gujranwala', '03246783461', '10', 'maria2312@gmail.com10images (3).jfif', 'maria2312@gmail.com', '1000', '12345', 1),
(11, 'Areeba ', '34101678964456', '2015-05-23', 'Fayyaz sheikh', '34101876745364', 'Gujranwala', '03246783424', '11', 'areeba12@gmail.com11images (9).jfif', 'areeba12@gmail.com', '1000', '12345', 1),
(12, 'Qahafa Mughal', '34101567859346', '2014-05-23', 'M.Arif', '34101675434657', 'Gujranwala', '032456491209', '12', 'qahafa12@gmail.com12images (17).jfif', 'qahafa12@gmail.com', '1000', '12345', 1),
(13, 'Anas Asif', '34101567859356', '2016-06-12', 'Asif jutt', '34101765342785', 'Gujranwala', '03316783461', '13', 'anas12@gmail.com13images (13).jfif', 'anas12@gmail.com', '1000', '12345', 1),
(14, 'M.Ahmad', '34101567859324', '2014-04-23', 'Muneeb Butt', '34101765342453', 'Gujranwala', '03247436901', '15', 'ahmad@gmail.com15images (15).jfif', 'ahmad@gmail.com', '1000', '12345', 1),
(15, 'Abul Rahmen', '3410156743524', '2015-09-12', ' Muhammad Safdar ', '34101765344536', 'Gujranwala', '0324673429', '14', 'abdul12@gmail.com14images (17).jfif', 'abdul12@gmail.com', '1000', '12345', 1),
(16, 'Misba Jutt', '3410167589835', '2015-08-04', 'M.Ali', '34101876745334', 'gujranwala', '03218783461', '16', 'misba12@gmail.com16images (19).jfif', 'misba12@gmail.com', '1000', '12345', 1),
(17, 'Amer Hamza', '34101567435421', '2015-11-02', 'Javaid Iqbal', '34101765342410', 'Gujranwala', '03129483461', '17', 'hamza12@gmail.com17images (16).jfif', 'hamza12@gmail.com', '1000', '12345', 1),
(18, 'Kinza Mehar', '34101567859351', '2015-07-19', 'Tariq Arif', '3410178745634', 'Gujranwala', '03346781461', '18', 'kinza12@gmail.com18images.jfif', 'kinza12@gmail.com', '1000', '12345', 1),
(19, 'Maham Mughal', '341015674351', '2015-12-11', 'M.Amir', '3410167543461', 'Gujranwala', '03246783431', '19', 'maham12@gmail.com19images (21).jfif', 'maham12@gmail.com', '1000', '12345', 1),
(20, 'Ali Raza', '341015674356', '2015-07-27', 'M.Ahmad ', '34101787431', 'Gujranwala', '03016303461', '20', 'raza82@gmail.com20istockphoto-165162824-170667a.jpg', 'raza82@gmail.com', '1000', '12345', 1),
(21, 'Bilal Butt', '3410167589821', '2015-01-19', 'Arshad Butt', '34101876745362', 'Gujranwala', '03107383461', '21', 'bilal32@gmail.com21images (30).jfif', 'bilal32@gmail.com', '1000', '12345', 1),
(22, 'Bisma Khan', '341015674319', '2015-12-12', 'Rahim khan', '3410167543461', 'Gujranwala', '03319783461', '22', 'bisma12@gmail.com22images.jfif', 'bisma12@gmail.com', '1000', '12345', 1),
(23, 'Ali Hamza', '3410167589875', '2014-03-21', ' Muhammad Safdar ', '3410167543461', 'Gujranwala', '03013783461', '23', 'ali12@gmail.com23images (31).jfif', 'ali12@gmail.com', '1000', '12345', 1),
(24, 'Shahwaiz Jutt', '3410156785991', '2015-02-01', 'Arif Jutt', '3410167543431', 'Gujranwala', '03217383461', '24', 'shahwaiz12@gmail.com24images (12).jfif', 'shahwaiz12@gmail.com', '1000', '12345', 1),
(25, 'Alishba Mughal', '341016747839', '2015-01-19', 'Bilal mughal', '3410167543462', 'Gujranwala', '03096429403', '26', 'alishba12@gmail.com26images (8).jfif', 'alishba12@gmail.com', '1000', '12345', 1),
(26, 'Waleed ', '3410156743579', '2015-03-01', 'Saleem Butt', '3410167543461', 'Gujranwala', '03072480217', '25', 'waleed12@gmail.com25download (1).jfif', 'waleed12@gmail.com', '1000', '12345', 1),
(27, 'Arooj Khan ', '3410156785921', '2014-08-13', 'M.Ali', '3410178745639', 'Gujranwala', '03246483413', '27', 'arooj72@gmail.com27download (2).jfif', 'arooj72@gmail.com', '1000', '12345', 1),
(28, 'Babar ', '341015674357', '2014-12-17', 'Faisal cheema', '3410178745634', 'gujranwala', '031945199021', '28', 'babar12@gmail.com28images (11).jfif', 'babar12@gmail.com', '1000', '12345', 1),
(29, 'Teefa', '3410156743579', '2014-09-17', 'M.Bashir', '3410167543468', 'Gujranwala', '03032509261', '29', 'teefa12@gmail.com29images (22).jfif', 'teefa12@gmail.com', '1000', '12345', 1),
(30, 'Fahad', '34101567435678', '2014-08-18', 'Maqsood Ahmad', '3410178745634', 'Gujranwala', '03173183461', '30', 'fahad12@gmail.com30images (31).jfif', 'fahad12@gmail.com', '1000', '12345', 1),
(31, 'Eman shahzadi', '341016758951', '2013-07-18', 'Sajjad cheema', '341016754346', 'Gujranwala', '03417693461', '31', 'eman12@gmail.com31images (4).jfif', 'eman12@gmail.com', '1000', '12345', 1),
(32, 'Hamid Cheema', '3410167589875', '2015-12-08', 'Zulfiqar Cheema', '34101765342251', 'Gujranwala', '03273783461', '32', 'hamidch2@gmail.com32download.jfif', 'hamidch2@gmail.com', '1200', '12345', 1),
(33, 'Sheza Eman', '3410174598361', '2014-03-29', 'Sufyan Jutt', '3410187674536', 'Gujranwala', '03103783461', '33', 'sheza12@gmail.com33images.jfif', 'sheza12@gmail.com', '1200', '12345', 1),
(34, 'Ibrahim khan', '3410156785936', '2014-06-25', 'Ismail khan', '34101675434685', 'Gujranwala', '03486783461', '34', 'ibrahim12@gmail.com34images (2).jfif', 'ibrahim12@gmail.com', '1200', '12345', 1),
(35, 'Abdullah perwaz', '3410167478391', '2014-05-25', ' Muhammad Safdar ', '341017874563', 'Gujranwala', '03174783461', '35', 'abdullah12@gmail.com35images (24).jfif', 'abdullah12@gmail.com', '1200', '12345', 1),
(36, 'Simra baloch', '34101675821', '2014-10-01', 'M.Malik', '341017874563`1', 'Gujranwala', '03073483461', '36', 'simra12@gmail.com36images (21).jfif', 'simra12@gmail.com', '1200', '12345', 1),
(37, 'Minahil mehar', '341017435719', '2013-10-29', 'Raza Mehar', '3410178745637', 'Gujranwala', '03026783461', '37', 'minahil12@gmail.com37images (7).jfif', 'minahil12@gmail.com', '1200', '12345', 1),
(38, 'Ali Shahwaiz', '3410167582775', '2013-12-21', 'Arif Jatta', '3410167543468', 'Gujranwala', '03256783461', '38', 'ali912@gmail.com29images (29).jfif', 'ali912@gmail.com', '1200', '12345', 1),
(39, 'Usman Mughal', '3410156743531', '2013-09-04', 'Muneeb Mughal', '3410187674536', 'Gujranwala', '03316783461', '40', 'usman12@gmail.com40male-student-books-laptop-on-260nw-2445206805.webp', 'usman12@gmail.com', '1200', '12345', 1),
(40, 'Nimra Mehar', '34101675898831', '2013-12-19', 'Fayyaz Mehar', '341017874563', 'Gujranwala', '03431783461', '39', 'nirma12@gmail.com29images (3).jfif', 'nirma12@gmail.com', '1200', '12345', 1),
(41, 'Zinta rani', '3410174598387', '2013-09-13', 'Rana shabir', '3410167543468', 'Gujranwala', '03196783461', '41', 'zinta12@gmail.com41images (4).jfif', 'zinta12@gmail.com', '1200', '12345', 1),
(42, 'Muskan Zulfiqar', '3410156785936', '2013-04-28', 'Zulfiqar Cheema', '341017874563', 'Gujranwala', '03019783461', '42', 'muskan821@gmail.com42download (2).jfif', 'muskan821@gmail.com', '1200', '12345', 1),
(43, 'Rana Atif', '3410156743567', '2013-11-03', 'Rana Aslam', '3410167543468', 'Gujranwala', '03013023461', '43', 'atif12@gmail.com43images (17).jfif', 'atif12@gmail.com', '1200', '12345', 1),
(44, 'Ismail Khan', '3410156785933', '2013-12-27', 'Abdullah Khan', '341017874591', 'Gujranwala', '03270313461', '44', 'ismail12@gmail.com44images (26).jfif', 'ismail12@gmail.com', '1200', '12345', 1),
(45, 'Bushra', '3410156743579', '2013-08-18', 'm.usman', '341017874596', 'Gujranwala', '03226783461', '45', 'bushra12@gmail.com45images (23).jfif', 'bushra12@gmail.com', '1200', '12345', 1),
(46, 'Anaya Mughal', '3410156743567', '2013-05-13', 'Musa mughal', '3410167544281', 'Gujranwala', '03063763461', '46', 'anaya12@gmail.com46images (20).jfif', 'anaya12@gmail.com', '1200', '12345', 1),
(47, 'Asim Butt', '3410156743579', '2013-08-17', 'Farooq Butt', '3410167543812', 'Gujranwala', '03016783461', '47', 'asimbutt2@gmail.com47images (25).jfif', 'asimbutt2@gmail.com', '1200', '12345', 1),
(48, 'Zainab khan', '3410156785936', '2014-02-18', 'Tariq khan', '3410167543463', 'Gujranwala', '03246783402', '48', 'zaini12@gmail.com48download (2).jfif', 'zaini12@gmail.com', '1200', '12345', 1),
(49, 'usama', '34101567859361', '2012-11-12', 'M.Ali', '34101876745368', 'Gujranwala', '0342893461', '49', 'usamzalik12@gmail.com49images (2).jfif', 'usamzalik12@gmail.com', '1200', '12345', 1),
(50, 'Faheem Cheema', '3410156743567', '2013-04-11', 'ali cheema', '341017874563', 'gujranwala', '03246523461', '50', 'cheema12@gmail.com50images (31).jfif', 'cheema12@gmail.com', '1200', '12345', 1),
(51, 'Uzair Insari', '3410156743567', '2012-07-27', 'Ali insari', '341017874563', 'gujranwala', '03007783461', '51', 'uzair/2@gmail.com51images (30).jfif', 'uzair/2@gmail.com', '1200', '12345', 1),
(52, 'haroon jutt', '3410156743567', '2013-02-11', 'Ahmar', '3410167543461', 'Gujranwala', '03046783467', '52', 'haroonjutt2@gmail.com52download (1).jfif', 'haroonjutt2@gmail.com', '1200', '12345', 1),
(53, 'Abdullah cheema', '3410167589875', '2012-07-23', 'Tariq cheema', '3410167543461', 'Gujranwala', '03076483461', '54', 'abdullah12@gmail.com54images (14).jfif', 'abdullah12@gmail.com', '1200', '12345', 1),
(54, 'Rabiya omer', '34101567859367', '2012-08-28', 'omer sheikh', '341017874565', 'Gujranwala', '032467834321', '53', 'rzbia22@gmail.com53images (4).jfif', 'rzbia22@gmail.com', '1200', '12345', 1),
(55, 'aatif', '3410167589886', '2012-12-30', 'ali ahmad', '341017874543', 'gujranwala', '03246783461', '55', 'aatifmalik12@gmail.com55images (24).jfif', 'aatifmalik12@gmail.com', '1200', '12345', 1),
(56, 'Daniyal Saith', '3410156785931', '2012-05-12', 'muneeb saith', '3410187674530', 'gujranwala', '03396783461', '56', 'saith312@gmail.com56images (29).jfif', 'saith312@gmail.com', '1200', '12345', 1),
(57, 'sufyab mehar', '3410156743567', '2011-06-09', 'M.Ali', '341016754347', 'gujranwala', '03174783461', '57', 'sufyan12@gmail.com57images (24).jfif', 'sufyan12@gmail.com', '1200', '12345', 1),
(58, 'Hira rani', '341015674357', '2012-12-04', 'Rana Asim', '3410187674531', 'Gujranwala', '03430283461', '58', 'hira12@gmail.com58images (21).jfif', 'hira12@gmail.com', '1200', '12345', 1),
(59, 'Imran khan', '341015674351', '2013-11-12', 'hashim khan', '3410167543469', 'Gujranwala', '03346783461', '60', 'imran12@gmail.com60images (27).jfif', 'imran12@gmail.com', '1200', '12345', 1),
(60, 'nimra jutt', '3410156743561', '2012-10-18', 'Saleem jutt', '3410187674531', 'Gujranwala', '03246783911', '59', 'nimra12@gmail.com59download (2).jfif', 'nimra12@gmail.com', '1200', '12345', 1),
(61, 'saniya', '3410156743561', '2012-10-12', 'Arshad Butt', '3410167543412', 'gujranwala', '03219856261', '61', 'Saniyak12@gmail.com61images (5).jfif', 'Saniyak12@gmail.com', '1500', '12345', 1),
(62, 'aatif', '341015674358', '2012-05-04', 'Tariq Arif', '3410167543468', 'gujranwala', '03106783461', '62', 'aatik12@gmail.com62images (2).jfif', 'aatik12@gmail.com', '1500', '12345', 1),
(63, 'Ayesha khan', '341016758987', '2011-10-16', 'M.Ali', '34101876745369', 'gujranwala', '0324183461', '63', 'ayesha212@gmail.com63download (2).jfif', 'ayesha212@gmail.com', '1500', '12345', 1),
(64, 'Ibrar Ahmad', '341015674351', '2011-09-14', 'Ahmad insari', '34101675434683', 'Gujranwala', '03186783461', '64', 'ibrar12@gmail.com64download.jfif', 'ibrar12@gmail.com', '1500', '12345', 1),
(65, 'Atif jutt', '3410156743596', '2010-12-28', ' Muhammad Safdar ', '34101876745334', 'gujranwala', '03312783461', '65', 'atifjutt12@gmail.com65images (17).jfif', 'atifjutt12@gmail.com', '1500', '12345', 1),
(66, 'Mossan cheema', '3410156743451', '2011-10-12', 'M.Ali', '3410187674576', 'Gujranwala', '03123458210', '66', 'mossan12@gmail.com66images (26).jfif', 'mossan12@gmail.com', '1500', '12345', 1),
(67, 'Taniya', '3410156743561', '0000-00-00', 'Fayyaz cheema', '341016754354', 'gfujranwala', '03249123461', '67', 'taniya12@gmail.com67images.jfif', 'taniya12@gmail.com', '1500', '12345', 1),
(68, 'Arham Butt', '341015674356', '2010-04-14', 'Arshad Butt', '34101876745353', 'gujranwala', '03246796461', '68', 'arhambutt12@gmail.com68images (28).jfif', 'arhambutt12@gmail.com', '1500', '12345', 1),
(69, 'Misba Mughal', '341015678591', '2010-12-02', 'M.usman', '3410167543441', 'Gujranwala', '03416783461', '69', 'misba12@gmail.com69download (2).jfif', 'misba12@gmail.com', '1500', '12345', 1),
(70, 'Ibrahim mehar', '3410156743521', '2010-08-02', 'Asif mehar', '34101876745021', 'gujranwala', '03126783461', '70', 'ibrahim12@gmail.com70images (27).jfif', 'ibrahim12@gmail.com', '1500', '12345', 1),
(71, 'Ali hamza ', '3410156743542', '2010-10-03', 'hamza jutt', '34101876745361', 'gujranwala', '03046783461', '71', 'alihamza12@gmail.com71download (1).jfif', 'alihamza12@gmail.com', '1500', '12345', 1),
(72, 'Amir Mughal', '3410156743513', '2010-01-26', 'Aslam Mughal', '34101675434601', 'Gujranwala', '03219783461', '72', 'amir12@gmail.com72images (11).jfif', 'amir12@gmail.com', '1500', '12345', 1),
(73, 'Manan khan  ', '341015674323', '2010-09-19', 'perwaz khan', '3410167543441', 'gujranwala', '0303641461', '73', 'mana12@gmail.com73download.jfif', 'mana12@gmail.com', '1500', '12345', 1),
(74, 'Urwa khan', '3410167586721', '2010-05-24', 'syfyan khan ', '34101876749623', 'Gujranwala', '03316486329', '74', 'urwa12@gmail.com74images (7).jfif', 'urwa12@gmail.com', '1500', '12345', 1),
(75, 'Muneeb Ahmad', '3410167589892', '2010-07-10', 'M.Ahamd', '34101675434872', 'Gujranwala', '03329860421', '75', 'muneeb12@gmail.com75images (15).jfif', 'muneeb12@gmail.com', '1500', '12345', 1),
(76, 'maya khan', '3410167589893', '2010-06-09', 'areeb khan', '3410167543492', 'Gujranwala', '03046783466', '76', 'maya12@gmail.com76images (8).jfif', 'maya12@gmail.com', '1500', '12345', 1),
(77, 'Ibrar Ahmad', '3410156743552', '2010-04-19', 'Ahmad mehar', '34101675434562', 'Gujranwala', '03385634261', '77', 'ibrar2@gmail.com77images (29).jfif', 'ibrar2@gmail.com', '1500', '12345', 1),
(78, 'Raza Mughal', '3410167589834', '2009-07-06', 'Aftab Mughal', '341017874508', 'Gujranwala', '03276483461', '78', 'raza12@gmail.com78istockphoto-165162824-170667a.jpg', 'raza12@gmail.com', '1500', '12345', 1),
(79, 'Mavish khan', '341016758963', '2010-12-08', 'Faiz Khan', '3410187674542', 'gujranwala', '03314783461', '79', 'mavish12@gmail.com79images.jfif', 'mavish12@gmail.com', '1500', '12345', 1),
(80, 'Abdul Raheem', '3410156743514', '2010-04-28', 'Azam jutt', '3410167543468', 'Gujranwala', '03226483461', '80', 'abdulraheem12@gmail.com80male-student-books-laptop-on-260nw-2445206805.webp', 'abdulraheem12@gmail.com', '1500', '12345', 1),
(81, 'Arif Ali', '341015674371', '2010-06-18', 'M.Ali', '3410167543478', 'Gujranwala', '03256793461', '81', 'arif12@gmail.com81images (31).jfif', 'arif12@gmail.com', '1500', '12345', 1),
(82, 'john ', '3410156743514', '2009-02-25', 'Ibrahim', '34101876764', 'gujranwala', '03246783972', '82', 'john12@gmail.com82images (16).jfif', 'john12@gmail.com', '1500', '12345', 1),
(83, 'shahwaiz Ali', '3410156743596', '2009-04-03', 'ibrar', '341016754346', 'Gujranwala', '03246783876', '83', 'shahali2@gmail.com83images (17).jfif', 'shahali2@gmail.com', '1800', '12345', 1),
(84, 'Alaya Ali', '3410156743534', '2009-03-27', 'Ali Jutt', '3410167543461', 'Gujranwala', '03246783582', '84', 'alaya12@gmail.com84images (20).jfif', 'alaya12@gmail.com', '1800', '12345', 1),
(85, 'Fahad saith', '3410156743565', '2009-10-03', ' Muhammad Safdar ', '3410167543466', 'Gujranwala', '03246785632', '85', 'fahad2@gmail.com85download (1).jfif', 'fahad2@gmail.com', '1800', '12345', 1),
(86, 'Alishba', '3410156743564', '2009-09-03', 'Tariq Arif', '341017874564', 'gujranwala', '03246754612', '86', 'alihba12@gmail.com86download (2).jfif', 'alihba12@gmail.com', '1800', '12345', 1),
(87, 'Haroon malik', '341015674359', '2009-05-04', 'ali malik', '3410187674536', 'gujranwala', '03246784620', '87', 'haroon12@gmail.com87images (10).jfif', 'haroon12@gmail.com', '1800', '12345', 1),
(88, 'Sufyan malik', '341016758983', '2009-04-23', 'ali malik', '341017874568', 'Gujranwala', '03246783461', '88', 'sufyan12@gmail.com88images (24).jfif', 'sufyan12@gmail.com', '1800', '12345', 1),
(89, 'uzair malik', '3410156743512', '2009-10-03', 'amir malik', '34101675434449', 'Gujranwala', '0324765853', '89', 'malik342@gmail.com89images (12).jfif', 'malik342@gmail.com', '1800', '12345', 1),
(90, 'Hammad Jutt', '3410167589872', '2009-12-28', 'haroon jutt', '341016754345', 'Gujranwala', '03246783461', '90', 'HAMMAD12@gmail.com90images (29).jfif', 'HAMMAD12@gmail.com', '1800', '12345', 1),
(91, 'Ali Butt', '341016758951', '2009-08-12', 'Arshad Butt', '3410167543456', 'Gujranwala', '03246783572', '91', 'alibutt12@gmail.com91images (30).jfif', 'alibutt12@gmail.com', '1800', '12345', 1),
(92, 'Hamid malik', '3410156743565', '2009-06-12', 'hammad malik', '3410187674452', 'Gujranwala', '03246783410', '92', 'hamid3712@gmail.com92download.jfif', 'hamid3712@gmail.com', '1800', '12345', 1),
(93, 'Amna sheikh', '3410156743561', '2009-03-12', 'faheem sheikh', '3410167543421', 'Gujranwala', '03215630981', '93', 'sheikh12@gmail.com93images (22).jfif', 'sheikh12@gmail.com', '1800', '12345', 1),
(94, 'Qahafa jutt', '3410156743562', '2009-10-02', 'M.Ali jutt', '3410167543463', 'Gujranwala', '03246781320', '95', 'qahafa12@gmail.com95images (27).jfif', 'qahafa12@gmail.com', '1800', '12345', 1),
(95, 'Minahil  Mughal', '3410167589812', '2009-02-12', 'ali mughul', '3410167543431', 'Gujranwala', '0324672540999', '94', 'minahil12@gmail.com94images (23).jfif', 'minahil12@gmail.com', '1800', '12345', 1),
(96, 'Aiza mailk', '3410156785931', '2009-07-28', 'abdullah mailk', '3410167543412', 'Gujranwala', '03226470413', '97', 'aiza12@gmail.com97images.jfif', 'aiza12@gmail.com', '1800', '12345', 1),
(97, 'Furqan ', '3410156743511', '2009-04-19', 'Asif', '341016754341', 'Gujranwala', '03316783442', '98', 'furqan12@gmail.com98download (1).jfif', 'furqan12@gmail.com', '1800', '12345', 1),
(98, 'Atif Ali', '341015674352', '2009-10-02', 'Arif', '3410187674592', 'Gujranwala', '03246783384', '99', 'atit32@gmail.com99images (24).jfif', 'atit32@gmail.com', '1800', '12345', 1),
(99, 'Eman choudary', '341015674353', '2009-12-03', 'Amir choudary', '3410167543461', 'Gujranwala', '0324678241', '100', 'eman12@gmail.com100images (19).jfif', 'eman12@gmail.com', '1800', '12345', 1),
(100, 'Alina mehar', '3410156743523', '2008-11-08', 'Abrar Ahmad', '3410187674521', 'Gujranwala', '03246783194', '96', 'alinamehar12@gmail.com96images (21).jfif', 'alinamehar12@gmail.com', '1800', '12345', 1),
(101, 'Haroon Butt', '3410156743578', '2009-03-09', 'arshad ', '3410187674536\\67', 'gujranwala', '03246783461', '101', 'aatifmalik12@gmail.com101download.jfif', 'aatifmalik12@gmail.com', '1800', '12345', 1),
(102, 'aatif', '3410156743567', '2009-03-01', 'Fayyaz sheikh', '34101675434685', 'gujranwala', '03246783461', '102', 'aatifmalik12@gmail.com102download (2).jfif', 'aatifmalik12@gmail.com', '1800', '12345', 1),
(103, 'Hamid Tariq', '3410167589875', '2009-02-14', 'Tariq Arif', '34101675434685', 'gujranwala', '03246783461', '103', 'aatifmalik12@gmail.com103images (1).jfif', 'aatifmalik12@gmail.com', '1800', '12345', 1),
(104, 'aiza', '34101567859367', '2009-02-14', 'Tariq Arif', '3410187674536', 'Gujranwala', '032467834213', '104', 'arifalik12@gmail.com104images (8).jfif', 'arifalik12@gmail.com', '2000', '12345', 1),
(105, 'uzair', '3410156743561', '2008-05-02', 'M.Ali', '341017874563', 'Gjranwala', '03246783432', '105', 'aatifmalik12@gmail.com105images (16).jfif', 'aatifmalik12@gmail.com', '2000', '12345', 1),
(106, 'Misba Jutt', '3410156743561', '2008-06-09', ' Muhammad Safdar ', '3410167543461', 'Gujranwala', '03246783312', '106', 'aatifmalik12@gmail.com106images.jfif', 'aatifmalik12@gmail.com', '2000', '12345', 1),
(107, 'Babar ', '34101567859367', '2008-04-02', 'Saleem Butt', '34101675434685', 'Gujranwala', '03246783461', '107', 'aatifmalik12@gmail.com107images (25).jfif', 'aatifmalik12@gmail.com', '2000', '12345', 1),
(108, 'nimra', '34101567859367', '2008-03-01', 'Fayyaz sheikh', '3410167543461', 'gujranwala', '03246783475', '108', 'nimra12@gmail.com108images (18).jfif', 'nimra12@gmail.com', '2000', '12345', 1),
(109, 'sufyan', '3410156743579', '2008-07-02', 'Arif Jutt', '3410187674536', 'gujranwala', '03246783432', '109', 'sufyan12@gmail.com109download (1).jfif', 'sufyan12@gmail.com', '2000', '12345', 1),
(110, 'Awis', '3410156743567', '2009-03-01', 'M.Ali', '3410167543461', 'gujranwala', '03246783638', '110', 'asif12@gmail.com110images (17).jfif', 'asif12@gmail.com', '2000', '12345', 1),
(111, 'aatif', '34101567435678', '2008-02-14', 'Tariq Arif', '341017874563', 'gujranwala', '03246783461', '111', 'aatifmalik12@gmail.com111images (2).jfif', 'aatifmalik12@gmail.com', '2000', '12345', 1),
(112, 'Maryam', '34101567435678', '2007-02-26', ' Muhammad Safdar ', '3410167543461', 'gujranwala', '03246783326', '112', 'aatifmalik12@gmail.com112images (3).jfif', 'aatifmalik12@gmail.com', '2000', '12345', 1),
(113, 'Arooj ', '34101567859367', '0008-02-25', 'Arshad Butt', '34101876745362', 'gujranwala', '03246783442', '113', 'arooj12@gmail.com113images (31).jfif', 'arooj12@gmail.com', '2000', '12345', 1),
(114, 'faheem', '3410156743561', '2008-02-03', 'M.Amir', '34101675434685', 'gujranwala', '03246783461', '114', 'aatifmalik12@gmail.com114images (10).jfif', 'aatifmalik12@gmail.com', '2000', '12345', 1),
(115, 'Ayesha', '341015674356', '2008-04-01', 'Saleem Butt', '3410187674536', 'gujranwala', '03246783461', '115', 'aatifmalik12@gmail.com115download (2).jfif', 'aatifmalik12@gmail.com', '2000', '12345', 1),
(116, 'Aiza mailk', '3410156743567', '2008-02-25', ' Muhammad Safdar ', '3410167543468', 'gujranwala', '032467672', '116', 'ayesha12@gmail.com116images (23).jfif', 'ayesha12@gmail.com', '2000', '12345', 1),
(117, 'Hamid Cheema', '3410156743561', '2008-05-03', 'M.Ahmad ', '34101876745362', 'gujranwala', '03246783467', '118', 'hamid4512@gmail.com118images (27).jfif', 'hamid4512@gmail.com', '2000', '12345', 1),
(118, 'Faheem Fayyaz', '3410156743579', '2008-03-14', 'Arif Jatta', '3410187674536', 'gujranwala', '03246783427', '119', 'arsfk12@gmail.com119download.jfif', 'arsfk12@gmail.com', '2000', '12345', 1),
(119, 'Sufyan Safdar', '3410156743567', '2008-12-12', 'Fayyaz sheikh', '34101876745362', 'gujranwala', '03246783562', '120', 'sufyan12@gmail.com120download (1).jfif', 'sufyan12@gmail.com', '2000', '12345', 1),
(120, 'Aiza butt', '34101567435678', '2008-11-12', 'Arshad Butt', '341017874563', 'gujranwala', '03246783461', '121', 'aatifmalik12@gmail.com121images.jfif', 'aatifmalik12@gmail.com', '2000', '12345', 1),
(121, 'Nimra  jutt', '3410156743579', '2009-10-09', 'Tariq Arif', '34101675434685', 'gujranwala', '03246783461', '122', 'aatifmalik12@gmail.com122images (23).jfif', 'aatifmalik12@gmail.com', '2000', '12345', 1),
(122, 'arham', '34101567859367', '2009-05-25', 'hamid jutt', '3410187674536', 'gujranwala', '03246783461', '124', 'arham12@gmail.com124images (25).jfif', 'arham12@gmail.com', '2000', '12345', 1),
(123, 'Muskan', '341015674356', '2009-03-01', ' Muhammad Safdar ', '341017874563', 'gujranwala', '03246783461', '125', 'muskan12@gmail.com125images (5).jfif', 'muskan12@gmail.com', '2000', '12345', 1),
(124, 'Ali', '34101567859367', '2008-09-04', 'Aslam Mughal', '3410187674536', 'gujranwala', '03246783461', '127', 'alinoork12@gmail.com127images (24).jfif', 'alinoork12@gmail.com', '2000', '12345', 1),
(125, 'uzair malik', '3410156743579', '2008-05-22', 'Tariq Arif', '3410167543468', 'gujranwala', '03246783461', '128', 'uzair12@gmail.com128images (30).jfif', 'uzair12@gmail.com', '2000', '12345', 1),
(126, 'faheem', '341015674356', '2008-04-01', ' Muhammad Safdar ', '3410187674536', 'gujranwala', '03246783461', '129', 'arif12@gmail.com129images (26).jfif', 'arif12@gmail.com', '2000', '12345', 1),
(127, 'shahwaiz butt', '34101567859367', '2008-04-02', 'hammad butt', '3410167543461', 'gujranwala', '03246783461', '130', 'shahwaiz2@gmail.com130images (29).jfif', 'shahwaiz2@gmail.com', '2000', '12345', 1),
(128, 'uswa khan', '34101567859367', '2008-06-02', 'ali khan', '3410167543461', 'gujranwala', '03246783461', '123', 'uswa12@gmail.com123download (2).jfif', 'uswa12@gmail.com', '2000', '12345', 1),
(129, 'haroon jutt', '3410156743567', '2008-04-24', 'M.Ali', '34101675434685', 'gujranwala', '03246782671', '125', 'aatifmalik12@gmail.com125download.jfif', 'aatifmalik12@gmail.com', '2000', '12345', 1),
(130, 'Hamid malik', '3410156743579', '2008-05-24', 'ali malik', '3410167543468', 'Gujranwala', '03296783461', '131', 'malikha@gmail.com131download (1).jfif', 'malikha@gmail.com', '2500', '12345', 1),
(131, 'aatif', '3410156743567', '2008-04-05', 'Tariq Arif', '3410167543468', 'gujranwala', '03246783461', '132', 'atif12@gmail.com132images (17).jfif', 'atif12@gmail.com', '2500', '12345', 1),
(132, 'hamza', '34101567859367', '2008-03-05', 'Fayyaz sheikh', '34101675434685', 'gujranwala', '03246783461', '133', 'hamza12@gmail.com133images (25).jfif', 'hamza12@gmail.com', '2500', '12345', 1),
(133, 'ali haider', '34101567435678', '2009-09-06', 'Saleem Butt', '34101675434685', 'gujranwala', '03246783461', '134', 'haiderk12@gmail.com134images (24).jfif', 'haiderk12@gmail.com', '2500', '12345', 1),
(134, 'Faheem Cheema', '3410156743561', '2008-04-15', 'ali cheema', '3410167543468', 'gujranwala', '03246783461', '135', 'faheem12@gmail.com135images (27).jfif', 'faheem12@gmail.com', '2500', '12345', 1),
(135, 'tahreem', '3410156743579', '2008-03-31', 'hamid', '3410178745639', 'gujranwala', '03246784572', '136', 'tahreem2@gmail.com136images (23).jfif', 'tahreem2@gmail.com', '2500', '12345', 1),
(136, 'hamid', '3410156743561', '0008-02-25', 'M.Ali', '3410187674536', 'gujranwala', '03246783461', '137', 'faheem2@gmail.com137male-student-books-laptop-on-260nw-2445206805.webp', 'faheem2@gmail.com', '2500', '12345', 1),
(137, 'alishba mailk', '3410156743579', '2008-05-04', 'Tariq Arif', '3410167543461', 'gujranwala', '03246783461', '138', 'alishba12@gmail.com138images (23).jfif', 'alishba12@gmail.com', '2500', '12345', 1),
(138, 'Faheem', '3410156743564', '2008-10-05', 'Saleem Butt', '3410187674536', 'gujranwala', '03246783461', '139', 'feheem12@gmail.com139images (31).jfif', 'feheem12@gmail.com', '2500', '12345', 1),
(139, 'Amir khan ', '341015674356', '2008-11-05', 'arif khan', '3410187674536', 'gujranwala', '03246783267', '140', 'amir36@gmail.com140images (29).jfif', 'amir36@gmail.com', '2500', '12345', 1),
(140, 'Haroon Butt', '3410156743579', '2008-09-04', 'Arshad Butt', '341017874563', 'gujranwala', '03246783461', '141', 'butttharoon2@gmail.com141download (1).jfif', 'butttharoon2@gmail.com', '2500', '12345', 1),
(141, 'Muskan malik', '3410156743561', '2008-11-07', 'sufyan malik', '341017874563', 'gujranwala', '03246783461', '142', 'sufyuan@gmail.com142download (2).jfif', 'sufyuan@gmail.com', '3000', '12345', 1),
(142, 'Hamid Tariq', '3410156743579', '2007-05-03', 'Tariq Arif', '3410167543468', 'gujranwala', '03246783435', '143', 'hamid9812@gmail.com143download.jfif', 'hamid9812@gmail.com', '2500', '12345', 1),
(143, 'Sufyan Safdar', '34101567859367', '2008-04-05', ' Muhammad Safdar ', '34101675434685', 'gujranwala', '03246783461', '144', 'sufyan12@gmail.com144images (1).jfif', 'sufyan12@gmail.com', '3000', '12345', 1),
(144, 'Uzair butt', '3410156743561', '2007-05-04', 'Saleem Butt', '34101675434685', 'gujranwala', '03246783461', '145', 'uzair12@gmail.com145images (2).jfif', 'uzair12@gmail.com', '3000', '12345', 1),
(145, 'Ayesha khan', '341015674356', '2006-04-05', 'M.Ali', '3410167543468', 'gujranwala', '03246783461', '145', 'ayeshkhan2@gmail.com145images (3).jfif', 'ayeshkhan2@gmail.com', '3000', '12345', 1),
(146, 'Eman choudary', '341015674356', '2007-05-04', 'Saleem choudary', '3410167543468', 'gujranwala', '03246783461', '147', 'emank12@gmail.com147images (4).jfif', 'emank12@gmail.com', '3000', '12345', 1),
(147, 'nimra', '3410156743567', '2008-07-05', 'hamid jutt', '3410167543468', 'gujranwala', '03246783461', '148', 'nimra12@gmail.com148images (5).jfif', 'nimra12@gmail.com', '3000', '12345', 1),
(148, 'misba Mehar', '34101567435678', '2007-02-04', 'faheem mehar', '3410167543461', 'gujranwala', '03246783461', '149', 'miba12@gmail.com149images (6).jfif', 'miba12@gmail.com', '3000', '12345', 1),
(149, 'Qahafa butt', '3410156743567', '2006-07-05', 'ali butt', '34101876745362', 'gujranwala', '03246783461', '150', 'alie12@gmail.com150images (17).jfif', 'alie12@gmail.com', '3000', '12345', 1),
(150, 'Alaya  jutt', '3410156743567', '2007-06-04', 'hamid jutt', '341017874563', 'gujranwala', '03246783461', '146', 'alaya12@gmail.com146images (23).jfif', 'alaya12@gmail.com', '3000', '12345', 1),
(151, 'faheem raza', '34101567435678', '2007-05-04', 'Raza Mehar', '34101675434685', 'gujranwala', '03246783461', '151', 'faheem12@gmail.com151male-student-books-laptop-on-260nw-2445206805.webp', 'faheem12@gmail.com', '3000', '12345', 1),
(152, 'ali raza', '34101567435678', '2008-06-04', ' Muhammad Safdar ', '34101675434685', 'gujranwala', '03246783461', '152', 'alirazak12@gmail.com152istockphoto-165162824-170667a.jpg', 'alirazak12@gmail.com', '3000', '12345', 1),
(153, 'Amna Jutt', '34101567435678', '2006-07-04', 'Saleem jutt', '3410167543468', 'gujranwala', '03246783461', '153', 'amna2@gmail.com153images.jfif', 'amna2@gmail.com', '3000', '12345', 1),
(154, 'Manan khan  ', '34101567435678', '2007-07-04', 'M.Ali khan  ', '34101675434685', 'gujranwala', '03246783461', '154', 'mani12@gmail.com154images (31).jfif', 'mani12@gmail.com', '3000', '12345', 1),
(155, 'haider', '3410156743567', '2006-09-05', 'ali maher', '34101876745362', 'gujranwala', '03246783461', '155', 'aatifmalik12@gmail.com155images (2).jfif', 'aatifmalik12@gmail.com', '3000', '12345', 1),
(156, 'Amer Hamza', '3410156743579', '2008-09-05', 'M.Ahmad ', '3410167543468', 'gujranwala', '03246783461', '157', 'amer12@gmail.com157images (13).jfif', 'amer12@gmail.com', '3000', '12345', 1),
(157, 'Alisha', '34101567859367', '2007-12-31', 'Tariq Arif', '3410187674536', 'gujranwala', '03246783461', '158', 'alisha12@gmail.com148images (7).jfif', 'alisha12@gmail.com', '3000', '12345', 1),
(158, 'shahwaiz', '3410156743561', '2007-12-04', 'haroon', '3410187674536', 'gujranwala', '03246783452', '159', 'haroon12@gmail.com159download.jfif', 'haroon12@gmail.com', '3000', '12345', 1),
(159, 'sufyan', '3410156743567', '2007-11-07', 'manan', '3410187674536', 'gujranwala', '03246783461', '160', 'manan12@gmail.com160images (11).jfif', 'manan12@gmail.com', '3000', '12345', 1),
(160, 'Uzair Insari', '3410156743561', '2006-10-05', 'Maqsood Ahmad', '341017874563', 'gujranwala', '03246783461', '156', 'maqsood12@gmail.com156images (10).jfif', 'maqsood12@gmail.com', '3000', '12345', 1),
(161, 'Muskan', '341015674356', '2006-09-05', 'Tariq Arif', '34101675434685', 'gujranwala', '03246783461', '161', 'muskan12@gmail.com161images (20).jfif', 'muskan12@gmail.com', '3500', '12345', 1),
(162, 'Ahmad', '3410156743561', '2007-08-05', 'hashim khan', '341017874563', 'gujranwala', '03246783461', '162', 'hashim12@gmail.com162download.jfif', 'hashim12@gmail.com', '3500', '12345', 1),
(163, 'hashim butt', '3410156743561', '2007-04-27', 'aslam Butt', '3410167543461', 'gujranwala', '03246783461', '163', 'hashim12@gmail.com163images (24).jfif', 'hashim12@gmail.com', '3500', '12345', 1),
(164, 'hamid mughal', '34101567859367', '2006-07-04', 'tariq mughal', '341017874563', 'gujranwala', '03246783461', '164', 'tariq12@gmail.com164download (1).jfif', 'tariq12@gmail.com', '3500', '12345', 1),
(165, 'sufyan mahar', '3410156743579', '2006-08-04', 'haroon maher', '3410187674536', 'gujranwala', '03246783461', '165', 'sufyanmaher12@gmail.com165images (14).jfif', 'sufyanmaher12@gmail.com', '3500', '12345', 1),
(166, 'Amna khan', '3410156743563', '2006-06-24', 'fayyaz khan', '3410167543468', 'gujranwala', '03246783461', '166', 'amna12@gmail.com166images (9).jfif', 'amna12@gmail.com', '3500', '12345', 1),
(167, 'faheem mughal', '3410156743561', '2006-07-04', 'ahmad mughal', '341017874563', 'gujranwala', '03246783461', '167', 'faheem712@gmail.com167images (16).jfif', 'faheem712@gmail.com', '3500', '12345', 1),
(168, 'Muskan ', '341015674356', '2007-07-04', 'Arshad Butt', '3410167543461', 'gujranwala', '03246783461', '168', 'muskan22@gmail.com168download (2).jfif', 'muskan22@gmail.com', '3500', '12345', 1),
(169, 'haider', '34101567435678', '2006-08-05', 'Saleem Butt', '3410187674536', 'gujranwala', '03246783461', '170', 'haider12@gmail.com170images (12).jfif', 'haider12@gmail.com', '3500', '12345', 1),
(170, 'NIMRA', '341015674356', '2007-09-05', 'hamid jutt', '3410167543468', 'gujranwala', '03246783461', '169', 'nimra12@gmail.com169images (8).jfif', 'nimra12@gmail.com', '3500', '12345', 1),
(171, 'Faizan', '3410156743561', '2008-08-06', 'ali khan', '341017874563', 'gujranwala', '03246783461', '171', 'faizan12@gmail.com171download (1).jfif', 'faizan12@gmail.com', '3500', '12345', 1),
(172, 'muskan', '341015674356', '2007-07-04', 'Saleem Butt', '341017874563', 'gujranwala', '03246783461', '172', 'muskan12@gmail.com172download (2).jfif', 'muskan12@gmail.com', '3500', '12345', 1),
(173, 'Sufyan Safdar', '3410156743567', '2008-08-05', 'safdar', '3410187674536', 'gujranwala', '03246783461', '173', 'sutyan612@gmail.com173download.jfif', 'sutyan612@gmail.com', '3500', '12345', 1),
(174, 'uzair', '34101567435678', '2007-08-05', ' Muhammad Safdar ', '3410187674536', 'gujranwala', '03246783461', '174', 'uzair12@gmail.com174images (2).jfif', 'uzair12@gmail.com', '3500', '12345', 1),
(175, 'Misba ', '3410156743561', '2007-07-04', 'hashim jutt', '3410167543461', 'gujranwala', '03246783461', '175', 'misba12@gmail.com175images (7).jfif', 'misba12@gmail.com', '3500', '12345', 1),
(176, 'hammad  mughal', '3410156743561', '2008-07-04', 'asif mughal', '3410167543461', 'gujranwala', '03246783461', '176', 'hammad12@gmail.com176images (17).jfif', 'hammad12@gmail.com', '3500', '12345', 1),
(177, 'atif mughal', '341015674356', '2007-04-29', 'ali mughal', '3410167543461', 'gujranwala', '03246783461', '177', 'aligh12@gmail.com177images (12).jfif', 'aligh12@gmail.com', '3500', '12345', 1),
(178, 'abdullah maher', '341015674356', '2007-06-04', 'hamid mughal', '34101876745362', 'gujranwala', '03246783461', '178', 'abdullah12@gmail.com178images (11).jfif', 'abdullah12@gmail.com', '3500', '12345', 1),
(179, 'Ayesha', '34101567435678', '2007-07-04', 'hamid jutt', '34101876745362', 'gujranwala', '03246783461', '179', 'ayesha6972@gmail.com179images (22).jfif', 'ayesha6972@gmail.com', '3500', '12345', 1),
(180, 'hamza', '3410156743567', '2007-06-04', 'nadeem', '3410167543468', 'gujranwala', '03246783461', '180', 'hamzak12@gmail.com180images (16).jfif', 'hamzak12@gmail.com', '3500', '12345', 1),
(181, 'Ali Shahwaiz', '3410156743561', '2006-08-04', 'Arif Jatta', '341017874563', 'gujranwala', '03246783461', '181', 'shahwaiz342@gmail.com181download (1).jfif', 'shahwaiz342@gmail.com', '4000', '12345', 1),
(182, 'Amna mughal', '34101567435679', '2006-08-05', 'faheem mughal', '3410167543461', 'gujranwala', '03246783461', '182', 'amna12@gmail.com182download (2).jfif', 'amna12@gmail.com', '4000', '12345', 1),
(183, 'hamid', '341015674353', '2006-09-07', 'Fayyaz sheikh', '3410167543468', 'gujranwala', '03246783461', '183', 'mhamid12@gmail.com183download.jfif', 'mhamid12@gmail.com', '4000', '12345', 1),
(184, 'sufyan mughal', '3410156743561', '2006-06-04', 'hashim mughal', '3410187674536', 'gujranwala', '03246783461', '184', 'sufyan2@gmail.com184images (1).jfif', 'sufyan2@gmail.com', '4000', '12345', 1),
(185, 'hamid', '3410156743579', '2006-08-06', 'fayyaz jutt', '3410167543468', 'gujranwala', '03246783461', '186', 'hamidg12@gmail.com186images (11).jfif', 'hamidg12@gmail.com', '4000', '12345', 1),
(186, 'arshad ', '3410156743567', '2008-07-06', 'khushi ', '3410187674536', 'gujranwala', '03246783461', '185', 'arshad12@gmail.com185images (10).jfif', 'arshad12@gmail.com', '4000', '12345', 1),
(187, 'qaiser', '3410156743579', '2006-07-04', 'faisal', '341016754346', 'gujranwala', '03246783461', '187', 'qaiser12@gmail.com187images (25).jfif', 'qaiser12@gmail.com', '4000', '12345', 1),
(188, 'ali raza', '341015674356', '2007-07-05', 'Tariq Arif', '3410187674536', 'gujranwala', '03246783461', '188', 'aliraza12@gmail.com188images (24).jfif', 'aliraza12@gmail.com', '4000', '12345', 1),
(189, 'arslan cheema', '341015674356', '2006-07-04', 'safdar cheema', '3410167543468', 'gujranwala', '03246783461', '189', 'arslan2@gmail.com189images (16).jfif', 'arslan2@gmail.com', '4000', '12345', 1),
(190, 'Eman rani', '341015674356', '2006-07-04', 'Rana ashfak', '34101876745362', 'gujranwala', '03246783461', '190', 'emanrani12@gmail.com190images (18).jfif', 'emanrani12@gmail.com', '4000', '12345', 1),
(191, 'Maryam mughal', '3410156743579', '2006-06-08', 'awais mughal', '34101675434685', 'gujranwala', '03246783383', '191', 'awis3412@gmail.com191images (23).jfif', 'awis3412@gmail.com', '4000', '12345', 1),
(192, 'haider ali', '341015674356', '2006-08-04', 'M.Ali', '34101876745362', 'gujranwala', '03246783461', '192', 'haider2@gmail.com192download.jfif', 'haider2@gmail.com', '4000', '12345', 1),
(193, 'Hamid Tariq', '341015674357', '2006-08-06', 'Tariq cheema', '341017874563', 'gujranwala', '03246783461', '193', 'hamidtariq@gmail.com193images (30).jfif', 'hamidtariq@gmail.com', '4000', '12345', 1),
(194, 'fahad mughal', '3410156743456', '2006-09-04', 'aslam mughal', '341017874851', 'gujranwala', '03246783461', '194', 'fahad12@gmail.com194images (29).jfif', 'fahad12@gmail.com', '4000', '12345', 1),
(195, 'aris maher', '3410156743567', '2007-08-04', 'ali maher', '3410167543468', 'gujranwala', '03246783461', '195', 'alimehar12@gmail.com195images (25).jfif', 'alimehar12@gmail.com', '4000', '12345', 1),
(196, 'sufyan', '341015674356', '2006-02-05', 'haider', '3410167543468', 'gujranwala', '03246783461', '196', 'msufyan4512@gmail.com196images (31).jfif', 'msufyan4512@gmail.com', '4000', '12345', 1),
(197, 'hashim cheema', '341015674357', '2006-11-06', 'asim cheema', '341017874563', 'gujranwala', '03246783461', '197', 'hashim12@gmail.com197male-student-books-laptop-on-260nw-2445206805.webp', 'hashim12@gmail.com', '4000', '12345', 1),
(198, 'muskan', '3410156785936', '2006-12-21', 'salman jutt', '341017874563', 'gujranwala', '03246783461', '198', 'muskan12@gmail.com198download (2).jfif', 'muskan12@gmail.com', '4000', '12345', 1),
(199, 'Abdullah khan', '341015674356', '2006-04-07', 'rafqat khan', '3410187674536', 'gujranwala', '03316427004', '199', 'abdullah12@gmail.com199images (28).jfif', 'abdullah12@gmail.com', '4000', '12345', 1),
(200, 'waleed Butt', '341015674356', '2006-08-04', 'shan butt', '341017874563', 'gujranwala', '03246783461', '200', 'waleed3512@gmail.com200images (27).jfif', 'waleed3512@gmail.com', '4000', '12345', 1),
(201, 'Asim Mughal', '3410145673931', '2007-02-08', 'Farooq Mughal', '3410187547321', 'Gujranwala', '03317376489', '201', 'asim123@gmail.com201download (1).jfif', 'asim123@gmail.com', '1000', '12345', 1);

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
  `password` varchar(255) NOT NULL,
  `teacher_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_profile`
--

INSERT INTO `teacher_profile` (`teacher_id`, `name`, `cnic`, `f_name`, `phone_no`, `qualification`, `dob`, `address`, `email`, `school_id`, `image`, `password`, `teacher_status`) VALUES
(1, 'Sir Imran', '3410145673984', 'Farooq Mughal', '03006476494', 'MA English', '2001-04-24', 'Gujranwala', 'imran23@gmail.com', '01', 'imran23@gmail.com01240_F_60942587_v6eMKqUitJ3PXptnhTfEVSlWe5Oq0bWm.jpg', '12345', 1),
(2, 'Sir Tanveer', '3410187395103', 'Ahmad Maqsood', '03116427004', 'MA Math', '2000-09-04', 'Gujranwala', 'tanveer32@gmail.com', '02', 'tanveer32@gmail.com02240_F_104939026_zfARs9vI4VUlXRU72XJTHXcV8VMIJD38.jpg', '12345', 1),
(3, 'Miss Ayesha', '3410179340510', 'M.Wassem ', '03326470555', 'MA Chemistry', '2000-11-06', 'Gujranwala', 'ayesha987@gmail.com', '03', 'ayesha987@gmail.com03240_F_66784939_cMe3BH6DWVicMEX5vzettRyP9E5IWsfz.jpg', '12345', 1),
(4, 'Miss Anam', '3410187395477', 'faheem mughl', '03006476596', 'MA Urdu', '2001-02-05', 'Gujranwala', 'anam56@gmail.com', '04', 'anam56@gmail.com04240_F_113316547_q9wiDxadvidz5UvKITGbJMvzqrDw45Kl.jpg', '12345', 1),
(5, 'Sir Faisal', '3410167430193', 'M.Ali', '03326476341', 'MA Physics', '1999-03-04', 'Gujranwala', 'faisal657@gmail.com', '05', 'faisal657@gmail.com05240_F_318400976_8xA8EmS76mI0wZKP9gF0H9h4DDYO7CI6.jpg', '12345', 1),
(6, 'Sir Qaiser', '3410167917321', 'Abdullah cheema', '03326476640', 'MA Computer', '2000-09-04', 'Gujranwala', 'qaiser65@gmail.com', '06', 'qaiser65@gmail.com06images (3).jfif', '12345', 1),
(7, 'Miss Nimra', '3410167430621', 'Abdul Raheem', '03326476931', 'MA Pak-Study', '2000-11-27', 'Gujranwala', 'nimra231@gmail.com', '07', 'nimra231@gmail.com07240_F_265183061_NkulfPZgRxbNg3rvYSNGGwi0iD7qbmOp.jpg', '12345', 1),
(8, 'Misba', '3410187395426', 'M.Awis', '03391888754', 'MA Islamiat', '2001-04-25', 'Gujranwala', 'misba47@gmail.com', '08', 'misba47@gmail.com08240_F_405298963_2A9tdEd4EJpmR8fJc9pIdnL9kndFjJsb.jpg', '12345', 1),
(9, 'Musab Butt', '3410145673671', 'Arshad Butt', '03007840201', 'MA Biology', '2002-11-10', 'Gujranwala', 'musab21@gmail.com', '09', 'musab21@gmail.com09360_F_104939054_E7P5jaVoNYcXQI7YBrzsVWH2qZc03sn8.webp', '12345', 1),
(10, 'Sufyan Cheema', '3410187395630', 'Asim cheema', '03316429004', 'MA Math', '2001-10-12', 'Gujranwala', 'sufyan34@gmail.com', '10', 'sufyan34@gmail.com10images (2).jfif', '12345', 1),
(11, 'Arham Arshad', '3410187395734', 'Arshad Butt', '03326476840', 'MA Physic', '2000-03-01', 'Gujranwala', 'arham12@gmail.com', '11', 'arham12@gmail.com11images (1).jfif', '12345', 1),
(12, 'Waleed Mughal', '3410179340971', 'Fizan Mughal', '03097856201', 'MA Math', '2000-11-03', 'Gujranwala', 'waleed 78@gmail.com', '12', 'waleed 78@gmail.com12images.jfif', '12345', 1),
(13, 'Zaman Jutt', '3410167430642', 'Afzal jutt', '03345839120', 'MA Ecnomics', '2000-12-04', 'Gujranwala', 'zaman09@gmail.com', '13', 'zaman09@gmail.com13240_F_504129720_UMoqrpUsC8WsdPbGiQvxvzafJTaEVijP.jpg', '12345', 1),
(14, 'Ali Haider', '3410145673904', 'M.Wassem ', '03116427841', 'MA English', '1999-05-02', 'Gujranwala', 'ali43@gmail.com', '14', 'ali43@gmail.com14240_F_60942587_v6eMKqUitJ3PXptnhTfEVSlWe5Oq0bWm.jpg', '12345', 1),
(15, 'Maryam', '3410167430630', 'Haroon Butt', '03326476301', 'MA Chemistry', '2002-08-04', 'Gujranwala', 'maryam09@gmail.com', '15', 'maryam09@gmail.com15240_F_66784939_cMe3BH6DWVicMEX5vzettRyP9E5IWsfz.jpg', '12345', 1),
(16, 'Aiza Mirza', '3410187395783', 'Farooq Mirza', '03326476601', 'MA Urdu', '1999-06-05', 'Gujranwala', 'aizamirza12@gmail.com', '16', 'aizamirza12@gmail.com16240_F_204120303_MXmugzfdk3I7Br9SqCp669EEgP70EKMR.jpg', '12345', 1),
(17, 'Hamid Rajpoot', '3410187395098', 'M.Ali', '03326476763', 'MA Computer', '2000-05-08', 'Gujranwala', 'hamid657@gmail.com', '17', 'hamid657@gmail.com17240_F_318400976_8xA8EmS76mI0wZKP9gF0H9h4DDYO7CI6.jpg', '12345', 1),
(18, 'Nehal Butt', '3410167430843', 'Haroon Butt', '03237478595', 'MA English', '2000-06-04', 'Gujranwala', 'nehal31@gmail.com', '18', 'nehal31@gmail.com18240_F_405298963_2A9tdEd4EJpmR8fJc9pIdnL9kndFjJsb.jpg', '12345', 1),
(19, 'Rana Uzair ', '3410179340973', 'Rana Hashim', '03326476797', 'MA Urdu', '2001-10-08', 'Gujranwala', 'uzair69@gmail.com', '20', 'uzair69@gmail.com20images (3).jfif', '12345', 1),
(20, 'Kinza cheema', '3410187395198', 'M.Ali', '03116427850', 'MA Computer', '2001-08-04', 'Gujranwala', 'kinza7@gmail.com', '19', 'kinza7@gmail.com19240_F_314312504_EYlkKSz9ZZJD1OA83YSafMQlDwghbJhf.jpg', '12345', 1),
(21, 'Usman Meer', '3410145673961', 'Hammad Meer', '03326470860', 'MA Pak-Study', '2001-09-04', 'Gujranwala', 'usman21@gmail.com', '21', 'usman21@gmail.com21360_F_104939054_E7P5jaVoNYcXQI7YBrzsVWH2qZc03sn8.webp', '12345', 1),
(22, 'Maqsood', '3410145673903', 'M.Ahmad', '03116427789', 'MA Islamiat', '1998-09-05', 'Gujranwala', 'maqsood009@gmail.com', '22', 'maqsood009@gmail.com22images.jfif', '12345', 1),
(23, 'Arslan Cheema', '3410187395187', 'Safdar Cheema', '03326476390', 'MA Computer', '2000-11-07', 'Gujranwala', 'arslan45@gmail.com', '23', 'arslan45@gmail.com23240_F_504129720_UMoqrpUsC8WsdPbGiQvxvzafJTaEVijP.jpg', '12345', 1),
(24, 'Hamza ', '3410179340569', 'M.Wassem ', '03006476596', 'MA Biology', '2000-07-07', 'Gujranwala', 'hamza23@gamil.com', '24', 'hamza23@gamil.com24240_F_104939026_zfARs9vI4VUlXRU72XJTHXcV8VMIJD38.jpg', '12345', 1),
(25, 'Alina', '3410179340583', 'Ahmad Maqsood', '03116427053', 'MA Ecnomics', '2000-11-05', 'Gujranwala', 'alina@gmail.com', '25', 'alina@gmail.com25240_F_113316547_q9wiDxadvidz5UvKITGbJMvzqrDw45Kl.jpg', '12345', 1),
(26, 'Abdullah cheema', '3410167430182', 'Javid Cheema', '03116427861', 'MA Chemistry', '2000-04-29', 'Gujranwala', 'abdullah45@gmail.com', '26', 'abdullah45@gmail.com26images (1).jfif', '12345', 1),
(27, 'Adeel Mughal', '3410187395193', 'Farooq Mughal', '031164266942', 'MA Math', '2000-07-04', 'Gujranwala', 'adeel89@gmail.com', '27', 'adeel89@gmail.com27images (3).jfif', '12345', 1),
(28, 'Maria Mehar', '3410167430173', 'Afzal Maher', '03016428690', 'MA Pak-Study', '2000-09-04', 'Gujranwala', 'maria12@gmail.com', '28', 'maria12@gmail.com28240_F_265183061_NkulfPZgRxbNg3rvYSNGGwi0iD7qbmOp.jpg', '12345', 1),
(29, 'Rana Adil ', '3410179340740', 'Rana Haseeb', '03006476649', 'MA Computer', '2001-07-04', 'Gujranwala', 'ranaadil4@gmail.com', '29', 'ranaadil4@gmail.com29360_F_104939054_E7P5jaVoNYcXQI7YBrzsVWH2qZc03sn8.webp', '12345', 1),
(30, 'Tahreem ', '3410179340743', 'Zulfiqar Rahmani', '03326470853', 'MA Math', '2003-05-19', 'Gujranwala', 'tahreem23@gmail.com', '30', 'tahreem23@gmail.com30240_F_66784939_cMe3BH6DWVicMEX5vzettRyP9E5IWsfz.jpg', '12345', 1);

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
(1, 1, 'Monday'),
(2, 1, 'Tuesday'),
(3, 1, 'Wednesday'),
(4, 1, 'Thursday'),
(5, 1, 'Friday'),
(6, 1, 'Saturday'),
(7, 2, 'Monday'),
(8, 2, 'Tuesday'),
(9, 2, 'Wednesday'),
(10, 2, 'Thursday'),
(11, 2, 'Friday'),
(12, 2, 'Saturday'),
(13, 3, 'Monday'),
(14, 3, 'Tuesday'),
(15, 3, 'Wednesday'),
(16, 3, 'Thursday'),
(17, 3, 'Friday'),
(18, 3, 'Saturday'),
(19, 4, 'Monday'),
(20, 4, 'Tuesday'),
(21, 4, 'Wednesday'),
(22, 4, 'Thursday'),
(23, 4, 'Friday'),
(24, 4, 'Saturday'),
(25, 5, 'Monday'),
(26, 5, 'Tuesday'),
(27, 5, 'Wednesday'),
(28, 5, 'Thursday'),
(29, 5, 'Friday'),
(30, 5, 'Saturday'),
(31, 6, 'Monday'),
(32, 6, 'Tuesday'),
(33, 6, 'Wednesday'),
(34, 6, 'Thursday'),
(35, 6, 'Friday'),
(36, 6, 'Saturday'),
(37, 7, 'Monday'),
(38, 7, 'Tuesday'),
(39, 7, 'Wednesday'),
(40, 7, 'Thursday'),
(41, 7, 'Friday'),
(42, 7, 'Saturday'),
(43, 8, 'Monday'),
(44, 8, 'Tuesday'),
(45, 8, 'Wednesday'),
(46, 8, 'Thursday'),
(47, 8, 'Friday'),
(48, 8, 'Saturday'),
(49, 9, 'Monday'),
(50, 9, 'Tuesday'),
(51, 9, 'Wednesday'),
(52, 9, 'Thursday'),
(53, 9, 'Friday'),
(54, 9, 'Saturday'),
(55, 10, 'Monday'),
(56, 10, 'Tuesday'),
(57, 10, 'Wednesday'),
(58, 10, 'Thursday'),
(59, 10, 'Friday'),
(60, 10, 'Saturday'),
(61, 11, 'Monday'),
(62, 11, 'Tuesday'),
(63, 11, 'Wednesday'),
(64, 11, 'Thursday'),
(65, 11, 'Friday'),
(66, 11, 'Saturday'),
(67, 12, 'Monday'),
(68, 12, 'Tuesday'),
(69, 12, 'Wednesday'),
(70, 12, 'Thursday'),
(71, 12, 'Friday'),
(72, 12, 'Saturday'),
(73, 13, 'Monday'),
(74, 13, 'Tuesday'),
(75, 13, 'Wednesday'),
(76, 13, 'Thursday'),
(77, 13, 'Friday'),
(78, 13, 'Saturday'),
(79, 14, 'Monday'),
(80, 14, 'Tuesday'),
(81, 14, 'Wednesday'),
(82, 14, 'Thursday'),
(83, 14, 'Friday'),
(84, 14, 'Saturday'),
(85, 15, 'Monday'),
(86, 15, 'Tuesday'),
(87, 15, 'Wednesday'),
(88, 15, 'Thursday'),
(89, 15, 'Friday'),
(90, 15, 'Saturday'),
(91, 16, 'Monday'),
(92, 16, 'Tuesday'),
(93, 16, 'Wednesday'),
(94, 16, 'Thursday'),
(95, 16, 'Friday'),
(96, 16, 'Saturday'),
(97, 17, 'Monday'),
(98, 17, 'Tuesday'),
(99, 17, 'Wednesday'),
(100, 17, 'Thursday'),
(101, 17, 'Friday'),
(102, 17, 'Saturday'),
(103, 18, 'Monday'),
(104, 18, 'Tuesday'),
(105, 18, 'Wednesday'),
(106, 18, 'Thursday'),
(107, 18, 'Friday'),
(108, 18, 'Saturday'),
(109, 19, 'Monday'),
(110, 19, 'Tuesday'),
(111, 19, 'Wednesday'),
(112, 19, 'Thursday'),
(113, 19, 'Friday'),
(114, 19, 'Saturday'),
(115, 20, 'Monday'),
(116, 20, 'Tuesday'),
(117, 20, 'Wednesday'),
(118, 20, 'Thursday'),
(119, 20, 'Friday'),
(120, 20, 'Saturday');

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
  MODIFY `admin_log_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=336;

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
  MODIFY `er_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `homework_diary`
--
ALTER TABLE `homework_diary`
  MODIFY `homework_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `notice_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `period_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1021;

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
  MODIFY `student_class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `student_fee`
--
ALTER TABLE `student_fee`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_profile`
--
ALTER TABLE `student_profile`
  MODIFY `student_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

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
