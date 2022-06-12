-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 13, 2022 at 01:59 AM
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertComment` (IN `commentt` TEXT, IN `recipeID` INT(10), IN `userID` INT(10))  BEGIN
    INSERT INTO reviews(
        reviewText,
        recipe_id,
        user_id
    )
VALUES(
    commentt,
    recipeID,
    userID );
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertGrocerieToFridge` (IN `grocerieName` VARCHAR(20), IN `grocerieAmount` INT(10), IN `emailAddress` VARCHAR(320), IN `fridgeName` VARCHAR(30))  BEGIN
insert into groceries(
    grocerieName,
    grocerieAmount,
    user_id,
    fridge_id
)
values(
    grocerieName,
    grocerieAmount,
	(select users.userID from users where users.email=emailAddress),
    (select f.fridgeID from fridges f where f.fridgeName=fridgeName)
);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertIngredient` (IN `recipeID` INT(10), IN `ingredientID` INT(10), IN `grAmount` INT(10))  BEGIN
    INSERT INTO ingredients(
        recipe_id,
        grocerie_id,
        amount
    )
VALUES(
    recipeID,
    ingredientID,
    grAmount);
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `makeNewRecipe` (IN `title` VARCHAR(40), IN `categoryID` INT(10), IN `mealID` VARCHAR(10), IN `estTime` VARCHAR(30), IN `userEmail` VARCHAR(320), IN `recipeImagePath` VARCHAR(255))  BEGIN
    INSERT INTO recipes(
        recipeTitle,
        category_id,
        meal_id,
        estTimeInMinutes,
        user_id,
        recipeImagePath
    )
VALUES(
    title,
    categoryID,
    mealID,
    estTime,
    (
        SELECT
        userID
    FROM
        users
    WHERE
        email = userEmail
	),
recipeImagePath);
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateUserData` (IN `newFirstName` VARCHAR(30), IN `newLastName` VARCHAR(40), IN `newPhoneNumber` VARCHAR(10), IN `newProfPicPath` VARCHAR(255), IN `oldEmail` VARCHAR(320))  BEGIN
    UPDATE users u
SET 
    u.firstName = newFirstName,
    u.lastName = newLastName,
    u.phoneNumber = newPhoneNumber,
    u.profilePicturePath = newProfPicPath
WHERE
    email=oldEmail;
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
,`grocerieUnit` enum('teaspoon','tablespoon','cup','ml','l','oz','g','piece')
,`groceriePicture` varchar(255)
,`userEmail` varchar(320)
,`fridgeName` varchar(30)
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
(53, 49),
(52, 58);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(10) UNSIGNED NOT NULL,
  `categoryName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`) VALUES
(2, 'Vegan'),
(5, 'Gluten free'),
(6, 'Normal'),
(8, 'Vegetarian');

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

--
-- Dumping data for table `fridgeowners`
--

INSERT INTO `fridgeowners` (`friOwnID`, `user_id`, `fridge_id`, `is_main_owner`) VALUES
(6, 47, 6, 1),
(7, 1, 7, 1),
(14, 1, 14, 1),
(15, 1, 15, 1),
(17, 58, 17, 1),
(18, 49, 18, 1),
(19, 1, 19, 1);

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
-- Dumping data for table `fridges`
--

INSERT INTO `fridges` (`fridgeID`, `fridgeName`, `user_id1`) VALUES
(6, 'modalfridge1', 47),
(7, 'fridge in restroom', 1),
(14, 'fridge in bathroom', 1),
(15, 'vw fridge', 1),
(17, 'goran fridge', 58),
(18, 'sladjan fridge', 49),
(19, 'fridge', 1);

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
-- Stand-in structure for view `groceriedata`
-- (See below for the actual view)
--
CREATE TABLE `groceriedata` (
`grocerieName` varchar(20)
,`grocerieAmount` int(10) unsigned
,`email` varchar(320)
,`fridgeName` varchar(30)
,`gpp` varchar(255)
);

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

--
-- Dumping data for table `groceries`
--

INSERT INTO `groceries` (`grocerieID`, `grocerieName`, `grocerieAmount`, `user_id`, `fridge_id`) VALUES
(3, 'Potato', 10, 47, 6),
(4, 'Apple', 10, 47, 6),
(5, 'Apple', 9, 47, 6),
(6, 'Banana', 6, 47, 6),
(7, 'Potato', 5, 1, 14),
(8, 'Melon', 7, 58, 17),
(9, 'Melon', 7, 1, 7),
(10, 'Tomato', 6, 1, 14),
(11, 'Melon', 9, 1, 7),
(12, 'Potato', 3, 1, 7);

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
(122, 1, '2022-05-04', '16:13:58'),
(123, 1, '2022-05-10', '14:32:35'),
(124, 47, '2022-05-10', '14:42:38'),
(125, 47, '2022-05-11', '14:09:07'),
(126, 47, '2022-05-11', '14:15:51'),
(127, 49, '2022-05-11', '22:01:23'),
(128, 47, '2022-05-12', '11:54:15'),
(129, 1, '2022-05-12', '11:58:01'),
(130, 1, '2022-05-12', '12:01:15'),
(131, 47, '2022-05-12', '12:04:54'),
(132, 1, '2022-05-13', '20:57:52'),
(133, 47, '2022-05-15', '17:13:37'),
(134, 1, '2022-05-15', '17:37:31'),
(135, 49, '2022-05-15', '17:38:49'),
(136, 1, '2022-05-15', '17:52:32'),
(137, 1, '2022-05-16', '16:55:59'),
(138, 49, '2022-05-16', '17:18:07'),
(139, 1, '2022-05-16', '17:35:17'),
(140, 1, '2022-05-17', '14:21:28'),
(141, 1, '2022-05-18', '10:27:21'),
(142, 1, '2022-05-18', '10:28:39'),
(143, 49, '2022-05-18', '11:02:16'),
(144, 1, '2022-05-18', '11:09:15'),
(145, 1, '2022-05-18', '21:38:15'),
(146, 1, '2022-05-18', '21:55:45'),
(147, 1, '2022-05-18', '22:15:23'),
(148, 1, '2022-05-20', '09:09:03'),
(149, 1, '2022-05-20', '09:22:41'),
(150, 47, '2022-05-20', '10:48:34'),
(151, 49, '2022-05-20', '10:53:07'),
(152, 47, '2022-05-20', '11:15:44'),
(153, 1, '2022-05-20', '11:17:38'),
(154, 47, '2022-05-20', '11:19:35'),
(155, 1, '2022-05-20', '11:23:45'),
(156, 47, '2022-05-20', '18:22:56'),
(157, 1, '2022-05-20', '18:43:25'),
(158, 1, '2022-05-23', '12:45:50'),
(159, 49, '2022-05-23', '13:44:19'),
(160, 47, '2022-05-23', '14:00:47'),
(161, 1, '2022-05-23', '14:17:23'),
(162, 1, '2022-05-25', '00:08:38'),
(163, 47, '2022-05-27', '21:08:04'),
(164, 1, '2022-05-27', '21:14:54'),
(165, 47, '2022-05-27', '21:28:38'),
(166, 1, '2022-05-27', '21:30:55'),
(167, 49, '2022-05-28', '12:20:38'),
(168, 49, '2022-05-28', '12:24:39'),
(169, 1, '2022-05-28', '12:54:55'),
(170, 1, '2022-05-31', '12:06:14'),
(171, 1, '2022-06-01', '14:14:49'),
(172, 49, '2022-06-01', '14:22:38'),
(173, 1, '2022-06-01', '14:23:23'),
(174, 47, '2022-06-02', '08:59:37'),
(175, 47, '2022-06-02', '21:00:14'),
(176, 1, '2022-06-06', '14:04:42'),
(177, 47, '2022-06-06', '14:49:50'),
(178, 1, '2022-06-06', '14:56:18'),
(179, 47, '2022-06-06', '15:02:05'),
(180, 1, '2022-06-08', '21:50:28'),
(181, 47, '2022-06-08', '21:55:07'),
(182, 1, '2022-06-09', '09:54:56'),
(183, 47, '2022-06-09', '10:27:09'),
(184, 1, '2022-06-09', '12:54:32'),
(186, 1, '2022-06-09', '13:30:37'),
(187, 47, '2022-06-09', '13:38:09'),
(188, 58, '2022-06-09', '14:19:04'),
(189, 58, '2022-06-09', '14:19:14'),
(190, 58, '2022-06-09', '14:37:01'),
(191, 1, '2022-06-09', '23:12:21'),
(192, 47, '2022-06-10', '09:06:04'),
(193, 1, '2022-06-10', '09:49:22'),
(194, 47, '2022-06-10', '10:13:53'),
(195, 49, '2022-06-10', '11:03:07'),
(196, 1, '2022-06-10', '11:04:37'),
(197, 1, '2022-06-10', '11:20:58'),
(198, 47, '2022-06-10', '11:54:09'),
(199, 1, '2022-06-10', '11:55:20'),
(200, 47, '2022-06-10', '11:58:23'),
(201, 1, '2022-06-12', '22:03:19'),
(202, 1, '2022-06-12', '23:28:40'),
(203, 1, '2022-06-12', '23:38:53'),
(204, 1, '2022-06-12', '23:50:20');

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
(5, 'dinner'),
(8, 'snack'),
(9, 'other');

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
  `numberOfViews` int(10) UNSIGNED DEFAULT 0,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `meal_id` int(10) UNSIGNED NOT NULL,
  `estTimeInMinutes` int(4) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `recipeImagePath` varchar(255) DEFAULT NULL,
  `approved` int(1) UNSIGNED NOT NULL,
  `dateOfApproval` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipeID`, `recipeTitle`, `numberOfViews`, `category_id`, `meal_id`, `estTimeInMinutes`, `user_id`, `recipeImagePath`, `approved`, `dateOfApproval`) VALUES
(4, 'Strudle', 0, 5, 3, 40, 1, 'images/recipeDoe.png', 0, '0000-00-00'),
(8, 'Burek', 0, 5, 5, 90, 47, 'recipePictures/62a2ee67f30d75.71914075.jpg', 0, '0000-00-00'),
(9, 'Pecenje', 0, NULL, 4, 240, 47, 'images/recipeDoe.png', 0, '0000-00-00'),
(10, 'French fries', 0, 6, 5, 50, 1, 'images/recipeDoe.png', 0, '0000-00-00'),
(11, 'Secerleme', 0, 8, 8, 49, 1, 'recipePictures/62a66f7e2f3778.20905851.jpg', 0, '0000-00-00'),
(12, 'recipe totjl', 0, 5, 3, 50, 1, 'images/recipeDoe.png', 0, '0000-00-00'),
(13, 'recipe totjl', 0, 5, 3, 50, 1, 'images/recipeDoe.png', 0, '0000-00-00'),
(14, 'recipe totjl', 0, 5, 3, 50, 1, 'images/recipeDoe.png', 0, '0000-00-00'),
(15, 'Medenjaci1', 0, 5, 4, 21, 1, 'images/recipeDoe.png', 0, '0000-00-00'),
(16, 'Medenjaci1', 0, 5, 4, 21, 1, 'images/recipeDoe.png', 0, '0000-00-00'),
(17, 'Oblande', 0, 2, 4, 32, 1, 'images/recipeDoe.png', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewID` int(10) UNSIGNED NOT NULL,
  `reviewText` text NOT NULL,
  `recipe_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `mark` enum('1','2','3','4','5') DEFAULT NULL,
  `allowed` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewID`, `reviewText`, `recipe_id`, `user_id`, `mark`, `allowed`) VALUES
(1, 'Burek je samo sa mesom...', 8, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roommates`
--

CREATE TABLE `roommates` (
  `rmID` int(10) UNSIGNED NOT NULL,
  `user1_id` int(10) UNSIGNED NOT NULL,
  `user2_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roommates`
--

INSERT INTO `roommates` (`rmID`, `user1_id`, `user2_id`) VALUES
(55, 1, 47),
(57, 47, 49),
(59, 1, 49);

-- --------------------------------------------------------

--
-- Table structure for table `suggestedgroceries`
--

CREATE TABLE `suggestedgroceries` (
  `suggGrocID` int(10) UNSIGNED NOT NULL,
  `suggGrocName` varchar(20) NOT NULL,
  `suggGrocUnit` enum('teaspoon','tablespoon','cup','ml','l','oz','g','piece') DEFAULT NULL,
  `groceriePicturePath` varchar(255) DEFAULT NULL,
  `price` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suggestedgroceries`
--

INSERT INTO `suggestedgroceries` (`suggGrocID`, `suggGrocName`, `suggGrocUnit`, `groceriePicturePath`, `price`) VALUES
(18, 'Apple', 'g', 'groceriePictures/62a1da7c1ec0f1.37340252.jpg', 0),
(19, 'Melon', 'g', 'groceriePictures/62a1da84414e80.73002618.jpg', 0),
(20, 'Potato', 'piece', 'groceriePictures/62a309532906e4.56498109.jpg', 0),
(21, 'Tomato', 'g', 'groceriePictures/62a3099b29a899.34159007.jpg', 0);

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
  `accType` enum('admin','user') NOT NULL,
  `wallet` int(10) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `lastName`, `phoneNumber`, `email`, `hashedPassword`, `country`, `city`, `profilePicturePath`, `verifyingCode`, `verified`, `accType`, `wallet`) VALUES
(1, 'Dragan', 'Jelic', '0649310515', 'dragan.02jelic@gmail.com', '$2y$10$lsT3VOjMJxn.64P8I21Lb.BHWqyrbs8s7YznQAizcxyu.sL8fTknS', '', '', 'profilePictures/6233aaffd0a6f5.27465359.jpg', 0, 1, 'admin', 0),
(47, 'Filip', 'Marjan', '0983333000', 'gagimanijak@outlook.com', '$2y$10$RtOilsZrz.sCP6DO0/YEpOazsM.8KdcrDw4DVEiFYNr4QeaeJb4Ci', '', '', 'profilePictures/62a314eb432ce2.19918756.jpg', 0, 1, 'user', 1190),
(49, 'Sladjan', 'Delibasic', '0645632514', 'janika7@janika.bal', '$2y$10$OumObfOTlf8AOU90vMV8quCgt.n67d4km1zI/lr9omTwcuRgpW8AO', '', '', 'profilePictures/62a308ec83c0c7.60858596.jpg', 0, 1, 'user', 900),
(58, 'Jovan', 'Lazic', '0987645767', 'rango@njacme.com', '$2y$10$Ky/7R.y71zUjkKgNplIr5egzfO0e44ppwTI/evAtRd.4vz38Gl4ua', '', '', 'profilePictures/62a1e6db4baf30.24675312.jpg', 0, 1, 'user', 0);

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `actualgroceries`  AS SELECT `gr`.`grocerieID` AS `grocerieID`, `gr`.`grocerieName` AS `grocerieName`, `gr`.`grocerieAmount` AS `grocerieAmount`, `sg`.`suggGrocUnit` AS `grocerieUnit`, `sg`.`groceriePicturePath` AS `groceriePicture`, `u`.`email` AS `userEmail`, `fr`.`fridgeName` AS `fridgeName` FROM (((`groceries` `gr` left join `suggestedgroceries` `sg` on(`gr`.`grocerieName` = `sg`.`suggGrocName`)) join `users` `u` on(`u`.`userID` = `gr`.`user_id`)) join `fridges` `fr` on(`fr`.`fridgeID` = `gr`.`fridge_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `fridgeusersall`
--
DROP TABLE IF EXISTS `fridgeusersall`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fridgeusersall`  AS SELECT `fo`.`friOwnID` AS `friOwnID`, `fri`.`fridgeName` AS `fridgeName`, `u`.`email` AS `email`, `fo`.`is_main_owner` AS `is_main_owner` FROM ((`fridgeowners` `fo` left join `users` `u` on(`u`.`userID` = `fo`.`user_id`)) left join `fridges` `fri` on(`fri`.`fridgeID` = `fo`.`fridge_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `groceriedata`
--
DROP TABLE IF EXISTS `groceriedata`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `groceriedata`  AS SELECT `gr`.`grocerieName` AS `grocerieName`, `gr`.`grocerieAmount` AS `grocerieAmount`, `u`.`email` AS `email`, `f`.`fridgeName` AS `fridgeName`, `sg`.`groceriePicturePath` AS `gpp` FROM (((`groceries` `gr` join `users` `u` on(`gr`.`user_id` = `u`.`userID`)) join `fridges` `f` on(`gr`.`fridge_id` = `f`.`fridgeID`)) join `suggestedgroceries` `sg` on(`gr`.`grocerieName` = `sg`.`suggGrocName`)) ;

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
  MODIFY `allowedUsersID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fridgeowners`
--
ALTER TABLE `fridgeowners`
  MODIFY `friOwnID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `fridges`
--
ALTER TABLE `fridges`
  MODIFY `fridgeID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `friendrequest`
--
ALTER TABLE `friendrequest`
  MODIFY `frireqID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `groceries`
--
ALTER TABLE `groceries`
  MODIFY `grocerieID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logevidence`
--
ALTER TABLE `logevidence`
  MODIFY `logID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `mealID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `passwordreset`
--
ALTER TABLE `passwordreset`
  MODIFY `pwdResetID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipeID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roommates`
--
ALTER TABLE `roommates`
  MODIFY `rmID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `suggestedgroceries`
--
ALTER TABLE `suggestedgroceries`
  MODIFY `suggGrocID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

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
  ADD CONSTRAINT `recipes_ibfk_2` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`mealID`),
  ADD CONSTRAINT `recipes_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `recipes_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `categories` (`categoryID`) ON DELETE SET NULL ON UPDATE CASCADE;

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
