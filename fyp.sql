-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2022 at 05:13 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentID` int(80) NOT NULL,
  `patientID` varchar(50) NOT NULL,
  `appointmentDate` date NOT NULL,
  `appointmentTime` varchar(80) NOT NULL,
  `medicalField` varchar(80) NOT NULL,
  `doctor` varchar(80) NOT NULL,
  `fee` varchar(80) NOT NULL,
  `status` varchar(80) NOT NULL,
  `review_status` varchar(20) DEFAULT NULL,
  `userID` int(10) NOT NULL,
  `doctor_schedule_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentID`, `patientID`, `appointmentDate`, `appointmentTime`, `medicalField`, `doctor`, `fee`, `status`, `review_status`, `userID`, `doctor_schedule_id`) VALUES
(1, '4', '2022-11-18', '20:00-20:30', 'Cardiology', 'Dr Hans Cronk', '-', 'booked', NULL, 2, 1),
(5, '4', '2017-11-08', '10:00-10:30', 'Cardiology', 'Dr Hans Cronk', '$250', 'expired', NULL, 2, 2),
(12, '4', '2022-11-14', '11:30-12:00', 'Oncology', 'Avery Watson', '$320.50', 'expired', NULL, 5, 3),
(13, ' ', '2022-11-19', '10:00-10:30', 'Cardiology', 'Dr Hans Cronk', '-', 'upcoming', NULL, 2, 4),
(19, '0', '2022-11-19', '13:00-13:30', 'Cardiology', 'Dr Hans Cronk', '-', 'upcoming', NULL, 2, 4),
(20, ' ', '2022-11-19', '13:30-14:00', 'Cardiology', 'Dr Hans Cronk', '-', 'upcoming', NULL, 2, 4),
(21, '0', '2022-11-23', '09:00-10:00', 'Oncology', 'Dr Avery Watson', '-', 'upcoming', NULL, 5, 5),
(22, '0', '2022-11-23', '10:00-11:00', 'Oncology', 'Dr Avery Watson', '-', 'upcoming', NULL, 5, 5),
(23, '0', '2022-11-23', '11:00-12:00', 'Oncology', 'Dr Avery Watson', '-', 'upcoming', NULL, 5, 5),
(24, ' ', '2022-11-23', '12:00-13:00', 'Oncology', 'Dr Avery Watson', '-', 'upcoming', NULL, 5, 5),
(25, '4', '2022-11-25', '09:00-09:30', 'Oncology', 'Dr Avery Watson', '-', 'booked', NULL, 5, 6),
(26, '0', '2022-11-25', '09:30-10:00', 'Oncology', 'Dr Avery Watson', '-', 'upcoming', NULL, 5, 6),
(27, '0', '2022-11-25', '10:00-10:30', 'Oncology', 'Dr Avery Watson', '-', 'upcoming', NULL, 5, 6),
(28, '0', '2022-11-25', '10:30-11:00', 'Oncology', 'Dr Avery Watson', '-', 'upcoming', NULL, 5, 6),
(29, '0', '2022-11-25', '11:00-11:30', 'Oncology', 'Dr Avery Watson', '-', 'upcoming', NULL, 5, 6),
(30, '0', '2022-11-25', '11:30-12:00', 'Oncology', 'Dr Avery Watson', '-', 'upcoming', NULL, 5, 6),
(31, '0', '2022-11-19', '12:30:13:00', 'Cardiology', 'Dr Hans Cronk', '-', 'upcoming', NULL, 2, 4),
(32, '0', '2022-11-19', '12:00:12:30', 'Cardiology', 'Dr Hans Cronk', '-', 'upcoming', NULL, 2, 4),
(33, '0', '2022-11-21', '09:00-09:30', 'Cardiology', 'Dr Hans Cronk', '-', 'upcoming', NULL, 2, 7),
(34, '0', '2022-11-21', '09:30-10:00', 'Cardiology', 'Dr Hans Cronk', '-', 'upcoming', NULL, 2, 7),
(35, '0', '2022-11-21', '10:00-10:30', 'Cardiology', 'Dr Hans Cronk', '-', 'upcoming', NULL, 2, 7),
(36, '0', '2022-11-21', '10:30-11:00', 'Cardiology', 'Dr Hans Cronk', '-', 'upcoming', NULL, 2, 7),
(37, '0', '2022-11-21', '11:00-11:30', 'Cardiology', 'Dr Hans Cronk', '-', 'upcoming', NULL, 2, 7),
(38, '0', '2022-11-21', '11:30-12:00', 'Cardiology', 'Dr Hans Cronk', '-', 'upcoming', NULL, 2, 7),
(39, '4', '2022-11-19', '17:30:18:00', 'Cardiology', 'Dr Hans Cronk', '-', 'booked', NULL, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `userID` int(100) NOT NULL,
  `img` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `education` varchar(100) NOT NULL,
  `field` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`userID`, `img`, `name`, `education`, `field`, `position`, `description`) VALUES
(2, 'IMG-636bc7a4335a65.11995852.jpg', 'Dr Hans Cronk', 'Bachelor of Science in Cardiovascular Technology', 'Cardiology', 'Head Of Department', 'Diagnose, assess and treat patients with defects and diseases of the heart and the blood vessels, which are known as the cardiovascular system.'),
(5, 'IMG-6371f9e03ccb78.87855766.jpg', 'Dr Avery Watson', 'University of New York', 'Oncology', 'Head of Department', 'Oncology is a branch of medicine that deals with the study, treatment, diagnosis and prevention of cancer. ');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedule`
--

CREATE TABLE `doctor_schedule` (
  `doctor_schedule_id` int(11) NOT NULL,
  `userID` int(80) NOT NULL,
  `doctor_schedule_date` date NOT NULL,
  `doctor_schedule_day` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') COLLATE utf8_unicode_ci NOT NULL,
  `doctor_schedule_start_time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_schedule_end_time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `average_consulting_time` int(5) NOT NULL,
  `doctor_schedule_status` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_schedule`
--

INSERT INTO `doctor_schedule` (`doctor_schedule_id`, `userID`, `doctor_schedule_date`, `doctor_schedule_day`, `doctor_schedule_start_time`, `doctor_schedule_end_time`, `average_consulting_time`, `doctor_schedule_status`) VALUES
(2, 2, '2022-11-15', 'Tuesday', '10:00', '12:00', 30, 'Activated'),
(3, 5, '2022-11-16', 'Wednesday', '10:00', '12:00', 30, 'Activated'),
(4, 2, '2022-11-19', 'Saturday', '10:00', '14:00', 30, 'Activated'),
(5, 5, '2022-11-23', 'Wednesday', '09:00', '13:00', 60, 'Activated'),
(6, 5, '2022-11-25', 'Friday', '09:00', '12:00', 30, 'Activated'),
(7, 2, '2022-11-21', 'Monday', '09:00', '12:00', 30, 'Activated');

-- --------------------------------------------------------

--
-- Table structure for table `hem`
--

CREATE TABLE `hem` (
  `hemID` smallint(5) UNSIGNED NOT NULL,
  `hemImageURL` text NOT NULL,
  `hemTitle` varchar(30) NOT NULL,
  `hemKeyword` varchar(30) NOT NULL,
  `hemDesc` varchar(1000) NOT NULL,
  `hemPublishedDate` date NOT NULL,
  `hemLastUpdate` date DEFAULT NULL,
  `author` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hem`
--

INSERT INTO `hem` (`hemID`, `hemImageURL`, `hemTitle`, `hemKeyword`, `hemDesc`, `hemPublishedDate`, `hemLastUpdate`, `author`) VALUES
(1, 'IMG-636bc96798c2c8.51048574.jpg', 'The Turning Point', 'Chronic Obstructive', 'From a near-death experience back to a full time job and enjoying time with his family. Mr Smith was diagnosed with Chronic Obstructive Pulmonary Disease but his second chance at life was facilitated by the integrated care that he received from FYP-22-S3-18.', '2022-11-09', '2022-11-09', 'admin'),
(2, 'IMG-636bd205bb5c89.42669108.jpg', 'Health Screening', 'Screening ', 'Health screening helps you find out if you have or are at-risk of developing chronic conditions, which could lead to more serious health issues.', '2022-11-09', '2022-11-09', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `hpm`
--

CREATE TABLE `hpm` (
  `hpmID` int(10) NOT NULL,
  `hpmDesc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hpm`
--

INSERT INTO `hpm` (`hpmID`, `hpmDesc`) VALUES
(1, 'DRINK MORE WATER');

-- --------------------------------------------------------

--
-- Table structure for table `medicalcertificates`
--

CREATE TABLE `medicalcertificates` (
  `medicalcertificateID` int(80) NOT NULL,
  `appointmentID` int(80) NOT NULL,
  `doctorID` varchar(300) NOT NULL,
  `patientName` varchar(200) NOT NULL,
  `patientIC` varchar(10) NOT NULL,
  `noOfDays` int(50) NOT NULL,
  `issueDate` date DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicalcertificates`
--

INSERT INTO `medicalcertificates` (`medicalcertificateID`, `appointmentID`, `doctorID`, `patientName`, `patientIC`, `noOfDays`, `issueDate`, `startDate`, `endDate`) VALUES
(1, 5, '2', 'patient', 'S1224127D', 3, '2022-11-14', '2022-11-14', '2022-11-16'),
(2, 12, '5', 'patient', 'S1224127D', 30, '2022-11-14', '2022-11-14', '2022-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `medicalfield`
--

CREATE TABLE `medicalfield` (
  `medicalFieldID` int(80) NOT NULL,
  `medicalField` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicalfield`
--

INSERT INTO `medicalfield` (`medicalFieldID`, `medicalField`) VALUES
(1, 'Oncology'),
(2, 'Dermatology'),
(3, 'Cardiology');

-- --------------------------------------------------------

--
-- Table structure for table `medicalrecords`
--

CREATE TABLE `medicalrecords` (
  `medicalrecordID` int(80) NOT NULL,
  `appointmentID` int(80) NOT NULL,
  `name` varchar(200) NOT NULL,
  `ic` varchar(200) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `height` varchar(100) NOT NULL,
  `Diagnosis` varchar(300) NOT NULL,
  `Prescription` varchar(300) NOT NULL,
  `doctorID` varchar(300) NOT NULL,
  `attachment1` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicalrecords`
--

INSERT INTO `medicalrecords` (`medicalrecordID`, `appointmentID`, `name`, `ic`, `weight`, `height`, `Diagnosis`, `Prescription`, `doctorID`, `attachment1`) VALUES
(1, 5, 'patient', 'S1224127D', '50', '155', 'Unstable angina. Unstable angina can be undiagnosed chest pain or a sudden worsening of existing angina. \r\n\r\nAlso has extreme case of eczema, to refer to a dermatologist', 'Blood thinner - aspirin', '2', 'MR-6371fba15bdbc0.72046017.jfif'),
(2, 12, 'patient', 'S1224127D', '65kg', '180cm', 'Stage 2 ovarian cancer', 'Chemotherapy:  to shrink or kill the cancer. The drugs can be pills you take or medicines given in your veins, or sometimes both.', '5', 'MR-63720026d16193.52201430.png');

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE `referral` (
  `referralID` int(80) NOT NULL,
  `referDate` date DEFAULT NULL,
  `appointmentID` int(80) NOT NULL,
  `doctorID` int(80) NOT NULL,
  `patientName` varchar(200) NOT NULL,
  `patientIC` varchar(10) NOT NULL,
  `referredField` varchar(100) NOT NULL,
  `reason` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referral`
--

INSERT INTO `referral` (`referralID`, `referDate`, `appointmentID`, `doctorID`, `patientName`, `patientIC`, `referredField`, `reason`) VALUES
(1, '2022-11-14', 5, 2, 'patient', 'S1224127D', 'Dermatology', 'Patient has unstable angina and appears to have an extreme case of eczema. Please help to review and provide a treatment. ');

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `user_rating` int(1) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL,
  `userID` int(80) NOT NULL,
  `user_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(80) NOT NULL,
  `username` varchar(80) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `password` varchar(80) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `fullname` varchar(80) NOT NULL,
  `ic` varchar(10) NOT NULL,
  `gender` varchar(80) NOT NULL,
  `dob` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phoneNumber` int(8) NOT NULL,
  `userProfile` int(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `fullname`, `ic`, `gender`, `dob`, `email`, `phoneNumber`, `userProfile`) VALUES
(1, 'admin', 'admin', 'admin', 'S1234567D', 'Other', '12/12/2011', 'admin@gmail.com', 87898989, 4),
(2, 'doctor', 'doctor', 'doctor', 'S1234567D', 'Other', '02/02/1998', 'doctor@gmail.com', 91234567, 2),
(3, 'nurse', 'nurse', 'nurse', 'S1234567D', 'Female', '03/03/1993', 'nurse123@gmail.com', 89768899, 3),
(4, 'patient', 'patient', 'patient', 'S1224127D', 'Female', '12/12/2012', 'fyp22s318@gmail.com', 81124564, 1),
(5, 'doctor2', 'doctor2', 'Avery Watson', 'S1221794G', 'Female', '1995-02-06', 'watson@gmail.com', 90889494, 2);

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `profileID` int(1) NOT NULL,
  `profileName` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`profileID`, `profileName`) VALUES
(1, 'Patient'),
(2, 'Doctor'),
(3, 'Nurse'),
(4, 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  ADD PRIMARY KEY (`doctor_schedule_id`);

--
-- Indexes for table `hem`
--
ALTER TABLE `hem`
  ADD PRIMARY KEY (`hemID`);

--
-- Indexes for table `hpm`
--
ALTER TABLE `hpm`
  ADD PRIMARY KEY (`hpmID`);

--
-- Indexes for table `medicalcertificates`
--
ALTER TABLE `medicalcertificates`
  ADD PRIMARY KEY (`medicalcertificateID`);

--
-- Indexes for table `medicalfield`
--
ALTER TABLE `medicalfield`
  ADD PRIMARY KEY (`medicalFieldID`);

--
-- Indexes for table `medicalrecords`
--
ALTER TABLE `medicalrecords`
  ADD PRIMARY KEY (`medicalrecordID`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`referralID`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentID` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  MODIFY `doctor_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hem`
--
ALTER TABLE `hem`
  MODIFY `hemID` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hpm`
--
ALTER TABLE `hpm`
  MODIFY `hpmID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicalcertificates`
--
ALTER TABLE `medicalcertificates`
  MODIFY `medicalcertificateID` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medicalfield`
--
ALTER TABLE `medicalfield`
  MODIFY `medicalFieldID` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicalrecords`
--
ALTER TABLE `medicalrecords`
  MODIFY `medicalrecordID` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `referralID` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
