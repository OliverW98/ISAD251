CREATE DEFINER=`ISAD251_OWilkes`@`%` PROCEDURE `editAppointment`(in `inAppointmentID`int, in`inAppointmentDate`datetime , in `inAppointmentDetails`varchar(200),in `inAppointmentNotes` varchar(200) , in `inNumOfPatients` int)
BEGIN
update appointments
set appointmentDate = inAppointmentDate , appointmentDetails = inAppointmentDetails, appointmentNotes = inAppointmentNotes, numOfPatients = inNumOfPatients
where appointmentID = inAppointmentID;
END