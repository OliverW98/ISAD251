CREATE TABLE `appointments` (
  `appointmentID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `appointmentDate` datetime NOT NULL,
  `appointmentDetails` varchar(200) DEFAULT NULL,
  `appointmentNotes` varchar(200) DEFAULT NULL,
  `numOfPatients` int(11) NOT NULL,
  PRIMARY KEY (`appointmentID`),
  KEY `userID_idx` (`userID`),
  CONSTRAINT `userID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci