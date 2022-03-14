-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2022 at 11:06 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `activatedaccounts`
--

CREATE TABLE `activatedaccounts` (
  `activationID` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `activationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `amounts`
--

CREATE TABLE `amounts` (
  `amID` int(10) UNSIGNED NOT NULL,
  `grocerie_id` int(10) UNSIGNED NOT NULL,
  `amount` int(10) NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `amount` int(10) NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL
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
-- Table structure for table `roommates`
--

CREATE TABLE `roommates` (
  `rmID` int(10) UNSIGNED NOT NULL,
  `user1_id` int(10) UNSIGNED NOT NULL,
  `user2_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unitID` int(10) UNSIGNED NOT NULL,
  `unitName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unitID`, `unitName`) VALUES
(1, 'gram'),
(2, 'kilogram'),
(3, 'liter'),
(4, 'piece');

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
  `profilePicturePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activatedaccounts`
--
ALTER TABLE `activatedaccounts`
  ADD PRIMARY KEY (`activationID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `amounts`
--
ALTER TABLE `amounts`
  ADD PRIMARY KEY (`amID`),
  ADD KEY `grocerie_id` (`grocerie_id`),
  ADD KEY `unit_id` (`unit_id`);

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
  ADD KEY `grocerie_id` (`grocerie_id`),
  ADD KEY `unit_id` (`unit_id`);

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
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipeID`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meal_id` (`meal_id`);

--
-- Indexes for table `roommates`
--
ALTER TABLE `roommates`
  ADD PRIMARY KEY (`rmID`),
  ADD KEY `user1_id` (`user1_id`),
  ADD KEY `user2_id` (`user2_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unitID`);

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
-- AUTO_INCREMENT for table `activatedaccounts`
--
ALTER TABLE `activatedaccounts`
  MODIFY `activationID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `amounts`
--
ALTER TABLE `amounts`
  MODIFY `amID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `logID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `mealID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipeID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roommates`
--
ALTER TABLE `roommates`
  MODIFY `rmID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unitID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activatedaccounts`
--
ALTER TABLE `activatedaccounts`
  ADD CONSTRAINT `activatedaccounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`);

--
-- Constraints for table `amounts`
--
ALTER TABLE `amounts`
  ADD CONSTRAINT `amounts_ibfk_1` FOREIGN KEY (`grocerie_id`) REFERENCES `groceries` (`grocerieID`),
  ADD CONSTRAINT `amounts_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unitID`);

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
  ADD CONSTRAINT `logevidence_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`);

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`categoryID`),
  ADD CONSTRAINT `recipes_ibfk_2` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`mealID`),
  ADD CONSTRAINT `recipes_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`);

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
