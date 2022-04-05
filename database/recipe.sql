-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2022 at 02:09 AM
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
    delete from passwordreset where pwdResetEmail = email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `resetPasswordWithoutDelete` (IN `pwd` VARCHAR(255), IN `selector` TEXT, IN `token` LONGTEXT)  BEGIN
    update users set hashedPassword = pwd where email = (select pwdResetEmail from passwordreset where pwdResetSelector = selector and pwdResetToken = token);
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
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `fridge_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fridges`
--

CREATE TABLE `fridges` (
  `fridgeID` int(10) UNSIGNED NOT NULL,
  `fridgeName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(16, 1, '2022-04-04', '16:26:02');

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

--
-- Dumping data for table `passwordreset`
--

INSERT INTO `passwordreset` (`pwdResetID`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpiringDate`) VALUES
(20, 'gagimanijak@outlook.com', '39b186e28917de3f', '$2y$10$4YEPpAl75j2QdK2JxBsMTOlnnlPG8mb3crF1jMTpSb7CJh7KvXFUq', '1649084039');

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
(47, 'Milos', 'Milivojevic', '0987287878', 'gagimanijak@outlook.com', '$2y$10$eziESqtpyUSh17ntD3uMCuGvL8tMSkYE1R.KaTdYEfCC95gOpaB6y', '', '', 'profilePictures/623cef07aef1a7.27172149.jpg', 0, 1, 'user');

-- --------------------------------------------------------

--
-- Structure for view `actualgroceries`
--
DROP TABLE IF EXISTS `actualgroceries`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `actualgroceries`  AS SELECT `g`.`grocerieID` AS `grocerieID`, `g`.`grocerieName` AS `grocerieName`, `g`.`grocerieAmount` AS `grocerieAmount`, `suggestedgroceries`.`suggGrocUnit` AS `suggGrocUnit`, `g`.`user_id` AS `user_id`, `g`.`fridge_id` AS `fridge_id` FROM (`groceries` `g` join `suggestedgroceries` on(`g`.`grocerieName` = `suggestedgroceries`.`suggGrocName`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `fridgeowners`
--
ALTER TABLE `fridgeowners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fridge_id` (`fridge_id`);

--
-- Indexes for table `fridges`
--
ALTER TABLE `fridges`
  ADD PRIMARY KEY (`fridgeID`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fridgeowners`
--
ALTER TABLE `fridgeowners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fridges`
--
ALTER TABLE `fridges`
  MODIFY `fridgeID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `logID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `mealID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `passwordreset`
--
ALTER TABLE `passwordreset`
  MODIFY `pwdResetID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `rmID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suggestedgroceries`
--
ALTER TABLE `suggestedgroceries`
  MODIFY `suggGrocID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fridgeowners`
--
ALTER TABLE `fridgeowners`
  ADD CONSTRAINT `fridgeowners_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `fridgeowners_ibfk_2` FOREIGN KEY (`fridge_id`) REFERENCES `fridges` (`fridgeID`);

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
