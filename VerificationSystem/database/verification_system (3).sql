-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2023 at 04:31 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `verification_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(5) NOT NULL,
  `Last_Name` varchar(250) NOT NULL,
  `First_Name` varchar(250) NOT NULL,
  `MIddle_Name` varchar(250) NOT NULL,
  `account_username` varchar(50) NOT NULL,
  `account_password` varchar(50) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Contact` int(15) NOT NULL,
  `Program_in_Charge` varchar(250) NOT NULL,
  `account_tag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `Last_Name`, `First_Name`, `MIddle_Name`, `account_username`, `account_password`, `Email`, `Contact`, `Program_in_Charge`, `account_tag`) VALUES
(0, 'name ba to?', 'xian', 'great', 'ANTHONY CASAUL', '12345', 'anthonycasaul21@gmail.com', 901291291, 'CCIS', 'View'),
(6, 'CASAUL', 'ANTHONY', 'TUSCANO', 'ANTHONY CASAUL', '123456', 'anthonycasaul22@gmail.com', 2147483647, 'COE', 'View'),
(8, 'Anthony', 'PASTORAL', 'MIDDLE', 'JOMMEL THE GREAT', '123456', 'anthonycasaul20@gmail.com', 2147483647, 'COE', 'View'),
(9, 'Panis', 'Vincent', 'panis', 'panisvincent', '123456', 'panisvincent@gmail.com', 2147483647, 'abcd', 'Edit'),
(10, 'Reyes ', 'Lhanzel', 'asd', 'kahit ano', 'wsdgrtg', 'sasd@gmail', 0, 'CCIS', 'View'),
(11, 'Cuerdo', 'Christian', '', 'xianpogi', '123456', 'christianpogi@gmail.com', 2147483647, 'COE', 'View'),
(12, 'Reyes', 'Lhanzell', '', 'reyesLhanzell', '1234567', 'lhanzreyes@gmail.com', 2147483647, 'CCIS', 'View'),
(13, 'ahahhahahaha', 'Jommel ', 'Rondina', 'melmel', '12345', 'jpast@gmail.com', 2147483647, 'CCIS', 'View'),
(14, 'hehe', 'hehe', 'hehe', 'hehe', 'hehehehe', 'hehe', 0, 'cbfs', 'View'),
(15, 'huhu', 'huhu', 'huhu', 'huhuhuhu', 'huhu', 'huhu', 0, 'ccsce', 'View'),
(16, 'hihi', 'hihi', 'hihi', 'hihi', 'hihihihi', 'hihi', 0, 'ccsce', 'Edit'),
(17, 'name to', 'seryoso?', 'ah okay', 'user123', '123456', 'j@gmail.com', 123456789, 'cthm', 'Edit'),
(18, 'HAHAHA', 'HUHUHU', 'HEHEHE', 'HIHIHI', '191102', 'JEJEJE@gmail.com', 123456789, 'cbfs', 'Edit');

-- --------------------------------------------------------

--
-- Table structure for table `activity_history`
--

CREATE TABLE `activity_history` (
  `id` int(250) NOT NULL,
  `activity_date` date NOT NULL,
  `staff_username` varchar(250) NOT NULL,
  `staff_email` varchar(250) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `student_lname` varchar(250) NOT NULL,
  `student_fname` varchar(250) NOT NULL,
  `recent_activity` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_history`
--

INSERT INTO `activity_history` (`id`, `activity_date`, `staff_username`, `staff_email`, `student_id`, `student_lname`, `student_fname`, `recent_activity`) VALUES
(1, '2023-03-27', 'panisvincent', 'panisvincent@gmail.com', 'a612321213123', 'ANTHONY', 'CASAUL', 'View'),
(2, '2023-03-27', 'panisvincent', 'panisvincent@gmail.com', 'asdasds', 'CASAUL', 'ANTHONY', 'View'),
(3, '2023-03-27', 'panisvincent', 'panisvincent@gmail.com', 'a123', 'pastoral', 'jommel', 'View'),
(4, '2023-03-27', 'JOMMEL THE GREAT', 'anthonycasaul20@gmail.com', 'a90', 'dasd', 'asd', 'View'),
(5, '2023-03-27', 'JOMMEL THE GREAT', 'anthonycasaul20@gmail.com', 'a9023421312', 'pastoral', 'jommel', 'View'),
(6, '2023-03-27', 'panisvincent', 'panisvincent@gmail.com', 'asdasds', 'CASAUL', 'ANTHONY', 'View'),
(7, '2023-03-27', 'panisvincent', 'panisvincent@gmail.com', 'A61930729', 'CASAUL', 'ANTHONY', 'Edit'),
(8, '2023-03-27', 'panisvincent', 'panisvincent@gmail.com', 'a612321312312', '', '', 'Add');

-- --------------------------------------------------------

--
-- Table structure for table `input`
--

CREATE TABLE `input` (
  `input` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `input`
--

INSERT INTO `input` (`input`) VALUES
(0);

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `id` int(250) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `student_lname` varchar(50) NOT NULL,
  `student_fname` varchar(50) NOT NULL,
  `student_mname` varchar(50) NOT NULL,
  `student_suffix` varchar(5) NOT NULL,
  `student_birthday` date NOT NULL,
  `student_address` varchar(250) NOT NULL,
  `student_contact` int(15) NOT NULL,
  `student_gender` varchar(11) NOT NULL,
  `date_graduated` date NOT NULL,
  `department` varchar(100) NOT NULL,
  `program` varchar(100) NOT NULL,
  `degree` varchar(250) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `academic_year` varchar(11) NOT NULL,
  `major` varchar(50) NOT NULL,
  `guardian_name` varchar(50) NOT NULL,
  `guardian_contact` int(15) NOT NULL,
  `guardian_relationship` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`id`, `student_id`, `student_lname`, `student_fname`, `student_mname`, `student_suffix`, `student_birthday`, `student_address`, `student_contact`, `student_gender`, `date_graduated`, `department`, `program`, `degree`, `semester`, `academic_year`, `major`, `guardian_name`, `guardian_contact`, `guardian_relationship`) VALUES
(5, 'a6123213123', 'CASAUL', 'ANTHONY', 'TUSCANO', 'none', '2000-08-06', '2978-C Kakarong St. Brgy. Santa Cruz', 2147483647, 'on', '2023-03-31', '', '', 'bachelor', 'first sem', '2023-2024', '', 'john patrick matias', 2147483647, 'tatay'),
(6, 'a612321213123', 'ANTHONY', 'CASAUL', 'MIDDLE', 'none', '2023-03-16', '2978-C Kakarong St. Brgy. Santa Cruz', 2147483647, 'Female', '2023-03-16', 'ccis', 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'none', 'first sem', '2023-2024', 'APPLICATION DEVELOPMENT', 'john patrick matias', 2147483647, 'tatay'),
(7, 'A61930729', 'CASAUL', 'ANTHONY', 'Tuscano', 'asdas', '2023-03-16', 'asdadasd', 0, 'Male', '2023-03-16', 'ccis', 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'none', 'asdasdasdas', 'asdasdasds', 'OBJECT-ORIENTED PROGRAMMING', 'asdasdasdas', 0, 'asdasdasdas'),
(8, 'a123', 'pastoral', 'jommel', 'rondina', '', '2001-02-19', 'kahit saan', 2147483647, 'Male', '2023-07-14', 'ccis', 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'Graduate\'s Degree', '2nd', '2022-2023', 'APPLICATION DEVELOPMENT', 'pastoral', 0, 'father'),
(9, 'a90', 'dasd', 'asd', 'dsasd', 'jr.', '2001-02-19', 'dfxgvu aerdgf dtfbg', 987654321, 'Male', '2023-07-07', 'cbfs', 'BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION', 'Graduate\'s Degree', '2nd', '2022-2023', 'MANAGEMENT', 'asd', 0, 'mother'),
(10, 'a90234', 'dasd', 'asd', 'dsasd', 'jr.', '2001-02-19', 'dfxgvu aerdgf dtfbg', 987654321, 'Male', '2023-07-07', 'ccis', 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'Graduate\'s Degree', '2nd', '2022-2023', 'OBJECT-ORIENTED PROGRAMMING', 'asd', 0, 'mother'),
(11, 'a9023421312', 'pastoral', 'jommel', 'rondina', 'jr.', '2001-03-12', 'kahit saan', 987654321, 'Male', '2023-03-23', 'ccis', 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', '', '2nd', '2022-2023', 'OBJECT-ORIENTED PROGRAMMING', 'xian', 2147483647, 'mother'),
(12, 'a90234213122', 'pastoral', 'jommel', 'rondina', '', '2023-03-20', 'kahit saan', 987654321, 'Male', '2023-03-20', 'ccis', 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'none', '2nd', '2022-2023', 'SOCIAL COMPUTING', 'asd', 0, 'mother'),
(13, 'a612321312312', 'Serdina', 'John Rey', 'none', 'none', '2023-03-27', '2978-C Kakarong St. Brgy. Santa Cruz', 2147483647, 'Male', '2022-02-10', 'ccis', 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'Baccalaureate Degree', 'first sem', '2023-2024', 'SOCIAL COMPUTING', 'john patrick matias', 2147483647, 'tatay');

-- --------------------------------------------------------

--
-- Table structure for table `validator`
--

CREATE TABLE `validator` (
  `validator` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `validator`
--

INSERT INTO `validator` (`validator`) VALUES
(7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `activity_history`
--
ALTER TABLE `activity_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `activity_history`
--
ALTER TABLE `activity_history`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
