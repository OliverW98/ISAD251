CREATE DEFINER=`ISAD251_OWilkes`@`%` PROCEDURE `getDeadlines`(in `inUserID` int )
BEGIN
select * from deadlines where deadlineUserID = inUserID;
END