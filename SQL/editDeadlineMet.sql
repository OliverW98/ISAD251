CREATE DEFINER=`ISAD251_OWilkes`@`%` PROCEDURE `editDeadlineMet`(in `inDeadlineID` int , in `inDeadlineMet` varchar(5))
BEGIN
update deadlines
set deadlineMet = inDeadlineMet
where deadlineID = inDeadlineID;
END