CREATE DEFINER=`ISAD251_OWilkes`@`%` PROCEDURE `recordAppointment`(in `inUserID` int , in `inAppointmentDate` datetime, in `inAppointmentDetails` varchar(200), in `inAppointmentNotes` varchar(200), in `inNumOfPatients` int)
BEGIN
	INSERT INTO appointments(userID, appointmentDate, appointmentDetails, appointmentNotes, numOfPatients)
	VAlUES (inUserID , inAppointmentDate , inAppointmentDetails, inAppointmentNotes, inNumOfPatients);
END