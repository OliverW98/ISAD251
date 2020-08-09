CREATE TABLE `deadlines` (
  `deadlineID` int(11) NOT NULL AUTO_INCREMENT,
  `deadlineUserID` int(11) NOT NULL,
  `deadlineDate` datetime NOT NULL,
  `deadlineDetails` varchar(200) NOT NULL,
  `deadlineMet` varchar(5) NOT NULL,
  PRIMARY KEY (`deadlineID`),
  KEY `userID_idx` (`deadlineUserID`),
  CONSTRAINT `deadlineUserID` FOREIGN KEY (`deadlineUserID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci