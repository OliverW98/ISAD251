CREATE DEFINER=`ISAD251_OWilkes`@`%` PROCEDURE `deleteDeadline`(in  `inDeadlineID` int)
BEGIN
delete from deadlines where deadlineID = inDeadlineID;
END