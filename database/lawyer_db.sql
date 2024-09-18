-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2024 at 04:22 PM
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
-- Database: `lawyer_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointmentid` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `customerid` int(11) DEFAULT NULL,
  `lawyerid` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointmentid`, `date`, `time`, `customerid`, `lawyerid`, `status`) VALUES
(4, '2024-09-04', '31:05:50', 5, 3, 1),
(7, '2024-09-18', '18:30:53', 3, 8, 1),
(8, '2024-09-18', '18:45:00', 3, 8, 0),
(9, '2024-09-19', '18:48:00', 3, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `genderid` int(11) NOT NULL,
  `gender` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`genderid`, `gender`) VALUES
(8, 'Male'),
(9, 'Female'),
(10, 'Other'),
(12, 'rather not say');

-- --------------------------------------------------------

--
-- Table structure for table `lawyerdetails`
--

CREATE TABLE `lawyerdetails` (
  `detailid` int(11) NOT NULL,
  `lawyerid` int(11) DEFAULT NULL,
  `specializationid` int(11) DEFAULT NULL,
  `locationid` int(11) DEFAULT NULL,
  `education` varchar(25) NOT NULL,
  `practicestartdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lawyerdetails`
--

INSERT INTO `lawyerdetails` (`detailid`, `lawyerid`, `specializationid`, `locationid`, `education`, `practicestartdate`) VALUES
(1, 2, 6, 2, 'B.A. LLB.', '2020-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `locationid` int(11) NOT NULL,
  `location` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`locationid`, `location`) VALUES
(1, 'Islamabad'),
(2, 'Karachi'),
(3, 'Lahore'),
(4, 'Multan'),
(5, 'Quetta');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`username`, `password`, `userid`) VALUES
('abdul', 'abdul', 3),
('aliraza', 'ali', 5),
('asdfgh', 'asdfgh12', 21),
('asil', 'asil', 2),
('Fahad', 'fahad', 9),
('haqqani', 'haqqani', 6),
('Ilyan', 'Ilyan', 8),
('qwerty', 'qwerty12', 20),
('saad', 'saad', 13),
('shoaib', 'shoaib', 14),
('smuhussain', 'Pakistan123', 4);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleid` int(11) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleid`, `role`) VALUES
(1, 'Admin'),
(2, 'Lawyer'),
(3, 'customer'),
(7, 'kd2e');

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `spid` int(11) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `specialization` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`spid`, `icon`, `specialization`, `description`) VALUES
(1, ' <i class=\"fa fa-file-invoice-dollar\"></i>\n\n', 'Bankruptcy lawyer', 'Bankruptcy lawyers are experts in the U.S. Bankruptcy Code, and handle insolvency issues for their clients.'),
(2, '<i class=\"fa fa-hand-holding-usd\"></i>', 'Business lawyer (corporate lawyer)', 'Business lawyers, also known as corporate lawyers, handle legal matters for businesses and ensure that all company transactions occur within the scope of local, state, and federal laws. '),
(3, '<i class=\"fa fa-university\"></i>', 'Constitutional lawyer', 'Constitutional lawyers deal with the interpretation and implementation of the U.S. Constitution, balancing the interests of government institutions with the interests of individuals. '),
(4, '<i class=\"fa fa-gavel\"></i>', 'Criminal defence lawyer', 'Criminal defence lawyers advocate on behalf of those accused of criminal activity and ensure that their liberties and basic rights are fairly upheld within the justice system. '),
(5, '<i class=\"fa fa-briefcase\"></i>', 'Employment and labour lawyer', 'Employment and labour lawyers broadly handle the relationships between unions, employers, and employees.'),
(6, '<i class=\"fa fa-users\"></i>', 'Family lawyer', 'While many people may think of family lawyers as divorce attorneys who handle the division of marital assets, child custody, and alimony, family law extends to many more issues. '),
(7, '<i class=\"fa fa-passport\"></i>', 'Immigration lawyer', ' Immigration lawyers play a pivotal role in providing guidance to individuals and families navigating the necessary requirements to live, work, or study in the country.'),
(8, '<i class=\"fa fa-calculator\"></i>', 'Tax lawyer', 'Tax lawyers understand the ins and outs of tax laws and regulations, and work in a variety of settings.'),
(9, '<i class=\"fa fa-lightbulb\"></i>\n', 'Intellectual property (IP) lawyer', 'Intellectual property (IP) lawyers protect and enforce the rights and creations of inventors, authors, artists, and businesses.'),
(10, '<i class=\"fa fa-landmark\"></i>', 'Personal injury lawyer (Civil Lawyer)', 'Personal injury lawyers work primarily in civil litigations, representing clients who have sustained an injury.'),
(11, '<i class=\"fa fa-graduation-cap\"></i>', 'Education Law', 'Education law encompasses a wide range of legal issues related to schools, colleges, and educational institutions.'),
(12, '<i class=\"fa fa-globe\"></i>', 'Cyber Law', 'Cyber law, also known as internet law or digital law, governs the legal issues related to the internet and digital technologies.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `genderid` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `roleid` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `email`, `genderid`, `dob`, `phone`, `address`, `roleid`, `photo`) VALUES
(2, 'Asil', 'asil@gmail.com', NULL, NULL, '0300-7654321', 'AS1', 1, 'img/team-1.jpg'),
(3, 'Abdul Hadi', 'hadi@gmail.com', 8, '0000-00-00', '0300-1122334', 'AH1', 3, ''),
(4, 'Syed Murtaza Hussain', 'smuhussain@gmail.com', NULL, '1983-07-03', '+92-314-2308332', 'Karachi', 1, 'img/team-1.jpg'),
(5, 'abdurrehman', 'abdulrehmanfaisal65@gmail.com', NULL, NULL, '+92-314-2308332', NULL, 2, 'img/team-1.jpg'),
(6, 'Muhammad Haqqani', 'muhammadhaqqani6@gmail.com', NULL, NULL, '+92-332-8046147', NULL, 2, 'img/team-1.jpg'),
(7, 'qweryhgdg', 'abdulrehmanfaisal65@gmail.com', NULL, NULL, '+923328046147', NULL, 3, NULL),
(8, 'Ilyan Javed', 'Ilyanjaved65@gmail.com', 8, '0000-00-00', '03342363179', '', 2, 'img/team-1.jpg'),
(9, 'Fahad', 'Fahad@gmail.com', NULL, NULL, '03342363123', NULL, 3, 'img/team-1.jpg'),
(13, 'Saad Kamlani', 'Saadkamlani@gmail.com', NULL, NULL, '03325173123', NULL, 2, 'img/team-1.jpg'),
(14, 'Shoaib Malik', 'shoaib@gmail.com', 8, NULL, '03327854139', NULL, 3, 'img/team-1.jpg'),
(15, 'Shoaib Malik', 'shoaib@gmail.com', 8, NULL, '03327854139', NULL, 3, 'img/team-1.jpg'),
(16, 'Shoaib Malik', 'shoaib@gmail.com', 8, NULL, '03327854139', NULL, 2, 'img/team-1.jpg'),
(17, 'Shoaib Malik', 'shoaib@gmail.com', 8, NULL, '03327854139', NULL, 2, 'img/team-1.jpg'),
(18, 'abdurrehman', 'abdulrehmanfaisal65@gmail.com', 8, NULL, '+923142308332', NULL, 3, 'img/team-1.jpg'),
(19, 'abdurrehman', 'abdulrehmanfaisal65@gmail.com', 8, NULL, '+923142308332', NULL, 2, 'img/team-1.jpg'),
(20, 'abdul hadi', 'abdulhadi@gmail.com', 8, NULL, '+923328046147', NULL, 2, 'img/team-1.jpg'),
(21, 'qwerty', 'qwerty@gmail.com', 10, NULL, '03341373106', NULL, 2, 'img/team-1.jpg'),
(22, 'Shahzaib1', 'shahzaib@gmail.com', 8, '2024-09-11', '0300-1234567', 'KHI', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointmentid`),
  ADD KEY `appointments_ibfk_1` (`customerid`),
  ADD KEY `appointments_ibfk_2` (`lawyerid`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`genderid`);

--
-- Indexes for table `lawyerdetails`
--
ALTER TABLE `lawyerdetails`
  ADD PRIMARY KEY (`detailid`),
  ADD KEY `lawyerid` (`lawyerid`),
  ADD KEY `specializationid` (`specializationid`),
  ADD KEY `locationid` (`locationid`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`locationid`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`username`),
  ADD KEY `logins_ibfk_1` (`userid`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`spid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `users_ibfk_1` (`roleid`),
  ADD KEY `genderid` (`genderid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `genderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `lawyerdetails`
--
ALTER TABLE `lawyerdetails`
  MODIFY `detailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `locationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `spid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`lawyerid`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `lawyerdetails`
--
ALTER TABLE `lawyerdetails`
  ADD CONSTRAINT `lawyerdetails_ibfk_1` FOREIGN KEY (`lawyerid`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `lawyerdetails_ibfk_2` FOREIGN KEY (`specializationid`) REFERENCES `specializations` (`spid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `lawyerdetails_ibfk_3` FOREIGN KEY (`locationid`) REFERENCES `locations` (`locationid`);

--
-- Constraints for table `logins`
--
ALTER TABLE `logins`
  ADD CONSTRAINT `logins_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `roles` (`roleid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`genderid`) REFERENCES `genders` (`genderid`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
