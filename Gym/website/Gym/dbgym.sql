-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2017 at 07:51 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbgym`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_user`
--

CREATE TABLE IF NOT EXISTS `auth_user` (
`id` int(11) NOT NULL,
  `login_id` varchar(20) NOT NULL,
  `pass_key` varchar(30) NOT NULL,
  `security` varchar(50) NOT NULL,
  `level` int(2) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_user`
--

INSERT INTO `auth_user` (`id`, `login_id`, `pass_key`, `security`, `level`, `sex`, `name`) VALUES
(1, 'admin1', '123456', 'admin1', 5, 'male', 'Mr.Admin'),
(2, 'cashier', 'cashier', 'cashier1', 4, 'male', 'cashier');

-- --------------------------------------------------------

--
-- Table structure for table `healthstatus`
--

CREATE TABLE IF NOT EXISTS `healthstatus` (
  `hs_id` int(20) NOT NULL,
  `id` int(7) NOT NULL,
  `name` varchar(30) NOT NULL,
  `date1` datetime NOT NULL,
  `bodyfat` varchar(25) NOT NULL,
  `water` varchar(30) NOT NULL,
  `muscle` varchar(30) NOT NULL,
  `calorie` varchar(30) NOT NULL,
  `bone` varchar(30) NOT NULL,
  `remarks` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `healthstatus`
--

INSERT INTO `healthstatus` (`hs_id`, `id`, `name`, `date1`, `bodyfat`, `water`, `muscle`, `calorie`, `bone`, `remarks`) VALUES
(0, 15, '15', '2016-02-14 00:00:00', 'Body Fatwr', 'Waterwr', 'Musclewr', 'Caloriewr', 'Bonewr', 'Remarkswr');

-- --------------------------------------------------------

--
-- Table structure for table `mem_types`
--

CREATE TABLE IF NOT EXISTS `mem_types` (
`id` int(11) NOT NULL,
  `mem_type_id` varchar(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `days` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mem_types`
--

INSERT INTO `mem_types` (`id`, `mem_type_id`, `name`, `days`, `rate`, `details`) VALUES
(2, 'XKCLTDSJ', 'Monthly', 30, 1500, 'Monthly'),
(5, 'PTGWSHDJ', 'Year', 365, 15000, '12 Month'),
(6, 'PUDTJFCW', 'Quarterly', 180, 8000, '6 month');

-- --------------------------------------------------------

--
-- Table structure for table `subsciption`
--

CREATE TABLE IF NOT EXISTS `subsciption` (
`id` int(7) NOT NULL,
  `mem_id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sub_type` varchar(100) NOT NULL,
  `paid_date` date NOT NULL,
  `expiry` date NOT NULL,
  `total` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `invoice` varchar(30) NOT NULL,
  `sub_type_name` text NOT NULL,
  `bal` int(11) NOT NULL,
  `exp_time` bigint(20) NOT NULL,
  `renewal` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subsciption`
--

INSERT INTO `subsciption` (`id`, `mem_id`, `name`, `sub_type`, `paid_date`, `expiry`, `total`, `paid`, `invoice`, `sub_type_name`, `bal`, `exp_time`, `renewal`) VALUES
(1, 1, 'sachin chikankar', 'XKCLTDSJ', '2017-05-08', '2017-05-19', 1500, 1000, '942495766ev', 'Monthly', 500, 1496049662, 'yes'),
(2, 2, 'vishnu nimbulkar', 'PTGWSHDJ', '2017-05-08', '2018-05-08', 15000, 15000, '94249806kpx', 'Year', 0, 1496049662, 'yes'),
(3, 3, 'sushil patukar', 'PUDTJFCW', '2017-05-10', '2017-11-06', 8000, 8000, '94395704g5p', 'Quarterly', 0, 1509906600, 'yes'),
(4, 4, 'nitin dhikde', 'XKCLTDSJ', '2017-05-10', '2017-06-09', 1500, 1000, '94396225ugz', 'Monthly', 500, 1496946600, 'yes'),
(5, 5, 'tushar dogare', 'XKCLTDSJ', '2017-05-10', '2017-06-09', 1500, 1500, '94396623kim', 'Monthly', 0, 1496946600, 'yes'),
(8, 6, 'hema baraparte', 'XKCLTDSJ', '2017-05-10', '2017-06-09', 1500, 1000, '943984492fx', 'Monthly', 500, 1496946600, 'yes'),
(9, 1495187019, 'demo', 'XKCLTDSJ', '2017-05-19', '2017-06-18', 1500, 1000, '9518816516q', 'Monthly', 500, 1497724200, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `time_table`
--

CREATE TABLE IF NOT EXISTS `time_table` (
`id` int(11) NOT NULL,
  `mem_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `details` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE IF NOT EXISTS `user_data` (
`id` int(7) NOT NULL,
  `wait` varchar(10) NOT NULL,
  `newid` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `zipcode` bigint(20) NOT NULL,
  `birthdate` date NOT NULL,
  `contact` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pic_add` varchar(255) NOT NULL,
  `height` float NOT NULL,
  `weight` int(11) NOT NULL,
  `nationality` text NOT NULL,
  `facebookaccount` text NOT NULL,
  `twitteraccount` text NOT NULL,
  `contactperson` text NOT NULL,
  `previousgym` text NOT NULL,
  `yearstraining` text NOT NULL,
  `joining` date NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `proof` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `wait`, `newid`, `name`, `address`, `zipcode`, `birthdate`, `contact`, `email`, `pic_add`, `height`, `weight`, `nationality`, `facebookaccount`, `twitteraccount`, `contactperson`, `previousgym`, `yearstraining`, `joining`, `age`, `sex`, `proof`) VALUES
(1, 'no', 1, 'sachin chikankar', 'Kamptee', 4410022, '2017-05-02', 8805531320, 'sachin@cluebix.com', '', 5.8, 60, 'indian', 'sachin@gmail.com', 'sachin@gmail.com', 'vishnu', 'fine fitness', '2016', '2017-05-08', 18, 'Male', 'Driving License'),
(2, 'no', 2, 'vishnu nimbulkar', 'kalmeshwar', 4410022, '2017-05-09', 9850731575, 'vishnu.cluebix@gmail.com', '', 5.7, 62, 'indian', 'vishnu.cluebix@gmail.com', 'vishnu.cluebix@gmail.com', 'vishnu.cluebix@gmail.com', 'gold gym', '2010', '2017-05-08', 18, 'Male', 'Passport'),
(3, 'no', 3, 'sushil patukar', 'nagpur', 440022, '2010-02-09', 8805531320, 'rutuja@gmail.com', '', 5.3, 50, 'indian', 'rutuja@gmail.com', 'rutuja@gmail.com', 'sachin', 'yesh', '2016', '2017-05-10', 20, 'Male', 'Driving License'),
(4, 'no', 4, 'nitin dhikde', 'nagpur', 441012, '2009-02-03', 9850731575, 'nitin@gmail.com', '', 5.8, 65, 'indian', 'nitin@gmail.com', 'nitin@gmail.com', 'sushil', 'gold gym', '2014', '2017-05-10', 25, 'Male', 'College/School ID'),
(5, 'no', 5, 'tushar dogare', 'nagpur', 445012, '1990-06-12', 9637515126, 'tushar@gmail.com', '', 5.3, 55, 'indian', 'tushar@gmail.com', 'tushar@gmail.com', 'vishnu', 'prnali', '4', '2017-05-10', 26, 'Male', 'Passport'),
(7, 'no', 6, 'hema baraparte', 'armori', 4410022, '1990-06-12', 9637515126, 'hema@gmail.com', 'images.jpg', 5.3, 50, 'indian', 'hema@gmail.com', 'hema@gmail.com', 'sushil', 'yesh', '2010', '2017-05-10', 18, 'Male', 'Passport'),
(8, 'no', 1495187019, '', '', 0, '0000-00-00', 0, '', '../images/1495187019.jpg', 0, 0, '', '', '', '', '', '', '0000-00-00', 0, '', ''),
(10, 'no', 1495517535, '', '', 0, '0000-00-00', 0, '', '../images/1495517535.jpg', 0, 0, '', '', '', '', '', '', '0000-00-00', 0, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_user`
--
ALTER TABLE `auth_user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `healthstatus`
--
ALTER TABLE `healthstatus`
 ADD PRIMARY KEY (`hs_id`);

--
-- Indexes for table `mem_types`
--
ALTER TABLE `mem_types`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subsciption`
--
ALTER TABLE `subsciption`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_table`
--
ALTER TABLE `time_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_user`
--
ALTER TABLE `auth_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mem_types`
--
ALTER TABLE `mem_types`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `subsciption`
--
ALTER TABLE `subsciption`
MODIFY `id` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `time_table`
--
ALTER TABLE `time_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
MODIFY `id` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
