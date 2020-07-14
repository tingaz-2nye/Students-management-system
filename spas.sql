-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2018 at 01:50 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `joined_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `first_name`, `last_name`, `joined_date`) VALUES
(1, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', '2018-09-23 20:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE IF NOT EXISTS `assignments` (
`id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `file_path` varchar(60) NOT NULL,
  `class_code` varchar(60) NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
`id` int(11) NOT NULL,
  `week` varchar(60) NOT NULL,
  `day` varchar(60) NOT NULL,
  `student_id` varchar(60) NOT NULL,
  `class_code` varchar(60) NOT NULL,
  `status` enum('Present','Absent') NOT NULL COMMENT '0 Undefined, 1 Absent, 2 Present',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
`id` int(11) NOT NULL,
  `class_name` varchar(60) NOT NULL,
  `class_level` varchar(60) NOT NULL,
  `class_code` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class_name`, `class_level`, `class_code`) VALUES
(1, 'BIT', 'Level 4', 'BITL4'),
(2, 'DC', 'Level 4', 'DCL4'),
(3, 'BIT', 'Level 5', 'BITL5'),
(4, 'DC', 'Level 5', 'DCL5'),
(5, 'BIT', 'Level 7', 'BITL7');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
`id` int(11) NOT NULL,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comment` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `name`, `date`, `comment`) VALUES
(2, 'Unit Test 2', '09/01/2015', 'UT2'),
(4, 'Unit Test 3', '01/01/2016', 'UT3'),
(5, 'Unit Test 3', '02/01/2016', 'UT3'),
(6, 'Final Term 2', '04/01/2016', 'T2');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
`grade_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `grade_point` int(11) NOT NULL,
  `grade_from` int(11) NOT NULL,
  `grade_to` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`grade_id`, `name`, `grade_point`, `grade_from`, `grade_to`, `comment`) VALUES
(1, 'A+', 100, 76, 100, 'Distinction Marks'),
(2, 'A', 80, 61, 75, 'First'),
(3, 'B+', 60, 46, 60, 'Second'),
(4, 'B', 40, 35, 45, 'Third'),
(5, 'F', 0, 0, 34, 'Fail');

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

CREATE TABLE IF NOT EXISTS `mark` (
`mark_id` int(11) NOT NULL,
  `student_id` varchar(60) NOT NULL,
  `class_code` varchar(60) NOT NULL,
  `subject_code` varchar(60) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `total_mark` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mark`
--

INSERT INTO `mark` (`mark_id`, `student_id`, `class_code`, `subject_code`, `exam_id`, `mark`, `total_mark`, `comment`) VALUES
(1, 'St002', 'BITL4', 'SFC', 2, 98, 100, 'Very good');

-- --------------------------------------------------------

--
-- Table structure for table `noticeboard`
--

CREATE TABLE IF NOT EXISTS `noticeboard` (
`id` int(11) NOT NULL,
  `notice_title` varchar(100) NOT NULL,
  `notice` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE IF NOT EXISTS `parent` (
`id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `online_status` tinyint(1) NOT NULL,
  `joined_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`id`, `email`, `password`, `first_name`, `last_name`, `online_status`, `joined_date`) VALUES
(1, 'parent@parent.com', 'd0e45878043844ffc41aac437e86b602', 'John', 'Doe', 0, '2018-09-24 11:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
`id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_reply`
--

CREATE TABLE IF NOT EXISTS `post_reply` (
`id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `reply_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
`id` int(11) NOT NULL,
  `student_id` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `parent_id` int(11) NOT NULL,
  `class` varchar(60) NOT NULL,
  `online_status` tinyint(1) NOT NULL,
  `joined_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_id`, `email`, `password`, `first_name`, `last_name`, `age`, `gender`, `parent_id`, `class`, `online_status`, `joined_date`) VALUES
(1, 'Student001', 'student@student.com', 'cd73502828457d15655bbd7a63fb0bc8', 'John', 'Doe', 20, 'Male', 1, 'BITL4', 0, '2018-09-24 11:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `student_assignments`
--

CREATE TABLE IF NOT EXISTS `student_assignments` (
`id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `file_path` varchar(60) NOT NULL,
  `class_code` varchar(60) NOT NULL,
  `student_id` varchar(60) NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
`id` int(11) NOT NULL,
  `subject_name` varchar(60) NOT NULL,
  `subject_code` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subject_name`, `subject_code`) VALUES
(1, 'Skills for Computing', 'SFC'),
(2, 'Software Development Techniques', 'SDT'),
(3, 'Enterprise Development', 'ED');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
`id` int(11) NOT NULL,
  `teacher_id` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `online_status` tinyint(1) NOT NULL,
  `joined_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `teacher_id`, `email`, `password`, `first_name`, `last_name`, `online_status`, `joined_date`) VALUES
(1, 'Teacher001', 'teacher@teacher.com', '8d788385431273d11e8b43bb78f3aa41', 'John', 'Doe', 0, '2018-09-24 11:45:21');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_assigned_to_student`
--

CREATE TABLE IF NOT EXISTS `teacher_assigned_to_student` (
`id` int(11) NOT NULL,
  `teacher_id` varchar(60) NOT NULL,
  `student_id` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_to_class_and_subject`
--

CREATE TABLE IF NOT EXISTS `teacher_to_class_and_subject` (
`assigned_id` int(11) NOT NULL,
  `teacher_id` varchar(60) NOT NULL,
  `class_code` varchar(60) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
`id` int(11) NOT NULL,
  `day` varchar(60) NOT NULL,
  `class_code` varchar(60) NOT NULL,
  `subject_code` varchar(60) NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_end` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `day`, `class_code`, `subject_code`, `time_start`, `time_end`) VALUES
(2, 'Monday', 'BITL4', 'DW', 10, 12),
(3, 'Tuesday', 'BITL4', 'DWF', 11, 12),
(4, 'Wednsday', 'BITL4', 'SFC', 10, 12),
(5, 'Thursday', 'DCL5', 'SFC', 9, 12),
(6, 'Friday', 'BITL7', 'SFC', 9, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `class_code` (`class_code`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
 ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `mark`
--
ALTER TABLE `mark`
 ADD PRIMARY KEY (`mark_id`);

--
-- Indexes for table `noticeboard`
--
ALTER TABLE `noticeboard`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_reply`
--
ALTER TABLE `post_reply`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `student_id` (`student_id`), ADD KEY `class` (`class`);

--
-- Indexes for table `student_assignments`
--
ALTER TABLE `student_assignments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `subject_code` (`subject_code`), ADD UNIQUE KEY `subject_name` (`subject_name`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `teacher_assigned_to_student`
--
ALTER TABLE `teacher_assigned_to_student`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_to_class_and_subject`
--
ALTER TABLE `teacher_to_class_and_subject`
 ADD PRIMARY KEY (`assigned_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `mark`
--
ALTER TABLE `mark`
MODIFY `mark_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `noticeboard`
--
ALTER TABLE `noticeboard`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_reply`
--
ALTER TABLE `post_reply`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student_assignments`
--
ALTER TABLE `student_assignments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `teacher_assigned_to_student`
--
ALTER TABLE `teacher_assigned_to_student`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teacher_to_class_and_subject`
--
ALTER TABLE `teacher_to_class_and_subject`
MODIFY `assigned_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
