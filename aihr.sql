-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2023 at 02:15 PM
-- Server version: 5.7.43-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aihr`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `a_id` int(11) NOT NULL,
  `a_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`a_id`, `a_name`, `username`, `password`) VALUES
(1, 'Jacky Ceng', 'applicant', 'applicant');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `f_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `f_job` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `f_status` varchar(255) NOT NULL,
  `compatibility` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`f_id`, `f_name`, `f_job`, `attachment`, `f_status`, `compatibility`) VALUES
(44, 'Khor Chun Leong', 'Web Developer', 'Leong Resume.pdf', '', '83'),
(45, 'LORNA ALVARADO', 'Web Developer', 'Lorna Alvarado.pdf', '', '0'),
(46, 'Donna Stroupe', 'Business Administrator', 'Donna Stroupe Resume.pdf', '', '63');

-- --------------------------------------------------------

--
-- Table structure for table `hr`
--

CREATE TABLE `hr` (
  `hr_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hr_name` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hr`
--

INSERT INTO `hr` (`hr_id`, `email`, `hr_name`, `username`, `password`) VALUES
(8, 'leong10722@gmail.com', 'Khor Chun Leong', 'leong', '111'),
(16, 'vincentgoh.sec@gmail.com', 'Vincent', 'vincent', 'vincent'),
(17, 'apollo@gmail.com', 'apollo', 'apollo', 'abc12345');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `j_id` int(11) NOT NULL,
  `j_name` varchar(255) NOT NULL,
  `j_requirement` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`j_id`, `j_name`, `j_requirement`) VALUES
(2, 'Web Developer', '-Proficiency in HTML, CSS, and JavaScript.\r\n-Experience with web development frameworks (e.g., React, Angular, or Vue.js).\r\n-Knowledge of server-side technologies (e.g., Node.js, Python, or PHP).\r\n-Familiarity with databases (e.g., SQL, MongoDB, or Firebase).\r\n-Understanding of responsive web design and cross-browser compatibility.\r\n-Strong problem-solving and debugging skills.\r\n-Version control (e.g., Git) proficiency.\r\n-Knowledge of web security best practices.\r\n-Excellent communication and teamwork skills.\r\n-Portfolio showcasing web projects is a plus.'),
(6, 'Business Administrator', '-Bachelor\'s degree in Business Administration or a related field.\r\n-Strong organizational and problem-solving skills.\r\n-Proficiency in Microsoft Office and business software.\r\n-Excellent communication and interpersonal abilities.\r\n-Leadership and team management experience may be required.\r\n-Understanding of financial principles and budget management.\r\n-Adaptability and ability to work in a fast-paced environment.\r\n-Knowledge of business operations and processes.\r\n-Attention to detail and a results-oriented mindset.\r\n-Prior experience in a similar role may be preferred.'),
(9, 'Digital Marketing', '-bachelor degree in marketing or related field.\r\n-proficiency in digital marketing tools and platforms (e.g., google ads, facebook ads, seo tools).\r\n-strong analytical skills to interpret data and make data-driven decisions.\r\n-excellent written and verbal communication skills.\r\n-knowledge of content marketing, social media management, and email marketing.\r\n-understanding of seo, sem, and online advertising strategies.\r\n-creativity and the ability to develop engaging marketing campaigns.\r\n-experience in managing budgets and optimizing marketing spend.\r\n-familiarity with web analytics tools (e.g., google analytics).\r\n-up-to-date knowledge of industry trends and best practices.\r\n-certifications such as google ads or hubspot inbound marketing can be a plus.'),
(12, 'Hr', '-bachelor degree in hr or related field\r\n-strong communication and interpersonal skills\r\n-knowledge of employment laws and regulations\r\n-proficiency in hr software and microsoft office\r\n-excellent organizational and multitasking abilities\r\n-attention to detail and confidentiality\r\n-problem-solving and conflict resolution skills\r\n-1-2 years of hr experience preferred');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `hr`
--
ALTER TABLE `hr`
  ADD PRIMARY KEY (`hr_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`j_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant`
--
ALTER TABLE `applicant`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `hr`
--
ALTER TABLE `hr`
  MODIFY `hr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `j_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
