CREATE DEFINER=`ISAD251_OWilkes`@`%` PROCEDURE `editDeadline`(in `inDeadlineID` int , in `inDeadlineDate` datetime , in `inDeadlineDetails` varchar(200) , in `inDeadlineMet` varchar(5))
BEGIN
update deadlines
set deadlineDate = inDeadlineDate , deadlineDetails = inDeadlineDetails , deadlineMet = inDeadlineMet
where deadlineID = inDeadlineID;
END