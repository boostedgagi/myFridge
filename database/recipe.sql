-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2022 at 04:34 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteTokenIfExists` (IN `email` VARCHAR(320))  BEGIN
delete from passwordreset where pwdResetEmail=email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertDataForPasswordRecovery` (IN `email` VARCHAR(320), IN `selector` TEXT, IN `token` LONGTEXT, IN `expires` VARCHAR(20))  BEGIN
    insert into passwordreset ( 
		pwdResetEmail,
    	pwdResetSelector,
    	pwdResetToken,
    	pwdResetExpiringDate
    )       
    values(
        email,
        selector,
        token,
        expires
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertNewFridge` (IN `fridgeNameByUser` VARCHAR(30), IN `emailAddress` VARCHAR(320))  BEGIN
insert into fridges(
    fridgeName,
    user_id1
)
values(
    fridgeNameByUser,
	(select users.userID from users where users.email=emailAddress)
);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertUsers` (IN `regFName` VARCHAR(30), IN `regLName` VARCHAR(40), IN `regPhone` VARCHAR(10), IN `regEmail` VARCHAR(320), IN `regHashPwd` VARCHAR(255), IN `regCountry` VARCHAR(30), IN `regCity` VARCHAR(20), IN `regProfPicPath` VARCHAR(255), IN `regVerCode` INT(10))  BEGIN
    insert into users (
        firstName,
        lastName,
        phoneNumber,
        email,
        hashedPassword,
        country,
        city,
        profilePicturePath,
        verifyingCode,
        accType    
)       
        values(
        regFName,
        regLname,
        regPhone,
        regEmail,
        regHashPwd,
        regCountry,
        regCity,
        regProfPicPath,
        regVerCode,
        'user'
        );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recordLog` (IN `emailAddress` VARCHAR(320))  BEGIN
insert into logevidence(
    user_id,
    logDate,
    logTime)
values(
	(select users.userID from users where users.email=emailAddress),
    (select CURDATE()),
    (select CURRENT_TIME)
);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `resetPasswordWithDelete` (IN `pwd` VARCHAR(255), IN `selector` TEXT, IN `token` LONGTEXT)  BEGIN
    update users set hashedPassword = pwd where email = (select pwdResetEmail from passwordreset where pwdResetSelector = selector and pwdResetToken = token);
    delete from passwordreset where pwdResetToken = token;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `resetPasswordWithoutDelete` (IN `pwd` VARCHAR(255), IN `selector` TEXT, IN `token` LONGTEXT)  BEGIN
    update users set hashedPassword = pwd where email = (select pwdResetEmail from passwordreset where pwdResetSelector = selector and pwdResetToken = token);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `returnAvailableUsersForRequest` (`currentUserEmail` VARCHAR(320))  BEGIN
 SELECT
    email
FROM
    users
WHERE NOT
    email = currentUserEmail
AND NOT 
	email IN(
    SELECT
        senderEmail
    FROM
        roommatestempfullemail
    WHERE
        senderEmail = currentUserEmail
);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sendRoommateRequest` (IN `senderEmail` VARCHAR(320), IN `receiverEmail` VARCHAR(320))  BEGIN
    insert into friendrequest(
        senderID,
        receiverID,
        ignored,
        requestDateTime
    )    
    values(
        (select userID from users where email = senderEmail),
        (select userID from users where email = receiverEmail),
        0,
        (select CURRENT_TIMESTAMP)
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verifyRegisteredUser` (IN `emailAddress` VARCHAR(320), IN `verificationCode` INT(10))  BEGIN
    UPDATE users SET verified=1, verifyingCode = 0 where email=emailAddress and verifyingCode=verificationCode;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `actualgroceries`
-- (See below for the actual view)
--
CREATE TABLE `actualgroceries` (
`grocerieID` int(10) unsigned
,`grocerieName` varchar(20)
,`grocerieAmount` int(10) unsigned
,`suggGrocUnit` enum('teaspoon','tablespoon','cup','ml','l','oz','g')
,`user_id` int(10) unsigned
,`fridge_id` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `allowedusers`
--

CREATE TABLE `allowedusers` (
  `allowedUsersID` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allowedusers`
--

INSERT INTO `allowedusers` (`allowedUsersID`, `user_id`) VALUES
(5, 1),
(8, 47),
(9, 49);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(10) UNSIGNED NOT NULL,
  `categoryName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fridgeowners`
--

CREATE TABLE `fridgeowners` (
  `friOwnID` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `fridge_id` int(10) UNSIGNED NOT NULL,
  `is_main_owner` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fridges`
--

CREATE TABLE `fridges` (
  `fridgeID` int(10) UNSIGNED NOT NULL,
  `fridgeName` varchar(30) NOT NULL,
  `user_id1` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `fridges`
--
DELIMITER $$
CREATE TRIGGER `cascadeFridgeDeletion` BEFORE DELETE ON `fridges` FOR EACH ROW BEGIN
    delete from fridgeowners where fridgeowners.fridge_id=OLD.fridgeID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertIntoFridgeOwnersAfterFridgeInsert` AFTER INSERT ON `fridges` FOR EACH ROW BEGIN
    INSERT INTO fridgeowners(user_id,fridge_id,is_main_owner)VALUES(NEW.user_id1, NEW.fridgeID, 1);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `fridgeusersall`
-- (See below for the actual view)
--
CREATE TABLE `fridgeusersall` (
`friOwnID` int(10) unsigned
,`fridgeName` varchar(30)
,`email` varchar(320)
,`is_main_owner` tinyint(1) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `friendrequest`
--

CREATE TABLE `friendrequest` (
  `frireqID` int(10) UNSIGNED NOT NULL,
  `senderID` int(10) UNSIGNED NOT NULL,
  `receiverID` int(10) UNSIGNED NOT NULL,
  `ignored` tinyint(1) UNSIGNED NOT NULL,
  `requestDateTime` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `friendrequest`
--
DELIMITER $$
CREATE TRIGGER `insertIntoRoommatesBeforeDeleteRequest` BEFORE DELETE ON `friendrequest` FOR EACH ROW BEGIN
    INSERT INTO roommates(user1_id,user2_id)
    VALUES(OLD.senderID,OLD.receiverID);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `grocerielocation`
--

CREATE TABLE `grocerielocation` (
  `grocLocID` int(10) UNSIGNED NOT NULL,
  `grocerie_id` int(10) UNSIGNED NOT NULL,
  `fridge_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `groceries`
--

CREATE TABLE `groceries` (
  `grocerieID` int(10) UNSIGNED NOT NULL,
  `grocerieName` varchar(20) NOT NULL,
  `grocerieAmount` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `fridge_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingID` int(10) UNSIGNED NOT NULL,
  `recipe_id` int(10) UNSIGNED NOT NULL,
  `grocerie_id` int(10) UNSIGNED NOT NULL,
  `amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logevidence`
--

CREATE TABLE `logevidence` (
  `logID` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `logDate` date NOT NULL,
  `logTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logevidence`
--

INSERT INTO `logevidence` (`logID`, `user_id`, `logDate`, `logTime`) VALUES
(1, 1, '2022-03-23', '17:18:40'),
(3, 47, '2022-03-24', '23:23:02'),
(4, 1, '2022-03-24', '23:23:16'),
(5, 1, '2022-03-24', '23:34:53'),
(6, 47, '2022-03-24', '23:44:08'),
(7, 47, '2022-03-26', '14:52:21'),
(8, 47, '2022-03-29', '15:22:49'),
(9, 47, '2022-04-02', '13:37:54'),
(10, 47, '2022-04-02', '13:48:27'),
(11, 47, '2022-04-04', '11:46:09'),
(12, 47, '2022-04-04', '12:24:23'),
(13, 1, '2022-04-04', '15:10:56'),
(14, 47, '2022-04-04', '15:11:16'),
(15, 47, '2022-04-04', '15:13:14'),
(16, 1, '2022-04-04', '16:26:02'),
(17, 47, '2022-04-05', '13:17:22'),
(18, 47, '2022-04-05', '13:22:22'),
(19, 47, '2022-04-05', '13:33:10'),
(20, 47, '2022-04-05', '13:38:49'),
(21, 47, '2022-04-05', '13:54:13'),
(22, 47, '2022-04-05', '14:38:52'),
(23, 47, '2022-04-05', '14:53:01'),
(24, 47, '2022-04-05', '15:58:47'),
(25, 47, '2022-04-05', '21:46:24'),
(26, 47, '2022-04-06', '14:59:43'),
(27, 1, '2022-04-06', '17:21:25'),
(28, 1, '2022-04-06', '17:23:21'),
(29, 47, '2022-04-06', '17:27:57'),
(30, 1, '2022-04-06', '17:35:16'),
(31, 47, '2022-04-06', '17:35:29'),
(32, 1, '2022-04-06', '17:37:40'),
(33, 1, '2022-04-07', '01:17:52'),
(34, 47, '2022-04-07', '01:18:00'),
(35, 1, '2022-04-07', '11:42:03'),
(36, 47, '2022-04-07', '11:42:23'),
(37, 47, '2022-04-13', '15:16:36'),
(38, 47, '2022-04-14', '12:21:23'),
(39, 47, '2022-04-17', '12:15:56'),
(40, 47, '2022-04-17', '13:13:20'),
(41, 47, '2022-04-17', '15:31:25'),
(42, 1, '2022-04-17', '15:45:31'),
(43, 1, '2022-04-17', '18:27:03'),
(44, 47, '2022-04-17', '18:27:29'),
(45, 1, '2022-04-17', '18:33:32'),
(46, 1, '2022-04-17', '18:33:45'),
(47, 47, '2022-04-17', '18:34:11'),
(48, 49, '2022-04-17', '23:33:19'),
(49, 1, '2022-04-17', '23:33:36'),
(50, 1, '2022-04-17', '23:33:56'),
(51, 49, '2022-04-18', '00:05:28'),
(52, 1, '2022-04-18', '00:05:40'),
(53, 47, '2022-04-18', '00:05:52'),
(54, 1, '2022-04-18', '00:06:05'),
(55, 49, '2022-04-18', '00:06:20'),
(56, 1, '2022-04-18', '00:06:30'),
(57, 47, '2022-04-18', '11:44:35'),
(58, 1, '2022-04-18', '11:45:03'),
(59, 1, '2022-04-18', '16:52:52'),
(60, 1, '2022-04-19', '15:25:29'),
(61, 1, '2022-04-19', '20:10:25'),
(62, 49, '2022-04-20', '10:13:20'),
(63, 47, '2022-04-20', '10:13:38'),
(64, 1, '2022-04-20', '10:13:55'),
(65, 47, '2022-04-20', '10:14:22'),
(66, 47, '2022-04-20', '10:15:42'),
(67, 1, '2022-04-20', '10:26:10'),
(68, 47, '2022-04-20', '13:29:56'),
(69, 1, '2022-04-20', '13:30:24'),
(70, 49, '2022-04-20', '13:31:56'),
(71, 47, '2022-04-20', '19:14:11'),
(72, 49, '2022-04-20', '19:15:30'),
(73, 1, '2022-04-21', '12:25:28'),
(74, 1, '2022-04-22', '13:45:32'),
(75, 49, '2022-04-22', '13:45:50'),
(76, 1, '2022-04-25', '22:20:10'),
(77, 49, '2022-04-25', '22:39:11'),
(78, 1, '2022-04-27', '11:59:09'),
(79, 49, '2022-04-27', '12:27:13'),
(80, 47, '2022-04-27', '12:38:33'),
(81, 49, '2022-04-27', '12:39:51'),
(82, 1, '2022-04-27', '12:43:52'),
(83, 49, '2022-04-27', '13:01:35'),
(84, 1, '2022-04-27', '13:11:13'),
(85, 1, '2022-04-27', '13:20:51'),
(86, 49, '2022-04-27', '13:24:54'),
(87, 1, '2022-04-27', '13:42:29'),
(88, 49, '2022-04-27', '13:43:30'),
(89, 1, '2022-04-27', '13:49:31'),
(90, 47, '2022-04-27', '14:04:36'),
(91, 1, '2022-04-27', '14:14:14'),
(92, 1, '2022-04-27', '14:16:09'),
(93, 49, '2022-04-27', '14:16:31'),
(94, 1, '2022-04-27', '14:21:41'),
(95, 49, '2022-04-27', '14:22:02'),
(96, 47, '2022-04-27', '14:29:37'),
(97, 49, '2022-04-27', '14:41:20'),
(98, 1, '2022-04-27', '14:49:54'),
(99, 1, '2022-04-27', '14:50:08'),
(100, 49, '2022-04-27', '14:57:06'),
(101, 1, '2022-04-27', '14:57:55'),
(102, 47, '2022-04-27', '14:59:57'),
(103, 1, '2022-04-27', '15:01:01'),
(104, 49, '2022-04-27', '17:40:52'),
(105, 1, '2022-04-27', '17:49:09'),
(106, 47, '2022-04-27', '17:49:46'),
(107, 1, '2022-04-27', '17:54:03'),
(108, 47, '2022-04-27', '18:06:59'),
(109, 49, '2022-04-29', '12:36:34'),
(110, 1, '2022-04-29', '12:36:51'),
(111, 47, '2022-04-29', '13:03:43'),
(112, 1, '2022-04-29', '13:06:34'),
(113, 47, '2022-04-29', '13:07:10'),
(114, 49, '2022-04-29', '14:16:07'),
(115, 1, '2022-04-29', '14:16:15'),
(116, 1, '2022-04-29', '17:52:07'),
(117, 1, '2022-04-29', '17:58:44'),
(118, 49, '2022-04-29', '18:04:10'),
(119, 1, '2022-04-29', '19:10:40'),
(120, 47, '2022-04-29', '19:11:16'),
(121, 49, '2022-04-29', '19:12:54'),
(122, 1, '2022-05-04', '16:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `mealID` int(10) UNSIGNED NOT NULL,
  `mealName` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`mealID`, `mealName`) VALUES
(3, 'breakfast'),
(4, 'lunch'),
(5, 'dinner');

-- --------------------------------------------------------

--
-- Table structure for table `passwordreset`
--

CREATE TABLE `passwordreset` (
  `pwdResetID` int(10) UNSIGNED NOT NULL,
  `pwdResetEmail` varchar(320) NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpiringDate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipeID` int(10) UNSIGNED NOT NULL,
  `recipeTitle` varchar(40) NOT NULL,
  `numberOfViews` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `meal_id` int(10) UNSIGNED NOT NULL,
  `estTimeInMinutes` int(4) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `recipeImagePath` varchar(255) DEFAULT NULL,
  `approved` int(1) UNSIGNED NOT NULL,
  `dateOfApproval` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewID` int(10) UNSIGNED NOT NULL,
  `reviewText` text NOT NULL,
  `recipe_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `mark` enum('1','2','3','4','5') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roommates`
--

CREATE TABLE `roommates` (
  `rmID` int(10) UNSIGNED NOT NULL,
  `user1_id` int(10) UNSIGNED NOT NULL,
  `user2_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `suggestedgroceries`
--

CREATE TABLE `suggestedgroceries` (
  `suggGrocID` int(10) UNSIGNED NOT NULL,
  `suggGrocName` varchar(25) NOT NULL,
  `suggGrocUnit` enum('teaspoon','tablespoon','cup','ml','l','oz','g') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(10) UNSIGNED NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `email` varchar(320) NOT NULL,
  `hashedPassword` varchar(255) NOT NULL,
  `country` varchar(30) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `profilePicturePath` varchar(255) DEFAULT NULL,
  `verifyingCode` int(10) UNSIGNED DEFAULT NULL,
  `verified` int(1) UNSIGNED DEFAULT NULL,
  `accType` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `lastName`, `phoneNumber`, `email`, `hashedPassword`, `country`, `city`, `profilePicturePath`, `verifyingCode`, `verified`, `accType`) VALUES
(1, 'Dragan', 'Jelic', '0649310515', 'dragan.02jelic@gmail.com', '$2y$10$lsT3VOjMJxn.64P8I21Lb.BHWqyrbs8s7YznQAizcxyu.sL8fTknS', '', '', 'profilePictures/6233aaffd0a6f5.27465359.jpg', 0, 1, 'admin'),
(47, 'Milos', 'Milivojevic', '0987287878', 'gagimanijak@outlook.com', '$2y$10$volp8.3HbF1dxdoqDoTWHuT0vTzzAJ9bGSbsPz.drcn5C89vnchzq', '', '', 'profilePictures/623cef07aef1a7.27172149.jpg', 0, 1, 'user'),
(49, 'Janika', 'Balaz', '0909876767', 'janika7@janika.bal', '$2y$10$OumObfOTlf8AOU90vMV8quCgt.n67d4km1zI/lr9omTwcuRgpW8AO', '', '', 'profilePictures/625c86b1ec3701.04899110.jpg', 0, 1, 'user');

-- --------------------------------------------------------

--
-- Stand-in structure for view `usersallowedbyadmin`
-- (See below for the actual view)
--
CREATE TABLE `usersallowedbyadmin` (
`email` varchar(320)
,`user_id` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Structure for view `actualgroceries`
--
DROP TABLE IF EXISTS `actualgroceries`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `actualgroceries`  AS SELECT `g`.`grocerieID` AS `grocerieID`, `g`.`grocerieName` AS `grocerieName`, `g`.`grocerieAmount` AS `grocerieAmount`, `suggestedgroceries`.`suggGrocUnit` AS `suggGrocUnit`, `g`.`user_id` AS `user_id`, `g`.`fridge_id` AS `fridge_id` FROM (`groceries` `g` join `suggestedgroceries` on(`g`.`grocerieName` = `suggestedgroceries`.`suggGrocName`)) ;

-- --------------------------------------------------------

--
-- Structure for view `fridgeusersall`
--
DROP TABLE IF EXISTS `fridgeusersall`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fridgeusersall`  AS SELECT `fo`.`friOwnID` AS `friOwnID`, `fri`.`fridgeName` AS `fridgeName`, `u`.`email` AS `email`, `fo`.`is_main_owner` AS `is_main_owner` FROM ((`fridgeowners` `fo` left join `users` `u` on(`u`.`userID` = `fo`.`user_id`)) left join `fridges` `fri` on(`fri`.`fridgeID` = `fo`.`fridge_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `usersallowedbyadmin`
--
DROP TABLE IF EXISTS `usersallowedbyadmin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `usersallowedbyadmin`  AS SELECT `u`.`email` AS `email`, `allowedusers`.`user_id` AS `user_id` FROM (`users` `u` join `allowedusers` on(`u`.`userID` = `allowedusers`.`user_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowedusers`
--
ALTER TABLE `allowedusers`
  ADD PRIMARY KEY (`allowedUsersID`),
  ADD UNIQUE KEY `user_id_2` (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `fridgeowners`
--
ALTER TABLE `fridgeowners`
  ADD PRIMARY KEY (`friOwnID`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fridge_id` (`fridge_id`);

--
-- Indexes for table `fridges`
--
ALTER TABLE `fridges`
  ADD PRIMARY KEY (`fridgeID`),
  ADD KEY `user_id` (`user_id1`);

--
-- Indexes for table `friendrequest`
--
ALTER TABLE `friendrequest`
  ADD PRIMARY KEY (`frireqID`);

--
-- Indexes for table `grocerielocation`
--
ALTER TABLE `grocerielocation`
  ADD PRIMARY KEY (`grocLocID`),
  ADD KEY `user_id` (`grocerie_id`),
  ADD KEY `fridge_id` (`fridge_id`);

--
-- Indexes for table `groceries`
--
ALTER TABLE `groceries`
  ADD PRIMARY KEY (`grocerieID`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fridge_id` (`fridge_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingID`),
  ADD KEY `recipe_id` (`recipe_id`),
  ADD KEY `grocerie_id` (`grocerie_id`);

--
-- Indexes for table `logevidence`
--
ALTER TABLE `logevidence`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`mealID`);

--
-- Indexes for table `passwordreset`
--
ALTER TABLE `passwordreset`
  ADD PRIMARY KEY (`pwdResetID`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipeID`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meal_id` (`meal_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewID`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `roommates`
--
ALTER TABLE `roommates`
  ADD PRIMARY KEY (`rmID`),
  ADD KEY `user1_id` (`user1_id`),
  ADD KEY `user2_id` (`user2_id`);

--
-- Indexes for table `suggestedgroceries`
--
ALTER TABLE `suggestedgroceries`
  ADD PRIMARY KEY (`suggGrocID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allowedusers`
--
ALTER TABLE `allowedusers`
  MODIFY `allowedUsersID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fridgeowners`
--
ALTER TABLE `fridgeowners`
  MODIFY `friOwnID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fridges`
--
ALTER TABLE `fridges`
  MODIFY `fridgeID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `friendrequest`
--
ALTER TABLE `friendrequest`
  MODIFY `frireqID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `grocerielocation`
--
ALTER TABLE `grocerielocation`
  MODIFY `grocLocID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groceries`
--
ALTER TABLE `groceries`
  MODIFY `grocerieID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logevidence`
--
ALTER TABLE `logevidence`
  MODIFY `logID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `mealID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `passwordreset`
--
ALTER TABLE `passwordreset`
  MODIFY `pwdResetID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipeID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roommates`
--
ALTER TABLE `roommates`
  MODIFY `rmID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `suggestedgroceries`
--
ALTER TABLE `suggestedgroceries`
  MODIFY `suggGrocID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allowedusers`
--
ALTER TABLE `allowedusers`
  ADD CONSTRAINT `allowedusers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fridgeowners`
--
ALTER TABLE `fridgeowners`
  ADD CONSTRAINT `fridgeowners_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `fridgeowners_ibfk_2` FOREIGN KEY (`fridge_id`) REFERENCES `fridges` (`fridgeID`);

--
-- Constraints for table `fridges`
--
ALTER TABLE `fridges`
  ADD CONSTRAINT `fridges_ibfk_1` FOREIGN KEY (`user_id1`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grocerielocation`
--
ALTER TABLE `grocerielocation`
  ADD CONSTRAINT `grocerielocation_ibfk_1` FOREIGN KEY (`grocerie_id`) REFERENCES `groceries` (`grocerieID`),
  ADD CONSTRAINT `grocerielocation_ibfk_2` FOREIGN KEY (`fridge_id`) REFERENCES `fridges` (`fridgeID`);

--
-- Constraints for table `groceries`
--
ALTER TABLE `groceries`
  ADD CONSTRAINT `groceries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `groceries_ibfk_2` FOREIGN KEY (`fridge_id`) REFERENCES `fridges` (`fridgeID`);

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`grocerie_id`) REFERENCES `groceries` (`grocerieID`),
  ADD CONSTRAINT `ingredients_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipeID`);

--
-- Constraints for table `logevidence`
--
ALTER TABLE `logevidence`
  ADD CONSTRAINT `logevidence_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`categoryID`),
  ADD CONSTRAINT `recipes_ibfk_2` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`mealID`),
  ADD CONSTRAINT `recipes_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roommates`
--
ALTER TABLE `roommates`
  ADD CONSTRAINT `roommates_ibfk_1` FOREIGN KEY (`user1_id`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `roommates_ibfk_2` FOREIGN KEY (`user2_id`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
