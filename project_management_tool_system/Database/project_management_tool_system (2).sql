-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 11:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_management_tool_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `AssignmentID` int(11) NOT NULL,
  `TaskID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`AssignmentID`, `TaskID`, `UserID`) VALUES
(0, 1, 7),
(1, 1, 7),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `AttachmentID` int(11) NOT NULL,
  `TaskID` int(11) DEFAULT NULL,
  `FileName` varchar(255) DEFAULT NULL,
  `FilePath` varchar(255) DEFAULT NULL,
  `UploadDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`AttachmentID`, `TaskID`, `FileName`, `FilePath`, `UploadDate`) VALUES
(1, 3, 'road', 'ggg', '2024-05-07 00:00:00'),
(2, 3, 'fff', 'abcd', '2024-05-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `BudgetID` int(11) NOT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `BudgetName` varchar(255) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`BudgetID`, `ProjectID`, `BudgetName`, `Amount`, `StartDate`, `EndDate`) VALUES
(1, 2, 'budget for school construction', 5000000.00, '2024-05-01', '2024-05-31'),
(2, 1, 'office building', 7000000.00, '2024-05-01', '2024-06-07'),
(3, 2, 'ddff', 6900000.00, '2024-05-01', '2024-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `ExpenseID` int(11) NOT NULL,
  `BudgetID` int(11) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `ExpenseDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`ExpenseID`, `BudgetID`, `Amount`, `ExpenseDate`) VALUES
(1, 2, 12000000.99, '2024-05-01'),
(2, 2, 50000000.00, '2024-05-02'),
(3, 3, 40000000.00, '2024-05-01'),
(4, 2, 7000000.00, '2024-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `MeetingID` int(11) NOT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `MeetingName` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`MeetingID`, `ProjectID`, `MeetingName`, `Description`, `StartTime`, `EndTime`, `Location`) VALUES
(1, 2, 'teammeating', 'this meetings will starts', '22:03:00', '22:06:00', 'RUHANGO'),
(2, 0, 'workersmeeting', 'this meeting talks about how to improve workers', '18:58:00', '18:00:00', 'RUBavu'),
(3, 2, 'ff', 'dd', '21:10:00', '21:10:00', 'dddd');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `ProjectID` int(11) NOT NULL,
  `ProjectName` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`ProjectID`, `ProjectName`, `Description`, `StartDate`, `EndDate`, `Status`) VALUES
(0, NULL, 'eee', '2024-05-01', '2024-05-31', 'kkk'),
(1, NULL, 'gt', '2024-04-30', '2024-05-31', 'gt'),
(2, NULL, 'office building', '2024-05-01', '2024-05-31', 'enginner'),
(3, '0', NULL, '0000-00-00', '2024-05-08', 'HHHH'),
(5, '0', NULL, '0000-00-00', '2024-04-30', 'FF'),
(6, 'food ordering', 'very good project', '2024-05-01', '2024-05-31', 'ttt'),
(7, 'road construction', 'yy', '2024-05-01', '2024-05-20', 'yy');

-- --------------------------------------------------------

--
-- Table structure for table `taskcomments`
--

CREATE TABLE `taskcomments` (
  `CommentID` int(11) NOT NULL,
  `TaskID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CommentText` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taskcomments`
--

INSERT INTO `taskcomments` (`CommentID`, `TaskID`, `UserID`, `CommentText`) VALUES
(1, 3, 1, 'abcd'),
(2, 3, 7, 'work is been done well'),
(3, 3, 9, 'work is been done well'),
(4, 3, 9, 'work is been done well');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `TaskID` int(11) NOT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `TaskName` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `AssignedTo` int(11) DEFAULT NULL,
  `DueDate` date DEFAULT NULL,
  `Priority` varchar(50) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`TaskID`, `ProjectID`, `TaskName`, `Description`, `AssignedTo`, `DueDate`, `Priority`, `Status`) VALUES
(1, 1, 'food ordering', 'we are doing food ordering project', 2024, '2024-05-30', 'to find capital', 'food ordering'),
(3, 2, 'road construction', 'building activity in Nyanza', 2024, '2024-05-30', 'building', 'building');

-- --------------------------------------------------------

--
-- Table structure for table `teammembers`
--

CREATE TABLE `teammembers` (
  `TeamMemberID` int(11) NOT NULL,
  `TeamID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teammembers`
--

INSERT INTO `teammembers` (`TeamMemberID`, `TeamID`, `UserID`, `Role`) VALUES
(1, 2, 1, 'customer'),
(2, 2, 13, 'admin'),
(3, 2, 7, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `timelines`
--

CREATE TABLE `timelines` (
  `TimelineID` int(11) NOT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `EventName` varchar(255) DEFAULT NULL,
  `EventDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timelines`
--

INSERT INTO `timelines` (`TimelineID`, `ProjectID`, `EventName`, `EventDate`) VALUES
(1, 1, 'meeting', '2024-04-28'),
(2, 1, '0', '2024-04-30'),
(3, 1, 'ddfg', '2024-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `Role`) VALUES
(1, 'Gentille@24', '222007958', 'ndatimanagentille@gmail.com', 'admin'),
(2, 'ndatimana', '2000', 'ndatimana@gmail.com', 'user'),
(3, 'gg', '$2y$10$pmjy7NQ327UGL9ny.PL5a.WTekaRr262t9g8OXdOEpWT/zOdcVvRi', '', 'customer'),
(4, 'anne', '$2y$10$VnvYH9r7SP1FScdg7WiMOeLceK2AcK5ypXVeoA/eU70tEg.BODdPy', '', 'customer'),
(5, 'Gentille', '$2y$10$A./5cQEh7jrwp836/Ip3VuevwP9dMBUs2LY4tDxO3VlVgpwMNW3OK', '', 'customer'),
(6, 'gg', '$2y$10$41AKrZTYlox.Dhr9R2TK5eOJ5X8uhkUDp3hDfXJjLk.oEgxuP.ha6', '', 'user'),
(7, 'mary', '$2y$10$FAsBeAAogBopG..Msi2KwuHKcQe5hUBW7kLNJ8LwUncofeckWHOKC', '', 'admin'),
(8, 'gogo', '$2y$10$NSHondB6C98Fzz4dBL/1X.H7XEkO0ZgghuMZeuA87UsnCTA5DOihG', '', 'admin'),
(9, 'anne', '$2y$10$USLedRJWOBcpiJBX1XcqL.CDaSFhoa5WFT/N4yjgBosGRpgcrH31.', '', 'admin'),
(10, 'anne', '$2y$10$cIjFqh2BeYCy4w5ePRsEb.ernHiwcdB7VwKNA7tZKEVdND8JMnDxe', 'anne@gmail.com', 'admin'),
(11, 'cedrick', '$2y$10$D7XE3GgNRKgR5L1KqacS2OhtsNZ7ALu2qRh2xhwcV7l2S3Iw4wlVC', 'cedrick@gmai.com', 'customer'),
(13, 'amina', '$2y$10$Ycc.5OTQ95vkPWs3SuFLbOR0NVHryTHq2eKzT737hRDyaZSrvMVS2', 'amina@gmail.com', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`AssignmentID`),
  ADD KEY `TaskID` (`TaskID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`AttachmentID`),
  ADD KEY `TaskID` (`TaskID`);

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`BudgetID`),
  ADD KEY `ProjectID` (`ProjectID`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`ExpenseID`),
  ADD KEY `BudgetID` (`BudgetID`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`MeetingID`),
  ADD KEY `ProjectID` (`ProjectID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ProjectID`);

--
-- Indexes for table `taskcomments`
--
ALTER TABLE `taskcomments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `TaskID` (`TaskID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`TaskID`),
  ADD KEY `ProjectID` (`ProjectID`);

--
-- Indexes for table `teammembers`
--
ALTER TABLE `teammembers`
  ADD PRIMARY KEY (`TeamMemberID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `timelines`
--
ALTER TABLE `timelines`
  ADD PRIMARY KEY (`TimelineID`),
  ADD KEY `ProjectID` (`ProjectID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`TaskID`) REFERENCES `tasks` (`TaskID`),
  ADD CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_ibfk_1` FOREIGN KEY (`TaskID`) REFERENCES `tasks` (`TaskID`);

--
-- Constraints for table `budgets`
--
ALTER TABLE `budgets`
  ADD CONSTRAINT `budgets_ibfk_1` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ProjectID`);

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`BudgetID`) REFERENCES `budgets` (`BudgetID`);

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_ibfk_1` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ProjectID`);

--
-- Constraints for table `taskcomments`
--
ALTER TABLE `taskcomments`
  ADD CONSTRAINT `taskcomments_ibfk_1` FOREIGN KEY (`TaskID`) REFERENCES `tasks` (`TaskID`),
  ADD CONSTRAINT `taskcomments_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ProjectID`);

--
-- Constraints for table `teammembers`
--
ALTER TABLE `teammembers`
  ADD CONSTRAINT `teammembers_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `timelines`
--
ALTER TABLE `timelines`
  ADD CONSTRAINT `timelines_ibfk_1` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ProjectID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
