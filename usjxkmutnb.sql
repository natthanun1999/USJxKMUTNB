-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2020 at 09:25 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usjxkmutnb`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `Sell_Ticket` (`type` VARCHAR(10)) RETURNS VARCHAR(10) CHARSET utf8 COLLATE utf8_bin BEGIN
  #Routine body goes here...
	DECLARE idle_ticket INT;
	
	SELECT AMOUNT INTO idle_ticket FROM ticket_idle WHERE ticket_idle.`TYPE_ID` = type;
	
		IF (idle_ticket > 0) THEN
			RETURN 'Sell';
		ELSE
			RETURN 'Idle';
		END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `USER_ID` varchar(4) COLLATE utf8_bin NOT NULL,
  `USERNAME` varchar(30) COLLATE utf8_bin NOT NULL,
  `PASSWORD` varchar(30) COLLATE utf8_bin NOT NULL,
  `STATUS_ID` int(3) DEFAULT NULL,
  `MONEY` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`USER_ID`, `USERNAME`, `PASSWORD`, `STATUS_ID`, `MONEY`) VALUES
('9999', '9999', '9999', 99, '0.00'),
('AF15', 'user01', '1234', 1, '0.00'),
('C1I8', 'user04', '1234', 1, '0.00'),
('GHUP', 'user03', '1234', 1, '0.00'),
('HJ72', 'user02', '1234', 1, '0.00'),
('WZ48', 'admin', '1234', 99, '49410.00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `adult_idle`
-- (See below for the actual view)
--
CREATE TABLE `adult_idle` (
`TICKET_ID` varchar(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `children_idle`
-- (See below for the actual view)
--
CREATE TABLE `children_idle` (
`TICKET_ID` varchar(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `seniors_idle`
-- (See below for the actual view)
--
CREATE TABLE `seniors_idle` (
`TICKET_ID` varchar(6)
);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `STATUS_ID` int(3) NOT NULL,
  `STATUS_NAME` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`STATUS_ID`, `STATUS_NAME`) VALUES
(1, 'Member'),
(99, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `TICKET_ID` varchar(6) COLLATE utf8_bin NOT NULL,
  `TYPE_ID` int(2) DEFAULT NULL,
  `TICKET_STATUS` varchar(10) COLLATE utf8_bin NOT NULL,
  `USER_ID` varchar(4) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`TICKET_ID`, `TYPE_ID`, `TICKET_STATUS`, `USER_ID`) VALUES
('AL1855', 3, 'Sell', 'WZ48'),
('BD9131', 2, 'Sell', 'WZ48'),
('HE2158', 2, 'Sell', 'WZ48'),
('HQ1248', 3, 'Sell', 'WZ48'),
('JR4541', 1, 'Sell', 'WZ48'),
('SB1590', 1, 'Idle', '9999'),
('YW2154', 3, 'Idle', '9999');

-- --------------------------------------------------------

--
-- Stand-in structure for view `ticket_idle`
-- (See below for the actual view)
--
CREATE TABLE `ticket_idle` (
`TYPE_ID` int(2)
,`NAME` varchar(30)
,`PRICE` decimal(10,2)
,`AMOUNT` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `ticket_sell`
-- (See below for the actual view)
--
CREATE TABLE `ticket_sell` (
`TYPE_ID` int(2)
,`NAME` varchar(30)
,`PRICE` decimal(10,2)
,`AMOUNT` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_type`
--

CREATE TABLE `ticket_type` (
  `TYPE_ID` int(2) NOT NULL,
  `TYPE_NAME` varchar(30) COLLATE utf8_bin NOT NULL,
  `TYPE_PRICE` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ticket_type`
--

INSERT INTO `ticket_type` (`TYPE_ID`, `TYPE_NAME`, `TYPE_PRICE`) VALUES
(1, 'Adult', '68.00'),
(2, 'Children', '48.00'),
(3, 'Seniors', '62.00');

-- --------------------------------------------------------

--
-- Structure for view `adult_idle`
--
DROP TABLE IF EXISTS `adult_idle`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `adult_idle`  AS  select `ticket`.`TICKET_ID` AS `TICKET_ID` from `ticket` where ((`ticket`.`TYPE_ID` = '1') and (`ticket`.`TICKET_STATUS` = 'Idle')) ;

-- --------------------------------------------------------

--
-- Structure for view `children_idle`
--
DROP TABLE IF EXISTS `children_idle`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `children_idle`  AS  select `ticket`.`TICKET_ID` AS `TICKET_ID` from `ticket` where ((`ticket`.`TYPE_ID` = '2') and (`ticket`.`TICKET_STATUS` = 'Idle')) ;

-- --------------------------------------------------------

--
-- Structure for view `seniors_idle`
--
DROP TABLE IF EXISTS `seniors_idle`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `seniors_idle`  AS  select `ticket`.`TICKET_ID` AS `TICKET_ID` from `ticket` where ((`ticket`.`TYPE_ID` = '3') and (`ticket`.`TICKET_STATUS` = 'Idle')) ;

-- --------------------------------------------------------

--
-- Structure for view `ticket_idle`
--
DROP TABLE IF EXISTS `ticket_idle`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ticket_idle`  AS  select `ticket_type`.`TYPE_ID` AS `TYPE_ID`,`ticket_type`.`TYPE_NAME` AS `NAME`,`ticket_type`.`TYPE_PRICE` AS `PRICE`,count(if((`ticket`.`TICKET_STATUS` = 'Idle'),1,NULL)) AS `AMOUNT` from (`ticket` join `ticket_type` on((`ticket`.`TYPE_ID` = `ticket_type`.`TYPE_ID`))) group by `ticket_type`.`TYPE_NAME` ;

-- --------------------------------------------------------

--
-- Structure for view `ticket_sell`
--
DROP TABLE IF EXISTS `ticket_sell`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ticket_sell`  AS  select `ticket_type`.`TYPE_ID` AS `TYPE_ID`,`ticket_type`.`TYPE_NAME` AS `NAME`,`ticket_type`.`TYPE_PRICE` AS `PRICE`,count(if((`ticket`.`TICKET_STATUS` = 'Sell'),1,NULL)) AS `AMOUNT` from (`ticket` join `ticket_type` on((`ticket`.`TYPE_ID` = `ticket_type`.`TYPE_ID`))) group by `ticket_type`.`TYPE_NAME` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`USER_ID`) USING BTREE,
  ADD KEY `STATUS` (`STATUS_ID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`STATUS_ID`) USING BTREE;

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`TICKET_ID`),
  ADD KEY `OWNER` (`USER_ID`),
  ADD KEY `TYPE_ID` (`TYPE_ID`);

--
-- Indexes for table `ticket_type`
--
ALTER TABLE `ticket_type`
  ADD PRIMARY KEY (`TYPE_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `STATUS` FOREIGN KEY (`STATUS_ID`) REFERENCES `status` (`STATUS_ID`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `OWNER` FOREIGN KEY (`USER_ID`) REFERENCES `account` (`USER_ID`),
  ADD CONSTRAINT `TYPE_ID` FOREIGN KEY (`TYPE_ID`) REFERENCES `ticket_type` (`TYPE_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
