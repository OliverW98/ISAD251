CREATE DEFINER=`ISAD251_OWilkes`@`%` PROCEDURE `deleteAppointment`(in `inAppointmentID` int)
BEGIN
DELETE FROM appointments WHERE appointmentID = inAppointmentID;
END