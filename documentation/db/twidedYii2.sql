-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2017 at 02:17 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twidedYii2`
--

-- --------------------------------------------------------

--
-- Table structure for table `ActivateAccount`
--

CREATE TABLE `ActivateAccount` (
  `userId` int(11) NOT NULL COMMENT 'the user in qtn',
  `activateUrl` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ActivateAccount`
--

INSERT INTO `ActivateAccount` (`userId`, `activateUrl`, `status`) VALUES
(24, 'http://localhost/twided/web/index.php?r=site%2Factivate-account&id=OichQNqUrkzF3lM&twisup=24&ded24twi=odgzrBkrlp6n7Jh', 1),
(25, 'http://localhost/twided/web/index.php/site/activate-account?id=w_0k4BIg4oplJ31&twisup=25&ded24twi=sOq0jyh4AMmac9v', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ClassMember`
--

CREATE TABLE `ClassMember` (
  `userId` int(11) NOT NULL,
  `classroomId` int(11) NOT NULL,
  `status` enum('F','D','L','') NOT NULL DEFAULT 'F' COMMENT 'F=floor member, D=delegate, L=lecturer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='a user belongs to a class';

-- --------------------------------------------------------

--
-- Table structure for table `Classroom`
--

CREATE TABLE `Classroom` (
  `classroomId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL COMMENT 'class description',
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ContactMessage`
--

CREATE TABLE `ContactMessage` (
  `ContactMessageId` int(11) NOT NULL,
  `parentId` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `body` text NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ContactMessage`
--

INSERT INTO `ContactMessage` (`ContactMessageId`, `parentId`, `name`, `email`, `subject`, `body`, `dateCreated`) VALUES
(1, 0, 'Typedef', 'nembosteph@gmail.com', 'Testing sturfs', 'Haha yii2 over fine men', '2017-06-27 14:04:50'),
(2, 0, 'Blessing', 'nanyi@gmail.com', 'Good Job', 'Good job dudes', '2017-06-27 14:07:42'),
(3, 0, 'Lil Kesh', 'lilkesh@yahoo.com', 'No fake love', 'Love me now or never', '2017-06-27 14:23:25'),
(4, 0, 'Maahlox', 'maahlox@gmail.com', 'Les Sorciers', 'Tuer pour tuer', '2017-06-27 14:32:12'),
(5, 0, 'Nges B', 'nges@ha.com', 'Match up', 'Briono man on d beat', '2017-06-27 15:15:31'),
(6, 0, 'Kedjivera dj', 'kedj@gmail.com', 'Remue la boteil', 'Ce show ici', '2017-06-27 18:12:40'),
(7, 0, 'Blessing', 'nanyi@gmail.com', 'Testing changes', 'A hear', '2017-06-27 21:51:28'),
(8, 0, 'Timaya', 'tima@gmail.com', 'R u done talking baby girl', 'Money fall on u, ....', '2017-06-29 11:12:40'),
(9, 0, 'Typedef', 'nembosteph@gmail.com', 'Testing a sweet girl', 'Wow girls can b god eh', '2017-07-09 04:02:20');

-- --------------------------------------------------------

--
-- Table structure for table `Countries`
--

CREATE TABLE `Countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Countries`
--

INSERT INTO `Countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People''s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People''s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZR', 'Zaire'),
(244, 'ZM', 'Zambia'),
(245, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `LastVisited`
--

CREATE TABLE `LastVisited` (
  `userId` int(11) NOT NULL COMMENT 'the user in qtn',
  `type` enum('C','G','P','') NOT NULL COMMENT 'whether user last visited a class or a studyGroup or a person, C=class,  G=group, P=person',
  `typeId` int(11) NOT NULL COMMENT 'id of the class or studyGroup or person'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Message`
--

CREATE TABLE `Message` (
  `messageId` int(11) NOT NULL COMMENT 'message id',
  `senderId` int(11) NOT NULL COMMENT 'sender''s user id',
  `recieverId` int(11) NOT NULL COMMENT 'reciever''s user id',
  `message` longtext NOT NULL COMMENT 'message itself',
  `isRead` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'if msg has been read by reciever',
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'creatn date of message'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PasswordReset`
--

CREATE TABLE `PasswordReset` (
  `idPasswordReset` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `resetUrl` varchar(200) NOT NULL,
  `isExpired` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PasswordReset`
--

INSERT INTO `PasswordReset` (`idPasswordReset`, `userId`, `resetUrl`, `isExpired`) VALUES
(1, 24, 'http://localhost/twided/web/index.php?r=site%2Fmail-password-reset&id=GZOBpuiB9mUIqcx&psupa=24&kol24=1&kunjaka=uvcLRCmVeRLrFaf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `StudyGroup`
--

CREATE TABLE `StudyGroup` (
  `studyGroupId` int(11) NOT NULL COMMENT 'group id',
  `name` varchar(100) NOT NULL COMMENT 'group name',
  `description` text,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date of creation'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `StudyGroupMember`
--

CREATE TABLE `StudyGroupMember` (
  `userId` int(11) NOT NULL COMMENT 'member''s user id',
  `studyGroupId` int(11) NOT NULL COMMENT 'group id',
  `status` enum('F','A','C') NOT NULL DEFAULT 'F' COMMENT 'F=floor member, A=admin, C=creator'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `userId` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL COMMENT 'email',
  `phoneNumber` varchar(15) DEFAULT NULL COMMENT 'contact',
  `password` varchar(60) NOT NULL COMMENT 'user''s password',
  `userType` enum('L','S','A','') NOT NULL COMMENT 'S=student, L=lecturer, A=admin',
  `secreteQtn` int(11) DEFAULT NULL,
  `secreteAns` varchar(20) DEFAULT NULL,
  `userUrl` varchar(100) NOT NULL,
  `country` int(11) NOT NULL DEFAULT '37',
  `lastAction` varchar(100) NOT NULL DEFAULT 'Sign up' COMMENT 'last thing the user did on the site',
  `lastActionTime` datetime DEFAULT NULL COMMENT 'time of last action',
  `lastRequestTime` time DEFAULT NULL COMMENT 'time of most recent request like a page reload',
  `signUpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date of account creation'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`userId`, `userName`, `email`, `phoneNumber`, `password`, `userType`, `secreteQtn`, `secreteAns`, `userUrl`, `country`, `lastAction`, `lastActionTime`, `lastRequestTime`, `signUpDate`) VALUES
(24, 'Typedef', 'nembosteph@gmail.com', NULL, '$2y$13$5JOHsClPVBkYLg6i0boj7u8lbV.64fJ6rnzI7txRW/mkTWX2hxIJS', 'S', 1, 'HCI', 'Typedef', 37, 'Sign up', NULL, NULL, '2017-07-09 06:16:11'),
(25, 'Damen', 'damen@gmail.com', NULL, '$2y$13$JHoeLHpQFYX.HA.GBX4xhuT9JCuutllae6i8v8dem9wgLooT7FY4C', 'L', NULL, NULL, 'Damen', 37, 'Sign up', NULL, NULL, '2017-07-10 23:25:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ActivateAccount`
--
ALTER TABLE `ActivateAccount`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `ClassMember`
--
ALTER TABLE `ClassMember`
  ADD PRIMARY KEY (`userId`,`classroomId`);

--
-- Indexes for table `Classroom`
--
ALTER TABLE `Classroom`
  ADD PRIMARY KEY (`classroomId`);

--
-- Indexes for table `ContactMessage`
--
ALTER TABLE `ContactMessage`
  ADD PRIMARY KEY (`ContactMessageId`);

--
-- Indexes for table `Countries`
--
ALTER TABLE `Countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `LastVisited`
--
ALTER TABLE `LastVisited`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `Message`
--
ALTER TABLE `Message`
  ADD PRIMARY KEY (`messageId`);

--
-- Indexes for table `PasswordReset`
--
ALTER TABLE `PasswordReset`
  ADD PRIMARY KEY (`idPasswordReset`),
  ADD KEY `User_pid` (`userId`);

--
-- Indexes for table `StudyGroup`
--
ALTER TABLE `StudyGroup`
  ADD PRIMARY KEY (`studyGroupId`);

--
-- Indexes for table `StudyGroupMember`
--
ALTER TABLE `StudyGroupMember`
  ADD PRIMARY KEY (`studyGroupId`,`userId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `userUrl` (`userUrl`),
  ADD UNIQUE KEY `phoneNumber` (`phoneNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Classroom`
--
ALTER TABLE `Classroom`
  MODIFY `classroomId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ContactMessage`
--
ALTER TABLE `ContactMessage`
  MODIFY `ContactMessageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `Countries`
--
ALTER TABLE `Countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `Message`
--
ALTER TABLE `Message`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'message id';
--
-- AUTO_INCREMENT for table `PasswordReset`
--
ALTER TABLE `PasswordReset`
  MODIFY `idPasswordReset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `StudyGroup`
--
ALTER TABLE `StudyGroup`
  MODIFY `studyGroupId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'group id';
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ActivateAccount`
--
ALTER TABLE `ActivateAccount`
  ADD CONSTRAINT `ActivateAccount_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `User` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ClassMember`
--
ALTER TABLE `ClassMember`
  ADD CONSTRAINT `ClassMember_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `User` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `LastVisited`
--
ALTER TABLE `LastVisited`
  ADD CONSTRAINT `LastVisited_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `User` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `PasswordReset`
--
ALTER TABLE `PasswordReset`
  ADD CONSTRAINT `PasswordReset_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `User` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `StudyGroupMember`
--
ALTER TABLE `StudyGroupMember`
  ADD CONSTRAINT `StudyGroupMember_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `User` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
