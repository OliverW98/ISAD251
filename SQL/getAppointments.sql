CREATE DEFINER=`ISAD251_OWilkes`@`%` PROCEDURE `getAppointments`(IN `inUserID` int)
BEGIN
	SELECT * FROM appointments WHERE userID = inUserID;
END