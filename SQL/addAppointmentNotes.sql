CREATE DEFINER=`ISAD251_OWilkes`@`%` PROCEDURE `addAppointmentNotes`(in`inAppointmentID` int , in `inAppointmentNotes` varchar(200))
BEGIN
 update appointments
 set appointmentNotes = inAppointmentNotes
 where appointmentID = inAppointmentID;
END