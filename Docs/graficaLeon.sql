SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE `graficaLeon` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `graficaLeon`;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `customers` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`cuit` varchar(256) NULL,
`initDate` varchar(32) NULL,
`numGross_income` varchar(32) NULL,
`name` varchar(256) NOT NULL,
`lastName` varchar(256) NOT NULL,
`businessName` varchar(256) NULL,
`address` varchar(256) NOT NULL,
`city` varchar(32) NOT NULL,
`email` varchar(256) NULL,
`phone` varchar(32) NULL,
`cellPhone` varchar(32) NULL,
`userId` int(11) NOT NULL,
PRIMARY KEY (`id`),
KEY `userId`(`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `orders` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`date` varchar(32) NOT NULL,
`customerId` int(11) NOT NULL,
`description` varchar(2048) NULL,
`type` varchar(32) NOT NULL,
`state` varchar(32) NOT NULL,
`total` decimal(11,3) NOT NULL,
`advance` decimal(11,3) NULL,
`deliveryDate` varchar(32) NULL,
`amount` int(11) NOT NULL,
`paper` varchar(256) NULL,
`colorPaper` varchar(32) NULL,
`weight` int(11) NULL,
`machine` varchar(256) NULL,
`termination` varchar(2048) NULL,
`fromNumber` int(11) NULL,
`toNumber` int(11) NULL,
`observation` varchar(2048) NULL,
`userId` int(11) NOT NULL,
PRIMARY KEY (`id`),
KEY `customerId`(`customerId`),
KEY `userId`(`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `boxes` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`date` varchar(32) NOT NULL,
`description` varchar(256) NOT NULL,
`type` varchar(32) NOT NULL,
`value` decimal(11,3) NOT NULL,
`orderId` int(11) NULL,
`userId` int(11) NOT NULL,
PRIMARY KEY (`id`),
KEY `orderId`(`orderId`),
KEY `userId`(`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(32) NOT NULL,
`nick` varchar(32) NOT NULL,
`password` varchar(32) NOT NULL,
`lastAcces` varchar(32) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `images` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`page` varchar(128) NOT NULL,
`smallPath` varchar(128) NOT NULL,
`bigPath` varchar(128) NOT NULL,
`downloadPath` varchar(128) NULL,
`altText` varchar(128) NOT NULL,
`description` varchar(128) NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customers` (`id`),
ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `boxes`
--
ALTER TABLE `boxes`
ADD CONSTRAINT `boxes_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`),
ADD CONSTRAINT `boxes_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
;
