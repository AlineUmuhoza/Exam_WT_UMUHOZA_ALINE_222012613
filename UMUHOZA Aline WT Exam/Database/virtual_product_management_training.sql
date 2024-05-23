-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 09:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `virtual_product_management_training`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `title`, `instructor_id`, `start_date`, `end_date`, `price`) VALUES
(1, 'Introduction to Product Management', 1, '2024-06-01', '2024-07-01', 199.99),
(2, 'Advanced UX Design', 2, '2024-06-15', '2024-08-15', 299.99),
(3, 'Data-Driven Product Development', 3, '2024-07-01', '2024-08-30', 249.99),
(4, 'Product sale', 4, '2024-01-03', '2024-02-14', 5000000.00),
(6, 'Product Development', 3, '2024-03-22', '2024-04-29', 50000.00),
(7, 'Product marketing', 2, '2024-04-29', '2024-05-22', 950000.00);

-- --------------------------------------------------------

--
-- Table structure for table `course_assignments`
--

CREATE TABLE `course_assignments` (
  `assignment_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `assignment_title` varchar(255) NOT NULL,
  `assignment_marks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_assignments`
--

INSERT INTO `course_assignments` (`assignment_id`, `course_id`, `id`, `assignment_title`, `assignment_marks`) VALUES
(1, 3, 1, 'Introduction Quiz', '75%'),
(2, 2, 2, 'UX Design Project', '90%'),
(3, 1, 3, 'Data Analysis Assignment', '85%'),
(4, 3, 4, 'Product management Test', '90%'),
(6, 1, 1, 'Management Exam', '85%');

-- --------------------------------------------------------

--
-- Table structure for table `course_materials`
--

CREATE TABLE `course_materials` (
  `material_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `material_type` varchar(50) NOT NULL,
  `material_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_materials`
--

INSERT INTO `course_materials` (`material_id`, `course_id`, `material_type`, `material_title`) VALUES
(1, 1, 'PDF', 'Introduction to Product Management PDF'),
(2, 3, 'Video', 'Advanced UX Design Video'),
(3, 2, 'PDF', 'Data Analysis Guide PDF'),
(4, 4, 'Video', 'Product  sales '),
(6, 1, 'Audio', 'Management');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `enrollment_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `enrollment_date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`enrollment_id`, `id`, `course_id`, `enrollment_date`) VALUES
(1, 1, 1, '2024-05-15'),
(2, 2, 2, '2024-05-16'),
(3, 3, 3, '2024-05-17'),
(4, 4, 3, '2021-01-12'),
(6, 2, 3, '2024-04-30'),
(7, 1, 4, '2024-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `instructor_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `expertise_area` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`instructor_id`, `id`, `bio`, `expertise_area`) VALUES
(1, 1, 'Experienced product manager with over 10 years in the tech industry, specializing in product strategy and user experience design.', 'Product Strategy, UX Design'),
(2, 2, 'Senior product manager with a background in agile development and data analytics. Passionate about building data-driven products.', 'Agile Development, Data Analytics'),
(3, 4, 'Product management professional with expertise in market research and product marketing. Over 8 years of experience in launching successful products.', 'Market Research, Product Marketing'),
(4, 4, 'Junior mananager with experience of 5 years', 'Market Researcher'),
(6, 3, ' mananager', 'Researcher');

-- --------------------------------------------------------

--
-- Table structure for table `product_management_resources`
--

CREATE TABLE `product_management_resources` (
  `resource_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `id` int(11) DEFAULT NULL,
  `created_date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_management_resources`
--

INSERT INTO `product_management_resources` (`resource_id`, `title`, `description`, `id`, `created_date`) VALUES
(1, 'Product Management Basics', 'An introductory article on the fundamentals of product management.', 1, '2024-05-10'),
(2, 'Advanced UX Design Techniques', 'A comprehensive video tutorial on advanced UX design techniques.', 2, '2024-05-11'),
(3, 'Data-Driven Decision Making', 'An in-depth guide on how to use data analytics to drive product decisions.', 2, '2024-05-12'),
(4, 'Product sales management', 'sales management describe how sales will be managed', 4, '2024-01-19'),
(7, 'Web product', 'WEb product refers to website where you sell your products', 3, '2024-04-29'),
(8, 'Web product', 'WEb product refers to website where you sell your products', 3, '2024-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'Nshuti', 'Sam', 'nshuti001', 'nshuti@gmail.com', '09876666', '$2y$10$iP0yd7SmnUSYCTgEXD8jAeSeeuBAdaZAO6W6o4XNpGHHE2Q4/E8DC', '2024-05-18 15:56:34', '1236', 0),
(2, 'Natacha', 'Naty', 'nshuti@gmail.com', 'natacha@gmail.com', '0787100392', '$2y$10$oESSFjUzW2PxiXVAZOU/FOjlGsEAfgFpW3vm/XZdlH4bTqGZ6noLq', '2024-05-18 21:49:18', '125', 0),
(3, 'Honore', 'Ntakirutimana', 'honore1234', 'honore@gmail.com', '0987654', '$2y$10$YVymaBW6xwOeABTCpJscou09QeaEiWL9PvFXiCtA7L9YAJtFUryKG', '2024-05-18 21:50:29', '789', 0),
(4, 'Yves', 'Ntakirutimana', 'yves789', 'yves@gmail.com', '07987654', '$2y$10$zJCz.tchbhvR/fB5REy24uCbZCBNQeAIBYllkqrNV/us4/E62F8n.', '2024-05-18 21:52:23', '4568', 0),
(5, '', '', 'shyaka002', 'shyaka@gmail.com', '078234567', '$2y$10$bXij3DLHOEkjHnWcxHM0GejXAGdGTWjy4Tet5hBGXk6Jfegd3JlDG', '2024-05-21 15:21:56', '123568', 0),
(6, '', '', 'pothin89', 'pothin@gmail.com', '07987654', '$2y$10$TpbebdBgMc711d7nr01Vr.ocYEVHHTywj1jmxxKrDqPLQMDb/bPm.', '2024-05-22 14:29:27', '127898', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_certificates`
--

CREATE TABLE `user_certificates` (
  `certificate_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `issue_date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_certificates`
--

INSERT INTO `user_certificates` (`certificate_id`, `id`, `course_id`, `issue_date`) VALUES
(1, 3, 2, '2024-05-15'),
(2, 1, 1, '2024-05-16'),
(3, 2, 3, '2024-05-17'),
(4, 2, 1, '2024-05-02'),
(5, 4, 3, '2024-02-19'),
(6, 1, 1, '2024-02-19'),
(7, 3, 4, '2024-04-30'),
(8, 1, 1, '2024-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE `user_payments` (
  `payment_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_payments`
--

INSERT INTO `user_payments` (`payment_id`, `id`, `course_id`, `amount`, `payment_date`) VALUES
(1, 2, 3, 49.99, '2024-05-15'),
(2, 3, 1, 79.99, '2024-05-16'),
(3, 1, 2, 99.99, '2024-05-17'),
(4, 4, 4, 8000000.00, '2024-04-29'),
(6, 1, 1, 200000.00, '2024-01-29'),
(7, 4, 4, 99999999.99, '2024-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `user_progress`
--

CREATE TABLE `user_progress` (
  `progress_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `completion_status` varchar(100) DEFAULT NULL,
  `completion_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_progress`
--

INSERT INTO `user_progress` (`progress_id`, `id`, `course_id`, `completion_status`, `completion_date`) VALUES
(1, 2, 3, 'Completed', '2024-05-15'),
(2, 3, 1, 'pending', '2019-09-05'),
(3, 2, 4, 'Not Completed', '2024-06-23'),
(4, 4, 4, 'GOOD', '2024-04-30'),
(6, 3, 2, 'completed', '2024-04-29'),
(7, 3, 2, 'completed', '2024-04-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_assignments`
--
ALTER TABLE `course_assignments`
  ADD PRIMARY KEY (`assignment_id`);

--
-- Indexes for table `course_materials`
--
ALTER TABLE `course_materials`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`enrollment_id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`instructor_id`);

--
-- Indexes for table `product_management_resources`
--
ALTER TABLE `product_management_resources`
  ADD PRIMARY KEY (`resource_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_certificates`
--
ALTER TABLE `user_certificates`
  ADD PRIMARY KEY (`certificate_id`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user_progress`
--
ALTER TABLE `user_progress`
  ADD PRIMARY KEY (`progress_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course_assignments`
--
ALTER TABLE `course_assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_materials`
--
ALTER TABLE `course_materials`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `instructor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_management_resources`
--
ALTER TABLE `product_management_resources`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_certificates`
--
ALTER TABLE `user_certificates`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_progress`
--
ALTER TABLE `user_progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
